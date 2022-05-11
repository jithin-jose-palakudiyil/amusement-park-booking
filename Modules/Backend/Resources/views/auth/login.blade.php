<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
	<title><?php  if (isset($page_title)){ echo $page_title; } ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('public/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/core.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('public/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('public/global_assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/core/libraries/jquery.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('public/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>

	<script src="{{asset('public/assets/js/app.js')}}"></script>
           <script src="{{asset('public/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>
	<!--<script src="{{asset('public/pages/js/login.js')}}" type="text/javascript"></script>-->
	<!-- /theme JS files -->
 <style>  .AbsoluteCenter { margin: auto; position: absolute;  max-height: 480px; top: 0; left: 0; bottom: 0; right: 0; } </style>
</head>

<body class="login-container">
    <div class="AbsoluteCenter"> 
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content pb-20">

					<!-- Advanced login -->
					<form action="{{route('LoginAction')}}" method="post" autocomplete="off" id="login_admin">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
                                                            <input type="text" class="form-control" required="" name="email"  id="email" placeholder="Enter email">
								
                                                                @if($errors->has('email'))
                                                                    <div class="validation-error-label">{{ $errors->first('email') }}</div>
                                                                @endif
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
                                                            <input type="password"  required="" class="form-control" id="password" name="password" placeholder="Enter Password">
								
                                                                @if($errors->has('password'))
                                                                    <div class="validation-error-label">{{ $errors->first('password') }}</div>
                                                                @endif
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-inline">
											<input type="checkbox" class="styled" name="remember" checked="checked">
											Remember
										</label>
									</div>

									<div class="col-sm-6 text-right">
										<!--<a href="">Forgot password?</a>-->
									</div>
								</div>
							</div>
                                                        @if($errors->has('message'))
                                                            <div class="form-group">
                                                                <label class="validation-error-label">
                                                                    {{ $errors->first('message') }}
                                                                </label> 
                                                            </div>    
                                                       @endif
							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
							</div>

						 </div>
                                            {{ csrf_field() }}
					</form>
					<!-- /advanced login -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
    </div>

</body>
</html>
