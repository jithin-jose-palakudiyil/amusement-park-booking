<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Coupon;
use \Exception;

class CouponController extends Controller
{
    protected $repository;
    public function __construct(Coupon $coupon)
    {   
        $this->defaultUrl           =   route('coupon');
        $this->createUrl            =   route('coupon.create');  
        $this->createMessage        =   'Coupon code is created successfully.';
        $this->createErrorMessage   =   'Coupon code is not created successfully.';
        $this->updateMessage        =   'Coupon code is updated successfully.';
        $this->updateErrorMessage   =   'Coupon code is not updated successfully.';
        $this->deleteMessage        =   'Coupon code is deleted successfully.';
        $this->deleteErrorMessage   =   'Coupon code is not deleted successfully.';  
         $this->page_title          =   "Coupon code";
        $this->breadcrumb_icon      =  'icon-basket';
        $this->active               =  'coupon'; 
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Coupon');
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Offers', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           ); 
        $coupon = Coupon::all();
        return view('backend::coupon.index', compact('page_title','coupon','active','breadcrumb','breadcrumb_icon','CreateBtn'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Coupon $coupon)
    {
        $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Coupon', "url" => $this->defaultUrl ),  
                                array ("title" => 'Create', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
         
        return view('backend::coupon.create', compact('coupon','page_title','active','breadcrumb','breadcrumb_icon'));
    
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(\Modules\Backend\Http\Requests\CouponRequest $request)
    {
       $error = null;
        try
        {
            $haystack = ['percentage'];
            if($request->exists('type') && in_array($request->type, $haystack)):
                $data = $request->all();
                unset($data['_token']);
                Coupon::create($data);
            else:
               $error = 'Type Not Found !';
            endif;
            
        } catch (Exception $ex) {$error = $ex->getMessage(); }
        if($error == null): 
            $request->session()->flash('flash-success-message',$this->createMessage);
            return \Redirect::route('coupon'); 
        else: 
            $request->session()->flash('flash-error-message',$this->createErrorMessage.'<br/> '.$my);
            return \Redirect::back();
        endif;
                        
    }

    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Coupon $coupon)
    {
       $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Coupon', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           ); 
         
        return view('backend::coupon.edit', compact('coupon','page_title','active','breadcrumb','breadcrumb_icon'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(\Modules\Backend\Http\Requests\CouponRequest $request, Coupon $coupon)
    {
       $error = null;
        try
        {
            $haystack = ['percentage'];
            if($request->exists('type') && in_array($request->type, $haystack)):
                $data = $request->all();
                unset($data['_token']);
                $coupon->update($data); 
            else:
               $error = 'Type Not Found !';
            endif;
        } catch (Exception $ex) {$error = $ex->getMessage(); }
        if($error == null): 
            $request->session()->flash('flash-success-message',$this->updateMessage);
            return \Redirect::route('coupon'); 
        else: 
            $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$my);
            return \Redirect::back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Coupon $coupon)
    {
         
        if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($coupon):  $coupon->delete(); endif;
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
