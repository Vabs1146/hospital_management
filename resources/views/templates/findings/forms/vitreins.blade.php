<span class="dropdown-container">
<div id="vitreoretinal" class="ContainerToAppend">
	<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		<label>Vitreins</label>
		<input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" /> 
		</div>  
		</div>
		<div class="col-md-3">
		{{ Form::select('vitreoretinal_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OD')->pluck('ddText','ddText')->toArray(), array_key_exists('vitreoretinal OD', $defaultValues)?$defaultValues['vitreoretinal OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
		{{ Form::select('vitreoretinal_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OS')->pluck('ddText','ddText')->toArray(), array_key_exists('vitreoretinal OS', $defaultValues)?$defaultValues['vitreoretinal OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-4">
		<button type="button" name="add" id="vitreobtn" class="btn btn-success  set-dropdown-options"  data-field_name="vitreoretinal OD" data-form_name="EyeForm" >Set Option </button>
		<button type='button' class="btn btn-primary" id='vitreobtnsave'>Save Option</button>
		<button id="vitreoretinal" class="btn btn-default addmore" data-templateDiv="vitreoretinalTemplate">Add</button>
		</div>
	</div>

	@if(isset($template_data) && $template_data != null && isset($template_data['vitreoretinal']))
		@foreach($template_data['vitreoretinal'] as $template_row)
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" />  
				</div>
				<div class="col-md-3">
					{{ Form::select('vitreoretinal_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OD')->pluck('ddText','ddText')->toArray(), $template_row->od, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('vitreoretinal_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OS')->pluck('ddText','ddText')->toArray(), $template_row->os, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		@endforeach
	@endif

</div>
<div id='VitreoTextBoxesGroup' class="col-md-12">

</div>
<div style="display:none;">
<div id="vitreoretinalTemplate">
        <div class="col-md-12">
            <div class="col-md-2">
                <input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" />  
            </div>
            <div class="col-md-3">
                {{ Form::select('vitreoretinal_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
            </div>
            <div class="col-md-3">
                {{ Form::select('vitreoretinal_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'vitreoretinal OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
$dropdown_options_field_name = 'vitreoretinal OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item)
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