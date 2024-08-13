<div class="col-md-12">
	<h1>Eye Condition on Discharge</h1>
</div>

<!-- =========================== Start Vision ============================ -->
<!-- <div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="surgerydvision_div" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Vision</label> 
					</div>
					<input type="hidden" id="surgerydvision[]" name="surgerydvision[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('surgeryvision_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), array_key_exists('surgeryvision_od', $defaultValues)?$defaultValues['surgeryvision_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('surgerydvision_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), array_key_exists('surgeryvision_os', $defaultValues)?$defaultValues['surgeryvision_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				
				<div class="col-md-4">
					<button id="addsurgeryvision" class="btn btn-default addmore" data-templateDiv="surgeryvisiontemplate">Add</button>
				</div>

			</div>
		</div>
		
	</span> 
</div> -->

<div id="surgeryvision" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('surgeryvision','Vision') }} 
			</div>
			<input type="hidden" id="surgeryvision[]" name="surgeryvision[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('surgeryvision_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('surgeryvision_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), array_key_exists('surgeryvision_os', $defaultValues)?$defaultValues['surgeryvision_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='surgeryvisionbtn' class="btn btn-success  set-dropdown-options"  data-field_name="surgeryvision" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='surgeryvisionbtnsave'>Save Option</button>
			<button id="addsurgeryvision" class="btn btn-default addmore" data-templateDiv="surgeryvisiontemplate">Add</button>
		</div>
	</div>
	<div id='surgeryvisionTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var surgeryvisioncnt = 1;
