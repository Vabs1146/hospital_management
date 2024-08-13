<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
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
        .col-sm-12,
        .col-xs-12 {
            width: 100% !important;
        }
        .col-sm-11,
        .col-xs-11 {
            width: 91.66666667% !important;
        }
        .col-sm-10,
        .col-xs-10 {
            width: 83.33333333% !important;
        }
        .col-sm-9,
        .col-xs-9 {
            width: 75% !important;
        }
        .col-sm-8,
        .col-xs-8 {
            width: 66.66666667% !important;
        }
        .col-sm-7,
        .col-xs-7 {
            width: 58.33333333% !important;
        }
        .col-sm-6,
        .col-xs-6 {
            width: 50% !important;
        }
        .col-sm-5,
        .col-xs-5 {
            width: 41.66666667% !important;
        }
        .col-sm-4,
        .col-xs-4 {
            width: 33.33333333% !important;
        }
        .col-sm-3,
        .col-xs-3 {
            width: 25% !important;
        }
        .col-sm-2,
        .col-xs-2 {
            width: 16.66666667% !important;
        }
        .col-sm-1,
        .col-xs-1 {
            width: 8.33333333% !important;
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
            font-size: 10px;
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
            display: none !important;
        }
    }

    </style>
</head>
<body>
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>

<div class="row">
    <div class="col-sm-6">
        <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
    </div>
    <div class="col-sm-6">

    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label for="date" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }}
    </div>
    <div class="col-sm-6">
        <label class="control-label">UHID Number :</label>   {{ $casedata['uhid_no'] }} 
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label for="date" class="control-label">Patient Name :</label>   {{ strtoupper($casedata['patient_name']) }}
    </div>
    <div class="col-sm-6">
       <label for="date" class="control-label">Follow-up Date and Time :</label>   {{ $casedata['appointment_dt'] }} {{ $casedata['appointment_timeslot'] }}
    </div>
</div>
<div class="row">
    
    <div class="col-sm-6">
        <label class="control-label">Address :</label>   {{ $casedata['patient_address'] }} 
    </div>
    <div class="col-sm-6">
        <label class="control-label">Contact No. :</label>   {{ $casedata['patient_mobile'] }}
    </div>
</div>

