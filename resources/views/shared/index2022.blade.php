@extends(env('layoutTemplate'))
@section('pagebody')
<!-- ===================================================================================================== -->
<!-- Start Body section -->
 
    <!-- Slider main container -->

						
    <div class="mainslider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- <div class="swiper-slide">
                            <img src="{{ url('/')}}/assets_2022/img/1.jpg" alt="" />
                            <div class="overlay"></div>
                            <div class="sliderinfo hidden-xs">
                                <h4>Best care | Modern equipment</h4>
                                <h1 class="text-upper">True Healthcare <span>For Your Family</span> </h1>
                            
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ url('/')}}/assets_2022/img/2.jpg" alt="" />
                            <div class="overlay"></div>
                            <div class="sliderinfo hidden-xs">
                                <h4>Meet doctors | Get admitted</h4>
                                <h1 class="text-upper">Provide Aspects  <span>of Medical Care</span></h1>
                            
                              
                            </div>
                        </div>
						-->
						
						@php
							//dd($new_homepage_slider_images);
						@endphp
						
						@foreach($new_homepage_slider_images as $homepage_slider_images_row)
							<div class="swiper-slide">
								<img src="{{ url('/')}}/uploads/images/{{$homepage_slider_images_row->imgUrl}}" alt="" />
								<div class="overlay"></div>
								<div class="sliderinfo hidden-xs">
									<!--<h4>Best care | Modern equipment</h4>
									<h1 class="text-upper">True Healthcare <span>For Your Family</span> </h1>-->
								</div>
							</div>
						@endforeach
                     
                        
                    </div>

                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev">PREV</div>
                    <div class="swiper-button-next">NEXT</div>

                    <!-- If we need scrollbar -->
                    <!-- <div class="swiper-scrollbar"></div> -->
                </div>
            </div>
    


<!-- Start Home intro section -->
<div class="home-intro pt-50 pb-50">
    <div class="container"> 
	{!! isset($new_get_section_1->html_text) ? htmlspecialchars_decode($new_get_section_1->html_text) : '' !!}
		   <!--
           <div class="col-sm-6">
               <div class="title mb-30">
                    <h2 >Improving The Quality Of Your Life Through Better Health.</h1>
                </div>
                
                <p class="mt-30 text-justify">Our goal is to deliver quality of care in a courteous, respectful, and compassionate manner. We hope you will allow us to care for you and to be the first and best choice for healthcare.</p>
                <p>We will work with you to develop individualised care plans, including management of chronic diseases. We are committed to being the region’s premier healthcare network providing patient centered care that inspires clinical and service excellence.</p>
                <div class="">
                    <a href="#/" class="btn1">Read More <span class="glyphicon glyphicon-arrow-right"></span></a> 
                </div>
           </div>
           <div class="col-sm-6">
                 <img src="{{ url('/')}}/assets_2022/img/homeintro.jpg" alt="" class="img-responsive img-r">
           </div> -->
    </div>
</div>
<!-- End of Home intro section -->

<!-- Start Home intro section -->

<!-- End of Home intro section -->

<!-- Start our department section  -->
<div class="ourdepartment">
  <div class="container p-r">
     <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="title2 white-color text-center mb-60">
            <h1>Our Services</h1>
          </div>
      </div>
     </div>

      <div class=" deparmentwrapper">
            <div class="owl-carousel owl-theme" id="Department">
                @foreach($services_data as $certificates_data_row)
						
						<div class="depbox">
							<div class="service-img">
							  <img src="{{  url('/').'/gallery_image/'.$certificates_data_row->filenames1 }}" alt="">
							</div>
							<div class="dep-info">
							  <h4><?php echo $certificates_data_row->gallery_name; ?></h4>
							   <a href="<?php echo $certificates_data_row->link; ?>">Read More <span class="glyphicon glyphicon-arrow-right"></span></a> 
							</div>
						</div>

				@endforeach
            </div>
      </div>
  </div>
</div>
<!-- End of our department section  -->

<!-- Start doctor section  -->

<!-- End of doctor section --> 


