<span class="dropdown-container">
	<div id="eye_sonography_div" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
				<label>Eye Sonogrphy</label>
				</div>
				<input type="hidden" id="eye_sonography[]" name="eye_sonography[]" class="hiddenCounter" value="1" />   
			</div>

			<div class="col-md-3">
				{{ Form::select('eye_sonography_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'eye_sonography_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('eye_sonography_OD', $defaultValues)?$defaultValues['eye_sonography_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-3">
				{{ Form::select('eye_sonography_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'eye_sonography_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('eye_sonography_OS', $defaultValues)?$defaultValues['eye_sonography_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-4">
				<button type="button" name="add" id="eye_sonography_btn" class="btn btn-success  set-dropdown-options"  data-field_name="eye_sonography_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='eye_sonography_btnsave'>Save Option</button>
				<button class="btn btn-default addmore" data-templateDiv="eye_sonography_Template">Add</button>
			</div>

		</div>

	</div>
	<div id='eye_sonography_TextBoxesGroup' class="col-md-12">

	</div>

	<div style="display:none;">
	<div id="eye_sonography_Template" >
		<div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="eye_sonography[]" name="eye_sonography[]" class="hiddenCounter" value="" />   
			</div>
			<div class="col-md-3">
				{{ Form::select('eye_sonography_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'eye_sonography_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
			</div>
			<div class="col-md-3">
				{{ Form::select('eye_sonography_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'eye_sonography_OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
			</div>
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
	$dropdown_options_field_name = 'eye_sonography_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'eye_sonography')->get() as $item)
<div class="col-md-12">
<div class="col-md-2">
</div>
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

<script type="text/javascript">
	var eye_sonography_cnt = 1;
	$("#eye_sonography_btn").click(function () {

	if(eye_sonography_cnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+eye_sonography_cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="eye_sonography_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="eye_sonography_OS"><input class="form-control"  type="text" id="optionsval'+eye_sonography_cnt+'" placeholder="value'+eye_sonography_cnt+'" name="optionsval[]"></div><span class="input-group-addon eye_sonography_removeButton" type="button" id="eye_sonography_removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#eye_sonography_TextBoxesGroup").append(newTextBoxDiv);
	eye_sonography_cnt++;
	});

	$(document).on('click', '.eye_sonography_removeButton', function(e) {
	eye_sonography_cnt--;
	var target = $("#eye_sonography_TextBoxesGroup").find("#TextBoxDiv" +eye_sonography_cnt);
	$(target).remove();
	});
</script>

<script>
	$("#eye_sonography_btnsave").click(function () {
		var content=$("#eye_sonography_TextBoxesGroup").val();
		if (isEmpty($('#eye_sonography_TextBoxesGroup'))) {
			swal({
				title: "Please Add Some Option by clicking on",
				text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
				html: true
			});
		} else {
			var data=$("#eyeform").serialize();
			event.preventDefault();
			$.ajax({
				url:'{{ route("dynamic-field.insert") }}',
				method:'post',
				data:data,
				success:function(data) {
					swal({title: "Option For Eye Sonography", text: "Added Successfully!", type: "success"},
						function(){ 
							location.reload();
						}
					);
				}
			})
		}

	});
</script>