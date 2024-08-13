<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('CNS','General Complaints') }} 
		</div>
	</div>

	<div class="col-md-9">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('CNS', Request::old('CNS',$form_details->CNS), array('class' => 'form-control')) }}                           
			</div>
		</div>
	</div> 
</div>

<div class="col-md-12">
	<div class="col-md-2"> </div>
	<div class="col-md-5">
		<div class="form-group">
			<label>OD</label>
		</div>
	</div>

	<div class="col-md-5">
		<div class="form-group ">
			<label>OS</label>
		</div>
	</div>
</div>

<span class="dropdown-container">
	<div id="chiefComplaint" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="">Chief Complaint</label> 
				</div>
				<input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="1" />  
			</div>

			<div class="col-md-3">
				{{ Form::select('ChiefComplaint_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Chief Complaint OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Chief Complaint OD', $defaultValues)?$defaultValues['Chief Complaint OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-3">
				{{ Form::select('ChiefComplaint_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Chief Complaint OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Chief Complaint OS', $defaultValues)?$defaultValues['Chief Complaint OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-4">
				<button type="button" name="add" id='chiefcomplaintbtn' class="btn btn-success set-dropdown-options" data-field_name="Chief Complaint OD" data-form_name="EyeForm">Set Option </button>

				<button type='button' class="btn btn-primary" id='chiefcomplaintbtnsave'>Save Option</button>

				<button id="addChiefComplaint" class="btn btn-default addmore" data-templateDiv="ChiefComplaintTemplate">Add</button>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="">Duration</label> 
				</div> 
			</div>

			<div class="col-md-3">
				{{ Form::text('ChiefComplaint_OD_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-3">
				{{ Form::text('ChiefComplaint_OS_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-4">
				
			</div>
		</div>

	</div>
	<div id='ChiefTextBoxesGroup' class="col-md-12">

	</div>
	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</span>
<!-- ================================================================================= -->    




<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>

		<div class="col-md-12">
			<div class="col-md-2"> </div>

			<div class="col-md-3">
				<input type="text" class="form-control" readonly value="{{$item->duration_od}}">
			</div>

			<div class="col-md-3">
				<input type="text" class="form-control" readonly value="{{$item->duration_os}}">
			</div>

			<div class="col-md-2">
				
			</div>
		</div>
	</div>
	@endforeach
</div>

<span class="dropdown-container">
	<div id="OpthalHistory" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Ophthalmic History</label> 
				</div>
				<input type="hidden" id="OpthalHistory[]" name="OpthalHistory[]" class="hiddenCounter" value="1" />
			</div>  

			<div class="col-md-3">
				{{ Form::select('OpthalHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Opthal History OD', $defaultValues)?$defaultValues['Opthal History OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-3">
				{{ Form::select('OpthalHistory_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Opthal History OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Opthal History OS', $defaultValues)?$defaultValues['Opthal History OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-4">
				<button type="button" name="add" id='opthahistorybtn' class="btn btn-success set-dropdown-options"  data-field_name="Opthal History OS" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='opthahistorybtnsave'>Save Option</button>
				<button id="addOpthalHistory" class="btn btn-default addmore" data-templateDiv="OpthalHistoryTemplate">Add</button>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="">Duration</label> 
				</div>
			</div>

			<div class="col-md-3">
				{{ Form::text('OpthalHistory_OD_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-3">
				{{ Form::text('OpthalHistory_OS_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-4">
				
			</div>
		</div>

	</div>
	<div id='OpthalTextBoxesGroup' class="col-md-12">

	</div>
	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</span>
<!-- ================================================================================= -->



<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>

		<div class="col-md-12">
			<div class="col-md-2"> </div>

			<div class="col-md-3">
				<input type="text" class="form-control" readonly value="{{$item->duration_od}}">
			</div>

			<div class="col-md-3">
				<input type="text" class="form-control" readonly value="{{$item->duration_os}}">
			</div>

			<div class="col-md-2">
				
			</div>
		</div>
	</div>
	@endforeach
</div>

<!-- ================================================================================= -->
<span class="dropdown-container">
	<div id="systemic_history" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="">Systemic History</label> 
				</div>
				<input type="hidden" id="systemicHistory[]" name="systemicHistory[]" class="hiddenCounter" value="1" />  
			</div>

			<div class="col-md-6">
				{{ Form::select('SystemicHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemic_history')->pluck('ddText','ddText')->toArray(), array_key_exists('systemic_history', $defaultValues)?$defaultValues['systemic_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-4">
				<button type="button" name="add" id='systemichistorybtn' class="btn btn-success set-dropdown-options" data-field_name="systemic_history" data-form_name="EyeForm">Set Option </button>

				<button type='button' class="btn btn-primary" id='systemichistorybtnsave'>Save Option</button>

				<button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="SystemicHistoryTemplate">Add</button>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="">Duration</label> 
				</div>
			</div>

			<div class="col-md-6">
				{{ Form::text('SystemicHistory_OD_duration[]', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-4">
				
			</div>
		</div>
	</div>
	<div id='SystemicHistoryTextBoxesGroup' class="col-md-12"> 	</div>

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</span>
<!-- ================================================================================= -->

<div class="dbMultiEntryContainer">
	@foreach ($form_details->patients_systemic_history as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>
		<div class="col-md-8">
			<input type="text" class="form-control" readonly value="{{$item->value}}">
		</div>
		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="systemic_history">Remove</button>
		</div>

		<div class="col-md-12">
			<div class="col-md-2"> </div>

			<div class="col-md-8">
				<input type="text" class="form-control" readonly value="{{$item->duration}}">
			</div>

			<div class="col-md-2">
				
			</div>
		</div>
	</div>
	@endforeach
</div>


@include('EyeForm.steps.1.past_history')

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Family History</label>
		</div>
	</div>

	<div class="col-md-9">
		{{ Form::textarea('familyHistory', Request::old('familyHistory',$form_details->familyHistory), array('class'=> 'form-control')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Birth History</label>
		</div>
	</div>

	<div class="col-md-9">
		{{ Form::textarea('birthHistory', Request::old('birthHistory',$form_details->birthHistory), array('class'=> 'form-control')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Past Treatment History</label>
		</div>
	</div>

	<div class="col-md-9">
		{{ Form::textarea('pastTreatmentHistory', Request::old('pastTreatmentHistory',$form_details->pastTreatmentHistory), array('class'=> 'form-control')) }}
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="infection" class="form-control">Allergy</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('infection', Request::old('infection', $casedata['infection']), array('class' => 'form-control')) }}  
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">Miscellaneous History :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('miscellaneous_history', Request::old('infection', $casedata['miscellaneous_history']), array('class' => 'form-control')) }}                             
			</div>
		</div>
	</div>
</div>

<div class="col-md-12 custom-item-parent-div">
	<div class="row custom-item">
		<div class="col-md-4">
			<select class="custom-item-dropdown form-control select2">
				<option value="">Select Option</option>
				<option value="ChiefComplaint" data-title="Chief Complaint" data-od="ChiefComplaint_OD[]" data-os="ChiefComplaint_OS[]">Chief Complaint</option>
				<option value="OpthalHistory" data-title="Ophthalmic History" data-od="OpthalHistory_OD[]" data-os="OpthalHistory_OS[]">Ophthalmic History</option>
				<option value="systemicHistory" data-title="Systemic History" data-od="SystemicHistory_OD[]">Systemic History</option>
				<option value="pastHistory" data-title="Past History" data-od="pastHistory_OD[]">Past History</option>
			</select>
		</div>
		<div class="col-md-3"> </div>
		<div class="col-md-3"> </div>
		<div class="col-md-2">
			<span class="add-custom-item btn btn-default">Add</span>
		</div>
	</div>
	<div class="custom-item-container">

	</div>
</div>                                    
<div class="col-md-12">
	<div class="col-md-6 col-md-offset-4">
		<div class="form-group">
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submitandview" class="btn btn-primary btn-lg" value="submitandview">Submit & View
			</button>
		</div>
	</div>
</div>

