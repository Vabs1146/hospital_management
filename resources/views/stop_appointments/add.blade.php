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
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
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
          <form action="{{ url('/stop_appointments'.( !empty($model['id']) ? "/" . $model['id'] : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (!empty($model['id']))
                <input type="hidden" name="_method" value="PATCH">
            @endif
          <div class="header bg-pink">
          <h2>Patient Info </h2>
          </div>
         
              <div class="body">
                  <div class="row clearfix ">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Id :</label>
                              </div>
                              </div>

                             <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">                        
                              </div>
                              </div>
                              </div>    


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Stop Level :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('stop_level',array(''=>'Please select') + $model['stop_levelLst'], Request::old('stop_level', $model['stop_level']), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Date :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="date" name="date" id="date" class="form-control" value="{{$model['date'] or ''}}">                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Doctor :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                                
                               {{ Form::select('DoctorId',array(''=>'Please select') + $model['doctorlst']->toArray(), Request::old('DoctorId', $model['DoctorId']), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div> 

                          </div>


                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Time Slot :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('TimeSlotId',   array(''=>'Please select') + $model['timeslotlst']->toArray(), Request::old('TimeSlotId', $model['TimeSlotId']), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Description :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="description" id="description" class="form-control" value="{{$model['description'] or ''}}">                          
                              </div>
                              </div>
                              </div>

                          </div>    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
								@if($permissions['1_stop_appointments']->edit_permission || AUTH::user()->role == 1)
                                 <button type="submit" class="btn btn-success btn-lg">
                                 <i class="glyphicon glyphicon-plus btnicons"></i> Save
                                 </button>
								 @endif
                                <a class="btn btn-success btn-lg" href="{{ url('/stop_appointments') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
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