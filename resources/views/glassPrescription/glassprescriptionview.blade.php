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
      
<div class="card">

<div class="header bg-orange">
<h2>
View Glass Prescription
</h2>
</div>
    <div class="body">
     <div class="row clearfix">
         <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
             <div class="panel-group" id="accordion_9" role="tablist" aria-multiselectable="true">
                 <div class="panel panel-col-orange">
                    <div class="panel-heading" role="tab" id="headingOne_9">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion_9" href="#collapseOne_9" aria-expanded="true" aria-controls="collapseOne_9">
                              <span> Case Number : <b>{{ $casedata['case_number']  }} </b> Patient Name : <b>
        {{ $casedata['patient_name'] }} </b> </span>
                            </a>
                        </h4>
                    </div>

<div id="collapseOne_9" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_9">
 {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}

<div class="panel-body">
<div class="row clearfix">
  <div class="row">
  @foreach ($report_image as $rptImg)
    @if(isset($rptImg) && $rptImg != null && isset($rptImg->filePath))
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="{{ url('/printEyeReportFiles') . '/' . $rptImg->id }}" target="_blank">
            <img src="{{ Storage::disk('local')->url($rptImg->filePath) }}" alt="Lights" style="width:100%">
            <div class="caption">
              <p>&nbsp;</p>
            </div>
          </a>
        </div>
      </div>
    {{-- <a href="{{ Storage::disk('local')->url($rptImg->filePath) }}" class="" target="_blank"> {{$loop->iteration}}
    Report file </a> --}}
    @endif
  @endforeach
</div>

     

<!---------------------medial--------------------------------->
    <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="case_number" class="control-label">Case Number :</label>   {{ $case_master['case_number'] }} 
        </div>
        <div class="col-sm-6">
        
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $case_master['patient_name'] }} 
        </div>
        <div class="col-sm-6">
            <div class="col-sm-6">
                <label class="control-label">Age :</label>   {{ $case_master['patient_age'] }}
            </div>
            <div class="col-sm-6">
                <label class="control-label">Gender :</label>   {{ $case_master['male_female'] }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="control-label">Address :</label>   {{ $case_master['patient_address'] }} 
        </div>
        <div class="col-sm-6">
            <label class="control-label">Contact No. :</label>   {{ $case_master['patient_mobile'] }}
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
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Remark :</label>   {{ $glass_prescription->Report_1 }} 
        </div>
    </div>
    
    <div class="row">
            <div class="col-sm-6">
      </div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <a>Dr. Shashikant Nikhate.</a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
    <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
</div>
</div>
</div>
</div>
</div>
</div>



@endsection

