<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
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
                <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
            </div>
            <div class="col-lg-12">&nbsp;</div>
        </div>
</div>
<div class="row">
        <div class="col-lg-12">
        <center><h1 class="page-header"><u>S/B. DR. {{ empty($patientRegister->consultant_doctor)?"--": strtoupper($doctorlist[$patientRegister->consultant_doctor]) }}, MD, DGO</u></h1></center>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">Date :</label></div>
        <div class="col-sm-3"><u>{{Carbon\Carbon::now()->format('d-M-Y')}}</u></div>
        <div class="col-sm-3"><label class="control-lable"></label></div>
        <div class="col-sm-3"> <u></u> </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">Time :</label></div>
        <div class="col-sm-3"><u>{{Carbon\Carbon::now()->format('h:i a')}}</u></div>
        <div class="col-sm-3"><label class="control-lable"></label></div>
        <div class="col-sm-3"> <u></u> </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">Age :</label></div>
        <div class="col-sm-10"><u>{{$patientRegister->age}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">Past History :</label></div>
        <div class="col-sm-3"><u>{{$patientRegister->past_history}}</u></div>
        <div class="col-sm-3"><label class="control-label">Family History :</label></div>
        <div class="col-sm-3"><u>{{$patientRegister->family_history}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">OBSTERIC HISTORY :</label></div>
        <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["obstetric_history"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["obstetric_history"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">
            <div class="col-sm-3"><label class="control-label">LMP :</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["LMP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LMP"])->first()->field_data}}</u></div>
            <div class="col-sm-3"><label class="control-label">GRAVIDA :</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["GRAVIDA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["GRAVIDA"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">
            <div class="col-sm-3"><label class="control-label">EDD :</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["EDD"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["EDD"])->first()->field_data}}</u></div>
            <div class="col-sm-3"><label class="control-label">PARA :</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["PARA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PARA"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">    
            <div class="col-sm-3"><label class="control-label">MTP :</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["MTP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MTP"])->first()->field_data}}</u></div>
            <div class="col-sm-3"><label class="control-label">ABORTION :</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["ABORTION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ABORTION"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 text-nowrap"><label class="control-label">PHYSICAL EXAMINATION :</label></div>
        <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">
            <div class="col-sm-2"><label class="control-label">Vital Parameter :</label></div>
            <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <div class="col-sm-2"><label class="control-label">Pulse :</label></div>
            <div class="col-sm-2">{{$form_field_values->where('form_field_code', $field_name_id["pulse"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pulse"])->first()->field_data}}</div>
            <div class="col-sm-2"><label class="control-label">BP :</label></div>
                <div class="col-sm-2">{{$form_field_values->where('form_field_code', $field_name_id["BP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BP"])->first()->field_data}}</div>
            <div class="col-sm-2"><label class="control-label">Respiratory Rate :</label></div>
                <div class="col-sm-2">{{$form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->first()->field_data}}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">General Examination :</label></div>
        <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["general examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["general examination"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
    <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <div class="col-sm-6">
                <div class="col-sm-3"><label class="control-label">PALLOR :</label></div>
                <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["pallor"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pallor"])->first()->field_data}}</u></div>
                <div class="col-sm-3"><label class="control-label">ICTERUS :</label></div>
                <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["icterus"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["icterus"])->first()->field_data}}</u></div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-3"><label class="control-label">RASH :</label></div>
                <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["rash"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rash"])->first()->field_data}}</u></div>
                <div class="col-sm-3"><label class="control-label">CYANOSIS :</label></div>
                <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["cyanosis"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cyanosis"])->first()->field_data}}</u></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <div class="col-sm-2"><label class="control-label">ENT :</label></div>
            <div class="col-sm-2">
                <u>{{$form_field_values->where('form_field_code', $field_name_id["ent"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ent"])->first()->field_data}}</u>
            </div>
            <div class="col-sm-2"><label class="control-label">LYMHADENOPATHY :</label></div>
            <div class="col-sm-2">
                <u>{{$form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->first()->field_data}}</u>
            </div>
            <div class="col-sm-2"><label class="control-label">EDEMA FEET :</label></div>
            <div class="col-sm-2">
                <u>{{$form_field_values->where('form_field_code', $field_name_id["edema_feet"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["edema_feet"])->first()->field_data}}</u>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">
            <div class="col-sm-2"><label class="control-label">OTHERS :</label></div>
            <div class="col-sm-8"><u>{{$form_field_values->where('form_field_code', $field_name_id["others"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["others"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 text-nowrap"><label class="control-label">SYSTEMIC EXAMINATION :</label></div>
        <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["systemic examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemic examination"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-3 text-nowrap"><label class="control-label">RESPIRATORY SYSTEM : AIR ENTRY :</label></div>
        <div class="col-sm-9 text-nowrap"><u>{{$form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">
            <div class="col-sm-7 text-nowrap"><label class="control-label">FOREIGN SOUNDS : CREPTS/WHEEZING/BRONCHIAL BREATHING/PLEURAL RUB</label></div>
            <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-nowrap"><label class="control-label">CARDIOVASCULAR SYSTEM : HEART SOUNDS :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound"])->first()->field_data}}</u></div>
        <div class="col-sm-1"><label class="control-label">S1</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->first()->field_data}}</u></div>
        <div class="col-sm-1"><label class="control-label">S2</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-1">&nbsp;</div>
        <div class="col-sm-11">
            <div class="col-sm-2"><label class="control-label">CARDIAC MURMUR</label></div>
            <div class="col-sm-8"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-nowrap"><label class="control-label">CNETRAL NERVOUS SYSTEMIC :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-nowrap"><label class="control-label">ABDOMINAL SYSTEM : SHAPE OF ABDOMEN :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <div class="col-sm-2"><label class="control-label">ORGANOMEGALY :</label></div>
            <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["organomegaly"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["organomegaly"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-11">
            <div class="col-sm-3 text-nowrap"><label class="control-label">FREE FLUID IN ABDOMEN :</label></div>
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->first()->field_data}}</u></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">TENDERNESS :</label></div>
        <div class="col-sm-2">
                <u>{{$form_field_values->where('form_field_code', $field_name_id["tenderness"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["tenderness"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-2"><label class="control-label">GUARDING :</label></div>
        <div class="col-sm-2">
                <u>{{$form_field_values->where('form_field_code', $field_name_id["guarding"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["guarding"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-2"><label class="control-label">RIGIDITY :</label></div>
        <div class="col-sm-2">
                <u>{{$form_field_values->where('form_field_code', $field_name_id["rigidity"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rigidity"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-nowrap"><label class="control-label">FAETAL HEART SOUNDS (FHS) :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_code', $field_name_id["faetal_heart_sound"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["faetal_heart_sound"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4 text-nowrap"><label class="control-label">PRE VAGINAL EXAMINATION (PV) :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_code', $field_name_id["pre_vaginal_examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pre_vaginal_examination"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <b><label class="control-label">INFORMED CONSENT / INFORMED REJECTED CONSENT :</label></b>
        </div>
        <div class="col-sm-12">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["informed_consent_rejected_consented"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["informed_consent_rejected_consented"])->first()->field_data}}</u>
        </div>
    </div>
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-6">
            <div class="col-sm-6">Doctor's Signature</div>
            <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
        </div>
        <div class="col-sm-6">
            <div class="col-sm-6">PARENT'S/RELATIVE'S SIGNATURE</div>
            <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
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