@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
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
                        <form action="{{ url('/staff_member'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        @if (isset($model))
                            <input type="hidden" name="_method" value="PATCH">
                        @endif
                         <div class="header bg-pink">
                            <h2>
                                 Add/Modify Members Contact
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix ">
                            <div class="col-md-12">
                              <input type="hidden" name="id" id="id" class="form-control" value="{{ $model['id'] or ''}}" readonly="readonly">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="staff_type_id" class="form-control">User Role :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              {{ Form::select('staff_type_id',array(''=>'Please select') + $staff_type_lst->toArray(),
                                Request::old('staff_type_id', $model['staff_type_id']), array('class' => 'form-control select2','data-live-search'=>'true')) }}                              
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
                              <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}"> 
                              </div>
                              </div>
                              </div>
                              </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="Description" class="form-control">Description :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="description" id="description" class="form-control" value="{{$model['description'] or ''}}">
                              </div>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ed_degree" class="form-control">Ed Degree :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="ed_degree" id="ed_degree" class="form-control" value="{{$model['ed_degree'] or ''}}">
                              </div>
                              </div>
                              </div>
                            </div>  


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="Description" class="form-control">Mobile No :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="{{$model['mobile_no'] or ''}}">
                              </div>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ed_degree" class="form-control">Email Id :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="email_id" id="email_id" class="form-control" value="{{$model['email_id'] or ''}}">
                              </div>
                              </div>
                              </div>
                            </div>  


                             <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="Description" class="form-control">Address :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             <input type="text" name="address" id="address" class="form-control" value="{{$model['address'] or ''}}">
                              </div>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ed_degree" class="form-control">Is Active :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                                <input type="checkbox" id="remember_me_3" {{ ( !isset($model) || is_null($model['is_active']) || $model['is_active'] == 0 )?"":"checked" }}  value="{{ $model['is_active'] or '0'}}" class="filled-in" name="is_active">
                                <label for="remember_me_3"></label>
                               
                              </div>
                              </div>
                            </div>   

                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="Description" class="form-control">Created At :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="date" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}">
                              </div>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="ed_degree" class="form-control">Updated At :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="date" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}">
                              </div>
                              </div>
                              </div>
                            </div>   

                            <div class="col-md-12">                           
                              <div class="col-md-4 col-md-offset-4">
                              <div class="form-group">
                              <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default btn-lg" href="{{ url('/staff_users') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
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


@endsection

@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection  