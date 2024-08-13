<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
            font-size: 10px;
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
            </div>
            <div class="col-lg-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h4>Prescriptions</h4>
                   <!-- <h5 class="pull-right">Patient Number # {{ $casedata['case_number'] }}</h5> -->
                </div>
                <div class="row">
                 <!--   <div class="col-xs-6">
                        <address>Date:					{{ \Carbon\Carbon::now()->format('d/M/Y') }}
                            <br/>Name: {{$casedata['patient_name'] }} 
                            <br/> Address: {{$casedata['patient_address'] }}
                            <br/> Mobile no:  {{ $casedata['patient_mobile'] }}
                            <br/> Follow-up Dt:  {{ $casedata['appointment_dt'] }}
                        </address>
                    </div>
					-->
                </div>
				
				<div class="row">
                    <div class="col-sm-6">
						 
					</div>
					<div class="col-sm-6">
						<label class="control-label">Patient Number :</label>   # {{ $casedata['case_number'] }}
					</div>
                </div>
				
				<div class="row">
                    <div class="col-sm-6">
						<label for="case_number" class="control-label">Name :</label>   {{ $casedata['patient_name'] }} 
					</div>
					<div class="col-sm-6">
						<label class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
					</div>
                </div>
				
				<div class="row">
                    <div class="col-sm-6">
						<label for="case_number" class="control-label">Address :</label>   {{ $casedata['patient_address'] }} 
					</div>
					<div class="col-sm-6">
						<label class="control-label">Follow-up Dt :</label>   {{ $casedata['appointment_dt'] }} 
					</div>
                </div>
				
				<div class="row">
                    <div class="col-sm-6">
						<label for="case_number" class="control-label">Mobile no :</label>   {{ $casedata['patient_mobile'] }} 
					</div>
					<div class="col-sm-6">
						
					</div>
                </div>
				
				<div class="row">
                    <div class="col-sm-6">
						<label for="case_number" class="control-label">UHID Number :</label>   {{ $casedata['uhid_no'] }}  
					</div>
					<div class="col-sm-6">
						<label class="control-label">
					</div>
                </div>
				
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"></h3>
                    </div>
                    <div class="panel-body">
						@if($prscription_notes)
			<tr><td></td><td><strong>Note :&nbsp;&nbsp;</strong></td><td colspan="4">{!! nl2br($prscription_notes) !!}</td></tr>
		@endif
		<br>
						<br>
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
                         <td><strong>Medicine</strong></td>
						 <td><strong>Times a day</strong></td>
						<td><strong>Day</strong></td>
                         <td><strong>Quantity</strong></td>
                        
                         
                         
                </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Sumtotal = 0; ?>
                                @foreach($casedata['prescriptions'] as $prescption)
                                <tr>
               <td>
                    {{  $loop->iteration }}
                </td>   
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                
                <td>
					 {{ $prescption->numberoftimes }}
                  
                </td>
                <td>
                  {{ $prescption->medicine_Quntity }}  
                </td>
                <td>
					
					  {{ $prescption->strength }}
                   
                </td>
                
                
            <tr>
                                 @endforeach
                                {{-- <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">{{ $Sumtotal }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Tax</strong></td>
    								<td class="no-line text-right">15%</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">{{ $Sumtotal + ($Sumtotal * (15/100))  }} </td>
    							</tr> --}}
								
									<!--@if($prscription_notes)
			<tr><td></td><td>Note</td><td colspan="4">{!! nl2br($prscription_notes) !!}</td></tr>
		@endif-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <!--<div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    
                    <br>
                    <br>
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>-->
	<div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    @if($doctor)
						<p>{{ $doctor->doctor_name }}</p>
						<p>{{ $doctor->doctorDegree }}</p>
						<p>{{ $doctor->reg_number }}</p>
					@endif
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
            //Added comment to incluede file in commit
        });
    </script>
</body>

</html>