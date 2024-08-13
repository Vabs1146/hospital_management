@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }
</style>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
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
          <h2>Followup Patient </h2>
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
                              {{ Form::select('doctor_id', array(''=>'Please select') + $doctorlist->toArray(), Request::old('appDetails.doctor_id', $appDetails->doctor_id), array('class' => 'form-control select2', 'required' )) }}
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number" class="form-control">Case Number :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('case_number', Request::old('appDetails.case_number', $appDetails->case_number), array('class' => 'form-control ', 'placeholder'=>'Type Patient Name / mobile no / case number / UHID no')) }}                        
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
                              
                              {{ Form::text('uhid_no',Request::old('appDetails.uhid_no', $appDetails->uhid_no), array('class' => 'form-control')) }}                           
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
                              {{ Form::text('patient_address', Request::old('appDetails.patient_address', $appDetails->patient_address), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Email Id:</label>
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
                              {{ Form::text('patient_mobile', Request::old('patient_mobile', $appDetails->patient_mobile), array('class' => 'form-control')) }}                          
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
                              <input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male"   {{ ($appDetails->male_female == "Male")? "checked=\"checked\"" : "" }}  />
                              <label for="radio_8">Male</label>
                              <input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" \   {{ ($appDetails->male_female == "Female")? "checked=\"checked\"" : "" }} />
                              <label for="radio_10">Female</label>
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
                              <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                              </button>&nbsp;
                              <button type="submit" name="submitMsg" class="btn btn-success btn-lg" value="submitMsg"><i class="fa fa-plus"></i> Submit & Msg.
                              </button> &nbsp;
                              
                               <a class="btn btn-default btn-lg" href="{{ url('/followupappoinment/0') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Appointment</a>&nbsp;
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
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
     $(".select2").select2();
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
                // $('input[name="male_female"][value='+ ui.item.male_female +']').attr('checked', 'checked');
                $('#doctor_id').val(ui.item.doctor_id);
                return false; // Prevent the widget from inserting the value.
            }
        });
</script>

@endsection