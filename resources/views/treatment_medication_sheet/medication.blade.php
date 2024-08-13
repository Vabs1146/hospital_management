<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<form action="{{ url('treatment-medication-sheet/'.$registration_data->id) }}" method="POST" class="form-horizontal" id="gynform">
				<div class="header bg-pink">
					<h2>Daily Order Sheet</h2>
				</div>

				<div class="body">
					<input type="hidden" name="registration_id" value="{{$registration_data->id}}">
	
					<div id="tpr_tables_div">
						@if(!empty($tpr_monitoring_chart_data)) 
							@foreach($tpr_monitoring_chart_data as $tpr_monitoring_chart_data_key => $tpr_monitoring_chart_data_row)
								@php $identifier = $tpr_monitoring_chart_data_key; @endphp
								@include('trp_monitoring_chart.elements.trp_monitoring_chart_table')
							@endforeach
							
							@php 
								unset($tpr_monitoring_chart_data_key); 
								unset($tpr_monitoring_chart_data_row); 
							@endphp
						@else 
							@php $identifier = strtotime('now'); @endphp
							@include('treatment_medication_sheet.elements.treatment_medication_sheet_main_row.blade')
						@endif
					</div>
				</div>
				<div class="row clearfix">
					<div class="row clearfix">
						<div class="col-md-8 col-md-offset-3">
							<div class="form-group">
<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_icsi_main"> <i class="fa fa-plus"></i> Submit
</button>
<a name="submit" class="btn btn-primary btn-lg" id="new_tpr"> <i class="fa fa-plus"></i> Add New </a>
<a class="btn btn-primary btn-lg"  target="_blank" href="{{ url('/tpr-monitoring-chart/print').'/'. $registration_data->id }}" ><i class="glyphicon glyphicon-chevron-left"></i> Print </a>
							</div>
						</div>
					</div>
				</div>
				<br><br>
			</form>                          
		</div>
	</div>
</div>