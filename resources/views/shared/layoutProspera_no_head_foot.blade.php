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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{ config('app.name', 'Dr') }}">
	<meta name="keywords" content="{{config('app.name', 'Dr') }}">

	<link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i|Roboto+Mono" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('css/components.css') }}">
	<link rel="stylesheet" href="{{ asset('css/responsee.css') }}">
	<link rel="stylesheet" href="{{ asset('owl-carousel/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('owl-carousel/owl.theme.css') }}">
	<link rel="stylesheet" href="{{ asset('css/template-style.css') }}">


	<!-- Modernizr JS -->
	<script src="{{ url('/')}}/assets/js/jquery-1.8.3.min.js"></script>
	<script src="{{ url('/')}}/assets/js/jquery-ui.min.js"></script>
	<script src="{{ url('/')}}/assets/js/modernizr.js"></script>
	<script src="{{ url('/')}}/assets/js/responsee.js"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js" crossorigin="anonymous">

<!-- Load font awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	@yield('pageheader')
<style>
.top-bar {
    position: relative;
    height: 60px;
    background: #1d2434;
}

.top-bar .top-bar-left {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.top-bar .container-fluid, .top-bar .container-lg, .top-bar .container-md, .top-bar .container-sm, .top-bar .container-xl {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}


.top-bar .col-md-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}

.top-bar .text {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 60px;
    padding: 0 10px;
    text-align: center;
    border-left: 1px solid rgba(255, 255, 255, .15);
}

top-bar .top-bar-left {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.top-bar .text:last-child {
    border-right: 1px solid rgba(255, 255, 255, .15);
}

.top-bar .text {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 60px;
    padding: 0 10px;
    text-align: center;
    border-left: 1px solid rgba(255, 255, 255, .15);
}

.top-bar .text h2 {
    color: #eeeeee;
    font-weight: 600;
    font-size: 16px;
    letter-spacing: 1px;
    margin: 0;
}

.top-bar .text p {
    color: #eeeeee;
    font-size: 12px;
    font-weight: 400;
    margin: 0;
}

.top-bar .top-bar-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.top-bar .social {
    display: flex;
    height: 60px;
    font-size: 0;
    justify-content: flex-end;
}
top-bar .social a:first-child {
    border-left: 1px solid rgba(255, 255, 255, .15);
}

.top-bar .social a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 100%;
    font-size: 22px;
    color: #ffffff;
    border-right: 1px solid rgba(255, 255, 255, .15);
}
.fab {
    font-family: "Font Awesome 5 Brands";
}
.fa, .fab, .fad, .fal, .far, .fas {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
}
.fa-twitter:before {
    content: "\f099";
}
.fa-facebook-f:before {
    content: "\f39e";
}
.fa-linkedin-in:before {
    content: "\f0e1";
}
.fa-instagram:before {
    content: "\f16d";
}
.navbar {
    position: absolute;
    width: 100%;
    top: 60
px
;
    padding: 20
px
 60
px
;
    background: rgba(0, 0, 0, .1) !important;
    z-index: 9;
}

.navbar {
    position: relative;
    transition: .5s;
    z-index: 999;
}

.navbar-expand-lg>.container, .navbar-expand-lg>.container-fluid, .navbar-expand-lg>.container-lg, .navbar-expand-lg>.container-md, .navbar-expand-lg>.container-sm, .navbar-expand-lg>.container-xl {
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
}

.navbar .container, .navbar .container-fluid, .navbar .container-lg, .navbar .container-md, .navbar .container-sm, .navbar .container-xl {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.navbar {
    position: absolute;
    width: 100%;
    top: 60px;
    padding: 20px 60px;
    /* background: rgba(0, 0, 0, .1) !important; */
    z-index: 9;
}
.navbar .navbar-brand {
    margin: 0;
    color: #ffffff;
    font-size: 45px;
    line-height: 0px;
    font-weight: 600;
}

.navbar-dark .navbar-brand {
    color: #fff;
}
.navbar-brand {
    display: inline-block;
    padding-top: 0.3125rem;
    padding-bottom: 0.3125rem;
    margin-right: 1rem;
    font-size: 1.25rem;
    line-height: inherit;
    white-space: nowrap;
}

.navbar .navbar-brand span {
    font-weight: 800;
}
.navbar .navbar-brand {
    margin: 0;
    color: #ffffff;
    font-size: 45px;
    line-height: 0px;
    font-weight: 600;
}
.navbar-dark .navbar-toggler {
    color: rgba(255,255,255,.5);
    border-color: rgba(255,255,255,.1);
}
.navbar-toggler {
    padding: 0.25rem 0.75rem;
    font-size: 1.25rem;
    line-height: 1;
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 0.25rem;
}

.navbar-expand-lg .navbar-collapse {
    display: -ms-flexbox!important;
    display: flex!important;
    -ms-flex-preferred-size: auto;
    flex-basis: auto;
}

.navbar-collapse {
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
    -ms-flex-positive: 1;
    flex-grow: 1;
    -ms-flex-align: center;
    align-items: center;
}
.navbar-expand-lg .navbar-nav {
    -ms-flex-direction: row;
    flex-direction: row;
}

.ml-auto, .mx-auto {
    margin-left: auto!important;
}
.navbar-nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}


.navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link.active {
    background: rgba(256, 256, 256, .1);
    transition: none;
}

.navbar-dark .navbar-nav .nav-link, .navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link.active {
    padding: 10px 10px 8px 10px;
    color: #ffffff;
}
.navbar-dark .navbar-nav .active>.nav-link, .navbar-dark .navbar-nav .nav-link.active, .navbar-dark .navbar-nav .nav-link.show, .navbar-dark .navbar-nav .show>.nav-link {
    color: #fff;
}
.navbar-dark .navbar-nav .nav-link {
    color: rgba(255,255,255,.5);
}


.navbar-expand-lg .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
}


.navbar a.nav-link {
    padding: 8px 15px;
    font-size: 14px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
.navbar-nav .nav-link {
    padding-right: 0;
    padding-left: 0;
}
.nav-link {
    display: block;
    padding: 0.5rem 1rem;
}

.dropdown, .dropleft, .dropright, .dropup {
    position: relative;
}

.dropdown-toggle {
    white-space: nowrap;
}
.navbar-nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
}

.navbar-expand-lg .navbar-nav .dropdown-menu {
    position: absolute;
}

.navbar .dropdown-menu {
    margin-top: 0;
    border: 0;
    border-radius: 0;
    background: #f8f9fa;
}
.navbar-nav .dropdown-menu {
    position: static;
    float: none;
}
.dropdown-menu.show {
    display: block;
}
.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 10rem;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 0.25rem;
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.dropdown-menu.show {
    display: block;
}

/* ======================= */
.fixed {
	position: fixed;
	top: 0;
	height: 70px;
	z-index: 1;
}
</style>
</head>

<body class="size-1140">

    @if(isset($all_settings['top_bar']->value) && $all_settings['top_bar']->value == 1)
<!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block">
            <div class="container-fluid">
                <div class="row" style="display: flex; flex-wrap: wrap;  margin-right: -15px;  margin-left: -15px;">
                    <div class="col-md-6">
                        <div class="top-bar-left">
                            <div class="text">
                                 @if($all_settings['openeing_hours']->value)
                                <h2>{{$all_settings['openeing_hours']->value??''}}</h2>
                                <p>{{$all_settings['openeing_hours_text']->value??''}}</p>
                                @endif
                            </div>
                            <div class="text">
                                 @if($all_settings['appointment_number']->value)
                                <h2>{{$all_settings['appointment_number']->value??''}}</h2>
                                <p>Call Us For Appointment</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-bar-right">
                            <div class="social">
                                @if($all_settings['twitter_link']->value)
                                <a href="{{$all_settings['twitter_link']->value??''}}"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($all_settings['fb_link']->value)
                                <a href="{{$all_settings['fb_link']->value??''}}"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($all_settings['linkedin_link']->value)
                                <a href="{{$all_settings['linkedin_link']->value??''}}"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if($all_settings['insta_link']->value)
                                <a href="{{$all_settings['insta_link']->value??''}}"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
@endif
        <!-- Nav Bar Start -->
        <!--
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="index.html" class="navbar-brand">Barber <span>X</span></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="price.html" class="nav-item nav-link">Price</a>
                        <a href="team.html" class="nav-item nav-link">Barber</a>
                        <a href="portfolio.html" class="nav-item nav-link">Gallery</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu">
                                <a href="blog.html" class="dropdown-item">Blog Page</a>
                                <a href="single.html" class="dropdown-item">Single Page</a>
                            </div>
                        </div>
                        
                        ====================================================== 
                      
                       
                       ====================================================== 
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        -->
        <!-- Nav Bar End -->
	<!-- HEADER -->
	@if(empty($hideMenu))
		<header role="banner">		</header>
	@endif
	<!-- MAIN -->
	<main role="main">
		@yield('pagebody')
	</main>


	<!-- FOOTER -->
	<footer>	</footer>


	<!-- jQuery -->
	<script src="{{ asset('owl-carousel/owl.carousel.js')}} "></script>
	<script src="{{ url('/')}}/assets/js/template-scripts.js"></script>
	<!-- jQuery Easing -->

	<script src="{{ url('/')}}/assets/js/template-scripts.js"></script>
	<!-- Bootstrap -->
		<script src="{{ url('/')}}/assets/js/main.js"></script>
	<script src="{{ url('/')}}/assets/js/bootstrap-datepicker.min.js"></script>
	@yield('footescripts')
        
        
        <script>
        $(document).ready(function(){
            $(window).bind('scroll', function() {
            var navHeight = $( window ).height() - 170;
            
            var navHeight = 80;
            
            console.log("scrollTop : " + $(window).scrollTop() + " |||| navHeight : "+ navHeight);
                if ($(window).scrollTop() > navHeight) {
                    $('nav').addClass('fixed');
                } else {
                    $('nav').removeClass('fixed');
                }
             });
        });


        </script>
</body>

</html>
