<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Error</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/v2/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/v2/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/v2/css/iosoon-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/v2/css/iosoon-theme5.css')}}">
</head>
<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder">
                <div class="info-holder">
                    <img src="{{asset('public/v2/images/graphic4.svg')}}" alt="">
                </div>
            </div>
            <div class="form-holder custom-bg">
                <div class="form-content">
                    <div class="form-items">
                        <div class="form-row logo-social">
<!--                            <div class="col-6">
                                <div class="website-logo-inside">
                                    <a href="index.html">
                                        <div class="logo">
                                            <img class="logo-size" src="images/logo-light.svg" alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="other-links no-bg-icon">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>-->
                        </div>
                        <h3>Sorry, something went wrong!</h3>
                        <p style="color: #000">
                            <?php   $error = Session::get('Booking_Offer_Error');
                                    foreach ($error as $value) :
                                        echo $value.'<br/>';
                                    endforeach;
                            ?>
                        </p>
                        <div class="form-row">
 
                           
                                <div class="col-md-6"> 
                                    <a href="{{route('booking_index')}}"> 
                                <button type="submit" class="btn btn-primary">Back To Booking</button>
                                    </a>
                            </div>
                            
                        </div>
                        <div style="padding: 50px">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{asset('public/v2/js/jquery.min.js')}}"></script>
<script src="{{asset('public/v2/js/popper.min.js')}}"></script>
<script src="{{asset('public/v2/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/v2/js/main.js')}}"></script>
</body>
</html>