@extends('adminlayouts.master')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <form class="form-inline" action="{{ url('/doctorbill/BillReport/printReport') }}" method="POST" target="_blank">
    {!! Form::token() !!}
    <div class="form-group" style="margin-top: 10px;">

        <lable for="doctorName"><h5> Doctor Names :</h5> </lable> 
        {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, $selecteddoc, array('class' => 'form-control', 'required' )) }}
<!-- Request::old('doctor_id') -->
    </div>
  
</form>
          </div>
      </div>

       <div class="row mb-2">
          <div class="col-sm-12">
            <div class="panel panel-default">
               <!--  <div class="panel-heading">Full Calendar Example</div> -->

                <div class="panel-body" >
                     {!! $calendar->calendar() !!}

                     {!! $calendar->script() !!}
                </div>
            </div>
         </div>
      </div>
  </div>
</section>



    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Appointment doctorList</h1>
            <hr>
          </div>
       
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
    </div>
       
        </div>

        <div class="row mb-2">
          <div class="col-sm-12">
<form class="form-inline">
    {!! Form::token() !!}
    <div class="form-group">
     <lable for="doctorName"> Patient Name: </lable> 
    <input type="text" id="searchByName" name="searchByName" class="form-control myinput" /> 
    </div>

    <div class="form-group">
    <lable for="fromDate">  Doctor : </label>
          <input type="text" id="searchByDoctor"  name="searchByDoctor "  class="form-control myinput" /> 
            </div>

            <div class="form-group">
       <lable for="ToDate">  Date : </label>
       <input type="text" id="DateFltr" name="DateFltr" class="form-control datepicker myinput"/>  
            </div>

          <div class="form-group">
          <button id="search" onclick="return searchPatient()" class="btn btn-default mybtn"> Search </button>
          </div>
        </form>
   
          </div>
       
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Appointment1</h3>
              </div>
                <div class="card-body">
           <div class="table-responsive">
       <table class="table table-striped" id="theMorningGrid">
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
               <br />
        <div class="form-inline">
            <div class="form-group">
                <textarea type="text" name="messageBody"     rows="" id="messageBody" class="form-control"> </textarea>
                <a href="#" class="btn btn-primary" role="button" id="sendMessage"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing.." style="margin-left: 10px;">Send Message</a>
            </div>
        </div>

        
           
            </div>



            </div>
          </div>
        </div>
    
    </section>
  </form>
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

                         if(row[6]!=1)   
                         {
                              return '<a href="{{ url('/appointment/') }}/'+row[6]+'" class="btn btn-default">Accept/Deny</a>'; 
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
@endsection