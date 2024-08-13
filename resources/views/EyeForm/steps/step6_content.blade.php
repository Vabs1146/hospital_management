@include('EyeForm.steps.sp_test.colour_vision')

@include('EyeForm.steps.sp_test.schimer_test_one')

@include('EyeForm.steps.sp_test.schimer_test_two')

@include('EyeForm.steps.sp_test.tear_film_breakup_time')


<span class="dropdown-container">
<div id="OCT" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label> Optical Coherence tomography (OCT)
</label>
</div>
<input type="hidden" id="OCT[]" name="OCT[]" class="hiddenCounter" value="1" />
</div>

<div class="col-md-3">
{{ Form::select('OCT_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'OCT OD')->pluck('ddText','ddText')->toArray(), array_key_exists('OCT OD', $defaultValues)?$defaultValues['OCT OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}</div> 

<div class="col-md-3">
{{ Form::select('OCT_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'OCT OS')->pluck('ddText','ddText')->toArray(), array_key_exists('OCT OS', $defaultValues)?$defaultValues['OCT OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}</div>

<div class="col-md-4">
<button type="button" name="add" id='octbtn' class="btn btn-success set-dropdown-options"  data-field_name="OCT OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='octbtnsave'>Save Option</button>
<button id="OCT" class="btn btn-default addmore" data-templateDiv="OCTTemplate">Add</button>
</div>
</div>
</div>
<div id='OCTTextBoxesGroup' class="col-md-12"></div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'OCT OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
</span>
<!-- ================================================================================= -->


<div class="dbMultiEntryContainer">
<div class="col-md-12">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item)
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
@endforeach
</div>
</div>

<span class="dropdown-container">
<div id="EOM" class="ContainerToAppend">   
<div class="col-md-12"> 
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Extra Ocular Movement (EOM)</label>
<input type="hidden" id="EOM[]" name="EOM[]" class="hiddenCounter" value="1" />
</div>          
</div>

<div class="col-md-3">
{{ Form::select('EOM_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'EOM OD')->pluck('ddText','ddText')->toArray(), array_key_exists('EOM OD', $defaultValues)?$defaultValues['EOM OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}  
</div>  

<div class="col-md-3">
{{ Form::select('EOM_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'EOM OS')->pluck('ddText','ddText')->toArray(), array_key_exists('EOM OS', $defaultValues)?$defaultValues['EOM OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}   
</div> 

<div class="col-md-4">
<button type="button" name="add" id='eombtn' class="btn btn-success set-dropdown-options"  data-field_name="EOM OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='eombtnsave'>Save Option</button>
<button id="EOM" class="btn btn-default addmore" data-templateDiv="EOMTemplate">Add</button>
</div>    
</div>
</div>
<div id='EOMTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'EOM OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer js-sweetalert">
<div class="col-md-12">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item)
<div class="col-md-2">    
</div>

<div class="col-md-3">
<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
</div>

<div class="col-md-3">
<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
</div>

<div class="col-md-4">
<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove </button>
</div>
@endforeach
</div>
</div>
<!-- ==================New fields======================================-->
@include('EyeForm.steps.sp_test.perimetry')
<!-- ================================================================================= -->
<!-- =====================================================================-->
<!-- ==================New fields======================================-->
@include('EyeForm.steps.sp_test.laser')

@include('EyeForm.steps.sp_test.oculizer')

@include('EyeForm.steps.sp_test.ffa')

@include('EyeForm.steps.sp_test.eye_sonography')

<!-- ================================================================================= -->
<!-- =====================================================================-->
<!-- ==================New fields======================================-->

<!-- ================================================================================= -->
<!-- =====================================================================-->
<!-- ==================New fields======================================-->

<!-- ================================================================================= -->
<!-- =====================================================================-->
<!-- ================================================================================= -->
<!-- =====================================================================-->
<div class="col-md-12 custom-item-parent-div">
<div class="row custom-item">
<div class="col-md-4">
<select class="custom-item-dropdown form-control select2">
<option value="">Select Option</option>

<option value="colour" data-title="Colour Vision" data-od="1" data-os="1">Colour Vision</option>
<option value="schimerTest1" data-title="Schimer Test 1" data-od="1" data-os="1">Schimer Test 1</option>

<option value="schimerTest2" data-title="Schimer Test 2" data-od="1" data-os="1">Schimer Test 2</option>
<option value="tear_film_breakup_time" data-title="Tear Film Breakup Time" data-od="1" data-os="1">Tear Film Breakup Time</option>
<option value="OCT" data-title="Optical Coherence tomography (OCT)" data-od="1" data-os="1">Optical Coherence tomography (OCT)</option>
<option value="EOM" data-title="Extra Ocular Movement (EOM)" data-od="1" data-os="1">Extra Ocular Movement (EOM)</option>
<option value="perimetry_sp" data-title="Perimetry" data-od="1" data-os="1">Perimetry</option>
<option value="laser_sp" data-title="Laser" data-od="1" data-os="1">Laser</option>
<option value="oculizer_sp" data-title="Oculizer" data-od="1" data-os="1">Oculizer</option>
<option value="ffa_sp" data-title="FFA" data-od="1" data-os="1">FFA</option>
<option value="eye_sonography" data-title="Eye Sonography" data-od="1" data-os="1">Eye Sonography</option>
</select>
</div>
<div class="col-md-3">

</div>
<div class="col-md-3">

</div>
<div class="col-md-2">
<span class="add-custom-item btn btn-default">Add</span>
</div>
</div>
<div class="custom-item-container">

</div>
</div>

<!-- =======================Upload Images================================== -->  

<div class="col-md-12">
<div class="col-md-6">
<label>SP Test Images : </label>
<input type="file" class="img-thumb-upload" id="sp_test_images" name="sp_test_images[]"  multiple="">
</div>

</div>

<div class="col-md-12">
<?php foreach ($sp_test_image as  $k=>$value) { ?>
<img class="show-image" data-src="{{ asset('/sp_test_images/'.$value['filePath']) }}" src="{{ asset('/sp_test_images/'.$value['filePath']) }}" height="200px" width="200px" style="margin: 10px;">
<?php } ?>

</div>

<!-- ========================================================= -->  

<div class="col-md-12">
<div class="col-md-6 col-md-offset-4">
<div class="form-group">
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button> 
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
</button>
</div>
</div>
</div>

