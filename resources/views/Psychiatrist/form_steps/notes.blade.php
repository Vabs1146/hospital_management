
<div class="panel-heading" role="tab" id="headingOne_2">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Notes" aria-expanded="true" aria-controls="Notes">
		Notes
		</a>
	</h4>
</div>

<div id="Notes" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
	<div class="panel-body">
	
	
	
	<!-- =========================== Start form head ===================================== -->	
	<form action="{{ url('save-psychiatrist-notes') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
 
		{{ csrf_field() }}
		{{ Form::hidden('case_id', $casedata['id'], array('class'=> 'form-control')) }}
		{{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
	
	<!-- ============================ End form head ============================================ -->
	@include('Psychiatrist.form_steps.treatment_notes')

	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label>Doctor Notes</label>
			</div>
		</div>

		<div class="col-md-9">
			{{ Form::textarea('doctor_notes',  isset($doctor_notes->notes) ? $doctor_notes->notes : '', array('class'=> 'form-control')) }}
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label>Advice</label>
			</div>
		</div>

		<div class="col-md-9">
			{{ Form::textarea('psychiatrist_advice',  isset($psychiatrist_advice->notes) ? $psychiatrist_advice->notes : '', array('class'=> 'form-control')) }}
		</div>
	</div>
	<!-- ========================================================================== -->
	
	<!-- =========================== Stsart form footer ====================================== -->	

	
	<div class="col-md-12"></div>
	<div class="row clearfix">
		<div class="col-md-4 col-md-offset-4">
			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-lg btn-primary waves-effect"><i class="fa fa-plus"></i> Submit
				</button>					
					<!-- <a class="btn btn-primary waves-effect btn-lg" href="{{url('/ViewEyeDetails').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> View </a> -->					
				<a  target="_blank" class="btn btn-primary waves-effect btn-lg" href="{{ url('/print-psychiatrist-notes').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> Print </a>
					
				<a class="btn btn-primary waves-effect btn-lg" href="{{ url('/case_masters') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
			  
			</div>
		</div>	   
	</div>

	
</form>	

<!-- ============================= End form footer ======================================= -->
</div>
</div>