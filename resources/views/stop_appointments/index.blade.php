@extends('adminlayouts.master')
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
 
        <div class="container-fluid">
            <div class="block-header">
               
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Stopped Appointment
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="thegrid" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                         <tr>
                                        <th>Id</th>
                                        <th>Date</th>
                                        <th>Doctor</th>
                                        <th>Time Slot</th>
                                        <th>Description</th>
                                        <th style="width:50px"></th>
										@if($permissions['1_stop_appointments']->delete_permission || AUTH::user()->role == 1)
                                        <th style="width:50px"></th>
										@endif
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="panel-footer"> <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
							@if($permissions['1_stop_appointments']->add_permission || AUTH::user()->role == 1)
                            <a href="{{url('stop_appointments/create')}}" class="btn btn-primary btn-lg" role="button">Add Stop Appointment</a></div>
							@endif
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
           
   



 @endsection




@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "ajax": "{{url('stop_appointments/grid')}}",
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/stop_appointments') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 0
                    },
                    {
                        "render": function ( data, type, row ) {
							@if($permissions['1_stop_appointments']->edit_permission || AUTH::user()->role == 1)
                            return '<a href="{{ url('/stop_appointments') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
							@else
							return '<a href="{{ url('/stop_appointments/') }}/'+row[0]+'/show" class="btn btn-default">View</a>';
							@endif
                        },
                        "targets": 5                    },
							@if($permissions['1_stop_appointments']->delete_permission || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 5+1
                    },
							@endif
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/stop_appointments') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
              var csrf_token = $("#hdnCsrfToken").data('token')
              $.ajax({ url: '{{ url('/stop_appointments') }}/' + id, 
                        type: 'POST',
                        data: {_method: 'delete', _token :csrf_token}
                     }).success(function() {
                        theGrid.ajax.reload();
                     });
            }
            return false;
        }
    </script>
@endsection