@extends('adminlayouts.master')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <form class="form-inline" action="{{ url('/doctorbill/BillReport/printReport') }}" method="POST" target="_blank">
    {!! Form::token() !!}
            <div class="col-md-9" style="margin-bottom: 10px">
            <div class="col-md-2">
          <div class="block-header">
                <h2>
                    Doctor Name :
                </h2>
            </div>
            </div>
            <div class="col-md-6">
               {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, $selecteddoc, array('class' => 'form-control', 'required','data-live-search'=>'true','id'=>'doctor_id' )) }}
            </div>
            </div>
            </form>
            </div>
                    
         
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
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
                        <div class="header bg-custom">
                            <h2>Follow up Appointment</h2>
                        </div>
                        <div class="body">
                 
                               <div class="table-responsive">
                             <table class="table table-striped table-hover table-bordered" id="thegrid">
                                  <thead>
                                    <tr>    
                                       <th></th>
                                        <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                        <th>Patient Mobile</th>    
                                        <th>Followup Date</th>  
                                        <th>Visit Time</th>
                                        <th>Action</th>
                                        <th>Patient Details</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                                </div>
                           
                        </div>
                        <div class="panel-footer">
                        @if($commonHelper->checkUserAccess("1_followupappoinment/0", Auth::user()->id, 'add_permission') == 1 || AUTH::user()->role == 1)
                        <a href="#" class="btn btn-primary" name="addAppointment" id="addAppointment" role="button" style="margin-bottom: 10px">Add Appointment</a>

                        @endif

 @if($commonHelper->checkUserAccess("1_followupappoinment/0", Auth::user()->id, 'add_permission') == 1 || $commonHelper->checkUserAccess("1_followupappoinment/0", Auth::user()->id, 'edit_permission') == 1 || AUTH::user()->role == 1)
                        <div class="form-group" style="width: 70% !important;">
                                        <div class="form-line">
                                            <textarea rows="3" class="form-control addborder no-resize" name="messageBody" id="messageBody" cols="50"></textarea>
                                        </div>
                                        <a href="#" class="btn btn-primary" role="button" id="sendMessage"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing.." style="margin-left: 10px; margin-top: 10px">Send Message</a>
                                        
                                    </div>


                                    @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
 <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
            <!-- Modal content-->
        <div class="modal-content">       
            <form class="form-horizontal" name="createAppointment" id="createAppointment" action="#">
                <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
                <div class="modal-header bg-custom">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create appointment (date : <spam id="dateSelected"></spam>) </h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for=""></label>
                        <div class="col-sm-10">
                             <input type="hidden" name="appointment_dt" id="appointment_dt" />
                            <span id="submitMessage"></span>
                            <div class="alert print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group labelgrp">
                            <label for="name" class="form-control">Name :</label>
                            </div>
                        </div>
                        
                        <div class="col-md-9">
                            <div class="form-group">
                            <div class="form-line">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group labelgrp">
                            <label for="mobile_no" class="form-control">Mobile No :</label>
                            </div>
                        </div>
                        
                        <div class="col-md-9">
                            <div class="form-group">
                            <div class="form-line">
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No." required>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group labelgrp">
                            <label for="doctor_id" class="form-control">Doctor:</label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, $selecteddoc, array('class' => 'form-control', 'required' ,'data-live-search'=>'true','id'=>'doc_id')) }}
                              <input type="hidden" name="morningEvening" value=" ">
                              </div>
                        </div>
                       
                    </div>

                       <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group labelgrp">
                            <label for="doctor_id" class="form-control">Follow up Time Slot:</label>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="FollowUpTimeSlot"></div>
                            <div id="Morning" class="align-items-center" style="display: none;margin-bottom: 5px;"><b>Morning Slot</b></div>

                            <label for="basic_checkbox_2"></label>
                            
                        <div id="appdate"></div>
                        </div>


                         <div class="col-md-9 col-sm-offset-3">
                            <div id="Afternoon" class="align-items-center" style="display: none;margin-bottom: 5px;"><b>Afternoon Slot</b></div>

                            <label for="basic_checkbox_2"></label>
                            
                        <div id="appdate2"></div>
                        </div>


                         <div class="col-md-9 col-sm-offset-3">
                            <div id="Evening" class="align-items-center" style="display: none;margin-bottom: 5px;"><b>Evening Slot</b></div>

                            <label for="basic_checkbox_2"></label>
                            
                        <div id="appdate1"></div>
                        </div>
                       
                    </div>
                  
                
                </div>
                <br>
                <div class="modal-footer">
                    <button type="submit" style="margin-top: 3%; " class="btn btn-primary btn-lg" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                    <button type="button" style="margin-top: 3%;" class="btn btn-primary btn-lg" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
 <script src="{{ url('/')}}/assets/js/dataTables.checkboxes.min.js"></script>
 <script type="text/javascript">

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
    <script type="text/javascript">
        var theGrid = null,theMorningGrid = null;
        $(document).ready(function(){


            
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "order": [[ 5, "desc" ]],
                "ajax": "{{url('followpappointment/grid/Evening')}}/"+{{$selecteddoc}},
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
                            return '<a href="{{ url('/followupacceptdenyappointment/') }}/'+row[0]+'" class="btn btn-default">Deny Appointment</a>';
                        },
                        "targets": 6
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/followuppatientDetails/') }}/'+row[0]+'" class="btn btn-default">Patient Details</a>';
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

              $('#doctor_id').on('change', function (e) {
           var optionSelected = $("option:selected", this);
    var doctor_id = this.value;
    var url1="{{url('followupappoinment')}}/"+doctor_id;
   
          
            

       window.location.replace(url1);

    });


$(document).ready(function () {
     
 
  $('#doc_id').on('change', function (e) {

           $("#appdate2").empty();
        $("#appdate1").empty();
         $("#Morning").css("display","none");
        $("#Afternoon").css("display","none");
        $("#Evening").css("display","none");
        
        $("#FollowUpTimeSlot").empty();
        //alert(this.value);         //Date in full format alert(new Date(this.value));
        var inputDate = new Date(this.value);
        var FollowUpDoctor_id = $("#doc_id").val();
       

        var appointment_dt = $('#appointment_dt').val();
       //alert(appointment_dt);
        
        var url1="{{url('avaibaletimeslotscasemaster')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
        //alert(url1);
    

        $.ajax({
            url:url1,
           
            type:'GET',
            success:function(response) {
                //alert(response);
        
             if(response==0)
                 {
                    $("#FollowUpTimeSlot").append('<h5> <input type="hidden" name="morningEvening" value=" ">No Slots Available</h5>');
               
                 }

                    else
                 {
                 
                       for(var i=0;i<response['slottime'].length;i++){
                    var slotime= response['slottime'][i];
                     var starttime= response['timeslot1'][i];
                  
                    if(slotime=="Morning")
                    {
                        
                        $("#Morning").css("display","block");
 $('<div class="col-md-4"><input name="morningEvening" value="'+starttime+'" type="radio" id="radio_'+(i+1)+'" class="with-gap radio-col-red" checked /><label for="radio_'+(i+1)+'">&nbsp;'+starttime+'</label></div>').appendTo($("#appdate")); 
                    }

                         else if(slotime=="Afternoon")
                 {
                     $("#Afternoon").css("display","block");
 $('<div class="col-md-4"><input name="morningEvening" value="'+starttime+'" type="radio" id="radio_'+(i+1)+'" class="with-gap radio-col-red" checked /><label for="radio_'+(i+1)+'">&nbsp;'+starttime+'</label></div>').appendTo($("#appdate2")); 
                 }
                 

                 else if(slotime=="Evening")
                 {
                     $("#Evening").css("display","block");
 $('<div class="col-md-4"><input name="morningEvening" value="'+starttime+'" type="radio" id="radio_'+(i+1)+'" class="with-gap radio-col-red" checked /><label for="radio_'+(i+1)+'">&nbsp;'+starttime+'</label></div>').appendTo($("#appdate1")); 
                 }

                    
               
            }
   

                 }
              }
        }); 



    });
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
               
            $("#addAppointment").click(function(){
                $("#createAppointment").trigger("reset");
                $("#appointment_dt").val(moment().format('YYYY-MM-DD'));
                $("#dateSelected").text(moment().format('YYYY-MM-DD'));
                $(".print-error-msg").removeClass('alert-danger').removeClass('alert-success').css('display','none');
                $("#myModal").modal();
            });

            $("#createAppointment").submit(function(e){
                e.preventDefault();
                //$("#submitBtn").attr('disabled', 'disabled').addClass('disabled');
                $("#submitBtn").button('loading');
                var csrf_token = $("#hdnCsrfToken").data('token')
                $.ajax({
                        url: '{{ url('/store') }}' ,
                        dataType: 'text',
                        type: 'post',
                        contentType: 'application/x-www-form-urlencoded',
                        data: $(this).serialize()+"&_token=" + csrf_token,
                        success: function(data, textStatus, jQxhr){
                            data = JSON.parse(data);
                            if($.isEmptyObject(data.error)){
                                $(".print-error-msg").removeClass('alert-danger').addClass('alert-success').css('display','block').find("ul").html('');
                                $(".print-error-msg").find("ul").append('<li>'+data.success+'</li>');
                                
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

            
           // $('.datepicker').datepicker({
              //  format: "dd/M/yyyy",
              //  weekStart: 1,
               // clearBtn: true,
               // daysOfWeekHighlighted: "0,6",
               // autoclose: true,
           // });

        });//End of document ready

         
        $('#myModal').on('hidden.bs.modal', function () {
           $("#FollowUpTimeSlot").load(" #FollowUpTimeSlot");
         location.reload();
        });
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