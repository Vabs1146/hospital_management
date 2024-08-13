<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
    /* Print styling */
 
 .list-group1 li
 {
    float: left;
    list-style-type: square;
    margin: 10px 20px;
    padding:0px;
 }
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
            font-size: 14px;
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
    @if($logoUrl)
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
	@endif
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">
            <label for="date" class="control-label">Time :</label>   
            {{ $casedata['visit_time'] }}
        </div>
    </div>
    <div class="row">
            <div class="col-sm-6">
                <label for="case_number" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }} 
            </div>
            <div class="col-sm-6">
                    <label class="control-label">UHID NO :</label>   {{ $case_master['uhid_no'] }}
                </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="Patient_name" class="control-label">Patient Name :</label>    {{ $casedata['mr_mrs_ms'] }} {{ $casedata['patient_name'] }} {{ $casedata['middle_name'] }} {{ $casedata['last_name'] }}
            </div>
            <div class="col-sm-6">
                
                <div class="col-sm-6">
                    <label class="control-label">Age :</label>   {{ $casedata['patient_age'] }}
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Gender :</label>   {{ $casedata['male_female'] }}
                </div>
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
		@if($casedata['area'] != '' || $casedata['city'] != '' || $casedata['district'] != '')
		<div class="row">
			@if($casedata['district'])
            <div class="col-sm-6">
                <label class="control-label">Area :</label>   {{ $casedata['area'] }} 
            </div>
			@endif
			@if($casedata['city'])
            <div class="col-sm-6">
                <label class="control-label">City :</label>   {{ $casedata['city'] }}
            </div>
			@endif
			@if($casedata['district'])
				<div class="col-sm-6">
					<label class="control-label">District :</label>   {{ $casedata['district'] }} 
				</div>
			@endif
        </div>
		@endif
		
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Appointment Dt :</label>   {{ $casedata['appointment_dt'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Appointment Time. :</label>   {{ $casedata['appointment_timeslot'] }}
            </div>
        </div>
        
        @if(!$CheckField::IsFieldEmpty($form_details->CNS) && !in_array('CNS', $print_eyeformFields))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">General Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
                </div>
            </div>
        @endif
        <br>
        <br>
        <div class="table-responsive">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <td >
                             
                        </td>
                        <td >
                            <strong>OD</strong>
                        </td>
                        <td >
                            <strong>OS</strong>
                        </td>
                    </tr>
                </thead>
                <tbody>
					@if(!in_array('ChiefComplaint', $print_eyeformFields))
						@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Chief Complaint
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}} @if($item->duration_od) - {{$item->duration_od}} @endif
                                </td>
                                <td>
                                    {{$item->field_value_OS}} @if($item->duration_os) - {{$item->duration_os}} @endif
                                </td>
                            </tr>                            
                        @endforeach 
					@endif

					@if(!in_array('OpthalHistory', $print_eyeformFields))
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Ophthalmic History     
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}} @if($item->duration_od) - {{$item->duration_od}} @endif
                                </td>
                                <td>
                                    {{$item->field_value_OS}} @if($item->duration_os) - {{$item->duration_os}} @endif
                                </td>
                            </tr>                            
                        @endforeach
					@endif

					@if(!in_array('patients_systemic_history', $print_eyeformFields))
                       @foreach ($form_details->patients_systemic_history as $item)
							<tr>
								<td>
									@if ($loop->iteration == 1)
										Systemic History
									@endif
								</td>
								<td colspan="2">
									{{$item->value}} @if($item->duration) - {{$item->duration}} @endif
								</td>
							</tr>
						@endforeach
					@endif

			@if(!in_array('pastHistory', $print_eyeformFields))
				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'pastHistory')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pastHistory')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Past History
                            @endif
                        </td>
                        <td colspan="2">
                            {{$item->field_value_OD}}
                        </td>
                    </tr>
					@endforeach
				@endif
			@endif


                @if(!$CheckField::IsFieldEmpty($form_details->familyHistory) && !in_array('familyHistory', $print_eyeformFields))
                <tr>
                    <td>
                        Family History
                    </td>
                    <td colspan="2">
                        {{ nl2br($form_details->familyHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->birthHistory) && !in_array('birthHistory', $print_eyeformFields))
                <tr>
                    <td>
                        Birth History
                    </td>
                    <td colspan="2">
                        {{ nl2br($form_details->birthHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->pastTreatmentHistory) && !in_array('pastTreatmentHistory', $print_eyeformFields))
                <tr>
                    <td>
                        Past Treatment History
                    </td>
                    <td colspan="2">
                        {{ nl2br($form_details->pastTreatmentHistory) }}
                    </td>
                </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->dvn_od) && !$CheckField::IsFieldEmpty($form_details->dvn_os) && !in_array('dvn_od', $print_eyeformFields))
                    <tr>
                        <td>
                            Distant Vision Unaided
                        </td>
                        <td>
                            {{ $form_details->dvn_od }}
                        </td>
                        <td>
                            {{ $form_details->dvn_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->nvn_od) && !$CheckField::IsFieldEmpty($form_details->nvn_os) && !in_array('nvn_od', $print_eyeformFields))
                    <tr>
                        <td>
                            Near Vision Unaided
                        </td>
                        <td>
                            {{ $form_details->nvn_od }}
                        </td>
                        <td>
                            {{ $form_details->nvn_os }}
                        </td>
                    </tr>
                @endif
                 @if(!$CheckField::IsFieldEmpty($form_details->withpinhole_OD) && !$CheckField::IsFieldEmpty($form_details->withpinhole_OS) && !in_array('withpinhole_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            With Pinhole
                        </td>
                        <td>
                            {{ $form_details->withpinhole_OD }}
                        </td>
                        <td>
                            {{ $form_details->withpinhole_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->visualacuity_OD) && !$CheckField::IsFieldEmpty($form_details->visualacuity_OS) && !in_array('visualacuity_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            PGP
                        </td>
                        <td>
                            {{ $form_details->visualacuity_OD }}
                        </td>
                        <td>
                            {{ $form_details->visualacuity_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->colour_vision_OD) && !$CheckField::IsFieldEmpty($form_details->colour_vision_OS) && !in_array('colour_vision_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            DVN (With Glasses)
                        </td>
                        <td>
                            {{ $form_details->colour_vision_OD }}
                        </td>
                        <td>
                            {{ $form_details->colour_vision_OS }}
                        </td>
                    </tr>
                @endif

				@if(!$CheckField::IsFieldEmpty($form_details->with_glass_dilated_od) && !$CheckField::IsFieldEmpty($form_details->with_glass_dilated_od) && !in_array('with_glass_dilated', $print_eyeformFields))
                    <tr>
                        <td>
                            With Glass Dilated
                        </td>
                        <td>
                            {{ $form_details->with_glass_dilated_od }}
                        </td>
                        <td>
                            {{ $form_details->with_glass_dilated_os }}
                        </td>
                    </tr>
                @endif
                <!--          =====================================================               -->
                       

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'colour')->get()) > 0) && !in_array('colour', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'colour')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				colour  Vision
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest1')->get()) > 0) && !in_array('schimerTest1', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest1')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				Schimer Test 1
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest2')->get()) > 0) && !in_array('schimerTest2', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest2')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				Schimer Test 2
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'tear_film_breakup_time')->get()) > 0) && !in_array('tear_film_breakup_time', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'tear_film_breakup_time')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				Tear Film Breakup Time
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'eye_sonography')->get()) > 0)  && !in_array('eye_sonography', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'eye_sonography')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				Eye Sonography
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get()) > 0) && !in_array('OCT', $print_eyeformFields))
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item)
<tr>
	<td>
		@if ($loop->iteration == 1)
			Optical Coherence tomography (OCT)
		@endif
	</td>
	<td>
		{{$item->field_value_OD}}
	</td>
	<td>
		{{$item->field_value_OS}}
	</td>
