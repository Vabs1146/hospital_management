<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
    /* Print styling */
 
 .list-group1 li
 {
    float: left;
    list-style-type: square;
    margin: 10px 20px;
    padding:0px;
 }
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
            font-size: 14px;
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
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">
            <label for="date" class="control-label">Time :</label>   
            {{ $casedata['visit_time'] }}
        </div>
    </div>
    <div class="row">
            <div class="col-sm-6">
                <label for="case_number" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }} 
            </div>
            <div class="col-sm-6">
                    <label class="control-label">UHID NO :</label>   {{ $case_master['uhid_no'] }}
                </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $casedata['mr_mrs_ms'] }} {{ $casedata['patient_name'] }} {{ $casedata['middle_name'] }} {{ $casedata['last_name'] }}
            </div>
            <div class="col-sm-6">
                
                <div class="col-sm-6">
                    <label class="control-label">Age :</label>   {{ $casedata['patient_age'] }}
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Gender :</label>   {{ $casedata['male_female'] }}
                </div>
            </div>
        </div>
        
       <br>
	   <br>

@php 
$is_first = 0;
$otherDetailsDiagnosis = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get();
$otherDetailsAnteriorSegment = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get();
$otherDetailsPosteriorSegment = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get();
$other_details_treatment_given = $form_details->eyeformmultipleentry()->where('field_name', 'other_details_treatment_given')->get();
$otherDetailsAdditionalInformation = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdditionalInformation')->get();
$planOfManagement = $form_details->eyeformmultipleentry()->where('field_name', 'planOfManagement')->get();

$otherDetailsAdvice = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdvice')->get();
$otherDetailsSurgery = $form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get();
@endphp

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table  table-bordered">
				<thead>
					<tr>
						<td > </td>
						<td > <strong>OD</strong> </td>
						<td > <strong>OS</strong> </td>
					</tr>
				</thead>
				<tbody>
					@if(count($otherDetailsDiagnosis))
						@foreach($otherDetailsDiagnosis as $item_key => $item)
						<tr>
							<td > {{($item_key == 0) ? 'Diagnosis' : '' }} </td>
							<td > <strong>{{$item->field_value_OD}}</strong> </td>
							<td > <strong>{{$item->field_value_OS}}</strong> </td>
						</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif
					

					@if(count($otherDetailsAnteriorSegment))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif
						@foreach($otherDetailsAnteriorSegment as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Anterior Segment' : '' }} </td>
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($otherDetailsPosteriorSegment))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif
						@foreach($otherDetailsPosteriorSegment as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Posterior Segment' : '' }} </td>
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif

					

					@if(count($other_details_treatment_given))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($other_details_treatment_given as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Treatment Given' : '' }} </td>
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($otherDetailsAdditionalInformation))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($otherDetailsAdditionalInformation as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Additional Information' : '' }} </td>
								<td colspan="2"> <strong>{{$item->field_value_OD}}</strong> </td>
								<!-- <td > <strong>{{$item->field_value_OS}}</strong> </td> -->
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($planOfManagement))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($planOfManagement as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Plan Of Management' : '' }} </td>
								<td colspan="2"> <strong>{{$item->field_value_OD}}</strong> </td>
								<!-- <td > <strong>{{$item->field_value_OS}}</strong> </td> -->
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					
					@if(count($otherDetailsAdvice))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($otherDetailsAdvice as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Advice' : '' }} </td>
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($otherDetailsSurgery))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($otherDetailsSurgery as $item_key => $item)
							<tr>
								<td > {{($item_key == 0) ? 'Surgery/Procedure' : '' }} </td>
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


@php 
$other_details_comment = $form_details->eyeformmultipleentry()->where('field_name', 'other_details_comment')->first();

$other_details_comment_val = $other_details_comment->field_value_OD??'';
@endphp

					@if($other_details_comment_val)
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						<tr>
							<td > Comment : </td>
							<td colspan="2"> <strong>{{$other_details_comment_val}}</strong> </td>
							<!-- <td > <strong>{{$item->field_value_OS}}</strong> </td> -->
						</tr>
						@php $is_first = 1; @endphp
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>


				 @if(count($form_details->uveiitis_bloodtests_data))
                <div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table  table-bordered">
									<tbody>
										<tr>
												
												<td>
													Blood Investigation
												</td>
												
												<td >
													
												</td>
											</tr>
										
										@php $test_type = ""; @endphp
										@foreach($form_details->uveiitis_bloodtests_data as $key => $item)
											<tr>
												
												<td>
													@if($item->test_type != $test_type) 
														{{$item->test_type}} 
													@endif

													@php $test_type = $item->test_type; @endphp
												</td>
												
												<td >
													<strong>{{$item->value}}</strong>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
                </div>
                @endif
       
        @if(!$CheckField::IsFieldEmpty($form_details->localExamReport))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Additional Information :</label>   {!! nl2br($form_details->localExamReport) !!} 
                </div>
            </div>
        @endif

        @if(!empty($casedata->appointment_dt) && !is_null($casedata->appointment_dt) && !isset($casedata->appointment_dt))
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Followup Date :</label>   {{ $casedata['appointment_dt'] }} 
                </div>
            </div>
        
            <br>
            <br>
            <br>
        @endif
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //setTimeout(function () { window.print(); }, 500);
            //window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>
 
</body>
</html>