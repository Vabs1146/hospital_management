@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Patient Reports</h2>
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
                <lable for="searchByNumber"> Patient Number : </lable> <input type="text" id="searchByNumber" name="searchByNumber" class="form-control" /> 
            </div>
            <div class="form-group">
               <lable for="searchByName">  Patient Name : </label> <input type="text" id="searchByName" name="searchByName"  class="form-control"/> 
            </div>
            <div class="form-group">
               <lable for="searchByDoctor">  Doctor : </label> <input type="text" id="searchByDoctor" name="searchByDoctor"  class="form-control"/> 
            </div>
            <div class="form-group">
                <button id="search" onclick="return searchPatient()" class="btn btn-default"> Search </button>
            </div>
        </form>
        <p></p>

<div class="panel panel-default">
    <div class="panel-heading">
        List of {{ ucfirst('case_masters') }}
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th class="never">ID</th>
                    <th>Patient Number</th>
                    <th>Doctor</th>
                    <th>Patient Name</th>                                        
                    <th>Patient EmailId</th>
                    <th>Patient Mobile</th>
                    <th></th>
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
                "ajax": { "url" : "{{url('case_masters/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/insuranceBill/') }}/'+row[0]+'/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add/Edit</a>';
                        },
                        "sortable": false,
                        "targets": 6                    
                    }
                    ,
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/insuranceBill/print') }}/'+ row[0] + '" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>print</a>';
                        },
                        "sortable": false,
                        "targets": 7                    
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
               $.ajax({ url: '{{ url('/insuranceBill') }}/' + id, type: 'DELETE'}).success(function() {
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