@extends('adminlayouts.master')
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp

<style>
.fc-time-grid-event.fc-event.fc-start.fc-end fc-short {
	height:fit-content !important;
}

.fc-time-grid-event.fc-event.fc-start.fc-end.fc-short {
	height:fit-content !important;
}

</style>
<div class="container-fluid">
            <div class="row clearfix">
                <form class="form-inline" action="{{ url('/doctorbill/BillReport/printReport') }}" method="POST" target="_blank">
    {!! Form::token() !!}
					
            <div class="col-md-8" style="margin-bottom: 10px">
            <div class="col-md-2">
          <div class="block-header">
                <h2>
                    Doctor Name:
                </h2>
            </div>
            </div>
            <div class="col-md-4">
               {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, $selecteddoc, array('class' => 'form-control', 'required','data-live-search'=>'true' )) }}
            </div>
            
            </form>
				
				
					</div>
				 <div class="col-md-3">
				  @if($permissions['1_appointmentlist/0']->add_permission || AUTH::user()->role == 1)
               <a href="{{ url('/appointment/') }}"><button class="btn btn-primary btn-lg">Add new appointment</button></a>
			   @endif
            </div>
            </div>
                    
         
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body" id="calendar_div">
                          {!! $calendar->calendar() !!}

                     {!! $calendar->script() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Input -->
            <!-- Textarea -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Appointment List</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                           <input type="text" class="form-control" placeholder="Patient Name" name="doctor_name" id="doctor_name" value="{{old('doctor_name')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Doctor" name="doctorDegree" id="doctorDegree" value="{{old('doctorDegree')}}">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Date" name="doctorDegree" id="doctorDegree" value="{{old('doctorDegree')}}">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        
                                        <button type="button" class="btn btn-default waves-effect">Search</button>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>Appointment List</h2>
                        </div>
                        <div class="body">
                 
                               <div class="table-responsive">
                             <table class="table table-striped table-hover table-bordered" id="theMorningGrid">
                                  <thead>
                                    <tr>    
                                        <th></th>
                                       <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                          <th>Mobile</th>  
                                           <th>Date</th>                                       
                                        <th>Time</th>
                                        <th>Action</th>
                                        <th>Patient Details</th>
                                        {{-- <th style="width:50px"></th> --}}
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                                </div>
                           
                        </div>
                        <div class="panel-footer">
                        @if($commonHelper->checkUserAccess("1_appointmentlist/0", Auth::user()->id, 'add_permission') == 1 || $commonHelper->checkUserAccess("1_appointmentlist/0", Auth::user()->id, 'edit_permission') == 1 || AUTH::user()->role == 1)
                             <div class="form-group" style="width: 70% !important;">
                                        <div class="form-line">
                                            <textarea rows="3" class="form-control addborder no-resize" name="messageBody" id="messageBody" cols="50"></textarea>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-lg" role="button" id="sendMessage"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing.." style="margin-left: 10px; margin-top: 10px">Send Message</a>
                                        
                                    </div>

@endif
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
        var theGrid = null,theMorningGrid = null;
        $(document).ready(function(){

                theMorningGrid = $('#theMorningGrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "order": [[ 5, "desc" ]],
                "ajax": "{{url('appointment/grid/Morning')}}/"+{{$selecteddoc}},
                "columnDefs": [
                     {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "sortable": false,
                        //"class":"never",
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    {
                        "render": function ( data, type, row ) {

                      if(row[6]!=1)
                            {
                            return '<a href="{{ url('/appointment/') }}/'+row[0]+'" class="btn btn-default">Deny Appointment</a><a href="{{ url('/edit-appointment/') }}/'+row[0]+'" class="btn btn-default">Edit Appointment</a>';
                            }
                            else
                            {
                              return ' -';   
                            }  

                           
                        },
                        "targets": 6
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/aptpatientDetails/') }}/'+row[0]+'" class="btn btn-default">Patient Details</a>';
                        },
                        "targets": 7
                    }
                ],
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    {
                        extend: 'pdfHtml5',
                        title: 'Data export'
                    }
                ]
            });   


   $('select').on('change', function (e) {
           var optionSelected = $("option:selected", this);
    var doctor_id = this.value;
    var url1="{{url('appointmentlist')}}/"+doctor_id;
   
          
            

       window.location.replace(url1);

    });


      $("#sendMessage").on('click', function () {
                var rows_selected = theMorningGrid.column(0).checkboxes.selected();
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
                        theMorningGrid.column(0).checkboxes.deselectAll()
                        $("#sendMessage").button('reset');
                        alert('Message send successfully');
                    }).error(function(errmessage){
                        alert(errmessage);
                    });
                }
            });

           
         
            $("#addAppointment").click(function(){
                $("#createAppointment").trigger("reset");
                $("#appointment_dt").val(moment().format('DD/MMM/YYYY'));
                $("#dateSelected").text(moment().format('DD/MMM/YYYY'));
                $(".print-error-msg").removeClass('alert-danger').removeClass('alert-success').css('display','none');
                $("#myModal").modal();
            });

            $("#createAppointment").submit(function(e){
                e.preventDefault();
                //$("#submitBtn").attr('disabled', 'disabled').addClass('disabled');
                $("#submitBtn").button('loading');
                var csrf_token = $("#hdnCsrfToken").data('token')
                $.ajax({
                        url: '{{ url('/appointment') }}' ,
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: $(this).serialize()+"&_token=" + csrf_token,
                        success: function(data, textStatus, jQxhr){
                            data = JSON.parse(data);
                            if($.isEmptyObject(data.error)){
                                $(".print-error-msg").removeClass('alert-danger').addClass('alert-success').css('display','block').find("ul").html('');
                                $(".print-error-msg").find("ul").append('<li>'+data.success+'</li>');
                                //$("#"+calendarId).fullCalendar('renderEvent', {"id":null,"title":"Token Number : "+ data.tokenNumber,"allDay":true,"start":$("#appointment_dt").val(),"end":$("#appointment_dt").val(),"color":"green","editable":false});
                                theGrid.ajax.reload();
                                theMorningGrid.ajax.reload();
                            }else{
                                printErrorMsg(data.error);
                            }
                            //$("#submitBtn").removeAttr('disabled').removeClass('disabled');                    
                            $("#submitBtn").button('reset');
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                            //$("#submitBtn").removeAttr('disabled').removeClass('disabled');
                            $("#submitBtn").button('reset');
                        }
                    });
                return false;
            });

            
            $('.datepicker').datepicker({
                format: "dd/M/yyyy",
                weekStart: 1,
                clearBtn: true,
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
            });

        });//End of document ready

        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").addClass('alert-danger').css('display','block');        
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient() {
            if ($('#searchByDoctor').val() != "") {
                theGrid.column(1).search(
                    $('#searchByDoctor').val()
                ).draw();
                theMorningGrid.column(1).search(
                    $('#searchByDoctor').val()
                ).draw();
            }
            if ($('#searchByName').val() != "") {
                theGrid.column(2).search(
                    $('#searchByName').val()
                ).draw();
                theMorningGrid.column(2).search(
                    $('#searchByName').val()
                ).draw();
            }
            if ($('#DateFltr').val() != "") {
                theGrid.column(3).search(
                    $('#DateFltr').val()
                ).draw();
                theMorningGrid.column(3).search(
                    $('#DateFltr').val()
                ).draw();
            }


            if ($('#searchByName').val() == "" && $('#searchByDoctor').val() == "" && $('#DateFltr').val() == "") {
                theGrid.column(1).search('');
                theGrid.column(2).search('');
                theGrid.column(3).search('');
                theGrid.ajax.reload();

                theMorningGrid.column(1).search('');
                theMorningGrid.column(2).search('');
                theMorningGrid.column(3).search('');
                theMorningGrid.ajax.reload();
            }
            return false;
        }
    </script>
<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
@endsection


  