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
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">


@endsection
@section('content')

    <div class="container">
    <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/glassPrescription').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/glassPrescription').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
          <form action="{{ url('/glassPrescription'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($case_master))
                    <input type="hidden" name="_method" value="PATCH">
                @endif

          <div class="header bg-pink">
          <h2>Add/Edit Glass Prescription </h2>
          </div>
           
              <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
                {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
                 {{ Form::hidden('patient_emailId', Request::old('patient_emailId'), array('class'=> 'form-control')) }}
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number" class="control-label">Case Number</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                                <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">                        
                              </div>
                              </div>
                              </div>   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="name_of_patient" class="control-label">Name Of Patient</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="name_of_patient" id="name_of_patient" class="form-control"  readonly='readonly' value="{{ $case_master['mr_mrs_ms'] or ''}} {{ $case_master['patient_name'] or ''}} {{ $case_master['middle_name'] or ''}} {{ $case_master['last_name'] or ''}}">                        
                              </div>
                              </div>
                              </div>
                          </div>

                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-condensed" id="refraction_table">
								
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
	<td>D.V.</td>
	<td>

	<!-- {{ Form::text('r_dv_sph', Request::old('r_dv_sph', $glass_prescription->r_dv_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_dv_sph" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" data-selected="{{$glass_prescription->r_dv_sph}}" {{isset( $glass_prescription->r_dv_sph) &&  $glass_prescription->r_dv_sph == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	<!-- {{ Form::text('r_dv_cyl', Request::old('r_dv_cyl', $glass_prescription->r_dv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_dv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_dv_cyl) &&  $glass_prescription->r_dv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('r_dv_axi', Request::old('r_dv_axi', $glass_prescription->r_dv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	<!-- {{ Form::text('r_dv_vision', Request::old('r_dv_vision', $glass_prescription->r_dv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="r_dv_vision" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_dv_vision) &&  $glass_prescription->r_dv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>

	<td>
	<!-- {{ Form::text('l_dv_sph', Request::old('l_dv_sph', $glass_prescription->l_dv_sph??''), array('class' => 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_dv_sph" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['sph'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_dv_sph) &&  $glass_prescription->l_dv_sph == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	<!-- {{ Form::text('l_dv_cyl', Request::old('l_dv_cyl', $glass_prescription->l_dv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_dv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_dv_cyl) &&  $glass_prescription->l_dv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
	<td>
	{{ Form::text('l_dv_axi', Request::old('l_dv_axi', $glass_prescription->l_dv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	<!-- {{ Form::text('l_dv_vision', Request::old('l_dv_vision', $glass_prescription->l_dv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }} -->
	
<select name="l_dv_vision" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
	@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
		<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_dv_vision) &&  $glass_prescription->l_dv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
	@endforeach
</select>
	</td>
</tr>

<tr>
	<td>Add</td>
	<td>
		{{ Form::text('r_add_sph', Request::old('r_add_sph', $glass_prescription->r_add_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td> </td>
	<td> </td>
	<td> </td>

	<td>
		{{ Form::text('l_add_sph', Request::old('l_add_sph', $glass_prescription->l_add_sph??''), array('class' => 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td> </td>
	<td> </td>
	<td> </td>
</tr>

<tr>
	<td>N.V.</td>
	<td>
	{{ Form::text('r_nv_sph', Request::old('r_nv_sph', $glass_prescription->r_nv_sph??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('r_nv_cyl', Request::old('r_nv_cyl', $glass_prescription->r_nv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}

	<select name="r_nv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_nv_cyl) &&  $glass_prescription->r_nv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>

	</td>
	<td>
	{{ Form::text('r_nv_axi', Request::old('r_nv_axi', $glass_prescription->r_nv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('r_nv_vision', Request::old('r_nv_vision', $glass_prescription->r_nv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
	<select name="r_nv_vision" class="form-control" style=" width: 90px; ">
		<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->r_nv_vision) &&  $glass_prescription->r_nv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>
	</td>

	<td>
	{{ Form::text('l_nv_sph', Request::old('l_nv_sph', $glass_prescription->l_nv_sph??''), array('class'
	=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('l_nv_cyl', Request::old('l_nv_cyl', $glass_prescription->l_nv_cyl??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
	<select name="l_nv_cyl" class="form-control" style=" width: 90px; ">
	<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['cyl'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_nv_cyl) &&  $glass_prescription->l_nv_cyl == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>

	</td>
	<td>
	{{ Form::text('l_nv_axi', Request::old('l_nv_axi', $glass_prescription->l_nv_axi??''), array('class'=> 'form-control', 'autocomplete'=>'off')) }}
	</td>
	<td>
	{{-- Form::text('l_nv_vision', Request::old('l_nv_vision', $glass_prescription->l_nv_vision??''), array('class'=> 'form-control', 'autocomplete'=>'off')) --}}
	<select name="l_nv_vision" class="form-control" style=" width: 90px; ">
		<option value="">Select</option>
		@foreach($refraction_dropdowns_arr['vision'] as $refraction_dropdowns_arr_row)
			<option value="{{$refraction_dropdowns_arr_row}}" {{isset( $glass_prescription->l_nv_vision) &&  $glass_prescription->l_nv_vision == $refraction_dropdowns_arr_row ? 'selected' : ''}}>{{$refraction_dropdowns_arr_row}}</option>
		@endforeach
	</select>
	</td>
</tr>
</tbody>

								</table>
                        </div>
                        </div>


                           <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('Report_1','Remark') }} 
                              </div>
                              </div>


                              <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Report_1', Request::old('Report_1', $glass_prescription->Report_1), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>

                             

                          </div>
					  
					   <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Email To </label>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="form-line">
                                          <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                         </div>
                                        </div> 
                                        <div class="col-md-2">
                                          <button type="submit" formaction="{{ url('glass_prescriptionEmail') }}" name="submit" class="btn btn-success btn-lg" value="submit" >Email To Other</button>&nbsp;
                                           
                                        
                                        </div>
                                      </div>


                                     
                  </div>    

                  <div class="row clearfix">
                    <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                    </button>
                    <a class="btn btn-default btn-lg" href="{{ url('/glassPrescription') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details </a>
                    <a class="btn btn-default btn-lg" href="{{ url('/glassPrescription/print').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>
                    {{-- <a class="btn btn-default" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a> --}}
						
					<button type="submit" formaction="{{ url('glass_prescriptionEmail1') }}" name="submit" class="btn btn-success btn-lg" value="submit" >Submit & Email</button>&nbsp;

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

<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>

<script>    
     jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} ">
</script>
<script>
        var url = "{{ url('/genericAutocomplete') }}";
        jq(".autocompleteTxt").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ url('/genericAutocomplete') }}",
                    dataType: "json",
                    data: {
                        query: request.term,
                        PropertyName: jq(this.element).attr('name'),//'Complaints' 
                        tableName: 'glass_prescriptions'
                    },
                    success: function(data) {
                        data = JSON.parse(JSON.stringify(data));
                        response(data);
                    }
                });
            }
        });

$('#refraction_table select[name="r_dv_sph"]').change(function(){
  calculate_sph();
});
$('#refraction_table input[name="r_add_sph"]').blur(function(){
  calculate_sph();
});

function calculate_sph() {
	var sph = $('#refraction_table select[name="r_dv_sph"]').val();
	var add = $('#refraction_table input[name="r_add_sph"]').val();
	sph = (!isNaN(parseFloat(sph))) ? parseFloat(sph) : 0;
	add = (!isNaN(parseFloat(add))) ? parseFloat(add) : 0;

	var adition_value = sph + add;

	var addition_text = (adition_value  >= 0 ) ? '+'+ adition_value : adition_value;
	$('#refraction_table input[name="r_nv_sph"]').val(addition_text);
}

$('#refraction_table select[name="l_dv_sph"]').change(function(){
  calculate_sph_l();
});
$('#refraction_table input[name="l_add_sph"]').blur(function(){
  calculate_sph_l();
});

function calculate_sph_l() {
	var sph = $('#refraction_table select[name="l_dv_sph"]').val();
	var add = $('#refraction_table input[name="l_add_sph"]').val();
	sph = (!isNaN(parseFloat(sph))) ? parseFloat(sph) : 0;
	add = (!isNaN(parseFloat(add))) ? parseFloat(add) : 0;
	var adition_value = sph + add;

	var addition_text =  (adition_value  >= 0 ) ? '+'+ adition_value : adition_value;

	$('#refraction_table input[name="l_nv_sph"]').val(addition_text);
}

/*
$('#refraction_table input[name="r_dv_cyl"]').blur(function(){
  $('#refraction_table input[name="r_nv_cyl"]').val($('#refraction_table input[name="r_dv_cyl"]').val());
});

$('#refraction_table input[name="r_dv_axi"]').blur(function(){
  $('#refraction_table input[name="r_nv_axi"]').val($('#refraction_table input[name="r_dv_axi"]').val());
});

$('#refraction_table input[name="l_dv_cyl"]').blur(function(){
  $('#refraction_table input[name="l_nv_cyl"]').val($('#refraction_table input[name="l_dv_cyl"]').val());
});

$('#refraction_table input[name="l_dv_axi"]').blur(function(){
  $('#refraction_table input[name="l_nv_axi"]').val($('#refraction_table input[name="l_dv_axi"]').val());
});
*/

$('#refraction_table select[name="r_dv_cyl"]').change(function(){
	//alert('hi');
  $('#refraction_table select[name="r_nv_cyl"]').val($('#refraction_table select[name="r_dv_cyl"]').val());
});

$('#refraction_table input[name="r_dv_axi"]').blur(function(){
  $('#refraction_table input[name="r_nv_axi"]').val($('#refraction_table input[name="r_dv_axi"]').val());
});

$('#refraction_table select[name="l_dv_cyl"]').change(function(){
  $('#refraction_table select[name="l_nv_cyl"]').val($('#refraction_table select[name="l_dv_cyl"]').val());
});

$('#refraction_table input[name="l_dv_axi"]').blur(function(){
  $('#refraction_table input[name="l_nv_axi"]').val($('#refraction_table input[name="l_dv_axi"]').val());
});

</script>

@endsection








