<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $title or config('app.name', 'Dr') }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="CareMed demo project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="{{ asset('caremed/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('caremed/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ asset('caremed/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('caremed/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('caremed/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('caremed/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('caremed/styles/responsive.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('css/responsee.css') }}">
<script src=" {{ asset('js/responsee.js') }}"></script> --}}
@yield('pageheader')
</head>
<body>

<div class="super_container">

	@if(empty($hideMenu))	
	<!-- Header -->

	<header class="header trans_200">
		
		<!--site menu Top Bar -->
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
							<div class="top_bar_item"><a href="#">FAQ</a></div>
							<div class="top_bar_item"><a href="#">Request an Appointment</a></div>
							<div class="emergencies  d-flex flex-row align-items-center justify-content-start ml-auto">For Emergencies: +563 47558 623</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!--Site Menu Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<nav class="main_nav ml-auto">
								<div class="top-nav">
									<ul class="right chevron">
											<li>
												<a href="/">Home1</a>
											</li>
											<?php $subCnt = 0; $sub_SubCnt = 0; $subHref = ""; $sub_SubHref = ""; ?> 
											@foreach($menulst as $mLst) 
											@if(is_null($mLst->parentId))
											<li>
												@php
													$subHref = '/pages/'.$mLst->name;
													if(($menulst->where('parentId', $mLst->id)->count()) > 0){
														$subHref = "#";
													}
												@endphp
												<a href="{{ $subHref }}">{{$mLst->name}}</a>
												@foreach($menulst as $subMlst) 
													@if(intval($subMlst->parentId) == intval($mLst->id))
														<?php 
															$subCnt++; 
															$subHref = "#";
															if($subCnt == 1){
																echo "<ul>";
															}
														?>
													<li>
														@php
															$sub_SubHref = '/pages/'.$subMlst->name;
															if(($menulst->where('parentId', $subMlst->id)->count()) > 0){
																$sub_SubHref = "#";
															}
														@endphp
														<a href="{{ $sub_SubHref }}">{{ $subMlst->name}}</a>
														@foreach($menulst as $sub_subMlst) 
															@if($sub_subMlst->parentId == $subMlst->id)
																	<?php 
																		$sub_SubCnt++; 
																		if($sub_SubCnt == 1){
																			echo "<ul>";
																		}
																	?>
																<li>
																	<a href="{{ '/pages/'.$sub_subMlst->name }}">{{ $sub_subMlst->name }}</a>
																</li>
															@endif 
														@endforeach
														<?php 
															if($sub_SubCnt > 0){
																echo "</ul>";
															}
															$sub_SubCnt = 0; 
														?>
													</li>
												@endif 
												@endforeach
												<?php 
													if($subCnt > 0){
														echo "</ul>";
													}
													$subCnt = 0; 
												?>
											</li>
											@endif 
											@endforeach
											<li>
												<a href="/Gallery">Gallery</a>
											</li>
											<li>
												<a href="/appointment">Appointment</a>
											</li>
											<li>
												<a href="/login">Login</a>
											</li>
										</ul>
								{{-- <ul>
									<li><a href="index.html">Home</a></li>
									<li class="submenu active-item"><a href="about.html">About us</a>
										<ul>
											<li>
												<a href="about.html">About us 2nd</a>
											</li>
											<li>
												<a href="about.html">About us 3rd</a>
											</li>
										</ul>
									</li>
									<li><a href="services.html">Services</a></li>
									<li><a href="news.html">News</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul> --}}
								</div>
							</nav>
							<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Logo -->
		<div class="logo_container_outer">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="logo_container">
							<a href="#">
								<div class="logo_content d-flex flex-column align-items-start justify-content-center">
									<div class="logo_line"></div>
									<div class="logo d-flex flex-row align-items-center justify-content-center">
										<div class="logo_text">Care<span>Med</span></div>
										<div class="logo_box">+</div>
									</div>
									<div class="logo_sub">Health Care Center</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>	
		</div>

	</header>

	<!--Mobile Menu -->
	@endif
	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<ul class="menu_list menu_mm">
					<li class="menu_item menu_mm"><a href="index.html">Home1</a></li>
					<li class="menu_item menu_mm"><a href="about.html">About us</a></li>
					<li class="menu_item menu_mm"><a href="services.html">Services</a></li>
					<li class="menu_item menu_mm"><a href="news.html">News</a></li>
					<li class="menu_item menu_mm"><a href="contact.html">Contact</a></li>
				</ul>
			</div>
			<div class="menu_extra">
				<div class="menu_appointment"><a href="#">Request an Appointment</a></div>
				<div class="menu_emergencies">For Emergencies: +563 47558 623</div>
			</div>

		</div>

	</div>
	
	@yield('pagebody')

	<!-- Footer -->

	<footer class="footer">
		{{-- <div class="footer_container">
			<div class="container">
				<div class="row">
					
					<!-- Footer - About -->
					<div class="col-lg-4 footer_col">
						<div class="footer_about">
							<div class="footer_logo_container">
								<a href="#" class="d-flex flex-column align-items-center justify-content-center">
									<div class="logo_content">
										<div class="logo d-flex flex-row align-items-center justify-content-center">
											<div class="logo_text">Care<span>Med</span></div>
											<div class="logo_box">+</div>
										</div>
										<div class="logo_sub">Health Care Center</div>
									</div>
								</a>
							</div>
							<div class="footer_about_text">
								<p>Lorem ipsum dolor sit amet, conse ctetur adipiscing elit. Curabitur ante leo, finibus quis est ut, tempor tincidunt ipsum.</p>
							</div>
							<ul class="footer_about_list">
								<li><div class="footer_about_icon"><img src="{{ asset('caremed/images/phone-call.svg')}}" alt=""></div><span>+45 677 8993000 223</span></li>
								<li><div class="footer_about_icon"><img src="{{ asset('caremed/images/envelope.svg') }}" alt=""></div><span>office@template.com</span></li>
								<li><div class="footer_about_icon"><img src="{{ asset('caremed/images/placeholder.svg') }}" alt=""></div><span>Main Str. no 45-46, b3, 56832, Los Angeles, CA</span></li>
							</ul>
						</div>
					</div>

					<!-- Footer - Links -->
					<div class="col-lg-4 footer_col">
						<div class="footer_links footer_column">
							<div class="footer_title">Useful Links</div>
							<ul>
								<li><a href="#">Testimonials</a></li>
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Apply for a Job</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="#">Our Partners</a></li>
								<li><a href="#">Services</a></li>
								<li><a href="#">Free services</a></li>
								<li><a href="#">About us</a></li>
								<li><a href="#">News</a></li>
								<li><a href="#">Contact</a></li>
								<li><a href="#">Our Screening Program</a></li>
								<li><a href="#">FAQ</a></li>
							</ul>
						</div>
					</div>

					<!-- Footer - News -->
					<div class="col-lg-4 footer_col">
						<div class="footer_news footer_column">
							<div class="footer_title">Useful Links</div>
							<ul>
								<li>
									<div class="footer_news_title"><a href="news.html">Aliquam ac eleifend metus</a></div>
									<div class="footer_news_date">March 10, 2018</div>
								</li>
								<li>
									<div class="footer_news_title"><a href="news.html">Donec in libero sit amet mi vulputate</a></div>
									<div class="footer_news_date">March 10, 2018</div>
								</li>
								<li>
									<div class="footer_news_title"><a href="news.html">Aliquam ac eleifend metus</a></div>
									<div class="footer_news_date">March 10, 2018</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="copyright_content d-flex flex-lg-row flex-column align-items-lg-center justify-content-start">
							<div class="cr">
							    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							    Copyright &copy;<script>
							        document.write(new Date().getFullYear());
							    </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i>
							    by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</div>
							<div class="footer_social ml-lg-auto">
								<ul>
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div> --}}
		{!! $footerText->html_text !!}
	</footer>
</div>

<script src="{{ asset('caremed/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('caremed/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('caremed/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('caremed/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('caremed/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('caremed/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{ asset('caremed/js/custom.js') }}"></script>
@yield('footescripts')
</body>
</html>