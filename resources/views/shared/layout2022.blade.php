<!DOCTYPE html>
<html lang="en">
  <head>
	      <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<link rel="icon" href="demo_icon.png" type="image/png" sizes="16x16">

 <title>{{ config('app.name', 'Dr') }}</title>


<!-- //for-mobile-apps -->
<link href="{{ url('/')}}/assets_2022/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- <link href="{{ url('/')}}/assets_2022/css/normalize.css" rel="stylesheet" type="text/css" media="all" /> -->
<link href="{{ url('/')}}/assets_2022/css/animate.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('/')}}/assets_2022/css/bootsnav.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('/')}}/assets_2022/css/menu.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('/')}}/assets_2022/css/nice-select.css" rel="stylesheet" type="text/css" media="all" />

<link rel="stylesheet" href="{{ url('/')}}/assets_2022/css/swiper-bundle.css" />

  <!-- Owl Stylesheets -->
 <link rel="stylesheet" href="{{ url('/')}}/assets_2022/css/owl.carousel.min.css">
 <link rel="stylesheet" href="{{ url('/')}}/assets_2022/css/owl.theme.default.min.css">

 <link href="{{ url('/')}}/assets_2022/css/lightgallery.css" rel="stylesheet" type="text/css" media="all" />

<!-- font-awesome icons -->
<link href="{{ url('/')}}/assets_2022/css/font-awesome.min.css" rel="stylesheet"> 
<link href="{{ url('/')}}/assets_2022/css/themify-icons.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<link href="{{ url('/')}}/assets_2022/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('/')}}/assets_2022/css/responsive.css" rel="stylesheet" type="text/css" media="all" />
<!-- Google fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ url('/')}}/assets_2022/bootstrap/js/jquery.min.js"></script>
  </head>

  <body>  
         
<div class="mainheader">
    
    <div class="toparea" style="{{ (isset($new_all_settings['header_color']) && $new_all_settings['header_color']->value) ? 'background:'.$new_all_settings['header_color']->value.' !important;' : '' }}">
        <div class="news">
              <marquee behavior="scroll" direction="left" class="marqueeTxt">
			  {{ $new_all_settings['top_slider_text']->value }}
			  </marquee>

        </div>
        <div class="topsocial hidden-xs">
            <ul class="f_social">
                <li>
                    <a href="{{ $new_all_settings['fb_link']->value }}" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="{{ $new_all_settings['insta_link']->value }}" target="blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a href="{{ $new_all_settings['twitter_link']->value }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </div>


    <nav class="navbar navbar-default  navbar-sticky  bootsnav">
        <div class="container-fluid">      
             <!-- Start Atribute Navigation -->
			
       <div class="attr-nav hidden-xs">
                <ul>
                    <li><a href="tel:+91{{ ($new_all_settings['call_us']->value) ? $new_all_settings['call_us']->value : '' }}" class="callbtn"><i class="fa fa-phone"></i> Call Now</a></li>
                    <li><a href="{{url('appointment')}}"  class="bookbtn"><i class="fa fa-book"></i> Book An Appointment</a></li>
                </ul>
            </div>
		
            <!-- End Atribute Navigation -->
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="logo" href="/">
                    <!-- <img src="{{ url('/')}}/assets_2022/img/logo.png"   alt=""> -->
                    <!-- <h1>LOGO</h1> -->
					
					<!--<img src="{{ $siteLogo }}" alt=""> -->
					<img src="{{ url('/') }}/uploads/images/{{ $new_all_settings['logo']->value }}"   alt="">
                </a>
            </div>
            <!-- End Header Navigation -->
        @php 
			//dd($new_all_settings);
			
			//echo "==== <pre>"; print_r($new_all_settings['menu']['submenu']);
			//dd($new_all_settings['menu']);
		@endphp
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li><a href="/">Home</a></li>                    
                    
					
					<!-- ====================================================================== -->
					
					@php 
					
					//echo "==== <pre>"; print_r($new_all_settings['menu']['submenu']);
					//dd($new_all_settings['menu']['mainmenu']);
					@endphp
					@foreach($new_all_settings['menu']['mainmenu'] as $menu_row)
					
						@if(isset($new_all_settings['menu']['submenu'][$menu_row['id']]) && count($new_all_settings['menu']['submenu'][$menu_row['id']]) > 0)
							@if($menu_row['orientation'] == 'portrait') 
					
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><?php echo $menu_row['name']; ?></a>
								<ul class="dropdown-menu">
									@foreach($new_all_settings['menu']['submenu'][$menu_row['id']] as $sub_menu_row)
										<li><a href="{{($sub_menu_row['dynamic_text_id']) ? url('pages').'/'.$sub_menu_row['name'] : '#'}}">{{ $sub_menu_row['name'] }}</a></li>
									@endforeach
								</ul>
							</li>
							@else

							@php
								$landscape = [];

								foreach($new_all_settings['menu']['submenu'][$menu_row['id']] as $key => $sub_menu_row) {
									$landscape[$key % 4][] = $sub_menu_row;
								}
							@endphp
							<li class="dropdown megamenu-fw">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $menu_row['name'] }}</a>
								<ul class="dropdown-menu megamenu-content" role="menu">
									<li>
										<div class="row">
											@foreach($landscape as $landscape_row)
												<div class="col-menu col-md-3">
													<div class="content">
														<ul class="menu-col">
								@foreach($landscape_row as $landscape_row_val)
									<li>
										<!-- <a href="{{ ($landscape_row_val['dynamic_text_id']) ? 'page.php?id='.$landscape_row_val['id'] : '#' }}">{{ $landscape_row_val['name'] }}</a> -->
										
										<a href="{{ url('pages').'/'.$landscape_row_val['name'] }}">{{ $landscape_row_val['name'] }}</a>
									</li>
								@endforeach
														</ul>
													</div>
												</div>
											@endforeach
										</div>
									</li>
								</ul>
							</li>
							@endif
						@else
							<!-- <li><a href="{{($menu_row['dynamic_text_id']) ? 'page.php?id='.$menu_row['id'] : '#' }}"> {{ $menu_row['name'] }}</a></li> -->
						
							<li><a href="{{ '/pages/'.$menu_row['name'] }}">{{ $menu_row['name'] }}</a></li>
						@endif
					@endforeach
					<!-- ====================================================================== -->

             

                    <li><a href="{{url('new-gallery')}}">Gallery</a></li>
                    <li><a href="{{url('client-feedback')}}">Feedback</a></li>
                </ul>
            
            </div><!-- /.navbar-collapse -->
                
        </div>   
    </nav>
