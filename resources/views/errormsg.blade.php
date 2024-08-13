@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8" style="margin-left: 67px;margin-top: 27px;">
            <div class="panel panel-default">
                  @if ($message = Session::get('error'))
                               <div class="alert alert-danger alert-block">
                                <!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
                                <strong>{{ $message }}</strong>
                               </div>
                               @endif
  
                <div class="panel-body">
                 <div>
                 <a href="{{url('/password/reset')}}" class="btn btn-default"> Back </a>
                  </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
