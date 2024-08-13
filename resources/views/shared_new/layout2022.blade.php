<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Dr') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ config('app.name', 'Dr') }}">
	<meta name="keywords" content="{{config('app.name', 'Dr') }}">

    <!-- <link rel="manifest" href="assets_2022/site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets_2022/img/favicon.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{url('assets_2022/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{url('assets_2022/css/style.css')}}">
    <!-- <link rel="stylesheet" href="{{url('assets_2022/css/responsive.css')}}"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
			 @if(isset($all_settings['top_bar']->value) && $all_settings['top_bar']->value == 1)
            <div class="header-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 ">
                            <div class="social_media_links">
								@if($all_settings['twitter_link']->value)
								<a href="{{$all_settings['twitter_link']->value??''}}"><i class="fa fa-twitter"></i></a>
								@endif
								@if($all_settings['fb_link']->value)
								<a href="{{$all_settings['fb_link']->value??''}}"><i class="fa fa-facebook-f"></i></a>
								@endif
								@if($all_settings['linkedin_link']->value)
								<a href="{{$all_settings['linkedin_link']->value??''}}"><i class="fa fa-linkedin"></i></a>
								@endif
								@if($all_settings['insta_link']->value)
								<a href="{{$all_settings['insta_link']->value??''}}"><i class="fa fa-instagram"></i></a>
								@endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="short_contact_list">
                                <ul>
                                    <!-- <li><a href="#"> <i class="fa fa-envelope"></i> info@docmed.com</a></li>
                                    <li><a href="#"> <i class="fa fa-phone"></i> 160160</a></li> -->

									<li>
                                 @if($all_settings['openeing_hours']->value)
                                {{$all_settings['openeing_hours']->value??''}} {{$all_settings['openeing_hours_text']->value??''}}
                                @endif
                            </li>
                            <li>
                                 @if($all_settings['appointment_number']->value)
								 |
                                {{$all_settings['appointment_number']->value??''}} Call Us For Appointment 
                                @endif
                            </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			@endif
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-2">
                            <div class="logo">
                                <a href="/">
                                    <img src="{{ $siteLogo }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-10">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="/">home</a></li>
                                        <!-- <li><a href="Department.html">Department</a></li>
                                        <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">blog</a></li>
                                                <li><a href="single-blog.html">single-blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                <li><a href="elements.html">elements</a></li>
                                                <li><a href="about.html">about</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="Doctors.html">Doctors</a></li>
                                        <li><a href="contact.html">Contact</a></li> -->

										<?php 

							$subCnt = 0; $sub_SubCnt = 0; $subHref = ""; $sub_SubHref = ""; ?> 
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
												echo "<ul class='submenu'>";
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


										<li><a href="/Gallery">Gallery</a></li>
										<li><a href="/all-events">Events</a></li>
										<li><a href="/all-works">Work</a></li>
										<li><a href="/all-paper-cuttings">Paper Cutting</a></li>
										<li><a href="{{ url('/appointment/') }}">Appointment</a></li>
										<li><a href="/AddRating">Feedback</a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                            <div class="Appointment">
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" href="#test-form">Make an Appointment</a>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

<!-- ============================= Start Main Area ----------------------- -->
@yield('pagebody')
<!-- ============================= End Main Area ----------------------- -->

