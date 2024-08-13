<?php
use App\helperClass\drAppHelper; 
$commonHelper = new drAppHelper();
?>
@extends('adminlayouts.master')
@section('style')
<style>
        @media screen and (max-width: 767px) {
            .select2 {
                width: 100% !important;
            }
        }
        .ui-autocomplete-loading {
            background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
        }

.checkboxContainer {
    padding-left: 0 !important;
    padding-right: 0 !important;
    position: relative;
    float: left;
}
/*image gallery*/
.image-checkbox {
    cursor: pointer;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border: 4px solid transparent;
    margin-bottom: 0;
    outline: 0;
     
}
.image-checkbox input[type="checkbox"] {
    display: none;
}

.image-checkbox-checked {
    border-color: #4783B0;
      display: inline-block;
}
.image-checkbox .fa {
  position: absolute;
  color: #4A79A3;
  background-color: #fff;
  /* padding: 10px; */
  top: 0;
  right: 0;
}
.image-checkbox-checked .fa {
  display: block !important;
}

    </style>
   <link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

@endsection
@section('content')
<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form action="{{ url('/dentist'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($case_master))
                    <input type="hidden" name="_method" value="PATCH">
                @endif
                   @if(Session::has('flash_message'))
                      <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                      </div>
                                  @endif
                  <div class="card">
                        <div class="header  bg-pink">
                            <h2> Patient Name : {{ $commonHelper->get_patient_full_name($case_master['id'])}} | Case Number : {{ $case_master['case_number'] }} </h2>
                        </div>
                        <div class="body">
                          <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
						  <input type="hidden" name="patient_emailId" value="{{ $case_master['patient_emailId'] or ''}}">
                            <div class="row clearfix">
                              <div class="col-md-12">
                                <label class="">Chief Complaint :</label>
                              </div>
                            <div class="col-md-12 ">

							@php //dd($dentist_pain_in->pluck('pain_in_teeth')->toArray()) @endphp
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c2.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '1', in_array('1', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c3.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '2', in_array('2', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c4.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '3', in_array('3', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c5.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '4', in_array('4', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c6.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '5', in_array('5', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c7.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '6', in_array('6', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c8.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '7', in_array('7', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c9.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '8', in_array('8', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c10.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '9', in_array('9', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c11.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '10', in_array('10', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c12.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '11', in_array('11', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c13.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '12', in_array('12', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c14.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '13', in_array('13', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c15.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '14', in_array('14', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c16.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '15', in_array('15', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                            <div class="checkboxContainer text-center">
                                <label class="image-checkbox">
                                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c17.png') }}"
                                    />
                                    {{ Form::checkbox('dentist_pain_in[]', '16', in_array('16', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                    <i class="fa fa-check hidden"></i>
                                </label>
                            </div>
                              </div>
                              <div class="col-md-12">
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c2.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '17', in_array('17', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c3.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '18', in_array('18', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c4.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '19', in_array('19', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c5.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '20', in_array('20', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c6.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '21', in_array('21', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c7.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '22', in_array('22', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c8.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '23', in_array('23', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c9.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '24', in_array('24', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c10.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '25', in_array('25', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c11.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '26', in_array('26', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c12.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '27', in_array('27', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c13.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '28', in_array('28', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c14.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '29', in_array('29', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c15.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '30', in_array('30', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c16.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '31', in_array('31', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                                <div class="checkboxContainer text-center">
                                    <label class="image-checkbox">
                                        <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c17.png') }}"
                                        />
                                        {{ Form::checkbox('dentist_pain_in[]', '32', in_array('32', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                              </div>
                              <div class="col-md-12">
                              <label for="oral_examination" class="control-label">Oral Examination</label>
                              
                              <input type="text" name="oral_examination" id="oral_examination" class="form-control" value="{{ $dentist['oral_examination'] or ''}}">
                              </div>

                              <div class="col-md-12">
                              <legend>Advised Treatment </legend>
                            
                              <div class="col-md-6">
                              <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                              {{ Form::text('advised_treatment_1', Request::old('advised_treatment_1',$dentist->advised_treatment_1), array('class' => 'form-control')) }}
                              </div> 

                              <div class="col-md-6">
                              <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                              {{ Form::text('advised_treatment_2', Request::old('advised_treatment_2',$dentist->advised_treatment_2), array('class' => 'form-control')) }}
                              </div> 

                              <div class="col-md-6">          
                              <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                              {{ Form::text('advised_treatment_3', Request::old('advised_treatment_3',$dentist->advised_treatment_3), array('class' => 'form-control')) }}
                              </div>

                              <div class="col-md-6">
                              <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                              {{ Form::text('advised_treatment_4', Request::old('advised_treatment_4',$dentist->advised_treatment_4), array('class' => 'form-control')) }}
                              </div> 
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('is_diabetes','diabetic?') }}  
                              </div>
                              </div>

                              <div class="col-md-4">
                              {{ Form::select('is_diabetes',array(''=>'Please select','Yes'=>'Yes', 'No'=>'No'), Request::old('is_diabetes',$dentist->is_diabetes), array('class' => 'form-control select2','data-live-search'=>'true')) }}                           
                              </div> 

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('is_bp','BP?') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              {{ Form::select('is_bp',array(''=>'Please select','Yes'=>'Yes', 'No'=>'No'), Request::old('is_bp',$dentist->is_bp), array('class' => 'form-control select2','data-live-search'=>'true')) }}                            
                              </div>  
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('is_haemophiles','Haemophile?') }}   
                              </div>
                              </div>

                              <div class="col-md-4">
                              {{ Form::select('is_haemophiles',array(''=>'Please select','Yes'=>'Yes', 'No'=>'No'), Request::old('is_haemophiles',$dentist->is_haemophiles), array('class' => 'form-control select2','data-live-search'=>'true')) }}                           
                              </div> 

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('any_other_disease','Any Other Disease?') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              {{ Form::select('any_other_disease',array(''=>'Please select','Yes'=>'Yes', 'No'=>'No'), Request::old('any_other_disease',$dentist->any_other_disease), array('class' => 'form-control select2','data-live-search'=>'true')) }}                           
                              </div>  

                              </div>
								
								
								
                           </div>
                           <div class="row clearfix">
                                <div class="col-md-8 col-md-offset-2">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                                </button>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/AddEdit/entprescription/').'/'. $case_master['id'] }}">
                                <i class="glyphicon glyphicon-chevron-left"></i> Add Prescription 
                                </a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/report_files/').'/'.$case_master['id'].'/edit' }}">
                                <i class="glyphicon glyphicon-chevron-left"></i> Add Report 
                                </a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/dentistBill/').'/'.$case_master['id'].'/edit' }}">
                                <i class="glyphicon glyphicon-chevron-left"></i> Add Bill 
                                </a>&nbsp;
									
									<a class="btn btn-default btn-lg" href="{{ url('/dentist/').'/'.$case_master['id'] }}">
                                <i class="fa fa-eye"></i> view 
                                </a>&nbsp;
									
									<a class="btn btn-default btn-lg" href="{{ url('/dentist/print').'/'.$case_master['id'] }}">
                                <i class="fa fa-print"></i> Print
                                </a>&nbsp;
									
									
                                <button type="submit" name="SubmitMail" class="btn btn-primary btn-lg" value="SubmitMail"><i class="fa fa-plus"></i> Submit & Mail</button>
                                      
                                </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>


</div>


 @endsection
@section('scripts')
<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
      //$('.datepicker').datepicker({
            //format: "dd/M/yyyy",
           // weekStart: 1,
            //clearBtn: true,
           // daysOfWeekHighlighted: "0,6",
           // autoclose: true,
       // });
        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function () {
        if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
            $(this).addClass('image-checkbox-checked');
        }
        else {
            $(this).removeClass('image-checkbox-checked');
        }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
        $(this).toggleClass('image-checkbox-checked');
        var $checkbox = $(this).find('input[type="checkbox"]');
        $checkbox.prop("checked",!$checkbox.prop("checked"))

        e.preventDefault();
        });
    });
</script>

<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection