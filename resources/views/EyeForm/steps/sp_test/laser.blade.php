<span class="dropdown-container">

<div id="laser_sp_div" class="ContainerToAppend">
	<div class="col-md-12">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label>Laser</label>
	</div>       
			<input type="hidden" id="laser_sp[]" name="laser_sp[]" class="hiddenCounter" value="1" /> 
	</div>

	<div class="col-md-3">
	{{ Form::select('laser_sp_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_sp OD')->pluck('ddText','ddText')->toArray(), array_key_exists('laser_sp_od', $defaultValues)?$defaultValues['laser_sp_od']:null, array('class'=> 'form-control select2')) }}
	</div>

	<div class="col-md-3">

	{{ Form::select('laser_sp_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_sp OS')->pluck('ddText','ddText')->toArray(), array_key_exists('laser_sp_os', $defaultValues)?$defaultValues['laser_sp_os']:null, array('class'=> 'form-control select2')) }}

	</div>
	<div class="col-md-4">
	<button type="button" name="add" id='LaserSpbtn' class="btn btn-success  set-dropdown-options"  data-field_name="laser_sp OD" data-form_name="EyeForm" >Set Option </button>
	<button type='button' class="btn btn-primary" id='LaserSpbtnsave'>Save Option</button>
			<button class="btn btn-default addmore" data-templateDiv="laser_sp_Template">Add</button>
	</div>

	</div>
	</div>
	<div id='LaserSpTextBoxesGroup' class="col-md-12">

	</div>

	<div style="display:none;">
		<div id="laser_sp_Template" >
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="laser_sp[]" name="laser_sp[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					{{ Form::select('laser_sp_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_sp OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('laser_sp_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_sp OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
	$dropdown_options_field_name = 'laser_sp OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>

<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'laser_sp')->get() as $item)
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