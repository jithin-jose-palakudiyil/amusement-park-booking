    @include('frontend::layouts.header')   
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div>
    <!-- /Preload -->

    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div>
    <!-- /loader_form -->

    @include('frontend::partials.nav')    

    <!-- /menu -->
    <div class="container-fluid">
        <div class="row row-height">
            @include('frontend::partials.left')
            <!-- /content-left -->
            @include('frontend::partials.right')
            <!-- /content-right-->
        </div>
        <!-- /row-->
    </div>
    <!-- /container-fluid -->

    <div class="cd-overlay-nav">
            <span></span>
    </div>
    <!-- /cd-overlay-nav -->

    <div class="cd-overlay-content">
            <span></span>
    </div>
    <!-- /cd-overlay-content -->

    <a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
    <!-- /menu button -->

    <!-- Modal terms -->
    @include('frontend::partials.modal')
    <!-- /.modal -->

    <!-- COMMON SCRIPTS -->
    <script src="{{asset('public/v1/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('public/v1/js/common_scripts.min.js')}}"></script>
    <script src="{{asset('public/v1/js/velocity.min.js')}}"></script>
    <script src="{{asset('public/v1/js/common_functions.js')}}"></script>
    <script src="{{asset('public/v1/js/file-validator.js')}}"></script> 
    <!-- Wizard script-->
    
    <script src="{{asset('public/v1/js/jquery-ui.js')}}"></script>
    <script src="{{asset('public/v1/js/func_2.js')}}"></script>
    <script src="{{asset('public/intlTelInput/intlTelInput.min.js')}}"></script> 
    <script src="{{asset('public/v1/script/booking.js')}}"></script>

</body>
</html>