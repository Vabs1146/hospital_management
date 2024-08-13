@extends('layouts/app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Medical Store</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        View Medical_store    </div>

    <div class="panel-body">
                

        <form action="{{ url('/medical_stores') }}" method="POST" class="form-horizontal">


                
        <div class="form-group">
            <label for="id" class="col-sm-3 control-label">Id</label>
            <div class="col-sm-6">
                <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="medicine_name" class="col-sm-3 control-label">Medicine Name</label>
            <div class="col-sm-6">
                <input type="text" name="medicine_name" id="medicine_name" class="form-control" value="{{$model['medicine_name'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="available_quantity" class="col-sm-3 control-label">Available Quantity</label>
            <div class="col-sm-6">
                <input type="text" name="available_quantity" id="available_quantity" class="form-control" value="{{$model['available_quantity'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="unit_price" class="col-sm-3 control-label">Unit Price</label>
            <div class="col-sm-6">
                <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{$model['unit_price'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="balance_quantity" class="col-sm-3 control-label">Balance Quantity</label>
            <div class="col-sm-6">
                <input type="text" name="balance_quantity" id="balance_quantity" class="form-control" value="{{$model['balance_quantity'] or ''}}" readonly="readonly">
            </div>
        </div>
        
                
        <div class="form-group">
            <label for="isactive" class="col-sm-3 control-label">Isactive</label>
            <div class="col-sm-6">
                <input type="text" name="isactive" id="isactive" class="form-control" value="{{$model['isactive'] or ''}}" readonly="readonly">
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
                <a class="btn btn-default" href="{{ url('/medical_stores') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
            </div>
        </div>


        </form>

    </div>
</div>


@endsection