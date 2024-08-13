
@php //echo "============ : ".$slected_particular; exit; @endphp

<select class="particular-dropdown" class="form-control" name="particular{{$billdata_key}}" id="particular{{$billdata_key}}">
	<option value="">Select Particular</option>
	@foreach($ipd_particulars as $parent_id => $ipd_particular)
		@if(isset($ipd_particulars[$parent_id]['childs']))
				<optgroup label="{{$ipd_particular['name']}}">
			@foreach($ipd_particulars[$parent_id]['childs'] as $subcategories)
				  <option data-amount="{{$subcategories['value']}}" value="{{$subcategories['id']}}" {{ ($subcategories['id'] == $slected_particular) ? 'selected' : ''}}>{{$subcategories['name']}}</option>
			@endforeach
				</optgroup>
		@else
			<option value="{{$parent_id}}" {{ ($parent_id == $slected_particular) ? 'selected' : ''}}>{{$ipd_particular['name']}}</option>
		@endif
	@endforeach
</select>