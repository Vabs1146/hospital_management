<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<!-- <label class="form-control"> Duration :</label> -->
<label class="form-control">Day :</label>

</div>
</div>

<div class="col-md-6">
{{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
</div>
<div class="col-md-4">

<button type="button" name="add" id='daytbtn' class="btn btn-success set-dropdown-options" data-table_name="ent_form_dropdowns" data-field_name="Quantity" data-form_name="ent_prescription">Set Option </button>    
<button type='button' class="btn btn-primary" id='daybtnsave'>Save Option</button>
<button type="button" name="add" class="btn btn-success  edit-dropdown-options" data-table_name="ent_form_dropdowns" data-field_name="Quantity" data-form_name="ent_prescription">Edit</button>
</div>

<div id='DayTextBoxesGroup' class="col-md-12"> </div>
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</div>


<script>
// Day Add Option

$("#daybtnsave").click(function () {
var content=$("#DayTextBoxesGroup").val();
if (isEmpty($('#DayTextBoxesGroup'))) 
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
  var data=$("#DayTextBoxesGroup :input").serialize();
event.preventDefault();
$.ajax({
url:'{{ route("entinsert-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Day", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});



$(document).ready(function(){

    var daycounter = 1;

    $("#daytbtn").click(function () {
      
  if(daycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+daycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ent_prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Quantity"><input class="form-control"  type="text" id="optionsval'+daycounter+'" placeholder="value'+daycounter+'" name="optionsval[]"></div><span class="input-group-addon dayremoveButton" type="button" id="dayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#DayTextBoxesGroup").append(newTextBoxDiv);
  daycounter++;
     });


$(document).on('click', '.dayremoveButton', function(e) {
daycounter--;
   var target = $("#DayTextBoxesGroup").find("#TextBoxDiv" +daycounter);
  $(target).remove();
});


  });
</script>