<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard V.1 | Kiaalap - Kiaalap Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link href="{{ url('/')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/owl.carousel.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/owl.theme.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/style.css">
    <!-- <link href="{{ url('/')}}/assets/css/style.css" rel="stylesheet"> -->
    
    <!-- Waves Effect Css -->
    <link href="{{ url('/')}}/assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{ url('/')}}/assets/css_new_template/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/vendor/modernizr-2.8.3.min.js"></script>
    @php
//echo AUTH::user()->id; exit;
//echo "====>>>>>> <pre>"; print_r(AUTH::user()); exit;
//dd(session()->all());
    //$record = DB::table('user_permission')->leftjoin('menu_section', 'menu_section.sectionid', 'user_permission.section_id')->where('user_id', AUTH::user()->id)->select('user_permission.*', 'menu_section.sectionname')->get();

$logged_user_id = AUTH::user()->id;

//DB::enableQueryLog();
$record = DB::table('menu_section')->select('user_permission.*', 'menu_section.sectionname')
        ->leftJoin("user_permission",function($join) use($logged_user_id) {
            $join->on("menu_section.sectionid","=","user_permission.section_id");
            $join->where("user_permission.user_id","=",$logged_user_id);
        })
        ->get();

       // $sql_data = DB::getQueryLog();

$permissions = [];
foreach($record as $record_row) {
    $permissions[$record_row->sectionname] = $record_row;
}

session(['permissions' => $permissions]);

 $parent_menu = DB::table('parent_menu')->get();

