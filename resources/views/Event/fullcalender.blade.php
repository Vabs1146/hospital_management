@extends('layouts/app')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection 
@section('content')
<div class="container">

                <div class="panel-body">
                    {!! $calendar->calendar() !!}
                </div>

</div>
@endsection 
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<script>    
function dayClickEvent(date, jsEvent, view) {

//alert('Clicked on: ' + date.format());
var redirectUrl = '{{ url('/CreateApp') }}/' + date.format();
window.location.href = redirectUrl;
//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

//alert('Current view: ' + view.name);

// change the day's background color just for fun
//$(this).css('background-color', 'red');

}

</script>

{!! $calendar->script() !!}
@endsection