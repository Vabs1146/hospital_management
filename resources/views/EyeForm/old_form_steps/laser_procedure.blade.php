
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#laser_procedure" aria-expanded="true" aria-controls="laser_procedure">
		Laser Procedure
		</a>
	</h4>
</div>
<div id="laser_procedure" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
	<!-- ============================================================================ -->
<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Date</label>
		</div>
	</div>
@php
	$laser_procedure_date = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_date')->first()
@endphp
	<div class="col-md-5">
		{{ Form::text('laser_procedure_date_OD', Request::old('laser_procedure_date_OD', isset($laser_procedure_date->field_value_OD)?$laser_procedure_date->field_value_OD:null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('laser_procedure_date_OS', Request::old('laser_procedure_date_OS', isset($laser_procedure_date->field_value_OS)?$laser_procedure_date->field_value_OS:null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
	</div>
</div>

@php
	$laser_procedure_laser_type = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_laser_type')->first();
@endphp

<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label>Type of Laser</label>
			</div>
			<input type="hidden" id="laser_procedure_laser_type[]" name="laser_procedure_laser_type[]" class="hiddenCounter" value="1" />   
		</div>

		<div class="col-md-5">
			{{ Form::text('laser_procedure_laser_type_OD[]', Request::old('laser_procedure_laser_type_OD', isset($laser_procedure_laser_type->field_value_OD)?$laser_procedure_laser_type->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>

		<div class="col-md-5" >				
			{{ Form::text('laser_procedure_laser_type_OS[]', Request::old('laser_procedure_laser_type_OS', isset($laser_procedure_laser_type->field_value_OS)?$laser_procedure_laser_type->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
</div>

<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Power</label>
		</div>
	</div>
@php
	$laser_procedure_power = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_power')->first()
@endphp
	<div class="col-md-5">
		{{ Form::text('laser_procedure_power_OD', Request::old('laser_procedure_power_OD', isset($laser_procedure_power->field_value_OD)?$laser_procedure_power->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('laser_procedure_power_OS', Request::old('laser_procedure_power_OS', isset($laser_procedure_power->field_value_OS)?$laser_procedure_power->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
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
	<div class="col-md-5">
		{{ Form::text('laser_procedure_exposure_time_OD', Request::old('laser_procedure_exposure_time_OD', isset($laser_procedure_exposure_time->field_value_OD)?$laser_procedure_exposure_time->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('laser_procedure_exposure_time_OS', Request::old('laser_procedure_exposure_time_OS', isset($laser_procedure_exposure_time->field_value_OS)?$laser_procedure_exposure_time->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
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
	<div class="col-md-5">
		{{ Form::text('laser_procedure_sitting_OD', Request::old('laser_procedure_sitting_OD', isset($laser_procedure_sitting->field_value_OD)?$laser_procedure_sitting->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('laser_procedure_sitting_OS', Request::old('laser_procedure_sitting_OS', isset($laser_procedure_sitting->field_value_OS)?$laser_procedure_sitting->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
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
	<div class="col-md-5">
		{{ Form::text('laser_procedure_spot_size_OD', Request::old('laser_procedure_spot_size_OD', isset($laser_procedure_spot_size->field_value_OD)?$laser_procedure_spot_size->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('laser_procedure_spot_size_OS', Request::old('laser_procedure_spot_size_OS', isset($laser_procedure_spot_size->field_value_OS)?$laser_procedure_spot_size->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
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
	<div class="col-md-5">
		{{ Form::text('laser_procedure_no_of_spots_OD', Request::old('laser_procedure_no_of_spots_OD', isset($laser_procedure_no_of_spots->field_value_OD)?$laser_procedure_no_of_spots->field_value_OD:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('laser_procedure_no_of_spots_OS', Request::old('laser_procedure_no_of_spots_OS', isset($laser_procedure_no_of_spots->field_value_OS)?$laser_procedure_no_of_spots->field_value_OS:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
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
	<div class="col-md-5">
		{{ Form::textarea('laser_procedure_note_OD', Request::old('laser_procedure_not_OD',isset($laser_procedure_note->field_value_OS)?$laser_procedure_note->field_value_OD:null), array('class'=> 'form-control')) }}
		
	</div>

	<div class="col-md-5">
		{{ Form::textarea('laser_procedure_note_OS', Request::old('laser_procedure_note_OS',isset($laser_procedure_note->field_value_OS)?$laser_procedure_note->field_value_OS:null), array('class'=> 'form-control')) }}
	</div>
</div>
	<!-- ============================================================================ -->
	</div>
</div>
