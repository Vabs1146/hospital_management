<span class="dropdown-container">
	<div id="pastHistory" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Past History</label>
					<input type="hidden" id="pastHistory[]" name="pastHistory[]" class="hiddenCounter" value="1" /> 
				</div>  
			</div>
			<div class="col-md-6">
				{{ Form::select('pastHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'pastHistory_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('pastHistory_OD', $defaultValues)?$defaultValues['pastHistory_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<!-- <div class="col-md-3">
				{{ Form::select('pastHistory_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'pastHistory_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('pastHistory_OS', $defaultValues)?$defaultValues['pastHistory_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div> -->
			<div class="col-md-4">
				<button type="button" name="add" id="pastHistorybtn" class="btn btn-success  set-dropdown-options"  data-field_name="pastHistory_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='pastHistorybtnsave'>Save Option</button>
				<button id="pastHistory" class="btn btn-default addmore" data-templateDiv="pastHistoryTemplate">Add</button>
			</div>
		</div>

	</div>
	<div id='pastHistoryTextBoxesGroup' class="col-md-12">

	</div>
	<div style="display:none;">
	<div id="pastHistoryTemplate">
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="pastHistory[]" name="pastHistory[]" class="hiddenCounter" value="1" />  
				</div>
				<div class="col-md-6">
					{{ Form::select('pastHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'pastHistory_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<!-- <div class="col-md-3">
					{{ Form::select('pastHistory_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'pastHistory_OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
	$dropdown_options_field_name = 'pastHistory_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pastHistory')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2">
		</div>
		<div class="col-md-6">
		<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>
		<!-- <div class="col-md-3">
		<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div> -->
		<div class="col-md-2">
		<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<script>
 $("#pastHistorybtnsave").click(function () {
        var content=$("#pastHistoryTextBoxesGroup").val();
        if (isEmpty($('#pastHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For pastHistory", text: "Added Successfully!", type: "success"},
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
     var pastHistorycnt = 1;
$("#pastHistorybtn").click(function () {
      
  if(pastHistorycnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+pastHistorycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="pastHistory_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="pastHistory_OS"><input class="form-control"  type="text" id="optionsval'+pastHistorycnt+'" placeholder="value'+pastHistorycnt+'" name="optionsval[]"></div><span class="input-group-addon pastHistoryremoveButton" type="button" id="pastHistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#pastHistoryTextBoxesGroup").append(newTextBoxDiv);
  pastHistorycnt++;
     });

$(document).on('click', '.pastHistoryremoveButton', function(e) {
pastHistorycnt--;
   var target = $("#pastHistoryTextBoxesGroup").find("#TextBoxDiv" +pastHistorycnt);
  $(target).remove();
});

</script>