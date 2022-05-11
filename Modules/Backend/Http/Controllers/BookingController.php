<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Booking; 

class BookingController extends Controller
{
      protected $repository;
    public function __construct(Booking $booking)
    {   
   
        $this->page_title          =   "Booking";
        $this->breadcrumb_icon      =  'icon-stack2';
        $this->active               =  'booking'; 
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
                                array ("title" => 'Booking', "active" => 1,"url" => '' ), //only last add active page array
                           ); 
         
        return view('backend::booking.index', compact('page_title','active','breadcrumb','breadcrumb_icon'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function listing(Request $request)
    {
        return \DataTables::of(Booking::with('booking_offer')->get())->make(true);
    }

     

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $booking = Booking::with('created_booking')->where('id',$id)->first();
        
        if($booking): 
            $page_title= $this->page_title  ; $breadcrumb_icon = $this->breadcrumb_icon; $active= $this->active;
            $breadcrumb = array(   
                                    array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                    array ("title" => 'Booking', "url" => route('admin_booking_list') ), 
                                    array ("title" => 'Show', "active" => 1,"url" => '' ), //only last add active page array
                               ); 

            return view('backend::booking.show', compact('page_title','booking','active','breadcrumb','breadcrumb_icon'));
        else: abort(404); endif;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('backend::edit');
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
