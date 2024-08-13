@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Change Password</div>

            <div class="panel-body" style="text-align:center">

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                  <div class="form-line">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>

                                  </div>
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif                                  
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                  <div class="form-line">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>
                                  </div>

                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif                                  
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                <div class="col-md-6">
                                  <div class="form-line">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top:20px;">
                                <div class="col-md-6 form-control">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            
            <!-- #END# CPU Usage -->
           

            
        </div>


@endsection