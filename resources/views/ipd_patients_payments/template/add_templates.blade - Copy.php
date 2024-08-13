@extends('adminlayouts.master')
<style type="text/css">
.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
color: #700;
cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
color: #f00;
}

.date-from .form-group {
margin-right: 0px;
margin-left: 0px;
}
.date-from label {
padding-right: 0px;
}
</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp

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
{{ Form::model($casedata, array('url' => url('update-hospital-charges-particulars-template'), 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
{{ csrf_field() }}

<div class="header bg-pink">
	<h2>Add/Modify Template </h2>
</div>
<div class="form-group">
	{{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
</div>

<div class="body">

<div class="row clearfix">
	<div class="col-md-3">
		<div class="form-group labelgrp">
			<label>Template Name :</label>
		</div>
	</div>
	<div class="col-md-7">
		<div class="form-group">
			<div class="form-line">
				<input type="text" name="template_name" id="template_name" class="form-control" required>
			</div>
		</div>
	</div> 
	<div class="col-md-2">		</div>
</div>

<input type="hidden" name="total_template_rows" id="total_template_rows" value="1">
<span id="append_template_row">
	<span class="template-row-added">
		
		<div class="row clearfix">		

		
			<div class="col-md-12 perticlar-row" style="background: white;">	
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Particulars  </label>
		</div>
	</div>
	<div class="col-md-4">
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
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Amount </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('amount[]', null, array('class' => 'form-control amount-element', 'id' => 'amount')) }}  
			</div>
		</div>
	</div>

	
</div>

			
		</div>
		
	</span>	
</span>


<hr>

<div class="row clearfix">
	<div class="col-md-4"></div>
	<div class="col-md-3"></div>
	<div class="col-md-3"></div>
	<div class="col-md-2"><a href="javascript:void(0)" class="prescription-template-row btn btn-info">Add more</a></div>
</div>

	<div class="row clearfix">	</div>

	<div class="row clearfix" style="text-align: right;"> 
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				{{ Form::button('Submit', array('class' => 'btn btn-primary', 'Value' => '', 'name' => 'prescription_delete', 'type'=>'submit')) }}
				@if(isset($case_id) && $case_id != '')
				<a class="btn btn-danger" href="{{url('edit-hospital-charges-particulars/'.$case_id)}}">Cancel</a>
				@else
				<!-- <a class="btn btn-danger" href="{{url('case_masters')}}">Cancel</a> -->
				@endif
			</div>
		</div>
	</div>
	</form>
</div>
</div>    
</div>
</div>

<div style="display:none;" id="row_template">
	<span class="template-row-added">
		
		<div class="row clearfix">		

		
			<div class="col-md-12 perticlar-row" style="background: white;">	
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Particulars  </label>
		</div>
	</div>
	<div class="col-md-4">
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
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label for="referedby" class="form-control">Amount </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line"> 
			{{ Form::text('amount[]', null, array('class' => 'form-control amount-element', 'id' => 'amount')) }}  
			</div>
		</div>
	</div>

			<div class="col-md-2"><a href="javascript:void(0)" class="remove-template-row btn btn-danger">Remove</a></div>
	
</div>

			
		</div>
		
	</span>	
</div>

@endsection

@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
$('.select2').select2();
</script>


<script>
$('.prescription-template-row').click(function(e) {
	e.preventDefault();
	
	var total_template_rows = $('#total_template_rows').val();
	
	$('#total_template_rows').val(++total_template_rows);
	
	var template = $('#row_template').clone();
	
	var htm_to_append = $(template).html();
	
	htm_to_append = htm_to_append.replace("main_medicine_id", "medicine_id["+total_template_rows+"]");
	htm_to_append = htm_to_append.replace("numberoftimes", "numberoftimes["+total_template_rows+"]");
	htm_to_append = htm_to_append.replace("medicine_quantity", "medicine_quantity["+total_template_rows+"]");	
	htm_to_append = htm_to_append.replace("strength", "strength["+total_template_rows+"]");
	
	
	$('#append_template_row').append(htm_to_append);

	$('#append_template_row .template-row-added').last().find('.Dyselect2').select2({width: '100%'});
	
	$('#append_template_row .template-row-added').last().find('.current-template-row').val(total_template_rows);
	
	$('#append_template_row .template-row-added').last().find('.addFrequency').attr('data-key', total_template_rows);
	
           
});

$(document).on('click', '.remove-template-row', function() {
	$(this).closest('.template-row-added').remove();
});

$(document).on('change', '.particular-dropdown', function() {
		let amount = $(this).find(':selected').data('amount');

		let parent_tr = $(this).closest('.perticlar-row');

		parent_tr.find('.amount-element').val(amount);
  });
</script>


@endsection