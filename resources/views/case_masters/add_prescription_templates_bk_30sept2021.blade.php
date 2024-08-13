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
{{ Form::model($casedata, array('url' => url('update-prescription-template'), 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
{{ csrf_field() }}

<div class="header bg-pink">
	<h2>Add/Modify Template </h2>
</div>
<div class="form-group">
	{{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
</div>

<div class="body">
	<!-- <div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label>Template Name :</label>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<div class="form-line">
					<input type="text" name="template_name" id="template_name" class="form-control">
				</div>
			</div>
		</div> 
		<div class="col-md-2">		</div>
	</div> -->
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
<!--
<div class="row clearfix">
	<div class="col-md-4">Medicine</div>
	<div class="col-md-3">Frequency</div>
	<div class="col-md-3">Duration</div>
	<div class="col-md-2"></div>
</div>
<span id="append_template_row">
	<div class="row clearfix">
		<div class="col-md-4">{{ Form::select('medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		<div class="col-md-3">{{ Form::select('frequency[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		<div class="col-md-3">{{ Form::select('duration[]', array(''=>'Please select') + $casedata['quantity']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		<div class="col-md-2"></div>
	</div>
</span> -->

<span id="append_template_row">
	<div class="row clearfix">
		<div class="col-md-2">Medicine</div>
		<div class="col-md-3">{{ Form::select('medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		
		<div class="col-md-2">Generic Medicine</div>
		<div class="col-md-3">{{ Form::select('generic_medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		<div class="col-md-2"></div>
	</div>
	
	<div class="row clearfix">
		<div class="col-md-2">Frequency</div>
		<div class="col-md-3">{{ Form::select('frequency[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		
		<div class="col-md-2">Duration</div>
		<div class="col-md-3">{{ Form::select('duration[]', array(''=>'Please select') + $casedata['quantity']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		<div class="col-md-2"></div>
	</div>
	
	<div class="row clearfix">
		<div class="col-md-2">Timing</div>
		<div class="col-md-3">{{ Form::select('medicine_timing[]', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</div>
		
		<div class="col-md-2"></div>
		<div class="col-md-3"></div>
		<div class="col-md-2"></div>
	</div>
</span>

<div class="row clearfix">
	<div class="col-md-4"></div>
	<div class="col-md-3"></div>
	<div class="col-md-3"></div>
	<div class="col-md-2"><a href="javascript:void(0)" class="prescription-template-row btn btn-info">Add more</a></div>
</div>
<!-- <div class="row clearfix">
	<div class="table-responsive append_template_div">
		<table class="table">
			<thead>
				<tr>
					<th>Medicine</th>
					<th>Frequency</th>
					<th>Duration</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="append_template_row">
				<tr>
					<td>{{ Form::select('medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</td>
					<td>{{ Form::select('strength[]', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</td>
					<td>{{ Form::select('numberoftimes[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}</td>
					<td><a href="javascript:void(0)" class="prescription-template-row">Add more</a></td>
				</tr>
			</tbody>
		</table>
	</div>						
	
		
	</div> -->
	<div class="row clearfix">	</div>

	<div class="row clearfix" style="text-align: right;"> 
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				{{ Form::button('Submit', array('class' => 'btn btn-primary', 'Value' => '', 'name' => 'prescription_delete', 'type'=>'submit')) }}
				@if(isset($case_id) && $case_id != '')
				<a class="btn btn-danger" href="{{url('AddEdit/prescription/'.$case_id)}}">Cancel</a>
				@else
				<a class="btn btn-danger" href="{{url('case_masters')}}">Cancel</a>
				@endif
			</div>
		</div>
	</div>
	</form>
</div>
</div>    
</div>
</div>

<!--
<div style="display:none;" id="row_template">
	<div class="row clearfix template-row-added">
		<div class="col-md-4">{{ Form::select('medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		<div class="col-md-3">{{ Form::select('frequency[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		<div class="col-md-3">{{ Form::select('duration[]', array(''=>'Please select') + $casedata['quantity']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
		<div class="col-md-2"><a href="javascript:void(0)" class="remove-prescription-template-row btn btn-danger">Remove</a></div>
	</div>
</div>
-->

<div style="display:none;" id="row_template">
	<span class="template-row-added">
		<hr>
		<div class="row clearfix">
			<div class="col-md-2">Medicine</div>
			<div class="col-md-3">{{ Form::select('medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
			
			<div class="col-md-2">Generic Medicine</div>
			<div class="col-md-3">{{ Form::select('generic_medicine_id[]', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
			<div class="col-md-2"></div>
		</div>
		
		<div class="row clearfix">
			<div class="col-md-2">Frequency</div>
			<div class="col-md-3">{{ Form::select('frequency[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
			
			<div class="col-md-2">Duration</div>
			<div class="col-md-3">{{ Form::select('duration[]', array(''=>'Please select') + $casedata['quantity']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
			<div class="col-md-2"></div>
		</div>
		
		<div class="row clearfix">
			<div class="col-md-2">Timing</div>
			<div class="col-md-3">{{ Form::select('medicine_timing[]', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}</div>
			
			<div class="col-md-2"></div>
			<div class="col-md-3"></div>
			<div class="col-md-2"><a href="javascript:void(0)" class="remove-prescription-template-row btn btn-danger">Remove</a></div>
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
$('.prescription-template-row').click(function() {
	//alert('hi');
	/*
	e.preventDefault();
	//alert('hi');
	var surgery_html = $('#surgeryTemplate').html();

	var replace_text = 'surgery_OS_temp['+$.now()+']';

	surgery_html = surgery_html.replaceAll('surgery_OS_temp', replace_text);

	$('#temp_surgery').html(surgery_html);

	//var template = $('#surgeryTemplate').clone();

	var template = $('#temp_surgery').clone();

	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	$('#temp_surgery').html('');
	*/

	var template = $('#row_template').clone();
	
	$('#append_template_row').append($(template).html());

	$('#append_template_row .template-row-added').last().find('.Dyselect2').select2({width: '100%'});
           
});

$(document).on('click', '.remove-prescription-template-row', function() {
	$(this).closest('.template-row-added').remove();
});
</script>


@endsection