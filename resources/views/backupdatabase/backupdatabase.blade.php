@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
    <div class="block-header">
    <h3>Backup Database</h3>
    </div>
    <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
    <div class="header bg-pink">
    <h2> Backup Database</h2>
    </div>
    <div class="body">
     <form action="" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
    {{ csrf_field() }}
    <div class="form-group">
    <label>Download Database</label>
    <a href="{{ route('exeldatabaseback')}}" class="btn btn-info btn-lg">Download Database</a>
    </div>
    </form> 
    </div>
    </div>
    </div>
    </div>


</div>



        @endsection
