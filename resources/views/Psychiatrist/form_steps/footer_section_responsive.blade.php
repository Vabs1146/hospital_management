<span>
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="form-group labelgrp">
				<label class="">I the undersigned Mr./Mrs./Ms.</label> 
			</div>
		</div>

		<div class="col-md-4">
			{{ Form::text('undersigned_first_name', isset($psychiatrist->undersigned_first_name) ? $psychiatrist->undersigned_first_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('undersigned_middle_name', isset($psychiatrist->undersigned_middle_name) ? $psychiatrist->undersigned_middle_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('undersigned_last_name', isset($psychiatrist->undersigned_last_name) ? $psychiatrist->undersigned_last_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="form-group labelgrp">
				<label class="">declare that I have willingly given the information about &nbsp;
				<input  type="radio" name="about_person" value="self" style="position: initial; opacity: 1;" {{isset($psychiatrist->about_person) && $psychiatrist->about_person == "self" ? 'checked' : ''}}> self &nbsp;&nbsp;
				<input  type="radio" name="about_person" value="relative" style="position: initial; opacity: 1;" {{isset($psychiatrist->about_person) && $psychiatrist->about_person == "relative" ? 'checked' : ''}}> relative &nbsp;&nbsp;
				<input  type="radio" name="about_person" value="friend" style="position: initial; opacity: 1;" {{isset($psychiatrist->about_person) && $psychiatrist->about_person == "friend" ? 'checked' : ''}}> friend &nbsp;&nbsp;
				
				Mr./Mrs./Mast/Ms.</label> 
			</div>
		</div>

		<div class="col-md-4">
			{{ Form::text('about_person_first_name', isset($psychiatrist->about_person_first_name) ? $psychiatrist->about_person_first_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('about_person_middle_name', isset($psychiatrist->about_person_middle_name) ? $psychiatrist->about_person_middle_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('about_person_last_name', isset($psychiatrist->about_person_last_name) ? $psychiatrist->about_person_last_name : '', array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="form-group labelgrp">
				<label class=""> This information is
given with an intention to take help from the mental health professional (Psychiatrist/Psychologist/
Counselor) for the above mentioned problems. I/We am/are willingly ready to follow-up the medication, counseling or testing procedure as and when suggested by the counsulting professional.</label> 
			</div>
		</div>
	</div>
</span>

<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group labelgrp">
			<label class=""><input required type="checkbox" name="accept_terms[]" value="1" style="position: initial; opacity: 1;">
			
			Click here to accept above terms</label>
		</div>
	</div>
</div>

