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
                  <form action="{{ url('/image_galleries') }}" method="POST" class="form-horizontal">
                     {{ csrf_field() }}
                      @if (isset($model['id']))
                          <input type="hidden" name="_method" value="PATCH">
                      @endif

                         <div class="header bg-pink">
                            <h2>
                               Image gallery
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix ">
                            <div class="col-md-12 ">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="id" class="form-control">Id :</label>
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
                              <label for="imgTypeId" class="form-control">ImgTypeId:</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                                <input type="text" name="imgTypeId" id="imgTypeId" class="form-control" value="{{$model['imgTypeId'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>
                              
                              </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="imgUrl" class="form-control">ImgUrl :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               <input type="text" name="imgUrl" id="imgUrl" class="form-control" value="{{$model['imgUrl'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="Name" class="form-control">Name :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="Name" id="Name" class="form-control" value="{{$model['Name'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="Description" class="form-control">Description</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="Description" id="Description" class="form-control" value="{{$model['Description'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="isActive" class="form-control">Is Active :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              {{ Form::checkbox('isActive', 1, $model['isActive'],array('id'=>'isActive' ,'disabled'=>'')) }}
                              <label for="isActive"></label>
                               
                              </div>
                              </div>    
                            </div>  
                            
                            <div class="col-md-12">

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="created_at" class="form-control">Created At</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="isActive" class="form-control">Updated At</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line"> <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}" readonly="readonly"></div>
                              </div>
                              </div>    
                            </div> 
                            <div class="col-md-12">                           
                              <div class="col-md-4 col-md-offset-4">
                              <div class="form-group">
                              <a class="btn btn-primary btn-lg" href="{{ url('/image_galleries') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                              </div>
                              </div>
                              
                            
                            </div>                  
                            <!-- End Of row -->
                            </div>                              
                            </div>
                             <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">
                             <input type="hidden" name="imgTypeId" id="imgTypeId" value="1">
                          </form>
                        </div>
                        
                    </div>
                </div>
            </div>




        @endsection
