

<div id="ascan" class="ContainerToAppend dropdown-container">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Flat K</label>
</div>      
</div>
@php
$a_scan_record_data = $form_details->eyeformmultipleentry()->where('field_name', 'flat_k')->first();
$flat_k_od = isset($a_scan_record_data->field_value_OD) ? $a_scan_record_data->field_value_OD : '';
$flat_k_os = isset($a_scan_record_data->field_value_OS) ? $a_scan_record_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('flat_k_od', Request::old('flat_k_od', $flat_k_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">
{{ Form::text('flat_k_os', Request::old('flat_k_os', $flat_k_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>
<div id='K1TextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'k1_od';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>


<!-- ================================================================================= -->
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Flat Axis</label>
</div>   
</div>
@php
$a_scan_record_data = $form_details->eyeformmultipleentry()->where('field_name', 'flat_axis')->first();
$flat_axis_od = isset($a_scan_record_data->field_value_OD) ? $a_scan_record_data->field_value_OD : '';
$flat_axis_os = isset($a_scan_record_data->field_value_OS) ? $a_scan_record_data->field_value_OS : '';
@endphp


<div class="col-md-3">
{{ Form::text('flat_axis_od', Request::old('flat_axis_od', $flat_axis_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}


</div>
<div class="col-md-3">
{{ Form::text('flat_axis_os', Request::old('flat_axis_os', $flat_axis_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-4">                                        </div>

<div id='K2TextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'k1_od';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>



<!-- ================================================================================= -->
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Stap K</label>
</div>  
</div>
@php
$a_scan_record_data = $form_details->eyeformmultipleentry()->where('field_name', 'stap_k')->first();
$stap_k_od = isset($a_scan_record_data->field_value_OD) ? $a_scan_record_data->field_value_OD : '';
$stap_k_os = isset($a_scan_record_data->field_value_OS) ? $a_scan_record_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('stap_k_od', Request::old('stap_k_od', $stap_k_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>


<div class="col-md-3">
{{ Form::text('stap_k_os', Request::old('stap_k_os', $stap_k_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-4">                                        </div>

<div id='axial_lengthTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'axial_length_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
<!-- ================================================================================= -->
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Stap Axis</label>
</div>
</div>
@php
$a_scan_record_data = $form_details->eyeformmultipleentry()->where('field_name', 'stap_axis')->first();
$stap_axis_od = isset($a_scan_record_data->field_value_OD) ? $a_scan_record_data->field_value_OD : '';
$stap_axis_os = isset($a_scan_record_data->field_value_OS) ? $a_scan_record_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('stap_axis_od', Request::old('stap_axis_od', $stap_axis_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>


<div class="col-md-3">
{{ Form::text('stap_axis_os', Request::old('stap_axis_os', $stap_axis_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-4">                                        </div>

<div id='lenspowerTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'lenspower_od';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>



<!-- ================================================================================= -->
</div>



<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Axial Length</label>
</div>  
</div>
@php
$a_scan_record_data = $form_details->eyeformmultipleentry()->where('field_name', 'axial_length')->first();
$axial_length_od = isset($a_scan_record_data->field_value_OD) ? $a_scan_record_data->field_value_OD : '';
$axial_length_os = isset($a_scan_record_data->field_value_OS) ? $a_scan_record_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('axial_length_od', Request::old('axial_length_od', $axial_length_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-3">
{{ Form::text('axial_length_os', Request::old('axial_length_os', $axial_length_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-4">                                        </div>

<div id='KCTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'KC_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
<!-- ================================================================================= -->

</div>


<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Optical ACD</label>
</div>  
</div>
@php
$optical_acd_data = $form_details->eyeformmultipleentry()->where('field_name', 'optical_acd')->first();
$optical_acd_od = isset($optical_acd_data->field_value_OD) ? $optical_acd_data->field_value_OD : '';
$optical_acd_os = isset($optical_acd_data->field_value_OS) ? $optical_acd_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('optical_acd_od', Request::old('optical_acd_od', $optical_acd_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>


<div class="col-md-3">
{{ Form::text('optical_acd_os', Request::old('optical_acd_os', $optical_acd_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-4">                                        </div>

<div id='lens_typeTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'lens_type_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
<!-- ================================================================================= -->
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Target Refraction</label>
</div>  
</div>
@php
$target_refraction_data = $form_details->eyeformmultipleentry()->where('field_name', 'target_refraction')->first();
$target_refraction_od = isset($target_refraction_data->field_value_OD) ? $target_refraction_data->field_value_OD : '';
$target_refraction_os = isset($target_refraction_data->field_value_OS) ? $target_refraction_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('target_refraction_od', Request::old('target_refraction_od', $target_refraction_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">
{{ Form::text('target_refraction_os', Request::old('target_refraction_os', $target_refraction_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Lens Thickness</label>
</div>  
</div>
@php
$lens_thickness_data = $form_details->eyeformmultipleentry()->where('field_name', 'lens_thickness')->first();
$lens_thickness_od = isset($lens_thickness_data->field_value_OD) ? $lens_thickness_data->field_value_OD : '';
$lens_thickness_os = isset($lens_thickness_data->field_value_OS) ? $lens_thickness_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('lens_thickness_od', Request::old('lens_thickness_od', $lens_thickness_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">
{{ Form::text('lens_thickness_os', Request::old('lens_thickness_os', $lens_thickness_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>


<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>WTW</label>
</div>  
</div>
@php
$wtw_data = $form_details->eyeformmultipleentry()->where('field_name', 'wtw')->first();
$wtw_od = isset($wtw_data->field_value_OD) ? $wtw_data->field_value_OD : '';
$wtw_os = isset($wtw_data->field_value_OS) ? $wtw_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('wtw_od', Request::old('wtw_od', $wtw_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">
{{ Form::text('wtw_os', Request::old('wtw_os', $wtw_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>KC/Formula Use</label>
</div>  
</div>
@php
$kc_formula_use_data = $form_details->eyeformmultipleentry()->where('field_name', 'kc_formula_use')->first();
$kc_formula_use_od = isset($kc_formula_use_data->field_value_OD) ? $kc_formula_use_data->field_value_OD : '';
$kc_formula_use_os = isset($kc_formula_use_data->field_value_OS) ? $kc_formula_use_data->field_value_OS : '';
@endphp
<div class="col-md-3">
{{ Form::text('kc_formula_use_od', Request::old('kc_formula_use_od', $kc_formula_use_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">
{{ Form::text('kc_formula_use_os', Request::old('kc_formula_use_os', $kc_formula_use_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Type of Lens</label>
</div>  
</div>

@php
$type_of_lens_data = $form_details->eyeformmultipleentry()->where('field_name', 'type_of_lens')->first();
$type_of_lens_od = isset($type_of_lens_data->field_value_OD) ? $type_of_lens_data->field_value_OD : '';
$type_of_lens_os = isset($type_of_lens_data->field_value_OS) ? $type_of_lens_data->field_value_OS : '';
@endphp

<div class="col-md-3">
{{ Form::text('type_of_lens_od', Request::old('type_of_lens_od', $type_of_lens_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">
{{ Form::text('type_of_lens_os', Request::old('type_of_lens_os', $type_of_lens_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<br>
<label>Power of Lens</label>
</div>  
</div>
@php
$iol_cilinder_data = $form_details->eyeformmultipleentry()->where('field_name', 'iol_cilinder')->first();
$iol_cilinder_od = isset($iol_cilinder_data->field_value_OD) ? $iol_cilinder_data->field_value_OD : '';
$iol_cilinder_os = isset($iol_cilinder_data->field_value_OS) ? $iol_cilinder_data->field_value_OS : '';

$se_data = $form_details->eyeformmultipleentry()->where('field_name', 'se')->first();
$se_od = isset($se_data->field_value_OD) ? $se_data->field_value_OD : '';
$se_os = isset($se_data->field_value_OS) ? $se_data->field_value_OS : '';
@endphp
<div class="col-md-2">
<label>SE</label>
{{ Form::text('se_od', Request::old('se_od', $se_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-2">
<label>IOL Cilinder</label>
{{ Form::text('iol_cilinder_od', Request::old('iol_cilinder_od', $iol_cilinder_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-2">
<label>SE</label>
{{ Form::text('se_os', Request::old('se_os', $se_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-2">
<label>IOL Cilinder</label>
{{ Form::text('iol_cilinder_os', Request::old('iol_cilinder_os', $iol_cilinder_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

<div class="col-md-12">
<div class="col-md-6">
<label>Scan Images : </label>
<input type="file" class="img-thumb-upload" id="a_scan_images" name="a_scan_images[]"  multiple="">
</div>
<?php if(!empty($reportScan_image)) { ?>
<!-- <div class="col-md-6">
<a type="submit" href="{{ url('/patientDetails/scanPrint') }}/{{$casedata['id']}}" type="submit" name="submit" class="btn btn-primary btn-small" target="_blank">Print</a> 
</div> -->
<?php } ?>
</div>
<div class="col-md-12">
<?php foreach ($reportScan_image as  $k=>$value) { ?>
<img class="show-image" data-src="{{ asset('/a_scan_images/'.$value['filePath']) }}" src="{{ asset('/a_scan_images/'.$value['filePath']) }}" height="200px" width="200px" style="margin: 10px;">
<?php } ?>

</div>

<div class="col-md-12">
<div class="col-md-6 col-md-offset-4">
<div class="form-group">
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
</button>
</div>
</div>
</div>

<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button> -->

 

