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

.custom-text-input.datepicker {
	width: 150px;
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
           <h3> <u>Certificate</u> </h3>
        </div>
    </div>
	
   <!-- ================================================================================= -->  
   <div class="row">
<div class="col-md-12" >
@php
	foreach($certificate as $certificate_key => $certificate_val) {
		if($certificate_val == '0000-00-00') {
			$certificate->{$certificate_key} = '';
		}
	}
@endphp

<table style="width:100%;">
	<tr>
		<td style="width: 10px;"> </td>
		<td> </td>
		<td> </td>
		<td></td>
	</tr>
	<tr>
		<td colspan="2">Patient : {{ $case_master['mr_mrs_ms'] or ''}} {{ $case_master['patient_name'] or ''}} {{ $case_master['middle_name'] or ''}} {{ $case_master['last_name'] or ''}}</td>
		<td>Age : {{ $case_master['patient_age'] or ''}}</td>
		<td>Sex : {{ $case_master['male_female'] or ''}}</td>
	</tr>
	
	<tr>
		<td colspan="4">Diagnosis : {{$certificate->diagnosis??''}}</td>
	</tr>
	
	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_is_opd_ipd" value="1" {{($certificate->show_is_opd_ipd) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
		
		@php $is_opd_ipd = explode('_', $certificate->is_opd_ipd); @endphp
		My treatment as an <input class="redio-css" type="checkbox" name="is_opd_ipd[]" value="opd" {{in_array('opd', $is_opd_ipd) ? 'checked' : ''}} > out - patient and / or <input  class="redio-css" type="checkbox" name="is_opd_ipd[]" value="ipd" {{in_array('ipd', $is_opd_ipd) ? 'checked' : ''}}> in patient, at this hospital
		</td>
	</tr>
	
	<tr>
		<td><input class="check-css" type="checkbox" name="show_opd" value="1" {{($certificate->show_opd) ? 'checked' : ''}}></td>
		<td colspan="3">was treated as an OPD patient from <input class="custom-text-input datepicker" type="text" name="opd_from" value="{{$certificate->opd_from??''}}"> to <input class="custom-text-input datepicker datepicker" type="text" name="opd_to" value="{{$certificate->opd_to??''}}"></td>
	</tr>
	
	

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_opd" value="1" {{($certificate->show_opd) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
			was treated as an OPD patient from <input class="custom-text-input datepicker" type="text" name="opd_from" value="{{$certificate->opd_from??''}}"> to <input class="custom-text-input datepicker datepicker" type="text" name="opd_to" value="{{$certificate->opd_to??''}}">
		</td>
	</tr>

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_ipd" value="1" {{($certificate->show_ipd) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
			was admitted as an indoor patient on <input class="custom-text-input datepicker" type="text" name="ipd_on" value="{{$certificate->ipd_on??''}}"> and discharged on <input class="custom-text-input datepicker" type="text" name="discharge_on" value="{{$certificate->discharge_on??''}}">
		</td>
	</tr>

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_operated" value="1" {{($certificate->show_operated) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
			He / She was operated for <input class="custom-text-input" type="text" name="operated_for" value="{{$certificate->operated_for??''}}"> on <input class="custom-text-input datepicker" type="text" name="operated_date" value="{{$certificate->operated_date??''}}">

		</td>
	</tr>

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_advised" value="1" {{($certificate->show_advised) ? 'checked' : ''}}>
		</td colspan="3">
			<td colspan="3">
		He / She has been advised <input class="custom-text-input" type="text" name="rest_days" value="{{$certificate->rest_days??''}}"> days rest from <input class="custom-text-input datepicker" type="text" name="rest_from" value="{{$certificate->rest_from??''}}">
		</td>
	</tr>

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_further_advised" value="1" {{($certificate->show_further_advised) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
		However, He / She further advised to continue rest from <input class="custom-text-input datepicker" type="text" name="further_rest_from??''" value="{{$certificate->further_rest_from}}"> for another <input class="custom-text-input" type="text" name="further_rest_days??''" value="{{$certificate->further_rest_days}}"> days
		</td>
	</tr>

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_resume_work" value="1" {{($certificate->show_resume_work) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
		He / She is fit to resume <input class="redio-css" type="radio" name="is_nominal_or_light_work" value="nominal" {{($certificate->is_nominal_or_light_work == 'nominal') ? 'checked' : ''}}> normal duties / <input class="redio-css" type="radio" name="is_nominal_or_light_work" value="light" {{($certificate->is_nominal_or_light_work == 'light') ? 'checked' : ''}}> light work from <input class="custom-text-input datepicker" type="text" name="nominal_or_light_work_from" value="{{$certificate->nominal_or_light_work_from??''}}">
		</td>
	</tr>

	<tr>
		<td>
			<input class="check-css" type="checkbox" name="show_identification_mark" value="1" {{($certificate->show_identification_mark) ? 'checked' : ''}}>
		</td>
		<td colspan="3">
		Identification Mark <input class="custom-text-input" type="text" name="identification_mark" value="{{$certificate->identification_mark??''}}">
		</td>
	</tr>
<!-- ================================================================================================================== -->

	<tr>
		<td colspan="2">Patients SIGNATURE & / or THUMB IMPRESSION : <br/><br/><br/><br/>
			<input class="custom-text-input" type="text" name="" value="">
		</td>
		<td colspan="2">Dr's Sign : <br/><br/><br/><br/>
			<input class="custom-text-input" type="text" name="dr_sign" value="">
		</td>
	</tr>


	<tr>
		<td colspan="2">Date : <input class="custom-text-input datepicker" type="text" name="consent_date" value="" > </td>
		<td colspan="2">Date : <input class="custom-text-input datepicker" type="text" name="consent_date" value="" > </td>
	</tr>
</table>

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