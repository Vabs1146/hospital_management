
@extends('shared/layoutCaremed')
@section('pageheader')
<link rel="stylesheet" type="text/css" href="{{asset('caremed/styles/about.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('caremed/styles/about_responsive.css')}}">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection
@section('pagebody')
<div class="super_container">
    <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll"
            data-image-src="{{ asset('caremed/images/about.jpg')}}" data-speed="0.8"></div>
        <div class="home_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title"> Appointment <span></span></div>
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="#">Images</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container">
                <form class="form-horizontal" name="createAppointment" id="createAppointment" action="#" autocomplete="off">
                        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
                        <div class="modal-header">
                            <h4 class="modal-title">Create appointment</h4>
                        </div>
                        <div class="modal-body">
        
                            <div class="form-group">
                                <label class="control-label col-sm-2" for=""></label>
                                <div class="col-sm-10">
                                    <span id="submitMessage"></span>
                                    <div class="alert print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-4  col-md-offset-4" >
                                    <input type="radio" name="existing_patient" value="existing" class="" id="existing_patient">
                                    <label for="existing_patient">Existing Patient</label>
                                </div>
                                <div class="col-md-4" >
                                    <input type="radio" name="existing_patient" value="new" class="" id="new_patient" checked="checked">
                                    <label for="new_patient">New Patient</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Name:</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="mobile_no">Mobile No:</label>
                                <div class="col-sm-10"> 
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Enter Mobile No." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="doctor_id">Doctor:</label>
                                <div class="col-sm-10"> 
                                    {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, Request::old('doctor_id'), array('class' => 'form-control', 'required')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="doctor_id">Appointment Date:</label>
                                <div class="col-sm-10"> 
                                    <input type="text" class="datepicker form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date." required>
                                </div>
                            </div>

                           <!--  <div class="form-group"> 
                               <div class="col-sm-offset-2 col-sm-10">
                               <div class="checkbox">
                                   <label><input type="radio" name="morningEvening" id="morningEvening" value="Morning" required /> Morning </label>
                                   <label><input type="radio" name="morningEvening" id="morningEvening" value="Evening" required /> Evening </label>
                                   {{-- <input type="hidden" name="appointment_dt" id="appointment_dt" /> --}}
                               </div>
                               </div>
                           </div> -->
                           <div class="form-group"> 
                        <label class="control-label col-sm-2">Time Slot1:</label>
                        <div class="col-sm-offset-2 col-sm-10">
                   
                       <?php 
                            foreach($timeslot as $timeslots){
                        ?>
                          <div class="col-xs-3">
                               <label><input type="radio" name="morningEvening" id="morningEvening" value="{{  $timeslots->starttime }}" required>&nbsp;{{  $timeslots->starttime }}</label>
                                <!--<input type="hidden" name="appointment_dt" id="appointment_dt" /> -->
                           </div>
                           

                        <?php } ?>   



                        </div>
                    </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                            <a href="{{ url('/') }}" class="btn btn-default" > Home </a>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
@section('footescripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

<script>    
        function dayClickEvent(date, jsEvent, view) {
                //alert('Clicked on: ' + date.format());
                const today = moment().format('YYYY-MM-DD');
                const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
                if (date.format('YYYY-MM-DD') > endOfMonth){       
                        return false;
                }
                if (date.format('YYYY-MM-DD') < today){
                        return false;
                }
                //$("#createAppointment").reset();
                $("#createAppointment").trigger("reset");
                $("#appointment_dt").val(date.format('DD/MMM/YYYY'));
                $("#dateSelected").text(date.format('DD/MMM/YYYY'));
                $(".print-error-msg").removeClass('alert-danger').removeClass('alert-success').css('display','none');
                $("#myModal").modal();
            //alert(redirectUrl);
            //window.location.href = redirectUrl;
            //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        
            //alert('Current view: ' + view.name);
        
            // change the day's background color just for fun
            //$(this).css('background-color', 'red');
        }
        
        function dayRenderEvent(date, cell){
            const startOfMonth = moment().startOf('month').format('YYYY-MM-DD hh:mm');
            const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD hh:mm');
            console.log((date.format('YYYY-MM-DD hh:mm') > endOfMonth));
            console.log(date.format('YYYY-MM-DD hh:mm'));
            console.log(endOfMonth);
            if (date.format('YYYY-MM-DD hh:mm') > endOfMonth){
                    $(cell).addClass('disabled');
                    console.log('disabled');
            }
            if (date.format('YYYY-MM-DD hh:mm') < startOfMonth){
                    $(cell).addClass('disabled');
            }
        }
        
        $(document).ready(function(){
            
            //{{-- var calendarId = 'calendar-{!! $calendar->getId() !!}' --}}
            $('.datepicker').datepicker({
                format: "dd/M/yyyy",
                weekStart: 1,
                clearBtn: true,
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
                todayHighlight: true,
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
                                $("#createAppointment").trigger("reset");
                                $(".print-error-msg").removeClass('alert-danger').addClass('alert-success').css('display','block').find("ul").html('');
                                $(".print-error-msg").find("ul").append('<li>'+data.success+'</li>');
                                // $("#"+calendarId).fullCalendar('renderEvent', {"id":null,"title":"Token Number : "+ data.tokenNumber,"allDay":true,"start":$("#appointment_dt").val(),"end":$("#appointment_dt").val(),"color":"green","editable":false});
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
        });
        
            function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").addClass('alert-danger').css('display','block');        
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }
        
        </script>

@endsection