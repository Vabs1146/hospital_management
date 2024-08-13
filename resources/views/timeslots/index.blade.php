@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Timeslot</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        List of {{ ucfirst('timeslots') }}
    </div>

    <div class="panel-body">
     <div class="table-responsive"> 
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>IsActive</th>
                    <th>Created Dt</th>
                    <th>Update Dt</th>
                    <th style="width:50px"></th>
                    <th style="width:50px"></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
    </div>
        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
        <a href="{{url('timeslots/create')}}" class="btn btn-primary" role="button">Add timeslot</a>
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
                "ajax": "{{url('timeslots/grid')}}",
                "columnDefs": [
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/timeslots') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/timeslots') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
                        },
                        "targets": 5                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                        },
                        "targets": 5+1
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
                // Apply the search
            theGrid.columns().every( function () {
                var that = this;
        
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               var csrf_token = $("#hdnCsrfToken").data('token')
               $.ajax({ url: '{{ url('/timeslots') }}/' + id, 
                         type: 'POST', 
                         data: {_method: 'delete', _token :csrf_token}
                       }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection