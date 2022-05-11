<?php  
    if(Session::has('Booking_Offer_Success') && Session::has('Booking_Offer_Success.offers') && Session::has('Booking_Offer_Success.pivot_offers') && Session::has('Booking_Offer_Success.qty') ): 
        $Offer = Session::get('Booking_Offer_Success.offers');  
        $pivot_offers = Session::get('Booking_Offer_Success.pivot_offers');
        $qty = Session::get('Booking_Offer_Success.qty');
        if(count($pivot_offers) == count($qty)): 
            $promo_code = null; $discount = 0;
            if (Session::has('Booking_Offer_Success.promo_code')):
                $promo_code = Session::get('Booking_Offer_Success.promo_code');
            endif;
            if($promo_code): 
                $discount = $promo_code->offer;  
            else:
                $discount = $Offer->offer; 
            endif;     
            $collect = collect(Session::get('Booking_Offer_Success'));
            $encryptString = encrypt($collect); 
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking  - Summary</title> 
    <link href="{{asset('public/v1/css/uxcore.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
    @media screen and (min-width: 992px) {
      body.ux-app {
        background: #fff;
        padding: 40px 0;
      }
    }

    .basket, .container {
      padding: 0;
    }
    @media screen and (min-width: 992px) {
      .basket, .container {
        padding: 0 10px;
      }
    }

    .action-link, .ux-card a, .payment > a, .terms > a {
      color: #008A32;
      font-weight: bold;
      text-decoration: none;
    }
    .action-link:hover, .ux-card a:hover, .payment > a:hover, .terms > a:hover {
      color: #008A32;
    }

    .ux-card {
      border: 1px solid #E8E8E8;
      background: #FCFCFC;
      padding: 20px;
      position: relative;
    }
    .ux-card:hover {
      cursor: pointer;
      border-color: #008a32;
      background-color: #fff;
    }

    .ux-card.deleted {
      visibility: hidden;
      overflow: hidden;
      transition: all 0.2s;
      height: 0px;
      padding: 0px;
      margin: 0px;
      box-shadow: none;
      border: none;
    }

    a {
      color: #333;
    }
    a:hover {
      color: #000;
    }

    .product {
      color: #767676;
      margin-bottom: 20px;
      box-shadow: 0 4px 0 0 rgba(0, 0, 0, 0.1);
    }
    @media screen and (min-width: 992px) {
      .product {
        padding-left: 75px;
        box-shadow: 4px 4px 0 0 rgba(0, 0, 0, 0.1);
      }
    }
    .product img {
      display: none;
      position: absolute;
      top: 20px;
      left: 20px;
    }
    @media screen and (min-width: 992px) {
      .product img {
        display: block;
      }
    }
    .product .price {
      color: #333;
      font-weight: bold;
    }
    .product .tier {
      padding-bottom: 1em;
    }
    .product .renews {
      padding-top: 1em;
    }
    .product .title, .product .tier, .product .attr, .product .renews {
      float: left;
      clear: left;
    }
    .product .price, .product .term {
      float: right;
      clear: right;
    }
    .product .remove {
      float: right;
      clear: right;
      display: none;
      color: #008a32 !important;
      border-width: 1px;
      box-shadow: none !important;
      font-size: 12px;
      padding-bottom: 5px !important;
    }
    .product .remove .uxicon {
      margin-top: 3px;
      box-shadow: none !important;
    }
    .product .remove:hover {
      border-color: #008a32 !important;
    }
    @media screen and (min-width: 992px) {
      .product .remove {
        display: block;
      }
    }

    .product span {
      display: block;
    }

    .summary dl {
      margin: 0;
      padding: 20px;
    }
    .summary dl dt {
      float: left;
      clear: left;
      font-weight: normal;
    }
    .summary dl dd {
      float: right;
      clear: right;
      font-weight: bold;
    }
    .summary dl:after {
      content: ".";
      clear: both;
      display: block;
      height: 0;
      visibility: hidden;
    }
    @media screen and (min-width: 992px) {
      .summary .subtotal {
        border-top: 5px solid #D0D0D0;
      }
      .summary .subtotal dt {
        margin-top: 2px;
      }
      .summary .subtotal dd {
        font-size: 18px;
      }
    }
    .summary .total {
      background: #128937;
      color: #fff;
      padding: 20px;
    }
    .summary .total dt {
      text-transform: uppercase;
      margin-top: 0.5em;
      font-weight: bold;
    }
    .summary .total dd {
      font-size: 1.5em;
    }
    .summary .support dd {
      float: left;
      font-weight: normal;
      padding-left: 0.5em;
    }
    .summary button {
      margin: 0 20px;
      width: calc(100% - 40px);
    }

    .payment, .terms {
      margin-bottom: 20px;
    }
    .payment > a, .terms > a {
      float: right;
      padding-right: 20px;
      text-transform: uppercase;
    }
    .payment h4, .payment p, .terms h4, .terms p {
      padding: 0 20px;
    }
    .payment button, .terms button {
      margin-top: 20px;
    }

    .terms .agreed {
      display: none;
    }

    p.agreed {
      padding-left: 50px;
      position: relative;
    }
    p.agreed:before {
      content: " ";
      background-image: url(https://img1.wsimg.com/fos/react/check.svg);
      position: absolute;
      left: 20px;
      top: 4px;
      width: 20px;
      height: 21px;
    }

    .cart button[disabled] {
      background: #e8e8e8 !important;
      border-bottom: none !important;
      color: #848484 !important;
      opacity: 1;
    }

    .price {
      position: relative;
      display: inline-block;
    }
    .price .old {
      position: absolute;
      right: 0;
      opacity: 1;
    }
    .price .new {
      opacity: 0;
    }
    .price .strike {
      display: inline-block;
      position: absolute;
      left: 0;
      top: 50%;
      width: 0;
      border-top: 1px solid #333;
    }

    #controls {
      position: absolute;
      top: 0px;
      left: 0px;
      background: rgba(0, 0, 0, 0.5);
      padding: 20px;
    }
    </style>
