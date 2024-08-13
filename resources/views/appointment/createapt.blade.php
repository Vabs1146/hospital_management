<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Appointment</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create appointment11</h3>
              </div>
    <div class="card-body">
     <div class="col-md-12">
  <form class="form-horizontal" name="createAppointment" id="createAppointment" action="#" autocomplete="off">
 <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}" value="{{ csrf_token() }}">
     <div class="form-group row">
                        <label class="control-label col-sm-2" for=""></label>
                        <div class="col-sm-9">
                            <span id="submitMessage"></span>
                            <div class="alert print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
          <div class="form-group row">
           <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
           </div>
          </div>


             <div class="form-group row">
         <label for="mobile_no" class="col-sm-2 control-label">Mobile No:</label>
            <div class="col-sm-9">
            <input type="text" name="name" id="name" class="form-control" value="">
           </div>
          </div>

         <div class="form-group row">
         <label for="mobile_no" class="col-sm-2 control-label">Mobile No:</label>
            <div class="col-sm-9">
            <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="">
           </div>
          </div>

          <div class="form-group row">
         <label for="doctor_id" class="col-sm-2 control-label">Doctor:</label>
            <div class="col-sm-9">
            <select name="doctor_id" id="doctor_id" class="form-control" placeholder="select your doctor">
                              
                               <?php 
                                    foreach($doctorlist11 as $doclist){
                                ?>
                               <option value="{{ $doclist->id }}">{{ $doclist->doctor_name }}</option>
                           <?php } ?>
                           </select>
           </div>
          </div>

          <div class="form-group row">
         <label for="mobile_no" class="col-sm-2 control-label">Appointment Date:</label>
            <div class="col-sm-9">
           <input type="text" class="datepicker form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date." data-date-format="yyyy-mm-dd" required>
           </div>
          </div>

          <div class="form-group row">
         <label for="mobile_no" class="col-sm-2 control-label">Time Slot:</label>
            <div class="col-sm-9">
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
            </div>
             <div class="card-footer">
                <button type="submit" class="btn btn-default" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                    <a href="{{ url('/') }}" class="btn btn-default" > Home </a>
                </div>
                 </form> 
            </div>
          </div>
        </div>
      </div>
    </section>

<script src="{{ url('/')}}/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/')}}/assets/dist/js/adminlte.min.js"></script>
</body>
</html>