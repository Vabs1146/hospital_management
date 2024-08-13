@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
<div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/eyeOperationRecord').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/eyeOperationRecord').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
</div>

</div>
<div class="container-fluid">
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif


       

<div class="card">
<div class="header bg-pink">
<h2> Operation Record </h2>
</div>
     
<div class="body">
<div class="row clearfix ">

 <form action="{{ url('/eyeOperationRecord'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' id="eyeOperationRecord" >
  {{ csrf_field() }}

 @if (isset($case_master))
   <input type="hidden" name="_method" value="PATCH">
@endif

<input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >

                          <div class="col-md-12">
                            <div class="col-md-4">
                              <div class="col-md-3">
                              <div class="form-group labelgrp">
                              <label for="case_number" class="control-label">Case Number</label>
                              </div>
                              </div>

                              <div class="col-md-9">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">                          
                              </div>
                              </div>
                              </div>   
                            </div>
                            <div class="col-md-4">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('IPD_no','IPD no.') }} 
                              </div>
                              </div>


                              <div class="col-md-10">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('IPD_no', Request::old('IPD_no',$case_master['IPD_no']), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>                              
                            </div>

                            <div class="col-md-4">

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('uhid','UHID No:') }} 
                              </div>
                              </div>


                              <div class="col-md-10">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('uhid', Request::old('uhid',$case_master['uhid_no']), array('class' => 'form-control ', 'autocomplete'=>'off')) }}                      
                              </div>
                              </div>
                              </div>                              
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="patient_name" class="control-label">Name Of Patient</label>
                              </div>
                              </div>


                              <div class="col-md-10">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_name" id="patient_name" class="form-control" readonly='readonly' value="{{ $case_master['mr_mrs_ms'] .' '. $case_master['patient_name'] .' '.$case_master['middle_name'] .' '. $case_master['last_name']}}">                          
                              </div>
                              </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                  <div class="col-md-2">
                                  <div class="form-group labelgrp">
                                      <label for="patient_name" class="control-label">Age</label>
                                  </div>
                                  </div>

                                  <div class="col-md-10">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <input type="text" name="patient_name" id="patient_name" class="form-control" readonly='readonly' value="{{ $case_master['patient_age'] or ''}}">                          
                                          </div>
                                      </div>
                                  </div>
                                </div> 
                                <div class="col-md-6">
                                  <div class="col-md-3">
                                  <div class="form-group labelgrp">
                                      <label for="patient_name" class="control-label">Gender</label>
                                  </div>
                                  </div>

                                  <div class="col-md-9">
                                      <div class="form-group">
                                          <div class="form-line">
                                              <input type="text" name="patient_name" id="patient_name" class="form-control" readonly='readonly' value="{{ $case_master['male_female'] or ''}}">                          
                                          </div>
                                      </div>
                                  </div>
                                </div>                                                              
                            </div>
                          </div>
                          <div classs="col-md-12">
                              <span class="dropdown-container">
                              <div id="surgery_history" class="ContainerToAppend">
                                <div class="col-md-12">
                                    <div class="col-md-2">
                                      <div class="form-group labelgrp">
                                        <label class="">Surgery/Procedure</label> 
                                      </div>
                                      <input type="hidden" id="surgeryHistory[]" name="surgeryHistory[]" class="hiddenCounter" value="1" />  
                                    </div>

                                    <div class="col-md-3">
                                      {{ Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery_history', $defaultValues)?$defaultValues['surgery_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                    </div>

									<div class="col-md-3 surgery-eye">
										<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp"  value="left" style="opacity: 1; left: auto; position: relative;">Left
										<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="right" style="opacity: 1; left: auto; position: relative;">Right
										<input class="surgery-eye-radio" type="radio" name="surgery_OS_temp" value="both" style="opacity: 1; left: auto; position: relative;">Both
										<input type="hidden" class="surgery-eye-val" name="surgery_OS[]">
									</div> 

                                    <div class="col-md-4">
                                      <button type="button" name="add" id='surgerysetbtn' class="btn btn-success set-dropdown-options" data-field_name="Systemic History OD" data-form_name="commanForm">Set Option </button>

                                      <button type='button' class="btn btn-primary" id='surgerybtnsave'>Save Option</button>

                                      <button id="addSystemicHistory" class="btn btn-default addmore-sergery" data-templateDiv="surgerytemplate">Add</button>
                                    </div>
                                </div>
                              </div>
                              <div id='surgeryTextBoxesGroup' class="col-md-12">

                              </div>
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
                              </span> 
                              <div id="templateContainner" style="display:none">
                                <div id="surgerytemplate">
                                    <div class="col-md-12">
                                            <div class="col-md-2">
                                                <input type="hidden" id="surgeryHistory[]" name="surgeryHistory[]" class="hiddenCounter" value="" />
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery_history', $defaultValues)?$defaultValues['surgery_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
                                
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
                            </div>


<script>

$(document).on('click', '.surgery-eye-radio', function() {
	//alert($(this).val());
	$(this).parent().find('.surgery-eye-val').val($(this).val());
});
$(document).on('click', '.addmore-sergery', function(e) {
	e.preventDefault();

	var surgery_html = $('#surgerytemplate').html();

	//console.log(surgery_html);

	var replace_text = 'surgery_OS_temp['+$.now()+']';

	surgery_html = surgery_html.replaceAll('surgery_OS_temp', replace_text);

	$('#temp_surgery').html(surgery_html);

	var template = $('#temp_surgery').clone();

	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	$('#temp_surgery').html('');
           
});
</script>
<!-- <div id="temp_surgery" style="display:none;"></div> -->
<div id="temp_surgery"></div>


                            <script>

                          $(document).ready(function(){
                            var surgerycnt = 1;
                            $("#surgerysetbtn").click(function () {

                            if(surgerycnt>10){
                            swal("Only 10 Options Values are allow!");
                            return false;
                            }

                            var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+surgerycnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="surgery_history"><input class="form-control"  type="text" id="optionsval'+surgerycnt+'" placeholder="value'+surgerycnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

                            $("#surgeryTextBoxesGroup").append(newTextBoxDiv);
                            surgerycnt++;
                            });

                            $(document).on('click', '.systemichistoryremoveButton', function(e) {
                          surgerycnt--;
                          var target = $("#surgeryTextBoxesGroup").find("#TextBoxDiv" +surgerycnt);
                          $(target).remove();
                          });

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
                           var data=$("#eyeOperationRecord").serialize();
                                  event.preventDefault();
                                  $.ajax({
                                      url:'{{ route("dynamic-field.insert") }}',
                                      method:'post',
                                      data:data,
                                      success:function(data)
                                      {
                                       swal({title: "Option For Surgery is saved", text: "Added Successfully!", type: "success"},
                                       function(){ 
                                        location.reload();
                                        }
                                      );
                                      }
                                  })
                              }

                              });
                          });
                          </script>




                           <div class="col-md-12">

							
                             <div class="col-md-2">
							<div class="form-group labelgrp">
							{{ Form::label('admission_date_time','Admission Date & Time') }} 
							</div>
							</div>


							<div class="col-md-2">
							<div class="form-group">
							<div class="form-line">
							{{ Form::text('admission_date_time', Request::old('admission_date_time',$case_master['admission_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}                      
							</div>
							</div>
							</div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('surgery_date_time','Surgery Date & Time') }} 
                              </div>
                              </div>


                              <div class="col-md-2">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master['surgery_date_time']), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('discharge_date_time','Discharge Date & Time ') }}
                              </div>
                              </div>


                              <div class="col-md-2">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('discharge_date_time', Request::old('discharge_date_time',$case_master['discharge_date_time']), array('class' => 'form-control datetimepicker')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-5">
                                <div class="col-md-3">
                                <div class="form-group labelgrp">
                                {{ Form::label('doctor_in_charge','Doctor-In-Charge') }} 
                                </div>
                                </div>


                                <div class="col-md-9">
                                <div class="form-group">
                                <div class="form-line">
                                {{ Form::select('Surgeon', array(''=>'Please select') + $doctorlist->toArray(), Request::old('Surgeon',$eyeOperationRecord->Surgeon), array('class' => 'form-control select2',  'id'=>'Surgeon','data-live-search'=>'true')) }}                          
                                </div>
                                </div>
                                </div>
                            </div>

<!-- ==================================================================================================================================== -->
                        <div classs="col-md-6">
                            <span class="dropdown-container">
                            <div id="classes_history" class="ContainerToAppend">
                              <div class="col-md-7">
                               
                                  <div class="col-md-1">
                                    <div class="form-group labelgrp">
                                      <label class="">Classes</label> 
                                    </div>
                                    <input type="hidden" id="classesHistory[]" name="classesHistory[]" class="hiddenCounter" value="1" />  
                                  </div>

                                  <div class="col-md-4">

                                    {{ Form::select('classes[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'classes_history')->pluck('ddText','ddText')->toArray(), array_key_exists('classes_history', $defaultValues)?$defaultValues['classes_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                  </div>

                                  <div class="col-md-7">
                                    <button type="button" name="add" id='classsetbtn' class="btn btn-success set-dropdown-options" data-field_name="Systemic History OD" data-form_name="commanForm">Set Option </button>

                                    <button type='button' class="btn btn-primary" id='classbtnsave'>Save Option</button>

                                    <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="classesTemplate">Add</button>
                                  </div>
                               
                                <div class="col-md-3">        </div>
                              </div>
                            </div>
                            <div id='classTextBoxesGroup' class="col-md-12">

                            </div>
                             <div class="dbMultiEntryContainer">
                             <?php if(isset($newDischargeData['classes'])) { ?>
                               @foreach ($newDischargeData['classes'] as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-6">
                                      </div>
                                      <div class="col-md-4">
                                      <input type="text" class="form-control" readonly value="{{$item->field_value}}">
                                      </div>
                                      <div class="col-md-2">
                                      <button class="removeDbItemClasses btn btn-default" data-deleteid="{{$item->id}}" data-type="classes_history">Remove</button>
                                      </div>
                                  </div>
                                  @endforeach
                             <?php } ?>
                              </div>
                            </span> 
                            <div id="templateContainner" style="display: none">
                              <div id="classesTemplate">
                                  <div class="col-md-12">
                                          <div class="col-md-6">
                                              <input type="hidden" id="classesHistory[]" name="classesHistory[]" class="hiddenCounter" value="" />
                                          </div>
                                          <div class="col-md-4">

                                              {{ Form::select('classes[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'classes_history')->pluck('ddText','ddText')->toArray(), array_key_exists('classes_history', $defaultValues)?$defaultValues['classes_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
                              
                                          </div>
                                         
                                          <div class="col-md-2">
                                              <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove1</button>
                                          </div>
                                  </div>
                              </div>  
                            </div>     
                          </div>
                        </div>

                          <script>

                        $(document).ready(function(){
                          var classcnt = 1;
                          $("#classsetbtn").click(function () {

                          if(classcnt>10){
                          swal("Only 10 Options Values are allow!");
                          return false;
                          }

                          var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+classcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="classes_history"><input class="form-control"  type="text" id="optionsval'+classcnt+'" placeholder="value'+classcnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

                          $("#classTextBoxesGroup").append(newTextBoxDiv);
                          classcnt++;
                          });

                          $(document).on('click', '.systemichistoryremoveButton', function(e) {
                        classcnt--;
                        var target = $("#classTextBoxesGroup").find("#TextBoxDiv" +classcnt);
                        $(target).remove();
                        });

                        $("#classbtnsave").click(function () {
                               
                                var content=$("#classTextBoxesGroup").val();
                                if (isEmpty($('#classTextBoxesGroup'))) 
                                {
                                    swal({
                                    title: "Please Add Some Option by clicking on",
                                    text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
                                    html: true
                                    });
                                }
                               else 
                            {
                         var data=$("#eyeOperationRecord").serialize();
                                event.preventDefault();
                                $.ajax({
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
                        });
                        </script>
<!-- =============================================================================================================================== -->
                          
                           
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('referred_by','Referred By') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('referedby', Request::old('referedby',$case_master['referedby']), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('discharge_sts','Discharge Status') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('discharge_sts', Request::old('discharge_sts',$case_master['discharge_sts']), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>
<!-- ==================================================================================================================================== -->
<div classs="col-md-12">
    <span class="dropdown-container">
    <div id="diagnosis_history" class="ContainerToAppend">
      <div class="col-md-12">
       
          <div class="col-md-2">
            <div class="form-group labelgrp">
              <label class="">Diagnosis</label> 
            </div>
            <input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="1" />  
          </div>

          <div class="col-md-3">
            {{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>

			<div class="col-md-3">
			{{ Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div> 

          <div class="col-md-4">
            <button type="button" name="add" id='diagnosissetbtn' class="btn btn-success set-dropdown-options" data-field_name="Systemic History OD" data-form_name="commanForm">Set Option </button>

            <button type='button' class="btn btn-primary" id='diagnosisbtnsave'>Save Option</button>

            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="diagnosistemplate">Add</button>
          </div>
       
        <div class="col-md-3">        </div>
      </div>
    </div>
    <div id='diagnosisTextBoxesGroup' class="col-md-12">

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
    </span>
	
    <div id="templateContainner" style="display:none">
      <div id="diagnosistemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-3">
                    {{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>

				 <div class="col-md-3">
                    {{ Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdownsEye->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div>


  <script>

$(document).ready(function() {
  var diagnosiscnt = 1;
  $("#diagnosissetbtn").click(function () {

  if(diagnosiscnt>10){
  swal("Only 10 Options Values are allow!");
  return false;
  }

  var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+diagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="diagnosis_history"><input class="form-control"  type="text" id="optionsval'+diagnosiscnt+'" placeholder="value'+diagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon systemichistoryremoveButton" type="button" id="systemichistoryremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

  $("#diagnosisTextBoxesGroup").append(newTextBoxDiv);
  diagnosiscnt++;
  });

  $(document).on('click', '.systemichistoryremoveButton', function(e) {
diagnosiscnt--;
var target = $("#diagnosisTextBoxesGroup").find("#TextBoxDiv" +diagnosiscnt);
$(target).remove();
});

$("#diagnosisbtnsave").click(function () {
       
	var content=$("#diagnosisTextBoxesGroup").val();
	if (isEmpty($('#diagnosisTextBoxesGroup'))) {
		swal({
		title: "Please Add Some Option by clicking on",
		text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
		html: true
		});
	} else {
		var data=$("#eyeOperationRecord").serialize();
			event.preventDefault();
			$.ajax({
				url:'{{ route("dynamic-field.insert") }}',
				method:'post',
				data:data,
				success:function(data) {
						 swal({title: "Option For Diagnosis", text: "Added Successfully!", type: "success"},
						 function(){ 
							location.reload();
						 }
					);
				}
			})
		}
    });
});
</script>
<!-- =============================================================================================================================== -->
<!-- ================================================================================= -->
<!-- =========================== Start Anaesthetist ============================ -->

@include('discharge.sections.main.anaesthetist')

<!-- =========================== Start Anesthesia ============================ -->
@include('discharge.sections.main.anesthesia')



<!-- ================================================================================= --> 
<!-- 
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="diagnosis" class="control-label">Diagnosis</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('diagnosis', Request::old('diagnosis',$case_master['diagnosis']), array('class' => 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="upload_image" class="control-label">Image</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="file" name="upload_image" id="upload_image" class="form-control" >                         
                              </div>
                              </div>
                              </div>

                          </div> -->
                         
                        
                             
                 

                  <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                 <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                        <i class="fa fa-plus"></i> Submit
                    </button>
                    <a class="btn btn-default btn-lg" href="{{ url('/eyeOperationRecord') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    {{-- <a class="btn btn-default" href="{{ url('/eyeOperationRecord/print').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a> --}}
                    <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>

                    <a  class="btn btn-default btn-lg" href="{{ url('/eyeOperationRecord/print').'/'.$case_master->id }}" target="_blank">
                        <i class="fa fa-print" aria-hidden="true"></i>Print
                    </a>
                    <a  class="btn btn-default btn-lg" href="{{ url('/eyeOperationRecord/view').'/'.$case_master->id }}" >
                        <i class="fa fa-print" aria-hidden="true"></i>View
                    </a>

                                      
                                </div>
                                </div>
                               
                            </div>
                            </form>   
                             </div>        
                </div>
           
            </div>
        </div>
</div>
</div>
</div>
</div>
</div>

        @endsection
  

  @section('scripts')
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<!-- <script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {

   });

   $(".removeDbItemSurgery").click(function(e) {
      var ClickedButton = $(this);
      var containerDiv = $(this).closest('div.form-group.row');

      //var delete_type = ClickedButton.data('type');
     // var url='{{ url("insurancedeletesurgery") }}/'+ $(ClickedButton).data('deleteid');
      //alert(url);
      swal({
        title: "Are you sure?",
        text: "This Will Remove !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      }, function () {
          
        $.ajax({ url: '{{ route("insurancedeletesurgery") }}',
          method:'POST',
          data: {
            _token :$("input[name='_token'][type='hidden']").val(),
            id : $(ClickedButton).data('deleteid'),
          }
        })
        .success(function() {
          $(containerDiv).remove();
          $(ClickedButton).button('reset');

          swal({title: "Deleted", text: "Successfully!!!", type: "success"},
            function(){ 
              location.reload();
            }
          );
        }).error(function(){
        $(ClickedButton).button('reset');
        });

         location.reload();
      });
      e.preventDefault();

        });        

   $(".removeDbItemClasses").click(function(e) {
      var ClickedButton = $(this);
      var containerDiv = $(this).closest('div.form-group.row');

      swal({
        title: "Are you sure?",
        text: "This Will Remove !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      }, function () {
          
        $.ajax({ url: '{{ url("dischargedeleteField") }}',
          method:'POST',
          data: {
            _token :$("input[name='_token'][type='hidden']").val(),
            id : $(ClickedButton).data('deleteid'),
          }
        })
        .success(function() {
          $(containerDiv).remove();
          $(ClickedButton).button('reset');

          swal({title: "Deleted", text: "Successfully!!!", type: "success"},
            function(){ 
              location.reload();
            }
          );
        }).error(function(){
        $(ClickedButton).button('reset');
        });

         location.reload();
      });
      e.preventDefault();

        }); 
		

		$(document).on('click', '.removeDbItem', function(e) {
			var ClickedButton = $(this);
			var containerDiv = $(this).closest('div.form-group.row');

			var delete_type = ClickedButton.data('type');
			var url='{{ url("eyeform/deleteMultiEntry")}}/'+ $(ClickedButton).data('deleteid');
			//alert(url);
			swal({
				title: "Are you sure?",
				text: "This Will Remove !",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}, function () {
					
				$.ajax({ url: url, 
					type: 'DELETE',
					data: {
						_method: 'delete', 
						_token :$("input[name='_token'][type='hidden']").val(),
						id : $(ClickedButton).data('deleteid'),
						type: delete_type
					}
				})
				.success(function() {
					$(containerDiv).remove();
					$(ClickedButton).button('reset');

					swal({title: "Deleted", text: "Successfully!!!", type: "success"},
						function(){ 
							location.reload();
						}
					);
				}).error(function(){
				$(ClickedButton).button('reset');
				});

				 location.reload();
			});
			e.preventDefault();

        });

		$(document).on('click', '.removeItem' ,function(e) {
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });


   $(".select2").select2();
    function isEmpty( el ){
      return !$.trim(el.html())
    }
  $('.addmore').click(function(e) {
    e.preventDefault();
    var template = $("#"+$(this).data('templatediv')).clone();
    
    $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
   // alert("template"+$(this).data('templatediv'))
    $(this).closest('div.ContainerToAppend').append($(template).html());
    $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
    
  });    
 </script>
@endsection
