<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Dr') }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Bootstrap Core Css -->
    <link href="{{ url('/')}}/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ url('/')}}/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ url('/')}}/assets/plugins/animate-css/animate.css" rel="stylesheet" />
    
    <link href="{{ url('/')}}/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{ url('/')}}/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Morris Chart Css-->
    <link href="{{ url('/')}}/assets/plugins/morrisjs/morris.css" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    
    <link href="{{ url('/')}}/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="{{ url('/')}}/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="{{ url('/')}}/assets/plugins/waitme/waitMe.css" rel="stylesheet" />

    <link href="{{ url('/')}}/assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ url('/')}}/assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ url('/')}}/assets/css/themes/all-themes.css" rel="stylesheet" />
     <link href="{{ url('/')}}/css/adminStyle.css" rel="stylesheet" />
     

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    
    
      <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
   
     .fc-time
    {
     display: none;
    }
    
     /*Media Queries For Mobiles*/

    @media (max-width: 468px) {
    .bg-pink 
    {
    background-color: blue !important;
    color: #fff;
    }
    .btn
    {
           margin-bottom: 12px !important;
           margin-left: 2px !important;
            float: left;

     }
      .panel-footer{
          height: 59px;
      }
   
    }


    @media (max-width: 768px) {
     .bg-pink 
    {
    background-color: red !important;
    color: #fff;
    }   
    .select2 {
        width: 100% !important;
    }
    .seccontent
    {

    margin: 0px 0px 0 0px !important;
    -moz-transition: 0.5s;
    -o-transition: 0.5s;
    -webkit-transition: 0.5s;
    transition: 0.5s; 
    }

    .labelgrp {
    text-align: left !important;
    }

    .labelgrp label {
    font-size: 12px !important;
    }

    .card .body .col-xs-3, .card .body .col-sm-3, .card .body .col-md-3, .card .body .col-lg-3
    {
        margin-bottom: 6px !important;
    }
     
     .btn
    {
           margin-bottom: 12px !important;
           margin-left: 2px !important;
            float: left;

     }


     }

   /*Media Queries For Tab/ipad*/

   @media(min-width: 769px) and (max-width: 1023px)
   {
    .noslot h3
    {
        font-size: 20px !important;
    }
    .bg-pink 
    {
    background-color: orange !important;
    color: #fff;
    }
    .select2 {
            width: 100% !important;
        }
     .labelgrp {
    text-align: left !important;
    }

    .labelgrp label {
    font-size: 15px !important;
    }

    .card .body .col-xs-3, .card .body .col-sm-3, .card .body .col-md-3, .card .body .col-lg-3
    {
        margin-bottom: 6px !important;
    }

     .btn
    {
          margin-top: 3px !important;

     }
   }


   /*Media Queries For Desktop/Laptop*/
   @media(min-width: 1024px)
   {
    /*.btn{
            margin-top: 10px;
    }*/
    
   }

   

    </style>
    @yield('style')

  </head>
   <!-- Page Loader -->
   <body class="theme-red">
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
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                     @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                  
                    @else
                    <li class="dropdown">
                      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                             <div style="font-size: 17px;">{{ Auth::user()->name }}
                        <i class="fa fa-caret-down" aria-hidden="true"></i></div>
                        </a>
                            <!-- <ul class="dropdown-menu ">
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="material-icons">input</i>Sign Out</a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            
                            </li>
                            <li role="separator" class="divider"></li>

                            <li><a href="{{ url('/changePassword') }}"><i class="material-icons">person</i>Change Password</a></li>
                        </ul> -->

                        <ul class="dropdown-menu">
                            <li class="header">ADMIN</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">input</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Sign Out </h4> 
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">person</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Change Password</h4>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                
                    </li>
                         @endif
                   
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
               <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ url('/')}}/assets/images/user.png" width="48" height="48" alt="User" />
                    <span class="Logoname" style="">Tejas Infotech</span>
                    
                    
                </div>
                <div class="info-container">
                      @if(isset(Auth::user()->email))
                    <div class="email">{{ Auth::user()->email }}</div>
                     @else
                     <div class="email">Admin</div>
                     @endif
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
           <div class="menu">
                <ul class="list" data-widget="treeview" role="menu" data-accordion="false">
                    @can('isDoctor')
                   <li class="active">
                        <a href="{{ url('admin') }}">
                            <i class="fa fa-home myicons" aria-hidden="true"></i> <span class="icon-name">Home</span>
                        </a>
                    </li>
                     @endcan

                    
                  @can('isDoctor')
                  <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-file fa-fw myicons"></i>
                            <span> Patient Reg., Appointment & OPD Bill </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @can('ishomepage_body_editor')
                            <li class="nav-item"> 
                                <a href="{{url('/AddPatient_Details/0')}}"> Add Patient Details
                               </a>
                            </li>
                              @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/appointmentlist/0') }}"> Appointment Details</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('followupappoinment/0') }}"> Follow-up Appointment</a>
                            </li>
                            @endcan
                            
                            @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ route('appointmentslot') }}"> Appointment Time Slot</a>
                            </li>
                            @endcan

                             @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('/appointment/') }}"> Create Appointment</a>
                            </li>
                             @endcan

                              @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ route('stop_appointments.index') }}">  Stopped Appointment</a>
                            </li>
                             @endcan

                              @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}">  OPD Patient Bill</a>
                            </li>
                             @endcan

                              @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('MedicineStock') }}">  Medicine Stock</a>
                            </li>
                             @endcan


                            
                        </ul>
                    </li>
                    @endcan
                
                    @can('isDoctor') 
                   <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span> Eye Patient </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @can('isDoctor') 
                            <li class="nav-item">
                               
                            <a href="{{ route('case_masters.index') }}"> Patient Details</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                            <a href="{{ url('/case_masters/prescriptionlst') }}">Eye Prescription</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{url('/glassPrescription/')}}"> Glass Prescription</a>
                            </li>
                            @endcan
                            
                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/report_files') }}"> Add Report</a>
                            </li>
                            @endcan

                            @can('isDoctor')

                            <li class="nav-item">
                                <a href="{{url('/patient/report')}}"> Patient Report</a>
                            </li>
                            @endcan
                                 
                            @can('isDoctor')     
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/4') }}"> Add Letter Head Top</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/5') }}">Add Letter Head Footer</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}"> OPD Patient Bill / Report</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('MedicineStock') }}">  Medicine Stock</a>
                            </li>
                            @endcan
                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ route('doctor.create') }}">  Add Doctor</a>
                            </li>
                            @endcan

                            
                        </ul>
                    </li>
                    @endcan

                       @can('isDoctor') 
                   <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span>Patient </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @can('isDoctor') 
                            <li class="nav-item">
                               
                            <a href="{{ route('case_masters.index') }}"> Patient Details</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                            <a href="{{ url('/case_masters/prescriptionlstother') }}"> Prescription
                            </a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{url('/glassPrescription/')}}"> Glass Prescription</a>
                            </li>
                            @endcan
                            
                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/report_files') }}"> Add Report</a>
                            </li>
                            @endcan

                            @can('isDoctor')

                            <li class="nav-item">
                                <a href="{{url('/patient/report')}}"> Patient Report</a>
                            </li>
                            @endcan
                                 
                            @can('isDoctor')     
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/4') }}"> Add Letter Head Top</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/5') }}">Add Letter Head Footer</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}"> OPD Patient Bill / Report</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('MedicineStock') }}">  Medicine Stock</a>
                            </li>
                            @endcan
                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ route('doctor.create') }}">  Add Doctor</a>
                            </li>
                            @endcan

                            
                        </ul>
                    </li>
                    @endcan

                    @can('isDoctor')
                  <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-file fa-fw myicons"></i>

                            <span> Eye IPD</span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @can('isDoctor')
                            <li class="nav-item"> 
                                <a href="#"> IPD Patient Details</a>
                            </li>
                              @endcan

                            @can('isDoctor')
                            <li class="nav-item"> 
                                <a href="{{url('/operation_rec/')}}">Operation Record</a>
                            </li>
                              @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{url('/eyeipd_operation_rec/')}}">Operation Theater Notes</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{url('/ipdbill_index/')}}"> IPD Patient Bill</a>
                            </li>
                            @endcan
                            
                            @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{url('/discharge_index/')}}">Discharge(1)</a>
                            </li>
                            @endcan

                             @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{url('/discharge2/')}}">Discharge(2)</a>
                            </li>
                            @endcan

                             @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{url('doctorbill/report/SurgeryReport')}}">Surgery Report</a>
                            </li>
                             @endcan

                             @can('isDoctor') 
                            <li class="nav-item">
                                <a href="#">Operative Notes</a>
                            </li>
                             @endcan

                            
                        </ul>
                    </li>
                    @endcan

                     @can('isDoctor') 
                   <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span>IPD </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @can('isDoctor') 
                            <li class="nav-item">
                               
                            <a href="#"> IPD Patient Details</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                            <a href="#"> CONSENT LETTER</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                            <a href="{{ url('/IPD/patientBill') }}"> IPD Patient Bill</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="#">Medicine Details</a>
                            </li>
                            @endcan
                            
                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="#">Medicine Prescription</a>
                            </li>
                            @endcan

                            @can('isDoctor')

                            <li class="nav-item">
                                <a href="{{ url('/IPD/Discharge') }}">Discharges</a>
                            </li>
                            @endcan
                                 
                            @can('isDoctor')     
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/4') }}">Surgery Notes</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/5') }}">Treatment Chart</a>
                            </li>
                            @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/2') }}">Seen By</a>
                            </li>
                            @endcan

                            
                        </ul>
                    </li>
                    @endcan

                    @can('isDoctor')
                      <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-paper-plane myicons" aria-hidden="true"></i> <span class="icon-name">Web Site</span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ route('menu_lists.index') }}"> Add Menu List</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ route('image_galleries.index') }}">Home Slider</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/2') }}">Add Logo</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ route('gallery_list') }}"> Gallery</a>
                            </li>
                            @endcan

                            
                            
                            @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('/dynamic_text/3/1') }}"> Body Layer 1 Editor</a>
                            </li>
                            @endcan

                             @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('/dynamic_text/4/1') }}">Body Layer 2 Editor</a>
                            </li>
                             @endcan

                             @can('isDoctor')
                            <li class="nav-item">
                                <a href="{{ url('/dynamic_text/5/1') }}">Footer Editor</a>
                            </li>
                             @endcan

                             @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('/rating/list') }}">  Approve Ratings</a>
                            </li>
                             @endcan

                        </ul>
                    </li>
                    @endcan
                    

                    @can('isDoctor')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fas fa-mobile-alt myicons"></i> <span class="icon-name">SMS</span>
                        </a>
                        <ul class="ml-menu">
                            @can('isDoctor') 
                            <li>
                                <a href="{{ url('/staff_member') }}">Add Member Contact</a>
                            </li>
                            @endcan

                            @can('isDoctor') 
                            <li>
                                <a href="{{ url('/member_sms') }}"> Member SMS</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li>
                                <a href="{{ url('/bulk_sms') }}"> Send Bulk SMS</a>
                            </li>
                            @endcan
                           
                        </ul>
                    </li>
                    @endcan

                    @can('isDoctor')
                    <li>
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="fa fa-users fa-fw myicons"></i> <span class="icon-name">User</span> 
                        </a>
                        <ul class="ml-menu">
                            @can('isDoctor') 
                            <li class="nav-item">
                                <a href="{{ url('/staff_users') }}">Add User</a>
                            </li>
                            @endcan

                            @can('isDoctor')
                            <li>
                                <a href="{{ url('user-permissions') }}">User Access </a>
                            </li>
                            @endcan

                            @can('isDoctor') 
                            <li>
                                <a href="{{ route('downloaddatabase')}}"> Backup Databse</a>
                            </li>
                            @endcan
                           
                        </ul>
                    </li>
                    @endcan



                </ul>
            </div>

            
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

 <section class="content">
        
              @yield('content')
        
  </section>
        <!-- Jquery Core Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>

    <script>

