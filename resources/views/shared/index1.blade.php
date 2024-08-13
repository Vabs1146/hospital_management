@extends(env('layoutTemplate'))
@section('pagebody')
      <!-- Main Carousel -->
      <section class="section background-dark">
        <div class="line">
          <div class="carousel-fade-transition owl-carousel carousel-main carousel-nav-white carousel-wide-arrows">
              @if(isset($imageGallery))
              @foreach($imageGallery as $imgGal)
                <div class="item">
                  <div class="s-12 center">
                    <img src="{{ Storage::disk('local')->url($imgGal->imgUrl) }}" alt="">
                    <div class="carousel-content">
                      <div class="padding-2x">
                        <div class="s-12 m-12 l-8">
                          <p class="text-white text-s-size-20 text-m-size-40 text-l-size-60 margin-bottom-40 text-thin text-line-height-1">
                            {{ $imgGal->Name  }}
                          </p>
                          <p class="text-white text-size-16 margin-bottom-40">
                            {{ $imgGal->Description }}
                          </p>  
                        </div>                  
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              @endif
          </div>  
        </div>
      </section>
      
      <!-- Section 1 -->
      <section class="section background-white"> 
        <div class="line">
          <div class="margin">
              {!! $bodyOne !!}
          </div>
        </div>
      </section>
      
      <!-- Section 2 -->
      <section class="section background-primary text-center">
        <div class="line">
          <div class="s-12 m-10 l-8 center">
            <h2 class="headline text-thin text-s-size-30">{{ $bodyTwo->name }}</h2>
            <p class="text-size-20"> {{ $bodyTwo->description }} </p>
          </div>
        </div>  
      </section>
      
      <!-- Section 3 -->
      <section class="section background-white">
        <div class="full-width text-center">
          <div class="line">
              {!! $bodyTwo->html_text !!}
          </div>  
        </div>  
      </section>
      <hr class="break margin-top-bottom-0">
@endsection
@section('footescripts')
@endsection