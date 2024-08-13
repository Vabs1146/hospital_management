@extends('adminlayouts.master')
@section('style')
<style>
#particulars_table td {
	padding : 15px;
}
#particulars_table .form-group {
	padding : 0px 20px;
}
#particulars_table_template td {
	padding : 15px;
}
#particulars_table_template .form-group {
	padding : 0px 20px;
}
</style>
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
	<form action="{{ url('/save-hospital-charges-particulars' ) }}" method="POST" class="form-horizontal" id="hospital_charges_form">
			{{ csrf_field() }}
			<div class="header bg-pink">
				<h2>Add Particulars</h2>
				<span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
			</div>

			<input type="hidden" name="registration_id" value="{{$registration_data->id}}">

			<input type="hidden" name="particular_id" value="{{$patient_particular_data->id or ''}}">

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
								<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{$patient_particular_data->date_time or date('Y-m-d - h:i A')}}" type="text">
							</div>
							</div>
						</div>

						
					</div>

					{{--
					<div class="col-md-12" style="background: white;">	
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Particulars  </label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line"> 

<select class="form-control particular-dropdown" name="particular" id="particular">
	<option value="">Select Particular</option>
	@foreach($ipd_particulars as $parent_id => $ipd_particular)
		@if(isset($ipd_particulars[$parent_id]['childs']))
				<optgroup label="{{$ipd_particular['name']}}">
			@foreach($ipd_particulars[$parent_id]['childs'] as $subcategories)
				  <option data-amount="{{$subcategories['value']}}" value="{{$subcategories['id']}}" {{(isset($patient_particular_data->particular) && $patient_particular_data->particular == $subcategories['id']) ? 'selected' : ''}}>{{$subcategories['name']}}</option>
			@endforeach
				</optgroup>
		@else
			<option value="{{$parent_id}}" {{(isset($patient_particular_data->particular) && $patient_particular_data->particular == $parent_id) ? 'selected' : ''}}>{{$ipd_particular['name']}}</option>
		@endif
	@endforeach
</select>
			</div>
		</div>
	</div>

	
</div>

--}}


<div class="col-md-12">
	<div class="col-md-4">
		<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"> New 
		
		<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template"> Template
	</div>
	<div class="col-md-7 col-md-offset-1">
		<div class="form-group">
			<a class="btn btn-primary btn-lg" href="{{url('add-hospital-charges-particulars-template').'/'.$casedata['id']}}">Create Template</a>
			<a class="btn btn-primary btn-lg" href="{{url('hospital-charges-particulars-templates-listing').'/'.$casedata['id']}}">List Template</a>
		</div>
	</div>
</div>

<span id="hospital_charges_template" style="display:none;">
	<div class="col-md-12">
		<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="form-control">Select Template</label>
				</div>
			</div>
		<div class="col-md-10">
			<select id="select_template" class="form-control">
				<option value="">Select Template</option>
				@foreach($templates as $templates_row)
				<option value="{{$templates_row->id}}">{{$templates_row->template_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</span>

<table style="width:100%; " id="particulars_table" class="new-hospital-charges">
	<tr>
		<th>Sr</th>
		<th>Particulars</th>
		<th>Amount</th>
		<th>Nos.</th>
		<th>Total Amount</th>
		<th></th>
	</tr>
	<tr class="bill-item-tr">
		<td></td>
		<td>
		<div class="form-group">
			<div class="form-line"> 
			<select class="form-control particular-dropdown" name="particular[]" id="particular">
				<option value="">Select Particular</option>
				@foreach($ipd_particulars as $parent_id => $ipd_particular)
					@if(isset($ipd_particulars[$parent_id]['childs']))
							<optgroup label="{{$ipd_particular['name']}}">
						@foreach($ipd_particulars[$parent_id]['childs'] as $subcategories)
							  <option data-amount="{{$subcategories['value']}}" value="{{$subcategories['id']}}" {{(isset($patient_particular_data->particular) && $patient_particular_data->particular == $subcategories['id']) ? 'selected' : ''}}>{{$subcategories['name']}}</option>
						@endforeach
							</optgroup>
					@else
						<option value="{{$parent_id}}" {{(isset($patient_particular_data->particular) && $patient_particular_data->particular == $parent_id) ? 'selected' : ''}}>{{$ipd_particular['name']}}</option>
					@endif
				@endforeach
			</select>
			</div>
		</div>
		</td>
		<td>
			<div class="form-group">
				<div class="form-line"> 
				{{ Form::text('amount[]', Request::old('amount', isset($patient_particular_data->amount) ? $patient_particular_data->amount : ''), array('class' => 'form-control  particular-amount', 'id' => 'amount')) }}  
				</div>
			</div>
		</td>
		<td>
			<div class="form-group">
				<div class="form-line"> 
				{{ Form::text('quantity[]', Request::old('quantity', isset($patient_particular_data->quantity) ? $patient_particular_data->quantity : ''), array('class' => 'form-control particular-quantity', 'id' => 'quantity')) }}  
				</div>
			</div>
		</td>
		<td>
			<div class="form-group">
				<div class="form-line"> 
				{{ Form::text('total_amount[]', Request::old('total_amount', isset($patient_particular_data->total_amount) ? $patient_particular_data->total_amount : ''), array('class' => 'form-control particular-row-total', 'id' => 'total_amount')) }}  
				</div>
			</div>
		</td>
		<td></td>
	</tr>
</table>
{{--
<div class="col-md-12" style="background: white;">	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Amount </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('amount', Request::old('amount', isset($patient_particular_data->amount) ? $patient_particular_data->amount : ''), array('class' => 'form-control', 'id' => 'amount')) }}  
			</div>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Nos. </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('quantity', Request::old('quantity', isset($patient_particular_data->quantity) ? $patient_particular_data->quantity : ''), array('class' => 'form-control', 'id' => 'quantity')) }}  
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Total Amount </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('total_amount', Request::old('total_amount', isset($patient_particular_data->total_amount) ? $patient_particular_data->total_amount : ''), array('class' => 'form-control', 'id' => 'total_amount')) }}  
			</div>
		</div>
	</div>

	
