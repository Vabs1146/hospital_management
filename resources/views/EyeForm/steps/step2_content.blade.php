

<div id="DVN" class="ContainerToAppend dropdown-container">

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
<button type="button" name="add" id='dvnbtn' class="btn btn-success  set-dropdown-options"  data-field_name="dvn_od" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='DVNbtnsave'>Save Option</button>

<!-- <button id="NVN" class="btn btn-default addmore" data-templateDiv="NVNTemplate">Add</button> -->

</div>
</div>
<div id='dvnTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'dvn_od';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>

<!-- ================================================================================= -->

</div>



<div id="NVN" class="ContainerToAppend dropdown-container">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Near Vision UNAIDED</label>
</div>   
</div>

<div class="col-md-3">
{{ Form::select('nvn_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'nvn_od')->pluck('ddText','ddText')->toArray(), array_key_exists('nvn_od', $defaultValues)?$defaultValues['nvn_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-3">
{{ Form::select('nvn_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'nvn_os')->pluck('ddText','ddText')->toArray(), array_key_exists('nvn_os', $defaultValues)?$defaultValues['nvn_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">
<button type="button" name="add" id="nvnbtn" class="btn btn-success  set-dropdown-options"  data-field_name="nvn_od" data-form_name="EyeForm" >Set Option </button>
<button type="button" class="btn btn-primary" id="nvnbtnsave">Save Option</button>
<!--  <button id="nvn" class="btn btn-default addmore" data-templateDiv="NVNTemplate">Add</button>
-->
</div>
</div>
<div id='nvnTextBoxesGroup' class="col-md-12">
</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'nvn_os';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>

<!-- ================================================================================= -->
</div>


<div id="WithPinhole" class="ContainerToAppend dropdown-container">
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
<button type="button" name="add" id="WithPinholebtn" class="btn btn-success  set-dropdown-options"  data-field_name="withpinhole_OD" data-form_name="EyeForm" >Set Option </button>
<button type="button" class="btn btn-primary" id="WithPinholebtnsave">Save Option</button>
<!-- <button id="WithPinhole" class="btn btn-default addmore" data-templateDiv="WithPinholeTemplate">Add</button> -->

</div>
</div>
<div id='WithPinholeTextBoxesGroup' class="col-md-12">
</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'withpinhole_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>

<!-- ================================================================================= -->
</div>

<!--                                    <div id="PGP" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>PGP</label>
</div>  
</div>
<div class="col-md-3">
{{ Form::select('visualacuity_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'visualacuity_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('visualacuity_OD', $defaultValues)?$defaultValues['visualacuity_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('visualacuity_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'visualacuity_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('visualacuity_OS', $defaultValues)?$defaultValues['visualacuity_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id="PGPbtn" class="btn btn-success "  data-field_name="Chief Complaint OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='PGPbtnsave'>Save Option</button>
<button id="PGP" class="btn btn-default addmore" data-templateDiv="PGPTemplate">Add</button> 
</div>
</div>
<div id='PGPTextBoxesGroup' class="col-md-12">
</div>
</div>-->

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


<!-- ======================= With Glass unaided=============================== -->
@include('EyeForm.steps.vision.glass_dilated')
<!-- ==========================With Glass unaided================================ -->


<!--==============================================================-->
<!-- <div class="col-md-12">
	<div class="table-responsive">
		<h1>PGP</h1>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th colspan="4" class="text-center">Right</th>
					<th colspan="4" class="text-center">Left</th>
				</tr>
				<tr>
					<th>&nbsp;</th>
					<th>SPH</th>
					<th>CYL</th>
					<th>Axis</th>
					<th>Vision</th>
					<th>SPH</th>
					<th>CYL</th>
					<th>Axis</th>
					<th>Vision</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>D.V.</td>
					<td>
					{{ Form::text('vision_pgp_dv_sph_r', Request::old('vision_pgp_dv_sph_r', $form_details->vision_pgp_dv_sph_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_dv_cyl_r', Request::old('vision_pgp_dv_cyl_r', $form_details->vision_pgp_dv_cyl_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_dv_axis_r', Request::old('vision_pgp_dv_axis_r', $form_details->vision_pgp_dv_axis_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_dv_vision_r', Request::old('vision_pgp_dv_vision_r', $form_details->vision_pgp_dv_vision_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>

					<td>
					{{ Form::text('vision_pgp_dv_sph_l', Request::old('vision_pgp_dv_sph_l', $form_details->vision_pgp_dv_sph_l??''), array('class' => 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_dv_cyl_l', Request::old('vision_pgp_dv_cyl_l', $form_details->vision_pgp_dv_cyl_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_dv_axis_l', Request::old('vision_pgp_dv_axis_l', $form_details->vision_pgp_dv_axis_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_dv_vision_l', Request::old('vision_pgp_dv_vision_l', $form_details->vision_pgp_dv_vision_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
				</tr>
				<tr>
					<td>N.V.</td>
					<td>
					{{ Form::text('vision_pgp_nv_sph_r', Request::old('vision_pgp_nv_sph_r', $form_details->vision_pgp_nv_sph_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_nv_cyl_r', Request::old('vision_pgp_nv_cyl_r', $form_details->vision_pgp_nv_cyl_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_nv_axis_r', Request::old('vision_pgp_nv_axis_r', $form_details->vision_pgp_nv_axis_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_nv_vision_r', Request::old('vision_pgp_nv_vision_r', $form_details->vision_pgp_nv_vision_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>

					<td>
					{{ Form::text('vision_pgp_nv_sph_l', Request::old('vision_pgp_nv_sph_l', $form_details->vision_pgp_nv_sph_l??''), array('class'
					=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_nv_cyl_l', Request::old('vision_pgp_nv_cyl_l', $form_details->vision_pgp_nv_cyl_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_nv_axis_l', Request::old('vision_pgp_nv_axis_l', $form_details->vision_pgp_nv_axis_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					{{ Form::text('vision_pgp_nv_vision_l', Request::old('vision_pgp_nv_vision_l', $form_details->vision_pgp_nv_vision_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div> -->

@include('EyeForm.steps.vision.pgp')
<!--==================================================================-->
<div class="col-md-12 custom-item-parent-div">
<div class="row custom-item">
<div class="col-md-4">
<select class="custom-item-dropdown form-control select2">
<option value="">Select Option</option>

<option value="dvn" data-title="DISTANT Vision Unaided" data-od="1" data-os="1">DISTANT Vision Unaided</option>
<option value="nvn" data-title="Near Vision UNAIDED" data-od="1" data-os="1">Near Vision UNAIDED</option>
<option value="withpinhole" data-title="With Pinhole" data-od="1" data-os="1">With Pinhole</option>
<option value="colour_vision" data-title="Colour vision" data-od="1" data-os="1">Colour vision</option>
<option value="withglasses" data-title="With Glass" data-od="1" data-os="1">With Glass</option>
<option value="withglassesdilated" data-title="With Glass Dilated" data-od="1" data-os="1">With Glass Dilated</option>
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
<div class="col-md-12">
<div class="col-md-6 col-md-offset-4">
<div class="form-group">
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
</button>
</div>
</div>
</div>
