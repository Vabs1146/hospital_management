<!-- =========================== Start Diagnosis History ============================ -->
<div class="col-md-12">
@php
//echo "<pre>"; print_r($template_data);
@endphp
</div>


<div class="row clearfix">
	<div id="payment_details_div">
	@php $index = 0; @endphp
		@foreach($template_data as $template_data_key => $template_data_row)
		<div class="row clearfix bill-item-row">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Item :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="text" name="bill_item[]" id="bill_item" class="form-control" value="{{ $template_data_key or ''}}"> 
					</div>
				</div>
			</div> 
			
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Amount :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="number" step="0.01" name="bill_Amount[]" id="bill_Amount" class="form-control" value="{{$template_data_row or ''}}">
					</div>
				</div>
			</div> 
			@if($index++ == 0)
			<div class="col-md-2"><span class="btn btn-success form-control" id="add_ipdbill_item" name="Item_Add" value="Item_Add" > <i class="fa fa-plus"></i> Add</span></div>
			@else
			<div class="col-md-2"><span class="btn btn-success form-control remove_ipdbill_item" name="Item_Add" value="Item_Add" > <i class="fa fa-plus"></i> Remove</span></div>
			@endif
		</div>
		@endforeach
	</div>
</div>


	
<span id="item_to_clone" style="display:none;">

	<div class="row clearfix bill-item-row">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label>Bill Item :</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<div class="form-line">
					 <input type="text" name="bill_item[]" id="bill_item" class="form-control" value="{{ $bill_item or ''}}"> 
				</div>
			</div>
		</div> 
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label>Bill Amount :</label>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<div class="form-line">
					 <input type="number" step="0.01" name="bill_Amount[]" id="bill_Amount" class="form-control" value="{{$bill_Amount or ''}}">
				</div>
			</div>
		</div> 
		
		<div class="col-md-2"><span class="btn btn-success form-control remove_ipdbill_item" name="Item_Add" value="Item_Add" > <i class="fa fa-plus"></i> Remove</span></div>
	</div>
</span>