<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Booking">
    <meta name="author" content="inventivhub">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?php  if (isset($page_title)){ echo $page_title; }  ?></title> 
 
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('public/v1/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/v1/css/menu.css')}}" rel="stylesheet">
    <link href="{{asset('public/v1/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/v1/css/vendors.css')}}" rel="stylesheet">
    <link href="{{asset('public/v1/css/jquery-ui.css')}}" rel="stylesheet"> 
    <link href="{{asset('public/intlTelInput/intlTelInput.css')}}" rel="stylesheet"> 
    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('public/v1/css/custom.css')}}" rel="stylesheet">
    <!-- MODERNIZR MENU -->
    <script src="{{asset('public/v1/js/modernizr.js')}}"></script>
    <script src="{{asset('public/v1/js/jquery-3.2.1.min.js')}}"></script>
    
    <!-- custom stylesheets -->
    @yield('css') 
    <!-- /custom stylesheets -->

    <!-- custom style -->
    @stack('style')
    <!-- custom style -->

    <!-- custom js top -->
     @yield('jstop') 
    <!-- /custom js top -->
    <script type="application/javascript">
        var base_url = "{{url('/')}}";
    </script>
</head>

<body>