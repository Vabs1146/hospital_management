<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Dr') }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
   
	<link rel="stylesheet" href="{{ ltrim(public_path('assets/plugins/bootstrap/css/bootstrap.css'), '/') }}" />
     <link rel="stylesheet" href="{{ ltrim(public_path('assets/css/style.css'), '/') }}" />
    <link rel="stylesheet" href="{{ ltrim(public_path('assets/css/themes/all-themes.css'), '/') }}" />
    <link rel="stylesheet" href="{{ ltrim(public_path('assets/css/adminStyle.css'), '/') }}" />
	  <style type="text/css" media="all">
        .dtable td, .dtable th
        {
            border: none !important;
        }
        .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}
.table td,
.table th {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table tbody + tbody {
    border-top: 2px solid #dee2e6;
}
.table .table {
    background-color: #fff;
}
.table-sm td,
.table-sm th {
    padding: 0.3rem;
}
.table-bordered {
    border: 1px solid #dee2e6;
}
.table-bordered td,
.table-bordered th {
    border: 1px solid #dee2e6;
}
.table-bordered thead td,
.table-bordered thead th {
    border-bottom-width: 2px;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}
.table-primary,
.table-primary > td,
.table-primary > th {
    background-color: #b8daff;
}
.table-hover .table-primary:hover {
    background-color: #9fcdff;
}
.table-hover .table-primary:hover > td,
.table-hover .table-primary:hover > th {
    background-color: #9fcdff;
}
.table-secondary,
.table-secondary > td,
.table-secondary > th {
    background-color: #d6d8db;
}
.table-hover .table-secondary:hover {
    background-color: #c8cbcf;
}
.table-hover .table-secondary:hover > td,
.table-hover .table-secondary:hover > th {
    background-color: #c8cbcf;
}
.table-success,
.table-success > td,
.table-success > th {
    background-color: #c3e6cb;
}
.table-hover .table-success:hover {
    background-color: #b1dfbb;
}
.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
    background-color: #b1dfbb;
}
.table-info,
.table-info > td,
.table-info > th {
    background-color: #bee5eb;
}
.table-hover .table-info:hover {
    background-color: #abdde5;
}
.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
    background-color: #abdde5;
}
.table-warning,
.table-warning > td,
.table-warning > th {
    background-color: #ffeeba;
}
.table-hover .table-warning:hover {
    background-color: #ffe8a1;
}
.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
    background-color: #ffe8a1;
}
.table-danger,
.table-danger > td,
.table-danger > th {
    background-color: #f5c6cb;
}
.table-hover .table-danger:hover {
    background-color: #f1b0b7;
}
.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
    background-color: #f1b0b7;
}
.table-light,
.table-light > td,
.table-light > th {
    background-color: #fdfdfe;
}
.table-hover .table-light:hover {
    background-color: #ececf6;
}
.table-hover .table-light:hover > td,
.table-hover .table-light:hover > th {
    background-color: #ececf6;
}
.table-dark,
.table-dark > td,
.table-dark > th {
    background-color: #c6c8ca;
}
.table-hover .table-dark:hover {
    background-color: #b9bbbe;
}
.table-hover .table-dark:hover > td,
.table-hover .table-dark:hover > th {
    background-color: #b9bbbe;
}
.table-active,
.table-active > td,
.table-active > th {
    background-color: rgba(0, 0, 0, 0.075);
}
.table-hover .table-active:hover {
    background-color: rgba(0, 0, 0, 0.075);
}
.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
    background-color: rgba(0, 0, 0, 0.075);
}
.table .thead-dark th {
    color: #fff;
    background-color: #212529;
    border-color: #32383e;
}
.table .thead-light th {
    color: #495057;
    background-color: #e9ecef;
    border-color: #dee2e6;
}
.table-dark {
    color: #fff;
    background-color: #212529;
}
.table-dark td,
.table-dark th,
.table-dark thead th {
    border-color: #32383e;
}
.table-dark.table-bordered {
    border: 0;
}
.table-dark.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(255, 255, 255, 0.05);
}
.table-dark.table-hover tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.075);
}
@media (max-width: 575.98px) {
    .table-responsive-sm {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .table-responsive-sm > .table-bordered {
        border: 0;
    }
}
@media (max-width: 767.98px) {
    .table-responsive-md {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .table-responsive-md > .table-bordered {
        border: 0;
    }
}
@media (max-width: 991.98px) {
    .table-responsive-lg {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .table-responsive-lg > .table-bordered {
        border: 0;
    }
}
@media (max-width: 1199.98px) {
    .table-responsive-xl {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .table-responsive-xl > .table-bordered {
        border: 0;
    }
}
.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
.table-responsive > .table-bordered {
    border: 0;
}
tr.collapse.show {
    display: table-row;
}
tbody.collapse.show {
    display: table-row-group;
}

.d-table {
    display: table !important;
}
.d-table-row {
    display: table-row !important;
}
.d-table-cell {
    display: table-cell !important;
}

@media print {
    *,
    ::after,
    ::before {
        text-shadow: none !important;
        box-shadow: none !important;
    }
    a:not(.btn) {
        text-decoration: underline;
    }
   
    thead {
        display: table-header-group;
    }
    img,
    tr {
        page-break-inside: avoid;
    }
  
    
    .table {
        border-collapse: collapse !important;
    }
    .table td,
    .table th {
        background-color: #fff !important;
    }
    .table-bordered td,
    .table-bordered th {
        border: 1px solid #ddd !important;
    }
}
    </style>

   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->

   <style type="text/css">
        .dtable td, .dtable th
        {
            border: none !important;
        }
    </style>
</head>
<body>
        <div class="container-fluid">    
    
                <div class="row">
                    <div class="col-lg-12">
                        <img src="{{url('/')}}{{ Storage::disk('local')->url($logoUrl) }}" class="img-rounded" alt="letter head top" width="100%" height="100%" />
                    </div>
                </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
                </div>
            
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="date" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }}
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label for="date" class="control-label">Patient Name :</label>   {{ strtoupper($casedata['patient_name']) }}
                </div>
             
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="control-label">Address :</label>   {{ $casedata['patient_address'] }} 
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Contact No. :</label>   {{ $casedata['patient_mobile'] }}
                </div>
            </div>
			
 <!--------------------------------->
<div class="panel-body" >
    <div class="container-fluid">
     <div class="table-responsive">
    <table class="table  table-bordered">
        <tbody>
             @if(!$CheckField::IsFieldEmpty($patient_details->Complaints))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Presenting Complaints with duration :</label></td>
                <td>
                 {{($patient_details->Complaints)}}
                 
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->History))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Past History</label></td>
                <td>
                 {{($patient_details->History)}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->PastPersonalHistory))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Past Personal History </label></td>
                <td>
                 {{($patient_details->PastPersonalHistory)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->menarch))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Menarche </label></td>
                <td>
                 {{($patient_details->menarch)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricMarriedSice))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Married Since </label></td>
                <td>
                 {{($patient_details->ObstetricMarriedSice)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricCMP))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Year</label></td>
                <td>
                 {{($patient_details->ObstetricCMP)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricG))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">G </label></td>
                <td>
                 {{($patient_details->ObstetricG)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricP))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">P</label></td>
                <td>
                 {{($patient_details->ObstetricP)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricL))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">L </label></td>
                <td>
                 {{($patient_details->ObstetricL)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricA))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">A </label></td>
                <td>
                 {{($patient_details->ObstetricA)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricD))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">D </label></td>
                <td>
                 {{($patient_details->ObstetricD)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricText))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Text </label></td>
                <td>
                 {{($patient_details->ObstetricText)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnecyLMP))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">LMP </label></td>
                <td>
                 {{($patient_details->presentPregnecyLMP)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnencyEDD))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">EDD </label></td>
                <td>
                 {{($patient_details->presentPregnencyEDD)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnencyUSG))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Edd by USG </label></td>
                <td>
                 {{($patient_details->presentPregnencyUSG)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->Education))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Education </label></td>
                <td>
                 {{($patient_details->Education)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnencyEDD))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">EDD </label></td>
                <td>
                 {{($patient_details->presentPregnencyEDD)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->GenExamBuild))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Build </label></td>
                <td>
                 {{($patient_details->GenExamBuild)}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamHeight))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Height </label></td>
                <td>
                 {{$patient_details->GenExamHeight .' cm'}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamWeight))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Height </label></td>
                <td>
                  {{ $patient_details->GenExamWeight.' kg' }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->GenExamWeight))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Height </label></td>
                <td>
                  {{ $patient_details->GenExamWeight.' kg' }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->BMI))
            <tr>
              <td><label for="MensturationHistory" class="control-label">BMI </label></td>
                <td>
                  {{ $patient_details->BMI }}
                </td>
            </tr>
            @endif
              @if(!$CheckField::IsFieldEmpty($patient_details->Temp))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Temp </label></td>
                <td>
                  {{ $patient_details->Temp }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->AG))
            <tr>
              <td><label for="MensturationHistory" class="control-label">AG </label></td>
                <td>
                  {{ $patient_details->AG }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->BMI))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Pulse </label></td>
                <td>
                  {{  $patient_details->GenExamPulse .' per min' }}
                </td>
            </tr>
            @endif
              @if(!$CheckField::IsFieldEmpty($patient_details->Temp))
            <tr>
              <td><label for="MensturationHistory" class="control-label">BP </label></td>
                <td>
                  {{ $patient_details->GenExamBP . '/' . $patient_details->GenExamBP_lower . 'mmhg'  }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamRR))
            <tr>
              <td><label for="MensturationHistory" class="control-label">RR </label></td>
                <td>
                  {{ $patient_details->GenExamRR . ' per min' }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamPallor))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Pallor </label></td>
                <td>
                  {{ $patient_details->GenExamPallor }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->Cyanosis))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Cyanosis </label></td>
                <td>
                  {{ $patient_details->GenExamCyanosis  }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->Icterus))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Icterus </label></td>
                <td>
                  {{ $patient_details->GenExamIcterus }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->Edema))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Edema </label></td>
                <td>
                  {{ $patient_details->GenExamEdema }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamSkin))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Skin </label></td>
                <td>
                  {{ $patient_details->GenExamSkin }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->SysExamCVS))
            <tr>
              <td><label for="MensturationHistory" class="control-label">CVS </label></td>
                <td>
                  {{ $patient_details->SysExamCVS }}
                </td>
            </tr>
            @endif

            @if(!$CheckField::IsFieldEmpty($patient_details->SysExamRS))
            <tr>
              <td><label for="MensturationHistory" class="control-label">RS </label></td>
                <td>
                  {{ $patient_details->SysExamRS }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->SysExamLocalExam))
            <tr>
              <td>{{ Form::label('SysExamLocalExam','Local/Examination') }} </td>
                <td>
                  {{ $patient_details->SysExamLocalExam }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ProvisionalDiagnosis))
            <tr>
              <td>{{ Form::label('ProvisionalDiagnosis','Provisional Diagnosis') }}</td>
                <td>
                  {{ $patient_details->ProvisionalDiagnosis }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->InvestigationAdvice))
            <tr>
              <td>{{ Form::label('InvestigationAdvice','Investigation Advice') }}</td>
                <td>
                  {{ $patient_details->InvestigationAdvice }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->TreatmentAdvice))
            <tr>
              <td>{{ Form::label('TreatmentAdvice','Treatment Advice') }} </td>
                <td>
                  {{ $patient_details->TreatmentAdvice }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->Remark))
            <tr>
              <td>{{ Form::label('Remark','Remark') }} </td>
                <td>
                  {{ $patient_details->Remark }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->Text))
            <tr>
              <td>{{ Form::label('Text','Text') }} </td>
                <td>
                  {{ $patient_details->Text }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($casedata['appointment_dt']))
            <tr>
              <td>{{ Form::label('followupDate','Follow-up Date') }} </td>
                <td>
                  {{ $casedata['appointment_dt'] }}
                </td>
            </tr>
            @endif
           @if(!$CheckField::IsFieldEmpty($casedata['appointment_timeslot']))
            <tr>
              <td>{{ Form::label('FollowUpTimeSlot','Follow up Time Slot') }} </td>
                <td>
                  {{ $casedata['appointment_timeslot'] }}
                </td>
            </tr>
            @endif
          

        </tbody>
    </table>
 </div>

