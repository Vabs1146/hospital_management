@extends('adminlayouts.master')
<style type="text/css">
.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
color: #700;
cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
color: #f00;
}

.custom-text-input {
	width: 400px;
    border: none;
    border-bottom: 1px solid;
}

.custom-text-input.datepicker {
	width: 150px;
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

.check-css {
		position: relative !important;
    left: unset !important;
    opacity: unset !important;
    width: 40px;
    height: 25px;
}

.redio-css {
	position: relative !important;
    left: unset !important;
    opacity: unset !important;
    width: 15px;
    height: 15px;
}
</style>
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
<div class="header bg-pink">
<h2>
Certificate
</h2>

</div>



<div class="body">
<form id="discharge_form" action="{{ url('/certificate'.( isset($case_master) ? "/1/" . $case_master['id'] : "")) }}" method="POST" enctype = 'multipart/form-data' >
{{ csrf_field() }}
<input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
<div class="row clearfix">
	<!-- ================================================================================= -->  

<div class="col-md-12">
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Patient :</label>
		</div>
	</div>


	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		<input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
		</div>  
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		<input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ $case_master['middle_name'] or ''}}">
		</div>  
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		<input type="text" name="last_name" id="last_name" class="form-control" value="{{ $case_master['last_name'] or ''}}">
		</div>  
		</div>
	</div>

	
</div>

<div class="col-md-12">
	<!-- <div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Patient :</label>
		</div>
	</div>
	
	
	<div class="col-md-5">
		<div class="form-group">
		<div class="form-line">
		<input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
		</div>  
		</div>
	</div> -->

	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="name_of_age" class="form-control">Age :</label>
		</div>
	</div>


	<div class="col-md-1">
		<div class="form-group">
		<div class="form-line">
		<input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}">
		</div>
		</div>
	</div>

	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="male_female" class="form-control">Sex :</label>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group" style="padding-top: 6px">
		<input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked=\"checked\"" : "" }}   />
		<label for="radio_8">Male</label>
		<input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" required   {{ ($case_master->male_female == "Female")? "checked=\"checked\"" : "" }} />
		<label for="radio_10">Female</label>
		</div>
	</div> 
</div>

<div class="col-md-12">
	<div class="col-md-1">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Diagnosis:</label>
		</div>
	</div>


	<div class="col-md-11">
		<div class="form-group">
			<div class="form-line">
				<textarea class="form-control" id="diagnosis" name="diagnosis">{{$certificate->diagnosis??''}}</textarea>
			</div>  
		</div>
	</div>
</div>


<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_is_opd_ipd" value="1" {{(isset($certificate->show_is_opd_ipd) && $certificate->show_is_opd_ipd) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	
	@php $is_opd_ipd = isset($certificate->is_opd_ipd) ? explode('_', $certificate->is_opd_ipd) : []; @endphp
	My treatment as an <input class="redio-css" type="checkbox" name="is_opd_ipd[]" value="opd" {{in_array('opd', $is_opd_ipd) ? 'checked' : ''}} > out - patient and / or <input  class="redio-css" type="checkbox" name="is_opd_ipd[]" value="ipd" {{in_array('ipd', $is_opd_ipd) ? 'checked' : ''}}> in patient, at this hospital
	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_opd" value="1" {{(isset($certificate->show_opd) && $certificate->show_opd) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	was treated as an OPD patient from <input class="custom-text-input datepicker" type="text" name="opd_from" value="{{$certificate->opd_from??''}}"> to <input class="custom-text-input datepicker datepicker" type="text" name="opd_to" value="{{$certificate->opd_to??''}}">
	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_ipd" value="1" {{(isset($certificate->show_ipd) && $certificate->show_ipd) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	was admitted as an indoor patient on <input class="custom-text-input datepicker" type="text" name="ipd_on" value="{{$certificate->ipd_on??''}}"> and discharged on <input class="custom-text-input datepicker" type="text" name="discharge_on" value="{{$certificate->discharge_on??''}}">
	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_operated" value="1" {{(isset($certificate->show_operated) && $certificate->show_operated) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	He / She was operated for <input class="custom-text-input" type="text" name="operated_for" value="{{$certificate->operated_for??''}}"> on <input class="custom-text-input datepicker" type="text" name="operated_date" value="{{$certificate->operated_date??''}}">

	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_advised" value="1" {{(isset($certificate->show_advised) && $certificate->show_advised) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	He / She has been advised <input class="custom-text-input" type="text" name="rest_days" value="{{$certificate->rest_days??''}}"> days rest from <input class="custom-text-input datepicker" type="text" name="rest_from" value="{{$certificate->rest_from??''}}">
	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_further_advised" value="1" {{(isset($certificate->show_further_advised) && $certificate->show_further_advised) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	However, He / She further advised to continue rest from <input class="custom-text-input datepicker" type="text" name="further_rest_from" value="{{$certificate->further_rest_from??''}}"> for another <input class="custom-text-input" type="text" name="further_rest_days" value="{{$certificate->further_rest_days??''}}"> days
	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_resume_work" value="1" {{(isset($certificate->show_resume_work) && $certificate->show_resume_work) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	He / She is fit to resume <input class="redio-css" type="radio" name="is_nominal_or_light_work" value="nominal" {{(isset($certificate->show_resume_work) && $certificate->is_nominal_or_light_work == 'nominal') ? 'checked' : ''}}> normal duties / <input class="redio-css" type="radio" name="is_nominal_or_light_work" value="light" {{(isset($certificate->show_resume_work) && $certificate->is_nominal_or_light_work == 'light') ? 'checked' : ''}}> light work from <input class="custom-text-input datepicker" type="text" name="nominal_or_light_work_from" value="{{$certificate->nominal_or_light_work_from??''}}">
	</div>
</div>

<div class="col-md-12" >
	<div class="col-md-1">
		<input class="check-css" type="checkbox" name="show_identification_mark" value="1" {{(isset($certificate->show_identification_mark) && $certificate->show_identification_mark) ? 'checked' : ''}}>
	</div>	
	<div class="col-md-11">
	Identification Mark <input class="custom-text-input" type="text" name="identification_mark" value="{{$certificate->identification_mark??''}}">
	</div>
</div>
<!-- ================================================================================================================== -->

<div class="col-md-12" ></br></br>
	<div class="col-md-6">Patients SIGNATURE & / or THUMB IMPRESSION : <br/><br/><br/><br/>
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-6">Dr's Sign : <br/><br/><br/><br/>
		<input class="custom-text-input" type="text" name="dr_sign" value="">
	</div>
</div>


<div class="col-md-12" >
	<div class="col-md-6">Date : <input class="custom-text-input datepicker" type="text" name="consent_date" value="" >
	</div>
	<div class="col-md-6">Date : <input class="custom-text-input datepicker" type="text" name="consent_date" value="" >
	</div>

</div>






	<!-- =============================================================================================================================== -->


	<div class="col-md-12">
		

		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-3">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
			</button>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/certificate') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
			<button type="submit" name="submit_print" class="btn btn-success btn-lg" value="submit_print"><i class="glyphicon glyphicon-print"></i></i> Save & Print &nbsp;
			
			
			
			</div>
		</div> 
	</div>

	<!-- ================================================================================= -->  

	

	<!-- =============================================================================================================================== -->
	</form> 


</div>                             

</div>


</div>
</div>
</div>

<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
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
e.preventDefault();
var template = $("#"+$(this).data('templatediv')).clone();

$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

$(this).closest('div.ContainerToAppend').append($(template).html());
$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

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

	
	//*/
           
});


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


