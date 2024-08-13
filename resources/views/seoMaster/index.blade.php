@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Doctor</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="clo-lg-12"> 
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div>
            <a class="btn btn-success" href="{{ route('doctor.create') }}"> Add New Doctor </a>
            <p></p>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="table-responsive">
<table class="table table-bordered">
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
            <a class="btn btn-primary" href="{{ route('doctor.edit',$doctor->id) }}">Edit</a> 
            {{-- {{ Form::open(['method' => 'DELETE','route' => ['doctor.destroy', $doctor->id],'style'=>'display:inline']) }} 
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }} 
            {{ Form::close() }} --}}
        </td>
    </tr>
    @endforeach
</table>
</div>
{{ $doctors->render() }} 
@endsection