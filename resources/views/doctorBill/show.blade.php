<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dr') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <!-- Custom CSS -->
    <link href="{{ asset('css/adminStyle.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!!json_encode([
                'csrfToken' => csrf_token(),
            ]) !!
        };
    </script>
    <style>
        @media screen and (max-width: 767px) {
            .select2 {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="table-responsive">
                <table class="table">
                    @if(null !== old('doctorbill',$model['doctorbill']) && count(old('doctorbill',$model['doctorbill']))> 0 ) 
                    <thead> 
                            <tr class="info">
                                <th>Bill Item</th>
                                <th>Bill Amount</th>
                                <th>Bill Date</th>
                                <th>Patient Name</th>
                            </tr>
                    </thead>
                    @foreach(old('doctorbill',$model['doctorbill']) as $doctorbill)
                    <tbody>
                        <tr>
                            <td> {{ $doctorbill->bill_item }} </td>
                            <td> {{ $doctorbill->bill_Amount }} </td>
                            <td> {{ $doctorbill->billed_date }} </td>
                            <td> {{ $doctorbill->Case_master->patient_name }} </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td align="right">
                                <label for="totalAmount" class="control-label">Total</label>
                            </td>
                            <td>
                                <?php $itemsum = 0; 
                                $itemsum = $model['doctorbill']->sum('bill_Amount') 
                            ?>
                                <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}" readonly="readonly">
                            </td>
                            <td> &nbsp; </td>
                            <td> &nbsp; </td>
                        </tr>
                    </tbody>
                    @else
                    <thead> 
                            <tr class="info">
                                <th>Bill Item</th>
                                <th>Bill Amount</th>
                                <th>Bill Date</th>
                                <th>Patient Name</th>
                            </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td colspan="4"> No Data found </td>
                            </tr>
                        </tbody>
                    @endif
                    
                </table>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js')}} "></script>

    <!-- jQuery Easing -->
    <script src="{{ asset('js/jquery.easing.1.3.js') }} "></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js') }} "></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/sb-admin-2.js') }} "></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/datatables.min.js') }} "></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }} "></script>

</body>

</html>