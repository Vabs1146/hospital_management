
<div class="panel-heading" role="tab" id="headingOne_1">
<h4 class="panel-title">
<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Complaint" aria-expanded="true" aria-controls="Complaint">
Complaint
</a>
</h4>
</div>
<div id="Complaint" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
<div class="panel-body">
<div id="chiefComplaint" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label class="">Chief Complaint</label> 
</div>
<input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="1" />  
</div>
	@php		
	$ChiefComplaint_OD = "";
			$ChiefComplaint_OS = "";

			$ChiefComplaint_OD_duration = "";
			$ChiefComplaint_OS_duration = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item) {
			$ChiefComplaint_OD = $item->field_value_OD;
			$ChiefComplaint_OS = $item->field_value_OS;

			$ChiefComplaint_OD_duration = $item->duration_od;
			$ChiefComplaint_OS_duration = $item->duration_os;
		}
	@endphp
<div class="col-md-5">
{{ Form::text('ChiefComplaint_OD[]', Request::old('ChiefComplaint_OD', $ChiefComplaint_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
{{ Form::text('ChiefComplaint_OS[]', Request::old('ChiefComplaint_OS', $ChiefComplaint_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>
</div>

<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label class="">Duration</label> 
</div>
<!--  <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="1" />   -->
</div>

<div class="col-md-5">
{{ Form::text('ChiefComplaint_OD_duration[]', Request::old('ChiefComplaint_OD_duration', $ChiefComplaint_OD_duration), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
{{ Form::text('ChiefComplaint_OS_duration[]', Request::old('ChiefComplaint_OS_duration', $ChiefComplaint_OS_duration), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

</div>


<div class="dbMultiEntryContainer"></div>

<div id="OpthalHistory" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Opthal History</label> 
</div>
<input type="hidden" id="OpthalHistory[]" name="OpthalHistory[]" class="hiddenCounter" value="1" />
</div>  
	@php	
	$OpthalHistory_OD = "";
			$OpthalHistory_OS = "";

			$OpthalHistory_OD_duration = "";
			$OpthalHistory_OS_duration = "";

		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item) {
			$OpthalHistory_OD = $item->field_value_OD;
			$OpthalHistory_OS = $item->field_value_OS;

			$OpthalHistory_OD_duration = $item->duration_od;
			$OpthalHistory_OS_duration = $item->duration_os;
		}
	@endphp
<div class="col-md-5">
{{ Form::text('OpthalHistory_OD[]', Request::old('OpthalHistory_OD', $OpthalHistory_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
{{ Form::text('OpthalHistory_OS[]', Request::old('OpthalHistory_OS', $OpthalHistory_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>

</div>
<!-- ================================== Start Duration ============================================ -->
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label class="">Duration</label> 
</div>
<!--  <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="1" />   -->
</div>

<div class="col-md-5">
{{ Form::text('OpthalHistory_OD_duration[]', Request::old('OpthalHistory_OD_duration', $OpthalHistory_OD_duration), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

<div class="col-md-5">
{{ Form::text('OpthalHistory_OS_duration[]', Request::old('OpthalHistory_OS_duration', $OpthalHistory_OS_duration), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>

</div>
<!-- ================================== End Duration ============================================ -->
<div id='OpthalTextBoxesGroup' class="col-md-12">

</div>
<div class="dbMultiEntryContainer"></div>


<div id="SystemicHistory" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label> Systemic History</label>
<input type="hidden" id="SystemicHistory[]" name="SystemicHistory[]" class="hiddenCounter" value="1" />
</div>
</div>

	@php		
	$SystemicHistory_OD = "";
			$SystemicHistory_OD_duration = "";
	//echo "========>>>>>>>> <pre>"; print_r($form_details->patients_systemic_history); exit;
		foreach ($form_details->patients_systemic_history as $item) {
			$SystemicHistory_OD = $item->value;
			$SystemicHistory_OD_duration = $item->duration;
		}
	@endphp

<div class="col-md-10">
<div class="form-group">
<div class="form-line">
{{ Form::text('SystemicHistory_OD[]', Request::old('SystemicHistory_OD', $SystemicHistory_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>
</div>
</div>
<div id='SystemicHistoryTextBoxesGroup' class="col-md-12">

</div>
</div>

<!-- ================================== Start Duration ============================================ -->
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label class="">Duration</label> 
</div>
<!--  <input type="hidden" id="ChiefComplaint[]" name="ChiefComplaint[]" class="hiddenCounter" value="1" />   -->
</div>

<div class="col-md-10">
{{ Form::text('SystemicHistory_OD_duration[]', Request::old('SystemicHistory_OD_duration', $SystemicHistory_OD_duration), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>



</div>
<!-- ================================== End Duration ============================================ -->

<div class="dbMultiEntryContainer"></div>

<div id="SystemicHistory" class="ContainerToAppend">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group labelgrp">
<label>Past History</label>
<input type="hidden" id="pastHistory[]" name="pastHistory[]" class="hiddenCounter" value="1" />
</div>
</div>

	@php	
	$pastHistory_OD = "";
		foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pastHistory')->get() as $item) {
			$pastHistory_OD = $item->field_value_OD;
		}
	@endphp

<div class="col-md-10">
<div class="form-group">
<div class="form-line">
{{ Form::text('pastHistory_OD[]', Request::old('pastHistory_OD', $pastHistory_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
</div>
</div>
</div>
</div>
<div id='SystemicHistoryTextBoxesGroup' class="col-md-12">

</div>
</div>

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
</div>

</div>
