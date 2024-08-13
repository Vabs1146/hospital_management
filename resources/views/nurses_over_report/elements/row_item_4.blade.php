@php

$record_id = isset($row_data) ? $row_data->id : '';
$single_val = isset($row_data) ? $row_data->single_val : '';

@endphp

<tr style="border:1px solid;" >
	<td>
		<div class="form-line">
			<input type="text" name="nutrition[{{$identifier}}][]" class="form-control" value="{{$single_val}}">	
			<input type="hidden" name="nutrition_id[{{$identifier}}][]" value="{{$record_id}}">	
			<input type="hidden" name="all_nutrition_ids_for_update[]" value="{{$record_id}}">			
		</div>
	</td>
</tr>