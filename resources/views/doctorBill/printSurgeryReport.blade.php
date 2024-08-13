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
    				<h3 class="panel-title"><strong>Surgery Report</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th><strong>Patient Name</strong></th>
                                <th><strong>Surgeon Name</strong></th>
                                <th><strong>Procedure Name</strong></th>
                                <th><strong>Surgery Date</strong></th>
                                <th><strong>Surgery Time</strong></th>
                                <th><strong>Amount</strong></th>
                            </tr>
                            </thead>
                            @if(!empty($results) && count($results) > 0 )
                                <?php $cntInt = 1 ?>
                                @foreach($results as $bdata) 
                                    <tr>
                                        <td >
                                               {{ $bdata->patient_name}}
                                        </td>
                                        <td> {{  $bdata->doctor_name }}  </td>
                                        <td> {{ $bdata->Surgery }} </td>
                                        <td> {{ $bdata->surgery_date }} </td>
                                        <td> {{ $bdata->Time_of_Surgery }} </td>
                                        <td> {{ $bdata->Amount }} </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
    				</div>
    			</div>
            </div>
            <div class="col-md-12">
                    <h3>{{ config('app.name', 'Dr') }}</h3> <br/>
                </div>
                <div class="col-md-12">
                    <span class="pull-left">
                            Date : <br>
                            Place : 
                    </span>
                    <div class="pull-right">
                        Date : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                        Place : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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