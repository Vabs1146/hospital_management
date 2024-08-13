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
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
           <h3> <u>DISCHARGE CARD</u> </h3>
        </div>
    </div>
    <!-- <div class="row">
        
        <div class="col-lg-4">
            <label for="Patient_IPDno" class="control-label">IPD no :</label>   {{ $discharge->IPD_no }}
        </div>
    </div> -->
    <div class="col-md-11" style="float: none;margin: 0 auto;">
    <div>
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <label for="IPD No." class="control-label">Date. :</label> 
           <!--{{ $insurance_bill->bill_date }}--> {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>     
    </div>
      <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4">
                <label for="Case No." class="control-label">Case No. :</label> 
                {{ $case_master['case_number'] }}                     
            </div>
            <div class="col-sm-4">
                <label for="IPD No." class="control-label">IPD No. :</label> 
                {{ $case_master['IPD_no'] }}  
                        
            </div>
            <div class="col-sm-4">
                <label for="IPD No." class="control-label">UHID No. :</label> 
                {{ $case_master['uhid_no'] }}
            </div>
            <!-- <div class="col-sm-3">
            <label for="IPD No." class="control-label">Bill No. :</label> 
               
                {{ $case_master['bill_number'] }}
            </div> -->
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-8">
                <label for="IPD No." class="control-label">Patient Name :</label> 
                {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}                 
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Age :</label> 
                {{ $case_master['patient_age'] }}              
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Sex :</label> 
               {{ $case_master['male_female'] }}  
            </div>
        </div>
    </div>  
	

	@if($case_master['patient_address'] !="" || $case_master['area'] != '' || $case_master['city'] != '' || $case_master['district'] != '')
	<div class="row">
	<div class="col-sm-12">
		@if($case_master['patient_address'])
		<div class="col-sm-6">
			<label class="control-label">Address :</label>   {{ $case_master['patient_address'] }} {{ $case_master['area'] }} {{ $case_master['city'] }} {{ $case_master['district'] }}
		</div>
		@endif
		<!--@if($case_master['district'])
		<div class="col-sm-6">
			<label class="control-label">Area :</label>   {{ $case_master['area'] }} 
		</div>
		@endif
		@if($case_master['city'])
		<div class="col-sm-6">
			<label class="control-label">City :</label>   {{ $case_master['city'] }}
		</div>
		@endif
		@if($case_master['district'])
			<div class="col-sm-6">
				<label class="control-label">District :</label>   {{ $case_master['district'] }} 
			</div>
		@endif-->
	</div>
	</div>
	@endif

    <!--<div class="row">   
        <div class="col-sm-12">
                <div class="col-sm-6">
                    <label for="IPD No." class="control-label">Eye:</label> 
                 @if($insurance_bill->left_eye == "1" && $insurance_bill->right_eye == "1")
                    Left & Right
                @elseif($insurance_bill->left_eye == "1" )
                    Left
                 @elseif($insurance_bill->right_eye == "1" )
                    Right
                 @endif
               </div>  
                 <div class="col-md-6">
                    
               </div>  
          </div>                                                    
    </div>-->
</div>


    <div class="row">
        <div class="col-sm-12">
           
        </div>
        <div class="col-md-6 pull-right">
            
        </div>
    </div>

        <div class="table-responsive">
            <table class="table table-bordered" style="width:100%">
               
                <tbody>   
               <tr>
                    <td>Admission Date & time: :</td>
                       <td colspan="2">
                            {{$case_master['admission_date_time']}}
                       </td>

               </tr>
               <tr>
                    <td>Surgery Date & Time:</td>
                    <td colspan="2">
                        {{$case_master['surgery_date_time']}}
                    </td>
               </tr>
               <tr>
                    <td>Dischagre Date & Time:</td>
                    <td colspan="2">
                    {{$case_master['discharge_date_time']}}
                    </td>                  
               </tr> 




				 
@php 
	$followup_date_time_data = $form_details->eyeformmultipleentry()->where('field_name', 'followup_date_time')->get();

	
@endphp
	@if(count($followup_date_time_data) > 0)
	<tr><td colspan="3"></td> </tr>	
	@foreach ($followup_date_time_data as $key => $item)
	<tr class="border no-collapse">
	<td>@if($key == 0) Followup date and time : @endif </td> 
	<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
	</tr>					
	@endforeach
@endif

<!-- <tr>
                    <td>22222222222222</td>
                    <td colspan="2">
                    11111111111111111
                    </td>                  
               </tr> --> 
				
				<!-- @if(isset($newDischargeData['anaesthetistSurgeon']) && $newDischargeData['anaesthetistSurgeon'][0] != "")
				               <tr>
				                   <td>Surgeon Name:</td>
				                   <td colspan="2">{{$surgeon_name->doctor_name}}</td>
				               </tr>
				               <tr>
				                   <td>Anaesthetist Surgeon :</td>
				                   <td colspan="2">
				                        <?php 
				                         if(isset($newDischargeData['anaesthetistSurgeon']))
				                        foreach ($newDischargeData['anaesthetistSurgeon'] as $key => $value) { ?>
				                                {{ $value->field_value }} &nbsp;
				                        <?php } ?>
				                   </td>
				               </tr>
							   @endif
							   
							   @if(isset($newDischargeData['anesthesia']) && $newDischargeData['anesthesia'][0] != "")
				               <tr>
				                   <td>Anesthesia :</td>
				                   <td colspan="2">
				                        <?php 
				                         if(isset($newDischargeData['anesthesia']))
				                        foreach ($newDischargeData['anesthesia'] as $key => $value) { ?>
				                                {{ $value->field_value }} &nbsp;
				                        <?php } ?>
				                   </td>
				               </tr>
						   @endif -->

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

		  
		  {{--
@php 
$surgery_procedure = $form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get();
@endphp
@if(count($surgery_procedure) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($surgery_procedure as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Surgery/Procedure : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td>
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif
--}}

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

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'investigation')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Investigation : @endif </td> 
<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'treatmentgiven')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Treatment Given : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td>
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'reasonofadmission')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Reason Of Admission : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td>
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'systemicdiseases')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Systemic Diseases : @endif </td> 
<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'surgerydetails')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Surgery Details : @endif </td> 
<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'surgeryvision')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Vision : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td> 
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Anterior Segment : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td> 
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Posterior Segment : @endif </td> 
<td> {{ucfirst($item->field_value_OD)}}	</td> 
<td> {{ucfirst($item->field_value_OS)}}	</td>
</tr>					
@endforeach
@endif

