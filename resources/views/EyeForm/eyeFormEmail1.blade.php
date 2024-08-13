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
<body style="background-color: none !important">
 <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <img src="{{url('/')}}{{ Storage::disk('local')->url($logoUrl) }}" class="img-rounded" alt="letter head top"  style="display:block" width="100%" height="100%"  />
        </div>
		<div class="col-lg-12">&nbsp;</div>
    </div>
	  <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">
            <label for="date" class="control-label">Time :</label>   
            {{ $casedata['visit_time'] }}
        </div>
    </div>
    <div class="row">
            <div class="col-sm-6">
                <label for="case_number" class="control-label">
				
					Case Number :</label>   {{ $casedata['case_number'] }} 
            </div>
            <div class="col-sm-6">
                 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $casedata['patient_name'] }} 
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <label class="control-label">Age :</label>   {{ $casedata['patient_age'] }}
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Gender :</label>   {{ $casedata['male_female'] }}
                </div>
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
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Appointment Dt :</label>   {{ $casedata['appointment_dt'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Appointment Time. :</label>   {{ $casedata['appointment_timeslot'] }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label"></label>   {{ $form_details->ChiefComplaint }} 
            </div>
        </div>
        
   
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label"></label>   
            {{ $form_details->ChiefComplaint }} 
        </div>
    </div>
        
        @if(!$CheckField::IsFieldEmpty($form_details->CNS))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Genral Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
                </div>
            </div>
        @endif
        <br>
        
        <div class="table-responsive">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <td >
                             
                        </td>
                        <td >
                            <strong>OD</strong>
                        </td>
                        <td >
                            <strong>OS</strong>
                        </td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Chief Complaint
                            @endif  
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach 
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Opthal History
                            @endif  
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'SystemicHistory')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Systemic History
                            @endif
                        </td>
                        <td colspan="2">
                            {{$item->field_value_OD}}
                        </td>
                    </tr>
                @endforeach
                @if(!$CheckField::IsFieldEmpty($form_details->familyHistory))
                <tr>
                    <td>
                        Family History
                    </td>
                    <td colspan="2">
                        {{ ($form_details->familyHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->birthHistory))
                <tr>
                    <td>
                        Birth History
                    </td>
                    <td colspan="2">
                        {{ nl2br($form_details->birthHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->dvn_od) && !$CheckField::IsFieldEmpty($form_details->dvn_os))
                    <tr>
                        <td>
                            Distant Vision UNAIDED
                        </td>
                        <td>
                            {{ $form_details->dvn_od }}
                        </td>
                        <td>
                            {{ $form_details->dvn_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->nvn_od) && !$CheckField::IsFieldEmpty($form_details->nvn_os))
                    <tr>
                        <td>
                            Near Vision UNAIDED
                        </td>
                        <td>
                            {{ $form_details->nvn_od }}
                        </td>
                        <td>
                            {{ $form_details->nvn_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->visualacuity_OD) && !$CheckField::IsFieldEmpty($form_details->visualacuity_OS))
                    <tr>
                        <td>
                            Distant Vision Aided
                        </td>
                        <td>
                            {{ $form_details->visualacuity_OD }}
                        </td>
                        <td>
                            {{ $form_details->visualacuity_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->withglasses_OD) && !$CheckField::IsFieldEmpty($form_details->withglasses_OS))
                    <tr>
                        <td>
                            Near Vision Aided
                        </td>
                        <td>
                            {{ $form_details->withglasses_OD }}
                        </td>
                        <td>
                            {{ $form_details->withglasses_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->withpinhole_OD) && !$CheckField::IsFieldEmpty($form_details->withpinhole_OS))
                    <tr>
                        <td>
                            With Pinhole
                        </td>
                        <td>
                            {{ $form_details->withpinhole_OD }}
                        </td>
                        <td>
                            {{ $form_details->withpinhole_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->colour_vision_OD) && !$CheckField::IsFieldEmpty($form_details->colour_vision_OS))
                    <tr>
                        <td>
                            Colour vision
                        </td>
                        <td>
                            {{ $form_details->colour_vision_OD }}
                        </td>
                        <td>
                            {{ $form_details->colour_vision_OS }}
                        </td>
                    </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Conj And Lids
                            @endif
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OrbitSacsEyeMotility')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Orbit Sacs & Eye Motility
                            @endif
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'cornia')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            CORNEA
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1) && !empty($form_details->OsImg1) && !is_null($form_details->OsImg1))
                <tr>
                   <td></td>
                   <td>
                        @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))
                            <p>&nbsp;</p>
                            <center id="wPaint-OdImg1"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                            </center>
                        @endif
                   </td>
                   <td>
                        @if (!empty($form_details->OsImg1) && !is_null($form_details->OsImg1))                        
                            <p>&nbsp;</p>
                            <center id="wPaint-OsImg1"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg1)."?".filemtime(Storage::path($form_details->OsImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />  
                            </center>
                        @endif
                   </td>
                </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pupilIrisac')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            pupil Iris a.c.
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'lens')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            LENS
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2) && !empty($form_details->OsImg2) && !is_null($form_details->OsImg2))
                <tr>
                   <td></td>
                   <td>
                        @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2))
                            <p>&nbsp;</p>
                            <center id="wPaint-OdImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg2)."?".filemtime(Storage::path($form_details->OdImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                            </center>
                        @endif
                   </td>
                   <td>
                        @if (!empty($form_details->OsImg2) && !is_null($form_details->OsImg2))                        
                            <p>&nbsp;</p>
                            <center id="wPaint-OsImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg2)."?".filemtime(Storage::path($form_details->OsImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />  
                            </center>
                        @endif
                   </td>
                </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            vitreo retinal
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if(!$CheckField::IsFieldEmpty($form_details->IOP_OD) && !$CheckField::IsFieldEmpty($form_details->IOP_OS))
                    <tr>
                        <td>
                            IOP
                        </td>
                        <td>
                            {{ $form_details->IOP_OD }}
                        </td>
                        <td>
                            {{ $form_details->IOP_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->Ratio_OD) && !$CheckField::IsFieldEmpty($form_details->Ratio_OS))
                    <tr>
                        <td>
                           CD Ratio
                        </td>
                        <td>
                            {{ $form_details->Ratio_OD }}
                        </td>
                        <td>
                            {{ $form_details->Ratio_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->Pachymetry_OD) && !$CheckField::IsFieldEmpty($form_details->Pachymetry_OS))
                    <tr>
                        <td>
                            Pachymetry
                        </td>
                        <td>
                            {{ $form_details->Pachymetry_OD }}
                        </td>
                        <td>
                            {{ $form_details->Pachymetry_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->CCT_OD) && !$CheckField::IsFieldEmpty($form_details->CCT_OS))
                    <tr>
                        <td>
                            CCT
                        </td>
                        <td>
                            {{ $form_details->CCT_OD }}
                        </td>
                        <td>
                            {{ $form_details->CCT_OS }}
                        </td>
                    </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'diagno')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Diagnosis
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @if(!$CheckField::IsFieldEmpty($form_details->Advice_OD) && !$CheckField::IsFieldEmpty($form_details->Advice_OS))
                    <tr>
                        <td>
                            Advice
                        </td>
                        <td>
                            {{ nl2br($form_details->Advice_OD) }}
                        </td>
                        <td>
                            {{ nl2br($form_details->Advice_OS) }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->BloodInvestigation))
                    <tr>
                        <td>
                            Blood Investigation
                        </td>
                        <td colspan="2">
                            {{ nl2br($form_details->BloodInvestigation) }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->k1_od) && !$CheckField::IsFieldEmpty($form_details->k1_os))
                    <tr>
                        <td>
                            K1
                        </td>
                        <td>
                            {{ $form_details->k1_od }}
                        </td>
                        <td>
                            {{ $form_details->k1_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->k2_od) && !$CheckField::IsFieldEmpty($form_details->k2_os))
                    <tr>
                        <td>
                            K2
                        </td>
                        <td>
                            {{ $form_details->k2_od }}
                        </td>
                        <td>
                            {{ $form_details->k2_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->lenspower_od) && !$CheckField::IsFieldEmpty($form_details->lenspower_os))
                    <tr>
                        <td>
                            Lens Power
                        </td>
                        <td>
                            {{ $form_details->lenspower_od }}
                        </td>
                        <td>
                            {{ $form_details->lenspower_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->axial_length_OD) && !$CheckField::IsFieldEmpty($form_details->axial_length_OS))
                    <tr>
                        <td>
                            Axial Lenght
                        </td>
                        <td>
                            {{ $form_details->axial_length_OD }}
                        </td>
                        <td>
                            {{ $form_details->axial_length_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->KC_OD) && !$CheckField::IsFieldEmpty($form_details->KC_OS))
                    <tr>
                        <td>
                            KC
                        </td>
                        <td>
                            {{ $form_details->KC_OD }}
                        </td>
                        <td>
                            {{ $form_details->KC_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->colour_OD) && !$CheckField::IsFieldEmpty($form_details->colour_OS))
                    <tr>
                        <td>
                            colour  Vision
                        </td>
                        <td>
                            {{ $form_details->colour_OD }}
                        </td>
                        <td>
                            {{ $form_details->colour_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->schimerTest1_OD) && !$CheckField::IsFieldEmpty($form_details->schimerTest1_OS))
                    <tr>
                        <td>
                            Schimer Test 1
                        </td>
                        <td>
                            {{ $form_details->schimerTest1_OD }}
                        </td>
                        <td>
                            {{ $form_details->schimerTest1_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->schimerTest2_OD) && !$CheckField::IsFieldEmpty($form_details->schimerTest2_OS))
                    <tr>
                        <td>
                            Schimer Test 2
                        </td>
                        <td>
                            {{ $form_details->schimerTest2_OD }}
                        </td>
                        <td>
                            {{ $form_details->schimerTest2_OS }}
                        </td>
                    </tr>
                @endif
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Optical Coherence tomography (OCT)
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                        Extra Ocular Movement (EOM)
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if(!$CheckField::IsFieldEmpty($form_details->systanicExamination))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">ANTERIOR SEGMENT :</label>   {!! nl2br($form_details->systanicExamination) !!} 
                </div>
            </div>
        @endif
        @if(!$CheckField::IsFieldEmpty($form_details->treatmentAdvice))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">POSTERIOR SEGMENT :</label>   {!! nl2br($form_details->treatmentAdvice) !!} 
                </div>
            </div>
        @endif
        @if(!$CheckField::IsFieldEmpty($form_details->localExamReport))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Additional Information :</label>   {!! nl2br($form_details->localExamReport) !!} 
                </div>
            </div>
        @endif
        @if(!empty($casedata->appointment_dt) && !is_null($casedata->appointment_dt) && !isset($casedata->appointment_dt))
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Followup Date :</label>   {{ $casedata['appointment_dt'] }} 
                </div>
            </div>
        
            <br>
            <br>
            <br>
        @endif
        @if(!$CheckField::IsFieldEmpty($form_details->surgery))       
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label"> Surgery :</label>   {{$form_details->surgery}}  
            </div>
        </div>
        @endif
        @if (!$CheckField::IsFieldEmpty($form_details->sph_r_undi) ||
        !$CheckField::IsFieldEmpty($form_details->sph_r_di) ||
        !$CheckField::IsFieldEmpty($form_details->sph_l_undi) ||
        !$CheckField::IsFieldEmpty($form_details->sph_l_di) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_r_undi) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_r_di) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_l_undi) ||
        !$CheckField::IsFieldEmpty($form_details->cyl_l_di) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_r_undi) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_r_di) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_l_undi) ||
        !$CheckField::IsFieldEmpty($form_details->Axis_l_di) ||       
        !$CheckField::IsFieldEmpty($form_details->vision_l_sa) ||
        !$CheckField::IsFieldEmpty($form_details->vision_r_sa) ||
        !$CheckField::IsFieldEmpty($form_details->vision_l_pga) ||
        !$CheckField::IsFieldEmpty($form_details->vision_r_pga) ||       
        !$CheckField::IsFieldEmpty($form_details->Add_l_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Add_r_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Add_l_pga) ||
        !$CheckField::IsFieldEmpty($form_details->Add_r_pga) ||       
        !$CheckField::IsFieldEmpty($form_details->Nvision_l_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Nvision_r_sa) ||
        !$CheckField::IsFieldEmpty($form_details->Nvision_l_pga) ||
        !$CheckField::IsFieldEmpty($form_details->Nvision_r_pga)       
        )
            <br/>
            <br/>
            <br/>
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Refraction</label>
                </div>
            </div>
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="6" class="text-center">Right</th>
                                <th colspan="6" class="text-center">Left</th>
                            </tr>
                            <tr>
                                <th>&nbsp;</th>
                                <th>SPH</th>
                                <th>CYL</th>
                                <th>Axis</th>
                                <th>Vision</th>
                                <th>Add</th>
                                <th>N Vision</th>
                                <th>SPH</th>
                                <th>CYL</th>
                                <th>Axis</th>
                                <th>Vision</th>
                                <th>Add</th>
                                <th>N Vision</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>S/A</td>
                                <td>
                                    {{ $form_details->sph_r_undi }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_r_undi }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_r_undi }}
                                </td>
                                <td>
                                    {{ $form_details->vision_r_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Add_r_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_r_sa }}
                                </td>
                                <td>
                                    {{ $form_details->sph_l_undi }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_l_undi }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_l_undi }}
                                </td>
                                <td>
                                    {{ $form_details->vision_l_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Add_l_sa }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_l_sa }}
                                </td>
                            </tr>
                            <tr>
                                <td>PGP</td>
                                <td>
                                    {{ $form_details->sph_r_di }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_r_di }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_r_di }}
                                </td>
                                <td>
                                    {{ $form_details->vision_r_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Add_r_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_r_pga }}
                                </td>
                                <td>
                                    {{ $form_details->sph_l_di }}
                                </td>
                                <td>
                                    {{ $form_details->cyl_l_di }}
                                </td>
                                <td>
                                    {{ $form_details->Axis_l_di }}
                                </td>
                                <td>
                                    {{ $form_details->vision_l_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Add_l_pga }}
                                </td>
                                <td>
                                    {{ $form_details->Nvision_l_pga }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD) && !empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))
            <div class="table-responsive">    
                <table width="100%">
                    <tr>
                        <td class="col-md-2">&nbsp;</td>
                        <td class="col-md-5" colspan="4" >
                            @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD))
                                <p>&nbsp;</p>
                                <center id="wPaint-retino_scopy_OD"> 
                                        <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OD)."?".filemtime(Storage::path($form_details->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />
                                </center>
                            @endif
                        </td>
                        <td class="col-md-5" colspan="4" >
                            @if (!empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))                        
                                <p>&nbsp;</p>
                                <center id="wPaint-retino_scopy_OS"> 
                                        <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OS)."?".filemtime(Storage::path($form_details->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />  
                                </center>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        @endif

     @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
        <br>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Prescription</label>
            </div>
        </div>
	 <div class="table-reesponsive">
        <table class="table table-bordered">
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
			<tbody>
            @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
            <tr>
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                <td>
                    {{ $prescption->strength }}
                </td>
                <td>
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
                    {{ $prescption->numberoftimes }}
                </td>
            </tr>
            @endforeach
				</tbody>
        </table>
	 </div>
        @endif
        @if (!$CheckField::IsFieldEmpty($glass_prescription->r_dv_sph) || 
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_vision)
        )
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Glass Prescription</label>
            </div>
        </div>
        <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="5" align="center">
                                    <strong>Right</strong>
                                </td>
                                <td colspan="4" align="center">
                                <strong>Left Eye</strong>
                                </td>                           
                            </tr>
                            <tr>
                                <td>
                                    <strong>&nbsp;</strong>
                                </td>
                                <td align="center">
                                <strong>SPH</strong>
                                </td>                           
                                <td align="center">
                                    <strong>CYL</strong>
                                </td>
                                <td align="center">
                                <strong>AXI</strong>
                                </td>                           
                                <td align="center">
                                <strong>VISION</strong>
                                </td>
                                <td align="center">
                                <strong>SPH</strong>
                                </td>                           
                                <td align="center">
                                    <strong>CYL</strong>
                                </td>
                                <td align="center">
                                    <strong>AXI</strong>
                                </td>                           
                                <td align="center">
                                    <strong>VISION</strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>D.V.</strong>
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->r_dv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_dv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->r_dv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_dv_vision }}
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->l_dv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_dv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->l_dv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_dv_vision }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>N.V.</strong>
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->r_nv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_nv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->r_nv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_nv_vision }}
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->l_nv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_nv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->l_nv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_nv_vision }}
                                </td>
                            </tr>
                        </tbody>
                </table>
                @if (!empty($glass_prescription->retino_scopy_OD) && !is_null($glass_prescription->retino_scopy_OD) && !empty($glass_prescription->retino_scopy_OS) && !is_null($glass_prescription->retino_scopy_OS))
                    <div class="table-responsive">    
                        <table width="100%">
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td class="col-md-5" colspan="4" >
                                    @if (!empty($glass_prescription->retino_scopy_OD) && !is_null($glass_prescription->retino_scopy_OD))
                                        <p>&nbsp;</p>
                                        <center id="wPaint-retino_scopy_OD"> 
                                                <img src={{ Storage::disk('local')->url($glass_prescription->retino_scopy_OD)."?".filemtime(Storage::path($glass_prescription->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />
                                        </center>
                                    @endif
                                </td>
                                <td class="col-md-5" colspan="4" >
                                    @if (!empty($glass_prescription->retino_scopy_OS) && !is_null($glass_prescription->retino_scopy_OS))                        
                                        <p>&nbsp;</p>
                                        <center id="wPaint-retino_scopy_OS"> 
                                                <img src={{ Storage::disk('local')->url($glass_prescription->retino_scopy_OS)."?".filemtime(Storage::path($glass_prescription->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />  
                                        </center>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
        </div>
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_1))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 1 :</label>   {{ $glass_prescription->Report_1 }} 
                    </div>
                </div>
            @endif
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_2))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 2 :</label>   {{ $glass_prescription->Report_2 }} 
                    </div>
                </div>
            @endif
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_3))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 3 :</label>   {{ $glass_prescription->Report_3 }} 
                    </div>
                </div>
            @endif
        @endif
        <br>
        <br>
        <div class="col-md-12">
                    @if($form_details->uveiitis_chk=="1")
                    <div class="col-md-4">
                        <label for="uveiitis_chk"><b>Investigation For Uveiitis</b></label>
                          <ul class="list-group1">
                                            <li class="list-group-item1" style="">Cbc</li>
                                            <li class="list-group-item1" style="">Esr</li>
                                            <li class="list-group-item1" style="">Fbs/ppbs</li>
                                            <li class="list-group-item1" style="">Mantoux test</li>
                                            <li class="list-group-item1" style="">Chest x-ray</li>
                                            <li class="list-group-item1" style="">Suptum for TB</li>
                                            <li class="list-group-item1" style="">SERUM ACE</li>
                                            <li class="list-group-item1" style="">CECT CHEST</li>
                                            <li class="list-group-item1" style="">BAL</li>
                                            <li class="list-group-item1" style="">RA FACTOR</li>
                                            <li class="list-group-item1" style="">ANTI dsDNA,ANA</li>
                                            <li class="list-group-item1" style="">P-ANCA,C-ANCA</li>
                                            <li class="list-group-item1" style="">Serum homocysteine</li>
                                            <li class="list-group-item1" style="">HLA B27</li>
                                            <li class="list-group-item1" style="">IgG and IgM anti Toxo antibodies</li>
                                            <li class="list-group-item1" style="">HIV,HCV</li>
                                            <li class="list-group-item1" style="">VDRL</li>
                                        </ul>
                    </div>
                     @endif
                     @if($form_details->preoperative_chk=="1")
                    <div class="col-md-4">
                    <label for="preoperative_chk"><b>Pre Operative Investigation</b></label>
                    <ul class="list-group1">
                                        <li class="list-group-item1" style="">CBC</li>
                                        <li class="list-group-item1" style="">ESR</li>
                                        <li class="list-group-item1" style="">FBS/PPBS</li>
                                        <li class="list-group-item1" style="">HIV 1&2</li>
                                        <li class="list-group-item1" style="">HbsAG</li>
                                        <li class="list-group-item1" style="">HCV</li>
                                        <li class="list-group-item1" style="">URINE ROUTINE/MICROSCOPE</li>
                                        <li class="list-group-item1" style="">BUN</li>
                                        <li class="list-group-item1" style="">S CREATININE</li>
                                        <li class="list-group-item1" style="">S ELECTROLYTES</li>
                                        <li class="list-group-item1" style="">Chest x-ray and ECG</li>
                                        </ul>
                         
                    </div>
                     @endif

                </div>
	    
        
        <div class="form-group">
                <ul class="list-unstyled">
                    <li class="">Please bring this paper on every visit</li>
                    <li class=""> Please follow the time </li>
                    <li class=""> Please inform allergy immediately </li>
                </ul>
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
        <div class="row">
                <div class="col-md-12">
                   
                    <img src="{{url('/')}}{{ Storage::disk('local')->url($FooterUrl) }}" class="img-rounded" alt="letter head top"  style="display:block" width="100%" height="100%"  />
                </div>
               
        </div>
    </div>
    <!-- jQuery -->
  
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>