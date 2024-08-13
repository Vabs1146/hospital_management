<div class="row clearfix">
	<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Select Template</label>
			</div>
		</div>
	<div class="col-md-6">
		<select id="select_template" class="form-control template_select2">
			<option value="">Select Template</option>
			@foreach($all_templates as $prescription_template)
			<option {{($template_id == $prescription_template->id) ? 'selected' : '' }} value="{{$prescription_template->id}}">{{$prescription_template->template_name}}</option>
			@endforeach
		</select>
	</div>
</div>

@php 
	$medicinlist = $casedata['medicinlist']->pluck('medicine_name','id')->toArray(); 
	$generic_medicinlist = $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray();
@endphp
@foreach($templates as $key => $templates_row)
<div id="initial_template_row">
	<div class="row clearfix">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Medicine :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{ Form::select('template_medicine_id[{{$key}}]', array(''=>'Please select') + $medicinlist, $templates_row->medicine_id, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Generic Medicine :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{ Form::select('generic_template_medicine_id[{{$key}}]', array(''=>'Please select') + $generic_medicinlist, $templates_row->generic_medicine_id, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
	</div>
	
	<div class="row clearfix">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Eye :</label>
			</div>
		</div>
		<div class="col-md-4">
			{{ Form::select('template_strength[{{$key}}]', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Frequency :</label>
			</div>
		</div>

		<div class="col-md-4">
			{{ Form::select('template_numberoftimes[{{$key}}]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), $templates_row->frequency, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div> 
	</div>
	
	<div class="row clearfix">
		

		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control"> Duration :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{ Form::select('template_medicine_quantity[{{$key}}]', array(''=>'Please select') + $casedata['quantity']->toArray(), $templates_row->duration, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control"> Timing :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{ Form::select('template_medicine_timing[{{$key}}]', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), $templates_row->medicine_timing, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
	</div>

	<div class="row clearfix">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control"> Date :</label>
			</div>
		</div>
		<div class="col-md-1 date-from">
			<div class="form-group labelgrp">
				<label class="form-control"> From :</label>
			</div>
		</div>
		<div class="col-md-2">
			{{ Form::text('template_from[{{$key}}]', Request::old('template_from[]', null), array('class'=> 'form-control template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control"> To :</label>
			</div>
		</div>
		<div class="col-md-2">
			{{ Form::text('template_to[{{$key}}]', Request::old('template_to[]', null), array('class'=> 'form-control template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>

		<div class="col-md-4">

		</div>
	</div>

</div>
<hr>
@endforeach