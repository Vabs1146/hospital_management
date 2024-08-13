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
<!-- Styles -->
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">
<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">
<style>
        /*
        * drawingboards styles: set the board dimensions you want with CSS
        */

        .board {
            margin: 0 auto;
            width: 200px;
            height: 150px;
        }

        .panel-title .trigger:before {
        content: '\f151';
        /* '\f056'; */
        font-family: 'FontAwesome';
        vertical-align: text-bottom;
        }

        .panel-title .trigger.collapsed:before {
        content: '\f150'; 
        /* '\f055'; */
        font-family: 'FontAwesome';
        }
        .complaintremoveButton,.findingremoveButton,.diagnosisremoveButton,.treatment_adviceremoveButton,.life_style_chengerremoveButton,.blncremoveButton
                {
          color: #700;
          cursor: pointer;
        }
        .complaintremoveButton,.findingremoveButton,.diagnosisremoveButton,.treatment_adviceremoveButton,.life_style_chengerremoveButton,.blncremoveButton:hover {
          color: #f00;
        }

</style>
@endsection

@section('content')
<!-- <div class="container">
  <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div> -->

<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     @include('shared.error') 
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                {{ Session::get('flash_message') }}
                            </div>
                        @endif
                    <span id="result"></span>
                </div>
                 <div class="card">
                    <form action="{{ url('/ent/SaveEntExamination') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
                      {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control','id'=>'caseid')) }}
                        {{ csrf_field() }}
                    <div class="header bg-pink">
                            <h2>
                                Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | Time : {{$casedata['visit_time']}}  
                            </h2>
                    </div>
                     {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}

                        <div class="body">
                        <div class="row clearfix">
                        <div class="col-md-12">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="" class="casemasterlinks">Form1</a></p>      
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="" class="casemasterlinks">Form2</a></p>      
                        </div>

                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="" class="casemasterlinks">Form3</a></p>      
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-6 col-xs-6">
                        <p class="font-bold col-pink"><a href="" class="casemasterlinks">Medicine Prescription</a></p>      
                        </div>

                        </div>
                        

        <!----------------------------------chief-complaint---------------------------------------->
                                    <div id="complaint" class="ContainerToAppend">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> Complaint</label> 
                                            </div>
                                            <input type="hidden" id="ent_complaint[]" name="ent_complaint[]" class="hiddenCounter" value="1" />  
                                        </div>

                                        <div class="col-md-6">
                                            {{ Form::select('complaint[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'complaint')->pluck('ddText','ddText')->toArray(), array_key_exists('complaint', $defaultValues)?$defaultValues['complaint']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                        </div>

                                        <div class="col-md-4">
                                            <button type="button" name="add" id='complaintbtn' class="btn btn-success ">Set Option </button> 
                                            <button type='button' class="btn btn-primary" id='complaintbtnsave'>Save Option</button>
                                            <button id="addcomplaint" class="btn btn-default addmore" data-templateDiv="complaintTemplate">Add</button>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        <div id='complaintTextBoxesGroup' class="col-md-12"></div>

                                        <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'complaint')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-6">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                        </div>

                                        <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Examination</label>   
                                        </div>
                                        </div>
                                         <div class="col-md-5">

                                    <div class="col-md-6">
                                         <input type="checkbox" name="ear1_chk" id="ear1_chk" class="filled-in chk-col-pink" <?php if($form_details->ear1_chk=="1"){echo "checked";}else{echo "unchecked";}?> />
                                        <label for="ear1_chk"></label>
                                  
                                    <div class="board" id="OdImg1_canvas"></div>
                               
                                    <input type="hidden" name="OdImg1" id="OdImg1"/>
                                    </div>

                                    <div class="col-md-6">
                                       @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))   
                                        <button type="button" value="OdImg1" class="ImageDelete pull-right" >Delete</button>
                                        <p>&nbsp;</p>

                                        <center id="wPaint-OdImg1"> 

                                        <img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                        @endif
                                   
                                     </div>
                                    </div>
                                        <div class="col-md-3">
                                            
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="ear1_chk" id="ear1_chk" class="filled-in chk-col-pink" <?php if($form_details->ear1_chk=="1"){echo "checked";}else{echo "unchecked";}?> />
                                        <label for="ear1_chk"><b>Right Ear</b></label>
                                       <div>
                                            <img src="{{ url('/')}}/assets/images/ear.jpg" width="100" height="100" alt="ears" />
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="ear2_chk" id="ear2_chk" class="filled-in chk-col-pink" <?php if($form_details->ear2_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="ear2_chk"><b>Left Ear</b></label>
                                        <div>
                                       <img src="{{ url('/')}}/assets/images/ear.jpg" width="100" height="100" alt="ears" />
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="nose" id="nose" class="filled-in chk-col-pink" <?php if($form_details->nose=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="nose"><b>Nose</b></label>
                                        <div >
                                       <img src="{{ url('/')}}/assets/images/nose.jpg" width="100" height="100" alt="ears" />
                                        </div>
                                        </div>
                                        </div>
                                  
                                     </div>

                                      <div class="col-md-12">
                                       
                                        <div class="col-md-3 col-md-offset-2">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="neck" id="neck" class="filled-in chk-col-pink" <?php if($form_details->neck=="1"){echo "checked";}else{echo "unchecked";}?> />
                                        <label for="neck"><b>Neck</b></label>
                                       <div>
                                            <img src="{{ url('/')}}/assets/images/shoulder.jpg" width="100" height="100" alt="ears" />
                                        </div>
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="shoulder" id="shoulder" class="filled-in chk-col-pink" <?php if($form_details->shoulder=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="shoulder"><b>Shoulder</b></label>
                                        <div class="">
                                       <img src="{{ url('/')}}/assets/images/shoulder.jpg" width="100" height="100" alt="ears" />
                                        </div>
                                        </div>
                                        </div>

                                        
                                  
                                     </div>
                                      
                                        <div id="finding" class="ContainerToAppend">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                <label class=""> Finding</label> 
                                                </div>
                                                <input type="hidden" id="ent_findings[]" name="ent_findings[]" class="hiddenCounter" value="1" />  
                                            </div>

                                            <div class="col-md-6">
                                                {{ Form::select('finding[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'finding')->pluck('ddText','ddText')->toArray(), array_key_exists('finding', $defaultValues)?$defaultValues['finding']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                            </div>

                                            <div class="col-md-4">
                                                <button type="button" name="add" id='findingbtn' class="btn btn-success ">Set Option </button>      
                                                <button type='button' class="btn btn-primary" id='findingbtnsave'>Save Option</button>
                                                <button id="addfinding" class="btn btn-default addmore" data-templateDiv="findingTemplate">Add</button>
                                            </div>
                                        
                                        </div>
                                        </div>
                                        <div id='findingTextBoxesGroup' class="col-md-12"></div>

                                         <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'finding')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-6">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                        </div>

                                        <div id="diagnosis" class="ContainerToAppend">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                <label class=""> Diagnosis</label> 
                                                </div>
                                                <input type="hidden" id="ent_diagnosis[]" name="ent_diagnosis[]" class="hiddenCounter" value="1" /> 
                                            </div>

                                            <div class="col-md-6">
                                                {{ Form::select('diagnosis[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis')->pluck('ddText','ddText')->toArray(), array_key_exists('diagnosis', $defaultValues)?$defaultValues['diagnosis']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                            </div>

                                            <div class="col-md-4">
                                                <button type="button" name="add" id='diagnosisbtn' class="btn btn-success ">Set Option </button>
                                                <button type='button' class="btn btn-primary" id='diagnosisbtnsave'>Save Option</button>
                                                <button id="adddiagnosis" class="btn btn-default addmore" data-templateDiv="diagnosisTemplate">Add</button>
                                            </div>
                                        </div>
                                        </div>

                                        <div id='diagnosisTextBoxesGroup' class="col-md-12"></div>

                                        <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'diagnosis')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-6">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                            </div>
                                        @endforeach
                                        </div>

                                        <div id="treatment_advice" class="ContainerToAppend">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <div class="form-group labelgrp">
                                                <label class=""> Treatment Advice</label> 
                                                </div>
                                                <input type="hidden" id="ent_treatment_advice[]" name="ent_treatment_advice[]" class="hiddenCounter" value="1" /> 
                                            </div>

                                            <div class="col-md-6">
                                                {{ Form::select('treatment_advice[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'treatment_advice')->pluck('ddText','ddText')->toArray(), array_key_exists('treatment_advice', $defaultValues)?$defaultValues['treatment_advice']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                            </div>

                                            <div class="col-md-4">
                                                <button type="button" name="add" id='treatment_advicebtn' class="btn btn-success ">Set Option </button> 
                                                <button type='button' class="btn btn-primary" id='treatment_advicebtnsave'>Save Option</button>
                                                <button id="addtreatment_advice" class="btn btn-default addmore" data-templateDiv="treatment_adviceTemplate">Add</button>
                                            </div>
                                        </div>
                                        </div>
                                        <div id='treatment_adviceTextBoxesGroup' class="col-md-12"></div>

                                        <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'treatment_advice')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-6">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        
                                        <div id="life_style_chenger" class="ContainerToAppend">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label class=""> Life Style Chenger</label> 
                                            </div>
                                            <input type="hidden" id="ent_life_style_chenger[]" name="ent_life_style_chenger[]" class="hiddenCounter" value="1" />   
                                            </div>

                                            <div class="col-md-6">
                                                {{ Form::select('life_style_chenger[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'life_style_chenger')->pluck('ddText','ddText')->toArray(), array_key_exists('life_style_chenger', $defaultValues)?$defaultValues['life_style_chenger']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
                                            </div>

                                            <div class="col-md-4">
                                                <button type="button" name="add" id='life_style_chengerbtn' class="btn btn-success ">Set Option </button>
                                                <button type='button' class="btn btn-primary" id='life_style_chengerbtnsave'>Save Option</button>
                                                <button id="addlife_style_chenger" class="btn btn-default addmore" data-templateDiv="life_style_chengerTemplate">Add</button>
                                            </div>
                                        </div>
                                        </div>

                                    <div id='life_style_chengerTextBoxesGroup' class="col-md-12">

                                    </div>
                                     <div class="dbMultiEntryContainer">
                                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'life_style_chenger')->get() as $item)
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                            </div>

                                            <div class="col-md-6">
                                            <input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
                                            </div>

                                            <div class="col-md-4">
                                            <button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                        </div>

<!-----------------------------------end------------------------------------------------>


<!--------------------------------balance-check----------------------------------->
                                        <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group labelgrp">
                                            <label>Balance Test</label>   
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-primary"  name="add" id='addbalnc'>Add Balence Test</button>

                                            <button type="button" id="blncbtnsave" class="btn btn-primary">Set</button>
                                        </div>
                                          <div id="blncTextBoxesGroup" class="col-md-12">
                                    
                                     </div>
                                    </div>
                                    <div class="col-md-12">
                                        @if(count($blnc_test)>1)
                                    
                                        @foreach($blnc_test as $key => $blnctest)
                                        <div class="col-md-3 col-md-offset-1">
                                            <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_{{$key+1}}" class="chksts chk-col-pink" name="checksts[]" value="{{$blnctest->id}}" <?php if($blnctest->sts=="1"){echo "checked";}else{echo "unchecked";}?>  />
                                            <label for="md_checkbox_{{$key+1}}"><b>{{$blnctest->blncetestname}}</b></label>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="col-md-12">
                                        <div class="col-md-3 col-md-offset-1">
                                            <button type="button" id="btnsbmit" class="btn  btn-success">Submit</button>
                                        </div>
                                       </div>
                                        @endif

                                        </div>

    
<!-----------------------------------end------------------------------------------>
<!----------------------------------Investigation------------------------------>
                                   <div class="col-md-12">
                                        <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Investigation</label>   
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="chk1" id="uveiitis_chk" class="filled-in chk-col-pink" <?php if($form_details->uveiitis_chk=="1"){echo "checked";}else{echo "unchecked";}?> />
                                        <label for="uveiitis_chk"><b>Investigation For Uveiitis</b></label>
                                       <ul class="list-group1" style="border: 2px solid #ccc !important;">
                                            <li class="list-group-item1" style="">Cbc</li>
                                            <li class="list-group-item1" style="">Esr</li>
                                            <li class="list-group-item1" style="">Fbs/ppbs</li>
                                            <li class="list-group-item1" style="">Mantoux test</li>
                                            <li class="list-group-item1" style="">Chest x-ray</li>
                                            <li class="list-group-item1" style="">Suptum for TB</li>
                                            <li class="list-group-item1" style="">SERUM ACE</li>
                                            <li class="list-group-item1" style="">CECT CHEST</li>
                                            <li class="list-group-item1" style="">BAL</li>
                                            <li class="list-group-item1" style="">RA FACTOR</li>
                                            <li class="list-group-item1" style="">ANTI dsDNA,ANA</li>
                                            <li class="list-group-item1" style="">P-ANCA,C-ANCA</li>
                                            <li class="list-group-item1" style="">Serum homocysteine</li>
                                            <li class="list-group-item1" style="">HLA B27</li>
                                            <li class="list-group-item1" style="">IgG and IgM anti Toxo antibodies</li>
                                            <li class="list-group-item1" style="">HIV,HCV</li>
                                            <li class="list-group-item1" style="">VDRL</li>
                                        </ul>
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="chk1" id="preoperative_chk" class="filled-in chk-col-pink" <?php if($form_details->preoperative_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="preoperative_chk"><b>Pre Operative Investigations</b></label>
                                        <ul class="list-group1" style="border: 2px solid #ccc !important;">
                                        <li class="list-group-item1" style="">CBC</li>
                                        <li class="list-group-item1" style="">ESR</li>
                                        <li class="list-group-item1" style="">FBS/PPBS</li>
                                        <li class="list-group-item1" style="">HIV 1&2</li>
                                        <li class="list-group-item1" style="">HbsAG</li>
                                        <li class="list-group-item1" style="">HCV</li>
                                        <li class="list-group-item1" style="">URINE ROUTINE/MICROSCOPE</li>
                                        <li class="list-group-item1" style="">BUN</li>
                                        <li class="list-group-item1" style="">S CREATININE</li>
                                        <li class="list-group-item1" style="">S ELECTROLYTES</li>
                                        <li class="list-group-item1" style="">Chest x-ray and ECG</li>
                                        </ul>
                                        </div>
                                        </div>

                                        <div class="col-md-3">
                                        <div class="demo-checkbox">
                                        <input type="checkbox" name="chk1" id="preoperative_chk" class="filled-in chk-col-pink" <?php if($form_details->preoperative_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="preoperative_chk"><b>Pre Operative Investigations</b></label>
                                        <ul class="list-group1" style="border: 2px solid #ccc !important;">
                                        <li class="list-group-item1" style="">CBC</li>
                                        <li class="list-group-item1" style="">ESR</li>
                                        <li class="list-group-item1" style="">FBS/PPBS</li>
                                        <li class="list-group-item1" style="">HIV 1&2</li>
                                        <li class="list-group-item1" style="">HbsAG</li>
                                        <li class="list-group-item1" style="">HCV</li>
                                        <li class="list-group-item1" style="">URINE ROUTINE/MICROSCOPE</li>
                                        <li class="list-group-item1" style="">BUN</li>
                                        <li class="list-group-item1" style="">S CREATININE</li>
                                        <li class="list-group-item1" style="">S ELECTROLYTES</li>
                                        <li class="list-group-item1" style="">Chest x-ray and ECG</li>
                                        </ul>
                                        </div>
                                        </div>
                                  
                                     </div>
<!--------------------------------------end--------------------------------> 
<!------------------------------button--------------------------------->
                            <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary waves-effect">Submit
                                </button>
                                <a class="btn btn-primary waves-effect btn-lg" href="">Submit & View </a>
                                      
                                    </div>
                                </div>
                               
                            </div> 
<!-------------------------------end-button----------------------------> 

<!------------------------------email---------------------------------->
                                       <div class="col-md-12">
                                       
                                        <div class="col-md-6 col-md-offset-2">
                                        
                                        {{ Form::text('Email_To', null, array('class'=> 'form-control', 'autocomplete'=>'off','placeholder'=>'Email To')) }}
                                        
                                        </div> 
                                        <div class="col-md-1">
                                        <button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" name="Send_email" class="btn form-inline" value="Send_email">
                                            <i class="fa fa-plus"></i> Send Mail
                                        </button>
                                        </div>
                                    </div>
<!------------------------------end-email------------------------------->   
<!------------------------------image-upload---------------------------------->     
                                   <div class="col-md-12 ">
                                        <div class="col-md-3 col-md-offset-3 ">
                                        <div class="form-group labelgrp">
                                        <label>Upload Case Paper Image</label>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        {{ Form::file('reportImage', Request::old('reportImage'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
                                        </div>
                                        </div>
                                    </div>
<!------------------------------end-image------------------------------->  

                                   <div class="col-md-12 "> 
                                        <div class="col-md-4 col-md-offset-4">
                                        <button type="submit" name="submit_reportImage" class="btn btn-lg" value="submit_reportImage"><i class="fa fa-plus"></i> Add
                                        </button>&nbsp;
                                        <a class="btn btn-default btn-lg" href="{{ url('/ViewEyeReportFiles/').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> View Report Files  
                                        </a>
                                        </div>
                                    </div> 
<!-------------------------end-------------------------------------------->             
                        </div>
                        </div>
                    </form>
                 </div>

</div>
</div>

<div id="templateContainner" style="display:none">
    <div id="complaintTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="ent_complaint[]" name="ent_complaint[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                        {{ Form::select('complaint[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'complaint')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
               
                <div class="col-md-4">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove this</button>
                </div>
        </div>
    </div>

      <div id="findingTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="ent_findings[]" name="ent_findings[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                        {{ Form::select('finding[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'finding')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
               
                <div class="col-md-4">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
                </div>
        </div>
    </div>

     <div id="diagnosisTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="ent_diagnosis[]" name="ent_diagnosis[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                        {{ Form::select('diagnosis[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'diagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
               
                <div class="col-md-4">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
                </div>
        </div>
    </div>

    <div id="treatment_adviceTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="ent_treatment_advice[]" name="ent_treatment_advice[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                        {{ Form::select('treatment_advice[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'treatment_advice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
               
                <div class="col-md-4">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
                </div>
        </div>
    </div>

   <div id="life_style_chengerTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="ent_life_style_chenger[]" name="ent_life_style_chenger[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                        {{ Form::select('life_style_chenger[]', array('Select'=>'-Select-') + $form_dropdowns->where('fieldName', 'life_style_chenger')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
               
                <div class="col-md-4">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
                </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts')

 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>

<!-- Images checkbox -->
<script>


    var defaultOptions = {
        controls: [
            'Color',
            {
                Size: {
                    type: 'dropdown'
                }
            },
            // {
            //     DrawingMode: {
            //         filler: false
            //     }
            // },
            { Navigation: { back: false, forward: false } },
            //'Download'
        ],
        controlsPosition:"top right",
        size: 6,
        color: "rgb(127, 0, 0)",
        webStorage: false,
        enlargeYourContainer: false,
        //background: '/images/OdImg1.PNG',
        stretchImg: true
    }

    
    var OdImg1 = new DrawingBoard.Board('OdImg1_canvas', $.extend( {}, defaultOptions, {background: '/images/OdImg1.PNG'}));
    var OsImg1 = new DrawingBoard.Board('OsImg1_canvas', $.extend( {}, defaultOptions, {background: '/images/OsImg1.PNG'}));
    var OdImg2 = new DrawingBoard.Board('OdImg2_canvas', $.extend( {}, defaultOptions, {background: '/images/OdImg2.PNG'}));
    var OsImg2 = new DrawingBoard.Board('OsImg2_canvas', $.extend( {}, defaultOptions, {background: '/images/OsImg2.PNG'}));

$(document).ready(function() {
$("#ear1_chk").on("click", function(){
    if(ear1_chk.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#eyeform").serialize();
     var caseid=$("#caseid").val();
     var url="{{ url('ear1') }}/"+checked+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:data,
            success:function(data)
            {
              swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              
              }

            );
            }
        });
}); 
   
////////////ear2////////////////////////////
   $("#ear2_chk").on("click", function(){
    if(ear2_chk.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#eyeform").serialize();
     var caseid=$("#caseid").val();
     var url="{{ url('ear2') }}/"+checked+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:data,
            success:function(data)
            {
              swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              
              }

            );
            }
        });
}); 

   ////////////nose////////////////////////////

   $("#nose").on("click", function(){
    if(nose.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#eyeform").serialize();
     var caseid=$("#caseid").val();
     var url="{{ url('nose') }}/"+checked+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:data,
            success:function(data)
            {
              swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              
              }

            );
            }
        });
}); 

   ////////////neck////////////////////////////

   $("#neck").on("click", function(){
    if(neck.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#eyeform").serialize();
     var caseid=$("#caseid").val();
     var url="{{ url('neck') }}/"+checked+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:data,
            success:function(data)
            {
              swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              
              }

            );
            }
        });
}); 

   ////////////shoulder////////////////////////////

   $("#shoulder").on("click", function(){
    if(shoulder.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#eyeform").serialize();
     var caseid=$("#caseid").val();
     var url="{{ url('shoulder') }}/"+checked+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              
              }

            );
            }
        });
}); 
});

</script>

<!-- to add blnc test in db -->
 <script type="text/javascript">
$( document ).ready(function() {
   $("#btnsbmit").click(function(){
   var caseid=$("#caseid").val();
   //alert(caseid);
   var ckb = $("input[name='checksts']:checked");
   if(ckb)
   {
    var sts=1;
   //alert(accesslevel);
   }
   else
   {
    var sts=0;
         //alert(accesslevel);
   }
    var data=$("#eyeform").serialize();
    var url1="{{url('checksts')}}/"+sts+"/"+caseid;
   // alert(url1);

           $.ajax({
            url:url1,
            type:'POST',
            data:data,
            success:function(response) {
           swal({title: "Done", type: "success"},
             function(){ 
              location.reload();
              }
            );
            
           }

               
           
        }); 


});
});
  
 </script>

<script>

$(document).ready(function() {

    $('input[name="chk1"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    var id= this.id;
    if(id=="uveiitis_chk")
    {
        var uv_chkval=1;
        // alert("uv chk value "+uv_chkval);

    }
    else
    {
        var uv_chkval=0;
       // alert("uv chk value "+uv_chkval);
    }

     if(id=="preoperative_chk")
    {
        var pre_chkval=1;
        //alert("pre_chk value "+pre_chkval);

    }
    else
    {
         var pre_chkval=0;
        //alert("pre_chk value "+pre_chkval);
    }
     var caseid=$("#caseid").val();
     var url="{{ url('bloodinvestigation1') }}/"+uv_chkval+"/"+pre_chkval+"/"+caseid;
     //alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:{uv_chkval:uv_chkval,pre_chkval:pre_chkval,caseid:caseid},
            success:function(data)
            {
            
            swal({title: "Data is Updated", text: "Successfully!!!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
});

   
});

</script>


<!-- ent_complaint Set Option -->
<script type="text/javascript">
     var blnccnt = 1;
$("#addbalnc").click(function () {
      
  if(blnccnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  

var newTextBoxDiv='<div class="col-md-4" id="TextBoxDiv'+blnccnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="caseid" value="{{$casedata['id']}}"><input class="form-control"  type="hidden"  name="casenum" value="{{ $casedata['case_number'] }}"><input class="form-control"  type="text" id="blncetestname'+blnccnt+'" placeholder="value'+blnccnt+'" name="blncetestname[]"></div><span class="input-group-addon blncremoveButton" type="button" id="blncremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#blncTextBoxesGroup").append(newTextBoxDiv);
  blnccnt++;
     });

$(document).on('click', '.blncremoveButton', function(e) {
blnccnt--;
   var target = $("#blncTextBoxesGroup").find("#TextBoxDiv" +blnccnt);
  $(target).remove();
});

</script>

<!-- ent_complaint Set Option -->
<script type="text/javascript">
     var complaintcnt = 1;
$("#complaintbtn").click(function () {
      
  if(complaintcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+complaintcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="complaint"><input class="form-control"  type="text" id="optionsval'+complaintcnt+'" placeholder="value'+complaintcnt+'" name="optionsval[]"></div><span class="input-group-addon complaintremoveButton" type="button" id="complaintremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#complaintTextBoxesGroup").append(newTextBoxDiv);
  complaintcnt++;
     });

$(document).on('click', '.complaintremoveButton', function(e) {
complaintcnt--;
   var target = $("#complaintTextBoxesGroup").find("#TextBoxDiv" +complaintcnt);
  $(target).remove();
});

</script>

<!-- finding Set Option -->
<script type="text/javascript">
     var findingcnt = 1;
$("#findingbtn").click(function () {
      
  if(findingcnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+findingcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="finding"><input class="form-control"  type="text" id="optionsval'+findingcnt+'" placeholder="value'+findingcnt+'" name="optionsval[]"></div><span class="input-group-addon findingremoveButton" type="button" id="findingremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#findingTextBoxesGroup").append(newTextBoxDiv);
  findingcnt++;
     });

$(document).on('click', '.findingremoveButton', function(e) {
findingcnt--;
   var target = $("#findingTextBoxesGroup").find("#TextBoxDiv" +findingcnt);
  $(target).remove();
});

</script>

<!-- diagnosis Set Option -->
<script type="text/javascript">
     var diagnosiscnt = 1;
$("#diagnosisbtn").click(function () {
      
  if(diagnosiscnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+diagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="diagnosis"><input class="form-control"  type="text" id="optionsval'+diagnosiscnt+'" placeholder="value'+diagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon diagnosisremoveButton" type="button" id="diagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#diagnosisTextBoxesGroup").append(newTextBoxDiv);
  diagnosiscnt++;
     });

$(document).on('click', '.diagnosisremoveButton', function(e) {
diagnosiscnt--;
   var target = $("#diagnosisTextBoxesGroup").find("#TextBoxDiv" +diagnosiscnt);
  $(target).remove();
});

</script>


<!-- ent_complaint Set Option -->
<script type="text/javascript">
     var treatment_advicecnt = 1;
$("#treatment_advicebtn").click(function () {
      
  if(treatment_advicecnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+treatment_advicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="treatment_advice"><input class="form-control"  type="text" id="optionsval'+treatment_advicecnt+'" placeholder="value'+treatment_advicecnt+'" name="optionsval[]"></div><span class="input-group-addon treatment_adviceremoveButton" type="button" id="treatment_adviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#treatment_adviceTextBoxesGroup").append(newTextBoxDiv);
  treatment_advicecnt++;
     });

$(document).on('click', '.treatment_adviceremoveButton', function(e) {
treatment_advicecnt--;
   var target = $("#treatment_adviceTextBoxesGroup").find("#TextBoxDiv" +treatment_advicecnt);
  $(target).remove();
});

</script>


<!-- ent_complaint Set Option -->
<script type="text/javascript">
     var life_style_chengercnt = 1;
$("#life_style_chengerbtn").click(function () {
      
  if(life_style_chengercnt>10){
             swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+life_style_chengercnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="life_style_chenger"><input class="form-control"  type="text" id="optionsval'+life_style_chengercnt+'" placeholder="value'+life_style_chengercnt+'" name="optionsval[]"></div><span class="input-group-addon life_style_chengerremoveButton" type="button" id="life_style_chengerremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#life_style_chengerTextBoxesGroup").append(newTextBoxDiv);
  life_style_chengercnt++;
     });

$(document).on('click', '.life_style_chengerremoveButton', function(e) {
life_style_chengercnt--;
   var target = $("#life_style_chengerTextBoxesGroup").find("#TextBoxDiv" +life_style_chengercnt);
  $(target).remove();
});

</script>



<script>
// ent_complaint Add Option
  function isEmpty( el ){
      return !$.trim(el.html())
  }

 
$("#blncbtnsave").click(function () {
        var content=$("#blncTextBoxesGroup").val();
        if (isEmpty($('#blncTextBoxesGroup'))) 
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
            url:'{{ route("blnce-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Balance Test ", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

$("#complaintbtnsave").click(function () {
        var content=$("#complaintTextBoxesGroup").val();
        if (isEmpty($('#complaintTextBoxesGroup'))) 
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
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For complaint", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// ent_finding Add Option
$("#findingbtnsave").click(function () {
        var content=$("#findingTextBoxesGroup").val();
        if (isEmpty($('#findingTextBoxesGroup'))) 
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
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For finding", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// diagnosis Add Option
$("#diagnosisbtnsave").click(function () {
        var content=$("#diagnosisTextBoxesGroup").val();
        if (isEmpty($('#diagnosisTextBoxesGroup'))) 
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
            url:'{{ route("entinsert-field.insert") }}',
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

// treatment_advice Add Option
$("#treatment_advicebtnsave").click(function () {
        var content=$("#treatment_adviceTextBoxesGroup").val();
        if (isEmpty($('#treatment_adviceTextBoxesGroup'))) 
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
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Treatment Advice", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

// life_style_chenger Add Option
$("#life_style_chengerbtnsave").click(function () {
        var content=$("#life_style_chengerTextBoxesGroup").val();
        if (isEmpty($('#life_style_chengerTextBoxesGroup'))) 
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
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Life Style Chenger", text: "Added Successfully!", type: "success"},
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


    $(document).ready(function () {
     
   $('.select2').select2({width: '100%'});
        $(".ImageDelete").on('click',function(){
            var deleteBtn = $(this);
            var  postData = {
                        'case_id': $("input[type='hidden'][name='case_id']").val(),
                        'imageName': deleteBtn.val(),//
                        '_token': $("input[type='hidden'][name='_token']").val()
                    };
            $.ajax({
                    url: "{{ url('/eyeform/deleteImage') }}",
                    type:'POST',
                    //dataType: "json",
                    data: postData,
                    success: function(data) {
                        // deleteBtn.closest('div.col-md-6').find('img').attr('src', '');
                        deleteBtn.closest('div.col-md-6').html('');
                    }
                });
            return false;
        });

        $("#eyeform").on("submit", function () {
            
            var ImgData_OdImg1 = OdImg1.getImg();
            ImgData_OdImg1 = (OdImg1.history.initialItem == ImgData_OdImg1) ? '' : ImgData_OdImg1;
            $("#OdImg1").val(ImgData_OdImg1);

            var ImgData_OsImg1 = OsImg1.getImg();
            ImgData_OsImg1 = (OsImg1.history.initialItem == ImgData_OsImg1) ? '' : ImgData_OsImg1;
            $("#OsImg1").val(ImgData_OsImg1);

            var ImgData_OdImg2 = OdImg2.getImg();
            ImgData_OdImg2 = (OdImg2.history.initialItem == ImgData_OdImg2) ? '' : ImgData_OdImg2;
            $("#OdImg2").val(ImgData_OdImg2);

            var ImgData_OsImg2 = OsImg2.getImg();
            ImgData_OsImg2 = (OsImg2.history.initialItem == ImgData_OsImg2) ? '' : ImgData_OsImg2;
            $("#OsImg2").val(ImgData_OsImg2);

            var ImgData_retino_scopy_OD = retino_scopy_OD.getImg();
            ImgData_retino_scopy_OD = (retino_scopy_OD.history.initialItem == ImgData_retino_scopy_OD) ? '' : ImgData_retino_scopy_OD;
            $("#retino_scopy_OD").val(ImgData_retino_scopy_OD);

            var ImgData_retino_scopy_OS = retino_scopy_OS.getImg();
            ImgData_retino_scopy_OS = (retino_scopy_OS.history.initialItem == ImgData_retino_scopy_OS) ? '' : ImgData_retino_scopy_OS;
            $("#retino_scopy_OS").val(ImgData_retino_scopy_OS);

            var ImgData_gonio_od = gonio_od.getImg();
            ImgData_gonio_od = (gonio_od.history.initialItem == ImgData_gonio_od) ? '' : ImgData_gonio_od;
            $("#gonio_od").val(ImgData_gonio_od);

            var ImgData_gonio_os = gonio_os.getImg();
            ImgData_gonio_os = (gonio_os.history.initialItem == ImgData_gonio_os) ? '' : ImgData_gonio_os;
            $("#gonio_os").val(ImgData_gonio_os);

            OdImg1.clearWebStorage();
            OsImg1.clearWebStorage();
            OdImg2.clearWebStorage();
            OsImg2.clearWebStorage();

            retino_scopy_OD.clearWebStorage();
            retino_scopy_OS.clearWebStorage();
         
            gonio_od.clearWebStorage();
            gonio_os.clearWebStorage();
        });

         
$('.addmore').click(function(e){
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
            template.find('.bootstrap-select').replaceWith(function() { return $('select', this); })
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
          
            $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
           
        });
       
        $('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
      
          return false;
        });
        $(".removeDbItem").click(function(e){
 var ClickedButton = $(this);
var containerDiv = $(this).closest('div.form-group.row');
var url='{{ url("entform/deleteMultiEntry") }}/'+ $(ClickedButton).data('deleteid');
alert(url);
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
                    data: {_method: 'delete', 
                           _token :$("input[name='_token'][type='hidden']").val(),
                           id : $(ClickedButton).data('deleteid')
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
       
         // location.reload();
    });
            e.preventDefault();
        
        });


    }); //document ready
</script>
 
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>
<script>    
    jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>

 

 
@endsection