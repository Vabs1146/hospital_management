@extends('layouts.app')

@section('content')

<br/>

<div class="panel panel-default">
    <div class="panel-heading">
        Send Member SMS    </div>

    <div class="panel-body">
                
        <form action="{{ url('/member_sms'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            @if (isset($model))
                <input type="hidden" name="_method" value="PATCH">
            @endif

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    @include('shared.error') 
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                {{-- <label for="id" class="col-sm-3 control-label">Id</label> --}}
                <div class="col-sm-6">
                    <input type="hidden" name="id" id="id" class="form-control" value="{{ $model['id'] or ''}}" readonly="readonly">
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('staff_type_id','User Role',array('class'=>'col-sm-3 control-label')) }} 
                <div class="col-sm-2">
                    {{ Form::select('staff_type_id',array(''=>'Please select') + $staff_type_lst->toArray(),
                    Request::old('staff_type_id', $model['staff_type_id']), array('class' => 'form-control', ' required')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('user_id','User',array('class'=>'col-sm-3 control-label')) }} 
                <div class="col-sm-2">
                    {{ Form::select('user_id',array(''=>'Please select'),
                    Request::old('user_id', $model['user_id']), array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                <label for="sms_text" class="col-sm-3 control-label">SMS Text</label>
                <div class="col-sm-6">
                    <input type="text" name="sms_text" id="sms_text" class="form-control" value="" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Send Message
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
     $(document).ready(function(){
        $('#staff_type_id').on('change', function(e){
            if($('#staff_type_id').val() != ''){
                $.get('/get_user_by_type/' + $('#staff_type_id').val(), function(data){
                    //success data
                    $('#user_id').empty();
                    $('#user_id').append('<option> Please select </option>');
                    $.each(data, function(index, subcatObj){
                        $('#user_id').append('<option value="' + subcatObj.id +'" >'
                        + subcatObj.name + '</option>');
                    });
                });
            }
        });

     })
    </script>
@endsection