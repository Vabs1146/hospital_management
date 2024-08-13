<div class="col-md-12">
	<div class="table-responsive">
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
					<td>AR Undilated</td>
					<td>
						<!-- {{ Form::text('sph_r_undi', Request::old('sph_r_undi', $form_details->sph_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="sph_r_undi" class="form-control" style=" width: 90px; ">
							<option value="">Select</option>
							@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
							<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_r_undi) &&  $form_details->sph_r_undi == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
							@endforeach
						</select>
					</td>
					<td>
						<!-- {{ Form::text('cyl_r_undi', Request::old('cyl_r_undi', $form_details->cyl_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="cyl_r_undi" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_r_undi) &&  $form_details->cyl_r_undi == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>
					<td>
						{{ Form::text('Axis_r_undi', Request::old('Axis_r_undi', $form_details->Axis_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
						<!-- {{ Form::text('Vision_r_undi', Request::old('Vision_r_undi', $form_details->Vision_r_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="Vision_r_undi" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_r_undi) &&  $form_details->Vision_r_undi == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>


					<td>
						<!-- {{ Form::text('sph_l_undi', Request::old('sph_l_undi', $form_details->sph_l_undi), array('class'
									=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="sph_l_undi" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_l_undi) &&  $form_details->sph_l_undi == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>
					<td>
						<!-- {{ Form::text('cyl_l_undi', Request::old('cyl_l_undi', $form_details->cyl_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="cyl_l_undi" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_l_undi) &&  $form_details->cyl_l_undi == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>
					<td>
						{{ Form::text('Axis_l_undi', Request::old('Axis_l_undi', $form_details->Axis_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }}

					</td>
					<td>
						<!-- {{ Form::text('Vision_l_undi', Request::old('Vision_l_undi', $form_details->Vision_l_undi), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="Vision_l_undi" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_l_undi) &&  $form_details->Vision_l_undi == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td>Subjective Undilated</td>
					<td>
					<!-- {{ Form::text('sph_r_undi_sub', Request::old('sph_r_undi_sub', $form_details->sph_r_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					-->
					<select name="sph_r_undi_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_r_undi_sub) &&  $form_details->sph_r_undi_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					<!-- {{ Form::text('cyl_r_undi_sub', Request::old('cyl_r_undi_sub', $form_details->cyl_r_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					-->
					<select name="cyl_r_undi_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_r_undi_sub) &&  $form_details->cyl_r_undi_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					{{ Form::text('Axis_r_undi_sub', Request::old('Axis_r_undi_sub', $form_details->Axis_r_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					<!-- {{ Form::text('Vision_r_undi_sub', Request::old('Vision_r_undi_sub', $form_details->Vision_r_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="Vision_r_undi_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_r_undi_sub) &&  $form_details->Vision_r_undi_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>

					<td>
					<!-- {{ Form::text('sph_l_undi_sub', Request::old('sph_l_undi_sub', $form_details->sph_l_undi_sub), array('class'
					=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="sph_l_undi_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_l_undi_sub) &&  $form_details->sph_l_undi_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					<!-- {{ Form::text('cyl_l_undi_sub', Request::old('cyl_l_undi_sub', $form_details->cyl_l_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					-->
					<select name="cyl_l_undi_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_l_undi_sub) &&  $form_details->cyl_l_undi_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					{{ Form::text('Axis_l_undi_sub', Request::old('Axis_l_undi_sub', $form_details->Axis_l_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					<!-- {{ Form::text('Vision_l_undi_sub', Request::old('Vision_l_undi_sub', $form_details->Vision_l_undi_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="Vision_l_undi_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_l_undi_sub) &&  $form_details->Vision_l_undi_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
				</tr>
				
				<tr><td></td><td colspan="8"><span class="btn btn-info" id="first_send_to_dv">Send to D.V.</span></td></tr>

<!-- ================================================================================================= -->

				<tr>
					<td>AR Dilated</td>
					<td>
						<!-- {{ Form::text('sph_r_di', Request::old('sph_r_di', $form_details->sph_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="sph_r_di" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_r_di) &&  $form_details->sph_r_di == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>
					<td>
						<!-- {{ Form::text('cyl_r_di', Request::old('cyl_r_di', $form_details->cyl_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="cyl_r_di" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_r_di) &&  $form_details->cyl_r_di == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>
					<td>
						{{ Form::text('Axis_r_di', Request::old('Axis_r_di', $form_details->Axis_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
						<!-- {{ Form::text('Vision_r_di', Request::old('Vision_r_di', $form_details->Vision_r_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

						<select name="Vision_r_di" class="form-control" style=" width: 90px; ">
						<option value="">Select</option>
						@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
						<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_r_di) &&  $form_details->Vision_r_di == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
						@endforeach
						</select>
					</td>

					<td>
					<!-- {{ Form::text('sph_l_di', Request::old('sph_l_di', $form_details->sph_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="sph_l_di" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_l_di) &&  $form_details->sph_l_di == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					<!-- {{ Form::text('cyl_l_di', Request::old('cyl_l_di', $form_details->cyl_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="cyl_l_di" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_l_di) &&  $form_details->cyl_l_di == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					{{ Form::text('Axis_l_di', Request::old('Axis_l_di', $form_details->Axis_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					<!-- {{ Form::text('Vision_l_di', Request::old('Vision_l_di', $form_details->Vision_l_di), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="Vision_l_di" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_l_di) &&  $form_details->Vision_l_di == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
				</tr>
				<tr>
					<td>Subjective Dilated</td>
					<td>
					<!-- {{ Form::text('sph_r_di_sub', Request::old('sph_r_di_sub', $form_details->sph_r_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="sph_r_di_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_r_di_sub) &&  $form_details->sph_r_di_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					<!-- {{ Form::text('cyl_r_di_sub', Request::old('cyl_r_di_sub', $form_details->cyl_r_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="cyl_r_di_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_r_di_sub) &&  $form_details->cyl_r_di_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					{{ Form::text('Axis_r_di_sub', Request::old('Axis_r_di_sub', $form_details->Axis_r_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					<!-- {{ Form::text('Vision_r_di_sub', Request::old('Vision_r_di_sub', $form_details->Vision_r_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="Vision_r_di_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_r_di_sub) &&  $form_details->Vision_r_di_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>

					<td>
					<!-- {{ Form::text('sph_l_di_sub', Request::old('sph_l_di_sub', $form_details->sph_l_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="sph_l_di_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->sph_l_di_sub) &&  $form_details->sph_l_di_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					<!-- {{ Form::text('cyl_l_di_sub', Request::old('cyl_l_di_sub', $form_details->cyl_l_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="cyl_l_di_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->cyl_l_di_sub) &&  $form_details->cyl_l_di_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
					<td>
					{{ Form::text('Axis_l_di_sub', Request::old('Axis_l_di_sub', $form_details->Axis_l_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
					</td>
					<td>
					<!-- {{ Form::text('Vision_l_di_sub', Request::old('Vision_l_di_sub', $form_details->Vision_l_di_sub), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->

					<select name="Vision_l_di_sub" class="form-control" style=" width: 90px; ">
					<option value="">Select</option>
					@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
					<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $form_details->Vision_l_di_sub) &&  $form_details->Vision_l_di_sub == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
					@endforeach
					</select>
					</td>
				</tr>
				<tr><td></td><td colspan="8"><span class="btn btn-info" id="second_send_to_dv">Send to D.V.</span></td></tr>
			</tbody>
		</table>
	</div>
</div>


<script>
$(document).on('click', '#first_send_to_dv', function() {
	//alert('One clicked');

	var sph_r_undi = $('select[name=sph_r_undi_sub]').val();
	var cyl_r_undi = $('select[name=cyl_r_undi_sub]').val();
	var Axis_r_undi = $('input[name=Axis_r_undi_sub]').val();
	var Vision_r_undi = $('select[name=Vision_r_undi_sub]').val();
	
	var sph_l_undi = $('select[name=sph_l_undi_sub]').val();
	var cyl_l_undi = $('select[name=cyl_l_undi_sub]').val();
	var Axis_l_undi = $('input[name=Axis_l_undi_sub]').val();
	var Vision_l_undi = $('select[name=Vision_l_undi_sub]').val();

	$('select[name=r_dv_sph]').val(sph_r_undi);
	$('select[name=r_dv_sph]').change();
	$('select[name=r_dv_cyl]').val(cyl_r_undi);
	$('input[name=r_dv_axi]').val(Axis_r_undi);
	$('select[name=r_dv_vision]').val(Vision_r_undi);

	$('select[name=l_dv_sph]').val(sph_l_undi);
	$('select[name=l_dv_cyl]').val(cyl_l_undi);
	$('input[name=l_dv_axi]').val(Axis_l_undi);
	$('select[name=l_dv_vision]').val(Vision_l_undi);

	calculate_sph();
	calculate_sph_l();
});

$(document).on('click', '#second_send_to_dv', function() {
	//alert('Two clicked');

	//var sph_r_di = $('select[name="sph_r_di"] options:selected').val();
	var sph_r_di = $('select[name="sph_r_di_sub"]').val();
	var cyl_r_di = $('select[name=cyl_r_di_sub]').val();
	var Axis_r_di = $('input[name=Axis_r_di_sub]').val();
	var Vision_r_di = $('select[name=Vision_r_di_sub]').val();

	var sph_l_di = $('select[name=sph_l_di_sub]').val();
	var cyl_l_di = $('select[name=cyl_l_di_sub]').val();
	var Axis_l_di = $('input[name=Axis_l_di_sub]').val();
	var Vision_l_di = $('select[name=Vision_l_di_sub]').val();

	//console.log(sph_r_di, cyl_r_di, Axis_r_di, Vision_r_di);

	$('select[name=r_dv_sph]').val(sph_r_di);
	$('select[name=r_dv_sph]').change();
	$('select[name=r_dv_cyl]').val(cyl_r_di);
	$('input[name=r_dv_axi]').val(Axis_r_di);
	$('select[name=r_dv_vision]').val(Vision_r_di);

	$('select[name=l_dv_sph]').val(sph_l_di);
	$('select[name=l_dv_cyl]').val(cyl_l_di);
	$('input[name=l_dv_axi]').val(Axis_l_di);
	$('select[name=l_dv_vision]').val(Vision_l_di);

	calculate_sph();
	calculate_sph_l();
});
</script>