</div>  

        
<!-- Start Body section -->
@yield('pagebody')
<!-- End of Body section -->
	  
	  
	  
      <div class="call-to5 pt-20 pb-20" style="{{ (isset($new_all_settings['footer_color']) && $new_all_settings['footer_color']->value) ? 'background:'.$new_all_settings['footer_color']->value.' !important;' : '' }}">
    <div class="container">
        <div class="col-sm-12 col-md-6">
            <h1>Get in Touch</h1>
            <!-- <p>You will find yourself working in a true partnership that results in an incredible experience, and an end product that is the best.</p> -->
        </div>
        <div class="col-sm-6 col-md-3 ">
            <div class="icon-box ">
              <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
            </div>
            <div class="info-box">
                <h2>Call us on</h2>
				<h4><a href="tel:+91{{ ($new_all_settings['call_us']->value) ? $new_all_settings['call_us']->value : '' }}">+91 {{ ($new_all_settings['call_us']->value) ? $new_all_settings['call_us']->value : '' }}</a></h4>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 ">
            <div class="icon-box">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </div>
            <div class="info-box ">
                <h2>Email us</h2>
                <h4><a href="mailto:{{ ($new_all_settings['email']->value) ? $new_all_settings['email']->value : '' }}">{{ ($new_all_settings['email']->value) ? $new_all_settings['email']->value : '' }}</a></h4>
            </div>
        </div>
    </div>
</div>
<footer class="footer_area">
            <div class="footer_widget">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <aside class="f_widget about_widget">
                                <!-- <img src="{{ url('/')}}/assets_2022/img/logo.png" width="200px" alt=""> -->
								
								<!-- <img src="{{ url('/') }}/uploads/images/{{ $new_all_settings['logo']->value }}"   alt=""> -->
								
								@if(isset($new_all_settings['google_map']) && $new_all_settings['google_map']->value)
								{!! $new_all_settings['google_map']->value !!}
								@else 
								<img src="{{ url('/') }}/uploads/images/{{ $new_all_settings['logo']->value }}"   alt="">
							@endif
								
                                <!--<h1>Logo</h1> -->
