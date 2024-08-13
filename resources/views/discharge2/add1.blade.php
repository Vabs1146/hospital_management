@extends('adminlayouts.master')
<style type="text/css">
  .medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
  color: #700;
  cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
  color: #f00;
}

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
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
                         <div class="header bg-pink">
                            <h2>
                               Discharge Summary
                            </h2>
                          
                        </div>
                    
               

                        <div class="body">
                          <form action="{{ url('/discharge2'.( isset($case_master) ? "/1/" . $case_master['id'] : "")) }}" method="POST" enctype = 'multipart/form-data' >
                          {{ csrf_field() }}
                         <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number" class="form-control">Case Number :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">              
                              </div>
                              </div>
                              </div> 

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="patient_name" class="form-control">Name Of Patient :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                                <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
                              </div>  
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="name_of_age" class="form-control">Age :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}"></div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="male_female" class="form-control">Sex :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                               <div class="form-group" style="padding-top: 6px">
                          
                              <input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked=\"checked\"" : "" }}   />
                              <label for="radio_8">Male</label>
                              <input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" required   {{ ($case_master->male_female == "Female")? "checked=\"checked\"" : "" }} />
                              <label for="radio_10">Female</label>
                             
                              </div>
                              </div>   
                              </div> 

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('IPD_no','IPD no.') }} 
                              </div>
                              </div>
 
                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('IPD_no', Request::old('IPD_no',$discharge2->IPD_no), array('class' => 'form-control')) }}</div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('patient_address','Address') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_address', Request::old('patient_address',$case_master->patient_address), array('class' => 'form-control')) }}
                              </div>
                              </div>
                              </div>
                              </div> 

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('patient_mobile','Tel.') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_mobile', Request::old('patient_mobile',$case_master->patient_mobile), array('class' => 'form-control')) }}            
                              </div>
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('admission_date_time','Admission Date & Time') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('admission_date_time', Request::old('admission_date_time',$case_master['admission_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
                              </div>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('surgery_date_time','Surgery Date & Time') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master['surgery_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
                              </div>
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('discharge_date_time','Discharge Date & Time ') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('discharge_date_time', Request::old('discharge_date_time',$case_master['discharge_date_time']), array('class' => 'form-control datetimepicker')) }}
                              </div>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('diagnosis','Diagnosis') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('diagnosis', Request::old('diagnosis',$case_master['diagnosis']), array('class' => 'form-control')) }}            
                              </div>
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('systemic_diseases','Systemic Diseases') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('systemic_diseases', Request::old('systemic_diseases',$discharge2->systemic_diseases), array('class' => 'form-control')) }}
                              </div>
                              </div>
                              </div>
                              </div>

                             
                              <div class="col-md-12">
                                

                                 <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('general_condition','General Condition') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('general_condition', Request::old('general_condition',$discharge2->general_condition), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>
                                
                              </div>
                               <div class="col-md-12">
                                <legend>OPERATION NOTES</legend>
                                <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('anesthesia_procedure','Anesthesia ') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('anesthesia_procedure', Request::old('anesthesia_procedure',$discharge2->anesthesia_procedure), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>

                                 <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('procedure','Procedure') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('procedures', Request::old('procedures',$discharge2->procedures), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>
                                
                              </div>
                               <div class="col-md-12">
                                <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('name_of_iol','Name Of IOL') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('name_of_iol', Request::old('name_of_iol',$discharge2->name_of_iol), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>

                                 <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('post_operative','Post Operative') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('post_operative', Request::old('post_operative',$discharge2->post_operative), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>
                                
                              </div>
                              <div class="col-md-12">
                                <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('advice','Advice') }}
                                </div>
                                </div>

                                <div class="col-md-8">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::textarea('advice', Request::old('advice',$discharge2->advice), array('class' => 'form-control advicetxtarea')) }}
                                </div>
                                </div>
                                </div>

                                 
                                
                              </div>

                               <div class="col-md-12">
                                <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('review','Review') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('review', Request::old('review',$discharge2->review), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <div class="form-group labelgrp">
                                {{ Form::label('surgeon_name','Surgeon Name') }}
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::text('surgeon_name', Request::old('surgeon_name',$discharge2->surgeon_name), array('class' => 'form-control')) }}
                                </div>
                                </div>
                                </div>

                                
                                
                              </div>
                             
                          <div class="col-md-12">
                          <div class="col-md-2">
                          <div class="form-group">
                           {{ Form::label('treatment_advised','Treatment Advised') }} 
                          </div> 
                          </div> 
                          <div class="col-md-10">
                         
                            {{ Form::textarea('treatment_advised', Request::old('treatment_advised',$discharge2->treatment_advised), array('class' => 'form-control')) }}
                     
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-2">
                          <div class="form-group">
                            {{ Form::label('followup','Followup') }}  
                          </div> 
                          </div> 
                          <div class="col-md-4">
                          <div class="form-group">
                          <div class="form-line">
                          {{ Form::text('followup', Request::old('followup',$discharge2->followup), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}
                          </div> 
                          </div> 
                          </div>
                          <div class="col-md-2">
                          <div class="form-group">
                            {{ Form::label('dischargeimg','Image Upload') }}  
                          </div> 
                          </div> 
                          <div class="col-md-4">
                          <div class="form-group">
                          <div class="form-line">
                         {{ Form::file('dischargeimg', Request::old('dischargeimg'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
                          </div> 
                          </div> 
                          </div>
                        </div>
                        
                         <div class="col-md-12">
                            <label class="form-label">
                                    In case of Emergency : 1. Severe Redness/watering pain or 2. Sudden diminished vision
                                    Pls. contact : 8055821212 ( Dr. Sandeep C. Joshi)                           
                            </label>
                        </div>
                            
                          
                             <div class="col-md-12">
                              <div class="col-md-9 col-md-offset-3">
                              <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                              </button>&nbsp;
                              <a class="btn btn-default btn-lg" href="{{ url('/discharge') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
                              <a class="btn btn-default btn-lg" href="{{ url('/discharge/print/1').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
                              <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
                              </div>
                              </div> 
                              </div>
                               </form> 
                                @include('shared.add_prescription', ['id'=>$case_master->id])

                            </div>                             
                                              
                        </div>
                        
             
                    </div>
                </div>
            </div>




 @endsection

@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.select2').select2();
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