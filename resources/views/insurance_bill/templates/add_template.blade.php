@extends('adminlayouts.master')
<style type="text/css">
button.set-dropdown-options {
	display:none;
}

button.set-dropdown-options + button {
	display:none;
}
</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@php $permissions = session('permissions'); 
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
{{ Form::model($casedata, array('url' => url('update-ipdbill-items-template').'/'.$case_id, 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
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


<div class="row clearfix">
	<div id="payment_details_div">
		<div class="row clearfix bill-item-row">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Item :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="text" name="bill_item[]" id="bill_item" class="form-control" value="{{ $bill_item or ''}}"> 
					</div>
				</div>
			</div> 
			
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Amount :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="number" step="0.01" name="bill_Amount[]" id="bill_Amount" class="form-control" value="{{$bill_Amount or ''}}">
					</div>
				</div>
			</div> 
			
			<div class="col-md-2"><span class="btn btn-success form-control" id="add_ipdbill_item" name="Item_Add" value="Item_Add" > <i class="fa fa-plus"></i> Add</span></div>
		</div>
	</div>
</div>


	
	<span id="item_to_clone" style="display:none;">
	
		<div class="row clearfix bill-item-row">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Item :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="text" name="bill_item[]" id="bill_item" class="form-control" value="{{ $bill_item or ''}}"> 
					</div>
				</div>
			</div> 
			
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Amount :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="number" step="0.01" name="bill_Amount[]" id="bill_Amount" class="form-control" value="{{$bill_Amount or ''}}">
					</div>
				</div>
			</div> 
			
			<div class="col-md-2"><span class="btn btn-success form-control remove_ipdbill_item" name="Item_Add" value="Item_Add" > <i class="fa fa-plus"></i> Remove</span></div>
		</div>
		
		
	</span>

	<div class="row clearfix" style="text-align: right;"> 
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				{{ Form::button('Submit', array('class' => 'btn btn-primary', 'Value' => '', 'name' => 'prescription_delete', 'type'=>'submit')) }}
				@if(isset($case_id) && $case_id != '')
				<a class="btn btn-danger" href="{{url('insuranceBill/'.$case_id)}}/edit">Cancel</a>
				@else
				<a class="btn btn-danger" href="{{url('insuranceBill')}}">Cancel</a>
				@endif
			</div>
		</div>
	</div>
	</form>
</div>
</div>    
</div>
</div>



@endsection

@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script>
	$('#add_ipdbill_item').click(function(e) {
		e.preventDefault();
		var template = $("#item_to_clone").clone();
		
		
		
		$('#payment_details_div').append($(template).html());
	   
	});

	$(document).on('click', '.remove_ipdbill_item' ,function(e){
          e.preventDefault();
          $(this).closest('.bill-item-row').remove();
         //alert('hi');
          return false;
    });
</script>
@endsection