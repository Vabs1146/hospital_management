@extends('adminlayouts.master')
@section('style')
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
 
 
@endsection

@section('content')

<div class="container-fluid">
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         
<div class="card">

<div class="header bg-pink">
<h2>
SeenBy View
</h2>
</div>
    <div class="body">
     <div class="row clearfix">
         <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
             <div class="panel-group" id="accordion_9" role="tablist" aria-multiselectable="true">
                 <div class="panel panel-col-pink">
                    <div class="panel-heading" role="tab" id="headingOne_9">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion_9" href="#collapseOne_9" aria-expanded="true" aria-controls="collapseOne_9">
                            <center>S/B. DR. {{ empty($patientRegister->consultant_doctor)?"--": strtoupper($doctorlist[$patientRegister->consultant_doctor]) }}, MD,DGO
							</center>
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">

<div class="panel-body">
    <div class="row clearfix">
      
      <div class="panel-body" >
    <div class="row clearfix ">
        <div class="row">
    <div class="col-md-12">
    <div class="col-sm-2"><label class="control-label">Date :</label></div>
    <div class="col-sm-2"><u>{{Carbon\Carbon::now()->format('d-M-Y')}}</u></div>
   <!--  <div class="col-sm-2"><label class="control-lable"></label></div> -->
    <!-- <div class="col-sm-2"> <u></u> </div> -->

    <div class="col-sm-2"><label class="control-label">Time :</label></div>
    <div class="col-sm-2"><u>{{Carbon\Carbon::now()->format('h:i a')}}</u></div>
<!--     <div class="col-sm-2"><label class="control-lable"></label></div>
 -->    <!-- <div class="col-sm-2"> <u></u> </div> -->


    <div class="col-sm-2"><label class="control-label">Age :</label></div>
    <div class="col-sm-2"><u>{{$patientRegister->age}}</u></div>
</div>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="col-sm-2"><label class="control-label">Past History :</label></div>
    <div class="col-sm-2"><u>{{$patientRegister->past_history}}</u></div>
    <div class="col-sm-2"><label class="control-label">Family History :</label></div>
    <div class="col-sm-2"><u>{{$patientRegister->family_history}}</u></div>


    <div class="col-sm-2"><label class="control-label">OBSTERIC HISTORY :</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["obstetric_history"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["obstetric_history"])->first()->field_data}}</u></div>
</div>
</div>

<div class="row">
   <div class="col-md-12">
    
        <div class="col-sm-3"><label class="control-label">LMP :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["LMP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LMP"])->first()->field_data}}</u></div>
        <div class="col-sm-3"><label class="control-label">GRAVIDA :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["GRAVIDA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["GRAVIDA"])->first()->field_data}}</u></div>
    
        <div class="col-sm-3"><label class="control-label">EDD :</label></div>
        <div class="col-sm-3"><u>{{$form_field_values->where('form_field_code', $field_name_id["EDD"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["EDD"])->first()->field_data}}</u></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">PARA :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["PARA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PARA"])->first()->field_data}}</u></div>
  
        <div class="col-sm-2"><label class="control-label">MTP :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["MTP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MTP"])->first()->field_data}}</u></div>
        <div class="col-sm-2"><label class="control-label">ABORTION :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["ABORTION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ABORTION"])->first()->field_data}}</u></div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
    <div class="col-sm-2 text-nowrap"><label class="control-label">PHYSICAL EXAMINATION :</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->first()->field_data}}</u></div>


        <div class="col-sm-2"><label class="control-label">Vital Parameter :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->first()->field_data}}</u></div>

          <div class="col-sm-2"><label class="control-label">Pulse :</label></div>
        <div class="col-sm-2">{{$form_field_values->where('form_field_code', $field_name_id["pulse"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pulse"])->first()->field_data}}</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    
        <div class="col-sm-2"><label class="control-label">BP :</label></div>
            <div class="col-sm-2">{{$form_field_values->where('form_field_code', $field_name_id["BP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BP"])->first()->field_data}}</div>
        <div class="col-sm-2"><label class="control-label">Respiratory Rate :</label></div>
            <div class="col-sm-2">{{$form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->first()->field_data}}</div>

                <div class="col-sm-2"><label class="control-label">General Examination :</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["general examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["general examination"])->first()->field_data}}</u></div>


    </div>
</div>


<div class="row">
<div class="col-md-12">
       
            <div class="col-sm-2"><label class="control-label">PALLOR :</label></div>
            <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["pallor"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pallor"])->first()->field_data}}</u></div>

            <div class="col-sm-2"><label class="control-label">ICTERUS :</label></div>
            <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["icterus"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["icterus"])->first()->field_data}}</u></div>

            <div class="col-sm-2"><label class="control-label">RASH :</label></div>
            <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["rash"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rash"])->first()->field_data}}</u></div>

</div>
</div>
       
      
 
<div class="row">
    
    <div class="col-md-12">
         <div class="col-sm-2"><label class="control-label">CYANOSIS :</label></div>
            <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cyanosis"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cyanosis"])->first()->field_data}}</u></div>

        <div class="col-sm-2"><label class="control-label">ENT :</label></div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["ent"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ent"])->first()->field_data}}</u>
        </div>

        <div class="col-sm-2"><label class="control-label">LYMHADENOPATHY :</label></div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->first()->field_data}}</u>
        </div>

       
    </div>
