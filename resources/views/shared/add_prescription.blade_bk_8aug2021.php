<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        {{ Form::model($casedata, array('url' => url('/AddEdit/prescription/'.$casedata['id']), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
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
                             
                              {{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                            
                              
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('strength', 'Eye') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              
                              {{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                             
                              
                              </div>
                              </div>

                              <div class="col-md-12">

							  <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('numberoftimes', 'Frequency') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              {{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div> 

                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('medicine_quantity', 'Duration') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                             
                              {{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                             
                             
                              </div>

                                

                              </div>

                                <div class="row clearfix">
                                <div class="col-md-6 col-md-offset-2">
                                {{ Form::submit('Add Prescription', array('class' => 'btn btn-primary btn-lg', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}     
                                </div>
                                <br>
                                <div class="col-md-12">
                                <div class="table-responsive ">
                                @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                                <table class="table">
                                    <tr>
                                        <th>
                                            Medicine
                                        </th>
                                        
                                        <th>
                                           Frequency
                                          
                                        </th>
                                        <th>
                                            Duration
                                        </th>
                                        <th>
                                             Eye   
                                        </th>
                                        
                                        <th>
                                            <!-- Used for delete button -->    
                                        </th>
                                    </tr>
                                        @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                            <tr>   
                                                <td>
                                                    {{ $prescption->Medical_store->medicine_name }}
                                                </td>
                                                
                                                <td>
                                                  {{ $prescption->numberoftimes }}
                                                    
                                                </td>
                                                <td>
                                                    {{ $prescption->medicine_Quntity }}
                                                </td>
                                                <td>
                                                   {{ $prescption->strength }} 
                                                </td>
                                                
                                                <td>
                                                    {{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
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

                            
                        </div>
                        {{ Form::close() }}
                    </div>
               
@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $('.select2').select2();
    </script>
@endsection

