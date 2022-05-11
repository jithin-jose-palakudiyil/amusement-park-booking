<?php

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
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'FrontendController@index')->name('booking_index');
Route::any('/get-offer-details/{offer_id}', 'FrontendController@offer_details');
Route::any('/booking-action', 'FrontendController@booking_action')->name('booking_action');
Route::any('/booking-summary', 'FrontendController@booking_summary')->name('booking_summary');
Route::any('/booking-completed', 'FrontendController@booking_completed')->name('booking_completed');
Route::any('/payment-store', 'FrontendController@payment_store')->name('payment_store');
Route::any('/download-invoice/{booking_id}', 'FrontendController@download_invoice')->name('download_invoice');

//Route::prefix('frontend')->group(function() {
//    Route::get('/', 'FrontendController@index');
//});
