@extends('layouts/app')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Image Gallery11</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="clo-lg-12"> 
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        List of Images
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped" id="thegrid">
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
        <a href="{{url('image_galleries/create')}}" class="btn btn-primary" role="button">Add Images</a>
        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
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
                "ajax": { 'url':'{{url('imageList/grid')}}', 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/image_galleries') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 0
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/image_galleries') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
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
               $.ajax({ url: '{{ url('/image_galleries') }}/' + id, 
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