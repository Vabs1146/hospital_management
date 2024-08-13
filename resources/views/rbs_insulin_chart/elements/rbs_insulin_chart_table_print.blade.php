<style>
#meses_table table, #meses_table tr, #meses_table th, #meses_table td {
	border:1px solid;
}
</style>
<div class="col-md-12" id="meses_table">
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
			{{ $rbs_insulin_chart_data_row->date }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $rbs_insulin_chart_data_row->time }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $rbs_insulin_chart_data_row->hgt }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $rbs_insulin_chart_data_row->u_sugar }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $rbs_insulin_chart_data_row->u_acetone }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $rbs_insulin_chart_data_row->insuline_given }}                            
		</div>
	</td>
</tr>
@endforeach
</table>

</div>