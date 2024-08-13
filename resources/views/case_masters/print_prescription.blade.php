<?php //echo "=====>>>>>>> <pre>"; print_r($doctor); exit; 

//echo "=====>>>>>>> <pre>"; print_r($casedata); exit; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style type="text/css">
        .invoice-title h2,
        .invoice-title h3 {
            display: inline-block;
        }
        
        .table > tbody > tr > .no-line {
            border-top: none;
        }
        
        .table > thead > tr > .no-line {
            border-bottom: none;
        }
        
        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
</head>

<body>
    <div class="container"> 
    @if($logoUrl)
        <div class="row">
            <div class="col-lg-12">
                <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
            </div>
            <!--<div class="col-lg-12">&nbsp;</div>-->
        </div>
	@endif
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h4>Prescriptions</h4>
			
                   <h5 class="pull-right">Patient Number # {{ $casedata['case_number'] }}</h5>
					
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <address>Date:					{{ \Carbon\Carbon::now()->format('d/M/Y') }}
                            <br/>Name: {{ $casedata['mr_mrs_ms'] }}  {{ $casedata['patient_name'] }} {{ $casedata['middle_name'] }} {{ $casedata['last_name'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!--<br/> Address: {{$casedata['patient_address'] }}-->
                             Mobile no:  {{ $casedata['patient_mobile'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Follow-up Dt:  {{ $casedata['appointment_dt'] }}
                            <!--<br/> Follow-up Dt:  {{ $casedata['appointment_dt'] }}-->
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6 text-right">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prescption summary</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
                         <td><strong>Medicine</strong></td>
                         <td><strong>Generic Medicine</strong></td>
                         <td><strong>Eye</strong></td>
                         <td><strong>Duration</strong></td>
                         <td><strong>Frequency</strong></td>
						 <td><strong>Date</strong></td>
						 <td><strong>Timing</strong></td>
                         
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
							{{ $prescption->generic_name }}
							</td>
                <td>
                    {{ $prescption->strength }}
                </td>
                <td >
                    {{ $prescption->medicine_Quntity }}
                </td>
				{{--
                <td>
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
					{{ $prescption->from_date }} to {{ $prescption->to_date }}
				</td>
				--}}
				
				<td>
									@foreach($prescription_data[$prescption->id] as $prescription_data_row)
										{{ $prescription_data_row->frequency }}<hr>
									@endforeach
								</td>

								<td>
									@foreach($prescription_data[$prescption->id] as $prescription_data_row)
										{{ $prescription_data_row->date_from }} to {{ $prescription_data_row->date_to }}<hr>
									@endforeach
								</td>
				<td>
					{{ $prescption->medicine_timing }}
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
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