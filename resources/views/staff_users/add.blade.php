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
                <form action="{{ url('/staff_users'.(isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    @if (isset($model))
                    <input type="hidden" name="_method" value="PATCH">
                    @endif
                    <div class="header bg-pink">
                        <h2>Add/Modify User Details Update</h2>
                    </div>


                    <div class="body">
                        <div class="row clearfix ">
                            <input type="hidden" name="id" id="id" class="form-control" value="{{ $model['id'] or ''}}" readonly="readonly">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Name :</label>
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
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Role :</label>
                                    </div>
                                </div>
							

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
											<select name="role" class="form-control">
											<option value="">Select role</option>
                                            @foreach($roles as $role)
												<option value="{{$role->id}}" {{$model['role'] == $role->id ? 'selected' : ''}}>{{$role->role}}</option>
											@endforeach
											</select>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Doctor Degree :</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="doctor_degree" id="doctor_degree" class="form-control" value="{{$model['doctor_degree'] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Doctor Registration No. :</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="doctor_registration_number" id="doctor_registration_number" class="form-control" value="{{$model['doctor_registration_number'] or ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

<div class="col-md-12">                           
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Mobile :</label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{$model['mobile'] or ''}}">                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">                           
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Email Id :</label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="email" id="email" class="form-control" value="{{$model['email'] or ''}}">                             
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- One row start -->
                            <div class="col-md-12">                           
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Password :</label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="password" id="password" class="form-control" value="">                             
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- End Of row -->
                        </div>    

                        <div class="row clearfix">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="glyphicon glyphicon-plus btnicons"></i> Save
                                    </button> 
                                    <a class="btn btn-default btn-lg" href="{{ url('/staff_users') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

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
