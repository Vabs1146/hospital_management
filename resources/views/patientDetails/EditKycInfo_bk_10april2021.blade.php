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
                <form action="{{ url('/patientDetails/EditKYC' ) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="header bg-pink">
                        <h2>Patient Info</h2>
                    </div>
                    <div class="form-group">
                    </div>
                    <div class="body">
                        <div class="row clearfix ">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Doctor :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::hidden('doctor_id', $case_details->doctor_id) }}
                                    {{ Form::select('doctor_id_dd', array(''=>'Please select') + $doctorlist->toArray(), Request::old('case_details.doctor_id', $case_details->doctor_id), array('class' => 'form-control', 'required', 'readonly', 'disabled')) }}
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Case Number :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('case_number', Request::old('case_number', $case_details->case_number), array('class' => 'form-control', 'readonly')) }}
                                            {{ Form::hidden('case_id', $case_details->id) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Patient Name :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="patient_name" id="patient_name" class="form-control" required value="{{ $case_details->patient_name or ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Address :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_address', Request::old('patient_address', $case_details->patient_address), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Email Id :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_emailId', Request::old('patient_emailId', $case_details->patient_emailId), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_age', Request::old('patient_age', $case_details->patient_age), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Mobile No :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_mobile', Request::old('patient_mobile', $case_details->patient_mobile), array('class' => 'form-control', 'required')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Gender :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="demo-radio-button" style="padding-top: 6px">
                                            <input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_details->male_female == "Male")? "checked=\"checked\"" : "" }}  />
                                            <label for="radio_8">Male</label>
                                            <input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple"value="Female" required   {{ ($case_details->male_female == "Female")? "checked=\"checked\"" : "" }} />
                                            <label for="radio_10">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Blood Pressure :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('blood_pressure', Request::old('blood_pressure', $case_details->blood_pressure), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Patient Weight :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_weight', Request::old('patient_weight', $case_details->patient_weight), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="infection" class="form-control">Infection</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('infection', Request::old('infection', $case_details->infection), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Miscellaneous History :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('miscellaneous_history', Request::old('miscellaneous_history', $case_details->miscellaneous_history), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Patient Height :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_height', Request::old('patient_height', $case_details->patient_height), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Refered By :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('referedby', Request::old('referedby',$case_details->referedby), array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Submit
                                    </button>
                                    <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
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

