@extends('adminlayouts.master')
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
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
                            <h2>List of Members Contact Details</h2>
                        </div>
                         
                        <div class="body">
                                  <div class="table-responsive">
                                <table class="table table-hover table-bordered table-stripe" id="thegrid"  data-stripe-classes="[]">
                                    <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Role</th>
                                          <th>Mobile</th>
                                          <th>Password</th>
                                           @if($permissions['users']->edit_permission || AUTH::user()->role == 1)
                                         <th></th>
                                         @endif
                                          @if($permissions['users']->delete_permission || AUTH::user()->role == 1)
                                          <th></th>    
                                          @endif
                                      </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                              </div>
                            
                            <div class="panel-footer"><input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
                                @if($permissions['users']->add_permission || AUTH::user()->role == 1)
                            <a href="{{url('staff_users/create')}}" class="btn btn-lg btn-primary" role="button">Add User</a></div>
                            @endif
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
                "ajax": "{{url('staff_users/grid')}}",
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                     @if($permissions['users']->edit_permission || AUTH::user()->role == 1)
                    {
                        "render": function ( data, type, row ) {
							if((row[2] != "Admin")) {
                            return '<a href="{{ url('/staff_users') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
							} else {
								return '';
							}
                        },
                        "sortable": false,
                        "targets":5
                    },
                    @endif
                     @if($permissions['users']->delete_permission || AUTH::user()->role == 1)
                       {
                        "render": function ( data, type, row ) {
							if((row[2] != "Admin")) {
								return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
							} else {
								return '';
							}
                        },
                        "sortable": false,
                        "targets": 6
                    },
                    @endif
                ]
            });
        });
     
            function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/deleteuser/delete') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection
  