$(document).ready(function(){
                /** add active class and stay opened when selected */
                var url = window.location;
//alert(url);
                // for sidebar menu entirely but not cover treeview
                $('ul.list a').filter(function() {
                     return this.href == url;
                }).parent().addClass('active');

                // for treeview
                $('ul.ml-menu a').filter(function() {
                    //alert(this.href);
                     return this.href == url;
                }).parentsUntil(".list > .ml-menu").addClass('active');
            });</script>

    <!-- Bootstrap Core Js -->
    <script src="{{ url('/')}}/assets/plugins/bootstrap/js/bootstrap.js"></script>

   <!--<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
    <!-- Slimscroll Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    
    <script src="{{ url('/')}}/assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-steps/jquery.steps.js"></script>
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


    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/raphael/raphael.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="{{ url('/')}}/assets/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

     <!-- Jquery DataTable Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{ url('/')}}/assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    
        <!-- SweetAlert Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/sweetalert/sweetalert.min.js"></script>          
     
    <!-- Custom Js -->
    <script src="{{ url('/')}}/assets/js/admin.js"></script>
    <script src="{{ url('/')}}/assets/js/pages/ui/dialogs.js"></script>
     <script src="{{ url('/')}}/assets/js/pages/forms/basic-form-elements.js"></script>
    <script src="{{ url('/')}}/assets/js/pages/forms/form-wizard.js"></script>


    <!-- Demo Js -->
    <script src="{{ url('/')}}/assets/js/demo.js"></script>
@yield('scripts')


</body>