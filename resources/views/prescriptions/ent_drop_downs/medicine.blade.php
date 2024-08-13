<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<label class="form-control">Medicine :</label>
</div>
</div>


<div class="col-md-6">
{{-- Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '0')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) --}}

{{ Form::select('medicine_id', array(''=>'Please select') + $medicinlist->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
</div>

<div class="col-md-4">
<button type="button" name="add" id='medicinetbtn' class="btn btn-success  set-dropdown-options" data-table_name="entmedical_store" data-field_name="" data-form_name="">Set Option </button>    

<button type='button' class="btn btn-primary" id='medicinebtnsave'>Save Option</button>

<button type="button" name="add" class="btn btn-success  edit-dropdown-options" data-table_name="entmedical_store" data-field_name="" data-form_name="ent_prescription">Edit</button>   
</div>

<div id='MedicineTextBoxesGroup' class="col-md-12">

</div>
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</div>


<script>
// Medicine Add Option

$("#medicinebtnsave").click(function () {
var content=$("#MedicineTextBoxesGroup").val();
if (isEmpty($('#MedicineTextBoxesGroup'))) 
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
var data = $('#MedicineTextBoxesGroup :input').serialize();
event.preventDefault();
$.ajax({
url:'{{ route("entmedicine-field.insert") }}',
method:'post',
data:data,
success:function(data)
{
swal({title: "Option For Medicine", text: "Added Successfully!", type: "success"},
function(){ 
location.reload();
}
);
}
})
}

});


$(document).ready(function() {

	var medcounter = 1;

	$("#medicinetbtn").click(function () {

		if(medcounter>10){
			swal("Only 10 Options Values are allow!");
			return false;
		}

		var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+medcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="balance_quantity" value="1"><input class="form-control"  type="hidden"  name="isactive" value="1"><input class="form-control"  type="text" id="optionsval'+medcounter+'" placeholder="value'+medcounter+'" name="optionsval[]"></div><span class="input-group-addon medicineremoveButton" type="button" id="medicineremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

		$("#MedicineTextBoxesGroup").append(newTextBoxDiv);
		medcounter++;
	});

	$(document).on('click', '.medicineremoveButton', function(e) {
		medcounter--;
		var target = $("#MedicineTextBoxesGroup").find("#TextBoxDiv" +medcounter);
		$(target).remove();
	});


});
</script>