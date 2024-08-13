
<div class="panel-heading" role="tab" id="headingOne_1">
<h4 class="panel-title">
<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Finding" aria-expanded="true" aria-controls="Finding">
Finding
</a>
</h4>
</div>
<div id="Finding" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
<div class="panel-body">
<div id="ConjAndLids" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Lids</label>
</div>
<input type="hidden" id="Lids[]" name="Lids[]" class="hiddenCounter" value="1" />   
</div>

@php
$Lids_OD = "";
			$Lids_OS = "";
	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Lids')->get() as $item) {
			$Lids_OD = $item->field_value_OD;
			$Lids_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('Lids_OD[]', Request::old('Lids_OD', $Lids_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
{{ Form::text('Lids_OS[]', Request::old('Lids_OS', $Lids_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

</div> 
<div id='LidsTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>
<div id="OrbitSacsEyeMotility" class="ContainerToAppend">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp"> <label> Orbit</label> </div>
			<input type="hidden" id="OrbitSacsEyeMotility[]" name="OrbitSacsEyeMotility[]" class="hiddenCounter" value="1" />   
		</div>

		@php
		$OrbitSacsEyeMotility_OD = "";
					$OrbitSacsEyeMotility_OS = "";
			foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OrbitSacsEyeMotility')->get() as $item) {
					$OrbitSacsEyeMotility_OD = $item->field_value_OD;
					$OrbitSacsEyeMotility_OS = $item->field_value_OS;
				} 
		@endphp

		<div class="col-md-5">
		{{ Form::text('OrbitSacsEyeMotility_OD[]', Request::old('OrbitSacsEyeMotility_OD', $OrbitSacsEyeMotility_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-5">
		{{ Form::text('OrbitSacsEyeMotility_OS[]', Request::old('OrbitSacsEyeMotility_OS', $OrbitSacsEyeMotility_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
	</div>

</div>
<div id='OrbitTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>
<div id="AC" class="ContainerToAppend">
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label>Conj</label>
		</div>
		<input type="hidden" id="ConjAndLids[]" name="ConjAndLids[]" class="hiddenCounter" value="1" />   
	</div>

	@php

	$ConjAndLids_OD = "";
				$ConjAndLids_OS = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item) {
				$ConjAndLids_OD = $item->field_value_OD;
				$ConjAndLids_OS = $item->field_value_OS;
			} 
	@endphp

	<div class="col-md-5">
	{{ Form::text('ConjAndLids_OD[]', Request::old('ConjAndLids_OD', $ConjAndLids_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
	<div class="col-md-5">
	{{ Form::text('ConjAndLids_OS[]', Request::old('ConjAndLids_OS', $ConjAndLids_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>

</div>
<div id='ConjTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>

<div id="IRIS" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Cornea</label>
</div>
<input type="hidden" id="cornia[]" name="cornia[]" class="hiddenCounter" value="1" />   
</div>

@php

$cornia_od = "";
			$cornia_os = "";
	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'cornia')->get() as $item) {
			$cornia_od = $item->field_value_OD;
			$cornia_os = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('cornia_od[]', Request::old('cornia_od', $cornia_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('cornia_os[]', Request::old('cornia_os', $cornia_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

</div>

</div>
<div id='CorneaTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>
<div class="col-md-12">
<div class="col-md-2">
{{-- <input type="button" value="CheckCanvas" id="checkCanvas"> --}}
</div>

<div class="col-md-5">

<div class="col-md-6">
<div class="example1" data-example="OdImg1">
<div class="board" id="OdImg1_canvas"></div>
</div>
<input type="hidden" name="OdImg1" id="OdImg1"/>
</div>

<div class="col-md-6">
@if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))   
<button type="button" value="OdImg1" class="ImageDelete pull-right" >Delete</button>
<p>&nbsp;</p>
<center id="wPaint-OdImg1"> 
<img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
</center>
@endif
</div>
</div>

<div class="col-md-5">
<div class="col-md-6">
<div class="example1" data-example1="OsImg1">
<div class="board" id="OsImg1_canvas">
</div>
</div>
<input type="hidden" name="OsImg1" id="OsImg1"/>
</div>
<div class="col-md-6">
@if (!empty($form_details->OsImg1) && !is_null($form_details->OsImg1))
<button type="button" value="OsImg1" class="ImageDelete pull-right" >Delete</button>
<p>&nbsp;</p>
<center id="wPaint-OsImg1"> 
<img src={{ Storage::disk('local')->url($form_details->OsImg1)."?".filemtime(Storage::path($form_details->OsImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
</center>
@endif
</div>
</div>
</div>
<div id="sac" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>AC</label>
</div>
<input type="hidden" id="AC[]" name="AC[]" class="hiddenCounter" value="1" />   
</div>


<!-- =============================================== -->
@php

$AC_OD = "";
			$AC_OS = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'AC')->get() as $item) {
			$AC_OD = $item->field_value_OD;
			$AC_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('AC_OD[]', Request::old('AC_OD', $AC_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('AC_OS[]', Request::old('AC_OS', $AC_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->

</div>

</div>
<div id='AC1TextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>


<div id="Retina" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Iris</label>
</div>
<input type="hidden" id="IRIS[]" name="IRIS[]" class="hiddenCounter" value="1" />   
</div>

<!-- =============================================== -->
@php

$IRIS_OD = "";
			$IRIS_OS = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'AC')->get() as $item) {
			$IRIS_OD = $item->field_value_OD;
			$IRIS_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('IRIS_OD[]', Request::old('IRIS_OD', $IRIS_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('IRIS_OS[]', Request::old('IRIS_OS', $IRIS_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->


</div>

</div>
<div id='IrisTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>
<div id="Macula" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Pupil</label>
</div>
<input type="hidden" id="pupilIrisac[]" name="pupilIrisac[]" class="hiddenCounter" value="1" /> 
</div>


<!-- =============================================== -->
@php

$pupilIrisac_OD = "";
			$pupilIrisac_OS = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pupilIrisac')->get() as $item) {
			$pupilIrisac_OD = $item->field_value_OD;
			$pupilIrisac_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('pupilIrisac_OD[]', Request::old('pupilIrisac_OD', $pupilIrisac_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('pupilIrisac_OS[]', Request::old('pupilIrisac_OS', $pupilIrisac_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->




</div>

</div>
<div id='PupilTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>

<div id="ONH" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Lens</label>
</div>
<input type="hidden" id="lens[]" name="lens[]" class="hiddenCounter" value="1" />   
</div>

<!-- =============================================== -->
@php
$lens_od = "";
			$lense_os = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'lens')->get() as $item) {
			$lens_od = $item->field_value_OD;
			$lense_os = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('lens_od[]', Request::old('lens_od', $lens_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('lense_os[]', Request::old('lense_os', $lense_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->


</div>

</div>
<div id='LensTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Fundus</label>
</div>
</div>
<div class="col-md-5">
<div class="col-md-6">
<div class="example1" data-example="OdImg2">
<div class="board" id="OdImg2_canvas" ></div>
</div>
<input type="hidden" name="OdImg2" id="OdImg2"/>
</div>
<div class="col-md-6">
@if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2))
<button type="button" value="OdImg2" class="ImageDelete pull-right" >Delete</button>
<p>&nbsp;</p>
<center id="wPaint-OdImg2"> 
<img src={{ Storage::disk('local')->url($form_details->OdImg2)."?".filemtime(Storage::path($form_details->OdImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
</center>
@endif
</div>
</div>

<div class="col-md-5">
<div class="col-md-6">
<div class="example1" data-example="OsImg2">
<div class="board" id="OsImg2_canvas"></div>
</div>
<input type="hidden" name="OsImg2" id="OsImg2"/>
</div>
<div class="col-md-6">
@if (!empty($form_details->OsImg2) && !is_null($form_details->OsImg2))
<button type="button" value="OsImg2" class="ImageDelete pull-right" >Delete</button>
<p>&nbsp;</p>
<center id="wPaint-OsImg2"> 
<img src={{ Storage::disk('local')->url($form_details->OsImg2)."?".filemtime(Storage::path($form_details->OsImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
</center>
@endif
</div>
</div>
</div>
<div id="OrbitSacsEyeMotility1" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Vitreins</label>
<input type="hidden" id="vitreoretinal[]" name="vitreoretinal[]" class="hiddenCounter" value="1" /> 
</div>  
</div>

<!-- =============================================== -->
@php

$vitreoretinal_OD = "";
			$vitreoretinal_OS = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item) {
			$vitreoretinal_OD = $item->field_value_OD;
			$vitreoretinal_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('vitreoretinal_OD[]', Request::old('vitreoretinal_OD', $vitreoretinal_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('vitreoretinal_OS[]', Request::old('vitreoretinal_OS', $vitreoretinal_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->


</div>

</div>
<div id='VitreoTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>

<div id="cornia" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Retina</label>
</div>
<input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="1" />  
</div>

<!-- =============================================== -->
@php
$Retina_OD = "";
			$Retina_OS = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Retina')->get() as $item) {
			$Retina_OD = $item->field_value_OD;
			$Retina_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('Retina_OD[]', Request::old('Retina_OD', $Retina_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('Retina_OS[]', Request::old('Retina_OS', $Retina_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->

</div>

</div>
<div id='RetinaTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>


<div id="pupilIrisac" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>ONH</label>
</div>
<input type="hidden" id="ONH[]" name="ONH[]" class="hiddenCounter" value="1" />
</div>

<!-- =============================================== -->
@php
			$ONH_OD = "";
			$ONH_OS = "";
	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ONH')->get() as $item) {
			$ONH_OD = $item->field_value_OD;
			$ONH_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('ONH_OD[]', Request::old('ONH_OD', $ONH_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('ONH_OS[]', Request::old('ONH_OS', $ONH_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->


</div>

</div>
<div id='ONHTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>

<div id="lens" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Macula</label>
</div>
<input type="hidden" id="Macula[]" name="Macula[]" class="hiddenCounter" value="1" />  
</div>

<!-- =============================================== -->
@php

$Macula_OD = "";
			$Macula_OS = "";

	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Macula')->get() as $item) {
			$Macula_OD = $item->field_value_OD;
			$Macula_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('Macula_OD[]', Request::old('Macula_OD', $Macula_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('Macula_OS[]', Request::old('Macula_OS', $Macula_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->


</div>

</div>
<div id='MaculaTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>

<div id="vitreoretinal" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Sac</label>
<input type="hidden" id="sac[]" name="sac[]" class="hiddenCounter" value="1" />
</div>
</div>

<!-- =============================================== -->
@php

$sac_OD = "";
			$sac_OS = "";
	foreach ($form_details->eyeformmultipleentry()->where('field_name', 'sac')->get() as $item) {
			$sac_OD = $item->field_value_OD;
			$sac_OS = $item->field_value_OS;
		} 
@endphp

<div class="col-md-5">
{{ Form::text('sac_OD[]', Request::old('sac_OD', $sac_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<div class="col-md-5">
{{ Form::text('sac_OS[]', Request::old('sac_OS', $sac_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
<!-- =========================================== -->


</div>

</div>
<div id='SacTextBoxesGroup' class="col-md-12">

</div>

<div class="dbMultiEntryContainer"></div>

</div>


</div>
