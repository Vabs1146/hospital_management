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
{{--  {{ Form::text('Complaints', Request::old('Complaints',$form_details->Complaints), array('class'=> 'form-control autocompleteTxt')) }}  --}}
            {{ csrf_field() }}
<div class="header bg-pink">
<h2>
Surgery View
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
                            Surgery View
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">

<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        
        </div>
      </div>
      <div class="panel-body" >
    <div class="row clearfix ">
                          

<div class="col-md-12">
                            
 <div class="row">&nbsp;</div>
    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">DELIVARY NOTES : DATE OF DELIVARY:</label></div>    
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->first()->field_data}}</u></div>
        <div class="col-sm-2"><label class="control-lable">TIME</label></div>
        <div class="col-sm-2"> <u>{{$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["DelivaryNotes_Date"])->first()->field_data}}</u> </div>
   
    
        
        <div class="col-sm-2"><label class="control-label">Nature Of Delivary : FTND/PTND/LSCS</label></div>    
        <div class="col-sm-2"><u>{{$form_field_values->where('form_field_code', $field_name_id["NatureOfDelivary"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["NatureOfDelivary"])->first()->field_data}}</u></div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-12">

        <div class="col-sm-2">
            <label class="control-label">SEX OF BABY</label>
        </div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code',$field_name_id["SexOfBaby"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["SexOfBaby"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2"><label class="control-label">WEIGHT</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["BabyWeight"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["BabyWeight"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2"><label class="control-label">AGA/SGA/PREMATURITY/LBW/VLBW</label></div>
    </div>
</div>


    <div class="row">
       
<div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">POST NATAL PERIOD :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["PostNatalPeriod"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["PostNatalPeriod"])->first()->field_data}}
            </u>
        </div>
    
    
        <div class="col-sm-2"><label class="control-label">Indication of LSCS :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["IndicationOfLSCS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["IndicationOfLSCS"])->first()->field_data}}
            </u>
        </div>
    </div>

    <div class="row">
        <center> <b><u>SURGERY (OPERATIVE NOTES)</u></b> </center>
    </div>
    
<br><br>

    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">ANAESTHESIA: NAME OF ANAESTHES: SIGNATURE :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["Anaesthes Name"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Anaesthes Name"])->first()->field_data}}
            </u>
        </div>
    
   
        
        <div class="col-sm-2"><label class="control-label">TYPE OF ANAESTHESIA :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["TypeOfAnaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TypeOfAnaesthesia"])->first()->field_data}}
            </u>
        </div>
   
  

        <div class="col-sm-2"><label class="control-label">RECOVERY FROM ANAESTHESIA :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["RecoveryFromAnaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["RecoveryFromAnaesthesia"])->first()->field_data}}
            </u>
        </div>
   
     </div>
    </div>


    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">ANY COMPLICATIONS DURING ANAESTHESIA :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["ComplicationAnaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["ComplicationAnaesthesia"])->first()->field_data}}
            </u>
        </div>
    
    
        <div class="col-sm-2"><label class="control-label">SURGERY :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["Surgery"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Surgery"])->first()->field_data}}
            </u>
        </div>
    
    
        <div class="col-sm-2"><label class="control-label">MTP :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["MTP"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["MTP"])->first()->field_data}}
            </u>
        </div>
    </div>
</div>



    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">TUBAL LIGATION :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["TubalLigation"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["TubalLigation"])->first()->field_data}}
            </u>
        </div>
        <div class="col-sm-2"><label class="control-label">LAP TL :</label></div>
        <div class="col-sm-2">
            <u>
                {{$form_field_values->where('form_field_code', $field_name_id["LAPTL"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LAPTL"])->first()->field_data}}
            </u>
        </div>
    
  
        <div class="col-sm-2"><label class="control-label">OPERATIVE :</label></div>
        <div class="col-sm-2">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["Operative"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Operative"])->first()->field_data) !!}
            </u>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-md-12">
        <div class="col-sm-2"><label class="control-label">HYSTECRECTOMY: VAGINAL/ABDOMINAL :</label></div>
        <div class="col-sm-2">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["HystecrectomyVaginalAbdominal"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["HystecrectomyVaginalAbdominal"])->first()->field_data) !!}
            </u>
        </div>
    
    
        <div class="col-sm-2"><label class="control-label">LCSC :</label></div>
        <div class="col-sm-2">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["LSCS"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["LSCS"])->first()->field_data) !!}
            </u>
        </div>
    
   
        <div class="col-sm-2"><label class="control-label">OTHER SURGERY :</label></div>
        <div class="col-sm-2">
            <u>
                {!! nl2br($form_field_values->where('form_field_code', $field_name_id["OtherSurgery"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["OtherSurgery"])->first()->field_data) !!}
            </u>
        </div>

        </div>
    </div>

    
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


