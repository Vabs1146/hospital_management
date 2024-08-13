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
                            <h2>IPD Patient's</h2>
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
                                        <button type="button" onclick="return searchPatient()" class="btn btn-default waves-effect">Search</button></div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                        <form>
                         <div class="header bg-pink">
                            <h2>
                               IPD Admission
                            </h2>
                          
                        </div>
                        <div class="body">
                              <div class="table-responsive">
                                <table class="table  table-bordered table-hover dataTable js-exportable" id="thegrid">
                                   <thead>
                                    <tr>
                                    <th></th>
                                    <th>Patient IPD No</th>
                                    <th>Patient Name</th>
                                    <th>Patient Address</th>
                                    <th>Date of Admission</th>
                                    <th>Mobile no</th>
                                    <th>Consulting doctor</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                  <tbody class="tbody">
                                  </tbody>
                                </table>
                            </div>  
                          
                        </div>
                        
                        <div class="panel-footer">
                         <a href="{{url('IPD/patientRegsiter/0/edit')}}" class="btn btn-primary btn-lg" role="button">Add New</a>
                        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}" />
                        </div>
                        </div>
                </div>
            </div>


</div>

@endsection
@section('scripts')
    
    <script src="{{ asset('js/dataTables.checkboxes.min.js') }} "></script>
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
                "ajax": { "url" : "{{url('IPD/patientRegsiter/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "sortable": false,
                        "class":"never",
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/IPD/patientRegsiter/') }}/'+row[0]+'/edit" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 7                    
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/IPD/patientRegsiter/print/') }}/'+row[0] +'"target="_blank" class="btn btn-default btn-circle waves-effect waves-circle waves-float" ><i class="fa fa-print" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 8                   
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger btnDelete" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> Processing..">Delete</a>';
                        },
                        "sortable": false,
                        "targets": 9                    
                    }
                ],
                'select': {
                    'style': 'multi'
                },
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
                $(".btnDelete").button('loading');
                $.ajax({ url: '{{ url('/IPD/patientRegsiter/delete') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
                theGrid.ajax.reload();
               }).done(function(){
                $(".btnDelete").button('reset');
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
         if($('#searchByName').val() != ""){
           theGrid.column(2).search(
                $('#searchByName').val()
            ).draw();
         }
         if($('#searchByDoctor').val() != ""){
           theGrid.column(3).search(
                $('#searchByDoctor').val()
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