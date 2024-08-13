





<div class="col-md-12 dropdown-container dropdown-container">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label>CD Ratio  </label>
	</div>   
	</div>
	<div class="col-md-3">

	{{ Form::select('Ratio_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Ratio OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Ratio_OD', $defaultValues)?$defaultValues['Ratio_OD']:null, array('class'=> 'form-control select2')) }}

	</div>
	<div class="col-md-3">

	{{ Form::select('Ratio_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Ratio OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Ratio_OS', $defaultValues)?$defaultValues['Ratio_OS']:null, array('class'=> 'form-control select2')) }}

	</div>

	<div class="col-md-4">
	<button type="button" name="add" id='CDRatiobtn' class="btn btn-success  set-dropdown-options"  data-field_name="Ratio OD" data-form_name="EyeForm" >Set Option </button>
	<button type='button' class="btn btn-primary" id='CDRatiobtnsave'>Save Option</button>
	</div>

	<div id='CDRatioTextBoxesGroup' class="col-md-12">

	</div>

	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	@php 
	$dropdown_options_field_name = 'Ratio OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>

	<!-- ================================================================================= -->
</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Pachymetry  </label>
</div>
</div>
<!-- <div class="col-md-3">
{{ Form::select('Pachymetry_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Pachymetry_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Pachymetry_OD', $defaultValues)?$defaultValues['Pachymetry_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('Pachymetry_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Pachymetry_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Pachymetry_OS', $defaultValues)?$defaultValues['Pachymetry_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id='Pachymetrybtn' class="btn btn-success  set-dropdown-options"  data-field_name="Pachymetry_OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='Pachymetrybtnsave'>Save Option</button>
</div> -->


<div class="col-md-3">

{{ Form::text('Pachymetry_OD', Request::old('Pachymetry_OD', array_key_exists('Pachymetry_OD', $defaultValues)?$defaultValues['Pachymetry_OD']:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-3">

{{ Form::text('Pachymetry_OS', Request::old('Pachymetry_OS', array_key_exists('Pachymetry_OS', $defaultValues)?$defaultValues['Pachymetry_OS']:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-4">

</div>


<div id='PachymetryTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'Pachymetry_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>

<!-- ================================================================================= -->

</div>

<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>C.C.T.  </label>
</div>  
</div>
<div class="col-md-3">
{{ Form::select('CCT_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'CCT_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('CCT_OD', $defaultValues)?$defaultValues['CCT_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-3">
{{ Form::select('CCT_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'CCT_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('CCT_OS', $defaultValues)?$defaultValues['CCT_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id='cctbtn' class="btn btn-success  set-dropdown-options"  data-field_name="CCT_OD" data-form_name="EyeForm" >Set Option </button>
<button type='button' class="btn btn-primary" id='cctbtnsave'>Save Option</button>
</div>

<div id='cctTextBoxesGroup' class="col-md-12">

</div>

<!-- ================================================================================= -->

<!-- set-dropdown-options -->
<!-- <span class="dropdown-container"> -->
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
@php 
$dropdown_options_field_name = 'CCT_OD';
$dropdown_options_form_name = 'EyeForm';
@endphp
{{--@include('comman_templates.dropdown_options_update')--}}
</div>
<!-- ================================================================================= -->

</div>


<div class="col-md-12">
<div class="col-md-2"> 
</div>
<div class="col-md-5">
<div class="col-md-6">
<div class="example1" data-example="gonio_od">
<div class="board" id="gonio_od_canvas"></div>
</div>
<input type="hidden" name="gonio_od" id="gonio_od">
</div>
<div class="col-md-6">
@if (!empty($form_details->gonio_od) && !is_null($form_details->gonio_od))   
<button type="button" value="gonio_od" class="ImageDelete pull-right" >Delete</button>
<p>&nbsp;</p>
<center id="wPaint-gonio_od"> 
<img src={{ Storage::disk('local')->url($form_details->gonio_od)."?".filemtime(Storage::path($form_details->gonio_od)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
</center>
@endif
</div>
</div>

<div class="col-md-5">
<div class="col-md-6">
<div class="example1" data-example1="gonio_os">
<div class="board" id="gonio_os_canvas"></div>
</div>
<input type="hidden" name="gonio_os" id="gonio_os">
</div>
<div class="col-md-6">
@if (!empty($form_details->gonio_os) && !is_null($form_details->gonio_os))
<button type="button" value="gonio_os" class="ImageDelete pull-right" >Delete</button>
<p>&nbsp;</p>
<center id="wPaint-gonio_os"> 
<img src={{ Storage::disk('local')->url($form_details->gonio_os)."?".filemtime(Storage::path($form_details->gonio_os)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
</center>
@endif
</div>
</div>
</div> 
<div class="col-md-12 custom-item-parent-div">
<div class="row custom-item">
<div class="col-md-4">
<select class="custom-item-dropdown form-control select2">
<option value="">Select Option</option>

<option value="IOP" data-title="IOP" data-od="1" data-os="1">IOP</option>
<option value="CD" data-title="CD Ratio" data-od="1" data-os="1">CD Ratio</option>

<option value="Pachymetry" data-title="Pachymetry" data-od="1" data-os="1">Pachymetry</option>
<option value="CCT" data-title="C.C.T." data-od="1" data-os="1">C.C.T.</option>
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
