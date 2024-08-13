<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Create Appointment</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <!-- Bootstrap Core Css -->
        <link href="{{ url('/')}}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="{{ url('/')}}/assets/plugins/node-waves/waves.css" rel="stylesheet" />
        <!-- Animation Css -->
        <link href="{{ url('/')}}/assets/plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- Bootstrap Material Datetime Picker Css -->
        <link href="{{ url('/')}}/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
        <!-- Bootstrap DatePicker Css -->
        <link href="{{ url('/')}}/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
        <!-- Wait Me Css -->
        <link href="{{ url('/')}}/assets/plugins/waitme/waitMe.css" rel="stylesheet" />
        <!-- Bootstrap Select Css -->
        <link href="{{ url('/')}}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
        <!-- Custom Css -->
        <link href="{{ url('/')}}/assets/css/style.css" rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{ url('/')}}/assets/css/themes/all-themes.css" rel="stylesheet" />
        <link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
        <style type="text/css">
            .scroll
            {
                overflow-y: scroll;
                height: 344px;
            }
            .noscroll
            {
                height: 344px;
            }
            @media screen and (max-width: 767px) {
                .select2 {
                    width: 100% !important;
                }
            }
            @media screen and (max-width: 600px) {
                .seccontent
                {
                    margin: 0px 0px 0 0px !important;
                    -moz-transition: 0.5s;
                    -o-transition: 0.5s;
                    -webkit-transition: 0.5s;
                    transition: 0.5s; 
                }
                .labelgrp
                {
                    text-align: left !important;
                }
                .labelgrp label {
                    font-size: 10px !important;
                }
                .card .body .col-xs-3, .card .body .col-sm-3, .card .body .col-md-3, .card .body .col-lg-3
                {
                    margin-bottom: 0px !important;
                }
                .card .body .col-xs-8, .card .body .col-sm-8, .card .body .col-md-8, .card .body .col-lg-8
                {
                    margin-bottom: 0px !important;  
                }
            }
        </style>
    </head>
    <body class="theme-red">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <section class="seccontent">
            <div class="container-fluid">
                <div class="row clearfix">
                    <form class="form-horizontal" name="createAppointment" id="createAppointment" action="#" autocomplete="off">
                        <!--   <form class="form-horizontal" method="post" action="{{ route('appointment.store') }}"> -->
                        <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}" value="{{ csrf_token() }}">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header bg-pink">
                                    <h2>Create Appointment </h2>
                                </div>
                                <div class="body">
                                    <div class="alert print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="row col-md-12" style="display:none;">
                                            <div class="col-md-4  col-md-offset-4" >
                                                <input type="radio" name="existing_patient" value="existing" class="" id="existing_patient" >
                                                <label for="existing_patient">Existing Patient</label>
                                            </div>
                                            <div class="col-md-4" >
                                                <input type="radio" name="existing_patient" value="new" class="" id="new_patient" checked="checked">
                                                <label for="new_patient">New Patient</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group labelgrp">
                                                    <label for="name" class="form-control">Name :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group labelgrp">
                                                    <label for="mobile_no" class="form-control">Mobile No :</label>              
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group labelgrp">
                                                    <label for="doctor_id" class="form-control">Doctor :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select name="doctor_id" id="doctor_id" class="form-control select2" placeholder="select your doctor" data-live-search="true">
                                                        <?php 
                                                            foreach($doctorlist11 as $doclist){
                                                            ?>
                                                        <option value="{{ $doclist->id }}">{{ $doclist->doctor_name }}</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group labelgrp">
                                                    <label class="form-control">Appointment Date :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::text('appointment_dt', Request::old('appointment_dt'), array('class'=> 'form-control datepicker','id'=>'appointment_dt')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-8">
                                            <span style="color:red";>Due to COVID-19 Pandemic, please call to confirm your appointment</span>
                                        </div>
                                        <!-- <div class="col-md-12">
                                            <div class="col-md-3">
                                                  <div class="form-group labelgrp">
                                               <label class="form-control">Time Slot :</label>
                                                  </div>
                                              </div>
                                              <div class="col-md-8" style="display: none;" id="slodrec">
                                                <div class="form-group">
                                               <div class="col-md-12" >
                                                  <div class="col-md-4">
                                                  <div id="Morning" class="align-items-center" style="display: none;"><b>Morning Slot</b></div>
                                                  </div>
                                                  </div>
                                                  <div class="col-md-12" id="MorningSlots">
                                                  <div id="appdate"></div>
                                                  </div>
                                                  <div class="col-md-12">
                                                  <div class="col-md-4">
                                                  <div id="Afternoon" style="display: none;"><b>Afternoon Slot</b>
                                                  </div>
                                                  </div>
                                                  </div>
                                                  <div class="col-md-12" id="AfternoonSlots">
                                                  <div id="appdate2"></div>
                                                  </div>
                                                  <div class="col-md-12">
                                                  <div class="col-md-4">
                                                  <div id="Evening" style="display: none;"><b>Evening Slot</b></div>
                                                  </div>
                                                  </div>
                                                  <div class="col-md-12" id="EveningSlots">
                                                  <div id="appdate1"></div>
                                                  </div>
                                                  </div>
                                                  </div>
                                              </div> -->
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="submit" class="btn btn-default" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                                    <a href="{{ url('/') }}" class="btn btn-default" > Home </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" id="slotdiv">
                            <div class="card">
                                <div class="header bg-pink">
                                    <h2>Time Slots for Appoinment </h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-12" id="slotsrec">
                                            <div class="col-md-12" style="display: none;" id="slodrec">
                                                <div class="form-group">
                                                    <div class="col-md-12" >
                                                        <div class="" id="noslot"></div>
                                                        <div class="col-md-6">
                                                            <div id="Morning" class="align-items-center" style="display: none;">
                                                                <b>Morning Slot</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="MorningSlots">
                                                        <div id="appdate"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div id="Afternoon" style="display: none;">
                                                                <b>Afternoon Slot</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="AfternoonSlots">
                                                        <div id="appdate2"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div id="Evening" style="display: none;">
                                                                <b>Evening Slot</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="EveningSlots">
                                                        <div id="appdate1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section>
        <!-- Jquery Core Js -->
        <script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap Core Js -->
        <script src="{{ url('/')}}/assets/plugins/bootstrap/js/bootstrap.js"></script>
        <!-- Select Plugin Js -->
        <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
        <!-- Slimscroll Plugin Js -->
        <script src="{{ url('/')}}/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <!-- Waves Effect Plugin Js -->
        <script src="{{ url('/')}}/assets/plugins/node-waves/waves.js"></script>
        <!-- Autosize Plugin Js -->
        <script src="{{ url('/')}}/assets/plugins/autosize/autosize.js"></script>
        <!-- Moment Plugin Js -->
        <script src="{{ url('/')}}/assets/plugins/momentjs/moment.js"></script>
        <!-- Bootstrap Material Datetime Picker Plugin Js -->
        <script src="{{ url('/')}}/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!-- Bootstrap Datepicker Plugin Js -->
        <script src="{{ url('/')}}/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <!-- Custom Js -->
        <script src="{{ url('/')}}/assets/js/admin.js"></script>
        <script src="{{ url('/')}}/assets/js/pages/forms/basic-form-elements.js"></script>
        <!-- Demo Js -->
        <script src="{{ url('/')}}/assets/js/demo.js"></script>
        <script>
            $(document).ready(function(){
                $("#slotdiv").css("display","none");
                $(".select2").select2();
            $("#appointment_dt").on('change.dp', function (e) {
                $("#appdate").empty();
                $("#appdate2").empty();
                $("#appdate1").empty();
                $("#noslot").empty();
                $("#Morning").css("display","none");
                 $("#slodrec").css("display","block");
                $("#Afternoon").css("display","none");
                $("#Evening").css("display","none");
                //alert(this.value);         //Date in full format alert(new Date(this.value));
                var inputDate = new Date(this.value);
                var doctor_id = $("#doctor_id option:selected").val();
                var appointment_dt = $("#appointment_dt").val();
                 //alert(appointment_dt);
                $('#startdate').data('date')
                //alert(appointment_dt);
                var url1 = "avaibaletimeslots/"+doctor_id+'/'+appointment_dt;
               // alert(url1);
                var data=$("#createAppointment").serialize();
                $.ajax({
                    url:url1,
                    type:'GET',
                    data:data,
                    success:function(response) {
                      //alert(response);
                         if(response==0)
                         {
                            $("#slotsrec").addClass("noscroll");
                            $("#slotdiv").css("display","block");
                            $("#noslot").html("<h3>No Slots Available</h3>");
                            // $('<div class="col-md-6"></div>').appendTo($("#appdate"));
                         }
                         else
                         {
                          for(var i=0;i<response['slottime'].length;i++){
                            var slotime= response['slottime'][i];
                             var starttime= response['timeslot1'][i];
                            if(slotime=="Morning")
                            {
                                $("#Morning").css("display","block");
                                $("#slotdiv").css("display","block");
                                $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate"));  
                            }
                             else if(slotime=="Afternoon")
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         {
                             $("#Afternoon").css("display","block");
                             $("#slotdiv").css("display","block");
                             $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate2")); 
                         }
                         else if(slotime=="Evening")
                         {
                             $("#Evening").css("display","block");
                             $("#slotdiv").css("display","block");
                              $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate1")); 
                         }
                    }
                         }
                     },
                }); 
            });
            });
        </script>
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
                $("#createAppointment").submit(function(e){
                    e.preventDefault();
                    var data = $("#createAppointment").serialize();
                    //alert(data); 
                    //$("#submitBtn").attr('disabled', 'disabled').addClass('disabled');
                    $("#submitBtn").button('loading');
                    var csrf_token = $("#hdnCsrfToken").data('token');
                    $.ajax({
                            url: 'appointment',
                            dataType: 'text',
                            type: 'post',
                            contentType: 'application/x-www-form-urlencoded',
                            data: $(this).serialize()+"&_token=" + csrf_token,
                            success: function(data, textStatus, jQxhr){
                               // alert(data);
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
    </body>
</html>