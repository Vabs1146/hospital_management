@extends('adminlayouts.master')
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }
</style>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
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
             
         <form class="form-horizontal" method="post" action="{{ route('save-feedback')}}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="header bg-pink">
              <h2>ADD Certificates</h2>
              </div>
              <div class="body">
                  <div class="row clearfix ">
                      <div class="col-md-12">
                          <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('gallery_name', 'Name :') }}
                            </div>
                          </div>

                           <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                              <input type="text" class="form-control" id="gallery_name" placeholder="Name here" name="gallery_name" required>                           
                            </div>
                            </div>
                          </div>  
                      </div>

                      <div class="col-md-12">
                          <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Photo :</label>
                              </div>
                          </div>
                      
                          <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="file" class="custom-file-input" id="filenames1" name="filenames1"  required>                       
                              </div>
                              </div>
                          </div>
                      </div>

					  <div class="col-md-12">
                          <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('feedback', 'Feedback :') }}
                            </div>
                          </div>

                           <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                              <!-- <input type="text" class="form-control" id="message" placeholder="Feedback" name="message" required>    -->  
							  
							  <textarea class="form-control" id="message" placeholder="Feedback" name="message" required></textarea>
                            </div>
                            </div>
                          </div>  
                      </div>
                            

                  </div>    

                  <div class="row clearfix">
                      <div class="col-md-8 col-md-offset-2" >
                         
                         <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                           </div>
                      
                               
                  </div>
                </div>
                </form>
                </div>
                </div>
                </div>
               </div>
  @endsection

