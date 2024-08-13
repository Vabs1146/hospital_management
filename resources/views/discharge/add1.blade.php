@extends('adminlayouts.master')
<style type="text/css">
.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
color: #700;
cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
color: #f00;
}

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<style>
.labelgrp {
text-align: left !important;
}

.elective_emergency input {
position: relative !important;
left: auto !important;
opacity: 1 !important;
/* margin-left: 47px !important; */
margin-right: 8px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
<div class="list-group list-group-horizontal">
@forelse ($DateWiseRecordLst as $VisitListDateWise)
@if($case_master['id'] == $VisitListDateWise['id'])
<a href="{{ url('/discharge').'/'.$VisitListDateWise['id'].'/1/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
@else
<a href="{{ url('/discharge').'/'.$VisitListDateWise['id'].'/1/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
<div class="header bg-pink">
<h2>
Discharge Summary
</h2>

</div>



<div class="body">
<form id="discharge_form" action="{{ url('/discharge'.( isset($case_master) ? "/1/" . $case_master['id'] : "")) }}" method="POST" enctype = 'multipart/form-data' >
{{ csrf_field() }}
<input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
<div class="row clearfix">
	<div class="col-md-12"></div>

	<!-- ================================================================================= -->  

 
@include('discharge.sections.main') 
 
@include('discharge.sections.clinical_findings') 

@include('discharge.sections.surgery') 

@include('discharge.sections.eye_condition_on_discharge')

	<!-- =============================================================================================================================== -->


	<div class="col-md-12">
		<!--
		<div class="col-md-2">
			<div class="form-group">
			{{ Form::label('followup','Followup') }}  
			</div> 
		</div> 
		<div class="col-md-4" id="appointment_append_div">
			<div class="form-group">
			<div class="form-line" id="datepicker_clone">
			{{ Form::text('appointment_date', Request::old('appointment_date',''), array('class' => 'form-control datepicker', 'autocomplete'=>'off', 'id' => 'appointment_dt')) }}
			</div> 
					
			</div> 

			@foreach($appointment as $value)
			<div class="row">
			<div class="col-md-12"><div class="col-md-8"> 
			<input class="form-control" type="text" autocomplete="off" value="{{$value->date}}" readonly></div>
			<div class="col-md-4"><span class="btn btn-danger removeDbItemAppointment" data-id="{{$value->id}}">Remove</span></div>
			</div>
			</div>
			@endforeach
		</div>


		<div class="col-sm-12" style="margin-top: 20px;">
			<label class="control-label">IOL Sticker</label>
			<div style="height:80px;"></div>
		</div>

		
		<div class="col-md-12">
			<label class="form-label">
			In case of Emergency : 1. Severe Redness/watering pain or 2. Sudden diminished vision
			Pls. contact : 8055821212 ( Dr. Sandeep C. Joshi)                           
			</label>
		</div>

		<div class="col-md-12 custom-item-parent-div">
			<div class="row custom-item">
			<div class="col-md-4">
			<select class="custom-item-dropdown form-control select2">
			<option value="">Select Option</option>

			<option value="anaesthetistSurgeon" data-title="Anaesthetist Surgeon" data-od="1">Anaesthetist Surgeon</option>
			<option value="anesthesia" data-title="Anesthesia" data-od="1">Anesthesia</option>
			<option value="surgery" data-title="Surgery/Procedure"  data-od="1">Surgery/Procedure</option>
			<option value="discharge_iol" data-title="Name of IOL"  data-od="1">Name of IOL</option>
			<option value="diagnosis_history" data-title="Diagnosis" data-od="1">Diagnosis</option>
			<option value="systemicDiseases_history" data-title="Systemic Diseases" data-od="1">Systemic Diseases</option>
			<option value="advice_history" data-title="Advice"  data-od="1">Advice</option>
			<option value="surgicalStepsNotes_history" data-title="Surgical Steps Notes"  data-od="1">Surgical Steps Notes</option>
			</select>
			</div>
			<div class="col-md-3"> </div>
			<div class="col-md-3"> </div>
			<div class="col-md-2">
			<span class="add-custom-item btn btn-default">Add</span>
			</div>
			</div>
			<div class="custom-item-container"> </div>
		</div> 
		-->

		<div class="col-md-12 custom-item-parent-div">
			<div class="row custom-item">
			<div class="col-md-4">
			<select class="custom-item-dropdown form-control select2">
			<option value="">Select Option</option>


			<option value="surgon_name" data-title="Surgeon Name" data-od="1">Surgeon Name</option>
			<option value="surgery" data-title="Surgery/Procedure" data-od="surgery_OD[]" data-os="surgery_OS">Surgery/Procedure</option>
			<option value="otherDetailsDiagnosis" data-title="Diagnosis"  data-od="otherDetailsDiagnosis_OD[]" data-os="otherDetailsDiagnosis_OS[]">Diagnosis</option>

			<option value="investigation" data-title="Investigation" data-od="1">Investigation</option>
			<option value="treatmentgiven" data-title="Treatment Given"  data-od="treatmentgiven_od[]" data-os="treatmentgiven_os[]">Treatment Given</option>
			<option value="reasonofadmission" data-title="Reason Of Admission"  data-od="reasonofadmission_od[]" data-os="reasonofadmission_os[]">Reason Of Admission</option>
			
			<option value="systemicdiseases" data-title="Systemic Diseases" data-od="1">Systemic Diseases</option>

<option value="surgerydetails" data-title="Surgery Details"  data-od="surgerydetails_od[]" data-os="surgerydetails_os[]">Surgery Details</option>
			

			<option value="anaesthetistSurgeon" data-title="Anaesthetist Surgeon" data-od="1">Anaesthetist Surgeon</option>
			<option value="anesthesia" data-title="Anesthesia" data-od="1">Anesthesia</option>

			
			<option value="surgeryvision" data-title="Vision"  data-od="surgeryvision_od[]" data-os="surgerydvision_os[]">Vision</option>
			<option value="otherDetailsAnteriorSegment" data-title="Anterior Segment"  data-od="otherDetailsDiagnosis_OD[]" data-os="otherDetailsDiagnosis_OS[]">Anterior Segment</option>
			<option value="otherDetailsPosteriorSegment" data-title="Posterior Segment"  data-od="otherDetailsDiagnosis_OD[]" data-os="otherDetailsDiagnosis_OS[]">Posterior Segment</option>
			<option value="discharge_iol_name" data-title="Name of IOL" data-od="1">Name of IOL</option>

			</select>
			</div>
			<div class="col-md-3"> </div>
			<div class="col-md-3"> </div>
			<div class="col-md-2">
			<span class="add-custom-item btn btn-default">Add</span>
			</div>
			</div>
			<div class="custom-item-container"> </div>
		</div> 


		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-3">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
			</button>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/discharge') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/discharge/print/1').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
			</div>
		</div> 
	</div>

	<!-- ================================================================================= -->  

	

	<!-- =============================================================================================================================== -->
	</form> 


