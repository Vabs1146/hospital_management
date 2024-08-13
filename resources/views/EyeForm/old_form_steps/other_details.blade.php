<style>
.blood_select_all {
	position: relative !important;
    left: auto !important;
    opacity: 1 !important;
    margin-left: 47px !important;
    margin-right: 8px !important;
}
</style>
<div class="panel-heading" role="tab" id="headingOne_1">
	<h4 class="panel-title">
		<a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#Other_details" aria-expanded="true" aria-controls="Other_details">
		Other Details
		</a>
	</h4>
</div>
<div id="Other_details" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
	<div class="panel-body">
		

		<!-- =============== ===== ========SSSSSSSSTTTTTTAAAAAARRRRRRRRRTTTTTT=========================================== -->
		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					{{ Form::label('otherDetailsDiagnosis','Diagnosis') }} 
				</div>
				<input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="1" />  
			</div>

			@php	
			$otherDetailsDiagnosis_OD = "";
					$otherDetailsDiagnosis_OS = "";

				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get() as $item) {
					$otherDetailsDiagnosis_OD = $item->field_value_OD;
					$otherDetailsDiagnosis_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-5">
				{{ Form::text('otherDetailsDiagnosis_OD[]', Request::old('otherDetailsDiagnosis_OD', $otherDetailsDiagnosis_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
			<div class="col-md-5">
				{{ Form::text('otherDetailsDiagnosis_OS[]', Request::old('otherDetailsDiagnosis_OS', $otherDetailsDiagnosis_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					{{ Form::label('otherDetailsAnteriorSegment','Anterior Segment') }} 
				</div>
				<input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="1" />  
			</div>

			@php		
			$otherDetailsAnteriorSegment_OD = "";
					$otherDetailsAnteriorSegment_OS = "";
				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get() as $item) {
					$otherDetailsAnteriorSegment_OD = $item->field_value_OD;
					$otherDetailsAnteriorSegment_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-5">
				{{ Form::text('otherDetailsAnteriorSegment_OD[]', Request::old('otherDetailsAnteriorSegment_OD', $otherDetailsAnteriorSegment_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
			<div class="col-md-5">
				{{ Form::text('otherDetailsAnteriorSegment_OS[]', Request::old('otherDetailsAnteriorSegment_OS', $otherDetailsAnteriorSegment_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					{{ Form::label('otherDetailsPosteriorSegment','Posterior Segment') }}
				</div>
				<input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="1" />  
			</div>

			@php			
					$otherDetailsPosteriorSegment_OD = "";
					$otherDetailsPosteriorSegment_OS = "";
				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get() as $item) {
					$otherDetailsPosteriorSegment_OD = $item->field_value_OD;
					$otherDetailsPosteriorSegment_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-5">
				{{ Form::text('otherDetailsPosteriorSegment_OD[]', Request::old('otherDetailsPosteriorSegment_OD', $otherDetailsPosteriorSegment_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
			<div class="col-md-5">
				{{ Form::text('otherDetailsPosteriorSegment_OS[]', Request::old('otherDetailsPosteriorSegment_OS', $otherDetailsPosteriorSegment_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					{{ Form::label('otherDetailsAdditionalInformation','Additional Information') }} 
				</div>
				<input type="hidden" id="otherDetailsAdditionalInformationCount[]" name="otherDetailsAdditionalInformationCount[]" class="hiddenCounter" value="1" />  
			</div>

			@php			
					$otherDetailsAdditionalInformation = "";
					//$otherDetailsPosteriorSegment_OS = "";
				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdditionalInformation')->get() as $item) {
					$otherDetailsAdditionalInformation = $item->field_value_OD;
					//$otherDetailsPosteriorSegment_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-10">
				{{ Form::text('otherDetailsAdditionalInformation[]', Request::old('otherDetailsAdditionalInformation', $otherDetailsAdditionalInformation), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
		</div>

		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					<label>Plan Of Management</label>
				</div>
				<input type="hidden" id="planOfManagement[]" name="planOfManagement[]" class="hiddenCounter" value="1" />  
			</div>

			@php		
					$planOfManagement_OD = "";	
				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'planOfManagement')->get() as $item) {
					$planOfManagement_OD = $item->field_value_OD;
					//$otherDetailsPosteriorSegment_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-10">
				{{ Form::text('planOfManagement_OD[]', Request::old('planOfManagement_OD', $planOfManagement_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
		</div>

		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					{{ Form::label('otherDetailsAdvice','Advice') }} 
				</div>
				<input type="hidden" id="otherDetailsAdviceCount[]" name="otherDetailsAdviceCount[]" class="hiddenCounter" value="1" />  
			</div>

			@php		
			$otherDetailsAdvice_OD = "";
					$otherDetailsAdvice_OS = "";

				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdvice')->get() as $item) {
					$otherDetailsAdvice_OD = $item->field_value_OD;
					$otherDetailsAdvice_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-5">
				{{ Form::text('otherDetailsAdvice_OD[]', Request::old('otherDetailsAdvice_OD', $otherDetailsAdvice_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
			<div class="col-md-5">
				{{ Form::text('otherDetailsAdvice_OS[]', Request::old('otherDetailsAdvice_OS', $otherDetailsAdvice_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2 ">
				<div class="form-group labelgrp">
					{{ Form::label('surgery','Surgery/Procedure') }}
				</div>
				<input type="hidden" id="surgeryCount[]" name="surgeryCount[]" class="hiddenCounter" value="1" />  
			</div>

			@php		
			
			$surgery_OD = "";
					$surgery_OS = "";
				foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get() as $item) {
					$surgery_OD = $item->field_value_OD;
					$surgery_OS = $item->field_value_OS;
				}
			@endphp

			<div class="col-md-5">
				{{ Form::text('surgery_OD[]', Request::old('surgery_OD', $surgery_OD), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div> 
			<div class="col-md-5">
				{{ Form::text('surgery_OS[]', Request::old('surgery_OS', $surgery_OS), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>


<!-- ====================================== -->
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
<!-- =================================== -->

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

		<!-- =============== ===== ========ENDNENDNDN=========================================== -->
	</div>

</div>

<script type="text/javascript">

    $("#showBloodDiv").click(function () {
        $("#blood_investigation").toggle();
    })
var bloodcnt = 1;
$("#addBloodtitlebtn").click(function () {
      
  if(bloodcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+bloodcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="text" id="optionsval'+bloodcnt+'" placeholder="value'+bloodcnt+'" name="optionsval[]"></div><span class="input-group-addon treatmentAdviceremoveButton" type="button" id="treatmentAdviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

    $("#bloodTestGroup").append(newTextBoxDiv);
        bloodcnt++;
     });

        $(document).on('click','.set-dropdown-options_blood_investigation',function() {
           // var form_name = $(this).data('form_name');
           // var field_name = $(this).data('field_name');
            
            var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

            $.ajax({
                url:"{{route('get_update_dropdown_options_blood_investigation')}}",
                method:'post',
                datatype: 'json',
                success:function(response) {
                    console.log(response);                 
                    $("#bloodTestGroupEdit").html(response);
                }
            });

           
            //$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

            $("#bloodTestGroupEdit").show();
        });
    $(document).on('click','.cancel-dropdown-options-btn',function() {
        $('#bloodTestGroupEdit').hide();
        $('#bloodTestGroupEdit').html('');
    });

        $(document).on('click','.update-dropdown-options-btn_blood_ign',function() {
            //alert('clicked');

           // var clicked_element = $(this);

           // var form_target = $(this).closest('.update-dropdown-options-form');

            //var id = form_target.attr('id');

            var form_data = $('#update-dropdown-options-form-blood-ivn :input').serialize();

            $.ajax({
                url:"{{route('update_dropdown_options_blood_ivn')}}",
                method:'post',
                data:{'form_data': form_data},
                datatype: 'json',
                success:function(response) {
                    console.log(response);

                    location.reload();
                    /*
                    swal({title: "Options", text: "Update Successfully!", type: "success"},
                     function(){ 
                      location.reload();
                      }
                    );
                    */
                    //clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
                }
            });
        });

        $(document).on('click','.remove-initial-options-BI',function() {
           var closest =  $(this).closest('.initial_options');
            //alert("input value :;"+$(this).closest('.initial_options').prev().val());
            var idToDelete = $(this).closest('.initial_options').prev().val()

            var r = confirm("Do you really want to delete record ?");
            if (r == true) {
                 $.ajax({
                    url:"{{route('delete_bloodinvestigatinTitles')}}",
                    method:'post',
                    data:{ 'idToDelete':idToDelete },
                    datatype: 'json',
                    success:function(response) {
                        //console.log(response);                 
                        //$("#bloodSubcategoryTestGroupEdit").html(response);
                         closest.remove();

                    }
                }); 
            } 
        });
        $(document).on('click','.remove-initial-options-parent',function() {
           var closest =  $(this).closest('.initial_options');
            //alert("input value :;"+$(this).closest('.initial_options').prev().val());
            var idToDelete = $(this).closest('.initial_options').prev().val();
            var parenttitle='';

            var temp = confirm("Do you really want to delete record ?");
            if (temp == true) {
                 $.ajax({
                    url:"{{route('delete_bloodinvestigatinTitles')}}",
                    method:'post',
                    data:{ 'idToDelete':idToDelete,'parent': 'parenttitle' },
                    datatype: 'json',
                    success:function(response) {
                        //console.log(response);                 
                        //$("#bloodSubcategoryTestGroupEdit").html(response);
                         closest.remove();

                    }
                }); 
            } 
        });        
/***************************** sub title ******************************************************/

        $(document).on('click','#addsubcategoriesbtn',function() {
           // var form_name = $(this).data('form_name');
           // var field_name = $(this).data('field_name');
            var selectedID = $("#blood_titles option:selected").attr("data-id");
            //alert("selectedID" +selectedID);
           // var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

            $.ajax({
                url:"{{route('get_update_dropdown_options_blood_investigation')}}",
                method:'post',
                data:{ 'subtitle':'subtitle','selectedID':selectedID },
                datatype: 'json',
                success:function(response) {
                    console.log(response);                 
                    $("#bloodSubcategoryTestGroupEdit").html(response);
                }
            });

           
            //$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

            $("#bloodSubcategoryTestGroupEdit").show();
        });
        $(document).on('click','.update-dropdown-options-btn_blood_ign_subtitle',function() {
           

            var form_data = $('#update-dropdown-options-form-blood-ivn-subtitle :input').serialize();

            $.ajax({
                url:"{{route('update_dropdown_options_blood_ivn_subtitle')}}",
                method:'post',
                data:{'form_data': form_data},
                datatype: 'json',
                success:function(response) {
                    console.log(response);

                    location.reload();
                    /*
                    swal({title: "Options", text: "Update Successfully!", type: "success"},
                     function(){ 
                      location.reload();
                      }
                    );
                    */
                   // clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
                }
            });
        });

    $(document).on('click','.cancel-dropdown-options-btn-subtitle',function() {
        $('#bloodSubcategoryTestGroupEdit').hide();
        $('#bloodSubcategoryTestGroupEdit').html('');
    });
//=======================================================================================//
$('.blood_select_all').on("change", function(e) {
	//alert('hi');
	var parent = $(this).closest('.blood-category');
	
	if($(this).is(':checked')) {
	
		parent.find('.bloodtests').each(function() {
	
			if($(this).is(':checked')) {
				
	
			} else {
				
	
				$(this).trigger('click');
			}
		});
	} else {
		
	
		parent.find('.bloodtests').each(function() {
			
	
			if($(this).is(':checked')) {
				
	
				$(this).trigger('click');
			} else {
				
	
			}
		});
	}
});

$('.bloodtests').on('change', function() {
	//alert(this.value);

	var test_type = $(this).data('type');
	var test = $(this).val();
	var is_checked = $(this).is(':checked') ? 1 : 0;

	console.log(test +' : '+ is_checked);

	var caseid=$("#caseid").val();
    var case_number=$("#case_number").val();

	var url="{{ url('manage-bloodinvestigation') }}";

	$.ajax({
		url:url,
		method:'post',
		data:{form_type: 'eyeform', test_type:test_type, test:test, is_checked:is_checked, caseid:caseid,case_number:case_number},
		success:function(data)
		{
		/*
		swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
		 function(){ 
		  location.reload();
		  }
		);
		*/
		}
	});
});
</script>