</tr>
@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get()) > 0) && !in_array('EOM', $print_eyeformFields))
@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item)
<tr>
	<td>
		@if ($loop->iteration == 1)
			Extra Ocular Movement (EOM)
		@endif
	</td>
	<td>
		{{$item->field_value_OD}}
	</td>
	<td>
		{{$item->field_value_OS}}
	</td>
</tr>
@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'perimetry_sp')->get()) > 0) && !in_array('perimetry_sp', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'perimetry_sp')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
			Perimetry
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

@if((count($form_details->eyeformmultipleentry()->where('field_name', 'laser_sp')->get()) > 0) && !in_array('laser_sp', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'laser_sp')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				Laser
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif
                        
@if((count($form_details->eyeformmultipleentry()->where('field_name', 'oculizer_sp')->get()) > 0)  && !in_array('oculizer_sp', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'oculizer_sp')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				Oculizer
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif

 @if((count($form_details->eyeformmultipleentry()->where('field_name', 'ffa_sp')->get()) > 0) && !in_array('ffa_sp', $print_eyeformFields))
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ffa_sp')->get() as $key => $item)
	
	<tr>
		<td>
			@if ($loop->iteration == 1)
				FFA
			@endif
		</td>
		<td>
			{{$item->field_value_OD}}
		</td>
		
		<td>
			{{$item->field_value_OS}}
		</td>
	</tr>
	@endforeach
@endif
                        
<!--      ==============================================================-->
                @if(!$CheckField::IsFieldEmpty($form_details->withglasses_OD) && !$CheckField::IsFieldEmpty($form_details->withglasses_OS) && !in_array('withglasses_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            NVN (With Glasses)
                        </td>
                        <td>
                            {{ $form_details->withglasses_OD }}
                        </td>
                        <td>
                            {{ $form_details->withglasses_OS }}
                        </td>
                    </tr>
                @endif
				
				@if(!in_array('Lids', $print_eyeformFields)) 
						@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Lids')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Lids
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}}
                                </td>
                            </tr>                            
                        @endforeach
                @endif
				
				@if(!in_array('OrbitSacsEyeMotility', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OrbitSacsEyeMotility')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Orbit
                            @endif
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @endif
				
				@if(!in_array('ConjAndLids', $print_eyeformFields)) 
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                Conj
                            @endif
                        </td>
                        <td>
                            {{$item->field_value_OD}}
                        </td>
                        <td>
                            {{$item->field_value_OS}}
                        </td>
                    </tr>                            
                @endforeach
                @endif
				
				@if(!in_array('cornia', $print_eyeformFields)) 
                @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'cornia')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Cornea
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
				 @endif

                @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1) && !empty($form_details->OsImg1) && !is_null($form_details->OsImg1) && !in_array('cornia_image', $print_eyeformFields))
                <tr>
                   <td></td>
                   <td>
                        @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))
                            <p>&nbsp;</p>
                            <center id="wPaint-OdImg1"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                            </center>
                        @endif
                   </td>
                   <td>
                        @if (!empty($form_details->OsImg1) && !is_null($form_details->OsImg1))                        
                            <p>&nbsp;</p>
                            <center id="wPaint-OsImg1"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg1)."?".filemtime(Storage::path($form_details->OsImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />  
                            </center>
                        @endif
                   </td>
                </tr>
				<tr>
                   <td></td>
					<td>{{$form_details->OdImg1_comment}}</td>
					<td>{{$form_details->OsImg1_comment}}</td>
				</tr>
                @endif
						
						@if(!in_array('AC', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'AC')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    AC
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}}
                                </td>
                            </tr>                            
                        @endforeach
						@endif
				
						@if(!in_array('IRIS', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'IRIS')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Iris
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}}
                                </td>
                            </tr>                            
                        @endforeach
						@endif
				
						@if(!in_array('pupilIrisac', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pupilIrisac')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Pupil
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
						@endif
				
						@if(!in_array('lens', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'lens')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Lens
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
				@endif

                        @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2) && !empty($form_details->OsImg2) && !is_null($form_details->OsImg2) && !in_array('fundus_image', $print_eyeformFields))
                <tr>
                   <td></td>
                   <td>
                        @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2))
                            <p>&nbsp;</p>
                            <center id="wPaint-OdImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OdImg2)."?".filemtime(Storage::path($form_details->OdImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                            </center>
                        @endif
                   </td>
                   <td>
                        @if (!empty($form_details->OsImg2) && !is_null($form_details->OsImg2))                        
                            <p>&nbsp;</p>
                            <center id="wPaint-OsImg2"> 
                                    <img src={{ Storage::disk('local')->url($form_details->OsImg2)."?".filemtime(Storage::path($form_details->OsImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />  
                            </center>
                        @endif
                   </td>
                </tr>
				<tr>
                   <td></td>
					<td>{{$form_details->OdImg2_comment}}</td>
					<td>{{$form_details->OsImg2_comment}}</td>
				</tr>
                @endif

                
						@if(!in_array('vitreoretinal', $print_eyeformFields)) 
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item)
                <tr>
                    <td>
                        @if ($loop->iteration == 1)
                            Vitreins
                        @endif
                    </td>
                    <td>
                        {{$item->field_value_OD}}
                    </td>
                    <td>
                        {{$item->field_value_OS}}
                    </td>
                </tr>
                @endforeach
						@endif
				
						@if(!in_array('Retina', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Retina')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Retina
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}} {{ ($item->duration_od == 'none') ? '' : ' - '. ucfirst($item->duration_od)}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}} {{ ($item->duration_os == 'none') ? '' : ' - '. ucfirst($item->duration_os)}}
                                </td>
                            </tr>                            
                        @endforeach
						@endif
				
						@if(!in_array('ONH', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ONH')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    ONH
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}}
                                </td>
                            </tr>                            
                        @endforeach
						@endif
				
						@if(!in_array('Macula', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Macula')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Macula
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}}
                                </td>
                            </tr>                            
                        @endforeach
						@endif
				
						@if(!in_array('sac', $print_eyeformFields)) 
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'sac')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Sac
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                <td>
                                    {{$item->field_value_OS}}
                                </td>
                            </tr>                            
                        @endforeach
                        @endif
            
                
                @if(!$CheckField::IsFieldEmpty($form_details->IOP_OD) && !$CheckField::IsFieldEmpty($form_details->IOP_OS) && !in_array('IOP_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            IOP
                        </td>
                        <td>
                            {{ $form_details->IOP_OD }} {{($form_details->iop_od_time) ? '['.$form_details->iop_od_time.']': ''}}
                        </td>
                        <td>
                            {{ $form_details->IOP_OS }} {{($form_details->iop_os_time) ? '['.$form_details->iop_os_time.']': ''}}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->Ratio_OD) && !$CheckField::IsFieldEmpty($form_details->Ratio_OS) && !in_array('Ratio_OD', $print_eyeformFields))
                    <tr>
                        <td>
                           CD Ratio
                        </td>
                        <td>
                            {{ $form_details->Ratio_OD }}
                        </td>
                        <td>
                            {{ $form_details->Ratio_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->Pachymetry_OD) && !$CheckField::IsFieldEmpty($form_details->Pachymetry_OS) && !in_array('Pachymetry_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            Pachymetry
                        </td>
                        <td>
                            {{ $form_details->Pachymetry_OD }}
                        </td>
                        <td>
                            {{ $form_details->Pachymetry_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->CCT_OD) && !$CheckField::IsFieldEmpty($form_details->CCT_OS) && !in_array('CCT_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            CCT
                        </td>
                        <td>
                            {{ $form_details->CCT_OD }}
                        </td>
                        <td>
                            {{ $form_details->CCT_OS }}
                        </td>
                    </tr>
                @endif
				@if(!in_array('diagno', $print_eyeformFields))
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'diagno')->get() as $item)
					<tr>
						<td>
							@if ($loop->iteration == 1)
								Diagnosis
							@endif
						</td>
						<td>
							{{$item->field_value_OD}}
						</td>
						<td>
							{{$item->field_value_OS}}
						</td>
					</tr>
					@endforeach
                @endif

                @if(!$CheckField::IsFieldEmpty($form_details->k1_od) && !$CheckField::IsFieldEmpty($form_details->k1_os) && !in_array('k1_od', $print_eyeformFields))
                    <tr>
                        <td>
                            K1
                        </td>
                        <td>
                            {{ $form_details->k1_od }}
                        </td>
                        <td>
                            {{ $form_details->k1_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->k2_od) && !$CheckField::IsFieldEmpty($form_details->k2_os) && !in_array('k2_od', $print_eyeformFields))
                    <tr>
                        <td>
                            K2
                        </td>
                        <td>
                            {{ $form_details->k2_od }}
                        </td>
                        <td>
                            {{ $form_details->k2_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->lenspower_od) && !$CheckField::IsFieldEmpty($form_details->lenspower_os) && !in_array('lenspower_od', $print_eyeformFields))
                    <tr>
                        <td>
                            Lens Power
                        </td>
                        <td>
                            {{ $form_details->lenspower_od }}
                        </td>
                        <td>
                            {{ $form_details->lenspower_os }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->axial_length_OD) && !$CheckField::IsFieldEmpty($form_details->axial_length_OS) && !in_array('axial_length_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            Axial Lenght
                        </td>
                        <td>
                            {{ $form_details->axial_length_OD }}
                        </td>
                        <td>
                            {{ $form_details->axial_length_OS }}
                        </td>
                    </tr>
                @endif
                @if(!$CheckField::IsFieldEmpty($form_details->KC_OD) && !$CheckField::IsFieldEmpty($form_details->KC_OS) && !in_array('KC_OD', $print_eyeformFields))
                    <tr>
                        <td>
                            KC
                        </td>
                        <td>
                            {{ $form_details->KC_OD }}
                        </td>
                        <td>
                            {{ $form_details->KC_OS }}
                        </td>
                    </tr>
                @endif
               
                </tbody>
            </table>
        </div>
        @if(!$CheckField::IsFieldEmpty($form_details->otherDetailsDiagnosis) && !in_array('otherDetailsDiagnosis', $print_eyeformFields))
                <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Diagnosis :</label>   {!! nl2br($form_details->otherDetailsDiagnosis) !!} 
                        </div>
                    </div>
                @endif
                


<!-- ========================================================================================================== -->

@php 
$is_first = 0;
$otherDetailsDiagnosis = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsDiagnosis')->get();
$otherDetailsAnteriorSegment = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAnteriorSegment')->get();
$otherDetailsPosteriorSegment = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsPosteriorSegment')->get();
$other_details_treatment_given = $form_details->eyeformmultipleentry()->where('field_name', 'other_details_treatment_given')->get();
$otherDetailsAdditionalInformation = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdditionalInformation')->get();
$planOfManagement = $form_details->eyeformmultipleentry()->where('field_name', 'planOfManagement')->get();

$otherDetailsAdvice = $form_details->eyeformmultipleentry()->where('field_name', 'otherDetailsAdvice')->get();
$otherDetailsSurgery = $form_details->eyeformmultipleentry()->where('field_name', 'surgery')->get();
@endphp

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table  table-bordered">
				<thead>
					<tr>
						<td > </td>
						<td > <strong>OD</strong> </td>
						<td > <strong>OS</strong> </td>
					</tr>
				</thead>
				<tbody>
					@if(count($otherDetailsDiagnosis))
						@foreach($otherDetailsDiagnosis as $item_key => $item)
						<tr>
							<td > 
									@if($item_key == 0) 
									  Diagnosis
									@endif 
							</td>
							<td > <strong>{{$item->field_value_OD}}</strong> </td>
							<td > <strong>{{$item->field_value_OS}}</strong> </td>
						</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif

					@if(count($other_details_treatment_given))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($other_details_treatment_given as $item_key => $item)
							<tr>
								
								<td > 
									@if($item_key == 0) 
									  Treatment Given
									@endif 
								</td>
							
								<!-- <td > {{($item_key == 0) ? 'Treatment Given' : '' }} </td> -->
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif
					

					@if(count($otherDetailsAnteriorSegment))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif
						@foreach($otherDetailsAnteriorSegment as $item_key => $item)
							<tr>
								<td > 
									@if($item_key == 0) 
									  Anterior Segment
									@endif 
								</td>
								<!-- <td > {{($item_key == 0) ? 'Anterior Segment' : '' }} </td> -->
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($otherDetailsPosteriorSegment))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif
						@foreach($otherDetailsPosteriorSegment as $item_key => $item)
							<tr>
								<td > 
									@if($item_key == 0) 
									  Posterior Segment
									@endif 
								</td>
								<!-- <td > {{($item_key == 0) ? 'Posterior Segment' : '' }} </td> -->
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif

					

					


					@if(count($otherDetailsAdditionalInformation))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($otherDetailsAdditionalInformation as $item_key => $item)
							<tr>
								<td > 
									@if($item_key == 0) 
									  Additional Information
									@endif 
								</td>
								<!-- <td > {{($item_key == 0) ? 'Additional Information' : '' }} </td> -->
								<td colspan="2"> <strong>{{$item->field_value_OD}}</strong> </td>
								<!-- <td > <strong>{{$item->field_value_OS}}</strong> </td> -->
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($planOfManagement))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($planOfManagement as $item_key => $item)
							<tr>
								<td > 
									@if($item_key == 0) 
									  Plan Of Management
									@endif 
								</td>
								<!-- <td > {{($item_key == 0) ? 'Plan Of Management' : '' }} </td> -->
								<td colspan="2"> <strong>{{$item->field_value_OD}}</strong> </td>
								<!-- <td > <strong>{{$item->field_value_OS}}</strong> </td> -->
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					
					@if(count($otherDetailsAdvice))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($otherDetailsAdvice as $item_key => $item)
							<tr>
								<td > 
									@if($item_key == 0) 
									  Advice
									@endif 
								</td>
								<!-- <td > {{($item_key == 0) ? 'Advice' : '' }} </td> -->
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


					@if(count($otherDetailsSurgery))
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						@foreach($otherDetailsSurgery as $item_key => $item)
							<tr>
								<td > 
									@if($item_key == 0) 
									 Surgery/Procedure
									@endif 
								</td>
								<!-- <td > {{($item_key == 0) ? 'Surgery/Procedure' : '' }} </td> -->
								<td > <strong>{{$item->field_value_OD}}</strong> </td>
								<td > <strong>{{$item->field_value_OS}}</strong> </td>
							</tr>
						@endforeach
						@php $is_first = 1; @endphp
					@endif


@php 
$other_details_comment = $form_details->eyeformmultipleentry()->where('field_name', 'other_details_comment')->first();

$other_details_comment_val = $other_details_comment->field_value_OD??'';
@endphp

					@if($other_details_comment_val)
						@if($is_first == 1)
							<tr><td colspan="3"> </td></tr>
						@endif

						<tr>
							<td > 
								Comment 
							</td>
							<!-- <td > Comment : </td> -->
							<td colspan="2"> <strong>{{$other_details_comment_val}}</strong> </td>
							<!-- <td > <strong>{{$item->field_value_OS}}</strong> </td> -->
						</tr>
						@php $is_first = 1; @endphp
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- ========================================================================================================== -->



				 @if(count($form_details->uveiitis_bloodtests_data) && !in_array('uveiitis_bloodtests_data', $print_eyeformFields))
                <div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table  table-bordered">
									<tbody>
										<tr>
												
												<td>
													Blood Investigation
												</td>
												
												<td >
													
												</td>
											</tr>
										
										@php $test_type = ""; @endphp
										@foreach($form_details->uveiitis_bloodtests_data as $key => $item)
											<tr>
												
												<td>
													@if($item->test_type != $test_type) 
														{{$item->test_type}} 
													@endif

													@php $test_type = $item->test_type; @endphp
												</td>
												
												<td >
													<strong>{{$item->value}}</strong>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
                </div>
                @endif
       
        @if(!$CheckField::IsFieldEmpty($form_details->localExamReport))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Additional Information :</label>   {!! nl2br($form_details->localExamReport) !!} 
                </div>
            </div>
        @endif

        @if(!empty($casedata->appointment_dt) && !is_null($casedata->appointment_dt) && !isset($casedata->appointment_dt))
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">Followup Date :</label>   {{ $casedata['appointment_dt'] }} 
                </div>
            </div>
        
            <br>
            <br>
            <br>
        @endif
        
        
        <!--                ==================================================-->
@if($eyform_vision_pgp_details  && !in_array('pgp', $print_eyeformFields))
    @if($eyform_vision_pgp_details->vision_pgp_dv_sph_r || $eyform_vision_pgp_details->vision_pgp_dv_cyl_r || $eyform_vision_pgp_details->vision_pgp_dv_axis_r || $eyform_vision_pgp_details->vision_pgp_dv_vision_r || $eyform_vision_pgp_details->vision_pgp_dv_sph_l || $eyform_vision_pgp_details->vision_pgp_dv_cyl_l || $eyform_vision_pgp_details->vision_pgp_dv_axis_l || $eyform_vision_pgp_details->vision_pgp_dv_vision_l || $eyform_vision_pgp_details->vision_pgp_nv_sph_r || $eyform_vision_pgp_details->vision_pgp_nv_cyl_r || $eyform_vision_pgp_details->vision_pgp_nv_axis_r || $eyform_vision_pgp_details->vision_pgp_nv_vision_r || $eyform_vision_pgp_details->vision_pgp_nv_sph_l || $eyform_vision_pgp_details->vision_pgp_nv_cyl_l || $eyform_vision_pgp_details->vision_pgp_nv_axis_l || $eyform_vision_pgp_details->vision_pgp_nv_vision_l)
 <div> 
    PGP
</div>
    @include('EyeForm.view_templates.eyform_vision_pgp_details')
@endif
@endif

@if($eyform_refraction_retina_scopy_details && !in_array('refraction1', $print_eyeformFields))
    @if($eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_sph_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_cyl_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_axis_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_vision_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_sph_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_cyl_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_axis_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_dv_vision_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_sph_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_cyl_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_axis_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_vision_r || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_sph_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_cyl_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_axis_l || $eyform_refraction_retina_scopy_details->retinaCopy_refraction_nv_vision_l)
 <div> 
                            Retina Scopy
                        </div>
    @include('EyeForm.view_templates.eyform_refraction_retina_scopy_details')
@endif
    @endif



<!--                ==================================================-->
 @if(($form_details->sph_r_undi || $form_details->cyl_r_undi || $form_details->Axis_r_undi || $form_details->vision_r_sa || $form_details->Add_r_sa || $form_details->Nvision_r_sa || $form_details->sph_l_undi || $form_details->cyl_l_undi || $form_details->Axis_l_undi || $form_details->vision_l_sa || $form_details->Add_l_sa || $form_details->Nvision_l_sa || $form_details->sph_r_di || $form_details->cyl_r_di || $form_details->Axis_r_di || $form_details->vision_r_pga || $form_details->Add_r_pga || $form_details->Nvision_r_pga || $form_details->sph_l_di || $form_details->cyl_l_di || $form_details->Axis_l_di || $form_details->vision_l_pga || $form_details->Add_l_pga || $form_details->Nvision_l_pga ||
 
 $form_details->sph_r_undi_sub || $form_details->cyl_r_undi_sub || $form_details->Axis_r_undi_sub || $form_details->sph_l_undi_sub || $form_details->cyl_l_undi_sub || $form_details->Axis_l_undi_sub || $form_details->sph_r_di_sub || $form_details->cyl_r_di_sub || $form_details->Axis_r_di_sub || $form_details->sph_l_di_sub || $form_details->cyl_l_di_sub || $form_details->Axis_l_di_sub)  && !in_array('refraction2', $print_eyeformFields)
 
 )             
                <div class="col-md-12">
					<label>Refraction : </label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
						
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th colspan="4" class="text-center">Right</th>
                                    <th colspan="4" class="text-center">Left</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>SPH</th>
                                    <th>CYL</th>
                                    <th>Axis</th>
                                    <th>Vision</th>

                                    <th>SPH</th>
                                    <th>CYL</th>
                                    <th>Axis</th>
                                    <th>Vision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AR Undilated</td>
                                    <td>
                                        {{ $form_details->sph_r_undi }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_r_undi }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_r_undi }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_r_undi }}
                                    </td>

                                    <td>
                                        {{ $form_details->sph_l_undi }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_l_undi }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_l_undi }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_l_undi }}
                                    </td>
                                </tr>
								<tr>
                                    <td>Subjective Undilated</td>
                                    <td>
                                        {{ $form_details->sph_r_undi_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_r_undi_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_r_undi_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_r_undi_sub }}
                                    </td>

                                    <td>
                                        {{ $form_details->sph_l_undi_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_l_undi_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_l_undi_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_l_undi_sub }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>AR Dilated</td>
                                    <td>
                                        {{ $form_details->sph_r_di }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_r_di }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_r_di }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_r_di }}
                                    </td>

                                    <td>
                                        {{ $form_details->sph_l_di }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_l_di }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_l_di }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_l_di }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subjective Dilated</td>
                                    <td>
                                        {{ $form_details->sph_r_di_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_r_di_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_r_di_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_r_di_sub }}
                                    </td>

                                    <td>
                                        {{ $form_details->sph_l_di_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->cyl_l_di_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Axis_l_di_sub }}
                                    </td>
                                    <td>
                                        {{ $form_details->Vision_l_di_sub }}
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
@endif

