
<div class="row">
	<div class="col-md-12 col-md-offset-1">
		<div class="col-md-2 ">
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

	<div class="col-md-12 col-md-offset-1">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				{{ Form::label('appointment_dt','Follow up Date : ') }} 
			</div>
		</div>
		<div class="col-md-6">
			<input type="text" name="appointment_dt" id="appointment_dt" class="form-control datepicker">
		</div>     
	</div>
	{{--
	<div class="col-md-12 col-md-offset-1" style="display:none;">
	<div class="col-md-2 ">
	<div class="form-group labelgrp">
	<label>Follow up Time Slot</label>
	</div>
	</div>
	<div class="col-md-6">

	<!--                                     <select class="form-control" readonly id="FollowUpTimeSlot" name="FollowUpTimeSlot"></select>                    -->
	<!-- <input type="text" readonly name="FollowUpTimeSlot" id="FollowUpTimeSlot" class="form-control"> -->
	</div>     
	</div>
	--}}

	<input type="hidden" readonly name="FollowUpTimeSlot" id="FollowUpTimeSlot" class="form-control">
	<!--                              ===============================================================-->
	<div class="col-md-12 col-sm-12 col-xs-12" id="slotdiv">
	<div class="card">
	<div class="header bg-pink">
	<h2>Time Slots for Appoinment </h2>
	</div>
	<div class="body">
	<div class="row clearfix">
	<div class="col-md-12" id="slotsrec">
	<div class="col-md-12" style="display: none;" id="slodrec">
	<div class="form-group">
	<div class="col-md-12" >
	<div class="" id="noslot"></div>
	<div class="col-md-6">
	<div id="Morning" class="align-items-center" style="display: none;">
	<b>Morning Slot</b>
	</div>
	</div>
	</div>
	<div class="col-md-12" id="MorningSlots">
	<div id="appdate"></div>
	</div>
	<div class="col-md-12">
	<div class="col-md-6">
	<div id="Afternoon" style="display: none;">
	<b>Afternoon Slot</b>
	</div>
	</div>
	</div>
	<div class="col-md-12" id="AfternoonSlots">
	<div id="appdate2"></div>
	</div>
	<div class="col-md-12">
	<div class="col-md-6">
	<div id="Evening" style="display: none;">
	<b>Evening Slot</b>
	</div>
	</div>
	</div>
	<div class="col-md-12" id="EveningSlots">
	<div id="appdate1"></div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>


	<!--======================================================-->
	<div class="col-md-12">
	<div class="col-md-6 col-md-offset-4">
	<div class="form-group">
	<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
	<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
	</button>
	</div>
	</div>
	</div>
</div> 

