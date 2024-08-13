@extends('adminlayouts.master')
@section('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>    
@endsection
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  @include('shared.error')
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  {{ Session::get('flash_message') }}
                  </div>
                  @endif
          <div class="card">
          <form action="{{ url('/ApproveRejectRating') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Approve Reject Rating </h2>
          </div>
              
              <div class="body">
                {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                  <div class="row clearfix ">
                         <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Provide Feedback :</label>
                              </div>
                              </div>

                              <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              <textarea type="text" class="form-control" id="feedback" name="feedback" placeholder="Feedback" required> {{$rating->feedback}} </textarea>                           
                              </div>
                              </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Give a rating for Skill:</label>
                              </div>
                              </div>


                              <div class="col-md-8">
                              <div class="form-group">
                              <div class="form">
                              <input id="ratingscore" name="ratingscore" class="rating rating-loading" data-min="0" data-max="5"
                              data-step="1" value="{{$rating->ratingscore}}">                             
                              </div>
                              </div>
                              </div>

                              <input type="hidden" name="id" value="{{$rating->id}}">
                          </div>


                           <div class="col-md-12">
                              
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"></label>
                              </div>
                              </div>
                                
                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="demo-radio-button" style="padding-top: 6px">
                              <input id="radio_8" name="isActive" type="checkbox" value="{{ $rating->isActive }}" @if($rating->isActive) checked=checked @endif> 
                              <label for="radio_8">isActive</label>
                              </div>
                              </div>
                              </div>
                          </div>
                                        
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                             <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Submit</button> &nbsp;
                            <a class="btn btn-default btn-lg" href="{{ url('/rating/list') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>        
                                </div>
                                </div>
                               
                            </div>
                </div>
           </form>
            </div>
        </div>
</div>
</div>


        @endsection
  @section('scripts')
    <script type="text/javascript">
    
    $(document).ready(function(){

    });
</script>
@endsection