@php 
$query_data = $form_details->eyeformmultipleentry()->where('field_name', 'discharge_iol_name')->get();
@endphp
@if(count($query_data) > 0)
<tr><td colspan="3"></td> </tr>	
@foreach ($query_data as $key => $item)
<tr class="border no-collapse">
<td>@if($key == 0) Name of IOL : @endif </td> 
<td colspan="2"> {{ucfirst($item->field_value_OD)}}	</td>
</tr>					
@endforeach
@endif
			   
@if(isset($case_master['elective_emergency']) && $case_master['elective_emergency'] != "")
			   
		   <tr>
				<td>Elective / Emergency:</td>
				<td>
			   {{$case_master['elective_emergency']}}
				</td>                  
		   </tr>  

 @endif
			   
	@if(isset($newDischargeData['surgicalStepsNotes']) && $newDischargeData['surgicalStepsNotes'] != "")			   
                <tr>
                    <td>
                       Surgical / Operation Steps Notes
                    </td>   
                    <td>
                        <?php 
                            if(isset($newDischargeData['surgicalStepsNotes']))
                            foreach ($newDischargeData['surgicalStepsNotes'] as $key => $value) { ?>
                                {{ $value->field_value }} &nbsp;/&nbsp;
                        <?php } ?>
                    </td>
                 
                </tr>
				

 @endif

		
	   
				@if(isset($discharge->general_condition) && $discharge->general_condition != "")			   
               <tr>
                    <td>General Condition:</td>
                    <td>
                     {{$discharge->general_condition}}
                    </td>                  
               </tr>
			   
 @endif
			   
				@if(isset($newDischargeData['advice']) && $newDischargeData['advice'][0] != "")			   
               <tr>
                   <td>Advice  :</td>
                   <td>
                    <?php
                    if(isset($newDischargeData['advice']))
                    foreach ($newDischargeData['advice'] as $key => $value) { ?>
                        {{ $value->field_value }}   &nbsp;/&nbsp;
                    <?php } ?>
                   </td>
               </tr>
 @endif
 
                </tbody>
            </table>
        </div>
   

