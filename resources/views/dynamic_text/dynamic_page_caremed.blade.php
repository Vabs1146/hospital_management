@extends('shared/layoutCaremed')
@section('pageheader')
<link rel="stylesheet" type="text/css" href="{{asset('caremed/styles/about.css')}}"">
<link rel="stylesheet" type="text/css" href="{{asset('caremed/styles/about_responsive.css')}}">
@endsection
@section('pagebody')
<div class="super_container">
    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll"
            data-image-src="{{ asset('caremed/images/about.jpg')}}" data-speed="0.8"></div>
        <div class="home_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title">{{ $dynamicText->name }} <span></span></div>
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="#">{{$dynamicText->description}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="container">
            {!! $dynamicText->html_text !!}
        </div>
    </div>

</div>
@endsection
@section('footescripts')
@endsection