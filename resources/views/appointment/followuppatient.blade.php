@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
  
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  @include('shared.error')
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  {{ Session::get('flash_message') }}
                  </div>
                  @endif
        
          <div class="card">
           <form action="{{ url('/patientDetails/SaveKYC' ) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Follow Up Patient</h2>
          </div>
        
              
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Doctor :</label>
                              </div>
                              </div>

                              
                              <div class="col-md-4">
                              {{ Form::select('doctor_id', array(''=>'Please select') + $doctorlist->toArray(), Request::old('appDetails.doctor_id', $appDetails->doctor_id), array('class' => 'form-control', 'required','data-live-search'=>'true')) }}
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Case Number :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('case_number', Request::old('case_number'), array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Type Patient Name / mobile no / case number / UHID no')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">UHID no. :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('uhid_no', Request::old('uhid_no'), array('class' => 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Visit Time :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('visit_time', $appDetails->visit_time, array('class' => 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Patient Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_name', $appDetails->patient_name, array('class' => 'form-control', 'required')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Patient Address :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_address', Request::old('patient_address'), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Referred By :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_emailId', $appDetails->patient_emailId, array('class' => 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Patient Age :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_age', $appDetails->patient_age, array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Patient Mobile No. :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_mobile', Request::old('patient_mobile', $appDetails->patient_mobile), array('class' => 'form-control', 'required')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Gender :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="demo-radio-button" style="padding-top: 6px">

                              <input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required   />
                              <label for="radio_8">Male</label>

                              <input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple"value="Female" required  />
                              <label for="radio_10">Female</label>

                              <input type="hidden" name="appointment_Id" id="appointment_Id" value="{{ $appDetails->id }}"   />

                              </div>
                              </div>
                              </div>
                          </div>
                           
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Doctor Fee :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::input('number', 'doctor_fee', Request::old('doctor_fee', $appDetails->doctor_fee), array('class' => 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>
                           
                         
                        
                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                  <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                                  <i class="glyphicon glyphicon-plus btnicons"></i> Submit
                                  </button>
                                  &nbsp;
                                  <button type="submit" name="submitMsg" class="btn btn-success btn-lg" value="submitMsg" >
                                   <i class="glyphicon glyphicon-plus btnicons"></i> Submit & Msg.
                                  </button>&nbsp;
                                  <a class="btn btn-default btn-lg" href="{{ url('/appointmentlist') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Appointment</a>
                                  &nbsp;
                                  <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Patient List</a>

                                      
                                </div>
                                </div>
                               
                            </div>
                </div>
           </form>
            </div>
        </div>
</div>
</div>


        @endsection
  
  @section('scripts')
<script type="text/javascript">
    
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
    });
</script>

<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>

<script>    
     jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} ">
</script>
<script>
        var url = "{{ url('/GetCaseIdByPatientNameMobile') }}";
        jq(".autocompleteTxt").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ url('/GetCaseIdByPatientNameMobile') }}",
                    dataType: "json",
                    data: {
                        query: request.term,
                        PropertyName: jq(this.element).attr('name'),//'Complaints' 
                        tableName: 'eyeform'
                    },
                    success: function(data) {

                        // response($.map(data, function (item) {
                        //     return { 
                        //             value: item.value,
                        //             label: item.label,
                        //             patient_name: item.patient_name,
                        //             patient_mobile: item.patient_mobile
                        //         };
                        // }));
                        //data = JSON.parse(JSON.stringify(data));
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                jq("#case_number").val(ui.item.value);
                $('input[name="patient_name"]').val(ui.item.patient_name);
                $('input[name="patient_mobile"]').val(ui.item.patient_mobile);
                $('input[name="patient_address"]').val(ui.item.patient_address);
                $('input[name="patient_emailId"]').val(ui.item.patient_emailId);
                $('input[name="patient_age"]').val(ui.item.patient_age);
                $('input[name="uhid_no"]').val(ui.item.uhid_no);
                $('input[name="male_female"][value='+ ui.item.male_female +']').attr('checked', 'checked');
                $('#doctor_id').val(ui.item.doctor_id);
                return false; // Prevent the widget from inserting the value.
            }
        });
</script>
<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
@endsection