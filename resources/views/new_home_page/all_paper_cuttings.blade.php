{{-- @extends(env('layoutTemplate')) --}}
@extends('shared.layoutProspera_no_head_foot')
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
		  <div class="row">
          @foreach($all_paper_cttings as $all_paper_cttings_row)

		  @php
			$all_images = explode(',', $all_paper_cttings_row->img_url);
		  @endphp
          <div class="col-md-3" style="padding: 5px;">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#imageModal{{ $all_paper_cttings_row->id }}"><img src="{{ Storage::disk('local')->url( $all_images[0]) }}" width="100%" alt="" style="height: 194px;"></a><br><br> 
            <p class="text-center">{{ $all_paper_cttings_row->title }}</p>
          </div>
            
           
           <div id="imageModal{{ $all_paper_cttings_row->id }}" class="modal fade" role="dialog">
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
                      <div id="myCarousel{{ $all_paper_cttings_row->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                                            
                     
                        @foreach($all_images as $key => $all_images_row)
                          
                          
                          <div class="item @if ($key == 0) active @endif">
                            <img src="{{ Storage::disk('local')->url( $all_images_row) }}" width="600px" >
                          </div>
                          
                          
                        @endforeach
                        </div>             
                        <a class="left carousel-control" href="#myCarousel{{ $all_paper_cttings_row->id }}" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel{{ $all_paper_cttings_row->id }}" data-slide="next">
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