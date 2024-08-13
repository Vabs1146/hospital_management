@extends('layouts.app')

@section('content')



<h2 class="page-header">Staff_user</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Staff_user    </div>

    <div class="panel-body">
                

        <form action="{{ url('/staff_users') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="staff_type_id" class="col-sm-3 control-label">Staff Type Id</label>
            <div class="col-sm-6">
                <input type="text" name="staff_type_id" id="staff_type_id" class="form-control" value="{{$model['staff_type_id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <input type="text" name="description" id="description" class="form-control" value="{{$model['description'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="ed_degree" class="col-sm-3 control-label">Ed Degree</label>
            <div class="col-sm-6">
                <input type="text" name="ed_degree" id="ed_degree" class="form-control" value="{{$model['ed_degree'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="mobile_no" class="col-sm-3 control-label">Mobile No</label>
            <div class="col-sm-6">
                <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="{{$model['mobile_no'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="email_id" class="col-sm-3 control-label">Email Id</label>
            <div class="col-sm-6">
                <input type="text" name="email_id" id="email_id" class="form-control" value="{{$model['email_id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="address" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-6">
                <input type="text" name="address" id="address" class="form-control" value="{{$model['address'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="is_active" class="col-sm-3 control-label">Is Active</label>
            <div class="col-sm-6">
                <input type="text" name="is_active" id="is_active" class="form-control" value="{{$model['is_active'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="created_at" class="col-sm-3 control-label">Created At</label>
            <div class="col-sm-6">
                <input type="text" name="created_at" id="created_at" class="form-control" value="{{$model['created_at'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="updated_at" class="col-sm-3 control-label">Updated At</label>
            <div class="col-sm-6">
                <input type="text" name="updated_at" id="updated_at" class="form-control" value="{{$model['updated_at'] or ''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/staff_users') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection