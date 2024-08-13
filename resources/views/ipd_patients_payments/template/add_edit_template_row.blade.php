<span class="template-row-added">
		
		<div class="row clearfix">		

		
			<div class="col-md-12 perticlar-row" style="background: white;">	
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Particulars  </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 

<select class="form-control particular-dropdown" name="particular[]" id="particular">
	<option value="">Select Particular</option>
	@foreach($ipd_particulars as $parent_id => $ipd_particular)
		@if(isset($ipd_particulars[$parent_id]['childs']))
				<optgroup label="{{$ipd_particular['name']}}">
			@foreach($ipd_particulars[$parent_id]['childs'] as $subcategories)
				  <option data-amount="{{$subcategories['value']}}" value="{{$subcategories['id']}}" {{(isset($template_data_row->particular_id) && $template_data_row->particular_id == $subcategories['id'] && $is_edit == 0) ? 'selected' : ''}}>{{$subcategories['name']}}</option>
			@endforeach
				</optgroup>
		@else
			<option value="{{$parent_id}}" {{(isset($patient_particular_data->particular) && $patient_particular_data->particular == $parent_id) ? 'selected' : ''}}>{{$ipd_particular['name']}}</option>
		@endif
	@endforeach
</select>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Amount </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('amount[]', isset($template_data_row) && $is_edit == 0 ? $template_data_row->amount : null, array('class' => 'form-control amount-element', 'id' => 'amount')) }}  
			</div>
		</div>
	</div>

	@if((isset($is_hidden) && $is_hidden == 1) || $template_data_row) 
			<div class="col-md-2"><a href="javascript:void(0)" class="remove-template-row btn btn-danger">Remove</a></div>
	@endif
</div>

			
		</div>
		
	</span>	