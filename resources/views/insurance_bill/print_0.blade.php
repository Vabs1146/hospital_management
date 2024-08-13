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
.payment {
    height: 40px;
    border: 2px solid #000;
    text-align: center;
    font-size: 16px;
    line-height: 2;
    font-weight: bold;
    margin-bottom: 15px;
}
.payment_details {
    border: 2px solid #000;
}
@media print {

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
  float: left;
}

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
}
.col-md-offset-3
{
    margin-left: 38% !important;
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
  font-size: 13px;
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
  display:none !important;
}
}
    </style>
</head>
<body>
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%"  />
        </div>
        <!--<div class="col-lg-12">&nbsp;</div>-->
    </div>
   
      <div><center><b><h3>BILL BREAKUP</h3></b></center></div>
    <div class="container" style="border: 2px solid black;">

    <div class="row">
       <div class="col-sm-8 col-md-offset-3">
           <!--  <center><label for="case_number" class="control-label"><b>BILL BREAKUP</b></label> </center> -->  
        </div> 
    </div>
    <br>
      <div class="row">
        <div class="col-md-12">
            <div class="col-sm-3">

                    <label for="Case No." class="control-label">Case No. :</label> 
                    {{ $insurance_bill->case_number }}
                      
            </div>
            <div class="col-sm-3">
                <label for="IPD No." class="control-label">IPD No. :</label> 
				{{ $case_master['IPD_no'] }}  
                        
            </div>
            <div class="col-sm-3">
                <label for="IPD No." class="control-label">UHID No. :</label> 
                {{ $insurance_bill->uhid_no }}
            </div>
            <div class="col-sm-3">
            <label for="IPD No." class="control-label">Bill No. :</label> 
               
				{{ $case_master['bill_number'] }}
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <div class="col-sm-5">
                <label for="IPD No." class="control-label">Patient Name :</label> 
                {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}                 
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Age</label> 
                {{ $case_master['patient_age'] }}              
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Gender</label> 
               {{ $case_master['male_female'] }}  
            </div>
			<div class="col-sm-3">
            <label for="IPD No." class="control-label">Bill Date. :</label> 
                    <!--{{ $insurance_bill->bill_date }}--> {{ \Carbon\Carbon::now()->format('d/M/Y') }}
            </div>
        </div>
    </div>   
    <div class="row">
        <div class="col-md-12">
                <div class="col-sm-12">
                    <label for="IPD No." class="control-label">Adderss:</label> 
                    {{ $case_master['patient_address'] }} {{ $case_master['area'] }} {{ $case_master['city'] }} {{ $case_master['district'] }} 
               </div>
			  <!--<div class="col-sm-4">
                    <label for="IPD No." class="control-label"></label> 
                    {{ $case_master['area'] }}  
               </div> 
			   <div class="col-sm-2">
                    <label for="IPD No." class="control-label"></label> 
                    {{ $case_master['city'] }}  
               </div> 
			   <div class="col-sm-2">
                    <label for="IPD No." class="control-label"></label> 
                    {{ $case_master['district'] }}  
               </div> -->
                                     
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <div class="col-sm-6">
                    <label for="IPD No." class="control-label">Surgery/Procedure :</label> 
                {{-- $surgery --}}  
				@foreach ($surgeryDetails as $item)
				 
					 
					  {{$item->text}} - {{$item->eye_operated}}
					  
				
				  @endforeach
				<!--@foreach ($surgeryDetails as $item)
				  <div class="col-md-6">
					 
					  {{$item->text}} - {{$item->eye_operated}}
					  
				  </div>
				  @endforeach-->

               </div>  
                 <div class="col-sm-6">
                    <label for="IPD No." class="control-label">Doctor-In-Charge :</label> 
                    {{ $surgon_name }} 
                    
               </div>  
                                                              
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <div class="col-sm-6">
                    <label for="IPD No." class="control-label">Admission Date & Time :</label> 
                    {{ $insurance_bill->admission_date_time }}
               </div>  
                 <div class="col-sm-6">
                   <label for="IPD No." class="control-label">Surgery Date/Time :</label> 
                {{ $insurance_bill->surgery_date_time }}
               </div>  
                                                              
        </div>
    </div>		
   <div class="row">
        <div class="col-md-12">
                <div class="col-sm-6">
                    <label for="IPD No." class="control-label">Discharge Date & Time :</label> 
            {{ $insurance_bill->discharge_date_time }}
               </div>  
                <div class="col-sm-6">
            <label for="IPD No." class="control-label">Discharge Status :</label> 
                    {{ $insurance_bill->discharge_sts }}                
               </div>                          
        </div>
    </div>
   <!--<div class="row">
        <div class="col-md-12">
                <div class="col-sm-6">
                     <label for="IPD No." class="control-label">Doctor-In-Charge :</label> 
                    {{ $surgon_name }}
               </div>  
               <div class="col-sm-6">
                    <label for="IPD No." class="control-label">Insurance Company :</label> 
                    {{ $insurance_bill->insurance_company }}
               </div>                          
        </div>
    </div>-->
     
    </div>
    <br>
    <div class="container">

         <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead style="border-bottom: 2px solid black;">
                                <tr>
                                    <td >
                                        <strong>Sr no.</strong>
                                    </td>
                                    
                                    <td >
                                        <strong>Bill Details</strong>
                                    </td>
                                  
                                    <td  class="text-right"><strong>Amount</strong></td>                           
                                    
                                </tr>
                                </thead>
                                @if(!empty($billdata) && count($billdata) > 0 )
                                    <?php $cntInt = 1 ?>
                                    @foreach($billdata as $bdata) 
                                        <tr>
                                            <td >
                                                {{$cntInt++}}
                                            </td>
                                       
                                            <td> {{ $bdata->bill_item }} </td>
                                        
                                            <td class="text-right"> {{ $bdata->bill_Amount }} </td>
                                        </tr>
                                    @endforeach
                                         <tr>
                                            <td  class="thick-line" >
                                            
                                            </td>
                                           
                                            <td class="thick-line text-right"> <label for="bill_Amount" class="control-label">sub Total</label>  </td>
                                            
                                            <td class="thick-line text-right"> 
                                                <?php 
                                                    $itemsum = 0; 
                                                    $itemsum = $billdata->sum('bill_Amount');
                                                    $itemsum = floatval($itemsum);
                                                ?>
                                                {{ number_format((float)$itemsum, 2, '.', '') }}


                                                  <?php

												  $itemsum = floatval($itemsum);
        $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
        $billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);

                                                    /*
                                                    $billamount = (isset($itemsum) && $itemsum > 0) ? ($itemsum += ($itemsum*(floatval($case_master['tax_percentage'])/100))) : $itemsum;
    
                                                    $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum - floatval($case_master['paidAmount'])) : 0;
                                                    $billamount = number_format((float)$billamount, 2, '.', '');
													$billamountInWords = "";
													
                                                    $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                                    $exp = explode('.', $billamount);
                                                    if(sizeof($exp)>1){
    
                                                    }
                                                    $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
													

                                                     $billamount = $billamount > 0 ? ($billamount += ($billamount*(floatval($case_master['tax_percentage'])/100))) : $billamount; 
													 */
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  class="no-line" >
                                            
                                            </td>
                                      
                                            <td  class="no-line text-right"><label class="control-label">Advance Details</label></td>
                                            <td  class="no-line text-right"> {{$insurance_bill->advance_amount}}</td>
                                        </tr>
                                        <tr>
                                            <td  class="no-line" >
                                            
                                            </td>
                                      
                                            <td  class="no-line text-right"><label class="control-label">Discount Details</label></td>
                                            <td  class="no-line text-right"> {{$insurance_bill->discount_amount}}</td>
                                        </tr>
                                     <!-- <tr>
                                            <td  class="no-line" >
                                            
                                            </td>
                                      
                                            <td  class="no-line text-right"><label class="control-label">Tax %</label></td>
                                            <td  class="no-line text-right"> {{$case_master['tax_percentage']}}</td>
                                        </tr>  
                                        <tr>
                                            <td  class="no-line" >
                                            
                                            </td>
                                            
                                            <td  class="no-line text-right"><label class="control-label">Paid Amount</label> </td>
                                            <td  class="no-line text-right"> {{$case_master['paidAmount']}} </td>
                                        </tr>-->
                                        <tr>
                                            <td  class="no-line" >
                                            
                                            </td>
                                          
                                            <td  class="no-line text-right"><label class="control-label">Total Amount</label></td>
                                             @php
                                                $itemsum = $itemsum - $insurance_bill->advance_amount - $insurance_bill->discount_amount;
                                            @endphp
                                            <td  class="no-line  text-right"> {{ number_format((float)$itemsum, 2, '.', '') }} Rs. </td>
                                        </tr>
                                        <tr>
                                            <td class="no-line text-right" colspan="5">{{-- $billamountInWords --}}
											{{ $billamountInWords_calculated }}</td>
                                        </tr>
                                @endif
                            </table>
                        </div>
            </div>
        </div>
		<br>
		
		@if(!empty($payment_details) && count($payment_details) > 0 )
            <div class="payment">Payment Details</div>
			<div class="row">
				<div class="col-md-12">
					<div class="payment_details panel-default">

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
									@if($advance_amount > 0)
										<tr>
											<td>  
												{{$cntInt++}}
											</td>
											<td>
												{{date('d F, Y', strtotime($advance_date))}}                
											</td>
											<td>
												{{$payment_modes_array[$advance_payment_type]}}   
											</td>
											<td class="text-right">    
												{{$advance_amount}}                            
											</td>
										</tr>
									@endif	
									
										@foreach($payment_details as $payment_details_row) 
											<tr>
												<td >
													{{$cntInt++}}
												</td>
												
												<td> {{date('d F, Y', strtotime($payment_details_row->payment_date))}} </td>
												<td> {{$payment_modes_array[$payment_details_row->payment_mode]}}    </td>
												
												<td class="text-right"> {{$payment_details_row->paid_amount}}   </td>
											</tr>
										@endforeach
											 <tr>
												
												<td class="thick-line" >&nbsp;</td>
												<td class="thick-line" >&nbsp;</td>
												<td class="thick-line text-right"> <label for="bill_Amount" class="control-label">Total Paid</label>  </td>
												
												<td class="thick-line text-right"> 
												   @if($advance_amount > 0)
														Rs. {{$total_paid + $advance_amount}}  
													@else
														Rs. {{$total_paid}}     
													@endif	  
												</td>
											</tr>
											
											<tr>
												
												<td  class="no-line">&nbsp;</td>
												<td  class="no-line">&nbsp;</td>
												<td  class="no-line text-right"><label class="control-label">Balance</label></td>
												<td  class="no-line  text-right"> Rs. {{round(($itemsum - $total_paid), 2)}}    </td>
											   
											</tr>
									<tr><td></td><td></td><td></td>
										<td style="text-align:right;">
											
											<?php
									                $amountInWords = "";
                                                    /*
                                                    $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                                    $exp = explode('.', $total_paid);
                                                    if(sizeof($exp)>1){
    
                                                    }
                                                    $amountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.'; 
													*/
													?>

											{{-- $amountInWords --}}
											{{ $billamountInWords_calculated }}</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			@endif
    </div>


	
   

    <br/>
    <br/>
    <br/>
    <br/>
    
    <div class="col-md-10" style="float: none;
    margin: 0 auto;
    text-align: center;">
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
             {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}
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