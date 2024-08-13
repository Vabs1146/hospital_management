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
                            <h2>
                               List Departments
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                 <table class="table table-hover dataTable table-bordered js-exportable" id="thegrid" data-stripe-classes="[]">
                                  <thead>
                                     <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>IsActive</th>
                                    <th style="width:50px"></th>
                                    <th style="width:50px"></th>
                                </tr>
                                  </thead>

                                  <tbody>
                                  </tbody>
                                </table>
                            </div>     
                        </div>
                        <div class="panel-footer">
                          <a href="{{url('add-section-our-departments')}}" class="btn btn-primary btn-lg" role="button">Add</a>
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
                "ajax": { 'url':'{{url('section-our-departments-grid')}}', 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/edit-section-our-departments') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 0
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/edit-section-our-departments') }}/'+row[0]+'" class="btn btn-default">Update</a>';
                        },
                        "targets": 4                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 4+1
                    },
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/delete-section-our-departments') }}/' + id, 
               type: 'POST',
               data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token'), 'id' : id}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection