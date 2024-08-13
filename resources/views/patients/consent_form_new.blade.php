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
.custom-text-input-small {
    width: 200px;
    border: none;
    border-bottom: 1px solid;
}
.custom-text-input-med {
    width: 300px;
    border: none;
    border-bottom: 1px solid;
}
.custom-text-input-full {
    width: 100%;
    border: none;
    border-bottom: 2px solid;
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
.nm{
    margin-bottom: 0px !important;
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
CONSENT FOR PROCEDURE / SURGERY / DELIVERY
</h2>

</div>



<div class="body">
<form id="discharge_form" action="{{ url('/patients/save-consent' ) }}" method="POST" enctype = 'multipart/form-data' >
{{ csrf_field() }}
<input type="hidden" name="registration_id" value="{{$registration_id}}">
<div class="row clearfix">
    <!-- ================================================================================= -->  
<div class="col-md-12" >
    <!-- <p>I authorize the administration of anaesthesia upon <input class="custom-text-input" type="text" name="" value="{{ $patient_consent_form->treatment }}"> </p>
<p>For  <input class="custom-text-input" type="text" name="" value="">    surgery, under overall supervision & direction of
Dr. <input class="custom-text-input" type="text" name="" value="">   ( Anaesthetist)</p>
         -->
<ol>
<li>I authorise the performance upon <input class="custom-text-input" type="text" name="performance_upon" value="{{ $patient_consent_form->performance_upon }}"> the following procedure/treatment (S) / Surgery <input class="custom-text-input" type="text" name="surgery" value="{{ $patient_consent_form->surgery }}"></li>
<li><input class="custom-text-input" type="text" name="treatment" value="{{ $patient_consent_form->treatment }}"> to be performed under the direction of Dr <input class="custom-text-input" type="text" name="treatment_dr" value="{{ $patient_consent_form->treatment_dr }}"> complications of the same. I want Dr. <input class="custom-text-input" type="text" name="required_dr" value="{{ $patient_consent_form->required_dr }}"></li>
<li>The Doctor has already explained to me about the necessity, the exact of treatment, alternative therapies, advantages and disadvantages of each of them, benefits, complications, risks, consequences, sequella of the procedure/surgery/treatment. I am also told that complications are uncommon but not unknown. In spite of maximum efforts to avoid such complications they can not be totally avoided.</li>
<li>After asking questions and satisfying myself i have decided to consent for the procedure/treatment/surgery.
</li>
<li>I have been explained that the management of the case will be done by the team of Doctors, nurses and other employees of the hospital</li>
<li>I state that no guarantee or warrantee of results or cure has been given to me.
</li>
<li>I have been explained that in peculiar situation i may have to be transferred to other hospital having specific facilities which are not available in the hospital
</li>
<li>I assure the managerment of the hospital to constantly keep one responsible relative with me till the doctor wants. If any delay in caused due to unavailability of a responsible relative the consequences of that will be borne by us. The doctor will not be responsible in that case.</li>
<li>I am aware that during the procedure blood or components of blood may be required to be transfused, there (1) are inherent risks of blood transfusions and the same have been explained to me.</li>

<li>I have been informed about the fact that the hospital does not have an in-house blood bank & an ambulance facility. If required it has to be arranged from the other sources by my relatives.
</li>
<li>I consent to the observation, photography of the procedure for the medical, scientific, educational purposes
provided that due care is taken to conceal my identity.</li>
<li>I consent to the pathological examination of the relevant specimens and disposal of the tissues removed during the procedure.</li>
<li>I am aware that during the operation/procedure the course of management may have to be change in my best interest. This may also include incomplete surgery or removal or treatment of other organs and body systems.
</li>
<li>I have been given opportunity to ask questions & satisfy myself before signing.
</li>
<li>I state that i have no objection to the reuse of disposable items provided that they are properly streilized.
</li>
<li>I further state that i have disclosed the relevant information about my pervious illness, surgeries and allergies. I shall not hold the hospital responsible for consequences arising out of my non disclosure.
</li>
<li>I agree to pay the professional fees of the various doctors & professionals working for me. And i also agree to pay the hospital prior to discharge.
</li>
<li>I undertake to comply with all the instructions given to me (verbal and written) during and after procedure / surgery.
</li>
<li>I am aware that are exiting diseases and medical problems can further complicate the procedure/ surgery and the recovery and same has been explained to me.
</li>
<li>By signing below i confirm that all the things written above are read and understood by me & i agree & accept all the clauses (1-20) written above.
</li>
</ol>

</div>

<div class="col-md-12 nm" >
    <div class="col-md-6">Name of the Patient <input class="custom-text-input-med" type="text" name="patient_name_surg" value="{{ $patient_consent_form->patient_name_surg }}"></div>
    <div class="col-md-6">Signature of the patient    <input class="custom-text-input-med" type="text" name="patient_signature_surg" value="{{ $patient_consent_form->patient_signature_surg }}"> </div> 
</div>  
<div class="col-md-12 nm" >
    <div class="col-md-4">Age : <input class="custom-text-input-small" type="text" name="patient_age_surg" value="{{ $patient_consent_form->patient_age_surg }}"></div>                         
    <div class="col-md-4">Date : <input class="custom-text-input-small" type="date" name="patient_date_surg" value="{{ $patient_consent_form->patient_date_surg }}" data-date-format="dd-mm-yyyy"></div>
    <div class="col-md-4">Time : <input class="custom-text-input-small" id="patient_time_surg" name="patient_time_surg" type="time" value="{{ old('time', $patient_consent_form->patient_time_surg ?? '09:00') }}"></div>
</div>  
<div class="col-md-12 nm" >
    <div class="col-md-6">Name of the Witnesses    <input class="custom-text-input-med" type="text" name="witness_first_surg" value="{{ $patient_consent_form->witness_first_surg }}"></div>
    <div class="col-md-6">Signature of the witnesses    <input class="custom-text-input-med" type="text" name="witness_first_sign_surg" value="{{ $patient_consent_form->witness_first_sign_surg }}"> </div> 
</div>
<div class="col-md-12 nm" >
    <div class="col-md-4">Age : <input class="custom-text-input-small" type="text" name="witness_first_surg_age" value="{{ $patient_consent_form->witness_first_surg_age }}"></div>                         
    <div class="col-md-4">Date : <input class="custom-text-input-small" type="date" name="witness_first_surg_date" value="{{ $patient_consent_form->witness_first_surg_date }}" data-date-format="dd-mm-yyyy"></div>
    <div class="col-md-4">Time : <input class="custom-text-input-small" name="witness_first_surg_time" type="time" value="{{ old('time', $patient_consent_form->witness_first_surg_time ?? '09:00') }}" ></div>
</div> 
<div class="col-md-12 nm" >  
    <div class="col-md-6">Name of the Witnesses    <input class="custom-text-input-med" type="text" name="witness_second_surg" value="{{ $patient_consent_form->witness_second_surg }}"></div>
    <div class="col-md-6">Signature of the witnesses    <input class="custom-text-input-med" type="text" name="witness_second_sign_surg" value="{{ $patient_consent_form->witness_second_sign_surg }}"> </div> 
</div>    
<div class="col-md-12 nm" >  
    <div class="col-md-4">Age : <input class="custom-text-input-small" type="text" name="witness_second_surg_age" value="{{ $patient_consent_form->witness_second_surg_age }}"></div>                         
    <div class="col-md-4">Date : <input class="custom-text-input-small" type="date" name="witness_second_surg_date" value="{{ $patient_consent_form->witness_second_surg_date }}" data-date-format="dd-mm-yyyy"></div>
    <div class="col-md-4">Time : <input class="custom-text-input-small" name="witness_second_surg_time" type="time" value="{{ old('time', $patient_consent_form->witness_second_surg_time ?? '09:00') }}"></div>
</div> 
<div class="col-md-12 nm" >
    <div class="col-md-6">Admission By: 
        <input class="custom-text-input-med" type="text" name="admission_by_surg" value="{{ $patient_consent_form->admission_by_surg }}">
    </div>
    <div class="col-md-6">Authorized Signatory <input class="custom-text-input-med" type="text" name="authorized_sign_surg" value="{{ $patient_consent_form->authorized_sign_surg }}">
    </div>
</div>
<div class="col-md-12"><input class="custom-text-input-full" type="text" name="" value=""></div>
<div class="col-md-12"><h5>COMMENTS :</h5></div>
<div class="col-md-12" >
    <ol>
        <li>
        One can tailer-make the above consent form depending upon specific surgery of specific complications.
    </li>
    <li>
        Specific high risk nature (Eg. Surgery in case of h/o pervious infarct) should be added
    </li>
    <li>
        It is advisable that the doctor countersigns the consent form.
    </li>
    <li>
        A detailed separate consent form for anaesthesia may be used
    </li>
</ol>
</div>

<div class="col-md-12" style="text-align:center"><h5>GENERAL CONSENT-CUM-UNDERTAKING</h5></div>
<div class="col-md-12" >
All Patients are requested to read, understand and sign on the following undertaking at the time of admission <br>
I <input class="custom-text-input" type="text" name="patient_gen_name" value="{{ $patient_consent_form->patient_gen_name }}"> Age <input class="custom-text-input-small" type="text" name="patient_gen_age" value="{{ $patient_consent_form->patient_gen_age }}">Years<br>
Residing at <input class="custom-text-input" type="text" name="patient_address" value="{{ $patient_consent_form->patient_address }}"> am getting admitted at this hospital under care of Dr
<input class="custom-text-input-med" type="text" name="under_care_of_dr" value="{{ $patient_consent_form->under_care_of_dr }}"> for the necessary treatment voluntarily.
</div>
<div class="col-md-12" >
<div class="col-md-12 nm"><h5>I hereby state that:</h5></div>
<ol>
    <li>
    I am aware of the rules & regulations of the hospital and undertake to comply with the same.
    </li>
    <li>
    I am aware of the approximate expenditure that i am likely to incur during the stay and undertake to pay it fully on discharge.
    </li>
    <li>
    I undertake to collect all the papers, reports from the hospital on discharge.
    </li>
    <li>
    I have disclosed my complete medical history including past surgeries, medical illnesses, allergies and state that the information entered is true.
    </li>
    <li>
    I undertake to abide by the decisions taken by the treating doctor. I am aware that i have right to refuse the suggested treatment. In such situation i undertake to put that in writing on my case sheet.
    </li>
    <li>
    I consent to all the minor procedures, medications, examinations (e.g. starting IVline, Sahving, Enema, Injections, Administration of oral medicines, dressing etc.)
    </li>
    <li>
    I am aware that the procedure will be carried out by the hospital staff and allow the same
    </li>
    <li>
    I am aware of the amenities, provision of food & beverages, and working rules of the hospital, i have been told
not to keep any valuables in the hospital & the hospital authorities will not be responsible in case of loss of the same.
    </li>
    <li>
    I am aware about the infrastructural facilities available at the hospital to my satisfaction
    </li>
    <li>
    I am aware that the consultant along with the staff including nurses and Dr.'s will take care of me. 
    </li>
    <li>
    I undertake to pay the required deposit on admission and pay interim bills generated by hospital
    </li>
    <li>
    By signing below i affirm that i have read all the clauses above/have been explained to me
    </li>
</ol>
</div>
<div class="col-md-12 nm" >
    <div class="col-md-6">Name of Patient    <input class="custom-text-input-med" type="text" name="patient_name_gen" value="{{ $patient_consent_form->patient_name_gen }}"> </div> 
    <div class="col-md-6">Sign of Patient <input class="custom-text-input-med" type="text" name="patient_sign_gen" value="{{ $patient_consent_form->patient_sign_gen }}"></div>
</div>  
<div class="col-md-12 nm" >                
    <div class="col-md-4">Date : <input class="custom-text-input-small" type="date" name="patient_date_gen" value="{{ $patient_consent_form->patient_date_gen }}" data-date-format="dd-mm-yyyy"></div>
    <div class="col-md-4">Time : <input class="custom-text-input-small" name="patient_time_gen" type="time" value="{{ old('time', $patient_consent_form->patient_time_gen ?? '09:00') }}"></div>
   
</div>  
<div class="col-md-12 nm" >
    <div class="col-md-6">Witnesses Name   <input class="custom-text-input-med" type="text" name="witness_name_gen" value="{{ $patient_consent_form->witness_name_gen }}"> </div> 
    <div class="col-md-6">Signature    <input class="custom-text-input-med" type="text" name="witness_sign_gen" value="{{ $patient_consent_form->witness_sign_gen }}"></div>
</div>
<div class="col-md-12 nm" >                         
    <div class="col-md-4">Date : <input class="custom-text-input-small" type="date" name="witness_date_gen" value="{{ $patient_consent_form->witness_date_gen }}" data-date-format="dd-mm-yyyy"></div>
    <div class="col-md-4">Time : <input class="custom-text-input-small" name="witness_time_gen"  type="time" value="{{ old('time', $patient_consent_form->witness_time_gen ?? '09:00') }}"></div>
</div> 
<div class="col-md-12 nm" >
    <div class="col-md-6">Admission By: 
        <input class="custom-text-input-med" type="text" name="addmission_by_gen" value="{{ $patient_consent_form->addmission_by_gen }}">
    </div>
    <div class="col-md-6">Authorized Signatory <input class="custom-text-input-med" type="text" name="authorized_sign_gen" value="{{ $patient_consent_form->authorized_sign_gen }}">
    </div>

</div>




    <!-- =============================================================================================================================== -->


    <div class="col-md-12">
        

        <div class="col-md-12">
            <div class="col-md-9 col-md-offset-3">
            <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Save
            </button>&nbsp;

            <button type="submit" name="submit_print" class="btn btn-info btn-lg" value="submit" ><i class="fa fa-plus"></i> Save & Print
            </button>&nbsp;
            <a class="btn btn-default btn-lg" href="{{ url('/patients-listing') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
            <!-- <a class="btn btn-default btn-lg" href="{{ url('/patients/print-patient-consent').'/'. $patient_consent_form->patient_id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp; -->
            
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
<script></script>
@endsection