$("#surgeryvisionbtn").click(function () {
      
  if(surgeryvisioncnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgeryvisioncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgeryvision"><input class="form-control"  type="hidden"  name="fieldName2" value="surgeryvision"><input class="form-control"  type="text" id="optionsval'+surgeryvisioncnt+'" placeholder="value'+surgeryvisioncnt+'" name="optionsval[]"></div><span class="input-group-addon surgeryvisionremoveButton" type="button" id="surgeryvisionremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#surgeryvisionTextBoxesGroup").append(newTextBoxDiv);
  surgeryvisioncnt++;
     });

$(document).on('click', '.surgeryvisionremoveButton', function(e) {
surgeryvisioncnt--;
   var target = $("#surgeryvisionTextBoxesGroup").find("#TextBoxDiv" +surgeryvisioncnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#surgeryvisionbtnsave").click(function () {
        var content=$("#surgeryvisionTextBoxesGroup").val();
        if (isEmpty($('#surgeryvisionTextBoxesGroup'))) 

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
 var data=$("#surgeryvisionTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For surgeryvision", text: "Added Successfully!", type: "success"},
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
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgeryvision')->get() as $item)
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

<!-- =========================== Start Anterior Segment ============================ -->
<!--
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="diagnosis_history" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Anterior Segment</label> 
					</div>
					<input type="hidden" id="diagnosisHistory[]" name="diagnosisHistory[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-4">          </div>

			</div>
		</div>
	</span> 
</div>
-->

<!-- <div id="otherDetailsAnteriorSegment" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsAnteriorSegment','Anterior Segment') }} 
			</div>
			<input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button id="addotherDetailsAnteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsAnteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsAnteriorSegmentTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div> -->

<div id="otherDetailsAnteriorSegment" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsAnteriorSegment','Anterior Segment') }} 
			</div>
			<input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsAnteriorSegment_os', $defaultValues)?$defaultValues['otherDetailsAnteriorSegment_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsAnteriorSegmentbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsAnteriorSegment" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsAnteriorSegmentbtnsave'>Save Option</button>
			<button id="addotherDetailsAnteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsAnteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsAnteriorSegmentTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var otherDetailsAnteriorSegmentcnt = 1;
$("#otherDetailsAnteriorSegmentbtn").click(function () {
      
  if(otherDetailsAnteriorSegmentcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsAnteriorSegmentcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsAnteriorSegment"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsAnteriorSegment"><input class="form-control"  type="text" id="optionsval'+otherDetailsAnteriorSegmentcnt+'" placeholder="value'+otherDetailsAnteriorSegmentcnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsAnteriorSegmentremoveButton" type="button" id="otherDetailsAnteriorSegmentremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsAnteriorSegmentTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsAnteriorSegmentcnt++;
     });

$(document).on('click', '.otherDetailsAnteriorSegmentremoveButton', function(e) {
otherDetailsAnteriorSegmentcnt--;
   var target = $("#otherDetailsAnteriorSegmentTextBoxesGroup").find("#TextBoxDiv" +otherDetailsAnteriorSegmentcnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#otherDetailsAnteriorSegmentbtnsave").click(function () {
        var content=$("#otherDetailsAnteriorSegmentTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsAnteriorSegmentTextBoxesGroup'))) 

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
 var data=$("#otherDetailsAnteriorSegmentTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For otherDetailsAnteriorSegment", text: "Added Successfully!", type: "success"},
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
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get() as $item)
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

<!-- =========================== Start Posterior Segment ============================ -->
<!--
<div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="diagnosis_history" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Posterior Segment</label> 
					</div>
					<input type="hidden" id="diagnosisHistory[]" name="diagnosisHistory[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{ Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis_history')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis_history', $defaultValues)?$defaultValues['diagnosis_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-4">          </div>

			</div>
		</div>
	</span> 
</div>
-->

<!-- <div id="otherDetailsPosteriorSegment" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsPosteriorSegment','Posterior Segment') }}
			</div>
			<input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-4">
			<button id="addotherDetailsPosteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsPosteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsPosteriorSegmentTextBoxesGroup' class="col-md-12"> </div>

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div> -->

<div id="otherDetailsPosteriorSegment" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsPosteriorSegment','Posterior Segment') }} 
			</div>
			<input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsPosteriorSegment_os', $defaultValues)?$defaultValues['otherDetailsPosteriorSegment_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsPosteriorSegmentbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsPosteriorSegment" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsPosteriorSegmentbtnsave'>Save Option</button>
			<button id="addotherDetailsPosteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsPosteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsPosteriorSegmentTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var otherDetailsPosteriorSegmentcnt = 1;
$("#otherDetailsPosteriorSegmentbtn").click(function () {
      
  if(otherDetailsPosteriorSegmentcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsPosteriorSegmentcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsPosteriorSegment"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsPosteriorSegment"><input class="form-control"  type="text" id="optionsval'+otherDetailsPosteriorSegmentcnt+'" placeholder="value'+otherDetailsPosteriorSegmentcnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsPosteriorSegmentremoveButton" type="button" id="otherDetailsPosteriorSegmentremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsPosteriorSegmentTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsPosteriorSegmentcnt++;
     });

$(document).on('click', '.otherDetailsPosteriorSegmentremoveButton', function(e) {
otherDetailsPosteriorSegmentcnt--;
   var target = $("#otherDetailsPosteriorSegmentTextBoxesGroup").find("#TextBoxDiv" +otherDetailsPosteriorSegmentcnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#otherDetailsPosteriorSegmentbtnsave").click(function () {
        var content=$("#otherDetailsPosteriorSegmentTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsPosteriorSegmentTextBoxesGroup'))) 

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
 var data=$("#otherDetailsPosteriorSegmentTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For otherDetailsPosteriorSegment", text: "Added Successfully!", type: "success"},
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
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get() as $item)
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
<!-- =========================== Start Name of IOL ============================ -->
<!-- <div classs="col-md-12 dropdown-container">
	<span class="dropdown-container">
		<div id="discharge_iol_name_div" class="ContainerToAppend">
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="form-group labelgrp">
					<label class="">Name of IOL</label> 
					</div>
					<input type="hidden" id="discharge_iol_name[]" name="discharge_iol_name[]" class="hiddenCounter" value="1" />  
				</div>

				<div class="col-md-3">
					{{ Form::select('discharge_iol_name_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_name_od', $defaultValues)?$defaultValues['discharge_iol_name_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>

				<div class="col-md-3">
					{{-- Form::select('diagnosis[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_name', $defaultValues)?$defaultValues['discharge_iol_name']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) --}}
				</div>

				<div class="col-md-4">          
					<button id="adddischarge_iol_name" class="btn btn-default addmore" data-templateDiv="discharge_iol_name_template">Add</button>
				</div>

			</div>
		</div>
	</span> 
</div> -->

<div id="discharge_iol_name" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('discharge_iol_name','Name of IOL') }} 
			</div>
			<input type="hidden" id="discharge_iol_name[]" name="discharge_iol_name[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('discharge_iol_name_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{-- Form::select('discharge_iol_name_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), array_key_exists('discharge_iol_name_os', $defaultValues)?$defaultValues['discharge_iol_name_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) --}}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='discharge_iol_namebtn' class="btn btn-success  set-dropdown-options"  data-field_name="discharge_iol_name" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='discharge_iol_namebtnsave'>Save Option</button>
			<button id="adddischarge_iol_name" class="btn btn-default addmore" data-templateDiv="discharge_iol_name_template">Add</button>
		</div>
	</div>
	<div id='discharge_iol_nameTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var discharge_iol_namecnt = 1;
$("#discharge_iol_namebtn").click(function () {
      
  if(discharge_iol_namecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+discharge_iol_namecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="discharge_iol_name"><input class="form-control"  type="hidden"  name="fieldName2" value="discharge_iol_name"><input class="form-control"  type="text" id="optionsval'+discharge_iol_namecnt+'" placeholder="value'+discharge_iol_namecnt+'" name="optionsval[]"></div><span class="input-group-addon discharge_iol_nameremoveButton" type="button" id="discharge_iol_nameremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#discharge_iol_nameTextBoxesGroup").append(newTextBoxDiv);
  discharge_iol_namecnt++;
     });

$(document).on('click', '.discharge_iol_nameremoveButton', function(e) {
discharge_iol_namecnt--;
   var target = $("#discharge_iol_nameTextBoxesGroup").find("#TextBoxDiv" +discharge_iol_namecnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#discharge_iol_namebtnsave").click(function () {
        var content=$("#discharge_iol_nameTextBoxesGroup").val();
        if (isEmpty($('#discharge_iol_nameTextBoxesGroup'))) 

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
 var data=$("#discharge_iol_nameTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For discharge_iol_name", text: "Added Successfully!", type: "success"},
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
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'discharge_iol_name')->get() as $item)
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