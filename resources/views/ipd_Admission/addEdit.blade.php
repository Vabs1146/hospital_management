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

    .canvas {
        position: relative;
        width: 150px;
        height: 200px;
        background-color: #7a7a7a;
        margin: 70px auto 20px auto;
    }
</style>

<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<!-- Styles -->


<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">

<style>
    /*
        * drawingboards styles: set the board dimensions you want with CSS
        */

    .board {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }

</style>

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
          <form action="{{ url('/dynamicForm/'.$form_master->id.'/'.$patientRegister->id.'') }}" method="POST" class="form-horizontal" id="form_{{$patientRegister->id}}"
                enctype='multipart/form-data'>

            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif
         {{ Form::hidden('register_id', $patientRegister->id ) }}
          <div class="header bg-pink">
          <h2>Admission Paper</h2>
          </div>
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('name','Patient Name') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('name', Request::old('name',$patientRegister->name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('uhid_no','UHID no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('uhid_no', Request::old('uhid_no',$patientRegister->uhid_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('ipd_no','IPD no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('ipd_no', Request::old('ipd_no',$patientRegister->ipd_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="address" class="control-label">Address</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                           {{ Form::textarea('address', Request::old('address',$patientRegister->address), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>
                            </div>
                                 
                                 <!-- One row start -->
                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('mobile_no','Mobile no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('mobile_no', Request::old('mobile_no',$patientRegister->mobile_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('phone_no','Phone no.') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('phone_no', Request::old('phone_no',$patientRegister->phone_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                            </div>



                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('gender','Sex') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              {{ Form::select('gender', array(''=>'Please select') + ['Male'=>'Male','Female'=>'Female'], Request::old('gender',$patientRegister->gender), array('class' => 'form-control select2',  'id'=>'gender','data-live-search'=>'true')) }}
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('age','Age') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('age', Request::old('age',$patientRegister->age), array('class'=>'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('weight','Wt') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('weight', Request::old('weight',$patientRegister->weight), array('class'=>'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('registration_date','Date of Registration') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('registration_date', Request::old('registration_date',$patientRegister->registration_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>
                            </div>
                  
                               <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('registration_time','Time of Registration') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('registration_time', Request::old('registration_time',$patientRegister->registration_time), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('discharge_date','Date of Discharge') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('discharge_date', Request::old('discharge_date',$patientRegister->discharge_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('discharge_time','Time of Discharge') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('discharge_time', Request::old('discharge_time',$patientRegister->discharge_time), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('presenting_complaint','Provisional Diagnosis/Major Complaint') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('presenting_complaint', Request::old('presenting_complaint',$patientRegister->presenting_complaint), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["Operation"].']','Operation') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["Operation"].']', $form_field_values->where('form_field_code', $field_name_id["Operation"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Operation"])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('field_data_singular['.$field_name_id["Anaesthesia"].']','Anaesthesia') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["Anaesthesia"].']', $form_field_values->where('form_field_code', $field_name_id["Anaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Anaesthesia"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             <label>Outcome = Discharged well/TRANSFERRED/WENT DAMA</label></div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                                 {{ Form::text('field_data_singular['.$field_name_id["outcome_wentDama"].']',                         $form_field_values->where('form_field_code', $field_name_id["outcome_wentDama"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["outcome_wentDama"])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              </div> 
                             </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            <label>ON </label> 
                            </div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                                  {{ Form::text('field_data_singular['.$field_name_id["outcome_on"].']', $form_field_values->where('form_field_code', $field_name_id["outcome_on"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["outcome_on"])->first()->field_data, array('class'=> 'form-control')) }}                              </div>
                              </div> 
                             </div>

                            </div>
                       
                            <!-- End Of row -->
                            </div>    

                               <div class="row clearfix">
                                <div class="col-md-6 col-md-offset-4">
                                <div class="form-group">
                               <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit">
                                <i class="glyphicon glyphicon-plus btnicons"></i> Submit
                                </button>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/view/').'/'.$form_master->id.'/'.$patientRegister->id }}">
                                <i class="glyphicon glyphicon-chevron-left"></i> view</a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-chevron-left"></i> print</a>   
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
