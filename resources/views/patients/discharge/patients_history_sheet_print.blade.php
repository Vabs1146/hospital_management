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
						
			
.pageBreak {
        page-break-after: always;
    }
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
        <div class="col-lg-12 panel panel-default"> <center> <strong> PATIENT`S HISTORY SHEET </strong> </center> </div>
    </div>

<!-- ========================================================================== -->

<div class="row">
    <div class="col-sm-4">
        <label class="control-label">Date & Time :</label> {{isset($patients_history_sheet['date_time'])? $patients_history_sheet['date_time']->value_1 : ''}}
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Name :</label> {{ $registration_data->first_name }} {{$registration_data->middle_name}} {{$registration_data->last_name}}
    </div>
    <div class="col-sm-3">
        <label class="control-label">Age :</label> {{ $registration_data->age }} 
    </div>
    <div class="col-sm-3">
        <label class="control-label">Sex :</label> {{$registration_data->gender }}
    </div>
    <div class="col-sm-3">
        <label class="control-label">Height :</label> {{ $registration_data->height }} 
    </div>
    <div class="col-sm-3">
        <label class="control-label">Weight :</label> {{$registration_data->weight }}
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Chief Complaints :</label> {!! isset($patients_history_sheet['chief_complaints']) ? nl2br($patients_history_sheet['chief_complaints']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Systemic Examination :</label> {!! isset($patients_history_sheet['systemic_examination']) ? nl2br($patients_history_sheet['systemic_examination']->value_1) : '' !!} 
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Local  Examination :</label> {!! isset($patients_history_sheet['local_examination']) ? nl2br($patients_history_sheet['local_examination']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Past History :</label> {!! isset($patients_history_sheet['past_history']) ? nl2br($patients_history_sheet['past_history']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Personal History :</label> 
        {!! isset($patients_history_sheet['personal_history']) ? nl2br($patients_history_sheet['personal_history']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Drug Allergies :</label> 
        {!! isset($patients_history_sheet['drug_allergies']) ? nl2br($patients_history_sheet['drug_allergies']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Family History :</label> 
        {!! isset($patients_history_sheet['family_history']) ? nl2br($patients_history_sheet['family_history']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">PR (Proctoscopy) / PV :</label> 
        {!! isset($patients_history_sheet['proctoscopy']) ? nl2br($patients_history_sheet['proctoscopy']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Menstrual History / Obstetric History :</label> 
        {!! isset($patients_history_sheet['menstrual_history']) ? nl2br($patients_history_sheet['menstrual_history']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Treatment History :</label> 
        {!! isset($patients_history_sheet['treatment_history']) ? nl2br($patients_history_sheet['treatment_history']->value_1) : '' !!} 
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Notes :</label> 
        {!! isset($patients_history_sheet['final_notes']) ? nl2br($patients_history_sheet['final_notes']->value_1) : '' !!} 
    </div>
</div>


@php
$saved_data = isset($patients_history_sheet['provisional_diagnosis']) ? $patients_history_sheet['provisional_diagnosis']  : [];
@endphp


<div class="row">
<div class="col-sm-12">
    <label class="control-label">Provisional Diagnosis :</label> 
    <ol>
	@foreach ($saved_data as $item)
	<li>{{$item->value_1}} 
        
    @if($is_two)
    / {{ucfirst($item->value_2)}}
		@endif
		
	</li>
	@endforeach
    </ol>
</div>
</div>
<!-- ========================================================================== -->


	
    <br/>
<!-- ======================================= -->

@if(count($priscriptions_data))
	<div class="row">
	
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prescption summary</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
                         <td><strong>Medicine</strong></td>
						 <td><strong>Times a day</strong></td>
						<td><strong>Day</strong></td>
                         <td><strong>Quantity</strong></td>
                        
                         
                         
                </tr>
                                </thead>
                                <tbody>
                                <?php $Sumtotal = 0; ?>
                                @foreach($priscriptions_data as $prescption)
                                <tr>
               <td>
                    {{  $loop->iteration }}
                </td>   
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                
                <td>
					 {{ $prescption->numberoftimes }}
                  
                </td>
                <td>
                  {{ $prescption->medicine_Quntity }}  
                </td>
                <td>
					
					  {{ $prescption->strength }}
                   
                </td>
                
                
            <tr>
                                 @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

	</div>
@endif
	<!-- =================================== -->
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
            {{ $registration_data->first_name .' '. $registration_data->middle_name .' '. $registration_data->last_name}}
        </div>
        <div class="col-md-6 pull-right">
            {{$convert_to_words->get_hospital_name()}}
        </div>
    </div>


<div class="row pageBreak">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
        </div>


<!-- ===================================================Prescription========================================== -->

<!-- =========================== End Prescription ============================================================= -->





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