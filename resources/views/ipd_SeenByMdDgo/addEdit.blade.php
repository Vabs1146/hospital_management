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
          <h2>IPD Seen By MD, DGO </h2>
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
                              {{ Form::label('presenting_complaint','Provisional Diagnosis/Major Complaint') }} 
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
                              {{ Form::label('name','Family History') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('family_history', Request::old('family_history',$patientRegister->family_history), array('class' => 'form-control', 'autocomplete'=>'off')) }}                            
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('name','Past History') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('past_history', Request::old('past_history',$patientRegister->past_history), array('class' => 'form-control', 'autocomplete'=>'off')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                                {{ Form::label('field_data_singular['.$field_name_id["obstetric_history"].']','Obstetric History') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["obstetric_history"].']', $form_field_values->where('form_field_code', $field_name_id["obstetric_history"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["obstetric_history"])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["LMP"].']','LMP') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["LMP"].']', $form_field_values->where('form_field_code', $field_name_id["LMP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LMP"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["GRAVIDA"].']','GRAVIDA') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["GRAVIDA"].']', $form_field_values->where('form_field_code', $field_name_id["GRAVIDA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["GRAVIDA"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["EDD"].']','EDD') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["EDD"].']', $form_field_values->where('form_field_code', $field_name_id["EDD"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["EDD"])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["PARA"].']','PARA') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["PARA"].']', $form_field_values->where('form_field_code', $field_name_id["PARA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PARA"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>
                          </div>
                           
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["MTP"].']','MTP') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["MTP"].']', $form_field_values->where('form_field_code', $field_name_id["MTP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MTP"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["ABORTION"].']','ABORTION') }} 
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["ABORTION"].']', $form_field_values->where('form_field_code', $field_name_id["ABORTION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ABORTION"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('field_data_singular['.$field_name_id["PHYSICAL EXAMINATION"].']','PHYSICAL EXAMINATION') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["PHYSICAL EXAMINATION"].']', $form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["Vital Parameter"].']','Vital Parameter') }}
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["Vital Parameter"].']', $form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>
                         

                         <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["pulse"].']','pulse') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["pulse"].']', $form_field_values->where('form_field_code', $field_name_id["pulse"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pulse"])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["BP"].']','BP') }} 
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["BP"].']', $form_field_values->where('form_field_code', $field_name_id["BP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BP"])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>
                         

                         <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["respiratory rate"].']','respiratory rate') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["respiratory rate"].']', $form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["general examination"].']','general examination') }} 
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["general examination"].']', $form_field_values->where('form_field_code', $field_name_id["general examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["general examination"])->first()->field_data, array('class'=> 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>
                         

                         <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["pallor"].']','pallor') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["pallor"].']', $form_field_values->where('form_field_code', $field_name_id["pallor"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pallor"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["icterus"].']','icterus') }} 
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["icterus"].']', $form_field_values->where('form_field_code', $field_name_id["icterus"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["icterus"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>
                         

                         <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["rash"].']','rash') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["rash"].']', $form_field_values->where('form_field_code', $field_name_id["rash"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rash"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["cyanosis"].']','cyanosis') }}  
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["cyanosis"].']', $form_field_values->where('form_field_code', $field_name_id["cyanosis"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cyanosis"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["ent"].']','ent') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["ent"].']', $form_field_values->where('form_field_code', $field_name_id["ent"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ent"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["lymhadenopathy"].']','LYMHADENOPATHY') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["lymhadenopathy"].']', $form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["edema_feet"].']','EDEMA FEET') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["edema_feet"].']', $form_field_values->where('form_field_code', $field_name_id["edema_feet"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["edema_feet"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["others"].']','OTHERS') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["others"].']', $form_field_values->where('form_field_code', $field_name_id["others"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["others"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["systemic examination"].']','SYSTEMIC EXAMINATION') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["systemic examination"].']', $form_field_values->where('form_field_code', $field_name_id["systemic examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemic examination"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["respiratory_system_air_entry"].']','RESPIRATORY SYSTEM: AIR ENTRY:') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["respiratory_system_air_entry"].']', $form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["foreign_sounds_pleural_rub"].']','FOREIGN SOUNDS : CREPTS/WHEEZING/BRONCHIAL BREATHING/PLEURAL RUB') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["foreign_sounds_pleural_rub"].']', $form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["cardiovascular_heart_sound"].']','CARDIOVASCULAR SYSTEM : HEART SOUNDS :') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["cardiovascular_heart_sound"].']', $form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound"])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s1"].']','S1') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s1"].']', $form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s2"].']','S2') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s2"].']', $form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->first()->field_data, array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["cardiac_murmur"].']','CARDIAC MURMUR') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["cardiac_murmur"].']', $form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["central_nervous_system"].']','CNETRAL NERVOUS SYSTEMIC :') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["central_nervous_system"].']', $form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["shape_of_abdomen"].']','ABDOMINAL SYSTEM : SHAPE OF ABDOMEN :') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["shape_of_abdomen"].']', $form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["organomegaly"].']','ORGANOMEGALY') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["organomegaly"].']', $form_field_values->where('form_field_code', $field_name_id["organomegaly"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["organomegaly"])->first()->field_data, array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["free_fluid_in_abdomen"].']','FREE FLUID IN ABDOMEN :') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["free_fluid_in_abdomen"].']', $form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["tenderness"].']','TENDERNESS') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["tenderness"].']', $form_field_values->where('form_field_code', $field_name_id["tenderness"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["tenderness"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["guarding"].']','guarding') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["guarding"].']', $form_field_values->where('form_field_code', $field_name_id["guarding"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["guarding"])->first()->field_data, array('class'=> 'form-control')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["rigidity"].']','rigidity') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["rigidity"].']', $form_field_values->where('form_field_code', $field_name_id["rigidity"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rigidity"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["faetal_heart_sound"].']','FAETAL HEART SOUNDS (FHS)') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["faetal_heart_sound"].']', $form_field_values->where('form_field_code', $field_name_id["faetal_heart_sound"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["faetal_heart_sound"])->first()->field_data, array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["pre_vaginal_examination"].']','PRE VAGINAL EXAMINATION (PV)') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["pre_vaginal_examination"].']', $form_field_values->where('form_field_code', $field_name_id["pre_vaginal_examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pre_vaginal_examination"])->first()->field_data, array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div>
                          
                         <div class="col-md-12">
                          <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('field_data_singular['.$field_name_id["informed_consent_rejected_consented"].']','INFORMED CONSENT / INFORMED REJECTED CONSENT') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('field_data_singular['.$field_name_id["informed_consent_rejected_consented"].']', $form_field_values->where('form_field_code', $field_name_id["informed_consent_rejected_consented"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["informed_consent_rejected_consented"])->first()->field_data, array('class'=> 'form-control')) }}                          
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