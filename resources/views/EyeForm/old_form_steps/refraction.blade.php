<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Refraction" aria-expanded="true" aria-controls="Refraction">
		Refraction
		</a>
	</h4>
</div>
<div id="Refraction" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
		<div id="Glaucoma" class="ContainerToAppend dropdown-container">
			<div class="col-md-12">
				<div class="col-md-1">
					<div class="form-group labelgrp">
					<label> IOP  </label>
					</div>      
				</div>
				<div class="col-md-4">
				{{ Form::select('IOP_OD', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IOP_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('IOP_OD', $defaultValues)?$defaultValues['IOP_OD']:null, array('class'=> 'form-control select2 iop-field','data-live-search'=>'true', 'id' => 'iop_od_field')) }}
				<input readonly class="form-control" type="text" name="iop_od_time" id="iop_od_time" value="{{isset($defaultValues['iop_od_time']) ? $defaultValues['iop_od_time'] : ''}}"> 
				</div>
				

				<div class="col-md-4">
				{{ Form::select('IOP_OS', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'IOP_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('IOP_OS', $defaultValues)?$defaultValues['IOP_OS']:null, array('class'=> 'form-control select2  iop-field','data-live-search'=>'true', 'id' => 'iop_os_field')) }}
				<input readonly class="form-control" type="text" name="iop_os_time" id="iop_os_time" value="{{isset($defaultValues['iop_os_time']) ? $defaultValues['iop_os_time'] : ''}}">
				
					
				</div>

				<div class="col-md-3">
				<button type="button" name="add" id='IOPbtn' class="btn btn-success  set-dropdown-options"  data-field_name="IOP_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='IOPbtnsave'>Save Option</button>
				</div>
			</div>
			<div id='IOPTextBoxesGroup' class="col-md-12">

			</div>

			<!-- ================================================================================= -->

			<!-- set-dropdown-options -->
			<!-- <span class="dropdown-container"> -->
			<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
			@php 
			$dropdown_options_field_name = 'IOP_OS';
			$dropdown_options_form_name = 'EyeForm';
			@endphp
			{{--@include('comman_templates.dropdown_options_update')--}}
			</div>

			<!-- ================================================================================= -->

		</div>
		<!-- <div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th colspan="3" class="text-center">Right</th>
							<th colspan="3" class="text-center">Left</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>SPH</th>
							<th>CYL</th>
							<th>Axis</th>
							<th>SPH</th>
							<th>CYL</th>
							<th>Axis</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>AR Undilated</td>
							<td>
							{{ Form::text('sph_r_undi', Request::old('sph_r_undi', $form_details->sph_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('cyl_r_undi', Request::old('cyl_r_undi', $form_details->cyl_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('Axis_r_undi', Request::old('Axis_r_undi', $form_details->Axis_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('sph_l_undi', Request::old('sph_l_undi', $form_details->sph_l_undi), array('class'
							=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('cyl_l_undi', Request::old('cyl_l_undi', $form_details->cyl_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('Axis_l_undi', Request::old('Axis_l_undi', $form_details->Axis_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
						</tr>
						<tr>
							<td>AR Dilated</td>
							<td>
							{{ Form::text('sph_r_di', Request::old('sph_r_di', $form_details->sph_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('cyl_r_di', Request::old('cyl_r_di', $form_details->cyl_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('Axis_r_di', Request::old('Axis_r_di', $form_details->Axis_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('sph_l_di', Request::old('sph_l_di', $form_details->sph_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('cyl_l_di', Request::old('cyl_l_di', $form_details->cyl_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
							<td>
							{{ Form::text('Axis_l_di', Request::old('Axis_l_di', $form_details->Axis_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div> -->

		<!-- <div class="col-md-12">
			<div class="col-md-2">
				{{-- <input type="button" value="CheckCanvas" id="checkCanvas"> --}}
			</div>
			<div class="col-md-5">
				<div class="col-md-6">
					<div class="example1" data-example="retino_scopy_OD">
					<div class="board" id="retino_scopy_OD_canvas"  style="min-height:150px"></div>
					</div>
					<input type="hidden" name="retino_scopy_OD" id="retino_scopy_OD">
				</div>
				<div class="col-md-6" style="min-height:100px">
					@if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD))   
					<button type="button" value="retino_scopy_OD" class="ImageDelete pull-right" >Delete</button>
					<p>&nbsp;</p>
					<center id="wPaint-retino_scopy_OD"> 
					<img src={{ Storage::disk('local')->url($form_details->retino_scopy_OD)."?".filemtime(Storage::path($form_details->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
					</center>
					@endif
				</div>
			</div>
			<div class="col-md-5">
				<div class="col-md-6">
					<div class="example1" data-example1="retino_scopy_OS">
					<div class="board" id="retino_scopy_OS_canvas" style="min-height:150px"></div>
					</div>
					<input type="hidden" name="retino_scopy_OS" id="retino_scopy_OS">
				</div>
				<div class="col-md-6">
					@if (!empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))
					<button type="button" value="retino_scopy_OS" class="ImageDelete pull-right" >Delete</button>
					<p>&nbsp;</p>
					<center id="wPaint-retino_scopy_OS"> 
					<img src={{ Storage::disk('local')->url($form_details->retino_scopy_OS)."?".filemtime(Storage::path($form_details->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
					</center>
					@endif
				</div>
			</div>
		</div> --> 

		@include('EyeForm.steps.refraction.one')

		@include('EyeForm.steps.refraction.two')

		<!--==================================================================-->
<div class="col-md-12">
	<h1>Retinoscopy</h1>
	<div class="col-md-2">
	{{-- <input type="button" value="CheckCanvas" id="checkCanvas"> --}}
	</div>
	<div class="col-md-5">
	<div class="col-md-6">
	<div class="example1" data-example="retino_scopy_OD">
	<div class="board" id="retino_scopy_OD_canvas"  style="min-height:150px"></div>
	</div>
	<input type="hidden" name="retino_scopy_OD" id="retino_scopy_OD">
	</div>
	<div class="col-md-6" style="min-height:100px">
	@if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD))   
	<button type="button" value="retino_scopy_OD" class="ImageDelete pull-right" >Delete</button>
	<p>&nbsp;</p>
	<center id="wPaint-retino_scopy_OD"> 
	<img src={{ Storage::disk('local')->url($form_details->retino_scopy_OD)."?".filemtime(Storage::path($form_details->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
	</center>
	@endif
	</div>
	</div>
	<div class="col-md-5">
	<div class="col-md-6">
	<div class="example1" data-example1="retino_scopy_OS">
	<div class="board" id="retino_scopy_OS_canvas" style="min-height:150px"></div>
	</div>
	<input type="hidden" name="retino_scopy_OS" id="retino_scopy_OS">
	</div>
	<div class="col-md-6">
	@if (!empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))
	<button type="button" value="retino_scopy_OS" class="ImageDelete pull-right" >Delete</button>
	<p>&nbsp;</p>
	<center id="wPaint-retino_scopy_OS"> 
	<img src={{ Storage::disk('local')->url($form_details->retino_scopy_OS)."?".filemtime(Storage::path($form_details->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
	</center>
	@endif
	</div>
	</div>
</div> 

<!--==============================================================-->
@include('EyeForm.steps.refraction.three')

<div class="col-md-12 set-new-option-parent-container">
	<div class="row set-new-option-container">
		<div class="col-md-3">
		SPH
		</div>
		<div class="col-md-6">
			<span class="set-new-option btn btn-info" data-type="sph">Set Option</span>
			<input class="save-new-option btn btn-default" type="submit" name="sph_option" value="Save Option">
			<span class="refraction-option-modify-button btn btn-warning" data-type="sph">Modify Option</span>
		</div>
		<div class="set-new-option-input row"></div>

		<div class="update-new-option-input row d-none">
			{{--
			@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_id => $refraction_dropdowns_arr_row)
			<input type="hidden" name="all_option_ids[sph][]" value="{{$refraction_dropdowns_arr_id}}">
			<div class="col-md-3">
				<div class="input-group">
					<div class="form-line">
						<input class="form-control" type="hidden" name="single_update_field_id[sph][]" value="{{$refraction_dropdowns_arr_id}}">
						<input class="form-control" type="text" placeholder="value" name="update_option_values[sph][]" value="{{$refraction_dropdowns_arr_row}}">
					</div>
					<span class="input-group-addon refraction-option-remove-button" type="button" >
						<i class="fa fa-times" aria-hidden="true"></i>
					</span>
				</div>
			</div>
				@endforeach
			<div class="col-md-3">
				<input class="update-option btn btn-success" type="submit" name="sph_option_update" value="Update SPH">
				<span class="cancel-update-option btn btn-info" data-type="sph">Cancel</span>
			</div>
			--}}
		</div>
	</div>
	<hr>
	<div class="row set-new-option-container">
		<div class="col-md-3">
		CYL
		</div>
		<div class="col-md-6">
			<span class="set-new-option btn btn-info" data-type="cyl">Set Option</span>
			<input class="save-new-option btn btn-default" type="submit" name="sph_option" value="Save Option">
			<span class="refraction-option-modify-button btn btn-warning" data-type="cyl">Modify Option</span>
		</div>
		<div class="set-new-option-input row"></div>
		<div class="update-new-option-input row d-none">
		{{--
			@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_id => $refraction_dropdowns_arr_row)
			<input type="hidden" name="all_option_ids[cyl][]" value="{{$refraction_dropdowns_arr_id}}">
			<div class="col-md-3">
				<div class="input-group">
					<div class="form-line">
						<input class="form-control" type="hidden" name="single_update_field_id[cyl][]" value="{{$refraction_dropdowns_arr_id}}">
						<input class="form-control" type="text" placeholder="value" name="update_option_values[cyl][]" value="{{$refraction_dropdowns_arr_row}}">
					</div>
					<span class="input-group-addon refraction-option-remove-button" type="button" >
						<i class="fa fa-times" aria-hidden="true"></i>
					</span>
				</div>
			</div>
			@endforeach
			<div class="col-md-3">
				<input class="update-option btn btn-success" type="submit" name="cyl_option_update" value="Update CYL">
				<span class="cancel-update-option btn btn-info" data-type="cyl">Cancel</span>
			</div>
		--}}
		</div>
	</div>
	<hr>
	<div class="row set-new-option-container">
		<div class="col-md-3">
		VISION
		</div>
		<div class="col-md-6">
			<span class="set-new-option btn btn-info" data-type="vision">Set Option</span>
			<input class="save-new-option btn btn-default" type="submit" name="sph_option" value="Save Option">
			<span class="refraction-option-modify-button btn btn-warning" data-type="vision">Modify Option</span>
		</div>
		<div class="set-new-option-input row"></div>
		<div class="update-new-option-input row d-none">
		{{--
			@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_id => $refraction_dropdowns_arr_row)
			<input type="hidden" name="all_option_ids[vision][]" value="{{$refraction_dropdowns_arr_id}}">
			<div class="col-md-3">
				<div class="input-group">
					<div class="form-line">
						<input class="form-control" type="hidden" name="single_update_field_id[vision][]" value="{{$refraction_dropdowns_arr_id}}">
						<input class="form-control" type="text" placeholder="value" name="update_option_values[vision][]" value="{{$refraction_dropdowns_arr_row}}">
					</div>
					<span class="input-group-addon refraction-option-remove-button" type="button" >
						<i class="fa fa-times" aria-hidden="true"></i>
					</span>
				</div>
			</div>
			@endforeach
			<div class="col-md-3">
				<input class="update-option btn btn-success" type="submit" name="vision_option_update" value="Update VISION">
				<span class="cancel-update-option btn btn-info" data-type="vision">Cancel</span>
			</div>
		--}}
		</div>
	</div>
</div>


<!--==================================================================-->

	</div>

</div>

<script>
$(document).ready(function() {
	$('.iop-field').on('select2:select', function (e) {
		var time = new Date();
		var time_selected = time.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
		//alert(time_selected);

		$(this).closest('.col-md-4').find('input').val(time_selected);
	});
});
/*
$('#refraction_table input[name="r_dv_sph"]').blur(function(){
  calculate_sph();
});
$('#refraction_table input[name="r_add_sph"]').blur(function(){
  calculate_sph();
});

function calculate_sph() {
var sph = $('#refraction_table input[name="r_dv_sph"]').val();
var add = $('#refraction_table input[name="r_add_sph"]').val();
	sph = (!isNaN(parseFloat(sph))) ? parseFloat(sph) : 0;
	add = (!isNaN(parseFloat(add))) ? parseFloat(add) : 0;

	var adition_value = sph + add;

	var addition_text = (adition_value  >= 0 ) ? '+'+ adition_value : adition_value;


	$('#refraction_table input[name="r_nv_sph"]').val(addition_text);
}
*/

$('#refraction_table select[name="r_dv_sph"]').change(function(){
  calculate_sph();
});
$('#refraction_table input[name="r_add_sph"]').blur(function(){
  calculate_sph();
});

function calculate_sph() {
	var sph = $('#refraction_table select[name="r_dv_sph"]').val();
	var add = $('#refraction_table input[name="r_add_sph"]').val();
	sph = (!isNaN(parseFloat(sph))) ? parseFloat(sph) : 0;
	add = (!isNaN(parseFloat(add))) ? parseFloat(add) : 0;

	var adition_value = sph + add;

	var addition_text = (adition_value  >= 0 ) ? '+'+ adition_value : adition_value;
	$('#refraction_table input[name="r_nv_sph"]').val(addition_text);
}


/*
$('#refraction_table input[name="l_dv_sph"]').blur(function(){
  calculate_sph_l();
});
$('#refraction_table input[name="l_add_sph"]').blur(function(){
  calculate_sph_l();
});
*/

$('#refraction_table select[name="l_dv_sph"]').change(function(){
  calculate_sph_l();
});
$('#refraction_table input[name="l_add_sph"]').blur(function(){
  calculate_sph_l();
});

function calculate_sph_l() {
	var sph = $('#refraction_table select[name="l_dv_sph"]').val();
	var add = $('#refraction_table input[name="l_add_sph"]').val();
	sph = (!isNaN(parseFloat(sph))) ? parseFloat(sph) : 0;
	add = (!isNaN(parseFloat(add))) ? parseFloat(add) : 0;
	var adition_value = sph + add;

	var addition_text =  (adition_value  >= 0 ) ? '+'+ adition_value : adition_value;

	$('#refraction_table input[name="l_nv_sph"]').val(addition_text);
}


$('#refraction_table select[name="r_dv_cyl"]').change(function(){
	//alert('hi');
  $('#refraction_table select[name="r_nv_cyl"]').val($('#refraction_table select[name="r_dv_cyl"]').val());
});

$('#refraction_table input[name="r_dv_axi"]').blur(function(){
  $('#refraction_table input[name="r_nv_axi"]').val($('#refraction_table input[name="r_dv_axi"]').val());
});

$('#refraction_table select[name="l_dv_cyl"]').change(function(){
  $('#refraction_table select[name="l_nv_cyl"]').val($('#refraction_table select[name="l_dv_cyl"]').val());
});

$('#refraction_table input[name="l_dv_axi"]').blur(function(){
  $('#refraction_table input[name="l_nv_axi"]').val($('#refraction_table input[name="l_dv_axi"]').val());
});


$(document).on('click', '.set-new-option', function() {
	//alert('hi');
	var type= $(this).data('type');

	var input_html = '<div class="col-md-3"><div class="input-group"><div class="form-line"><input class="form-control" type="hidden" name="fieldName['+type+']" value="'+type+'"><input class="form-control" type="text" id="optionsval" placeholder="value" name="optionsval['+type+'][]"></div><span class="input-group-addon refraction-option-remove-button" type="button" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';

	$(this).closest('.set-new-option-container').find('.set-new-option-input').append(input_html);
});

$('.save-new-option').click(function () {
	var data=$(".set-new-option-parent-container input").serialize();
	event.preventDefault();
	$.ajax({
		url:'{{ route("refraction-options.insert") }}',
		method:'post',
		data:data,
		success:function(data) {
			swal({title: "Option For Refraction", text: "Added Successfully!", type: "success"},
				function(){ 
					location.reload();
				}
			);
		}
	})
});

//$('.update-option').click(function () {
$(document).on('click', '.update-option', function() {
	//var data=$(".set-new-option-parent-container input").serialize();

	var data=$(this).closest('.update-new-option-input').find('input').serialize();
	event.preventDefault();
	$.ajax({
		url:'{{ route("refraction-options.update") }}',
		method:'post',
		data:data,
		success:function(data) {
			swal({title: "Option For Refraction", text: "Added Successfully!", type: "success"},
				function(){ 
					location.reload();
				}
			);
		}
	})
});

$(document).on('click', '.refraction-option-remove-button', function() {
	$(this).closest('.col-md-3').remove();
});

$(document).on('click', '.refraction-option-modify-button', function() {
	var data=$(this).closest('.set-new-option-container').find('.update-new-option-input').show();
	
	//======================================================================
	var data_type = $(this).data('type');
	
	var element_to_show = $(this).closest('.set-new-option-container').find('.update-new-option-input');

//refraction_dropdowns
	$.ajax({
		url:"{{url('get-update-refration-dropdown-options')}}",
		method:'post',
		data:{'type': data_type},
		datatype: 'json',
		success:function(response) {
			console.log(response);
			
			element_to_show.html(response.view);
		}
	});
	//=======================================================================
});

$(document).on('click', '.cancel-update-option', function() {
	$(this).closest('.update-new-option-input').html('');
	var data=$(this).closest('.update-new-option-input').hide();
});

</script>
