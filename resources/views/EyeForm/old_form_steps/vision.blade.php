
<div class="panel-heading" role="tab" id="headingOne_1">
<h4 class="panel-title">
<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Vision" aria-expanded="true" aria-controls="Vision">
Vision
</a>
</h4>
</div>
<div id="Vision" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
<div class="panel-body">
<div id="DVN" class="ContainerToAppend">

<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>DISTANT Vision Unaided</label>
</div> 
<input type="hidden" id="DVN[]" name="DVN[]" class="hiddenCounter" value="1" />     
</div>

<div class="col-md-3">
{{ Form::select('dvn_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'dvn_od')->pluck('ddText','ddText')->toArray(), array_key_exists('dvn_od', $defaultValues)?$defaultValues['dvn_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('dvn_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'dvn_os')->pluck('ddText','ddText')->toArray(), array_key_exists('dvn_os', $defaultValues)?$defaultValues['dvn_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">
<button type="button" name="add" id='dvnbtn' class="btn btn-success ">Set Option </button>
<button type='button' class="btn btn-primary" id='DVNbtnsave'>Save Option</button>

<!-- <button id="NVN" class="btn btn-default addmore" data-templateDiv="NVNTemplate">Add</button> -->

</div>
</div>
<div id='dvnTextBoxesGroup' class="col-md-12">

</div>

</div>



<div id="NVN" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Near Vision UNAIDED</label>
</div>   
</div>
@php
//echo "=====>>>>>>>> <pre>"; print_r($defaultValues); exit;
@endphp
<div class="col-md-3">
{{ Form::select('nvn_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'nvn_od')->pluck('ddText','ddText')->toArray(), array_key_exists('nvn_od', $defaultValues)?$defaultValues['nvn_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-3">
{{ Form::select('nvn_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'nvn_os')->pluck('ddText','ddText')->toArray(), array_key_exists('nvn_os', $defaultValues)?$defaultValues['nvn_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">
<button type="button" name="add" id="nvnbtn" class="btn btn-success ">Set Option </button>
<button type="button" class="btn btn-primary" id="nvnbtnsave">Save Option</button>
<!--  <button id="nvn" class="btn btn-default addmore" data-templateDiv="NVNTemplate">Add</button>
-->
</div>
</div>
<div id='nvnTextBoxesGroup' class="col-md-12">
</div>
</div>

<div id="WithPinhole" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>With Pinhole</label>
</div>
</div>

<div class="col-md-3">
{{ Form::select('withpinhole_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'withpinhole_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('withpinhole_OD', $defaultValues)?$defaultValues['withpinhole_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-3">
{{ Form::select('withpinhole_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'withpinhole_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('withpinhole_OS', $defaultValues)?$defaultValues['withpinhole_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">
<button type="button" name="add" id="WithPinholebtn" class="btn btn-success ">Set Option </button>
<button type="button" class="btn btn-primary" id="WithPinholebtnsave">Save Option</button>
<!-- <button id="WithPinhole" class="btn btn-default addmore" data-templateDiv="WithPinholeTemplate">Add</button> -->

</div>
</div>
<div id='WithPinholeTextBoxesGroup' class="col-md-12">
</div>
</div>

<!-- <div id="PGP" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>PGP</label>
</div>  
</div>
<div class="col-md-3">
{{ Form::select('visualacuity_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'visualacuity_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('visualacuity OD', $defaultValues)?$defaultValues['visualacuity OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('visualacuity_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'visualacuity_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('visualacuity OS', $defaultValues)?$defaultValues['visualacuity OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id="PGPbtn" class="btn btn-success ">Set Option </button>
<button type='button' class="btn btn-primary" id='PGPbtnsave'>Save Option</button>
<button id="PGP" class="btn btn-default addmore" data-templateDiv="PGPTemplate">Add</button>
</div>
</div>
<div id='PGPTextBoxesGroup' class="col-md-12">
</div>
</div> -->

<!-- <div id="DVNWithGlasses" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>DVN (With Glasses)</label>
</div>  
</div>
<div class="col-md-3">
{{ Form::select('colour_vision_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour_vision_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('colour_vision OD', $defaultValues)?$defaultValues['colour_vision OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('colour_vision_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour_vision_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('colour_vision OS', $defaultValues)?$defaultValues['colour_vision OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id="DVNWithGlassesbtn" class="btn btn-success ">Set Option </button>
<button type='button' class="btn btn-primary" id='DVNWithGlassesbtnsave'>Save Option</button>
<button id="DVNWithGlasses" class="btn btn-default addmore" data-templateDiv="DVNWithGlassesTemplate">Add</button>
</div>
</div>
<div id='DVNWithGlassesTextBoxesGroup' class="col-md-12">
</div>
</div>

<div id="NVNWithGlasses" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>NVN (With Glasses) </label>
</div>   
</div>
<div class="col-md-3">
{{ Form::select('withglasses_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'withglasses_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('withglasses OD', $defaultValues)?$defaultValues['withglasses OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-3">
{{ Form::select('withglasses_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'withglasses_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('withglasses OS', $defaultValues)?$defaultValues['withglasses OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">
<button type="button" name="add" id="NVNWithGlassesbtn" class="btn btn-success ">Set Option </button>
<button type='button' class="btn btn-primary" id='NVNWithGlassesbtnsave'>Save Option</button>
<button id="NVNWithGlasses" class="btn btn-default addmore" data-templateDiv="NVNWithGlassesTemplate">Add</button>
</div>
</div>
<div id='NVNWithGlassesTextBoxesGroup' class="col-md-12">
</div>
</div> -->

<!-- ========================= start color vision and with glasses=================================================== -->
<div id="DVNWithGlasses" class="ContainerToAppend dropdown-container">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Colour vision</label>
</div>  
</div>
<div class="col-md-3">
{{ Form::select('colour_vision_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour_vision_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('colour_vision_OD', $defaultValues)?$defaultValues['colour_vision_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('colour_vision_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'colour_vision_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('colour_vision_OS', $defaultValues)?$defaultValues['colour_vision_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id="DVNWithGlassesbtn" class="btn btn-success  set-dropdown-options"  data-field_name="colour_vision_OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='DVNWithGlassesbtnsave'>Save Option</button>
<!-- <button id="DVNWithGlasses" class="btn btn-default addmore" data-templateDiv="DVNWithGlassesTemplate">Add</button> -->
</div>
</div>
<div id='DVNWithGlassesTextBoxesGroup' class="col-md-12">
</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'colour_vision_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>

<!-- ================================================================================= -->
</div>

<div id="NVNWithGlasses" class="ContainerToAppend dropdown-container">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>With Glass</label>
</div>   
</div>
<div class="col-md-3">
{{ Form::select('withglasses_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'withglasses_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('withglasses_OD', $defaultValues)?$defaultValues['withglasses_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-3">
{{ Form::select('withglasses_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'withglasses_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('withglasses_OS', $defaultValues)?$defaultValues['withglasses_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">
<button type="button" name="add" id="NVNWithGlassesbtn" class="btn btn-success  set-dropdown-options"  data-field_name="withglasses_OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='NVNWithGlassesbtnsave'>Save Option</button>
<!-- <button id="NVNWithGlasses" class="btn btn-default addmore" data-templateDiv="NVNWithGlassesTemplate">Add</button> -->
</div>
</div>
<div id='NVNWithGlassesTextBoxesGroup' class="col-md-12">
</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'withglasses_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>

<!-- ================================================================================= -->


</div>
<!-- =========================end color vision and with glasses ============================= -->

@include('EyeForm.steps.vision.pgp')

</div>



</div>
