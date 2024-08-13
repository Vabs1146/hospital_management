<div class="row clearfix main-data-table-div" >
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Date <b class="star">*</b> :</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<div class="form-line">
	<input required type="date" name="date[{{$identifier}}]" class="form-control" value="{{ isset($final_data_key) ? $final_data_key : ''}}">		
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div>Administration Record</div>
		<div class="row-item" data-identifier="{{$identifier}}" data-template="row_item_1_template">
			<table style="width:100%;" style="border:1px solid;" class="main-data-table">
				<tbody class="row-item-table-body">
				@if(isset($final_data_row['administration_data']))
					@foreach($final_data_row['administration_data'] as $row_data)
						@include('treatment_medication_sheet.elements.row_item_1')
					@endforeach
				@else
					@include('treatment_medication_sheet.elements.row_item_1')
				@endif
				</tbody>
			</table>
			<br>
			<div class="col-md-12">
				<a class="btn btn-info add-more-tpr-row">Add More</a>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div>IV Fluid</div>
		<div class="row-item" data-identifier="{{$identifier}}" data-template="row_item_2_template">
			<table style="width:100%;" style="border:1px solid;" class="main-data-table">
				<tbody class="row-item-table-body">
				@if(isset($final_data_row['iv_fluid_data']))
					@foreach($final_data_row['iv_fluid_data'] as $row_data)
						@include('treatment_medication_sheet.elements.row_item_2')
					@endforeach
				@else
					@include('treatment_medication_sheet.elements.row_item_2')
				@endif
				</tbody>
			</table>
			<br>
			<div class="col-md-12">
				<a class="btn btn-info add-more-tpr-row">Add More</a>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div>Non-Drug Orders</div>
		<div class="row-item" data-identifier="{{$identifier}}" data-template="row_item_3_template">
			<table style="width:100%;" style="border:1px solid;" class="main-data-table">
				<tbody class="row-item-table-body">
				@if(isset($final_data_row['non_drug_orders_data']))
					@foreach($final_data_row['non_drug_orders_data'] as $row_data)
						@include('treatment_medication_sheet.elements.row_item_3')
					@endforeach
				@else
					@include('treatment_medication_sheet.elements.row_item_3')
				@endif
				</tbody>
			</table>
			<br>
			<div class="col-md-12">
				<a class="btn btn-info add-more-tpr-row">Add More</a>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div>Nutrition</div>
		<div class="row-item" data-identifier="{{$identifier}}" data-template="row_item_4_template">
			<table style="width:100%;" style="border:1px solid;" class="main-data-table">
				<tbody class="row-item-table-body">
				@if(isset($final_data_row['nutrition_data']))
					@foreach($final_data_row['nutrition_data'] as $row_data)
						@include('treatment_medication_sheet.elements.row_item_4')
					@endforeach
				@else
					@include('treatment_medication_sheet.elements.row_item_4')
				@endif
				</tbody>
			</table>
			<br>
			<div class="col-md-12">
				<a class="btn btn-info add-more-tpr-row">Add More</a>
			</div>
		</div>
	</div>
</div>
<hr>