<!-- Start doctor section  -->
<div class="homedoctor pt-80 pb-80">
  <div class="container">
      
      <div class="col-md-10 col-md-offset-1">
        <div class="title2 text-center mb-60">
          <h1>Meet Our Speciality Consultations</h1>
          <p>All doctors are Qualified with long experience in their respective field. We plan to provide high quality medical services from qualified doctors with all Diagnostic Tests using latest equipments   under one roof.</p>
        </div>  
      </div> 
	  
	  <?php foreach($consultant_data as $certificates_data_row) { ?>
	     <div class="col-sm-6 col-md-3">
			  <div class="doctor-item style-2 " >
					<div class="doctor-inner">
						<div class="doctor-thumb">
							<img src="{{url('/')}}/gallery_image/{{$certificates_data_row->filenames1}}" alt="doctor">
						</div>
						<div class="doctor-content">
							<div class="doctor-name">
								<h4><a href="#/"><?php echo $certificates_data_row->gallery_name; ?></a></h4>
								<p class="digi"><?php echo $certificates_data_row->degree; ?></p>
							</div>
						</div>
					</div>
				</div>
		  </div>					
<?php } ?>

      <div class="col-sm-12">
        <div class="btnsec text-center mt-50">
          <a href="{{url('all-doctors')}}" class="btn1">View All Doctors</a>
        </div>
      </div>
  </div>
</div>
<!-- End of doctor section  -->



<!-- start book appointment section  -->

<!-- End of book appointment section  -->




<!-- Start Testimonail section -->
<div class="our-testimonial pt-50 pb-50">
  <div class="container">
      <div class="testimial-title pb-20">
        <h1 >Our <span  class="theme-color"> Testimonials</span></h1>
      </div>
    <div class="col-md-8 col-md-offset-2">
         <div id="our-testimonial" class="owl-carousel  owl-theme">
		 
		 {{--	
		@foreach($feedback_data as $certificates_data_row)				  
		<div class="testimonial-box">
		  <div class="test-img">
			<img src="{{url('/')}}/gallery_image/{{$certificates_data_row->filenames1}}" alt="" style="width: 100px !important;">
		  </div>
		  <div class="test-info">
			<span><i class="fa fa-quote-left" aria-hidden="true"></i></span>
			<p>{{ $certificates_data_row->message }}</p>
			<h3>{{ $certificates_data_row->name }}</h3>
		  </div>
		</div>
		@endforeach
		 --}}
		
		@foreach ($ratingLst as $item)
		<div class="testimonial-box">
		  <div class="test-img">
			<img src="{{ asset('images')}}/{{$item->userimage}}" alt="" style="width: 100px !important;">
		  </div>
		  <div class="test-info">
			<span><i class="fa fa-quote-left" aria-hidden="true"></i></span>
			{{--<div> <input id="ratingscore" name="ratingscore" value="{{$item->ratingscore}}" class="rating rating-loading" data-min="0" data-max="5"
                            data-step="1" value="0" readonly></div> --}}
			<p>{{ $item->feedback or "" }}</p>
			<h3>{{ $item->username}}</h3>
		  </div>
		</div>
		@endforeach

            
          
          </div><!-- end of owl-carousel  -->
    </div><!-- end of col-md-offset-2  -->
  </div><!-- end of container  -->

</div><!-- end of our-testimonial  -->

<!-- End of  Testimonail section -->

<div class="our-partners pt-50 pb-50">
            <div class="testimial-title text-center pb-20">
                <h1>Our <span  class="theme-color">  Certification </span></h1>
            </div>
            <div class="container">
        		<div class="small-12 cell">
					<div id="partners" class="owl-carousel  owl-theme">
						<?php foreach($certificates_data as $certificates_data_row) { ?>
							<div class="partners-logo">
								<a href="#"><img src="{{ url('/')}}/gallery_image/{{$certificates_data_row->filenames1}}" alt=""/></a>
							</div>
						<?php } ?>

					</div>
				</div>
            
            </div><!-- Grid Container /-->
            
        </div>
        <!-- Our Partners /-->




	  <!-- End of Body section -->
<!-- ===================================================================================================== -->
@endsection