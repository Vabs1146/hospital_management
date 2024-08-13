<div class="col-md-12">
<div class="table-responsive">
<h1>Refraction</h1>
<table class="table table-bordered" id="refraction_table">
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

	<!-- {{ Form::text('r_dv_sph', Request::old('r_dv_sph', $glass_prescription->r_dv_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_dv_sph" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" data-selected="{{$glass_prescription->r_dv_sph}}" {{isset( $glass_prescription->r_dv_sph) &&  $glass_prescription->r_dv_sph == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	<!-- {{ Form::text('r_dv_cyl', Request::old('r_dv_cyl', $glass_prescription->r_dv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_dv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_dv_cyl) &&  $glass_prescription->r_dv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('r_dv_axi', Request::old('r_dv_axi', $glass_prescription->r_dv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	<!-- {{ Form::text('r_dv_vision', Request::old('r_dv_vision', $glass_prescription->r_dv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_dv_vision" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_dv_vision) &&  $glass_prescription->r_dv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>

	<td>
	<!-- {{ Form::text('l_dv_sph', Request::old('l_dv_sph', $glass_prescription->l_dv_sph??''), array('class' => 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_dv_sph" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_dv_sph) &&  $glass_prescription->l_dv_sph == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	<!-- {{ Form::text('l_dv_cyl', Request::old('l_dv_cyl', $glass_prescription->l_dv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_dv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_dv_cyl) &&  $glass_prescription->l_dv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('l_dv_axi', Request::old('l_dv_axi', $glass_prescription->l_dv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	<!-- {{ Form::text('l_dv_vision', Request::old('l_dv_vision', $glass_prescription->l_dv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_dv_vision" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_dv_vision) &&  $glass_prescription->l_dv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
</tr>

<tr>
	<td>Add</td>
	<td>
		{{ Form::text('r_add_sph', Request::old('r_add_sph', $glass_prescription->r_add_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td> </td>
	<td> </td>
	<td> </td>

	<td>
		{{ Form::text('l_add_sph', Request::old('l_add_sph', $glass_prescription->l_add_sph??''), array('class' => 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td> </td>
	<td> </td>
	<td> </td>
</tr>

<tr>
	<td>N.V.</td>
	<td>
	{{ Form::text('r_nv_sph', Request::old('r_nv_sph', $glass_prescription->r_nv_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('r_nv_cyl', Request::old('r_nv_cyl', $glass_prescription->r_nv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}

	<select name="r_nv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_nv_cyl) &&  $glass_prescription->r_nv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>

	</td>
	<td>
	{{ Form::text('r_nv_axi', Request::old('r_nv_axi', $glass_prescription->r_nv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('r_nv_vision', Request::old('r_nv_vision', $glass_prescription->r_nv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
	<select name="r_nv_vision" class="form-control" style=" width: 90px; ">
		<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_nv_vision) &&  $glass_prescription->r_nv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>
	</td>

	<td>
	{{ Form::text('l_nv_sph', Request::old('l_nv_sph', $glass_prescription->l_nv_sph??''), array('class'
	=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('l_nv_cyl', Request::old('l_nv_cyl', $glass_prescription->l_nv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
	<select name="l_nv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_nv_cyl) &&  $glass_prescription->l_nv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>

	</td>
	<td>
	{{ Form::text('l_nv_axi', Request::old('l_nv_axi', $glass_prescription->l_nv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('l_nv_vision', Request::old('l_nv_vision', $glass_prescription->l_nv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
	<select name="l_nv_vision" class="form-control" style=" width: 90px; ">
		<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_nv_vision) &&  $glass_prescription->l_nv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>
	</td>
</tr>
</tbody>
</table>
</div>
</div>