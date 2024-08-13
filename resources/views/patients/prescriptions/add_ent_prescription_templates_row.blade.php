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
	$generic_medicinlist = $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray();
@endphp
@foreach($templates as $key => $templates_row)
<div id="initial_template_row">
	<div class="row clearfix">

		<div class="col-md-3">
			<div>
				<label>Medicine :</label>
			</div>
			 {{ Form::select('template_medicine_id['.$key.']', array(''=>'Please select') + $medicinlist,  $templates_row->medicine_id, array('class' => 'form-control template_select2','data-live-search'=>'true')) }}
		</div>

		<div class="col-md-3">
			<div>
				<label> Times a Day :</label>
			</div>
			{{ Form::select('template_numberoftimes['.$key.']', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), $templates_row->numberoftimes, array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>

		<div class="col-md-3"> <!-- Timing -->
				<div>
					<label>Day :</label>
				</div>
				{{ Form::select('template_medicine_quantity['.$key.']', array(''=>'Please select') + $casedata['quantity']->toArray(), $templates_row->medicine_Quntity, array('class' => 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-3"> <!-- Timing -->
				<div>
					<label>Quantity :</label>
				</div>
				{{ Form::select('template_strength['.$key.']', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), $templates_row->strength, array('class' => 'form-control select2')) }}
			</div>
		
		
	</div>
	
	
	
	
	<!-- =========================================== -->
	
	<!-- =============================================== -->

</div>
<div style="border-bottom:5px solid;" class="col-md-12"></div>


@endforeach