<!--------------------------------------->
	<br>
	 <br>
	 @if(!$CheckField::IsFieldEmpty($patient_details->Complaints))
	 <div class="row">
		 <div class="col-sm-12">
        <label class="control-label">Presenting Complaints with duration :</label>  {{($patient_details->Complaints)}}
    </div>
		 </div>
	   @endif
	 @if(!$CheckField::IsFieldEmpty($patient_details->History))
	 <div class="row">
		 <div class="col-sm-12">
        <label class="control-label">History :</label>  {{($patient_details->History)}}
    </div>
		 </div>
	 @endif
            <div class="row">
		@if(!$CheckField::IsFieldEmpty($patient_details->GenExamBuild))
		 <div class="col-sm-4">
        <label class="control-label">Build :</label>{{($patient_details->GenExamBuild)}}
                </div>
		@endif   
	  @if(!$CheckField::IsFieldEmpty($patient_details->GenExamHeight))
	 <div class="col-sm-4">
        <label class="control-label">Height :</label>{{$patient_details->GenExamHeight .' cm'}}
                </div>
		 @endif
      @if(!$CheckField::IsFieldEmpty($patient_details->GenExamWeight))
	 <div class="col-sm-4">
        <label class="control-label">Weight :</label>{{ $patient_details->GenExamWeight.' kg' }}
                </div>
		 </div>
         @endif
	 <div class="row">
		@if(!$CheckField::IsFieldEmpty($patient_details->BMI))
		 <div class="col-sm-4">
        <label class="control-label">HGT :</label>{{ $patient_details->BMI }}
                </div>
		@endif   
	  @if(!$CheckField::IsFieldEmpty($patient_details->Temp))
	 <div class="col-sm-4">
        <label class="control-label">Temp :</label>{{ $patient_details->Temp }}
                </div>
		 @endif
      @if(!$CheckField::IsFieldEmpty($patient_details->AG))
	 <div class="col-sm-4">
        <label class="control-label">SpO2 :</label>{{ $patient_details->AG }}
                </div>
		 </div>
         @endif
	 <div class="row">
		@if(!$CheckField::IsFieldEmpty($patient_details->GenExamPulse))
		 <div class="col-sm-4">
        <label class="control-label">Pulse :</label>{{  $patient_details->GenExamPulse .' per min' }}
                </div>
		@endif   
	  @if(!$CheckField::IsFieldEmpty($patient_details->GenExamBP))
	 <div class="col-sm-4">
        <label class="control-label">BP :</label>{{ $patient_details->GenExamBP . '/' . $patient_details->GenExamBP_lower . '...mmhg'  }}
                </div>
		 @endif
      @if(!$CheckField::IsFieldEmpty($patient_details->GenExamRR))
	 <div class="col-sm-4">
        <label class="control-label">RR :</label>{{ $patient_details->GenExamRR . ' per min' }}
                </div>
		 </div>
         @endif
 <div class="row">
		@if(!$CheckField::IsFieldEmpty($patient_details->GenExamPallor))
		 <div class="col-sm-4">
        <label class="control-label">CG :</label>{{ $patient_details->GenExamPallor }}
                </div>
		@endif
		 
 <div class="panel-body" >
    <div class="container-fluid">
     <div class="table-responsive">
    <table class="table  table-bordered">
        <tbody>
            <!-- @if(!$CheckField::IsFieldEmpty($patient_details->Complaints))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Presenting Complaints with duration :</label></td>
                <td>
                 {{($patient_details->Complaints)}}
                 
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->History))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">History</label></td>
                <td>
                 {{($patient_details->History)}}
                </td>
            </tr>
            @endif
             
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricMarriedSice))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Married Since </label></td>
                <td>
                 {{($patient_details->ObstetricMarriedSice)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricCMP))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Year</label></td>
                <td>
                 {{($patient_details->ObstetricCMP)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricG))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">G </label></td>
                <td>
                 {{($patient_details->ObstetricG)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricP))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">P</label></td>
                <td>
                 {{($patient_details->ObstetricP)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricL))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">L </label></td>
                <td>
                 {{($patient_details->ObstetricL)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricA))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">A </label></td>
                <td>
                 {{($patient_details->ObstetricA)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricD))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">D </label></td>
                <td>
                 {{($patient_details->ObstetricD)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ObstetricText))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Text </label></td>
                <td>
                 {{($patient_details->ObstetricText)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnecyLMP))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">LMP </label></td>
                <td>
                 {{($patient_details->presentPregnecyLMP)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnencyEDD))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">EDD </label></td>
                <td>
                 {{($patient_details->presentPregnencyEDD)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnencyUSG))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Edd by USG </label></td>
                <td>
                 {{($patient_details->presentPregnencyUSG)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->Education))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Education </label></td>
                <td>
                 {{($patient_details->Education)}}
                </td>
            </tr>
            @endif
           
            @if(!$CheckField::IsFieldEmpty($patient_details->GenExamBuild))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Build </label></td>
                <td>
                 {{($patient_details->GenExamBuild)}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamHeight))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Height </label></td>
                <td>
                 {{$patient_details->GenExamHeight .' cm'}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamWeight))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Weight </label></td>
                <td>
                  {{ $patient_details->GenExamWeight.' kg' }}
                </td>
            </tr>
            @endif
         
             @if(!$CheckField::IsFieldEmpty($patient_details->BMI))
            <tr>
              <td><label for="MensturationHistory" class="control-label">HGT </label></td>
                <td>
                  {{ $patient_details->BMI }}
                </td>
            </tr>
            @endif
              @if(!$CheckField::IsFieldEmpty($patient_details->Temp))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Temp </label></td>
                <td>
                  {{ $patient_details->Temp }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->AG))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Spo2 </label></td>
                <td>
                  {{ $patient_details->AG }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->GenExamPulse))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Pulse </label></td>
                <td>
                  {{  $patient_details->GenExamPulse .' per min' }}
                </td>
            </tr>
            @endif
              @if(!$CheckField::IsFieldEmpty($patient_details->GenExamBP))
            <tr>
              <td><label for="MensturationHistory" class="control-label">BP </label></td>
                <td>
                  {{ $patient_details->GenExamBP . '/' . $patient_details->GenExamBP_lower . '...mmhg'  }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamRR))
            <tr>
              <td><label for="MensturationHistory" class="control-label">RR </label></td>
                <td>
                  {{ $patient_details->GenExamRR . ' per min' }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamPallor))
            <tr>
              <td><label for="MensturationHistory" class="control-label">GC </label></td>
                <td>
                  {{ $patient_details->GenExamPallor }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->Cyanosis))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Cyanosis </label></td>
                <td>
                  {{ $patient_details->GenExamCyanosis  }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->Icterus))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Icterus </label></td>
                <td>
                  {{ $patient_details->GenExamIcterus }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->Edema))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Edema </label></td>
                <td>
                  {{ $patient_details->GenExamEdema }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->GenExamSkin))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Skin </label></td>
                <td>
                  {{ $patient_details->GenExamSkin }}
                </td>
            </tr>
            @endif-->
             @if(!$CheckField::IsFieldEmpty($patient_details->SysExamCVS))
            <tr>
              <td><label for="MensturationHistory" class="control-label">CVS </label></td>
                <td>
                  {{ $patient_details->SysExamCVS }}
                </td>
            </tr>
            @endif

            @if(!$CheckField::IsFieldEmpty($patient_details->SysExamRS))
            <tr>
              <td><label for="MensturationHistory" class="control-label">RS </label></td>
                <td>
                  {{ $patient_details->SysExamRS }}
                </td>
            </tr>
            @endif
			@if(!$CheckField::IsFieldEmpty($patient_details->PastPersonalHistory))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">CNS </label></td>
                <td>
                 {{($patient_details->PastPersonalHistory)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->menarch))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">P/A </label></td>
                <td>
                 {{($patient_details->menarch)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->SysExamPA))
            <tr>
              <td><label for="MensturationHistory" class="control-label">PA </label></td>
                <td>
                  {{ $patient_details->SysExamPA }}
                </td>
            </tr>
            @endif
            <!--@if(!$CheckField::IsFieldEmpty($patient_details->SysExamLocalExam))
            <tr>
              <td>{{ Form::label('SysExamLocalExam','Local/Examination') }} </td>
                <td>
                  {{ $patient_details->SysExamLocalExam }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->ProvisionalDiagnosis))
            <tr>
              <td>{{ Form::label('ProvisionalDiagnosis','Provisional Diagnosis') }}</td>
                <td>
                  {{ $patient_details->ProvisionalDiagnosis }}
                </td>
            </tr>
            @endif-->
            @if(!$CheckField::IsFieldEmpty($patient_details->InvestigationAdvice))
            <tr>
              <td>{{ Form::label('InvestigationAdvice','Investigation Advice') }}</td>
                <td>
                  {{ $patient_details->InvestigationAdvice }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->TreatmentAdvice))
            <tr>
              <td>{{ Form::label('TreatmentAdvice','Treatment Advice') }} </td>
                <td>
                  {{ $patient_details->TreatmentAdvice }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->Remark))
            <tr>
              <td>{{ Form::label('Remark','Remark') }} </td>
                <td>
                  {{ $patient_details->Remark }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->Text))
            <tr>
              <td>{{ Form::label('Text','Text') }} </td>
                <td>
                  {{ $patient_details->Text }}
                </td>
            </tr>
            @endif
            <!--@if(!$CheckField::IsFieldEmpty($casedata['appointment_dt']))
            <tr>
              <td>{{ Form::label('followupDate','Follow-up Date') }} </td>
                <td>
                  {{ $casedata['appointment_dt'] }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($casedata['appointment_timeslot']))
            <tr>
              <td>{{ Form::label('FollowUpTimeSlot','Follow up Time ') }}  </td>
                <td>
                  {{ $casedata['appointment_timeslot'] }}
                </td>
            </tr>
            @endif-->

          

        </tbody>
    </table>
 </div>
