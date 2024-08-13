<div class="col-md-12">
	<h1>Procedure</h1>
</div>


<div class="col-md-12">
	<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="custom_type" value="new"> Default
	<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="custom_type" value="template"> Template

	<span id="custom_template_dropdown_div" style="display:none;">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="form-control">Select Template</label>
				</div>
			</div>
			<div class="col-md-4">
				<select name="select_template" id="select_template" class="form-control">
					<option value="">Select Template</option>
					@foreach($custom_templates as $custom_templates_row)
					<option value="{{$custom_templates_row->id}}">{{$custom_templates_row->name}}</option>
					@endforeach
				</select>
			</div>
		
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="form-control">OR</label>
				</div>
			</div>
			<div class="col-md-4">
				<a href="{{ url('/add-custom-templates') }}/{{$casedata['id']}}/procedure" name="submit" class="btn btn-info btn-lg">
					Add New Template
				</a>       
			</div>
		</div>
	</span>
</div>

<div class="template-span" id="template_one">
<!-- =========================== Start Diagnosis History ============================ -->

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
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', $procedure_array_key)->get() as $item)
        
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

@endforeach


@php
	$procedure_checkboxes_result = $form_details->eyeformmultipleentry()->where('field_name', 'procedure_checkboxes')->first();
	
	$procedure_checkboxes_array = (!empty($procedure_checkboxes_result) && isset($procedure_checkboxes_result)) ? explode(',', $procedure_checkboxes_result->field_value_OD) : [];
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
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', $procedure_array_key)->get() as $item)
        
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

@endforeach


@php
	$sutures_array = $form_details->eyeformmultipleentry()->where('field_name', 'sutures')->first();
	
	$sutures = !empty($sutures_array) ? $sutures_array->field_value_OD : '';
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
	$sc_injection_array = $form_details->eyeformmultipleentry()->where('field_name', 'sc_injection')->first();
	
	$sc_injection = !empty($sc_injection_array) ? $sc_injection_array->field_value_OD : '';
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
	$eye_patch_array = $form_details->eyeformmultipleentry()->where('field_name', 'eye_patch')->first();
	
	$eye_patch = !empty($eye_patch_array) ? $eye_patch_array->field_value_OD : '';

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
			<button id="add{{$procedure_array_key}}" class="btn btn-default addmore" data-templateDiv="{{$procedure_array_key}}Template">Add</button>
		</div>
	</div>
	<div id='{{$procedure_array_key}}TextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', $procedure_array_key)->get() as $item)
        
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

@endforeach

	
	@php
		$anaesthetist_notes_array = $form_details->eyeformmultipleentry()->where('field_name', 'anaesthetist_notes')->first();
		
		$anaesthetist_notes = !empty($anaesthetist_notes_array) ? $anaesthetist_notes_array->field_value_OD : '';
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
</div>


<script>
	$('input[name=custom_type]').click(function() {
		var custom_type = $(this).val();
		
		if(custom_type == 'new') {
			location.reload();
		}

		if(custom_type == 'template') {
			$('#template_one').hide();
			$('#custom_template_dropdown_div').show();
		}
		//alert(finding_type);
	});

	$(document).on('change', '#select_template', function() {
		var selected_template = $(this).val();
		//alert(selected_template);
		$('#template_one').html('');
				
		$.ajax({
			url : '{{url("get-custom-template-html")}}',
			type:'post',
			data : {'id' : $(this).val(), 'template_type' : 'procedure'},
			datatype: 'json',
			success : function(response) {


				$('#template_one').html(response.one);

				$('#template_one').show();
				
				$('.template-span .select2').select2({width: '100%'});
			}
		});
		
	});
</script>