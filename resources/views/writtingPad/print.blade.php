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
  display:none !important;
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
                <div class="col-md-5">{{ Form::label('patient_name', 'Patient Name :') }} {{$casedata['patient_name']}}</div>
                <div class="col-md-3">
                    {{ Form::label('patient_age', 'Patient age :') }} {{$casedata['patient_age']}}</div>
                    <div class="col-md-4">{{ Form::label('male_female', 'Gender :') }} {{$casedata['male_female']}}</div>
            </div>
            <div class="row">
                <div class="col-md-6">{{ Form::label('patient_address', 'Patient Address :') }} {{$casedata['patient_address']}}
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">{{ Form::label('doctor_name', 'Doctor :') }} {{$casedata['doctor_name']}}</div>
                <div class="col-md-6">{{ Form::label('appointment_dt', 'Date :') }} {{ is_null($casedata['appointment_dt'])? Carbon\Carbon::today()->format('d/M/Y') :$casedata['appointment_dt'] }}
                        {{-- Carbon\Carbon::createFromFormat('d/M/Y', Carbon\Carbon::today())->toDateTimeString() --}}
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <img src="{{ $form_details['image_data'] }}" class="img-rounded" alt="letter head top" width="100%" />
                </div>
            </div>
        </div>
        <div class="form-group">
                <ul class="list-unstyled">
                    <li class="">Please bring this paper on every visit</li>
                    <li class=""> Please follow the time </li>
                    <li class=""> Please inform allergy immediately </li>
                </ul>
            </div>
        
        
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <li>Dr. Sanjeev Balani</li></b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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