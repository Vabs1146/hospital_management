<span class="dropdown-container">
<div id="with_glass_dilated_div" class="ContainerToAppend">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label> With Glass  Dilated</label>
			</div> 
			<input type="hidden" id="with_glass_dilated[]" name="with_glass_dilated[]" class="hiddenCounter" value="1" />   
		</div>

		<div class="col-md-3">
		{{-- Form::select('with_glass_dilated_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'with_glass_dilated_od')->pluck('ddText','ddText')->toArray(), array_key_exists('with_glass_dilated_od', $defaultValues)?$defaultValues['with_glass_dilated_od']:null, array('class'=> 'form-control select2')) --}}
		

{{ Form::select('with_glass_dilated_od', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'with_glass_dilated_od')->pluck('ddText','ddText')->toArray(), array_key_exists('with_glass_dilated_od', $defaultValues)?$defaultValues['with_glass_dilated_od']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>

		<div class="col-md-3">

			{{-- Form::select('with_glass_dilated_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'with_glass_dilated_os')->pluck('ddText','ddText')->toArray(), array_key_exists('with_glass_dilated_os', $defaultValues)?$defaultValues['with_glass_dilated_os']:null, array('class'=> 'form-control select2')) --}}

{{ Form::select('with_glass_dilated_os', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'with_glass_dilated_os')->pluck('ddText','ddText')->toArray(), array_key_exists('with_glass_dilated_os', $defaultValues)?$defaultValues['with_glass_dilated_os']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}

		</div>



		<div class="col-md-4">
			<button type="button" name="add" id='with_glass_dilatedVisionbtn' class="btn btn-success  set-dropdown-options"  data-field_name="with_glass_dilated_od" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='with_glass_dilatedVisionbtnsave'>Save Option</button>
			<!-- <button class="btn btn-default addmore" data-templateDiv="with_glass_dilated_Template">Add</button> -->
		</div>

	</div>
</div>
	<div id='with_glass_dilatedVisionTextBoxesGroup' class="col-md-12">

	</div>
	{{--
	<div style="display:none;">
		<div id="with_glass_dilated_Template" >
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="with_glass_dilated[]" name="with_glass_dilated[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					{{ Form::select('with_glass_dilated_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'with_glass_dilated_od')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
					{{ Form::select('with_glass_dilated_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'with_glass_dilated_os')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		</div>
	</div>
	--}}

	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	@php 
	$dropdown_options_field_name = 'with_glass_dilated_od';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>

<div class="dbMultiEntryContainer">
{{--
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'with_glass_dilated')->get() as $item)
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
--}}
</div>

<!-- Color Vision  Set Option -->
<script type="text/javascript">
     var colorvisioncnt = 1;
$("#with_glass_dilatedVisionbtn").click(function () {
      
  if(colorvisioncnt>10){
 swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+colorvisioncnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="with_glass_dilated_od"><input class="form-control"  type="hidden"  name="fieldName2" value="with_glass_dilated_os"><input class="form-control"  type="text" id="optionsval'+colorvisioncnt+'" placeholder="value'+colorvisioncnt+'" name="optionsval[]"></div><span class="input-group-addon colorvisionremoveButton" type="button" id="colorvisionremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#with_glass_dilatedVisionTextBoxesGroup").append(newTextBoxDiv);
  colorvisioncnt++;
     });

$(document).on('click', '.colorvisionremoveButton', function(e) {
colorvisioncnt--;
   var target = $("#with_glass_dilatedVisionTextBoxesGroup").find("#TextBoxDiv" +colorvisioncnt);
  $(target).remove();
});



//==============================================================


 $("#with_glass_dilatedVisionbtnsave").click(function () {
        var content=$("#with_glass_dilatedVisionTextBoxesGroup").val();
        if (isEmpty($('#with_glass_dilatedVisionTextBoxesGroup'))) 
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

			var data = $('#with_glass_dilatedVisionTextBoxesGroup :input').serialize();

        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For With Glass Dilated", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

</script>