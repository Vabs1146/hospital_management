@foreach($refraction_dropdowns_arr[$data_type] as $refraction_dropdowns_arr_id => $refraction_dropdowns_arr_row)
<input type="hidden" name="all_option_ids[{{$data_type}}][]" value="{{$refraction_dropdowns_arr_id}}">
<div class="col-md-3">
	<div class="input-group">
		<div class="form-line">
			<input class="form-control" type="hidden" name="single_update_field_id[{{$data_type}}][]" value="{{$refraction_dropdowns_arr_id}}">
			<input class="form-control" type="text" placeholder="value" name="update_option_values[{{$data_type}}][]" value="{{$refraction_dropdowns_arr_row}}">
		</div>
		<span class="input-group-addon refraction-option-remove-button" type="button" >
			<i class="fa fa-times" aria-hidden="true"></i>
		</span>
	</div>
</div>
	@endforeach
<div class="col-md-3">
	<input class="update-option btn btn-success" type="submit" name="{{$data_type}}_option_update" value="Update {{ucwords($data_type)}}">
	<span class="cancel-update-option btn btn-info" data-type="{{$data_type}}">Cancel</span>
</div>