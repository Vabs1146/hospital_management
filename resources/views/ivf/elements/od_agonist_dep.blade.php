<span class="dropdown-container">
	<div id="agonist" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Agonist Depo :</label>
					<input type="hidden" id="agonist[]" name="agonist[]" class="hiddenCounter" value="1" /> 
				</div>  
			</div>
			<div class="col-md-4">
				{{ Form::select('agonist_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'agonist_OD')->pluck('ddText','ddText')->toArray(), array_key_exists('agonist_OD', $defaultValues)?$defaultValues['agonist_OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-2">
				{{ Form::text('agonist_OS[]', null, array('class' => 'form-control datepicker')) }}
			</div>
			<div class="col-md-4">
				<button type="button" name="add" id="agonistbtn" class="btn btn-success  set-dropdown-options"  data-field_name="agonist_OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='agonistbtnsave'>Save Option</button>
				<button id="agonist" class="btn btn-default agonist-addmore" data-templateDiv="agonistTemplate">Add</button>
			</div>
		</div>

	</div>
	<div id='agonistTextBoxesGroup' class="col-md-12">

	</div>

	<div class="dbMultiEntryContainer">
		@foreach($ivf_agonist_data as $ivf_agonist_data_row)
		<div class="col-md-12">
			<div class="col-md-2">
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control" readonly value="{{$ivf_agonist_data_row->name}}">
			</div>
			<div class="col-md-2">
				<input type="text" class="form-control" readonly value="{{$ivf_agonist_data_row->date}}">
			</div>
			<div class="col-md-4">
				<button class="removeDbItem btn btn-default" data-deleteid="{{$ivf_agonist_data_row->id}}">Remove</button>
			</div>
		</div>
		@endforeach
	</div>

	<div style="display:none;">
	<div id="agonistTemplate">
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="agonist[]" name="agonist[]" class="hiddenCounter" value="1" />  
				</div>
				<div class="col-md-4">
					{{ Form::select('agonist_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'agonist_OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
			<div class="col-md-2">
				{{ Form::text('agonist_OS[]', null, array('class' => 'form-control datepicker')) }}
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
	$dropdown_options_field_name = 'agonist_OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	</div>
</span>
<!-- ================================================================================= -->


<script>
 $("#agonistbtnsave").click(function () {
        var content=$("#agonistTextBoxesGroup").val();
        if (isEmpty($('#agonistTextBoxesGroup'))) 
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
 var data=$("#agonistTextBoxesGroup :input").serialize();
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
     var agonistcnt = 1;
$("#agonistbtn").click(function () {
      
  if(agonistcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+agonistcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="agonist_OD"><input class="form-control"  type="hidden"  name="fieldName2" value="agonist_OS"><input class="form-control"  type="text" id="optionsval'+agonistcnt+'" placeholder="value'+agonistcnt+'" name="optionsval[]"></div><span class="input-group-addon agonistremoveButton" type="button" id="agonistremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#agonistTextBoxesGroup").append(newTextBoxDiv);
  agonistcnt++;
     });

$(document).on('click', '.agonistremoveButton', function(e) {
agonistcnt--;
   var target = $("#agonistTextBoxesGroup").find("#TextBoxDiv" +agonistcnt);
  $(target).remove();
});



</script>