<span class="dropdown-container">
	<div id="tear_film_breakup_time_div" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
				<label>Tear Film Breakup Time</label>
				</div>
				<input type="hidden" id="tear_film_breakup_time[]" name="tear_film_breakup_time[]" class="hiddenCounter" value="1" />   
			</div>

			<div class="col-md-3">
				{{ Form::select('tear_film_breakup_time_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'tear_film_breakup_time_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('tear_film_breakup_time_OD', $defaultValues)?$defaultValues['tear_film_breakup_time_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-3">
				{{ Form::select('tear_film_breakup_time_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'tear_film_breakup_time_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('tear_film_breakup_time_OS', $defaultValues)?$defaultValues['tear_film_breakup_time_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>

			<div class="col-md-4">
				<button type="button" name="add" id="tear_film_breakup_time_btn" class="btn btn-success  set-dropdown-options"  data-field_name="tear_film_breakup_time_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='tear_film_breakup_time_btnsave'>Save Option</button>
				<button class="btn btn-default addmore" data-templateDiv="tear_film_breakup_time_Template">Add</button>
			</div>

		</div>

	</div>
	<div id='tear_film_breakup_time_TextBoxesGroup' class="col-md-12">

	</div>

	<div style="display:none;">
	<div id="tear_film_breakup_time_Template" >
		<div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="tear_film_breakup_time[]" name="tear_film_breakup_time[]" class="hiddenCounter" value="" />   
			</div>
			<div class="col-md-3">
				{{ Form::select('tear_film_breakup_time_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'tear_film_breakup_time_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
			</div>
			<div class="col-md-3">
				{{ Form::select('tear_film_breakup_time_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'tear_film_breakup_time_OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
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
	$dropdown_options_field_name = 'tear_film_breakup_time_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'tear_film_breakup_time')->get() as $item)
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
	var tear_film_breakup_time_cnt = 1;
	$("#tear_film_breakup_time_btn").click(function () {

	if(tear_film_breakup_time_cnt>10){
	swal("Only 10 Options Values are allow!");
	return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+tear_film_breakup_time_cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="tear_film_breakup_time_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="tear_film_breakup_time_OS"><input class="form-control"  type="text" id="optionsval'+tear_film_breakup_time_cnt+'" placeholder="value'+tear_film_breakup_time_cnt+'" name="optionsval[]"></div><span class="input-group-addon tear_film_breakup_time_removeButton" type="button" id="tear_film_breakup_time_removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#tear_film_breakup_time_TextBoxesGroup").append(newTextBoxDiv);
	tear_film_breakup_time_cnt++;
	});

	$(document).on('click', '.tear_film_breakup_time_removeButton', function(e) {
	tear_film_breakup_time_cnt--;
	var target = $("#tear_film_breakup_time_TextBoxesGroup").find("#TextBoxDiv" +tear_film_breakup_time_cnt);
	$(target).remove();
	});
</script>

<script>
	$("#tear_film_breakup_time_btnsave").click(function () {
		var content=$("#tear_film_breakup_time_TextBoxesGroup").val();
		if (isEmpty($('#tear_film_breakup_time_TextBoxesGroup'))) {
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
					swal({title: "Option For Tear Film Breakup Time", text: "Added Successfully!", type: "success"},
						function(){ 
							location.reload();
						}
					);
				}
			})
		}

	});
</script>