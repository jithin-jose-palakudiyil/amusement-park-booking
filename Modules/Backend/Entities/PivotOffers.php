<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class PivotOffers extends Model
{
    protected $table = "pivot_offers";  
    protected $fillable = ['offer_id','category_id','actual_price','offer_price'];
    
}
