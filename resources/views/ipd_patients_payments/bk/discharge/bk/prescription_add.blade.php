<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                         {{ Form::model($patientRegister, array('url' => url('/IPD/AddEdit/prescription/'.$patientRegister->id), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
                         {{ csrf_field() }}
                          {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                         {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
                         <div class="header bg-pink">
                            <h2>
                               Add/Modify Prescription
                            </h2>
                        </div>
                        <div class="body">
                        <div class="row clearfix">
                             <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('medicine_id', 'Medicine') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                             
                               {{ Form::select('medicine_id', array(''=>'Please select') + $presDropdowns['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2')) }}                            
                              
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('strength', 'Strength') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              
                              {{ Form::select('strength', array(''=>'Please select') + $presDropdowns['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2')) }}                            
                              
                              </div>
                              </div>

                              <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('medicine_quantity', 'Quantity') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                             
                             {{ Form::select('medicine_quantity', array(''=>'Please select') + $presDropdowns['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2')) }}                            
                             
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('numberoftimes', 'Times a Day') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                               {{ Form::select('numberoftimes', array(''=>'Please select') + $presDropdowns['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2')) }}
                              </div>   

                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('no_of_days', 'Day') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                                {{ Form::text('no_of_days', Request::old('no_of_days'), array('class' => 'form-control')) }}
                              </div>   

                              </div>

                                <div class="row clearfix">
                                <div class="col-md-6 col-md-offset-2">
                                {{ Form::submit('Add Prescription', array('class' => 'btn btn-primary', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}    
                                </div>
                                <br>
                                <div class="col-md-12">
                                <div class="table-responsive table-bordered">
                @if(null !== old('prescriptionList',$prescriptionList) && count(old('prescriptionList',$prescriptionList))> 0 )
                    <table class="table">
                        <tr>
                            <th>
                                Medicine
                            </th>
                            <th>
                                Generic Name    
                            </th>
                            <th>
                                Strength
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Times a Day    
                            </th>
                            <th>
                                Day    
                            </th>
                            <th>
                                <!-- Used for delete button -->    
                            </th>
                        </tr>
                            @foreach($prescriptionList as $prescption)
                            {{-- <tr>
                                <td colspan="7">
                                {{ dd($prescption->strength) }}    
                                </td>
                            </tr> --}}
                            <tr>   
                                    <td>
                                        {{ $prescption->Medical_store->medicine_name }}
                                    </td>
                                    <td>
                                        {{ $prescption->Medical_store->generic_name }}
                                    </td>
                                    <td>
                                        {{ $prescption->strength }}
                                    </td>
                                    <td>
                                        {{ $prescption->medicine_Quntity }}
                                    </td>
                                    <td>
                                        {{ $prescption->numberoftimes }}
                                    </td>
                                    <td>
                                        {{ $prescption->no_of_days }}
                                    </td>
                                    <td>
                                        {{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
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

                            
                        </div>
                        {{ Form::close() }}
                    </div>
               
@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $('.select2').select2();
    </script>
@endsection

