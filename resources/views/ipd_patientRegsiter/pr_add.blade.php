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
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
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
          <form action="{{ url('/IPD/patientRegsiter'.( empty($patientRegister->id) ? "/0" : ("/" . $patientRegister['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (!empty($patientRegister->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif
          <div class="header bg-pink">
          <h2>Register</h2>
          </div>
              <div class="body">
                  <div class="row clearfix ">
                  <input type="hidden" id="id" name="id" value="{{ $patientRegister['id'] or ''}}" >
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('name','Patient Name') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              {{ Form::select('name', array(''=>'Please select') + $names->toArray(),Request::old('name',$patientRegister->name),array('class' => 'form-control autocompleteTxt select2', 'autocomplete'=>'off','data-live-search'=>'true')) }}
                           
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('guardian_name','Guardian Name') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('guardian_name', Request::old('guardian_name',$patientRegister->guardian_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="address" class="control-label">Address</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('address', Request::old('address',$patientRegister->address), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('mobile_no','Mobile no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('mobile_no', Request::old('mobile_no',$patientRegister->mobile_no), array('class' => 'form-control', 'autocomplete'=>'off')) }} 
                              </div>
                              </div>
                              </div>
                            </div>
                                 
                                 <!-- One row start -->
                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                            {{ Form::label('phone_no','Phone no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('phone_no', Request::old('phone_no',$patientRegister->phone_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('email_id','Email ID.') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('email_id', Request::old('email_id',$patientRegister->email_id), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                            </div>



                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                            {{ Form::label('blood_group','Blood Group') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                   <div class="form-line">
                              {{ Form::text('blood_group', Request::old('blood_group',$patientRegister->blood_group), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('gender','Gender') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              {{ Form::select('gender', array(''=>'Please select') + ['Male'=>'Male','Female'=>'Female'], Request::old('gender',$patientRegister->gender), array('class' => 'form-control select2',  'id'=>'gender','data-live-search'=>'true')) }}                     
                              
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('date_of_birth','DOB') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('date_of_birth', Request::old('date_of_birth',$patientRegister->date_of_birth), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('age','Age') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('age', Request::old('age',$patientRegister->age), array('class'=>'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                            </div>
                  
                               <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('maritial_status','Maritial Status') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              
                               {{ Form::select('maritial_status', array(''=>'Please select') + ['Single'=>'Single','Married'=>'Married'], Request::old('maritial_status',$patientRegister->maritial_status), array('class' => 'form-control select2', 'autocomplete'=>'off','data-live-search'=>'true')) }}                           
                             
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('registration_date','Admit Date') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('registration_date', Request::old('registration_date',$patientRegister->registration_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('registration_time','Time') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('registration_time', Request::old('registration_time',$patientRegister->registration_time), array('class' => 'form-control', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                            {{ Form::label('room_no','Room No.') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('room_no', Request::old('room_no',$patientRegister->room_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('package','Package') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                             
                              {{ Form::select('package', array(''=>'Please select') + ['Yes'=>'Yes','No'=>'No'], Request::old('package',$patientRegister->package), array('class' => 'form-control select2', 'autocomplete'=>'off','data-live-search'=>'true')) }}                          
                             
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('uhid_no','UHID No.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('uhid_no', Request::old('uhid_no',$patientRegister->uhid_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                              <label for="ipd_no" class="control-label">IPD No.</label></div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                                 {{ Form::text('ipd_no', Request::old('ipd_no',$patientRegister->ipd_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div> 
                             </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             {{ Form::label('case','Case') }} 
                            </div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                                 {{ Form::text('case', Request::old('case',$patientRegister->case), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                               </div>
                              </div> 
                             </div>

                            </div>



                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             {{ Form::label('ref_doctor','Ref. Doctor') }} 
                             </div>
                             </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                 {{ Form::text('ref_doctor', Request::old('ref_doctor',$patientRegister->ref_doctor), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div> 
                             </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             {{ Form::label('consultant_doctor','Consulting Doctor') }}
                            </div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                                 {{ Form::text('consultant_doctor', Request::old('consultant_doctor',$patientRegister->consultant_doctor), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                               </div>
                              </div> 
                             </div>

                            </div>

                    
                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('department','Department') }} 
                             </div>
                             </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                 {{ Form::text('department', Request::old('department',$patientRegister->department), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div> 
                             </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                               {{ Form::label('specialisation','Specialisation') }} 
                            </div>
                             </div>

                             <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                                 {{ Form::text('specialisation', Request::old('specialisation',$patientRegister->specialisation), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                               </div>
                              </div> 
                             </div>

                            </div>


                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                           {{ Form::label('presenting_complaint','Presenting Complaints') }} 
                             </div>
                             </div>

                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                            {{ Form::text('presenting_complaint', Request::old('presenting_complaint',$patientRegister->presenting_complaint), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
                            </div> 
                            </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('drug_sensitivity','Drug sensitivity') }} 
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                            {{ Form::text('drug_sensitivity', Request::old('drug_sensitivity',$patientRegister->drug_sensitivity), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
                            </div> 
                            </div>

                            </div>


                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             {{ Form::label('family_history','Family History') }} 
                             </div>
                             </div>

                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                            {{ Form::text('family_history', Request::old('family_history',$patientRegister->family_history), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
                            </div> 
                            </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('remark','Remark') }} 
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                            {{ Form::text('remark', Request::old('remark',$patientRegister->remark), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
                            </div> 
                            </div>

                            </div>


                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             {{ Form::label('advance','Advance') }}  
                             </div>
                             </div>

                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                            {{ Form::text('advance', Request::old('advance',$patientRegister->advance), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
                            </div> 
                            </div>

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('payment_mode','Payment Mode') }} 
                            </div>
                            </div>

                            <div class="col-md-4">
                            <div class="form-group">
          {{ Form::select('payment_mode', array(''=>'Please select') + ['Cash'=>'Cash', 'Credit Card'=>'Credit Card', 'Debit Card'=>'Debit Card', 'Cheque'=>'Cheque'], Request::old('payment_mode',$patientRegister->payment_mode), array('class' => 'form-control select2', 'autocomplete'=>'off','data-live-search'=>'true')) }}
                            
                            </div> 
                            </div>

                            </div>

                            <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                             {{ Form::label('debit_ac','Debit A/C') }} 
                             </div>
                             </div>

                            <div class="col-md-4">
                            <div class="form-group">
                            <div class="form-line">
                            {{ Form::text('debit_ac', Request::old('debit_ac',$patientRegister->debit_ac), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
                            </div> 
                            </div>
                            </div>
                            <!-- End Of row -->
                            </div>    

                               <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                               <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                               <i class="glyphicon glyphicon-plus btnicons"></i> Submit
                                </button>&nbsp;
                                {{-- <a class="btn btn-default" href="{{ url('/eyeoperation') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> --}}
                                <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientRegsiter') }}" ><i class="glyphicon glyphicon-print"></i> Back </a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ route('case_masters.index') }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>   
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
<!--<script type="text/javascript">
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
    });
</script>-->
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>

<script>    
     jq = $.noConflict(true);
     //alert(jq);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} ">
</script>
<script>

    $("#name").change(function() {
     var id = $('#name').val();
     
                $.ajax({
                    url: "{{ url('GetPatientName') }}/"+id,
                    dataType: 'json',
                    success: function(response) {
              var len = 0;
              if(response['data'] != null){
              len = response['data'].length;
              }

              if(len > 0){

              for(var i=0; i<len; i++)
              {
               var id = response['data'][i].id;
                 var guardian_name = response['data'][i].guardian_name;
                 var address = response['data'][i].address;
                 var mobile_no = response['data'][i].mobile_no;
                 var phone_no = response['data'][i].phone_no;
                 var blood_group = response['data'][i].blood_group;
                 var gender = response['data'][i].gender;
                 var date_of_birth = response['data'][i].date_of_birth;
                 var age = response['data'][i].age;
                 var weight = response['data'][i].weight;
                 var registration_date = response['data'][i].registration_date;
                 var discharge_date = response['data'][i].discharge_date;
                 var discharge_time = response['data'][i].discharge_time;
                 var room_no = response['data'][i].room_no;
                 var uhid_no = response['data'][i].uhid_no;
                 var ipd_no = response['data'][i].ipd_no;
                 var ref_doctor = response['data'][i].ref_doctor;
                 var email_id = response['data'][i].email_id;
                 var maritial_status = response['data'][i].maritial_status;
              } 

              //alert(guardian_name);

               $('input[name="guardian_name"]').val(guardian_name);
                $('textarea[name="address"]').val(address);
                $('input[name="mobile_no"]').val(mobile_no);
                $('input[name="phone_no"]').val(phone_no);
                $('input[name="blood_group"]').val(blood_group);
                $("#gender").val(gender);
                $("#gender").selectpicker("refresh");
                $('input[name="date_of_birth"]').val(date_of_birth);
                $('input[name="age"]').val(age);
                $('input[name="weight"]').val(weight);
                $('input[name="registration_date"]').val(registration_date);
                $('input[name="discharge_date"]').val(discharge_date);
                $('input[name="discharge_time"]').val(discharge_time);
                $('input[name="room_no"]').val(room_no);
                $('input[name="uhid_no"]').val(uhid_no);
                $('input[name="ipd_no"]').val(ipd_no);
                $('input[name="ref_doctor"]').val(ref_doctor);
                $('input[name="email_id"]').val(email_id);
                $("#maritial_status").val(maritial_status);
                $("#maritial_status").selectpicker("refresh");
              }
              }
            
        });  
      
           
        });
</script>

<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection
