@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
          <form action="{{ url('/bulk_sms'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

             @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif

          <div class="header bg-pink">
          <h2>Bulk SMS </h2>
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
                              <label class="form-control">Group Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="group_name" id="group_name" class="form-control" value="{{$model['group_name'] or ''}}">                           
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Mobile Numbers :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="mobile_numbers" id="mobile_numbers" class="form-control" value="{{$model['mobile_numbers'] or ''}}">                           
                              </div>
                              </div>
                              </div>

                             
                          </div>


                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-plus"></i> Save
                                </button> 
                                
                               
                                <a class="btn btn-default btn-lg" href="{{ url('/bulk_sms') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>


                                      
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
  