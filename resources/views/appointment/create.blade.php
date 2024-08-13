@extends(env('layoutTemplate'))
@section('pageheader')
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@endsection
@section('pagebody')
<article>
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-4">
            <h3><strong> Appointment </strong></h3>
            {{ Form::model($appointment, array('url' => '/appointment')) }}
                
                @include('shared.error')

                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', Request::old('name'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', Request::old('email'), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('mobile_no','Mobile') }}
                    {{ Form::text('mobile_no', Request::old('mobile_no'), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('appointment_dt','Date') }}
                    {{ Form::text('appointment_dt', Request::old('appointment_dt'), array('class' => 'form-control datepicker', 'data-provide'=>'datepicker')) }}
                    {{-- {{Form::date('appointment_dt', \Carbon\Carbon::now(), array('class' => 'form-control'))}} --}}
                </div>
                
                <div class="form-group">
                    {{ Form::label('doctor_id','Doctor') }}
                    {{ Form::select('doctor_id',array(''=>'Please select') + $doctorlist->toArray(), Request::old('doctor_id'), array('class' => 'form-control')) }}
                    
                </div>
                <div class="form-group">
                    {{ Form::label('appointment_subject','Subject') }}
                    {{ Form::text('appointment_subject', Request::old('appointment_subject'), array('class' => 'form-control')) }}
                </div>
                {{ Form::submit('Create Appointment', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
</div>
<br/>
</article>
@endsection
@section('footescripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
    });
</script>
    
@endsection