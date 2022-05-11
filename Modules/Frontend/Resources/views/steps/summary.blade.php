<html lang="en"><head>
<meta charset="UTF-8">
<link rel="apple-touch-icon" type="image/png" href="https://static.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
<meta name="apple-mobile-web-app-title" content="CodePen">
<link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
<link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
<title>CodePen - Responsive Shopping Cart - Brand v01</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="https://img1.wsimg.com/ux/1.3.9-brand/css/uxcore.min.css">
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
<!--<script>
 window.console = window.console || function(t) {};
</script>-->
<!--<script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>-->
</head>
<body translate="no" class="ux-app">

<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0">


<div class="container">
<div class="cart">
<div class="basket col-md-6 col-md-offset-1">
<div class="product ux-card">
<img src="https://img1.wsimg.com/fos/react/sprite.svg#domains" height="32" width="32">
<span class="title"><a href="/product/{id}">catstewardesses</a></span>
<span class="price">
$12.99
</span>
<span class="tier">.com</span>
<span class="term">1 year</span>
<span class="attr">Privacy: ON</span>
<span class="renews">Renews at $14.99/yr</span>
<button class="btn btn-canvas btn-xs remove" href="product/remove"><span class="uxicon uxicon-trash"></span>Remove</button>
</div>
<div class="product ux-card">
<img src="https://img1.wsimg.com/fos/react/sprite.svg#website-builder" height="32" width="32">
<span class="title"><a href="/product/{id}">Website Builder</a></span>
<span class="price">$12.00</span>
<span class="tier">Personal</span>
<span class="term">12 months</span>
<span class="renews">Renews at $5.99/mo</span>
<button class="btn btn-canvas btn-xs remove" href="product/remove"><span class="uxicon uxicon-trash"></span>Remove</button>
</div>
<div class="product ux-card">
<img src="https://img1.wsimg.com/fos/react/sprite.svg#get-found" height="32" width="32">
<span class="title"><a href="/product/{id}">Get Found</a></span>
<span class="price"><strike></strike>$143.88</span>
<span class="tier">Essential</span>
<span class="term">12 months</span>
<span class="renews">Renews at $11.99/mo</span>
<button class="btn btn-canvas btn-xs remove" href="product/remove"><span class="uxicon uxicon-trash"></span>Remove</button>
</div>
</div>
<div class="summary col-md-4">
<dl class="subtotal">
<dt>Subtotal</dt>
<dd>$14.99</dd>
<dt><a href="/taxes">Estimated Taxes &amp; Fees</a></dt>
<dd>$3.42</dd>
</dl>
<dl class="total">
<dt>Total</dt>
<dd>$18.41</dd>
</dl>
<dl class="support">
<dt><a href="/savings/">Total savings</a></dt>
<dd>$150.00</dd>
<dt><a href="/promocode/add">Have a promocode?</a></dt>
</dl>
<div class="payment">
<a href="payment/add">Add</a>
<h4 class="headline-primary">Payment</h4>
<div class="ux-card">
<a href="/payment/{id}"><img src="https://img1.wsimg.com/fos/react/sprite.svg#visa" height="32" width="50"> John Doe</a>
</div>
</div>
<div class="terms">
<h4 class="headline-primary">Terms &amp; Conditions</h4>
<p class="review">Clicking on "I Agree" means you agree to GoDaddy's <a href="terms/show">Terms &amp; Conditions</a>.</p>
<p class="review"><strong>Products automatically</strong> renew until cancelled, and are billed to your payment method on file. Turn off auto-renew in your GoDaddy account.</p>
<p class="agreed">I've read and agreed to the <a href="terms/show">Term &amp; Conditions</a>.</p>
<button type="button" class="btn btn-purchase review">I Agree</button>
</div>
<div class="complete">
<button type="button" disabled="disabled" class="btn btn-purchase">Complete Purchase</button>
</div>
</div>
</div>
</div>
 

<!--<script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
<script id="rendered-js">
$('.terms button').on('click', function () {
  $(".review").hide();
  $(".agreed").show();
  $(".complete button").removeAttr("disabled");
});

$('.agreed').on('click', function () {
  $(".review").show();
  $(".agreed").hide();
  $(".complete button").attr("disabled", "disabled");
});

$('button.remove').on('click', function () {
  $(this).parent().velocity({
    translateX: "-800px",
    opacity: 0 },
  {
    duration: 500,
    complete: function (elem) {
      $(elem).addClass("deleted");
    },
    easing: [0.65, -0.02, 0.72, 0.29] });

});

$('#changePrices').on('click', function () {
  var $strike = $('<span class="strike"></span>');
  var $price = $('.price').first();
  var oldPrice = $price.text();
  var $oldPrice = $('<span class="old"></span>');
  var newPrice = '$0.99';
  var $newPrice = $('<span class="new">' + newPrice + '</span>');
  // add span.strike
  $price.prepend($strike);
  // wrap the span.old around the current price
  $price.wrapInner($oldPrice);
  // For some reason wrapInner doesn't maintain the DOM relationship, so re-assign it back
  $oldPrice = $price.find(".old");
  $price.append($newPrice);

  // draw a slash through the price, and remove the slash
  $strike.velocity({
    width: "105%" },
  {
    duration: 500,
    easing: [1, 0, 1, 1] });


  // float the old price up
  $oldPrice.velocity({
    translateY: "-1.2em",
    opacity: 0 },
  {
    delay: 500,
    duration: 800,
    complete: function (elem) {
      $(elem).remove();
    },
    easing: [0, 1, 1, 1] });


  // Fade in the new price, then unwrap it to finish the animation
  $newPrice.velocity({
    opacity: 1 },
  {
    delay: 500,
    duration: 250,
    easing: "linear",
    complete: function (elem) {
      $(elem).contents().unwrap();
    } });

});

$('#undelete').on('click', function () {
  $('.product.ux-card').each(function (index, el) {
    if ($(el).hasClass('deleted')) {
      $(el).velocity('reverse').removeClass('deleted');
    } else {
      // Do nothing
    }
  });;
});
//# sourceURL=pen.js
    </script>-->
<!--<script src="https://static.codepen.io/assets/editor/iframe/iframeRefreshCSS-e03f509ba0a671350b4b363ff105b2eb009850f34a2b4deaadaa63ed5d970b37.js"></script>-->


</body></html>