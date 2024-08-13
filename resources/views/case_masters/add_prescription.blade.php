@extends('adminlayouts.master')
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

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
<div class="container">
    <div class="list-group list-group-horizontal">
        @forelse ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/AddEdit/prescription').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/AddEdit/prescription').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
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

			<div class="header bg-pink">
				<!-- <h2>Add/Modify Prescription </h2> -->

				<h2>Medicine Prescription </h2>
				
				<span style="float:right;"><a class="btn btn-success" href="{{url('prescription-templates-listing/'.$casedata['id'])}}">Prescription Templates</a></span>
			</div>
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

						<!-- <div class="col-md-3">
							<div class="form-group">
								<div class="form-line">
									{{ Form::text('middle_name', null, array('class'=> 'form-control','readonly'=>'readonly', 'placeholder' => 'Middle Name')) }}                            
								</div>
							</div>
						</div> 
						
						<div class="col-md-3">
							<div class="form-group">
								<div class="form-line">
									{{ Form::text('last_name', null, array('class'=> 'form-control','readonly'=>'readonly', 'placeholder' => 'Last Name')) }}                            
								</div>
							</div>
						</div>  -->
					</div>   

					<!-- <div class="col-md-12">
						<div class="form-group">
							<h3 class="text-center"><u>Prescription.</u></h3>
						</div>
					</div> -->

				

				<div class="row clearfix">
					<div class="col-md-4">
						<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"> New Prescription
						<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template"> Template
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="{{url('add-prescription-dropdowns').'/'.$casedata['id']}}" >Add Dropdown</a>  
							<!-- <a class="btn btn-primary btn-lg" href="" >Create Prescription Template and Edit</a>   -->
							<a class="btn btn-primary btn-lg" href="{{url('add-prescription-templates').'/'.$casedata['id']}}">Create Prescription Template</a>
							<a class="btn btn-primary btn-lg" href="" >Languages</a>  
						</div>
					</div>
				</div>
