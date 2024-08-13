<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<!-- <label class="form-control">Timing :</label> -->

<label class="form-control">Quantity :</label>
</div>
</div>


<div class="col-md-6">

{{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id='ent_medicine_quantitytbtn' class="btn btn-success  set-dropdown-options" data-table_name="ent_form_dropdowns" data-field_name="medicine_timing" data-form_name="ent_prescription">Set Option </button>    

<button type='button' class="btn btn-primary" id='ent_medicine_quantity_btnsave'>Save Option</button>

<button type="button" name="add" class="btn btn-success  edit-dropdown-options" data-table_name="ent_form_dropdowns" data-field_name="Strength" data-form_name="ent_prescription">Edit</button>
</div>

<div id='ent_medicine_quantity_TextBoxesGroup' class="col-md-12">

</div>
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</div>


<script>
// ent_medicine_quantity_ Add Option

$("#ent_medicine_quantity_btnsave").click(function () {
var content=$("#ent_medicine_quantity_TextBoxesGroup").val();
if (isEmpty($('#ent_medicine_quantity_TextBoxesGroup'))) 
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
var data=$("#ent_medicine_quantity_TextBoxesGroup :input").serialize();
event.preventDefault();
$.ajax({
url:'{{ route("entinsert-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Quatnity", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});



$(document).ready(function(){

var ent_medicine_quantity_counter = 1;

$("#ent_medicine_quantitytbtn").click(function () {

if(ent_medicine_quantity_counter>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+ent_medicine_quantity_counter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ent_prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+ent_medicine_quantity_counter+'" placeholder="value'+ent_medicine_quantity_counter+'" name="optionsval[]"></div><span class="input-group-addon ent_medicine_quantity_removeButton" type="button" id="ent_medicine_quantity_removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#ent_medicine_quantity_TextBoxesGroup").append(newTextBoxDiv);
ent_medicine_quantity_counter++;
});


$(document).on('click', '.ent_medicine_quantity_removeButton', function(e) {
ent_medicine_quantity_counter--;
var target = $("#ent_medicine_quantity_TextBoxesGroup").find("#TextBoxDiv" +ent_medicine_quantity_counter);
$(target).remove();
});


});
</script>