<span class="dropdown-container">
	<div id="planOfManagement" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Plan Of Management</label>
					<input type="hidden" id="planOfManagement[]" name="planOfManagement[]" class="hiddenCounter" value="1" /> 
				</div>  
			</div>
			<div class="col-md-6">
				{{ Form::select('planOfManagement_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'planOfManagement_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('planOfManagement_OD', $defaultValues)?$defaultValues['planOfManagement_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<!-- <div class="col-md-3">
				{{ Form::select('planOfManagement_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'planOfManagement_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('planOfManagement_OS', $defaultValues)?$defaultValues['planOfManagement_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div> -->
			<div class="col-md-4">
				<button type="button" name="add" id="planOfManagementbtn" class="btn btn-success  set-dropdown-options"  data-field_name="planOfManagement_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='planOfManagementbtnsave'>Save Option</button>
				<button id="planOfManagement" class="btn btn-default addmore" data-templateDiv="planOfManagementTemplate">Add</button>
			</div>
		</div>

	</div>
	<div id='planOfManagementTextBoxesGroup' class="col-md-12">

	</div>
	<div style="display:none;">
	<div id="planOfManagementTemplate">
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="planOfManagement[]" name="planOfManagement[]" class="hiddenCounter" value="1" />  
				</div>
				<div class="col-md-6">
					{{ Form::select('planOfManagement_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'planOfManagement_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<!-- <div class="col-md-3">
					{{ Form::select('planOfManagement_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'planOfManagement_OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div> -->
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		</div>
	</div>
	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	@php 
	$dropdown_options_field_name = 'planOfManagement_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'planOfManagement')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2">
		</div>
		<div class="col-md-6">
		<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>
		<div class="col-md-3">
		<input type="text" class="form-control" readonly value="{{ucfirst($item->field_value_OS)}}">
		</div>
		<div class="col-md-2">
		<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<script>
 $("#planOfManagementbtnsave").click(function () {
        var content=$("#planOfManagementTextBoxesGroup").val();
        if (isEmpty($('#planOfManagementTextBoxesGroup'))) 
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
 var data=$("#planOfManagementTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Plan Of Management", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    }); 
</script>


<script type="text/javascript">
     var planOfManagementcnt = 1;
$("#planOfManagementbtn").click(function () {
      
  if(planOfManagementcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+planOfManagementcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="planOfManagement_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="planOfManagement_OS"><input class="form-control"  type="text" id="optionsval'+planOfManagementcnt+'" placeholder="value'+planOfManagementcnt+'" name="optionsval[]"></div><span class="input-group-addon planOfManagementremoveButton" type="button" id="planOfManagementremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#planOfManagementTextBoxesGroup").append(newTextBoxDiv);
  planOfManagementcnt++;
     });

$(document).on('click', '.planOfManagementremoveButton', function(e) {
planOfManagementcnt--;
   var target = $("#planOfManagementTextBoxesGroup").find("#TextBoxDiv" +planOfManagementcnt);
  $(target).remove();
});

</script>