</div>                             

</div>
 @include('shared.add_prescription', ['id'=>$case_master->id]) 

{{--@include('discharge.prescription_sections.add_prescription', ['id'=>$case_master->id])--}}

{{-- @include('shared.add_appointment_multi', ['id'=>$case_master->id]) --}}

</div>
</div>
</div>

@include('discharge.sections.hidden_templates')

<!-- <script src="{{ url('/')}}/select2/js/select2.min.js"></script> -->
<script src="{{ url('/')}}/assets/js/eyeform/eyeform.js"></script> 
<script>

$(".removeDbItemSurgery").click(function(e) {
var ClickedButton = $(this);
var containerDiv = $(this).closest('div.form-group.row');

//var delete_type = ClickedButton.data('type');
// var url='{{ url("insurancedeletesurgery") }}/'+ $(ClickedButton).data('deleteid');
//alert(url);
swal({
title: "Are you sure?",
text: "This Will Remove !",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes, delete it!",
closeOnConfirm: false
}, function () {

$.ajax({ url: '{{ route("insurancedeletesurgery") }}',
method:'POST',
data: {
_token :$("input[name='_token'][type='hidden']").val(),
id : $(ClickedButton).data('deleteid'),
}
})
.success(function() {
$(containerDiv).remove();
$(ClickedButton).button('reset');

swal({title: "Deleted", text: "Successfully!!!", type: "success"},
function(){ 
location.reload();
}
);
}).error(function(){
$(ClickedButton).button('reset');
});

location.reload();
});
e.preventDefault();

});        

$(".removeDbItem").click(function(e) {
var ClickedButton = $(this);
var containerDiv = $(this).closest('div.form-group.row');

swal({
title: "Are you sure?",
text: "This Will Remove !",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes, delete it!",
closeOnConfirm: false
}, function () {

$.ajax({ url: '{{ url("dischargedeleteField") }}',
method:'POST',
data: {
_token :$("input[name='_token'][type='hidden']").val(),
id : $(ClickedButton).data('deleteid'),
}
})
.success(function() {
$(containerDiv).remove();
$(ClickedButton).button('reset');

swal({title: "Deleted", text: "Successfully!!!", type: "success"},
function(){ 
location.reload();
}
);
}).error(function(){
$(ClickedButton).button('reset');
});

location.reload();
});
e.preventDefault();

});        


