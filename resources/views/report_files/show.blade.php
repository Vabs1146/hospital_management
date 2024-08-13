@extends('layouts.app')

@section('content')



<h2 class="page-header">Report_file</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Report_file    </div>

    <div class="panel-body">
                

        <form action="{{ url('/report_files') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="case_number" class="col-sm-3 control-label">Case Number</label>
            <div class="col-sm-6">
                <input type="text" name="case_number" id="case_number" class="form-control" value="{{$model['case_number'] or ''}}" readonly="readonly">
            </div>
        </div>

        <div class="form-group">
            <label for="report_title" class="col-sm-3 control-label">Report Title</label>
            <div class="col-sm-6">
                <input type="text" name="report_title" id="report_title" class="form-control" value="{{ $model['report_title'] or ''}}" readonly="readonly">
            </div>
        </div>
                
        <div class="form-group">
            <label for="report_description" class="col-sm-3 control-label">Report Description</label>
            <div class="col-sm-6">
                <input type="text" name="report_description" id="report_description" class="form-control" value="{{$model['report_description'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="file_path" class="col-sm-3 control-label">File Path</label>
            <div class="col-sm-6">
                <input type="text" name="file_path" id="file_path" class="form-control" value="{{$model['file_path'] or ''}}" readonly="readonly">
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
                <a class="btn btn-default" href="{{ url('/report_files') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection