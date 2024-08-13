@if(isset($form_dropdowns_array[$dropdown_options_field_name]) && !empty($form_dropdowns_array[$dropdown_options_field_name]))

@php 
	$form_id = $dropdown_options_form_name .'_'. str_replace(' ', '-', $dropdown_options_field_name);
@endphp
<div name="" class="update-dropdown-options-form" id="{{$form_id}}" method="POST" action="{{route('update-dropdown-options')}}">

<input class="form-control" type="hidden" name="tableName" class="tableName" value="{{$dropdown_options_table_name}}">
<input class="form-control" type="hidden" name="formName" class="formName" value="{{$dropdown_options_form_name}}">
<input class="form-control" type="hidden" name="fieldName" class="fieldName" value="{{$dropdown_options_field_name}}">

@foreach($form_dropdowns_array[$dropdown_options_field_name] as $key => $form_dropdowns_array_row)
	<input type="hidden" name="initial_options_ids[]" value="{{$key}}">
	<div class="col-md-3 initial_options">
		<div class="input-group">
			<div class="form-line">
				<input class="form-control" type="hidden" placeholder="value1" class="initial_optionsid" name="initial_optionsid[]" value="{{$key}}">
				<input class="form-control" type="text" placeholder="value1" class="initial_optionsval" name="initial_optionsval[]" value="{{$form_dropdowns_array_row['ddValue']}}">
			</div>
			<span class="input-group-addon remove-initial-options" type="button"><i class="fa fa-times" aria-hidden="true"></i></span>
		</div>
	</div>
@endforeach
<span class="update-dropdown-options-btn btn btn-success" data-table_name="{{$dropdown_options_table_name}}">Update</span>
<span class="cancel-dropdown-options-btn btn btn-success">Cancel</span>
</div>
@endif