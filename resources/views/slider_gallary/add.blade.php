@extends('layouts/app')

@section('content')



<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Image Gallery11</h2>
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
        Add/Modify Image gallery    </div>

    <div class="panel-body">
                
        <form action="{{ url('/image_galleries'.( isset($model['id']) ? "/" . $model['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data'>
            @if (isset($model['id']))
                <input type="hidden" name="_method" value="PATCH">
            @endif
            <div class="form-group">
                <label for="uploadeImage" class="col-sm-3 control-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="uploadeImage" id="uploadeImage" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('displayed_in', 'Add In', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::select('displayed_in',   array('homeSlider'=>'Hoem Page Slider', 'galleryPage'=>'Gallery Page'), Request::old('displayed_in', $model['displayed_in']), array('class' => 'form-control')) }}
                </div>
            </div>
            @if(isset($model['imgUrl']) && !empty($model['imgUrl']))
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <img src="{{ Storage::disk('local')->url($model['imgUrl']) }}" class="img-thumbnail" alt="Image" width="304" height="236">
                    </div>
                </div>
            @endif
            <div class="form-group">
                <label for="Name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="Name" id="Name" class="form-control" value="{{$model['Name'] or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="Description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" name="Description" id="Description" class="form-control" value="{{$model['Description'] or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="read_more_link" class="col-sm-3 control-label">Read More Link</label>
                <div class="col-sm-6">
                    <input type="text" name="read_more_link" id="read_more_link" class="form-control" value="{{$model['read_more_link'] or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="isActive" class="col-sm-3 control-label">IsActive</label>
                <div class="col-sm-6 checkbox" style="margin:0px 25px" >
                    {{ Form::checkbox('isActive', 1, $model['isActive']) }}
                </div>
            </div>
                        
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/image_galleries') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">
            <input type="hidden" name="imgTypeId" id="imgTypeId" value="1">
            {{ csrf_field() }}
        </form>

    </div>
</div>






@endsection