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
                            <h2> Payment Modes</h2>
                          </div>
                        
                        <div class="body">
                          <div class="row mb-2">
                              <div class="col-lg-12"> 
                              <div>
							  @if($commonHelper->checkUserAccess("2_admin/payment-modes",Auth::user()->id, 'add_permission') == '1' || AUTH::user()->role == 1)	
                              <a class="btn btn-success btn-lg" href="{{ route('payment-modes.create') }}"> Add New Payment Mode
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
        <th>Status</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($payment_modes as $payment_modes_row)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $payment_modes_row->name}}</td>
        <td>{{ $payment_modes_row->status}}</td>
        <td>
            {{-- <a class="btn btn-info" href="{{ route('payment-modes.show',$payment_modes_row->id) }}">Show</a> --}}
			
			
        @if(($commonHelper->checkUserAccess("2_admin/payment-modes", Auth::user()->id, 'edit_permission') == 1 || AUTH::user()->role == 1))
            <a class="btn btn-primary" href="{{ route('payment-modes.edit',$payment_modes_row->id) }}">Edit</a> 
		@endif
		
		 @if($commonHelper->checkUserAccess("2_admin/payment-modes", Auth::user()->id, 'delete_permission') == 1 || AUTH::user()->role == 1)
            {{ Form::open(['method' => 'DELETE','route' => ['payment-modes.destroy', $payment_modes_row->id],'style'=>'display:inline']) }} 
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }} 
            {{ Form::close() }}
		@endif
        </td>
    </tr>
    @endforeach
</table>
</div>
{{ $payment_modes->render() }} 
                            </div>
                  
                    </div>
                </div>
            </div>


</div>



        @endsection
