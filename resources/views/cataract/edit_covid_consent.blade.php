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
COVID-19 Pandemic Ophthalmic Treatment Consent Form
</h2>

</div>



<div class="body">
<form id="discharge_form" action="{{ url('/covid-consent-form'.( isset($case_master) ? "/1/" . $case_master['id'] : "")) }}" method="POST" enctype = 'multipart/form-data' >
{{ csrf_field() }}
<input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
<div class="row clearfix">
	<!-- ================================================================================= -->  
<div class="col-md-12" >
	<p>I understand the novel coronavirus causes the disease known as COVID-19. I understand the novel coronavirus has unknown and long incubation period during which carriers of the virus may not show symptoms and still be contagious. Even though lockdown is lifted. In the wake of the current coronavirus threat pandemic (present all over the world). I have come to (Hospital / Clinic Name) will for my Eye Treatment. If I am asymptomatic carrier (with no discomfort or symptoms present, but the virus still present hidden in my body) or an undiagnosed patient with COVID-19, I suspect it may endanger doctor and hospital staff. It is my responsibility to take appropriate precautions and to follow the protocols prescribed by the hospital staff.</P>
	
<p>I am aware that I may get an infection from the hospital or from a doctor, or other patients in the hospital even after the hospital has taken precautions, which have been explained to me, as per guidelines prescribed by the Ministry of Health and Family Welfare, Government of India and WHO. This disease spreads by aerosol and is very contagious even though every precaution is taken it will reduce the risk of transmission and will not completely eliminate the risk.
I understand that ophthalmology (eye) procedures (OPD & IPD) might create droplets which is one way that the novel coronavirus can spread. The droplets can linger in the air for minutes to sometimes hours, which can transmit the novel coronavirus.</P>

<p>I confirm that I am not in a high-risk category, including diabetes, cardiovascular disease, hypertension, lung disease including moderate to severe asthma, being immunocompromised, or over age of 60. NOR I fall into the following high-risk category. My doctor and I have discussed the risk, and I agree to Proceed with treatment.</P>

<p>I confirm that I am not waiting for the results of a laboratory test for the novel coronavirus.</P>

<p>I verify that I have not been identified as a contact of someone who has tested positive for novel corona virus or been asked to self-isolate by the government.</P>

<p>I also understand that during my treatment and recovery, I can contract this infection outside the hospital premise. I will take every precaution to reduce the risk of transmission from happening, but I will not at all hold doctors and hospital staff accountabl If such infection occurs to me or my accompanying persons. In case I or my attendant gets the COVID-19 infection after the visit to the hospital, I will inform the hospital authorities at the earliest, so that appropriate tracking of the patients / attendants and hospital staff present on the day of my visit can be done.</P>

<p>I verify the information I have provided on this form and in the questionnaires overleaf is truthful and accurate. I knowingly and willingly consent to necessary investigations and treatment completed during the COVID-19 pandemic. I am also aware, if any details provided by me or by my accompanying relative are found to be false and not correct or if I or accompanying relative has hidden facts and other relevant details, appropriate legal action may be initiated against me and my family members as per applicable government rules.
</P>

</div>




<div class="col-md-12" ></br></br>
	<div class="col-md-6">SIGNATURE / THUMB IMPRESSION OF PATIENT : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<!-- <div class="col-md-6">Patient Signature : <input class="custom-text-input" type="text" name="" value="">
	</div> -->

</div>


<div class="col-md-12" >
	<div class="col-md-6">Name : 
		<input class="custom-text-input" type="text" name="patient_name" value="{{ $case_master['patient_name'] or ''}}">
	</div>
	<div class="col-md-6">Date : <input class="custom-text-input datepicker" type="text" name="consent_date" value="{{ $consent_record->consent_date or ''}}" >
	</div>

</div>

<div class="col-md-12" >
	<div class="col-md-6">Address : 
		<input class="custom-text-input" type="text" name="patient_address" value="{{ $case_master['patient_address'] or ''}}">
	</div>
	<div class="col-md-6">Mobile No. : <input class="custom-text-input" type="text" name="patient_mobile" value="{{ $case_master['patient_mobile'] or ''}}">
	</div>

</div>

<div class="col-md-12" >
	<div class="col-md-6">Name of Attendant : 
		<input class="custom-text-input" type="text" name="name_of_attendant" value="{{ $consent_record->name_of_attendant or ''}}">
	</div>
	<div class="col-md-6">Date : <input class="custom-text-input datepicker" type="text" name="attendant_signature_date" value="{{ $consent_record->attendant_signature_date or ''}}" >
	</div>

</div>

<div class="col-md-12" ></br></br>
	<div class="col-md-6">Signature of Attendant :
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<!-- <div class="col-md-6">Patient Signature : <input class="custom-text-input" type="text" name="" value="">
	</div> -->

</div>

<div class="col-md-12" style="text-align:right;">
	<div class="col-md-12"><input class="custom-text-input" type="text" name="name_of_doctor" value="{{ $consent_record->name_of_doctor or ''}}"></br></br>Name of Doctor / Hospital  </div> 
	<div class="col-md-12"></br></br><input class="custom-text-input" type="text" name="" value=""></br></br>SIGNATURE OF THE DOCTOR / HOSPITAL </div>
</div>


	<!-- =============================================================================================================================== -->


	<div class="col-md-12">
		

		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-3">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
			</button>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/covid-consent-form') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/covid-consent-form/print/1').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
			
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


