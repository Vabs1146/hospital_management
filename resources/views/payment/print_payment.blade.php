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
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Dates :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="case_number" class="control-label">Case Number :</label>   {{ $case_master['case_number'] }} 
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            @if( !empty($dentist_bill) && null !== $dentist_bill && count($dentist_bill) > 0 )
            <thead>
                <tr>
                    <th>    
                        {{ Form::label('treatmentDone','Treatment Done') }} 
                    </th>
                    <th>
                        {{ Form::label('date','Date') }} 
                        
                    </th>
                    <th> 
                        {{ Form::label('amountPaid','Amount Paid') }} 
                        
                     </th>
                </tr>
            </thead>
            @foreach($dentist_bill as $billdata) 
                    <tr>
                        <td> {{ $billdata->treatmentDone }} </td>
                        <td> {{ $billdata->date }} </td>
                        <td>{{ $billdata->amountPaid }} </td>
                    </tr>
                @endforeach
                        <tr>
                        <td>  </td>
                        <td align="right"> 
                            <p></p>
                            <label for="totalAmount" class="control-label">Total</label>  
                        </td>
                        <td> 
                            <?php $itemsum = 0; 
                                    $itemsum = $dentist_bill->sum('amountPaid'); 
									/*
                                    $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                    $exp = explode('.', $itemsum);
                                    $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
*/
									$billamountInWords = $convert_to_words->displaywords($billamount);
                            ?>
                            <p></p>
                            {{ $itemsum }}
                            <p>{{$billamountInWords}}</p> 
                        </td>
                    </tr>
            @endif
        </table>
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
            {{ $case_master['patient_name'] }}
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
            setTimeout(function () { window.print();window.close(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>

</body>
</html>