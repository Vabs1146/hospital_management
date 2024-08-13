<div class="col-md-12">
	<h1>Clinical Finding</h1>
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

<script>
// Diagnosis Add Option//
$("#otherDetailsDiagnosisbtnsave").click(function () {
        var content=$("#otherDetailsDiagnosisTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsDiagnosisTextBoxesGroup'))) 

        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 //var data=$("#eyeform").serialize();
 var data=$("#otherDetailsDiagnosisTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Diagnosis", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>

<!-- =========================== Start Investigation ============================ -->

<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="investigation_div" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="col-md-3">
						<div class="form-group labelgrp">
						<label class="">Investigation</label> 
						</div>
						<input type="hidden" id="investigation[]" name="investigation[]" class="hiddenCounter" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('investigation_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'investigation')->pluck('ddText','ddText')->toArray(), array_key_exists('investigation_od', $defaultValues)?$defaultValues['investigation_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-5">
						<!-- <button type="button" name="add" id='advicesetbtn' class="btn btn-success set-dropdown-options" data-field_name="advice_history" data-form_name="EyeForm">Set Option </button>
						
						<button type='button' class="btn btn-primary" id='advicebtnsave'>Save Option</button> -->

						<button id="addInvestigation" class="btn btn-default addmore" data-templateDiv="investigationtemplate">Add</button>
					</div>
				</div>
				<div class="col-md-3">        </div>
			</div>
		</div>
	</span> 
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'investigation')->get() as $item)
        
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

<!-- =========================== Start Treatment Given ============================ -->
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="treatmentgiven_div" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Treatment Given</label> 
					</div>
					<input type="hidden" id="treatmentgiven[]" name="treatmentgiven[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('treatmentgiven_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'treatmentgiven')->pluck('ddText','ddText')->toArray(), array_key_exists('treatmentgiven_od', $defaultValues)?$defaultValues['treatmentgiven_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('treatmentgiven_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'treatmentgiven')->pluck('ddText','ddText')->toArray(), array_key_exists('treatmentgiven_os', $defaultValues)?$defaultValues['treatmentgiven_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-4">  
					<button id="addtreatmentgiven" class="btn btn-default addmore" data-templateDiv="treatmentgiventemplate">Add</button>
				</div>

			</div>
		</div>
	</span> 
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'treatmentgiven')->get() as $item)
        
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

<!-- =========================== Start Reason Of Admission ============================ -->

<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="reasonofadmission_div" class="ContainerToAppend">
			<div class="col-md-12">
				
					<div class="col-md-2">
						<div class="form-group labelgrp">
						<label class="">Reason Of Admission</label> 
						</div>
						<input type="hidden" id="reasonofadmission[]" name="reasonofadmission[]" class="hiddenCounter" value="1" />  
					</div>

					<div class="col-md-3">
						{{ Form::select('reasonofadmission_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), array_key_exists('reasonofadmission_od', $defaultValues)?$defaultValues['reasonofadmission_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-3">
						{{ Form::select('reasonofadmission_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), array_key_exists('reasonofadmission_os', $defaultValues)?$defaultValues['reasonofadmission_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-4">
						<!-- <button type="button" name="add" id='advicesetbtn' class="btn btn-success set-dropdown-options" data-field_name="advice_history" data-form_name="EyeForm">Set Option </button>
						
						<button type='button' class="btn btn-primary" id='advicebtnsave'>Save Option</button> -->

						<button id="addreasonofadmission" class="btn btn-default addmore" data-templateDiv="reasonofadmissiontemplate">Add</button>
					</div>
				</div>
				
			
		</div>
	</span> 
</div>


<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'reasonofadmission')->get() as $item)
        
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

<!-- =========================== Start Systemic Diseases ============================ -->

<div classs="col-md-12">
	<span class="dropdown-container">
		<div id="systemicdiseases_div" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="col-md-3">
						<div class="form-group labelgrp">
						<label class="">Systemic Diseases </label> 
						</div>
						<input type="hidden" id="systemicdiseases[]" name="systemicdiseases[]" class="hiddenCounter" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('systemicdiseases_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemicdiseases')->pluck('ddText','ddText')->toArray(), array_key_exists('systemicdiseases_od', $defaultValues)?$defaultValues['systemicdiseases_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-5">
						

						<button id="addsystemicdiseases" class="btn btn-default addmore" data-templateDiv="systemicdiseasestemplate">Add</button>
					</div>
				</div>
				<div class="col-md-3">        </div>
			</div>
		</div>
	</span> 
</div>


<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'systemicdiseases')->get() as $item)
        
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


