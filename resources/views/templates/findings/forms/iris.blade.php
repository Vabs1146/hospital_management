<span class="dropdown-container">
<div id="IRIS" class="ContainerToAppend">
	<div class="col-md-12">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label>Iris</label>
	</div>
	<input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="1" />   
	</div>
	<div class="col-md-3">
	{{ Form::select('IRIS_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OD')->pluck('ddText','ddText')->toArray(), array_key_exists('IRIS OD', $defaultValues)?$defaultValues['IRIS OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
	</div>
	<div class="col-md-3">
	{{ Form::select('IRIS_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OS')->pluck('ddText','ddText')->toArray(), array_key_exists('IRIS OS', $defaultValues)?$defaultValues['IRIS OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
	</div>
	<div class="col-md-4">
	<button type="button" name="add" id="irisbtn" class="btn btn-success  set-dropdown-options"  data-field_name="IRIS OD" data-form_name="EyeForm" >Set Option </button>
	<button type='button' class="btn btn-primary" id='irisbtnsave'>Save Option</button>
	<button id="IRIS" class="btn btn-default addmore" data-templateDiv="IRISTemplate">Add</button>
	</div>
	</div>

	@if(isset($template_data) && $template_data != null && isset($template_data['IRIS']))
		@foreach($template_data['IRIS'] as $template_row)
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					{{ Form::select('IRIS_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OD')->pluck('ddText','ddText')->toArray(), $template_row->od, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('IRIS_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OS')->pluck('ddText','ddText')->toArray(), $template_row->os, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		@endforeach
	@endif

</div>
<div id='IrisTextBoxesGroup' class="col-md-12">

</div>

<div style="display:none;">
<div id="IRISTemplate" >
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="" />   
            </div>
            <div class="col-md-3">
                {{ Form::select('IRIS_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('IRIS_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IRIS OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
$dropdown_options_field_name = 'IRIS OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'IRIS')->get() as $item)
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