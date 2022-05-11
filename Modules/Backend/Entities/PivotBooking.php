<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class PivotBooking extends Model
{
    protected $table = "pivot_booking";  
    protected $fillable = ['booking_id','category_id','count'];
}
