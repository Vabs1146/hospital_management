
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#fix_surgery" aria-expanded="true" aria-controls="fix_surgery">
		Fix Surgery
		</a>
	</h4>
</div>
<div id="fix_surgery" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
	<!-- ======================================================================== -->

	@php
		$fix_srgery_eye_array = $form_details->eyeformmultipleentry()->where('field_name', 'fix_srgery_eye')->get();
		
		$fix_srgery_eye = ($fix_srgery_eye_array && isset($fix_srgery_eye_array[0])) ? $fix_srgery_eye_array[0]->field_value_OD : '';
	@endphp
	
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('fix_srgery_eye','Eye') }} 
			</div>
			
		</div>
		<div class="col-md-3 surgery-eye">
			<input {{($fix_srgery_eye == 'left') ? 'checked' : ''}} class="surgery-eye-radio" type="radio" name="fix_srgery_eye"  value="left" style="opacity: 1; left: auto; position: relative;">Left
			<input {{($fix_srgery_eye == 'right') ? 'checked' : ''}} class="surgery-eye-radio" type="radio" name="fix_srgery_eye" value="right" style="opacity: 1; left: auto; position: relative;">Right
			<input {{($fix_srgery_eye == 'both') ? 'checked' : ''}} class="surgery-eye-radio" type="radio" name="fix_srgery_eye" value="both" style="opacity: 1; left: auto; position: relative;">Both
			
		</div> 

		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">

		</div>
	</div>

<div class="col-md-12">
	<div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('surgery_date_time','Surgery Date and Time ') }} 
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master_data['surgery_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
		</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group labelgrp">
		{{ Form::label('reporting_date_time','Reporting Date and Time ') }} 
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('reporting_date_time', Request::old('reporting_date_time',$case_master_data['reporting_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}            
		</div>
		</div>
	</div>

</div>

<div class="col-md-12 col-md-offset-1">
	<div class="col-md-2 ">
		<div class="form-group labelgrp">
		{{ Form::label('posted_for_doctor','Posted for Doctor: ') }} 
		<input type="hidden" name="posted_for_doctor"  id="posted_for_doctor" value="{{$posted_for_doctor??''}}">
		</div>
	</div>
	<div class="col-md-6 ">

		{{ Form::select('posted_for_doctor',array(''=>'Please select') + $doctorlist->toArray(),$case_master_data['posted_for_doctor'], array('class' => 'form-control select2')) }}

	</div>     
</div>
	
@php
	
	$fields_array = array(
		'planned_surgery' => 'Planned Surgery', 
		'selected_iol' => 'Selected IOL',
		'package' => 'Pacakge'
	);
@endphp

@foreach($fields_array as $fields_array_key => $fields_array_val)
<div id="{{$fields_array_key}}_div" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('section', $fields_array_val) }} 
			</div>
			<input type="hidden" id="{{$fields_array_key}}[]" name="{{$fields_array_key}}[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select($fields_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $fields_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			
		</div> 
		<div class="col-md-4">
			<!-- <button type="button" name="add" id="{{$fields_array_key}}btn" class="btn btn-success  set-dropdown-options" data-field_name="{{$fields_array_val}}" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='{{$fields_array_key}}btnsave'>Save Option</button> -->
			
			<button id="add{{$fields_array_key}}" class="btn btn-default addmore" data-templateDiv="{{$fields_array_key}}Template">Add</button>
		</div>
	</div>
	<div id='{{$fields_array_key}}TextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>
<div style="display:none;">
	<div id="{{$fields_array_key}}Template" >
		<div class="col-md-12">
			<div class="col-md-2">
				<input type="hidden" id="{{$fields_array_key}}[]" name="{{$fields_array_key}}[]" class="hiddenCounter" value="1" />  
			</div>
			<div class="col-md-3">
				{{ Form::select($fields_array_key.'_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', $fields_array_key)->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
			</div>
			<div class="col-md-3">
				
			</div>
			<div class="col-md-2">
				<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
			</div>
		</div>
	</div>
</div>
<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', $fields_array_key)->get() as $item)
        
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

<script>
var {{$fields_array_key}}cnt = 1;
$("#{{$fields_array_key}}btn").click(function () {

if({{$fields_array_key}}cnt>10){
swal("Only 10 Options Values are allow!");
return false;
}

var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+{{$fields_array_key}}cnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="{{$fields_array_key}}"><input class="form-control"  type="hidden"  name="fieldName2" value="{{$fields_array_key}}"><input class="form-control"  type="text" id="optionsval'+{{$fields_array_key}}cnt+'" placeholder="value'+{{$fields_array_key}}cnt+'" name="optionsval[]"></div><span class="input-group-addon {{$fields_array_key}}removeButton" type="button" id="{{$fields_array_key}}removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#{{$fields_array_key}}TextBoxesGroup").append(newTextBoxDiv);
{{$fields_array_key}}cnt++;
});

$(document).on('click', '.{{$fields_array_key}}removeButton', function(e) {
{{$fields_array_key}}cnt--;
var target = $("#{{$fields_array_key}}TextBoxesGroup").find("#TextBoxDiv" +{{$fields_array_key}}cnt);
$(target).remove();
});
</script>


<script>
// Diagnosis Add Option//
$("#{{$fields_array_key}}btnsave").click(function () {
        var content=$("#{{$fields_array_key}}TextBoxesGroup").val();
        if (isEmpty($('#{{$fields_array_key}}TextBoxesGroup'))) 

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
 var data=$("#{{$fields_array_key}}TextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For {{$fields_array_val}}", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }
});
</script>
@endforeach




<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('surgery_advance_amount','Advance Amount')  }} 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('surgery_advance_amount', Request::old('surgery_advance_amount', $form_details->advance_amount), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('advance_date','Advance Date')  }} 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('advance_date', Request::old('advance_date', $form_details->advance_date), array('class'=> 'form-control datepicker', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div>  

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('advance_amount','Payment Mode')  }} 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				<select class="form-control select2" name="advance_payment_type" id="advance_payment_type" required>
				<option value="0">Select Payment Mode</option>
				@foreach ($payment_modes as $payment_modes_row)
				<?php $selected = ( $form_details->advance_payment_type == $payment_modes_row->id) ? "selected": ""; ?>
				<option value="{{ $payment_modes_row->id }}" {{ $selected }}
				>
				{{ $payment_modes_row->name }}
				</option>
				@endforeach
			</select> 
			</div>
		</div>
	</div>     
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('advance_payment_reference','Reference Code')  }} 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('advance_payment_reference', Request::old('advance_payment_reference', $form_details->advance_payment_reference), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div>  

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('balance_amount','Balance Amount')  }} 
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('balance_amount', Request::old('balance_amount', $form_details->balance_amount), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div>  


<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('surgery_comment','Comment')  }} 
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="form-line">
				@php
					$surgery_comment = $form_details->eyeformmultipleentry()->where('field_name', 'surgery_comment')->first();

					$other_details_comment_val = $surgery_comment->field_value_OD??'';
				@endphp
				{{ Form::text('surgery_comment', Request::old('surgery_comment', $other_details_comment_val), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div> 
	<!-- ======================================================================== -->
	</div>

</div>
