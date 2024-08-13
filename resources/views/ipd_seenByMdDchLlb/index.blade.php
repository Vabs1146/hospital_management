@extends('layouts/app')

@section('style')

<link href="{{ asset('css/dataTables.checkboxes.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">IPD Seen By MD DCH LLB</h2>
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
        <lable for="searchByNumber"> Patient Number : </lable> <input type="text" id="searchByNumber" name="searchByNumber"
            class="form-control" />
    </div>
    <div class="form-group">
        <lable for="searchByName"> Patient Name : </label> <input type="text" id="searchByName" name="searchByName"
                class="form-control" />
    </div>
    <div class="form-group">
        <lable for="searchByDoctor"> Doctor : </label> <input type="text" id="searchByDoctor" name="searchByDoctor"
                class="form-control" />
    </div>
    <div class="form-group">
        <button id="search" onclick="return searchPatient()" class="btn btn-default"> Search </button>
    </div>

    <p></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            IPD S/B. MD, DGO
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped" id="thegrid">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Patient IPD No</th>
                            <th>Patient Name</th>
                            <th>Patient Address</th>
                            <th>Date of Admission</th>
                            <th>Mobile no</th>
                            <th>Consulting doctor</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <br />
            <div class="form-inline">
                <div class="form-group">
                    {{-- <a href="{{url('IPD/patientBill/0/edit')}}" class="btn btn-primary" role="button">Add New</a> --}}
                    <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}" />
                </div>
            </div>
        </div>
    </div>
</form>




@endsection



@section('scripts')
    
    <script src="{{ asset('js/dataTables.checkboxes.min.js') }} "></script>
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
                "ajax": { "url" : "{{url('IPD/patientRegsiter/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "sortable": false,
                        "class":"never",
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/dynamicForm/3/') }}/'+row[0]+'/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add/Edit</a>';
                        },
                        "sortable": false,
                        "targets": 7                    
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/dynamicForm/print/3/') }}/'+row[0] +'"target="_blank" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Print</a>';
                        },
                        "sortable": false,
                        "targets": 8                   
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/dynamicForm/view/3/') }}/'+row[0] +'" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</a>';
                        },
                        "sortable": false,
                        "targets": 9                
                    }
                ],
                'select': {
                    'style': 'multi'
                },
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
                $(".btnDelete").button('loading');
                $.ajax({ url: '{{ url('/IPD/patientBill/delete') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
                theGrid.ajax.reload();
               }).done(function(){
                $(".btnDelete").button('reset');
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
         if($('#searchByName').val() != ""){
           theGrid.column(2).search(
                $('#searchByName').val()
            ).draw();
         }
         if($('#searchByDoctor').val() != ""){
           theGrid.column(3).search(
                $('#searchByDoctor').val()
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