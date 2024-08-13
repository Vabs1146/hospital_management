<?php
use App\helperClass\drAppHelper; 
$convert_to_words = new drAppHelper();
?>
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
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
        </div>
        
    </div>
    <div class="row">
            <div class="col-lg-12 panel panel-default"> <center> <strong> MEDICINE CHARGE </strong> </center> </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-6">
            <label for="Bill No." class="control-label">Bill No. :</label>   {{ $patientbill->bill_no }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="name" class="control-label">Patient Name :</label>   {{ $patientRegister->name }} 
        </div>
        <div class="col-sm-6">
           
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Diagnosis :</label> {{ $discharge->diagnosis }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Doctor :</label>   {{ isset($doctorlist[$patientRegister->consultant_doctor])?$doctorlist[$patientRegister->consultant_doctor]: ""  }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">D.O.A. :</label>   {{ $patientbill->admit_date  }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">D.O.D. :</label>   {{ $patientbill->discharge_date }}
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td >
                                <strong>Sr. no.</strong>
                            </td>
                            <td >
                                <strong>Medicine</strong>
                            </td>
                            <td >
                                <strong>Dt. of Manf.</strong>
                            </td>
                            <td >
                                <strong>Dt. of Exp.</strong>
                            </td>
                            <td >
                                <strong>Batch No.</strong>
                            </td>
                            <td >
                                <strong>Price</strong>
                            </td>
                            <td >
                                <strong>Qty</strong>
                            </td>
                            <td  class="text-right">
                                <strong>Amount</strong>
                            </td>
                        </tr>
                        </thead>
                        @if(!empty($patientMedicine) && count($patientMedicine) > 0 )
                            <?php $cntInt = 1; $itemsum = 0; ?>
                            @foreach($patientMedicine as $pMedicine)
                                <tr>
                                    <td >
                                        {{$cntInt++}}
                                    </td>
                                    <td> {{ $pMedicine->medical_store->medicine_name }} </td>
                                    <td> {{ $pMedicine->date_of_mgf }} </td>
                                    <td> {{ $pMedicine->date_of_exp }} </td>
                                    <td> {{ $pMedicine->batch_no }} </td>
                                    <td> {{ $pMedicine->price }} </td>
                                    <td> {{ $pMedicine->quantity }} </td>
                                    <td> {{ $pMedicine->price*$pMedicine->quantity }} </td>
                                </tr>
                                @php
                                    $itemsum = $itemsum + ($pMedicine->price*$pMedicine->quantity);
                                @endphp
                            @endforeach
                                    <tr>
                                    <td class="thick-line text-right" colspan="7"> <label for="bill_Amount" class="control-label">Gross Total</label>  </td>
                                    
                                    <td class="thick-line text-right"> 
                                        <?php
                                            $itemsum = floatval($itemsum);
                                        ?>
                                        {{ number_format((float)$itemsum, 2, '.', '') }}
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                            
                                        $itemsum = floatval($itemsum);
        $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
        $billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);
										/*
                                        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                        $exp = explode('.', $billamount);
                                        if(sizeof($exp)>1){

                                        }
                                        $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
										*/
                                        /* $billamount = $billamount > 0 ? ($billamount += ($billamount*(floatval($case_master['tax_percentage'])/100))) : $billamount; */

										//$billamountInWords = $convert_to_words->displaywords($billamount);
                                    ?>
                                    <td class="no-line text-right" colspan="8">{{ $billamountInWords }}</td>
                                </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="form-group">
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
            {{ $patientRegister->name }}
        </div>
        <div class="col-md-6 pull-right">
            {{ config('app.name', 'Dr') }}
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
        });
    </script>

</body>
</html>