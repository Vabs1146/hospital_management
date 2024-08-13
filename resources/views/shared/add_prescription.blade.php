<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			{{ Form::model($casedata, array('url' => url('/AddEdit/prescription/'.$casedata['id']), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
			{{ csrf_field() }}
			{{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
			{{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
			<div class="header bg-pink">
			<h2>
			Post-Operative Treatment
			</h2>
			</div>
			<div class="body">
				<div class="row clearfix">

					<div class="col-md-12">
						<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"> New Prescription
						<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template"> Template
					</div>

					<span id="new_prescription">

						<!-- ============================================================================================================================== -->
<div class="row clearfix">
						<div class="col-md-3">
							<div>
								<label>Medicine :</label>
							</div>
							{{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '0')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>
						<div class="col-md-3">
							<div>
								<label>Generic Medicine :</label>
							</div>
							{{ Form::select('generic_medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>


						<div class="col-md-3">
							<div>
								<label>Eye :</label>
							</div>
							{{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>
						
						<div class="col-md-3">
							<div>
								<label> Duration :</label>
							</div>
							{{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

						<div class="col-md-3"> <!-- Timing -->
							<div>
								<label>Timing :</label>
							</div>
							{{ Form::select('medicine_timing', array(''=>'Please select') + $presDropdowns['medicine_timing']->toArray(), Request::old('medicine_timing'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>
		{{--				--}}
						<div class="col-md-3"> <!-- frequency -->
							<div>
								<label>Frequency :</label>
							</div>
							{{ Form::select('numberoftimes[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div> 
						<div class="col-md-2">
							<div>
								<label>From Date :</label>
							</div>
							{{ Form::text('from[]', null, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>
						<div class="col-md-2">
							<div>
								<label>To Date :</label>
							</div>
							{{ Form::text('to[]', null, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>

						<div class="col-md-2">
							<button type='button' class="btn btn-primary" id='add_more_frequency'>Add Frequency <br> and Dates</button>
						</div>
					</div>
						<!-- ============================================================================================================================== -->
						<!-- <div class="col-md-12">
							<div class="col-md-2">
								<div class="form-group labelgrp">
								{{ Form::label('medicine_id', 'Medicine') }}
								</div>
							</div>
						
							<div class="col-md-4">
						
								{{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                            
						
							</div>  
						
							<div class="col-md-2">
								<div class="form-group labelgrp">
									{{ Form::label('strength', 'Eye') }}
								</div>
							</div>
						
						
							<div class="col-md-4">
						
							{{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                             
						
							</div>
						</div> -->

						<!-- <div class="col-md-12">
						
							<div class="col-md-2">
							<div class="form-group labelgrp">
							{{ Form::label('numberoftimes', 'Frequency') }}
							</div>
							</div>
						
							<div class="col-md-4">
							{{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
							</div> 
						
							<div class="col-md-2">
							<div class="form-group labelgrp">
							{{ Form::label('medicine_quantity', 'Duration') }}
							</div>
							</div>
						
						
							<div class="col-md-4">
						
							{{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                             
						
							</div>
						
						
						
						</div> -->


						<!-- <div class="col-md-12 dropdown-container">
							<div class="col-md-2">
							<div class="form-group labelgrp">
							<label class="form-control"> Date :</label>
							</div>
							</div>
							<div class="col-md-1 date-from">
							<div class="form-group labelgrp">
							<label class="form-control"> From :</label>
							</div>
							</div>
							<div class="col-md-2">
							{{ Form::text('from', Request::old('from', null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
							</div>
							<div class="col-md-1">
							<div class="form-group labelgrp">
							<label class="form-control"> To :</label>
							</div>
							</div>
							<div class="col-md-2">
							{{ Form::text('to', Request::old('to', null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
							</div>
						
							<div class="col-md-4">
						
							</div> -->
						</div>
					</span>

					<div id="prescription_template" style="display:none; width:100%;" class="container">

						<div class="col-md-12">
							<div class="col-md-2">
								<div class="form-group labelgrp">
								<label class="form-control">Select Template</label>
								</div>
							</div>
							<div class="col-md-10">
								<select id="select_template" class="form-control">
									<option value="">Select Template</option>
									@foreach($templates as $prescription_template)
									<option value="{{$prescription_template->id}}">{{$prescription_template->template_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					
					<div class="row clearfix">
						<div class="col-md-6 col-md-offset-2">
							{{ Form::submit('Add Prescription', array('class' => 'btn btn-primary btn-lg', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}     
						</div>
						<br>
						{{--
						<div class="col-md-12">
							<div class="table-responsive ">
								@if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
								<table class="table">
									<tr>
										<th> Medicine </th>
										<th> Frequency </th>
										<th> Duration </th>
										<th> Eye </th>
										<th> <!-- Used for delete button --> </th>
									</tr>
									@foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
									<tr>   
										<td>
										{{ $prescption->Medical_store->medicine_name }}
										</td>

										<td>
										{{ $prescption->numberoftimes }}

										</td>
										<td>
										{{ $prescption->medicine_Quntity }}
										</td>
										<td>
										{{ $prescption->strength }} 
										</td>

										<td>
										{{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
										
										</td>
									<tr>
									@endforeach
								
								</table>
								@endif
							</div>
						</div>
						--}}
					</div>
					

					<div class="row clearfix">
						<div class="col-md-12">
							<div class="table-responsive">
								@if(null !== old('prescriptions',$getdata['prescriptions']) && count(old('prescriptions',$getdata['prescriptions']))> 0 )
								<table class="table" id="prescription_table">
									<tr>
										<th>
											Medicine
										</th>
										<th>
											Generic Medicine
										</th>
										<th>
											Eye
										</th>
										<th>
											Days
										</th>
										<th>
											Times a Day    
										</th>
										<th>
											Date    
										</th>
										<th>
											Timing    
										</th>

										<th>
										<!-- Used for delete button -->    
										</th>
									</tr>
									@php $prescription_id = ""; @endphp
									@foreach($getdata['prescriptions'] as $prescption)
									<tr>   
										<td>
											{{ $prescption->Medical_store->medicine_name }}
										</td>
										<td>
											{{ $prescption->generic_name }}
										</td>

										<td>
											{{ $prescption->strength }}
										</td>
										<td>
											{{ $prescption->medicine_Quntity }}
										</td>
										
										<td>
											@foreach($prescription_data[$prescption->id] as $prescription_data_row)
												{{ $prescription_data_row->frequency }}<hr>
											@endforeach
										</td>

										<td>
											@foreach($prescription_data[$prescption->id] as $prescription_data_row)
												{{ $prescription_data_row->date_from }} to {{ $prescription_data_row->date_to }}<hr>
											@endforeach
										</td>
										
										
										
										<td>
											{{ $prescption->medicine_timing }}
										</td>

											
										<td>
											@if($permissions['2_case_masters/prescriptionlst']->delete_permission || AUTH::user()->role == 1)
											{{ Form::button('Delete <br>Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
											@endif
											
										</td>
									<tr>
									@endforeach
									@endif
								</table>
							</div>
						</div>
				</div>
				<!-- ============================================================================================== -->
				</div>
			</div>
		</div>


	</div>
	{{ Form::close() }}
</div>

<span id="more_timing_dates" style="display:none;">
	<div class="row clearfix time-date-row">
		<div class="col-md-3"> <!-- Timing -->
		
		</div>

		<div class="col-md-3"> <!-- frequency -->
			{{ Form::select('', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-2">
			{{ Form::text('', null, array('class'=> 'form-control datepicker from-date-picker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>
		<div class="col-md-2">
		{{ Form::text('', null, array('class'=> 'form-control datepicker to-date-picker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>

		<div class="col-md-2">
			<button type='button' class="btn btn-warning remove_more_frequency" >Remove</button>
		</div>
	</div>
</span>

@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
$('.select2').select2();
</script>

<script>
	$('#add_more_frequency').click(function(e) {
		e.preventDefault();
		var template = $("#more_timing_dates").clone();
		/*
		$(template).find('.datepicker').bootstrapMaterialDatePicker({
			format: 'YYYY-MM-DD - HH:mm A',
			clearButton: true,
			weekStart: 1
		});
		*/
		$('#new_prescription').append($(template).html());


		$( "#new_prescription .time-date-row:last-child" ).find('.Dyselect2').attr('name', 'numberoftimes[]');
		$( "#new_prescription .time-date-row:last-child" ).find('.from-date-picker').attr('name', 'from[]');
		$( "#new_prescription .time-date-row:last-child" ).find('.to-date-picker').attr('name', 'to[]');

		$( "#new_prescription .time-date-row:last-child" ).find('.Dyselect2').select2({width: '100%'});

		$( "#new_prescription .time-date-row:last-child" ).find('.datepicker').bootstrapMaterialDatePicker({
			format: 'YYYY-MM-DD',
			clearButton: true,
			weekStart: 1,
			time: false
		});
	});

	$(document).on('click', '.remove_more_frequency', function(e) {
		$(this).closest('.time-date-row').remove();
	});
</script>

<script>
$('input[name=prescription_type]').click(function() {
var prescription_type = $(this).val();

if(prescription_type == 'new') {
$('#new_prescription').show();
$('#prescription_template').hide();
}

if(prescription_type == 'template') {
$('#new_prescription').hide();
$('#prescription_template').show();
}
//alert(prescription_type);
});

$(document).on('change', '#select_template', function() {
var selected_template = $(this).val();
//alert(selected_template);

$.ajax({
url : '{{url("get-prescription-template")}}',
type:'post',
data : {'id' : $(this).val()},
datatype: 'html',
success : function(response) {
$('#prescription_template').html(response);
$('.template_select2').select2();
$('.template-datepicker').bootstrapMaterialDatePicker({
format: 'YYYY-MM-DD',
clearButton: true,
weekStart: 1,
time: false
});
}
});
});
</script>
@endsection

