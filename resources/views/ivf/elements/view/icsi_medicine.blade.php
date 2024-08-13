<style>
#append_data_2 table, #append_data_2 tr, #append_data_2 th, #append_data_2 td {
	border:1px solid;
}
</style>

<div class="col-md-12" id="append_data_2" >

<table style="width:100%;">
	<tr>
		<th>MEDICIN NAME</th>
		<th>Time</th>
		<th>Batch No.</th>
		<th>Exp Date</th>
	</tr>
	@foreach($ivf_icsi_medicine_details as $ivf_icsi_medicine_details_row) 
	<tr>
		<td>{{$ivf_icsi_medicine_details_row->medicine_name}}</td>
		<td>{{$ivf_icsi_medicine_details_row->time}}</td>
		<td>{{$ivf_icsi_medicine_details_row->batch_number}}</td>
		<td>{{$ivf_icsi_medicine_details_row->expiry_date}}</td>
	</tr>
	
	@endforeach
</table>
</div>



