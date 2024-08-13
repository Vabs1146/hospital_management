@extends('layouts/app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Follow Up Detail111</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="clo-lg-12"> 
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        View Appointment
    </div>

    <div class="panel-body">
        <form action="{{ url('/appointment/'.$model['id'].'/AcceptDeny') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            @include('shared.error') 
            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
        </div>
  
        {{ Form::hidden('id', Request::old('id', $model['id']), array('class'=> 'form-control')) }}
        <div class="form-group">
            {{ Form::label('name', 'Name', array('class' => 'col-sm-3 control-label')) }}
             <div class="col-sm-6">
                {{ Form::text('name', $model['patient_name'], array('class' => 'form-control', 'readonly')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-6">
            {{ Form::email('email', $model['patient_emailId'], array('class' => 'form-control', 'readonly')) }}</div>
        </div>
        <div class="form-group">
            {{ Form::label('mobile_no','Mobile', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-6">
            {{ Form::text('mobile_no', $model['patient_mobile'], array('class' => 'form-control', 'readonly')) }}</div>
        </div>
        <div class="form-group">
            {{ Form::label('appointment_dt','Date', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-6">
            {{ Form::text('appointment_dt', $model['FollowUpDate'], array('class' => 'form-control', 'readonly')) }}</div>
            {{-- {{Form::date('appointment_dt', \Carbon\Carbon::now(), array('class' => 'form-control', 'readonly'))}} --}}
        </div>
        <div class="form-group">
             {{ Form::label('appointment_timeslot_sel', 'Time', array('class' => 'col-sm-3 control-label')) }} 
            <div class="col-sm-6">
         
             <input type="text" name="" value="{{$model['FollowUpTimeSlot']}}" class="form-control" readonly="">
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('doctor_id_sel','Doctor', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-6">
            {{ Form::select('doctor_id_sel',array(''=>'Please select') + $model['doctorlist']->toArray(), $model['doctor_id'], array('class' => 'form-control', 'disabled'=>'disabled')) }}
            {{ Form::hidden('doctor_id',Request::old('doctor_id',$model['doctor_id']), array('class'=> 'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('appointment_subject','Subject', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-6">
            {{ Form::text('appointment_subject', $model['complaint'], array('class' => 'form-control', 'readonly')) }}</div>
        </div>
        <div class="form-group">
            {{ Form::label('AcceptDenyComment','comments', array('class' => 'col-sm-3 control-label')) }}
            <div class="col-sm-6">
            {{ Form::text('AcceptDenyComment', Request::old('AcceptDenyComment'), array('class' => 'form-control')) }}</div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                {{ Form::submit('Accept Appointment', array('class' => 'btn btn-primary', 'value' => 'Accept_Appointment', 'name' => 'Accept_Appointment')) }} &nbsp;
                {{ Form::submit('Deny Appointment', array('class' => 'btn btn-primary', 'value' => 'Deny_Appointment', 'name' => 'Deny_Appointment')) }} &nbsp;
                <a class="btn btn-default" href="{{ url('/appointmentlist') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>
        </form>
    </div>
</div>


@endsection