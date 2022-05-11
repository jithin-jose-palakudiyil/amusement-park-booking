<?php if(isset($pivot_offers) && $pivot_offers->isNotEmpty() && isset($offers) && $offers): ?>
<h2 class="section_title" style="color: #f8bd2c"> {{$offers->name}} </h2>
<h3 class="main_question">Choose category and quantity ?</h3>
<table  cellspacing="3" cellpadding="3" style="width: 100%" > 
    <tbody> 
        <?php foreach ($pivot_offers as $key => $value) :
            //dd($value);
            $offer_price = ceil(number_format($value->actual_price-$value->offer_price,2) );
        ?> 
        <tr>
            <td>
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label class="container_check"> {{$value->name}} / ₹{{$offer_price}} <br/><small>(Actual Price: ₹{{$value->actual_price}})</small>
                            <input type="checkbox" name="category[]" data-key='{{$key}}' value="{{\Crypt::encryptString($value->id)}}" class="required category_options">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </td> 
            <td>  
                <div class="form-group">
                    <label for="qty">Count</label>
                    <input type="number" style="width: 100px" disabled="" name="qty[]" id="qty_{{$key}}" data-qtykey='{{$key}}' data-price='{{$offer_price}}' class="form-control qty_option" min="1" >
                </div>  
            </td> 
            <td>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" style="width: 100px" disabled="" name="price[]" id="price_{{$key}}" data-pricekey='{{$key}}' class="form-control price_option"  value="" >
                </div> 
            </td>
        </tr> 
        <?php  endforeach;  ?>
        
         <tr>
            <td>
                 
            </td> 
             
            <td colspan="2" align='left'>
                <div>
                   
                   <span id="igst"></span>
                </div>
                
                <div>
                    <span id="TotalPrice"></span>
                </div>
            </td>
        </tr> 
        
    </tbody>
</table>
<?php else: ?>                                    
     <h2 class="section_title">Sorry, No Offer Details Found</h2>
<?php endif; ?>