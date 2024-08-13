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
        <div class="col-lg-12 panel panel-default"> <center> <strong> Discharge Card </strong> </center> </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">IPD no. :</label> {{ $registration_data->ipd_number }} 
        </div>
        <div class="col-sm-6">
            <label class="control-label">UHID no. :</label> {{ $registration_data->uhid_number }} 
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Name :</label>
            {{ $registration_data->first_name .' '. $registration_data->middle_name .' '. $registration_data->last_name}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Age :</label> {{ $registration_data->age }} | <label class="control-label">sex :</label> {{$registration_data->gender }}
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Consultant Doctor :</label> {{ $registration_data->consulting_doctor }}
        </div>
    </div>

	@php $admission_date_time_arr = explode(' - ', $registration_data->admission_date_time); @endphp
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">D.O.A :</label> {{ $admission_date_time_arr[0] }}  <label class="control-label">Time :</label> {{ $admission_date_time_arr[1] }}
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>

	@php $discharge_date_time_arr = explode(' - ', $registration_data->discharge_date_time); @endphp
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">D.O.D :</label> {{$discharge_date_time_arr[0]}}  <label class="control-label">Time :</label> {{$discharge_date_time_arr[0]}}
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Diagnosis :</label> {!! nl2br($discharge_data->diagnosis) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">History & Clinical Findings :</label> {!! nl2br($discharge_data->history_clinical_findings) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">On Examination :</label> {!! nl2br($discharge_data->on_examination) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Operative Procedure :</label> {!! nl2br($discharge_data->operative_procedure) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Investigation :</label> {!! nl2br($discharge_data->investigation) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Surgical / Maternity Notes :</label> {!! nl2br($discharge_data->surgical_maternity_notes) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Treatment Given :</label> {!! nl2br($discharge_data->treatment_given) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Treatment Advice :</label> {!! nl2br($discharge_data->treatment_advice) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Treatment Given :</label> {!! nl2br($discharge_data->treatment_on_discharge) !!}
        </div>
    </div>	
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Follow-up :</label> 
        </div>
		
        <div class="col-sm-12">
             <div class="col-sm-3"><label class="control-label">1. </label> {{$discharge_data->followup_1}}</div>
             <div class="col-sm-3"><label class="control-label">2. </label> {{$discharge_data->followup_2}}</div>
             <div class="col-sm-3"><label class="control-label">3. </label> {{$discharge_data->followup_3}}</div>
             <div class="col-sm-3"><label class="control-label">4. </label> {{$discharge_data->followup_4}}</div>
        </div>
    </div>
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
            //setTimeout(function () { window.print(); }, 500);
            //window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>
 
</body>
</html>