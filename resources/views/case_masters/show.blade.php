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
    <div class="list-group list-group-horizontal">
            @forelse ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
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
{{ Form::model($casedata, array('route' => array('case_masters.edit',$casedata['id']), 'method' => 'GET', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}
<div class="header bg-pink">
<h2>
Case Master
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
                            Patient Summary
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
{{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>

<!---------------------medial--------------------------------->
    <div class="panel-body" >
    <div class="container-fluid">
            <div class="row">
            <label for="MensturationHistory" class="control-label">Case Number :</label>
            {{  $casedata['case_number'] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Patient Name :</label>
            {{ $casedata['patient_name'] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Patient age :</label>
            {{ $casedata['patient_age'] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Patient Address :</label>
            {{ $casedata['patient_address'] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Patient Email Id :</label>
            {{ $casedata['patient_emailId'] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Patient mobile :</label>
            {{ $casedata['patient_mobile'] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Doctor :</label>
            {{ empty($casedata['doctor_id'])?"--": $casedata['doctorlist'][$casedata['doctor_id']] }}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Male/Female :</label>
            {{ $casedata['male_female']}}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Height :</label>
            {{ $casedata['patient_height']}}
            </div>
            <div class="row">
            <label for="MensturationHistory" class="control-label">Weight :</label>
            {{ $casedata['patient_weight']}}
            </div>
            <div class="row">
            @if(isset($casedata['diagnosis_file']) && $casedata['diagnosis_file'] != null)
            <a href="{{Storage::disk('local')->url($casedata['diagnosis_file']) }}" class="" target="_blank"> Diagnosis File link</a>
            @endif
            </div>

     </div>
 </div>


</div>
</div>
</div>
</div>

<!------------------2-panel------------------------------->

<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
    <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapseOne_9">
        Complaint
        </a>
    </h4>
  </div>
   <div id="collapse7" class="panel-collapse collapse">        
        <div class="container-fluid">
            <div class="panel-body" >                
                <ul  class="list-group">
                    @forelse($casedata['field_type_data']->where('field_type_id', '1') as $fieldData)
                        <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                    @empty
                        <li  class="list-group-item"> No Data found </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div> 
</div>
</div>
<!-----------------end-2-panel------------------------------->
<!----------------3-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
            Diagnosis</a>
        </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse">        
        <div class="container-fluid">
        <div class="panel-body" > 
        <ul  class="list-group">
            @forelse($casedata['field_type_data']->where('field_type_id', '2') as $fieldData)
                <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
            @empty
                <li  class="list-group-item"> No Data found </li>
            @endforelse
        </ul>
        </div>
        </div>            
    </div> 
</div>
</div>

<!---------------end-3-panel------------------------------------>

<!----------------4-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
            Treatment</a>
        </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse">
        <div class="container-fluid">
        <div class="panel-body" > 
            <ul  class="list-group">
                @forelse($casedata['field_type_data']->where('field_type_id', '3') as $fieldData)
                    <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                @empty
                    <li  class="list-group-item"> No Data found </li>
                @endforelse
            </ul>
        </div>
        </div>
    </div> 
</div>
</div>

<!---------------end-4-panel------------------------------------>

<!----------------5-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
            Follow up date</a>
        </h4>
    </div>
<div id="collapse2" class="panel-collapse collapse">
    <div class="container-fluid">
    <div class="panel-body" >
        
                        <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label>Date :</label>
                              </div>
                             </div>
                              
                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ $casedata['appointment_dt']}}                          
                              </div>
                              </div>
                              </div>
                        </div>

                        <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label>Time :</label>
                              </div>
                             </div>
                              
                              <div class="col-md-4">
                              {{ Form::select('appointment_timeslot', array(''=>'Please select') + $casedata['timeslot']->toArray(), Request::old('appointment_timeslot'), array('class' => 'form-control', 'readonly' => 'readonly', 'disabled'=> 'disabled')) }}                       
                             </div>
                            
                         
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('FollowUpDoctor_id','Doctor') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $casedata['doctorlist']->toArray(),
                        Request::old('FollowUpDoctor_id'), array('class' => 'form-control', 'readonly'=>'readonly', 'disabled'=> 'disabled')) }}
                              </div>
                        </div>
</div>
</div>
</div> 
</div>
</div>

<!---------------end-5-panel------------------------------------>

<!----------------6-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
            Prescription</a>
        </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
            <div class="container-fluid">
                <div class="panel-body">
                    Or any other cheaper Generic Medicine per choice of patient
                    <div class="table-responsive">
                        @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                            <table class="table">
                                <tr>
                                    <th>
                                        Medicine
                                    </th>
                                    <th>
                                        Strength
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Times a Day    
                                    </th>
                                </tr>
                                    @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                        <tr>   
                                            <td>
                                                {{ $prescption->Medical_store->medicine_name }}
                                            </td>
                                            <td>
                                                {{ $prescption->strength }}
                                            </td>
                                            <td>
                                                {{ $prescption->medicine_Quntity }}
                                            </td>
                                            <td>
                                                {{ $prescption->numberoftimes }}
                                            </td>
                                        <tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
            </div>
            </div>
            </div>  
</div>
</div>

<!---------------end-6-panel------------------------------------>

<!----------------7-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
            Uploaded Files</a>
        </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
            <div class="container-fluid">
                <div class="panel-body">
                <div class="form-group">
                    {{ Form::label('Reports_file', 'Report File/image') }}
                    @if(null !== old('Report_file',$casedata['Reports_file']) && count(old('Report_file',$casedata['Reports_file']))> 0 )
                        <div class="list-group">
                            @foreach(old('Report_file',$casedata['Reports_file']) as $reportfile)                        
                                    <div href="#" class="list-group-item clearfix">
                                        <div class="d-flex w-100 justify-content-between">
                                            @if(isset($reportfile->file_path) && $reportfile->file_path != null)
                                            <h5 class="mb-1"> <a href="{{ Storage::disk('local')->url($reportfile->file_path) }}" class="" target="_blank"> ..Report document </a> </h5>
                                            @endif
                                        </div>
                                        <p class="mb-1">
                                                {{$reportfile->report_title}}
                                        </p>
                                        <p class="mb-1">
                                            {{$reportfile->report_description}}
                                        </p>
                                    </div>
                            @endforeach
                        </div>
                    @endif
                </div>              
                <div class="form-group">
                    {{ Form::label('Before_file', 'Before image') }}
                    @if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
                        <a href="{{Storage::disk('local')->url($casedata['Before_file']) }}" class="" target="_blank"> Before Image link</a>              
                    @endif                
                </div>
                <div class="form-group">
                    {{ Form::label('After_file', 'After image') }} 
                    @if(isset($casedata['After_file']) && $casedata['After_file'] != null)
                        <a href="{{ Storage::disk('local')->url($casedata['After_file']) }}" class="" target="_blank"> After Image link</a>              
                    @endif
                </div>
            </div>
            </div>
            </div> 
</div>
</div>

<!---------------end-7-panel------------------------------------>

<!----------------8-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
   
    <div id="collapse15" class="panel-collapse collapse in">
        <div class="container">
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li class="list-group-itemsd clearfix">Please bring this paper on every visit</li>
                    <li class="list-group-itemasdf"> Please follow the time </li>
                    <li class="list-group-itemasf"> Please inform allergy immediately </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<!---------------end-8-panel------------------------------------>

<!-----------button----------------------->    
<div class="row clearfix">
<div class="col-md-4 col-md-offset-4">
<div class="form-group">
    <a class="btn btn-info btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>    
    <button type="submit" class="btn btn-info btn-lg"> Edit </button>
    <a class="btn btn-info btn-lg" href="{{ url('/case_masters/print/').'/'.$casedata['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
</div>
</div>
</div>
 <!----------end-button----------------------->  

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
<script type="text/javascript">
    
</script>
@endsection
