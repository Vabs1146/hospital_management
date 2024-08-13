<?php
use App\helperClass\drAppHelper; 
$convert_to_words = new drAppHelper();
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
<div class="container">
	<!--@if(isset($header_footer_data[4]) && $header_footer_data[4] == "1" && $logoUrl != "")
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
    </div>
	@endif-->
	<div class="row">
        <div class="col-lg-12">
	<div><center><b><h2>Royal HOSPITAL </h2></b></center></div>
			<div><center><b><h5> 1st Floor, Sahyog plaza, Murbad - Masa Road, Near Bus stand, Murbad  </h5></b></center></div>
<div><center><b><h5>Contact : +91 9067260967  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website : www.royalhospitalmurbad.com</h5></b></center></div>
			<div><center><b><h4>24 HRS. EMERGENCY SERVICE </h4></b></center></div>
			</div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                    <strong>Billed To:</strong>
                        {{$casedata['mr_mrs_ms']}} {{$casedata['patient_name']}} {{$casedata['middle_name']}} {{$casedata['last_name']}}<br>
                      
                        <strong> Date:
                         @forelse ($DateWiseRecordLst as $VisitListDateWise)
						 @if($case_master['id'] == $VisitListDateWise['id'])
						 {{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}<span> &nbsp;,</span>

						 @endif
						@endforeach
						</strong>    
                    </address>
                    </div>
                <div class="col-xs-6 text-right">
                    case no. :  {{$casedata['case_number']}}
                </div>
				<div class="col-xs-6 text-right">
                    Bill no. :  {{$casedata['bill_number']}}
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td >
                                    <strong>Sr no.</strong>
                                </td>
                                <td >&nbsp;
                                    
                                </td>
								 <td >
                                    <strong>Fees Details</strong>
                                </td>
                                <td >
                                   <!-- <strong>Doctor</strong>-->
                                </td>
                               
                                <!-- <td >
                                   Payment Mode
                                </td> -->
                                <td  class="text-right"><strong>Totals</strong></td>                           
                                
                            </tr>
                            </thead>
                            @if(!empty($billdata) && count($billdata) > 0 )
                                <?php $cntInt = 1; ?>
                                @foreach($billdata as $bdata) 
                                    <tr>
                                        <td >
                                            {{$cntInt++}}
                                        </td>
                                        <td >&nbsp;
                                    
                                </td>
                                        <!--<td> {{ $doctor_array[$bdata->doctor_id] }} </td>-->
										<td >
										@if(isset($fees_details_array[$bdata->bill_item]))
											{{$fees_details_array[$bdata->bill_item]}}
										@else
											
										@endif
										</td>
                                       {{-- <td> {{ isset($fees_details_array[$bdata->bill_item]) ? $fees_details_array[$bdata->bill_item] ? '' }} </td> --}}
										<td >
                                            
                                        </td>
                                        
                                        <td class="text-right"> {{ $bdata->bill_Amount }} </td>
                                    </tr>
                                @endforeach
                                     <tr>
                                        
										<td  class="thick-line" > </td>
                                        <td class="thick-line" >&nbsp;</td>
                                        <td class="thick-line" >&nbsp;</td>
                                        <td class="thick-line text-right"> <label for="bill_Amount" class="control-label">Sub Total</label>  </td>
                                        
                                        <td class="thick-line text-right"> 
                                            <?php 
                                                $itemsum = 0; 
                                                $itemsum = $billdata->sum('bill_Amount');
                                                $itemsum = floatval($itemsum);
                                            ?>
                                            {{ round($itemsum,2) }}
                                              <?php

											  $itemsum = floatval($itemsum);
        $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
        $billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);
                                                
                                               // $billamount = (isset($itemsum) && $itemsum > 0) ? ($itemsum += ($itemsum*(floatval($casedata['tax_percentage'])/100))) : $itemsum;

                                               // $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum - floatval($casedata['paidAmount'])) : 0;
												/*
                                                $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                                $exp = explode('.', $billamount);
                                                if(sizeof($exp)>1){

                                                }
                                                $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
												*/
												$billamountInWords = "";
												$billamountInWords = $convert_to_words->displaywords($billamount);
                                                /* $billamount = $billamount > 0 ? ($billamount += ($billamount*(floatval($casedata['tax_percentage'])/100))) : $billamount; */
                                            ?>
                                        </td>
                                    </tr>
                                    
									@if($casedata['bill_discount'] != "" && !empty($casedata['bill_discount'])) 
										<tr>
											
											<td  class="no-line" > </td>
											<td  class="no-line">&nbsp;</td>
											<td  class="no-line">&nbsp;</td>
											<td  class="no-line text-right"><label class="control-label">Discount</label></td>
											<td  class="no-line  text-right"> {{ round((float) $casedata['bill_discount'], 2)}} </td>
										   
										</tr>
									@endif
                                    
                                    <tr>
                                       
										<td  class="no-line" > </td>
                                        <td  class="no-line">&nbsp;</td>
                                        <td  class="no-line">&nbsp;</td>
                                        <td  class="no-line text-right"><label class="control-label">Total Amount</label></td>
                                        <td  class="no-line  text-right"> {{ round($casedata['billAmount'], 2)}} </td>
                                       
                                    </tr>
									
                                    <tr>
                                        <td class="no-line text-left" colspan="4">{{ $billamountInWords }}</td>

                                    </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



	@if(!empty($payment_details) && count($payment_details) > 0 )

	<!--<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td >
                                    <strong>Sr no.</strong>
                                </td>
                               
                                <td >
                                    <strong>Payment Date</strong>
                                </td>
                                <td >
                                    <strong>Payment Mode</strong>
                                </td>
                                <td class="text-right">
                                   Payment Amount
                                </td>
                            </tr>
                            </thead>
                            
                                <?php $cntInt = 1 ?>
                                @foreach($payment_details as $payment_details_row) 
                                    <tr>
                                        <td >
                                            {{$cntInt++}}
                                        </td>
                                        
                                        <td> {{date('d F, Y', strtotime($payment_details_row->payment_date))}} </td>
                                        <td> {{$payment_modes_array[$payment_details_row->payment_mode]}}    </td>
                                        
                                        <td class="text-right"> {{$payment_details_row->paid_Amount}}   </td>
                                    </tr>
                                @endforeach
                                     <tr>
                                        
                                        <td class="thick-line" >&nbsp;</td>
                                        <td class="thick-line" >&nbsp;</td>
                                        <td class="thick-line text-right"> <label for="bill_Amount" class="control-label">Total Paid</label>  </td>
                                        
                                        <td class="thick-line text-right"> 
                                           Rs. {{$total_paid}}    
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        
                                        <td  class="no-line">&nbsp;</td>
                                        <td  class="no-line">&nbsp;</td>
                                        <td  class="no-line text-right"><label class="control-label">Balance</label></td>
                                        <td  class="no-line  text-right"> Rs. {{round(($casedata['billAmount'] - $total_paid), 2)}}    </td>
                                       
                                    </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

	@endif

 
    <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
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
        });
    </script>
</body>

</html>