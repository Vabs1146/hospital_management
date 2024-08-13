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
        <div class="container" >
			<div class="our_department_area " style="padding-top: 20px;padding-bottom: 20px;">
				<div class="container">
					<div class="row">
						<div class="col-xl-12">
							<div class="section_title text-center mb-10">
								<h3>work</h3>
								<!-- <p>Esteem spirit temper too say adieus who direct esteem. <br>
									It esteems luckily or picture placing drawing. </p> -->
							</div>
						</div>
					</div>
					<div class="row">
					
					 
					@foreach($all_work as $departments_data_row)
						<div class="col-xl-3 col-md-6 col-lg-4">
							<div class="single_department">
								<div class="department_thumb">
									<img src="{{ Storage::disk('local')->url($departments_data_row->img_url) }}" alt="">
								</div>
								<div class="department_content">
									<h3><a href="#">{{$departments_data_row->title}}</a></h3>
									<p>{{$departments_data_row->description}}</p>
									<a href="{{$departments_data_row->read_more_link}}" class="learn_more">Learn More</a>
								</div>
							</div>
						</div>
					@endforeach
						
					</div>
				</div>
			</div>
		</div>
    </section>
    <!--================Blog Area =================-->

@endsection


@section('footescripts')

@endsection