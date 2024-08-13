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

	.dilation-complted {
		background:#ace886;
	}

	.dilation-about-to-complete {
		background:#ff0;
	}

	.dilation-item {
		border: 1px solid;
    padding: 6px 10px 0px;
    margin-right: 20px;
    width: fit-content;
    display: inline-block;
    border-radius: 5px;
	}

	.dilation-item-timer {
		display: inline; margin-right:20px;
	}
   

    </style>
    @yield('style')
@php
//echo AUTH::user()->id; exit;
//echo "====>>>>>> <pre>"; print_r(AUTH::user()); exit;
//dd(session()->all());
    //$record = DB::table('user_permission')->leftjoin('menu_section', 'menu_section.sectionid', 'user_permission.section_id')->where('user_id', AUTH::user()->id)->select('user_permission.*', 'menu_section.sectionname')->get();

$logged_user_id = AUTH::user()->id;
$record = DB::table('menu_section')->select('user_permission.*', 'menu_section.sectionname')
        ->leftJoin("user_permission",function($join) use($logged_user_id) {
                $join->on("menu_section.sectionid","=","user_permission.section_id");
            $join->where("user_permission.user_id","=",$logged_user_id);
        })
        ->get();
$permissions = [];
foreach($record as $record_row) {
    $permissions[$record_row->sectionname] = $record_row;
}

session(['permissions' => $permissions]);

 $parent_menu = DB::table('parent_menu')->get();

//echo "====>>>>>> <pre>"; print_r($permissions); exit;
@endphp
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
                                        <a href="{{ route('changePassword') }}">
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
                    <img src="{{ url('/')}}/assets/images/ojo.gif" width="48" height="48" alt="User" />
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
           <!-- <div class="menu" style="overflow: hidden;overflow-y: auto;height: -webkit-fill-available;height: 500px;"> -->

		   <div class="menu" style="overflow: hidden;overflow-y: auto;height: -webkit-fill-available;height: 100vh;padding-bottom: 272px;">
                <ul class="list" data-widget="treeview" role="menu" data-accordion="false">
                   
                   <li class="active">
                        <a href="{{ url('admin') }}">
                            <i class="fa fa-home myicons" aria-hidden="true"></i> <span class="icon-name">Home</span>
                        </a>
                    </li>
					
					
					
					<!--<li>
                        <a href="{{url('/covid-consent-form/')}}">
                           <!-- <i class="fa fa-home myicons" aria-hidden="true"></i>  -->
							<!--<i class="fas fa-allergies myicons" aria-hidden="true"></i><span class="icon-name">Covid 19</span>
                        </a>
                    </li>-->
					
					<!--<li>
                        <a href="{{url('patient-activity')}}" target="_blank">-->
                            <!-- <i class="fa fa-home myicons" aria-hidden="true"></i>  -->
							<!--<i class="fas fa-eye myicons" aria-hidden="true"></i> <span class="icon-name">Patient View</span>
                        </a>
                    </li>-->


					<!--<li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-file fa-fw myicons"></i>
                            <span> New Patients </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            <li class="nav-item"> 
                                <a href="{{url('/register')}}"> Register
                               </a>
                            </li>
							<li class="nav-item"> 
                                <a href="{{url('/patients-listing')}}"> Listing
                               </a>
                            </li>
							<li class="nav-item"> 
                                <a href="{{url('/patients_ipd/patientBill')}}"> Patient Bill
                               </a>
                            </li>
							<li class="nav-item"> 
                                <a href="{{url('/ipd-settings')}}"> Ipd Settings
                               </a>
                            </li>
                        </ul>
                    </li>-->
                      
@if($parent_menu[0]->status == 1)                    
                  	@if($permissions['1_AddPatient_Details/0']->listing_permission || $permissions['1_appointmentlist/0']->listing_permission || $permissions['1_followupappoinment/0']->listing_permission || $permissions['1_appointmentslot']->listing_permission || $permissions['1_appointment']->listing_permission || $permissions['1_stop_appointments']->listing_permission || $permissions['1_bill_details']->listing_permission || $permissions['1_MedicineStock']->listing_permission || AUTH::user()->role == 1)    
                  <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-file fa-fw myicons"></i>
                            <span> Patient Reg., Appointment & OPD Bill </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @if($permissions['1_AddPatient_Details/0']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item"> 
                                <a href="{{url('/AddPatient_Details/0')}}"> OPD Patient Register
                               </a>
                            </li>
                              @endif
							 <!--<li class="nav-item"> 
                                <a href="{{url('dilation')}}"> Dilation
                               </a>
                            </li>-->

                            @if($permissions['1_appointment']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/appointment/') }}"> Create Appointment</a>
                            </li>
                             @endif
                           @if($permissions['1_appointmentlist/0']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/appointmentlist/0') }}"> Appointment Details</a>
                            </li>
                            @endif

                            @if($permissions['1_followupappoinment/0']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('followupappoinment/0') }}"> Follow-up Appointment</a>
                            </li>
                            @endif
                            
                            @if($permissions['1_appointmentslot']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('appointmentslot') }}"> Appointment Add Time Slot</a>
                            </li>
                            @endif

                            <!--@if($permissions['1_stop_appointments']->listing_permission || AUTH::user()->role == 1)     
                            <li class="nav-item">
                                <a href="{{ route('stop_appointments.index') }}">  Stopped Appointment</a>
                            </li>
                             @endif-->

                             @if($permissions['1_bill_details']->listing_permission || AUTH::user()->role == 1)     
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}">  OPD Bill</a>
                            </li>
                             @endif

							 {{--
							<li class="nav-item">
                                <a href="{{url('patientbill/report')}}">OPD Bill Report</a>
                            </li>
							<li class="nav-item">
                                <a href="{{url('patientbill/payment-report')}}">OPD Bill Payment Report</a>
                            </li>
							 --}}
							
                        </ul>
                    </li>
                    @endif
 @endif  

 @if($parent_menu[1]->status == 1)    
                  @if($permissions['2_case_masters']->listing_permission || $permissions['2_case_masters/prescriptionlst']->listing_permission || $permissions['2_glassPrescription']->listing_permission || $permissions['2_report_files']->listing_permission || $permissions['2_patient/report']->listing_permission || $permissions['2_LogoAddEdit/4']->listing_permission || $permissions['2_LogoAddEdit/5']->listing_permission || $permissions['2_bill_details']->listing_permission || $permissions['2_MedicineStock']->listing_permission || $permissions['2_admin/doctor/create']->listing_permission || AUTH::user()->role == 1)
                   <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span> OPD Patient </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @if($permissions['2_case_masters']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                               
                            <a href="{{ route('case_masters.index') }}"> Patient Case History</a>
                            </li>
                            @endif
							
							@if($permissions['4_case_masters/prescriptionlstother']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{ url('/case_masters/prescriptionlstother') }}"> Prescription
                            </a>
                            </li>
                            @endif
							
							<!--<li class="nav-item">
								<a href="{{url('/certificate/')}}"> Certificate</a>
                            </li>
							
							@if($permissions['4_case_masters']->listing_permission || AUTH::user()->role == 1)
                            
                            @endif

                            @if($permissions['2_case_masters/prescriptionlst']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{ url('/case_masters/prescriptionlst') }}">Eye Prescription</a>
                            </li>
                            @endif

                            @if($permissions['2_glassPrescription']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{url('/glassPrescription/')}}"> Glass Prescription</a>
                            </li>
                            @endif-->
                            
                            @if($permissions['2_report_files']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/report_files') }}"> Add Report</a>
                            </li>
                            @endif
							
							
                            <!--@if($permissions['2_patient/report']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{url('/patient/report')}}"> Patient Report</a>
                            </li>
                            @endif
							
                            @if($permissions['2_bill_details']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}"> OPD Patient Bill / Report</a>
                            </li>
                            @endif-->
							
                            
                            @if($permissions['2_admin/doctor/create']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('doctor.create') }}">Add Doctor & Fees</a>
                            </li>
                            @endif

                            
                        </ul>
                    </li>
                    @endif
@endif  

 
 {{--
 @if($parent_menu[3]->status == 1) 
                  @if($permissions['4_case_masters']->listing_permission || $permissions['4_case_masters/prescriptionlstother']->listing_permission || $permissions['4_glassPrescription']->listing_permission || $permissions['4_report_files']->listing_permission || $permissions['4_patient/report']->listing_permission || $permissions['4_dynamicForm/4']->listing_permission || $permissions['4_dynamicForm/5']->listing_permission || $permissions['4_bill_details']->listing_permission || $permissions['4_MedicineStock']->listing_permission || $permissions['4_admin/doctor/create']->listing_permission || AUTH::user()->role == 1)
                   <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span>Patient</span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @if($permissions['4_case_masters']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                               
                            <a href="{{ route('case_masters.index') }}"> Patient Details</a>
                            </li>
                            @endif
							
							@if($permissions['4_case_masters']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                               
                            <a href="{{ url('patient-activity') }}" target="_blank"> Patient View</a>
                            </li>
                            @endif

                            @if($permissions['4_case_masters/prescriptionlstother']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{ url('/case_masters/prescriptionlstother') }}"> Prescription
                            </a>
                            </li>
                            @endif
							
                            @if($permissions['4_report_files']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/report_files') }}"> Add Report</a>
                            </li>
                            @endif

                            @if($permissions['4_patient/report']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{url('/patient/report')}}"> Patient Report</a>
                            </li>
                            @endif
                                 
                           

                            @if($permissions['4_bill_details']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}"> OPD Patient Bill / Report</a>
                            </li>
                            @endif

                            @if($permissions['4_admin/doctor/create']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('doctor.create') }}">  Add Doctor</a>
                            </li>
                            @endif

                            
                        </ul>
                    </li>
                    @endif
@endif 
--}}
  
 {{--
 @if($parent_menu[2]->status == 1) 
                 @if($permissions['3_ipd_details']->listing_permission || $permissions['3_operation_rec']->listing_permission || $permissions['3_eyeipd_operation_rec']->listing_permission || $permissions['3_ipdbill_index']->listing_permission || $permissions['3_discharge_index']->listing_permission || $permissions['3_discharge2']->listing_permission || $permissions['3_doctorbill/report/SurgeryReport']->listing_permission || $permissions['3_operative_notes']->listing_permission || AUTH::user()->role == 1)
                  <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-file fa-fw myicons"></i>

                            <span> Eye IPD</span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                           <!--     @if($permissions['3_ipd_details']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item"> 
                                <a href="#"> IPD Patient Details</a>
                            </li>
                              @endif -->
							  @if($permissions['1_AddPatient_Details/0']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item"> 
                                <a href="{{url('/add-ipd-patient/0')}}"> IPD Patient Register
                               </a>
                            </li>
                              @endif
                            @if($permissions['3_operation_rec']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item"> 
                                <a href="{{url('/operation_rec/')}}">Operation Record</a>
                            </li>
                              @endif

                            @if($permissions['3_eyeipd_operation_rec']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{url('/eyeipd_operation_rec/')}}">Operation Theater Notes</a>
                            </li>
                            @endif

                            @if($permissions['3_ipdbill_index']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{url('/ipdbill_index/')}}">Create IPD Bill</a>
                            </li>
                            @endif
							
                            @if($permissions['3_discharge_index']->listing_permission || AUTH::user()->role == 1) 
                            <li class="nav-item">
                                <a href="{{url('/discharge_index/')}}">Discharge</a>
                            </li>
                            @endif
							
							
							<!-- ======================================================== -->
							<li class="nav-item has-treeview">
								<a href="javascript:void(0);" class="menu-toggle">
									<i class="fa fa-file fa-fw myicons"></i>

									<span>Cataract</span>
								</a>
								<ul class="ml-menu nav-treeview">
									
									<li class="nav-item">
										<a href="{{url('/cataract-operative-notes/')}}">Cataract Operative Notes</a>
									</li>
									
									<li class="nav-item">
										<a href="{{url('/cataract-consent-form/')}}">Cataract Consent Form</a>
									</li>
									
									
									<li class="nav-item">
										<a href="{{url('/cataract-surgey/')}}">Cataract Surgery With / Without Implantation of Intraocular Lens</a>
									</li>
									
								</ul>
							</li>
							<!-- ======================================================== -->
                        </ul>
                    </li>
                    @endif
@endif  --}}

<!--<li class="nav-item has-treeview">
	<a href="javascript:void(0);" class="menu-toggle">-->
		<!--<i class="fa fa-paper-plane myicons" aria-hidden="true"></i> -->
		<!--<i class="fas fa-file-medical-alt myicons" aria-hidden="true"></i><span class="icon-name">Report</span>
	</a>
	<ul class="ml-menu nav-treeview">
		<li class="nav-item">
			<a href="{{ url('opdbill-report') }}">OPD Bill Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('today-opdbill-report') }}">OPD Other Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('ipdbill-report') }}">IPD Bill Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('ipd-surgery-report') }}">IPD Other Report</a>
		</li>
	</ul>
</li>-->

			 @if($parent_menu[10]->status == 1) 

@if($permissions['10_opd-bill-report']->listing_permission || $permissions['10_opd-bill-payment-report']->listing_permission || $permissions['10_opd-bill-balance-report']->listing_permission || AUTH::user()->role == 1)
<li class="nav-item has-treeview">
	<a href="javascript:void(0);" class="menu-toggle">
		<i class="fas fa-file-medical-alt myicons" aria-hidden="true"></i><span class="icon-name">OPD Reports</span>
	</a>
	<ul class="ml-menu nav-treeview">
		<li class="nav-item">
			<a href="{{ url('opd-bill-report') }}">OPD Bill Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('opd-bill-payment-report') }}">OPD Bill Payment Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('opd-bill-balance-report') }}">OPD Bill Balance Report</a>
		</li>
                
                <li class="nav-item">
			<a href="{{ url('ipd-bill-report') }}">IPD Bill Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('ipd-bill-payment-report') }}">IPD Bill Payment Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('ipd-bill-balance-report') }}">IPD Bill Balance Report</a>
		</li>
	</ul>