//echo "====>>>>>> <pre>"; print_r($sql_data); exit;
@endphp
<script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
   .header-top-area {
        background: #2147ff;
    }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
            <img src="{{ url('/')}}/assets/images/ojo.gif" width="48" height="48" alt="User" />
            <span class="Logoname" style="">Tejas Infotech</span>
            <div class="info-container">
                      @if(isset(Auth::user()->email))
                    <div class="email">{{ Auth::user()->email }}</div>
                     @else
                     <div class="email">Admin</div>
                     @endif
                </div>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                        <a class="" href="{{ url('admin') }}">
                            <i class="fa fa-home myicons" aria-hidden="true"></i> <span class="mini-click-non">Home</span>
                        </a>
                        </li>
                        @if($parent_menu[1]->status == 1)    
                  @if($permissions['2_case_masters']->listing_permission || $permissions['2_case_masters/prescriptionlst']->listing_permission || $permissions['2_glassPrescription']->listing_permission || $permissions['2_report_files']->listing_permission || $permissions['2_patient/report']->listing_permission || $permissions['2_bill_details']->listing_permission || $permissions['2_MedicineStock']->listing_permission || $permissions['2_admin/doctor/create']->listing_permission || AUTH::user()->role == 1)
                   <li>
                        <a href="javascript:void(0);" class="has-arrow">
                             <i class="fa fa-file fa-fw myicons"></i>

                            <span class="mini-click-non"> OPD Patient </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                            @if($permissions['1_AddPatient_Details/0']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item"> 
                                <a href="{{url('/AddPatient_Details/0')}}"> Patient Register
                               </a>
                            </li>
                              @endif

                            @if($permissions['2_case_masters']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{ route('case_masters.index') }}"> Patient Case History</a>
                            </li>
                            @endif
							
							@if($permissions['4_case_masters/prescriptionlstother']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                            <a href="{{ url('/case_masters/prescriptionlstother') }}"> Patient Prescription
                            </a>
                            </li>
                            @endif
							
                            
                            @if($permissions['2_report_files']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/report_files') }}"> Patient Add Report</a>
                            </li>
                            @endif
							
							@if($permissions['1_bill_details']->listing_permission || AUTH::user()->role == 1)     
                            <li class="nav-item">
                                <a href="{{ url('/bill_details') }}">  OPD Bill</a>
                            </li>
                             @endif
                        </ul>
                    </li>
                    @endif
@endif  
@if($parent_menu[0]->status == 1)                    
                  	@if($permissions['1_AddPatient_Details/0']->listing_permission || $permissions['1_appointmentlist/0']->listing_permission || $permissions['1_followupappoinment/0']->listing_permission || $permissions['1_appointmentslot']->listing_permission || $permissions['1_appointment']->listing_permission || $permissions['1_stop_appointments']->listing_permission || $permissions['1_bill_details']->listing_permission || $permissions['1_MedicineStock']->listing_permission || AUTH::user()->role == 1)    
                  <li class="">
                        <a href="javascript:void(0);" class="has-arrow">
                            <i class="fa fa-file fa-fw myicons"></i>
                            <span class="mini-click-non"> Appointment & <br> Follow-up </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                           
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
                                <a href="{{ url('/appointmentlist/0') }}"> Appointment</a>
                            </li>
                            @endif

                            @if($permissions['1_followupappoinment/0']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('followupappoinment/0') }}"> Follow-up Appointment</a>
                            </li>
                            @endif
                            
                            @if($permissions['1_appointmentslot']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('appointmentslot') }}"> Appointments Add Time<br>Slot</a>
                            </li>
                            @endif

							
                        </ul>
                    </li>
                    @endif
 @endif  

  
 @if($permissions['15_settings']->listing_permission 
                   || $permissions['15_prescription-templates-listing']->listing_permission 
                   || $permissions['15_list-finding-templates']->listing_permission 
                   || $permissions['15_LogoAddEdit/4']->listing_permission 
                   || $permissions['15_LogoAddEdit/5']->listing_permission 
                   || $permissions['15_set-dropdown-options']->listing_permission 
                   || AUTH::user()->role == 1)
                    <li>
                       <a href="javascript:void(0);" class="has-arrow">
                           <i class="fa fa-cog fa-fw myicons"></i> <span class="mini-click-non">OPD Masters</span> 
                        </a>
                        <ul class="ml-menu">
                            @if($permissions['2_admin/doctor/create']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ route('doctor.create') }}">Add Doctor & Fees</a>
                            </li>
                            @endif
                            @if($permissions['15_settings']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('settings') }}">General Sttings</a>
                            </li>
                            @endif
                            @if($permissions['15_LogoAddEdit/4']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/4') }}"> Add Letter Head Top</a>
                            </li>
                            @endif

                            @if($permissions['15_LogoAddEdit/5']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item">
                                <a href="{{ url('/LogoAddEdit/5') }}">Add Letter Head Footer</a>
                            </li>
                            @endif
                            @if($permissions['11_ipd-settings']->listing_permission || AUTH::user()->role == 1)
							<li class="nav-item"> 
                                <a href="{{url('/ipd-settings')}}"> IPD Masters
                               </a>
                            </li>
                            @if($permissions['downloaddatabase']->listing_permission || AUTH::user()->role == 1)
                            <li>
                                <a href="{{ route('downloaddatabase')}}"> Backup Database</a>
                            </li>
                            @endif
                          
                        </ul>
                    </li>
  @endif 
 
			 @if($parent_menu[10]->status == 1) 

             @php
//echo "===>>>>>>>>>>>> <pre>"; print_r($permissions); exit;
@endphp

@if($permissions['10_opd-bill-report']->listing_permission || $permissions['10_opd-bill-payment-report']->listing_permission || $permissions['10_opd-bill-balance-report']->listing_permission || AUTH::user()->role == 1)
<li class="">
	<a href="javascript:void(0);" class="has-arrow">
		<i class="fas fa-file-medical-alt myicons" aria-hidden="true"></i><span class="mini-click-non">OPD Bill Reports</span>
	</a>
	<ul class="ml-menu nav-treeview">
    @if($permissions['10_opd-bill-report']->listing_permission || AUTH::user()->role == 1)
		<li class="nav-item">
			<a href="{{ url('opd-bill-report') }}">OPD Bill Report</a>
		</li>
    @endif
    @if($permissions['10_opd-bill-payment-report']->listing_permission || AUTH::user()->role == 1)
		<li class="nav-item">
			<a href="{{ url('opd-bill-payment-report') }}">OPD Bill Payment Report</a>
		</li>
    @endif
    @if($permissions['10_opd-bill-balance-report']->listing_permission || AUTH::user()->role == 1)
		<li class="nav-item">
			<a href="{{ url('opd-bill-balance-report') }}">OPD Bill Balance Report</a>
		</li>
    @endif   
	</ul>
</li>

@endif
@endif
			 @if($parent_menu[11]->status == 1) 

@if($permissions['11_register']->listing_permission || $permissions['11_patients-listing']->listing_permission || $permissions['11_ipd-settings']->listing_permission ||  $permissions['11_upload-document-listing']->listing_permission || AUTH::user()->role == 1)
				<li class="">
                        <a href="javascript:void(0);" class="has-arrow">
                            <i class="fa fa-file fa-fw myicons"></i>
                            <span class="mini-click-non"> IPD Patient </span>
                        </a>
                        <ul class="ml-menu nav-treeview">
                        @if($permissions['11_register']->listing_permission || AUTH::user()->role == 1)
                            <li class="nav-item"> 
                                <a href="{{url('/register')}}"> IPD Patient Register
                               </a>
                            </li>
	@endif
                        <!-- @if($permissions['11_register']->listing_permission || AUTH::user()->role == 1) -->
                            <li class="nav-item"> 
                                <a href="{{url('/consent')}}"> Consent Form
                               </a>
                            </li>
	<!-- @endif -->

                            @if($permissions['11_patients-listing']->listing_permission || AUTH::user()->role == 1)
							<li class="nav-item"> 
                                <a href="{{url('/patients-listing')}}"> IPD Patient Listing
                               </a>
                            </li>
	@endif
                            <li class="nav-item"> 
                                <a href="{{url('/refund-payment')}}"> Refund Payment
                               </a>
                            </li>
    
							<!--<li class="nav-item"> 
                                <a href="{{url('/patients_ipd/patientBill')}}"> Patient Bill
                               </a>
                            </li>-->

                            
	@endif

                            @if($permissions['11_upload-document-listing']->listing_permission || AUTH::user()->role == 1)
							<li class="nav-item"> 
                                <a href="{{url('/upload-document-listing')}}"> IPD Uploaded Documents
                               </a>
                            </li>
	@endif
                        </ul>
                    </li>	

	@endif
@endif
@php
   // echo "<pre>"; print_r($parent_menu); exit;
@endphp
					 @if($parent_menu[11]->status == 1) 

@if($permissions['12_new-ipd-bill-report']->listing_permission || $permissions['12_new-ipd-bill-payment-report']->listing_permission || $permissions['12_new-ipd-bill-balance-report']->listing_permission || AUTH::user()->role == 1)

<li class="">
	<a href="javascript:void(0);" class="has-arrow">
		<!--<i class="fas fa-file-medical-alt myicons" aria-hidden="true"></i><span class="mini-click-non">New Ipd Reports</span> -->
        <i class="fas fa-file-medical-alt myicons" aria-hidden="true"></i><span class="mini-click-non">IPD Reports</span>
	</a>
	<ul class="ml-menu nav-treeview">
        @if($permissions['12_new-ipd-bill-report']->listing_permission || AUTH::user()->role == 1)
                    
                    <li class="nav-item">
                <a href="{{ url('new-ipd-bill-report') }}">IPD Bill Report</a>
            </li>
        @endif
        @if($permissions['12_new-ipd-bill-payment-report']->listing_permission || AUTH::user()->role == 1)
            <li class="nav-item">
                <a href="{{ url('new-ipd-bill-payment-report') }}">IPD Bill Payment Report</a>
            </li>
        @endif
        @if($permissions['12_new-ipd-bill-balance-report']->listing_permission || AUTH::user()->role == 1)
            <li class="nav-item">
                <a href="{{ url('new-ipd-bill-balance-report') }}">IPD Bill Balance Report</a>
            </li>
        @endif
	</ul>
</li>
@endif
@endif

 @if($parent_menu[7]->status == 1) 
                   @if($permissions['users']->listing_permission || $permissions['user_permissions']->listing_permission || $permissions['downloaddatabase']->listing_permission || AUTH::user()->role == 1)
                    <li>
                       <a href="javascript:void(0);" class="has-arrow">
                           <i class="fa fa-users fa-fw myicons"></i> <span class="mini-click-non">User</span> 
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

                            
                           
                        </ul>
                    </li>
                    @endif
  @endif

  

<!-- ============================================================= -->
@if(env('layoutTemplate') == "shared/layout2022")
@if($permissions['16_new_website']->listing_permission || AUTH::user()->role == 1)   
                      <li class="">
                        <a href="javascript:void(0);" class="has-arrow">
                            <i class="fa fa-paper-plane myicons" aria-hidden="true"></i> <span class="mini-click-non"> Website Settings</span>
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
                                <a href="{{ url('certificate-list') }}">Upload Certificates</a>
                            </li>
							
                            <li class="nav-item">
                                <a href="{{ route('services-list') }}">Upload Services</a>
                            </li>
							
                            <li class="nav-item">
                                <a href="{{ url('consultant-list') }}">Upload Consultant</a>
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
                    @endif
@endif
			<!-- ======================================================== -->

                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
													<i class="educate-icon educate-nav"></i>
												</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                                
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
															<img src="img/product/pro4.jpg" alt="" />
															<span class="admin-name">Admin</span>
															<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
														</a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                                <div class="icon-circle bg-light-green">
                                                                </div>
                                                                <div class="menu-info">
                                                                    <h4>Sign Out </h4> 
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li><a href="{{ route('changePassword') }}"><div class="icon-circle bg-cyan">
                                                        </div>
                                                        <div class="menu-info">
                                                            <h4>Change Password</h4>
                                                        </div></a>
                                                        </li>
                                                        
                                                        </li>
                                                    </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="breadcome-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')   
    </div>

    <!-- jquery
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/jquery.scrollUp.min.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/counterup/jquery.counterup.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/counterup/waypoints.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/metisMenu/metisMenu.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/morrisjs/raphael-min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/morrisjs/morris.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/morrisjs/morris-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/sparkline/jquery.sparkline.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/sparkline/jquery.charts-sparkline.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/calendar/moment.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/calendar/fullcalendar.min.js"></script>
    <script src="{{ url('/')}}/assets/js_new_template/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="{{ url('/')}}/assets/js_new_template/main.js"></script>
</body>

</html>