<!-- =========================================== Start  =====Retinoscopy Refration =============================================== -->
@if(($form_details->r_retinoscopy_sph || $form_details->r_retinoscopy_cyl || $form_details->r_retinoscopy_axi || $form_details->r_retinoscopy_vision || 
 $form_details->l_retinoscopy_sph || $form_details->l_retinoscopy_cyl || $form_details->l_retinoscopy_axi || $form_details->l_retinoscopy_vision)  && !in_array('retinoscopy_refraction_page', $print_eyeformFields))             
                <div class="col-md-12">
					<label>Retinoscopy : </label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
						
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th colspan="4" class="text-center">Right</th>
                                    <th colspan="4" class="text-center">Left</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>SPH</th>
                                    <th>CYL</th>
                                    <th>Axis</th>
                                    <th>Vision</th>

                                    <th>SPH</th>
                                    <th>CYL</th>
                                    <th>Axis</th>
                                    <th>Vision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AR Undilated</td>
                                    <td>
                                        {{ $form_details->r_retinoscopy_sph }}
                                    </td>
                                    <td>
                                        {{ $form_details->r_retinoscopy_cyl }}
                                    </td>
                                    <td>
                                        {{ $form_details->r_retinoscopy_axi }}
                                    </td>
                                    <td>
                                        {{ $form_details->r_retinoscopy_vision }}
                                    </td>

                                    <td>
                                        {{ $form_details->l_retinoscopy_sph }}
                                    </td>
                                    <td>
                                        {{ $form_details->l_retinoscopy_cyl }}
                                    </td>
                                    <td>
                                        {{ $form_details->l_retinoscopy_axi }}
                                    </td>
                                    <td>
                                        {{ $form_details->l_retinoscopy_vision }}
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
@endif
<!-- =========================================== Start A scan ==================================================== -->
@if(count($multiple_entries_data_arr) > 0 && 
((isset($multiple_entries_data_arr['flat_k']) && $multiple_entries_data_arr['flat_k']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_k']['field_value_OS'] != "") || (isset($multiple_entries_data_arr['flat_axis']) && $multiple_entries_data_arr['flat_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_axis']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['stap_k']) && $multiple_entries_data_arr['stap_k']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_k']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['stap_axis']) && $multiple_entries_data_arr['stap_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_axis']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['axial_length']) && $multiple_entries_data_arr['axial_length']['field_value_OD'] != "" && $multiple_entries_data_arr['axial_length']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['optical_acd']) && $multiple_entries_data_arr['optical_acd']['field_value_OD'] != "" && $multiple_entries_data_arr['optical_acd']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['target_refraction']) && $multiple_entries_data_arr['target_refraction']['field_value_OD'] != "" && $multiple_entries_data_arr['target_refraction']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['lens_thickness']) && $multiple_entries_data_arr['lens_thickness']['field_value_OD'] != "" && $multiple_entries_data_arr['lens_thickness']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['wtw']) && $multiple_entries_data_arr['wtw']['field_value_OD'] != "" && $multiple_entries_data_arr['wtw']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['kc_formula_use']) && $multiple_entries_data_arr['kc_formula_use']['field_value_OD'] != "" && $multiple_entries_data_arr['kc_formula_use']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['type_of_lens']) && $multiple_entries_data_arr['type_of_lens']['field_value_OD'] != "" && $multiple_entries_data_arr['type_of_lens']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['se']) && $multiple_entries_data_arr['se']['field_value_OD'] != "" && $multiple_entries_data_arr['se']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['iol_cilinder']) && $multiple_entries_data_arr['iol_cilinder']['field_value_OD'] != "" && $multiple_entries_data_arr['iol_cilinder']['field_value_OS'] != ""))
 && !in_array('a_scan', $print_eyeformFields)
)

