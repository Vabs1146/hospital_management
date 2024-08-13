<div class="col-md-12">
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
	{{-- Form::text('vision_pgp_dv_sph_r', Request::old('vision_pgp_dv_sph_r', $form_details->vision_pgp_dv_sph_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_dv_sph_r" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" data-selected="{{$form_details->vision_pgp_dv_sph_r}}" {{isset($form_details->vision_pgp_dv_sph_r) &&  $form_details->vision_pgp_dv_sph_r == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>

	<td>
	{{-- Form::text('vision_pgp_dv_cyl_r', Request::old('vision_pgp_dv_cyl_r', $form_details->vision_pgp_dv_cyl_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_dv_cyl_r" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset($form_details->vision_pgp_dv_cyl_r) &&  $form_details->vision_pgp_dv_cyl_r == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('vision_pgp_dv_axis_r', Request::old('vision_pgp_dv_axis_r', $form_details->vision_pgp_dv_axis_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('vision_pgp_dv_vision_r', Request::old('vision_pgp_dv_vision_r', $form_details->vision_pgp_dv_vision_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_dv_vision_r" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->vision_pgp_dv_vision_r) &&  $form_details->vision_pgp_dv_vision_r == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>

	<td>
	{{-- Form::text('vision_pgp_dv_sph_l', Request::old('vision_pgp_dv_sph_l', $form_details->vision_pgp_dv_sph_l??''), array('class' => 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_dv_sph_l" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" data-selected="{{$form_details->vision_pgp_dv_sph_l}}" {{isset($form_details->vision_pgp_dv_sph_l) &&  $form_details->vision_pgp_dv_sph_l == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>

	</td>
	<td>
	{{-- Form::text('vision_pgp_dv_cyl_l', Request::old('vision_pgp_dv_cyl_l', $form_details->vision_pgp_dv_cyl_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}

<select name="vision_pgp_dv_cyl_l" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset($form_details->vision_pgp_dv_cyl_l) &&  $form_details->vision_pgp_dv_cyl_l == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('vision_pgp_dv_axis_l', Request::old('vision_pgp_dv_axis_l', $form_details->vision_pgp_dv_axis_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}

	</td>
	<td>
	{{-- Form::text('vision_pgp_dv_vision_l', Request::old('vision_pgp_dv_vision_l', $form_details->vision_pgp_dv_vision_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_dv_vision_l" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->vision_pgp_dv_vision_l) &&  $form_details->vision_pgp_dv_vision_l == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
</tr>




<tr>
	<td>N.V.</td>
	<td>
	{{-- Form::text('vision_pgp_nv_sph_r', Request::old('vision_pgp_nv_sph_r', $form_details->vision_pgp_nv_sph_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_nv_sph_r" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" data-selected="{{$form_details->vision_pgp_nv_sph_r}}" {{isset($form_details->vision_pgp_nv_sph_r) &&  $form_details->vision_pgp_nv_sph_r == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{-- Form::text('vision_pgp_nv_cyl_r', Request::old('vision_pgp_nv_cyl_r', $form_details->vision_pgp_nv_cyl_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_nv_cyl_r" class="form-control" style=" width: 90px; ">
<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset($form_details->vision_pgp_nv_cyl_r) &&  $form_details->vision_pgp_nv_cyl_r == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('vision_pgp_nv_axis_r', Request::old('vision_pgp_nv_axis_r', $form_details->vision_pgp_nv_axis_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('vision_pgp_nv_vision_r', Request::old('vision_pgp_nv_vision_r', $form_details->vision_pgp_nv_vision_r??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_nv_vision_r" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset($form_details->vision_pgp_nv_vision_r) &&  $form_details->vision_pgp_nv_vision_r == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>

	<td>
	{{-- Form::text('vision_pgp_nv_sph_l', Request::old('vision_pgp_nv_sph_l', $form_details->vision_pgp_nv_sph_l??''), array('class'
	=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_nv_sph_l" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" data-selected="{{$form_details->vision_pgp_nv_sph_l}}" {{isset($form_details->vision_pgp_nv_sph_l) &&  $form_details->vision_pgp_nv_sph_l == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{-- Form::text('vision_pgp_nv_cyl_l', Request::old('vision_pgp_nv_cyl_l', $form_details->vision_pgp_nv_cyl_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_nv_cyl_l" class="form-control" style=" width: 90px; ">
<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset($form_details->vision_pgp_nv_cyl_l) &&  $form_details->vision_pgp_nv_cyl_l == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('vision_pgp_nv_axis_l', Request::old('vision_pgp_nv_axis_l', $form_details->vision_pgp_nv_axis_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('vision_pgp_nv_vision_l', Request::old('vision_pgp_nv_vision_l', $form_details->vision_pgp_nv_vision_l??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
<select name="vision_pgp_nv_vision_l" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset($form_details->vision_pgp_nv_vision_l) &&  $form_details->vision_pgp_nv_vision_l == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
</tr>
			</tbody>
		</table>
	</div>
</div>