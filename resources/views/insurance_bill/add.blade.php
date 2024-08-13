@extends('adminlayouts.master')
@php $permissions = session('permissions');  @endphp
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
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
@endsection
@section('content')
<div class="container-fluid">
<div class="list-group list-group-horizontal">
@forelse ($DateWiseRecordLst as $VisitListDateWise)
     @if($case_master['id'] == $VisitListDateWise['id'])
      <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
     @else
     <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
     @endif
    @endforeach
</div>
</div>

<div class="container-fluid">
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
  <center><h2>Eye IPD Bill</h2></center>
</div>
     
<div class="body">
<div class="row clearfix ">

 <form action="{{ url('/insuranceBill'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" id="eyeform" enctype = 'multipart/form-data' >
{{ csrf_field() }}


@if (isset($case_master))
    <input type="hidden" name="_method" value="PATCH">
@endif

 <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
    <div class="col-md-12">
      <div class="col-md-6">
          <div class="col-md-4">
              <div class="form-group labelgrp">
                <label for="name_of_patient">Username: </label>                     
              </div>
          </div>
          <div class="col-md-4">
              @if(isset(Auth::user()->name))
              <div class="name">{{ Auth::user()->name }}</div>
              @else
              <div class="name">Admin</div>
              @endif
          </div>
      </div>

      <div class="col-md-2">
        <div class="form-group labelgrp">
          <label for="name_of_patient">Bill Date:</label>
        </div>
      </div>


      <div class="col-md-4">
        <div class="form-group">
          <div class="form-line">
            <input type="text" name="bill_date" id="bill_date" class="form-control datepicker"  value="{{ $insurance_bill->bill_date or ''}}">                          
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
            <div class="col-md-4">
            <div class="form-group labelgrp">
            <label for="case_number" class="">Case No</label>
            </div>
            </div>

            <div class="col-md-8">
            <div class="form-group">
            <div class="form-line">
            <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">                         
            </div>
            </div>
            </div>         
      </div>
      <div class="col-md-3">
          <div class="col-md-4">
          <div class="form-group labelgrp">
           {{ Form::label('ipd no',' IPD No') }} 
          </div>
          </div>

          <div class="col-md-8">
          <div class="form-group">
          <div class="form-line">
             <input type="text" name="ipd_no" id="ipd_no" class="form-control" value="{{ $case_master['IPD_no'] or ''}}">                                 
          </div>
          </div>
          </div>         
      </div>
      <div class="col-md-3">
            <div class="col-md-4">
            <div class="form-group labelgrp">
             {{ Form::label('uhid_no',' UHID No') }} 
            </div>
            </div>

            <div class="col-md-8">
            <div class="form-group">
            <div class="form-line">            
              <input type="text" name="uhid_no" id="uhid_no" class="form-control" readonly='readonly' value="{{ $case_master['uhid_no'] or ''}}">                 
            </div>
            </div>
            </div>        
      </div>
      <div class="col-md-3">
            <div class="col-md-4">
              <div class="form-group labelgrp">
              <label for="name_of_patient">Bill No:</label>
              </div>
            </div>

            <div class="col-md-8">
              <div class="form-group">
              <div class="form-line">
                <input type="text" name="bill_no" id="bill_no" class="form-control"  value="{{ $case_master['bill_number'] or ''}}">                          
              </div>
              </div>
            </div>        
      </div>

    </div>

	<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Name <b class="star">*</b> :</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">				
				{{ Form::text('patient_name', $case_master['mr_mrs_ms'].' '.$case_master['patient_name'] .' '.$case_master['middle_name'] .' '.$case_master['last_name'], array('class' => 'form-control', 'required', 'readonly'=>'true')) }}  
			</div>
		</div>
	</div>

	
	<div class="col-md-1">
			<div class="form-group labelgrp">
			<label for="name_of_age" class="form-control">Age :</label>
			</div>
		</div>
	
	
		<div class="col-md-2">
			<div class="form-group">
			<div class="form-line">
			<input type="text" name="patient_age" id="patient_age" class="form-control" readonly value="{{ $case_master['patient_age'] or ''}}">
			</div>
			</div>
		</div>
	
		<div class="col-md-1">
			<div class="form-group labelgrp">
			<label for="male_female" class="form-control">Sex :</label>
			</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		 {{ Form::text('male_female', Request::old('male_female',$case_master->male_female), array('class' => 'form-control', 'readonly'=>'true')) }}
		</div>
		</div>
		</div>
