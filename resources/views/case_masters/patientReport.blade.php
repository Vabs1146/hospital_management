@extends('adminlayouts.master')
@section('style')

<link href="{{ asset('css/dataTables.checkboxes.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Patient Search</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                 <div class="col-md-12">
                                   <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="searchByDoctor" name="searchByDoctor" class="form-control" />
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            From Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="fromDate" name="fromDate" autocomplete="off"  class="form-control datepicker"/> 
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           To Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="ToDate" name="ToDate"  autocomplete="off" class="form-control datepicker"/>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <button id="search" onclick="return searchPatient()" class="btn btn-default btn-lg"> Search </button>
                                    </div>
                                  </div>
                              </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-pink">
                            <h2> List of Patients</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                               <div class="table-responsive">
                              <table class="table table-striped table-bordered" id="thegrid">
              <thead>
                <tr>
                    <th></th>
                    <th class="never">ID</th>
                    <th>Patient Number</th>
                    <th>UHID</th>
                    <th>First Time Date</th>
                    <th>Followup Date</th>
                    <th>Doctor</th>
                    <th>Referred By</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Contact No.</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
                                </div>
                                <br>
                                 <div class="col-sm-9">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea type="text" name="messageBody" cols="90" rows="" id="messageBody" class="form-control"> </textarea>
                                        </div>
                                        <br>
                                        <a href="#" class="btn btn-primary btn-lg" role="button" id="sendMessage"   data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Send Message</a>
                                        
                                    </div>
                                    
                                </div>

                                <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
                            

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    
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
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": { "url" : "{{url('/patient/report/grid')}}", 'type':'POST', data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token')}},
                "order": [[ 1, "desc" ]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": true,
                        "searchable": false,
                        "sortable": false,
                        //"class":"never",
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    {
                        "targets": 1,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'">'+data+'</a>';
                        },
                        "targets": 2
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

            $('.datepicker').datepicker({
                format: "dd/M/yyyy",
                weekStart: 1,
                clearBtn: true,
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
            });

            $("#sendMessage").on('click', function () {
                var rows_selected = theGrid.column(0).checkboxes.selected();
                var messageBody = $.trim($("#messageBody").val());
                if (rows_selected.length > 0 && messageBody != "") {
                    $("#sendMessage").button('loading');
                    $.ajax({
                        url: '{{ url('/bulk_sms/sendPatientReportSms') }}',
                        type: 'POST',
                        data: {
                            _method: 'POST',
                            _token: $("#hdnCsrfToken").data('token'),
                            'case_master_Id': $.makeArray(rows_selected),
                            'messageBody': messageBody
                        }
                    }).success(function (data) {
                        $("#messageBody").val('')
                        //theGrid.ajax.reload();
                        theGrid.column(0).checkboxes.deselectAll()
                        $("#sendMessage").button('reset');
                        alert('Message send successfully');
                    }).error(function(errmessage){
                        alert(errmessage);
                    });
                }
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

        function searchPatient(){
         
         if($('#searchByDoctor').val() != ""){
			 /*
           theGrid.column(1).search(
                $('#searchByDoctor').val()
            ).draw();*/

			theGrid.column(1).search($('#searchByDoctor').val());
         }
         if($('#fromDate').val() != ""){
            /*theGrid.column(2).search(
                $('#fromDate').val()
            ).draw();*/

			theGrid.column(2).search($('#fromDate').val());
         }
         if($('#ToDate').val() != ""){
          /* theGrid.column(3).search(
                $('#ToDate').val()
            ).draw();*/

			theGrid.column(3).search($('#ToDate').val());
         }
         if($('#ToDate').val() == "" && $('#fromDate').val() == "" && $('#searchByDoctor').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            //theGrid.ajax.reload();
         }

		 theGrid.ajax.reload();
        return false;
        }
    </script>
@endsection