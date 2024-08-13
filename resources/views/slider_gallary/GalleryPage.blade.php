@extends('shared/layoutProspera')
@section('pageheader')
    <link rel="stylesheet" href="{{ asset('owl-carousel/owl-gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <style>
        .well {
            width: 200px;
            display: inline-block;
        }
        .well img {
            display: block;
            width: 100%;
            margin: 0 auto;
        }
        a:active, a:focus, a:hover {
            text-decoration: none;
        }
        #gallery-slider .owl-item img {
            height: 95% !important;
        }
    </style>
@endsection
@section('pagebody')
<div class="container">
<br/>
<br/>
    <div style="text-align: center;">
            @foreach ($galleryData as $item)
                <a href="#" onclick="$(this).galleryShow(); return false;">
                    <div class="well">
                        <img src={{ Storage::disk('local')->url($item->imgUrl) }} alt="" title="Portfolio Image 1" style="widht:150px; height:150px;" />
                    </div>
                </a>
            @endforeach
        </div>
<br/>
<br/>
</div>
      <script src="{{ asset('owl-carousel/owl-gallery.js')}} "></script>
@endsection
@section('footescripts')
@endsection