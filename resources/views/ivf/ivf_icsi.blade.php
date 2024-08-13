@php //echo "======>>>> <pre>"; print_r($casedata); exit; @endphp
@extends('adminlayouts.master')

@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">
<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">
<style></style>
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
            <form action="{{ url('save-ivf/'.$casedata['id']) }}" method="POST" class="form-horizontal" id="gynform">
            {{--  {{ Form::model($casedata, array('route' => array('case_masters.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}  --}}
               {{ csrf_field() }}
                         <div class="header bg-pink">
							<h2>
                                Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . @$casedata['visit_time']}}  
                            </h2>
                          
                        </div>
						
                        <div class="body">
                           {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                            {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
	{{ Form::hidden('ivf_type', "icsi", array('class'=> 'form-control')) }}
                          <div class="row clearfix">
						 <!--  -------------------------------------------------------------------------- -->

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">            
			{{ Form::label('pre_ivf_hysteroscopy','Pre-IVF Hysteroscopy :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">           
				{{ Form::textarea('pre_ivf_hysteroscopy', ($ivf_icsi->pre_ivf_hysteroscopy) ? $ivf_icsi->pre_ivf_hysteroscopy : '', array('class'=> 'form-control ')) }}       
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">            
			{{ Form::label('protocol','Protocol :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">           
				IVF INJECTION PRISCIPTION FOR OPU   
			</div>
		</div>
	</div>
</div>
		
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="name" class="form-control">Name</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('name', ($ivf_icsi->name) ? $ivf_icsi->name : '', array('class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="age" class="form-control"> Age :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('age', ($ivf_icsi->age) ? $ivf_icsi->age : '', array('class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="lmp_date" class="form-control">LMP</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('lmp_date', ($ivf_icsi->lmp_date) ? $ivf_icsi->lmp_date : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="amh" class="form-control"> AMH :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('amh', ($ivf_icsi->amh) ? $ivf_icsi->amh : '', array('class' => 'form-control')) }}                            
			</div>
		</div>
	</div>
</div>


@include('ivf.elements.icsi_table');

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="opu_date_time" class="form-control">OPU Date Time :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('opu_date_time', ($ivf_icsi->opu_date_time) ? $ivf_icsi->opu_date_time : '', array('class'=> 'form-control datetimepicker')) }}                            
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="ivf_followup" class="form-control">Follow-up Date & Time :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_1', ($ivf_icsi->ivf_followup_1) ? $ivf_icsi->ivf_followup_1 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_2', ($ivf_icsi->ivf_followup_2) ? $ivf_icsi->ivf_followup_2 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_3', ($ivf_icsi->ivf_followup_3) ? $ivf_icsi->ivf_followup_3 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_4', ($ivf_icsi->ivf_followup_4) ? $ivf_icsi->ivf_followup_4 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label for="" class="form-control">Embryology Details</label>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="stimulated" class="form-control">STIMULATED :</label>
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('stimulated', ($ivf_icsi->stimulated) ? $ivf_icsi->stimulated : '', array('class'=> 'form-control')) }}                            
			</div>
		</div>
	</div>
</div>


@include('ivf.elements.icsi_ovary')

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">            
			{{ Form::label('embryology_formed','Embryology Formed :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">           
				{{ Form::textarea('embryology_formed', ($ivf_icsi->embryology_formed) ? $ivf_icsi->embryology_formed : '', array('class'=> 'form-control ')) }}       
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">            
			{{ Form::label('fresh_et','Fresh ET :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">           
				{{ Form::textarea('fresh_et', ($ivf_icsi->fresh_et) ? $ivf_icsi->fresh_et : '', array('class'=> 'form-control ')) }}       
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">            
			{{ Form::label('notes','Notes :') }} 
		</div>
	</div>
	<div class="col-md-10">
		<div class="form-group">
			<div class="form-line">           
				{{ Form::textarea('notes', ($ivf_icsi->notes) ? $ivf_icsi->notes : '', array('class'=> 'form-control ')) }}       
			</div>
		</div>
	</div>
</div>


<!-- ============================================================================ -->
   
						  
						  </div>

                          
                 
           
                                  

                            </div>
<div class="row clearfix">
	<div class="col-md-8 col-md-offset-3">
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_icsi_main" >
			<i class="fa fa-plus"></i> Submit
			</button>
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_od_print" >
			<i class="fa fa-plus"></i> Submit & Print
			</button>
			<a class="btn btn-primary btn-lg" href="{{ url('/ivf-icsi-view').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i> view </a>
		</div>
	</div>
</div>
                            <br><br>
  {{ Form::close() }}                          
                        </div>


						<div class="card">
            <form action="{{ url('save-ivf/'.$casedata['id']) }}" method="POST" class="form-horizontal" id="gynform">
<!-- ===================================================================================== -->
 {{ csrf_field() }}
<div class="header bg-pink">
	<h2>
		SOP FOR HCG INJECTION
	</h2>
</div>
<div class="body">
	{{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
	{{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
	{{ Form::hidden('casehisfem_patient_emailId', Request::old('patient_emailId',$casedata['patient_emailId']), array('class'=> 'form-control')) }}
	<div class="row clearfix">
	<!--  -------------------------------------------------------------------------- -->

		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group labelgrp">            
				Inform sir about
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label for="sop_hcg_ing_trigger_date_time" class="form-control">Trigger Date & Time :</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="form-line">
						{{ Form::text('sop_hcg_ing_trigger_date_time', isset($ivf_icsi_medicine->sop_hcg_ing_trigger_date_time) ? $ivf_icsi_medicine->sop_hcg_ing_trigger_date_time : '', array('class'=> 'form-control datetimepicker')) }}   
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label for="rmo_name" class="form-control">RMO Name</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="form-line">
						{{ Form::text('rmo_name', isset($ivf_icsi_medicine->rmo_name) ? $ivf_icsi_medicine->rmo_name : '', array('class' => 'form-control')) }}                            
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label for="reception_informed" class="form-control"> Reception Informed :</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<div class="form-line">
						{{ Form::text('reception_informed', isset($ivf_icsi_medicine->reception_informed) ? $ivf_icsi_medicine->reception_informed : '', array('class' => 'form-control')) }}                            
					</div>
				</div>
			</div>
		</div>


		@include('ivf.elements.icsi_medicine')

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">            
					{{ Form::label('pt_instruction','Pt. Instruction :') }} 
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<div class="form-line">           
						{{ Form::textarea('pt_instruction', isset($ivf_icsi_medicine->pt_instruction) ? $ivf_icsi_medicine->pt_instruction : '', array('class'=> 'form-control ')) }}       
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-6">
				<div class="form-group labelgrp">            
					{{ Form::label('real_time_video_sent_to_sir','Real Time video with timings to be sent to Sir') }} 
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<div class="form-line">           
						{{ Form::textarea('real_time_video_sent_to_sir', isset($ivf_icsi_medicine->real_time_video_sent_to_sir) ? $ivf_icsi_medicine->real_time_video_sent_to_sir : '', array('class'=> 'form-control ')) }}       
					</div>
				</div>
			</div>
		</div>


	</div>
</div>


<div class="row clearfix">
	<div class="col-md-8 col-md-offset-3">
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_icsi_medicine" >
			<i class="fa fa-plus"></i> SOP FOR HCG INJECTION Print 
			</button>
		</div>
	</div>
</div>

			<br><br>
<!-- ===================================================================================== -->
			</form>
			</div>
                        
                    </div>
                </div>
            </div>


</div>
@endsection

@section('scripts')

@endsection