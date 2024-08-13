@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

           <div class="form-group">
                  @include('shared.error')
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  {{ Session::get('flash_message') }}
                  </div>
                  @endif
              </div>
          <div class="card">
          <form action="{{ url('/dynamicForm/'.$form_master->id.'/'.$patientRegister->id.'') }}" method="POST" class="form-horizontal" id="form_{{$patientRegister->id}}"
                enctype='multipart/form-data'>

                {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Treatment Chart (Daily)</h2>
          </div>
           <!--    <div class="form-group">
                  @include('shared.error')
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  {{ Session::get('flash_message') }}
                  </div>
                  @endif
              </div> -->

              {{ Form::hidden('register_id', $patientRegister->id ) }}
              
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "Complaints"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','COMPLAINTS') }}
                              </div>
                              </div>

                              
                             <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             
                              {{ Form::textarea('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control advicetxtarea')) }}                            
                             
								  </div>
								 </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "GeneralCondition"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','GENERAL CONDITION : GOOD/FAIR/POOR') }} 
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
                              @php $fieldName = "Vital Parameter"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','VITAL PARAMETER: HR/PULSE') }}
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
                               @php $fieldName = "CAPILLARI REFILLING"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','CAPILLARI REFILLING') }}
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
                              @php $fieldName = "RR"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','RR') }} 
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
                              @php $fieldName = "TEMPURATURE"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','TEMP') }} 
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
                               @php $fieldName = "BP"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','B.P') }}
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
                              @php $fieldName = "SpO2"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Sp O2') }}
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
                              @php $fieldName = "general examination"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','GENERAL EXAMINATION') }} 
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
                              @php $fieldName = "systemicExaminationRS"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','SYSTEMIC EXAMINATION RS') }}
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

                          <Div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              @php $fieldName = "systemicExaminationCVS"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','SYSTEMIC EXAMINATION CVS') }} 
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
                              @php $fieldName = "systemicExaminationCNS"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','SYSTEMIC EXAMINATION CNS') }}
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
                              @php $fieldName = "systemicExaminationPA"; @endphp
                    {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','SYSTEMIC EXAMINATION PA') }} 
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
                         
                             
                  </div>    

            <div class="row clearfix">
             <div class="col-md-4 col-md-offset-2">
                <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                <i class="fa fa-plus"></i> Submit
                </button>

                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/view/').'/'.$form_master->id.'/'.$patientRegister->id }}"><i class="glyphicon glyphicon-chevron-left"></i> view</a>
                
                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-chevron-left"></i> print</a>

                </div>
             </div>
                               
           </div>
                </div>
           </form>
           @include('ipd_dailyTreatment.DailyNotes', ['id'=>$patientRegister->id])
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
@endsection