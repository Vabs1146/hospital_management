<div class="col-md-12">
<table style="width:100%;" style="border:1px solid;" id="menses_table">
<tr style="border:1px solid;">
	<th style="width:90px;">Date</th>
	<th style="width:90px;">DAY OF MENSES</th>
	<th style="width:90px;">DAY OF TABLET</th>
	<th style="width:90px;">ET</th>
	<th>DOSES
		<div class="doses-row">
			<span style="width:100px;display: inline-block;">Medicine</span>
			<span style="width:100px;display: inline-block;">Duration</span>
			<span style="width:100px;display: inline-block;">Time</span>
			<span></span>
		</div>
	</th>
	<th>NOTES</th>
	<th  style="width:30px;"></th>
</tr>
@php
	$parent_tr_id_key = "1";
@endphp
@foreach($ivf_menses_data as $ivf_od_menses_row)
<input type="hidden" name="od_menses_all_old_ids[]" value="{{$ivf_od_menses_row->id}}">

	@include('ivf.elements.view.od_menses_update_tr', ['ivf_od_menses_row' => $ivf_od_menses_row, 'ivf_menses_dosage_data' => $ivf_menses_dosage_data, 'od_menses_old_id' => $ivf_od_menses_row->id])
	
	@php
		$parent_tr_id_key = 1 + $ivf_od_menses_row->id;
	@endphp
@endforeach

</table>


</div>