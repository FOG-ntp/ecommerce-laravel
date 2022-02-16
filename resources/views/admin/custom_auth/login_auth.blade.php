<!DOCTYPE html>
<head>
<title>Đăng nhập Auth</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>

</head>
<body>
	
<div class="log-w3">
	div
<div class="w3layouts-main" style="background: #fff; box-shadow: rgba(20, 30, 97, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;">
	<h2 style="color: #141E61">Đăng nhập</h2>
	<?php
	$message = Session::get('message');
	if($message){
		echo '<span class="text-alert">'.$message.'</span>';
		Session::put('message',null);
	}
	?>
		<form action="{{URL::to('/login')}}" method="post">
			{{ csrf_field() }}
			@foreach($errors->all() as $val)
			<ul>
				<li>{{$val}}</li>
			</ul>
			@endforeach
			<h6 style="color: #141E61">Email đăng nhập</h6>
			<input type="text"  class="ggg" name="admin_email" placeholder="" style="color: #141E61; font-style:italic ; font-weight: bold">
			<h6 style="color: #141E61">Mật khẩu</h6>
			<input type="password" class="ggg" name="admin_password" placeholder="" style="color: #141E61; font-style:italic">

			{{-- <span><input type="checkbox" />Nhớ đăng nhập</span>
			<h6><a href="#">Quên mật khẩu</a></h6> --}}
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login" style="background: #141E61;color: #fff; box-shadow: rgba(2, 36, 255, 0.25) 0px 54px 55px, rgba(42, 54, 128, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">

			{{-- <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
			<br/>
			@if($errors->has('g-recaptcha-response'))
			<span class="invalid-feedback" style="display:block">
				<strong>{{$errors->first('g-recaptcha-response')}}</strong>
			</span>
			@endif --}}

		</form>
		{{-- <a href="{{url('/login-facebook')}}">Login Facebook</a> |
		<a href="{{url('/login-google')}}">Login Google</a> | --}}

		<a href="{{url('/register-auth')}}" style="color: #141E61">Đăng ký Auth - </a> 
		<a href="{{url('/login-auth')}}" style="color: #141E61">Đăng nhập Auth</a>
		{{-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> --}}
</div>
</div>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
