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

<div class="container-fluid">
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
<div class="card">

<div class="header bg-pink">
<h2>
View Ent Report 
</h2>
</div>
    <div class="body">
     <div class="row clearfix">
         <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
             <div class="panel-group" id="accordion_9" role="tablist" aria-multiselectable="true">
                 <div class="panel panel-col-pink">
                    <div class="panel-heading" role="tab" id="headingOne_9">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion_9" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_9">
                              <span> Case Number : <b>{{ $casedata['case_number']  }} </b> Patient Name : <b>
        {{ $casedata['patient_name'] }} </b> </span>
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
 {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}

<div class="panel-body">
<div class="row clearfix">
  <div class="row">
  @foreach ($report_image as $rptImg)
    @if(isset($rptImg) && $rptImg != null && isset($rptImg->filePath))
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="{{ url('/printEyeReportFiles') . '/' . $rptImg->id }}" target="_blank">
            <img src="{{ Storage::disk('local')->url($rptImg->filePath) }}" alt="Lights" style="width:100%">
            <div class="caption">
              <p>&nbsp;</p>
            </div>
          </a>
        </div>
      </div>
    {{-- <a href="{{ Storage::disk('local')->url($rptImg->filePath) }}" class="" target="_blank"> {{$loop->iteration}}
    Report file </a> --}}
    @endif
  @endforeach
</div>

     

<!---------------------medial--------------------------------->
    <div class="panel-body" >
    <div class="container-fluid">
    
          <ul class="list-inline">
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/Ent') . '/'. $casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back </a>
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back Patient list</a>
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/AddEdit/prescription/').'/'. $casedata['id'] }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Add Prescription 
      </a>
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/report_files/').'/'.$casedata['id'].'/edit' }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Add Report 
      </a>
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/insuranceBill/').'/'.$casedata['id'].'/edit' }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Insurance Bill 
      </a>
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/eyeOperationRecord/').'/'.$casedata['id'].'/edit' }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Eye Operation Record 
      </a>
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/discharge/').'/'.$casedata['id'].'/1/edit' }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Discharge 
      </a>                    
  </li>
</ul>

<ul class="list-inline">
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/eyeoperation/').'/'.$casedata['id'].'/edit' }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Operation Details 
      </a>                    
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/eyeOperationRecord/view').'/'.$casedata['id'] }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Operation record View 
      </a>                                           
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/eyeOperationRecord/print').'/'.$casedata['id'] }}" target="_blank">
          <i class="fa fa-print" aria-hidden="true"></i>Operation record Print
      </a>                                           
  </li>
  <li class="list-inline-item">
      <a class="btn btn-default btn-lg" href="{{ url('/glassPrescription/').'/'.$casedata['id'].'/edit' }}">
          <i class="glyphicon glyphicon-chevron-left"></i> Glass Prescription 
      </a>                                           
  </li>
</ul>
            
           

        
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

