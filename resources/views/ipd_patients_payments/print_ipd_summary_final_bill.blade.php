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

		table,tr,td,th {
		border: 1px solid #000 !important;
	}
    }

	table,tr,td,th {
		border: 1px solid;
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
        <div class="col-lg-12 panel panel-default"> <center> <h4><strong> IPD Summary Bill </strong></h4> </center> </div>
    </div>
	@endif

<div class="row">
	<div class="col-sm-6">
		<label for="date" class="control-label">Bill No. :</label>
	
		{{$registration_data->ipd_summary_bill_number}}
	</div>
	<div class="col-sm-6">
		<label for="date" class="control-label">Date & Time :</label>
		
		@php
		if(isset($registration_data->ipd_bill_summary_date_time)) {
			$date_arr = explode(' - ', $registration_data->ipd_bill_summary_date_time);
		}
	@endphp
       {{ isset($registration_data->ipd_bill_summary_date_time) ? date('d/m/Y', strtotime($date_arr[0])) . ' ' . $date_arr[1] : '' }}
	
		{{-- $registration_data->ipd_bill_summary_date_time --}}
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
	<div class="col-sm-6">
		<label for="date" class="control-label">Name :</label>{{$registration_data->first_name .' '.$registration_data->middle_name .' '.$registration_data->last_name}}
	</div>
	<div class="col-sm-3">
		<label for="date" class="control-label">Age :</label>{{$registration_data->age}} 
	</div>
	<div class="col-sm-3">
		 <label for="date" class="control-label">Gender :</label> {{$registration_data->gender}}
	</div>
</div>

<!--<div class="row">
		
	<div class="col-sm-6"> <label for="date" class="control-label">Age :</label> </div>
	<div class="col-sm-2"> {{$registration_data->age}} </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label">Gender :</label> </div>
	<div class="col-sm-2"> {{$registration_data->gender}} </div>
</div>-->

<div class="row">
	<div class="col-sm-12"> <label for="date" class="control-label">Address :</label>  {{$registration_data->address}} &nbsp;{{$registration_data->area}} &nbsp; {{$registration_data->city}} &nbsp; {{$registration_data->district}}</div>	
	
	<!-- <div class="col-sm-2"> <label for="date" class="control-label">Age :</label> </div> 
	<div class="col-sm-2"> {{$registration_data->area}} </div>-->
	
	<!-- <div class="col-sm-2"> <label for="date" class="control-label">Gender :</label> </div> 
	<div class="col-sm-2"> {{$registration_data->city}} </div>
	
	<div class="col-sm-2"> {{$registration_data->district}} </div>-->
</div>

<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Date of Admission & Time :</label>  {{--$registration_data->admission_date_time--}} {{ $convert_to_words->format_date_time($registration_data->admission_date_time) }} </div>	
	
	<div class="col-sm-6"> <label for="date" class="control-label">Date of Discharge & Time :</label>  {{--$discharge_data->discharge_date_time--}} {{ $convert_to_words->format_date_time($discharge_data->discharge_date_time) }} </div>	
</div>


<div class="row">
	<div class="col-sm-6"> <label for="date" class="control-label">Consulting Doctor :</label>  {{$all_doctors[$registration_data->consulting_doctor]}} </div>	
</div>

<!-- <div class="row">
	<div class="col-sm-2"> <label for="date" class="control-label">Diagnosis :</label> </div>
	<div class="col-sm-10"> {{isset($estimated_bill_data->diagnosis) ? $estimated_bill_data->diagnosis : ''}} </div>	
</div>

<div class="row">
	<div class="col-sm-2"> <label for="date" class="control-label">Advance Amount :</label> </div>
	<div class="col-sm-4">{{--$advance_payment->advance_amount--}}{{$total_payment}}</div>	
	@php $discount_amount = isset($patientbill->discount_amount) ? $patientbill->discount_amount : 0; @endphp
@if(isset($patientbill->discount_amount))
	<div class="col-sm-2"> <label for="date" class="control-label">Discount Amount :</label> </div>
	<div class="col-sm-4"> {{$discount_amount}} </div>	
	@endif
</div>-->
<br>
<div class="row clearfix ">
	<div class="col-md-12">
	
		<table style="width:100%;">
			<thead>
				<tr>
				<th style="width:50px;">Sr No.</th>
				<th>Particulars</th>
				<th>Nos.</th>
				<th>Rate</th>
				<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				@php $final_total = 0;
					$i = 1;
				@endphp
				


				@foreach($ipd_particulars_data as $key => $ipd_particulars_data_row) 
				<tr>
					<td></td>
					<td><b>{{$ipd_particulars_data_row['name']}}</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@foreach($ipd_particulars_data_row['childs'] as $key => $ipd_particulars_data_row_data) 
					<tr>
						<td>{{$i++}}</td>
						<td>{{$ipd_particulars_data_row_data['name']}}</td>
						<td>{{$ipd_particulars_data_row_data['total_quantity']}}</td>
						<td>{{$ipd_particulars_data_row_data['amount']}}</td>
						<td>{{$ipd_particulars_data_row_data['total_amount']}}</td>
					</tr>
					@endforeach
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Group Total :</b></td>
					<td>{{$ipd_particulars_data_row['particular_total_amount']}}</td>
				</tr>

					@php $final_total += $ipd_particulars_data_row['particular_total_amount']; @endphp
				@endforeach
				


					<th colspan="4">Gross Total</th>
					<td>{{$final_total}}</td>
				</tr>
				<tr>
					<th colspan="5">Advance Details</th>
				</tr>
				@php $total_payment = 0; @endphp
				@foreach($payment_records as $key =>$payment_records_row) 
				<tr>
					<td colspan="2">{{$payment_records_row->date_time}}</td>
					<td >{{$payment_records_row->advance_amount}}</td>
					<td  >{{$payment_modes_array[$payment_records_row->payment_mode]}}</td>
					<td></td>

					@php $total_payment += $payment_records_row->advance_amount; @endphp				
				</tr>
				@endforeach
				<tr>
					<th colspan="4">Total Advance Payment</th>
					<td>{{$total_payment}}</td>
				</tr>

				@php $discount_amount = isset($patientbill->discount_amount) ? $patientbill->discount_amount : 0; @endphp
				<tr>
					<th colspan="4">Discount</th>
					<td>{{ ($discount_amount == 0) ? '' : $discount_amount }}</td>
				</tr>
				{{--
				<tr>
					<th colspan="4">Net Amount</th>
					@php $net_amount = $total_payment - $discount_amount; @endphp
					<td>{{$net_amount}}</td>
				</tr>
				--}}
				<tr>
					<th colspan="4">Balance Amount</th>
					<td>{{$final_total - $total_payment - $discount_amount}}</td>
				</tr>
			</tbody>
			
				</table>
	</div>
</div>

<div class="row clearfix ">
	<div class="col-md-12">
		<div class="col-md-4">Rs. In words</div>

		@php
		$itemsum = $final_total - $total_payment - $discount_amount;
		$itemsum = floatval($itemsum);
		 $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
		$billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);
		
		@endphp
		<div class="col-md-8">{{$billamountInWords}}</div>
	</div>
</div>

<!-- <div class="row" style="text-align: center;">
	<div class="col-sm-2"> <label for="date" class="control-label">Rs. in words</label> </div>
	
	<div class="col-sm-10"> <label for="date" class="control-label"></label> </div>
</div> -->

<div class="row" style="text-align: center;">
	<div class="col-sm-6"> <label for="date" class="control-label"></label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label">Signature</label> </div>
</div>

<div class="row" style="text-align: center;">
	<div class="col-sm-6"> <label for="date" class="control-label" style="text-align: center;"> </label> </div>
	
	<div class="col-sm-6"> <label for="date" class="control-label" style=" ">{{$convert_to_words->get_hospital_name()}} </label> </div>
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