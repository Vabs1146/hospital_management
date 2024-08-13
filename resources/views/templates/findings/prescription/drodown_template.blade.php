<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">Timing :</label>
		</div>
	</div>


	<div class="col-md-6">
		{{-- Form::select('medicine_timing', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) --}}
		
		{{ Form::select('medicine_timing', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), Request::old('medicine_timing'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
	</div>

	<div class="col-md-4">
		<button type="button" name="add" id='medicine_timingtbtn' class="btn btn-success  set-dropdown-options" data-table_name="form_dropdowns" data-field_name="medicine_timing" data-form_name="">Set Option </button>    
		<button type='button' class="btn btn-primary" id='medicine_timingbtnsave'>Add</button>
	</div>

	<div id='Medicine_timingTextBoxesGroup' class="col-md-12">

	</div>
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
</div>

<!-- Medicine_timing Set Option -->

<script type="text/javascript">

$(document).ready(function(){

	var medicine_timingcounter = 1;

	$("#medicine_timingtbtn").click(function () {

	if(medicine_timingcounter>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+medicine_timingcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="medicine_timing"><input class="form-control"  type="text" id="optionsval'+medicine_timingcounter+'" placeholder="value'+medicine_timingcounter+'" name="optionsval[]"></div><span class="input-group-addon medicine_timingremoveButton" type="button" id="medicine_timingremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';
	
	$("#Medicine_timingTextBoxesGroup").append(newTextBoxDiv);
		medicine_timingcounter++;
	});
	
	$(document).on('click', '.medicine_timingremoveButton', function(e) {
		medicine_timingcounter--;
		var target = $("#Medicine_timingTextBoxesGroup").find("#TextBoxDiv" +medicine_timingcounter);
		$(target).remove();
	});
});
</script>

<script>
// Medicine_timing Add Option

      $("#medicine_timingbtnsave").click(function () {
        var content=$("#Medicine_timingTextBoxesGroup").val();
        if (isEmpty($('#Medicine_timingTextBoxesGroup'))) 
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
 var data=$("#Medicine_timingTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Timing", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>