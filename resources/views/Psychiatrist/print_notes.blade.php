<?php //echo "=====>>>>>>> <pre>"; print_r($doctor); exit; 

//echo "=====>>>>>>> <pre>"; print_r($casedata); exit; 

//echo "====1111111===>>> <pre>"; print_r($casedata['prescriptions']); exit;
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
                    <h4>Notes</h4>
			
                   <h5 class="pull-right">Patient Number # {{ $casedata['case_number'] }}</h5>
					
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <address>Date:					{{ \Carbon\Carbon::now()->format('d/M/Y') }}
                            <br/>Name: {{ $casedata['mr_mrs_ms'] }}  {{ $casedata['patient_name'] }} {{ $casedata['middle_name'] }} {{ $casedata['last_name'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <!--<br/> Address: {{$casedata['patient_address'] }}-->
                             Mobile no:  {{ $casedata['patient_mobile'] }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Follow-up Dt:  {{ $casedata['appointment_dt'] }} {{ $casedata['appointment_timeslot'] }}
                            <!--<br/> Follow-up Dt:  {{ $casedata['appointment_dt'] }}-->
                        </address>
                    </div>
                </div>
                <div class="row">
					
                    <div class="col-xs-12">
					Followup Notes : 
						@if($casedata['casehistory_followup_notes'])
						{{$casedata['casehistory_followup_notes']}}
						@endif
                    </div>
                </div>
            </div>
        </div>
		
		
		@if($doctor_notes->notes)
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Doctor Notes</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
						{!! nl2br($doctor_notes->notes) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@endif
		
		
		
		@if($psychiatrist_advice->notes)
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Advice</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
						{!! nl2br($psychiatrist_advice->notes) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@endif
		
		@if($treatment_notes)
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Treatment Notes</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
						<table class="table table-condensed">
                                
                                <tbody>
									@foreach ($treatment_notes as $key => $item)
									<tr>
									<td><strong>{{$key + 1}}.</strong></td>
									 <td><strong>{{$item->notes}}</strong></td>
									 </tr>
									 @endforeach
								</tbody>
								</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@endif
    

		@if(isset($prescription_notes->notes) && $prescription_notes->notes)
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prescription Notes</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
						{!! nl2br($prescription_notes->notes) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
		@endif

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