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

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
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
          <form action="{{ url('/Patients/save-discharge') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Add/Edit discharge </h2>
          </div>
           <input type="hidden" id="id" name="discharge_id" value="{{ isset($discharge_data->id) ? $discharge_data->id : ''}}" >
              <div class="body">
                  <div class="row clearfix ">

				  <input type="hidden" name="registration_id" value="{{$registration_data->id}}">


				  <!-- =================================================================================== -->
<h1>General Information</h1>
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">UHID No.  :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control" id="uhid_no" name="uhid_no" value="{{$registration_data->uhid_number}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">IPD No. :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control" id="ipd_no" name="ipd_no" value="{{$registration_data->ipd_number}}" type="text">
		</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control">Date & Time :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
			<input class="form-control datetimepicker" id="date_time" name="date_time" value="{{isset($discharge_data->discharge_summary_date_time)? $discharge_data->discharge_summary_date_time : ''}}" type="text">
		</div>
		</div>
	</div>
</div>
</div>    

                </div>
           </form>
			@include('patients.prescriptions.medicine_prescription')
			
            </div>
        </div>
</div>


<!-- ============================================================= -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<form action="{{ url('treatment-medication-sheet/'.$registration_data->id) }}" method="POST" class="form-horizontal" id="gynform">
				<div class="header bg-pink">
					<h2>Treatment Medication Sheet</h2>
				</div>

				<div class="body">
					<input type="hidden" name="registration_id" value="{{$registration_data->id}}">
	
					<div id="tpr_tables_div">
					@if(!empty($final_data)) 
						@foreach($final_data as $final_data_key => $final_data_row)
							@php $identifier = $final_data_key; @endphp
							@include('treatment_medication_sheet.elements.treatment_medication_sheet_main_row')
						@endforeach
						
						@php 
							unset($final_data_key); 
							unset($final_data_row); 
						@endphp
					@else 
						@php $identifier = strtotime('now'); @endphp
						@include('treatment_medication_sheet.elements.treatment_medication_sheet_main_row')
					@endif
					</div>
				</div>
				<div class="row clearfix">
					<div class="row clearfix">
						<div class="col-md-8 col-md-offset-3">
							<div class="form-group">
								<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_icsi_main" >
									<i class="fa fa-plus"></i> Submit
								</button>
								<a name="submit" class="btn btn-primary btn-lg" id="new_tpr" >
									<i class="fa fa-plus"></i> Add New
								</a>
								<a class="btn btn-primary btn-lg"  target="_blank" href="{{ url('/tpr-monitoring-chart/print').'/'. $registration_data->id }}" ><i class="glyphicon glyphicon-chevron-left"></i> Print </a>
							</div>
						</div>
					</div>
				</div>
				<br><br>
			</form>                          
		</div>
	</div>
</div>
<!-- ============================================================= -->
</div>

<div id="tpr_main_table_template" style="display:none">
	@php $identifier = '---replace_this---'; @endphp
	@include('treatment_medication_sheet.elements.treatment_medication_sheet_main_row')
</div>


<div style="display:none;">
	
	
	<table>
		<tbody  id="row_item_1_template">
			@php $identifier = '---replace_this---'; @endphp
			@include('treatment_medication_sheet.elements.row_item_1')
		</tbody>
	</table>
	<table>
		<tbody  id="row_item_2_template">
			@php $identifier = '---replace_this---'; @endphp
			@include('treatment_medication_sheet.elements.row_item_2')
		</tbody>
	</table>
	<table>
		<tbody  id="row_item_3_template">
			@php $identifier = '---replace_this---'; @endphp
			@include('treatment_medication_sheet.elements.row_item_3')
		</tbody>
	</table>
	<table>
		<tbody  id="row_item_4_template">
			@php $identifier = '---replace_this---'; @endphp
			@include('treatment_medication_sheet.elements.row_item_4')
		</tbody>
	</table>
	
</div>

 <script>
function replace_initial_identifier(target_html, replacement) {
	let to_replace = new RegExp('---replace_this---','g');
	return target_html = target_html.replace(to_replace, replacement);
}
$(document).on('click', '.icsi-menses-remove', function(e) {
	$(this).closest('.menses-row').remove();
});

$(document).on('click', '.add-more-tpr-row', function(e) {
	let identifier = $(this).closest('.row-item').data('identifier');
	
	let template_div = $(this).closest('.row-item').data('template');
	
	let target_html = $('#'+template_div).html();
	target_html = replace_initial_identifier(target_html, identifier);
	
	$(this).closest('.row-item').find('.row-item-table-body').append(target_html);	
});

$(document).on('click', '#new_tpr', function(e) {
	
	let x = Math.random().toString(36).slice(2);
	
	let total_divs = 1 + $('.main-data-table-div').length ;
	
	let identifier = x + total_divs;
	
	//alert(identifier);
	
	let target_html = $('#tpr_main_table_template').html();
	 
	 target_html = replace_initial_identifier(target_html, identifier);
	$('#tpr_tables_div').append(target_html);
});	

</script>

  @endsection
@section('scripts')

  @endsection  