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
{{--  {{ Form::text('Complaints', Request::old('Complaints',$form_details->Complaints), array('class'=> 'form-control autocompleteTxt')) }}  --}}
            {{ csrf_field() }}
<div class="header bg-pink">
<h2>
Treatment Chart View
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
                            Treatment Chart (Daily)
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">

<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
      </div>
      <div class="panel-body" >
    <div class="row clearfix ">
        <div class="col-md-12">
            <div class="col-sm-2"><label class="control-label">COMPLAINTS</label></div>    
            <div class="col-sm-10">
                <u>
                    {!! nl2br($form_field_values->where('form_field_code', $field_name_id["Complaints"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Complaints"])->first()->field_data) !!}
                </u>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-2"><label class="control-label">GENERAL CONDITION : GOOD/FAIR/POOR</label></div>    
            <div class="col-sm-10"><u>{{$form_field_values->where('form_field_code', $field_name_id["GeneralCondition"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["GeneralCondition"])->first()->field_data}}</u></div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-2">
                <label class="control-label">VITAL PARAMETER: HR/PULSE</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["Vital Parameter"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Vital Parameter"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-2">
                <label class="control-label">CAPILLARI REFILLING</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["CAPILLARI REFILLING"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["CAPILLARI REFILLING"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-2">
                <label class="control-label">RR</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["RR"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["RR"])->first()->field_data}}
                </u>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-2">
                <label class="control-label">TEMPURATURE</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["TEMPURATURE"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TEMPURATURE"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-2">
                <label class="control-label">BP</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["BP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BP"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-2">
                <label class="control-label">Sp O2</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["SpO2"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["SpO2"])->first()->field_data}}
                </u>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-2 text-nowrap"><label class="control-label">GENERAL EXAMINATION :</label></div>
            <div class="col-sm-10">
                <u>
                    {{$form_field_values->where('form_field_code', $field_name_id["general examination"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["general examination"])->first()->field_data}}
                </u>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-1">
                <label class="control-label">SYSTEMIC EXAMINATION RS</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationRS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationRS"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-1">
                <label class="control-label">CVS</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationCVS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationCVS"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-1">
                <label class="control-label">CNS</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationCNS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationCNS"])->first()->field_data}}
                </u>
            </div>
            <div class="col-sm-1">
                <label class="control-label">PA</label>
            </div>
            <div class="col-sm-2">
                <u>
                    {{$form_field_values->where('form_field_code',$field_name_id["systemicExaminationPA"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["systemicExaminationPA"])->first()->field_data}}
                </u>
            </div>
        </div>
        <div class="table-responsive">
            @if($patientRegister->ipdTreatmentDailyNotes()->get()->count() > 0 )
                <table class="table table-bordered">
                    <tr>
                        <th>
                            Time
                        </th>
                        <th>
                            Temp    
                        </th>
                        <th>
                            SPO2
                        </th>
                        <th>
                            BP
                        </th>
                        <th>
                            RR    
                        </th>
                        <th>
                            FHS    
                        </th>
                        <th>
                            TREATMENT    
                        </th>
                        <th>
                            Morning
                        </th>
                        <th>
                            Evening
                        </th>
                        <th>
                            Night
                        </th>
                    </tr>
                        @foreach($patientRegister->ipdTreatmentDailyNotes()->get() as $TreatmentNotes)
                            <tr>   
                                <td>
                                    {{$TreatmentNotes->time}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->temp}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->spo2}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->bp}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->rr}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->fhs}}
                                </td>
                                <td>
                                    {!! nl2br($TreatmentNotes->treatment) !!}
                                </td>
                                <td>
                                    {{$TreatmentNotes->morning}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->evening}}
                                </td>
                                <td>
                                    {{$TreatmentNotes->night}}
                                </td>
                            <tr>
                        @endforeach
                    @endif
                </table>
            </div>
        <br/>
        <br/>
        <div class="col-md-12">
            <div class="col-sm-6">
                <div class="col-sm-6">Doctor's Signature</div>
                <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">PARENT'S/RELATIVE'S SIGNATURE</div>
                <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
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
<!-- </form> -->
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


