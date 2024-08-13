<tr style="border:1px solid;" class="od-menses-row">
	@if(isset($od_menses_old_id))
	<input type="hidden" name="od_menses_old_id[]" value="{{$od_menses_old_id}}">
	@endif
	@php
		$parent_tr_id_key = isset($od_menses_old_id) ? $od_menses_old_id : "1";
	@endphp
	<td>
		<div class="form-line">
			{{ $ivf_od_menses_row->menses_injection_date }}    
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_od_menses_row->menses_day }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_od_menses_row->menses_tablet_day }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_od_menses_row->menses_et }}                            
		</div>
	</td>
	<td>
		<div class="doses-medicine-container">
			@include('ivf.elements.view.od_menses_doses_row', ['parent_tr_id_key' => $parent_tr_id_key, 'ivf_menses_dosage_data' => $ivf_menses_dosage_data])
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ $ivf_od_menses_row->notes }}                            
		</div>
	</td>
	
</tr>