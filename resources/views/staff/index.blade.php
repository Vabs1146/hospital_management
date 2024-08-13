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
                                List of Members Contact Details
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                 <table class="table table-hover dataTable js-exportable" id="thegrid" data-stripe-classes="[]">

                                  <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Relationship</th>
                                        <th>Mobile No</th>
                                        <th>Email Id</th>
                                        <th style="width:50px"></th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                  </tbody>
                                </table>
                            </div>     
                        </div>
                        <div class="panel-footer">
                          <a href="{{url('staff_member/create')}}" class="btn btn-lg btn-primary" role="button">Add User</a>
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
                "ajax": "{{url('staff/grid')}}",
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/staff_member') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
                        },
                        "targets": 5
                    },
                ]
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/staff_users') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection
  