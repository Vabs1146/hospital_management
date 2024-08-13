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
        <div class="col-sm-3"><label class="control-label">DELIVARY NOTES : DATE OF DELIVARY:</label></div>    
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->first()->field_data}}</u></div>
        <div class="col-sm-3"><label class="control-lable">TIME</label></div>
        <div class="col-sm-3"> <u>{{$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->first()->field_data}}</u> </div>
    </div>
    <div class="row">
        <div class="col-sm-3"><label class="control-label">Nature Of Delivary : FTND/PTND/LSCS</label></div>    
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["NatureOfDelivary"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["NatureOfDelivary"])->first()->field_data}}</u></div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label class="control-label">SEX OF BABY</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["SexOfBaby"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["SexOfBaby"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2"><label class="control-label">WEIGHT</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["BabyWeight"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BabyWeight"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2"><label class="control-label">AGA/SGA/PREMATURITY/LBW/VLBW</label></div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">POST NATAL PERIOD :</label></div>
        <div class="col-sm-10">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["PostNatalPeriod"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PostNatalPeriod"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">Indication of LSCS :</label></div>
        <div class="col-sm-10">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["IndicationOfLSCS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["IndicationOfLSCS"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <center> <b>SURGERY (OPERATIVE NOTES)</b> </center>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">ANAESTHESIA: NAME OF ANAESTHES: SIGNATURE :</label></div>
        <div class="col-sm-10">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["Anaesthes Name"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Anaesthes Name"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="control-label">TYPE OF ANAESTHESIA :</label></div>
        <div class="col-sm-8">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["TypeOfAnaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TypeOfAnaesthesia"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="control-label">RECOVERY FROM ANAESTHESIA :</label></div>
        <div class="col-sm-8">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["RecoveryFromAnaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["RecoveryFromAnaesthesia"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="control-label">ANY COMPLICATIONS DURING ANAESTHESIA :</label></div>
        <div class="col-sm-8">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["ComplicationAnaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ComplicationAnaesthesia"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">SURGERY :</label></div>
        <div class="col-sm-10">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["Surgery"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Surgery"])->first()->field_data}}
            </u>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-2"><label class="control-label">MTP :</label></div>
        <div class="col-sm-10">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["MTP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MTP"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">&nbsp;</div>
        <div class="col-sm-2"><label class="control-label">TUBAL LIGATION :</label></div>
        <div class="col-sm-3">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["TubalLigation"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TubalLigation"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2"><label class="control-label">LAP TL :</label></div>
        <div class="col-sm-3">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["LAPTL"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LAPTL"])->first()->field_data}}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><label class="control-label">OPERATIVE :</label></div>
        <div class="col-sm-8">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["Operative"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Operative"])->first()->field_data) !!}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">HYSTECRECTOMY: VAGINAL/ABDOMINAL :</label></div>
        <div class="col-sm-10">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["HystecrectomyVaginalAbdominal"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["HystecrectomyVaginalAbdominal"])->first()->field_data) !!}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">LCSC :</label></div>
        <div class="col-sm-10">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["LSCS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LSCS"])->first()->field_data) !!}
            </u>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><label class="control-label">OTHER SURGERY :</label></div>
        <div class="col-sm-10">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["OtherSurgery"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["OtherSurgery"])->first()->field_data) !!}
            </u>
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