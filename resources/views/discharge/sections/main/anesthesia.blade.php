<!-- <div classs="col-md-12">
	<span class="dropdown-container">
		<div id="advice_history" class="ContainerToAppend">
			<div class="col-md-12">
				<div class="col-md-9">
					<div class="col-md-3">
						<div class="form-group labelgrp">
						<label class="">Anesthesia</label> 
						</div>
						<input type="hidden" id="anesthesiaCount[]" name="anesthesiaCount[]" class="anesthesia" value="1" />  
					</div>

					<div class="col-md-4">
						{{ Form::select('anesthesia', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'anesthesia')->pluck('ddText','ddText')->toArray(), isset($newDischargeData['anesthesia'][0]) ?$newDischargeData['anesthesia'][0]->field_value : null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
					</div>

					<div class="col-md-5">
						<button type="button" name="add" id='advicesetbtn' class="btn btn-success set-dropdown-options" data-field_name="advice_history" data-form_name="EyeForm">Set Option </button>
						
						<button type='button' class="btn btn-primary" id='advicebtnsave'>Save Option</button>
						
						<button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="advicetemplate">Add</button>
					</div>
				</div>
				<div class="col-md-3">        </div>
			</div>
		</div>
	</span> 
</div> -->

<div id="anesthesia" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('anesthesia','Anesthesia') }} 
			</div>
			<input type="hidden" id="anesthesia[]" name="anesthesia[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('anesthesia_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'anesthesia')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='anesthesiabtn' class="btn btn-success  set-dropdown-options"  data-field_name="anesthesia" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='anesthesiabtnsave'>Save Option</button>
			<button id="addanesthesia" class="btn btn-default addmore" data-templateDiv="anesthesiaTemplate">Add</button>
		</div>
	</div>
	<div id='anesthesiaTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script>
var anesthesiacnt = 1;
$("#anesthesiabtn").click(function () {
      
  if(anesthesiacnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+anesthesiacnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="anesthesia"><input class="form-control"  type="hidden"  name="fieldName2" value="anesthesia"><input class="form-control"  type="text" id="optionsval'+anesthesiacnt+'" placeholder="value'+anesthesiacnt+'" name="optionsval[]"></div><span class="input-group-addon anesthesiaremoveButton" type="button" id="anesthesiaremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#anesthesiaTextBoxesGroup").append(newTextBoxDiv);
  anesthesiacnt++;
     });

$(document).on('click', '.anesthesiaremoveButton', function(e) {
anesthesiacnt--;
   var target = $("#anesthesiaTextBoxesGroup").find("#TextBoxDiv" +anesthesiacnt);
  $(target).remove();
});
// Diagnosis Add Option//
$("#anesthesiabtnsave").click(function () {
        var content=$("#anesthesiaTextBoxesGroup").val();
        if (isEmpty($('#anesthesiaTextBoxesGroup'))) 

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
 var data=$("#anesthesiaTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Anesthesia", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'anesthesia')->get() as $item)
        
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>

		<div class="col-md-3">
			<!-- <input type="text" class="form-control" readonly value="{{$item->field_value_OS}}"> -->
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<div style="display:none">
	<div id="anesthesiaTemplate">
		<div class="col-md-12">
		<div class="col-md-2">
		<input type="hidden" id="anesthesia[]" name="anesthesia[]" class="hiddenCounter" value="" />
		</div>
		<div class="col-md-3">
		{{ Form::select('anesthesia_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'anesthesia')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
		</div>
		<div class="col-md-3">
		{{-- Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) --}}
		</div>
		<div class="col-md-2">
		<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
		</div>
		</div>
	</div>
</div>