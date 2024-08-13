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
                    <form action="" method="POST" class="form-horizontal" id="entform" enctype='multipart/form-data'>
                      {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control','id'=>'caseid')) }}
					{{ Form::hidden('patient_emailId', Request::old('patient_emailId', $casedata['patient_emailId']), array('class'=> 'form-control')) }}
                        {{ csrf_field() }}
                    <div class="header bg-pink">
                            <h2>Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | Time : {{$casedata['visit_time']}}  
                            </h2>
                    </div>
                     {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly','id'=>'case_number')) }}

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
                        <p class="font-bold col-pink"><a href="{{ url('/AddEdit/entprescription
/').'/'.$casedata['id']}}" class="casemasterlinks">Medicine Prescription</a></p>      
                        </div>

                        </div>
                        

<!----------------chief-complaint---------------------------------------->
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
                                        <legend>Examination</legend>

                                       <div class="col-md-6">
                                        <label>Left Ear</label> 
                                        <div class="col-md-6">
                                            <div class="example1" data-example="leftear">
                                            <div class="board" id="leftear_canvas">
                                            <input type="checkbox" name="ear1_chk" id="ear1_chk" class="filled-in chk-col-pink" <?php if($form_details->ear1_chk=="1"){echo "checked";}else{echo "unchecked";}?> />
                                            <label for="ear1_chk" style="top: 37px;"></label>
                                            </div>
                                            </div>
                                        <input type="hidden" name="leftear" id="leftear"/>
                                        </div>

                                        <div class="col-md-6" style="margin-top: 9px">
                                             <label></label>
                                           @if (!empty($form_details->leftear) && !is_null($form_details->leftear))   
                                            <button type="button" value="leftear" class="ImageDelete pull-right" >Delete</button>
                                           

                                            <center id="wPaint-leftear" > 
                                            <img src={{ Storage::disk('local')->url($form_details->leftear)."?".filemtime(Storage::path($form_details->leftear)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                          
                                            </center>
                                            @endif
                                       
                                         </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Right Ear</label>
                                        <div class="col-md-6">
                                        <div class="example1" data-example="rightear">
                                        <div class="board" id="rightear_canvas">
                                        <input type="checkbox" name="ear2_chk" id="ear2_chk" class="filled-in chk-col-pink" <?php if($form_details->ear2_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="ear2_chk" style="top: 37px;"><b></b></label>
                                        </div>
                                        </div>
                                        <input type="hidden" name="rightear" id="rightear"/>
                                        </div>

                                        <div class="col-md-6" style="margin-top: 9px">
                                             <label></label>
                                        @if (!empty($form_details->rightear) && !is_null($form_details->rightear))   
                                        <button type="button" value="rightear" class="ImageDelete pull-right" >Delete</button>
                                      
                                        <center id="wPaint-rightear" > 
                                        <img src={{ Storage::disk('local')->url($form_details->rightear)."?".filemtime(Storage::path($form_details->rightear)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                        @endif
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                             <label>Nose </label>
                                        <div class="col-md-6">
                                        <div class="example1" data-example="nose">
                                        <div class="board" id="nose_canvas">
                                        <input type="checkbox" name="nose_chk" id="nose_chk" class="filled-in chk-col-pink" <?php if($form_details->nose_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="nose_chk" style="top: 37px;"><b></b></label>
                                        </div>
                                        </div>
                                        <input type="hidden" name="nose" id="nose"/>
                                        </div>
                                  
                                        <div class="col-md-6" style="margin-top: 9px">
                                        @if (!empty($form_details->nose) && !is_null($form_details->nose))   
                                        <button type="button" value="nose" class="ImageDelete pull-right" >Delete</button>
                                    
                                        <center id="wPaint-nose"> 
                                        <img src={{ Storage::disk('local')->url($form_details->nose)."?".filemtime(Storage::path($form_details->nose)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                         @endif
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <label>Neck </label>
                                        <div class="col-md-6">
                                        <div class="example1" data-example="neck">
                                        <div class="board" id="neck_canvas">
                                        <input type="checkbox" name="neck_chk" id="neck_chk" class="filled-in chk-col-pink" <?php if($form_details->neck_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="neck_chk" style="top: 37px;"><b></b></label>
                                        </div>
                                        </div>
                                        <input type="hidden" name="neck" id="neck"/>
                                        </div>
                                   
                                        <div class="col-md-6" style="margin-top: 9px">
                                        @if (!empty($form_details->neck) && !is_null($form_details->neck))   
                                        <button type="button" value="neck" class="ImageDelete pull-right" >Delete</button>
                                       
                                        <center id="wPaint-neck"> 
                                        <img src={{ Storage::disk('local')->url($form_details->neck)."?".filemtime(Storage::path($form_details->neck)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                        @endif
                                        </div>
                                         </div>

                                    </div>

                                    <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Throat </label>
                                        <div class="col-md-6">
                                        <div class="example1" data-example="throat">
                                        <div class="board" id="throat_canvas">
                                        <input type="checkbox" name="throat_chk" id="throat_chk" class="filled-in chk-col-pink" <?php if($form_details->throat_chk=="1"){echo "checked";}else{echo "unchecked";}?>/>
                                        <label for="throat_chk" style="top: 37px;"><b></b></label>
                                        </div>
                                        </div>
                                        <input type="hidden" name="throat" id="throat"/>
                                        </div>

                                        <div class="col-md-6" style="margin-top: 9px">
                                        @if (!empty($form_details->throat) && !is_null($form_details->throat))   
                                        <button type="button" value="throat" class="ImageDelete pull-right" >Delete</button>
                                       
                                        <center id="wPaint-throat"> 
                                        <img src={{ Storage::disk('local')->url($form_details->throat)."?".filemtime(Storage::path($form_details->throat)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                        </center>
                                        @endif
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
                                <button type="submit" class="btn btn-lg btn-primary waves-effect" formaction="{{ url('/ent/SaveEntExamination') }}">Submit
                                </button>
                                <button type="submit" class="btn btn-lg btn-primary waves-effect" formaction="{{ url('/ent/SaveViewEntExamination') }}">Submit & View 
                                </button>
                                
                                      
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
                                        <button type="submit" formaction="{{ url('Send_emailent') }}" name="Send_email" class="btn form-inline" value="Send_email">
                                            <i class="fa fa-plus"></i> Send Mail
                                        </button>
                                        </div>
                                    </div>
<!------------------------------end-email------------------------------->   
<!------------------------------image-upload---------------------------------->     
                                   <div class="col-md-12 ">
                                        <div class="col-md-3 col-md-offset-2 ">
                                        <div class="form-group labelgrp">
                                        <label>Upload Case Paper Image</label>
                                        </div>
                                        </div>
                                        <div class="col-md-3">
                                       
                                        {{ Form::file('reportImage', Request::old('reportImage'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
                                     
                                        </div>
                                        <div class="col-md-1">
                                            <button type="submit" name="submit_reportImage" class="btn" value="submit_reportImage" formaction="{{ url('/ent/SaveEntExamination') }}"><i class="fa fa-plus"></i> Add
                                        </button>&nbsp; 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="col-md-6 col-md-offset-3">
                                    @foreach ($report_image as $rptImg)
                                    @if(isset($rptImg) && $rptImg != null && isset($rptImg->filePath))
                                         <div href="#" class="list-group-item clearfix">
                                            <span>
                                               <button formaction="{{ url('/ent/SaveEntExamination') }}" type="submit" class="btn btn-warning pull-right" value="{{$rptImg->id}}" name="delete_reportImage" >Delete</button>
                                            </span>
                                            <div class="d-flex w-100 justify-content-between">
                                                @if(isset($rptImg->filePath) && $rptImg->filePath != null)
                                                   <h5 class="mb-1"> <a  href="{{ url('/printEntReportFiles') . '/' . $rptImg->id }}" class="" target="_blank"> {{ $loop->iteration }} ..Report document </a> </h5>
                                                @endif
                                            </div>
                                        </div>
                                    @endif                    
                                @endforeach
                                </div>
                                    </div>
<!------------------------------end-image------------------------------->  

                                   <div class="col-md-12 "> 
                                        <div class="col-md-8 col-md-offset-4">
                                        
                                        <a class="btn btn-default btn-lg" href="{{ url('/ViewEntReportFiles/').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> View Report Files  
											
                                        </a>
										<button type="submit" name="Submit_emailent" formaction="{{ url('Send_emailent') }}" class="btn btn-primary btn-lg" value="Submit_emailent"><i class="fa fa-plus"></i> Submit & Email
                                  </button>&nbsp;
                                        </div>
                                    </div> 
<!-------------------------end-------------------------------------------->             
                        </div>
                        </div>
                    </form>
                 </div>
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

    
    var leftear = new DrawingBoard.Board('leftear_canvas', $.extend( {}, defaultOptions, {background: '/images/left_ear.JPEG'}));
    var rightear = new DrawingBoard.Board('rightear_canvas', $.extend( {}, defaultOptions, {background: '/images/right_ear.JPG'}));
    var nose = new DrawingBoard.Board('nose_canvas', $.extend( {}, defaultOptions, {background: '/images/nose.JPG'}));
    var neck = new DrawingBoard.Board('neck_canvas', $.extend( {}, defaultOptions, {background: '/images/shoulder.JPG'}));  
    var throat = new DrawingBoard.Board('throat_canvas', $.extend( {}, defaultOptions, {background: '/images/shoulder.JPG'}));
   





$(document).ready(function() {
$("#ear1_chk").on("click", function(){
    if(ear1_chk.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
       // alert("Checkbox is unchecked."+checked);
    }


    var data=$("#entform").serialize();
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


    var data=$("#entform").serialize();
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

   $("#nose_chk").on("click", function(){
    if(nose_chk.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#entform").serialize();
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

   $("#neck_chk").on("click", function(){
    if(neck_chk.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#entform").serialize();
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

   ////////////throat////////////////////////////

   $("#throat_chk").on("click", function(){
    if(throat_chk.checked) {
        var checked = 1;
        //alert("Checkbox is checked."+checked);
    } else {
        var checked = 0;
        //alert("Checkbox is unchecked."+checked);
    }


    var data=$("#entform").serialize();
     var caseid=$("#caseid").val();
     var url="{{ url('throat') }}/"+checked+"/"+caseid;
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
    var data=$("#entform").serialize();
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
    var case_number=$("#case_number").val();
    //alert(case_number);
     var url="{{ url('bloodinvestigation1') }}/"+uv_chkval+"/"+pre_chkval+"/"+caseid;
    // alert(url);

      $.ajax({
            url:url,
            method:'post',
            data:{uv_chkval:uv_chkval,pre_chkval:pre_chkval,caseid:caseid,case_number:case_number},
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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+complaintcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ENT"><input class="form-control"  type="hidden"  name="fieldName" value="complaint"><input class="form-control"  type="text" id="optionsval'+complaintcnt+'" placeholder="value'+complaintcnt+'" name="optionsval[]"></div><span class="input-group-addon complaintremoveButton" type="button" id="complaintremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+findingcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ENT"><input class="form-control"  type="hidden"  name="fieldName" value="finding"><input class="form-control"  type="text" id="optionsval'+findingcnt+'" placeholder="value'+findingcnt+'" name="optionsval[]"></div><span class="input-group-addon findingremoveButton" type="button" id="findingremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+diagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ENT"><input class="form-control"  type="hidden"  name="fieldName" value="diagnosis"><input class="form-control"  type="text" id="optionsval'+diagnosiscnt+'" placeholder="value'+diagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon diagnosisremoveButton" type="button" id="diagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+treatment_advicecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ENT"><input class="form-control"  type="hidden"  name="fieldName" value="treatment_advice"><input class="form-control"  type="text" id="optionsval'+treatment_advicecnt+'" placeholder="value'+treatment_advicecnt+'" name="optionsval[]"></div><span class="input-group-addon treatment_adviceremoveButton" type="button" id="treatment_adviceremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+life_style_chengercnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ENT"><input class="form-control"  type="hidden" name="fieldName" value="life_style_chenger"><input class="form-control"  type="text" id="optionsval'+life_style_chengercnt+'" placeholder="value'+life_style_chengercnt+'" name="optionsval[]"></div><span class="input-group-addon life_style_chengerremoveButton" type="button" id="life_style_chengerremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

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
 var data=$("#entform").serialize();
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
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Complaint", text: "Added Successfully!", type: "success"},
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
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Finding", text: "Added Successfully!", type: "success"},
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
 var data=$("#entform").serialize();
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
 var data=$("#entform").serialize();
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
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Life Style Changer", text: "Added Successfully!", type: "success"},
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
                    url: "{{ url('/entform/deleteImage') }}",
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

        $("#entform").on("submit", function () {
            
            var ImgData_leftear = leftear.getImg();
            ImgData_leftear = (leftear.history.initialItem == ImgData_leftear) ? '' : ImgData_leftear;
            $("#leftear").val(ImgData_leftear);

            var ImgData_rightear = rightear .getImg();
            ImgData_rightear = (rightear.history.initialItem == ImgData_rightear) ? '' : ImgData_rightear;
            $("#rightear").val(ImgData_rightear);

            var ImgData_nose = nose.getImg();
            ImgData_nose = (nose.history.initialItem == ImgData_nose) ? '' : ImgData_nose;
            $("#nose").val(ImgData_nose);

            var ImgData_neck = neck.getImg();
            ImgData_neck = (neck.history.initialItem == ImgData_neck) ? '' : ImgData_neck;
            $("#neck").val(ImgData_neck);

           var ImgData_throat = throat.getImg();
            ImgData_throat = (throat.history.initialItem == ImgData_throat) ? '' : ImgData_throat;
            $("#throat").val(ImgData_throat);

           
            leftear.clearWebStorage();
            rightear.clearWebStorage();
            nose.clearWebStorage();
            neck.clearWebStorage();
            throat.clearWebStorage();

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