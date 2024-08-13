<!DOCTYPE html>
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
</head>
<body>
 <div class="container-fluid">
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
<div class="card">
    
  <div class="body">
     <div class="row clearfix">
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
   
    </div>
  <div class="form-group">
                {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
                {{ Form::hidden('doctor_id', Request::old('doctor_id'), array('class'=> 'form-control')) }}
                {{ Form::hidden('r_dv_sph', Request::old('r_dv_sph'), array('class'=> 'form-control')) }}
                {{ Form::hidden('r_dv_cyl', Request::old('r_dv_cyl'), array('class'=> 'form-control')) }}
                {{ Form::hidden('r_dv_axi', Request::old('r_dv_axi'), array('class'=> 'form-control')) }}
               {{ Form::hidden('r_dv_vision', Request::old('r_dv_vision'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_dv_sph', Request::old('l_dv_sph'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_dv_cyl', Request::old('l_dv_cyl'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_dv_axi', Request::old('l_dv_axi'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_dv_vision', Request::old('l_dv_vision'), array('class'=> 'form-control')) }}
               {{ Form::hidden('r_nv_sph', Request::old('r_nv_sph'), array('class'=> 'form-control')) }}
               {{ Form::hidden('r_nv_cyl', Request::old('r_nv_cyl'), array('class'=> 'form-control')) }}
               {{ Form::hidden('r_nv_axi', Request::old('r_nv_axi'), array('class'=> 'form-control')) }}
               {{ Form::hidden('r_nv_vision', Request::old('r_nv_vision'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_nv_sph', Request::old('l_nv_sph'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_nv_cyl', Request::old('l_nv_cyl'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_nv_axi', Request::old('l_nv_axi'), array('class'=> 'form-control')) }}
               {{ Form::hidden('l_nv_vision', Request::old('l_nv_vision'), array('class'=> 'form-control')) }}

               {{ Form::hidden('Report_1', Request::old('Report_1'), array('class'=> 'form-control')) }}
               {{ Form::hidden('patient_name', Request::old('patient_name'), array('class'=> 'form-control')) }}
               {{ Form::hidden('patient_age', Request::old('patient_age'), array('class'=> 'form-control')) }}
               {{ Form::hidden('male_female', Request::old('male_female'), array('class'=> 'form-control')) }}
               {{ Form::hidden('patient_address', Request::old('patient_address'), array('class'=> 'form-control')) }}
               {{ Form::hidden('patient_mobile', Request::old('patient_mobile'), array('class'=> 'form-control')) }}
                {{ Form::hidden('patient_emailId', Request::old('patient_emailId'), array('class'=> 'form-control')) }}
            </div>
    <div class="row">
          
            <div class="col-sm-6">
                
                 {{ $msg }} <br><label for="case_number" class="control-label">This is Your Case Number :</label>  {{  $case_number }} 
            </div>
        </div>

  <!--       <div class="row">
        <div class="col-sm-6">
            <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $patient_name }} 
        </div>
        <div class="col-sm-6">
            <div class="col-sm-6">
                <label class="control-label">Age :</label>   {{ $patient_age }}
            </div>
            <div class="col-sm-6">
                <label class="control-label">Gender :</label>   {{ $male_female }}
            </div>
        </div>
    </div> -->
    <!-- <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Address :</label>   {{ $patient_address }} 
        </div>
        <div class="col-sm-6">
            <label class="control-label">Contact No. :</label>   {{ $patient_mobile }}
        </div>
    </div> -->

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
                                {{ $r_dv_sph }}
                            </td>                           
                            <td align="center">
                                    {{ $r_dv_cyl }}
                            </td>
                            <td align="center">
                                    {{ $r_dv_axi }}
                            </td>                           
                            <td align="center">
                                    {{ $r_dv_vision }}
                            </td>
                            <td align="center">
                                {{ $l_dv_sph }}
                            </td>                           
                            <td align="center">
                                    {{ $l_dv_cyl }}
                            </td>
                            <td align="center">
                                    {{ $l_dv_axi }}
                            </td>                           
                            <td align="center">
                                    {{ $l_dv_vision }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>N.V.</strong>
                            </td>
                            <td align="center">
                                {{ $r_nv_sph }}
                            </td>                           
                            <td align="center">
                                    {{ $r_nv_cyl }}
                            </td>
                            <td align="center">
                                    {{ $r_nv_axi }}
                            </td>                           
                            <td align="center">
                                    {{ $r_nv_vision }}
                            </td>
                            <td align="center">
                                {{ $l_nv_sph }}
                            </td>                           
                            <td align="center">
                                    {{ $l_nv_cyl }}
                            </td>
                            <td align="center">
                                    {{ $l_nv_axi }}
                            </td>                           
                            <td align="center">
                                    {{ $l_nv_vision }}
                            </td>
                        </tr>                    
                    </tbody>
            </table>
    </div>

        

 <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Remark :</label>   {{ $Report_1 }} 
        </div>
    </div>
        
       
</div>
</div>
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