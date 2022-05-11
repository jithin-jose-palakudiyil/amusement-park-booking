<?php 
if(isset($booking)&& $booking && $booking->razorpay_order_id !=null && $booking->razorpay_payment_id !=null && $booking->razorpay_signature !=null):
    $created_booking = $booking->created_booking;
    $Offers = \Modules\Frontend\Entities\Offers::find($booking->offer_id);
    if($Offers):
?> 
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        @media only screen and (max-width: 960px) {
            .container {
                width: 600px;
            }
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
            }

            .invoice-left {
                width: 100%;
            }

            .invoice-right {
                width: 100%;
            }

            .total-price {
                padding-right: 10px;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0"
        style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
        <tr>
            <td>
                <!-- // START CONTAINER -->
                <table class="container" width="600px" align="center" border="0" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff;">
                    <tr>
                        <td>
                            <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"
                                style="background-color: #ffffff;">
                                <tr>
                                    <td>
                                        <img src="{{asset('public/images/logo.png')}}" style="width: 60px;height: auto" alt="Apple Logo">
                                    </td>
                                    <td align="right">
                                        <p style="font-size: 32px; color: #888888;">Invoice</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                style="background-color: #fafafa;">
                                <tr>
                                    <td>
                                        <table class="invoice-left" width="50%" align="left" border="0" cellpadding="0"
                                            cellspacing="0" style="padding-top: 10px; padding-left: 20px;">
                                            <tr>
                                                <td>
                                                    <p
                                                        style="margin: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        Email</p>
                                                    <p style="margin: 0; font-size: 12px;">{{$booking->email}}</p>
                                                </td>
                                                  <td align="center" style="border: 1px #ffffff solid">
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        Date & time</p>
                                                    <p style="margin-top: 0; font-size: 12px;">{{$booking->created_at}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px #ffffff solid">
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        Phone :</p>
                                                    <p style="margin-top: 0; font-size: 12px;">{{$booking->phone}}</p>
                                                </td>
                                                <td align="center" style="border: 1px #ffffff solid">
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        Booked For</p>
                                                    <p style="margin-top: 0; font-size: 12px;">{{$booking->booking_date}}</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        Payment id</p>
                                                    <p style="margin-top: 0; font-size: 12px;color: #4caf50">{{$booking->razorpay_payment_id}}</p>
                                                </td>
                                                <td align="center">
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        Offer Type.</p>
                                                    <p style="margin-top: 0; font-size: 12px;">{{$Offers->name}}</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="invoice-right" width="50%" align="right" border="0"
                                            cellpadding="0" cellspacing="0" style="padding-left: 20px;">
                                            <tr>
                                                <td>
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        BILLED TO</p>
                                                    <p style="margin: 0; font-size: 12px;">{{$booking->full_name}}</p>
                                                    <p style="margin: 0; font-size: 12px;">{{$booking->address}}</p>
                                                     
                                                </td>
                                            </tr>
                                            @if($booking->coupon_code)
                                            <tr>
                                                <td>
                                                    <p
                                                        style="margin-bottom: 0; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                       Promo Code</p>
                                                   
                                                    <p style="margin: 0; font-size: 12px;">{{$booking->coupon_code}}</p>
                                                     
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 30px;">
<!--                            <table class="apple-services" border="0" cellpadding="0" cellspacing="0">
                                <p style="padding: 7px; font-size: 14px; font-weight: 500; background-color: #fafafa;">
                                    Category
                                </p>
                            </table>-->
                            <table border="1" cellspacing="0" cellpadding="5" width="100%">
                                <thead>
                                    <tr>
                                        <td align="center">
                                            <p style="margin: 0;padding: 7px; font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Category</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0;padding: 7px; font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Quantity</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0;padding: 7px; font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Price</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 7px;font-size: 12px; color: #000;"> 
                                            <span style="font-weight: 700;">Offer Price</span></p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 7px;font-size: 12px; color: #000;"> 
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
                                
                                    <tr>
                                        <td align="center">
                                            <p style="margin: 0; padding: 7px;font-size: 12px; color: #666666;">
                                                {{$value->name}}
                                                <!--<span style="font-weight: 700;">20%</span>-->
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 7px;font-size: 12px; color: #666666;">
                                                {{$pivot->count}}
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 7px;font-size: 12px; color: #666666;">
                                           {{isset($PivotOffers->actual_price) ? "₹ ".$PivotOffers->actual_price :''}}
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0; padding: 7px;font-size: 12px; color: #666666;">
                                            <?php 
                                                $dis_pr = ($PivotOffers->actual_price/100)*$discount;
                                                $offer_price =  ceil(number_format($PivotOffers->actual_price-$dis_pr,2) );

                                                echo '₹'.$offer_price;
                                                $_price =$offer_price*$pivot->count;
                                                $sub_total+=$_price;
                                                $actual_total+= ceil($pivot->count*$PivotOffers->actual_price);
                                            ?>
                                               
                                            </p>
                                        </td>
                                        <td align="center">
                                            <p style="margin: 0;padding: 7px; font-size: 12px; color: #666666;">
                                               ₹ {{$_price}}
                                            </p>
                                        </td>
                                    </tr>
                                <?php    endforeach; ?>
                                </tbody> 
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="padding-left: 20px;">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 0 0 15px;">
                                <tr>
                                    <td>
<!--                                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <img src="https://i.postimg.cc/2yf357b4/d-Item-Art-Music-64-2x.jpg" alt="iTunes">
                                                </td>
                                                <td align="left" style="padding-left: 20px;">
                                                    <p
                                                        style="margin: 0; font-size: 12px; font-weight: 600; color: #333333;">
                                                        Apple Music
                                                        Subscription
                                                    </p>
                                                    <p style="margin: 0; font-size: 12px; color: #666666;"> 
                                                        3*120</p>
                                                    <p style="margin: 0; font-size: 12px; color: #666666;">Renews 14 Mar
                                                        2020</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="right">
                                                    <p style="margin: 10px; font-size: 12px; font-weight: 600;">£9.99
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                style="padding: 5px; border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                <tr>
                                    <td align="right">
                                        <p style="margin: 0; font-size: 12px; color: #666666;">
                                            Original Amount:
                                            <span style="font-weight: 700;">₹ {{number_format($actual_total,2)}}</span>
                                        </p>
                                    </td>
                                     <td align="right">
                                        <p style="margin: 0; font-size: 12px; color: #666666;">
                                            Discount Amount:
                                            <span style="font-weight: 700;">₹ {{number_format($actual_total-$sub_total,2)}}</span>
                                        </p>
                                    </td>
                                     <td align="right">
                                        <p style="margin: 0; font-size: 12px; color: #666666;">
                                            Subtotal:
                                            <span style="font-weight: 700;">₹ {{number_format($sub_total,2)}}</span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding: 10px 0;">
                                <tr>
                                    <td align="right">
                                        <p class="total-price" style="margin: 4px; font-size: 12px; color: #666666;">
                                            IGST (18%): 
                                            <span style="font-weight: 600; color:#000000"> 
                                            <?php 
                                            $IGST = ($sub_total/100)*18;  
                                            echo '₹'.$IGST;
                                            ?>
                                            </span>
                                        </p>
<!--                                        <p class="total-price" style="margin: 4px; font-size: 12px; color: #666666;">
                                            VAT charged at 20%
                                            <span style="font-weight: 600; color:#000000">£1.67</span>
                                        </p>
                                         <p class="total-price" style="margin: 4px; font-size: 12px; color: #666666;">
                                            VAT charged at 20%
                                            <span style="font-weight: 600; color:#000000">£1.67</span>
                                        </p>-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="right">
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="border-top: 1px solid #eeeeee; border-bottom: 1px solid #eeeeee;">
                                            <tr>
                                                <td width="70%" align="right" style="border-right: 1px solid #eeeeee;">
                                                    <p
                                                        style="padding-right: 35px; font-size: 10px; text-transform: uppercase; color: #666666;">
                                                        TOTAL</p>
                                                </td>
                                                <td width="10%">
                                                    <p class="total-price" style="padding-left: 80px; font-size: 16px; font-weight: 600;">
                                                         
                                                        <?php  echo '₹'.number_format(($sub_total+$IGST),2);  ?>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
<!--                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <p style="margin: 20px; font-size: 12px; color: #666666;">Get help with
                                            subscriptions and
                                            purchases. <a href="#" style="text-decoration: none; color: #007eff;">Visit
                                                Apple Support</a>.</p>
                                        <p style="font-size: 12px; color: #666666;">Learn how to <a href="#"
                                                style="text-decoration: none; color: #007eff;">manage your
                                                password
                                                preferences</a> for iTunes, Apple Books and App
                                            Store purchases.</p>
                                        <p style="font-size: 12px; color: #666666;">To cancel your purchase within 14
                                            days of receiving this invoice, <a href="#"
                                                style="text-decoration: none; color: #007eff;">report a
                                                problem</a> or <a href="#"
                                                style="text-decoration: none; color: #007eff;">contact us</a>.
                                            <a href="#" style="text-decoration: none; color: #007eff;"><br>Learn more
                                                about your right of withdrawal</a></p>
                                        <p style="margin: 20px; font-size: 12px; color: #666666;">You have the option to
                                            stop
                                            receiving email receipts for your subscription
                                            renewals. If you have opted out, you can still view your receipts in your
                                            account under Purchase History. To manage receipts or to opt in again, go to
                                            <a href="#" style="text-decoration: none; color: #007eff;">Account
                                                Settings</a>.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>-->
                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 5px;">
<!--                                <tr>
                                    <td align="center">
                                        <img src="https://i.postimg.cc/05pbBFFZ/logo-apple-small.png" alt="Apple logo">
                                    </td>
                                </tr>-->

<!--                                <tr>
                                    <td>
                                        <table align="center">
                                            <tr>
                                                <td>
                                                    <p style="font-size: 12px; color: #666666;"><a href="#"
                                                            style="text-decoration: none; color: #007eff;">Apple ID
                                                            Summary</a></p>
                                                </td>
                                                <td>
                                                    <p style="font-size: 12px; color: #666666;"><a href="#"
                                                            style="text-decoration: none; color: #007eff;">Terms of
                                                            Sale</a></p>
                                                </td>
                                                <td>
                                                    <p style="font-size: 12px; color: #666666;"><a href="#"
                                                            style="text-decoration: none; color: #007eff;">Privacy
                                                            Policy </a></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>-->
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
<!--                                                    <p style="margin-top: 0; font-size: 12px; color: #666666;">Hollyhill
                                                        Industrial
                                                        Estate, Hollyhill, Cork, Ireland. Ireland
                                                        VAT Reg No. IE9700053D </p>-->
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!-- END CONTAINER \\ -->
    </td>
    </tr>
    </table>
</body>

</html>
<!--<html>
<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
  <table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
    <thead>
      <tr>
        <th style="text-align:left;"><img style="max-width: 50px;;height: auto" src="{{asset('public/images/logo.png')}}" alt="Silver Storm Water Theme Park "></th>
        <th style="text-align:right;font-weight:400;">{{$booking->created_at}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b style="color:#1dd81d;font-weight:normal;margin:0">Success</b></p>
          <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Transaction ID</span> {{$booking->razorpay_payment_id}}</p>
          <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span> Rs. {{$booking->amount_paid}}</p>
        </td>
      </tr>
      <tr>
        <td style="height:35px;"></td>
      </tr>
      <tr>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> {{$booking->full_name}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$booking->email}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$booking->phone}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">ID No.</span> 2556-1259-9842</p>
        </td>
        <td style="width:50%;padding:20px;vertical-align:top">
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span> {{$booking->address}}</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Offer</span> 2</p>
          <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Coupon</span> 25/04/2017 to 28/04/2017 (3 Days)</p>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Items</td>
      </tr>
      <?php
      
      
      ?>
      <tr>
        <td colspan="2" style="padding:15px;">
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
            <span style="display:block;font-size:13px;font-weight:normal;">Homestay with fooding & lodging</span> Rs. 3500 <b style="font-size:12px;font-weight:300;"> /person/day</b>
          </p>
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Pickup & Drop</span> Rs. 2000 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Local site seeing with guide</span> Rs. 800 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Tea tourism with guide</span> Rs. 500 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">River side camping with guide</span> Rs. 1500 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
          <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">Trackking and hiking with guide</span> Rs. 1000 <b style="font-size:12px;font-weight:300;"> /person/day</b></p>
        </td>
      </tr>
    </tbody>
    <tfooter>
      <tr>
        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
          <strong style="display:block;margin:0 0 10px 0;">Regards</strong> Bachana Tours<br> Gorubathan, Pin/Zip - 735221, Darjeeling, West bengal, India<br><br>
          <b>Phone:</b> 03552-222011<br>
          <b>Email:</b> contact@bachanatours.in
        </td>
      </tr>
    </tfooter>
  </table>
</body>

</html>-->
<?php else: abort(404); endif; else: abort(404); endif; ?>