<?php 
if(isset($booking)&& $booking && $booking->razorpay_order_id !=null && $booking->razorpay_payment_id !=null && $booking->razorpay_signature !=null):
    $created_booking = $booking->created_booking;
    $Offers = \Modules\Frontend\Entities\Offers::find($booking->offer_id);
    if($Offers):
?> 
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Invoice - #SS {{$booking->id}} </title> 
    <style>
        body {
  color: #f00;
  font-family: Helvetica;
}
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{asset('public/images/logo.png')}}" style="width: 80px;height: auto;">
                            </td>
                            
                            <td style="margin: 0; font-size: 12px;">
                                Invoice :<b>#SS {{$booking->id}} </b><br/>
                                Date & time:<b> {{$booking->created_at}} </b><br/>
                                Offer Type:<b> {{$Offers->name}} </b><br/>
                                @if($booking->coupon_code)
                                Promo Code :<b> {{$booking->coupon_code}}
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="margin: 0; font-size: 12px;">                     
                                Email : <b>{{$booking->email}} </b><br/> 
                                Phone.: <b>{{$booking->phone}}  </b><br/>
                                Booked For: <b>{{$booking->booking_date}}  </b><br/>
                                Payment id: <b>{{$booking->razorpay_payment_id}} </b><br/>
                               
                            </td>
                            
                            <td style="margin: 0; font-size: 12px;">
                               BILLED TO <br/>
                                <p style="margin: 0; font-size: 12px;font-weight: bold">{{$booking->full_name}}</p>
                                                    <p style="margin: 0; font-size: 12px;font-weight: bold">{{$booking->address}}</p>  
                            </td>
                        </tr>
                    
                                           
                    </table>
                </td>
            </tr>
            <tr class="details">
                <td colspan="2">
                       <table border="1" cellspacing="0" cellpadding="5" width="100%">
                                <thead>
                                    <tr>
                                        <td align="center">
                                            <p style="margin: 0;padding: 0px; font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Category</span></p>
                                        </td>
                                        <td align="center" style="text-align: center !important;">
                                            <p style="margin: 0;padding: 0px; font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Quantity</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0;padding: 0px; font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Price</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 0px;font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Offer Price</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 0px;font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Total</span></p>
                                        </td> 
                                    </tr>
                                </thead>
                                <tbody> 
                                <?php 
                                    $sub_total = 0; $actual_total = 0;
                                    foreach ($created_booking as $key => $value) : 
                                        $pivot = $value->pivot;
                                        $PivotOffers = \Modules\Backend\Entities\PivotOffers::where('offer_id',$booking->offer_id)->where('category_id',$pivot->category_id)->first();
                                        $discount = null;
                                        if($booking->coupon_id != null):
                                            $coupon = Modules\Frontend\Entities\Coupon::find($booking->coupon_id);
                                            if($coupon):
                                                $discount=$coupon->offer;
                                            endif;
                                        else: 
                                            if($Offers):
                                                $discount=$Offers->offer;
                                            endif;
                                        endif;
                                       
                                ?>    
                                
                                    <tr >
                                        <td align="center">
                                            <p style="margin: 0; padding: 0px;font-size: 12px; color: #666666;">
                                                {{$value->name}}
                                                
                                            </p>
                                        </td>
                                        <td align="center" style="text-align: center !important;">
                                            <p style="margin: 0; padding: 0px;font-size: 12px; color: #666666;">
                                                {{$pivot->count}}
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 0px;font-size: 12px; color: #666666;">
                                           {{isset($PivotOffers->actual_price) ? "Rs.".$PivotOffers->actual_price :''}}
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 0px;font-size: 12px; color: #666666;">
                                            <?php 
                                                $dis_pr = ($PivotOffers->actual_price/100)*$discount;
                                                $offer_price =  ceil(number_format($PivotOffers->actual_price-$dis_pr,2) );

                                                echo 'Rs.'.$offer_price;
                                                $_price =$offer_price*$pivot->count;
                                                $sub_total+=$_price;
                                                $actual_total+= ceil($pivot->count*$PivotOffers->actual_price);
                                            ?>
                                               
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0;padding: 0px; font-size: 12px; color: #666666;">
                                               Rs. {{$_price}}
                                            </p>
                                        </td>
                                    </tr>
                                <?php    endforeach; ?>
                                </tbody> 
                            </table>
                </td>
            </tr>

            <tr class="item">
                <td colspan="2" align="right">
                  <p style="margin: 0; font-size: 12px; color: #666666;">
                      Original Amount: <b> Rs.  {{number_format($actual_total,2)}} </b>
                  </p>
                </td>  
            </tr>
            <tr class="item" >
                <td colspan="2" align="right">
                    <p style="margin: 0; font-size: 12px; color: #666666;">
                        Discount Amount: <b>Rs.  {{number_format($actual_total-$sub_total,2)}} </b>
                    </p>
                </td>  
            </tr>
            <tr class="item heading">
                <td colspan="2" align="right">
                    Subtotal: Rs.  {{number_format($sub_total,2)}}
                </td>  
            </tr>
            <tr class="item" >
                <td colspan="2" align="right">
                    
                </td>  
            </tr>
            <tr class="item heading">
                <td colspan="2" align="right">
                    IGST (18%):   <?php 
                                            $IGST = ($sub_total/100)*18;  
                                            echo 'Rs. '.$IGST;
                                            ?>
                </td>  
            </tr>
            <tr class="item" >
                <td colspan="2" align="right">
                    
                </td>  
            </tr>
            <tr class="item heading">
                <td colspan="2" align="right">
                    TOTAL:  <?php  echo 'Rs. '.number_format(($sub_total+$IGST),2);  ?>
                </td>  
            </tr>
                 <tr>
                     <td colspan="2">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 5px;">
 
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                    <p style="margin-bottom: 0; font-size: 12px; color: #666666;">
                                                        Copyright © <?php  echo date('Y');  ?> Silver Storm Amusement Parks (P) Ltd.
                                                        <br> <a href="javascritp:void(0)"
                                                            style="text-decoration: none; color: #007eff;">All
                                                            rights reserved</a></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
        </table>
    </div>
</body>
</html>
    <?php else: abort(404); endif; else: abort(404); endif; ?>