<!--                              
                                <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit, sed do eiusmod tempor incididunt ut labore ali qua.</p> -->
                               
                               
                            </aside>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <aside class="f_widget padd-l-60">
                                <div class="f_title">
                                    <h3>Services</h3>
                                </div>
                                <div class="link_widget">
                                    <ul>
										<?php foreach($new_all_settings['services_data'] as $certificates_data_row) { ?>
											<li><a href="<?php echo $certificates_data_row->link; ?>"><?php echo $certificates_data_row->gallery_name; ?></a></li>
										<?php } ?>
                                        <!-- 
										<li><a href="services.php">X-ray</a></li>
                                        <li><a href="services.php">USG</a></li>
                                        <li><a href="services.php">2D Echo</a></li>
                                        <li><a href="services.php">Stress Test</a></li>
                                        <li><a href="services.php">Doppler</a></li>
                                        <li><a href="services.php">PFT</a></li>
                                        <li><a href="services.php">Dental Clinic</a></li>
                                        <li><a href="services.php">Ophthalmology</a></li>
										-->
                                       
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                            <aside class="f_widget">
                                <div class="f_title">
                                    <h3>Quick Links </h3>
                                </div>
                                <div class="link_widget">
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li><a href="{{url('new-gallery')}}">Gallery</a></li>
                                    
                                    <li><a href="{{url('client-feedback')}}">Feedback</a></li>
                                     </ul>
                            </div>
                            </aside>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12" style="">
                            <aside class="f_widget contact_widget">
                                <div class="f_title">
                                    <h3>get in touch</h3>
                                </div>
                                <div class="contact_inner">
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <p>{{$new_all_settings['address']->value}}</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                          <a href="tel:+91{{$new_all_settings['call_us']->value}}">+91 {{$new_all_settings['call_us']->value}}</a></a>
                                        </div>
                                    </div>
                                    
                                    <div class="media">
                                        <div class="media-left">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <div class="media-body">
                                            <a href="mailto:{{$new_all_settings['email']->value}}">{{$new_all_settings['email']->value}}</a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </aside>

                            
                        </div>
                    </div>
                </div>
            </div>
			@if(isset($new_all_settings['copyright']->value))
            <div class="footer_copyright">
                <div class="container-fluid">
                    <div class="footer_copyright_inner">
                        <div class="text-center copy-right">
							{{$new_all_settings['copyright']->value}}
                        </div>
                    </div>
                </div>
            </div>
			@endif
        </footer>  
			
			
		@if(isset($new_all_settings['whatsapp']->value))
          <a href="https://api.whatsapp.com/send?phone=+91{{$new_all_settings['whatsapp']->value}}&text=Hi" class="whatsapp-btn" target="_blank">
           <i class="fa fa-whatsapp wp-button"></i>
           </a>
		@endif


        <div class="col-lg-12 col-sm-12 col-xs-12 fixed-footer-cust hidden-md hidden-lg ">
        <div class="container">
            <!-- <div class="col-lg-6 col-sm-6 col-xs-6 div-line plr-0 pd0">
                <a href="#/" download class="fix-link callme">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i> DOWNLOAD BROCHURE</a>
            </div> -->
            <div class="col-lg-6 col-sm-6 col-xs-6 div-line plr-0 pd0">
                <a href="tel:+91{{ ($new_all_settings['call_us']->value) ? $new_all_settings['call_us']->value : '' }}" class="fix-link callme">
                  <i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>
            </div>
            <div class="col-lg-12 col-sm-6 col-xs-6 plr-0 pd0">
                <a href="{{url('appointment')}}" class="btn fix-link i-am">
                  <i class="fa fa-book"></i> Appointment</a>
            </div>
        </div>
    </div>
      
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ url('/')}}/assets_2022/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('/')}}/assets_2022/js/bootsnav.js"></script>
    <script src="{{ url('/')}}/assets_2022/js/owl.carousel.js"></script>
    <script src="{{ url('/')}}/assets_2022/js/swiper-bundle.min.js"></script>
    <script src="{{ url('/')}}/assets_2022/js/nice-select.min.js"></script>
    <script src="{{ url('/')}}/assets_2022/js/lightgallery-all.min.js"></script>
    <script src="{{ url('/')}}/assets_2022/js/custom.js"></script>  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
	@yield('footescripts')


  </body>
</html>