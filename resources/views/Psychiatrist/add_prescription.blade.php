
<style type="text/css">
  .medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
  color: #700;
  cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
  color: #f00;
}

.date-from .form-group {
	margin-right: 0px;
    margin-left: 0px;
}
.date-from label {
	padding-right: 0px;
}

#prescription_table tr td {
	font-size : 12px;
}

.d-none {
	display:none;
}

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r($prescription_data); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp

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
			{{ Form::model($casedata, array('url' => url('/AddEdit/prescription/'.$casedata['id']), 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
			{{ csrf_field() }}

			
			<div class="form-group">
				{{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
				{{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
				{{ Form::hidden('doctor_id', Request::old('doctor_id'), array('class'=> 'form-control')) }}
				{{ Form::hidden('patient_emailId', '', array('class'=> 'form-control')) }}
			</div>

			<div class="body">
				<div class="row clearfix">
					<div class="col-md-12 ">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Patient Name :</label>
							</div>
						</div>

						<div class="col-md-8">
							<div class="form-group">
								<div class="form-line">
									{{ Form::text('patient_name', $casedata['patient_name'] .' '.$casedata['middle_name'] .' '.$casedata['last_name'] , array('class'=> 'form-control','readonly'=>'readonly', 'placeholder' => 'First Name')) }}                            
								</div>
							</div>
						</div> 
					</div>   

				<div class="row clearfix">
					<div class="col-md-4">
						<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"  class="prescription_type"> New Prescription
						<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template" class="prescription_type"> Template
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="{{url('add-psychiatrist-prescription-dropdowns').'/'.$casedata['id']}}" >Add Dropdown</a>  
							<a class="btn btn-primary btn-lg" href="{{url('add-psychiatrist-prescription-templates').'/'.$casedata['id']}}">Create Prescription Template</a>
							
							
							<a class="btn btn-primary btn-lg" href="{{url('psychiatrist-prescription-templates-listing/'.$casedata['id'])}}">Prescription Templates</a>
							
						</div>
					</div>
				</div>
<!-- ============================================================================================================= -->
				<span id="new_prescription">
					<div class="row clearfix medicine-row">
						<div class="col-md-3">
							<div>
								<label>Medicine :</label>
							</div>
							{{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '0')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2 selected-medicine','data-live-search'=>'true')) }}
						</div>
						<div class="col-md-3">
							<div>
								<label>Generic Medicine :</label>
							</div>
							{{-- Form::select('generic_medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) --}}

							{{ Form::select('generic_medicine_id[1]', array(''=>'Please select') + $casedata['medicinlist']->where('generic_name', '<>', '')->pluck('generic_name','id')->toArray(), null, array('class' => 'form-control select2 selected-generic','data-live-search'=>'true')) }}
						</div>
						<div class="col-md-3 d-none">
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
							{{ Form::select('medicine_timing', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), Request::old('medicine_timing'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

						<div class="col-md-3"> <!-- frequency -->
							<div>
								<label>Frequency :</label>
							</div>
							{{ Form::select('numberoftimes[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div> 
						<div class="col-md-2  d-none">
							<div>
								<label>From Date :</label>
							</div>
							{{ Form::text('from[]', null, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>
						<div class="col-md-2  d-none">
							<div>
								<label>To Date :</label>
							</div>
							{{ Form::text('to[]', null, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>

						<div class="col-md-2">
							<button type='button' class="btn btn-primary" id='add_more_frequency'>Add Frequency <br> and Dates</button>
						</div>
					</div>
				</span>

				<script>
					$('#add_more_frequency').click(function(e) {
						e.preventDefault();
						var template = $("#more_timing_dates").clone();
						
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

				<span id="more_timing_dates" style="display:none;">
					<div class="row clearfix time-date-row">
						<div class="col-md-3"> <!-- Timing -->
						
						</div>

						<div class="col-md-3"> <!-- frequency -->
							{{ Form::select('', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}
						</div> 
						<div class="col-md-2 d-none">
							{{ Form::text('', null, array('class'=> 'form-control datepicker from-date-picker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>
						<div class="col-md-2 d-none">
						{{ Form::text('', null, array('class'=> 'form-control datepicker to-date-picker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>

						<div class="col-md-2">
							<button type='button' class="btn btn-warning remove_more_frequency" >Remove</button>
						</div>
					</div>
				</span>
<!-- ============================================================================================================= -->
					<span id="prescription_template" style="display:none;">
						
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
					</span>


					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label>Prescription Notes</label>
							</div>
						</div>

						<div class="col-md-9">
							{{ Form::textarea('prescription_notes',  isset($prescription_notes->notes) ? $prescription_notes->notes : '', array('class'=> 'form-control')) }}
						</div>
					</div>



					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label>Email To :</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="form-line">
									<input type="email" name="email" id="email" class="form-control">
								</div>
							</div>
						</div> 
						<div class="col-md-2">
							<button type="submit"  name="sendemailpres" class="btn btn-success " value="sendemailpres" >Email To Other</button>
						</div>
					</div>



					<div class="row clearfix">
						<div class="col-md-6 col-md-offset-2">
							<div class="form-group">
								{{ Form::submit('Add Prescription', array('class' => 'btn btn-primary btn-lg', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}  
								{{ Form::button('Send Message', array('class' => 'btn btn-primary btn-lg', 'Value' => $casedata['id'], 'name' => 'prescription_msg', 'type'=>'submit')) }}   
								<button type="submit"  name="submiitemailpres" class="btn btn-primary btn-lg " value="submiitemailpres" >Submit & Mail</button>  
							</div>
						</div>
					</div>
					<br>


				</div>
@php
//dd($casedata['prescriptions'][0]->Medical_store);
@endphp

				<div class="row clearfix">
				<div class="col-md-12">
					<div class="table-responsive">
						@if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
						<table class="table" id="prescription_table">
							<tr>
								<th>
									Medicine
								</th>
								<!-- <th>
									Generic Medicine
								</th> -->
								<th>
									<!-- Times a Day --> 
Frequency 									
								</th>
								<!-- <th>
									Date    
								</th> -->
								<th>
									Timing    
								</th>
								<th>
									Duration
								</th>

								<th>
								<!-- Used for delete button -->    
								</th>
							</tr>
							@php $prescription_id = ""; @endphp
							@foreach($casedata['prescriptions'] as $prescption)
							<tr>   
								<td>
									{{ $prescption->Medical_store->medicine_name }}<br>
									{{ $prescption->Medical_store->generic_name }}
								</td>
								<!-- <td>
									{{ $prescption->generic_name }}
								</td> -->
								
								<td>
@foreach($prescription_data[$prescption->id] as $prescription_data_row)
@if($prescription_data_row->frequency)
{{ $prescription_data_row->frequency }}<hr>
@endif
@endforeach
								</td>

								<!-- <td>
								@foreach($prescription_data[$prescption->id] as $prescription_data_row)
								@if($prescription_data_row->date_from || $prescription_data_row->date_to)
								{{ $prescription_data_row->date_from }} to {{ $prescription_data_row->date_to }}<hr>
								@endif
								@endforeach
								
								</td> -->
								
								<td>
									{{ $prescption->medicine_timing }}
								</td>
								<td>
									{{ $prescption->medicine_Quntity }}
								</td>
								
								<td>
									@if($permissions['2_case_masters/prescriptionlst']->delete_permission || AUTH::user()->role == 1)
									{{ Form::button('Delete <br>Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
									@endif
									{{-- <a href="{{'/case_masters/delete/'.$prescption->id }}" class="btn btn-primary" name='prescription_delete'> Delete Prescription </a> --}}
								</td>
							<tr>
							@endforeach
							@endif
						</table>
					</div>
				</div>
			</div>
				</form>
			</div>

			

			<div class="row clearfix">
			<div class="col-md-12">
			<div class="form-group">
			
				<!-- <a class="btn btn-default btn-lg"  href="{{ url('/print-psychiatrist-prescription').'/'.$casedata['id'] }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a> -->
				
				<a class="btn btn-primary waves-effect btn-lg" href="{{ url('/print-psychiatrist-prescription').'/'.$casedata['id'] }}"  target="_blank"> <i class="fa fa-eye"></i> Print </a>
			
			</div>
			</div>
			</div> 
					</div>    
            </div>
        </div>



@include('prescriptions.frequency_add_more')

  
  
 