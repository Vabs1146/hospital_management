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
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      @include('shared.error')
      @if(Session::has('flash_message'))
      <div class="alert alert-success">
     {{ Session::get('flash_message') }}
      </div>
      @endif
<div class="card">
<form action="{{ url('/MedicineStock').'/'.$form_details['id'] }}" method="GET" class="form-horizontal">
{{ csrf_field() }}
<div class="header bg-pink">
<h2>
Medicine Stock Details
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
                             Medicine Stock 
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">

<div class="panel-body">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="form-group">
        
        </div>
      </div>

<!---------------------medial--------------------------------->
    <div class="panel-body" >
    <div class="container-fluid">
      <div class="table-responsive">
    <table class="table  table-bordered">
        <tbody>
             @if(!$CheckField::IsFieldEmpty($form_details->medicine_name))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Name Of Medicine :</label></td>
                <td>
                 {{($form_details->medicine_name)}}
                 
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->Remaining_Stock_Qty))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Remaining Stock Qty</label></td>
                <td>
                 {{($form_details->Remaining_Stock_Qty)}}
                </td>
            </tr>
            @endif
             @if(!$CheckField::IsFieldEmpty($form_details->Mfg_date))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Mfg.date  </label></td>
                <td>
                 {{($form_details->Mfg_date)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->Exp_date))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Exp date </label></td>
                <td>
                 {{($form_details->Exp_date)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->Stock_in_date))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Stock in date </label></td>
                <td>
                 {{($form_details->Stock_in_date)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->Stock_Out_date))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Stock Out date</label></td>
                <td>
                 {{($form_details->Stock_Out_date)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->Cost))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">Cost </label></td>
                <td>
                 {{($form_details->Cost)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->unit_Received))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">unit Received</label></td>
                <td>
                 {{($form_details->unit_Received)}}
                </td>
            </tr>
            @endif
            @if(!$CheckField::IsFieldEmpty($form_details->unit_issued))
            <tr>
              <td> <label for="MensturationHistory" class="control-label">unit issued  </label></td>
                <td>
                 {{($form_details->unit_issued)}}
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
   <a class="btn btn-info btn-lg" href="{{ url('/MedicineStock') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>    


   <a class="btn btn-info btn-lg" href="{{ url('/MedicineStock/print/').'/'.$form_details['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
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
