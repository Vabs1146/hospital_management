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
  display:none !important;
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
        <div class="col-lg-12 text-center">
           <h3> <u>OPERATION THEATER NOTES</u> </h3>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td colspan="3">
                    <label for="Patient_name" class="control-label">Patient's Name :</label>   {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}
                </td>
            </tr>
            <tr>
                <td><label for="Patient_age" class="control-label">Age :</label>   {{ $case_master['patient_age'] }}</td>
                <td><label for="Patient_sex" class="control-label">Sex :</label>   {{ $case_master['male_female'] }}</td>
                <td><label for="Patient_caseNumber" class="control-label">OPD case No. :</label>   {{ $case_master['case_number'] }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="surgery_name" class="control-label">Surgery :</label>   {{ $eyeoperation->surgery_name }}
                </td>
                <td>
                    <label class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
                </td>
            </tr>
        </table>
    </div>
    
    <div class="form-group">
        <label class="control-label"><u><b>Surgery Details :</b></u></label>
        @foreach ($eyeoperation->eye_op_nt_surgery_details()->get() as $item)
            <p>
                {{$item->surgery_details}} 
            </p>        
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label">Notes :</label> {{$eyeoperation->notes}}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label"> <b><u>Anesthetist Notes :</u></b> </label> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label class="control-label"> Pulse </label> {{$anesthetist_notes->an_pulse}}
        </div>
        <div class="col-lg-6">
            <label class="control-label"> Cardiac History </label> {{$anesthetist_notes->an_cardiac_history}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label class="control-label"> BP </label> {{$anesthetist_notes->an_bp}}
        </div>
        <div class="col-lg-6">
            <label class="control-label"> Investigation </label> {{$anesthetist_notes->an_investigations}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label class="control-label"> NBM/NotNBM </label> {{$anesthetist_notes->an_nbm_notnbm}}
        </div>
        <div class="col-lg-6">
            <label class="control-label"> Dentition </label> {{$anesthetist_notes->an_dentition}}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label"> <b><u>Intra-Operative Notes :</u></b> </label> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label"> Anesthesia :Topical / Peribulbar given by </label> {{$anesthetist_notes->ion_anesthesia_topical_peribular_given_by}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label class="control-label"> Pulse </label> {{$anesthetist_notes->ion_pulse}}
        </div>
        <div class="col-lg-6">
            <label class="control-label"> O2 Saturation </label> {{$anesthetist_notes->ion_o_saturation}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label"> BP </label> {{$anesthetist_notes->ion_bp}}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label"> <b><u>Post-Operative Notes :</u></b> </label> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label class="control-label"> Pulse </label> {{$anesthetist_notes->pon_pulse}}
        </div>
        <div class="col-lg-4">
            <label class="control-label"> BP </label> {{$anesthetist_notes->pon_bp}}
        </div>
        <div class="col-lg-4">
            <label class="control-label"> O2 Saturation </label> {{$anesthetist_notes->pon_o_saturation}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label class="control-label"> Additional Notes </label> {{$anesthetist_notes->pon_additional_note}}
        </div>
    </div>

   
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