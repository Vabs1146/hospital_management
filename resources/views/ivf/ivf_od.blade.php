@php //echo "======>>>> <pre>"; print_r($casedata); exit; @endphp
@extends('adminlayouts.master')

@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
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

/*
.doses-medicine-container .doses-medicine-row:not(:last-child) .od-menses-doses-remove {
	display:none !important;
}

.doses-medicine-container .doses-medicine-row:not(:last-child) .od-menses-doses-add-more {
	display:inline-block !important;
}
*/

.doses-medicine-container .doses-medicine-row:not(:last-child) .od-menses-doses-remove {
	display:inline-block !important;
}

.doses-medicine-container .doses-medicine-row:last-child .od-menses-doses-add-more {
	display:inline-block !important;
}

#menses_table .od-menses-row:not(:last-child) .od-menses-tr-remove {
	display:inline-block !important;
}

#menses_table .od-menses-row:last-child .od-menses-tr-add-more {
	display:inline-block !important;
}

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">
<style></style>
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
            <form action="{{ url('save-ivf/'.$casedata['id']) }}" method="POST" class="form-horizontal" id="gynform">
<!-- ===================================================================================== -->
 {{ csrf_field() }}
<div class="header bg-pink">
	<div class="header bg-pink">
		<!-- <h2>
			Patient Name : {{ $casedata['patient_name'] }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . @$casedata['visit_time']}}  
		</h2> -->

		<h2>{{strtoupper($ivf_type)}}</h2>
	  
	</div>
</div>
<div class="body">
	{{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
	{{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
	
	{{ Form::hidden('ivf_type', $ivf_type, array('class'=> 'form-control')) }}
	<div class="row clearfix">
	<!--  -------------------------------------------------------------------------- -->

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label for="ivf_od_lmp" class="form-control">LMP :</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<div class="form-line">
						{{ Form::text('ivf_od_lmp', isset($main_details->ivf_od_lmp) ? $main_details->ivf_od_lmp : '', array('class'=> 'form-control datetimepicker')) }}   
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">            
					{{ Form::label('ivf_od_pre_ivf_heteroscopy','Pre-IVF Hysteroscopy :') }} 
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="form-group">
					<div class="form-line">           
						{{ Form::textarea('ivf_od_pre_ivf_heteroscopy', isset($main_details->ivf_od_pre_ivf_heteroscopy) ? $main_details->ivf_od_pre_ivf_heteroscopy : '', array('class'=> 'form-control ')) }}       
					</div>
				</div>
			</div>
		</div>

@include('ivf.elements.od_agonist_dep')

		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label for="ivf_od_cycle_type" class="form-control">CYCLE TYPE</label>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<div class="form-line">
{{ Form::text('ivf_od_cycle_type', isset($main_details->ivf_od_cycle_type) ? $main_details->ivf_od_cycle_type : '', array('class' => 'form-control')) }}                            
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label for="ivf_od_injection" class="form-control"> INJECTION :</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<div class="form-line">
						{{ Form::text('ivf_od_injection', isset($main_details->ivf_od_injection) ? $main_details->ivf_od_injection : '', array('class' => 'form-control')) }}                            
					</div>
				</div>
			</div>
		</div>

@include('ivf.elements.od_table');
		
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="ivf_followup" class="form-control">Follow-up Date & Time :</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_1', ($main_details->ivf_followup_1) ? $main_details->ivf_followup_1 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_2', ($main_details->ivf_followup_2) ? $main_details->ivf_followup_2 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_3', ($main_details->ivf_followup_3) ? $main_details->ivf_followup_3 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				 {{ Form::text('ivf_followup_4', ($main_details->ivf_followup_4) ? $main_details->ivf_followup_4 : '', array('class'=> 'form-control datepicker')) }}                            
			</div>
		</div>
	</div>
</div>
		

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">            
			{{ Form::label('ivf_od_notes','Notes :') }} 
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="col-md-12">
		<div class="form-group">
			<div class="form-line">           
				{{ Form::textarea('ivf_od_notes', isset($main_details->ivf_od_notes) ? $main_details->ivf_od_notes : '', array('class'=> 'form-control ')) }}       
			</div>
		</div>
	</div>
</div>


	</div>
</div>


<div class="row clearfix">
	<div class="col-md-8 col-md-offset-3">
		<div class="form-group">
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_od_main" >
			<i class="fa fa-plus"></i> Submit
			</button>
			<button type="submit" name="submit" class="btn btn-primary btn-lg" value="submit_od_print" >
			<i class="fa fa-plus"></i> Submit & Print
			</button>
			<a class="btn btn-primary btn-lg" href="{{ url('/ivf-'.$ivf_type.'-view').'/'. $casedata['id'] }}" ><i class="glyphicon glyphicon-chevron-left"></i> view </a>
		</div>
	</div>
</div>

			<br><br>
<!-- ===================================================================================== -->
			</form>
			</div>
                        
                    </div>
                </div>
            </div>


</div>
@endsection

@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script>
$(document).ready(function() {
	$('.select2').select2({width: '100%'});
});
   $(".agonist-addmore").click(function (e) {
	//alert('ghi');
	e.preventDefault();
	var template = $("#"+$(this).data('templatediv')).clone();
	
	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
	
	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	$(this).closest('div.ContainerToAppend').find('.datepicker').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD',
		clearButton: true,
		weekStart: 1,
		time: false
	});
	
});

$(document).on('click', '.removeItem' ,function(e){
  e.preventDefault();
  $(this).closest('div.col-md-12').remove();
  return false;
});






//===================================================
$(document).on('click', '.removeDbItem', function(e) {
	var ClickedButton = $(this);
	var containerDiv = $(this).closest('div.col-md-12');

	var delete_type = ClickedButton.data('type');
	var url='{{ url("ivf-remove-agonist") }}/'+ $(ClickedButton).data('deleteid');
	//alert(url);
	swal({
		title: "Are you sure?",
		text: "This Will Remove !",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
	}, function () {
			
		$.ajax({ url: url, 
			type: 'DELETE',
			data: {
				_method: 'delete', 
				_token :$("input[name='_token'][type='hidden']").val(),
				id : $(ClickedButton).data('deleteid'),
				type: delete_type
			}
		})
		.success(function() {
			$(containerDiv).remove();
			$(ClickedButton).button('reset');

			swal({title: "Deleted", text: "Successfully!!!", type: "success"},
				function(){ 
					location.reload();
				}
			);
		}).error(function(){
		$(ClickedButton).button('reset');
		});

		 location.reload();
	});
	e.preventDefault();

});
</script>
@endsection