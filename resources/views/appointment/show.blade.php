@extends('adminlayouts.master')
@section('content')
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @if(Session::has('flash_message'))
               <div class="alert alert-success">
                {{ Session::get('flash_message') }}
               </div>
                @endif
          <div class="card">

          <div class="header bg-pink">
          <h2>Deny Appointment </h2>
          </div>

           <form action="{{ url('/appointment/'.$model['id'].'/AcceptDeny') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        
        {{ Form::hidden('id', Request::old('id', $model['id']), array('class'=> 'form-control')) }}
              <div class="body">
                  <div class="row clearfix">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('name', 'Name :', array('class' => 'control-label')) }}
                              </div>
                              </div>

                              
                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('name', $model['name'], array('class' => 'form-control', 'readonly')) }}                         
                              </div>
                              </div>
                              </div>  


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('email', 'Email :', array('class' => 'control-label')) }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::email('email', $model['email'], array('class' => 'form-control', 'readonly')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('mobile_no','Mobile :', array('class' => 'control-label')) }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('mobile_no', $model['mobile_no'], array('class' => 'form-control', 'readonly')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('appointment_dt','Date :', array('class' => ' control-label')) }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('appointment_dt', $model['appointment_dt'], array('class' => 'form-control', 'readonly')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('appointment_timeslot_sel', 'Time :', array('class' => 'control-label')) }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="morningEvening" value="{{$model['morningEvening']}}" class="form-control" readonly="">                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('doctor_id_sel','Doctor :', array('class' => ' control-label')) }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('doctor_id_sel',array(''=>'Please select') + $model['doctorlist']->toArray(), $model['doctor_id'], array('class' => 'form-control', 'disabled'=>'disabled')) }}
            {{ Form::hidden('doctor_id',Request::old('doctor_id',$model['doctor_id']), array('class'=> 'form-control')) }}
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('appointment_subject','Subject :', array('class' => ' control-label')) }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('appointment_subject', $model['appointment_subject'], array('class' => 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('AcceptDenyComment','Comments :', array('class' => ' control-label')) }}
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
                                <div class="col-md-12 ">
                                <div class="form-group">
                                <div class="col-md-6 col-md-offset-2">
								 @if($permissions['1_appointmentlist/0']->edit_permission || AUTH::user()->role == 1)
                                {{ Form::submit('Deny Appointment', array('class' => 'btn btn-primary btn-lg', 'value' => 'Deny_Appointment', 'name' => 'Deny_Appointment')) }} &nbsp;
								@endif
                                <a class="btn btn-default btn-lg" href="{{ url('/appointmentlist/0') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                </div>
                                      
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
  
 