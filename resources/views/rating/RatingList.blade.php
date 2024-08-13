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
       
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>Approve Reject Feedback</h2>
                        </div>
                        <div class="body">
                         <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="thegrid" data-stripe-classes="[]">
                               <thead>
                                 <tr>
                                     <th class="never">ID</th>                   
                                     <th>Name</th>                 
                                     <th>Mobile</th>                  
                                     <th>Feedback</th>
                                     <th>Rating</th>
                                     <th></th>
                                     <th></th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                           </table>
                                </div>
                                <br>

                                 <div class="col-sm-9">
                                    <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
                                            
                                    
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
            
        </div>


   


   

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

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
                "ajax": { "url" : "{{url('rating/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
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
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="{{ url('/ApproveRejectRating') }}/'+row[0]+'"><i class="fa fa-edit" aria-hidden="true"></i>Approve/Reject</a>';
                        },
                        "sortable": false,
                        //"targets": 3
                        "targets": 5
                    },
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            return '<a href="#" onclick="return doDelete('+row[0]+')"><i class="fa fa-times" aria-hidden="true"></i>Delete</a>';
                        },
                        "sortable": false,
                        //"targets": 4,
                        "targets": 6,
                        "visible": true,
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
        });
		
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/delete-rating') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
					//theGrid.ajax.reload();
					
					location.reload();
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