</div>

--}}

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

<script>
	  $(document).on('change', '.particular-dropdown', function() {
			let amount = $(this).find(':selected').data('amount');
			
			//alert(amount);

			let parent_tr = $(this).closest('.bill-item-tr');
			
			parent_tr.find('.particular-amount').val(amount);

			//$('#amount').val(amount);

			calculate_amount(parent_tr);
	  });
	  
	  
	  
	   $(document).on('keyup', '.particular-amount, .particular-quantity', function () {

		  console.log('======== : ' + $(this).val());

			let parent_tr = $(this).closest('.bill-item-tr');
			//parent_tr.find('.particular-amount').val(amount);
		    calculate_amount(parent_tr);
      });


	  function calculate_amount(parent_tr) {
		let quantity = parent_tr.find('.particular-quantity').val();
		let amount   = parent_tr.find('.particular-amount').val();

		let total_amount = parseFloat(quantity) * parseFloat(amount);
		if(total_amount > 0) {
			parent_tr.find('.particular-row-total').val(total_amount);
		} else {
			parent_tr.find('.particular-row-total').val('');
		}
	  }
	</script>

<div class="card">
	<div class="header bg-pink">
	<h2>Particulars</h2>
	</div>
	<div class="body">

		<table style="width:100%;" class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
		<thead>
			<tr>
				<th>Sr No.</th>
				<th>Date & Time</th>
				<th>Particulars</th>
				<th>Amount</th>
				<th>Nos.</th>
				<th>Total Amount</th>
				<th></th>
			</tr>
		</thead>
  <tbody>
  @php $final_total = 0; @endphp
			@foreach($ipd_particulars_records as $key => $ipd_particulars_records_row) 
			<tr>
				<td>{{$key+1}}</td>
				<td>{{$ipd_particulars_records_row->date_time}}</td>
				<td>{{$ipd_particulars_all[$ipd_particulars_records_row->particular]}}</td>
				<td>{{$ipd_particulars_records_row->amount}}</td>
				<td>{{$ipd_particulars_records_row->quantity}}</td>
				<td>{{$ipd_particulars_records_row->total_amount}}</td>

				@php $final_total += $ipd_particulars_records_row->total_amount; @endphp
<td>
<a href="{{url('edit-hospital-charges-particulars/'.$ipd_particulars_records_row->registration_id.'/'.$ipd_particulars_records_row->id)}}">Edit</a>
<a href="{{url('delete-hospital-charges-particulars/'.$ipd_particulars_records_row->registration_id.'/'.$ipd_particulars_records_row->id)}}">Delete</a>
</td>
			</tr>
			@endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="5">Total Amount</td>
      <td>{{$final_total }}</td>
	  <td></td>
    </tr>
  </tfoot>
			
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
//alert(jq);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>

<script>
$('input[name=prescription_type]').click(function() {
	var prescription_type = $(this).val();
	
	//$('#hospital_charges_form').reset();
	
	if(prescription_type == 'new') {
		$('.new-hospital-charges').show();
		$('#hospital_charges_template').hide();
		
		$('#particulars_table_template').remove();
		$('#select_template').val('');
	}

	if(prescription_type == 'template') {
		$('.new-hospital-charges').hide();
		$('#hospital_charges_template').show();
	}
	//alert(prescription_type);
});

$(document).on('change', '#select_template', function() {
	var selected_template = $(this).val();
	//alert(selected_template);

	$.ajax({
		url : '{{url("get-hospital-charges-particulars-template")}}',
		type:'post',
		data : {'id' : $(this).val()},
		datatype: 'html',
		success : function(response) {
			$('#hospital_charges_template').html(response);
		}
	});
});
</script>
@endsection

