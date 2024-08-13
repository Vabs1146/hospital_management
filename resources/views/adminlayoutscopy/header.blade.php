<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="favicon.ico" type="image/x-icon">
  

    <title>{{ config('app.name', 'Dr') }}</title>
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
   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.js'></script>
        <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" />
 
      <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>
        .sidebar{
    overflow-y: auto;
  }
     .fc-time
    {
     display: none;
    }

    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    </style>
    @yield('style')
 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">{{ config('app.name', 'Laravel') }}</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}"></a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->name }} 

                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li><a href="{{ url('/changePassword') }}"> Change Password </a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                @endif
     
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('/')}}/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
            @if(isset(Auth::user()->email))
      <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
        @else
                 <span class="brand-text font-weight-light">Admin</span>           
                         @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
    <!--   <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/')}}/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
 -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @can('isDoctor')
            <li class="nav-item has-treeview menu-open">
            <a href="{{ route('doctor.index') }}" class="nav-link ">
           <i class="fab fa-superpowers myicons"></i>
            <p>Doctor</p>
            </a>
            </li>
            @endcan


            @can('isAptpatientDetails')
            <li class="nav-item">
            <a href="{{url('/aptpatientDetails1/0')}}" class="nav-link">
            <i class="fab fa-superpowers myicons"></i>
            <p>Add Patinet Details</p>
            </a>
            </li>
            @endcan

            @can('isAppointmentlist')
            <li class="nav-item">
            <a href="{{ url('/appointmentlist/0') }}" class="nav-link">
            <i class="fas fa-calendar-alt myicons"></i>
            <p>Appointment Details</p>
            </a>
            </li>
            @endcan

            @can('isFollowupappoinment')
            <li class="nav-item">
            <a href="{{ url('followupappoinment/0') }}" class="nav-link">
            <i class="fas fa-calendar-alt myicons"></i>
            <p>Follow up Appointment</p>
            </a>
            </li>
            @endcan

            @can('isAppointment')
            <li class="nav-item">
            <a href="{{ url('/appointment') }}" target="_blank" class="nav-link">
           <i class="fas fa-calendar-alt myicons"></i>
            <p>Create Appointment</p>
            </a>
            </li>
            @endcan

            @can('isStop_appointments')
            <li class="nav-item">
            <a href="{{ route('stop_appointments.index') }}" class="nav-link">
            <i class="fas fa-calendar-alt myicons"></i>
            <p>Stop Appointment</p>
            </a>
            </li>
            @endcan

            @can('isUseraccess')
            <li class="nav-item">
            <a href="{{ url('useraccess/0') }}" class="nav-link">
           <i class="fas fa-calendar-alt myicons"></i>
            <p>User Access</p>
            </a>
            </li>
            @endcan

            @can('isAppointmentslot')
            <li class="nav-item">
            <a href="{{ route('appointmentslot') }}" class="nav-link">
            <i class="fas fa-calendar-alt myicons"></i>
            <p>Appointment Time Slot</p>
            </a>
            </li>
            @endcan

            @can('isCase_masters')
            <li class="nav-item">
            <a href="{{ route('case_masters.index') }}" class="nav-link">
            <i class="fa fa-edit fa-fw myicons"></i>
            <p>Patient Details</p>
            </a>
            </li>
            @endcan

            @can('isPatient_reports')
            <li class="nav-item">
            <a href="{{url('/patient/report')}}" class="nav-link">
            <i class="fa fa-edit fa-fw myicons"></i>
            <p>Patinet report</p>
            </a>
            </li>
            @endcan

            @can('isCase_masters_prescriptionlst')
            <li class="nav-item">
            <a href="{{ url('/case_masters/prescriptionlst') }}" class="nav-link">
            <i class="fab fa-renren myicons"></i>
            <p>Add/Print Prescription</p>
            </a>
            </li>
            @endcan


            @can('isReport_files')
            <li class="nav-item">
            <a href="{{ url('/report_files') }}" class="nav-link">
            <i class="fa fa-table fa-fw myicons"></i>
            <p>Add report file</p>
            </a>
            </li>
            @endcan


            @can('isFormDropDown')
            <li class="nav-item">
            <a href="{{ url('/formDropDown') }}" class="nav-link">
            <i class="fa fa-table fa-fw myicons"></i>
            <p>Form Field</p>
            </a>
            </li>
            @endcan

            @can('isBill_details')
            <li class="nav-item">
            <a href="{{ url('/bill_details') }}" class="nav-link">
            <i class="fa fa-adjust fa-fw myicons"></i>
            <p>OPD Bill</p>
            </a>
            </li>
            @endcan

            @can('isDoctorbill')
            <li class="nav-item">
            <a href="{{ url('/doctorbill') }}" class="nav-link">
            <i class="fa fa-file fa-fw myicons"></i>
            <p>Doctors Details</p>
            </a>
            </li>
            @endcan

          
            @can('isInsuranceBill')
            <li class="nav-item">
            <a href="{{ url('/insuranceBill') }}" class="nav-link">
            <i class="fa fa-file fa-fw myicons"></i>
            <p>Eye IPD Bill</p>
            </a>
            </li>
            @endcan

            @can('isGlassPrescription')
            <li class="nav-item">
            <a href="{{ url('/glassPrescription') }}" class="nav-link">
             <i class="fa fa-file fa-fw myicons"></i>
            <p>Eye Glass Prescription</p>
            </a>
            </li>
            @endcan

             @can('isMedicine')
            <li class="nav-item">
            <a href="{{ url('/Medicine') }}" class="nav-link">
            <i class="far fa-image myicons"></i>
            <p>Add Medicine</p>
            </a>
            </li>
            @endcan


             @can('isRating_list')
            <li class="nav-item">
            <a href="{{ url('/rating/list') }}" class="nav-link">
           <i class="far fa-image myicons"></i>
            <p>Ratings</p>
            </a>
            </li>
            @endcan


             @can('isOldregister')
            <li class="nav-item">
            <a href="{{ url('/oldregister') }}" class="nav-link">
           <i class="far fa-image myicons"></i>
            <p>Old register</p>
            </a>
            </li>
            @endcan


             @can('isSeo_add')
            <li class="nav-item">
            <a href="{{ url('/seo/add') }}" class="nav-link">
             <i class="fa fa-table fa-fw myicons"></i>
            <p>Add SEO Details</p>
            </a>
            </li>
            @endcan


             @can('isMenu_lists')
            <li class="nav-item">
            <a href="{{ route('menu_lists.index') }}" class="nav-link">
            <i class="fa fa-tree fa-fw myicons"></i>
            <p>Menu List</p>
            </a>
            </li>
            @endcan


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-home myicons"></i>
              <p>
               Home Page
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ulhomepage ">
              <li class="nav-item ">
                <a href="{{ route('image_galleries.index') }}" class="nav-link">
                    <i class="far fa-image myicons"></i>
                  <p>Slider</p>
                </a>
              </li>

               @can('isHomepage_LogoAddEdit')
              <li class="nav-item">
                <a href="{{ url('/LogoAddEdit/2') }}" class="nav-link">
                     <i class="far fa-image myicons"></i>
                  <p>Edit Logo</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_editletterhead')
              <li class="nav-item">
                <a href="{{ url('/LogoAddEdit/4') }}" class="nav-link">
                  <i class="far fa-image myicons"></i>
                  <p>Edit Letter Head</p>
                </a>
              </li>
              @endcan

              @can('isHomepage_editletterfooter') 
              <li class="nav-item">
                <a href="{{ url('/LogoAddEdit/5') }}" class="nav-link">
                    <i class="far fa-image myicons"></i>
                  <p>Edit Letter Footer</p>
                </a>
              </li>
              @endcan


               @can('ishomepage_body_editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/3/1') }}" class="nav-link">
                 <i class="fa fa-user fa-fw myicons"></i>
                  <p> body Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_body_layer2editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/4/1') }}" class="nav-link">
                  <i class="fas fa-cog myicons"></i>
                  <p>body layer 2 Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_body_layer3editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/6/1') }}" class="nav-link">
                  <i class="fas fa-cog myicons"></i>
                  <p>body layer 3 Editor</p>
                </a>
              </li>
              @endcan


               @can('isHomepage_body_layer4editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/7/1') }}" class="nav-link">
                <i class="fas fa-cog myicons"></i>
                  <p>body layer 4 Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_body_layer5editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/8/1') }}" class="nav-link">
                   <i class="fas fa-cog myicons"></i>
                  <p>body layer 5 Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_body_layer6editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/9/1') }}" class="nav-link">
                   <i class="fas fa-cog myicons"></i>
                  <p>body layer 6 Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_body_layer7editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/10/1') }}" class="nav-link">
                  <i class="fas fa-cog myicons"></i>
                  <p>body layer 7 Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_body_layer8editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/11/1') }}" class="nav-link">
                  <i class="fas fa-cog myicons"></i>
                  <p>body layer 8 Editor</p>
                </a>
              </li>
              @endcan

               @can('isHomepage_footer_editor') 
              <li class="nav-item">
                <a href="{{ url('/dynamic_text/5/1') }}" class="nav-link">
                 <i class="fas fa-sign-out-alt myicons"></i>
                  <p>Footer Editor</p>
                </a>
              </li>
              @endcan

            </ul>
          </li>

           @can('isBulk_sms') 
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fas fa-mobile-alt myicons"></i>
              <p>
                SMS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ulsms">
              <li class="nav-item">
                <a href="{{ url('/bulk_sms') }}" class="nav-link">
                    <i class="fas fa-mobile-alt myicons"></i>
                  <p>Bulk SMS</p>
                </a>
              </li>
                @endcan
               
               @can('isMember_sms') 
              <li class="nav-item">
                <a href="{{ url('/member_sms') }}" class="nav-link">
                  <i class="fas fa-mobile-alt myicons"></i>
                  <p>Member SMS</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>



            @can('iswritingCasePaper')
            <li class="nav-item">
            <a href="{{ url('writingCasePaper') }}" class="nav-link">
           <i class="fa fa-users fa-fw myicons"></i>
            <p>Writting Pad</p>
            </a>
            </li>
            @endcan

            @can('isImagegallary')
            <li class="nav-item">
            <a href="{{ route('gallery_list') }}" class="nav-link">
           <i class="far fa-image myicons"></i>
            <p>Image Gallary</p>
            </a>
            </li>
            @endcan

             @can('isStaff_users')
            <li class="nav-item">
            <a href="{{ url('/staff_users') }}" class="nav-link">
           <i class="fa fa-users fa-fw myicons"></i>
            <p>Add User</p>
            </a>
            </li>
            @endcan


             @can('isStaff_member')
            <li class="nav-item">
            <a href="{{ url('/staff_member') }}" class="nav-link">
            <i class="fa fa-users fa-fw myicons"></i>
            <p>Members Contact</p>
            </a>
            </li>
            @endcan


             @can('isDownloaddatabase')
            <li class="nav-item">
            <a href="{{ route('downloaddatabase')}}" class="nav-link">
            <i class="fa fa-users fa-fw myicons"></i>
            <p>Backup Database</p>
            </a>
            </li>
            @endcan

         
        </ul>
      </nav>
      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  </div>



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

    <!-- Flot Charts Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/flot-charts/jquery.flot.js"></script>
    <script src="{{ url('/')}}/assets/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="{{ url('/')}}/assets/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="{{ url('/')}}/assets/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="{{ url('/')}}/assets/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ url('/')}}/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="{{ url('/')}}/assets/js/admin.js"></script>
    <script src="{{ url('/')}}/assets/js/pages/index.js"></script>
     <script src="{{ url('/')}}/assets/js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="{{ url('/')}}/assets/js/demo.js"></script>
   
@yield('scripts')


</body>