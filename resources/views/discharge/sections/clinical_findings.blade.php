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
			<button type="button" name="add" id='otherDetailsDiagnosisbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsDiagnosis" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsDiagnosisbtnsave'>Save Option</button>
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
var otherDetailsDiagnosiscnt = 1;
$("#otherDetailsDiagnosisbtn").click(function () {
      
  if(otherDetailsDiagnosiscnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsDiagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsDiagnosis"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsDiagnosis"><input class="form-control"  type="text" id="optionsval'+otherDetailsDiagnosiscnt+'" placeholder="value'+otherDetailsDiagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsDiagnosisremoveButton" type="button" id="otherDetailsDiagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsDiagnosisTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsDiagnosiscnt++;
     });

$(document).on('click', '.otherDetailsDiagnosisremoveButton', function(e) {
otherDetailsDiagnosiscnt--;
   var target = $("#otherDetailsDiagnosisTextBoxesGroup").find("#TextBoxDiv" +otherDetailsDiagnosiscnt);
  $(target).remove();
});
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

<!-- <div classs="col-md-12">
	<span class="dropdown-container">
		<div id="investigation_div" class="ContainerToAppend">
			<div class="col-md-12">
				
					<div class="col-md-2">
						<div class="form-group labelgrp">
						<label class="">Investigation</label> 
						</div>
						<input type="hidden" id="investigation[]" name="investigation[]" class="hiddenCounter" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('investigation_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'investigation')->pluck('ddText','ddText')->toArray(), array_key_exists('investigation_od', $defaultValues)?$defaultValues['investigation_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-5">
						<button type="button" name="add" id='advicesetbtn' class="btn btn-success set-dropdown-options" data-field_name="advice_history" data-form_name="EyeForm">Set Option </button>
						
						<button type='button' class="btn btn-primary" id='advicebtnsave'>Save Option</button>

						<button id="addInvestigation" class="btn btn-default addmore" data-templateDiv="investigationtemplate">Add</button>
					</div>
				
			</div>
		</div>
	</span> 
</div> -->

<div id="investigation" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('investigation','Investigation') }} 
			</div>
			<input type="hidden" id="investigation[]" name="investigation[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('investigation_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'investigation')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='investigationbtn' class="btn btn-success  set-dropdown-options"  data-field_name="investigation" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='investigationbtnsave'>Save Option</button>
			<button id="addinvestigation" class="btn btn-default addmore" data-templateDiv="investigationTemplate">Add</button>
		</div>
	</div>
	<div id='investigationTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var investigationcnt = 1;
$("#investigationbtn").click(function () {
      
  if(investigationcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+investigationcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="investigation"><input class="form-control"  type="hidden"  name="fieldName2" value="investigation"><input class="form-control"  type="text" id="optionsval'+investigationcnt+'" placeholder="value'+investigationcnt+'" name="optionsval[]"></div><span class="input-group-addon investigationremoveButton" type="button" id="investigationremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#investigationTextBoxesGroup").append(newTextBoxDiv);
  investigationcnt++;
     });

