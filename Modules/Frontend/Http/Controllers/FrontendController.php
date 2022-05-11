<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Session; 
use Razorpay\Api\Api; use \Config;
use \Exception; use \Mail;
use PDF;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (Session::has('Booking_Offer_Success')): Session::forget('Booking_Offer_Success'); endif;
        if (Session::has('Booking_Offer_Error')): Session::forget('Booking_Offer_Error'); endif;
        if (Session::has('Booking_Success')): Session::forget('Booking_Success'); endif;
        if (Session::has('Booking_Error')): Session::forget('Booking_Error'); endif;
        $page_title = 'Booking';
        return view('frontend::steps.index', compact('page_title'));
    }

    /**
     * Show the offer details a new resource.
     * @return Response
     */
    public function offer_details(Request $request)
    {
        if (Session::has('Booking_Offer_Success')): Session::forget('Booking_Offer_Success'); endif;
        if (Session::has('Booking_Offer_Error')): Session::forget('Booking_Offer_Error'); endif;
        if (Session::has('Booking_Success')): Session::forget('Booking_Success'); endif;
        if (Session::has('Booking_Error')): Session::forget('Booking_Error'); endif;
        
        if($request->offer_id):
            $_id = \Crypt::decryptString($request->offer_id); 
            $offers = \Modules\Frontend\Entities\Offers::where('id',$_id)->where('status',1)->first();
            if($offers):
                $pivot_offers =  \DB::table('pivot_offers')->join('category','category.id','=', 'pivot_offers.category_id')->where('pivot_offers.offer_id', $offers->id)->where('category.status', 1)->get();
                if($pivot_offers->isNotEmpty()):
                    $html =  \View::make('frontend::steps.wizard.offer_details', compact('pivot_offers','offers'))->render(); 
                    return response()->json(['offer_details' => $html], 200);
                else: return response()->json(['message' => 'Page not found!'], 404);   endif;
            else: return response()->json(['message' => 'Page not found!'], 404); endif;
        else: return response()->json(['message' => 'Page not found!'], 404); endif;
         
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function booking_action(Request $request)
    {
        if (Session::has('Booking_Offer_Success')): Session::forget('Booking_Offer_Success'); endif;
        if (Session::has('Booking_Offer_Error')): Session::forget('Booking_Offer_Error'); endif;
        if (Session::has('Booking_Success')): Session::forget('Booking_Success'); endif;
        if (Session::has('Booking_Error')): Session::forget('Booking_Error'); endif;
        
        $error =[]; $data =[]; $category = [];
        if($request->exists('booking_offer')): 
            $_id = \Crypt::decryptString($request->booking_offer); 
            $offers = \Modules\Frontend\Entities\Offers::where('id',$_id)->where('status',1)->first();
            if($offers):
                if($request->exists('category') && is_array($request->category) && !empty($request->category) ):  
                    foreach ($request->category as $key => $value) : $category[] = \Crypt::decryptString($value);  endforeach;
                    $pivot_offers =  \DB::table('pivot_offers')->join('category','category.id','=', 'pivot_offers.category_id')->whereIn('pivot_offers.category_id', $category)->where('pivot_offers.offer_id', $offers->id)->where('category.status', 1)->get();
                    if(count($pivot_offers) == count($request->category)):
                        if($request->exists('qty') && is_array($request->qty) && !empty($request->qty) && ( count($request->qty) == count($request->category) ) ): 
                           $data =$request->all();  $data['offers'] = $offers; $data['pivot_offers'] = $pivot_offers;
                       else: $error[]='Selected category and their count is not matching'; endif;
                    else: $error[]='Selected category not found '; endif;
                else: $error[]='Category not found '; endif;
            else: $error[]='Your Offer not found '; endif; 
        else: $error[]='Offer not found '; endif;
        
        if(empty($error) && !empty($data)): Session::put('Booking_Offer_Success', $data); else: Session::put('Booking_Offer_Error', $error);endif; 
        return \Redirect::route('booking_summary');
         
        
        
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function booking_summary(Request $request)
    {
   
        if (Session::has('Booking_Offer_Success')): 
            if ($request->isMethod('post') && $request->exists('promo')):
                $coupon = \Modules\Frontend\Entities\Coupon::where('coupon_code',$request->promo)->first();
                if($coupon):
                    if (Session::has('Booking_Offer_Success.promo_code')):
                        Session::forget('Booking_Offer_Success.promo_code');
                    endif;
                     \Session::flash('flash-coupon-success','coupon code applied successfully');
                    Session::put('Booking_Offer_Success.promo_code',$coupon);
                else:
                    \Session::flash('flash-coupon-fail','coupon code not found!');
                    if (Session::has('Booking_Offer_Success.promo_code')):
                        Session::forget('Booking_Offer_Success.promo_code');
                    endif;    
                endif;
            endif; 
            return view('frontend::steps.wizard.booking_summary');
        elseif (Session::has('Booking_Offer_Error')): 
            return view('frontend::steps.wizard.booking_summary_error');
        else: abort(404); endif;
        
       
    }

    
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function payment_store(Request $request)
    {   
        $array = $error = [];
        try
        { 
            if($request->exists('razorpay_order_id') && $request->exists('razorpay_payment_id') && $request->exists('razorpay_signature') ):
                $api = new Api(Config::get('constants.razorpay.api_key'), Config::get('constants.razorpay.api_secret'));
                $payment = $api->payment->fetch($request->razorpay_payment_id);
                if($payment && $payment->error_code == null):
                     
                    $array['razorpay_order_id']     =   $request->razorpay_order_id;
                    $array['razorpay_payment_id']   =   $request->razorpay_payment_id;
                    $array['razorpay_signature']    =   $request->razorpay_signature;
                    $array['amount_paid']           =   ($payment->amount/100); 
                    $create = null;
                    if(!empty($array)):  $create = \Modules\Frontend\Entities\Booking::create($array); endif; 
                    if($create):
                        $booking_offer = [];
                        if(Session::has('Booking_Offer_Success') || $request->exists('booking_offer') ):
                            $booking_offer = Session::get('Booking_Offer_Success'); 
                        elseif($request->exists('booking_offer')) :
                            $booking_offer = decrypt($request->booking_offer);
                            $booking_offer = $booking_offer->toArray();
                        endif;  
                        $update_array = [];
                        if(!empty($booking_offer)):
                            $update_array['offer_id']      = isset($booking_offer['offers']->id) ? $booking_offer['offers']->id : null;
                            $update_array['full_name']      = isset($booking_offer['name']) ? $booking_offer['name'] : null;
                            $update_array['address']        = isset($booking_offer['address']) ? $booking_offer['address'] : null;
                            $update_array['email']          = isset($booking_offer['email']) ? $booking_offer['email'] : null;
                            $update_array['phone']          = isset($booking_offer['phone']) ? $booking_offer['phone'] : null;
                            $update_array['booking_date']   = isset($booking_offer['bookingdate']) ? $booking_offer['bookingdate'] : null;
                            $update_array['coupon_code']    = isset($booking_offer['promo_code']->coupon_code) ? $booking_offer['promo_code']->coupon_code : null;
                            $update_array['coupon_id']      = isset($booking_offer['promo_code']->id) ? $booking_offer['promo_code']->id : null;
                            $create->update($update_array);
                        endif; 
                        
                        if(isset($booking_offer['pivot_offers']) && isset($booking_offer['qty'])):
                            $pivot_booking = [];
                            foreach ($booking_offer['pivot_offers'] as $key => $value):
                                if(isset($booking_offer['qty'][$key])):
                                    $pivot_booking[$key]['category_id'] = $value->category_id;
                                    $pivot_booking[$key]['count'] = $booking_offer['qty'][$key];
                                endif; 
                            endforeach;
                        endif;
                        if(!empty($pivot_booking)):
                            $create->pivot_booking()->sync($pivot_booking);
                        endif; 
                    else: $error = 'Booking not completed, please contact us with your payment id from bank. '; endif; 
                else: $error = $payment->error_code;  endif;  
                if (Session::has('Booking_Offer_Success')): Session::forget('Booking_Offer_Success'); endif;
                if (Session::has('Booking_Offer_Error')): Session::forget('Booking_Offer_Error'); endif; 
            else: $error = 'Payment not success '; endif; 
        } catch (Exception $ex) { $error = $ex->getMessage(); }
        if($error == null && $create):
            Session::put('Booking_Success', [ 'id' => $create->id]);
            //send email
            $email_error = null;
            try{
                $to = $create->email;
                Mail::send('frontend::steps.booking_success',['booking'=>$create], function($message) use ($to)   
                {  
                       $message->to($to,  Config::get('constants.email_setting.sitename').' - invoice')->subject('invoice');
                       $message->from(Config::get('constants.email_setting.from'), Config::get('constants.email_setting.sitename') );
                });
                 
            } catch (Exception $ex) { $email_error =$ex->getMessage();  }
        else:
            Session::put('Booking_Error', $error);
        endif;
        return \Redirect::route('booking_completed');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function booking_completed()
    {
        
        if (Session::has('Booking_Success')):  
            $booking = \Modules\Frontend\Entities\Booking::find(Session::get('Booking_Success.id'));
            return view('frontend::steps.booking_success', compact('booking'));
        elseif (Session::has('Booking_Error')): 
             return view('frontend::steps.booking_fail');
        else: abort(404); endif;
    }
    
    
        /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function download_invoice($booking_id)
    {
        $decrypted = \Crypt::decryptString($booking_id); 
         $booking = \Modules\Frontend\Entities\Booking::with('created_booking')->where('id',$decrypted)->first();
//         dd($booking);
////        $booking = \Modules\Frontend\Entities\Booking::find($decrypted); 
        if($booking):
//             return view('frontend::steps.invoice', compact('booking'));
            $pdf = PDF::loadView('frontend::steps.invoice', compact('booking'));  
            return $pdf->download($booking->booking_date.'.pdf');
        else:
            abort(404);
        endif;
       
    }
    
    
}
