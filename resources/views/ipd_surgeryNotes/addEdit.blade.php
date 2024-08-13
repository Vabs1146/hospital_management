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
          <form action="{{ url('/dynamicForm/'.$form_master->id.'/'.$patientRegister->id.'') }}" method="POST" class="form-horizontal" id="form_{{$patientRegister->id}}"
                enctype='multipart/form-data'>

                {{ csrf_field() }}

                

          <div class="header bg-pink">
          <h2>Surgery Operative Notes </h2>
          </div>
      
              {{ Form::hidden('register_id', $patientRegister->id ) }}
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["DelivaryNotes_Date"].']','Delivary Notes: Date of Delivary') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["DelivaryNotes_Date"].']', $form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->first()->field_data, array('class'=> 'form-control datepicker')) }}                          
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["DelivaryNotes_Time"].']','Delivary Time') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["DelivaryNotes_Time"].']', $form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Time"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Time"])->first()->field_data, array('class'=> 'form-control')) }}                       
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["NatureOfDelivary"].']','Nature Of Delivary') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["NatureOfDelivary"].']', $form_field_values->where('form_field_code', $field_name_id["NatureOfDelivary"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["NatureOfDelivary"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "SexOfBaby"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Sex of Baby') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                                <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                           </div>
                         </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               @php $fieldName = "BabyWeight"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Weight of Baby') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "PostNatalPeriod"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Post Natal Period') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "IndicationOfLSCS"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Indication of LSCS') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "Anaesthes Name"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','ANAESTHESIA: NAME OF ANAESTHES: SIGNATURE') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>
                           
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "TypeOfAnaesthesia"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','TYPE OF ANAESTHESIA') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "ComplicationAnaesthesia"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','ANY COMPLICATIONS DURING ANAESTHESIA') }} 
                              </div>
                              </div>

                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "RecoveryFromAnaesthesia"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','RECOVERY FROM ANAESTHESIA') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "Surgery"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','SURGERY') }}  
                              </div>
                              </div>

                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "MTP"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','MTP') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "TubalLigation"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','TUBAL LIGATION') }}
                              </div>
                              </div>

                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                       
                              </div>
                              </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "LAPTL"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','LAP TL') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>


                          </div>

                          <div class="col-md-12">
                            
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "Operative"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','OPERATIVE :') }} 
                              </div>
                              </div>

                               <div class="col-md-10">
                              
                              {{ Form::textarea('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control','rows'=>'4')) }} 

                             <!--  <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea> -->                       
                              
                              </div>
                          </div>
                              
                            <div class="col-md-12">
                            
                              <div class="col-md-2">
                             <div class="form-group labelgrp">
                              @php $fieldName = "LSCS"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','LSCS :') }}
                              </div>
                              </div>

                               <div class="col-md-10">
                              
                              {{ Form::textarea('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control','rows'=>'4')) }}                     
                              
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                             @php $fieldName = "HystecrectomyVaginalAbdominal"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','HYSTECRECTOMY: VAGINAL/ABDOMINAL') }} 
                              </div>
                              </div>


                              <div class="col-md-10">
                             
                              {{ Form::textarea('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control','rows'=>'4')) }}                     
                              
                              </div>

                          </div>

                        <div class="col-md-12">
                          <div class="col-md-2">
                              <div class="form-group labelgrp">
                             @php $fieldName = "OtherSurgery"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','OTHER SURGERY') }} 
                              </div>
                              </div>


                              <div class="col-md-10">
                              
                              {{ Form::textarea('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control','rows'=>'4')) }}                  
                            
                              </div>

                          </div>
                          </div>

                           <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                <i class="glyphicon glyphicon-plus btnicons"></i> Submit
                </button> &nbsp;

                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> &nbsp;

                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/view/').'/'.$form_master->id.'/'.$patientRegister->id }}"><i class="glyphicon glyphicon-chevron-left"></i> view</a> &nbsp;

                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-chevron-left"></i> print</a>


                                      
                                </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
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
@endsection