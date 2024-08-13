@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                    <div class="card">
                        <form>
                         <div class="header bg-pink">
                            <h2>
                                Eye Prescription Medicine
                            </h2>
                          
                        </div>
                        
                        <div class="body">
                            
                              <div class="table-responsive">
                               <table class="table table-striped display table-hover table-bordered" id="thegrid" cellspacing="0" width="100%">
              <thead>
                <tr>
                    <th style="width:50px">Id</th>
                    <th style="width:150px">Medicine Name</th>
                    <th style="width:0px">Total/Purchased Quantity</th>
                    <th style="width:0px">Unit Price</th>
                    <th style="width:0px">Balance Quantity</th>
                    <th style="width:50px">Isactive</th>
                    {{-- <th>Created Dt</th>
                    <th>Updated Dt</th> --}}
                    <th style="width:10px"></th>
                    <th style="width:50px"></th> 
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
                            
                            </div>

                        </div>
                        
                        <div class="panel-footer">
                            <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
        <a href="{{url('Medicine/create')}}" class="btn btn-primary btn-lg" role="button">Add medicine</a></div>
                     
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
                "ajax": "{{url('medical_stores/grid')}}",
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/Medicine') }}/'+row[0]+'" class="btn btn-default">Update</a>';
                        },
                        "targets": 6                    },
                        {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 7
                    },
                ],
                  "columns": [
                        null,
                        null,
                        { "visible": false },
                        { "visible": false },
                        { "visible": false },
                        null,
                        null
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
             swal({
        title: "Are you sure?",
        text: "This Will Remove !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {

            
               var csrf_token = $("#hdnCsrfToken").data('token')
               $.ajax({ url: '{{ url('/medical_stores') }}/' + id, 
                        type: 'POST',
                        data: {_method: 'delete', _token :csrf_token}
                        }).

               success(function() {
            swal({title: "Deleted", text: "Successfully!!!", type: "success"},
             function(){ 
               theGrid.ajax.reload();
              }
            );
                });

              
           
            
         });
    }
    </script>
@endsection