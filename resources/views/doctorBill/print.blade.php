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
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{ $casedata['case_number'] }}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$casedata['patient_name']}}<br>
    					{{$casedata['patient_mobile']}}<br>
    					{{$casedata['patient_emailId']}}<br>
    					{{$casedata['patient_address']}}<br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    				<strong>Shipped To:</strong><br>
    					{{$casedata['patient_name']}}<br>
    					{{$casedata['patient_mobile']}}<br>
    					{{$casedata['patient_emailId']}}<br>
    					{{$casedata['patient_address']}}<br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{ \Carbon\Carbon::now()->format('d/M/Y') }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td >
                                    <strong>Sr no.</strong>
                                </td>
                                <td >
                                    <strong>Bill Item</strong>
                                </td>
                                <td  class="text-right"><strong>Totals</strong></td>                           
                                
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
                                            {{ round($itemsum,2) }}
                                              <?php
                                                
                                                $billamount = (isset($itemsum) && $itemsum > 0) ? ($itemsum += ($itemsum*(floatval($casedata['tax_percentage'])/100))) : $itemsum;

                                                $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum - floatval($casedata['paidAmount'])) : 0;
                                                /* $billamount = $billamount > 0 ? ($billamount += ($billamount*(floatval($casedata['tax_percentage'])/100))) : $billamount; */
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td  class="no-line" >
                                        
                                        </td>
                                        <td  class="no-line text-right"><label class="control-label"></label></td>
                                        <td  class="no-line text-right"> {{$casedata['tax_percentage']}}</td>
                                    </tr>
                                    <tr>
                                        <td  class="no-line" >
                                        
                                        </td>
                                        <td  class="no-line text-right"><label class="control-label">Paid Amount</label> </td>
                                        <td  class="no-line text-right"> {{$casedata['paidAmount']}} </td>
                                    </tr>
                                    <tr>
                                        <td  class="no-line" >
                                        
                                        </td>
                                        <td  class="no-line text-right"><label class="control-label">Total Amount</label></td>
                                        <td  class="no-line  text-right"> {{ round($billamount, 2)}} </td>
                                    </tr>
                            @endif
                        </table>
    				</div>
    			</div>
    		</div>
        </div>
        <div class="col-md-12">
                <h3>{{ config('app.name', 'Dr') }}</h3> <br/>
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