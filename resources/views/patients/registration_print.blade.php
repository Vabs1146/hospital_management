<?php  
use App\helperClass\drAppHelper; 
$convert_to_words = new drAppHelper();

//$all_settings = $convert_to_words->get_hospital_name();

//echo "=====>>>>>>> <pre>"; print_r($all_settings); exit;
?>
<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
    /* Print styling */
 
 .list-group1 li
 {
    float: left;
    list-style-type: square;
    margin: 10px 20px;
    padding:0px;
 }
    @media print {
        [class*="col-sm-"] {
            float: left;
        }
        [class*="col-xs-"] {
            float: left;
        }
        .col-sm-12,
        .col-xs-12 {
            width: 100% !important;
        }
        .col-sm-11,
        .col-xs-11 {
            width: 91.66666667% !important;
        }
        .col-sm-10,
        .col-xs-10 {
            width: 83.33333333% !important;
        }
        .col-sm-9,
        .col-xs-9 {
            width: 75% !important;
        }
        .col-sm-8,
        .col-xs-8 {
            width: 66.66666667% !important;
        }
        .col-sm-7,
        .col-xs-7 {
            width: 58.33333333% !important;
        }
        .col-sm-6,
        .col-xs-6 {
            width: 50% !important;
        }
        .col-sm-5,
        .col-xs-5 {
            width: 41.66666667% !important;
        }
        .col-sm-4,
        .col-xs-4 {
            width: 33.33333333% !important;
        }
        .col-sm-3,
        .col-xs-3 {
            width: 25% !important;
        }
        .col-sm-2,
        .col-xs-2 {
            width: 16.66666667% !important;
        }
        .col-sm-1,
        .col-xs-1 {
            width: 8.33333333% !important;
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
            font-size: 14px;
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
            display: none !important;
        }
    }
 
    </style>
</head>
<body>
 <div class="container-fluid"> 
    @if($logoUrl)
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
	@endif
	 <div class="row">
	<div class="col-sm-12">
		<center><h4><strong><u>ADMISSION CONSENT FORM</u></strong></h4></center>
		</div>
	</div>


<div class="row">
	<div class="col-sm-12">
		<label for="date" class="control-label">Date & Time :</label>
	
		{{-- $registration_data->registration_date_time --}}
		{{ $convert_to_words->format_date_time($registration_data->registration_date_time) }}
	</div>
	</div>
	<br>
	<div class="row">
	<div class="col-sm-6">
		<label for="date" class="control-label">IPD No. :</label>
	
		{{$registration_data->ipd_number}}
	</div>
	
	<div class="col-sm-6">
		<label for="date" class="control-label">UHID No. :</label>
	
		{{$registration_data->uhid_number}}
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<label for="date" class="control-label">Name :</label>
	
		{{$registration_data->first_name .' '.$registration_data->middle_name .' '.$registration_data->last_name}}
	</div>
</div>

<div class="row">
	<div class="col-sm-4"> <label for="date" class="control-label">Date of Birth :</label> 
	 {{$convert_to_words->format_date($registration_data->date_of_birth)}} </div>	
	
	<div class="col-sm-4"> <label for="date" class="control-label">Age :</label> 
	 {{$registration_data->age}} </div>
	
	<div class="col-sm-4"> <label for="date" class="control-label">Gender :</label> 
	 {{$registration_data->gender}} </div>
</div>


<div class="row">
	<div class="col-sm-12"> <label for="date" class="control-label">Address :</label> 
	 {{$registration_data->address}} 	
	
	<!-- <div class="col-sm-2"> <label for="date" class="control-label">Age :</label> </div> -->
	 &nbsp;{{$registration_data->area}} 
	
	<!-- <div class="col-sm-2"> <label for="date" class="control-label">Gender :</label> </div> -->
	&nbsp; {{$registration_data->city}} 
	
	 &nbsp;{{$registration_data->district}} </div>
