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
        <div class="col-sm-2"><label class="control-label">Presenting Complaint :</label></div>
        <div class="col-sm-10"><u>{{$patientRegister->presenting_complaint}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4"><label class="control-label">PAST HISTORY - convulsion/asthma/recurrent illness/</label></div>
        <div class="col-sm-8"><u>{{$patientRegister->past_history}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4"><label class="control-label">BIRTH HISTORY full term/pretrem/IUGR/LSCS/birth asphexia/jaundice/convulsion/hospitalization :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_id', $field_name_id["BIRTH HISTORY"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["BIRTH HISTORY"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4"><label class="control-label">PHYSICAL EXAMINATION - General examination :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_id', $field_name_id["PHYSICAL EXAMINATION"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["PHYSICAL EXAMINATION"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4"><label class="control-label">CONSCIOUSNESS :</label></div>
        <div class="col-sm-8"><u>{{$form_field_values->where('form_field_id', $field_name_id["CONSCIOUSNESS"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["CONSCIOUSNESS"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">Vital Parameter :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_id', $field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["Vital Parameter"])->first()->field_data}}</u></div>
        <div class="col-sm-3"><label class="control-label">OXYGEN SATURATION :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_id', $field_name_id["OXYGEN SATURATION"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["OXYGEN SATURATION"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">HEART RATE :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_id', $field_name_id["HEART RATE"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["HEART RATE"])->first()->field_data}}</u></div>
        <div class="col-sm-2"><label class="control-label">PULSE RATE :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_id', $field_name_id["PULSE"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["PULSE"])->first()->field_data}}</u></div>
        <div class="col-sm-2"><label class="control-label">PERIPHERAL PULSATION :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_id', $field_name_id["PERIPHERAL PULSATION"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["PERIPHERAL PULSATION"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">RESPIRATORY RATE :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_id', $field_name_id["respiratory rate"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["respiratory rate"])->first()->field_data}}</u></div>
        <div class="col-sm-3"><label class="control-label">BLOOD PRESSURE :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_id', $field_name_id["BLOOD PRESSURE"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["BLOOD PRESSURE"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">CAPILLARI REFILLING :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_id', $field_name_id["CAPILLARI REFILLING"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["CAPILLARI REFILLING"])->first()->field_data}}</u></div>
        <div class="col-sm-3"><label class="control-label">TEMPURATURE :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_id', $field_name_id["TEMPURATURE"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["TEMPURATURE"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">NEONATE CRY :</label></div>
        <div class="col-sm-1"><u>{{$form_field_values->where('form_field_id', $field_name_id["NEONATE CRY"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["NEONATE CRY"])->first()->field_data}}</u></div>
        <div class="col-sm-1"><label class="control-label">ACTIVITY :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_id', $field_name_id["ACTIVITY"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["ACTIVITY"])->first()->field_data}}</u></div>
        <div class="col-sm-1"><label class="control-label">REFLEXES :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_id', $field_name_id["REFLEXES"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["REFLEXES"])->first()->field_data}}</u></div>
        <div class="col-sm-1"><label class="control-label">COLOUR :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_id', $field_name_id["COLOUR"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["COLOUR"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="control-label">OBVIOUS CONG ANAMOLY :</label>
        </div>
        <div class="col-sm-8">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["OBVIOUS CONG ANAMOLY"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["OBVIOUS CONG ANAMOLY"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="control-label">DEHYDRATION :</label>
        </div>
        <div class="col-sm-8">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["DEHYDRATION"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["DEHYDRATION"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <label class="control-label">PALLOR :</label>
        </div>
        <div class="col-sm-1">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["pallor"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["pallor"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">ICTERUS :</label>
        </div>
        <div class="col-sm-1">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["icterus"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["icterus"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">CYANOSIS :</label>
        </div>
        <div class="col-sm-1">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["cyanosis"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["cyanosis"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">rash :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["rash"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["rash"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1 text-nowrap">
            <label class="control-label">SCLEREMA :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["SCLEREMA"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["SCLEREMA"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label class="control-label">ent :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["ent"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["ent"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-2">
            <label class="control-label">lymhadenopathy :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["lymhadenopathy"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["lymhadenopathy"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-2">
            <label class="control-label">edema_feet :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["edema_feet"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["edema_feet"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="control-label">systemic examination :</label>
        </div>
        <div class="col-sm-8">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["systemic examination"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["systemic examination"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label class="control-label">RESPIRATORY SYSTEM :</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["RESPIRATORY SYSTEM"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["RESPIRATORY SYSTEM"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-3">
            <label class="control-label">Air Entry :</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["respiratory_system_air_entry"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["respiratory_system_air_entry"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            &nbsp;
        </div>
        <div class="col-sm-4">
            <label class="control-label">FOREIGN SOUND: CREPTS/WHEEZING/BRONCHIAL BREATHING/PLEURAL RUB :</label>
        </div>
        <div class="col-sm-6">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["foreign_sounds_pleural_rub"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["foreign_sounds_pleural_rub"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label class="control-label">CARDIOVASCULAR SYSTEM :HEART SOUND :S1</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["cardiovascular_heart_sound_s1"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["cardiovascular_heart_sound_s1"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-3">
            <label class="control-label">S2</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["cardiovascular_heart_sound_s2"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["cardiovascular_heart_sound_s2"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-4">
            <label class="control-label">CARDIAC MURMUR</label>
        </div>
        <div class="col-sm-6">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["cardiac_murmur"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["cardiac_murmur"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label class="control-label">CENTRAL NERVOUS SYSTEM</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["central_nervous_system"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["central_nervous_system"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-3">
            <label class="control-label">MENINGEAL SIGN:</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["MENINGEAL SIGN"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["MENINGEAL SIGN"])->first()->field_data}}</u> HIGHER FUNCTION
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-4">
            <label class="control-label">CRANIAL NERVES</label>
        </div>
        <div class="col-sm-6">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["CRANIAL NERVES"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["CRANIAL NERVES"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-1">
            <label class="control-label">MOTOR SYSTEMS</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["MOTOR SYSTEMS"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["MOTOR SYSTEMS"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">SENSORY SYSTEMS</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["SENSORY SYSTEMS"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["SENSORY SYSTEMS"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">PLANTERS</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["PLANTERS"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["PLANTERS"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <label class="control-label">ABDOMINAL SYSTEM : SHAPE OF ABDOMEN :</label>
        </div>
        <div class="col-sm-8">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["shape_of_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["shape_of_abdomen"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-2">
            <label class="control-label">ORGANOMEGALY :</label>
        </div>
        <div class="col-sm-8">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["organomegaly"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["organomegaly"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-2">
            <label class="control-label">FREE FLUID IN ABDOMEN :</label>
        </div>
        <div class="col-sm-8">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["free_fluid_in_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["free_fluid_in_abdomen"])->first()->field_data}}</u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-1 text-nowrap">
            <label class="control-label">TENDERNESS :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["tenderness"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["tenderness"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">GUARDING :</label>
        </div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["guarding"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["guarding"])->first()->field_data}}</u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">RIGIDITY :</label>
        </div>
        <div class="col-sm-3">
            <u>{{$form_field_values->where('form_field_id', $field_name_id["rigidity"])->isEmpty()?"":$form_field_values->where('form_field_id', $field_name_id["rigidity"])->first()->field_data}}</u>
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