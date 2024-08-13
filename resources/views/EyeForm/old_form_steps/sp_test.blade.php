
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
	<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Sp_tests" aria-expanded="true" aria-controls="Sp_tests">
	SP Tests
	</a>
	</h4>
</div>
<div id="Sp_tests" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
				<label> Colour  Vision</label>
				</div>       
			</div>
			
			@php	
			$colour_OD = "";
					$colour_OS = "";

				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'colour')->get() as $item) {
					$colour_OD = $item->field_value_OD;
					$colour_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-5">
			{{ Form::text('colour_OD[]', Request::old('colour_OD', $colour_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-5">
			{{ Form::text('colour_OS[]', Request::old('colour_OS', $colour_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
		<div id='ColourVisionTextBoxesGroup' class="col-md-12">

		</div>

		<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		<label> Schimer Test 1</label>
		</div>     
		</div>

		@php	
		$schimerTest1_OD = "";
				$schimerTest1_OS = "";

			foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest1')->get() as $item) {
				$schimerTest1_OD = $item->field_value_OD;
				$schimerTest1_OS = $item->field_value_OS;
			}
		@endphp

		<div class="col-md-5">
		<div class="input-group">
			{{ Form::text('schimerTest1_OD[]', Request::old('schimerTest1_OD', $schimerTest1_OD), array('class'=> 'form-control', 'autocomplete'=>'off', 'style' => 'border:1px solid lightgray;')) }}
		<span class="input-group-addon myaddontest" id="basic-addon">MM</span>
		</div>
		</div>

		<div class="col-md-5">
		<div class="input-group">
			{{ Form::text('schimerTest1_OS[]', Request::old('schimerTest1_OS', $schimerTest1_OS), array('class'=> 'form-control', 'autocomplete'=>'off', 'style' => 'border:1px solid lightgray;')) }}
		<span class="input-group-addon myaddontest" id="basic-addon">MM</span>
		</div>
		</div> 
		</div>
		<div id='SchimerTestOneTextBoxesGroup' class="col-md-12">

		</div>
		<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		<label> Schimer Test 2</label>
		</div> 
		</div>
		
		@php		
		
		$schimerTest2_OD = "";
				$schimerTest2_OS = "";

			foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest2')->get() as $item) {
				$schimerTest2_OD = $item->field_value_OD;
				$schimerTest2_OS = $item->field_value_OS;
			}
		@endphp

		<div class="col-md-5">
		<div class="input-group">
		{{ Form::text('schimerTest2_OD[]', Request::old('schimerTest2_OD', $schimerTest2_OD), array('class'=> 'form-control', 'autocomplete'=>'off', 'style' => 'border:1px solid lightgray;')) }}
		<span class="input-group-addon myaddontest" id="basic-addon">MM</span>
		</div>
		</div>

		<div class="col-md-5">
		<div class="input-group">

		{{ Form::text('schimerTest2_OS[]', Request::old('schimerTest2_OS', $schimerTest2_OS), array('class'=> 'form-control', 'autocomplete'=>'off', 'style' => 'border:1px solid lightgray;')) }}
		<span class="input-group-addon myaddontest" id="basic-addon">MM</span>
		</div>
		</div> 
		</div>
		<div id='SchimerTestTwoTextBoxesGroup' class="col-md-12">

		</div>
	
		<!-- ==============================ssssstttttttaaaaaarrrrrrtttt=========================================== -->
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label>Tear Film Breakup Time</label>
		</div>
		<input type="hidden" id="tear_film_breakup_time[]" name="tear_film_breakup_time[]" class="hiddenCounter" value="1" />   
	</div>

	@php	
	$tear_film_breakup_time_OD = "";
				$tear_film_breakup_time_OS = "";

			foreach ($form_details->eyeformmultipleentry()->where('field_name', 'tear_film_breakup_time')->get() as $item) {
				$tear_film_breakup_time_OD = $item->field_value_OD;
				$tear_film_breakup_time_OS = $item->field_value_OS;
			}
		@endphp

	<div class="col-md-5">
		{{ Form::text('tear_film_breakup_time_OD[]', Request::old('tear_film_breakup_time_OD', $tear_film_breakup_time_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>

	<div class="col-md-5">
		{{ Form::text('tear_film_breakup_time_OS[]', Request::old('tear_film_breakup_time_OS', $tear_film_breakup_time_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>



<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label> Optical Coherence tomography (OCT)
		</label>
		</div>
		<input type="hidden" id="OCT[]" name="OCT[]" class="hiddenCounter" value="1" />
	</div>

	@php		
	
	$OCT_OD = "";
			$OCT_OS = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item) {
			$OCT_OD = $item->field_value_OD;
			$OCT_OS = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('OCT_OD[]', Request::old('OCT_OD', $OCT_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('OCT_OS[]', Request::old('OCT_OS', $OCT_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label> Extra Ocular Movement (EOM) </label>
		</div>
		<input type="hidden" id="EOM[]" name="EOM[]" class="hiddenCounter" value="1" />
	</div>

	@php	
	
	$EOM_OD = "";
			$EOM_OS = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item) {
			$EOM_OD = $item->field_value_OD;
			$EOM_OS = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('EOM_OD[]', Request::old('EOM_OD', $EOM_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('EOM_OS[]', Request::old('EOM_OS', $EOM_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label> Perimetry </label>
		</div>
		<input type="hidden" id="perimetry_sp[]" name="perimetry_sp[]" class="hiddenCounter" value="1" />
	</div>

	@php	
	
	$perimetry_sp_od = "";
			$perimetry_sp_os = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item) {
			$perimetry_sp_od = $item->field_value_OD;
			$perimetry_sp_os = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('perimetry_sp_od[]', Request::old('perimetry_sp_od', $perimetry_sp_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('perimetry_sp_os[]', Request::old('perimetry_sp_os', $perimetry_sp_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>

@php
//'perimetry_sp' => 'Perimetry', 
$sp_test_lables = ['laser_sp' => 'Laser', 'oculizer_sp' => 'Oculizer', 'ffa_sp' => 'FFA', 'eye_sonography' => 'Eye Sonogrphy'];
@endphp

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label> Laser </label>
		</div>
		<input type="hidden" id="laser_sp[]" name="laser_sp[]" class="hiddenCounter" value="1" />
	</div>

	@php	
	
	$laser_sp_od = "";
			$laser_sp_os = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'laser_sp')->get() as $item) {
			$laser_sp_od = $item->field_value_OD;
			$laser_sp_os = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('laser_sp_od[]', Request::old('laser_sp_od', $laser_sp_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('laser_sp_os[]', Request::old('laser_sp_os', $laser_sp_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label> Oculizer </label>
		</div>
		<input type="hidden" id="oculizer_sp[]" name="oculizer_sp[]" class="hiddenCounter" value="1" />
	</div>

	@php			

	$oculizer_sp_od = "";
			$oculizer_sp_os = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'oculizer_sp')->get() as $item) {
			$oculizer_sp_od = $item->field_value_OD;
			$oculizer_sp_os = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('oculizer_sp_od[]', Request::old('oculizer_sp_od', $oculizer_sp_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('oculizer_sp_os[]', Request::old('oculizer_sp_os', $oculizer_sp_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label> FFA </label>
		</div>
		<input type="hidden" id="ffa_sp[]" name="ffa_sp[]" class="hiddenCounter" value="1" />
	</div>

	@php	
	$ffa_sp_od = "";
			$ffa_sp_os = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ffa_sp')->get() as $item) {
			$ffa_sp_od = $item->field_value_OD;
			$ffa_sp_os = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('ffa_sp_od[]', Request::old('ffa_sp_od', $ffa_sp_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('ffa_sp_os[]', Request::old('ffa_sp_os', $ffa_sp_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label> Eye Sonogrphy </label>
		</div>
		<input type="hidden" id="eye_sonography[]" name="eye_sonography[]" class="hiddenCounter" value="1" />
	</div>

	@php		
	
	$eye_sonography_OD = "";
			$eye_sonography_OS = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ffa_sp')->get() as $item) {
			$eye_sonography_OD = $item->field_value_OD;
			$eye_sonography_OS = $item->field_value_OS;
		}
	@endphp

	<div class="col-md-5">
	{{ Form::text('eye_sonography_OD[]', Request::old('eye_sonography_OD', $eye_sonography_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</div> 

	<div class="col-md-5">
		{{ Form::text('eye_sonography_OS[]', Request::old('eye_sonography_OS', $eye_sonography_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
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


		<!-- ================================ eeeeeeeeeennnnnnnndddddddd--------------------------------================ -->

	</div>

</div>
