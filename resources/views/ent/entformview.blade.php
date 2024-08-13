@extends('adminlayouts.master')
@section('style')
@inject('CheckField', 'App\Http\Controllers\EntController')
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
<div class="container">
    <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
            @if($casedata['id'] == $VisitListDateWise['id'])
                <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
            @else
                <a href="{{ url('/ViewMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
                        <form action="{{ url('/Ent/').'/'.$casedata['id'] }}" method="GET" class="form-horizontal">
                          {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2> 
                                Ent View
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
                                                        Patient History | Case Number : {{ $casedata['case_number'] }}  | {{ 'Time :' . $casedata['visit_time']}}
                                                    </a>
                                                </h4>
                                            </div>
                          <div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
                          {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
            <div class="panel-body">
            <div class="row clearfix">
            <div class="col-md-12">
              <div class="form-group">
              {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
              </div>
            </div>
            <div class="col-md-12">
                <label class="control-label">General Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
              </div>
            </div>

              <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <td >
                                     
                                </td>
                                <td >
                                    <strong>OD</strong>
                                </td>
                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'complaint')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Complaint
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                               
                            </tr>                            
                        @endforeach 
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'finding')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                   Finding      
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                               
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'diagnosis')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                      Diagnosis
                                    @endif
                                </td>
                                <td colspan="2">
                                    {{$item->field_value_OD}}
                                </td>
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'treatment_advice')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                      Treatment Advice
                                    @endif
                                </td>
                                <td colspan="2">
                                    {{$item->field_value_OD}}
                                </td>
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'life_style_chenger')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Life Style Changer
                                    @endif
                                </td>
                                <td colspan="2">
                                    {{$item->field_value_OD}}
                                </td>
                            </tr>                            
                        @endforeach
                       
                        
                    
                        
                        
                        </tbody>
                    </table>
                </div>
              </div>  
              <div class="col-md-12">
                @if(count($blnc_test)>1)
                <div class="col-md-2">
                    <div class="form-group labelgrp">
                    <label>Balance Test :</label>   
                    </div>
                </div>
               <div class="col-md-12">
                @foreach($blnc_test as $key => $blnctest)
                <div class="col-md-2 ">
                    <ul class="" >
                       <li class="" style="list-style-type: none;"><label><b>{{$key+1}}.&nbsp;{{$blnctest->blncetestname}}</b></label> </li>
                    </ul>
                    
                </div>
                @endforeach
                </div>
                @endif
              </div>


    <!----------------------------------------------------------------------------->
           <div class="col-md-12">
            <legend>Examination</legend>
                   
            @if (!empty($form_details->leftear) && !is_null($form_details->leftear)&& ($form_details->ear1_chk=="1"))
            <div class="col-md-3">
            <label for="ear1_chk"><b>Left Ear</b></label>
            <div class="">
            @if (!empty($form_details->leftear) && !is_null($form_details->leftear))
                <center id="wPaint-leftear"> 
                        <img src={{ Storage::disk('local')->url($form_details->leftear)."?".filemtime(Storage::path($form_details->leftear)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>    
            </div>
            @endif
            
            @if (!empty($form_details->rightear) && !is_null($form_details->rightear)&& ($form_details->ear2_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Right Ear</b></label>
            <div class="">
            @if (!empty($form_details->rightear) && !is_null($form_details->rightear))
                <center id="wPaint-rightear"> 
                        <img src={{ Storage::disk('local')->url($form_details->rightear)."?".filemtime(Storage::path($form_details->rightear)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif

            @if (!empty($form_details->nose) && !is_null($form_details->nose)&& ($form_details->nose_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Nose</b></label>
            <div class="">
            @if (!empty($form_details->nose) && !is_null($form_details->nose))
                <center id="wPaint-nose"> 
                        <img src={{ Storage::disk('local')->url($form_details->nose)."?".filemtime(Storage::path($form_details->nose)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif

            @if (!empty($form_details->neck) && !is_null($form_details->neck)&& ($form_details->neck_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Neck</b></label>
            <div class="">
            @if (!empty($form_details->neck) && !is_null($form_details->neck))
                <center id="wPaint-neck"> 
                        <img src={{ Storage::disk('local')->url($form_details->neck)."?".filemtime(Storage::path($form_details->neck)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif

            @if (!empty($form_details->throat) && !is_null($form_details->throat)&& ($form_details->throat_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Throat</b></label>
            <div class="">
            @if (!empty($form_details->throat) && !is_null($form_details->throat))
                <center id="wPaint-throat"> 
                        <img src={{ Storage::disk('local')->url($form_details->throat)."?".filemtime(Storage::path($form_details->throat)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif
        </div>
                   

    <!------------------------------------------------------------------------------>
              <div class="col-md-12">
                   
                    <div class="col-md-4">
                    <label for="uveiitis_chk"><b>Investigation</b></label>
                    
                    </div>
                    
                
                <div class="col-md-12">
                    @if($form_details->uveiitis_chk=="1")
                    <div class="col-md-4">
                        <label for="uveiitis_chk"><b>Investigation For Uveiitis</b></label>
                          <ul class="list-group1">
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
                     @endif
                     @if($form_details->preoperative_chk=="1")
                    <div class="col-md-4">
                    <label for="preoperative_chk"><b>Pre Operative Investigation</b></label>
                    <ul class="list-group1">
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
                     @endif

                     @if($form_details->preoperative_chk1=="1")
                    <div class="col-md-4">
                    <label for="preoperative_chk1"><b>Pre Operative Investigation1</b></label>
                    <ul class="list-group1">
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
                     @endif

                </div>
               <div class="col-md-12">
                  <div class="table-responsive">
                  
                            @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            Medicine
                                        </th>  
                                        <th>
                                           Times a Day  
                                        </th>
                                        <th>
                                            Days
                                        </th>
                                        <th>
                                            Quantity   
                                        </th>  
                                    </tr>
                                        @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                            <tr>   
                                                <td>
                                                    {{ $prescption->Medical_store->medicine_name }}
                                                </td> 
                                                <td>
                                                   {{ $prescption->numberoftimes }}    
                                                </td>
                                                <td>
                                                    {{ $prescption->medicine_Quntity }}
                                                </td>
                                                <td>
                                                   {{ $prescption->strength }}
                                                </td>
                                            <tr>
                                        @endforeach
                                    @endif
                                </table>
                                </div>
                </div>
               </div>
                <div class="row clearfix">
                  <div class="col-md-4 col-md-offset-4">
                  <div class="form-group">
                  <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails/').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> &nbsp;   
                  <button type="submit" class="btn btn-default btn-lg"> Edit </button>&nbsp;
                  <a class="btn btn-default btn-lg" href="{{ url('/PrintMedicalDetails/').'/'.$casedata['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
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
                </form>
                </div>
                </div>
                </div>
             </div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#medicine_id').select2();  
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
  