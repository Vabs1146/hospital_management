@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Seo search</h2>
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
                <lable for="searchByUrl"> Page Url : </lable> <input type="text" id="searchByUrl" name="searchByUrl" class="form-control" /> 
            </div>
            <!--div class="form-group">
               <lable for="searchByName">  Patient Name : </label> <input type="text" id="searchByName" name="searchByName"  class="form-control"/> 
            </div>
            <div class="form-group">
               <lable for="searchByDoctor">  Doctor : </label> <input type="text" id="searchByDoctor" name="searchByDoctor"  class="form-control"/> 
            </div -->            
            <div class="form-group">
                <button id="search" onclick="return searchSeo()" class="btn btn-default"> Search </button>
            </div>
        </form>
        <p></p>

<div class="panel panel-default">
    <div class="panel-heading">
        List of Seo 
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped" id="thegrid">
              <thead>
                <tr>
                    <th class="never">ID</th>                    
                    <th>Page Url</th>
                    <th>Page Title</th>                                        
                    <th>Date</th>
					<!-- th>Status</th -->
                    <th></th>
                    <!-- th></th -->
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <a href="{{url('/seo/add')}}" class="btn btn-primary" role="button">Add Seo Details</a>
        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
    </div>
</div>

@endsection



@section('scripts')
<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script -->
<script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                "ajax": { "url" : "{{url('seo/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/seo/edit') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="{{ url('/seo/edit') }}/'+row[0]+'"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>';
                        },
                        "sortable": false,
                        "targets": 4
                    },
                    // {
                        // "render": function ( data, type, row ) {
                           
						// if(row[4] == '1'){ var strAct = 'Disable'}else{var strAct = 'Enable'}
                            // return '<a href="#" onclick="return doDelete('+row[0]+')"><i class="fa fa-times" aria-hidden="true"></i>'+strAct+'</a>';
                        // },
                        // "sortable": false,
                        // "targets": 5+1
                    // },
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
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchSeo(){
         
         if($('#searchByUrl').val() != ""){
            theGrid.column(1).search(
                $('#searchByUrl').val()
            ).draw();
         }
         // if($('#searchByDoctor').val() != ""){
           // theGrid.column(2).search(
                // $('#searchByDoctor').val()
            // ).draw();
         // }         
         // if($('#searchByName').val() != ""){
           // theGrid.column(3).search(
                // $('#searchByName').val()
            // ).draw();
         // }
         //if($('#searchByUrl').val() == "" && $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == ""){
         if($('#searchByUrl').val() == ""){
            theGrid.column(1).search('');
            // theGrid.column(2).search('');
            // theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }
    </script>

   
@endsection