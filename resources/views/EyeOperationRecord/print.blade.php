<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
     <style>
 /* Print styling */

@media print {

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
  float: left;
}

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
}

.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-xs-1,
.col-xs-2,
.col-xs-3,
.col-xs-4,
.col-xs-5,
.col-xs-6,
.col-xs-7,
.col-xs-8,
.col-xs-9,
.col-xs-10,
.col-xs-11,
.col-xs-12 {
float: left !important;
}

body {
  margin: 0;
  padding: 0 !important;
  min-width: 768px;
}

.container {
  width: auto;
  min-width: 750px;
}

body {
  font-size: 13px;
}

a[href]:after {
  content: none;
}

.noprint,
div.alert,
header,
.group-media,
.btn,
.footer,
form,
#comments,
.nav,
ul.links.list-inline,
ul.action-links {
  display:none !important;
}
ul { display: inline-flex;
    list-style: none; }
ul li { padding: 10px; }
}

.table {
   margin-bottom: 0px;
}

.border {
	border:1px solid;
}

.no-collapse {
	
	}
    </style>
</head>
<body>
 <div class="container-fluid col-md-10" style="float: none;margin: 0 auto;">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
           <h3> <u>Eye Operation</u> </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}
        </div>
    </div>
    <div class="row">
          <div class="col-sm-12">   
            <div class="col-sm-4">
            <label for="Patient_age" class="control-label">Age :</label>
            {{ $case_master['patient_age'] }}
            </div>

            <div class="col-sm-4">
            <label for="Patient_sex" class="control-label">Sex :</label>
            {{ $case_master['male_female'] }}
            </div>

            <div class="col-sm-4">
            <label for="Patient_IPDno" class="control-label">IPD no :</label>
            {{ $eyeOperationRecord->IPD_no }}
            </div>
          </div>
        </div>

            <div class="row">
			<div class="col-sm-12"> 
            <div class="col-sm-3">
            <label for="Patient_address" class="control-label">Address :</label>
            {{ $case_master['patient_address'] }} 
            </div>
            <div class="col-sm-3">
            <label for="Patient_address" class="control-label">Area :</label>
            {{ $case_master['area'] }} 
            </div>
            <div class="col-sm-3">
            <label for="Patient_address" class="control-label">City :</label>
            {{ $case_master['city'] }} 
            </div>
            <div class="col-sm-3">
            <label for="Patient_address" class="control-label">District :</label>
            {{ $case_master['district'] }} 
            </div>
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
            </div>
            			
            			@if(isset($newDischargeData['diagnosis']))
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
            			@endif
            
            			@if(isset($surgeryDetails))
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
            			@endif
            
            			<div class="row">
            
            <div class="col-md-6">
            <label for="BriefHistory" class="control-label">Anesthesia :</label> {{(isset($newDischargeData['anesthesia'][0]) && $newDischargeData['anesthesia'][0]->field_value) ? $newDischargeData['anesthesia'][0]->field_value : ''}}
            </div>
            
            <div class="col-md-6">
            <label for="TreatmentAdvised" class="control-label">Anaesthetist Surgon :</label> {{(isset($newDischargeData['anaesthetistSurgeon'][0]) && $newDischargeData['anaesthetistSurgeon'][0]->field_value) ? $newDischargeData['anaesthetistSurgeon'][0]->field_value : ''}}
            </div> -->
                
         </div>
    <div class="row">
        <div class="col-md-6">
            Date :{{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-md-6 pull-right">
            
        </div>
    </div>
     
    
    <br/>
    
    <div class="form-group">
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

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>

</body>
</html>