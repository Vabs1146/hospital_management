<?php
use App\helperClass\drAppHelper; 
$convert_to_words = new drAppHelper();
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
        <div class="col-lg-12 panel panel-default"> <center> <h4><strong>Advance Receipt </strong></h4> </center> </div>
    </div>
	@endif


<div class="row">
	<div class="col-sm-6">
		<label for="date" class="control-label">Receipt No :</label>
	
		{{$payment_data->receipt_number}}
	</div>

	
	<div class="col-sm-6">
		<label for="date" class="control-label">Date :</label>
	
		{{date('d-m-Y', strtotime($payment_data->created_at))}}
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<label for="date" class="control-label">Name :</label>
	
		{{$registration_data->first_name .' '.$registration_data->middle_name .' '.$registration_data->last_name}}
	</div>
</div>

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
	<div class="col-sm-8"> <label for="date" class="control-label">Towards :</label> 
	 Advance </div>
</div>

@php
$itemsum = floatval($payment_data->advance_amount);
$billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
$billamount = number_format((float)$billamount, 2, '.', '');
$billamountInWords = $convert_to_words->displaywords($billamount);

@endphp
<div class="row">
	<div class="col-sm-12"> <label for="date" class="control-label">Rupees in Word :</label> 
	 {{$billamountInWords}} </div>
</div>
	<br>
	 
<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label"><stong><h4>Rs :</h4></stong></label>
	 {{$payment_data->advance_amount}} </div>
</div>

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label" style="text-align: center;"> </label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label" style="text-align: center;"> </label> </div>
</div>

<div class="row" style="text-align: center;">
	<div class="col-sm-6"> <label for="date" class="control-label"> </label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label">Received Signature</label> </div>
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