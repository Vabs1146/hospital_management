@foreach($templates as $key => $templates_row)
<div class="template-row-added">

	<div class="row clearfix">
		<div class="col-md-2">Medicine</div>
		<div class="col-md-3">{{ Form::select('medicine_id['.$key.']', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), $templates_row->medicine_id, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		
		<div class="col-md-2">Generic Medicine</div>
		<div class="col-md-3">{{ Form::select('generic_medicine_id['.$key.']', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray(), $templates_row->generic_medicine_id, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		<div class="col-md-2"></div>
	</div>
	
	
	<div class="row clearfix">
		
		<div class="col-md-2">Duration</div>
		<div class="col-md-3">{{ Form::select('duration['.$key.']', array(''=>'Please select') + $casedata['quantity']->toArray(), $templates_row->duration, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		<div class="col-md-2">Timing</div>
		<div class="col-md-3">{{ Form::select('medicine_timing['.$key.']', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), $templates_row->medicine_timing, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		
		<div class="col-md-2"></div>
		
	</div>
	
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
			
			<div class="col-md-1 date-from">
				From
			</div>
			
			<div class="col-md-2">
				{{ Form::text('from['.$key.'][]', $frequency_data_row->from, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>
			
			<div class="col-md-1">
				To
			</div>
			
			<div class="col-md-2">
				{{ Form::text('to['.$key.'][]', $frequency_data_row->to, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
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
	
		
	<div class="row clearfix">
		<div class="col-md-5"></div>
		
		<div class="col-md-2"></div>
		<div class="col-md-3"></div>
		<div class="col-md-2"><a href="javascript:void(0)" class="remove-prescription-template-row btn btn-danger">Remove</a></div>
	</div>
</div>
<hr>
@endforeach