</div>


<div class="row">
  <div class="col-md-12">

        <div class="col-sm-2"><label class="control-label">EDEMA FEET :</label></div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["edema_feet"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["edema_feet"])->first()->field_data}}</u>
        </div>

        <div class="col-sm-2"><label class="control-label">OTHERS :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["others"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["others"])->first()->field_data}}</u></div>

        <div class="col-sm-2 text-nowrap"><label class="control-label">SYSTEMIC EXAMINATION :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["systemic examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemic examination"])->first()->field_data}}</u></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="col-sm-2 text-nowrap"><label class="control-label">RESPIRATORY SYSTEM : AIR ENTRY :</label></div>
    <div class="col-sm-2 text-nowrap"><u>{{$form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->first()->field_data}}</u>
    </div>

     <div class="col-sm-2 text-nowrap"><label class="control-label">FOREIGN SOUNDS : CREPTS/WHEEZING/BRONCHIAL BREATHING/PLEURAL RUB</label></div>
     <div class="col-sm-4"><u>{{$form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->first()->field_data}}</u></div>
</div>
</div>



<div class="row">
    <div class="col-md-12">
    <div class="col-sm-2 text-nowrap"><label class="control-label">CARDIOVASCULAR SYSTEM : HEART SOUNDS :</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound"])->first()->field_data}}</u></div>

    <div class="col-sm-2"><label class="control-label">S1</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->first()->field_data}}</u></div>

    <div class="col-sm-2"><label class="control-label">S2</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->first()->field_data}}</u></div>

</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">CARDIAC MURMUR</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->first()->field_data}}</u></div>
         
        <div class="col-sm-2 text-nowrap"><label class="control-label">CNETRAL NERVOUS SYSTEMIC :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->first()->field_data}}</u></div>

        <div class="col-sm-2 text-nowrap"><label class="control-label">ABDOMINAL SYSTEM : SHAPE OF ABDOMEN :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->first()->field_data}}</u></div>

    </div>
</div>


<div class="row">
    <div class="col-md-12">
    
        <div class="col-sm-2"><label class="control-label">ORGANOMEGALY :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["organomegaly"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["organomegaly"])->first()->field_data}}</u></div>
        
        <div class="col-sm-2 text-nowrap"><label class="control-label">FREE FLUID IN ABDOMEN :</label></div>
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->first()->field_data}}</u></div>

        <div class="col-sm-2"><label class="control-label">TENDERNESS :</label></div>
        <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["tenderness"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["tenderness"])->first()->field_data}}</u>
       </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="col-sm-2"><label class="control-label">GUARDING :</label></div>
    <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["guarding"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["guarding"])->first()->field_data}}</u>
    </div>
    <div class="col-sm-2"><label class="control-label">RIGIDITY :</label></div>
    <div class="col-sm-2">
            <u>{{$form_field_values->where('form_field_code', $field_name_id["rigidity"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rigidity"])->first()->field_data}}</u>
    </div>

    <div class="col-sm-2 text-nowrap"><label class="control-label">FAETAL HEART SOUNDS (FHS) :</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["faetal_heart_sound"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["faetal_heart_sound"])->first()->field_data}}</u></div>

</div>
</div>


<div class="row">
    <div class="col-md-12">
    <div class="col-sm-4 text-nowrap"><label class="control-label">PRE VAGINAL EXAMINATION (PV) :</label></div>
    <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["pre_vaginal_examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pre_vaginal_examination"])->first()->field_data}}</u></div>
    
    <div class="col-sm-4">
        <b><label class="control-label">INFORMED CONSENT / INFORMED REJECTED CONSENT :</label></b>
    </div>
    <div class="col-sm-2">
        <u>{{$form_field_values->where('form_field_code', $field_name_id["informed_consent_rejected_consented"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["informed_consent_rejected_consented"])->first()->field_data}}</u>
    </div>

</div>
</div>


<br/>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="col-sm-2">Doctor's Signature</div>
        <div class="col-sm-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    
    
        <div class="col-sm-2">PARENT'S/RELATIVE'S SIGNATURE</div>
        <div class="col-sm-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    </div>
</div>                   

  
<!-----------button-----------------------> 
<div class="row clearfix">
<div class="col-md-4 col-md-offset-4">
<div class="form-group">
    <a class="btn btn-info btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
    <a class="btn btn-info btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i> print</a>
    <a class="btn btn-info btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id.'/'.$patientRegister->id .'/edit' }}"><i class="glyphicon glyphicon-chevron-left"></i> Edit</a>
</div>
</div>
</div>
   
 <!----------end-button----------------------->  

              
    </div>
  
</div>
</div>
</div>
</div>

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


