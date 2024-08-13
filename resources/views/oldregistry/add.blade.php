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
                  @include('shared.error')
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  {{ Session::get('flash_message') }}
                  </div>
                  @endif
                
    <div class="card">
         <form action="{{ url('/oldregister'.( empty($old_register->id) ? "/0" : ("/" . $old_register['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (!empty($old_register->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif

          <div class="header bg-pink">
          <h2>Add/Edit old register </h2>
          </div>
             
               <input type="hidden" id="id" name="id" value="{{ $old_register['id'] or ''}}" >

              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">IPD No :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="ipd_no" id="ipd_no" class="form-control" autocomplete="off" value="{{ $old_register['ipd_no'] or ''}}">                            
                              </div>
                              </div>
                              </div>    


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Name Of Patient :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             <input type="text" name="patient_name" id="patient_name" autocomplete="off" class="form-control" value="{{ $old_register['patient_name'] or ''}}">                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Patient Address :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_address" id="patient_address" autocomplete="off" class="form-control"  value="{{ $old_register['patient_address'] or ''}}">                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Date of Admission :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('date_of_admission', Request::old('date_of_admission',$old_register->date_of_admission), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Date of Discharge :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('date_of_discharge', Request::old('date_of_discharge',$old_register->date_of_discharge), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Mobile no :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('mobile_no', Request::old('mobile_no',$old_register->mobile_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                            
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Consulting Doctor :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('consulting_doctor', array(''=>'Please select') + $doctorlist->toArray(), Request::old('consulting_doctor',$old_register->consulting_doctor), array('class' => 'form-control select2',  'id'=>'consulting_doctor','data-live-search'=>'true')) }}
                              </div>

                           
                          </div>
                           
                           
                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                                  <i class="glyphicon glyphicon-plus btnicons"></i>Submit
                                 </button> 
                                <a class="btn btn-default btn-lg" href="{{ url('/oldregister') }}" ><i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                <a class="btn btn-default btn-lg" href="{{ route('case_masters.index') }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
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
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection  
