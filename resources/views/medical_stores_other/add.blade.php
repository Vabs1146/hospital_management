@extends('layouts/app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Medical Store1</h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="form-group">
    @include('shared.error')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Add/Modify Medical_store    </div>

    <div class="panel-body">
                
        <form action="{{ url('/medical_stores'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif


            <div class="form-group">
                <label for="id" class="col-sm-3 control-label">Id</label>
                <div class="col-sm-6">
                    <input type="text" name="id" id="id" class="form-control" value="{{$model['id'] or ''}}" readonly="readonly">
                </div>
            </div>
                                                                                                            <div class="form-group">
                <label for="medicine_name" class="col-sm-3 control-label">Medicine Name</label>
                <div class="col-sm-6">
                    <input type="text" name="medicine_name" id="medicine_name" class="form-control" value="{{$model['medicine_name'] or ''}}">
                </div>
            </div>
                                                                                                            <div class="form-group">
                <label for="available_quantity" class="col-sm-3 control-label">Total/Purchased Quantity</label>
                <div class="col-sm-2">
                    <input type="number" name="available_quantity" id="available_quantity" class="form-control" value="{{$model['available_quantity'] or ''}}">
                </div>
            </div>
                                                                                                                        <div class="form-group">
                <label for="unit_price" class="col-sm-3 control-label">Unit Price</label>
                <div class="col-sm-6">
                    <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{$model['unit_price'] or ''}}">
                </div>
            </div>
                                                                        <div class="form-group">
                <label for="balance_quantity" class="col-sm-3 control-label">Balance Quantity</label>
                <div class="col-sm-2">
                    <input type="number" name="balance_quantity" id="balance_quantity" class="form-control" value="{{$model['balance_quantity'] or ''}}">
                </div>
            </div>
                                                                                                                        <div class="form-group">
                <label for="isactive" class="col-sm-3 control-label">Isactive</label>
                <div class="col-sm-6">
                    <input type="checkbox" name="isactive" id="isactive" {{ ( !isset($model) || is_null($model['isactive']) || $model['isactive'] == 0 )?"":"checked" }} value="{{$model['isactive'] or '0'}}">
                </div>
            </div>
                                                                                    {{-- <div class="form-group">
                <label for="created_dt" class="col-sm-3 control-label">Created Dt</label>
                <div class="col-sm-3">
                    <input type="date" name="created_dt" id="created_dt" class="form-control" value="{{$model['created_dt'] or ''}}">
                </div>
            </div>
                                                                                                <div class="form-group">
                <label for="updated_dt" class="col-sm-3 control-label">Updated Dt</label>
                <div class="col-sm-3">
                    <input type="date" name="updated_dt" id="updated_dt" class="form-control" value="{{$model['updated_dt'] or ''}}">
                </div>
            </div> --}}
                                    
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/medical_stores') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection