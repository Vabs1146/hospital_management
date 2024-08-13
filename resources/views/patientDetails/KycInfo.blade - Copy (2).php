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
    .star{
    color: red;
    }
</style>
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
                <form action="{{ url('/patientDetails/SaveKYC' ) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="header bg-pink">
                        <h2>Patient Info</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix ">

		
							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="wife_name" class="form-control">Wife Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('wife_name', $appDetails->wife_name, array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="wife_age" class="form-control"> Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('wife_age', Request::old('wife_age'), array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="husband_name" class="form-control">Husband Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('husband_name', $appDetails->husband_name, array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="husband_age" class="form-control"> Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('husband_age', Request::old('husband_age'), array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Married Since :</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('married_since', $appDetails->married_since, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Menstrual History :</label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('menstrual_history', $appDetails->menstrual_history, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>






<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">LMP :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('lmp', $appDetails->lmp, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Obstetric History :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('obstetric_history', $appDetails->obstetric_history, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	





<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">H/O Other Medical Surgical Illness :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('other_medical_surgical_illness', $appDetails->other_medical_surgical_illness, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">H/O Othe Art Procedure In Past :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('other_art_procedure_past', $appDetails->other_art_procedure_past, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">HSG :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('hsg', $appDetails->hsg, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Laproscopy :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('laproscopy', $appDetails->laproscopy, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Hsf :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('hsf', $appDetails->hsf, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Hormones :</label>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">LH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('lh', $appDetails->lh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">FSH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('fsh', $appDetails->fsh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">TSH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('tsh', $appDetails->tsh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">Prolactin :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('prolactin', $appDetails->prolactin, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
		
		<div class="col-md-1">
			<div class="form-group labelgrp">
				<label class="form-control">AMH :</label>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('amh', $appDetails->amh, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Folliculometry :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('folliculometry', $appDetails->folliculometry, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label class="form-control">Adviced :</label>
			</div>
		</div>
		<div class="col-md-10">
			<div class="form-group">
				<div class="form-line">
					{{ Form::text('adviced', $appDetails->adviced, array('class' => 'form-control')) }}                             
				</div>
			</div>
		</div>
	</div>

                            
			
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-2" >
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Submit
                                </button>&nbsp;
                                <button type="submit" name="submitMsg" class="btn btn-success btn-lg" value="submitMsg" ><i class="fa fa-plus"></i> Submit & Msg.
                                </button>&nbsp;
                                <button type="submit" formtarget="_blank" formaction="{{ url('/patientDetails/SaveKYCWhatsapp') }}" name="submit" class="btn" value="submit" ><i class="fab fa-whatsapp-square fa-2x" style="color:green;"></i> </button>&nbsp;
                                <button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination2') }}" name="submit" class="btn btn-success btn-lg" value="submit" >Submit & Email</button>&nbsp;
                            </div>
                            <div class="col-md-8 col-md-offset-2" >
                                <a class="btn btn-default btn-lg" href="{{ url('/appointmentlist/0') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Appointment</a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Patient List</a> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="patientPictureModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Capture Patient Image</h4>
      </div>
      <div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<div id="my_camera"></div>
				</div>
				<div class="col-md-6">
					<div id="results" ></div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<input type="button" value="Take Snapshot" onClick="take_snapshot()">
				</div>
				<div class="col-md-6">
					<input type="button" id="approve" value="Approve" onClick="approve_snapshot()" style="display:none;">
				</div>
			</div>

			<input type="hidden" name="image-tag" id="image-tag" class="image-tag">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
         $('.select2').select2();
    
    });
</script>
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} "></script>
<script>    
    jq = $.noConflict(true);
    //alert(jq);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>
<script>
    var url = "{{ url('/GetCaseIdByPatientNameMobile') }}";
    jq(".autocompleteTxt").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ url('/GetCaseIdByPatientNameMobile') }}",
                dataType: "json",
                data: {
                    query: request.term,
                    PropertyName: jq(this.element).attr('name'),//'Complaints' 
                    tableName: 'eyeform'
                },
                success: function(data) {
                    response(data);
                    
                }
            });
        },
        select: function(event, ui) {
            jq("#case_number").val(ui.item.value);
            $('input[name="patient_name"]').val(ui.item.patient_name);
            $('#patient_pic_view').attr('src', "{{url('/').'/uploads/'}}"+ui.item.patient_pic);
			
            $('input[name="alternate_number"]').val(ui.item.alternate_number);
            $('input[name="adhar_number"]').val(ui.item.adhar_number);
            $('input[name="pan"]').val(ui.item.pan);
            $('input[name="dob"]').val(ui.item.dob);

            $('input[name="patient_mobile"]').val(ui.item.patient_mobile);
            $('input[name="patient_address"]').val(ui.item.patient_address);
            $('input[name="patient_emailId"]').val(ui.item.patient_emailId);
            $('input[name="patient_age"]').val(ui.item.patient_age);
            $('input[name="uhid_no"]').val(ui.item.uhid_no);
            $('input[name="patient_weight"]').val(ui.item.patient_weight);
            $('input[name="patient_height"]').val(ui.item.patient_height);
            $('input[name="blood_pressure"]').val(ui.item.blood_pressure);
            $('input[name="infection"]').val(ui.item.infection);
            $('input[name="miscellaneous_history"]').val(ui.item.miscellaneous_history);
            $('input[name="male_female"][value='+ ui.item.male_female +']').attr('checked', 'checked');
            $('input[name="doctor_fee"]').val(ui.item.billAmount);
            $('input[name="referedby"]').val(ui.item.referedby);
            $('input[name="payment_mode"]').val(ui.item.payment_mode);
            $("#doctor_id").append('<option value="'+ui.item.doctor_id+'" selected="">'+ui.item.doctor_name+'</option>');
            $("#doctor_id").selectpicker("refresh");
             
            return false; // Prevent the widget from inserting the value.
        }
    });

	$('#dob').on('change', function() {
		//alert($(this).val());

		dob = new Date($(this).val());
		var today = new Date();
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

		//alert(age);
		$('#patient_age').val(age);
	});
</script>

@endsection

