@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        {{ Form::model($doctor, array('route' => array('doctor.update',  $doctor->id), 'method' => 'PATCH' )) }}
                         <div class="header bg-pink">
                            <h2>
                                Doctor
                            </h2>
                          
                        </div>
                         <div class="form-group">
                          @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                  </div>
                        <div class="body">
                              <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Name :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control')) }}                            
                              </div>
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Doctor Degree :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('doctorDegree', Request::old('doctorDegree'),array('class'=>'form-control')) }}                             
                              </div>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Mobile No :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::number('mobile_no', Request::old('mobile_no'),array('class'=>'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Patient Form :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                                  {{ Form::select('formViewName', $doctorFormView->toArray(), Request::old('formViewName'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>   

                              </div>
                              
                              <div class="col-md-12">
                                <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"></label>
                              </div>
                              </div>
                                <div class="col-md-4">
                                  <div class="demo-checkbox">
                                 {{ Form::checkbox('isActive', Request::old('isActive'),($doctor->isActive == 1),array('id'=>'basic_checkbox_2')) }}
                                <label for="basic_checkbox_2">Is Active</label>
                                  </div>
                                </div>
                              </div>
                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary waves-effect"><span>Update Doctor</span>
                                </button>
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ route('doctor.index') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
                            </div>

                            
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>


</div>

        @endsection
@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection  
  