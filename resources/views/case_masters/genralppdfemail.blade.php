<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
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
  display:none !important;
}
}
    </style>
</head>
<body>
 <div class="container">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src="{{url('/')}}{{ Storage::disk('local')->url($logoUrl) }}" class="img-rounded" alt="letter head top" width="100%" height="150" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>

    <div class="container">
        <div class="list-group list-group-horizontal">
            @forelse ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                    @if($casedata['id'] == $VisitListDateWise['id'])
                      Date:  {{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}
                    @endif
            @endforeach
        </div>
    </div>

   
    <div class="panel-group" id="accordion">
        {{-- <form action="{{ url('/case_masters'.( isset($casedata) ? " / " . $casedata->id : " ")) }}" method="POST" class="form-horizontal"> --}}        
            {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse"  href="#collapse1">
                        Patient Summary</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                   <div class="container"> 
                        <div class="panel-body">
                            <div class="form-group">
                                {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                            </div>
                            <div class="form-group">
                                Case Number :
                                {{  $casedata['case_number'] }}
                            </div>
                            <div class="form-group">
                                Patient Name :
                                {{ $casedata['patient_name'] }}
                            </div>
                            <div class="form-group">
                                Patient age
                                {{ $casedata['patient_age'] }}
                            </div>
                            <div class="form-group">
                                Patient Address :
                                {{ $casedata['patient_address'] }}
                            </div>
                            <div class="form-group">
                                Patient Email Id :
                                {{ $casedata['patient_emailId'] }}
                            </div>
                            <div class="form-group">
                                Patient mobile :
                                {{ $casedata['patient_mobile'] }}
                            </div>
                            <div class="form-group">
                                Doctor :
                                {{ empty($casedata['doctor_id'])?"--": $casedata['doctorlist'][$casedata['doctor_id']] }}
                            </div>
                            <div class="form-group">
                                Marital Status :
                                {{ $casedata['male_female']}}
                            </div>
                            <div class="form-group">
                                Height :
                                {{ $casedata['patient_height']}}
                            </div>
                            <div class="form-group">
                                Weight:
                                {{ $casedata['patient_weight']}}
                            </div>                                                        
                            <div class="form-group">
                                Complaint :
                                {{ $casedata['complaint']}}
                            </div>
                            <div class="form-group">
                                Diagnosis :
                                {{ $casedata['diagnosis'] }}
                            </div>
                            <div class="form-group">
                                Treatment :
                                {{ $casedata['treatment'] }}
                            </div>
                            <div class="form-group">
                                @if(isset($casedata['diagnosis_file']) && $casedata['diagnosis_file'] != null)
                                    <a href="{{Storage::disk('local')->url($casedata['diagnosis_file']) }}" class="" target="_blank"> Diagnosis File link</a>
                                @endif
                            </div>
                            <div class="form-group">
                                Follow-up Date :
                                {{ $casedata['appointment_dt'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                    Complaint</a>
                </h4>
            </div>
            <div id="collapse7" class="panel-collapse collapse in">        
                <div class="container">
                    <div class="panel-body" >                
                        <ul  class="list-group">
                            @forelse($casedata['field_type_data']->where('field_type_id', '1') as $fieldData)
                                <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                            @empty
                                <li  class="list-group-item"> No Data found </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>            
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                    Diagnosis</a>
                </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse in">        
                <div class="container">
                <div class="panel-body" > 
                <ul  class="list-group">
                    @forelse($casedata['field_type_data']->where('field_type_id', '2') as $fieldData)
                        <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                    @empty
                        <li  class="list-group-item"> No Data found </li>
                    @endforelse
                </ul>
                </div>
                </div>            
            </div>            
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                    Treatment</a>
                </h4>
            </div>            
            <div id="collapse6" class="panel-collapse collapse in">
                <div class="container">
                    <div class="panel-body" > 
                        <ul  class="list-group">
                            @forelse($casedata['field_type_data']->where('field_type_id', '3') as $fieldData)
                                <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                            @empty
                                <li  class="list-group-item"> No Data found </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse"  href="#collapse3">
                    Prescription. </a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse">
              <div class="container">
                <div class="panel-body">
                <div class="table-responsive">
                    @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                        <table class="table">
                            <tr>
                                <th>
                                    Medicine
                                </th>
                                <th>
                                    Quantity
                                </th>
                                <th>
                                Per Unit Price
                                </th>
                                <th>
                                    Total Amount
                                </th>
                            </tr>
                                @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                    <tr>   
                                        <td>
                                            {{ $prescption->Medical_store->medicine_name }}
                                        </td>
                                        <td>
                                            {{ $prescption->medicine_Quntity }}
                                        </td>
                                        <td>
                                            {{ $prescption->per_unit_cost }}
                                        </td>
                                        <td>
                                            {{ $prescption->per_unit_cost * $prescption->medicine_Quntity }}
                                        </td>
                                    <tr>
                                @endforeach
                            </table>        
                    @else
                        <ul  class="list-group">
                            <li  class="list-group-item"> No Data found </li>
                        </ul>
                    @endif
                        
                </div>
              </div>
            </div>
            </div>            
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                        Note</a>
                </h4>
            </div>
            <div id="collapse6" class="panel-collapse collapse in">
                <div class="container">
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li class="">Please bring this paper on every visit</li>
                            <li class=""> Please follow the time </li>
                            <li class=""> Please inform allergy immediately </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
                <h3>{{ config('app.name', 'Dr') }}</h3> <br/>
            </div>
            <div class="col-md-12">
                <span class="pull-left">
                        Date : <br>
                        Place : 
                </span>
                <div class="pull-right">
                    Date : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                    Place : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
        </div>
    {{-- <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"  href="#collapse2">
                Follow up date.</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
            <div class="container" >
                <div class="form-group">
                    Date :
                    {{ $casedata['appointment_dt']}}
                </div>
                <div class="form-group">
                    Time : {{ Form::select('appointment_timeslot', array(''=>'Please select') + $casedata['timeslot']->toArray(), Request::old('appointment_timeslot'), array('class' => 'form-control', 'readonly' => 'readonly', 'disabled'=> 'disabled')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('FollowUpDoctor_id','Doctor') }} {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $casedata['doctorlist']->toArray(),
                    Request::old('FollowUpDoctor_id'), array('class' => 'form-control', 'readonly'=>'readonly', 'disabled'=> 'disabled')) }}
                </div>
             </div>
            </div>
        </div>            
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"  href="#collapse3">
                Prescription.</a>
            </h4>
        </div>
        <div id="collapse3" class="panel-collapse collapse">
          <div class="container">
            <div class="panel-body">
            <div class="table-responsive">
                @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                    <table class="table">
                        <tr>
                            <th>
                                Medicine
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                            Per Unit Price
                            </th>
                            <th>
                                Total Amount
                            </th>
                        </tr>
                            @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                <tr>   
                                    <td>
                                        {{ $prescption->Medical_store->medicine_name }}
                                    </td>
                                    <td>
                                        {{ $prescption->medicine_Quntity }}
                                    </td>
                                    <td>
                                        {{ $prescption->per_unit_cost }}
                                    </td>
                                    <td>
                                        {{ $prescption->per_unit_cost * $prescption->medicine_Quntity }}
                                    </td>
                                <tr>
                            @endforeach
                        @endif
                    </table>
            </div>
          </div>
        </div>
        </div>            
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"  href="#collapse4">
                Uploaded Files.</a>
            </h4>
        </div>
        <div id="collapse4" class="panel-collapse collapse">
          <div class="container">
            <div class="panel-body">
            <div class="form-group">
                {{ Form::label('Reports_file', 'Report File/image') }}
                @if(null !== old('Report_file',$casedata['Reports_file']) && count(old('Report_file',$casedata['Reports_file']))> 0 )
                    <div class="list-group">
                        @foreach(old('Report_file',$casedata['Reports_file']) as $reportfile)                        
                                <div href="#" class="list-group-item clearfix">
                                    <div class="d-flex w-100 justify-content-between">
                                        @if(isset($reportfile->file_path) && $reportfile->file_path != null)
                                        <h5 class="mb-1"> <a href="{{url('/')}}{{ Storage::disk('local')->url($reportfile->file_path) }}" class="" target="_blank"> ..Report document </a> </h5>
                                        @endif
                                    </div>
                                    <p class="mb-1">
                                        {{$reportfile->report_description}}
                                    </p>
                                </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{ Form::label('Before_file', 'Before image') }}
                @if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
                    <a href="{{url('/')}}{{Storage::disk('local')->url($casedata['Before_file']) }}" class="" target="_blank"> Before Image link</a>              
                @endif                
            </div>
            <div class="form-group">
                {{ Form::label('After_file', 'After image') }} 
                @if(isset($casedata['After_file']) && $casedata['After_file'] != null)
                    <a href="{{url('/')}}{{ Storage::disk('local')->url($casedata['After_file']) }}" class="" target="_blank"> After Image link</a>              
                @endif
            </div>
          </div>
        </div>
        </div>            
    </div> --}}

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