<div class="col-md-12">
	<label>A Scan: </label>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<td style="width:33%">
						 
					</td>
					<td >
						<strong>OD</strong>
					</td>
					<td >
						<strong>OS</strong>
					</td>
				</tr>
			</thead>
			<tbody>
				@if($multiple_entries_data_arr['flat_k']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_k']['field_value_OS'] != "" && !in_array('flat_k', $print_eyeformFields))
				<tr>
					<td>Flat K</td>
					<td>{{$multiple_entries_data_arr['flat_k']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['flat_k']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['flat_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_axis']['field_value_OS'] != "" && !in_array('flat_axis', $print_eyeformFields))
				<tr>
					<td>Flat Axis</td>
					<td>{{$multiple_entries_data_arr['flat_axis']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['flat_axis']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['stap_k']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_k']['field_value_OS'] != "" && !in_array('stap_k', $print_eyeformFields))
				<tr>
					<td>Stap K</td>
					<td>{{$multiple_entries_data_arr['stap_k']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['stap_k']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['stap_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_axis']['field_value_OS'] != "" && !in_array('stap_axis', $print_eyeformFields))
				<tr>
					<td>Stap Axis</td>
					<td>{{$multiple_entries_data_arr['stap_axis']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['stap_axis']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['axial_length']['field_value_OD'] != "" && $multiple_entries_data_arr['axial_length']['field_value_OS'] != "" && !in_array('axial_length', $print_eyeformFields))
				<tr>
					<td>Axial Length</td>
					<td>{{$multiple_entries_data_arr['axial_length']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['axial_length']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['optical_acd']['field_value_OD'] != "" && $multiple_entries_data_arr['optical_acd']['field_value_OS'] != "" && !in_array('optical_acd', $print_eyeformFields))
				<tr>
					<td>Optical ACD</td>
					<td>{{$multiple_entries_data_arr['optical_acd']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['optical_acd']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['target_refraction']['field_value_OD'] != "" && $multiple_entries_data_arr['target_refraction']['field_value_OS'] != "" && !in_array('target_refraction', $print_eyeformFields))
				<tr>
					<td>Target Refraction</td>
					<td>{{$multiple_entries_data_arr['target_refraction']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['target_refraction']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['lens_thickness']['field_value_OD'] != "" && $multiple_entries_data_arr['lens_thickness']['field_value_OS'] != "" && !in_array('lens_thickness', $print_eyeformFields))
				<tr>
					<td>Lens Thickness</td>
					<td>{{$multiple_entries_data_arr['lens_thickness']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['lens_thickness']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['wtw']['field_value_OD'] != "" && $multiple_entries_data_arr['wtw']['field_value_OS'] != "" && !in_array('wtw', $print_eyeformFields))
				<tr>
					<td>WTW</td>
					<td>{{$multiple_entries_data_arr['wtw']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['wtw']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['kc_formula_use']['field_value_OD'] != "" && $multiple_entries_data_arr['kc_formula_use']['field_value_OS'] != "" && !in_array('kc_formula_use', $print_eyeformFields))
				<tr>
					<td>KC/Formula Use</td>
					<td>{{$multiple_entries_data_arr['kc_formula_use']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['kc_formula_use']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['type_of_lens']['field_value_OD'] != "" && $multiple_entries_data_arr['type_of_lens']['field_value_OS'] != "" && !in_array('type_of_lens', $print_eyeformFields))
				<tr>
					<td>Type of Lens</td>
					<td>{{$multiple_entries_data_arr['type_of_lens']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['type_of_lens']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['se']['field_value_OD'] != "" && $multiple_entries_data_arr['se']['field_value_OS'] != "" && !in_array('se', $print_eyeformFields))
				<tr>
					<td>Power of Lens - Se</td>
					<td>{{$multiple_entries_data_arr['se']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['se']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['iol_cilinder']['field_value_OD'] != "" && $multiple_entries_data_arr['iol_cilinder']['field_value_OS'] != "" && !in_array('iol_cilinder', $print_eyeformFields))
				<tr>
					<td>Power of Lens - IOL Cilinder</td>
					<td>{{$multiple_entries_data_arr['iol_cilinder']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['iol_cilinder']['field_value_OS']}}</td>
				</tr>
				@endif

			</tbody>
		</table>
	</div>
</div>
@endif
<!-- =========================================== End A scan======================================================= -->

<!-- =========================================== Start Laser Procedure  ==================================================== -->


@if(count($multiple_entries_data_arr) > 0 && 
(
(isset($multiple_entries_data_arr['laser_procedure_laser_type']) && $multiple_entries_data_arr['laser_procedure_laser_type']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_laser_type']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_date']) && $multiple_entries_data_arr['laser_procedure_date']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_date']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_power']) && $multiple_entries_data_arr['laser_procedure_power']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_power']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_exposure_time']) && $multiple_entries_data_arr['laser_procedure_exposure_time']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_exposure_time']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_sitting']) && $multiple_entries_data_arr['laser_procedure_sitting']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_sitting']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_spot_size']) && $multiple_entries_data_arr['laser_procedure_spot_size']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_spot_size']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_no_of_spots']) && $multiple_entries_data_arr['laser_procedure_no_of_spots']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_no_of_spots']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['laser_procedure_note']) && $multiple_entries_data_arr['laser_procedure_note']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_note']['field_value_OS'] != "")
) &&  !in_array('laser_procedure_laser', $print_eyeformFields))

@php $laser_procedure_date = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_date')->first(); @endphp
<div class="col-md-12">
	<label>Laser Procedure: </label>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<!-- <th>
						Entry No. 
					</th>
					<th>
						Case No.
					</th>
					<th>
						Eye Type
					</th> -->
					<th>Date
					</th>
					<th>Power
					</th>
					<th>Exposer Time
					</th>
					<th>No. Sitting
					</th>
					<th>Spot Size
					</th>
					<th>No. of Spot
					</th>
					<th>Laser Type
					</th>
					<th>Note
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<!-- <td>{{$laser_procedure_date->eyeformid}}</td>
					<td>{{$casedata['id']}}</td>
					<td>Right Eye</td> -->
					<td>{{$multiple_entries_data_arr['laser_procedure_date']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_power']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_exposure_time']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_sitting']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_spot_size']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_no_of_spots']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_laser_type']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_note']['field_value_OD']}}</td>
				</tr>
				<tr>
					<!-- <td>{{$laser_procedure_date->eyeformid}}</td>
					<td>{{$casedata['id']}}</td>
					<td>Left Eye</td> -->
					<td>{{$multiple_entries_data_arr['laser_procedure_date']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_power']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_exposure_time']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_sitting']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_spot_size']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_no_of_spots']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_laser_type']['field_value_OS']}}</td>
					<td>{{$multiple_entries_data_arr['laser_procedure_note']['field_value_OS']}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@endif


<!-- =========================================== End Laser Procedure ======================================================= -->

        <div class="row clearfix">
                    @if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
                        <div class="col-sm-12"> 
                            Before Image
                        </div>
                        <div class="col-sm-12"> 
                            <img src={{ Storage::disk('local')->url($casedata['Before_file'])."?".filemtime(Storage::path($casedata['Before_file'])) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                        </div>
                    @endif                
                </div>

                <div class="row clearfix">
                    @if(isset($casedata['After_file']) && $casedata['After_file'] != null)
                        <div class="col-sm-12"> 
                            After Image
                        </div>
                        <div class="col-sm-12"> 
                            <img src={{ Storage::disk('local')->url($casedata['After_file'])."?".filemtime(Storage::path($casedata['After_file'])) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                        </div>
                    @endif
                </div>
        @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD) && !empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))
            <div class="table-responsive">    
                <table width="100%">
                    <tr>
                        <td class="col-md-2">&nbsp;</td>
                        <td class="col-md-5" colspan="4" >
                            @if (!empty($form_details->retino_scopy_OD) && !is_null($form_details->retino_scopy_OD))
                                <p>&nbsp;</p>
                                <center id="wPaint-retino_scopy_OD"> 
                                        <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OD)."?".filemtime(Storage::path($form_details->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />
                                </center>
                            @endif
                        </td>
                        <td class="col-md-5" colspan="4" >
                            @if (!empty($form_details->retino_scopy_OS) && !is_null($form_details->retino_scopy_OS))                        
                                <p>&nbsp;</p>
                                <center id="wPaint-retino_scopy_OS"> 
                                        <img src={{ Storage::disk('local')->url($form_details->retino_scopy_OS)."?".filemtime(Storage::path($form_details->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />  
                                </center>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        @endif
            @if(!$CheckField::IsFieldEmpty($form_details->Advice_OD)) 
                    <div class="row">
                    <div class="col-sm-12">
                            <label class="control-label">Advice :</label>   {{ nl2br($form_details->Advice_OD) }}
                    </div>
                </div>
                        
                @endif

        @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
        
        <!-- <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Prescription</label>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>
                    Medicine
                </th>
                <th>
                    Eye
                </th>
                <th>
                    Frequency
                </th>
                <th>
                    Duration
                </th>
                <th>
                    Date
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
                    {{ $prescption->numberoftimes }}
                </td>
                <td>
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
        					{{ $prescption->from_date }} to {{ $prescption->to_date }}
        				</td>
            <tr>
            @endforeach
        </table> -->
        @endif
      
        @if (
	 		 (!$CheckField::IsFieldEmpty($glass_prescription->r_dv_sph) || 
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_dv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_dv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->r_nv_vision) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_sph) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_cyl) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_axi) ||
             !$CheckField::IsFieldEmpty($glass_prescription->l_nv_vision))
	 		 && !in_array('refraction1', $print_eyeformFields)
        )
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Glass Prescription</label>
            </div>
        </div>
        <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="5" align="center">
                                    <strong>Right</strong>
                                </td>
                                <td colspan="4" align="center">
                                <strong>Left Eye</strong>
                                </td>                           
                            </tr>
                            <tr>
                                <td>
                                    <strong>&nbsp;</strong>
                                </td>
                                <td align="center">
                                <strong>SPH</strong>
                                </td>                           
                                <td align="center">
                                    <strong>CYL</strong>
                                </td>
                                <td align="center">
                                <strong>AXI</strong>
                                </td>                           
                                <td align="center">
                                <strong>VISION</strong>
                                </td>
                                <td align="center">
                                <strong>SPH</strong>
                                </td>                           
                                <td align="center">
                                    <strong>CYL</strong>
                                </td>
                                <td align="center">
                                    <strong>AXI</strong>
                                </td>                           
                                <td align="center">
                                    <strong>VISION</strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>D.V.</strong>
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->r_dv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_dv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->r_dv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_dv_vision }}
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->l_dv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_dv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->l_dv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_dv_vision }}
                                </td>
                            </tr>
