<tr style="border:1px solid;" class="od-menses-row">
	@if(isset($od_menses_old_id))
	<input type="hidden" name="od_menses_old_id[]" value="{{$od_menses_old_id}}">
	@endif
	@php
		$parent_tr_id_key = isset($od_menses_old_id) ? $od_menses_old_id : "1";
	@endphp
	<td>
		<div class="form-line">
			{{ Form::text($hidden.'menses_injection_date['.$parent_tr_id_key.'][]', isset($ivf_od_menses_row->menses_injection_date) ? $ivf_od_menses_row->menses_injection_date : null, array('class' => 'form-control datepicker')) }}    
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text($hidden.'menses_day['.$parent_tr_id_key.'][]', isset($ivf_od_menses_row->menses_day) ? $ivf_od_menses_row->menses_day : null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text($hidden.'menses_tablet_day['.$parent_tr_id_key.'][]', isset($ivf_od_menses_row->menses_tablet_day) ? $ivf_od_menses_row->menses_tablet_day : null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text($hidden.'menses_et['.$parent_tr_id_key.'][]', isset($ivf_od_menses_row->menses_et) ? $ivf_od_menses_row->menses_et : null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="doses-medicine-container">
			@include('ivf.elements.od_menses_doses_row', ['parent_tr_id_key' => $parent_tr_id_key, 'ivf_menses_dosage_data' => $ivf_menses_dosage_data])
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text($hidden.'notes['.$parent_tr_id_key.'][]', isset($ivf_od_menses_row->notes) ? $ivf_od_menses_row->notes : null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
	
	<span style="display:none;" class="btn btn-warning od-menses-tr-remove" >-</span>
	<span style="display:none;" class="btn btn-info od-menses-tr-add-more" data-parent_tr_id="{{isset($od_menses_old_id) ? $od_menses_old_id : '1'}}">+</span>
	</td>
</tr>