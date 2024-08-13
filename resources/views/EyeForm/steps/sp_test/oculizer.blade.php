<span class="dropdown-container">

<div id="oculizer_sp_div" class="ContainerToAppend">
	<div class="col-md-12">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label>Oculizer</label>
	</div>      
			<input type="hidden" id="oculizer_sp[]" name="oculizer_sp[]" class="hiddenCounter" value="1" />  
	</div>

	<div class="col-md-3">
	{{ Form::select('oculizer_sp_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'oculizer_sp OD')->pluck('ddText','ddText')->toArray(), array_key_exists('oculizer_sp_od', $defaultValues)?$defaultValues['oculizer_sp_od']:null, array('class'=> 'form-control select2')) }}
	</div>

	<div class="col-md-3">

	{{ Form::select('oculizer_sp_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'oculizer_sp OS')->pluck('ddText','ddText')->toArray(), array_key_exists('oculizer_sp_os', $defaultValues)?$defaultValues['oculizer_sp_os']:null, array('class'=> 'form-control select2')) }}

	</div>
	<div class="col-md-4">
	<button type="button" name="add" id='OculizerSpbtn' class="btn btn-success  set-dropdown-options"  data-field_name="oculizer_sp OD" data-form_name="EyeForm" >Set Option </button>
	<button type='button' class="btn btn-primary" id='OculizerSpbtnsave'>Save Option</button>
			<button class="btn btn-default addmore" data-templateDiv="oculizer_sp_Template">Add</button>
	</div>

	</div>
	</div>
	<div id='OculizerSpTextBoxesGroup' class="col-md-12">

	</div>

	<div style="display:none;">
		<div id="oculizer_sp_Template" >
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="oculizer_sp[]" name="oculizer_sp[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					{{ Form::select('oculizer_sp_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'oculizer_sp OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('oculizer_sp_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'oculizer_sp OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		</div>
	</div>

	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	@php 
	$dropdown_options_field_name = 'oculizer_sp OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>

<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'oculizer_sp')->get() as $item)
<div class="col-md-12">
<div class="col-md-2">
</div>
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