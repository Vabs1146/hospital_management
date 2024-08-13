@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  @if(Session::has('flash_message'))
                                      <div class="alert alert-success">
                                          {{ Session::get('flash_message') }}
                                      </div>
                                  @endif
                              
                    <div class="card">
                        <div class="header">
                            <h2>Patient Reports</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                                   <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Patient Number :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByNumber" name="searchByNumber">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Patient Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByDoctor" name="searchByDoctor">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <!-- <span class="input-group-addon">
                                           Patients:
                                        </span> -->
                                        <div class="form-line">
                                            <select class="form-control select2" id="searchByDay">
                                                <option value="today">Todays Patients</option>
                                                <option value="all">All Patients</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-1">
                                    <div class="form-group">
                                        <button id="search" onclick="return searchPatient()" class="btn btn-default"> Search </button>
                                    </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>List of Patients</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                           <table class="table table-striped table-hover table-bordered" id="thegrid">
                              <thead>
                                <tr>
                                    <th class="never">ID</th>
                                    <th>Patient Number</th>
                                    <th>Patient Name</th>
                                    <th>Ref. Doctor</th>                                        
                                    <th>Patient Mobile</th>
                                    <th>Doctor</th>

                                    @if($commonHelper->checkUserAccess("2_report_files",Auth::user()->id, 'add_permission') || $commonHelper->checkUserAccess("2_report_files",Auth::user()->id, 'edit_permission') || AUTH::user()->role == 1)
                                    <th style="width:100px; text-align:center"></th>
                                    @endif
                                    {{-- <th style="width:50px"></th> --}}
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                           </table>
                           </div>
<input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>                          
                        </div>
                    </div>
                </div>
            </div>
</div>

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
                "autoWidth": false,
                "order": "",
                "ajax": { "url" : "{{url('case_masters/prescription_grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    @if($commonHelper->checkUserAccess("2_report_files",Auth::user()->id, 'add_permission') || $commonHelper->checkUserAccess("2_report_files",Auth::user()->id, 'edit_permission') || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/report_files/') }}/'+row[0]+'/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add/Edit</a>';
                        },
                        "sortable": false,
                        "targets": 6                    
                    }
                    @endif
                ],
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient(){
         //alert($('#searchByDay').val());
         if($('#searchByNumber').val() != ""){
            theGrid.column(1).search(
                $('#searchByNumber').val()
            ).draw();
         }
         if($('#searchByDoctor').val() != ""){
           theGrid.column(2).search(
                $('#searchByDoctor').val()
            ).draw();
         }         
         if($('#searchByName').val() != ""){
           theGrid.column(3).search(
                $('#searchByName').val()
            ).draw();
         }         
         if($('#searchByDay').val() != ""){
           theGrid.column(4).search(
                $('#searchByDay').val()
            ).draw();
         }
         if($('#searchByName').val() == "" && $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection
