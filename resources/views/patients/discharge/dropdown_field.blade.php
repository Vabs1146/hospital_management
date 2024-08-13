<span class="dropdown-container">
	<div id="planOfManagement" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>{{$dropdown_field_title}}</label>
				
				</div>  
			</div>
			<div class="col-md-6">
				{{ Form::select($dropdown_field_key.'_select', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $dropdown_field_key)->pluck('ddText','id')->toArray(), array_key_exists($dropdown_field_key, $defaultValues)?$defaultValues[$dropdown_field_key]:null, array('id'=> $dropdown_field_key.'_select','class'=> 'form-control','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-4">
				<button type="button" name="add" id="{{$dropdown_field_key}}btn" class="btn btn-success  set-dropdown-options"  data-field_name="{{$dropdown_field_key}}_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='{{$dropdown_field_key}}btnsave'>Save Option</button>
				{{--
				<button class="btn btn-default addmore" data-templateDiv="planOfManagementTemplate">Add</button>
				--}}
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					{{-- Form::label('diagnosis','Diagnosis') --}} 
				</div>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<div class="form-line">
			@php
			$cusrrent_value = isset($discharge_summary[$dropdown_field_key]) ? $discharge_summary[$dropdown_field_key]->value_1 : '';
			@endphp
						{{ Form::textarea($dropdown_field_key, Request::old($dropdown_field_key, $cusrrent_value), array('id' => $dropdown_field_key,'class' => 'form-control advicetxtarea', 'autocomplete'=>'off')) }}                        
					</div>
				</div>
			</div>
		</div>

	</div>
	<div id='{{$dropdown_field_key}}TextBoxesGroup' class="col-md-12">

	</div>
	
	<div  id="{{$dropdown_field_key}}_options_template" style="display:none;">
		<div class="col-md-12 main-row-container" >
			<div class="input-group">
				<div class="form-line">
					<input class="form-control"  type="hidden"  name="dropdown_feild_form" value="discharge">
					<input class="form-control"  type="hidden"  name="dropdown_feild_name" value="{{$dropdown_field_key}}">
					<input placeholder="Title" class="form-control"  type="text"  name="optionsTitle[]" value="">
				</div>
			</div>
			<div class="input-group">
				<div class="form-line">
					<textarea placeholder="Details"  class="form-control"  name="optionsval[]"></textarea>
				</div>
				<span class="input-group-addon {{$dropdown_field_key}}removeButton" type="button" id="{{$dropdown_field_key}}removeButton" >
					<i class="fa fa-times" aria-hidden="true"></i>
				</span>
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
	@if(isset($discharge_summary[$dropdown_key]))

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
	
	@endif
</div>

<script>
 $("#{{$dropdown_field_key}}btnsave").click(function () {
        var content=$("#{{$dropdown_field_key}}TextBoxesGroup").val();
        if (isEmpty($('#{{$dropdown_field_key}}TextBoxesGroup'))) 
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
 var data=$("#{{$dropdown_field_key}}TextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert-discharge") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For {{$dropdown_field_key}}", text: "Added Successfully!", type: "success"},
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
$("#{{$dropdown_field_key}}btn").click(function () {

	if(planOfManagementcnt>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}
	
	var newTextBoxDiv = $('#{{$dropdown_field_key}}_options_template').html();

	//var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+planOfManagementcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="planOfManagement_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="planOfManagement_OS"><input class="form-control"  type="text" id="optionsval'+planOfManagementcnt+'" placeholder="value'+planOfManagementcnt+'" name="optionsval[]"></div><span class="input-group-addon planOfManagementremoveButton" type="button" id="planOfManagementremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

	$("#{{$dropdown_field_key}}TextBoxesGroup").append(newTextBoxDiv);
	planOfManagementcnt++;
});

$(document).on('click', '.{{$dropdown_field_key}}removeButton', function(e) {
	$(this).closest('.col-md-12').remove();
});


//$('select[name="{{$dropdown_field_key}}_select"]').change(function() {
//$(document).on('change', '#{{$dropdown_field_key}}', function() {
/*
$('#{{$dropdown_field_key}}').on('select2:select', function (e) {
	var data = e.params.data;
	alert(data);
});
*/


$(document).on('change', '#{{$dropdown_field_key}}_select', function() {
	//alert($(this).val());
	if($(this).val()) {
	$.ajax({
		url:'{{ route("dynamic-field.get-record") }}',
		method:'post',
		data:{'id' : $(this).val()},
		success:function(response) {
			//alert(response.result.ddValue);
			
			$('#{{$dropdown_field_key}}').val(response.result.ddValue);
		}
	})
	} else {
		$('#{{$dropdown_field_key}}').val('');
	}
	
	
 });

</script>
