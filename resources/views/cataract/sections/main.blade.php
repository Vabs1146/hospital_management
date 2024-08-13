<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="case_number" class="form-control">OPD Case Number :</label>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
			<div class="form-line">
			<input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}"> 
			</div>
			</div>
		</div> 

		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="uhid_no" class="form-control">UHID No. :</label>
			</div>
		</div>


		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
				<input type="text" name="uhid_no" id="uhid_no" class="form-control" value="{{ $case_master['uhid_no'] or ''}}">
				</div>  
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="IPD_no" class="form-control">IPD No. :</label>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
				<input type="text" name="IPD_no" id="IPD_no" class="form-control" value="{{ $case_master['IPD_no'] or ''}}"> 
				</div>
			</div>
		</div> 

		
	</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Name <b class="star">*</b> :</label>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<div class="demo-radio-button" style="padding-top: 6px">
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_1" value="Mr." {{($case_master['mr_mrs_ms'] == "Mr.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_1" style="min-width: 50px;">Mr.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_2" value="Mrs." {{($case_master['mr_mrs_ms'] == "Mrs.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_2" style="min-width: 50px;">Mrs.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_3" value="Ms." {{($case_master['mr_mrs_ms'] == "Ms.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_3" style="min-width: 50px;">Ms.</label>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">				
				{{ Form::text('patient_name',$case_master['patient_name'], array('class' => 'form-control', 'required')) }}  
			</div>
		</div>
	</div>

	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('middle_name',$case_master['middle_name'], array('class' => 'form-control', 'placeholder'=>'Middle Name','id'=>'middle_name')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('last_name',$case_master['last_name'], array('class' => 'form-control', 'placeholder'=>'Surname','id'=>'last_name')) }}                          
			</div>
		</div>
	</div>
</div>

	<div class="col-md-12">
		<!-- <div class="col-md-3">
			<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Name Of Patient :</label>
			</div>
		</div>
		
		
		<div class="col-md-4">
			<div class="form-group">
			<div class="form-line">
			<input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
			</div>  
			</div> 
		</div>
-->
		<div class="col-md-1">
			<div class="form-group labelgrp">
			<label for="name_of_age" class="form-control">Age :</label>
			</div>
		</div>


		<div class="col-md-1">
			<div class="form-group">
			<div class="form-line">
			<input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}">
			</div>
			</div>
		</div>

		<div class="col-md-1">
			<div class="form-group labelgrp">
			<label for="male_female" class="form-control">Sex :</label>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group" style="padding-top: 6px">
			<input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked=\"checked\"" : "" }}   />
			<label for="radio_8">Male</label>
			<input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" required   {{ ($case_master->male_female == "Female")? "checked=\"checked\"" : "" }} />
			<label for="radio_10">Female</label>
			</div>
		</div>   


	</div>
	
	<!-- =========================== Start Surgery Date and Time ============================ -->
<div class="col-md-12">
	<div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('surgery_date_time','Surgery Date and Time ') }} 
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master['surgery_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
		</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('surgery_complete_date_time','Surgery Complete Date and Time ') }} 
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('surgery_complete_date_time', Request::old('surgery_complete_date_time', ($case_master['surgery_complete_date_time'] !='0000-00-00 00:00:00') ? $case_master['surgery_complete_date_time'] : ''), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
		</div>
		</div>
	</div>

</div>


<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="advice_history" class="ContainerToAppend">
			<div class="col-md-12">
					<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('surgeon_name','Surgeon Name') }}
		</div>
		</div>
@php
									$doctors_list = $doctorlist->toArray();
									//dd($doctors_list);
									$doc_key = key($doctors_list);
									$doc_name = $doctors_list[$doc_key];
								@endphp
		<div class="col-md-4">
		<div class="form-group">
		<div class="form-line">
		@if(count($doctors_list) > 1)
		{{ Form::select('surgeon_name', array(''=>'Please select') + $doctorlist->toArray(), Request::old('surgon_name', $discharge->surgeon_name), array('class' => 'form-control select2',  'id'=>'Surgeon','data-live-search'=>'true')) }} 
		 @else
						
									<input class="form-control" name="" value="{{$doc_name}}" type="text" disabled>

									<input class="form-control" name="surgeon_name" value="{{$doc_key}}" type="hidden">
									@endif

		</div>
		</div>
		</div>
					<div class="col-md-2">
						<div class="form-group labelgrp">
						<label class="">Anaesthetist</label> 
						</div>
						<input type="hidden" id="anaesthetistSurgeonCount[]" name="anaesthetistSurgeonCount[]" class="hiddenCounter" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('anaesthetistSurgeon', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'anaesthetistSurgeon')->pluck('ddText','ddText')->toArray(), isset( $newDischargeData['anaesthetistSurgeon'][0])? $newDischargeData['anaesthetistSurgeon'][0]->field_value:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>
			</div>
		</div>
	</span> 
</div>	


<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="advice_history" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="col-md-3">
						<div class="form-group labelgrp">
						<label class="">Anesthesia</label> 
						</div>
						<input type="hidden" id="anesthesiaCount[]" name="anesthesiaCount[]" class="anesthesia" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('anesthesia', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'anesthesia')->pluck('ddText','ddText')->toArray(), isset($newDischargeData['anesthesia'][0]) ?$newDischargeData['anesthesia'][0]->field_value : null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-5">
						<!-- <button type="button" name="add" id='advicesetbtn' class="btn btn-success set-dropdown-options" data-field_name="advice_history" data-form_name="EyeForm">Set Option </button>
						
						<button type='button' class="btn btn-primary" id='advicebtnsave'>Save Option</button>
						
						<button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="advicetemplate">Add</button> -->
					</div>
				</div>
				<div class="col-md-3">        </div>
			</div>
		</div>
	</span> 
</div>

<!-- =========================== Start Diagnosis History ============================ -->
<div id="otherDetailsDiagnosis" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsDiagnosis','Diagnosis') }} 
			</div>
			<input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<!-- <button type="button" name="add" id='otherDetailsDiagnosisbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsDiagnosis" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsDiagnosisbtnsave'>Save Option</button> -->
			<button id="addotherDetailsDiagnosis" class="btn btn-default addmore" data-templateDiv="otherDetailsDiagnosisTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsDiagnosisTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get() as $item)
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
	</div>
	@endforeach
</div>
	

	<!-- ================================================================================= -->

<div id="surgery" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('surgery','Surgery/Procedure') }} 
			</div>
			<input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('surgery_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3 surgery-eye">
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
			<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
		</div> 
		<div class="col-md-4">
			<!-- <button type="button" name="add" id='surgerybtn' class="btn btn-success set-dropdown-options"  data-field_name="surgery" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='surgerybtnsave'>Save Option</button> -->
			<button id="addsurgery1" class="btn btn-default addmore-sergery" data-templateDiv="surgeryTemplate">Add</button>
		</div>
	</div>
	<div id='surgeryTextBoxesGroup' class="col-md-12"> </div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>
		<div class="col-md-3">
			{{ucfirst($item->field_value_OS)}}
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<div style="display:none;">
	<div id="surgeryTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('surgery_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery', $defaultValues)?$defaultValues['surgery']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
				
		<div class="col-md-3 surgery-eye">
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
			<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
		</div> 
		<div class="col-md-2">
			<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
		</div>
        </div>
    </div>
</div>


<!-- <div id="temp_surgery" style="display:none;"></div> -->
<div id="temp_surgery"></div>
<!-- ================================================================================= -->


	

