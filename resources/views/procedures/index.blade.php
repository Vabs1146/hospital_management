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
                            <h2> Procedures</h2>
                          </div>
                        
                        <div class="body">
                          <div class="row mb-2">
                              <div class="col-lg-12"> 
                              <div>
                              <a class="btn btn-success btn-lg" href="{{ route('procedure.create') }}"> Add New Procedure
                              </a>
                               </div>
                              </div>
                              </div>
                           <div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
    <tr>
        <th>No</th>
        <th>Name</th>
        <!-- <th>isActive</th> -->
        <th width="280px">Action</th>
    </tr>
    @foreach ($procedures as $procedure)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $procedure->name}}</td>
        <!-- <td>{{ $procedure->isActive}}</td> -->
        <td>
            {{-- <a class="btn btn-info" href="{{ route('procedure.show',$procedure->id) }}">Show</a> --}}
            <a class="btn btn-primary" href="{{ route('procedure.edit',$procedure->id) }}">Edit</a> 
            {{-- {{ Form::open(['method' => 'DELETE','route' => ['procedure.destroy', $procedure->id],'style'=>'display:inline']) }} 
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }} 
            {{ Form::close() }} --}}
        </td>
    </tr>
    @endforeach
</table>
</div>
{{ $procedures->render() }} 
                            </div>
                  
                    </div>
                </div>
            </div>


</div>



        @endsection
