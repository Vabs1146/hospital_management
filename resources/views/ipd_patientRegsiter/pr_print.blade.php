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
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>    {{ $patientRegister->registration_time }}
            {{-- {{ \Carbon\Carbon::now()->format('d/M/Y') }} --}}
        </div>
        <div class="col-sm-6">
            <label for="date" class="control-label">Time :</label>   
            {{ $patientRegister->registration_time }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Name :</label> {{ $patientRegister->name }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Gaurdian Name :</label> {{$patientRegister->guardian_name}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Address :</label> {{ $patientRegister->address }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Mobile No :</label> {{$patientRegister->mobile_no}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Phone no :</label> {{ $patientRegister->phone_no }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Email Id :</label> {{$patientRegister->email_id}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Blood Group :</label> {{ $patientRegister->blood_group }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Gender :</label> {{$patientRegister->gender}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">DOB :</label> {{ $patientRegister->date_of_birth }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Age :</label> {{$patientRegister->age}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Maritial Status :</label> {{ $patientRegister->maritial_status }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Registration Date :</label> {{$patientRegister->registration_date}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Registration Time :</label> {{ $patientRegister->registration_time }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Room No :</label> {{$patientRegister->room_no}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Package :</label> {{ $patientRegister->package }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">UHID no :</label> {{$patientRegister->uhid_no}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">IPD no :</label> {{ $patientRegister->ipd_no }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Case :</label> {{$patientRegister->case}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Ref Doctor :</label> {{ $patientRegister->ref_doctor }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Consulting Doctor :</label> {{$patientRegister->consultant_doctor}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Department :</label> {{ $patientRegister->department }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Specialisation :</label> {{$patientRegister->specialisation}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Presenting Complaint :</label> {{ $patientRegister->presenting_complaint }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Drug Sensitivity :</label> {{$patientRegister->drug_sensitivity }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Family History :</label> {{ $patientRegister->family_history }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Remark :</label> {{$patientRegister->remark }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Advance :</label> {{ $patientRegister->advance }}
        </div>
        <div class="col-sm-6">
            <label class="control-label">Payment Mode :</label> {{$patientRegister->payment_mode }}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Debit A/C :</label> {{ $patientRegister->debit_ac }}
        </div>
        <div class="col-sm-6">
            &nbsp;
        </div>
    </div>
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
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>
 
</body>
</html>