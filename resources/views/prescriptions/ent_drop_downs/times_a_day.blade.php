<div class="frequencyContainerToAppend">	
<!-- <div style="border-bottom:1px solid;" class="col-md-12"></div> -->
<div class="col-md-12 dropdown-container">
<div class="col-md-2">
<div class="form-group labelgrp">
<!-- <label class="form-control">Frequency :</label> -->

<label class="form-control"> Times a Day :</label>
</div>
</div>

<div class="col-md-6">
{{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
</div> 
<div class="col-md-4">

<button type="button" name="add" id='timesadaytbtn' class="btn btn-success set-dropdown-options" data-table_name="ent_form_dropdowns" data-field_name="Times a day" data-form_name="ent_prescription">Set Option </button>    
<button type='button' class="btn btn-primary" id='timesadaybtnsave'>Save Option</button>
<button type="button" name="add" class="btn btn-success  edit-dropdown-options" data-table_name="ent_form_dropdowns" data-field_name="Times a day" data-form_name="ent_prescription">Edit</button>

</div>

<div id='TimesadayTextBoxesGroup' class="col-md-12"> </div>
<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</div>

<div class="col-md-12 dropdown-container">				</div>
<!-- <div style="border-bottom:1px solid;" class="col-md-12"></div> -->


</div>	


<!-- Times a day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

var timesadaycounter = 1;

$("#timesadaytbtn").click(function () {

if(timesadaycounter>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+timesadaycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Times a day"><input class="form-control"  type="text" id="optionsval'+timesadaycounter+'" placeholder="value'+timesadaycounter+'" name="optionsval[]"></div><span class="input-group-addon timesadayremoveButton" type="button" id="timesadayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#TimesadayTextBoxesGroup").append(newTextBoxDiv);
timesadaycounter++;
});


$(document).on('click', '.timesadayremoveButton', function(e) {
timesadaycounter--;
var target = $("#TimesadayTextBoxesGroup").find("#TextBoxDiv" +timesadaycounter);
$(target).remove();
});


});


// Times a day Add Option

      $("#timesadaybtnsave").click(function () {
        var content=$("#TimesadayTextBoxesGroup").val();
        if (isEmpty($('#TimesadayTextBoxesGroup'))) 
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
  var data=$("#TimesadayTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Times a Day", text: "Added Successfully!", type: "success"},
             function(){ 
				location.reload();
              }
            );
            }
        })
    }

    });

</script>