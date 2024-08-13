
<div class="panel-heading" role="tab" id="headingOne_1">
<h4 class="panel-title">
<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#follow-up" aria-expanded="true" aria-controls="follow-up">
Follow-Up
</a>
</h4>
</div>
<div id="follow-up" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
<div class="panel-body">
<div class="row">
<div class="col-md-12 ">
<div class="col-md-2 col-md-offset-1">
<div class="form-group labelgrp">
{{ Form::label('FollowUpDoctor_id','Doctor : ') }} 
<input type="hidden" name="FollowUpDoctorID"  id="FollowUpDoctorID" value="{{$DID}}">
</div>
</div>
<div class="col-md-6 ">

{{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $doctorlist->toArray(),$selectdoc,array('class' => 'form-control select2','disabled'=>'true')) }}

</div>     
</div>

<div class="col-md-12 col-md-offset-1">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				{{ Form::label('casehistory_followup_notes','Note : ') }} 
			</div>
		</div>
		<div class="col-md-6">
			<textarea name="casehistory_followup_notes" id="casehistory_followup_notes" class="form-control">{{$case_master_data->casehistory_followup_notes??''}}</textarea>
		</div>     
	</div>

<div class="col-md-12 ">
<div class="col-md-2 col-md-offset-1">
<div class="form-group labelgrp">
<label>Date :</label>
</div>
</div>
<div class="col-md-6">
<input type="text" name="appointment_dt" id="appointment_dt" class="form-control datepicker">

</div>     
</div>

<div class="col-md-12 ">
<div class="col-md-2 col-md-offset-1 ">
<div class="form-group labelgrp">
<label>Follow up Time Slot</label>
</div>
</div>
<div class="col-md-6">

<select class="form-control select2" id="FollowUpTimeSlot" name="FollowUpTimeSlot"></select>                    

</div>     
</div>

</div> 
</div>

</div>
