@include('backend::layouts.header') 
<body class="navbar-top"> 
    <!-- Main navbar -->
    @include('backend::partials.topbar') 
    <!-- /main navbar --> 
    <!-- Page container -->
    <div class="page-container"> 
        <!-- Page content -->
        <div class="page-content"> 
            <!-- Main sidebar -->
            @include('backend::partials.sidebar')
            <!-- /main sidebar --> 
            <!-- Main content -->
            <div class="content-wrapper"> 
                <!-- Page header -->
                @include('backend::partials.breadcrumb')
                <!-- /page header --> 
                <!-- Content area -->
                <div class="content">  
                    @include('backend::partials.flash-message')    
                    @yield('content')
                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; <?php echo date('Y'); ?>. <a href="#"> SSAP</a> by <a href="https://inventivhub.com/" target="_blank">InventivHub</a>
                    </div>
                    <!-- /footer --> 
                </div>
                <!-- /content area --> 
            </div>
            <!-- /main content --> 
        </div>
            <!-- /page content --> 
    </div>
	<!-- /page container -->
    @include('backend::layouts.footer')
</body>
</html>

 
