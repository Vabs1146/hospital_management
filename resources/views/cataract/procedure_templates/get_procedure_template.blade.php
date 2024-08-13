<!-- =========================== Start Diagnosis History ============================ -->
<div class="col-md-12">
@php
//echo "<pre>"; print_r($template_data);
@endphp
</div>
@foreach($procedure_array as $procedure_array_key => $procedure_array_val)
<div id="{{$procedure_array_key}}_div" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('section', $procedure_array_val) }} 
			</div>
			<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select($procedure_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $procedure_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<button id="add{{$procedure_array_key}}" class="btn btn-default addmore" data-templateDiv="{{$procedure_array_key}}Template">Add</button>
		</div>
	</div>
	<div id='{{$procedure_array_key}}TextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@if(isset($template_data[$procedure_array_key]))
        @foreach ($template_data[$procedure_array_key] as $item)
	<div class="col-md-12">
		<div class="col-md-2"> 
		<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			<input name="{{$procedure_array_key.'_OD[]'}}" type="text" class="form-control" readonly value="{{$item->od}}">
		</div>

		<div class="col-md-3">
			<!-- <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"> -->
		</div>

		<div class="col-md-2">
			<button class="removeCustomDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
	@endif
</div>

@endforeach


@php
	//$procedure_checkboxes_result = $form_details->eyeformmultipleentry()->where('field_name', 'procedure_checkboxes')->first();

	$procedure_checkboxes_result = isset($template_data['procedure_checkboxes']) ? $template_data['procedure_checkboxes'][0] : [];
	
	$procedure_checkboxes_array = (!empty($procedure_checkboxes_result) && isset($procedure_checkboxes_result)) ? explode(',', $procedure_checkboxes_result->od) : [];
@endphp
	
<div class="col-md-12">
@foreach($checkbox_array as $checkbox_array_key => $checkbox_array_val)
	<div class="col-md-2">
	
	<!-- <input type="checkbox" name="procedure_checkboxes" value="{{$checkbox_array_key}}">{{$checkbox_array_val}} -->
	
	
	<input  <?php if(in_array( $checkbox_array_key, $procedure_checkboxes_array)){ echo "checked"; }else{echo "unchecked";}?>  type="checkbox" name="procedure_checkboxes[]" id="{{$checkbox_array_key}}" class="bloodtests filled-in chk-col-pink"  value="{{$checkbox_array_key}}" />
	<label for="{{$checkbox_array_key}}">{{$checkbox_array_val}}</label>
	
	</div>
@endforeach
</div>

@foreach($procedure_array2 as $procedure_array_key => $procedure_array_val)
<div id="{{$procedure_array_key}}_div" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('section', $procedure_array_val) }} 
			</div>
			<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select($procedure_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $procedure_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<button id="add{{$procedure_array_key}}" class="btn btn-default addmore" data-templateDiv="{{$procedure_array_key}}Template">Add</button>
		</div>
	</div>
	<div id='{{$procedure_array_key}}TextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@if(isset($template_data[$procedure_array_key]))
        @foreach ($template_data[$procedure_array_key] as $item)
        
	<div class="col-md-12">
		<div class="col-md-2"> 
		<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			<input name="{{$procedure_array_key.'_OD[]'}}" type="text" class="form-control" readonly value="{{$item->od}}">
		</div>

		<div class="col-md-3">
			<!-- <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"> -->
		</div>

		<div class="col-md-2">
			<button class="removeCustomDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
	@endif
</div>

@endforeach


@php


	
		$sutures_array = isset($template_data['sutures']) ? $template_data['sutures'][0] : [];
	
	
	
	$sutures = !empty($sutures_array) ? $sutures_array->od : '';
@endphp

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('sutures','Sutures ') }}
		</div>
	</div>

	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('sutures', Request::old('sutures', $sutures), array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
</div> 


@php
	//$sc_injection_array = $form_details->eyeformmultipleentry()->where('field_name', 'sc_injection')->first();

	$sc_injection_array = isset($template_data['sc_injection']) ? $template_data['sc_injection'][0] : [];
	
	
	$sc_injection = !empty($sc_injection_array) ? $sc_injection_array->od : '';
@endphp

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('sc_injection','S. C. Injection') }}
		</div>
	</div>

	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('sc_injection', Request::old('sc_injection', $sc_injection), array('class' => 'form-control')) }}
			</div>
		</div>
	</div>
</div> 

@php

	$eye_patch_array = isset($template_data['eye_patch']) ? $template_data['eye_patch'][0] : [];
	
	$eye_patch = !empty($eye_patch_array) ? $eye_patch_array->od : '';

	$yes = ($eye_patch == 'Yes') ? 'checked' : '';

	$no = ($eye_patch == 'No' || $yes == '') ? 'checked' : '';

@endphp

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('eye_patch','Eye Patch') }}
		</div>
	</div>

	<div class="col-md-10">
		<div class="form-group ">
			<!-- <div class="form-line"> -->
				{{--  Form::text('eye_patch', Request::old('eye_patch', $eye_patch), array('class' => 'form-control')) --}}
				<input class="surgery-eye-radio" type="radio" name="eye_patch"  value="Yes" {{$yes}} style="opacity: 1; left: auto; position: relative;">&nbsp;Yes
				&nbsp;&nbsp;&nbsp;<input class="surgery-eye-radio" type="radio" name="eye_patch" value="No" {{$no}} style="opacity: 1; left: auto; position: relative;">&nbsp;No
			<!-- </div> -->
		</div>
	</div>
</div> 
	
	
	
@foreach($procedure_array3 as $procedure_array_key => $procedure_array_val)
<div id="{{$procedure_array_key}}_div" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('section', $procedure_array_val) }} 
			</div>
			<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select($procedure_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $procedure_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<button id="addCustom_{{$procedure_array_key}}" class="btn btn-default addmore_custom" data-templateDiv="{{$procedure_array_key}}CustomTemplate">Add</button>
		</div>
	</div>
	<div id='{{$procedure_array_key}}TextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">

    
	  @if(isset($template_data[$procedure_array_key]))
        @foreach ($template_data[$procedure_array_key] as $item)

	<div class="col-md-12">
		<div class="col-md-2">
		<input type="hidden" id="{{$procedure_array_key}}[]" name="{{$procedure_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			<input name="{{$procedure_array_key.'_OD[]'}}" type="text" class="form-control" readonly value="{{$item->od}}">
		</div>

		<div class="col-md-3">
			<!-- <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"> -->
		</div>

		<div class="col-md-2">
			<button class="removeCustomDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
	@endif
</div>

@endforeach

	
	@php
		
		$anaesthetist_notes_array = isset($template_data['anaesthetist_notes']) ? $template_data['anaesthetist_notes'] : [];

		$anaesthetist_notes = !empty($anaesthetist_notes_array) ? $anaesthetist_notes_array[0]->od : '';
	@endphp
	<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('anaesthetist_notes','Anaesthetist Notes') }}
		</div>
		</div>

		<div class="col-md-10">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('anaesthetist_notes', Request::old('anaesthetist_notes',$anaesthetist_notes), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
	</div> 


	@include('cataract.sections.cataract_hidden_templates')