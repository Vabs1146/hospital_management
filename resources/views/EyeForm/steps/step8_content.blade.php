<style>
.blood_select_all {
	position: relative !important;
    left: auto !important;
    opacity: 1 !important;
    margin-left: 47px !important;
    margin-right: 8px !important;
}
</style>


<div id="otherDetailsDiagnosis" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsDiagnosis','Diagnosis') }} 
			</div>
			<input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsDiagnosisbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsDiagnosis" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsDiagnosisbtnsave'>Save Option</button>
			<button id="addotherDetailsDiagnosis" class="btn btn-default addmore" data-templateDiv="otherDetailsDiagnosisTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsDiagnosisTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get() as $item)
        
	<div class="col-md-12">
		<div class="col-md-2"> </div>

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
</div>

<script>
// Diagnosis Add Option//
$("#otherDetailsDiagnosisbtnsave").click(function () {
        var content=$("#otherDetailsDiagnosisTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsDiagnosisTextBoxesGroup'))) 

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
 var data=$("#otherDetailsDiagnosisTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
            //url:'{{ route("segmentinsert-field.insert") }}',
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Diagnosis", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>

<!-- ================================================================================= -->

@php 
		$treatment_given_od = "";
		$treatment_given_os = "";
	@endphp
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'other_details_treatment_given')->get() as $item)
	@php 
		$treatment_given_od = $item->field_value_OD;
		$treatment_given_os = $item->field_value_OS;
	@endphp
@endforeach

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('treatment_given','Treatment Given')  }} 
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('treatment_given_od', Request::old('treatment_given_od', $treatment_given_od), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div> 
	
	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('treatment_given_os', Request::old('treatment_given_os', $treatment_given_os), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div> 

	<div class="col-md-4">

	</div>
</div>  


<!-- ================================================================================= -->

<div id="otherDetailsAnteriorSegment" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsAnteriorSegment','Anterior Segment') }} 
			</div>
			<input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-3">
			{{ Form::select('otherDetailsAnteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsAnteriorSegmentbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsAnteriorSegment" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsAnteriorSegmentbtnsave'>Save Option</button>
			<button id="addotherDetailsAnteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsAnteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsAnteriorSegmentTextBoxesGroup' class="col-md-12">

	</div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

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
</div>
<!-- ================================================================================= -->
<!-- ================================================================================= -->

<div id="treatmentAdvice" class="ContainerToAppend dropdown-container">
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsPosteriorSegment','Posterior Segment') }}
			</div>
			<input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="1" />  
		</div>
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
			{{ Form::select('otherDetailsPosteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsPosteriorSegmentbtn' class="btn btn-success  set-dropdown-options"  data-field_name="otherDetailsPosteriorSegment" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsPosteriorSegmentbtnsave'>Save Option</button>
			<button id="addotherDetailsPosteriorSegment" class="btn btn-default addmore" data-templateDiv="otherDetailsPosteriorSegmentTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsPosteriorSegmentTextBoxesGroup' class="col-md-12"> </div>

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

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
</div>

<!-- ================================================================================= -->
<!-- ================================================================================= -->

<div id="otherDetailsAdditionalInformation" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsAdditionalInformation','Additional Information') }} 
			</div>
			<input type="hidden" id="otherDetailsAdditionalInformationCount[]" name="otherDetailsAdditionalInformationCount[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-6">
			{{ Form::select('otherDetailsAdditionalInformation[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdditionalInformation')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsAdditionalInformationbtn' class="btn btn-success set-dropdown-options"  data-field_name="otherDetailsAdditionalInformation" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsAdditionalInformationbtnsave'>Save Option</button>
			<button id="addotherDetailsAdditionalInformation" class="btn btn-default addmore" data-templateDiv="otherDetailsAdditionalInformationTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsAdditionalInformationTextBoxesGroup' class="col-md-12"> </div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdditionalInformation')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

		<div class="col-md-6">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
		</div>
		
		<!-- <div class="col-md-3">
			<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
		</div> -->

		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>
<!-- ================================================================================= -->


@include('EyeForm.steps.other_details.plan_of_management')
<!-- ================================================================================= -->

<div id="otherDetailsAdvice" class="ContainerToAppend dropdown-container">
	<div class="col-md-12 ">
		<div class="col-md-2 ">
			<div class="form-group labelgrp">
				{{ Form::label('otherDetailsAdvice','Advice') }} 
			</div>
			<input type="hidden" id="otherDetailsAdviceCount[]" name="otherDetailsAdviceCount[]" class="hiddenCounter" value="1" />  
		</div>

		<div class="col-md-3">
			{{ Form::select('otherDetailsAdvice_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdvice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 

		<div class="col-md-3">
			{{ Form::select('otherDetailsAdvice_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdvice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-4">
			<button type="button" name="add" id='otherDetailsAdvicebtn' class="btn btn-success set-dropdown-options"  data-field_name="otherDetailsAdvice" data-form_name="EyeForm" >Set Option </button>
			<button type='button' class="btn btn-primary" id='otherDetailsAdvicebtnsave'>Save Option</button>
			<button id="addotherDetailsAdvice" class="btn btn-default addmore" data-templateDiv="otherDetailsAdviceTemplate">Add</button>
		</div>
	</div>
	<div id='otherDetailsAdviceTextBoxesGroup' class="col-md-12"> </div> 

	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> 	</div>
</div>

<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdvice')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>

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
</div>
<!-- ================================================================================= -->
<!-- ================================================================================= -->

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

<script>

$(document).on('click', '.surgery-eye-radio', function() {
	//alert($(this).val());
	$(this).parent().find('.surgery-eye-val').val($(this).val());
});
$(document).on('click', '.addmore-sergery', function(e) {
	e.preventDefault();
	//alert('hi');
	var surgery_html = $('#surgeryTemplate').html();

	var replace_text = 'surgery_OS_temp['+$.now()+']';

	surgery_html = surgery_html.replaceAll('surgery_OS_temp', replace_text);

	$('#temp_surgery').html(surgery_html);

	//var template = $('#surgeryTemplate').clone();

	var template = $('#temp_surgery').clone();

	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	$('#temp_surgery').html('');
           
});
</script>
<!-- <div id="temp_surgery" style="display:none;"></div> -->
<div id="temp_surgery"></div>
<!-- ================================================================================= -->
<!-- ================================================================================= -->

<!-- <div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Advice  </label>
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="form-line">
				{{ Form::textarea('Advice_OD', Request::old('Advice_OD',$form_details->Advice_OD), array('class'=> 'form-control advicetxtarea')) }} 
			</div>
		</div>
	</div>     
</div> -->

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Blood Investigation</label>   
		</div>
	</div>
	<div class="col-md-10">
		<div class="row" style="margin-bottom: 30px;"> <button type="button" id="showBloodDiv" class="btn btn-default">Add Titles</button></div>
		<div id="blood_investigation" class="row" style="display: none">

			<div id="blood_title" class="ContainerToAppend dropdown-container">
				<div class="col-md-12">
					<div class="col-md-1 ">
						<div class="form-group labelgrp">
							{{ Form::label('blood_title','Title') }} 
						</div>
					</div>

					<div class="col-md-6">
						<select class="form-control select2" data-live-search='true' name="blood_title" id="blood_titles">
							<option value="">-- select title --</option>
							<?php //echo "<pre> ====";print_r($blood_categories->toArray());exit; ?>
							@foreach ($blood_categories->toArray() as $category)
							<option value="{{ $category['id'] }}_{{ $category['blood_title'] }}" data-id="{{ $category['id'] }}">{{ $category['blood_title'] }}</option>
							@endforeach                                                        
						</select>

					</div> 
					<div class="col-md-4">
						<button type="button" name="add" id='addBloodtitlebtn' class="btn btn-success  set-dropdown-options_blood_investigation">Set Option </button>
						<button type='button' class="btn btn-primary" id='bloodTitlebtnsave'>Save Option</button>
					</div>                                                                                        
				</div>
			</div>
			<div id='bloodTestGroup' class="col-md-12"> </div>
			<div id='bloodTestGroupEdit' class="col-md-12"> </div>

			<div class="col-md-12">
				<button type="button" id="addsubcategoriesbtn" style="display:none" class="btn btn-success">Add Subcategories</button>
				<button type='button' class="btn btn-primary" id='subCategorysave' style="display:none">Save Category</button>
			</div>

			<div id='bloodSubcategoryTestGroup' class="col-md-12"> </div> 
			<div id='bloodSubcategoryTestGroupEdit' class="col-md-12"> </div>                                            
		</div>                                           
		<div class="demo-checkbox">
			<!--  <input type="checkbox" name="chk1" id="uveiitis_chk" class="filled-in chk-col-pink" <?php if($form_details->uveiitis_chk=="1"){echo "checked";}else{echo "unchecked";}?> /> -->

			<?php 
			$i = 0;
			if(!empty($categories)) {
			foreach ($categories as $key => $value) { ?>
			<div style="width:30%;float: left;padding:5px"><label for="uveiitis_chk"><b>{{ $key }}</b></label>
			<ul class="list-group1 blood-category">    
					<li><input type="checkbox" class="blood_select_all">Select All</li>
					<?php foreach($value as $uveiitis_bloodtests_row) { ?>
					<li class="list-group-item1" style="">
						<input type="checkbox" name="chk1[]" id="uveiitis_bloodtests_row_{{$i}}" data-type="{{$key}}" class="bloodtests filled-in chk-col-pink" <?php if(in_array( $key.'_'.$uveiitis_bloodtests_row, $form_details->uveiitis_bloodtests_data)){ echo "checked"; }else{echo "unchecked";}?> value="{{$uveiitis_bloodtests_row}}" />
						<label for="uveiitis_bloodtests_row_{{$i}}">{{$uveiitis_bloodtests_row}}</label>
					</li>
					<?php $i++; } ?>
				</ul></div> <?php  } }  ?>
		</div>
	</div>
</div>




<!-- <div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('localExamReport','Additional Information') }} 
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('localExamReport', Request::old('localExamReport',$form_details->localExamReport), array('class' => 'form-control')) }}
			</div>
		</div>
	</div>     
</div>   -->

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('other_details_comment','Comment')  }} 
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="form-line">
				@php
					$other_details_comment = $form_details->eyeformmultipleentry()->where('field_name', 'other_details_comment')->first();

					$other_details_comment_val = $other_details_comment->field_value_OD??'';
				@endphp
				{{ Form::text('other_details_comment', Request::old('other_details_comment', $other_details_comment_val), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div> 

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('advance_amount','Advance Amount')  }} 
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('advance_amount', Request::old('advance_amount', $form_details->advance_amount), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div>                                    
<div class="col-md-1">
	<div class="form-group labelgrp">
		<label>Email To</label>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<div class="form-line">
			{{ Form::text('Email_To', null, array('class'=> 'form-control', 'autocomplete'=>'off')) }}
		</div>
	</div>
</div> 
<div class="col-md-1">
	<button type="submit" formaction="{{ url('/patientDetails/SendEmailSave') }}" name="Send_email" class="btn form-inline" value="Send_email">
		<i class="fa fa-plus"></i> Send Mail
	</button>
</div>
<div class="col-md-12 custom-item-parent-div">
	<div class="row custom-item">
		<div class="col-md-4">
			<select class="custom-item-dropdown form-control select2">
				<option value="">Select Option</option>

				<option value="otherDetailsDiagnosis" data-title="Diagnosis"  data-od="otherDetailsDiagnosis_OD[]" data-os="otherDetailsDiagnosis_OS[]">Diagnosis</option>
				<option value="otherDetailsAnteriorSegment" data-title="ANTERIOR SEGMENT" data-od="otherDetailsPosteriorSegment_OD[]" data-os="otherDetailsPosteriorSegment_OS[]">ANTERIOR SEGMENT</option>

				<option value="otherDetailsPosteriorSegment" data-title="POSTERIOR SEGMENT" data-od="otherDetailsPosteriorSegment_OD[]" data-os="otherDetailsPosteriorSegment_OS[]">POSTERIOR SEGMENT</option>

				<option value="otherDetailsAdditionalInformation" data-title="Additional Information"  data-od="1">Additional Information</option>

				<option value="planOfManagement" data-title="Plan Of Management" data-od="planOfManagement_OD[]">Plan Of Management</option>

				<option value="otherDetailsAdvice" data-title="Advice"  data-od="otherDetailsAdvice_OD[]" data-os="otherDetailsAdvice_OS[]">Advice</option>

				<option value="surgery" data-title="Surgery/Procedure"  data-od="surgery_OD[]" data-os="surgery_OS">Surgery/Procedure</option>
			</select>
		</div>
		<div class="col-md-3"> </div>
		<div class="col-md-3"> </div>
		<div class="col-md-2">
			<span class="add-custom-item btn btn-default">Add</span>
		</div>
	</div>
	<div class="custom-item-container"> </div>
</div>                                    
<div class="col-md-12">
	<div class="col-md-12 col-md-offset-4">
		<div class="form-group">
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit</button>
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">Submit & View
			</button>
			<button type="submit" formaction="{{ url('/patientDetails/SendEmailSave') }}" name="SubmitMail" class="btn btn-primary btn-lg" value="SubmitMail">Submit & Mail</button>
			<a type="submit" href="{{ url('/PrintEyeOtherDetails') }}/{{$casedata['id']}}"  class="btn btn-primary btn-lg" target="_blank">Print</a>
		</div>
	</div>
</div> 


<div style="display:none">
	<div id="otherDetailsDiagnosisTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	<div id="otherDetailsAnteriorSegmentTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsAnteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsAnteriorSegment', $defaultValues)?$defaultValues['otherDetailsAnteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('otherDetailsAnteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsAnteriorSegment', $defaultValues)?$defaultValues['otherDetailsAnteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>

	<div id="otherDetailsPosteriorSegmentTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsPosteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsPosteriorSegment', $defaultValues)?$defaultValues['otherDetailsPosteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('otherDetailsPosteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsPosteriorSegment', $defaultValues)?$defaultValues['otherDetailsPosteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>

	<div id="otherDetailsAdditionalInformationTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsAdditionalInformationCount[]" name="otherDetailsAdditionalInformationCount[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                     {{ Form::select('otherDetailsAdditionalInformation[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdditionalInformation')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsAdditionalInformation', $defaultValues)?$defaultValues['otherDetailsAdditionalInformation']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>

	<div id="otherDetailsAdviceTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsAdviceCount[]" name="otherDetailsAdviceCount[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
					 {{ Form::select('otherDetailsAdvice_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdvice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
				  {{ Form::select('otherDetailsAdvice_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdvice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>

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




<script type="text/javascript">
     var otherDetailsAdditionalInformationcnt = 1;
$("#otherDetailsAdditionalInformationbtn").click(function () {
      
  if(otherDetailsAdditionalInformationcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsAdditionalInformationcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsAdditionalInformation"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsAdditionalInformation"><input class="form-control"  type="text" id="optionsval'+otherDetailsAdditionalInformationcnt+'" placeholder="value'+otherDetailsAdditionalInformationcnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsAdditionalInformationremoveButton" type="button" id="otherDetailsAdditionalInformationremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsAdditionalInformationTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsAdditionalInformationcnt++;
     });

$(document).on('click', '.otherDetailsAdditionalInformationremoveButton', function(e) {
otherDetailsAdditionalInformationcnt--;
   var target = $("#otherDetailsAdditionalInformationTextBoxesGroup").find("#TextBoxDiv" +otherDetailsAdditionalInformationcnt);
  $(target).remove();
});

// ANTERIOR SEGMENT Add Option//
$("#otherDetailsAdditionalInformationbtnsave").click(function () {
        var content=$("#otherDetailsAdditionalInformationTextBoxesGroup").val();
        if (isEmpty($('#otherDetailsAdditionalInformationTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Additional Details", text: "Added Successfully!", type: "success"},
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
     var otherDetailsAdvicecnt = 1;
$("#otherDetailsAdvicebtn").click(function () {
      
  if(otherDetailsAdvicecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherDetailsAdvicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="otherDetailsAdvice"><input class="form-control"  type="hidden"  name="fieldName2" value="otherDetailsAdvice"><input class="form-control"  type="text" id="optionsval'+otherDetailsAdvicecnt+'" placeholder="value'+otherDetailsAdvicecnt+'" name="optionsval[]"></div><span class="input-group-addon otherDetailsAdviceremoveButton" type="button" id="otherDetailsAdviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#otherDetailsAdviceTextBoxesGroup").append(newTextBoxDiv);
  otherDetailsAdvicecnt++;
});

$(document).on('click', '.otherDetailsAdviceremoveButton', function(e) {
otherDetailsAdvicecnt--;
   var target = $("#otherDetailsAdviceTextBoxesGroup").find("#TextBoxDiv" +otherDetailsAdvicecnt);
  $(target).remove();
});

// Advice Add Option//
$("#otherDetailsAdvicebtnsave").click(function () {
	var content=$("#otherDetailsAdviceTextBoxesGroup").val();
	if (isEmpty($('#otherDetailsAdviceTextBoxesGroup'))) {
		swal({
			title: "Please Add Some Option by clicking on",
			text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
			html: true
		});
	} else {
		var data=$("#eyeform").serialize();
		event.preventDefault();
		$.ajax({
			url:'{{ route("dynamic-field.insert") }}',
			method:'post',
			data:data,
			success:function(data) {
				swal({title: "Option For Advice", text: "Added Successfully!", type: "success"},
					function() { 
						location.reload();
					}
				);
			}
		})
	}

});

</script>


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
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
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

</script>