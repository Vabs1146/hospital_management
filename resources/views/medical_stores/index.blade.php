@extends('layouts/app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Medicine</h2>
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
        List of Medical Store
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Medicine Name</th>
                    <th>Total/Purchased Quantity</th>
                    <th>Unit Price</th>
                    <th>Balance Quantity</th>
                    <th>Isactive</th>
                    {{-- <th>Created Dt</th>
                    <th>Updated Dt</th> --}}
                    <th style="width:50px"></th>
                    {{-- <th style="width:50px"></th> --}}
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
        <a href="{{url('medical_stores/create')}}" class="btn btn-primary" role="button">Add medical_store</a>
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
                            return '<a href="{{ url('/medical_stores') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/medical_stores') }}/'+row[0]+'/edit" class="btn btn-default">Update</a>';
                        },
                        "targets": 6                    },
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
            if(confirm('You really want to delete this record?')) {
               var csrf_token = $("#hdnCsrfToken").data('token')
               $.ajax({ url: '{{ url('/medical_stores') }}/' + id, 
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