@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Form Field Mapping</h1>
    </div>
</div>
<div class="panel panel-default">
    {{-- <div class="panel-heading">
        Eye Operation Notes
    </div> --}}

    <div class="panel-body">
       <div class="container-fluid">         
            <form action="{{ url('/formFieldMaster/UpdateMapping'.( isset($form_field_master->id) ? "/" . $form_field_master->id : "/0")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($case_master))
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
                <input type="hidden" id="form_field_code" name="form_field_code" value="{{ $form_field_master->form_field_code or ''}}" >
                <div class="form-group">
                    {{ $form_field_master->fieldName . ' --- '. $form_field_master->form_field_code }}
                </div>
                <div class="form-group">
                    {{ Form::label('form_master_id','Form Master') }} 
                    {{ Form::text('form_master_id', Request::old('form_master_id',$form_field_master->form_master_id), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    @foreach ($form_master_form_field->get() as $ffMItem)
                    <div class="row">
                        <div class="col-md-2">
                            {{ $ffMItem->form_master_id . ' - ' . $ffMItem->form_master->form_name }} 
                        </div>
                        <div class="col-md-2">
                            {{ Form::button('Delete', array('class'=> 'btn btn-warning', 'Value' => $ffMItem->id, 'name' => 'delete_item', 'type'=>'submit', 'onclick'=>'javascript:return confirm("Do you want to delete? '.$ffMItem->form_master_id . ' - ' . $ffMItem->form_master->form_name.'")')) }}
                        </div>
                    </div>
                    @endforeach
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