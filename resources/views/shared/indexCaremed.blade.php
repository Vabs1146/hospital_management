@extends(env('layoutTemplate'))
@section('pagebody')

	<!-- Home slider-->

	<div class="home">
		<div class="home_slider_container">
            @if(isset($imageGallery))
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
                @foreach($imageGallery as $imgGal)
				<!-- Slider Item -->
				<div class="owl-item">
                    <div class="home_slider_background" style="background-image:url({{ Storage::disk('local')->url($imgGal->imgUrl) }})">
                            {{-- {{asset('caremed/images/home_background_1.jpg')}} --}}
                    </div>
					<div class="home_content">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content_inner">
										<div class="home_title"><h1> {{ $imgGal->Name  }}</h1></div>
										<div class="home_text">
											<p>{{ $imgGal->Description }}</p>
										</div>
										<div class="button home_button">
											<a href="{{ (empty($imgGal->read_more_link) || is_null($imgGal->read_more_link))?"#":$imgGal->read_more_link }}">read more</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                @endforeach
            @endif
				{{-- <!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url({{ asset('caremed/images/home_background_1.jpg') }})"></div>
					<div class="home_content">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content_inner">
										<div class="home_title"><h1>Medicine made with care</h1></div>
										<div class="home_text">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus velit ullamcorper id. Quisque at erat eu.</p>
										</div>
										<div class="button home_button">
											<a href="#">read more</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url({{ asset('caremed/images/home_background_1.jpg') }})"></div>
					<div class="home_content">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_content_inner">
										<div class="home_title"><h1>Medicine made with care</h1></div>
										<div class="home_text">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus vestibulum mauris quis aliquam. Integer accumsan sodales odio, id tempus velit ullamcorper id. Quisque at erat eu.</p>
										</div>
										<div class="button home_button">
											<a href="#">read more</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> --}}

			</div>

			<!-- Slider Progress -->
			<div class="home_slider_progress"></div>
		</div>
	</div>

	<!-- 3 Boxes -->

	<div class="boxes">
		<div class="container">
            {!! $bodyOne !!}
		</div>
	</div>

	<!--A great medical team to help your needs About -->

	<div class="about">
		<div class="container">
            {!! $bodyTwo->html_text !!}
		</div>
	</div>

	<!--Our Medical Departments -->

	<div class="departments">
        {{-- {{ dump($dynamictbl) }} --}}
        {!! isset($dynamictbl->where('textType', 6)->first()->html_text)?(HTML::decode($dynamictbl->where('textType', 6)->first()->html_text)) : '' !!}
	</div>

	<!--Our featured Services -->

	<div class="services">
		<div class="container">
            {!! isset($dynamictbl->where('textType', 7)->first()->html_text)?(HTML::decode($dynamictbl->where('textType', 7)->first()->html_text)) : '' !!}
		</div>
	</div>

	<!-- Call to action Need a personal health plan? -->

	<div class="cta">
            {!! isset($dynamictbl->where('textType', 8)->first()->html_text)?(HTML::decode($dynamictbl->where('textType', 8)->first()->html_text)) : '' !!}
	</div>

@endsection
@section('footescripts')
@endsection