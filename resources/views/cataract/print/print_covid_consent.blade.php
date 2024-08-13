<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
 /* Print styling */

@media print {

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
  float: left;
}

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
}

.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-xs-1,
.col-xs-2,
.col-xs-3,
.col-xs-4,
.col-xs-5,
.col-xs-6,
.col-xs-7,
.col-xs-8,
.col-xs-9,
.col-xs-10,
.col-xs-11,
.col-xs-12 {
float: left !important;
}

body {
  margin: 0;
  padding: 0 !important;
  min-width: 768px;
}

.container {
  width: auto;
  min-width: 750px;
}

body {
  font-size: 13px;
}

a[href]:after {
  content: none;
}

.noprint,
div.alert,
header,
.group-media,
.btn,
.footer,
form,
#comments,
.nav,
ul.links.list-inline,
ul.action-links {
  display:none !important;
}
ul { display: inline-flex;
    list-style: none; }
ul li { padding: 10px; }
}

.table {
   margin-bottom: 0px;
}


.custom-text-input {
	width: 400px;
    border: none;
    border-bottom: 1px solid;
}

    </style>
</head>
<body>
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
           <h3> <u>COVID-19 Pandemic Ophthalmic Treatment Consent Form</u> </h3>
        </div>
    </div>
	
   <!-- ================================================================================= -->  
   <div class="row">
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
</br></br>
	<div class="col-md-6">Name : <input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_name'] or ''}}">
		
	</div>
	<div class="col-md-6">Date : <input class="custom-text-input" type="text" name="" value="{{ $consent_record->consent_date or ''}}">
	</div>

</div>

<div class="col-md-12" >
</br></br>
	<div class="col-md-6">Address : <input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_address'] or ''}}">
	</div>
	<div class="col-md-6">Mobile No. : <input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_mobile'] or ''}}">
	</div>

</div>

<div class="col-md-12" >
</br></br>
	<div class="col-md-6">Name of Attendant : 
		<input class="custom-text-input" type="text" name="" value="{{ $consent_record->name_of_attendant or ''}}">
	</div>
	<div class="col-md-6">Date : <input class="custom-text-input" type="text" name="" value="{{ $consent_record->attendant_signature_date or ''}}">
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
	<div class="col-md-12"><input class="custom-text-input" type="text" name="" value="{{ $consent_record->name_of_doctor or ''}}"></br></br>Name of Doctor / Hospital  </div> 
	<div class="col-md-12"></br></br><input class="custom-text-input" type="text" name="" value=""></br></br>SIGNATURE OF THE DOCTOR / HOSPITAL </div>
</div>
</div>
	<!-- =============================================================================================================================== -->

    <br/>
 
<!--
        <div class="col-lg-10">
            <label class="control-label"><center>
            In case of redness, pain in eyes, swelling, watering in eyes, please contact3,4, 1: emergency number : 8512043333</center>
            </label>
        </div>    

    <br/>

    <div class="col-sm-12" style="margin-top: 20px;">
        <label class="control-label">IOL Sticker</label>
        <div style="height:80px;"></div>
    </div>
    <div class="col-md-12" style="float: none; margin: 0 auto;">
        <div class="col-md-6">
            _______________________
        </div>
        <div class="col-md-6 pull-right">
            _______________________
        </div>
        <div class="col-md-6">
            Signature
        </div>
        <div class="col-md-6 pull-right">
            Signature
        </div>
        <div class="col-md-6">
            {{ $case_master['patient_name'] }}
        </div>
        <div class="col-md-6 pull-right">
            {{ config('app.name', 'Dr') }}
        </div>
    </div> -->



    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>

</body>
</html>