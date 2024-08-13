<div class="col-md-12">
	<h1>Surgery</h1>
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

	<!-- <div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('surgery_time','Surgery Time') }} 
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('surgery_time', Request::old('surgery_time',$case_master['surgery_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }} 
		</div>
		</div>
	</div>   -->
</div>

<!-- =========================== Start Surgery Details ============================ -->
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="surgerydetails" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Surgery Details</label> 
					</div>
					<input type="hidden" id="surgerydetails[]" name="surgerydetails[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('surgerydetails_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgerydetails')->pluck('ddText','ddText')->toArray(), array_key_exists('surgerydetails_od', $defaultValues)?$defaultValues['surgerydetails_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('surgerydetails_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgerydetails')->pluck('ddText','ddText')->toArray(), array_key_exists('surgerydetails_os', $defaultValues)?$defaultValues['surgerydetails_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-4">
					<button id="addsurgerydetails" class="btn btn-default addmore" data-templateDiv="surgerydetailstemplate">Add</button>
				</div>

			</div>
		</div>
	</span> 
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgerydetails')->get() as $item)
        
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

<!-- =========================== Start Anaesthetist ============================ -->

<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="advice_history" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="col-md-3">
						<div class="form-group labelgrp">
						<label class="">Anaesthetist</label> 
						</div>
						<input type="hidden" id="anaesthetistSurgeonCount[]" name="anaesthetistSurgeonCount[]" class="hiddenCounter" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('anaesthetistSurgeon', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'anaesthetistSurgeon')->pluck('ddText','ddText')->toArray(), isset( $newDischargeData['anaesthetistSurgeon'][0])? $newDischargeData['anaesthetistSurgeon'][0]->field_value:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
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

<!-- =========================== Start Anesthesia ============================ -->

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