<!-- footer start -->
    <footer class="footer">
            <div class="footer_top">
                <div class="container">
                    <div class="row">

					{!! $footerText->html_text !!}

                        <!-- <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="footer_widget">
                                <div class="footer_logo">
                                    <a href="#">
                                        <img src="{{ $siteLogo }}" alt="">
                                    </a>
                                </div>
                                <p>
                                        Firmament morning sixth subdue darkness 
                                        creeping gathered divide.
                                </p>
                                <div class="socail_links">
                                    <ul>
                        										@if($all_settings['twitter_link']->value)
                                        <li>
                        										<a href="{{$all_settings['twitter_link']->value??''}}"><i class="fa fa-twitter"></i></a>
                                        </li>
                        										@endif
                        										@if($all_settings['fb_link']->value)
                                        <li>
                        										<a href="{{$all_settings['fb_link']->value??''}}"><i class="fa fa-facebook-f"></i></a>
                                        </li>
                        										@endif
                        										@if($all_settings['linkedin_link']->value)
                                        <li>
                        										<a href="{{$all_settings['linkedin_link']->value??''}}"><i class="fa fa-linkedin"></i></a>
                                        </li>
                        										@endif
                        										@if($all_settings['insta_link']->value)
                                        <li>
                        										<a href="{{$all_settings['insta_link']->value??''}}"><i class="fa fa-instagram"></i></a>
                                        </li>
                        										@endif
                                    </ul>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-xl-2 offset-xl-1 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Departments
                                </h3>
                                <ul>
                        									@foreach($departments_data as $departments_data_row)
                                    <li><a href="#">{{$departments_data_row->title}}</a></li>
                        									@endforeach
                                   
                                </ul>
                            
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-lg-2">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Useful Links
                                </h3>
                                <ul>
                        
                        								@php //echo "============>>>>>>>>> <pre>"; print_r($menulst); exit; @endphp
                        								@foreach($menulst as $mLst)
                        									@if(is_null($mLst->parentId))
                        
                        									@php $subHref = '/pages/'.$mLst->name; @endphp
                        
                        										@if(($menulst->where('parentId', $mLst->id)->count()) <= 0)
                        											<li><a href="{{ $subHref }}">{{$mLst->name}}</a></li>
                        										@endif
                        									@endif
                        								@endforeach
                        									<li><a class="active" href="/">home</a></li>
                        									<li><a href="/Gallery">Gallery</a></li>
                        									<li><a href="/all-events">Events</a></li>
                        									<li><a href="{{ url('/appointment/') }}">Appointment</a></li>
                        									<li><a href="/AddRating">Feedback</a></li>
                        
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-3">
                            <div class="footer_widget">
                                <h3 class="footer_title">
                                        Address
                                </h3>
                                <p>
                        								{!!$footerAddress->html_text!!}
                                </p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="copy-right_text">
                <div class="container">
                    <div class="footer_border"></div>
                    <div class="row">
                        <div class="col-xl-12">
                            <p class="copy_right text-center">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
<!-- footer end  -->
    <!-- link that opens popup -->

    <!-- form itself end-->
    <form id="test-form" class="white-popup-block mfp-hide">
        <div class="popup_box ">
            <div class="popup_inner">
                <h3>Make an Appointment</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-xl-6">
                            <input id="datepicker" placeholder="Pick date">
                        </div>
                        <div class="col-xl-6">
                            <input id="datepicker2" placeholder="Suitable time">
                        </div>
                        <div class="col-xl-6">
                            <select class="form-select wide" id="default-select" class="">
                                <option data-display="Select Department">Department</option>
                                <option value="1">Eye Care</option>
                                <option value="2">Physical Therapy</option>
                                <option value="3">Dental Care</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <select class="form-select wide" id="default-select" class="">
                                <option data-display="Doctors">Doctors</option>
                                <option value="1">Mirazul Alom</option>
                                <option value="2">Monzul Alom</option>
                                <option value="3">Azizul Isalm</option>
                            </select>
                        </div>
                        <div class="col-xl-6">
                            <input type="text"  placeholder="Name">
                        </div>
                        <div class="col-xl-6">
                            <input type="text"  placeholder="Phone no.">
                        </div>
                        <div class="col-xl-12">
                            <input type="email"  placeholder="Email">
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed-btn3">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- form itself end -->

    <!-- JS here -->
    <script src="{{url('assets_2022/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{url('assets_2022/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{url('assets_2022/js/popper.min.js')}}"></script>
    <script src="{{url('assets_2022/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets_2022/js/owl.carousel.min.js')}}"></script>
    <script src="{{url('assets_2022/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{url('assets_2022/js/ajax-form.js')}}"></script>
    <script src="{{url('assets_2022/js/waypoints.min.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.counterup.min.js')}}"></script>
    <script src="{{url('assets_2022/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{url('assets_2022/js/scrollIt.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{url('assets_2022/js/wow.min.js')}}"></script>
    <script src="{{url('assets_2022/js/nice-select.min.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{url('assets_2022/js/plugins.js')}}"></script>
    <script src="{{url('assets_2022/js/gijgo.min.js')}}"></script>
    <!--contact js-->
    <script src="{{url('assets_2022/js/contact.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.form.js')}}"></script>
    <script src="{{url('assets_2022/js/jquery.validate.min.js')}}"></script>
    <script src="{{url('assets_2022/js/mail-script.js')}}"></script>

    <script src="{{url('assets_2022/js/main.js')}}"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    </script>
</body>

</html>