@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add/Edit Discharge Details</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Discharge11
    </div>

    <div class="panel-body">
       <div class="container-fluid">         
            <form action="{{ url('/discharge'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($case_master))
                    <input type="hidden" name="_method" value="PATCH">
                @endif

                <div class="form-group">
                    @include('shared.error') 
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                </div>
                <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
                <div class="form-group">
                    <label for="case_number" class="control-label">Case Number</label>
                    <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">
                </div>
                <div class="form-group">
                    <label for="patient_name" class="control-label">Name Of Patient</label>
                    <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
                </div>
                <div class="form-group">
                    <label for="name_of_age" class="control-label">Age</label>
                    <input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}">
                </div>
                <div class="form-group"> 
                        <label for="male_female" class="control-label">Sex</label>
                    <div class="checkbox">
                        <label><input type="radio" name="male_female" id="male_female" value="Male" required  {{ ($case_master->male_female == "Male")? "checked=\"checked\"" : "" }}  /> Male </label>
                        <label><input type="radio" name="male_female" id="male_female" value="Female" required   {{ ($case_master->male_female == "Female")? "checked=\"checked\"" : "" }}/> Female </label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('patient_address','Address') }} 
                    {{ Form::text('patient_address', Request::old('patient_address',$case_master->patient_address), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('IPD_no','IPD no.') }} 
                    {{ Form::text('IPD_no', Request::old('IPD_no',$discharge->IPD_no), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('date_admission','Date of Admission') }} 
                    {{ Form::text('date_admission', Request::old('date_admission',$discharge->date_admission), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('date_surgery','Date of Surgery') }} 
                    {{ Form::text('date_surgery', Request::old('date_surgery',$discharge->date_surgery), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('date_discharge','Date of Discharge') }} 
                    {{ Form::text('date_discharge', Request::old('date_discharge',$discharge->date_discharge), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('discharge_time','Discharge Time') }} 
                    {{ Form::text('discharge_time', Request::old('discharge_time',$discharge->discharge_time), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('diagnosis','Diagnosis') }} 
                    {{ Form::text('diagnosis', Request::old('diagnosis',$discharge->diagnosis), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('surgery','Surgery') }} 
                    {{ Form::text('surgery', Request::old('surgery',$discharge->surgery), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('brief_history','Brief History') }} 
                    {{ Form::text('brief_history', Request::old('brief_history',$discharge->brief_history), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('treatment_advised','Treatment Advised') }} 
                    {{ Form::text('treatment_advised', Request::old('treatment_advised',$discharge->treatment_advised), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('investigation','Investigation') }} 
                    {{ Form::text('investigation', Request::old('investigation',$discharge->investigation), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('followup','Followup') }} 
                    {{ Form::text('followup', Request::old('followup',$discharge->followup), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}
                </div>
               
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success" value="submit" >
                        <i class="fa fa-plus"></i> Submit
                    </button>
                    <a class="btn btn-default" href="{{ url('/discharge') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <a class="btn btn-default" href="{{ url('/discharge/print').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>
                    <a class="btn btn-default" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });   
        $('.datetimepicker').datetimepicker({
           format: 'LT'
        }); 
    });
</script>
@endsection