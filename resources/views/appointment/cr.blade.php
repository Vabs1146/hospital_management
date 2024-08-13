@extends('shared.layoutProspera')
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Appointment</title>
  <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ url('/')}}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ url('/')}}/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ url('/')}}/assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ url('/')}}/assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ url('/')}}/assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ url('/')}}/assets/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body>
 <section class="content">
      <div class="container-fluid">
        <div class="row clearfix">
          <!-- left column -->
           <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <!-- general form elements -->
            <div class="card">
            <form class="form-horizontal" name="createAppointment" id="createAppointment" action="#" autocomplete="off">
            <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}" value="{{ csrf_token() }}">
            {{ csrf_field() }}
              <div class="header bg-pink">
                    <h2>Create Appointment </h2>
                      </div>
                    <div class="body">
                  <div class="row clearfix ">
                    <div class="col-md-9">
                            <span id="submitMessage"></span>
                            <div class="alert print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                        </div>
                            <div class="col-md-12">
                              <div class="col-md-4">
                              <div class="form-group labelgrp">
                              <label for="name" class="form-control">Name :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-4">
                              <div class="form-group labelgrp">
                              <label for="mobile_no" class="form-control">Mobile No:</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="name" id="name" class="form-control" value="">                           
                              </div>
                              </div>
                              </div>
                            </div>
                                 
                                 <!-- One row start -->
                            <div class="col-md-12">                           
                             <div class="col-md-4">
                              <div class="form-group labelgrp">
                              <label class="form-control">Doctor :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <select name="doctor_id" id="doctor_id" class="form-control" placeholder="select your doctor">
                              
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


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" class="datepicker form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date." data-date-format="yyyy-mm-dd" required>
                              </div>
                              </div>
                              </div>
                            </div>

                             <div class="col-md-12">                           
                             <div class="col-md-4">
                              <div class="form-group labelgrp">
                              <label class="form-control">Time Slot :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                            <div id="Morning" class="align-items-center" style="display: none;margin-bottom: 5px;"><b>Morning Slot</b></div>
                            
                        <div id="appdate"></div>

                        </div>

                        

                         <div class="col-sm-offset-2 col-sm-10" style="margin-top: 18px;">
                            <div id="Afternoon" style="display: none;margin-bottom: 5px; "><b>Afternoon Slot</b></div>
                            
                        <div id="appdate2"></div>

                        </div>
                         <div class="col-sm-offset-2 col-sm-10" style="margin-top: 18px;">
                            <div id="Evening" style="display: none;margin-bottom: 5px; "><b>Evening Slot</b></div>
                            
                        <div id="appdate1"></div>

                        </div>
                              </div>
                              </div>
                            </div>
                            <!-- End Of row -->
                            </div>    

                             
                </div>

   
             <div class="panel-footer">
                <button type="submit" class="btn btn-default" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                    <a href="{{ url('/') }}" class="btn btn-default" > Home </a>
                </div>
                 </form> 
            </div>
          </div>
        </div>
      </div>
    </section>

 <!-- Jquery Core Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ url('/')}}/assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/raphael/raphael.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/morrisjs/morris.js"></script>

    <!-- Custom Js -->
    <script src="{{ url('/')}}/assets/js/admin.js"></script>
    <script src="{{ url('/')}}/assets/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="{{ url('/')}}/assets/js/demo.js"></script>
</body>
</html>