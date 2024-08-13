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
<div class="container">
           <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
        @if($case_master['id'] == $VisitListDateWise['id'])
        <a href="{{ url('/Skin').'/'.$VisitListDateWise['id'] }}"
            class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a>
        <span> &nbsp;</span>
        @else
        <a href="{{ url('/Skin').'/'.$VisitListDateWise['id'] }}"
            class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a>
        <span> &nbsp;</span>
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
                    <form action="{{ url('/Skin'.( isset($case_master) ? "/" . $case_master['id'] : "/0")) }}" method="POST" class="form-horizontal" enctype='multipart/form-data' id="skin">
                    {{ csrf_field() }}

                    @if (isset($case_master))
                    <input type="hidden" name="_method" value="PATCH">
                    @endif

                    <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}">
					<input type="hidden" id="case_number" name="case_number" value="{{ $case_master['case_number'] or ''}}" >
                    
                    <input type="hidden" id="patient_emailId" name="patient_emailId" value="{{ $case_master['patient_emailId'] or ''}}" >
						
                    <div class="card">
                        <div class="header bg-pink">
                            <h2>
                                Add/Edit Patient Skin details
                            </h2>
                          
                        </div>
                        
                        <div class="body">
                              <div class="row clearfix">
                              <div id="skinsym" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Symptom :</label>
                              <input type="hidden" id="SkinSym[]" name="SkinSym[]" class="hiddenCounter" value="1" /> 
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['Symptom'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Symptom')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Symptom'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinSymTemplate" class="btn addmore btn-default" value="Addmore"> Add
                              </button>
                              <button type="button" name="add" id='symptomstbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='symptomsbtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SymptomsTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Symptom'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skinduration" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Duration :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['Duration'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Duration')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Duration'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinDurationTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='durationtbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='durationbtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='DurationTextBoxesGroup' class="col-md-12">

                              </div>

                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Duration'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>

                              
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">ODP :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::text('odp', Request::old('odp',$skin->odp), array('class' => 'form-control')) }}
                              </div>

                              <!-- <div class="col-md-4">
                              <button type="button" name="add" id='medicinetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
                              </div> -->
                              </div>
                              <div id="skinotherissue" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Other Issue :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                               {{ Form::select($form_field_master['OtherIssue'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'OtherIssue')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['OtherIssue'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinotherIssueTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinissuebtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinissuebtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinIssueTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['OtherIssue'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skinpasthistory" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Past History :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                               {{ Form::select($form_field_master['PastHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'PastHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['PastHistory'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinPastHistoryTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinpasthistorybtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinpasthistorybtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinPastHistoryTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['PastHistory'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skinpersonal" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Personal History :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                               {{ Form::select($form_field_master['PersonalHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'PersonalHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['PersonalHistory'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinPersonalHistoryTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinpersonalhistorybtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinpersonalhistorybtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinPersonalHistoryTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['PersonalHistory'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skinmed" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">   Medical History :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['MedicalHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'MedicalHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['MedicalHistory'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinMedicalHistoryTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinmedicalhistorybtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinmedicalhistorybtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinMedicalHistoryTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['MedicalHistory'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skinfam" class="ContainerToAppend">   
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Family History :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['FamilyHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'FamilyHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['FamilyHistory'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinFamilyHistoryTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinfamilybtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinfamilybtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinFamilyHistoryTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                 @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['FamilyHistory'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skinexm" class="ContainerToAppend"> 
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Examination :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                                {{ Form::select($form_field_master['Examination'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Examination')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Examination'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinExaminationTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinexambtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinexambtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinExaminationTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Examination'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Palm / Sole :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div  class="form-group">
                              <div class="form-line">
                                {{ Form::text('PalmSole', Request::old('PalmSole',$skin->PalmSole), array('class' => 'form-control')) }}
                              </div> 
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Genital Area :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div  class="form-group">
                              <div class="form-line">
                              {{ Form::text('GenitalArea', Request::old('GenitalArea',$skin->GenitalArea), array('class' => 'form-control')) }}
                              </div> 
                              </div>
                              </div>

                              <!-- <div class="col-md-4">
                              <button type="button" name="add" id='medicinetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
                              </div> -->
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Oral Mucosa :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div  class="form-group">
                              <div class="form-line">
                              {{ Form::text('OralMucosa', Request::old('OralMucosa',$skin->OralMucosa), array('class' => 'form-control')) }}
                              </div> 
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Nails :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div  class="form-group">
                              <div class="form-line">
                              {{ Form::text('Nails', Request::old('Nails',$skin->Nails), array('class' => 'form-control')) }}
                              </div> 
                              </div>
                              </div>

                              <!-- <div class="col-md-4">
                              <button type="button" name="add" id='medicinetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
                              </div> -->
                              </div>
                              <div id="skininvest" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Investigation :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['Investigation'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Investigation')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Investigation'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinInvestigationTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skininvestigationbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skininvestigationbtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinInvestigationTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                 @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Investigation'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>

                              <div id="skinprocedure" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Procedure :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['Procedure'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Procedure')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Procedure'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinProcedureTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinprocedurebtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinprocedurebtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div>
                              <div id='SkinProcedureTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                 @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Procedure'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>

                              <div id="skinconsent" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Consent :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['Consent'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Consent')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Consent'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinConsentTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skinconsentbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skinconsentbtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div> 
                              <div id='SkinConsentTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                 @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Consent'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                              <div id="skindiagnosis" class="ContainerToAppend">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">  Diagnosis :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select($form_field_master['Diagnosis'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Diagnosis')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Diagnosis'],$skin->Symptom), array('class'=> 'form-control select2')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" data-templateDiv="SkinDiagnosisTemplate" class="btn addmore btn-default" value="Addmore"><i class="fa fa-plus"></i> Add
                              </button>
                              <button type="button" name="add" id='skindiagnosisbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='skindiagnosisbtnsave'>Save Option</button>
                              </div>
                              </div>
                              </div> 
                              <div id='SkinDiagnosisTextBoxesGroup' class="col-md-12">

                              </div>
                              <div class="dbMultiEntryContainer">
                                  @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Diagnosis'])->all() as $item)
                                  <div class="col-md-12">
                                      <div class="col-md-2">
                                      </div>

                                      <div class="col-md-6">
                                         <input type="text" class="form-control" readonly value="{{$item->valueData}}">
                                      
                                      </div>

                                      <div class="col-md-4">
                                      <button type="button" class="btn deleteDbRecord btn-default" value="{{$item->id}}"><i class="fa fa-minus"></i> Delete
                                      </button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Special Comment :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                               {{ Form::textarea('SpecialComment', Request::old('SpecialComment',$skin->SpecialComment), array('class' => 'form-control')) }}
                              </div>

                              <!-- <div class="col-md-4">
                              <button type="button" name="add" id='medicinetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
                              </div> -->
                              </div>
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Before Image :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::file('BeforeImage', Request::old('BeforeImage'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }} 
                              </div> 
                              </div>
                              </div>
                              </div>
                              <div class="col-md-12 img">
                                @if (!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath))   
                                <div class="col-md-1">
                                  
                                </div>
                                <div class="col-md-6">
                                    <center id="BeforeImage"> 
                                        <img src={{ Storage::disk('local')->url($skin->BeforeImagePath)."?".filemtime(Storage::path($skin->BeforeImagePath)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                                    </center>
                                    <div class="text-center" style="margin-top: 10px">
                                    <button type="button" value="BeforeImage" class="ImageDelete" >Delete</button>
                                  </div>
                                
                              </div>
                              @endif
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">After Image :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::file('AfterImage', Request::old('AfterImage'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }}
                              </div> 
                              </div>
                              </div>
                              </div>
                              <div class="col-md-12 img">
                                @if (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath))  
                                <div class="col-md-1">
                                  
                                </div>
                                <div class="col-md-6">
                                    <center id="AfterImage"> 
                                        <img src={{ Storage::disk('local')->url($skin->AfterImagePath)."?".filemtime(Storage::path($skin->AfterImagePath)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                                    </center>
                                    <div class="text-center" style="margin-top: 10px">
                                    <button type="button" value="AfterImage" class="ImageDelete" >Delete</button>
                                  </div>
                                
                              </div>
                              @endif
                              </div>
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('FollowUpDoctor_id','Doctor') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                               {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $doctorlist->toArray(),Request::old('FollowUpDoctor_id'), array('class' => 'form-control select2')) }}
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('FollowUpDate','Follow-Up Date') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('FollowUpDate', Request::old('FollowUpDate',$skin->FollowUpDate), array('class'=> 'form-control datepicker')) }}  
                              </div> 
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('FollowUptimeslot','Follow Up Time Slot') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <select class="form-control select2" id="FollowUpTime" name="FollowUpTime"></select>
                              </div>

                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('casepaper',' Case Paper') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::file('CasePaperUpload', Request::old('CasePaperUpload'), array('class'=> 'form-control', "accept"=> "image/png, image/gif, image/jpeg" )) }} 
                              </div> 
                              </div>
                              </div>
                              <div class="col-md-4">
                                <button type="submit" name="submit_reportImage" class="btn form-inline "
                                    value="submit_reportImage">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                                <a class="btn btn-default "
                                    href="{{ url('/ViewSkinReportFiles/').'/'.$case_master->id }}">
                                    <i class="glyphicon glyphicon-chevron-left"></i> View Report Files
                                </a>

                              </div>
                              </div>
                              <div>
                              @foreach ($report_image as $rptImg)
                              @if(isset($rptImg) && $rptImg != null && isset($rptImg->filePath))
                                <tr>
                                <td></td>
                                <td colspan="2">
                                <div href="#" class="list-group-item clearfix">
                                    <span>
                                        {{ Form::button('Delete', array('class'=> 'btn btn-warning  pull-right', 'Value' => $rptImg->id, 'name' => 'delete_reportImage', 'type'=>'submit')) }}
                                    </span>
                                    <div class="d-flex w-100 justify-content-between">
                                        @if(isset($rptImg->filePath) && $rptImg->filePath != null)
                                        <h5 class="mb-1"> <a  href="{{ url('/printEyeReportFiles') . '/' . $rptImg->id }}" class="" target="_blank"> {{ $loop->iteration }} ..Report document </a> </h5>
                                        @endif
                                    </div>
                                </div>
                                </td>
                                </tr>
                               @endif                    
                               @endforeach
                              </div>
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('sendemail','Send Email') }}
                              </div>
                              </div>


                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Email_To', null, array('class'
                                => 'form-control', 'autocomplete'=>'off')) }}                              
                              </div> 
                              </div>
                              </div>
                              <div class="col-md-4">
                              <button type="submit" name="Send_email" class="btn form-inline " value="Send_email">
                                    <i class="fa fa-plus"></i> Send Mail
                                </button>
                              </div>
                              </div>


                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-2">
                                 <button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                                  </button>&nbsp;
                                  <a class="btn btn-primary btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
                                  <a class="btn btn-primary btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}">
                                    <i class="glyphicon glyphicon-chevron-left"></i> Patient Details </a>&nbsp;
                                  <a class="btn btn-primary btn-lg" href="{{ url('/skin/print').'/'.$case_master->id }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a>&nbsp;
                                  <a class="btn btn-primary btn-lg" href="{{ url('/skin/view').'/'.$case_master->id }}">View
                                  </a>
								 <button type="submit" name="submit_email" class="btn btn-primary btn-lg" value="submit_email"><i class="fa fa-plus"></i> Submit & Email
                                  </button>
                                </div>
                               
                            </div>

                            
                        </div>

     <div id="templateContainner" style="display:none">
      <div id="SkinSymTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinSym[]" name="SkinSym[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                  {{ Form::select($form_field_master['Symptom'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Symptom')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Symptom'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinDurationTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinDur[]" name="SkinDur[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['Duration'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Duration')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Duration'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinotherIssueTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinOIssue[]" name="SkinOIssue[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['OtherIssue'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'OtherIssue')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['OtherIssue'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinPastHistoryTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinPast[]" name="SkinPast[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['PastHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'PastHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['PastHistory'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }} 
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinPersonalHistoryTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinPast[]" name="SkinPast[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['PersonalHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'PersonalHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['PersonalHistory'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinMedicalHistoryTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinMedical[]" name="SkinMedical[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['MedicalHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'MedicalHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['MedicalHistory'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinFamilyHistoryTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinFamily[]" name="SkinFamily[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['FamilyHistory'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'FamilyHistory')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['FamilyHistory'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>
      <div id="SkinExaminationTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinExamination[]" name="SkinExamination[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['Examination'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Examination')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Examination'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinInvestigationTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinInvest[]" name="SkinInvest[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['Investigation'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Investigation')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Investigation'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinProcedureTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinProcedure[]" name="SkinProcedure[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['Procedure'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Procedure')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Procedure'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                    
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinConsentTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinConsent[]" name="SkinMedical[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['Consent'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Consent')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Consent'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>

      <div id="SkinDiagnosisTemplate">
          <div class="col-md-12">
                  <div class="col-md-2">
                      <input type="hidden" id="SkinDiagnosis[]" name="SkinDiagnosis[]" class="hiddenCounter" value="" />
                  </div>
                  <div class="col-md-6">
                    {{ Form::select($form_field_master['Diagnosis'].'[]', array(''=>'--Select--') + $form_dropdowns->where('fieldName', 'Diagnosis')->pluck('ddText','ddText')->toArray(), Request::old($form_field_master['Diagnosis'],$skin->Symptom), array('class'=> 'form-control Dyselect2')) }}
                  </div>
                  
                  <div class="col-md-4">
                      <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                  </div>
          </div>
      </div>


    

                        
                    </div>
                  </form>
                </div>
            </div>


</div>

@endsection

      @section('scripts')
        <script type="text/javascript">

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>

<script src="{{ url('/')}}/select2/js/select2.min.js"></script>

<!-- Set Option for Symptoms -->

 
<script type="text/javascript">
$(document).ready(function(){

    var symcnt = 1;

    $("#symptomstbtn").click(function () {
      
  if(symcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+symcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Symptom"><input class="form-control"  type="text" id="optionsval'+symcnt+'" placeholder="value'+symcnt+'" name="optionsval[]"></div><span class="input-group-addon symptomsremoveButton" type="button" id="symptomsremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SymptomsTextBoxesGroup").append(newTextBoxDiv);
  symcnt++;
     });

$(document).on('click', '.symptomsremoveButton', function(e) {
symcnt--;
   var target = $("#SymptomsTextBoxesGroup").find("#TextBoxDiv" +symcnt);
  $(target).remove();
});
});
</script>


<!-- Set Option For Duration -->
<script type="text/javascript">
$(document).ready(function(){

    var durationcnt = 1;

    $("#durationtbtn").click(function () {
      
  if(durationcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+durationcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Duration"><input class="form-control"  type="text" id="optionsval'+durationcnt+'" placeholder="value'+durationcnt+'" name="optionsval[]"></div><span class="input-group-addon durationremoveButton" type="button" id="durationremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#DurationTextBoxesGroup").append(newTextBoxDiv);
  durationcnt++;
     });

$(document).on('click', '.durationremoveButton', function(e) {
durationcnt--;
   var target = $("#DurationTextBoxesGroup").find("#TextBoxDiv" +durationcnt);
  $(target).remove();
});
});
</script>

<!-- Set Option For Other Issue -->

<script type="text/javascript">
$(document).ready(function(){

    var otherissuecnt = 1;

    $("#skinissuebtn").click(function () {
      
  if(otherissuecnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+otherissuecnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="OtherIssue"><input class="form-control"  type="text" id="optionsval'+otherissuecnt+'" placeholder="value'+otherissuecnt+'" name="optionsval[]"></div><span class="input-group-addon otherissueremoveButton" type="button" id="otherissueremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinIssueTextBoxesGroup").append(newTextBoxDiv);
  otherissuecnt++;
     });

$(document).on('click', '.otherissueremoveButton', function(e) {
otherissuecnt--;
   var target = $("#SkinIssueTextBoxesGroup").find("#TextBoxDiv" +otherissuecnt);
  $(target).remove();
});
});
</script>

<!-- Set Option For Past History-->

<script type="text/javascript">
$(document).ready(function(){

    var skinpasthiscnt = 1;

    $("#skinpasthistorybtn").click(function () {
      
  if(skinpasthiscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinpasthiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="PastHistory"><input class="form-control"  type="text" id="optionsval'+skinpasthiscnt+'" placeholder="value'+skinpasthiscnt+'" name="optionsval[]"></div><span class="input-group-addon skinpasthisremoveButton" type="button" id="skinpasthisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinPastHistoryTextBoxesGroup").append(newTextBoxDiv);
  skinpasthiscnt++;
     });

$(document).on('click', '.skinpasthisremoveButton', function(e) {
skinpasthiscnt--;
   var target = $("#SkinPastHistoryTextBoxesGroup").find("#TextBoxDiv" +skinpasthiscnt);
  $(target).remove();
});
});
</script>

<!-- Set Option For Personal History-->

<script type="text/javascript">
$(document).ready(function(){

    var skinpersonalhiscnt = 1;

    $("#skinpersonalhistorybtn").click(function () {
      
  if(skinpersonalhiscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinpersonalhiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="PersonalHistory"><input class="form-control"  type="text" id="optionsval'+skinpersonalhiscnt+'" placeholder="value'+skinpersonalhiscnt+'" name="optionsval[]"></div><span class="input-group-addon skinpersonalhisremoveButton" type="button" id="skinpersonalhisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinPersonalHistoryTextBoxesGroup").append(newTextBoxDiv);
  skinpersonalhiscnt++;
     });

$(document).on('click', '.skinpersonalhisremoveButton', function(e) {
skinpersonalhiscnt--;
   var target = $("#SkinPersonalHistoryTextBoxesGroup").find("#TextBoxDiv" +skinpersonalhiscnt);
  $(target).remove();
});
});
</script>


<!-- Set Option For Medical  History-->

<script type="text/javascript">
$(document).ready(function(){

    var skinmedicalhiscnt = 1;

    $("#skinmedicalhistorybtn").click(function () {
      
  if(skinmedicalhiscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinmedicalhiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="MedicalHistory"><input class="form-control"  type="text" id="optionsval'+skinmedicalhiscnt+'" placeholder="value'+skinmedicalhiscnt+'" name="optionsval[]"></div><span class="input-group-addon skinmedicalhisremoveButton" type="button" id="skinpersonalhisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinMedicalHistoryTextBoxesGroup").append(newTextBoxDiv);
  skinmedicalhiscnt++;
     });

$(document).on('click', '.skinpersonalhisremoveButton', function(e) {
skinmedicalhiscnt--;
   var target = $("#SkinMedicalHistoryTextBoxesGroup").find("#TextBoxDiv" +skinmedicalhiscnt);
  $(target).remove();
});
});
</script>


<!-- Set Option For Family  History-->

<script type="text/javascript">
$(document).ready(function(){

    var skinfamilyhiscnt = 1;

    $("#skinfamilybtn").click(function () {
      
  if(skinfamilyhiscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinfamilyhiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="FamilyHistory"><input class="form-control"  type="text" id="optionsval'+skinfamilyhiscnt+'" placeholder="value'+skinfamilyhiscnt+'" name="optionsval[]"></div><span class="input-group-addon skinfamhisremoveButton" type="button" id="skinfamhisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinFamilyHistoryTextBoxesGroup").append(newTextBoxDiv);
  skinfamilyhiscnt++;
     });

$(document).on('click', '.skinfamhisremoveButton', function(e) {
skinfamilyhiscnt--;
   var target = $("#SkinFamilyHistoryTextBoxesGroup").find("#TextBoxDiv" +skinfamilyhiscnt);
  $(target).remove();
});
});
</script>



<!-- Set Option For Examination -->

<script type="text/javascript">
$(document).ready(function(){

    var skinexamcnt = 1;

    $("#skinexambtn").click(function () {
      
  if(skinexamcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinexamcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Examination"><input class="form-control"  type="text" id="optionsval'+skinexamcnt+'" placeholder="value'+skinexamcnt+'" name="optionsval[]"></div><span class="input-group-addon skinexamremoveButton" type="button" id="skinexamremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinExaminationTextBoxesGroup").append(newTextBoxDiv);
  skinexamcnt++;
     });

$(document).on('click', '.skinexamremoveButton', function(e) {
skinexamcnt--;
   var target = $("#SkinExaminationTextBoxesGroup").find("#TextBoxDiv" +skinexamcnt);
  $(target).remove();
});
});
</script>

<!-- Set Option For Investigation -->

<script type="text/javascript">
$(document).ready(function(){

    var skininvestcnt = 1;

    $("#skininvestigationbtn").click(function () {
      
  if(skininvestcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skininvestcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Investigation"><input class="form-control"  type="text" id="optionsval'+skininvestcnt+'" placeholder="value'+skininvestcnt+'" name="optionsval[]"></div><span class="input-group-addon skininvestremoveButton" type="button" id="skininvestremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinInvestigationTextBoxesGroup").append(newTextBoxDiv);
  skininvestcnt++;
     });

$(document).on('click', '.skininvestremoveButton', function(e) {
skininvestcnt--;
   var target = $("#SkinInvestigationTextBoxesGroup").find("#TextBoxDiv" +skininvestcnt);
  $(target).remove();
});
});
</script>

<!-- Set Option For Procedure -->

<script type="text/javascript">
$(document).ready(function(){

    var skinprocnt = 1;

    $("#skinprocedurebtn").click(function () {
      
  if(skinprocnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinprocnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Procedure"><input class="form-control"  type="text" id="optionsval'+skinprocnt+'" placeholder="value'+skinprocnt+'" name="optionsval[]"></div><span class="input-group-addon skinproremoveButton" type="button" id="skinproremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinProcedureTextBoxesGroup").append(newTextBoxDiv);
  skinprocnt++;
     });

$(document).on('click', '.skinproremoveButton', function(e) {
skinprocnt--;
   var target = $("#SkinProcedureTextBoxesGroup").find("#TextBoxDiv" +skinprocnt);
  $(target).remove();
});
});
</script>

<!-- Set Option For Consent -->

<script type="text/javascript">
$(document).ready(function(){

    var skinconsentcnt = 1;

    $("#skinconsentbtn").click(function () {
      
  if(skinconsentcnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skinconsentcnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Consent"><input class="form-control"  type="text" id="optionsval'+skinconsentcnt+'" placeholder="value'+skinconsentcnt+'" name="optionsval[]"></div><span class="input-group-addon skinconsentremoveButton" type="button" id="skinconsentremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinConsentTextBoxesGroup").append(newTextBoxDiv);
  skinconsentcnt++;
     });

$(document).on('click', '.skinconsentremoveButton', function(e) {
skinconsentcnt--;
   var target = $("#SkinConsentTextBoxesGroup").find("#TextBoxDiv" +skinconsentcnt);
  $(target).remove();
});
});
</script>


<!-- Set Option For Diagnosis -->

<script type="text/javascript">
$(document).ready(function(){

    var skindiagnosiscnt = 1;

    $("#skindiagnosisbtn").click(function () {
      
  if(skindiagnosiscnt>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+skindiagnosiscnt+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="skinOpd"><input class="form-control"  type="hidden"  name="fieldName" value="Diagnosis"><input class="form-control"  type="text" id="optionsval'+skindiagnosiscnt+'" placeholder="value'+skindiagnosiscnt+'" name="optionsval[]"></div><span class="input-group-addon skindiagnosisremoveButton" type="button" id="skindiagnosisremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#SkinDiagnosisTextBoxesGroup").append(newTextBoxDiv);
  skindiagnosiscnt++;
     });

$(document).on('click', '.skindiagnosisremoveButton', function(e) {
skindiagnosiscnt--;
   var target = $("#SkinDiagnosisTextBoxesGroup").find("#TextBoxDiv" +skindiagnosiscnt);
  $(target).remove();
});
});
</script>
<!-- Insert Option in DB -->
<script type="text/javascript">
  

  function isEmpty( el ){
      return !$.trim(el.html())
  }
// Insert Option of Symptoms In DB
      $("#symptomsbtnsave").click(function () {
        if (isEmpty($('#SymptomsTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Symptom", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

      // Insert Option For Duration
      $("#durationbtnsave").click(function () {
        if (isEmpty($('#DurationTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Duration", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

      // Insert Option For Other Issue
      $("#skinissuebtnsave").click(function () {
        if (isEmpty($('#SkinIssueTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Other Issue", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

       // Insert Option For Past History 
      $("#skinpasthistorybtnsave").click(function () {
        if (isEmpty($('#SkinPastHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Past History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


       // Insert Option For Personal History 
      $("#skinpersonalhistorybtnsave").click(function () {
        if (isEmpty($('#SkinPersonalHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Personal History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

        // Insert Option For Medical History 
      $("#skinmedicalhistorybtnsave").click(function () {
        if (isEmpty($('#SkinMedicalHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Medical History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

      // Insert Option For Family History 
      $("#skinfamilybtnsave").click(function () {
        if (isEmpty($('#SkinFamilyHistoryTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Family History", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


      // Insert Option For Examination
      $("#skinexambtnsave").click(function () {
        if (isEmpty($('#SkinExaminationTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Examination", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


         // Insert Option For Investigation
      $("#skininvestigationbtnsave").click(function () {
        if (isEmpty($('#SkinInvestigationTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Investigation ", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


         // Insert Option For Procedure
      $("#skinprocedurebtnsave").click(function () {
        if (isEmpty($('#SkinProcedureTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Procedure ", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


      // Insert Option For Consent 
      $("#skinconsentbtnsave").click(function () {
        if (isEmpty($('#SkinConsentTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Consent  ", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


       // Insert Option For Diagnosis  
      $("#skindiagnosisbtnsave").click(function () {
        if (isEmpty($('#SkinDiagnosisTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#skin").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("skin-field.insert") }}',
            method:'PATCH',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Diagnosis ", text: "Added Successfully!", type: "success"},
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
     $('.select2').select2();
 
        
         $("#FollowUpDate").on('change.dp', function (e) {
               //alert("hii");
            // $(this).datepicker('hide');
            
        
        $("#FollowUpTime").empty();
        //alert(this.value);         //Date in full format alert(new Date(this.value));
        var inputDate = new Date(this.value);
        var FollowUpDoctor_id = $("#FollowUpDoctor_id").val();
       

        var appointment_dt = $('#FollowUpDate').val();
       
        
        var url1="{{url('avaibaletimeslotscasemaster')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
        //alert(url1);
    

        $.ajax({
            url:url1,
           
            type:'GET',
            success:function(response) {
        
             if(response==0)
                 {
                    $('<option value="0">No Slots Available</option>').appendTo($("#FollowUpTime"));
                 }

                    else
                 {
                 
                        for(var i=0;i<response['timeslot1'].length;i++){
                  
                     var starttime= response['timeslot1'][i];
                    
                  
                     var toAppend = '<option value="'+starttime+'">'+starttime+'</option>';
                      $('#FollowUpTime').append(toAppend);
                  
                  
               

                
               
            }
   

                 }
              }
        }); 



    });

         $('button.addmore').click(function(e){
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
            // $("#surgeryDetails").find('#patient_name').val('');
            $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
            // .each(function(index,ele){
            //     $(ele).select2({width: '80%'});
            // });
        });

        
         $('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });

        $(document).on('click', '.DeleteAppended', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });

        $(".deleteDbRecord").click(function(e){
     var ClickedButton = $(this);
    var containerDiv = $(this).closest('.dbMultiEntryContainer');
    var url="{{ url('/skinmultiselect') }}/"+ $(ClickedButton).val();
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
                    data: {_method: 'delete', 
                           _token :$("input[name='_token'][type='hidden']").val(),
                           id : $(ClickedButton).val()
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

        // $(".deleteDbRecord").click(function(e){
        //     e.preventDefault();
        //     if(confirm('You really want to delete this record?')) {
        //        var ClickedButton = $(this);
        //       var url="{{ url('/skinmultiselect') }}/"+ $(ClickedButton).val();
        //       alert(url);
        //        var containerDiv = $(this).closest('div.form-group.row');
        //        $(ClickedButton).button('loading');

        //        $.ajax({ 
        //             url: url, 
        //             type: 'DELETE',
        //             data: {_method: 'delete', 
        //                    _token :$("input[name='_token'][type='hidden']").val(),
        //                    id : $(ClickedButton).val()
        //                   }
        //             })
        //         .success(function() {
        //             $(containerDiv).remove();
        //             $(ClickedButton).button('reset');
        //         }).error(function(){
        //             $(ClickedButton).button('reset');
        //         });
        //     }
        // });

        $(".ImageDelete").on('click',function(){
            var deleteBtn = $(this);
            $(deleteBtn).button('loading');
            var  postData = {
                        'case_id': $("input[type='hidden'][name='case_id']").val(),
                        'imageName': deleteBtn.val(),//
                        '_token': $("input[type='hidden'][name='_token']").val()
                    };
            $.ajax({
                    url: "{{ url('/skinBeforeAfterimage/delete') }}",
                    type:'POST',
                    //dataType: "json",
                    data: postData,
                    success: function(data) {
                        // deleteBtn.closest('div.col-md-6').find('img').attr('src', '');
                        deleteBtn.closest('.img').remove();
                        $(deleteBtn).button('reset');
                    },
                    error: function(data){
                        $(deleteBtn).button('reset');
                    },
                    done: function(e){
                        $(deleteBtn).button('reset');
                    }
                });
            return false;
        });

    });
</script>
@endsection
  
  