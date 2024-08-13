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
			
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="name_of_age" class="form-control">Age :</label>
			</div>
		</div>
	
	
		<div class="col-md-2">
			<div class="form-group">
			<div class="form-line">
			<input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}">
			</div>
			</div>
		</div>
	
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label for="male_female" class="form-control">Sex :</label>
			</div>
		</div>
	
		<div class="col-md-2">
			<div class="form-group" style="padding-top: 6px">
			<input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked" : "" }}   />
			<label for="radio_8">Male</label>
			<input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" required   {{ ($case_master->male_female == "Female")? "checked" : "" }} />
			<label for="radio_10">Female</label>
			</div>
		</div> 

		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_mobile','Contact No.') }}
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_mobile', Request::old('patient_mobile',$case_master->patient_mobile), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
	</div> 

{{--
<div class="col-md-12">
		<div class="col-md-3">
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
			<input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked="checked"" : "" }}   />
			<label for="radio_8">Male</label>
			<input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple" value="Female" required   {{ ($case_master->male_female == "Female")? "checked="checked"" : "" }} />
			<label for="radio_10">Female</label>
			</div>
		</div> 
	</div> 
--}}


	<!-- <div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_address','Address') }}
		</div>
		</div>
	
		<div class="col-md-6">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_address', Request::old('patient_address',$case_master->patient_address), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
	
		
	</div> -->

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Address <b class="star">*</b>:</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_address', Request::old('patient_address', $case_master->patient_address), array('class' => 'form-control', 'placeholder'=>'Address')) }}       
			</div>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">     {{ Form::text('patient_area', Request::old('patient_area', $case_master->area), array('class' => 'form-control', 'placeholder'=>'Area')) }}                             
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('city', Request::old('city', $case_master->city), array('class' => 'form-control', 'placeholder'=>'City')) }}               
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('district', Request::old('district', $case_master->district), array('class' => 'form-control', 'placeholder'=>'District')) }}                            
			</div>
		</div>
	</div>
</div>

	<!-- <div classs="col-md-12">
		<span class="dropdown-container">
			<div id="surgery_history" class="ContainerToAppend">
				<div class="col-md-12">
	
				<div class="col-md-2">
				<div class="form-group labelgrp">
				<label class="">Surgery/Procedure</label> 
				</div>
				<input type="hidden" id="surgeryHistory[]" name="surgeryHistory[]" class="hiddenCounter" value="1" />  
				</div>
	
				<div class="col-md-3">
				{{ Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery', $defaultValues)?$defaultValues['surgery']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>
	
	
				<div class="col-md-4">				</div>
	
				</div>
			</div>
			
		</span> 
		
	</div> -->


	<div class="col-md-12">

		<!-- <div class="col-sm-2">
		<label for="IPD No." class="control-label">Eye:</label> 
		@if($insurance_bill->left_eye == "1" && $insurance_bill->right_eye == "1")
		Left & Right
		@elseif($insurance_bill->left_eye == "1" )
		Left
		@elseif($insurance_bill->right_eye == "1" )
		Right
		@endif
		</div>    
		
		<div class="col-md-2">
		<input type="hidden" name="left_eye" value="0">
		<input type="checkbox" name="left_eye" id="left_eye" class="bloodtests filled-in chk-col-pink"   value="1" <?php if($insurance_bill->left_eye == 1) { echo "checked"; } else { echo "unchecked"; } ?> />
		<label for="left_eye">Left Eye</label>
		</div>
		<div class="col-md-2">
		<input type="hidden" name="right_eye" value="0">
		
		<input type="checkbox" name="right_eye" id="right_eye" class="bloodtests filled-in chk-col-pink"  value="1" <?php if($insurance_bill->right_eye == 1) { echo "checked"; } else { echo "unchecked"; } ?>/>
		<label for="right_eye">Right Eye</label>
		</div>  -->
		
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
	</div>
	

	@include('discharge.sections.main.surgery_procedure')


	<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('discharge_history','Discharge History') }}
		</div>
		</div>

		<div class="col-md-10">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('discharge_history', Request::old('discharge_history',$case_master->discharge_history), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
	</div> 


	<div class="col-md-12">

		<div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('admission_date_time','Admission Date & Time') }} 
		</div>
		</div>

		<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('admission_date_time', Request::old('admission_date_time',$case_master['admission_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
		</div>
		</div>
		</div>

		<div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('discharge_date_time','Discharge Date & Time') }} 
		</div>
		</div>

		<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('discharge_date_time', Request::old('discharge_date_time',$case_master['discharge_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }} 
		</div>
		</div>
		</div>  
	</div>


	<!-- =========================== Start Systemic Diseases ============================ -->

<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="systemicdiseases_div" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="col-md-3">
						<div class="form-group labelgrp">
						<label class="">Follow Up Date & Time</label> 
						</div>
						<!-- <input type="hidden" id="followup_date_time[]" name="followup_date_time[]" class="hiddenCounter" value="1" />   -->
					</div>

					<div class="col-md-4">
						{{-- Form::select('systemicdiseases_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemicdiseases')->pluck('ddText','ddText')->toArray(), array_key_exists('systemicdiseases_od', $defaultValues)?$defaultValues['systemicdiseases_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) --}}

						{{ Form::text('followup_date_time[]', null, array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}    
					</div>

					<div class="col-md-5">
						<button id="addfollowup_date_time" class="btn btn-default addmore" data-templateDiv="followup_date_timetemplate">Add</button>
					</div>
				</div>
				<div class="col-md-3">        </div>
			</div>
		</div>
	</span> 
</div>


<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'followup_date_time')->get() as $item)
        
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<!-- <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"> -->
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

