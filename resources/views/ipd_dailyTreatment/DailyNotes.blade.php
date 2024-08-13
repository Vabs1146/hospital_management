             
              <div class="body">
                  <div class="row clearfix ">
                       {{ Form::model($patientRegister, array('url' => url('/AddEdit/dailyNotes/'.$patientRegister->id), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
                {{ csrf_field() }}


                {{ Form::hidden('ipd_patient_id', Request::old('ipd_patient_id', $patientRegister->id), array('class'=> 'form-control')) }}

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('time', 'Time') }}
                              </div>
                              </div>

                              
                             <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('time', Request::old('time'), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('temp', 'Temp') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('temp', Request::old('temp'), array('class' => 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('spo2', 'Sp O2') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('spo2', Request::old('spo2'), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('bp', 'B.P') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('bp', Request::old('bp'), array('class' => 'form-control')) }}                         
                              </div>
                              </div>
                              </div>
                          </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('rr', 'RR') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('rr', Request::old('rr'), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('fhs', 'FHS') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('fhs', Request::old('fhs'), array('class' => 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('treatment', 'Treatment') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::textarea('treatment', Request::old('treatment'), array('class' => 'form-control advicetxtarea')) }}                           
                              </div>
							  </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('morning', 'Morning') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('morning', Request::old('morning'), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>
                           
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('evening', 'Evening') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('evening', Request::old('evening'), array('class' => 'form-control')) }}                         
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('night', 'Night') }}
                              </div>
                              </div>


                                <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('night', Request::old('night'), array('class' => 'form-control')) }}                        
                              </div>
                              </div>
                              </div>
                          </div>

                      


                          
  <div class="row clearfix">
             <div class="col-md-4 col-md-offset-2">
                <div class="form-group">
                {{ Form::submit('Add', array('class' => 'btn btn-primary btn-lg', 'value' => 'AddTreatmentItem', 'name' => 'AddTreatmentItem')) }} 

                </div>
             </div>
                               
           </div>




                <diiv class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  
                    <div class="card">
                      
                        <div class="body">
                            <div class="row clearfix">
                               <div class="table-responsive">
                         @if($patientRegister->ipdTreatmentDailyNotes()->get()->count() > 0 )
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    Time
                                </th>
                                <th>
                                    Temp    
                                </th>
                                <th>
                                    SPO2
                                </th>
                                <th>
                                    BP
                                </th>
                                <th>
                                    RR    
                                </th>
                                <th>
                                    FHS    
                                </th>
                                <th>
                                   TREATMENT    
                                </th>
                                <th>
                                    Morning
                                </th>
                                <th>
                                    Evening
                                </th>
                                <th>
                                    Night
                                </th>
                                <th>
                                    <!-- Used for delete button -->    
                                </th>
                            </tr>
                                @foreach($patientRegister->ipdTreatmentDailyNotes()->get() as $TreatmentNotes)
                                    <tr>   
                                        <td>
                                            {{$TreatmentNotes->time}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->temp}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->spo2}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->bp}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->rr}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->fhs}}
                                        </td>
                                        <td>
                                            {!! nl2br($TreatmentNotes->treatment) !!}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->morning}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->evening}}
                                        </td>
                                        <td>
                                            {{$TreatmentNotes->night}}
                                        </td>
                                        <td>
                                            {{ Form::button('Delete', array('class' => 'btn btn-primary', 'Value' => $TreatmentNotes->id, 'name' => 'deleteTreatmentNotes', 'type'=>'submit')) }}
                                            {{-- <a href="{{'/case_masters/delete/'.$prescption->id }}" class="btn btn-primary" name='prescription_delete'> Delete Prescription </a> --}}
                                        </td>
                                    <tr>
                                @endforeach
                            @endif
                        </table>
                                </div>
                               


                            </div>
                        </div>
                    </div>
                </div>
            </div>
				  

                       
 {{ Form::close() }}
                         
                             
                  </div>    

          
                </div>


