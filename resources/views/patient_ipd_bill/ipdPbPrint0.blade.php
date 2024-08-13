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
        <div class="col-lg-12 panel panel-default"> <center> <strong> BILL </strong> </center> </div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-6">
            <label for="name" class="control-label">Patient Name :</label>   {{ $patientRegister->name }} 
        </div>
        <div class="col-sm-6">
            <label for="Bill No." class="control-label">Bill No. :</label>   {{ $patientbill->bill_no }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">UHID no. :</label> {{ $patientRegister->uhid_no }}
        </div>
        <div class="col-sm-6">
            &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Age/Gender :</label>   {{ $patientRegister->age . "Years/" . $patientRegister->gender   }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">IPD No. :</label>   {{ $patientRegister->ipd_no }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Gaurdian Name :</label>   {{ $patientRegister->guardian_name  }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Room No. :</label>   {{ $patientRegister->room_no }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Address :</label>   {!! nl2br($patientRegister->address)  !!}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Bill Date :</label>   {{ $patientbill->bill_date }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Admission Date :</label>   {{ $patientRegister->registration_date  }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Admission Time :</label>   {{ $patientRegister->registration_time }}
        </div>
    </div>
                     @php
                       $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
                       if(is_null($ipdDischarge)){
                         $ipdDischarge = new App\Models\IPD\ipdDischarge;
                        }
                    @endphp  
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">TPA Company :</label>   {{ $patientbill->tpa_company }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Discharge Date :</label>   {{ $ipdDischarge->dod }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Insurance Company :</label>   {{ $patientbill->insurance_company }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Discharge Time :</label>   {{ $ipdDischarge->dodtime }}
        </div>
    </div>
	 
	   <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Advance Amount :</label>   {{ $patientbill->advance_amount }}  
        </div>
        <div class="col-sm-6">
            <label class="control-label">Discount Amount :</label>   {{ $patientbill->discount_amount }}
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
                                <strong>Particulars</strong>
                            </td>
                            <td >
                                <strong>Day</strong>
                            </td>
                            <td >
                                <strong>Rate</strong>
                            </td>
                            <td  class="text-right">
                                <strong>Amount</strong>
                            </td>
                        </tr>
                        </thead>
                        @if(!empty($billItems) && count($billItems) > 0 )
                            <?php $cntInt = 1; $itemsum = 0; ?>
                            @foreach($billItems as $bdata)
                                <tr>
                                    <td >
                                        {{$cntInt++}}
                                    </td>
                                    <td> {{ $bdata->particular }} </td>
                                    <td> {{ $bdata->day }} </td>
                                    <td> {{ $bdata->rate }} </td>
                                    <td class="text-right"> {{ (is_null($bdata->day)?1:$bdata->day)*$bdata->rate }} </td>
                                </tr>
                                @php
                                    $itemsum = $itemsum + ((is_null($bdata->day)?1:$bdata->day)*$bdata->rate);
                                @endphp
                            @endforeach
                                    <tr>
                                    <td class="thick-line text-right" colspan="4"> <label for="bill_Amount" class="control-label">Gross Total</label>  </td>
                                    
                                    <td class="thick-line text-right"> 
                                        <?php
                                            $itemsum = floatval($itemsum);
                                        ?>
                                        {{ number_format((float)$itemsum, 2, '.', '') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="no-line text-right" colspan="4"><label class="control-label">Advance Details </label></td>
                                    <td  class="no-line text-right"> {{ $patientbill->advance_amount }}</td>
                                </tr>
                                <tr>
                                    <td  class="no-line text-right" colspan="4"><label class="control-label">Discount Details</label> </td>
                                    <td  class="no-line text-right"> {{ $patientbill->discount_amount }} </td>
                                </tr>
                                <tr>
                                    <td  class="no-line text-right" colspan="4"><label class="control-label">Net Amount</label></td>
                                    @php
                                        $itemsum = $itemsum - $patientbill->advance_amount - $patientbill->discount_amount;
                                    @endphp
                                    <td  class="no-line  text-right"> {{ number_format((float)$itemsum, 2, '.', '') }} </td>
                                </tr>
                                <tr>
                                    <?php
                                            
                                        $billamount = $itemsum;
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
                                    <td class="no-line text-right" colspan="5">{{ $billamountInWords }}</td>
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