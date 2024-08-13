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

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
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
          <form action="{{ url('/IPD/Discharge'.( empty($patientRegister->id) ? "/0" : ("/" . $patientRegister['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                 @if (!empty($patientRegister->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif

          <div class="header bg-pink">
          <h2>Add/Edit discharge </h2>
          </div>
           <input type="hidden" id="id" name="id" value="{{ $ipdDischarge->id or ''}}" >
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('name','Patient Name') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('name', Request::old('name',$patientRegister->name), array('class' => 'form-control', 'readonly', 'autocomplete'=>'off')) }}                           
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
                              <label class="form-control">IPD No. :</label>
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
                              <label class="form-control"> Patient :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              {{ Form::select('patient_id', array(''=>'Please select') + $patientRegisterList->pluck('name','id')->toArray(), Request::old('patient_id',$ipdDischarge->patient_id), array('class' => 'form-control select2',  'id'=>'patient_id','data-live-search'=>'true')) }}
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Consulting Doctor :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('consultant_doctor', Request::old('consultant_doctor',$patientRegister->consultant_doctor), array('class' => 'form-control', 'autocomplete'=>'off')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('registration_date','D.O.A') }}
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
                              {{ Form::label('dod','D.O.D.') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('dod', Request::old('dod',$ipdDischarge->dod), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                             
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
                              {{ Form::textarea('diagnosis', Request::old('diagnosis',$ipdDischarge->diagnosis), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                        
                  </div>
                   </div>
                              </div>

                         
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('clinical_notes','Clinical Notes') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('clinical_notes', Request::old('clinical_notes',$ipdDischarge->clinical_notes), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
                  </div>
                  </div>
                              </div>

                            

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('investigation_findings','Investigation findings') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('investigation_findings', Request::old('investigation_findings',$ipdDischarge->investigation_findings), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
                             </div>
                  </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('treatment_given','Treatment Given') }} 
                              </div>
                              </div>

                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('treatment_given', Request::old('treatment_given',$ipdDischarge->treatment_given), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                        
                              </div>
                  </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('operative_notes','Operative Notes') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('operative_notes', Request::old('operative_notes',$ipdDischarge->operative_notes), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
                              </div>
                  </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('treatment_advice','Treatment Advice') }} 
                              </div>
                              </div>

                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('treatment_advice', Request::old('treatment_advice',$ipdDischarge->treatment_advice), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                         
                             </div>
                  </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('next_visit','Next Visit') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('next_visit', Request::old('next_visit',$ipdDischarge->next_visit), array('class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                        
                             </div>
                  </div>
                              </div>

                          </div>
          
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                               <i class="fa fa-plus"></i> Submit
                               </button>
                                 <a class="btn btn-default btn-lg" href="{{ url('/IPD/Discharge') }}" ><i class="glyphicon glyphicon-print"></i> Back </a>
                                <a class="btn btn-default btn-lg" href="{{ url('/IPD/Discharge/print').'/'.$ipdDischarge->patient_id  }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>
                                <a class="btn btn-default btn-lg" href="{{ route('case_masters.index') }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>


                                                  
                                </div>
                                </div>
                               
                            </div>
                </div>
           </form>
            @include('ipd_discharge.prescription_add', ['id'=>$patientRegister->id])
            </div>
        </div>
</div>
</div>

  @endsection
  @section('scripts')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>


<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
     <script type="text/javascript">
       $(document).ready(function() {
       });
       $(".select2").select2();
     </script>
  @endsection  