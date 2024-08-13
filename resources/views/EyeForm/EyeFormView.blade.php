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
	
.details-section {
    color: initial;
    text-align: center;
    margin-bottom: 7px;
    padding-top: 4px;
    padding-bottom: 1px;
    margin-top: -2px;
}

.hide_print {
	position: relative !important;
    left: auto !important;
    opacity: 1 !important;
   /* margin-left: 47px !important; */
    margin-right: 8px !important;
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
                        <form action="{{ url('/AddEditEyeDetails/').'/'.$casedata['id'] }}" method="GET" class="form-horizontal">
                          {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2> 
                                Patient History  View
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
											<?php if(!empty($casedata['infection']) || !empty($casedata['miscellaneous_history'])) {?>
                         <div class="header bg-yellow">
                            <div class="col-md-12" style="margin-top: -10px;"><h2>
							<marquee>
                                <div class="col-md-2">Infection</div><div class="col-md-3 details-section">{{ $casedata['infection'] }}</div> 
                                <div class="col-md-3">Miscellaneous History</div><div class="col-md-4 details-section">{{ $casedata['miscellaneous_history'] }}</div></h2>
								</marquee>
                            </div>
                        </div>
                        <?php } ?>
                          <div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
                          {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
            <div class="panel-body">
            <div class="row clearfix">
            <div class="col-md-12">
              <div class="form-group">
              {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
              </div>
            </div>

			@if(!$CheckField::IsFieldEmpty($form_details->CNS))   
            <div class="col-md-12">
                <label class="control-label"><input type="checkbox" class="hide_print" name="hide_print[]" value="CNS" {{in_array('CNS', $print_eyeformFields) ? 'checked' : '' }}>General Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
              </div>
			  @endif
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
                                <td >
                                    <strong>OS</strong>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ChiefComplaint')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="ChiefComplaint" {{in_array('ChiefComplaint', $print_eyeformFields) ? 'checked' : '' }}>Chief Complaint
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OpthalHistory')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="OpthalHistory" {{in_array('OpthalHistory', $print_eyeformFields) ? 'checked' : '' }}>Ophthalmic History      
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
                       @foreach ($form_details->patients_systemic_history as $item)
                    <tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="patients_systemic_history" {{in_array('patients_systemic_history', $print_eyeformFields) ? 'checked' : '' }}>Systemic History
                            @endif
                        </td>
                        <td colspan="2">
                            {{$item->value}} @if($item->duration) - {{$item->duration}} @endif
                        </td>
                    </tr>
                @endforeach
				
				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'pastHistory')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pastHistory')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="pastHistory" {{in_array('pastHistory', $print_eyeformFields) ? 'checked' : '' }}>Past History
                            @endif
                        </td>
                        <td colspan="2">
                            {{$item->field_value_OD}}
                        </td>
                    </tr>
					@endforeach
				@endif


                        @if(!$CheckField::IsFieldEmpty($form_details->familyHistory))
                        <tr>
                            <td>
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="familyHistory" {{in_array('familyHistory', $print_eyeformFields) ? 'checked' : '' }}>Family History
                            </td>
                            <td colspan="2">
                                {{ nl2br($form_details->familyHistory) }}
                            </td>
                        </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->birthHistory) && !in_array('birthHistory', $print_eyeformFields))
                        <tr>
                            <td>
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="birthHistory" {{in_array('birthHistory', $print_eyeformFields) ? 'checked' : '' }}>Birth History
                            </td>
                            <td colspan="2">
                                {{ nl2br($form_details->birthHistory) }}
                            </td>
                        </tr>
                        @endif
						@if(!$CheckField::IsFieldEmpty($form_details->pastTreatmentHistory) && !in_array('pastTreatmentHistory', $print_eyeformFields))
                        <tr>
                            <td>
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="pastTreatmentHistory" {{in_array('pastTreatmentHistory', $print_eyeformFields) ? 'checked' : '' }}>Past Treatment History
                            </td>
                            <td colspan="2">
                                {{ nl2br($form_details->pastTreatmentHistory) }}
                            </td>
                        </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->dvn_od) && !$CheckField::IsFieldEmpty($form_details->dvn_os) && !in_array('dvn_os', $print_eyeformFields))
                            <tr>
                                <td>
                                   <input type="checkbox" class="hide_print" name="hide_print[]" value="dvn_od" {{in_array('dvn_od', $print_eyeformFields) ? 'checked' : '' }}>Distant Vision UNAIDED
                                </td>
                                <td>
                                    {{ $form_details->dvn_od }}
                                </td>
                                <td>
                                    {{ $form_details->dvn_os }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->nvn_od) && !$CheckField::IsFieldEmpty($form_details->nvn_os))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="nvn_od" {{in_array('nvn_od', $print_eyeformFields) ? 'checked' : '' }}>Near Vision UNAIDED
                                </td>
                                <td>
                                    {{ $form_details->nvn_od }}
                                </td>
                                <td>
                                    {{ $form_details->nvn_os }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->visualacuity_OD) && !$CheckField::IsFieldEmpty($form_details->visualacuity_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="visualacuity_OD" {{in_array('visualacuity_OD', $print_eyeformFields) ? 'checked' : '' }}>Distant Vision Aided
                                </td>
                                <td>
                                    {{ $form_details->visualacuity_OD }}
                                </td>
                                <td>
                                    {{ $form_details->visualacuity_OS }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->withglasses_OD) && !$CheckField::IsFieldEmpty($form_details->withglasses_OS))
