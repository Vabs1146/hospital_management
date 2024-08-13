@extends('layouts/app')

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

    .canvas {
        position: relative;
        width: 150px;
        height: 200px;
        background-color: #7a7a7a;
        margin: 70px auto 20px auto;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
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
        width: 100%;
        height: 100%;
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
</style>


@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">IPD Seen By MD DCH LLB</h1>
    </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        IPD Seen By MD DCH LLB
    </div>
    <div class="panel-body">
        <div class="container-fluid">
            <form action="{{ url('/dynamicForm/'.$form_master->id.'/'.$patientRegister->id.'') }}" method="POST" class="form-horizontal" id="form_{{$patientRegister->id}}"
                enctype='multipart/form-data'>

                {{ csrf_field() }}

                <div class="form-group">
                    @include('shared.error')
                    @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                    @endif
                </div>
                {{ Form::hidden('register_id', $patientRegister->id ) }}
                
                <div class="form-group">
                    {{ Form::label('presenting_complaint','Presenting Complaint') }} 
                    {{ Form::text('presenting_complaint', Request::old('presenting_complaint',$patientRegister->presenting_complaint), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('past_history','PAST HISTORY - convulsion/asthma/recurrent illness/') }} 
                    {{ Form::text('past_history', Request::old('past_history',$patientRegister->past_history), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["BIRTH HISTORY"].']','BIRTH HISTORY full term/pretrem/IUGR/LSCS/birth asphexia/jaundice/convulsion/hospitalization') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["BIRTH HISTORY"].']', $form_field_values->where('form_field_code', $field_name_id["BIRTH HISTORY"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BIRTH HISTORY"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["PHYSICAL EXAMINATION"].']','PHYSICAL EXAMINATION - General examination') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["PHYSICAL EXAMINATION"].']', $form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PHYSICAL EXAMINATION"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["CONSCIOUSNESS"].']','CONSCIOUSNESS') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["CONSCIOUSNESS"].']', $form_field_values->where('form_field_code', $field_name_id["CONSCIOUSNESS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["CONSCIOUSNESS"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["Vital Parameter"].']','Vital Parameter') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["Vital Parameter"].']', $form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["OXYGEN SATURATION"].']','OXYGEN SATURATION') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["OXYGEN SATURATION"].']', $form_field_values->where('form_field_code', $field_name_id["OXYGEN SATURATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["OXYGEN SATURATION"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["HEART RATE"].']','HEART RATE') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["HEART RATE"].']', $form_field_values->where('form_field_code', $field_name_id["HEART RATE"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["HEART RATE"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["PULSE"].']','PULSE RATE') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["PULSE"].']', $form_field_values->where('form_field_code', $field_name_id["PULSE"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PULSE"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["PERIPHERAL PULSATION"].']','PERIPHERAL PULSATION') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["PERIPHERAL PULSATION"].']', $form_field_values->where('form_field_code', $field_name_id["PERIPHERAL PULSATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PERIPHERAL PULSATION"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["respiratory rate"].']','RESPIRATORY RATE') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["respiratory rate"].']', $form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory rate"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["BLOOD PRESSURE"].']','BLOOD PRESSURE') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["BLOOD PRESSURE"].']', $form_field_values->where('form_field_code', $field_name_id["BLOOD PRESSURE"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BLOOD PRESSURE"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["CAPILLARI REFILLING"].']','CAPILLARI REFILLING') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["CAPILLARI REFILLING"].']', $form_field_values->where('form_field_code', $field_name_id["CAPILLARI REFILLING"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["CAPILLARI REFILLING"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["TEMPURATURE"].']','TEMPURATURE') }}
                    {{ Form::text('field_data_singular['.$field_name_id["TEMPURATURE"].']', $form_field_values->where('form_field_code', $field_name_id["TEMPURATURE"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TEMPURATURE"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["NEONATE CRY"].']','NEONATE CRY') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["NEONATE CRY"].']', $form_field_values->where('form_field_code', $field_name_id["NEONATE CRY"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["NEONATE CRY"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["ACTIVITY"].']','ACTIVITY') }}
                    {{ Form::text('field_data_singular['.$field_name_id["ACTIVITY"].']', $form_field_values->where('form_field_code', $field_name_id["ACTIVITY"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ACTIVITY"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["REFLEXES"].']','REFLEXES') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["REFLEXES"].']', $form_field_values->where('form_field_code', $field_name_id["REFLEXES"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["REFLEXES"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["COLOUR"].']','COLOUR') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["COLOUR"].']', $form_field_values->where('form_field_code', $field_name_id["COLOUR"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["COLOUR"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["OBVIOUS CONG ANAMOLY"].']','OBVIOUS CONG ANAMOLY') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["OBVIOUS CONG ANAMOLY"].']', $form_field_values->where('form_field_code', $field_name_id["OBVIOUS CONG ANAMOLY"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["OBVIOUS CONG ANAMOLY"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["DEHYDRATION"].']','DEHYDRATION') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["DEHYDRATION"].']', $form_field_values->where('form_field_code', $field_name_id["DEHYDRATION"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DEHYDRATION"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["pallor"].']','PALLOR') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["pallor"].']', $form_field_values->where('form_field_code', $field_name_id["pallor"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["pallor"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["icterus"].']','ICTERUS') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["icterus"].']', $form_field_values->where('form_field_code', $field_name_id["icterus"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["icterus"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["cyanosis"].']','cyanosis') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["cyanosis"].']', $form_field_values->where('form_field_code', $field_name_id["cyanosis"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cyanosis"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["rash"].']','rash') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["rash"].']', $form_field_values->where('form_field_code', $field_name_id["rash"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rash"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["SCLEREMA"].']','SCLEREMA') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["SCLEREMA"].']', $form_field_values->where('form_field_code', $field_name_id["SCLEREMA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["SCLEREMA"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["ent"].']','ent') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["ent"].']', $form_field_values->where('form_field_code', $field_name_id["ent"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ent"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["lymhadenopathy"].']','lymhadenopathy') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["lymhadenopathy"].']', $form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["lymhadenopathy"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["edema_feet"].']','edema_feet') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["edema_feet"].']', $form_field_values->where('form_field_code', $field_name_id["edema_feet"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["edema_feet"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["systemic examination"].']','systemic examination') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["systemic examination"].']', $form_field_values->where('form_field_code', $field_name_id["systemic examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemic examination"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["RESPIRATORY SYSTEM"].']','RESPIRATORY SYSTEM') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["RESPIRATORY SYSTEM"].']', $form_field_values->where('form_field_code', $field_name_id["RESPIRATORY SYSTEM"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["RESPIRATORY SYSTEM"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["respiratory_system_air_entry"].']','AIR ENTRY') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["respiratory_system_air_entry"].']', $form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["respiratory_system_air_entry"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["foreign_sounds_pleural_rub"].']','FOREIGN SOUND: CREPTS/WHEEZING/BRONCHIAL BREATHING/PLEURAL RUB') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["foreign_sounds_pleural_rub"].']', $form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["foreign_sounds_pleural_rub"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s1"].']','CARDIOVASCULAR SYSTEM :HEART SOUND :S1') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s1"].']', $form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s1"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s2"].']','S2') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["cardiovascular_heart_sound_s2"].']', $form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiovascular_heart_sound_s2"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["cardiac_murmur"].']','CARDIAC MURMUR') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["cardiac_murmur"].']', $form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["cardiac_murmur"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["central_nervous_system"].']','CENTRAL NERVOUS SYSTEM') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["central_nervous_system"].']', $form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["central_nervous_system"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["MENINGEAL SIGN"].']','MENINGEAL SIGN:') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["MENINGEAL SIGN"].']', $form_field_values->where('form_field_code', $field_name_id["MENINGEAL SIGN"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MENINGEAL SIGN"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["CRANIAL NERVES"].']','CRANIAL NERVES') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["CRANIAL NERVES"].']', $form_field_values->where('form_field_code', $field_name_id["CRANIAL NERVES"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["CRANIAL NERVES"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["MOTOR SYSTEMS"].']','MOTOR SYSTEMS') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["MOTOR SYSTEMS"].']', $form_field_values->where('form_field_code', $field_name_id["MOTOR SYSTEMS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MOTOR SYSTEMS"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["SENSORY SYSTEMS"].']','SENSORY SYSTEM') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["SENSORY SYSTEMS"].']', $form_field_values->where('form_field_code', $field_name_id["SENSORY SYSTEMS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["SENSORY SYSTEMS"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["PLANTERS"].']','PLANTERS :') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["PLANTERS"].']', $form_field_values->where('form_field_code', $field_name_id["PLANTERS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PLANTERS"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["shape_of_abdomen"].']','ABDOMINAL SYSTEM : SHAPE OF ABDOMEN :') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["shape_of_abdomen"].']', $form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["shape_of_abdomen"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["organomegaly"].']','ORGANOMEGALY') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["organomegaly"].']', $form_field_values->where('form_field_code', $field_name_id["organomegaly"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["organomegaly"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["free_fluid_in_abdomen"].']','FREE FLUID IN ABDOMEN :') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["free_fluid_in_abdomen"].']', $form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["free_fluid_in_abdomen"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["tenderness"].']','TENDERNESS') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["tenderness"].']', $form_field_values->where('form_field_code', $field_name_id["tenderness"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["tenderness"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["guarding"].']','guarding') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["guarding"].']', $form_field_values->where('form_field_code', $field_name_id["guarding"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["guarding"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('field_data_singular['.$field_name_id["rigidity"].']','rigidity') }} 
                    {{ Form::text('field_data_singular['.$field_name_id["rigidity"].']', $form_field_values->where('form_field_code', $field_name_id["rigidity"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["rigidity"])->first()->field_data, array('class'=> 'form-control')) }}
                </div>
                {{-- <div class="row">
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["CBC: Hb"].']','CBC: Hb') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["CBC: Hb"].']', $form_field_values->where('form_field_code', $field_name_id["CBC: Hb"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["CBC: Hb"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["ESR"].']','ESR') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["ESR"].']', $form_field_values->where('form_field_code', $field_name_id["ESR"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ESR"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["TC"].']','TC') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["TC"].']', $form_field_values->where('form_field_code', $field_name_id["TC"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TC"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["N"].']','N') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["N"].']', $form_field_values->where('form_field_code', $field_name_id["N"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["N"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["L"].']','L') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["L"].']', $form_field_values->where('form_field_code', $field_name_id["L"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["L"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["E"].']','E') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["E"].']', $form_field_values->where('form_field_code', $field_name_id["E"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["E"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["M"].']','M') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["M"].']', $form_field_values->where('form_field_code', $field_name_id["M"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["M"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["Platelet Count"].']','Platelet Count') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["Platelet Count"].']', $form_field_values->where('form_field_code', $field_name_id["Platelet Count"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Platelet Count"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::label('field_data_singular['.$field_name_id["MP"].']','MP') }} 
                        {{ Form::text('field_data_singular['.$field_name_id["MP"].']', $form_field_values->where('form_field_code', $field_name_id["MP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MP"])->first()->field_data, array('class'=> 'form-control')) }}
                    </div>
                </div> --}}

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success" value="submit" >
                        <i class="fa fa-plus"></i> Submit
                </button>
                <a class="btn btn-default" href="{{ url('/dynamicForm/').'/'.$form_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                <a class="btn btn-default" href="{{ url('/dynamicForm/view/').'/'.$form_master->id.'/'.$patientRegister->id }}"><i class="glyphicon glyphicon-chevron-left"></i> view</a>
                <a class="btn btn-default" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-chevron-left"></i> print</a>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
    });
</script>
@endsection