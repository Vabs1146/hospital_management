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
<div class="container-fluid">
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
<form action="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}" method="GET" class="form-horizontal">
{{ csrf_field() }}
<div class="header bg-pink">
<h2>
Patient Details.
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
                             Case Number : {{ $casedata['case_number'] }} 
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
{{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
        </div>
      </div>

<!---------------------medial--------------------------------->
    <div class="panel-body" >
    <div class="container-fluid">
      <div class="table-responsive">
    <table class="table  table-bordered">
        <tbody>
             @if(!$CheckField::IsFieldEmpty($patient_details->Complaints))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Presenting Complaints with duration :</label></td>
                <td>
                 {{($patient_details->Complaints)}}
                 
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->History))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Past History</label></td>
                <td>
                 {{($patient_details->History)}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->PastPersonalHistory))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Past Personal History </label></td>
                <td>
                 {{($patient_details->PastPersonalHistory)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->menarch))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Menarche </label></td>
                <td>
                 {{($patient_details->menarch)}}
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
            @if(!$CheckField::IsFieldEmpty($patient_details->presentPregnencyEDD))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">EDD </label></td>
                <td>
                 {{($patient_details->presentPregnencyEDD)}}
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
              <td><label for="MensturationHistory" class="control-label">Height </label></td>
                <td>
                  {{ $patient_details->GenExamWeight.' kg' }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->GenExamWeight))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Height </label></td>
                <td>
                  {{ $patient_details->GenExamWeight.' kg' }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($patient_details->BMI))
            <tr>
              <td><label for="MensturationHistory" class="control-label">BMI </label></td>
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
              <td><label for="MensturationHistory" class="control-label">AG </label></td>
                <td>
                  {{ $patient_details->AG }}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($patient_details->BMI))
            <tr>
              <td><label for="MensturationHistory" class="control-label">Pulse </label></td>
                <td>
                  {{  $patient_details->GenExamPulse .' per min' }}
                </td>
            </tr>
            @endif
              @if(!$CheckField::IsFieldEmpty($patient_details->Temp))
            <tr>
              <td><label for="MensturationHistory" class="control-label">BP </label></td>
                <td>
                  {{ $patient_details->GenExamBP . '/' . $patient_details->GenExamBP_lower . 'mmhg'  }}
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
              <td><label for="MensturationHistory" class="control-label">Pallor </label></td>
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
            @endif
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
            @if(!$CheckField::IsFieldEmpty($patient_details->SysExamLocalExam))
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
            @endif
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
            @if(!$CheckField::IsFieldEmpty($casedata['appointment_dt']))
            <tr>
              <td>{{ Form::label('followupDate','Follow-up Date') }} </td>
                <td>
                  {{ $casedata['appointment_dt'] }}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($casedata['appointment_timeslot']))
            <tr>
              <td>{{ Form::label('FollowUpTimeSlot','Follow up Time Slot') }} </td>
                <td>
                  {{ $casedata['appointment_timeslot'] }}
                </td>
            </tr>
            @endif
          

        </tbody>
    </table>
 </div>
    

        
     </div>
 </div>


</div>
</div>
</div>
</div>

<!------------------2-panel------------------------------->

<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion_9" href="#collapse3" aria-expanded="true" aria-controls="collapseOne_9">
        Prescription
        </a>
    </h4>
</div>
<div id="collapse3" class="panel-collapse collapse">
            <div class="container-fluid">
                <div class="panel-body">
                    <div class="table-responsive">
                         @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
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
                                @endif
                            </table>
                        </div>
                </div>
            </div>
        </div>  
</div>
<!-----------------end-2-panel------------------------------->
<!----------------3-panel------------------------------------>
<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <div class="panel-heading">
        <h4 class="panel-title">
           <a data-toggle="collapse" data-parent="#accordion" href="#collapseNote">
            Note</a>
        </h4>
    </div>
    <div id="collapseNote" class="panel-collapse collapse in">
        <div class="container">
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li class="">Please bring this paper on every visit</li>
                    <li class=""> Please follow the time </li>
                    <li class=""> Please inform allergy immediately </li>
                </ul>
            </div>
        </div> 
    </div>
</div>
</div>
<br>
<!---------------end-3-panel------------------------------------>

<!-----------button----------------------->    
<div class="row clearfix">
<div class="col-md-4 col-md-offset-4">
<div class="form-group">
   <a class="btn btn-info btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>    
   <button type="submit" class="btn btn-info btn-lg"> Edit </button>
   <a class="btn btn-info btn-lg" href="{{ url('/PrintMedicalDetails/').'/'.$casedata['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
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
        
        $("#Tabseyehistory a[href='"+$("#field_type_id").val()+"']").tab('show');
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            $("#field_type_id").val(target);
            $("#memory_id").val('');
        });
        $("#TabContainerDiv a.memoryList").on('click',function(e){
            e.preventDefault();
            $("#memory_id").val($(this).data('id'));
            $("button[name='mem_delete']").addClass('hidden');
            $.get('/getMemoryDetials/'+$(this).data('id'),function(data){
                 $("input[name='title']").val(data.title);
                 $("input[name='memory_data']").val(data.data);
                 if(data.field_type_id = "1"){
                    $("input[name='complaint']").val(data.data);
                 }
                 if(data.field_type_id = "2"){
                    $("input[name='Diagnosis']").val(data.data);
                 }
                 if(data.field_type_id = "3"){
                    $("input[name='Treatment']").val(data.data);
                 }
                 $("button[name='mem_delete']").removeClass('hidden');
            });
           
        });    
    });
</script>

<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>

<script>    
     jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} ">
</script>
<script>
        var url = "{{ url('/caseHistoryAutocomplete') }}";
        jq(".autocompleteTxt").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ url('/caseHistoryAutocomplete') }}",
                    dataType: "json",
                    data: {
                        query: request.term,
                        PropertyName: jq(this.element).attr('name')//'Complaints' 
                    },
                    success: function(data) {
                        data = JSON.parse(JSON.stringify(data));
                        response(data);
                    }
                });
            }
        });
</script>

@endsection
