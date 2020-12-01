<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Blog | @stack('title')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
	<!-- Stylesheets -->
	<link href="{{asset('frontend/common-css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/common-css/ionicons.css')}}" rel="stylesheet">

	<link href="{{asset('frontend/common-css/swiper.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/front-page-category/css/styles.css')}}" rel="stylesheet">

	<link href="{{asset('frontend/front-page-category/css/responsive.css')}}" rel="stylesheet">

@yield('style')
<script src="{{asset('frontend/common-js/jquery-3.1.1.min.js')}}"></script>
</head>
<body >

@include('frontend.partial.navbar')

	@yield('content')
	


	@include('frontend.partial.footer')


	<!-- SCIPTS -->


	<script src="{{asset('frontend/common-js/tether.min.js')}}"></script>
	<script src="{{asset('frontend/common-js/bootstrap.js')}}"></script>
	<script src="{{asset('frontend/common-js/swiper.js')}}"></script>
	<script src="{{asset('frontend/common-js/scripts.js')}}"></script>
	@yield('scripts')

</body>
</html>
