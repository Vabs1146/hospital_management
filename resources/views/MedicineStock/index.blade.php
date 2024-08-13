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
                            <h2>Medicine Stock</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                                   <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Available Medicine Stock :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="medicine_name" name="medicine_name" >
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            From Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="created_at" name="created_at">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           To Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="updated_at" name="updated_at">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" onclick="return searchMedicine()" class="btn btn-default waves-effect">Search</button></div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                        <form>
                         <div class="header bg-pink">
                            <h2>
                                List of Medicine Stock
                            </h2>
                          
                        </div>
                         
                        <div class="body">
                              <div class="table-responsive">
                                <table class="table  table-bordered table-hover dataTable js-exportable" id="thegrid">
                                  <thead>
                                    <tr>
                                        <th class="never">ID</th>
                                        <th>Name Of Medicine</th>
                                        <th>Remaining Stock Qty</th>
                                        <th>Mfg.date</th>                                        
                                        <th>Exp date</th>
                                        <th>Stock in date</th>
                                        <th>Stock Out date</th>
                                        <th>Cost</th>
                                        <th>unit Received</th>
                                        <th>unit issued</th>
                                        <th style="width:100px; text-align:center"></th>
                                        <th style="width:100px; text-align:center"></th>
                                        <th style="width:50px"></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                            </div>  
                          
                        </div>
                        
                        <div class="panel-footer"><a href="{{url('/MedicineStock/0/edit')}}" class="btn btn-info btn-lg"> Add New </a>  <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/></div>
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
                "ajax": { "url" : "{{url('/MedicineStock/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
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
                            return '<a href="{{ url('/MedicineStock') }}/'+row[0]+'/edit" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 10                    
                    },
					{
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="{{ url('/ViewMedicineStock') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 11
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/MedicineStock/print/') }}/'+row[0] +'"target="_blank" class="btn btn-default btn-circle waves-effect waves-circle waves-float" ><i class="fa fa-print" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 12                  
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger btnDelete" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> Processing..">Delete</a>';
                        },
                        "sortable": false,
                        "targets": 13                    
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
                $.ajax({ url: '{{ url('/MedicineStock/delete') }}/' + id, 
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


       function searchMedicine(){
         
         if($('#medicine_name').val() != ""){
            theGrid.column(1).search(
                $('#medicine_name').val()
            ).draw();
         }
         if($('#created_at').val() != ""){
           theGrid.column(2).search(
                $('#created_at').val()
            ).draw();
         }
         if($('#updated_at').val() != ""){
           theGrid.column(3).search(
                $('#updated_at').val()
            ).draw();
         }         
         if($('#created_at').val() == "" && $('#medicine_name').val() == "" && $('#updated_at').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }


    </script>
@endsection