<style>
#meses_table table, #meses_table tr, #meses_table th, #meses_table td {
	border:1px solid;
}
</style>
<div class="col-md-12" id="meses_table">
<table style="width:100%;" style="border:1px solid;">
<thead>
<tr style="border:1px solid; text-align:center">
	<th colspan=7></th>
	<th colspan=2>INTAKE</th>
	<th colspan=2>OUTPUT</th>
</tr>
<tr style="border:1px solid;">
	<th>Date</th>
	<th>Timing</th>
	<th>Temp</th>
	<th>Pulse</th>
	<th>RESP</th>
	<th>B.P.</th>
	<th>SPO2%</th>
	<th>IV</th>
	<th>R.T.</th>
	<th>Oral</th>
	<th>AG</th>
	<th>Urine</th>
	<th>Aspiration</th>
</tr>
</thead>
<tbody>
@foreach($main_record as $main_record_row)
<tr style="border:1px solid;">
	<td>
		{{ $main_record_row->date }} 
	</td>
	<td>
		{{ $main_record_row->timing }} 
	</td>
	<td>
		{{ $main_record_row->temp }} 
	</td>
	<td>
		{{ $main_record_row->pulse }} 
	</td>
	<td>
		{{ $main_record_row->resp }} 
	</td>
	<td>
		{{ $main_record_row->bp }} 
	</td>
	<td>
		{{ $main_record_row->spo2 }} 
	</td>
	<td>
		{{ $main_record_row->iv }} 
	</td>
	<td>
		{{ $main_record_row->rt }} 
	</td>
	<td>
		{{ $main_record_row->oral }} 
	</td>
	<td>
		{{ $main_record_row->ag }} 
	</td>
	<td>
		{{ $main_record_row->urine }} 
	</td>
	<td>
		{{ $main_record_row->aspiration }} 
	</td>
</tr>
@endforeach
</tbody>
</table>

</div>