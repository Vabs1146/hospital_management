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
Eye Operation View
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
                            Eye Operation | Case Number : {{ $case_master['case_number'] }}  | {{ 'Time :' . $case_master['visit_time']}}
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">

<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
        </div>
      </div>
      <div class="panel-body" >
    <div class="container-fluid">
           <div class="row">
           <div class="col-md-12">
            <label for="Patient_name" class="control-label">Patient Name :</label> 
            {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}
            </div>
            </div>
            
            <div class="row">
            
            <div class="col-md-4">
            <label for="Patient_age" class="control-label">Age :</label>
            {{ $case_master['patient_age'] }}
            </div>

            <div class="col-md-4">
            <label for="Patient_sex" class="control-label">Sex :</label>
            {{ $case_master['male_female'] }}
            </div>

            <div class="col-md-4">
            <label for="Patient_IPDno" class="control-label">IPD no :</label>
            {{ $eyeOperationRecord->IPD_no }}
            </div>
          
        </div>

            <div class="row">
            <div class="col-md-3">
            <label for="Patient_address" class="control-label">Address :</label>
            {{ $case_master['patient_address'] }} 
            </div>
            <div class="col-md-3">
            <label for="Patient_address" class="control-label">Area :</label>
            {{ $case_master['area'] }} 
            </div>
            <div class="col-md-3">
            <label for="Patient_address" class="control-label">City :</label>
            {{ $case_master['city'] }} 
            </div>
            <div class="col-md-3">
            <label for="Patient_address" class="control-label">District :</label>
            {{ $case_master['district'] }} 
            </div>
           </div>

		   <div class="table-responsive">
            <table class="table table-bordered" style="width:100%">
               
                <tbody>   
               <tr>
                    <td>Date Of Addmission :</td>
                       <td colspan="2">
                            {{$case_master['admission_date_time']}}
                       </td>

               </tr>
               <tr>
                    <td>Date Of Surgery:</td>
                    <td colspan="2">
                        {{$case_master['surgery_date_time']}}
                    </td>
               </tr>

			   @php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Diagnosis : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td>
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif

@if(count($surgeryDetails) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($surgeryDetails as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Surgery/Procedure : @endif </td> 
<td> {{ucfirst($item->text)}}	</td>
<td> {{ucfirst($item->eye_operated)}}	</td>
</tr>					
@endforeach
@endif

 @php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'anaesthetistSurgeon')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Anesthesia : @endif </td> 
<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'anesthesia')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Anaesthetist Surgeon : @endif </td> 
<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
</tr>					
@endforeach
@endif

			   </tbody>
			   </table>
			</div>

            <!-- <div class="row">
            <div class="col-md-12">
            <label for="Addmission_dt" class="control-label">Date Of Addmission :</label>
            {{$case_master['admission_date_time']}}
            </div>
            </div>
            
            <div class="row">
            <div class="col-md-12">
            <label for="Surgery_dt" class="control-label">Date Of Surgery :</label>
            {{$case_master['surgery_date_time']}}
            </div>
            </div> -->
			
			<!-- @if(isset($newDischargeData['diagnosis']))
			            <div class="row">
			            <div class="col-md-12">
			            <label for="Diagnosis" class="control-label">Diagnosis :</label>
			
			<table class="table  table-bordered">
				<tr><td>OD</td><td>OS</td></tr>		
				@foreach($newDischargeData['diagnosis'] as $diagnosis_data)
					<tr><td>{{$diagnosis_data->field_value}}</td><td>{{$diagnosis_data->field_value_os}}</td></tr>	
				@endforeach
			</table>
			            </div>
			            </div>
			@endif -->

			<!-- @if(isset($surgeryDetails))
			            <div class="row">
			            <div class="col-md-12">
			            <label for="surgery" class="control-label">Surgery :</label> 
			<table class="table  table-bordered"><tr><td>OD</td><td>OS</td></tr>	
				@foreach ($surgeryDetails as $item)
					<tr><td>{{$item->text}}</td><td>{{$item->eye_operated}}</td></tr>	
				@endforeach
			</table>
			            </div>
			            </div>
			@endif -->

      <!--       <div class="row">
            
            <div class="col-md-4">
            <label for="BriefHistory" class="control-label">Brief History :</label>   {{$discharge->brief_history}}
            </div>
            
            <div class="col-md-4">
            <label for="TreatmentAdvised" class="control-label">Treatment Advised :</label>   {{$discharge->treatment_advised}}
            </div>
                
                     </div>
            
            <div class="row">
            <div class="col-md-12">
            <label for="Investigation" class="control-label">Investigation :</label>   {{$discharge->investigation}}
            </div>
            </div>
            
            <div class="row">
            <div class="col-md-12">
            <label for="BriefHistory" class="control-label"> Followup :</label>
            {{$discharge->followup}}  
            </div>
            </div> -->

			<!-- <div class="row">
			            
			            <div class="col-md-6">
			            <label for="BriefHistory" class="control-label">Anesthesia :</label> {{(isset($newDischargeData['anesthesia'][0]) && $newDischargeData['anesthesia'][0]->field_value) ? $newDischargeData['anesthesia'][0]->field_value : ''}}
			            </div>
			
			            <div class="col-md-6">
			            <label for="TreatmentAdvised" class="control-label">Anaesthetist Surgon :</label> {{(isset($newDischargeData['anaesthetistSurgeon'][0]) && $newDischargeData['anaesthetistSurgeon'][0]->field_value) ? $newDischargeData['anaesthetistSurgeon'][0]->field_value : ''}}
			            </div>
			                
			         </div> -->

            <div class="row">
            <div class="col-md-12">
            <label for="BriefHistory" class="control-label"> Date : </label> {{ \Carbon\Carbon::now()->format('d/M/Y') }}
           
            </div> 
            </div>     
           

            
           
            <br/>
            
            <div class="col-md-12">
                <div class="col-md-6">
                    _______________________
                </div>
                <div class="col-md-6 pull-right">
                    _______________________
                </div>
                <div class="col-md-6">
                    Signature
                </div>
                <div class="col-md-6 pull-right">
                    Signature
                </div>
                <div class="col-md-6">
                    {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}
                </div>
                <div class="col-md-6 pull-right">
                    {{ config('app.name', 'Dr') }}
                </div>
            </div>

     </div>





<!-----------button----------------------->    
<div class="row clearfix">
<div class="col-md-4 col-md-offset-4">
<div class="form-group">
    <a class="btn btn-info btn-lg" href="{{ url('/eyeOperationRecord/print').'/'.$case_master->id }}" target="_blank">
    <i class="fa fa-print" aria-hidden="true"></i>Print</a>
    <a class="btn btn-info btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
</div>
</div>
</div>
 <!----------end-button----------------------->  

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
