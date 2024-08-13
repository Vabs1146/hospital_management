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
        display: none;
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

@endsection
@section('content')
<div class="container">
    <div class="list-group list-group-horizontal">
        @foreach($DateWiseRecordLst as $VisitListDateWise)
            @if($case_master['id'] == $VisitListDateWise['id'])
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
                     <form action="{{ url('/AddEditEyeDetails/').'/'.$case_master['id'] }}" method="GET" class="form-horizontal">
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
                                                         Patient History | Case Number : {{ $case_master['case_number'] }}
                                                    </a>
                                                </h4>
                                            </div>
                          <div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
                          {{ Form::hidden('case_id', Request::old('case_id',$case_master['id']), array('class'=> 'form-control')) }}
            <div class="panel-body">
            <div class="row clearfix">
            <div class="col-md-12">
              <div class="form-group">
               {{ Form::hidden('case_number', Request::old('case_number', $case_master['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
              </div>
            </div>
            <div class="col-md-12">
                <label class="control-label">Patient's Name :</label>
                  {{$case_master['patient_name']}} 
            </div>
            <div class="col-md-12">
                 <label class="control-label">Address :</label> 
                  {{$case_master['patient_address']}}
            </div>
            <div class="col-md-12">
                <label class="control-label">Tel. No. :</label>
                 {{$case_master['patient_mobile']}} 
            </div>
            <div class="col-md-12">
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c2.png') }}" /> 
                                {{ Form::checkbox('dentist_pain_in[]', '1', in_array('1', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c3.png') }}" />
                                 {{ Form::checkbox('dentist_pain_in[]', '2', in_array('2', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c4.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '3', in_array('3', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c5.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '4', in_array('4', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c6.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '5', in_array('5', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c7.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '6', in_array('6', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c8.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '7', in_array('7', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c9.png') }}" /> 
                                {{ Form::checkbox('dentist_pain_in[]', '8', in_array('8', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c10.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '9', in_array('9', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c11.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '10', in_array('10', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c12.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '11', in_array('11', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c13.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '12', in_array('12', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c14.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '13', in_array('13', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c15.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '14', in_array('14', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c16.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '15', in_array('15', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
                                <i class="fa fa-check hidden"></i>
                            </label>
                        </div>
                        <div class="checkboxContainer text-center">
                            <label class="image-checkbox">
                                <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c17.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '16', in_array('16', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                                }}
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
                        <legend>Oral Examination : </legend>
                        <div class="col-md-6">
                        <label for="oral_examination" class="control-label">&nbsp;</label>
                        {{ $dentist->oral_examination }}
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <legend>Advised Treatment </legend>
                        <div class="col-md-6">
                        <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                        {{ $dentist->advised_treatment_1 }}
                        </div>
                        <div class="col-md-6">
                        <label for="advised_treatment_2" class="control-label">&nbsp;</label>
                        {{ $dentist->advised_treatment_2 }}
                        </div>
                        <div class="col-md-6">
                        <label for="advised_treatment_3" class="control-label">&nbsp;</label>
                        {{ $dentist->advised_treatment_3 }}
                        </div>
                        <div class="col-md-6">
                        <label for="advised_treatment_4" class="control-label">&nbsp;</label>
                        {{ $dentist->advised_treatment_4 }}
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="col-md-6">
                    {{ Form::label('is_diabetes','diabetic?') }} 
                    {{ $dentist->is_diabetes }}
                    </div>
                    <div class="col-md-6">
                    {{ Form::label('is_bp','BP?') }} 
                    {{ $dentist->is_bp }}
                    </div>
                    <div class="col-md-6">
                    {{ Form::label('is_haemophiles','Haemophile?') }} 
                    {{ $dentist->is_haemophiles }}
                    </div>
                    <div class="col-md-6">
                    {{ Form::label('any_other_disease','Any Other Disease?') }} 
                    {{ $dentist->any_other_disease }}
                    </div>
                    </div>
              </div>
 
               
                <div class="row clearfix">
                <div class="col-md-4 col-md-offset-4">
                <div class="form-group">
                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>&nbsp;
                <a class="btn btn-default btn-lg" href="{{ url('/PrintMedicalDetails/').'/'.$case_master['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>&nbsp;
               
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
<script type="text/javascript">
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
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
    });
</script>
@endsection