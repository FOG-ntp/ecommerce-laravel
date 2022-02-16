<!DOCTYPE html>
<head>
<title>Đăng ký Auth</title>
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
<div class="w3layouts-main">
	<h2>Đăng ký auth</h2>
	<?php
	$message = Session::get('message');
	if($message){
		echo '<span class="text-alert">'.$message.'</span>';
		Session::put('message',null);
	}
	?>
		<form action="{{URL::to('/register')}}" method="post">
			{{ csrf_field() }}
			@foreach($errors->all() as $val)
			<ul>
				<li>{{$val}}</li>
			</ul>
			@endforeach
			<input type="text"  class="ggg" name="admin_name" value="{{old('admin_name')}}" placeholder="Điền Name" >
			<input type="text"  class="ggg" name="admin_email" placeholder="Điền Email" >
			<input type="text"  class="ggg" name="admin_phone" value="{{old('admin_phone')}}" placeholder="Điền Phone" >
			<input type="password" class="ggg" name="admin_password" placeholder="Điền password" >

			{{-- <span><input type="checkbox" />Nhớ đăng nhập</span>
			<h6><a href="#">Quên mật khẩu</a></h6> --}}
				<div class="clearfix"></div>
				<input type="submit" value="Đăng ký" name="login">

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

		<a href="{{url('/register-auth')}}">Đăng ký Auth - </a> 
		<a href="{{url('/login-auth')}}">Đăng nhập Auth</a>
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
