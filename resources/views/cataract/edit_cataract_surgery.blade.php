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
Cataract Surgery Form
</h2>

</div>



<div class="body">
<form id="discharge_form" action="{{ url('/cataract-consent-form'.( isset($case_master) ? "/1/" . $case_master['id'] : "")) }}" method="POST" enctype = 'multipart/form-data' >
{{ csrf_field() }}
<input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
<div class="row clearfix">
	<!-- ================================================================================= --> 
	
	<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Name <b class="star">*</b> :</label>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<div class="demo-radio-button" style="padding-top: 6px">
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_1" value="Mr." {{($case_master['mr_mrs_ms'] == "Mr.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_1" style="min-width: 50px;">Mr.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_2" value="Mrs." {{($case_master['mr_mrs_ms'] == "Mrs.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_2" style="min-width: 50px;">Mrs.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_3" value="Ms." {{($case_master['mr_mrs_ms'] == "Ms.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_3" style="min-width: 50px;">Ms.</label>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">				
				{{ Form::text('patient_name',$case_master['patient_name'], array('class' => 'form-control', 'required')) }}  
			</div>
		</div>
	</div>

	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('middle_name',$case_master['middle_name'], array('class' => 'form-control', 'placeholder'=>'Middle Name','id'=>'middle_name')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('last_name',$case_master['last_name'], array('class' => 'form-control', 'placeholder'=>'Surname','id'=>'last_name')) }}                          
			</div>
		</div>
	</div>
</div>

	<div class="col-md-12">
		<!-- <div class="col-md-3">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Name Of Patient :</label>
			</div>
		</div>
		
		
		<div class="col-md-4">
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
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="case_number" class="form-control">OPD Case Number :</label>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
			<div class="form-line">
			<input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}"> 
			</div>
			</div>
		</div> 

		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="uhid_no" class="form-control">UHID No. :</label>
			</div>
		</div>


		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
				<input type="text" name="uhid_no" id="uhid_no" class="form-control" value="{{ $case_master['uhid_no'] or ''}}">
				</div>  
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="IPD_no" class="form-control">IPD No. :</label>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
				<input type="text" name="IPD_no" id="IPD_no" class="form-control" value="{{ $case_master['IPD_no'] or ''}}"> 
				</div>
			</div>
		</div> 

		
	</div>

	<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Address <b class="star">*</b>:</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_address', Request::old('patient_address', $case_master->patient_address), array('class' => 'form-control', 'placeholder'=>'Address')) }}       
			</div>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">     {{ Form::text('patient_area', Request::old('patient_area', $case_master->area), array('class' => 'form-control', 'placeholder'=>'Area')) }}                             
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('city', Request::old('city', $case_master->city), array('class' => 'form-control', 'placeholder'=>'City')) }}               
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('district', Request::old('district', $case_master->district), array('class' => 'form-control', 'placeholder'=>'District')) }}                            
			</div>
		</div>
	</div>
</div>
	
	<div class="col-md-12">
		<!-- <div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_address','Address') }}
		</div>
		</div>
		
		<div class="col-md-6">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_address', Request::old('patient_address',$case_master->patient_address), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
		-->
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_mobile','Contact No.') }}
		</div>
		</div> 

		<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_mobile', Request::old('patient_mobile',$case_master->patient_mobile), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('son_daughter_of','Son / Daughter of') }}
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('son_daughter_of', Request::old('son_daughter_of',$case_master->son_daughter_of), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
<!--
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_mobile','Contact No.') }}
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_mobile', Request::old('patient_mobile',$case_master->patient_mobile), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
		-->
	</div>


<div class="col-md-12" >
<h5>Introduction :</h5>
<p>A cataract is opacity of the lens. Cataract operation is indicated only when you cannot function adequately due to poor sight produced by the cataract. Maturity  of Cataract is no longer a criterion for surgery. The natural lens within your eye with a slight cataract, although not perfect, has distinct advantages over an artificial lens </p>
<p>In giving permission for cataract extraction with/without implantation of an intraocular lens in my eye, I declare that I understand the following information :</p>
<ol>
<li>Alternative Treatments :</li>
<p>There are three methods of restoring vision after cataract surgery</p>
<p>a)&nbsp;Cataract Spectacles b)&nbsp;Contact Lens C)&nbsp;intraocular Lens</p>
<p>Cataract Spectacles Increase image Size by 30%.  They cannot be used if there is cataract in only one eye(the other is normal)because they may cause double vision. A contact lens increases image size by 8% However, it is difficult to handle and may not be tolerated by everyone. Intraocular lens does not increase Image size. It is surgically placed inside the permanently</p>
<li>An intraocular lens is implanted by surgery (not by laser).  The implanted lens will be left in the eye permanently. At the time of surgery the doctor may decide not to implant an intraocular lens in the eye, if for any reason he feels that the lens implantation is not indicated or may prove deleterious to the well being of the eye, even though permission may have been given to do so</li>

