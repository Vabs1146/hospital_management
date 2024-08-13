@extends('shared/layoutProspera')
@section('pageheader')
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{url('/')}}/Boostrap3.7/bootstrap.min.css">
  <script src="{{url('/')}}/Boostrap3.7/jquery.min.js"></script>
  <script src="{{url('/')}}/Boostrap3.7/bootstrap.min.js"></script>
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
 <div class="container">
<br/>
<br/>
    <div class="photogallery pt-50 pb-50">
      <div class="container">
          @php
          $i;
          @endphp
          @foreach($main_gallery_image as $main_gallery)
          <div class="col-md-3" style="padding: 5px;">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#imageModal{{ $main_gallery->main_id }}"><img src="{{ url('/')}}/gallery_image/{{ $main_gallery->filenames1}}" width="100%" alt="" style="height: 194px;"></a><br><br> 
            <p class="text-center">{{ $main_gallery->gallery_name }}</p>
          </div>
            
           
           <div id="imageModal{{ $main_gallery->main_id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                   

                  <!-- Modal content-->
                  <div class="modal-content">
                    <!--<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Modal Header1</h4>
                    </div>-->
                    <div class="modal-body" id="showimages">
                          <div class="modal-header">
                  
                    <button type="button" class="close text-danger" data-dismiss="modal"><span style="margin-right: -21px;">x</span>
                    </button>
                </div>
                      <!--start-->
                      <div id="myCarousel{{ $main_gallery->main_id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          @php
                           
                          $i[$main_gallery->main_id] = array();
                          @endphp
                           
                         @foreach($photo_gallery as $photo)
                          @if($main_gallery->main_id==$photo->main_id)
                           @php
                           
                          array_push($i[$main_gallery->main_id],$photo->filenames);
                          @endphp
                        @endif
                        @endforeach
                   
                     
                        @foreach($i[$main_gallery->main_id] as $photos)
                          
                          
                          <div class="item @if ($loop->first) active @endif">
                            <img src="{{ url('/')}}/gallery_image/{{ $photos}}" width="600px" >
                          </div>
                          
                          
                        @endforeach
                        </div>             
                        <a class="left carousel-control" href="#myCarousel{{ $main_gallery->main_id }}" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel{{ $main_gallery->main_id }}" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                      <!--end-->
                    </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            
          @endforeach

      </div>
    </div>
<br/>
<br/>
</div>
<br/>
<br/>
</div>
      
@endsection
@section('footescripts')
@endsection