</li>

	@endif
@endif
			 @if($parent_menu[11]->status == 1) 

@if($permissions['11_register']->listing_permission || $permissions['11_patients-listing']->listing_permission || $permissions['11_ipd-settings']->listing_permission || AUTH::user()->role == 1)
				<li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-file fa-fw myicons"></i>
                            <span> IPD Patients </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            <li class="nav-item"> 
                                <a href="{{url('/register')}}"> Register
                               </a>
                            </li>
							<li class="nav-item"> 
                                <a href="{{url('/patients-listing')}}"> Listing
                               </a>
                            </li>
							<!--<li class="nav-item"> 
                                <a href="{{url('/patients_ipd/patientBill')}}"> Patient Bill
                               </a>
                            </li>-->
							<li class="nav-item"> 
                                <a href="{{url('/ipd-settings')}}"> Ipd Settings
                               </a>
                            </li>
							<li class="nav-item"> 
                                <a href="{{url('/upload-document-listing')}}"> Upload Documents
                               </a>
                            </li>
                        </ul>
                    </li>	

	@endif
@endif

					 @if($parent_menu[12]->status == 1) 

@if($permissions['12_new-ipd-bill-report']->listing_permission || $permissions['12_new-ipd-bill-payment-report']->listing_permission || $permissions['12_new-ipd-bill-balance-report']->listing_permission || AUTH::user()->role == 1)

