@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
  <div class="col-lg-12"> 
                                  @if(Session::has('flash_message'))
                                      <div class="alert alert-success">
                                          {{ Session::get('flash_message') }}
                                      </div>
                                  @endif
                                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                        <div class="header">
                            <h2>Bulk SMS list</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                

                              <div class="col-md-12">
                                   <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Group Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Mobile Number :
                                        </span>
                                        <div class="form-line">
                                           <input type="text" class="form-control" placeholder="" id="searchByNumber" name="searchByNumber">
                                        </div>
                                    </div>
                                </div>


                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <button id="search" onclick="return searchBulkSms()" class="btn btn-default btn-lg"> Search </button>
                                      </div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                        <form>
                         <div class="header bg-pink">
                            <h2>
                                List of Bulk sms Group
                            </h2>
                          
                        </div>
                       
                            <div class="body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="thegrid">
                                <thead>
                                   <tr>
                                      <th>Id</th>
                                      <th>Group Name</th>
                                      <th style="width:50px"></th>
                                      
                                     
                                      <th style="width:50px"></th>
                                       <th style="width:50px"></th>
                                      <th>Mobile Numbers</th>
                                     
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </div>
                            <br>
                     <a href="{{url('bulk_sms/create')}}" class="btn btn-primary btn-lg" role="button">Add bulk_sms Group</a>
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
                "ajax": "{{url('bulk_sms/grid')}}",
             "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/bulk_sms') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/bulk_sms') }}/'+row[0]+'/send_sms" class="btn btn-default">Text SMS</a>';
                        },
                        "targets": 2                   
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/bulk_sms') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
                        },
                        "targets": 3                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 4
                    },
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/bulk_sms') }}/' + id, 
                        type: 'DELETE',
                        data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
                    }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

       function searchBulkSms(){
         
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
         if($('#searchByName').val() == "" && $('#searchByNumber').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.ajax.reload();
         }
        return false;
        }
    </script>
@endsection
