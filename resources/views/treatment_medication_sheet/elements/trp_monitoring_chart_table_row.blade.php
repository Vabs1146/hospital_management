
@php

$record_id = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->id : '';
$timing = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->timing : '';
$temp = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->temp : '';
$pulse = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->pulse : '';
$resp = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->resp : '';
$bp = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->bp : '';
$spo2 = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->spo2 : '';
$iv = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->iv : '';
$rt = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->rt : '';
$oral = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->oral : '';
$ag = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->ag : '';
$urine = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->urine : '';
$aspiration = isset($tpr_monitoring_chart_data_row_data) ? $tpr_monitoring_chart_data_row_data->aspiration : '';

@endphp
<tr style="border:1px solid;" class="menses-row" >
	<td>
		<div class="form-line">
			{{-- Form::text('timing['.$identifier.'][]', $trp_monitoring_chart_data_row->date, array('class' => 'form-control timepicker')) --}} 
			
			<input type="time" name="timing[{{$identifier}}][]" class="form-control" value="{{$timing}}">	
			<input type="hidden" name="record_id[{{$identifier}}][]" value="{{$record_id}}">	
			<input type="hidden" name="all_record_ids_for_update[]" value="{{$record_id}}">			
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('temp['.$identifier.'][]', $temp, array('class' => 'form-control')) }} 		
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('pulse['.$identifier.'][]', $pulse, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('resp['.$identifier.'][]', $resp, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('bp['.$identifier.'][]', $bp, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('spo2['.$identifier.'][]', $spo2, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('iv['.$identifier.'][]', $iv, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('rt['.$identifier.'][]', $rt, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('oral['.$identifier.'][]', $oral, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('ag['.$identifier.'][]', $ag, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('urine['.$identifier.'][]', $urine, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('aspiration['.$identifier.'][]', $aspiration, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td><span class="btn btn-danger icsi-menses-remove" >remove</span></td>
</tr>