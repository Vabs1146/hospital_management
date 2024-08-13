
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
	<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Glaucoma" aria-expanded="true" aria-controls="Glaucoma">
	Glaucoma
	</a>
	</h4>
</div>
<div id="Glaucoma" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
		<!-- <div id="Glaucoma" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-2">
				<div class="form-group labelgrp">
				<label> IOP  </label>
				</div>      
				</div>
				<div class="col-md-3">
				{{ Form::select('IOP_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IOP_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('IOP_OD', $defaultValues)?$defaultValues['IOP_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>
		
		
				<div class="col-md-3">
				{{ Form::select('IOP_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IOP_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('IOP_OS', $defaultValues)?$defaultValues['IOP_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>
		
				<div class="col-md-4">
				<button type="button" name="add" id='IOPbtn' class="btn btn-success ">Set Option </button>
				<button type='button' class="btn btn-primary" id='IOPbtnsave'>Save Option</button>
				</div>
			</div>
			<div id='IOPTextBoxesGroup' class="col-md-12">
		
			</div>
		
		</div> -->

		<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label>CD Ratio  </label>
			</div>   
			</div>

			@php			
				$Ratio_OD = array_key_exists('Ratio_OD', $defaultValues)?$defaultValues['Ratio_OD']:null;
					$Ratio_OS = array_key_exists('Ratio_OS', $defaultValues)?$defaultValues['Ratio_OS']:null;
			@endphp
			<div class="col-md-5">

			{{-- Form::select('Ratio_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Ratio OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Ratio OD', $defaultValues)?$defaultValues['Ratio OD']:null, array('class'=> 'form-control select2')) --}}

			{{ Form::text('Ratio_OD', Request::old('Ratio_OD', $Ratio_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}

			</div>
			<div class="col-md-5">

			{{-- Form::select('Ratio_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Ratio OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Ratio OS', $defaultValues)?$defaultValues['Ratio OS']:null, array('class'=> 'form-control select2')) --}}

			{{ Form::text('Ratio_OS', Request::old('Ratio_OS', $Ratio_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}

			</div>

			<!-- <div class="col-md-4">
			<button type="button" name="add" id='CDRatiobtn' class="btn btn-success ">Set Option </button>
			<button type='button' class="btn btn-primary" id='CDRatiobtnsave'>Save Option</button>
			</div> -->

			<div id='CDRatioTextBoxesGroup' class="col-md-12">

			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
			<div class="form-group labelgrp">
			<label>Pachymetry  </label>
			</div>
			</div>
			<div class="col-md-5">

{{ Form::text('Pachymetry_OD', Request::old('Pachymetry_OD', array_key_exists('Pachymetry_OD', $defaultValues)?$defaultValues['Pachymetry_OD']:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">

{{ Form::text('Pachymetry_OS', Request::old('Pachymetry_OS', array_key_exists('Pachymetry_OS', $defaultValues)?$defaultValues['Pachymetry_OS']:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

			<div id='PachymetryTextBoxesGroup' class="col-md-12">

			</div>

		</div>

		<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		<label>C.C.T.  </label>
		</div>  
		</div>
		


		<div class="col-md-5">

{{ Form::text('CCT_OD', Request::old('CCT_OD', array_key_exists('CCT_OD', $defaultValues)?$defaultValues['CCT_OD']:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">

{{ Form::text('CCT_OS', Request::old('CCT_OS', array_key_exists('CCT_OS', $defaultValues)?$defaultValues['CCT_OS']:null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

		<!-- <div class="col-md-4">
		<button type="button" name="add" id='cctbtn' class="btn btn-success ">Set Option </button>
		<button type='button' class="btn btn-primary" id='cctbtnsave'>Save Option</button>
		</div> -->

		<div id='cctTextBoxesGroup' class="col-md-12">

		</div>

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
	</div>

</div>
