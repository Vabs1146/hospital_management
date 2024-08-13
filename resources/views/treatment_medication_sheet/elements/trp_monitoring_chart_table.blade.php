<div class="row clearfix">
	<div class="col-md-12 main-data-table-div" data-identifier="{{$identifier}}">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Date <b class="star">*</b> :</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<div class="form-line">
					{{-- Form::text('date['.$identifier.'][]', $trp_monitoring_chart_data_row->date, array('class' => 'form-control datepicker')) --}}    

	<input required type="date" name="date[{{$identifier}}]" class="form-control" value="{{ isset($tpr_monitoring_chart_data_key) ? $tpr_monitoring_chart_data_key : ''}}">		
					
				</div>
			</div>
		</div>
		
		@if(isset($tpr_monitoring_chart_data_row))
			@foreach($tpr_monitoring_chart_data_row as $tpr_monitoring_chart_data_row_data)
				<input type="hidden" name="all_record_ids[]" value="{{$tpr_monitoring_chart_data_row_data->id}}">	
			@endforeach
		@endif
			
		<table style="width:100%;" style="border:1px solid;" class="main-data-table">
			<thead>
			<tr style="border:1px solid; text-align:center">
				<th colspan=7></th>
				<th colspan=2>INTAKE</th>
				<th colspan=2>OUTPUT</th>
			</tr>
			<tr style="border:1px solid;">
				<th>Timing</th>
				<th>Temp</th>
				<th>Pulse</th>
				<th>RESP</th>
				<th>B.P.</th>
				<th>SPO2%</th>
				<th>IV</th>
				<th>R.T.</th>
				<th>Oral</th>
				<th>AG</th>
				<th>Urine</th>
				<th>Aspiration</th>
			</tr>
			</thead>
			
			<tbody class="main-data-table-body">
			@if(isset($tpr_monitoring_chart_data_row))
				@foreach($tpr_monitoring_chart_data_row as $tpr_monitoring_chart_data_row_data)
					@include('trp_monitoring_chart.elements.trp_monitoring_chart_table_row')
				@endforeach
			@else
				@include('trp_monitoring_chart.elements.trp_monitoring_chart_table_row')
			@endif
			</tbody>
		</table>
		<br>
		<div class="col-md-12">
			<a class="btn btn-info add-more-tpr-row">Add More</a>
		</div>
	</div>
</div>