<!--                            <tr>
                                <td>
                                    PGP
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OD }}
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OS }}
                                </td>
                            </tr>-->
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->withpinhole_OD) && !$CheckField::IsFieldEmpty($form_details->withpinhole_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="withpinhole_OD" {{in_array('withpinhole_OD', $print_eyeformFields) ? 'checked' : '' }}>With Pinhole
                                </td>
                                <td>
                                    {{ $form_details->withpinhole_OD }}
                                </td>
                                <td>
                                    {{ $form_details->withpinhole_OS }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->colour_vision_OD) && !$CheckField::IsFieldEmpty($form_details->colour_vision_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="colour_vision_OD" {{in_array('colour_vision_OD', $print_eyeformFields) ? 'checked' : '' }}>Colour vision
                                </td>
                                <td>
                                    {{ $form_details->colour_vision_OD }}
                                </td>
                                <td>
                                    {{ $form_details->colour_vision_OS }}
                                </td>
                            </tr>
                        @endif

						@if(!$CheckField::IsFieldEmpty($form_details->with_glass_dilated_od) && !$CheckField::IsFieldEmpty($form_details->with_glass_dilated_os))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="with_glass_dilated" {{in_array('with_glass_dilated', $print_eyeformFields) ? 'checked' : '' }}>With Glass Dilated
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
                 
				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'colour')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'colour')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="colour" {{in_array('colour', $print_eyeformFields) ? 'checked' : '' }}>colour  Vision
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

				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest1')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest1')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="schimerTest1" {{in_array('schimerTest1', $print_eyeformFields) ? 'checked' : '' }}>Schimer Test 1
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

				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest2')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'schimerTest2')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="schimerTest2" {{in_array('schimerTest2', $print_eyeformFields) ? 'checked' : '' }}>Schimer Test 2
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

				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'tear_film_breakup_time')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'tear_film_breakup_time')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="tear_film_breakup_time" {{in_array('tear_film_breakup_time', $print_eyeformFields) ? 'checked' : '' }}>Tear Film Breakup Time
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

				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'eye_sonography')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'eye_sonography')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="eye_sonography" {{in_array('eye_sonography', $print_eyeformFields) ? 'checked' : '' }}>Eye Sonography
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

				
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OCT')->get() as $item)
				<tr>
					<td>
						@if ($loop->iteration == 1)
							<input type="checkbox" class="hide_print" name="hide_print[]" value="OCT" {{in_array('OCT', $print_eyeformFields) ? 'checked' : '' }}>Optical Coherence tomography (OCT)
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
				@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'EOM')->get() as $item)
				<tr>
					<td>
						@if ($loop->iteration == 1)
						<input type="checkbox" class="hide_print" name="hide_print[]" value="EOM" {{in_array('EOM', $print_eyeformFields) ? 'checked' : '' }}>Extra Ocular Movement (EOM)
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

				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'perimetry_sp')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'perimetry_sp')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="perimetry_sp" {{in_array('perimetry_sp', $print_eyeformFields) ? 'checked' : '' }}>Perimetry
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

				@if(count($form_details->eyeformmultipleentry()->where('field_name', 'laser_sp')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'laser_sp')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="laser_sp" {{in_array('laser_sp', $print_eyeformFields) ? 'checked' : '' }}>Laser
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
                        
                        @if(count($form_details->eyeformmultipleentry()->where('field_name', 'oculizer_sp')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'oculizer_sp')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="oculizer_sp" {{in_array('oculizer_sp', $print_eyeformFields) ? 'checked' : '' }}>Oculizer
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

				 @if(count($form_details->eyeformmultipleentry()->where('field_name', 'ffa_sp')->get()) > 0)
					@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ffa_sp')->get() as $key => $item)
					
					<tr>
                        <td>
                            @if ($loop->iteration == 1)
                                <input type="checkbox" class="hide_print" name="hide_print[]" value="ffa_sp" {{in_array('ffa_sp', $print_eyeformFields) ? 'checked' : '' }}>FFA
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
                        
                        @if(!$CheckField::IsFieldEmpty($form_details->withglasses_OD) && !$CheckField::IsFieldEmpty($form_details->withglasses_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="withglasses_OD" {{in_array('withglasses_OD', $print_eyeformFields) ? 'checked' : '' }}>With glasses
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OD }}
                                </td>
                                <td>
                                    {{ $form_details->withglasses_OS }}
                                </td>
                            </tr>
                        @endif
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ConjAndLids')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="ConjAndLids" {{in_array('ConjAndLids', $print_eyeformFields) ? 'checked' : '' }}>Conj
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Lids')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="Lids" {{in_array('Lids', $print_eyeformFields) ? 'checked' : '' }}>Lids
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'AC')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="AC" {{in_array('AC', $print_eyeformFields) ? 'checked' : '' }}>AC
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'IRIS')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="IRIS" {{in_array('IRIS', $print_eyeformFields) ? 'checked' : '' }}>IRIS
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'sac')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="sac" {{in_array('sac', $print_eyeformFields) ? 'checked' : '' }}>sac
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Retina')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="Retina" {{in_array('Retina', $print_eyeformFields) ? 'checked' : '' }}>Retina
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Macula')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="Macula" {{in_array('Macula', $print_eyeformFields) ? 'checked' : '' }}>Macula
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'ONH')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="ONH" {{in_array('ONH', $print_eyeformFields) ? 'checked' : '' }}>ONH
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'OrbitSacsEyeMotility')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="OrbitSacsEyeMotility" {{in_array('OrbitSacsEyeMotility', $print_eyeformFields) ? 'checked' : '' }}>Orbit
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'cornia')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="cornia" {{in_array('cornia', $print_eyeformFields) ? 'checked' : '' }}>CORNEA
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

                        @if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1) && !empty($form_details->OsImg1) && !is_null($form_details->OsImg1))
                        <tr>
                           <td>
								<input type="checkbox" class="hide_print" name="hide_print[]" value="cornia_image" {{in_array('cornia_image', $print_eyeformFields) ? 'checked' : '' }}>CORNEA Image
						   </td>
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'pupilIrisac')->get() as $item)
                        <tr>
                            <td>
                                @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="pupilIrisac" {{in_array('pupilIrisac', $print_eyeformFields) ? 'checked' : '' }}>pupil
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'lens')->get() as $item)
                        <tr>
                            <td>
                                @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="lens" {{in_array('lens', $print_eyeformFields) ? 'checked' : '' }}>LENS
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
                        @if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2) && !empty($form_details->OsImg2) && !is_null($form_details->OsImg2))
                        <tr>
                           <td>
								<input type="checkbox" class="hide_print" name="hide_print[]" value="fundus_image" {{in_array('fundus_image', $print_eyeformFields) ? 'checked' : '' }}>Fundus Image
						   </td>
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
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'vitreoretinal')->get() as $item)
                        <tr>
                            <td>
                                @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="vitreoretinal" {{in_array('vitreoretinal', $print_eyeformFields) ? 'checked' : '' }}>vitreo retinal
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
                        @if(!$CheckField::IsFieldEmpty($form_details->IOP_OD) && !$CheckField::IsFieldEmpty($form_details->IOP_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="IOP_OD" {{in_array('IOP_OD', $print_eyeformFields) ? 'checked' : '' }}>IOP
                                </td>
                                <td>
                                    {{ $form_details->IOP_OD }} {{($form_details->iop_od_time) ? '['.$form_details->iop_od_time.']': ''}}
                                </td>
                                <td>
                                    {{ $form_details->IOP_OS }} {{($form_details->iop_os_time) ? '['.$form_details->iop_os_time.']': ''}}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->Ratio_OD) && !$CheckField::IsFieldEmpty($form_details->Ratio_OS))
                            <tr>
                                <td>
                                   <input type="checkbox" class="hide_print" name="hide_print[]" value="Ratio_OD" {{in_array('Ratio_OD', $print_eyeformFields) ? 'checked' : '' }}>CD Ratio
                                </td>
                                <td>
                                    {{ $form_details->Ratio_OD }}
                                </td>
                                <td>
                                    {{ $form_details->Ratio_OS }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->Pachymetry_OD) && !$CheckField::IsFieldEmpty($form_details->Pachymetry_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="Pachymetry_OD" {{in_array('Pachymetry_OD', $print_eyeformFields) ? 'checked' : '' }}>Pachymetry
                                </td>
                                <td>
                                    {{ $form_details->Pachymetry_OD }}
                                </td>
                                <td>
                                    {{ $form_details->Pachymetry_OS }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->CCT_OD) && !$CheckField::IsFieldEmpty($form_details->CCT_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="CCT_OD" {{in_array('CCT_OD', $print_eyeformFields) ? 'checked' : '' }}>CCT
                                </td>
                                <td>
                                    {{ $form_details->CCT_OD }}
                                </td>
                                <td>
                                    {{ $form_details->CCT_OS }}
                                </td>
                            </tr>
                        @endif
                        @foreach ($form_details->eyeformmultipleentry()->where('field_name', 'diagno')->get() as $item)
                        <tr>
                            <td>
                                @if ($loop->iteration == 1)
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="diagno" {{in_array('diagno', $print_eyeformFields) ? 'checked' : '' }}>Diagnosis
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
@if(!$CheckField::IsFieldEmpty($form_details->Advice_OD) && !$CheckField::IsFieldEmpty($form_details->Advice_OS))
    <tr>
        <td>
            <input type="checkbox" class="hide_print" name="hide_print[]" value="Advice_OD" {{in_array('Advice_OD', $print_eyeformFields) ? 'checked' : '' }}>Advice
        </td>
        <td>
            {{ nl2br($form_details->Advice_OD) }}
        </td>
        <td>
            {{ nl2br($form_details->Advice_OS) }}
        </td>
    </tr>
@endif
                        @if(!$CheckField::IsFieldEmpty($form_details->BloodInvestigation))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="BloodInvestigation" {{in_array('BloodInvestigation', $print_eyeformFields) ? 'checked' : '' }}>Blood Investigation
                                </td>
                                <td colspan="2">
                                    {{ nl2br($form_details->BloodInvestigation) }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->k1_od) && !$CheckField::IsFieldEmpty($form_details->k1_os))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="k1_od" {{in_array('k1_od', $print_eyeformFields) ? 'checked' : '' }}>K1
                                </td>
                                <td>
                                    {{ $form_details->k1_od }}
                                </td>
                                <td>
                                    {{ $form_details->k1_os }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->k2_od) && !$CheckField::IsFieldEmpty($form_details->k2_os))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="k2_od" {{in_array('k2_od', $print_eyeformFields) ? 'checked' : '' }}>K2
                                </td>
                                <td>
                                    {{ $form_details->k2_od }}
                                </td>
                                <td>
                                    {{ $form_details->k2_os }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->lenspower_od) && !$CheckField::IsFieldEmpty($form_details->lenspower_os))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="lenspower_od" {{in_array('lenspower_od', $print_eyeformFields) ? 'checked' : '' }}>Lens Power
                                </td>
                                <td>
                                    {{ $form_details->lenspower_od }}
                                </td>
                                <td>
                                    {{ $form_details->lenspower_os }}
                                </td>
                            </tr>
                        @endif
						@if(!$CheckField::IsFieldEmpty($form_details->lens_type_od) && !$CheckField::IsFieldEmpty($form_details->lens_type_os))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="lens_type_od" {{in_array('lens_type_od', $print_eyeformFields) ? 'checked' : '' }}>Type of Lens
                                </td>
                                <td>
                                    {{ $form_details->lens_type_od }}
                                </td>
                                <td>
                                    {{ $form_details->lens_type_os }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->axial_length_OD) && !$CheckField::IsFieldEmpty($form_details->axial_length_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="axial_length_OD" {{in_array('axial_length_OD', $print_eyeformFields) ? 'checked' : '' }}>Axial Lenght
                                </td>
                                <td>
                                    {{ $form_details->axial_length_OD }}
                                </td>
                                <td>
                                    {{ $form_details->axial_length_OS }}
                                </td>
                            </tr>
                        @endif
                        @if(!$CheckField::IsFieldEmpty($form_details->KC_OD) && !$CheckField::IsFieldEmpty($form_details->KC_OS))
                            <tr>
                                <td>
                                    <input type="checkbox" class="hide_print" name="hide_print[]" value="KC_OD" {{in_array('KC_OD', $print_eyeformFields) ? 'checked' : '' }}>KC
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
              </div>  
		
              

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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="otherDetailsDiagnosis" {{in_array('otherDetailsDiagnosis', $print_eyeformFields) ? 'checked' : '' }}>Diagnosis
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="other_details_treatment_given" {{in_array('other_details_treatment_given', $print_eyeformFields) ? 'checked' : '' }}>Treatment Given
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="otherDetailsAnteriorSegment" {{in_array('otherDetailsAnteriorSegment', $print_eyeformFields) ? 'checked' : '' }}>Anterior Segment
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="otherDetailsPosteriorSegment" {{in_array('otherDetailsPosteriorSegment', $print_eyeformFields) ? 'checked' : '' }}>Posterior Segment
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="otherDetailsAdditionalInformation" {{in_array('otherDetailsAdditionalInformation', $print_eyeformFields) ? 'checked' : '' }}>Additional Information
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="planOfManagement" {{in_array('planOfManagement', $print_eyeformFields) ? 'checked' : '' }}>Plan Of Management
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="otherDetailsAdvice" {{in_array('otherDetailsAdvice', $print_eyeformFields) ? 'checked' : '' }}>Advice
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
									  <input type="checkbox" class="hide_print" name="hide_print[]" value="surgery" {{in_array('surgery', $print_eyeformFields) ? 'checked' : '' }}>Surgery/Procedure
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
								<input type="checkbox" class="hide_print" name="hide_print[]" value="other_details_comment" {{in_array('other_details_comment', $print_eyeformFields) ? 'checked' : '' }}>Comment 
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


				 @if(count($form_details->uveiitis_bloodtests_data))
                <div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table  table-bordered">
									<tbody>
										<tr>
												
												<td>
													<input type="checkbox" class="hide_print" name="hide_print[]" value="uveiitis_bloodtests_data" {{in_array('uveiitis_bloodtests_data', $print_eyeformFields) ? 'checked' : '' }}>Blood Investigation
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

				

               
                @if(!empty($casedata->appointment_dt) && !is_null($casedata->appointment_dt) && !isset($casedata->appointment_dt))
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Followup Date :</label>   {{ $casedata['appointment_dt'] }} 
                        </div>
                    </div>
                @endif
                @if(!empty($casedata->appointment_timeslot) && !is_null($casedata->appointment_timeslot) && !isset($casedata->appointment_timeslot))
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Followup Time :</label>   {{ $casedata['appointment_timeslot'] }} 
                        </div>
                    </div>
                @endif
               
                
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
                
<!--                ==================================================-->
@if($eyform_vision_pgp_details)
    @if($eyform_vision_pgp_details->vision_pgp_dv_sph_r || $eyform_vision_pgp_details->vision_pgp_dv_cyl_r || $eyform_vision_pgp_details->vision_pgp_dv_axis_r || $eyform_vision_pgp_details->vision_pgp_dv_vision_r || $eyform_vision_pgp_details->vision_pgp_dv_sph_l || $eyform_vision_pgp_details->vision_pgp_dv_cyl_l || $eyform_vision_pgp_details->vision_pgp_dv_axis_l || $eyform_vision_pgp_details->vision_pgp_dv_vision_l || $eyform_vision_pgp_details->vision_pgp_nv_sph_r || $eyform_vision_pgp_details->vision_pgp_nv_cyl_r || $eyform_vision_pgp_details->vision_pgp_nv_axis_r || $eyform_vision_pgp_details->vision_pgp_nv_vision_r || $eyform_vision_pgp_details->vision_pgp_nv_sph_l || $eyform_vision_pgp_details->vision_pgp_nv_cyl_l || $eyform_vision_pgp_details->vision_pgp_nv_axis_l || $eyform_vision_pgp_details->vision_pgp_nv_vision_l)
 <div > 
    <input type="checkbox" class="hide_print" name="hide_print[]" value="pgp" {{in_array('pgp', $print_eyeformFields) ? 'checked' : '' }}>PGP
</div>
    @include('EyeForm.view_templates.eyform_vision_pgp_details')
@endif
@endif

@if($glass_prescription)
    @if($glass_prescription->r_dv_sph || $glass_prescription->r_dv_cyl || 
	$glass_prescription->r_dv_axi || $glass_prescription->r_dv_vision || 
	$glass_prescription->l_dv_sph || $glass_prescription->l_dv_cyl || 
	$glass_prescription->l_dv_axi || $glass_prescription->l_dv_vision || 

	$glass_prescription->r_nv_sph || $glass_prescription->r_nv_cyl || 
	$glass_prescription->r_nv_axi || $glass_prescription->r_nv_vision || 
	$glass_prescription->l_nv_sph || $glass_prescription->l_nv_cyl || 
	$glass_prescription->l_nv_axi || $glass_prescription->l_nv_vision)
 <div > 
    <input type="checkbox" class="hide_print" name="hide_print[]" value="refraction1" {{in_array('refraction1', $print_eyeformFields) ? 'checked' : '' }}>Glass Prescription
                        </div>
    @include('EyeForm.view_templates.eyform_refraction_retina_scopy_details')
@endif
    @endif



<!--                ==================================================-->
 @if($form_details->sph_r_undi || $form_details->cyl_r_undi || $form_details->Axis_r_undi || $form_details->vision_r_sa || $form_details->Add_r_sa || $form_details->Nvision_r_sa || $form_details->sph_l_undi || $form_details->cyl_l_undi || $form_details->Axis_l_undi || $form_details->vision_l_sa || $form_details->Add_l_sa || $form_details->Nvision_l_sa || $form_details->sph_r_di || $form_details->cyl_r_di || $form_details->Axis_r_di || $form_details->vision_r_pga || $form_details->Add_r_pga || $form_details->Nvision_r_pga || $form_details->sph_l_di || $form_details->cyl_l_di || $form_details->Axis_l_di || $form_details->vision_l_pga || $form_details->Add_l_pga || $form_details->Nvision_l_pga ||
 
 $form_details->sph_r_undi_sub || $form_details->cyl_r_undi_sub || $form_details->Axis_r_undi_sub || $form_details->sph_l_undi_sub || $form_details->cyl_l_undi_sub || $form_details->Axis_l_undi_sub || $form_details->sph_r_di_sub || $form_details->cyl_r_di_sub || $form_details->Axis_r_di_sub || $form_details->sph_l_di_sub || $form_details->cyl_l_di_sub || $form_details->Axis_l_di_sub
 
 )             
                <div class="col-md-12">
					<label><input type="checkbox" class="hide_print" name="hide_print[]" value="refraction2" {{in_array('refraction2', $print_eyeformFields) ? 'checked' : '' }}>Refraction : </label>
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

<!-- ==================================================-->
 @if($form_details->r_retinoscopy_sph || $form_details->r_retinoscopy_cyl || $form_details->r_retinoscopy_axi || $form_details->r_retinoscopy_vision || 
 $form_details->l_retinoscopy_sph || $form_details->l_retinoscopy_cyl || $form_details->l_retinoscopy_axi || $form_details->l_retinoscopy_vision)             
                <div class="col-md-12">
					<label><input type="checkbox" class="hide_print" name="hide_print[]" value="retinoscopy_refraction_page" {{in_array('retinoscopy_refraction_page', $print_eyeformFields) ? 'checked' : '' }}>Retinoscopy : </label>
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

@php 
	//echo "==========>>>>>>>>. <pre>"; print_r($multiple_entries_data_arr); exit;
@endphp
<!-- =========================================== Start A scan ==================================================== -->
@if(count($multiple_entries_data_arr) > 0 && 
(isset($multiple_entries_data_arr['flat_k']) && $multiple_entries_data_arr['flat_k']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_k']['field_value_OS'] != "") || (isset($multiple_entries_data_arr['flat_axis']) && $multiple_entries_data_arr['flat_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_axis']['field_value_OS'] != "") || 
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

<div class="col-md-12">
	<label><input type="checkbox" class="hide_print" name="hide_print[]" value="a_scan" {{in_array('a_scan', $print_eyeformFields) ? 'checked' : '' }}>A Scan: </label>
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
				@if($multiple_entries_data_arr['flat_k']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_k']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="flat_k" {{in_array('flat_k', $print_eyeformFields) ? 'checked' : '' }}>Flat K</td>
					<td>{{$multiple_entries_data_arr['flat_k']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['flat_k']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['flat_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_axis']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="flat_axis" {{in_array('flat_axis', $print_eyeformFields) ? 'checked' : '' }}>Flat Axis</td>
					<td>{{$multiple_entries_data_arr['flat_axis']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['flat_axis']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['stap_k']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_k']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="stap_k" {{in_array('stap_k', $print_eyeformFields) ? 'checked' : '' }}>Stap K</td>
					<td>{{$multiple_entries_data_arr['stap_k']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['stap_k']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['stap_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_axis']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="stap_axis" {{in_array('stap_axis', $print_eyeformFields) ? 'checked' : '' }}>Stap Axis</td>
					<td>{{$multiple_entries_data_arr['stap_axis']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['stap_axis']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['axial_length']['field_value_OD'] != "" && $multiple_entries_data_arr['axial_length']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="axial_length" {{in_array('axial_length', $print_eyeformFields) ? 'checked' : '' }}>Axial Length</td>
					<td>{{$multiple_entries_data_arr['axial_length']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['axial_length']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['optical_acd']['field_value_OD'] != "" && $multiple_entries_data_arr['optical_acd']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="optical_acd" {{in_array('optical_acd', $print_eyeformFields) ? 'checked' : '' }}>Optical ACD</td>
					<td>{{$multiple_entries_data_arr['optical_acd']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['optical_acd']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['target_refraction']['field_value_OD'] != "" && $multiple_entries_data_arr['target_refraction']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="target_refraction" {{in_array('target_refraction', $print_eyeformFields) ? 'checked' : '' }}>Target Refraction</td>
					<td>{{$multiple_entries_data_arr['target_refraction']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['target_refraction']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['lens_thickness']['field_value_OD'] != "" && $multiple_entries_data_arr['lens_thickness']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="lens_thickness" {{in_array('lens_thickness', $print_eyeformFields) ? 'checked' : '' }}>Lens Thickness</td>
					<td>{{$multiple_entries_data_arr['lens_thickness']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['lens_thickness']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['wtw']['field_value_OD'] != "" && $multiple_entries_data_arr['wtw']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="wtw" {{in_array('wtw', $print_eyeformFields) ? 'checked' : '' }}>WTW</td>
					<td>{{$multiple_entries_data_arr['wtw']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['wtw']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['kc_formula_use']['field_value_OD'] != "" && $multiple_entries_data_arr['kc_formula_use']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="kc_formula_use" {{in_array('kc_formula_use', $print_eyeformFields) ? 'checked' : '' }}>KC/Formula Use</td>
					<td>{{$multiple_entries_data_arr['kc_formula_use']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['kc_formula_use']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['type_of_lens']['field_value_OD'] != "" && $multiple_entries_data_arr['type_of_lens']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="type_of_lens" {{in_array('type_of_lens', $print_eyeformFields) ? 'checked' : '' }}>Type of Lens</td>
					<td>{{$multiple_entries_data_arr['type_of_lens']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['type_of_lens']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['se']['field_value_OD'] != "" && $multiple_entries_data_arr['se']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="se" {{in_array('se', $print_eyeformFields) ? 'checked' : '' }}>Power of Lens - Se</td>
					<td>{{$multiple_entries_data_arr['se']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['se']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['iol_cilinder']['field_value_OD'] != "" && $multiple_entries_data_arr['iol_cilinder']['field_value_OS'] != "")
				<tr>
					<td><input type="checkbox" class="hide_print" name="hide_print[]" value="iol_cilinder" {{in_array('iol_cilinder', $print_eyeformFields) ? 'checked' : '' }}>Power of Lens - IOL Cilinder</td>
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

{{--
@if(count($multiple_entries_data_arr) > 0 && 
(isset($multiple_entries_data_arr['laser_procedure_laser_type']) && $multiple_entries_data_arr['laser_procedure_laser_type']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_laser_type']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_date']) && $multiple_entries_data_arr['laser_procedure_date']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_axis']['laser_procedure_date'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_power']) && $multiple_entries_data_arr['laser_procedure_power']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_power']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_exposure_time']) && $multiple_entries_data_arr['laser_procedure_exposure_time']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_exposure_time']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_sitting']) && $multiple_entries_data_arr['laser_procedure_sitting']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_sitting']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_spot_size']) && $multiple_entries_data_arr['laser_procedure_spot_size']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_spot_size']['field_value_OS'] != "") || 
(isset($multiple_entries_data_arr['laser_procedure_no_of_spots']) && $multiple_entries_data_arr['laser_procedure_no_of_spots']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_no_of_spots']['field_value_OS'] != "") ||
(isset($multiple_entries_data_arr['laser_procedure_note']) && $multiple_entries_data_arr['laser_procedure_note']['field_value_OD'] != "" && $multiple_entries_data_arr['laser_procedure_note']['field_value_OS'] != ""))
--}}

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
)

)

@php $laser_procedure_date = $form_details->eyeformmultipleentry()->where('field_name', 'laser_procedure_date')->first(); @endphp
<div class="col-md-12">
	<label><input type="checkbox" class="hide_print" name="hide_print[]" value="laser_procedure_laser" {{in_array('laser_procedure_laser', $print_eyeformFields) ? 'checked' : '' }}>Laser Procedure: </label>
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

                <div class="col-md-12">
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
                </div>
                <br>
                <br>

@if(count($casedata['prescriptions']) > 0)
				<div class="row">
            <div class="col-md-12">
               
<label><input type="checkbox" class="hide_print" name="hide_print[]" value="prescription_summary" {{in_array('prescription_summary', $print_eyeformFields) ? 'checked' : '' }}>Prescption summary: </label>
	                    
                  
                        
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                         <td><strong>Sr. No.</strong></td>
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

                <div class="col-md-12">
                    <ul class="list-unstyled">
                        <li class="">Please bring this paper on every visit</li>
                        <li class=""> Please follow the time </li>
                        <li class=""> Please inform allergy immediately </li>
                    </ul>
                </div>
          
                <div class="col-md-12">
                <div class="row">

                              @if(count($form_details->newBloodtestdata) > 0)
                              @foreach($form_details->newBloodtestdata as $key=>$bloodData)
                            <div class="col-md-4">
                                <label for="preoperative_chk"><b>{{$key}}</b></label>
                                <ul class="list-group1">
                                @foreach($bloodData as $pre_operative_bloodtests_row)
                                    <li class="list-group-item1" style="">{{$pre_operative_bloodtests_row->value}}</li>
                                @endforeach
                                </ul>
                                 
                            </div>
                            @endforeach
                             @endif
                    
                </div> 
				</div>


				


                <div class="row clearfix">
                  <div class="col-md-4 col-md-offset-4">
                  <div class="form-group">
                  <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> &nbsp;   
                 <!-- <button type="submit" class="btn btn-default btn-lg"> Edit </button>&nbsp; -->
				 
					  <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails/').'/'.$casedata['id'] }}" >Edit</a>&nbsp;
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
			

		$('.hide_print').on('click', function() {
			//alert(this.value);
			
			var url="{{ url('manage-print-display') }}";

			if($(this).is(':checked')) {
				var action = "add";
			} else {
				var action = "remove";
			}

			$.ajax({
				url:url,
				method:'post',
				data:{form_type: 'eyeform', value: this.value, action : action},
				success:function(data)
				{

				}
			});
			
			/*
			var test_type = $(this).data('type');
			var test = $(this).val();
			var is_checked = $(this).is(':checked') ? 1 : 0;

			console.log(test +' : '+ is_checked);

			var caseid=$("#caseid").val();
			var case_number=$("#case_number").val();

			var url="{{ url('manage-bloodinvestigation') }}";

			$.ajax({
				url:url,
				method:'post',
				data:{form_type: 'eyeform', test_type:test_type, test:test, is_checked:is_checked, caseid:caseid,case_number:case_number},
				success:function(data)
				{

				}
			});
			*/
		});
		

    });


</script>
 
@endsection
  