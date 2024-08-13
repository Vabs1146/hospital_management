@php

$nurses_over_report_id = isset($row_data) ? $row_data->id : '';
$medications = isset($row_data) ? explode(',',$row_data->medication) : [];

@endphp


<div class="row clearfix main-data-table-div" >
	<input type="hidden" name="nurses_over_report_id[{{$identifier}}]" value="{{$nurses_over_report_id}}">
	<input type="hidden" name="nurses_over_report_id_non_deleted[]" value="{{$nurses_over_report_id}}">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Date <b class="star">*</b> :</label>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
	<input required type="date" name="date[{{$identifier}}]" class="form-control" value="{{ isset($row_data) ? $row_data->date : ''}}">		
					
				</div>
			</div>
		</div>
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">From Time <b class="star">*</b> :</label>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
	<input required type="time" name="from[{{$identifier}}]" class="form-control" value="{{ isset($row_data) ? $row_data->from_time : ''}}">		
					
				</div>
			</div>
		</div>
		
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">To Time <b class="star">*</b> :</label>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
	<input required type="time" name="to[{{$identifier}}]" class="form-control" value="{{ isset($row_data) ? $row_data->to_time : ''}}">		
					
				</div>
			</div>
		</div>
	</div>
	@include('nurses_over_report.elements.row_item_1')
	
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Nurse name :</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
			<div class="form-line">
				<input class="form-control" id="nurse_name" name="nurse_name[{{$identifier}}]" value="{{isset($row_data)? $row_data->nurse_name : ''}}" type="text">
			</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Notes :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('notes['.$identifier.']', isset($row_data)? $row_data->notes : '', array('class' => 'form-control')) }}     
			</div>
			</div>
		</div>
	</div>
</div>
<hr>