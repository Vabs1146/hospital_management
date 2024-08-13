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

<input type="hidden" name="total_template_rows" id="total_template_rows" value="{{ count($templates) }}">
@php 
	$medicinlist = $casedata['medicinlist']->pluck('medicine_name','id')->toArray(); 
	//$generic_medicinlist = $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray();

	$generic_medicinlist = $casedata['medicinlist']->where('generic_name', '<>', '')->pluck('generic_name','id')->toArray();
@endphp
@foreach($templates as $key => $templates_row)
<div id="initial_template_row">
	<div class="row clearfix medicine-row">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Medicine :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{ Form::select('template_medicine_id['.$key.']', array(''=>'Please select') + $medicinlist, $templates_row->medicine_id, array('class' => 'form-control template_select2 selected-medicine','data-live-search'=>'true')) }}
		</div>
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Generic Medicine :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{-- Form::select('generic_template_medicine_id['.$key.']', array(''=>'Please select') + $generic_medicinlist, $templates_row->generic_medicine_id, array('class' => 'form-control template_select2','data-live-search'=>'true')) --}}

			{{ Form::select('generic_template_medicine_id['.$key.']', array(''=>'Please select') + $generic_medicinlist, $templates_row->medicine_id, array('class' => 'form-control template_select2 selected-generic', 'data-live-search'=>'true')) }}
		</div>
	</div>
	
	<div class="row clearfix d-none">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Eye :</label>
			</div>
		</div>
		<div class="col-md-4">
			{{ Form::select('template_strength['.$key.']', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
		
	</div>
	
	<div class="row clearfix">
		

		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control"> Duration :</label>
			</div>
		</div>


		<div class="col-md-4">
			{{ Form::select('template_medicine_quantity['.$key.']', array(''=>'Please select') + $casedata['quantity']->toArray(), $templates_row->duration, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
		
		<div class="col-md-2 d-none">
			<div class="form-group labelgrp">
				<label class="form-control"> Timing :</label>
			</div>
		</div>


		<div class="col-md-4 d-none">
			{{ Form::select('template_medicine_timing['.$key.']', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), $templates_row->medicine_timing, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>
	</div>
	{{--
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
			{{ Form::text('template_from['.$key.']', Request::old('template_from[]', null), array('class'=> 'form-control template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control"> To :</label>
			</div>
		</div>
		<div class="col-md-2">
			{{ Form::text('template_to['.$key.']', Request::old('template_to[]', null), array('class'=> 'form-control template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>

		<div class="col-md-4">

		</div>
	</div>
	--}}
	{{--
	<div class="frequencyContainerToAppend">	
		<div style="border-bottom:1px solid;" class="col-md-12"></div>
		<div class="col-md-12 dropdown-container">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="form-control">Frequency :</label>
				</div>
			</div>

			<div class="col-md-6">
				{{ Form::select('numberoftimes['.$key.'][]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
			</div> 
			<div class="col-md-4">
			
				<button id="addFrequency" class="btn btn-default addFrequency" data-templateDiv="FrequencyTemplate" data-key="{{$key}}">Add</button>
			</div>

			<div id='TimesadayTextBoxesGroup' class="col-md-12"> </div>
			<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
		</div>
		
		<div class="col-md-12 dropdown-container">
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
				{{ Form::text('from['.$key.'][]', Request::old('from', null), array('class'=> 'form-control  template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>
			<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control"> To :</label>
			</div>
			</div>
			<div class="col-md-2">
			{{ Form::text('to['.$key.'][]', Request::old('to', null), array('class'=> 'form-control  template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>

			<div class="col-md-4">

			</div> 
		</div>
	</div>	
	--}}
	
	
	<!-- =========================================== -->
	<div class="row clearfix frequencyContainerToAppend">	
		@php 
			$frequency_data = ($templates_row->frequency != "") ? json_decode($templates_row->frequency) : array(['frequency' => null, 'from' => null, 'to' => null]);
		@endphp
		
		@foreach($frequency_data as $frequency_data_key => $frequency_data_row)
		<div class="col-md-12 frequency_row">
			<div class="col-md-1">
				Frequency
			</div>

			<div class="col-md-4">
				{{ Form::select('numberoftimes['.$key.'][]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), $frequency_data_row->frequency, array('class' => 'form-control select2','data-live-search'=>'true')) }}
			</div> 
			
			<div class="col-md-1 date-from d-none">
				From
			</div>
			
			<div class="col-md-2 d-none">
				{{ Form::text('from['.$key.'][]', $frequency_data_row->from, array('class'=> 'form-control template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>
			
			<div class="col-md-1 d-none">
				To
			</div>
			
			<div class="col-md-2 d-none">
				{{ Form::text('to['.$key.'][]', $frequency_data_row->to, array('class'=> 'form-control template-datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>
			
			<div class="col-md-1">
				@if($frequency_data_key == 0)
				<button class="btn btn-default addFrequency" data-templateDiv="FrequencyTemplate" data-key="{{$key}}">Add</button>
				@else
				<button class="removeFrequencyRow btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>	
				@endif
			</div>
		</div>
		@endforeach
	</div>
	<!-- =============================================== -->

</div>
<div style="border-bottom:5px solid;" class="col-md-12"></div>

@endforeach
@include('Psychiatrist.frequency_add_more')