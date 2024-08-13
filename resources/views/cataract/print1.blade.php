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
    </style>
</head>
<body>
@php
//dd($doctorlist->toArray())
@endphp
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
           <h3> <u>Cataract Notes</u> </h3>
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
            <div class="col-sm-6">
                <label for="IPD No." class="control-label">Patient Name :</label> 
                {{ $case_master['mr_mrs_ms'] }} {{ $case_master['patient_name'] }} {{ $case_master['middle_name'] }} {{ $case_master['last_name'] }}                  
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Age :</label> 
                {{ $case_master['patient_age'] }}              
            </div>
            <div class="col-sm-3">
                <label for="IPD No." class="control-label">Sex :</label> 
               {{ $case_master['male_female'] }}  
            </div>
        </div>
    </div>   
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Surgery :</label> 
            </div>
            <div class="col-sm-4">
                {{$case_master['surgery_date_time']}}              
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Dischagre :</label>  
            </div>
            <div class="col-sm-4">
                 {{$case_master['discharge_date_time']}}
            </div>
        </div>
    </div>  
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Surgeon Name :</label> 
            </div>
            <div class="col-sm-10">
				@php
					$doctorlist = $doctorlist->toArray();
				@endphp
                {{$doctorlist[$discharge->surgeon_name]?? ''}}
            </div>
        </div>
    </div> 

	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Anaesthetist :	</label> 
            </div>
            <div class="col-sm-4">
                <?php 
                         if(isset($newDischargeData['anaesthetistSurgeon']))
                        foreach ($newDischargeData['anaesthetistSurgeon'] as $key => $value) { ?>
                                {{ $value->field_value }} &nbsp;
                        <?php } ?>           
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Anesthesia :</label>  
            </div>
            <div class="col-sm-4">
                 <?php 
                         if(isset($newDischargeData['anesthesia']))
                        foreach ($newDischargeData['anesthesia'] as $key => $value) { ?>
                                {{ $value->field_value }} &nbsp;
                        <?php } ?>
            </div>
        </div>
    </div>
	
	<div class="row">   
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get() as  $item_key => $item)
	<div class="col-md-12">
		<div class="col-md-2"> @if($item_key == 0) <label for="IPD No." class="control-label">Diagnosis : 	</label>   @endif</div>

		<div class="col-md-5">
			{{$item->field_value_OD}}
		</div>
		<div class="col-md-5">
			{{$item->field_value_OS}}
		</div>
	</div>
	@endforeach
	</div>  
	
	<div class="row">   
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get() as  $item_key => $item)
	<div class="col-md-12">
		<div class="col-md-2"> @if($item_key == 0) <label for="IPD No." class="control-label">Surgery/Procedure : 	</label>   @endif</div>

		<div class="col-md-5">
			{{$item->field_value_OD}}
		</div>
		<div class="col-md-5">
			{{ucfirst($item->field_value_OS)}}
		</div>
	</div>
	@endforeach
	</div>  
	
    <div class="row">   
        <div class="col-sm-12">
			<div class="col-md-12">
            <h3><b>Procedure</b> :</h3>
			</div>
          </div>                                                    
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Section :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'section')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Site :</label>  
            </div>
            <div class="col-sm-4">
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'site')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach	 
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Size Of Wound :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'size_of_wound')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">No. Of Side Ports :</label>  
            </div>
            <div class="col-sm-4">
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'side_ports')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach	 
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">ACM :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'acm')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">CCC :</label>  
            </div>
            <div class="col-sm-4">
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ccc')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach	 
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Intra cameral  :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'intra_cameral')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Hydrodissect  :</label>  
            </div>
            <div class="col-sm-4">
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'hydrodissect')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach	 
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Hyrodelamination   :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'hyrodelamination')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Phacoemulisification   :</label>  
            </div>
            <div class="col-sm-4">
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'phacoemulisification')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach	 
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">SICS    :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'sics')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                 
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
    </div>
	
	@php
		$procedure_checkboxes_result = $form_details->eyeformmultipleentry()->where('field_name', 'procedure_checkboxes')->first();
		
		$procedure_checkboxes_array = (!empty($procedure_checkboxes_result) && isset($procedure_checkboxes_result)) ? explode(',', $procedure_checkboxes_result->field_value_OD) : [];
	@endphp
		
	<div class="col-md-12">
	@foreach($checkbox_array as $checkbox_array_key => $checkbox_array_val)
		<div class="col-md-3">
		
		
		<label ><?php if(in_array( $checkbox_array_key, $procedure_checkboxes_array)){ echo $checkbox_array_val; } ?> </label>
		
		</div>
	@endforeach
	</div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">IOL    :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'iol')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">IOL Type    :</label>  
            </div>
            <div class="col-sm-4">
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'iol_type')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach	 
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Stromal Hydration     :	</label> 
            </div>
            <div class="col-sm-4">
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'stromal_hydration')->get() as $item)
				<div class="col-md-12">
					{{$item->field_value_OD}}
				</div>
				@endforeach		         
            </div>
            <div class="col-sm-2">
                 
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
    </div>
	
	@php
		$sutures_array = $form_details->eyeformmultipleentry()->where('field_name', 'sutures')->first();
		
		$sutures = !empty($sutures_array) ? $sutures_array->field_value_OD : '';
	@endphp

	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Sutures      :	</label> 
            </div>
            <div class="col-sm-4">
				{{$sutures}}         
            </div>
            <div class="col-sm-2">
                 
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
    </div>
	
	@php
		$sc_injection_array = $form_details->eyeformmultipleentry()->where('field_name', 'sc_injection')->first();
		
		$sc_injection = !empty($sc_injection_array) ? $sc_injection_array->field_value_OD : '';
	@endphp
	
	@php
		$eye_patch_array = $form_details->eyeformmultipleentry()->where('field_name', 'eye_patch')->first();
		
		$eye_patch = !empty($eye_patch_array) ? $eye_patch_array->field_value_OD : '';

	@endphp

	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">S. C. Injection     :	</label> 
            </div>
            <div class="col-sm-4">
				{{$sc_injection}}      	         
            </div>
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Eye Patch     :</label>  
            </div>
            <div class="col-sm-4">
                {{$eye_patch}}      	  
            </div>
        </div>
    </div>
	
	@php
		$anaesthetist_notes_array = $form_details->eyeformmultipleentry()->where('field_name', 'anaesthetist_notes')->first();
		
		$anaesthetist_notes = !empty($anaesthetist_notes_array) ? $anaesthetist_notes_array->field_value_OD : '';
	@endphp
	
	<div class="row">
        <div class="col-sm-12"> 
            <div class="col-sm-2">
                <label for="IPD No." class="control-label">Anaesthetist Notes       :	</label> 
            </div>
            <div class="col-sm-10">
				 {{$anaesthetist_notes}}               
            </div>
        </div>
    </div>
	
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
 @if (isset($prescriptions) && count($prescriptions) > 0)
<div class="row">
    <div class="col-sm-12">
        <b> Prescription : </b>  
    </div>
    <div class="col-md-6 pull-right">
        
    </div>
</div>

    <div class="table-responsive">
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
    </div>
@endif 
	

   <!--  <br/> -->
   @if(isset($appointment) && count($appointment) > 0)
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

        <div class="col-lg-10">
            <label class="control-label"><center>
            In case of redness, pain in eyes, swelling, watering in eyes, please contact3,4, 1: emergency number : 8512043333</center>
            </label>
        </div>    

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