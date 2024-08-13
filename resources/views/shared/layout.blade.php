<!DOCTYPE HTML>
<!--
	Justice by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name', 'Dr') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i|Roboto+Mono" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	{{--
	<link rel="stylesheet" href="css/icomoon.css"> --}}
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

	<!-- Magnific Popup -->
	{{--
	<link rel="stylesheet" href="css/magnific-popup.css"> --}}

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

	<!-- Modernizr JS -->
	<script src=" {{ asset('js/modernizr-2.6.2.min.js') }}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div class="gtco-loader"></div>
	@include('shared.menu')

	<div id="page">
		<div id="gtco-main">
			<div class="container">
				<p>&nbsp;</p>
				@yield('pagebody')
			</div>
		</div>
	</div>

	@include('shared.footer')

	<div class="gototop js-top">
		<a href="#" class="js-gotop">
			<i class="fa fa-angle-up">&nbsp;</i>
		</a>
	</div>

	<!-- jQuery -->
	<script src="{{ asset('js/jquery.min.js')}} "></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('js/jquery.easing.1.3.js') }} "></script>
	<!-- Bootstrap -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	{{--
	<!-- Waypoints -->
	<script src="{{asset('js/jquery.waypoints.min.js')}} "></script>
	<!-- Stellar -->
	<script src="{{ asset('js/jquery.stellar.min.js')}}"></script> --}}
	<!-- Main -->
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	@yield('footescripts')
</body>

</html>
