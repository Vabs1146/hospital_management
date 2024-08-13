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
                         <div class="header bg-pink">
                            <h2>Prescription Templates Listing</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
                                    <th class="never">ID</th>               
                                    <th>Template</th>  
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
            // $(".select2").select2()
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                "ajax": { "url" : "{{url('prescription-templates-grid')}}", 'type':'POST', data: {_method: 'POST', _tokdssdsen :$("#hdnCsrfToken").data('token'), searchByDay: 'all'}},
                "order": [[ 0, "desc" ]],
                lengthMenu: [
					[ 10, 25, 50, -1 ],
					[ '10 rows', '25 rows', '50 rows', 'Show all' ]
				],
                "createdRow": function( row, data, dataIndex){
                    //console.log(row);
                    //console.log(data);
                    //console.log(dataIndex);
                    if(data[11] == "1"){
                        $(row).addClass('redClass');
                    }
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": true,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return data;
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('edit-psychiatrist-prescription-templates') }}/'+row[0]+'/{{$case_id}}"  class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 2                    
                    }
                ],
				/*
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
				*/
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('delete-prescription-templates') }}/' + id, 
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
         if($('#searchByDay').val() != ""){
           theGrid.column(8).search(
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
