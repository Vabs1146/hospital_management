@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @if(Session::has('flash_message'))
      <div class="alert alert-success">
      {{ Session::get('flash_message') }}
        </div>
        @endif
        </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                         <div class="header bg-pink">
                            <h2> Doctors</h2>
                          </div>
                        
                        <div class="body">
                          <div class="row mb-2">
                              <div class="col-lg-12"> 
                              <div class="col-md-6">
                              @if($commonHelper->checkUserAccess("2_admin/doctor/create",Auth::user()->id, 'add_permission') == '1' || AUTH::user()->role == 1)	
                              <a class="btn btn-success btn-lg" href="{{ route('doctor.create') }}"> Add New Doctor
                              </a>
							  @endif
                               </div>
                              <div class="col-md-6">
                              <!-- <a class="btn btn-success btn-lg" style="float: right" href="{{ route('procedures.index') }}"> Procedures
                              </a> -->
							  @if($commonHelper->checkUserAccess("2_admin/payment-modes",Auth::user()->id, 'listing_permission') == '1' || AUTH::user()->role == 1)	
							  <a class="btn btn-success btn-lg" style="float: right" href="{{ route('payment-modes.index') }}"> Payment Modes
                              </a>
							  @endif
                               </div>
                              </div>
                              </div>
                           <div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>isActive</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($doctors as $doctor)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $doctor->doctor_name}}</td>
        <td>{{ $doctor->isActive}}</td>
        <td>
            {{-- <a class="btn btn-info" href="{{ route('doctor.show',$doctor->id) }}">Show</a> --}}
			@if($commonHelper->checkUserAccess("2_admin/doctor/create",Auth::user()->id, 'edit_permission') == '1' || AUTH::user()->role == 1)	
            <a class="btn btn-primary" href="{{ route('doctor.edit',$doctor->id) }}">Edit</a> 
		@endif
		
		@if($commonHelper->checkUserAccess("2_admin/doctor/create",Auth::user()->id, 'delete_permission') == '1' || AUTH::user()->role == 1)	
            {{ Form::open(['method' => 'DELETE','route' => ['doctor.destroy', $doctor->id],'style'=>'display:inline']) }} 
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }} 
            {{ Form::close() }}
		@endif
        </td>
    </tr>
    @endforeach
</table>
</div>
{{ $doctors->render() }} 
                            </div>
                  
                    </div>
                </div>
            </div>


</div>



        @endsection
