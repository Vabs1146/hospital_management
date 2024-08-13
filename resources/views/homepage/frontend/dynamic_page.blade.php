@extends(env('layoutTemplate'))
@section('title', $title )
@section('pagebody')
@if($dynamicText->image)
<section class="pt-breadcrumb" style="background: url('/gallery_image/{{$dynamicText->image}}');">
@else 
<section class="pt-breadcrumb" style="background: url('assets/img/conatcbg.jpg');">
@endif
   <div class="pt-bg-overley pt-opacity4" ></div>
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h1 class="pt-breadcrumb-title"> {{ $dynamicText->name }}</h1>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page">  {{ $dynamicText->name }}</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </section>
   
      <article>
        <div class="section background-white"> 
          <div class="line">
            <div class="margin text-center">
                {!! $dynamicText->html_text !!}
            </div>
          </div> 
        </div> 
      </article>
@endsection
@section('footescripts')
@endsection