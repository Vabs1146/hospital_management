<span class="dropdown-container">
<div id="colour_div" class="ContainerToAppend">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label> Colour  Vision</label>
			</div> 
			<input type="hidden" id="colour[]" name="colour[]" class="hiddenCounter" value="1" />   
		</div>

		<div class="col-md-3">
			{{ Form::select('colour_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour OD')->pluck('ddText','ddText')->toArray(), array_key_exists('colour_OD', $defaultValues)?$defaultValues['colour_OD']:null, array('class'=> 'form-control select2')) }}
		</div>

		<div class="col-md-3">

			{{ Form::select('colour_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour OS')->pluck('ddText','ddText')->toArray(), array_key_exists('colour_OS', $defaultValues)?$defaultValues['colour_OS']:null, array('class'=> 'form-control select2')) }}

		</div>
		<div class="col-md-4">
			<button type="button" name="add" id='ColourVisionbtn' class="btn btn-success  set-dropdown-options"  data-field_name="colour OD" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='ColourVisionbtnsave'>Save Option</button>
			<button class="btn btn-default addmore" data-templateDiv="colour_Template">Add</button>
		</div>

	</div>
</div>
	<div id='ColourVisionTextBoxesGroup' class="col-md-12">

	</div>

	<div style="display:none;">
		<div id="colour_Template" >
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="colour[]" name="colour[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					{{ Form::select('colour_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('colour_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
	$dropdown_options_field_name = 'colour_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>

<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'colour')->get() as $item)
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