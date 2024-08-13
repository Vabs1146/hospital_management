@extends('adminlayouts.master')
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
           <form action="{{ url('/followupappointment/'.$model['id'].'/AcceptDeny') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Followup Appointment</h2>
          </div>
              {{ Form::hidden('id', Request::old('id', $model['id']), array('class'=> 'form-control')) }}
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Name :</label>
                              </div>
                              </div>

                              
                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('name', $model['patient_name'], array('class' => 'form-control', 'readonly')) }}                           
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Email :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::email('email', $model['patient_emailId'], array('class' => 'form-control', 'readonly')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Mobile :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('mobile_no', $model['patient_mobile'], array('class' => 'form-control', 'readonly')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Date :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('appointment_dt', $model['FollowUpDate'], array('class' => 'form-control', 'readonly')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Time :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="" value="{{$model['FollowUpTimeSlot']}}" class="form-control" readonly="">                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Doctor :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                             {{ Form::select('doctor_id_sel',array(''=>'Please select') + $model['doctorlist']->toArray(), $model['doctor_id'], array('class' => 'form-control', 'disabled'=>'disabled')) }}
                             {{Form::hidden('doctor_id',Request::old('doctor_id',$model['doctor_id']), array('class'=> 'form-control')) }}  
                              </div>
                              </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Subject :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('appointment_subject', $model['complaint'], array('class' => 'form-control', 'readonly')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> comments :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('AcceptDenyComment', Request::old('AcceptDenyComment'), array('class' => 'form-control')) }}                            
                              </div>
                              </div>
                              </div>
                          </div>                 
                  </div>    

                                <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-4">
                                <div class="form-group">
                                 <!--{{ Form::submit('Accept Appointment', array('class' => 'btn btn-primary btn-lg', 'value' => 'Accept_Appointment', 'name' => 'Accept_Appointment')) }} &nbsp;-->
                                 {{ Form::submit('Deny Appointment', array('class' => 'btn btn-primary btn-lg', 'value' => 'Deny_Appointment', 'name' => 'Deny_Appointment')) }} &nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('followupappoinment/0') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>     
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
  