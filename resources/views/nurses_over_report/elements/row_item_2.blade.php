@php

$record_id = isset($row_data) ? $row_data->id : '';
$administration_record_1 = isset($row_data) ? $row_data->administration_record_1 : '';
$administration_record_2 = isset($row_data) ? $row_data->administration_record_2 : '';
$administration_record_3 = isset($row_data) ? $row_data->administration_record_3 : '';
$administration_record_4 = isset($row_data) ? $row_data->administration_record_4 : '';
$administration_record_5 = isset($row_data) ? $row_data->administration_record_5 : '';

@endphp

<tr style="border:1px solid;" >
	<td>
		<div class="form-line">
			<input type="text" name="iv_fluid_1[{{$identifier}}][]" class="form-control" value="{{$administration_record_1}}">	
			<input type="hidden" name="iv_fluid_id[{{$identifier}}][]" value="{{$record_id}}">	
			<input type="hidden" name="all_iv_fluid_ids_for_update[]" value="{{$record_id}}">			
		</div>
	</td>
	<td><input type="text" name="iv_fluid_2[{{$identifier}}][]" class="form-control" value="{{$administration_record_2}}"></td>
	<td><input type="text" name="iv_fluid_3[{{$identifier}}][]" class="form-control" value="{{$administration_record_3}}"></td>
	<td><input type="text" name="iv_fluid_4[{{$identifier}}][]" class="form-control" value="{{$administration_record_4}}"></td>
	<td><input type="text" name="iv_fluid_5[{{$identifier}}][]" class="form-control" value="{{$administration_record_5}}"></td>
</tr>