</head>
<body translate="no" class="ux-app">
    <div class="container">
        <div class="cart">
            <div class="basket col-md-7 col-md-offset-1">
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
                        $sub_total = 0; $actual_total = 0;
                        foreach ($pivot_offers as $key => $value) :
                            $actual_price = $value->actual_price;
                            
                            if(isset($qty[$key])):
                                $discount_amount = ($actual_price/100)*$discount; 
                                $offer_price = ceil(number_format($value->actual_price-$discount_amount,2) ); 
                                $actual_total+= ceil($qty[$key]*$value->actual_price);
                                $total = $qty[$key]*$offer_price;
                                $sub_total+=$total;
                        ?>  
                        <tr>
                            <td class="col-md-4"><em>{{$value->name}}</em></td>
                            <td class="col-md-2" style="text-align: center">{{$qty[$key]}}</td>
                            <td class="col-md-2 text-center">₹ {{$value->actual_price}}</td>
                            <td class="col-md-2 text-center">₹ {{$offer_price}}</td>
                            <td class="col-md-3 text-center">₹ {{$total}}</td>
                        </tr>
                        <?php 
                            endif;
                        endforeach;
                        ?>
                        <?php if($discount >0): ?>
                            
                         
                        <tr id="codeapplied">
                            <td class="text-center" colspan="6" style="color:#228B22;">
                                <strong id="promocodedetails">{{$discount}}% discount applied for order</strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <form method="post" enctype="multipart/form-data" action="" > 
                    {{ csrf_field() }}
                    <table style="width: 100%">
                        <tr>
                            <td class="text-center" colspan="2"> 
                                <strong>Have A Promo Code?</strong>
                            </td>
                            <td colspan="2"> 
                                <input type="text" name="promo" placholder="Enter Code" required="" id="PromoCode" /> 
                                <div id="PromoCodeError" style="color: red"></div>      
                            </td>
                            <td>
                                <button type="submit" id="PromoCodeBtn">Apply</button> 
                            </td> 
                        </tr>
                    </table>
                </form>
                
                @if(Session::has('flash-coupon-success'))
                
                <br/>
                    <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
                        <span class="font-weight-semibold">Well done!</span> {!! Session::get('flash-coupon-success')!!}
                    </div> 
                <br/>
                {{ Session::forget('flash-coupon-success')}}
                @elseif(Session::has('flash-coupon-fail'))
                
                <br/>
                <div class="alert bg-danger text-white alert-styled-left alert-dismissible"> 
                    <span class="font-weight-semibold">Oh snap!</span> {!! Session::get('flash-coupon-fail') !!}.
                </div>
                <br/>
                {{ Session::forget('flash-coupon-fail')}}
                @endif
                <br/>
               <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                        
                      <tr>
                        <td>Booking date :</td>
                        <td> <b>{{Session::get('Booking_Offer_Success.bookingdate')}}</b></td>
                      </tr>
                      <tr>
                        <td>Full Name:</td>
                        <td><b> {{Session::get('Booking_Offer_Success.name')}}</b></td>
                      </tr>
                      <tr>
                        <td>Address</td>
                         <td><b> {{Session::get('Booking_Offer_Success.address')}}</b></td>
                      </tr>
                     <tr>
                        <td>Email</td>
                        <td><b>{{Session::get('Booking_Offer_Success.email')}}</b></td>
                      </tr>
                      <tr>
                        <td>Phone Number</td>
                        <td><b>{{Session::get('Booking_Offer_Success.phone')}}</b></td>
                      </tr> 
                
                     
                    </tbody>
                  </table>
                  
                 
                </div>
            </div>
            <?php
            $IGST = ($sub_total/100)*18;
            $grand_total = $sub_total+$IGST; 
            $api = new Razorpay\Api\Api(\Config::get('constants.razorpay.api_key'), Config::get('constants.razorpay.api_secret'));
            $order  = $api->order->create(array( 'amount' => $grand_total*100, 'currency' => 'INR', 'payment_capture'=>1, )); 
            $orderId = $order['id'];  
            ?>
            <div class="summary col-md-3">
                <dl> 
                    <dt style="color: #cccccc">Original Amount: </dt>
                    <dd  style="color: #cccccc">₹ {{number_format($actual_total,2)}}</dd>
                    <dt style="color: #cccccc">Discount Amount: </dt>
                    <dd  style="color: #cccccc">₹ {{number_format($actual_total-$sub_total,2)}}</dd>
                    <dt><a href="/taxes">Subtotal</a></dt>
                    <dd>${{ number_format($sub_total,2)}}</dd>
                    <dt>IGST (18%): </dt>
                    <dd>₹ {{number_format($IGST,2)}}</dd>
                </dl>
                <dl class="total">
                    <dt>Total</dt>
                    <dd>₹ {{number_format($grand_total,2)}}</dd>
                </dl> 
                <div class="terms" >
                    <h4 class="headline-primary">Terms &amp; Conditions</h4>
                    <p class="review">
                        By proceeding to the payment, you agree the 
                        <a href="terms/show">Terms &amp; Conditions</a>.
                    </p>
                </div>
                <div class="complete">
                    <form action="{{route('payment_store')}}" method="post" enctype="multipart/form-data" >
                    {{ csrf_field() }} 
                    <script
                    src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{\Config::get('constants.razorpay.api_key')}}"  
                    data-amount="<?php echo $total * 100; ?>" 
                    data-currency="INR"  
                    data-buttontext="Pay Now"
                    data-name=""
                    data-image=""
                    data-prefill.name="<?php  if (Session::has('Booking_Offer_Success.name')){ echo Session::get('Booking_Offer_Success.name'); }  ?>"
                    data-prefill.email="<?php  if (Session::has('Booking_Offer_Success.email')){ echo Session::get('Booking_Offer_Success.email'); }  ?>"
                    data-prefill.contact="<?php  if (Session::has('Booking_Offer_Success.phone')){ echo Session::get('Booking_Offer_Success.phone'); }  ?>"
                    data-theme.color="#F37254"
                    data-order_id="<?php echo $orderId?>"
                    >
                    </script>
                    <input type="hidden" name="booking_offer" value="{{$encryptString}}"> 
                    </form> 
                </div>
            </div>
        </div>
    </div> 
</body>
</html>
<?php else: abort(404); endif; else: abort(404); endif; ?>