<li>Though the intraocular implant power is calculated by utilizing a computerized Biometer    ( A-Scan),  a small correction in the spectacles is to be considered inevitable postoperatively and      this may be more in specific cases. An astigmatism (number with axis) Which may reduce with time, is to be taken as inevitable and normal. Therefore, a small power is to be expected in the spectacles for distance and near for clear vision after the operation. In any case, the aim of cataract surgery is to remove the cloudy lens from the eye and replace it with a plastic lens and not to rid the patient of his spectacles.</li>

<li>The caliber of vision obtained after a successful cataract surgery/lens Implantation depends upon the retina behind. In an advanced cataract even with the most sophisticated instruments (Ultrasound Scan etc), it is not possible to be certain that the retina inside is normal. If the retina is normal, you will see well, bit it is not possible in a majority of advanced cataract cases to ascertain the visual status of the retina before operation</li>

<li>With modern instrumentation and micro surgical techniques, the rate of complication in cataract surgery With/Without intraocular lens implantation is very low. Complications can usually be managed by medical and/or surgical treatment. The changes of total loss of vision are less than 0.5%.However, the following complications can occur and are mentioned in standard text books of cataract and lens implantation surgery</li>
<p> </p>
<p>A)	It is possible that vision may drop after surgery due to thickening/Opacification of the posterior capsule. This  is not a complication but a sequeale to Extra Capsular Extraction. The condition is treated with the "yag Laser"</p>
<p>B)	Complications may include hemorrhages (bleeding), posterior capsule rupture, nucleus drop, vitreous loss, wound leakage, uveitis, corneal! Decompensation, glaucoma, cystoid macular oedem or retinal detachment. In addition lens implantation may be complicated by
Severe reaction to the lens (Toxic Lens Syndrome) or dislocation of the lens. The implanted lens may have to be repositioned or removed surgically if it is likely to damage the eye. Though every effort is made to minimize the chances of infection, it cannot be eliminated altogether. Loss of vision is a risk common to any intraocular surgery</p>
<p>C)   Although you may have opted for phacoemulsification surgery and the same may have  been        planned by your surgeon after pre operative examination, if during surgery Phacoemulsification is found to be unsafe or not feasible. Your surgeon will have the liberty to perform surgery by the conventional  technique in the interest of paiient safety
<p>D)	Complication Of Surgery in general :-  As the procedure is generally done under local anaesthesia  the risk to life is less than 0.5%. Risk is greater in patients with Diabeetes, Hypertension,  Cardiac ailments and other systemic disorder & when surgery is performed under general anaesthesia. There is a possibility of drug reaction, brain damage or risk to life.</p>
<p>Since it is impossible to state every complication that may occur as a result of surgery, the list of complication in this form is not exhaustive.</p>
</ol>
<h5>Consent operation for operation</h5>
<ol>
<li>I hearby authorize Dr. <input class="custom-text-input" type="text" name="consent_operation_doctor" value=""> and those whom he may designate as associates or assistants to perform cataract operation with an intraocular lens/ without an intraocular lens/as a secondary procedure on my left/right eye. It has been explained to me that during the course of operation procedure, unforeseen conditions may be revealed or encountered  which necessitate surgical or other procedures in addition to or different from those contemplated. I, therefore  further request and authorize the above named physician/ surgeon or his designates to perform such additional surgical or other procedures as he or they deem necessary or desirable</li>
<li>The nature and purpose of the operation, the necessity thereof, the possible alternative methods of treatment of my condition have been fully explained to me, iin my vernacular language, and I understand the same</li>
<li>I am fully aware that the surgery is being performed in good faith and that no guarantee or assurance has been given as to the result that may be obtained</li>
<li>I consent to the administration of anesthesia and to the use of such anesthetics as may be deemed necessary or desirable</li>
<li>I further  consent to the administration of such drugs or infusions deemed necessary in the judgement of the medical staff</li>
<li>I consent to the observing, photographing or televising of the procedure to be performed for medical, scientific or education purpose provided my identity is not revealed by the pictures or by descriptive text accompanying them</li>
<li>Any tissues or parts surgically removed may be disposed off by the institution in accordance with customary practice</li>
</ol>
 <h5>Informed consent for operation on patients with guarded/poor visual prognosis</h5>               
