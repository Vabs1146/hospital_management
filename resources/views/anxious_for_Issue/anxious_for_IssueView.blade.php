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
Patient Details
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


</div>
</div>
</div>
</div>

<!------------------2-panel------------------------------->

<div class="panel panel-col-pink">
<div class="panel-heading" role="tab" id="headingOne_9">
    <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion_8" href="#collapseOne_8" aria-expanded="true" aria-controls="collapseOne_8">
        Prescription
        </a>
    </h4>
</div>
<div id="collapseOne_8" class="panel-collapse collapse">
            <div class="container-fluid">
                <div class="panel-body">
                    <div class="table-responsive">
                        @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
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
						@endif
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
