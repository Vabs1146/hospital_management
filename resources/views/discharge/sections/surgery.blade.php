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
<!-- <div classs="col-md-12 dropdown-container">
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
</div> -->

<div id="surgerydetails" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('surgerydetails','Surgery Details') }} 
			</div>
			<input type="hidden" id="surgerydetails[]" name="surgerydetails[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('surgerydetails_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgerydetails')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('surgerydetails_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgerydetails')->pluck('ddText','ddText')->toArray(), array_key_exists('surgerydetails_os', $defaultValues)?$defaultValues['surgerydetails_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='surgerydetailsbtn' class="btn btn-success  set-dropdown-options"  data-field_name="surgerydetails" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='surgerydetailsbtnsave'>Save Option</button>
			<button id="addsurgerydetails" class="btn btn-default addmore" data-templateDiv="surgerydetailstemplate">Add</button>
		</div>
	</div>
	<div id='surgerydetailsTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var surgerydetailscnt = 1;
$("#surgerydetailsbtn").click(function () {
      
  if(surgerydetailscnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgerydetailscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgerydetails"><input class="form-control"  type="hidden"  name="fieldName2" value="surgerydetails"><input class="form-control"  type="text" id="optionsval'+surgerydetailscnt+'" placeholder="value'+surgerydetailscnt+'" name="optionsval[]"></div><span class="input-group-addon surgerydetailsremoveButton" type="button" id="surgerydetailsremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#surgerydetailsTextBoxesGroup").append(newTextBoxDiv);
  surgerydetailscnt++;
     });

$(document).on('click', '.surgerydetailsremoveButton', function(e) {
surgerydetailscnt--;
   var target = $("#surgerydetailsTextBoxesGroup").find("#TextBoxDiv" +surgerydetailscnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#surgerydetailsbtnsave").click(function () {
        var content=$("#surgerydetailsTextBoxesGroup").val();
        if (isEmpty($('#surgerydetailsTextBoxesGroup'))) 

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
 var data=$("#surgerydetailsTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For surgerydetails", text: "Added Successfully!", type: "success"},
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

@include('discharge.sections.main.anaesthetist')

<!-- =========================== Start Anesthesia ============================ -->
@include('discharge.sections.main.anesthesia')

