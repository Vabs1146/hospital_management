<?php
use App\helperClass\drAppHelper; 
$dr_helper = new drAppHelper();

$advertisement = $dr_helper->get_advertisement();

//echo "================>>>>>>>>>>>>> <pre>"; print_r($advertisement); exit;
?>
@extends('shared_new.layout2022_no_head_foot')
@section('pagebody')

    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container" style="width: 80%;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_left_sidebar row">
						@foreach($all_events as $all_event)
                        <article class="blog_item  col-md-6">
                            <div class="blog_item_img">

								@php
									$images = explode(',', $all_event->img_url);
								@endphp

                                <img class="card-img rounded-0" src="{{ Storage::disk('local')->url($images[0]) }}" alt="">
                                <a href="{{url('/event-details/'.$all_event->id)}}" class="blog_item_date">
                                    <h3>{{date('d', strtotime($all_event->start_date))}}</h3>
                                    <p>{{date('M Y', strtotime($all_event->start_date))}}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{url('/event-details/'.$all_event->id)}}">
                                    <h2>{{$all_event->title}}</h2>
                                </a>
                                <p>{{$all_event->description}}</p>
                                <ul class="blog-info-link">
                                    <li>
									<a href="{{url('/event-details/'.$all_event->id)}}"><i class="fa fa-user"></i> 

									@php
										$event_likes = isset($events_data[$all_event->id]) ? $events_data[$all_event->id]['likes'] : [];
										$event_comments = isset($events_data[$all_event->id]) ? $events_data[$all_event->id]['comments'] : [];
									@endphp
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
									
									</a>
									</li>
                                    <li><a href="{{url('/event-details/'.$all_event->id)}}"><i class="fa fa-comments"></i> {{count($event_comments)}} Comments</a></li>
                                </ul>
                            </div>
                        </article>
						@endforeach

                        <!-- <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="img/blog/single_blog_2.png" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>
                            </div>
                        
                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Google inks pact for new 35-storey office</h2>
                                </a>
                                <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                    he earth it first without heaven in place seed it second morning saying.</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>
                        
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="img/blog/single_blog_3.png" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>
                            </div>
                        
                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Google inks pact for new 35-storey office</h2>
                                </a>
                                <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                    he earth it first without heaven in place seed it second morning saying.</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>
                        
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="img/blog/single_blog_4.png" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>
                            </div>
                        
                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Google inks pact for new 35-storey office</h2>
                                </a>
                                <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                    he earth it first without heaven in place seed it second morning saying.</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article>
                        
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="img/blog/single_blog_5.png" alt="">
                                <a href="#" class="blog_item_date">
                                    <h3>15</h3>
                                    <p>Jan</p>
                                </a>
                            </div>
                        
                            <div class="blog_details">
                                <a class="d-inline-block" href="single-blog.html">
                                    <h2>Google inks pact for new 35-storey office</h2>
                                </a>
                                <p>That dominion stars lights dominion divide years for fourth have don't stars is that
                                    he earth it first without heaven in place seed it second morning saying.</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                    <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                                </ul>
                            </div>
                        </article> -->

                        <!-- <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>
                </div>
               
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

@endsection


@section('footescripts')

@endsection