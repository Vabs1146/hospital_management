<!-- ================================================================================= -->
	{{--
<div id="surgery" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('surgery','Surgery/Procedure') }} 
			</div>
			<input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('surgery_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3 surgery-eye">
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
			<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='surgerybtn' class="btn btn-success set-dropdown-options"  data-field_name="surgery" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='surgerybtnsave'>Save Option</button>
			<button id="addsurgery1" class="btn btn-default addmore-sergery" data-templateDiv="surgeryTemplate">Add</button>
		</div>
	</div>
	<div id='surgeryTextBoxesGroup' class="col-md-12"> </div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script type="text/javascript">
     var surgerycnt = 1;
$("#surgerybtn").click(function () {
      
  if(surgerycnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgerycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgery"><input class="form-control"  type="hidden"  name="fieldName2" value="surgery"><input class="form-control"  type="text" id="optionsval'+surgerycnt+'" placeholder="value'+surgerycnt+'" name="optionsval[]"></div><span class="input-group-addon surgeryremoveButton" type="button" id="surgeryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#surgeryTextBoxesGroup").append(newTextBoxDiv);
  surgerycnt++;
     });

$(document).on('click', '.surgeryremoveButton', function(e) {
surgerycnt--;
   var target = $("#surgeryTextBoxesGroup").find("#TextBoxDiv" +surgerycnt);
  $(target).remove();
});

// ANTERIOR SEGMENT Add Option//
$("#surgerybtnsave").click(function () {
        var content=$("#surgeryTextBoxesGroup").val();
        if (isEmpty($('#surgeryTextBoxesGroup'))) 
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

 var data = $('#surgeryTextBoxesGroup :input').serialize();
        event.preventDefault();
        $.ajax({
            url:'{{url("dynamic-field/insert")}}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Surgery", text: "Added Successfully!", type: "success"},
             function(){ 
              //location.reload();
              }
            );
            }
        })
    }

    });

</script>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>
		<div class="col-md-3">
			{{ucfirst($item->field_value_OS)}}
		</div>

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>

<div style="display:none;">
	<div id="surgeryTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('surgery_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery', $defaultValues)?$defaultValues['surgery']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
				
		<div class="col-md-3 surgery-eye">
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
			<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
		</div> 
		<div class="col-md-2">
			<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
		</div>
        </div>
    </div>
</div>


<!-- <div id="temp_surgery" style="display:none;"></div> -->
<div id="temp_surgery"></div>

--}}



<div id="surgery" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('surgery','Surgery/Procedure') }} 
			</div>
			<input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('surgery_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3 surgery-eye">
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
			<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='surgerybtn' class="btn btn-success set-dropdown-options"  data-field_name="surgery" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='surgerybtnsave'>Save Option</button>
			<button id="addsurgery1" class="btn btn-default addmore-sergery" data-templateDiv="surgeryTemplate">Add</button>
		</div>
	</div>
	<div id='surgeryTextBoxesGroup' class="col-md-12"> </div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<script type="text/javascript">
$(document).on('click', '.surgery-eye-radio', function() {
	//alert($(this).val());
	$(this).parent().find('.surgery-eye-val').val($(this).val());
});
     var surgerycnt = 1;
$("#surgerybtn").click(function () {
      
  if(surgerycnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgerycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgery"><input class="form-control"  type="hidden"  name="fieldName2" value="surgery"><input class="form-control"  type="text" id="optionsval'+surgerycnt+'" placeholder="value'+surgerycnt+'" name="optionsval[]"></div><span class="input-group-addon surgeryremoveButton" type="button" id="surgeryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#surgeryTextBoxesGroup").append(newTextBoxDiv);
  surgerycnt++;
     });

$(document).on('click', '.surgeryremoveButton', function(e) {
surgerycnt--;
   var target = $("#surgeryTextBoxesGroup").find("#TextBoxDiv" +surgerycnt);
  $(target).remove();
});

// ANTERIOR SEGMENT Add Option//
$("#surgerybtnsave").click(function () {
        var content=$("#surgeryTextBoxesGroup").val();
        if (isEmpty($('#surgeryTextBoxesGroup'))) 
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

 var data = $('#surgeryTextBoxesGroup :input').serialize();
        event.preventDefault();
        $.ajax({
            url:'{{url("dynamic-field/insert")}}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Surgery", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


$(document).on('click', '.addmore-sergery', function(e) {
	e.preventDefault();
	//alert('hi');
	//$('#temp_surgery').html('');
	
	///*
	var surgery_html = $('#surgeryTemplate').html();

	var replace_text = 'surgery_OS_temp['+$.now()+']';

	surgery_html = surgery_html.replaceAll('surgery_OS_temp', replace_text);

	$('#temp_surgery').html(surgery_html);

	//var template = $('#surgeryTemplate').clone();

	var template = $('#temp_surgery').clone();
	
	$('#temp_surgery').html('');
	
	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	
	//*/
           
});
</script>

<div class="dbMultiEntryContainer">
       @foreach ($surgeryDetails as $item)
          <div class="col-md-12">
              <div class="col-md-2">
              </div>
              <div class="col-md-4">
              <input type="text" class="form-control" readonly value="{{$item->text}}">
              </div>
			  <div class="col-md-4">
              <input type="text" class="form-control" readonly value="{{$item->eye_operated}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItemSurgery btn btn-default" data-deleteid="{{$item->id}}" data-type="surgery_history">Remove</button>
              </div>
          </div>
          @endforeach
      </div>

<div style="display:none;">
	<div id="surgeryTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('surgery_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery', $defaultValues)?$defaultValues['surgery']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
				
		<div class="col-md-3 surgery-eye">
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
			<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
		</div> 
		<div class="col-md-2">
			<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
		</div>
        </div>
    </div>
</div>

<div id="temp_surgery"></div>
<!-- ================================================================================= -->