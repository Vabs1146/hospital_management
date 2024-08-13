@extends('adminlayouts.master')
@section('content')
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Doctor </h1>
          </div><!-- /.col -->
         
        </div>

      <div class="row mb-2">
           @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
         
        </div>



        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
             
              <!-- /.card-header -->
              <!-- form start -->
             {{ Form::model($doctor, array('url' => 'admin/doctor','enctype'=>'multipart/form-data')) }}
                <div class="card-body">

                     <div class="form-group">
                     @include('shared.error')

            @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
                  </div>

            <div class="form-group">
            {{ Form::label('doctor_name', 'Name') }}
            {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{ Form::label('doctorDegree', 'Doctor Degree') }}
            {{ Form::text('doctorDegree', Request::old('doctorDegree'),array('class'=>'form-control')) }}
           </div>

            <div class="form-group">
            {{ Form::label('mobile_no', 'Mobile No') }}
            {{ Form::number('mobile_no', Request::old('mobile_no'),array('class'=>'form-control')) }}
            </div>
             
        
            <div class="form-group">
            {{ Form::label('formViewName', 'Patient Form') }} 
            {{ Form::select('formViewName', $doctorFormView->toArray(), Request::old('formViewName'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{ Form::label('isActive', 'isActive') }}
            {{ Form::checkbox('isActive', Request::old('isActive'),($doctor->isActive == 1)) }}
            </div>

            <div class="form-group">
            {{ Form::submit('Add Doctor', array('class' => 'btn btn-primary')) }}
            <a class="btn btn-success" href="{{ route('doctor.index') }}"> Back </a>
            </div> 

             {{ Form::close() }}
            </div>
             <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</div>
</div>
 
  </div>


@endsection