</div>

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Email ID :</label> 
	 {{$registration_data->email}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Contact No. :</label> 
	 {{$registration_data->contact}} </div>
</div>

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Blood Group :</label> 
	 {{$registration_data->blood_group}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Maritial Status :</label> 
	 {{$registration_data->marital_status}} </div>
</div>
	 
<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Adhar Card Number :</label> 
	 {{$registration_data->adhar_card_number}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Admission Type :</label> 
	 {{$registration_data->admission_type}} </div>
</div>

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">TPA Company :</label> 
	 {{$registration_data->tpa_company}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Insurance Company :</label> 
	 {{$registration_data->insurance_company}} </div>
</div>


<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Responsible Relative Name :</label> 
	 {{$registration_data->responsible_realtive_name}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Relationship :</label> 
	 {{$registration_data->responsible_realtive_relation}} </div>
</div>

<div class="row">
	<!-- <div class="col-sm-2"> <label for="date" class="control-label">Address :</label> </div>
	<div class="col-sm-4"> {{$registration_data->relative_address}} </div>	 -->
	
	<div class="col-sm-6"> <label for="date" class="control-label">Contact No. :</label> 
	 {{$registration_data->relative_contact_number}} </div>
</div>



<!-- <div class="row">
	<div class="col-sm-2"> <label for="date" class="control-label">Weight :</label> </div>
	<div class="col-sm-4"> {{$registration_data->weight}} </div>	
	
	<div class="col-sm-2"> <label for="date" class="control-label">Height :</label> </div>
	<div class="col-sm-4"> {{$registration_data->height}} </div>
</div> -->

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Date of Admission & Time :</label> 
	 {{--$registration_data->admission_date_time--}}
	{{ $convert_to_words->format_date_time($registration_data->admission_date_time) }}
	</div>	
</div>


<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Consulting Doctor :</label> 
	 {{$all_docotrs[$registration_data->consulting_doctor]}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Referring Doctor :</label> 
	 {{$registration_data->referring_doctor}} </div>
</div>

<!--<div class="row">
	<div class="col-sm-2"> <label for="date" class="control-label">Admission in</label> </div>
</div>-->

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Ward Type :</label> 
	 {{$ward_bed_payment_data['ward_type']}} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Bed No. :</label> 
	 {{$ward_bed_payment_data['bed_number']}} </div>
</div>

<div class="row">
	<div class="col-sm-4"> <label for="date" class="control-label">Advance Amount :</label> 
	 {{$registration_data->advance_amount}} </div>	
	
	<div class="col-sm-4"> <label for="date" class="control-label">Payment Mode :</label> 
	 {{$payment_modes_array[$registration_data->payment_mode]}} </div>

	<div class="col-sm-4"> <label for="date" class="control-label">Payment ID No. :</label> 
	 {{$registration_data->payment_id_number}} </div>	
</div>
	 <br>
	 <br>

<!--<div class="row">
	<div class="col-sm-2"> <label for="date" class="control-label">Permission is hereby granted for :</label> </div>
	<div class="col-md-10">	
		<p>
			1) The administration of such treatment as is necessary and performance of any diagnostic examination, biopsy transfusion or operation and for administration of any anaesthetic as may deemad advisable in the course, of Hospital admission.
		</p>
		<p>
			2) Therelease of professinal and / or other information from the medical Record as may deemed necessary, in accordance with rules and policies of the hospital.
		</p>
		<p>
			3) We are not responsible for any valuable / belonging of the patient, Valuble should be removed.
		</p>
	</div>
</div>-->
	 <div class="container-fluid"> 
    

<div class="row">
	<div class="col-sm-12">
		<label for="date" class="control-label">I/ we relation of Mr./ Ms / Mrs / Master:</label>
	
		{{$registration_data->first_name .' '.$registration_data->middle_name .' '.$registration_data->last_name}}
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<label for="date" class="control-label">Permitting to treat our patient under care of :</label>
	
		{{$all_docotrs[$registration_data->consulting_doctor]}}
	</div>
</div>

<div class="row">
<p>&emsp;&emsp;We the relative of patient give consent for Treatment, Investigation & Procedure require necessary for the management of the patient. </p>
</div>

<div class="row">
<p>&emsp;&emsp;We are legally bound to pay expenses & damages which are likely to be incurred at Universal Hospital.</p>
</div>

<div class="row">
<p>&emsp;&emsp;All valuables, belongings, jewellery, mobile phone, cash Are responsibility of patient and their family members. Hospital staff or management are not responsible for any loss of belongings.</p>
</div>



<!-- <div class="row" style="text-align: center;">
	<div class="col-sm-6"> <label for="date" class="control-label">Signature</label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label">Signature</label> </div>
</div> -->
<br>
<br>
<br>


	

<div class="row" style="text-align: center;">
	<div class="col-sm-6"> <label for="date" class="control-label">Signature</label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label">Signature</label> </div>
</div>

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label" style="text-align: center;"> </label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label" style="text-align: center;"> </label> </div>
</div>

<div class="row" style="text-align: center;">
	<div class="col-sm-6"> <label for="date" class="control-label">Signature of the Patients Responsible / Relative</label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label">{{$convert_to_words->get_hospital_name()}}</label> </div>
</div>

	<div class="row">
		<div class="col-lg-12">
			<img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
		</div>
		<div class="col-lg-12">&nbsp;</div>
	</div>
  
</div> <!-- End main container -->

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