<tr>
                                    <td>Add</td>
                                    <td>
                                        {{ ($glass_prescription->r_add_sph != '') ? $glass_prescription->r_add_sph : ''}}
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>
                                        
                                    </td>
                                    
                                    <td>
                                        {{ ($glass_prescription->l_add_sph != '') ? $glass_prescription->l_add_sph : ''}}
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            <tr>
                                <td>
                                    <strong>N.V.</strong>
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->r_nv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_nv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->r_nv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->r_nv_vision }}
                                </td>
                                <td align="center">
                                    {{ $glass_prescription->l_nv_sph }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_nv_cyl }}
                                </td>
                                <td align="center">
                                        {{ $glass_prescription->l_nv_axi }}
                                </td>                           
                                <td align="center">
                                        {{ $glass_prescription->l_nv_vision }}
                                </td>
                            </tr>
                        </tbody>
                </table>
                @if (!empty($glass_prescription->retino_scopy_OD) && !is_null($glass_prescription->retino_scopy_OD) && !empty($glass_prescription->retino_scopy_OS) && !is_null($glass_prescription->retino_scopy_OS))
                    <div class="table-responsive">    
                        <table width="100%">
                            <tr>
                                <td class="col-md-2">&nbsp;</td>
                                <td class="col-md-5" colspan="4" >
                                    @if (!empty($glass_prescription->retino_scopy_OD) && !is_null($glass_prescription->retino_scopy_OD))
                                        <p>&nbsp;</p>
                                        <center id="wPaint-retino_scopy_OD"> 
                                                <img src={{ Storage::disk('local')->url($glass_prescription->retino_scopy_OD)."?".filemtime(Storage::path($glass_prescription->retino_scopy_OD)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />
                                        </center>
                                    @endif
                                </td>
                                <td class="col-md-5" colspan="4" >
                                    @if (!empty($glass_prescription->retino_scopy_OS) && !is_null($glass_prescription->retino_scopy_OS))                        
                                        <p>&nbsp;</p>
                                        <center id="wPaint-retino_scopy_OS"> 
                                                <img src={{ Storage::disk('local')->url($glass_prescription->retino_scopy_OS)."?".filemtime(Storage::path($glass_prescription->retino_scopy_OS)) }} class="img-rounded" alt="Image Not found" width="150" height="150" />  
                                        </center>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
        </div>
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_1))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 1 :</label>   {{ $glass_prescription->Report_1 }} 
                    </div>
                </div>
            @endif
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_2))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 2 :</label>   {{ $glass_prescription->Report_2 }} 
                    </div>
                </div>
            @endif
            @if (!$CheckField::IsFieldEmpty($glass_prescription->Report_3))
                <div class="row">
                    <div class="col-sm-12">
                        <label class="control-label">Report 3 :</label>   {{ $glass_prescription->Report_3 }} 
                    </div>
                </div>
            @endif
            
        @endif

        
        
      

     
	 	<br>


