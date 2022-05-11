@extends('backend::layouts.master')

@section('content')
<?php if(isset($booking) && $booking):
     
    $created_booking = $booking->created_booking;
    ?>
    

    <div class="panel panel-flat"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Offer Price</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    $sub_total = 0;
                    foreach ($created_booking as $key => $value) :  
                        $pivot = $value->pivot;
                        $PivotOffers = \Modules\Backend\Entities\PivotOffers::where('offer_id',$booking->offer_id)->where('category_id',$pivot->category_id)->first();
                        $discount = null;
                        if($booking->coupon_id != null):
                            $coupon = \Modules\Backend\Entities\Coupon::find($booking->coupon_id);
                            if($coupon):
                                $discount=$coupon->offer;
                            endif;
                        else:
                           $Offers =  Modules\Backend\Entities\Offers::find($booking->offer_id);
                            if($Offers):
                                $discount=$Offers->offer;
                            endif;
                        endif;
                        
                ?>        
                <tr>
                    <td class="col-md-4"><em>{{$value->name}}</em></td>
                    <td class="col-md-2" style="text-align: center">{{$pivot->count}}</td>
                    <td class="col-md-2 text-center">{{isset($PivotOffers->actual_price) ? "₹ ".$PivotOffers->actual_price :''}}</td>
                    <td class="col-md-2 text-center">
                        <?php 
                            $dis_pr = ($PivotOffers->actual_price/100)*$discount;
                            $offer_price =  ceil(number_format($PivotOffers->actual_price-$dis_pr,2) );
                            
                            echo '₹'.$offer_price;
                            $_price =$offer_price*$pivot->count;
                            $sub_total+=$_price;
                        ?>
                        </td>
                    <td class="col-md-3 text-center">₹ {{$_price}}</td>
                </tr> 
                        
                <?php  
                    endforeach; 
                ?>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="1"><em>IGST (18%):</em></td> 
                    <td colspan="2">₹ 
                    <?php 
                    $IGST = ($sub_total/100)*18;  
                    echo $IGST;
                    ?>
                    </td>
                </tr> 
                <tr>
                    <td colspan="3"></td>
                    <td colspan="1"><em>Total:</em></td> 
                    <td colspan="2">₹ 
                    <?php 
                     
                    echo number_format(($sub_total+$IGST),2);  
                    
                    ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="panel panel-flat">
        <table class="table table-user-information">
            <tbody> 
                <tr>
                    <td>Booking date :</td>
                    <td> <b>{{$booking->booking_date}}</b></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><b> {{$booking->full_name}}</b></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><b> {{$booking->address}}</b></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><b>{{$booking->email}}</b></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><b>{{$booking->phone}}</b></td>
                </tr> 
                <tr>
                    <td>coupon code</td>
                    <td><b>{{$booking->coupon_code}}</b></td>
                </tr> 
            </tbody>
        </table>
    </div>
    <div class="panel panel-flat"> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>razorpay order id</th>
                    <th>razorpay payment id</th>
                    <th class="text-center">amount paid</th> 
                </tr>
            </thead>
            <tbody> 
                <tr>
                    <td class="col-md-4"><em>{{$booking->razorpay_order_id}}</em></td>
                    <td class="col-md-2" >{{$booking->razorpay_payment_id}}</td>
                    <td class="col-md-2 text-center">₹ {{$booking->amount_paid}}</td> 
                </tr> 
            </tbody>
        </table>
    </div>
<?php endif; ?>
@endsection
