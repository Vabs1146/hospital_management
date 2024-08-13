<style>
#meses_table table, #meses_table tr, #meses_table th, #meses_table td {
	border:1px solid;
}
</style>
<div class="col-md-12" id="meses_table">
<table style="width:100%;" style="border:1px solid;">
<tr style="border:1px solid;">
	<th>Date</th>
	<th>DAY OF MENSES</th>
	<th>DAY OF INJECTION</th>
	<th>TIME OF INJECTION</th>
	<th>INJ FOLISURGE 150</th>
	<th>INJ HMG 150 </th>
	<th>INJ CETRORELIX 150</th>
</tr>

@foreach($ivf_icsi_menses as $ivf_icsi_menses_row)
<input type="hidden" name="icsi_menses_all_old_id[]" value="{{$ivf_icsi_menses_row->id}}">
<tr style="border:1px solid;" class="menses-row">
	<input type="hidden" name="icsi_menses_old_id[]" value="{{$ivf_icsi_menses_row->id}}">
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_injection_date }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_day }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_injection_day }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_injection_time }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_injection_inj_folisurge_150 }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_injection_inj_hmg_150 }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_icsi_menses_row->menses_injection_inj_cetorflix_150 }}                            
		</div>
	</td>
</tr>
@endforeach

</table>

</div>