function isEmpty( el ){
return !$.trim(el.html())
}
$('.addmore').click(function(e) {
	//alert("#"+$(this).data('templatediv'));
	e.preventDefault();
	var template = $("#"+$(this).data('templatediv')).clone();
	console.log( "#"+$(this).data('templatediv') );
	console.log( $("#"+$(this).data('templatediv')).html());

	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	if($(this).data('templatediv') == "followup_date_timetemplate") {
		$(this).closest('div.ContainerToAppend').find('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD - HH:mm A',
        clearButton: true,
        weekStart: 1
    });
	}

});
//$("#btn_add_more").click(function(){
$(document).on('click', '#btn_add_more', function() {
//alert($('.radio-col-teal:checked').val());
//alert("click");
var html = '<div class="row"><div class="col-md-12"> <input type="hidden" name="appointment_id[]" readonly value="">'; 
html += '<input class="form-control datepicker" type="text" name="appointment_date[]" autocomplete="off"></div>';

$('#appointment_append_div').append($("#datepicker_clone").clone());

});

$(document).ready(function(){
$("#appointment_dt").on('change.dp', function (e) {


var appointment_dt = $("#appointment_dt").val();
//alert(appointment_dt);
$("#appointment_dt").val('');
$('#selected_date').html(appointment_dt);
var html = '<div class="row"><div class="col-md-12"><div class="col-md-8"> <input type="hidden" name="appointment_id[]" readonly value="">'; 
html += '<input class="form-control" type="text" name="appointment_date[]" autocomplete="off" value="'+appointment_dt+'" readonly></div>';
html += '<div class="col-md-4"><span class="btn btn-danger remove-date">Remove</span></div></div>';              

$('#appointment_append_div').append(html);

});


$(document).on('click', '.remove-date', function() {
//alert("In date");
$(this).parent().parent().hide();
})

$(".removeDbItemAppointment").click(function(e) {
var ClickedButton = $(this);
var id = $(this).attr('data-id');
//alert(" class name is"+id)

swal({
title: "Are you sure?",
text: "This Will Remove !",
type: "warning",
showCancelButton: true,
confirmButtonColor: "#DD6B55",
confirmButtonText: "Yes, delete it!",
closeOnConfirm: false
}, function () {

$.ajax({ url: '{{ url("deleteAppointment") }}',
method:'POST',
data: {
_token :$("input[name='_token'][type='hidden']").val(),
id : id,
}
})
.success(function() {
// $(containerDiv).remove();
// $(ClickedButton).button('reset');

swal({title: "Deleted", text: "Successfully!!!", type: "success"},
function(){ 
// location.reload();
ClickedButton.parent().parent().hide();
}
);
}).error(function(){
$(ClickedButton).button('reset');
});

// location.reload();
});
e.preventDefault();

});        
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
/*
$(document).on('click', '.surgery-eye-radio', function() {
	//alert($(this).val());
	$(this).parent().find('.surgery-eye-val').val($(this).val());
});
$(document).on('click', '.addmore-sergery', function(e) {
	e.preventDefault();
	//alert('hi');
	//$('#temp_surgery').html('');
	
	///*
	var surgery_html = $('#surgeryTemplate').html();

	var replace_text = 'surgery_OS_temp['+$.now()+']';

	surgery_html = surgery_html.replaceAll('surgery_OS_temp', replace_text);

	$('#temp_surgery').html(surgery_html);

	//var template = $('#surgeryTemplate').clone();

	var template = $('#temp_surgery').clone();
	
	$('#temp_surgery').html('');
	
	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	
	
           
});
*/

$(document).on('click', '.removeItem' ,function(e) {
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });

        //$(".removeDbItem").click(function(e) {
		$(document).on('click', '.removeDbItem', function(e) {
			var ClickedButton = $(this);
			var containerDiv = $(this).closest('div.form-group.row');

			var delete_type = ClickedButton.data('type');
			var url='{{ url("eyeform/deleteMultiEntry")}}/'+ $(ClickedButton).data('deleteid');
			//alert(url);
			swal({
				title: "Are you sure?",
				text: "This Will Remove !",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}, function () {
					
				$.ajax({ url: url, 
					type: 'DELETE',
					data: {
						_method: 'delete', 
						_token :$("input[name='_token'][type='hidden']").val(),
						id : $(ClickedButton).data('deleteid'),
						type: delete_type
					}
				})
				.success(function() {
					$(containerDiv).remove();
					$(ClickedButton).button('reset');

					swal({title: "Deleted", text: "Successfully!!!", type: "success"},
						function(){ 
							location.reload();
						}
					);
				}).error(function(){
				$(ClickedButton).button('reset');
				});

				 location.reload();
			});
			e.preventDefault();

        });
</script>
@endsection