<!--     <div class="col-md-10" style="float: none;margin: 0 auto;"> 

  


        <div class="row">
        <div class="col-sm-6">
            <label for="date_admission" class="control-label">Review :</label>   {{$discharge->review}}
        </div>
       </div>


        <div class="row">
        <div class="col-sm-6">
            <label for="date_admission" class="control-label">For Emergency :</label>   Kindly call 9324942543
        </div>
       </div>
        <div class="row">
        <div class="col-sm-6">
 
            <img src="{{ url('/')}}/discharge_img/{{ $discharge->dischargeimg }}" style="    width: 206px;"> 
        </div>
       </div>

    </div> -->
    <br/>
 @if (count($prescriptions) > 0)
<!-- <div class="row">
    <div class="col-sm-12">
        <b> Prescription : </b>  
    </div>
    <div class="col-md-6 pull-right">
        
    </div>
</div> -->

    <!-- <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td><strong>Sr. No.</strong></td>
                    <td><strong>Medicine</strong></td>
                    <td><strong>Eye</strong></td>
                    <td><strong>Frequency</strong></td>
                    <td><strong><center>Duration</center></strong></td>
                </tr>
            </thead>
            <tbody>
            <?php $Sumtotal = 0; ?>
            @foreach($prescriptions as $prescption)
            <tr>
                <td>
                    {{  $loop->iteration }}
                </td>   
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                <td>
                    {{ $prescption->strength }}
                </td>
                <td>
                    {{ $prescption->numberoftimes }}
                </td>
                <td class="text-center">
                    {{ $prescption->medicine_Quntity }}
                </td>
            <tr>
             @endforeach
            </tbody>
        </table>
    </div> -->


	<div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Prescption summary</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
                         <td><strong>Medicine</strong></td>
                         <td><strong>Generic Medicine</strong></td>
                         <td><strong>Eye</strong></td>
                         <td><strong>Duration</strong></td>
                         <td><strong>Frequency</strong></td>
						 <td><strong>Date</strong></td>
						 <td><strong>Timing</strong></td>
                         
                </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Sumtotal = 0; ?>
                                @foreach($prescriptions as $prescption)
                                <tr>
                <td>
                    {{  $loop->iteration }}
                </td>   
                <td>
                    {{ $prescption->Medical_store->medicine_name }}
                </td>
                <td>
							{{ $prescption->generic_name }}
							</td>
                <td>
                    {{ $prescption->strength }}
                </td>
                <td >
                    {{ $prescption->medicine_Quntity }}
                </td>
				
				
				<td>
									@foreach($prescription_data[$prescption->id] as $prescription_data_row)
										{{ $prescription_data_row->frequency }}<hr>
									@endforeach
								</td>

								<td>
									@foreach($prescription_data[$prescption->id] as $prescription_data_row)
										{{ $prescription_data_row->date_from }} to {{ $prescription_data_row->date_to }}<hr>
									@endforeach
								</td>
				<td>
					{{ $prescption->medicine_timing }}
				</td>
                
            <tr>
                                 @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif 
	

   <!--  <br/> -->
   @if(count($appointment) > 0)
    <div class="col-sm-8">
		<div class="col-sm-3">
			<label for="date_admission" class="control-label"><b>Follow-up Date</b>:</label>  

		</div>
		<div class="col-sm-3">
			@foreach($appointment as $value)
				{{$value->date}} <br>
			@endforeach        
		</div>
   </div> 
   @endif
  <!--   <div class="row">
        <div class="col-lg-12">
            <label class="control-label">In case of Emergency : 1. Severe Redness/watering pain or 2. Sudden diminished vision
                    Pls. contact : 8055821212 ( Dr. Sandeep C. Joshi)  </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            Date :{{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-md-6 pull-right">
            
        </div>
    </div> -->
     <!-- <br/> -->

         

    <br/>

    <div class="col-sm-12" style="margin-top: 20px;">
        <label class="control-label">IOL Sticker</label>
        <div style="height:80px;"></div>
    </div>
    <div class="col-md-12" style="float: none; margin: 0 auto;">
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
	 <br/>
		<div class="col-lg-10">
            <label class="control-label"><center>
            In case of redness, pain in eyes, swelling, watering in eyes, please contact</center>
            </label>
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