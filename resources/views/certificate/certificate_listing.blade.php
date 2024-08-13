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
                            <h2>Certificate List</h2>
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

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" onclick="return searchPatient()" class="btn btn-default btn-lg waves-effect">Search</button></div>
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
                            <table class="table table-hover dataTable js-exportable table-bordered table-striped table-hover" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
                                    <th class="never">ID</th>                    
                                    <th>Patient Number</th>
                                    <th>Patient Name</th>                                        
                                    <th>Referred By</th>
                                    <th>Patient Mobile</th>
                                    <th>Age</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th></th>
                                    
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
                "ajax": { "url" : "{{url('case_masters/certificate_grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "order": [[ 0, "desc" ]],
                lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
                "createdRow": function( row, data, dataIndex){
                    //console.log(row);
                    //console.log(data);
                    //console.log(dataIndex);
                    if(data[9] == "1"){
                        $(row).addClass('redClass');
                    }
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('certificate/') }}/'+row[0]+'/1/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
                        },
                        "sortable": false,
                        "targets": 8                    
                    },
                    
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
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
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