<p>I have been explained by the attending surgeon/Designated Assistant prior to the operation that visual Prognosis after surgery is guarded/ uncertain/poor/very poor. The reasons for this have been explained to me.The reasons are: (to be signed by the patient/person authorized to consent for the patient.)</p>
<p>Trauma/Diabetic Retinopathy/Myopia/Glaucoma/Uvetis/Age Related Macular Degeneration/PVR/ Complex  Traction Retinal Detachment/Combined tractional rhegmatogenous retinal detachment I dislocated lens or IOL/ Endophthalmitis/Phacodonesis/Non Dilating Pupil (severe eye infection)</p>

<p>Signature of patient/person authorized to consent for patients:<input class="custom-text-input" type="text" name="" value="">.</p>
<p>I THE UNDERSIGNED (THE PATIENT OR NEAREST RELATIVE) HEREBY GIVE MY CONSENT FOR THE OPERATION OF LEFT EYE / RIGHT EYE WITH THE FULL KNOWLEDGE OF POSSIBLE COMPLICATIONS ABD GUARDED/ POOR VISUAL PROGNOSIS. ICERTIFY THAT I HAVE READ THIS INFORMED CONSENT/ IT HAS BEEN READ OVER TO ME AND EXPLAINED TO ME IN MY VERNACULAR LANGUAGE.</p>
</br></br>
<p>Signature/Thumb impression of patient/parent/guardian <input class="custom-text-input" type="text" name="" value=""></p>
</div>



<div class="col-md-12" >
	<div class="col-md-6">Name : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-6">Relationship : <input class="custom-text-input" type="text" name="" value="">
	</div>

</div>

<div class="col-md-12" >
	<div class="col-md-12">Address : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>

</div>

<div class="col-md-12" >
	<div class="col-md-4">Phone(off) : </br>
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4">(Res) : </br><input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4">(Mob) : </br><input class="custom-text-input" type="text" name="" value="">
	</div>

</div>

<div class="col-md-12" >
<h5>Declaration by  Doctor</h5>                                                                           
<p>I declare that I have explained the nature and consequences of the procedure to be performed, and discussed the risks that particularly concern the patient.</p><br>
<p>I have given the patient an opportunity to ask questions and I have answered these.</p>
</div>


<div class="col-md-12" >
	<div class="col-md-4"><p>Doctor’s signature : </p> 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4"><p>Doctor’s name :</p>  <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4"><p>Date :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
</div>


<div class="col-md-6" >
	<div class="col-md-12"><h5>Witness 1</h5></div>
	<div class="col-md-12"><p>Signature : </p> 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12"><p>Name :</p>  <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12"><p>Address :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12"><p>Tel :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
</div>

<div class="col-md-6" >
	<div class="col-md-12"><h5>Witness 2</h5></div>
	<div class="col-md-12"><p>Signature : </p> 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12"><p>Name :</p>  <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12"><p>Address :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12"><p>Tel :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
</div>

 


	<!-- =============================================================================================================================== -->
	
	<div class="col-md-12">
		

		<div class="col-md-12">
			<div class="col-md-9 col-md-offset-3">
			<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
			</button>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/cataract-surgey') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/cataract-surgey/print/1').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
			
			</div>
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


