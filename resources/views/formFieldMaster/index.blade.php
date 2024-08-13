@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Form Field Master</h2>
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

        <form class="form-inline">
            <div class="form-group">
                <lable for="searchByNumber"> Field Name : </lable> <input type="text" id="searchByName" name="searchByName" class="form-control" /> 
            </div>
            <div class="form-group">
                <lable for="searchByFormId"> Form Id : </lable> 
                <input type="text" id="searchByFormId" name="searchByFormId" class="form-control" /> 
            </div>
            <div class="form-group">
                <button id="search" onclick="return searchPatient()" class="btn btn-default"> Search </button>
            </div>
        </form>
        <p></p>

<div class="panel panel-default">
    <div class="panel-heading">
        List of Form Field Name
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th class="never">ID</th>
                    <th>Field Name</th>
                    <th>Form Field Code</th>
                    <th>Form Master</th>
                    <th></th>
                    <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
        <a href="{{ url('/formFieldMaster/addField/0') }}"  class="btn btn-default" >Add field</a>
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
                "order": "",
                "ajax": { "url" : "{{url('formFieldMaster/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/formFieldMaster/addField/') }}/'+row[0] + '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Field</a>';
                        },
                        "sortable": false,
                        "targets": 4                    
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/formFieldMaster/EditMapping/') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Mapping</a>';
                        },
                        "sortable": false,
                        "targets": 5                    
                    }
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
               $.ajax({ url: '{{ url('/formFieldMaster') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient(){ 
         if($('#searchByName').val() != ""){
            theGrid.column(1).search(
                $('#searchByName').val()
            ).draw();
         }
         if($('#searchByName').val() == ""){
            theGrid.column(1).search('');
            theGrid.ajax.reload();
         }
         if($('#searchByFormId').val() != ""){
            theGrid.column(2).search(
                $('#searchByFormId').val()
            ).draw();
         }
         if($('#searchByFormId').val() == ""){
            theGrid.column(2).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection