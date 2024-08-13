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
                            <h2>Doctor Fees</h2>
                          </div>
                        
                        <div class="body">
                          <div class="row mb-2">
                              <div class="col-lg-12"> 
                              <div class="col-md-6">
                              <a class="btn btn-success btn-lg" href="{{ route('fees-details.create') }}"> Add New Doctor Fees
                              </a>
                               </div>
                              <div class="col-md-6">                               </div>
                              </div>
                              </div>
                           <div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>No</th>
        <th>Doctor</th>
        <th>Details</th>
        <th>Amount</th>
        <th>Status</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($fees_details as $fees_details_row)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $fees_details_row->doctor_id}}</td>
        <td>{{ $fees_details_row->fees_details}}</td>
        <td>{{ $fees_details_row->fees_amount}}</td>
        <td>{{ $fees_details_row->status}}</td>
        <td>
            {{-- <a class="btn btn-info" href="{{ route('doctor.show',$fees_details_row->id) }}">Show</a> --}}
            <a class="btn btn-primary" href="{{ route('fees-details.edit',$fees_details_row->id) }}">Edit</a> 
            {{ Form::open(['method' => 'DELETE','route' => ['fees-details.destroy', $fees_details_row->id],'style'=>'display:inline']) }} 
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }} 
            {{ Form::close() }}
        </td>
    </tr>
    @endforeach
</table>
</div>
{{ $fees_details->render() }} 
                            </div>
                  
                    </div>
                </div>
            </div>


</div>



        @endsection
