@php //echo "======>>>> <pre>"; print_r($casedata); exit; @endphp
@extends('adminlayouts.master')

@section('style')
<style>
	@media screen and (max-width: 767px) {
		.select2 {
			width: 100% !important;
		}
	}
	.ui-autocomplete-loading {
		background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
	}

	.canvas{
		position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
	}

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">
<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">
<style></style>
@endsection

@section('content')


<div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@include('shared.error')
			@if(Session::has('flash_message'))
			<div class="alert alert-success">
			{{ Session::get('flash_message') }}
			</div>
			@endif
			<div class="card">
				<form action="{{ url('tpr-monitoring-chart/'.$registration_data->id) }}" method="POST" class="form-horizontal" id="gynform">
					<div class="header bg-pink">
						<h2>
							Daily Order Sheet
						</h2>
					</div>

					<div class="body">
						{{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
						{{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
						{{ Form::hidden('ivf_type', "icsi", array('class'=> 'form-control')) }}

						<input type="hidden" name="registration_id" value="{{$registration_data->id}}">
						
						<div class="row clearfix">
<!--  -------------------------------------------------------------------------- -->

							<div class="col-md-12" style="background: white;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
									<label for="patient_name" class="form-control">Name <b class="star">*</b> :</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_name', $registration_data->first_name .' '.$registration_data->middle_name .' '.$registration_data->last_name, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'First Name ','id'=>'patient_name', 'required')) }}                          
										</div>
									</div>
								</div>
								<div class="col-md-2">
								<div class="form-group labelgrp">
									<label for="patient_name" class="form-control">Date :</label>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<div class="form-line">
											<input class="form-control datepicker" id="date" name="date" value="{{isset($daily_order_sheet_record->date)? $daily_order_sheet_record->date : ''}}" type="text">
										</div>
									</div>
								</div>
							</div>
</div>



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
	@include('trp_monitoring_chart.elements.trp_monitoring_chart_table')
@endif
</div>
<!-- ============================================================================ -->









</div>
	<div class="row clearfix">
		<div class="col-md-8 col-md-offset-3">
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_icsi_main" >
					<i class="fa fa-plus"></i> Submit
				</button>
				<a name="submit" class="btn btn-primary btn-lg" id="new_tpr" >
					<i class="fa fa-plus"></i> Add New
				</a>
				<a class="btn btn-primary btn-lg"  target="_blank" href="{{ url('/tpr-monitoring-chart/print').'/'. $registration_data->id }}" ><i class="glyphicon glyphicon-chevron-left"></i> Print </a>
			</div>
		</div>
	</div>
<br><br>
{{ Form::close() }}                          
</div>



</div>
</div>
</div>


</div>

<div id="tpr_main_table_template" style="display:none">
	@php $identifier = '---replace_this---'; @endphp
	@include('trp_monitoring_chart.elements.trp_monitoring_chart_table')
</div>

<table id="tpr_main_table_row_template" style="display:none">
	<tbody  id="tpr_main_table_row_data_template">
		@php $identifier = '---replace_this---'; @endphp
		@include('trp_monitoring_chart.elements.trp_monitoring_chart_table_row')
	</tbody>
</table>
@endsection

@section('scripts')
<script>

function replace_initial_identifier(target_html, replacement) {
		//=================================
		 //const given_string = "In this string, every a is going to be a large a";
		 let to_replace = new RegExp('---replace_this---','g');
		 //let replacement = identifier;

		 return target_html = target_html.replace(to_replace, replacement);
		//=====================================
}

$(document).on('click', '.icsi-menses-remove', function(e) {
		$(this).closest('.menses-row').remove();
	});
	
	$(document).on('click', '#new_tpr', function(e) {
		
		//let x = Math.floor((Math.random() * 100) + 1);
		
		let x = Math.random().toString(36).slice(2);
		
		let total_divs = 1 + $('.main-data-table-div').length ;
		
		let identifier = x + total_divs;
		
		//alert(identifier);
		
		let target_html = $('#tpr_main_table_template').html();
		
		//=================================
		/*
		 //const given_string = "In this string, every a is going to be a large a";
		 let to_replace = new RegExp('---replace_this---','g');
		 let replacement = identifier;

		 target_html = target_html.replace(to_replace, replacement);
		 */
		 
		 target_html = replace_initial_identifier(target_html, identifier);
		//=====================================
		
		$('#tpr_tables_div').append(target_html);
		
		//$('#tpr_tables_div').append($('#tpr_main_table_template').html());
	});	
	
	$(document).on('click', '.add-more-tpr-row', function(e) {
		//$('#tpr_tables_div').append($('#tpr_main_table_row_template').html());
		//console.log($(this).closest('.main-data-table-div').html());
		
		//alert($(this).closest('.main-data-table-div').data('identifier'));
		
		let identifier = $(this).closest('.main-data-table-div').data('identifier');
		
		let target_html = $('#tpr_main_table_row_data_template').html();
		target_html = replace_initial_identifier(target_html, identifier);
		
		$(this).closest('.main-data-table-div').find('.main-data-table-body').append(target_html);
		/*
		$(this).closest('.main-data-table-div').find('.main-data-table-body').last('.timepicker').bootstrapMaterialDatePicker({
							format: 'YYYY-MM-DD - HH:mm A',
							clearButton: true,
							weekStart: 1
						});
						*/
						
						//$(this).closest('.main-data-table-div').find('.main-data-table-body').last('tr td .timepicker').val('hiiiiii');
		
		//$(this).closest('.main-data-table-div').find('.main-data-table-body')
	});
</script>
@endsection