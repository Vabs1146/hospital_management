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
                         <form action="{{ url('/menu_lists') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                                View Menu_list
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix ">
                              <!-- first row -->
                            <div class="col-md-12">
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
                              <label for="name" class="form-control">Name :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}" readonly="readonly"> 
                              </div>
                              </div>
                              </div>
                              </div>

                            
                             <!-- second row -->

                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="description" class="form-control">Description :</label>
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
                              <label for="parentId" class="form-control">ParentId :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="parentId" id="parentId" class="form-control" value="{{$model['parentId'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>
                            </div>  

                              <!-- third row -->
                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="menu_type" class="form-control">Menu Type No :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="menu_type" id="menu_type" class="form-control" value="{{$model['menu_type'] or ''}}" readonly="readonly">
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
                                <input type="checkbox" id="remember_me_3" {{ ( !isset($model) || is_null($model['is_active']) || $model['is_active'] == 0 )?"":"checked" }}  value="{{ $model['is_active'] or '0'}}" class="filled-in" name="is_active">
                                <label for="remember_me_3"></label>
                              </div>
                              </div>
                              </div>  


                             <!-- fouth row -->
                             <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="created_at" class="form-control">Created At :</label>
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
                              <label for="updated_at" class="form-control">Updated At :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}" readonly="readonly">
                              </div>
                              </div>
                              </div>
                            </div>   

                           
                            <div class="col-md-12">                           
                              <div class="col-md-4 col-md-offset-2">
                              <div class="form-group">
                               <a class="btn btn-default btn-lg" href="{{ url('/menu_lists') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                              </div>
                              </div>
                              
                            
                            </div>                  
                            <!-- End Of row -->
                            </div>                              
                            </div>
                          </form>
                        </div>
                        
                    </div>
                </div>
            </div>

</div>


        @endsection
