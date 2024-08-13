<span class="dropdown-container">
<div id="laser_procedure_laser_type" class="ContainerToAppend">
	<!-- <div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
				<label>Type of Laser</label>
				</div>
				<input type="hidden" id="laser_procedure_laser_type[]" name="laser_procedure_laser_type[]" class="hiddenCounter" value="1" />   
			</div>
	
			<div class="col-md-3">
				{{ Form::select('laser_procedure_laser_type_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_procedure_laser_type_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('laser_procedure_laser_type_OD', $defaultValues)?$defaultValues['laser_procedure_laser_type_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
	
			<div class="col-md-3" >
				{{ Form::select('laser_procedure_laser_type_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_procedure_laser_type_OS')->pluck('ddText','ddText')->toArray(), array_key_exists('laser_procedure_laser_type_OS', $defaultValues)?$defaultValues['laser_procedure_laser_type_OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
	
			<div class="col-md-4">
				<button type="button" name="add" id='laser_procedure_laser_typebtn' class="btn btn-success  set-dropdown-options"  data-field_name="laser_procedure_laser_type_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='laser_procedure_laser_typebtnsave'>Save Option</button>
	
				<button id="laser_procedure_laser_type" class="btn btn-default addmore" data-templateDiv="laser_procedure_laser_typeTemplate">Add</button>
			</div>
	</div> -->


	<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
				<label>Type of Laser</label>
				</div>
				<input type="hidden" id="laser_procedure_laser_type[]" name="laser_procedure_laser_type[]" class="hiddenCounter" value="1" />   
			</div>

			<div class="col-md-3">
				

				{{ Form::text('laser_procedure_laser_type_OD[]', Request::old('laser_procedure_laser_type_OD', null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-3" >
				
				{{ Form::text('laser_procedure_laser_type_OS[]', Request::old('laser_procedure_laser_type_OS', null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>

			<div class="col-md-4">
				<!-- <button type="button" name="add" id='laser_procedure_laser_typebtn' class="btn btn-success  set-dropdown-options"  data-field_name="laser_procedure_laser_type_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='laser_procedure_laser_typebtnsave'>Save Option</button> -->

				<button id="laser_procedure_laser_type" class="btn btn-default addmore" data-templateDiv="laser_procedure_laser_typeTemplate">Add</button>
			</div>
	</div>

</div> 
<div id='laser_procedure_laser_typeTextBoxesGroup' class="col-md-12">

</div>

<div style="display:none;">
	<div id="laser_procedure_laser_typeTemplate" >
		<div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="laser_procedure_laser_type[]" name="laser_procedure_laser_type[]" class="hiddenCounter" value="" />   
			</div>
			<div class="col-md-3">
				<!-- {{ Form::select('laser_procedure_laser_type_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_procedure_laser_type_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }} -->
				{{ Form::text('laser_procedure_laser_type_OD[]', Request::old('laser_procedure_laser_type_OD', null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-3">
				<!-- {{ Form::select('laser_procedure_laser_type_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'laser_procedure_laser_type_OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }} -->
				{{ Form::text('laser_procedure_laser_type_OS[]', Request::old('laser_procedure_laser_type_OS', null), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
			<div class="col-md-2">
				<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
			</div>
		</div>
	</div>
</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_laser_type')->get() as $item)
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

<!-- Finding Lids Set Option -->
<script type="text/javascript">
	var laser_procedure_laser_typecnt = 1;
	$("#laser_procedure_laser_typebtn").click(function () {

		if(laser_procedure_laser_typecnt>10){
			swal("Only 10 Options Values are allow!");
			return false;
		}

		var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+laser_procedure_laser_typecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="laser_procedure_laser_type_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="laser_procedure_laser_type_OS"><input class="form-control"  type="text" id="optionsval'+laser_procedure_laser_typecnt+'" placeholder="value'+laser_procedure_laser_typecnt+'" name="optionsval[]"></div><span class="input-group-addon laser_procedure_laser_typeremoveButton" type="button" id="laser_procedure_laser_typeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

		$("#laser_procedure_laser_typeTextBoxesGroup").append(newTextBoxDiv);
		laser_procedure_laser_typecnt++;
	});

	$(document).on('click', '.laser_procedure_laser_typeremoveButton', function(e) {
		laser_procedure_laser_typecnt--;
		var target = $("#laser_procedure_laser_typeTextBoxesGroup").find("#TextBoxDiv" +laser_procedure_laser_typecnt);
		$(target).remove();
	});

 $("#laser_procedure_laser_typebtnsave").click(function () {
	var content=$("#laser_procedure_laser_typeTextBoxesGroup").val();
	if (isEmpty($('#laser_procedure_laser_typeTextBoxesGroup'))) {
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
				swal({title: "Option For Type of Laser", text: "Added Successfully!", type: "success"},
					function() { 
						location.reload();
					}
				);
			}
		})
	}
});
</script>