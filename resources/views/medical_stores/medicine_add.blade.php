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
                        <form action="{{ url('/Medicine'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        @if (isset($model))
                            <input type="hidden" name="_method" value="PATCH">
                        @endif
                         <div class="header bg-pink">
                            <h2>
                                Medical Store
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
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
                              <label class="form-control">Medicine Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="medicine_name" id="medicine_name" class="form-control" value="{{$model['medicine_name'] or ''}}">                           
                              </div>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Generic Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="generic_name" id="generic_name" class="form-control" value="{{$model['generic_name'] or ''}}">                           
                              </div>
                              </div>
                              </div>
                               
                            <input type="hidden" name="available_quantity" id="available_quantity" value="{{$model['available_quantity'] or ''}}">
                            <input type="hidden" name="unit_price" id="unit_price"  value="{{$model['unit_price'] or ''}}">
                            <input type="hidden" name="balance_quantity" id="balance_quantity"  value="{{$model['balance_quantity'] or ''}}">
                              
                            <div class="col-md-2">
                               <div class="form-group labelgrp">
                                <label class="form-control">Is active</label>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="demo-checkbox">
                                <input type="checkbox" name="isactive" id="basic_checkbox_2" {{ ( !isset($model) || is_null($model['isactive']) || $model['isactive'] == 0 )?"":"checked" }} value="{{$model['isactive'] or '0'}}">
                                <label for="basic_checkbox_2"></label>
                                </div>
                                </div>
                              </div>
                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-plus"></i> Save</button> &nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/Medicine') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
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

@section('scripts')
 <script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
@endsection
  