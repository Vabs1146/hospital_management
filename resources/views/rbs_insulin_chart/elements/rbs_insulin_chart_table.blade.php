<div class="col-md-12">
<table style="width:100%;" style="border:1px solid;">
<tr style="border:1px solid;">
	<th>Date</th>
	<th>Time</th>
	<th>HGT</th>
	<th>U Sugar</th>
	<th>U. ACENOTE</th>
	<th>INSULIN GIVEN</th>
</tr>

@foreach($rbs_insulin_chart_data as $rbs_insulin_chart_data_row)
<input type="hidden" name="rbs_insulin_chart_all_old_id[]" value="{{$rbs_insulin_chart_data_row->id}}">
<tr style="border:1px solid;" class="menses-row">
	<input type="hidden" name="rbs_insulin_chart_old_id[]" value="{{$rbs_insulin_chart_data_row->id}}">
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_date[]', $rbs_insulin_chart_data_row->date, array('class' => 'form-control datepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_time[]', $rbs_insulin_chart_data_row->time, array('class' => 'form-control timepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_hgt[]', $rbs_insulin_chart_data_row->hgt, array('class' => 'form-control ')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_u_sugar[]', $rbs_insulin_chart_data_row->u_sugar, array('class' => 'form-control ')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_u_acetone[]', $rbs_insulin_chart_data_row->u_acetone, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_insuline_given[]', $rbs_insulin_chart_data_row->insuline_given, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td><span class="btn btn-danger icsi-menses-remove" >remove</span></td>
</tr>
@endforeach

<tr style="border:1px solid;">
	<input type="hidden" name="rbs_insulin_chart_old_id[]" value="">
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_date[]', null, array('class' => 'form-control datepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_time[]', null, array('class' => 'form-control timepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_hgt[]', null, array('class' => 'form-control ')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_u_sugar[]', null, array('class' => 'form-control ')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_u_acetone[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rbs_insulin_chart_insuline_given[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td></td>
</tr>
</table>

<script>
$(document).on('click', '.icsi-menses-remove', function(e) {
		$(this).closest('.menses-row').remove();
	});
</script>
</div>