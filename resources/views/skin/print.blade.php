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
@php
   if(!empty($mailContent)){extract($mailContent);}
@endphp
    <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}">
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <div class="table-responsive">
        <table class="table-bordered">
                    
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Symptom'])->all() as $item)
                <tr>
                    <td>
                        Symptom
                    </td>
                    <td>
                        {{$item->valueData}}
                    </td>
                </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Duration'])->all() as $item)
            <tr>
                <td>
                    Duration
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @if(!$CheckField::IsFieldEmpty($skin->odp))
            <tr>
                <td>
                    ODP
                </td>
                <td colspan="2">
                    {{ $skin->odp }}
                </td>
            </tr>
            @endif
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['OtherIssue'])->all() as $item)
            <tr>
                <td>
                    Other Issue
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['PastHistory'])->all() as $item)
            <tr>
                <td>
                    Past History
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['PersonalHistory'])->all() as $item)
            <tr>
                <td>
                    Personal History
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['MedicalHistory'])->all() as $item)
            <tr>
                <td>
                    Medical History
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['FamilyHistory'])->all() as $item)
            <tr>
                <td>
                    Family History
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Examination'])->all() as $item)
            <tr>
                <td>
                    Examination
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @if(!$CheckField::IsFieldEmpty($skin->PalmSole))
            <tr>
                <td>
                    Palm / Sole
                </td>
                <td colspan="2">
                    {{ $skin->PalmSole }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($skin->GenitalArea))
            <tr>
                <td>
                    Genital Area
                </td>
                <td colspan="2">
                    {{ $skin->GenitalArea }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($skin->OralMucosa))
            <tr>
                <td>
                    Oral Mucosa
                </td>
                <td colspan="2">
                    {{ $skin->OralMucosa }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($skin->Nails))
            <tr>
                <td>
                    Nails
                </td>
                <td colspan="2">
                    {{ $skin->Nails }}
                </td>
            </tr>
            @endif
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Investigation'])->all() as $item)
            <tr>
                <td>
                    Investigation
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Procedure'])->all() as $item)
            <tr>
                <td>
                    Procedure
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Consent'])->all() as $item)
            <tr>
                <td>
                    Consent
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Diagnosis'])->all() as $item)
            <tr>
                <td>
                    Diagnosis
                </td>
                <td>
                    {{$item->valueData}}
                </td>
            </tr>
            @endforeach
            @if(!$CheckField::IsFieldEmpty($skin->SpecialComment))
            <tr>
                <td>
                    Special Comment
                </td>
                <td colspan="2">
                    {{ nl2br($skin->SpecialComment) }}
                </td>
            </tr>
            @endif
            @if((!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath)) || (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath)) )
            <tr>
                <td colspan="3">
                    Image Upload
                </td>
            </tr>
            @endif
            @if (!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath))
            <tr>
                <td>
                    Before Image
                </td>
                <td colspan="2">
                    @if (!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath))   
                        <p>&nbsp;</p>
                        <center id="BeforeImage"> 
                            <img src={{ Storage::disk('local')->url($skin->BeforeImagePath)."?".filemtime(Storage::path($skin->BeforeImagePath)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                        </center>
                    @endif
                </td>
            </tr>
            @endif
            @if (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath))
            <tr>
                <td>
                    After Image
                </td>
                <td colspan="2">
                    @if (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath))
                        <p>&nbsp;</p>
                        <center id="AfterImage"> 
                            <img src={{ Storage::disk('local')->url($skin->AfterImagePath)."?".filemtime(Storage::path($skin->AfterImagePath)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                        </center>
                    @endif
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($skin->FollowUpDate))
            <tr>
                <td>
                    Follow-Up Date
                </td>
                <td colspan="2">
                    {{ $skin->FollowUpDate }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($skin->FollowUpTime))
            <tr>
                <td>
                    Follow-Up Time
                </td>
                <td colspan="2">
                    {{ $skin->FollowUpTime }}
                </td>
            </tr>
            @endif
        </table>
    </div>

        <br/>
        <br/>
        <br/>
        <br/>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
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