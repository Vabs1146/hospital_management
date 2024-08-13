<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style type="text/css" media="all">
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
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h4>Welcome To {{$msg}} Hospital.</h4>
                    
                </div>
                <div class="row">
                    <div class="col-xs-6">
                     <address>Date : &nbsp;{{ \Carbon\Carbon::now()->format('d/M/Y') }}
						    <br/> Doctor Name : &nbsp; {{$doctor_name }} 
                            <br/>Patient Name : &nbsp;{{$casedata['patient_name'] }} 
                            <br/>Patient Number :&nbsp;#{{ $casedata['case_number'] }}
                            <br/> Address : &nbsp;{{$casedata['patient_address'] }}
                            <br/> Mobile no :  &nbsp;{{ $casedata['patient_mobile'] }}
                            <br/> Follow-up Date :  &nbsp;{{ $casedata['appointment_dt'] }}
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6 text-right">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prescription Summary</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
                         <td><strong>Medicine</strong></td>
                         <td><strong>Eye</strong></td>
                         <td><strong>Day</strong></td>
                         <td><strong>Times a day</strong></td>
                         
                </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Sumtotal = 0; ?>
                                @foreach($casedata['prescriptions'] as $prescption)
                                <tr>
                <td>
                    {{  $loop->iteration }}
                </td>   
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                
                <td>
                    {{ $prescption->strength }}
                </td>
                <td class="text-center">
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
                    {{ $prescption->numberoftimes }}
                </td>
                
                
            <tr>
                                 @endforeach
                                {{-- <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">{{ $Sumtotal }}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Tax</strong></td>
                                    <td class="no-line text-right">15%</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">{{ $Sumtotal + ($Sumtotal * (15/100))  }} </td>
                                </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    
                    <br>
                    <br>
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
            //Added comment to incluede file in commit
        });
    </script>
</body>

</html>