<!-- ============================================================================================================= -->
				<span id="new_prescription">
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
							{{ Form::select('medicine_timing', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), Request::old('medicine_timing'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

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
				</span>

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
							@foreach($casedata['prescriptions'] as $prescption)
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
								{{--
								<td>
									{{ $prescption->numberoftimes }}
								</td>

								<td>
									{{ $prescption->from_date }} to {{ $prescption->to_date }}
								</td>
								--}}
								
								
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

									{{-- <td>
										{{ $prescption->per_unit_cost }}
									</td>
									<td>
										{{ $prescption->per_unit_cost * $prescption->medicine_Quntity }}
									</td> --}}
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
			<a class="btn btn-default btn-lg" href="{{ url('/case_masters/prescriptionlst') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To List</a> &nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>&nbsp;
			<a class="btn btn-default btn-lg"  href="{{ url('/print/prescription').'/'.$casedata['id'] }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
			<!-- <a class="btn btn-primary btn-lg" href="{{url('add-prescription-templates').'/'.$casedata['id']}}">Create Prescription Template</a> -->
			<!-- <a class="btn btn-primary btn-lg" href="{{url('prescription-templates')}}">Prescription Templates</a> -->
			</div>
			</div>
			</div> 
					</div>    
            </div>
        </div>

@include('prescriptions.frequency_add_more')

        @endsection
  
  @section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
    $('.select2').select2();
    </script>


<!-- Medicine Set Option -->
<script type="text/javascript">

$(document).ready(function() {

	var medcounter = 1;

	$("#medicinetbtn").click(function () {

		if(medcounter>10){
			swal("Only 10 Options Values are allow!");
			return false;
		}

		var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+medcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="balance_quantity" value="1"><input class="form-control"  type="hidden"  name="isactive" value="1"><input class="form-control"  type="text" id="optionsval'+medcounter+'" placeholder="value'+medcounter+'" name="optionsval[]"></div><span class="input-group-addon medicineremoveButton" type="button" id="medicineremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

		$("#MedicineTextBoxesGroup").append(newTextBoxDiv);
		medcounter++;
	});

	$(document).on('click', '.medicineremoveButton', function(e) {
		medcounter--;
		var target = $("#MedicineTextBoxesGroup").find("#TextBoxDiv" +medcounter);
		$(target).remove();
	});


});
</script>

<!-- Generic Set Option -->

<script type="text/javascript">

$(document).ready(function(){

	var genericcounter = 1;

	$("#generictbtn").click(function () {

	if(genericcounter>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+genericcounter+'"><input type="hidden" name="is_generic" value="1"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+genericcounter+'" placeholder="value'+genericcounter+'" name="optionsval[]"></div><span class="input-group-addon genericremoveButton" type="button" id="genericremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';
	
	$("#GenericTextBoxesGroup").append(newTextBoxDiv);
		genericcounter++;
	});
	
	$(document).on('click', '.genericremoveButton', function(e) {
		genericcounter--;
		var target = $("#GenericTextBoxesGroup").find("#TextBoxDiv" +genericcounter);
		$(target).remove();
	});
});
</script>

<!-- Eye Set Option -->

<script type="text/javascript">

$(document).ready(function(){

	var eyecounter = 1;

	$("#eyetbtn").click(function () {

	if(eyecounter>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+eyecounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+eyecounter+'" placeholder="value'+eyecounter+'" name="optionsval[]"></div><span class="input-group-addon eyeremoveButton" type="button" id="eyeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';
	
	$("#EyeTextBoxesGroup").append(newTextBoxDiv);
		eyecounter++;
	});
	
	$(document).on('click', '.eyeremoveButton', function(e) {
		eyecounter--;
		var target = $("#EyeTextBoxesGroup").find("#TextBoxDiv" +eyecounter);
		$(target).remove();
	});
});
</script>

<!-- Day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var daycounter = 1;

    $("#daytbtn").click(function () {
      
  if(daycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+daycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Quantity"><input class="form-control"  type="text" id="optionsval'+daycounter+'" placeholder="value'+daycounter+'" name="optionsval[]"></div><span class="input-group-addon dayremoveButton" type="button" id="dayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#DayTextBoxesGroup").append(newTextBoxDiv);
  daycounter++;
     });


$(document).on('click', '.dayremoveButton', function(e) {
daycounter--;
   var target = $("#DayTextBoxesGroup").find("#TextBoxDiv" +daycounter);
  $(target).remove();
});


  });
</script>


<!-- Times a day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var timesadaycounter = 1;

    $("#timesadaytbtn").click(function () {
      
  if(timesadaycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+timesadaycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Times a day"><input class="form-control"  type="text" id="optionsval'+timesadaycounter+'" placeholder="value'+timesadaycounter+'" name="optionsval[]"></div><span class="input-group-addon timesadayremoveButton" type="button" id="timesadayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#TimesadayTextBoxesGroup").append(newTextBoxDiv);
  timesadaycounter++;
     });


$(document).on('click', '.timesadayremoveButton', function(e) {
timesadaycounter--;
   var target = $("#TimesadayTextBoxesGroup").find("#TextBoxDiv" +timesadaycounter);
  $(target).remove();
});


  });
</script>


<script type="text/javascript">
    function isEmpty( el ){
      return !$.trim(el.html())
  }

// Medicine Add Option

      $("#medicinebtnsave").click(function () {
        var content=$("#MedicineTextBoxesGroup").val();
        if (isEmpty($('#MedicineTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("medicine-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Medicine", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
	

// Generic Add Option

      $("#genericbtnsave").click(function () {
        var content=$("#GenericTextBoxesGroup").val();
        if (isEmpty($('#GenericTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 //var data=$("#eyeform").serialize();
 var data=$("#GenericTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("medicine-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Generic Medicine", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Eye Add Option

      $("#eyebtnsave").click(function () {
        var content=$("#EyeTextBoxesGroup").val();
        if (isEmpty($('#EyeTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Eye", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Day Add Option

      $("#daybtnsave").click(function () {
        var content=$("#DayTextBoxesGroup").val();
        if (isEmpty($('#DayTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Day", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });




// Times a day Add Option

      $("#timesadaybtnsave").click(function () {
        var content=$("#TimesadayTextBoxesGroup").val();
        if (isEmpty($('#TimesadayTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Times a Day", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

</script>


<!-- ==================================== Update dropdown options ================================================ -->
<script>
		$(document).on('click','.set-dropdown-options',function() {
			var table_name = $(this).data('table_name');
			var form_name = $(this).data('form_name');
			var field_name = $(this).data('field_name');
			
			var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

			var url = "{{route('get-update-dropdown-options')}}";
			if(table_name == "medical_store") {
				url = "{{route('get-prescription-dropdown-options')}}";
			}

			$.ajax({
				url: url,
				method:'post',
				data:{'table_name': table_name, 'form_name': form_name,'form_field': field_name},
				datatype: 'json',
				success:function(response) {
					console.log(response);
					
					element_to_show.html(response.view);
				}
			});

			console.log(form_name + ' : '+  field_name);
			//$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

			element_to_show.show();
		});

		$(document).on('click','.update-dropdown-options-btn',function() {
			//alert('clicked');

			var clicked_element = $(this);

			var form_target = $(this).closest('.update-dropdown-options-form');

			var id = form_target.attr('id');
			var table_name = $(this).data('table_name');

			var form_data = $('#'+ id +' :input').serialize();

			var url = "{{route('update-dropdown-options')}}";
			if(table_name == "medical_store") {
				url = "{{route('update-prescription-dropdown-options')}}";
			}

			//alert(table_name);

			$.ajax({
				url: url,
				method:'post',
				data:{'form_data': form_data},
				datatype: 'json',
				success:function(response) {
					console.log(response);

					location.reload();
					
					clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
				}
			});
		});

		$(document).on('click','.remove-initial-options',function() {
			$(this).closest('.initial_options').remove();
		});

$(document).on('click','.cancel-dropdown-options-btn',function() {
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').hide();
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').html('');
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