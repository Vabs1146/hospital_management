<style>
#meses_table table, #meses_table tr, #meses_table th, #meses_table td {
	border:1px solid;
}
</style>
<div class="col-md-12" id="meses_table">
<table style="width:100%;" style="border:1px solid;">
<tr style="border:1px solid;">
	<th>Date</th>
	<th>Clinical Notes</th>
	<th>Day</th>
	<th>Treatment Adviced</th>
</tr>

@foreach($daily_order_sheet_data as $daily_order_sheet_data_row)
<input type="hidden" name="daily_order_sheet_all_old_id[]" value="{{$daily_order_sheet_data_row->id}}">
<tr style="border:1px solid;" class="menses-row">
	<input type="hidden" name="daily_order_sheet_old_id[]" value="{{$daily_order_sheet_data_row->id}}">
	<td>
		{{ $daily_order_sheet_data_row->date }} 
	</td>
	<td>
		{{ $daily_order_sheet_data_row->clinical_notes }}
	</td>
	<td>
		{{ $daily_order_sheet_data_row->day }}
	</td>
	<td>
		{{ $daily_order_sheet_data_row->treatment_adviced }}  
	</td>
</tr>
@endforeach

</table>

</div>