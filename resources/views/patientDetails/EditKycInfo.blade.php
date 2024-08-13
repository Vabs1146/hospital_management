@extends('adminlayouts.master')
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">


<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }

    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .star {
        color: red;
    }

    .select2.select2-container.select2-container--default {
        width: 100% !important;
    }
</style>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
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
                <form action="{{ url('/patientDetails/EditKYC') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="header bg-pink">
                        <h2>Patient Info</h2>
                        <span id="balance_amount"
                            style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
                    </div>
                    <div class="body">
                        <div class="row clearfix ">
                            <!-- ====================================================================================================================================== -->
                            <div class="col-md-12">

                                @if($webcam_settings->value == '1')
                                    <div class="col-md-2" style="height: auto;text-align: center;">
                                        @if($case_details->patient_pic)
                                            <img id="patient_pic_view" name="patient_pic_view"
                                                alt="The screen capture will appear in this box."
                                                src="{{url('/')}}/uploads/{{$case_details->patient_pic}}"
                                                onerror="this.onerror=null;this.src='{{url('/')}}/images/user.jpeg';"
                                                style="width: 100%;">
                                        @else
                                            <img id="patient_pic_view" name="patient_pic_view"
                                                alt="The screen capture will appear in this box." src=""
                                                onerror="this.onerror=null;this.src='{{url('/')}}/images/user.jpeg';"
                                                style="width: 100%;">
                                        @endif
                                        <div style="margin-top: 10px;">
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#patientPictureModal">Capture Picture</button>
                                        </div>
                                        <input type="hidden" name="profile_picture" id="profile_picture">

                                    </div>
                                @endif
                                <div class="col-md-10">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <div class="form-group labelgrp">
                                                <label for="case_number" class="form-control">Doctor <b
                                                        class="star">*</b>:</label>
                                            </div>
                                        </div>

                                        @php
                                            $doctors_list = $doctorlist->toArray();
                                            //dd($doctors_list);
                                            $doc_key = key($doctors_list);
                                            $doc_name = $doctors_list[$doc_key];
                                        @endphp
                                        <div class="col-md-9" style="margin-left: 0px; padding-left: 0px;">
                                            @if(count($doctors_list) > 1)
                                                {{ Form::hidden('doctor_id', $case_details->doctor_id) }}
                                                {{ Form::select('doctor_id_dd', array('' => 'Please select') + $doctorlist->toArray(), Request::old('case_details.doctor_id', $case_details->doctor_id), array('class' => 'form-control', 'required', 'readonly', 'disabled')) }}
                                            @else
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input class="form-control" name="" value="{{$doc_name}}"
                                                            type="text" disabled>
                                                    </div>
                                                </div>
                                                <input class="form-control" name="doctor_id" value="{{$doc_key}}"
                                                    type="hidden">
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-12" id="old_new_related">
                                        <div class="col-md-3">
                                            <div class="form-group labelgrp">
                                                <label class="form-control">Case Number :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    {{ Form::text('case_number', Request::old('case_number', $case_details->case_number), array('class' => 'form-control', 'readonly')) }}
                                                    {{ Form::hidden('case_id', $case_details->id) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group labelgrp">
                                                <label class="form-control">UHID no :</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    {{ Form::text('uhid_no', Request::old('uhid_no', $case_details->uhid_no), array('class' => 'form-control', 'id' => 'uhid_no')) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="patient_name" class="form-control">Name <b class="star">*</b>
                                            :</label>
                                    </div>
                                </div>

                                <!--<div class="col-md-3">
		<div class="form-group">
			<div class="demo-radio-button" style="padding-top: 6px">
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_1" value="Mr." {{($case_details->mr_mrs_ms == "Mr.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_1" style="min-width: 50px;">Mr.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_2" value="Mrs." {{($case_details->mr_mrs_ms == "Mrs.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_2" style="min-width: 50px;">Mrs.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_3" value="Ms." {{($case_details->mr_mrs_ms == "Ms.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_3" style="min-width: 50px;">Ms.</label>
			</div>
		</div>
	</div>-->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_name', Request::old('patient_name', $case_details->patient_name), array('class' => 'form-control', 'required')) }}
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_middle_name', Request::old('patient_name', $case_details->middle_name), array('class' => 'form-control', 'placeholder' => 'Middle Name', 'id' => 'patient_middle_name')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_last_name', Request::old('patient_name', $case_details->last_name), array('class' => 'form-control', 'placeholder' => 'Surname', 'id' => 'patient_last_name')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Address <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_address', Request::old('patient_address', $case_details->patient_address), array('class' => 'form-control', 'placeholder' => 'Address')) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_area', Request::old('patient_area', $case_details->area), array('class' => 'form-control', 'placeholder' => 'Area')) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('city', Request::old('city', $case_details->city), array('class' => 'form-control', 'placeholder' => 'City')) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('district', Request::old('district', $case_details->district), array('class' => 'form-control', 'placeholder' => 'District')) }}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Gender <b class="star">*</b>:</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="demo-radio-button" style="padding-top: 6px">
                                        <input name="male_female" type="radio" id="radio_8"
                                            class=" with-gap radio-col-pink" value="Male" required {{ ($case_details->male_female == "Male") ? "checked=\"checked\"" : "" }} />
                                        <label for="radio_8">Male</label>

                                        <input name="male_female" type="radio" id="radio_10"
                                            class="with-gap radio-col-deep-purple" value="Female" required {{ ($case_details->male_female == "Female") ? "checked=\"checked\"" : "" }} />
                                        <label for="radio_10">Female</label>

                                        <input name="male_female" type="radio" id="radio_11"
                                            class="with-gap radio-col-deep-purple" value="Baby" required {{ ($case_details->male_female == "Baby") ? "checked=\"checked\"" : "" }} />
                                        <label for="radio_11">Baby</label>

                                        <input name="male_female" type="radio" id="radio_12"
                                            class="with-gap radio-col-deep-purple" value="Master" required {{ ($case_details->male_female == "Master") ? "checked=\"checked\"" : "" }} />
                                        <label for="radio_12">Master</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label for="dob" class="form-control"> Date of Birth :</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="form-line">
                                        <!-- <input value="{{$case_details->dob}}" type="date"
                                            class="datepicker form-control" id="dob" name="dob"
                                            placeholder="Select Date." data-date-format="yyyy-mm-dd"> -->
                                            <input type="date" class="form-control" id="dob"
												name="dob" placeholder="Select Date."
												data-date-format="dd-mm-yyyy"
												value="{{($case_details->dob) ? date('Y-m-d', strtotime($case_details->dob)) : ''}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group labelgrp">
                                    <label class="form-control"> Age (Years)</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('patient_age', Request::old('patient_age', $case_details->patient_age), array('id' => 'patient_age', 'class' => 'form-control', 'readonly')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Month</label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('admission_month', Request::old('admission_month', $case_details->admission_month), array('id' => 'admission_month', 'class' => 'form-control', 'readonly')) }}
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control"> Mobile No <b class="star">*</b>:</label>
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
                                    <label for="alternate_number" class="form-control"> Alternate No :</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('alternate_number', Request::old('alternate_number', $case_details->alternate_number), array('class' => 'form-control')) }}
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
                                    <label for="referedby" class="form-control">Refered by</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('referedby', Request::old('referedby', $case_details->referedby), array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-12" style="background: white;">
                            <div class="panel panel-primary">

                                <!-- <div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
	<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#other_details" aria-expanded="false" aria-controls="other_details">
	Other Details
	</a>
	</h4>
</div> -->
                                <div id="other_details" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingOne_1">
                                    <div class="panel-body">


                                        <!-- ======================================Start Panel =============================================== -->

                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Patient Weight :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('patient_weight', Request::old('patient_weight', $case_details->patient_weight), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Patient Height :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('patient_height', Request::old('patient_height', $case_details->patient_height), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Blood Pressure :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('blood_pressure', Request::old('blood_pressure', $case_details->blood_pressure), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Accompanied By :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('accompanied_by', Request::old('accompanied_by', $case_details->accompanied_by), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Occupation :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('occupation', Request::old('occupation', $case_details->occupation), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Daily Travel Time :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('daily_travel_time', Request::old('daily_travel_time', $case_details->daily_travel_time), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Screen Time :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('screen_time', Request::old('screen_time', $case_details->screen_time), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ============================================================================================================================== -->


                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label for="adhar_number" class="form-control">Adhar Number</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('adhar_number', $case_details->adhar_number, array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                    <label for="pan" class="form-control"> PAN :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('pan', Request::old('pan', $case_details->pan), array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12"> </div>


                                        <div class="col-md-12">







                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <div class="form-group labelgrp">
                                                        <label for="infection" class="form-control">Allergy</label>
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
                                            <!-- ================================================================================= -->
                                            <span class="dropdown-container">
                                                <div id="systemic_history" class="ContainerToAppend">
                                                    <div class="col-md-12">
                                                        <div class="col-md-2">
                                                            <div class="form-group labelgrp">
                                                                <label class="">Systemic History</label>
                                                            </div>
                                                            <input type="hidden" id="systemicHistory[]"
                                                                name="systemicHistory[]" class="hiddenCounter"
                                                                value="1" />
                                                        </div>

                                                        <div class="col-md-6">
                                                            {{ Form::select('SystemicHistory_OD[]', array(' ' => '-Select-') + $form_dropdowns->where('fieldName', 'systemic_history')->pluck('ddText', 'ddText')->toArray(), null, array('class' => 'form-control select2', 'data-live-search' => 'true')) }}

                                                        </div>



                                                        <div class="col-md-4">
                                                            <button type="button" name="add" id='chiefcomplaintbtn'
                                                                class="btn btn-success set-dropdown-options"
                                                                data-field_name="Chief Complaint OD"
                                                                data-form_name="commanForm">Set Option </button>

                                                            <button type='button' class="btn btn-primary"
                                                                id='chiefcomplaintbtnsave'>Save Option</button>

                                                            <button id="addChiefComplaint"
                                                                class="btn btn-default addmore"
                                                                data-templateDiv="ChiefComplaintTemplate">Add</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div id='ChiefTextBoxesGroup' class="col-md-12">

                                                </div>
                                            </span>
                                            <!-- ====================End panel========================== -->

                                            <div class="dbMultiEntryContainer">
                                                @foreach ($patients_systemic_history as $item)
                                                    <div class="col-md-12">
                                                        <div class="col-md-2"> </div>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" readonly
                                                                value="{{$item->value}}">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button class="removeDbItem btn btn-default"
                                                                data-deleteid="{{$item->id}}"
                                                                data-type="systemic_history">Remove</button>
                                                        </div>

                                                        <!-- <div class="col-md-12">
                                                            <div class="col-md-2"> </div>

                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" readonly value="{{$item->duration}}">
                                                            </div>

                                                            <div class="col-md-2">

                                                            </div>
                                                        </div> -->
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- ================================================================================= -->
                                            <!-- ================================================================================= -->
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i
                                            class="fa fa-plus"></i> Submit
                                    </button>
                                    <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i
                                            class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="patientPictureModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Capture Patient Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                    </div>
                    <div class="col-md-6">
                        <div id="results"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="button" value="Take Snapshot" onClick="take_snapshot()">
                    </div>
                    <div class="col-md-6">
                        <input type="button" id="approve" value="Approve" onClick="approve_snapshot()"
                            style="display:none;">
                    </div>
                </div>

                <input type="hidden" name="image-tag" id="image-tag" class="image-tag">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div id="templateContainner" style="display:none">
    <div id="ChiefComplaintTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="systemicHistory[]" name="systemicHistory[]" class="hiddenCounter" value="" />
            </div>
            <div class="col-md-6">
                {{ Form::select('SystemicHistory_OD[]', array(' ' => '-Select-') + $form_dropdowns->where('fieldName', 'systemic_history')->pluck('ddText', 'ddText')->toArray(), null, array('class' => 'form-control Dyselect2', 'data-live-search' => 'true')) }}

            </div>

            <div class="col-md-2">
                <button class="removeItem btn btn-default"
                    data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();

    });
</script>
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} "></script>
<script>
    jq = $.noConflict(true);
    //alert(jq);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>
<script>
    var url = "{{ url('/GetCaseIdByPatientNameMobile') }}";

    function getBalanceAmount(case_number) {
        $.ajax({
            url: "{{ url('/get-balance') }}",
            dataType: "json",
            data: {
                case_number: case_number,
            },
            success: function (data) {
                if (data.balance > 0) {
                    $('#balance_amount').html('Balance Amount : Rs.' + data.balance);
                } else {
                    $('#balance_amount').html('');
                }

            }
        });
    }

    jq(".autocompleteTxt").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "{{ url('/GetCaseIdByPatientNameMobile') }}",
                dataType: "json",
                data: {
                    query: request.term,
                    PropertyName: jq(this.element).attr('name'),//'Complaints' 
                    tableName: 'eyeform'
                },
                success: function (data) {
                    response(data);

                }
            });
        },
        select: function (event, ui) {
            getBalanceAmount(ui.item.value);
            jq("#case_number").val(ui.item.value);
            $('input[name="patient_name"]').val(ui.item.patient_name);
            if (ui.item.patient_pic) {
                $('#patient_pic_view').attr('src', "{{url('/') . '/uploads/'}}" + ui.item.patient_pic);
            } else {
                $('#patient_pic_view').attr('src', "{{url('/') . '/images/user.jpeg'}}");
            }

            $('input[name="alternate_number"]').val(ui.item.alternate_number);
            $('input[name="adhar_number"]').val(ui.item.adhar_number);
            $('input[name="pan"]').val(ui.item.pan);
            $('input[name="dob"]').val(ui.item.dob);

            $('input[name="patient_mobile"]').val(ui.item.patient_mobile);
            $('input[name="patient_address"]').val(ui.item.patient_address);
            $('input[name="patient_emailId"]').val(ui.item.patient_emailId);
            $('input[name="patient_age"]').val(ui.item.patient_age);
            $('input[name="uhid_no"]').val(ui.item.uhid_no);
            $('input[name="patient_weight"]').val(ui.item.patient_weight);
            $('input[name="patient_height"]').val(ui.item.patient_height);
            $('input[name="blood_pressure"]').val(ui.item.blood_pressure);
            $('input[name="infection"]').val(ui.item.infection);
            $('input[name="miscellaneous_history"]').val(ui.item.miscellaneous_history);
            $('input[name="male_female"][value=' + ui.item.male_female + ']').attr('checked', 'checked');
            $('input[name="doctor_fee"]').val(ui.item.billAmount);
            $('input[name="referedby"]').val(ui.item.referedby);
            $('input[name="payment_mode"]').val(ui.item.payment_mode);
            $("#doctor_id").append('<option value="' + ui.item.doctor_id + '" selected="">' + ui.item.doctor_name + '</option>');
            $("#doctor_id").selectpicker("refresh");

            return false; // Prevent the widget from inserting the value.
        }
    });
</script>

</script>

<script>
    /* JS comes here */
    (function () {

        var width = 320; // We will scale the photo width to this
        var height = 0; // This will be computed based on the input stream

        var streaming = false;

        var video = null;
        var canvas = null;
        var photo = null;
        var startbutton = null;

        function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');

            navigator.mediaDevices.getUserMedia({
                video: true,
                audio: false
            })
                .then(function (stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function (err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function (ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function (ev) {
                takepicture();
                ev.preventDefault();
            }, false);

            clearphoto();
        }


        function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            //photo.setAttribute('src', data);
        }

        function takepicture() {
            var context = canvas.getContext('2d');
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                var data = canvas.toDataURL('image/png');
                //photo.setAttribute('src', data);

                var profile_picture = document.getElementById('profile_picture');

                profile_picture.value = data;
            } else {
                clearphoto();
            }
        }
        window.addEventListener('load', startup, false);
    })();
</script>
@if($webcam_settings->value == '1')
    <!-- Webcam.min.js -->
    <script type="text/javascript" src="{{asset('assets/js/webcam.min.js')}}"></script>

    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90,
            constraints: {
                video: true,
                facingMode: "environment"
            }
        });
        Webcam.attach('#my_camera');

        <!-- Code to handle taking the snapshot and displaying it locally -->
        function take_snapshot() {

            // take snapshot and get image data
            Webcam.snap(function (data_uri) {
                // display results in page
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML =
                    '<img src="' + data_uri + '"/>';
                $('#approve').show();
            });
        }

        function approve_snapshot() {
            var img = $(".image-tag").val();
            if (img != "") {
                $('#profile_picture').val(img);
                $('#patient_pic_view').attr('src', img);

                document.getElementById('results').innerHTML = '';
                $('#approve').hide();
                $('#patientPictureModal').modal('hide');
            }
        }
    </script>
@endif
<!-- Chief Complaint Set Option -->
<script type="text/javascript">
    $(document).ready(function () {

        var counter = 1;

        $("#chiefcomplaintbtn").click(function () {

            if (counter > 10) {
                swal("Only 10 Options Values are allow!");
                return false;
            }

            var newTextBoxDiv = '<div class="col-md-3" id="TextBoxDiv' + counter + '"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="systemic_history"><input class="form-control"  type="text" id="optionsval' + counter + '" placeholder="value' + counter + '" name="optionsval[]"></div><span class="input-group-addon chiefcomplainremoveButton" type="button" id="chiefcomplainremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

            $("#ChiefTextBoxesGroup").append(newTextBoxDiv);
            counter++;
        });

        $(document).on('click', '.chiefcomplainremoveButton', function (e) {
            counter--;
            var target = $("#ChiefTextBoxesGroup").find("#TextBoxDiv" + counter);
            $(target).remove();
        });
    });

    function isEmpty(el) {
        return !$.trim(el.html())
    }
    // Chief Complaint Add Option

    $("#chiefcomplaintbtnsave").click(function () {
        var content = $("#ChiefTextBoxesGroup").val();
        if (isEmpty($('#ChiefTextBoxesGroup'))) {
            swal({
                title: "Please Add Some Option by clicking on",
                text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
                html: true
            });
        }
        else {
            var data = $("#patient_form").serialize();
            event.preventDefault();
            $.ajax({
                url: '{{ route("dynamic-field.insert") }}',
                method: 'post',
                data: data,
                success: function (data) {
                    swal({ title: "Option For Systemic History", text: "Added Successfully!", type: "success" },
                        function () {
                            //location.reload();
                        }
                    );
                }
            })
        }

    });

    $('.addmore').click(function (e) {
        //alert('hi');
        e.preventDefault();
        var template = $("#" + $(this).data('templatediv')).clone();
        $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
        // $("#surgeryDetails").find('#patient_name').val('');
        $(this).closest('div.ContainerToAppend').append($(template).html());
        $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({ width: '100%' });
        // .each(function(index,ele){
        //     $(ele).select2({width: '80%'});
        // });
    });

    $('.ContainerToAppend').on('click', '.removeItem', function (e) {
        e.preventDefault();
        $(this).closest('div.col-md-12').remove();
        //$('#surgeryDetails').remove($(this).closest('div.form-group'));
        return false;
    });

    $(".removeDbItem").click(function (e) {
        var ClickedButton = $(this);
        var containerDiv = $(this).closest('div.form-group.row');

        var delete_type = ClickedButton.data('type');
        var url = '{{ url("eyeform/deleteMultiEntry") }}/' + $(ClickedButton).data('deleteid');
        //alert(url);
        swal({
            title: "Are you sure?",
            text: "This Will Remove !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _method: 'delete',
                    _token: $("input[name='_token'][type='hidden']").val(),
                    id: $(ClickedButton).data('deleteid'),
                    type: delete_type
                }
            })
                .success(function () {
                    $(containerDiv).remove();
                    $(ClickedButton).button('reset');

                    swal({ title: "Deleted", text: "Successfully!!!", type: "success" },
                        function () {
                            location.reload();
                        }
                    );
                }).error(function () {
                    $(ClickedButton).button('reset');
                });

            location.reload();
        });
        e.preventDefault();

    });
    
    document.addEventListener('DOMContentLoaded', function () {
        const dobInput = document.getElementById('dob');
        const ageInput = document.getElementById('patient_age');
        const monthsInput = document.getElementById('admission_month');

        function calculateAge() {
            const dobValue = dobInput.value;
            if (dobValue) {
                const dob = new Date(dobValue);
                const today = new Date();

                let ageYears = today.getFullYear() - dob.getFullYear();
                let ageMonths = today.getMonth() - dob.getMonth();

                // Adjust years and months if necessary
                if (ageMonths < 0) {
                    ageYears--;
                    ageMonths += 12;
                }

                ageInput.value = ageYears;
                monthsInput.value = ageMonths;
            } else {
                ageInput.value = '';
                monthsInput.value = '';
            }
        }

        dobInput.addEventListener('change', calculateAge);
    });
</script>
@endsection