
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
	<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#A_Scan" aria-expanded="true" aria-controls="A_Scan">
	A Scan
	</a>
	</h4>
</div>
<div id="A_Scan" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
		<!-- <div id="ascan" class="ContainerToAppend">
			<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label>K1</label>
			</div>      
			</div>
			<div class="col-md-3">
			{{ Form::select('k1_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'k1_od')->pluck('ddText','ddText')->toArray(), array_key_exists('k1_od', $defaultValues)?$defaultValues['k1_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		
		
		
			<div class="col-md-3">
			{{ Form::select('k1_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'k1_os')->pluck('ddText','ddText')->toArray(), array_key_exists('k1_os', $defaultValues)?$defaultValues['k1_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		
			<div class="col-md-4">
			<button type="button" name="add" id='K1btn' class="btn btn-success ">Set Option </button>
			<button type='button' class="btn btn-primary" id='K1btnsave'>Save Option</button>
		
			</div>
			</div>
			<div id='K1TextBoxesGroup' class="col-md-12">
		
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label>K2</label>
			</div>   
			</div>
		
		
			<div class="col-md-3">
			{{ Form::select('k2_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'k2_od')->pluck('ddText','ddText')->toArray(), array_key_exists('k2_od', $defaultValues)?$defaultValues['k2_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-3">
			{{ Form::select('k2_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'k2_os')->pluck('ddText','ddText')->toArray(), array_key_exists('k2_os', $defaultValues)?$defaultValues['k2_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-4">
			<button type="button" name="add" id='K2btn' class="btn btn-success ">Set Option </button>
			<button type='button' class="btn btn-primary" id='K2btnsave'>Save Option</button>
		
			</div>
		
			<div id='K2TextBoxesGroup' class="col-md-12">
		
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label>Lens Power</label>
			</div>
			</div>
			<div class="col-md-3">
			{{ Form::select('lenspower_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'lenspower_od')->pluck('ddText','ddText')->toArray(), array_key_exists('lenspower_od', $defaultValues)?$defaultValues['lenspower_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		
		
			<div class="col-md-3">
			{{ Form::select('lenspower_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'lenspower_os')->pluck('ddText','ddText')->toArray(), array_key_exists('lenspower_os', $defaultValues)?$defaultValues['lenspower_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-4">
			<button type="button" name="add" id='lenspowerbtn' class="btn btn-success ">Set Option </button>
			<button type='button' class="btn btn-primary" id='lenspowerbtnsave'>Save Option</button>
		
			</div>
		
			<div id='lenspowerTextBoxesGroup' class="col-md-12">
		
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label>Axial length</label>
			</div>  
			</div>
			<div class="col-md-3">
			{{ Form::select('axial_length_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'axial_length_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('axial_length_OD', $defaultValues)?$defaultValues['axial_length_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		
		
			<div class="col-md-3">
			{{ Form::select('axial_length_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'axial_length_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('axial_length_OS', $defaultValues)?$defaultValues['axial_length_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-4">
			<button type="button" name="add" id='axial_lengthbtn' class="btn btn-success ">Set Option </button>
			<button type='button' class="btn btn-primary" id='axial_lengthbtnsave'>Save Option</button>
		
			</div>
		
			<div id='axial_lengthTextBoxesGroup' class="col-md-12">
		
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label> KC</label>
			</div>  
			</div>
			<div class="col-md-3">
			{{ Form::select('KC_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'KC_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('KC_OD', $defaultValues)?$defaultValues['KC_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-3">
			{{ Form::select('KC_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'KC_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('KC_OS', $defaultValues)?$defaultValues['KC_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-4">
			<button type="button" name="add" id='KCbtn' class="btn btn-success ">Set Option </button>
			<button type='button' class="btn btn-primary" id='KCbtnsave'>Save Option</button>
		
			</div>
		
			<div id='KCTextBoxesGroup' class="col-md-12">
		
			</div>
		
		</div> -->


		<!-- ============================================SSTRATTTTT========================================================= -->
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
		<div class="col-md-5">
			{{ Form::text('flat_k_od', Request::old('flat_k_od', $flat_k_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>

		<div class="col-md-5">
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


	<div class="col-md-5">
	{{ Form::text('flat_axis_od', Request::old('flat_axis_od', $flat_axis_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('stap_k_od', Request::old('stap_k_od', $stap_k_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>


<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('stap_axis_od', Request::old('stap_axis_od', $stap_axis_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>


<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('axial_length_od', Request::old('axial_length_od', $axial_length_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('optical_acd_od', Request::old('optical_acd_od', $optical_acd_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>


<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('target_refraction_od', Request::old('target_refraction_od', $target_refraction_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('lens_thickness_od', Request::old('lens_thickness_od', $lens_thickness_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('wtw_od', Request::old('wtw_od', $wtw_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
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
<div class="col-md-5">
{{ Form::text('kc_formula_use_od', Request::old('kc_formula_use_od', $kc_formula_use_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
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

<div class="col-md-5">
{{ Form::text('type_of_lens_od', Request::old('type_of_lens_od', $type_of_lens_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
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
		<!-- ==============================EEEEEENNDDDDD============================================================= -->
	</div>

</div>