<li class="nav-item has-treeview">
	<a href="javascript:void(0);" class="menu-toggle">
		<i class="fas fa-file-medical-alt myicons" aria-hidden="true"></i><span class="icon-name">New Ipd Reports</span>
	</a>
	<ul class="ml-menu nav-treeview">
        <li class="nav-item">
			<a href="{{ url('new-ipd-bill-report') }}">IPD Bill Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('new-ipd-bill-payment-report') }}">IPD Bill Payment Report</a>
		</li>
		<li class="nav-item">
			<a href="{{ url('new-ipd-bill-balance-report') }}">IPD Bill Balance Report</a>
		</li>
	</ul>
</li>
@endif
@endif

{{--   
 @if($parent_menu[4]->status == 1) 
                     @if($permissions['5_ipd_patient_details']->listing_permission || $permissions['5_consent_letter']->listing_permission || $permissions['5_IPD/patientBill']->listing_permission || $permissions['5_medicine_details']->listing_permission || $permissions['5_medicine_presction']->listing_permission || $permissions['5_IPD/Discharge']->listing_permission || $permissions['5_dynamicForm/4']->listing_permission || $permissions['5_dynamicForm/5']->listing_permission || $permissions['5_dynamicForm/2']->listing_permission || AUTH::user()->role == 1) 
                   <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span>IPD </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @if($permissions['5_ipd_patient_details']->listing_permission || AUTH::user()->role == 1) 
                            <li class="nav-item">
                               
                            <a href="{{url('/IPD/patientRegsiter')}}"> IPD Patient Details</a>
                            </li>
                            @endif

                            @if($permissions['5_consent_letter']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{url('/dynamicForm/1')}}"> Consent Letter</a>
                            </li>
                            @endif

                            @if($permissions['5_IPD/patientBill']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{ url('/IPD/patientBill') }}"> IPD Patient Bill</a>
                            </li>
                            @endif

                            @if($permissions['5_medicine_details']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{url('/IPD/patientMedicine')}}">Medicine Details</a>
                            </li>
                            @endif
                            
							
                            @if($permissions['5_IPD/Discharge']->listing_permission || AUTH::user()->role == 1)

                            <li class="nav-item">
                                <a href="{{ url('/IPD/Discharge') }}">Discharges</a>
                            </li>
                            @endif
                                 
                            @if($permissions['5_dynamicForm/4']->listing_permission || AUTH::user()->role == 1)     
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/4') }}">Surgery Notes</a>
                            </li>
                            @endif

                             @if($permissions['5_dynamicForm/5']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/5') }}">Treatment Chart</a>
                            </li>
                            @endif

                             @if($permissions['5_dynamicForm/2']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/dynamicForm/2') }}">Seen By</a>
                            </li>
                            @endif

                            
                        </ul>
                    </li>
                    @endif
@endif   
 --}}     
 @if($parent_menu[5]->status == 1) 
                     @if($permissions['rating/list']->listing_permission || $permissions['website']->listing_permission || AUTH::user()->role == 1)
                      <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-paper-plane myicons" aria-hidden="true"></i> <span class="icon-name">Web Site</span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @if($permissions['website']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('menu_lists.index') }}"> Add Menu List</a>
                            </li>
                            @endif

                            @if($permissions['website']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('image_galleries.index') }}">Home Slider</a>
                            </li>
                            @endif

                            @if($permissions['website']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/2') }}">Add Logo</a>
                            </li>
                            @endif

                            @if($permissions['website']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('gallery_list') }}"> Gallery</a>
                            </li>
                            @endif

                            
                            
                            @if($permissions['website']->listing_permission || AUTH::user()->role == 1) 
                            <li class="nav-item">
                                <a href="{{ url('/dynamic_text/3/1') }}"> Body Layer 1 Editor</a>
                            </li>
                            @endif

                             @if($permissions['website']->listing_permission || AUTH::user()->role == 1) 
                            <li class="nav-item">
                                <a href="{{ url('/dynamic_text/4/1') }}">Body Layer 2 Editor</a>
                            </li>
                             @endif

                             @if($permissions['website']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/dynamic_text/5/1') }}">Footer Editor</a>
                            </li>
							<li class="nav-item">
                                <a href="{{ url('/dynamic_text/6/1') }}">Footer Address</a>
                            </li>
                             @endif

                             @if($permissions['rating/list']->listing_permission || AUTH::user()->role == 1) 
                            <li class="nav-item">
                                <a href="{{ url('/rating/list') }}">  Approve Ratings</a>
                            </li>
                             @endif

							<li class="nav-item">
                                <a href="{{ url('/manage-advertisement') }}">Advertise</a>
                            </li>

                        </ul>
                    </li>
                    @endif
                    
@endif      


<li class="nav-item has-treeview">
	<a href="javascript:void(0);" class="menu-toggle">
		<i class="fa fa-paper-plane myicons" aria-hidden="true"></i> <span class="icon-name">Home Page Settings</span>
	</a>
	<ul class="ml-menu nav-treeview">
		<li class="nav-item">
			<a href="{{ url('section-slider2') }}">Slider 2</a>
		</li>
		
		<li class="nav-item">
			<a href="{{ url('section-slider-footer') }}">Slider Footer</a>
		</li>
		
		<li class="nav-item">
			<a href="{{ url('section-slider-footer2') }}">Slider Footer 2</a>
		</li>
		
		<li class="nav-item">
			<a href="{{ url('section-welcome') }}">Welcome Section</a>
		</li>

		<li class="nav-item">
			<a href="{{ url('section-our-departments') }}">Departments</a>
		</li>

		<li class="nav-item">
			<a href="{{ url('list-events') }}">Events</a>
		</li>

		<li class="nav-item">
			<a href="{{ url('section-work') }}">Work</a>
		</li>
		
		<li class="nav-item">
			<a href="{{ url('section-paper-cutting') }}">Paper Cutting</a>
		</li>

	</ul>
</li>
<!-- @if($parent_menu[6]->status == 1) 
                    @if($permissions['staff_member']->listing_permission || $permissions['member_sms']->listing_permission || $permissions['bulk_sms']->listing_permission || AUTH::user()->role == 1)
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                             <i class="fas fa-mobile-alt myicons"></i> <span class="icon-name">SMS</span>
                        </a>
                        <ul class="ml-menu">
                            @if($permissions['staff_member']->listing_permission || AUTH::user()->role == 1)
                            <li>
                                <a href="{{ url('/staff_member') }}">Add Member Contact</a>
                            </li>
                            @endif

                            @if($permissions['member_sms']->listing_permission || AUTH::user()->role == 1) 
                            <li>
                                <a href="{{ url('/member_sms') }}"> Member SMS</a>
                            </li>
                            @endif

                            @if($permissions['bulk_sms']->listing_permission || AUTH::user()->role == 1)
                            <li>
                                <a href="{{ url('/bulk_sms') }}"> Send Bulk SMS</a>
                            </li>
                            @endif
                           
                        </ul>
                    </li>
                    @endif
@endif  -->     
 @if($parent_menu[7]->status == 1) 
                   @if($permissions['users']->listing_permission || AUTH::user()->role == 1)
                    <li>
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="fa fa-users fa-fw myicons"></i> <span class="icon-name">User</span> 
                        </a>
                        <ul class="ml-menu">
                            @if($permissions['users']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/staff_users') }}">Add User</a>
                            </li>
                            @endif

                            @if($permissions['user_permissions']->listing_permission || AUTH::user()->role == 1)
                            <li>
                                <a href="{{ url('user-permissions') }}">User Access </a>
                            </li>
                            @endif

                            @if($permissions['downloaddatabase']->listing_permission || AUTH::user()->role == 1)
                            <li>
                                <a href="{{ route('downloaddatabase')}}"> Backup Databse</a>
                            </li>
                            @endif
                           
                        </ul>
                    </li>
                    @endif
  @endif
  
   @if($parent_menu[8]->status == 1) 
                   @if($permissions['settings']->listing_permission || $permissions['settings']->listing_permission || $permissions['2_LogoAddEdit/5']->listing_permission || AUTH::user()->role == 1)
                    <li>
                       <a href="javascript:void(0);" class="menu-toggle">
                           <i class="fa fa-cog fa-fw myicons"></i> <span class="icon-name">Settings</span> 
                        </a>
                        <ul class="ml-menu">
                            @if($permissions['settings']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('settings') }}">General Sttings</a>
                            </li>
                            @endif

							<!-- ======================================================== -->
							<li class="nav-item has-treeview">
								<a href="javascript:void(0);" class="menu-toggle">
									<i class="fa fa-file fa-fw myicons"></i>

									<span>Templates</span>
								</a>
								<ul class="ml-menu nav-treeview">
									
									<li class="nav-item">
										<a href="{{url('/prescription-templates-listing/')}}">Presctiption</a>
									</li>
									
									<li class="nav-item">
										<a href="{{url('/list-finding-templates/')}}">Findings</a>
									</li>
									
									{{--
									<li class="nav-item">
										<a href="{{url('/cataract-surgey/')}}">Cataract Surgery With / Without Implantation of Intraocular Lens</a>
									</li>
									--}}
									
								</ul>
							</li>
							<!-- ======================================================== -->

                             @if($permissions['2_LogoAddEdit/4']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/4') }}"> Add Letter Head Top</a>
                            </li>
                            @endif

                            @if($permissions['2_LogoAddEdit/5']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/5') }}">Add Letter Head Footer</a>
                            </li>
                            @endif

							<!--<li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/11') }}">Add Dentist Letter Head Footer</a>
                            </li>

							<li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/12') }}">Add Dentist Letter Head Footer</a>
                            </li>
                           
						   <li class="nav-item">
                                <a href="{{ url('/set-dropdown-options') }}">Set Dropdown Options</a>
                            </li>-->
                        </ul>
                    </li>
                    @endif
  @endif
  

<!-- ============================================================= -->

                      <li class="nav-item has-treeview">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="fa fa-paper-plane myicons" aria-hidden="true"></i> <span class="icon-name">New Web Site</span>
                        </a>
                        <ul class="ml-menu nav-treeview">
							<li class="nav-item">
                                <a href="{{ url('new-edit-settings') }}">General Sttings</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('menu_lists.index') }}"> Add Menu List</a>
                            </li>
                           
						   
                            <li class="nav-item">
                                <a href="{{ route('new-home-slider-list') }}">Home Slider</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('new-iamge-gallery-list') }}">Gallery Images</a>
                            </li>
							
                            <li class="nav-item">
                                <a href="{{ url('certificate-list') }}">Certificates</a>
                            </li>
							
                            <li class="nav-item">
                                <a href="{{ route('services-list') }}">Services</a>
                            </li>
							
                            <li class="nav-item">
                                <a href="{{ url('consultant-list') }}">Consultant</a>
                            </li>
                           
						   
                            <li class="nav-item">
                                <!-- <a href="{{ url('feedback-list') }}">Feedback</a> -->
								 <a href="{{ url('/rating/list') }}">Feedback</a>
                            </li>
							
                            <li class="nav-item">
                                <a href="{{ url('new-dynamic-text-list') }}">Dynamic Text</a>
                            </li>
                        </ul>
                    </li>
			<!-- ======================================================== -->

  

                </ul>
            </div>

            
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

 <section class="content">
 <div>
 <marquee style="display:none;" id="dilation_marquee" onMouseOver="this.stop()" onMouseOut="this.start()">
 
 </marquee>
 </div>
        
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
   <!--  <script src="{{ url('/')}}/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script> -->
    
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
@yield('scripts_wpaint')

