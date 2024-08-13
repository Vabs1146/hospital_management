<span class="dropdown-container">
<div id="schimerTest2_div" class="ContainerToAppend">
	<div class="col-md-12">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label> Schimer Test 2</label>
	</div> 
			<input type="hidden" id="schimerTest2[]" name="schimerTest2[]" class="hiddenCounter" value="1" /> 
	</div>

	<div class="col-md-3">
	<div class="input-group">
	{{ Form::select('schimerTest2_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'schimerTest2_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('schimerTest2_OD', $defaultValues)?$defaultValues['schimerTest2_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

	<span class="input-group-addon myaddontest" id="basic-addon">MM</span>
	</div>
	</div>

	<div class="col-md-3">
	<div class="input-group">
	{{ Form::select('schimerTest2_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'schimerTest2_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('schimerTest2_OS', $defaultValues)?$defaultValues['schimerTest2_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
	<!--  <div class="form-line">
	{{ Form::text('schimerTest2_OS', Request::old('schimerTest2_OS',$form_details->schimerTest2_OS), array('class'=> 'form-control','aria-describedby'=>"basic-addon" )) }}
	</div> -->
	<span class="input-group-addon myaddontest" id="basic-addon">MM</span>
	</div>
	</div> 
	<div class="col-md-4">
	<button type="button" name="add" id='schimertesttwobtn' class="btn btn-success  set-dropdown-options"  data-field_name="schimerTest2_OD" data-form_name="EyeForm" >Set Option </button>
	<button type='button' class="btn btn-primary" id='schimertesttwobtnsave'>Save Option</button>
			<button class="btn btn-default addmore" data-templateDiv="schimerTest2_Template">Add</button>
	</div> 
	</div>
	</div>
	<div id='SchimerTestTwoTextBoxesGroup' class="col-md-12">

	</div>

	<div style="display:none;">
		<div id="schimerTest2_Template" >
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="schimerTest2[]" name="schimerTest2[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					{{ Form::select('schimerTest2_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'schimerTest2_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('schimerTest2_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'schimerTest2_OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
	$dropdown_options_field_name = 'schimerTest2_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>


<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest2')->get() as $item)
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