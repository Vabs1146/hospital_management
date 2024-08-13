@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body" style="text-align:center">
			
                 @if(isset(Auth::user()->email))
                Welcome {{ Auth::user()->name }} You are logged in!
                  @else
                   Welcome Admin.  You are logged in!
                     @endif
              

			   <div class="row">
					<div class="col-md-12">
						<h1>{{$all_settings['hospital_name']->value}}</h1>
					</div>
			   </div>
			   @if($all_settings['hospital_logo']->value != "")
			   <div class="row">
					<div class="col-md-12">
						<img src="{{url('/')}}/uploads/images/{{$all_settings['hospital_logo']->value}}">
					</div>
			   </div>
			   @endif
            </div>
        </div>
    </div>
</div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            
            <!-- #END# CPU Usage -->
           

            
        </div>


@endsection