<script>
function dilationHtml(dilation_object) {
	var html = "";
	for (const [key, value] of Object.entries(dilation_object)) {
	  console.log(key +' : '+ value.patient_name);
	  html += value.dilation_remaining;
	}

	$('#dilation_marquee').html(html);
	$('#dilation_marquee').show();
}

function dilationAjaxRecords() {
	$.ajax({
		url: "{{url('get-dilations')}}",
		datatype: "JSON",
		success: function(response) {
			var result = JSON.parse(response);
			//alert(result.length);

			if(result.length > 0) {
				dilationHtml(result);
			}

			
		}
	});
}

$(document).ready(function() {
	dilationAjaxRecords();
	setInterval(function(){ 
		dilationAjaxRecords();		
	}, 30000);

	var x = setInterval(function() {
	//console.log('hi');
var records = $('.remaining-timer').length;
	$('.remaining-timer').each(function() {
		if($(this).html() != "EXPIRED") {
			var current_end_time = $(this).data('end_time');
			var patient_name = $(this).data('patient_name');

			var countDownDate = new Date(current_end_time).getTime();

			var now = new Date().getTime();

			//console.log(patient_name + ' : converted to js end time '+ countDownDate +' || js current time '+ new Date().toLocaleString() + ' || end time ' +current_end_time);

			var distance = countDownDate - now;

			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			if(distance > 0) {
				//$(this).html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
				$(this).html(minutes + "m " + seconds + "s ");
			} else {
				$(this).html("Completed");
				$(this).closest('.dilations_tr').addClass('dilation-complted');

				$(this).closest('.dilations_tr').removeClass('dilation-about-to-complete');

				$(this).closest('.dilations_tr').find('.dismiss-notification').show();

				
				
				/*
				swal({title: "Dilation Completed", text: patient_name, type: "success"},
					function(){ 
						location.reload();
					}
				);
				*/
			}
		} else {
			records--;
		}
	});
	if (records < 0) {
		clearInterval(x);
	}
}, 1000);




});

$(document).on('click','.dismiss-notification',function() {

	var dilations_id = $(this).data('id');
	//alert(dilations_id);

	$(this).closest('.dilations_tr').remove();
	
	$.ajax({
		url: "{{url('update-dilation-status')}}",
		method: "POST",
		data:{'id':dilations_id, 'action' : 'acknowledged'},
		success: function(response) {
		
		}
	});

});


	</script>
	
	<script>
		$(document).on('click', '.patient-ativity', function() {
			var status = $(this).val();
			var activity_type = $(this).data('type');
			var case_id = $(this).data('case_id');
			
			//alert(value +''+ data_type);
			$.ajax({
				'url' : '{{url("update-patient-activity")}}',
				'method': 'POST',
				'data':{'status':status, 'activity_type':activity_type, 'case_id':case_id},
				'sucess' : function() {
					
				}
			});
		});
	</script>

</body>
</html>