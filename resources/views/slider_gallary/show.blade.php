@extends('layouts/app')

@section('content')



<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Image Gallery</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="clo-lg-12"> 
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        View Image gallery    </div>

    <div class="panel-body">
                

        <form action="{{ url('/image_galleries') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="imgTypeId" class="col-sm-3 control-label">ImgTypeId</label>
            <div class="col-sm-6">
                <input type="text" name="imgTypeId" id="imgTypeId" class="form-control" value="{{$model['imgTypeId'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="imgUrl" class="col-sm-3 control-label">ImgUrl</label>
            <div class="col-sm-6">
                <input type="text" name="imgUrl" id="imgUrl" class="form-control" value="{{$model['imgUrl'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="Name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="Name" id="Name" class="form-control" value="{{$model['Name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="Description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <input type="text" name="Description" id="Description" class="form-control" value="{{$model['Description'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="isActive" class="col-sm-3 control-label">IsActive</label>
            <div class="col-sm-6">
                <input type="text" name="isActive" id="isActive" class="form-control" value="{{$model['isActive'] or ''}}" readonly="readonly">
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
                <a class="btn btn-default" href="{{ url('/image_galleries') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection