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
                        <div class="header">
                            <h2>Patient Search Case</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                                   <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Patient Number :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByNumber" name="searchByNumber">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Patient Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByDoctor" name="searchByDoctor">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="button" onclick="return searchPatient()" class="btn btn-default waves-effect">Search</button></div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
           
                    
         
         
            <!-- #END# Input -->
            <!-- Textarea -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>Old registry</h2>
                        </div>
                        <div class="body">
                         <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hovver" id="thegrid">
                         <thead>
                        <tr>
                            <th></th>
                            <th>Patient IPD No</th>
                            <th>Patient Name</th>
                            <th>Patient Address</th>
                            <th>Date of Admission</th>
                            <th>Date of Discharge</th>
                            <th>Mobile no</th>
                            <th>Consulting doctor</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                                </div>
                                <br>
<div class="row clearfix">
                                 <div class="col-sm-9">
                                    <a href="{{url('oldregister/create')}}" class="btn btn-primary btn-lg" role="button">Add New</a>
                    <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}" />
                                            <br><br>
                                    <div class="form-group">

                                        <div class="form-line">
                                            <textarea rows="3" class="form-control addborder no-resize" name="messageBody" id="messageBody" cols="90"></textarea>
                                        </div>
                                        <br>
                                       <a href="#" class="btn btn-primary btn-lg" role="button" id="sendMessage" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Send Message</a>
                                        
                                    </div>
                                    
                                </div>
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
                "ajax": { "url" : "{{url('oldregister/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "columnDefs": [
                    {
                        "targets": 0,
                        //"visible": false,
                        "searchable": false,
                        "sortable": false,
                        //"class":"never",
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/oldregister/') }}/'+row[0]+'/edit" class="btn btn-primary btn-lg">Add/Edit</a>';
                        },
                        "sortable": false,
                        "targets": 8                    
                    }
                    ,
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger btn-lg">Delete</a>';
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
            $("#sendMessage").on('click', function () {
                var rows_selected = theGrid.column(0).checkboxes.selected();
                var messageBody = $.trim($("#messageBody").val());
                if (rows_selected.length > 0 && messageBody != "") {
                    $("#sendMessage").button('loading');
                    $.ajax({
                        url: '{{ url('/bulk_sms/sendOldRegisterSms') }}',
                        type: 'POST',
                        data: {
                            _method: 'POST',
                            _token: $("#hdnCsrfToken").data('token'),
                            'oldRegisterId': $.makeArray(rows_selected),
                            'messageBody': messageBody
                        }
                    }).success(function (data) {
                        $("#messageBody").val('')
                        //theGrid.ajax.reload();
                        theGrid.column(0).checkboxes.deselectAll()
                        $("#sendMessage").button('reset');
                        alert('Message send successfully');
                    }).error(function(errmessage){
                        
                    });
                }
            });

        });

        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/oldregister/delete') }}/' + id, 
               type: 'DELETE',
               data: {_method: 'delete', _token :$("#hdnCsrfToken").data('token')}
               }).success(function() {
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