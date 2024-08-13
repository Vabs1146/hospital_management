@extends('adminlayouts.master')
@section('style')

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
	<form action="{{ url('/patients/payments-save' ) }}" method="POST" class="form-horizontal" id="patient_form">
			{{ csrf_field() }}
			<div class="header bg-pink">
				<h2>Add payment</h2>
				<span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
			</div>

			<input type="hidden" name="registration_id" value="{{$registration_data->id}}">

			<input type="hidden" name="payment_id" value="{{$payment->id or ''}}">

			<div class="body">
				<div class="row clearfix ">
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date & Time</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{$payment->date_time or date('Y-m-d - h:i A')}}" type="text">
							</div>
							</div>
						</div>

						
					</div>

<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Amount </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('amount', Request::old('amount', isset($payment->advance_amount) ? $payment->advance_amount : ''), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Payment Mode </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
{{-- Form::text('payment_mode', Request::old('payment_mode'), array('class' => 'form-control')) --}}  

<select name="payment_mode" id="payment_mode" class="form-control select2" placeholder="select payment mode">
	<option value="">Select</option> 
	@foreach($payment_modes_array as $key => $val)
	<option value="{{$key}}" {{(isset($payment->payment_mode) && $payment->payment_mode == $key) ? 'selected' : ''}}>{{$val}}</option> 
	@endforeach
</select>
			</div>
		</div>
	</div>

	
</div>


<div class="col-md-12">
<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Payment ID No. </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('payment_id_number', Request::old('payment_id_number', isset($payment->payment_id_number) ? $payment->payment_id_number : ''), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
</div>

					<!-- ====================End panel========================== -->                     

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
	<h2>Payment Chart</h2>
	</div>
	<div class="body">
		<!-- <table style="width:100%;" class="datatable"> -->
		<table style="width:100%;" class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
			<tr>
				<th>Sr No.</th>
				<th>Date & Time</th>
				<!-- <th>Patient Name</th> -->
				<th>Payment Mode</th>
				<th>Amount</th>
				<th>Id No.</th>
				<th></th>
			</tr>
@php $total = 0; @endphp
			@foreach($payment_records as $key => $payment_records_row) 

			@php $total += floatval($payment_records_row->advance_amount); @endphp

			<tr>
				<td>{{$key+1}}</td>
				<td>{{$payment_records_row->date_time}}</td>
				<td>{{$payment_records_row->advance_amount}}</td>
				<td>{{$payment_modes_array[$payment_records_row->payment_mode]}}</td>
				<td>{{$payment_records_row->payment_id_number}}</td>
<td>
<a href="{{url('edit-ipd-payment/'.$payment_records_row->registration_id.'/'.$payment_records_row->id)}}">Edit</a>
<a href="{{url('delete-ipd-payment/'.$payment_records_row->registration_id.'/'.$payment_records_row->id)}}">Delete</a>
<a href="{{url('print-ipd-payment/'.$payment_records_row->registration_id.'/'.$payment_records_row->id)}}">Print</a>
</td>
			</tr>
			@endforeach
			
			@if($total > 0) 
<tr>
	<td colspan="2">Total</td>
	<td >{{$total}}</td>
	<td></td>
	<td></td>
	<td><a href="{{url('print-ipd-payment/'.$payment_records_row->registration_id.'/0')}}">Print</a></td>
</tr>
			@endif
		</table>
	</div>
</div>

</div>
</div>


</div>

<div id="patientPictureModal" class="modal fade" role="dialog"></div>

<div id="templateContainner" style="display:none"></div>

@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript"></script>
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} "></script>
<script>    
jq = $.noConflict(true);
$('.datatable').datatable();
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>
@endsection

