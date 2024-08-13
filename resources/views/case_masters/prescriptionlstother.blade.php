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
                            <h2>Prescription List</h2>
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
                                            <input type="text" id="searchByNumber" name="searchByNumber" class="form-control" /> 
                                        </div>
                                    </div>
                                  </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Patient Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="searchByName" name="searchByName"  class="form-control"/> 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="searchByDoctor" name="searchByDoctor"  class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <div class="form-line">
                                            <select class="form-control select2" id="searchByDay">
                                                <option value="today">Todays Patients</option>
                                                <option value="all">All Patients</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
								-->
								 <div class="col-md-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           From :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="from_date" name="from_date">
                                        </div>
                                    </div>
                                </div>
								 <div class="col-md-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           To :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="to_date" name="to_date">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-1">
                                    <div class="form-group">
                                        <button id="search" onclick="return searchPatient()" class="btn btn-default btn-lg"> Search </button>
                                      </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>List of {{ ucfirst('case_masters') }}</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="thegrid">
                           <thead>
                            <tr>
                                <th class="never">ID</th>
                                <th>Patient Number</th>
                                <th>Patient Name</th>
                                <th>Ref. Doctor</th>                                        
                                <th>Patient Mobile</th>
                                <th>Doctor</th>
                                <th style="width:50px"></th>
                                <th style="width:50px"></th>
                                <th>Doctor</th>
                                <th>Doctor</th>
                                <th>Doctor</th>
                                <th>Doctor</th>
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
                "order": [[ 0, 'desc' ]],
                "ajax": { "url" : "{{url('case_masters/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/AddEdit/entprescription/') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
                        },
                        "sortable": false,
                        "targets": 6                    
                    },
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="{{ url('/print/entprescription') }}/' + row[0] + '"><i class="fa fa-print" aria-hidden="true"></i>Print</a>';
                        },
                        "sortable": false,
                        "targets": 6+1
                    },
            {
               "targets": 8,
                "visible": false,
            },
            {
               "targets": 9,
                "visible": false,
            },
            {
               "targets": 10,
                "visible": false,
            },
            {
               "targets": 11,
                "visible": false,
            }
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
         /*		 
         if($('#searchByDay').val() != ""){
           theGrid.column(8).search(
                $('#searchByDay').val()
            ).draw();
         } 
		 */
		 if($('#from_date').val() != ""){
           theGrid.column(9).search(
                $('#from_date').val()
            ).draw();
         }
		         
         if($('#to_date').val() != ""){
           theGrid.column(10).search(
                $('#to_date').val()
            ).draw();
         }
         if( $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == "" && $('#from_date').val() == "" && $('#to_date').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.column(9).search('');
            theGrid.column(10).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection