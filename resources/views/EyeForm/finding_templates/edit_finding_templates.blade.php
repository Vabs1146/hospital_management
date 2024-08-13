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
{{ Form::model($casedata, array('url' => url('manage-finding-template').'/'.$case_id, 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
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

@include('EyeForm.steps.finding.lids')

@include('EyeForm.steps.finding.orbit')

@include('EyeForm.steps.finding.conjandlids')

@include('EyeForm.steps.finding.cornea')

@include('EyeForm.steps.finding.ac')

@include('EyeForm.steps.finding.iris')

@include('EyeForm.steps.finding.pupil')

@include('EyeForm.steps.finding.lens')

@include('EyeForm.steps.finding.vitreins')

@include('EyeForm.steps.finding.retina')

@include('EyeForm.steps.finding.onh')

@include('EyeForm.steps.finding.macula')

@include('EyeForm.steps.finding.sac')


	<div class="row clearfix">	</div>

	<div class="row clearfix" style="text-align: right;"> 
		<div class="col-md-8 col-md-offset-2">
			<div class="form-group">
				{{ Form::button('Submit', array('class' => 'btn btn-primary', 'Value' => '', 'name' => 'prescription_delete', 'type'=>'submit')) }}
				@if(isset($case_id) && $case_id != '')
				<a class="btn btn-danger" href="{{url('AddEditEyeDetails/'.$case_id)}}">Cancel</a>
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



@endsection

@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script>
	$('.addmore').click(function(e) {
		e.preventDefault();
		var template = $("#"+$(this).data('templatediv')).clone();
		
		$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
		
		$(this).closest('div.ContainerToAppend').append($(template).html());
		$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
	   
	});

	$('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
         
          return false;
    });

	$(document).ready(function() {
		$('.select2').select2({width: '100%'});
	});
</script>
@endsection