</div>

<div class="col-md-12">	</div> 

	<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Address <b class="star">*</b>:</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_address', Request::old('patient_address', $case_master->patient_address), array('class' => 'form-control', 'placeholder'=>'Address', 'readonly'=>'true')) }}       
			</div>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">     {{ Form::text('patient_area', Request::old('patient_area', $case_master->area), array('class' => 'form-control', 'placeholder'=>'Area', 'readonly'=>'true')) }}                             
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('city', Request::old('city', $case_master->city), array('class' => 'form-control', 'placeholder'=>'City', 'readonly'=>'true')) }}               
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('district', Request::old('district', $case_master->district), array('class' => 'form-control', 'placeholder'=>'District', 'readonly'=>'true')) }}                            
			</div>
		</div>
	</div>
</div>
    <!-- <div class="col-md-12">
      <div class="col-md-6">
          <div class="col-md-4">
          <div class="form-group labelgrp">
          <label for="name_of_patient">Name Of Patient</label>
          </div>
          </div>
    
          <div class="col-md-8">
          <div class="form-group">
          <div class="form-line">
           <input type="text" name="name_of_patient" id="name_of_patient" class="form-control"  readonly='readonly' value="{{ $case_master['patient_name'] or ''}}">                   
          </div>
          </div>        
          </div>
      </div>
      <div class="col-md-6">
          <div class="col-md-2">
          <div class="form-group labelgrp">
          <label for="name_of_patient">Age</label>
          </div>
          </div>
    
          <div class="col-md-4">
            <div class="form-group">
            <div class="form-line">
             <input type="text" name="name_of_patient" id="patient_age" class="form-control"  readonly='readonly' value="{{ $case_master['patient_age'] or ''}}">                   
            </div>
            </div>
          </div>
          <div class="col-md-2">
          <div class="form-group labelgrp">
          <label for="name_of_patient">Sex</label>
          </div>
          </div>
    
          <div class="col-md-4">
            <div class="form-group">
            <div class="form-line">
             <input type="text" name="name_of_patient" id="male_female" class="form-control"  readonly='readonly' value="{{ $case_master['male_female'] or ''}}">                   
            </div>
            </div>                  
          
         </div>
      </div>
      </div> -->

  <!-- <div class="col-md-12">
          <div class="col-md-2">
          <div class="form-group labelgrp">
          {{ Form::label('address','Address') }}
          </div>
          </div>
  
  
          <div class="col-md-4">
          <div class="form-group">
          <div class="form-line">             
            <input type="text" name="patient_address" id="patient_address" class="form-control"  readonly='readonly' value="{{ $case_master['patient_address'] or ''}}">                    
          </div>
          </div>
          </div>      
  </div> -->

  <!-- ===================== START Surgery procedure ====================== -->
  <!-- <div classs="col-md-12">
    <span class="dropdown-container">
    <div id="surgery_history" class="ContainerToAppend">
      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-3">
            <div class="form-group labelgrp">
              <label class="">Surgery/Procedure</label> 
            </div>
            <input type="hidden" id="surgeryHistory[]" name="surgeryHistory[]" class="hiddenCounter" value="1" />  
          </div>
  
          <div class="col-md-4">
            {{-- Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery_history')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery_history', $defaultValues)?$defaultValues['surgery_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) --}}
  
  			{{ Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery_history', $defaultValues)?$defaultValues['surgery_history']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
          </div>
  
          <div class="col-md-5">
            <button type="button" name="add" id='surgerysetbtn' class="btn btn-success set-dropdown-options" data-field_name="Systemic History OD" data-form_name="commanForm">Set Option </button>
  
            <button type='button' class="btn btn-primary" id='surgerybtnsave'>Save Option</button>
  
            <button id="addSystemicHistory" class="btn btn-default addmore" data-templateDiv="surgerytemplate">Add</button>
          </div>
        </div>
        <div class="col-md-3">
          <div class="col-md-6">
            <input type="hidden" name="left_eye" value="0">
          <input type="checkbox" name="left_eye" id="left_eye" class="bloodtests filled-in chk-col-pink"   value="1" <?php if($insurance_bill->left_eye == 1) { echo "checked"; } else { echo "unchecked"; } ?> />
          <label for="left_eye">Left Eye</label>
          </div>
          <div class="col-md-6 ">
            <input type="hidden" name="right_eye" value="0">
  
          <input type="checkbox" name="right_eye" id="right_eye" class="bloodtests filled-in chk-col-pink"  value="1" <?php if($insurance_bill->right_eye == 1) { echo "checked"; } else { echo "unchecked"; } ?>/>
          <label for="right_eye">Right Eye</label>
          </div>          
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
              <div class="col-md-8">
              <input type="text" class="form-control" readonly value="{{$item->text}}">
              </div>
              <div class="col-md-2">
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="surgery_history">Remove</button>
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
                  <div class="col-md-6">
                      {{ Form::select('Surgery[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery_history')->pluck('ddText','ddText')->toArray(), array_key_exists('surgery_history', $defaultValues)?$defaultValues['surgery_history']:null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
      
                  </div>
                 
                  <div class="col-md-2">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>  
    </div>     
  </div> -->


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
              <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="surgery_history">Remove</button>
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

  <!-- ===================== END Surgery procedure ====================== -->


  <div class="col-md-12">
          <div class="col-md-2">
          <div class="form-group labelgrp">
          {{ Form::label('admission_date_time','Admission Date & Time') }}
          </div>
          </div>


          <div class="col-md-4">
          <div class="form-group">
          <div class="form-line">
          {{ Form::text('admission_date_time', Request::old('admission_date_time',$case_master['admission_date_time']), array('class' => 'form-control datetimepicker')) }}                            
          </div>
          </div>
          </div>     
          
          <div class="col-md-2">
          <div class="form-group labelgrp">
          {{ Form::label('discharge_date_time','Discharge Date & Time') }}
          </div>
          </div>


          <div class="col-md-4">
          <div class="form-group">
          <div class="form-line">
          {{ Form::text('discharge_date_time', Request::old('discharge_date_time',$case_master['discharge_date_time']), array('class' => 'form-control datetimepicker')) }}                            
          </div>
          </div>
          </div>           
    </div>
    <div class="col-md-12">
          <div class="col-md-2">
          <div class="form-group labelgrp">
          {{ Form::label('doctor_in_charge','Doctor-in-Charge') }} 
          </div>
          </div>
@php
									$doctors_list = $doctorlist->toArray();
									//dd($doctors_list);
									$doc_key = key($doctors_list);
									$doc_name = $doctors_list[$doc_key];
								@endphp
          <div class="col-md-4">
          <div class="form-group">
		  @if(count($doctors_list) > 1)
          {{ Form::select('surgon_name', array(''=>'Please select') + $doctorlist->toArray(), Request::old('surgon_name',$insurance_bill->surgon_name), array('class' => 'form-control select2',  'id'=>'Surgeon','data-live-search'=>'true')) }}  
          
		  @else
								<div class="form-group">
                                        <div class="form-line">
									<input class="form-control" name="" value="{{$doc_name}}" type="text" disabled>
</div>
                                </div>
									<input class="form-control" name="surgon_name" value="{{$doc_key}}" type="hidden">
									@endif


		  </div>
          </div>   

          <div class="col-md-2">
          <div class="form-group labelgrp">
          {{ Form::label('surgery_date','Surgery Date & Time') }} 
          </div>
          </div>


          <div class="col-md-4">
          <div class="form-group">
          <div class="form-line">
           {{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master['surgery_date_time']), array('class' => 'form-control datetimepicker')) }}                    
          </div>
          </div>
          </div>              
    </div>
    <div class="col-md-12">
        <div class="col-md-2">
        <div class="form-group labelgrp">
        {{ Form::label('referedby','Referred By') }}
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
    <div class="col-md-12">
      <div class="col-md-2">
      <div class="form-group labelgrp">
      {{ Form::label('tpa_company','TPA Company') }}
      </div>
      </div>


      <div class="col-md-4">
      <div class="form-group">
      <div class="form-line">
      {{ Form::text('tpa_company', Request::old('tpa_company',$insurance_bill->tpa_company), array('class' => 'form-control')) }}                         
      </div>
      </div>
      </div>   
      <div class="col-md-2">
      <div class="form-group labelgrp">
      {{ Form::label('insurance_company','Insurance Company') }} 
      </div>
      </div>


      <div class="col-md-4">
      <div class="form-group">
      <div class="form-line">
      {{ Form::text('insurance_company', Request::old('insurance_company',$insurance_bill->insurance_company), array('class' => 'form-control')) }}                        
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
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('advance_amount', Request::old('advance_amount', $advance_amount), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
	
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('advance_amount','Payment Mode')  }} 
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				<select class="form-control select2" name="advance_payment_type" id="advance_payment_type" required>
				<option value="0">Select Payment Mode</option>
				@foreach ($payment_modes as $payment_modes_row)
				<?php $selected = ( $advance_payment_type == $payment_modes_row->id) ? "selected": ""; ?>
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
			{{ Form::label('advance_date','Advance Date')  }} 
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('advance_date', Request::old('advance_date', $advance_date), array('class'=> 'form-control datepicker', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>     
</div>
    <div class="col-md-12">
	<!--
        <div class="col-md-2">
        <div class="form-group labelgrp">
        {{ Form::label('advance_amount','Advance Amount') }}
        </div>
        </div>


        <div class="col-md-4">
        <div class="form-group">
        <div class="form-line">
        {{ Form::text('advance_amount', Request::old('advance_amount',$advance_amount), array('class' => 'form-control', 'autocomplete'=>'off')) }}                         
        </div>
        </div>
        </div> -->

        <div class="col-md-2">
        <div class="form-group labelgrp">
         {{ Form::label('discount_amount','Discount Amount') }} 
        </div>
        </div>


        <div class="col-md-4">
        <div class="form-group">
        <div class="form-line">
        {{ Form::text('discount_amount', Request::old('discount_amount',$insurance_bill->discount_amount), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
        </div>
        </div>
        </div>

    </div>    
     {{--                     <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="name_of_patient">Name Of Patient</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               <input type="text" name="name_of_patient" id="name_of_patient" class="form-control"  readonly='readonly' value="{{ $case_master['patient_name'] or ''}}">                   
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('admission_date_time','Admission Date & Time') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('admission_date_time', Request::old('admission_date_time',$case_master['admission_date_time']), array('class' => 'form-control datetimepicker')) }}                            
                              </div>
                              </div>
                              </div>
                          </div>

                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('classes','Class') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                                 {{ Form::text('classes', Request::old('classes',$case_master['classes']), array('class' => 'form-control')) }}                  
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('discharge_date_time','Discharge Date & Time') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('discharge_date_time', Request::old('discharge_date_time',$case_master['discharge_date_time']), array('class' => 'form-control datetimepicker')) }}                            
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('doctor_in_charge','Doctor-in-Charge') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              {{ Form::select('surgon_name', array(''=>'Please select') + $doctorlist->toArray(), Request::old('surgon_name',$insurance_bill->surgon_name), array('class' => 'form-control select2',  'id'=>'Surgeon','data-live-search'=>'true')) }}  
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('referedby','Referred By') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('referedby', Request::old('referedby',$case_master['referedby']), array('class' => 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('final_diagnosis','Final Diagnosis') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('final_diagnosis', Request::old('final_diagnosis',$case_master['final_diagnosis']), array('class' => 'form-control')) }} 
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

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('procedure surgery done',' Procedure Surgery Done') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('procedure_surgery_done', Request::old('procedure_surgery_done',$insurance_bill->procedure_surgery_done), array('class' => 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('surgery_date','Surgery Date & Time') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('surgery_date_time', Request::old('surgery_date_time',$case_master['surgery_date_time']), array('class' => 'form-control datetimepicker')) }}                    
                              </div>
                              </div>
                              </div>
                          </div>
                           
                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('tpa_company','TPA Company') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('tpa_company', Request::old('tpa_company',$insurance_bill->tpa_company), array('class' => 'form-control')) }}                         
                              </div>
                              </div>
                              </div>


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('insurance_company','Insurance Company') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('insurance_company', Request::old('insurance_company',$insurance_bill->insurance_company), array('class' => 'form-control')) }}                        
                              </div>
                              </div>
                              </div>

                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('advance_amount','Advance Amount') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('advance_amount', Request::old('advance_amount',$advance_amount), array('class' => 'form-control', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('discount_amount','Discount Amount') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('discount_amount', Request::old('discount_amount',$insurance_bill->discount_amount), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>

                          </div>
                          --}}



<div class="col-md-12">
	<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="custom_type" value="new"> Default
	<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="custom_type" value="template"> Template

	<span id="custom_template_dropdown_div" style="display:none;">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="form-control">Select Template</label>
				</div>
			</div>
			<div class="col-md-4">
				<select name="select_template" id="select_template" class="form-control">
					<option value="">Select Template</option>
					@foreach($custom_templates as $custom_templates_row)
					<option value="{{$custom_templates_row->id}}">{{$custom_templates_row->name}}</option>
					@endforeach
				</select>
			</div>
		
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label class="form-control">OR</label>
				</div>
			</div>
			<div class="col-md-4">
				<a href="{{ url('/add-ipdbill-items-template') }}/{{$case_master['id']}}" name="submit" class="btn btn-info btn-lg">
					Add New Template
				</a>       
			</div>
		</div>
	</span>
</div>


                    <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="table-responsive">
					<div id="payment_details_html_div">
                        <table class="table">
                            <tr>
                                <td>    
                                    <label for="bill_item" class="control-label">Bill Item</label>
                                    <input type="text" name="bill_item" id="bill_item" class="form-control" value="{{ $bill_item or ''}}"> 
                                </td>
                                <td>
                                    <label for="bill_Amount" class="control-label">Bill Amount</label>
                                    <input type="number" step="0.01" name="bill_Amount" id="bill_Amount" class="form-control" value="{{$bill_Amount or ''}}">                            
                                </td>
                                <td> 
                                    <label for="Item_Add" class="control-label">&nbsp;</label>
                                    <button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>                      
                                 </td>
                            </tr>
                            @if(null !== old('bill_data',$bill_data) && count(old('bill_data',$bill_data))> 0 )
                                @foreach(old('bill_data',$bill_data) as $billdata) 
                                    <tr>
                                        <td> {{ $billdata->bill_item }} </td>
                                        <td> {{ $billdata->bill_Amount }} </td>
                                        <td> {{ Form::button('Delete', array('class'=> 'btn btn-warning pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} </td>
                                    </tr>
                                @endforeach
									<tr>
                                        <td align="right"> <label for="totalAmount" class="control-label">Sub Total</label>  </td>
                                        <td> 
                                            <?php $itemsum = 0; 
                                                  $itemsum = $bill_data->sum('bill_Amount') 
                                            ?>
                                            <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                        </td>
                                        <td>  </td>
                                    </tr>

									@if($insurance_bill->advance_amount)
									<tr>
                                        <td align="right"> <label for="totalAmount" class="control-label">Advance</label>  </td>
                                        <td> 
                                            <?php 
                                                  $itemsum = $itemsum  - $insurance_bill->advance_amount;
                                            ?>
                                            <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $insurance_bill->advance_amount }}"  readonly="readonly"> 
                                        </td>
                                        <td>  </td>
                                    </tr>
									@endif

@if($insurance_bill->discount_amount)
<tr>
<td align="right"> <label for="totalAmount" class="control-label">Discount</label>  </td>
<td> 
<?php 
$itemsum = $itemsum - floatval($insurance_bill->discount_amount);
?>
<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ floatval($insurance_bill->discount_amount) }}"  readonly="readonly"> 
</td>
<td>  </td>
</tr>
@endif

                                     <tr>
                                        <td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
                                        <td> 
                                            <?php 
													//$itemsum = 0; 
                                                    //$itemsum = $bill_data->sum('bill_Amount') 
                                            ?>
                                            <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                        </td>
                                        <td>  </td>
                                    </tr>
									
									 </table>
							 </div>

 <table class="table">
<!-- ======================================= Payment Section ================================================================= -->
	<tr>
		<td>    
			<label for="bill_item" class="control-label">Date</label><br>
			<input  class="form-control datepicker" type="text" name="payment_date" value="">
		</td>
		<td>
			<label for="payment_mode" class="control-label">Payment Mode</label><br>
			<select class="form-control select2" name="payment_mode" id="payment_mode" required>
				<option value="0">Select Payment Mode</option>
				@foreach ($payment_modes as $payment_modes_row)
				<?php $selected = ""; ?>
				<option value="{{ $payment_modes_row->id }}" {{ $selected }}
				>
				{{ $payment_modes_row->name }}
				</option>
				@endforeach
			</select>                            
		</td>
		<td>
			<label for="payment_Amount" class="control-label">Payment Amount</label><br>
			<input type="number" step="0.01" name="payment_amount" id="payment_amount" class="form-control" value="">                            
		</td>
		<td> 
			<label for="Payment_Add" class="control-label">&nbsp;</label>
			<button class="btn btn-success form-control" name="Payment_Add" value="Payment_Add" type="submit"> <i class="fa fa-plus"></i> Pay</button>                      
		</td>
	</tr>
	
@if($advance_amount > 0)
<tr>
		<td>    
			{{date('d F, Y', strtotime($advance_date))}}
		</td>
		<td>
			{{$payment_modes_array[$advance_payment_type]}}                      
		</td>
		<td>
			{{$advance_amount}}                            
		</td>
		<td> 
			
		</td>
	</tr>
@endif	
	

	@foreach($payment_details as $payment_details_row)
	<tr>
		<td>    
			{{date('d F, Y', strtotime($payment_details_row->payment_date))}}
		</td>
		<td>
			{{$payment_modes_array[$payment_details_row->payment_mode]}}                      
		</td>
		<td>
			{{$payment_details_row->paid_amount}}                            
		</td>
		<td> 
			@if(isset($permissions) && isset($permissions['1_bill_details']) && $permissions['1_bill_details']->delete_permission || AUTH::user()->role == 1)
{{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $payment_details_row->id, 'name' => 'delete_payment_item', 'type'=>'submit')) }} 
			@endif
		</td>
	</tr>
	@endforeach

	@if(floatval($total_paid) > 0) 
	<tr>
		<td>    

		</td>
		<td>
		<label for="bill_discount" class="control-label">Total Paid</label>

		</td>
		<td>
			@if($advance_amount > 0)
				Rs. {{$total_paid + $advance_amount}}  
			@else
				Rs. {{$total_paid}}     
			@endif		
		</td>
		<td> 

		</td>
	</tr>
	<tr>
		<td>    

		</td>
		<td>
			<label for="bill_discount" class="control-label">Balance</label>
		</td>
		<td>
			Rs. {{$itemsum - $total_paid}}                            
		</td>
		<td> 

		</td>
	</tr>
	@endif
<!-- ======================================= End Payment Section ======================================================================== -->
                            @endif
                        </table>
                    </div>
               </div>
            </div>
                         
                        
                             
                 

                  <div class="col-md-12">
                                <div class="col-md-12 " style="text-align: center;">
                                <div class="form-group">
                                 <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                        <i class="fa fa-plus"></i> Submit
                    </button>&nbsp;
                    <a class="btn btn-default btn-lg" href="{{ url('/insuranceBill') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Insurance Bill</a>&nbsp;
                    <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>
                   <a class="btn btn-success btn-lg" href="{{ url('/insuranceBill').'/'. $case_master->id }}/print/0" target="_blank"><i class="glyphicon glyphicon-print"></i> Bill Breakup Print </a>&nbsp;
                    <a class="btn btn-success btn-lg" href="{{ url('/insuranceBill').'/'. $case_master->id }}/print/1" target="_blank"><i class="glyphicon glyphicon-print"></i> Bill Cum Receipt Print </a>&nbsp;


                                      
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

<span id="item_to_clone" style="display:none;">
	
		<div class="row clearfix bill-item-row">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Item :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="text" name="bill_item[]" id="bill_item" class="form-control" value="{{ $bill_item or ''}}"> 
					</div>
				</div>
			</div> 
			
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Bill Amount :</label>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<div class="form-line">
						 <input type="number" step="0.01" name="bill_Amount[]" id="bill_Amount" class="form-control" value="{{$bill_Amount or ''}}">
					</div>
				</div>
			</div> 
			
			<div class="col-md-2"><span class="btn btn-success form-control remove_ipdbill_item" name="Item_Add" value="Item_Add" > <i class="fa fa-plus"></i> Remove</span></div>
		</div>
		
		
	</span>

        @endsection
  
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
 
<script>
var surgerycnt = 1;
$(document).ready(function() {
  function isEmpty( el ){
      return !$.trim(el.html())
  }
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

$(document).on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
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
 var data=$("#eyeform").serialize();
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

        $('.addmore').click(function(e){
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
      //alert($(this).data('templatediv'));
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
            // $("#surgeryDetails").find('#patient_name').val('');
            $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
            // .each(function(index,ele){
            //     $(ele).select2({width: '80%'});
            // });
        });



    $(".removeDbItem").click(function(e) {
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
});




//============================================================================================



  </script>
  
  

@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
 
 <script>
	$('input[name=custom_type]').click(function() {
		var custom_type = $(this).val();
		
		if(custom_type == 'new') {
			location.reload();
		}

		if(custom_type == 'template') {
			$('#template_one').hide();
			$('#custom_template_dropdown_div').show();
		}
		//alert(custom_type);
	});

	$(document).on('change', '#select_template', function() {
		var selected_template = $(this).val();
		//alert(selected_template);
		$('#template_one').html('');
				
		$.ajax({
			url : '{{url("get-ipdbill-items-template-html")}}',
			type:'post',
			data : {'id' : $(this).val(), 'template_type' : 'procedure'},
			datatype: 'json',
			success : function(response) {


				$('#payment_details_html_div').html(response.one);

				//$('#template_one').show();
				
				//$('.template-span .select2').select2({width: '100%'});
			}
		});
		
	});
</script>
<script>
	$(document).on('click', '#add_ipdbill_item',function(e) {
		e.preventDefault();
		var template = $("#item_to_clone").clone();
		$('#payment_details_div').append($(template).html());
	   
	});

	$(document).on('click', '.remove_ipdbill_item' ,function(e){
          e.preventDefault();
          $(this).closest('.bill-item-row').remove();
         //alert('hi');
          return false;
    });

	function isEmpty( el ){
      return !$.trim(el.html())
  }
</script>

@endsection
