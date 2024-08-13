@php
	$parent_tr_id_key = isset($parent_tr_id_key) ? $parent_tr_id_key : "1";

	//echo "==>>>>>>".$od_menses_old_id.">>>>>> <pre>"; print_r($ivf_menses_dosage_data[$od_menses_old_id]); exit;
@endphp

@if(isset($ivf_menses_dosage_data) && !empty($ivf_menses_dosage_data[$od_menses_old_id]))
@foreach($ivf_menses_dosage_data[$od_menses_old_id] as $ivf_menses_dosage_data_row) 
@php
//echo "==>>>>>>".$od_menses_old_id.">>>>>> <pre>".__LINE__; print_r($ivf_menses_dosage_data_row); exit;
@endphp
<input type="hidden" name="old_menses_dosage_ids[]" value="{{$ivf_menses_dosage_data_row['dosage_id']}}">
<div class="doses-medicine-row">
<input type="hidden" name="old_menses_dosage_id[]" value="{{$ivf_menses_dosage_data_row['dosage_id']}}">
	<span style="width:100px;display: inline-block;">
		<div class="form-line">
			{{ $ivf_menses_dosage_data_row['medicine'] }}                            
		</div>
	</span>
	<span style="width:100px;display: inline-block;">
		<div class="form-line">
			{{ $ivf_menses_dosage_data_row['duration'] }}                            
		</div>
	</span>
	<span style="width:100px;display: inline-block;">
		<div class="form-line">
			{{ $ivf_menses_dosage_data_row['time'] }}                            
		</div>
	</span>
	<!-- <span style="display:none;" class="btn btn-warning od-menses-doses-remove" >-</span>
	<span style="display:none;" class="btn btn-success od-menses-doses-add-more" data-tr_id="{{$parent_tr_id_key}}" >+</span> -->
</div>
@endforeach

@endif