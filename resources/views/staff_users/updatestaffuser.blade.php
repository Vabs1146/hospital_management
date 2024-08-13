@extends('layouts.app')

@section('content')

<br/>

<div class="panel panel-default">
    <div class="panel-heading">
        Add/Modify Members Contact Details e </div>

    <div class="panel-body">
                
        <form action="{{ url('saveuser')}}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

         

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
                <label for="name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{$model['name'] or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="mobile" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{$model['mobile'] or ''}}">
                </div>
            </div>
                <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" id="email" class="form-control" value="{{$model['email'] or ''}}">
                </div>
            </div>

                  <div class="form-group">
                <label for="password" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" name="password" id="password" class="form-control" value="{{$model['password']}}">
                </div>
            </div>
              
              
            
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <a class="btn btn-default" href="{{ url('/staff_users') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>
            </div>
        </form>

    </div>
</div>






@endsection