</div>
</div>
<!---------------------------------------->


@foreach(old('Report_file',$casedata['Reports_file']) as $reportfile)                        
<div class="row">
    <div class="col-sm-12">
        {{ $reportfile->report_title }} 
    </div>
    <div class="col-sm-12">
        {{ $reportfile->report_description }} 
    </div>
</div>
@endforeach


{{--
@if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
<BR/>
<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Prescription</label>  
    </div>
</div>
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
</table>
@endif

--}}

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
						 <td><strong>Times a day</strong></td>
						<td><strong>Day</strong></td>
                         <td><strong>Quantity</strong></td>
                        
                         
                         
                </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Sumtotal = 0; ?>
                                @foreach($casedata['prescriptions'] as $prescption)
                                <tr>
               <td>
                    {{  $loop->iteration }}
                </td>   
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
                                {{-- <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">{{ $Sumtotal }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Tax</strong></td>
    								<td class="no-line text-right">15%</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">{{ $Sumtotal + ($Sumtotal * (15/100))  }} </td>
    							</tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
    <div class="col-sm-12 pull-right">
            {{ config('app.name', 'Dr') }}
		</div>
</div>

<!-- asdfasdfa sdf asdf asdf -->
<br/>


<div class="row">
    <div class="col-sm-12">
        Note :  Please bring this paper on every visist / Please follow the time / Please inform allergy immediately 
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