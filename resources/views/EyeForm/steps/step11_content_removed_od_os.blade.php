<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Date</label>
		</div>
	</div>
@php
	$laser_procedure_date = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_date')->first()
@endphp
	<div class="col-md-3">
		{{ Form::text('laser_procedure_date_OD', Request::old('laser_procedure_date_OD', isset($laser_procedure_date->field_value_OD)?$laser_procedure_date->field_value_OD:null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::text('laser_procedure_date_OS', Request::old('laser_procedure_date_OS', isset($laser_procedure_date->field_value_OS)?$laser_procedure_date->field_value_OS:null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
	</div>

	<div class="col-md-4">

	</div>
</div>

@include('EyeForm.steps.laser_procedure.type')

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Power</label>
		</div>
	</div>
@php
	$laser_procedure_power = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_power')->first()
@endphp
	<div class="col-md-3">
		{{ Form::text('laser_procedure_power_OD', Request::old('laser_procedure_power_OD', isset($laser_procedure_power->field_value_OD)?$laser_procedure_power->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::text('laser_procedure_power_OS', Request::old('laser_procedure_power_OS', isset($laser_procedure_power->field_value_OS)?$laser_procedure_power->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-4">

	</div>
</div>

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Exposure Time</label>
		</div>
	</div>
@php
	$laser_procedure_exposure_time = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_exposure_time')->first()
@endphp
	<div class="col-md-3">
		{{ Form::text('laser_procedure_exposure_time_OD', Request::old('laser_procedure_exposure_time_OD', isset($laser_procedure_exposure_time->field_value_OD)?$laser_procedure_exposure_time->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::text('laser_procedure_exposure_time_OS', Request::old('laser_procedure_exposure_time_OS', isset($laser_procedure_exposure_time->field_value_OS)?$laser_procedure_exposure_time->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-4">

	</div>
</div>

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>No. of Sitting</label>
		</div>
	</div>
@php
	$laser_procedure_sitting = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_sitting')->first()
@endphp
	<div class="col-md-3">
		{{ Form::text('laser_procedure_sitting_OD', Request::old('laser_procedure_sitting_OD', isset($laser_procedure_sitting->field_value_OD)?$laser_procedure_sitting->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::text('laser_procedure_sitting_OS', Request::old('laser_procedure_sitting_OS', isset($laser_procedure_sitting->field_value_OS)?$laser_procedure_sitting->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-4">

	</div>
</div>

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Spot Size</label>
		</div>
	</div>
@php
	$laser_procedure_spot_size = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_spot_size')->first()
@endphp
	<div class="col-md-3">
		{{ Form::text('laser_procedure_spot_size_OD', Request::old('laser_procedure_spot_size_OD', isset($laser_procedure_spot_size->field_value_OD)?$laser_procedure_spot_size->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::text('laser_procedure_spot_size_OS', Request::old('laser_procedure_spot_size_OS', isset($laser_procedure_spot_size->field_value_OS)?$laser_procedure_spot_size->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-4">

	</div>
</div>

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>No. of Spots</label>
		</div>
	</div>
@php
	$laser_procedure_no_of_spots = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_no_of_spots')->first()
@endphp
	<div class="col-md-3">
		{{ Form::text('laser_procedure_no_of_spots_OD', Request::old('laser_procedure_no_of_spots_OD', isset($laser_procedure_no_of_spots->field_value_OD)?$laser_procedure_no_of_spots->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::text('laser_procedure_no_of_spots_OS', Request::old('laser_procedure_no_of_spots_OS', isset($laser_procedure_no_of_spots->field_value_OS)?$laser_procedure_no_of_spots->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-4">

	</div>
</div>

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Note</label>
		</div>
	</div>
@php
	$laser_procedure_note = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_note')->first();
	//dd($laser_procedure_note);
@endphp
	<div class="col-md-3">
		{{ Form::textarea('laser_procedure_note_OD', Request::old('laser_procedure_not_OD',isset($laser_procedure_note->field_value_OS)?$laser_procedure_note->field_value_OD:null), array('class'=> 'form-control')) }}
		
	</div>

	<div class="col-md-3" style="display:none;">
		{{ Form::textarea('laser_procedure_note_OS', Request::old('laser_procedure_note_OS',isset($laser_procedure_note->field_value_OS)?$laser_procedure_note->field_value_OS:null), array('class'=> 'form-control')) }}
	</div>

	<div class="col-md-4">

	</div>
</div>


<!-- <div class="col-md-12 custom-item-parent-div">
	<div class="row custom-item">
		<div class="col-md-4">
			<select class="custom-item-dropdown form-control select2">
				<option value="">Select Option</option>

				<option value="Lids" data-title="Lids" data-od="1" data-os="1">Lids</option>
				<option value="Orbit" data-title="Orbit" data-od="1" data-os="1">Orbit</option>

				<option value="ConjAndLids" data-title="Conj" data-od="1" data-os="1">Conj</option>
				<option value="cornia" data-title="Cornea" data-od="1" data-os="1">Cornea</option>

				<option value="AC" data-title="AC" data-od="1" data-os="1">AC</option>
				<option value="IRIS" data-title="Iris" data-od="1" data-os="1">Iris</option>

				<option value="pupilIrisac" data-title="Pupil" data-od="1" data-os="1">Pupil</option>
				<option value="lens" data-title="Lens" data-od="1" data-os="1">Lens</option>

				<option value="vitreoretinal" data-title="Vitreins" data-od="1" data-os="1">Vitreins</option>
				<option value="Retina" data-title="Retina" data-od="1" data-os="1">Retina</option>

				<option value="ONH" data-title="ONH" data-od="1" data-os="1">ONH</option>
				<option value="Macula" data-title="Macula" data-od="1" data-os="1">Macula</option>


				<option value="sac" data-title="Sac" data-od="1" data-os="1">Sac</option>
			</select>
		</div>
		<div class="col-md-3">

		</div>
		<div class="col-md-3">

		</div>
		<div class="col-md-2">
			<span class="add-custom-item btn btn-default">Add</span>
		</div>
	</div>
	<div class="custom-item-container">

	</div>
</div>  -->      

<div class="col-md-12">
	<div class="col-md-6 col-md-offset-4">
		<div class="form-group">
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">
				Submit
			</button>
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">
				Submit & View
			</button>                                       
		</div>
	</div>
</div>

