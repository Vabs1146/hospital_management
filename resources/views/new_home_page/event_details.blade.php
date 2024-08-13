<?php
use App\helperClass\drAppHelper; 
$dr_helper = new drAppHelper();

$advertisement = $dr_helper->get_advertisement();

//echo "================>>>>>>>>>>>>> <pre>"; print_r($advertisement); exit;
?>
@extends('shared_new.layout2022_no_head_foot')
@section('pagebody')

<style>
	.mfp-inline-holder .mfp-content, .mfp-ajax-holder .mfp-content {
		width: auto;
	}


	#slider{  
    width:900px;  
    height:400px;  
    margin: 10%;  
    margin-left:15%;  
    overflow:hidden;  
}  
.slides{  
    display:block;  
    width:6000px;  
    height:400px;  
    margin-left:0;  
    padding:0;  
}  
.slide{  
    float:left;  
    list-style-type:none;  
    width:900px;  
    height:400px;  
} 
img{  
   width: 100%;
    height: 100%;
    object-fit: contain;
} 
</style>

    <!-- bradcam_area_start  -->
  <div class="bradcam_overlay" style="">
      <div class="container">
          <div class="row">
              <div class="col-xl-12">
                  <div class="bradcam_text">
                      <h3>Event detials</h3>
                      <p><a href="{{url('/all-events')}}">All Events /</a> Event detials</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- bradcam_area_end  -->

   <!--================Blog Area =================-->
   <section class="blog_area single-post-area section-padding" style="padding-top: 20px;">
      <div class="container">

	
                          @if(Session::has('flash_message'))
							  <div class="row" style="margin: 0px;width: 100%;">
								  <div class="alert alert-success" style="width: 100%;">
									{{ Session::get('flash_message') }}
								  </div>
							  </div>
                          @endif
                      

         <div class="row">
            <div class="col-lg-12 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                     <!-- <img class="img-fluid" src="{{ Storage::disk('local')->url($event_data->img_url) }}" alt=""> -->

					 <!-- ============================================================================== -->
						
						@php
							$images = explode(',', $event_data->img_url);
						@endphp


						<div id="slider">  
							<ul class="slides">  
							@foreach($images as $images_row)
								<li class="slide"><img src="{{ Storage::disk('local')->url($images_row) }}"/></li>  
							@endforeach
								<!-- <li class="slide"><img src="{{ Storage::disk('local')->url($event_data->img_url) }}"/></li>  
								<li class="slide"><img src="{{ Storage::disk('local')->url($event_data->img_url) }}"/></li>  
								<li class="slide"><img src="{{ Storage::disk('local')->url($event_data->img_url) }}"/></li>  
								<li class="slide"><img src="{{ Storage::disk('local')->url($event_data->img_url) }}"/></li>  
								<li class="slide"><img src="{{ Storage::disk('local')->url($event_data->img_url) }}"/></li>   -->
		  
							</ul>  
						</div>  

					 <!-- ============================================================================== -->
                  </div>
                  <div class="blog_details">
					{{$event_data->description}}
				  </div>
               </div>
               <div class="navigation-top">
			  
                  <div class="d-sm-flex justify-content-between text-center">
                     <p class="like-info "><span class="align-middle"><a class="popup-with-form" href="#like-form"><i class="fa fa-heart"></i></a></span> 
					  @if(count($event_likes) <= 0)
						0 likes
					  @else
						@if(count($event_likes) > 5)
						{{trim($event_likes[0]->first_name . ' ' . $event_likes[0]->last_name)}} and {{count($event_likes) - 1}} people like this
						@else
							@foreach($event_likes as $event_likes_row)
								@php $names[] = trim($event_likes_row->first_name . ' ' . $event_likes_row->last_name); @endphp
							@endforeach
							{{implode(', ', $names)}} like this
						@endif
					  @endif
					 </p>
                     <div class="col-sm-4 text-center my-2 my-sm-0">
                        <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                     </div>
                     <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                     </ul>
                  </div>
               </div>
               <!-- <div class="blog-author">
                  <div class="media align-items-center">
                     <img src="img/blog/author.png" alt="">
                     <div class="media-body">
                        <a href="#">
                           <h4>Harvard milan</h4>
                        </a>
                        <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he
                           our dominion twon Second divided from</p>
                     </div>
                  </div>
               </div> -->

			   @if(count($event_comments) > 0)
               <div class="comments-area">
                  <h4>{{count($event_comments)}} Comments</h4>

				  @foreach($event_comments as $event_comments_row)
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="img/comment/comment_1.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
							  {{$event_comments_row->comment}}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">{{$event_comments_row->name}}</a>
                                    </h5>
                                    <p class="date">{{date('d F Y, h:i:s', strtotime( $event_comments_row->created_at))}}</p>
                                 </div>
                                 <!-- <div class="reply-btn">
                                    <a href="#" class="btn-reply text-uppercase">reply</a>
                                 </div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				  @endforeach
                  
               </div>
			   @endif
               <div class="comment-form">
                  <h4>Leave a Reply</h4>
                  <form method="POST" class="form-contact comment_form" action="{{url('save-event-comments')}}" id="commentForm">
				  <input type="hidden" name="event_id" id="event_id" value="{{$event_data->id}}">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea required class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input required class="form-control" name="name" id="name" type="text" placeholder="Name">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="mobile" id="mobile" type="text" placeholder="Mobile">
                           </div>
                        </div>
                       
                     </div>
                     <div class="form-group">
                        <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                     </div>
                  </form>
               </div>
            </div>
           
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->


   <form method="POST" action="{{url('like-this-event')}}" id="like-form" class="white-popup-block mfp-hide">
        <div class="popup_box ">
            <div class="popup_inner">
                <h3>Like this event</h3>
                <form method="POST" action="{{url('like-this-event')}}">
				 <input type="hidden" name="event_id" id="event_id" value="{{$event_data->id}}">
                    <div class="row">
                        <div class="col-xl-6">
                            <input type="text" required name="first_name" placeholder="First Name (required)">
                        </div>
                        <div class="col-xl-6">
                            <input type="text" name="last_name" placeholder="Last Name (optional)">
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

@endsection


@section('footescripts')
<script>

$(function()
{  
    //value for animation  
    var width = 900;  
    var animationSpeed = 1000;  
    var pause = 3000;  
    var currentSlide = 1;  
    //Dom element.   
    var $slider = $('#slider');  
    var $sliderAnimation = $slider.find('.slides');  
    var $slides = $sliderAnimation.find('.slide');  
  
    setInterval(function()
    {  
         $sliderAnimation.animate({'margin-left': '-='+width}, animationSpeed, function(){  
         currentSlide ++;  
         if(currentSlide === $slides.length)  
         {  
                $sliderAnimation.css('margin-left', 0);  
                currentSlide = 1;  
         }  
     });  
    },pause);  
});  

</script>
@endsection