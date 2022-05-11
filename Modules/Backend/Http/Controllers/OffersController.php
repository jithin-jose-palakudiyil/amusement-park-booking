<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Offers; 
use \Exception;



class OffersController extends Controller
{
    protected $repository;
    public function __construct(Offers $offers)
    {   
        $this->defaultUrl           =   route('offers');
        $this->createUrl            =   route('offers.create');  
        $this->createMessage        =   'Offer is created successfully.';
        $this->createErrorMessage   =   'Offer is not created successfully.';
        $this->updateMessage        =   'Offer is updated successfully.';
        $this->updateErrorMessage   =   'Offer is not updated successfully.';
        $this->deleteMessage        =   'Offer is deleted successfully.';
        $this->deleteErrorMessage   =   'Offer is not deleted successfully.';  
         $this->page_title           =   "Offer";
        $this->breadcrumb_icon      =  'icon-cart2';
        $this->active               =  'offers'; 
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Offer');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Offers', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           ); 
        $offers =     Offers::all();
        return view('backend::offers.index', compact('page_title','offers','active','breadcrumb','breadcrumb_icon','CreateBtn'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Offers $offers)
    {
        $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Offers', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
         
        return view('backend::offers.create', compact('offers','page_title','active','breadcrumb','breadcrumb_icon'));
    
        
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        
         $request->validate(
                    [
                        'group_id' => 'required|string',
                        'name' => 'required|string',
                        'offer' => 'required|numeric',
                        'status' => 'required|numeric',
                        'category' => 'required|array|min:1',
                        'actualprice' => 'required|array|min:1',
                        'offerprice' => 'required|array|min:1'
                        
                     ]);
        $error = null;
        if(!$request->ajax() && $request->exists('group_id')):
            $group = ['silverstorm','snowstorm','both'];
            if(in_array($request->group_id, $group)): 
                if($request->exists('category')&& is_array($request->category)):
                    $array = []; 
                    $offer = $request->offer;
                    foreach ($request->category as $key => $value):
                        $explode = explode('::', $value);
                        if(count($explode)==2):
                            $category = \Modules\Backend\Entities\Category::where('slug',$explode[0])->where('id',$explode[1])->where('status',1)->first();
                            if($category && isset($request->actualprice[$key]) && isset($request->offerprice[$key]) ):
                                $category_id   = $category->id;
                                $actualprice    = $request->actualprice[$key];
                                $offerprice     = $request->offerprice[$key];
                                if(is_numeric($actualprice) && is_numeric($offerprice) && is_numeric($offer) && $offer <=100):
                                    
                                    $actual_offer = number_format(($actualprice/100)*$offer,2);
                                  
                                    if($actual_offer == $offerprice):
                                        $array[$key] = ['category_id'=>$category_id,'actual_price'=>$actualprice,'offer_price'=>$offerprice];
                                    else:
                                      //error
                                    endif;
                                else:  
                                //error
                                endif;  
                            endif;
                        else: abort(404); endif; 
                    endforeach;
                    if(count($array) != count($request->category)):
                       $error = 'Sorry, something went wrong in category. Please try again later'; 
                    endif; 
                    if($error==null):
                        $my = null;
                        try{
                            $create_array=['group'=>$request->group_id,'name'=>$request->name,'status'=>$request->status,'offer'=>$offer];
                            $create = Offers::create($create_array);
                            if($create):
                                $create->pivot_offers()->sync($array);
                            endif;
                        } catch (Exception $ex) { $my= $ex->getMessage(); }
                       
                        if($my == null): 
                            $request->session()->flash('flash-success-message',$this->createMessage);
                            return \Redirect::route('offers'); 
                        else: 
                            $request->session()->flash('flash-error-message',$this->createErrorMessage.'<br/> '.$my);
                            return \Redirect::back();
                        endif; 
                        //create 
                    else: return \Redirect::back()->withErrors([$error]); endif;
                else: abort(404); endif; 
            else: abort(404); endif;
        else: abort(404); endif;  
    }

 

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $offers = Offers::find($id);
        if($offers):
            $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        
            $breadcrumb = array(   
                                    array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                    array ("title" => 'Offers', "url" => $this->defaultUrl ),  
                                    array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array

                               ); 
             
              
         return view('backend::offers.edit', compact('offers','page_title','active','breadcrumb','breadcrumb_icon'));
       
        else: abort(404); endif;
         
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $offers = Offers::find($id);
        if($offers):
            $request->validate(
                    [
                        'group_id' => 'required|string',
                        'name' => 'required|string',
                        'offer' => 'required|numeric',
                        'status' => 'required|numeric',
                        'category' => 'required|array|min:1',
                        'actualprice' => 'required|array|min:1',
                        'offerprice' => 'required|array|min:1'
                        
                     ]);
        
            $error = null;
            if(!$request->ajax() && $request->exists('group_id')):
                $group = ['silverstorm','snowstorm','both'];
                if(in_array($request->group_id, $group)): 
                    if($request->exists('category')&& is_array($request->category)):
                        $array = []; 
                        $offer = $request->offer;
                        foreach ($request->category as $key => $value):
                            $explode = explode('::', $value);
                            if(count($explode)==2):
                                $category = \Modules\Backend\Entities\Category::where('slug',$explode[0])->where('id',$explode[1])->where('status',1)->first();
                                if($category && isset($request->actualprice[$key]) && isset($request->offerprice[$key]) ):
                                    $category_id   = $category->id;
                                    $actualprice    = $request->actualprice[$key];
                                    $offerprice     = $request->offerprice[$key];
                                    if(is_numeric($actualprice) && is_numeric($offerprice) && is_numeric($offer) && $offer <=100):
                                         $actual_offer = number_format(($actualprice/100)*$offer,2);
                                  
                                        if($actual_offer == $offerprice):
                                            $array[$key] = ['category_id'=>$category_id,'actual_price'=>$actualprice,'offer_price'=>$offerprice];
                                        else:
                                          //error
                                        endif;
                                    else:  
                                    //error
                                    endif;  
                                endif;
                            else: abort(404); endif; 
                        endforeach;
                        if(count($array) != count($request->category)):
                           $error = 'Sorry, something went wrong in category. Please try again later'; 
                        endif; 
                        if($error==null):
                            $my = null;
                            try{
                                $create_array=['group'=>$request->group_id,'name'=>$request->name,'status'=>$request->status,'offer'=>$offer];
                                $update = $offers->update($create_array);
                                if($update):
                                    $offers->pivot_offers()->sync($array);
                                endif;
                            } catch (Exception $ex) { $my= $ex->getMessage(); }

                            if($my == null): 
                                $request->session()->flash('flash-success-message',$this->updateMessage);
                                return \Redirect::route('offers'); 
                            else: 
                                $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$my);
                                return \Redirect::back();
                            endif; 
                            //create 
                        else: return \Redirect::back()->withErrors([$error]); endif;
                    else: abort(404); endif; 
                else: abort(404); endif;
            else: abort(404); endif; 

        
        
        
        else: abort(404); endif;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $offers = Offers::find($id); 
        if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($offers):  $offers->delete(); endif;
            } catch (Exception $ex) {  $error = $ex->getMessage();  }

            if($error == null):      
                \Session::flash('flash-success-message',$this->deleteMessage);
                $msg=array('type'=>'success'); 
            else: 
                 \Session::flash('flash-success-message',$this->deleteErrorMessage);
                $msg=array('type'=>'error'); 
            endif;
        else:
            \Session::flash('flash-success-message',$this->deleteErrorMessage);
            $msg=array('type'=>'error');
        endif; 
        return response()->json($msg, 200);
        
    }
}
