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
<div class="container">
    <div class="list-group list-group-horizontal">
        @foreach ($DateWiseRecordLst as $VisitListDateWise)
            @if($case_master['id'] == $VisitListDateWise['id'])
                <a href="{{ url('/Skin').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
            @else
                <a href="{{ url('/Skin').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
Patient History
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
                             Patient History | Case Number : {{ $case_master['case_number'] }}  | {{ 'Time :' . $case_master['visit_time']}}
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
{{ Form::hidden('case_id', Request::old('case_id',$case_master->id), array('class'=> 'form-control')) }}
<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        {{ Form::hidden('case_number', Request::old('case_number', $case_master->case_number), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>


      <div class="row">
                <div class="col-lg-12">
                    <img src="{{ Storage::disk('local')->url($logoUrl) }}" class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
            </div>

<!---------------------medial--------------------------------->
    <div class="panel-body" >
    <div class="container-fluid">
    
        <div class="table-responsive">
                <table class="table-bordered">
                    
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Symptom'])->all() as $item)
                        <tr>
                            <td>
                                Symptom
                            </td>
                            <td>
                                {{$item->valueData}}
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Duration'])->all() as $item)
                    <tr>
                        <td>
                            Duration
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @if(!$CheckField::IsFieldEmpty($skin->odp))
                    <tr>
                        <td>
                            ODP
                        </td>
                        <td colspan="2">
                            {{ $skin->odp }}
                        </td>
                    </tr>
                    @endif
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['OtherIssue'])->all() as $item)
                    <tr>
                        <td>
                            Other Issue
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['PastHistory'])->all() as $item)
                    <tr>
                        <td>
                            Past History
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['PersonalHistory'])->all() as $item)
                    <tr>
                        <td>
                            Personal History
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['MedicalHistory'])->all() as $item)
                    <tr>
                        <td>
                            Medical History
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['FamilyHistory'])->all() as $item)
                    <tr>
                        <td>
                            Family History
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Examination'])->all() as $item)
                    <tr>
                        <td>
                            Examination
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @if(!$CheckField::IsFieldEmpty($skin->PalmSole))
                    <tr>
                        <td>
                            Palm / Sole
                        </td>
                        <td colspan="2">
                            {{ $skin->PalmSole }}
                        </td>
                    </tr>
                    @endif
                    @if(!$CheckField::IsFieldEmpty($skin->GenitalArea))
                    <tr>
                        <td>
                            Genital Area
                        </td>
                        <td colspan="2">
                            {{ $skin->GenitalArea }}
                        </td>
                    </tr>
                    @endif
                    @if(!$CheckField::IsFieldEmpty($skin->OralMucosa))
                    <tr>
                        <td>
                            Oral Mucosa
                        </td>
                        <td colspan="2">
                            {{ $skin->OralMucosa }}
                        </td>
                    </tr>
                    @endif
                    @if(!$CheckField::IsFieldEmpty($skin->Nails))
                    <tr>
                        <td>
                            Nails
                        </td>
                        <td colspan="2">
                            {{ $skin->Nails }}
                        </td>
                    </tr>
                    @endif
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Investigation'])->all() as $item)
                    <tr>
                        <td>
                            Investigation
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Procedure'])->all() as $item)
                    <tr>
                        <td>
                            Procedure
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Consent'])->all() as $item)
                    <tr>
                        <td>
                            Consent
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @foreach ($db_skinmultiple->where('formfieldCode', $form_field_master['Diagnosis'])->all() as $item)
                    <tr>
                        <td>
                            Diagnosis
                        </td>
                        <td>
                            {{$item->valueData}}
                        </td>
                    </tr>
                    @endforeach
                    @if(!$CheckField::IsFieldEmpty($skin->SpecialComment))
                    <tr>
                        <td>
                            Special Comment
                        </td>
                        <td colspan="2">
                            {{ nl2br($skin->SpecialComment) }}
                        </td>
                    </tr>
                    @endif
                    @if((!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath)) || (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath)) )
                    <tr>
                        <td colspan="3">
                            Image Upload
                        </td>
                    </tr>
                    @endif
                    @if (!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath))
                    <tr>
                        <td>
                            Before Image
                        </td>
                        <td colspan="2">
                            @if (!empty($skin->BeforeImagePath) && !is_null($skin->BeforeImagePath))   
                                <p>&nbsp;</p>
                                <center id="BeforeImage"> 
                                    <img src={{ Storage::disk('local')->url($skin->BeforeImagePath)."?".filemtime(Storage::path($skin->BeforeImagePath)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                </center>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @if (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath))
                    <tr>
                        <td>
                            After Image
                        </td>
                        <td colspan="2">
                            @if (!empty($skin->AfterImagePath) && !is_null($skin->AfterImagePath))
                                <p>&nbsp;</p>
                                <center id="AfterImage"> 
                                    <img src={{ Storage::disk('local')->url($skin->AfterImagePath)."?".filemtime(Storage::path($skin->AfterImagePath)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
                                </center>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @if(!$CheckField::IsFieldEmpty($skin->FollowUpDate))
                    <tr>
                        <td>
                            Follow-Up Date
                        </td>
                        <td colspan="2">
                            {{ $skin->FollowUpDate }}
                        </td>
                    </tr>
                    @endif
                    @if(!$CheckField::IsFieldEmpty($skin->FollowUpTime))
                    <tr>
                        <td>
                            Follow-Up Time
                        </td>
                        <td colspan="2">
                            {{ $skin->FollowUpTime }}
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
         

        
     </div>
 </div>


</div>
</div>
</div>
</div>

<br><br>

<!-----------button----------------------->    
<div class="row clearfix">
<div class="col-md-4 col-md-offset-4">
<div class="form-group">
   <a class="btn btn-info btn-lg" href="{{ url('/Skin').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>    
   <a class="btn btn-info btn-lg" href="{{ url('/skin/print').'/'.$case_master->id }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
</div>
</div>
</div>
 <!----------end-button----------------------->  

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
    });
</script>
 
@endsection
