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
 <div class="panel-body" >
    <div class="container-fluid">
     <div class="table-responsive">
	 
    <table class="table  table-bordered">
        <tbody>
             @if(!$CheckField::IsFieldEmpty($patient_details->wife_name))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Wife Name </label></td>
                <td>
                 {{($patient_details->wife_name)}}
                 
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->wife_age))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Wife Age</label></td>
                <td>
                 {{($patient_details->wife_age)}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->husband_name))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Husband Name </label></td>
                <td>
                 {{($patient_details->husband_name)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->husband_age))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Husband Age </label></td>
                <td>
                 {{($patient_details->husband_age)}}
                </td>
            </tr>
            @endif

			
   

            @if(!$CheckField::IsFieldEmpty($patient_details->married_since))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Married Since </label></td>
                <td>
                 {{($patient_details->married_since)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->menstrual_history))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Menstrual History</label></td>
                <td>
                 {{($patient_details->menstrual_history)}}
                </td>
            </tr>
            @endif

			 
   

            @if(!$CheckField::IsFieldEmpty($patient_details->lmp))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">LMP </label></td>
                <td>
                 {{($patient_details->lmp)}}
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
            @if(!$CheckField::IsFieldEmpty($patient_details->obstetric_history))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Obstetric History </label></td>
                <td>
                 {{($patient_details->obstetric_history)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->other_medical_surgical_illness))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Other Medical Surgical Illness </label></td>
                <td>
                 {{($patient_details->other_medical_surgical_illness)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->other_art_procedure_past))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Other ART Procedure In Past </label></td>
                <td>
                 {{($patient_details->other_art_procedure_past)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->hsg))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">HSG</label></td>
                <td>
                 {{($patient_details->hsg)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->laproscopy))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Laproscopty</label></td>
                <td>
                 {{($patient_details->laproscopy)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->hsf))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">HSF</label></td>
                <td>
                 {{($patient_details->hsf)}}
                </td>
            </tr>
            @endif
	
 </tbody>
    </table>


@if(!$CheckField::IsFieldEmpty($patient_details->lh) || !$CheckField::IsFieldEmpty($patient_details->fsh) || !$CheckField::IsFieldEmpty($patient_details->tsh) || !$CheckField::IsFieldEmpty($patient_details->prolactin) || !$CheckField::IsFieldEmpty($patient_details->amh))
		 <table class="table  table-bordered">
        <tbody>
		<tr>
				<td colspan="10">
					<label for="MensturationHistory" class="control-label">Hormones</label>
				</td>
		</tr>
		<tr>
            @if(!$CheckField::IsFieldEmpty($patient_details->lh))
            
              <td> <label for="MensturationHistory" class="control-label">LH</label></td>
                <td>
                 {{($patient_details->lh)}}
                </td>
            
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->fsh))
            
              <td> <label for="MensturationHistory" class="control-label">FSH</label></td>
                <td>
                 {{($patient_details->fsh)}}
                </td>
           
            @endif
           
            @if(!$CheckField::IsFieldEmpty($patient_details->tsh))
           
              <td> <label for="MensturationHistory" class="control-label">TSH</label></td>
                <td>
                 {{($patient_details->tsh)}}
                </td>
            
            @endif

             @if(!$CheckField::IsFieldEmpty($patient_details->prolactin))
            
              <td> <label for="MensturationHistory" class="control-label">Prolactin</label></td>
                <td>
                 {{$patient_details->prolactin}}
                </td>
            
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->amh))
           
              <td><label for="MensturationHistory" class="control-label">AMH </label></td>
                <td>
                  {{ $patient_details->amh}}
                </td>
            
            @endif
			</tr>
	 </tbody>
    </table>
	@endif

	@if(!$CheckField::IsFieldEmpty($patient_details->folliculometry) || !$CheckField::IsFieldEmpty($patient_details->adviced))
	<table class="table  table-bordered">
        <tbody>
         
             @if(!$CheckField::IsFieldEmpty($patient_details->folliculometry))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Folliculometry </label></td>
                <td>
                  {{ $patient_details->folliculometry }}
                </td>
            </tr>
            @endif
              @if(!$CheckField::IsFieldEmpty($patient_details->adviced))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Adviced </label></td>
                <td>
                  {{ $patient_details->adviced }}
                </td>
            </tr>
            @endif
            
        </tbody>
    </table>
	@endif
 
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

@if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
<BR/>
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
@endif
<!-- asdfasdfa sdf asdf asdf -->
<br/>
<div class="row">
    <div class="col-sm-12">
        <label class="control-label">Note : </label> 
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        Please bring this paper on every visist 
    </div>
    <div class="col-sm-12">
        Please follow the time 
    </div>
    <div class="col-sm-12">
        Please inform allergy immediately 
    </div>
</div>
<div class="row">
    <div class="col-sm-12 pull-right">
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