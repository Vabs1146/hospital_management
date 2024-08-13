<div class="col-md-12">
	<h1>Eye Condition on Discharge</h1>
</div>

<!-- =========================== Start Vision ============================ -->
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="surgerydvision_div" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Vision</label> 
					</div>
					<input type="hidden" id="surgerydvision[]" name="surgerydvision[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('surgeryvision_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), array_key_exists('surgeryvision_od', $defaultValues)?$defaultValues['surgeryvision_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('surgerydvision_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), array_key_exists('surgeryvision_os', $defaultValues)?$defaultValues['surgeryvision_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				
				<div class="col-md-4">
					<button id="addsurgeryvision" class="btn btn-default addmore" data-templateDiv="surgeryvisiontemplate">Add</button>
				</div>

			</div>
		</div>
		
	</span> 
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgeryvision')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<!-- =========================== Start Anterior Segment ============================ -->
<!--
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="diagnosis_history" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Anterior Segment</label> 
					</div>
					<input type="hidden" id="diagnosisHistory[]" name="diagnosisHistory[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-4">          </div>

			</div>
		</div>
	</span> 
</div>
-->

<div id="otherDetailsAnteriorSegment" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsAnteriorSegment','Anterior Segment') }} 
			</div>
			<input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button id="addotherDetailsAnteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsAnteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsAnteriorSegmentTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<!-- =========================== Start Posterior Segment ============================ -->
<!--
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="diagnosis_history" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Posterior Segment</label> 
					</div>
					<input type="hidden" id="diagnosisHistory[]" name="diagnosisHistory[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-4">          </div>

			</div>
		</div>
	</span> 
</div>
-->

<div id="treatmentAdvice" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsPosteriorSegment','Posterior Segment') }}
			</div>
			<input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-4">
			<button id="addotherDetailsPosteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsPosteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsPosteriorSegmentTextBoxesGroup' class="col-md-12"> </div>

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>
<!-- =========================== Start Name of IOL ============================ -->
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="discharge_iol_name_div" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Name of IOL</label> 
					</div>
					<input type="hidden" id="discharge_iol_name[]" name="discharge_iol_name[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('discharge_iol_name_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_name_od', $defaultValues)?$defaultValues['discharge_iol_name_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{-- Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_name', $defaultValues)?$defaultValues['discharge_iol_name']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) --}}
				</div>

				<div class="col-md-4">          
					<button id="adddischarge_iol_name" class="btn btn-default addmore" data-templateDiv="discharge_iol_name_template">Add</button>
				</div>

			</div>
		</div>
	</span> 
</div>
<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'discharge_iol_name')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<!-- <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"> -->
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>