</div>
</div>
 <!---------------------------------------->
          
            <BR/>
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Report</label>  
                </div>
            </div>
            @foreach(old('Report_file',$casedata['Reports_file']) as $reportfile)                        
            <div class="row">
                <div class="col-sm-12">
                    {{ $reportfile->report_title }} 
                </div>
                <div class="col-sm-12">
                    {{ $reportfile->report_description }} 
                </div>
            </div>
            @endforeach

            @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
<BR/>
<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Prescription Summary</label>  
    </div>
</div>
<table class="table">
    <tr>
        <th>
            Medicine
        </th>
        <th>
            Strength
        </th>
        <th>
            Quantity
        </th>
        <th>
            Times a Day    
        </th>
    </tr>
        @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
            <tr>   
                <td style="text-align:center;">
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                <td style="text-align:center;">
                    {{ $prescption->strength }}
                </td>
                <td style="text-align:center;">
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td style="text-align:center;">
                    {{ $prescption->numberoftimes }}
                </td>
            </tr>
        @endforeach
</table>
@endif


            <br>
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Note : </label> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    Please bring this paper on every visist 
                </div>
                <div class="col-sm-12">
                    Please follow the time 
                </div>
                <div class="col-sm-12">
                    Please inform allergy immediately 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 pull-right">
                        {{ config('app.name', 'Dr') }}
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