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
          <form action="{{ url('/stop_appointments') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            
          <div class="header bg-pink">
          <h2>View Stop_appointment </h2>
          </div>
  
              <div class="body">
                  <div class="row clearfix ">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Id :</label>
                              </div>
                              </div>

                             <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">                        
                              </div>
                              </div>
                              </div>    


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Date :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="date" id="date" class="form-control" value="{{$model['date'] or ''}}" readonly="readonly">                       
                              </div>
                              </div>
                              </div>   
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">DoctorId :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="DoctorId" id="DoctorId" class="form-control" value="{{$model['DoctorId'] or ''}}" readonly="readonly">                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">TimeSlotId :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="TimeSlotId" id="TimeSlotId" class="form-control" value="{{$model['TimeSlotId'] or ''}}" readonly="readonly">                            
                              </div>
                              </div>
                              </div>

                          </div>


                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Description :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="description" id="description" class="form-control" value="{{$model['description'] or ''}}" readonly="readonly">                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Created At :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="created_dt" id="created_dt" class="form-control" value="{{$model['created_dt'] or ''}}" readonly="readonly">                          
                              </div>
                              </div>
                              </div>

                          </div>
                           
                           <div class="col-md-12">
                            <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Updated Dt :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="updated_dt" id="updated_dt" class="form-control" value="{{$model['updated_dt'] or ''}}" readonly="readonly">                          
                              </div>
                              </div>
                              </div>

                          </div>

                             
                              
                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                 <a class="btn btn-default btn-lg" href="{{ url('/stop_appointments') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                      
                                </div>
                                </div>
                               
                            </div>
                </div>
          {{ Form::close() }}
            </div>
        </div>
</div>
</div>


        @endsection
  