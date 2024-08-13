<div class="col-md-12">
<table style="width:100%;" style="border:1px solid;">
<tr style="border:1px solid;">
	<th>Date</th>
	<th>Clinical Notes</th>
	<th>Day</th>
	<th>Treatment Adviced</th>
	<th></th>
</tr>

@foreach($daily_order_sheet_data as $daily_order_sheet_data_row)
<input type="hidden" name="daily_order_sheet_all_old_id[]" value="{{$daily_order_sheet_data_row->id}}">
<tr style="border:1px solid;" class="menses-row">
	<input type="hidden" name="daily_order_sheet_old_id[]" value="{{$daily_order_sheet_data_row->id}}">
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_date[]', $daily_order_sheet_data_row->date, array('class' => 'form-control datepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_clinical_notes[]', $daily_order_sheet_data_row->clinical_notes, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_day[]', $daily_order_sheet_data_row->day, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_treatment_adviced[]', $daily_order_sheet_data_row->treatment_adviced, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td><span class="btn btn-danger icsi-menses-remove" >remove</span></td>
</tr>
@endforeach

<tr style="border:1px solid;">
	<input type="hidden" name="daily_order_sheet_old_id[]" value="">
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_date[]', null, array('class' => 'form-control datepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_clinical_notes[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_day[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('daily_order_sheet_treatment_adviced[]', null, array('class' => 'form-control')) }}                            
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