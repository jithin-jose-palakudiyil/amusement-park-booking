<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = "offers";  
    protected $fillable = [];
    protected $guarded = [ ]; 
    
    public function pivot_offers()
    {
        return $this->belongsToMany("\Modules\Backend\Entities\PivotOffers","pivot_offers","offer_id","category_id")->withPivot('actual_price','offer_price') ;
    }
}
