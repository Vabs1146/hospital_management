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
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                 <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
    		</div>
    		<hr>
    		<div class="row">
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
                                <th> <strong> Sr no1. </strong></th>
                                <th> <strong> Date </strong></th>
                                <th>  </th>
                                <th> </th>
                                <th> <strong>Details</strong> </th>                                        
                                <th> <strong>Amount</strong> </th>
                            </tr>
                            </thead>
                            @if(!empty($billdata) && count($billdata) > 0 )
                                <?php $cntInt = 1 ?>
                                @foreach($billdata as $bdata) 
                                    <tr>
                                        <td >
                                            {{$cntInt++}}
                                        </td>
                                        <td> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $bdata->created_at)->format('d/M/Y') }} </td>
                                        <td>  </td>
                                        <td>  </td>
                                        <td> {{ $bdata->bill_item }} </td>
                                        <td> {{ $bdata->bill_Amount }} </td>
                                    </tr>
                                @endforeach
                                     <tr>
                                        <td class="thick-line">

                                        </td>
                                        <td class="thick-line">

                                        </td>
                                        <td class="thick-line">

                                        </td>
                                        <td class="thick-line">

                                        </td>
                                        <td class="thick-line  text-right"> <label for="bill_Amount" class="control-label">sub Total</label>  </td>
                                        <td class="thick-line"> 
                                            <?php 
                                                $itemsum = 0; 
                                                $itemsum = $billdata->sum('bill_Amount');
                                                $itemsum = floatval($itemsum);
                                            ?>
                                            {{ round($itemsum,2) }}
                                              <?php
                                                
                                                $billamount = 0;
                                                
                                            ?>
                                        </td>
                                    </tr>
                            @endif
                        </table>
    				</div>
    			</div>
    		</div>
        </div>
        <br>
    <br>
    <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <li>Dr. Sanjeev Balani</li></b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <br>
                    <br>
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
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