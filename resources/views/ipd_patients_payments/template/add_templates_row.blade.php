<div class="row clearfix">
	<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Select Template</label>
			</div>
		</div>
	<div class="col-md-6">
		<select id="select_template" class="form-control template_select2">
			<option value="">Select Template</option>
			@foreach($all_templates as $prescription_template)
			<option {{($template_id == $prescription_template->id) ? 'selected' : '' }} value="{{$prescription_template->id}}">{{$prescription_template->template_name}}</option>
			@endforeach
		</select>
	</div>
</div>

<input type="hidden" name="total_template_rows" id="total_template_rows" value="{{ count($template) }}">


<table style="width:100%; " id="particulars_table_template" class="new-hospital-charges">
	<tr>
		<th>Sr</th>
		<th>Particulars</th>
		<th>Amount</th>
		<th>Nos.</th>
		<th>Total Amount</th>
		<th></th>
	</tr>
	@foreach($template as $key => $templates_row)
	<tr class="bill-item-tr">
		<td></td>
		<td>
		<div class="form-group">
			<div class="form-line"> 
			<select class="form-control particular-dropdown" name="particular[]" id="particular">
				<option value="">Select Particular</option>
				@foreach($ipd_particulars as $parent_id => $ipd_particular)
					@if(isset($ipd_particulars[$parent_id]['childs']))
							<optgroup label="{{$ipd_particular['name']}}">
						@foreach($ipd_particulars[$parent_id]['childs'] as $subcategories)
<option data-amount="{{$subcategories['value']}}" value="{{$subcategories['id']}}" {{(isset($templates_row->particular_id) && $templates_row->particular_id == $subcategories['id']) ? 'selected' : ''}}>{{$subcategories['name']}} {{$templates_row->particular_id}}</option>
						@endforeach
							</optgroup>
					@else
						<option value="{{$parent_id}}" {{(isset($templates_row->particular_id) && $templates_row->particular_id == $parent_id) ? 'selected' : ''}}>{{$ipd_particular['name']}}</option>
					@endif
				@endforeach
			</select>
			</div>
		</div>
		</td>
		<td>
			<div class="form-group">
				<div class="form-line"> 
				{{ Form::text('amount[]', Request::old('amount', isset($templates_row->amount) ? $templates_row->amount : ''), array('class' => 'form-control  particular-amount', 'id' => 'amount')) }}  
				</div>
			</div>
		</td>
		<td>
			<div class="form-group">
				<div class="form-line"> 
				{{ Form::text('quantity[]', Request::old('quantity', isset($templates_row->quantity) ? $templates_row->quantity : ''), array('class' => 'form-control particular-quantity', 'id' => 'quantity')) }}  
				</div>
			</div>
		</td>
		<td>
			<div class="form-group">
				<div class="form-line"> 
				{{ Form::text('total_amount[]', Request::old('total_amount', isset($templates_row->total_amount) ? $templates_row->total_amount : ''), array('class' => 'form-control particular-row-total', 'id' => 'total_amount')) }}  
				</div>
			</div>
		</td>
		<td></td>
	</tr>
	@endforeach
</table>