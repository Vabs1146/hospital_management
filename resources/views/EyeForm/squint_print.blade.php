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
        <div class="row">&nbsp;</div>
        <div class="row">
            @php $fieldName = "HeadPosture"; @endphp
            <div class="col-sm-3"><label class="control-label">Head Posture:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Face Turn</th>
                        <th>Left</th>
                        <th>Righ</th>
                    </tr>
                    <tr>
                        <th>Chin elevation or depression</th>
                        <td>
                            @php $fieldName = "FaceTurnChinLeft"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "FaceTurnChinRight"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>Head Tilt</th>
                        <td>
                            @php $fieldName = "FaceTurnHeadTiltLeft"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}                        
                        </td>
                        <td>
                            @php $fieldName = "FaceTurnHeadTiltRight"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            @php $fieldName = "HirschbergTest"; @endphp
            <div class="col-sm-3"><label class="control-label">Hirschberg Test:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "CoverTest"; @endphp
            <div class="col-sm-3"><label class="control-label">Cover Test:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "PrismBarCoverTestDistance"; @endphp
            <div class="col-sm-3"><label class="control-label">Prism Bar Cover Test Distance:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><label class="control-label">All Nine gazes:</label></div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            @php $fieldName = "NineGazes1"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "NineGazes2"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "NineGazes3"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @php $fieldName = "NineGazes4"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "NineGazes5"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "NineGazes6"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @php $fieldName = "NineGazes7"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "NineGazes8"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "NineGazes9"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            @php $fieldName = "PrimaryDeviation"; @endphp
            <div class="col-sm-3"><label class="control-label">Primary Deviation:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "SecondaryDeviation"; @endphp
            <div class="col-sm-3"><label class="control-label">Secondary Deviation:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "OcularMotility"; @endphp
            <div class="col-sm-3"><label class="control-label">Ocular Motility:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "WorthFourDotTest"; @endphp
            <div class="col-sm-3"><label class="control-label">Worth Four Dot Test:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "Stereopsis"; @endphp
            <div class="col-sm-3"><label class="control-label">Stereopsis:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            @php $fieldName = "MaddoxRod"; @endphp
            <div class="col-sm-3"><label class="control-label">Maddox Rod:</label></div>    
            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><label class="control-label">Dipopia Charting:</label></div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            @php $fieldName = "DipopiaCharting1"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "DipopiaCharting2"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "DipopiaCharting3"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @php $fieldName = "DipopiaCharting4"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "DipopiaCharting5"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "DipopiaCharting6"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @php $fieldName = "DipopiaCharting7"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "DipopiaCharting8"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                        <td>
                            @php $fieldName = "DipopiaCharting9"; @endphp
                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                        </td>
                    </tr>
                </table>
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