<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 ko tìm thấy</title>
</head>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');
	*{
		margin:0;
		padding: 0;
		box-sizing: border-box;
		font-family: 'Nunito', sans-serif;
	}
	body{
		background-image:linear-gradient(to right,#FC466B,#3F5EFB);
		height:100vh;/* height view */
	}
	.container{
		position: absolute;
		top:10%;
		right: 10%;
		bottom:10%;
		left:10%;
		display:flex;
		justify-content: center;
		align-items: center;
		color:#fff;
	}
	.container .content{
		text-align: center;
	}
	.content h2{
		font-size:200px;

	}
	.content h4{
		font-size:50px;
		margin-bottom: 50px;
	}
	.content a{
		margin-top:30px;
		padding:15px 30px;
		color:#FC466B;
		background: #fff;
		text-decoration: none;
		border-radius: 10px;
		font-size:20px;
		font-weight: bold;
	}
</style>
<body>
	<div class="container">
		<div class="content">
			<h2>404 !!!</h2>
			<h4>Oops - Trang không tìm thấy !</h4>
			<a href="{{URL::to('/dashboard')}}">Trở lại trang chủ</a>
		</div>
	</div>
</body>
</html>