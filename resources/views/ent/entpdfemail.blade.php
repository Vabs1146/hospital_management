<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EntController')
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  
    <link href="{{ ltrim(public_path('css/bootstrap.css'), '/') }}" rel="stylesheet">
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
            font-size: 14px;
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
            <img src="{{url('/')}}{{ Storage::disk('local')->url($logoUrl) }}" class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
	  {{ Form::hidden('patient_emailId', Request::old('patient_emailId', $casedata['patient_emailId']), array('class'=> 'form-control')) }}
	  {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control')) }}
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
                <label for="case_number" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }} 
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
        <br>
        <br>
        @if(!$CheckField::IsFieldEmpty($form_details->CNS))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">General Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
                </div>
            </div>
        @endif
        <br>
        <br>
              <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <td>
                                    
                                </td>
                                <td >
                                    <strong>OD</strong>
                                </td>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'complaint')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Complaint
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                              
                            </tr>                            
                        @endforeach 
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'finding')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Finding      
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                            
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'diagnosis')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                        Diagnosis
                                    @endif
                                </td>
                                <td colspan="2">
                                    {{$item->field_value_OD}}
                                </td>
                            </tr>                            
                        @endforeach
                      
                    
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'treatment_advice')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                     Treatment Advice
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'life_style_chenger')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                     Life Style Changer
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                               
                            </tr>                            
                        @endforeach
                        
                       
                        </tbody>
                    </table>
                </div>
              </div>  
            
                <div class="col-md-12">
                @if(count($blnc_test)>1)
                <div class="col-md-2">
                    <div class="form-group labelgrp">
                    <label>Balance Test :</label>   
                    </div>
                </div>
               <div class="col-md-12">
                @foreach($blnc_test as $key => $blnctest)
                <div class="col-md-2 ">
                    <ul class="" >
                       <li class="" style="list-style-type: none;"><label><b>{{$key+1}}.&nbsp;{{$blnctest->blncetestname}}</b></label> </li>
                    </ul>
                    
                </div>
                @endforeach
                </div>
                @endif
              </div>


               <!----------------------------------------------------------------------------->
           <div class="row">
                   
                    <div class="col-md-2">
                    <label for="ear1_chk"><b>Examination</b></label>
                    
                    </div>
                    
                     @if($form_details->ear1_chk=="1")
                    <div class="col-md-3">
                    <label for="ear1_chk"><b>ear1</b></label>
                    <ul class="list-group1">
                                       <img src="{{ url('/')}}/assets/images/ear.jpg" width="100" height="100" alt="ears" />
                                        </ul>
                         
                    </div>
                     @endif

                      @if($form_details->ear2_chk=="1")
                    <div class="col-md-3">
                    <label for="ear2_chk"><b>ear2</b></label>
                    <ul class="list-group1">
                                       <img src="{{ url('/')}}/assets/images/ear.jpg" width="100" height="100" alt="ears" />
                                        </ul>
                         
                    </div>
                     @endif
                         @if($form_details->nose_chk=="1")
                    <div class="col-md-3">
                    <label for="nose_chk"><b>nose_chk</b></label>
                    <ul class="list-group1">
                                       <img src="{{ url('/')}}/assets/images/nose.jpg" width="100" height="100" alt="ears" />
                                        </ul>
                         
                    </div>
                     @endif
                     </div>
                    <div class="col-md-12">
                  

                      @if($form_details->neck_chk=="1")
                    <div class="col-md-3 col-md-offset-2">
                    <label for="neck_chk"><b>neck_chk</b></label>
                    <ul class="list-group1">
                                       <img src="{{ url('/')}}/assets/images/neck.jpg" width="100" height="100" alt="ears" />
                                        </ul>
                         
                    </div>
                     @endif

                      @if($form_details->throat_chk=="1")
                    <div class="col-md-3">
                    <label for="throat_chk"><b>Throat</b></label>
                    <ul class="list-group1">
                                       <img src="{{ url('/')}}/assets/images/shoulder.jpg" width="100" height="100" alt="ears" />
                                        </ul>
                         
                    </div>
                     @endif

                </div>

    <!------------------------------------------------------------------------------>
               <div class="col-md-12">
                   
                    <div class="col-md-4">
                    <label for="uveiitis_chk"><b>Investigation</b></label>
                    
                    </div>
                    
                 

               
            
            <!--    
              

                <div class="col-md-12">
                    <ul class="list-unstyled">
                        <li class="">Please bring this paper on every visit</li>
                        <li class=""> Please follow the time </li>
                        <li class=""> Please inform allergy immediately </li>
                    </ul>
                </div>
           -->
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

                     @if($form_details->preoperative_chk1=="1")
                    <div class="col-md-4">
                    <label for="preoperative_chk1"><b>Pre Operative Investigation1</b></label>
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
               </div>

        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <img src="{{url('/')}}{{ Storage::disk('local')->url($FooterUrl) }}" class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   
</body>
</html>