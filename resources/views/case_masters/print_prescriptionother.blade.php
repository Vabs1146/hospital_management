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
            <div class="col-lg-12">&nbsp;</div>
        </div>
	@endif
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h4>Prescriptions2</h4>
                    <h5 class="pull-right">Patient Number # {{ $casedata['case_number'] }}</h5>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>Date:					{{ \Carbon\Carbon::now()->format('d/M/Y') }}
                            <br/>Name: {{$casedata['patient_name'] }} 
                            <br/> Address: {{$casedata['patient_address'] }}
                            <br/> Mobile no:  {{ $casedata['patient_mobile'] }}
                            <br/> Follow-up Dt:  {{ $casedata['appointment_dt'] }}
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
                         <td><strong>Quantity</strong></td>
                         <td><strong>Day</strong></td>
                         <td><strong>Times a day</strong></td>
                         
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
                    {{ $prescption->strength }}
                </td>
                <td class="text-center">
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
                    {{ $prescption->numberoftimes }}
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
    </div>
    
    <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    
                    <br>
                    <br>
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