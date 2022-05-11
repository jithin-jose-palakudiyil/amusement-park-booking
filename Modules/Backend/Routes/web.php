<?php
/*
|--------------------------------------------------------------------------
| Constants variables
|--------------------------------------------------------------------------
|
| Here is where you can register Constants variables for your application. These
| variables are loaded by the application. Now create something great!
|
*/

define("admin_prefix", "ssap");
define("admin_guard", "admin");



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([ 'middleware' => 'preventBackHistory','prefix' => admin_prefix], function()
{ 
    Route::get('/', 'AuthController@index');
    Route::any('/login', 'AuthController@LoginAction')->name('LoginAction'); 
    /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
        Route::get('/dashboard', 'DashboardController@index');
        Route::get('/logout', 'AuthController@logout')->name('admin-logout');
        
        /* ************************************************************************** */
        /* ********************************** offers ******************************** */ 
        /* ************************************************************************** */ 
         
        Route::bind('offers', function ($value, $route) {return Modules\Backend\Entities\Offers::find($value); }); 
        Route::resource( '/offers', 'OffersController',
                        [ 
                            'names' => [
                                        'index'   => 'offers',
                                        'create'  => 'offers.create', 
                                        'store'   => 'offers.store', 
                                        'edit'    => 'offers.edit',
                                        'update'  => 'offers.update',
                                        'destroy' => 'offers.destroy' 
                                       ],
                        ]
        ); 
        
        
        /* ************************************************************************** */
        /* ********************************** Coupon ******************************** */ 
        /* ************************************************************************** */ 
         
        Route::bind('coupon', function ($value, $route) {return Modules\Backend\Entities\Coupon::find($value); }); 
        Route::resource( '/coupon', 'CouponController',
                        [ 
                            'names' => [
                                        'index'   => 'coupon',
                                        'create'  => 'coupon.create', 
                                        'store'   => 'coupon.store', 
                                        'edit'    => 'coupon.edit',
                                        'update'  => 'coupon.update',
                                        'destroy' => 'coupon.destroy' 
                                       ],
                        ]
        );  
        
        /* ************************************************************************** */
        /* ********************************* category ******************************* */ 
        /* ************************************************************************** */ 
         
        Route::bind('category', function ($value, $route) {return Modules\Backend\Entities\Category::find($value); }); 
        Route::resource( '/category', 'CategoryController',
                        [ 
                            'names' => [
                                        'index'   => 'category',
//                                        'create'  => 'coupon.create', 
//                                        'store'   => 'coupon.store', 
//                                        'edit'    => 'coupon.edit',
                                        'update'  => 'category.update',
//                                        'destroy' => 'coupon.destroy' 
                                       ],
                        ]
        );
        
        
        
        
        
        
        
        Route::any('/booking', 'BookingController@index')->name('admin_booking_index'); 
        Route::any('/booking-list', 'BookingController@listing')->name('admin_booking_list');
        Route::any('/booking-show/{id}', 'BookingController@show')->name('admin_booking_show');
        
    });
});
 
