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
    <div class="row">
        <div class="col-lg-12">
            <center>
                <h1> Treatment Chart (Daily)</h1>
            </center>
        </div>
        <div class="col-lg-12">
            
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"><label class="control-label">COMPLAINTS</label></div>    
        <div class="col-sm-10">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["Complaints"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Complaints"])->first()->field_data) !!}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">GENERAL CONDITION : GOOD/FAIR/POOR</label></div>    
        <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["GeneralCondition"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["GeneralCondition"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label class="control-label">VITAL PARAMETER: HR/PULSE</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2">
            <label class="control-label">CAPILLARI REFILLING</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["CAPILLARI REFILLING"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["CAPILLARI REFILLING"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2">
            <label class="control-label">RR</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["RR"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["RR"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label class="control-label">TEMPURATURE</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["TEMPURATURE"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TEMPURATURE"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2">
            <label class="control-label">BP</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["BP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BP"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2">
            <label class="control-label">Sp O2</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["SpO2"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["SpO2"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 text-nowrap"><label class="control-label">GENERAL EXAMINATION :</label></div>
        <div class="col-sm-10">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["general examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["general examination"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1">
            <label class="control-label">SYSTEMIC EXAMINATION RS</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationRS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationRS"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">CVS</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationCVS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationCVS"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">CNS</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationCNS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationCNS"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-1">
            <label class="control-label">PA</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationPA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationPA"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="table-responsive">
        @if($patientRegister->ipdTreatmentDailyNotes()->get()->count() > 0 )
            <table class="table table-bordered">
                <tr>
                    <th>
                        Time
                    </th>
                    <th>
                        Temp    
                    </th>
                    <th>
                        SPO2
                    </th>
                    <th>
                        BP
                    </th>
                    <th>
                        RR    
                    </th>
                    <th>
                        FHS    
                    </th>
                    <th>
                        TREATMENT    
                    </th>
                    <th>
                        Morning
                    </th>
                    <th>
                        Evening
                    </th>
                    <th>
                        Night
                    </th>
                </tr>
                    @foreach($patientRegister->ipdTreatmentDailyNotes()->get() as $TreatmentNotes)
                        <tr>   
                            <td>
                                {{$TreatmentNotes->time}}
                            </td>
                            <td>
                                {{$TreatmentNotes->temp}}
                            </td>
                            <td>
                                {{$TreatmentNotes->spo2}}
                            </td>
                            <td>
                                {{$TreatmentNotes->bp}}
                            </td>
                            <td>
                                {{$TreatmentNotes->rr}}
                            </td>
                            <td>
                                {{$TreatmentNotes->fhs}}
                            </td>
                            <td>
                                {!! nl2br($TreatmentNotes->treatment) !!}
                            </td>
                            <td>
                                {{$TreatmentNotes->morning}}
                            </td>
                            <td>
                                {{$TreatmentNotes->evening}}
                            </td>
                            <td>
                                {{$TreatmentNotes->night}}
                            </td>
                        <tr>
                    @endforeach
                @endif
            </table>
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