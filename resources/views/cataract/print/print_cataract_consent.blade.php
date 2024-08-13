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
           <h3> <u>Cataract Consent Form</u> </h3>
        </div>
    </div>
	
   <!-- ================================================================================= -->  
   <div class="row">
<div class="col-md-12" >
	<p>I authorize the administration of anaesthesia upon <input class="custom-text-input" type="text" name="" value=""> </p>
<p>For  <input class="custom-text-input" type="text" name="" value="">    surgery, under overall supervision & direction of
Dr. <input class="custom-text-input" type="text" name="" value="">   ( Anaesthetist)</p>
		
<ol>
<li>I have been explained that the surgery may be performed under General  / Regional / Anaesthesia  / sedation or a combination as per decision of the doctors.</li>
<li>Patients receiving general anaesthesia may require a tube in the windpipe (endotracheal intubation ) which could a use sore throat & hoarseness. Also teeth or dental prosthesis could becom loose.</li>
<li>Regional / Anaesthesia being blind procedure may fail, where by general anaesthesia may be administered.</li>
<li>I have been explained in detail the complication associated with local anaesthesia and the surgical procedure.</li> 
<ul>
<li>Preparation of eyeball.</li>
<li>Needle damage to optic nerve.</li>
<li>Interference with circulations for retina.</li>
<li>Possible drooping of eyelid.</li>
<li>Systemic effects that have potential for life threatening complication & death</li>
</ul>
<li>I also give consent for regional analgesia during the preoperative period & also other procedure such as central venous cannulation / arterial cannulation / urinary catheterization / blood transfusion as deemed / for the safety of the anaesthesia  and surgical procedure.</li>
<li>My doctor has also explained that, in performing the procedure, he / she may use assistants such as hospital residents or other physicians and nurses.</li>
<li>I have been explained about the possibility of occurrence of allergic reaction and I will inform you of an allergy. I have and problems in previous surgery / anaesthesia.</li>
<li>Untoward reaction / delayed recovery / death are extremely rare, however a remote possibility always exist.</li>
<li>I consent to the observing, photographing on televising of the procedure to be perfomed for medical scientific or education purpose provided my identity is not revealed. </li>
<li>I also give Consent for postoperative ventilatory suppot  as a routine management for the particular </li>
<li>	surgery or in the event of a complication.</li>
<li>I agree to co-operate fully with my doctor and to follow to the best of my ability his / her instruction & recommendations about my care & treatment.</li>
</ol>

</div>

<div class="col-md-12" >
<br/><br/>
	<div class="col-md-6">Doctor`s Signature : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-6">Patient Signature : <input class="custom-text-input" type="text" name="" value="">
	</div>

</div>
<br/>
<div class="col-md-12" >
<br/><br/>
	<div class="col-md-6">Date : <input class="custom-text-input" type="text" name="" value=""> </div> 
	<div class="col-md-6">Relative`s / Legal guardian authorized to sign : <input class="custom-text-input" type="text" name="" value=""></div>
</div>

<div class="col-md-12" >
<br/><br/>
	<div class="col-md-6">Witness : <input class="custom-text-input" type="text" name="" value=""></div>                         
	<div class="col-md-6">Relationship to patient : <input class="custom-text-input" type="text" name="" value=""></div>
</div>
<div class="col-md-12" >
<br/><br/>
	<label class="control-label"><center>P.S. You are welcome to discuss any of the above mentioned points with the doctors attending on you before giving the informed consent as above</label>
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