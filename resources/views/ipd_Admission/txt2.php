@extends('adminlayouts.master')
@section('content')
<section class="content">
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
                              <div class="form-line">
                              {{ Form::text('name', Request::old('name',$patientRegister->name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
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
                              {{ Form::text('ipd_no', Request::old('ipd_no',$patientRegister->ipd_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
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
                              {{ Form::text('blood_group', Request::old('blood_group',$patientRegister->blood_group), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('gender','Gender') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::select('gender', array(''=>'Please select') + ['Male'=>'Male','Female'=>'Female'], Request::old('gender',$patientRegister->gender), array('class' => 'form-control',  'id'=>'gender')) }}                         
                              </div>
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
                              <div class="form-line">
                               {{ Form::select('maritial_status', array(''=>'Please select') + ['Single'=>'Single','Married'=>'Married'], Request::old('maritial_status',$patientRegister->maritial_status), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
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
                              <div class="form-line">
                              {{ Form::select('package', array(''=>'Please select') + ['Yes'=>'Yes','No'=>'No'], Request::old('package',$patientRegister->package), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
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
                            <div class="form-line">
                            {{ Form::select('payment_mode', array(''=>'Please select') + ['Cash'=>'Cash', 'Credit Card'=>'Credit Card', 'Debit Card'=>'Debit Card', 'Cheque'=>'Cheque'], Request::old('payment_mode',$patientRegister->payment_mode), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                            </div>
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
                               <button type="submit" name="submit" class="btn btn-success" value="submit" >
                               <i class="fa fa-plus"></i> Submit
                                </button>
                                {{-- <a class="btn btn-default" href="{{ url('/eyeoperation') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> --}}
                                <a class="btn btn-default" href="{{ url('/IPD/patientRegsiter') }}" ><i class="glyphicon glyphicon-print"></i> Back </a>
                                <a class="btn btn-default" href="{{ url('/PatientMedicalDetails').'/'.$patientRegister->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>   
                                </div>
                                </div> 
                            </div>
                </div>
           </form>
            </div>
        </div>
</div>
</div>
</section>

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
@endsection
