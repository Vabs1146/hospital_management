<div class="col-md-12">
<div class="table-responsive">
<!-- <h1>Refraction</h1> -->
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
	<td>Retinoscopy</td>
	<td>
		<!-- {{ Form::text('r_retinoscopy_sph', Request::old('r_retinoscopy_sph', $form_details->r_retinoscopy_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
<select name="r_retinoscopy_sph" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->r_retinoscopy_sph) &&  $form_details->r_retinoscopy_sph == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
		<!-- {{ Form::text('r_retinoscopy_cyl', Request::old('r_retinoscopy_cyl', $form_details->r_retinoscopy_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			 -->
<select name="r_retinoscopy_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->r_retinoscopy_cyl) &&  $form_details->r_retinoscopy_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
		{{ Form::text('r_retinoscopy_axi', Request::old('r_retinoscopy_axi', $form_details->r_retinoscopy_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	
</td>
	<td>
		<!-- {{ Form::text('r_retinoscopy_vision', Request::old('r_retinoscopy_vision', $form_details->r_retinoscopy_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_retinoscopy_vision" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->r_retinoscopy_vision) &&  $form_details->r_retinoscopy_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>

	<td>
		<!-- {{ Form::text('l_retinoscopy_sph', Request::old('l_retinoscopy_sph', $form_details->l_retinoscopy_sph??''), array('class' => 'form-control', 'autocomplete'=>'off')) }}
			 -->
<select name="l_retinoscopy_sph" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->l_retinoscopy_sph) &&  $form_details->l_retinoscopy_sph == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
		<!-- {{ Form::text('l_retinoscopy_cyl', Request::old('l_retinoscopy_cyl', $form_details->l_retinoscopy_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			 -->
<select name="l_retinoscopy_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->l_retinoscopy_cyl) &&  $form_details->l_retinoscopy_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
		{{ Form::text('l_retinoscopy_axi', Request::old('l_retinoscopy_axi', $form_details->l_retinoscopy_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	

	</td>
	<td>
		<!-- {{ Form::text('l_retinoscopy_vision', Request::old('l_retinoscopy_vision', $form_details->l_retinoscopy_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_retinoscopy_vision" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->l_retinoscopy_vision) &&  $form_details->l_retinoscopy_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
</tr>

</tbody>
</table>
</div>
</div>