@if(count($casedata['prescriptions']) > 0 && !in_array('prescription_summary', $print_eyeformFields))
				<div class="row">
            <div class="col-md-12">
               
<label>Prescption summary: </label>
	                    
                  
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
                         {{--<td><strong>Medicine</strong></td>
                         <td><strong>Eye</strong></td>
                         <td><strong>Frequency</strong></td>
                         <td><strong>Duration</strong></td>
						 --}}
						 
						  <th>
									Medicine
								</th>
								<th>
									Generic Medicine
								</th>
								<th>
									Eye
								</th>
								<th>
									Duration
								</th>
								<th>
									Frequency    
								</th>
								<th>
									Date    
								</th>
								<th>
									Timing    
								</th>
								
                         
                </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Sumtotal = 0; ?>
								@php $prescription_id = ""; @endphp
							@foreach($casedata['prescriptions'] as $prescption)
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
								<td>
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
								
								
								{{--
                                @foreach($casedata['prescriptions'] as $prescption)
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
                <td >
                    {{ $prescption->numberoftimes }}
                </td>
                <td>
                    {{ $prescption->medicine_Quntity }}
                </td>
                <td>
					{{ $prescption->from_date }} to {{ $prescption->to_date }}
				</td>
                
                
            <tr>
                                 @endforeach
								 --}}
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
	@endif

	<div class="col-md-12">
					<div class="row">

						@if(isset($casedata['casehistory_followup_notes']) && $casedata['casehistory_followup_notes'] != "")
							<div class="col-md-4">
								<label for="preoperative_chk"><b>Follow Up Note : </b></label>
								<div>{{$casedata['casehistory_followup_notes']??''}}</div>
							</div>
						@endif

					</div> 
				</div>
                <br>
       
        <div class="form-group">
                <ul class="list-unstyled">
					<li class=""><h6>*Please bring this paper on every visit / Please follow the time / Please inform allergy immediately</h6></li>
                </ul>
        </div>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
					@if($doctor)
						<p>{{ $doctor->doctor_name }}</p>
						<p>{{ $doctor->doctorDegree }}</p>
						<p>{{ $doctor->reg_number }}</p>
					@endif
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
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