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
	<form action="{{ url('/save-advance-payment-receipt' ) }}" method="POST" class="form-horizontal" id="patient_form">
			{{ csrf_field() }}

			<input type="hidden" name="registration_id" value="{{$registration_data->id}}" >
			<div class="header bg-pink">
				<h2>Advance Amount Payment Receipt</h2>
				<span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
			</div>
			<div class="body">
				<div class="row clearfix ">
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Receipt No</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control" id="receipt_number" name="receipt_number" value="{{$payment_data->receipt_number}}" type="text">
							</div>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group labelgrp">
								<label class="form-control">Date</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<div class="form-line">
								<input class="form-control datepicker" id="receipt_date" name="receipt_date" value="{{date('d-m-Y', strtotime($payment_data->created_at))}}" type="text">
							</div>
							</div>
						</div>
					</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="patient_name" class="form-control">Name of Patient </label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_name', $registration_data->first_name.' '.$registration_data->middle_name.' '.$registration_data->last_name, array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Patient Name ','id'=>'patient_name')) }}                          
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">IPD No. </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control" id="ipd_no" name="ipd_no" value="{{$registration_data->ipd_number}}" type="text">
		</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">UHID No. </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control" id="uhid_no" name="uhid_no" value="{{$registration_data->uhid_number}}" type="text">
		</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="dob" class="form-control">Towards </label>
		</div>
	</div>
	<div class="col-md-9">
		<div class="form-group">
			<div class="form-line">
				<input type="text" class="form-control" id="advance_towards" name="advance_towards" value="{{$payment_data->receipt_number}}">                           
			</div>
		</div>
	</div>

	<div class="col-md-1">
		<div class="form-group labelgrp">
			<label class="form-control"> Advance</label>
		</div>
	</div>
</div>


<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control"> Rupees in Word  </label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('rupees_in_words', Request::old('rupees_in_words', $payment_data->receipt_number), array('class' => 'form-control', 'placeholder'=>'')) }}                            
		</div>
		</div>
	</div>
</div>

<div class="col-md-12" style="background: white;">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Rs </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('advance_amount', $payment_data->advance_amount, array('class' => 'form-control')) }}                             
			</div>
		</div>
	</div>
</div>

					<!-- ====================End panel========================== -->                     

				</div>

				<div class="row clearfix">
					<div class="col-md-8 col-md-offset-2" >
						<button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Save & Print
						</button>&nbsp;
					</div>
				</div>
			</div>
	</form>
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
//alert(jq);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>
@endsection

