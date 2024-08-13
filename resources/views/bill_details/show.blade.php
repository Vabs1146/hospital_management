@extends('layouts/app')

@section('content')



<h2 class="page-header">Bill_detail</h2>

<div class="panel panel-default">
    <div class="panel-heading">
        View Bill_detail    </div>

    <div class="panel-body">
                

        <form action="{{ url('/bill_details') }}" method="POST" class="form-horizontal">


                
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
            <label for="bill_item" class="col-sm-3 control-label">Bill Item</label>
            <div class="col-sm-6">
                <input type="text" name="bill_item" id="bill_item" class="form-control" value="{{$model['bill_item'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="bill_Amount" class="col-sm-3 control-label">Bill Amount</label>
            <div class="col-sm-6">
                <input type="text" name="bill_Amount" id="bill_Amount" class="form-control" value="{{$model['bill_Amount'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="created_dt" class="col-sm-3 control-label">Created Dt</label>
            <div class="col-sm-6">
                <input type="text" name="created_dt" id="created_dt" class="form-control" value="{{$model['created_dt'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="updated_dt" class="col-sm-3 control-label">Updated Dt</label>
            <div class="col-sm-6">
                <input type="text" name="updated_dt" id="updated_dt" class="form-control" value="{{$model['updated_dt'] or ''}}" readonly="readonly">
            </div>
        </div>
        
        
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <a class="btn btn-default" href="{{ url('/bill_details') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>







@endsection