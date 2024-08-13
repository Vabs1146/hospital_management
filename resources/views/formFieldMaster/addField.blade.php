@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Field Master</h1>
    </div>
</div>
<div class="panel panel-default">
    {{-- <div class="panel-heading">
        Eye Operation Notes
    </div> --}}

    <div class="panel-body">
       <div class="container-fluid">         
            <form action="{{ url('/formFieldMaster/StoreField'.( isset($form_field_master->id) ? "/" . $form_field_master->id : "/0")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($form_field_master))
                    <input type="hidden" name="_method" value="PATCH">
                @endif

                <div class="form-group">
                    @include('shared.error') 
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                </div>
                <input type="hidden" id="field_id" name="field_id" value="{{ $form_field_master->id or ''}}" >
                <div class="form-group">
                    {{ Form::label('fieldName','Field Name') }} 
                    {{ Form::text('fieldName', Request::old('fieldName',$form_field_master->fieldName), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('form_master_id','Form Master') }} 
                    {{ Form::text('form_master_id', null, array('class' => 'form-control', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success" value="submit" >
                        <i class="fa fa-plus"></i> Submit
                    </button>
                    <a href="{{ url('/formFieldMaster') }}"  class="btn btn-default" >Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection