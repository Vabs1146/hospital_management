@extends(env('layoutTemplate'))
@section('title', $title )
@section('pagebody')
          <!-- Content -->
      <article>
        <header class="section background-primary text-center">
            <h1 class="text-white margin-bottom-0 text-size-50 text-thin text-line-height-1"> {{ $dynamicText->name }} </h1>
        </header>
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