$(document).on('click', '.investigationremoveButton', function(e) {
investigationcnt--;
   var target = $("#investigationTextBoxesGroup").find("#TextBoxDiv" +investigationcnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#investigationbtnsave").click(function () {
        var content=$("#investigationTextBoxesGroup").val();
        if (isEmpty($('#investigationTextBoxesGroup'))) 

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
 var data=$("#investigationTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Investigation", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>

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
<!-- <div classs="col-md-12 dropdown-container">
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
</div> -->

<div id="treatmentgiven" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('treatmentgiven','treatmentgiven') }} 
			</div>
			<input type="hidden" id="treatmentgiven[]" name="treatmentgiven[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('treatmentgiven_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'treatmentgiven')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('treatmentgiven_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'treatmentgiven')->pluck('ddText','ddText')->toArray(), array_key_exists('treatmentgiven_os', $defaultValues)?$defaultValues['treatmentgiven_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='treatmentgivenbtn' class="btn btn-success  set-dropdown-options"  data-field_name="treatmentgiven" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='treatmentgivenbtnsave'>Save Option</button>
			<button id="addtreatmentgiven" class="btn btn-default addmore" data-templateDiv="treatmentgiventemplate">Add</button>
		</div>
	</div>
	<div id='treatmentgivenTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var treatmentgivencnt = 1;
$("#treatmentgivenbtn").click(function () {
      
  if(treatmentgivencnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+treatmentgivencnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="treatmentgiven"><input class="form-control"  type="hidden"  name="fieldName2" value="treatmentgiven"><input class="form-control"  type="text" id="optionsval'+treatmentgivencnt+'" placeholder="value'+treatmentgivencnt+'" name="optionsval[]"></div><span class="input-group-addon treatmentgivenremoveButton" type="button" id="treatmentgivenremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#treatmentgivenTextBoxesGroup").append(newTextBoxDiv);
  treatmentgivencnt++;
     });

$(document).on('click', '.treatmentgivenremoveButton', function(e) {
treatmentgivencnt--;
   var target = $("#treatmentgivenTextBoxesGroup").find("#TextBoxDiv" +treatmentgivencnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#treatmentgivenbtnsave").click(function () {
        var content=$("#treatmentgivenTextBoxesGroup").val();
        if (isEmpty($('#treatmentgivenTextBoxesGroup'))) 

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
 var data=$("#treatmentgivenTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For treatmentgiven", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>

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

<!-- <div classs="col-md-12">
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
						

						<button id="addreasonofadmission" class="btn btn-default addmore" data-templateDiv="reasonofadmissiontemplate">Add</button>
					</div>
				</div>
				
			
		</div>
	</span> 
</div> -->

<div id="reasonofadmission" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('reasonofadmission','Reason Of Admission') }} 
			</div>
			<input type="hidden" id="reasonofadmission[]" name="reasonofadmission[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('reasonofadmission_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('reasonofadmission_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), array_key_exists('reasonofadmission_os', $defaultValues)?$defaultValues['reasonofadmission_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='reasonofadmissionbtn' class="btn btn-success  set-dropdown-options"  data-field_name="reasonofadmission" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='reasonofadmissionbtnsave'>Save Option</button>
			<button id="addreasonofadmission" class="btn btn-default addmore" data-templateDiv="reasonofadmissiontemplate">Add</button>
		</div>
	</div>
	<div id='reasonofadmissionTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var reasonofadmissioncnt = 1;
$("#reasonofadmissionbtn").click(function () {
      
  if(reasonofadmissioncnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+reasonofadmissioncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="reasonofadmission"><input class="form-control"  type="hidden"  name="fieldName2" value="reasonofadmission"><input class="form-control"  type="text" id="optionsval'+reasonofadmissioncnt+'" placeholder="value'+reasonofadmissioncnt+'" name="optionsval[]"></div><span class="input-group-addon reasonofadmissionremoveButton" type="button" id="reasonofadmissionremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#reasonofadmissionTextBoxesGroup").append(newTextBoxDiv);
  reasonofadmissioncnt++;
     });

$(document).on('click', '.reasonofadmissionremoveButton', function(e) {
reasonofadmissioncnt--;
   var target = $("#reasonofadmissionTextBoxesGroup").find("#TextBoxDiv" +reasonofadmissioncnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#reasonofadmissionbtnsave").click(function () {
        var content=$("#reasonofadmissionTextBoxesGroup").val();
        if (isEmpty($('#reasonofadmissionTextBoxesGroup'))) 

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
 var data=$("#reasonofadmissionTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For reasonofadmission", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>


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

<!-- <div classs="col-md-12">
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
</div> -->

<div id="systemicdiseases" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('systemicdiseases','Systemic Diseases') }} 
			</div>
			<input type="hidden" id="systemicdiseases[]" name="systemicdiseases[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('systemicdiseases_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemicdiseases')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='systemicdiseasesbtn' class="btn btn-success  set-dropdown-options"  data-field_name="systemicdiseases" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='systemicdiseasesbtnsave'>Save Option</button>
			<button id="addsystemicdiseases" class="btn btn-default addmore" data-templateDiv="systemicdiseasestemplate">Add</button>
		</div>
	</div>
	<div id='systemicdiseasesTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var systemicdiseasescnt = 1;
$("#systemicdiseasesbtn").click(function () {
      
  if(systemicdiseasescnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+systemicdiseasescnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="systemicdiseases"><input class="form-control"  type="hidden"  name="fieldName2" value="systemicdiseases"><input class="form-control"  type="text" id="optionsval'+systemicdiseasescnt+'" placeholder="value'+systemicdiseasescnt+'" name="optionsval[]"></div><span class="input-group-addon systemicdiseasesremoveButton" type="button" id="systemicdiseasesremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#systemicdiseasesTextBoxesGroup").append(newTextBoxDiv);
  systemicdiseasescnt++;
     });

$(document).on('click', '.systemicdiseasesremoveButton', function(e) {
systemicdiseasescnt--;
   var target = $("#systemicdiseasesTextBoxesGroup").find("#TextBoxDiv" +systemicdiseasescnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#systemicdiseasesbtnsave").click(function () {
        var content=$("#systemicdiseasesTextBoxesGroup").val();
        if (isEmpty($('#systemicdiseasesTextBoxesGroup'))) 

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
 var data=$("#systemicdiseasesTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For systemicdiseases", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>


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


