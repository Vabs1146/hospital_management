@extends('adminlayouts.master')
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<style>
    @media screen and (max-width: 767px) {
    .select2 {
    width: 100% !important;
    }
    }
    .ui-autocomplete-loading {
    background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }
    .star{
    color: red;
    }

	.select2.select2-container.select2-container--default {
		width: 100% !important;
	}
</style>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @include('shared.error')
            @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
            @endif
            <div class="card">
                <form action="{{ url('add-dilation' ) }}" method="POST" class="form-horizontal" id="patient_form">
                    {{ csrf_field() }}
                    <div class="header bg-pink">
                        <h2>Add New dilations</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix ">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="case_number" class="form-control">Patient <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
									<select name="case_id" id="case_id" class="form-control select2" required>
										<option value="">Select</option>
										@foreach($case_details as $case_details_row)
											<option value="{{$case_details_row->id}}">{{$case_details_row->case_number .' : '.$case_details_row->patient_name .' '.$case_details_row->middle_name.' '.$case_details_row->last_name}}</option>
										@endforeach
									</select>
                                </div>
                                <div class="col-md-2">
									<div class="form-group labelgrp">
                                        <label for="case_number" class="form-control">Start Time <b class="star">*</b>:</label>
                                    </div>
								</div>
                                <div class="col-md-4">
									<input type="time" name="start_time" value="" class="form-control">
								</div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-2" >
								<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Submit
                                </button>&nbsp;
                            </div>
                        </div>
                    </div>
                </form>
            </div>

			<div class="card">
				<div class="header bg-pink">
					<h2>Dialations Completed</h2>
				</div>
                <div class="body">
					<table class="table table-hover">
						<thead>
						  <tr>
							<th>Case Number</th>
							<th>Patient Name</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Status</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						@foreach($dilations as $dilationss_row) 

						@php
						$current = new DateTime();
						$time1 = new DateTime($dilationss_row->dilation_date.' '.$dilationss_row->start_time);
						$time2 = new DateTime($dilationss_row->dilation_date.' '.$dilationss_row->end_time);
						
						$timediff = $current->diff($time2);

						@endphp
							@if($current >= $time2) 
							  <tr class="dilations_tr" id="dilations_{{$dilationss_row->dilation_id}}">
								<td>{{$dilationss_row->case_number}}</td>
								<td>{{$dilationss_row->patient_name .' '.$dilationss_row->middle_name.' '.$dilationss_row->last_name}}</td>
								<td>{{$dilationss_row->start_time}}</td>
								<td>{{$dilationss_row->end_time}}</td>
								<td>Completed</td>
								<td><a class="dismiss-notification" href="javascript:void(0)" data-id="{{$dilationss_row->dilation_id}}">Dimiss</a></td>
							  </tr>
							@endif
						@endforeach
						</tbody>
					  </table>
					  
				</div>
            </div>

			<div class="card">
				<div class="header bg-pink">
					<h2>Dialations in Progress</h2>
				</div>
                <div class="body">
					<table class="table table-hover">
						<thead>
						  <tr>
							<th>Case Number</th>
							<th>Patient Name</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Remaining</th>
						  </tr>
						</thead>
						<tbody>
						@foreach($dilations as $dilationss_row) 

						@php
						$current = new DateTime();
						$time1 = new DateTime($dilationss_row->dilation_date.' '.$dilationss_row->start_time);
						$time2 = new DateTime($dilationss_row->dilation_date.' '.$dilationss_row->end_time);
						//$timediff = $time1->diff($time2);
						//echo $timediff->format('%i minute %s second');

						$timediff = $current->diff($time2);

						@endphp
							@if($current < $time2) 
							  <tr>
								<td>{{$dilationss_row->case_number}}</td>
								<td>{{$dilationss_row->patient_name}}</td>
								<td>{{$dilationss_row->start_time}}</td>
								<td>{{$dilationss_row->end_time}}</td>
								<td>{{-- $timediff->format('%i : %S ') --}}<div data-patient_name="{{$dilationss_row->patient_name}}" data-end_time="{{date('M j, Y G:i:s' , strtotime($dilationss_row->dilation_date.' '.$dilationss_row->end_time))}}" class="remaining-timer"></div> </td>
							  </tr>
							@endif
						@endforeach
						</tbody>
					  </table>
					  
				</div>
            </div>


        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
         $('.select2').select2();
    
    });
</script>

<script>


/*
var x = setInterval(function() {
	//console.log('hi');
var records = $('.remaining-timer').length;
	$('.remaining-timer').each(function() {
		if($(this).html() != "EXPIRED") {
			var current_end_time = $(this).data('end_time');
			var patient_name = $(this).data('patient_name');

			var countDownDate = new Date(current_end_time).getTime();

			var now = new Date().getTime();

			var distance = countDownDate - now;

			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
			if(distance > 0) {
				//$(this).html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
				$(this).html(minutes + "m " + seconds + "s ");
			} else {
				$(this).html("EXPIRED");
				
			}
		} else {
			records--;
		}
	});
	if (records < 0) {
		clearInterval(x);
	}
}, 1000);


$('.dismiss-notification').click(function() {
	var dilations_id = $(this).data('id');
	$(this).closest('.dilations_tr').remove();
	
	$.ajax({
		url: "{{url('update-dilation-status')}}",
		method: "POST",
		data:{'id':dilations_id, 'action' : 'acknowledged'},
		success: function(response) {
		
		}
	});

});
*/

</script>

@endsection

