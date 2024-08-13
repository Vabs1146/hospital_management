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
<div class="form-group">
        <div class="table-responsive">
                <table class="table table-bordered">
                        <tr>
                            <th>S. No</th>
                            <th></th>
                            <th>Right Eye</th>
                            <th>Left Eye</th>
                        </tr>
                        <tr>
                            <th>1.</th>
                            <th>Ptosis</th>
                            <td>
                                @php $fieldName = "PtosisRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "PtosisLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>2.</th>
                            <th>MRD 1</th>
                            <td>
                                @php $fieldName = "MRD1Right"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "MRD1Left"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>3.</th>
                            <th>MRD 2</th>
                            <td>
                                @php $fieldName = "MRD2Right"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "MRD2Left"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>4.</th>
                            <th>PFH</th>
                            <td>
                                @php $fieldName = "PFHRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "PFHLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>5.</th>
                            <th>LPS ACTION</th>
                            <td>
                                @php $fieldName = "LPSACTIONRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "LPSACTIONLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>6.</th>
                            <th>FRONTALIS OVERACTION</th>
                            <td>
                                @php $fieldName = "FRONTALISOVERACTIONRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "FRONTALISOVERACTIONLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>7.</th>
                            <th>LID CREASE</th>
                            <td>
                                @php $fieldName = "LIDCREASERight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "LIDCREASELeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>8.</th>
                            <th>BELL’S PHENOMEMNON</th>
                            <td>
                                @php $fieldName = "BELLSPHENOMEMNONRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "BELLSPHENOMEMNONLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>9.</th>
                            <th>CORNEAL SENSATION</th>
                            <td>
                                @php $fieldName = "CORNEALSENSATIONRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "CORNEALSENSATIONLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>10.</th>
                            <th>ORBICULARIS ACTION</th>
                            <td>
                                @php $fieldName = "ORBICULARISACTIONRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "ORBICULARISACTIONLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>11.</th>
                            <th>MGJW</th>
                            <td>
                                @php $fieldName = "MGJWRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "MGJWLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>12.</th>
                            <th>FATIGUE TEST</th>
                            <td>
                                @php $fieldName = "FATIGUETESTRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "FATIGUETESTLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>13.</th>
                            <th>ICE TEST</th>
                            <td>
                                @php $fieldName = "ICETESTRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "ICETESTLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>14.</th>
                            <th>EDROPHONIUM /NEOSTIGMINE TEST</th>
                            <td>
                                @php $fieldName = "EDROPHONIUMNEOSTIGMINETESTRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "EDROPHONIUMNEOSTIGMINETESTLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>15.</th>
                            <th>SQUINT</th>
                            <td>
                                @php $fieldName = "SquintRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "SquintLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                        </tr>
                        <tr>
                            <th>16.</th>
                            <th>TEAR FUNCTION</th>
                            <td>
                                @php $fieldName = "TEARFUNCTIONRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                            </td>
                            <td>
                                @php $fieldName = "TEARFUNCTIONLeft"; @endphp
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