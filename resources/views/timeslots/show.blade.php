@extends('layouts.app')

@section('content')



<h2 class="page-header">Timeslot</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Timeslot    </div>

    <div class="panel-body">
                

        <form action="{{ url('/timeslots') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="isActive" class="col-sm-3 control-label">IsActive</label>
            <div class="col-sm-6">
                <input type="text" name="isActive" id="isActive" class="form-control" value="{{$model['isActive'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="created_dt" class="col-sm-3 control-label">Created Dt</label>
            <div class="col-sm-6">
                <input type="text" name="created_dt" id="created_dt" class="form-control" value="{{$model['created_dt'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="update_dt" class="col-sm-3 control-label">Update Dt</label>
            <div class="col-sm-6">
                <input type="text" name="update_dt" id="update_dt" class="form-control" value="{{$model['update_dt'] or ''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/timeslots') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection