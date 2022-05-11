<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Category;

class CategoryController extends Controller
{
    protected $repository;
    public function __construct(Category $category)
    {   
        $this->defaultUrl           =   route('coupon');
        $this->createUrl            =   route('coupon.create');  
        $this->createMessage        =   'Category is created successfully.';
        $this->createErrorMessage   =   'Category is not created successfully.';
        $this->updateMessage        =   'Category is updated successfully.';
        $this->updateErrorMessage   =   'Category is not updated successfully.';
        $this->deleteMessage        =   'Category is deleted successfully.';
        $this->deleteErrorMessage   =   'Category is not deleted successfully.';  
         $this->page_title          =   "Category";
        $this->breadcrumb_icon      =  'icon-stack2';
        $this->active               =  'category'; 
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Category', "active" => 1,"url" => $this->defaultUrl ), //only last add active page array
                           ); 
        $category = Category::all();
        return view('backend::category.index', compact('page_title','category','active','breadcrumb','breadcrumb_icon'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
//    public function create()
//    {
//        return view('backend::create');
//    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
//    public function store(Request $request)
//    {
//        //
//    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
//    public function show($id)
//    {
//        return view('backend::show');
//    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Category $category)
    {
        
        $error = null;
        try
        {
            if($category->status == 1):
                $category->update(['status'=>0]);
            elseif($category->status == 0):    
                $category->update(['status'=>1]);
            endif;
        } catch (Exception $ex) {$error = $ex->getMessage(); }
        if($error == null): 
            \Session::flash('flash-success-message',$this->updateMessage);
        else: 
            \Session::flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$error);
        endif;
        return \Redirect::route('category'); 
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
