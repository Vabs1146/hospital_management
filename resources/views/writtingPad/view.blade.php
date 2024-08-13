@extends('layouts/app') 
 
@section('style')
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
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
 
@endsection
 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Written Notes</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/writingCasePaper/view').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/writingCasePaper/view').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>

    <div class="row">
        <a class="btn btn-default" href="{{ url('/writingCasePaper/print').'/'.$casedata['id'] }}" target="_blank">Print</a>
        <a class="btn btn-default" href="{{ url('/writingCasePaper').'/'.$casedata['id']. '/edit' }}" >Edit</a>
        <a class="btn btn-default" href="{{ url('/writingCasePaper') }}">Back</a>
        <a class="btn btn-info" href="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
    </div>
    <div class="">
        &nbsp;
    </div>
</div>



{{--  {{ Form::text('Complaints', Request::old('Complaints',$form_details->Complaints), array('class'=> 'form-control autocompleteTxt')) }}  --}}
<div class="panel panel-default">
    <div class="panel-heading"  data-toggle="collapse"  data-target="#collapseOne" >
        Written Notes | Case Number : {{ $casedata['case_number'] }}  | {{ 'Time :' . $casedata['visit_time']}}</div>
    <div class="panel-body" id="collapseOne">
        <div class="container-fluid">
                
            <div class="row">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
            </div>

            <div class="form-group">
                <div class="col-md-6">{{ Form::label('patient_name', 'Patient Name :') }} {{$casedata['patient_name']}}</div>
                <div class="col-md-6">{{ Form::label('patient_age', 'Patient age :') }} {{$casedata['patient_age']}}</div>
            </div>
            <div class="form-group">
                <div class="col-md-6">{{ Form::label('patient_address', 'Patient Address :') }} {{$casedata['patient_address']}}</div>
                <div class="col-md-6">{{ Form::label('male_female', 'Gender :') }} {{$casedata['male_female']}}</div>
            </div>
            <div class="form-group">
                <div class="col-md-6">{{ Form::label('doctor_name', 'Doctor :') }} {{$casedata['doctor_name']}}</div>
                <div class="col-md-6">{{ Form::label('appointment_dt', 'Date :') }} {{ is_null($casedata['appointment_dt'])? Carbon\Carbon::today()->format('d/M/Y') :$casedata['appointment_dt'] }}
                        {{-- Carbon\Carbon::createFromFormat('d/M/Y', Carbon\Carbon::today())->toDateTimeString() --}}
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <img src="{{ $form_details['image_data'] }}" class="img-rounded" alt="letter head top" width="100%" />
                </div>
            </div>
            
            <br/>
            
            <div class="form-group">
                <div class="col-md-6">
                    _______________________
                </div>
                <div class="col-md-6 pull-right">
                    _______________________
                </div>
                <div class="col-md-6">
                    Signature
                </div>
                <div class="col-md-6 pull-right">
                    Signature
                </div>
                <div class="col-md-6">
                    {{ $casedata['patient_name'] }}
                </div>
                <div class="col-md-6 pull-right">
                    {{ config('app.name', 'Dr') }}
                </div>
            </div>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
</div>
 
 
 
@endsection
@section('scripts')
@endsection