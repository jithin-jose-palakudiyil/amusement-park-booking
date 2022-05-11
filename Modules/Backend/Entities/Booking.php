<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "booking";  
    protected $fillable = [];
    protected $guarded = [ ]; 
    
     public function pivot_booking()
    {
        return $this->belongsToMany("\Modules\Frontend\Entities\PivotBooking","pivot_booking","booking_id","category_id")->withPivot('count') ;
    }
    
    // fetch all created countries based on relation
    public function created_booking() {
        return $this->belongsToMany("Modules\Backend\Entities\Category",'pivot_booking')->withPivot('count');
    }
    
    // fetch all created countries based on relation
    public function booking_offer() {
        return $this->belongsTo("Modules\Backend\Entities\Offers","offer_id","id");
    }
}
