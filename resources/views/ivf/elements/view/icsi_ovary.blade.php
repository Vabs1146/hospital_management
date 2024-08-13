<style>
#append_data_1 table, #append_data_1 tr, #append_data_1 th, #append_data_1 td {
	border:1px solid;
}
</style>
<div class="col-md-12" id="append_data_1" >
<table style="width:100%;">
	<tr>
		<th>DAY / DATE</th>
		<th>RIGHT OVAR</th>
		<th>LEFT OVARY</th>
		<th>MI</th>
	</tr>
	@foreach($ivf_icsi_ovary as $ivf_icsi_ovary_row)
	<tr>
		<td>{{$ivf_icsi_ovary_row->ivf_icsi_ovary_date}}</td>
		<td>{{$ivf_icsi_ovary_row->ivf_icsi_ovary_right}}</td>
		<td>{{$ivf_icsi_ovary_row->ivf_icsi_ovary_left}}</td>
		<td>{{$ivf_icsi_ovary_row->ivf_icsi_ovary_mi}}</td>
	</tr>
	
	@endforeach
</table>
	
</div>