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
                                        <label for="case_number" class="form-control">Doctor <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::select('doctor_id', array(''=>'Please select') + $doctorlist->toArray(), Request::old('appDetails.doctor_id', $appDetails->doctor_id), array('class' => 'form-control select2', 'required')) }}
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="case_number" class="form-control">Case Number :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('case_number', Request::old('case_number'), array('class' => 'form-control autocompleteTxt', 'placeholder'=>'Type Patient Name / mobile no / case number / UHID no','id'=>'case_number')) }}                           
                                        </div>
                                    </div>
                                </div>
                            </div>

							<!-- <div class="col-md-12">
							                                <div class="camera">
									<video id="video">Video stream not available.</video>
								</div>
								<div><span class="btn btn-info" id="startbutton">Take photo</span></div>
								<canvas id="canvas"></canvas>
							
								<img id="patient_pic_view" name="patient_pic_view" alt="The screen capture will appear in this box." src="">
							
							                            </div> -->


<div class="col-md-12">
	<div class="row">
		<div class="col-md-6" style="height: 265px;text-align: center;">
			<img id="patient_pic_view" name="patient_pic_view" alt="The screen capture will appear in this box." src="" onerror="this.onerror=null;this.src='{{url('/')}}/images/user.jpeg';">
			<div style="margin-top: 10px;">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#patientPictureModal">Capture Picture</button>
			</div>
			<input type="hidden" name="profile_picture" id="profile_picture">
			
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group labelgrp">
						<label class="form-control">UHID no :</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('uhid_no', Request::old('uhid_no'), array('class' => 'form-control')) }}                             
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group labelgrp">
						<label class="form-control"> Visit Time :</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('visit_time', $appDetails->appointment_timeslot, array('class' => 'form-control')) }}                            
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="form-group labelgrp">
						<label for="patient_name" class="form-control">Patient Name <b class="star">*</b>:</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('patient_name', $appDetails->name, array('class' => 'form-control', 'required')) }}                            
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group labelgrp">
						<label class="form-control"> Address <b class="star">*</b>:</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<div class="form-line">
							{{ Form::text('patient_address', Request::old('patient_address'), array('class' => 'form-control')) }}                            
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


                            <!-- <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">UHID no :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('uhid_no', Request::old('uhid_no'), array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Visit Time :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('visit_time', $appDetails->appointment_timeslot, array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                           <!--  <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="patient_name" class="form-control">Patient Name <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_name', $appDetails->name, array('class' => 'form-control', 'required')) }}                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Address <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_address', Request::old('patient_address'), array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div> -->

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="adhar_number" class="form-control">Adhar Number</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('adhar_number', $appDetails->adhar_number, array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="pan" class="form-control"> PAN :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('pan', Request::old('pan'), array('class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Email Id :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_emailId', $appDetails->email, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Gender <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="demo-radio-button" style="padding-top: 6px">
                                            <input type="radio" name="male_female" id="male_female" value="Male" required />
                                            <label for="male_female">Male</label>
                                            <input type="radio" name="male_female" id="male_female1" value="Female" required />
                                            <label for="male_female1">Female</label>
                                            <input type="hidden" name="appointment_Id" id="appointment_Id" value="{{ $appDetails->id }}"   />
                                        </div>
                                    </div>
                                </div>

								
								
                            </div>


                            <div class="col-md-12">
                                



								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="dob" class="form-control"> Date of Birth :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" id="dob" name="dob" placeholder="Select Date." data-date-format="yyyy-mm-dd">                           
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_age', Request::old('patient_age'), array('id'=>'patient_age','class' => 'form-control')) }}                            
                                        </div>
                                    </div>
                                </div>
                                
								
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control"> Mobile No <b class="star">*</b>:</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_mobile', Request::old('patient_mobile', $appDetails->mobile_no), array('class' => 'form-control', 'required')) }}                           
                                        </div>
                                    </div>
                                </div>

								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="alternate_number" class="form-control"> Alternate No :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('alternate_number', Request::old('alternate_number', $appDetails->alternate_number), array('class' => 'form-control')) }}                           
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="referedby" class="form-control">Refered by</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            {{ Form::text('referedby', Request::old('referedby'), array('class' => 'form-control')) }}  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Blood Pressure :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('blood_pressure', $appDetails->blood_pressure, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="infection" class="form-control">Allergy</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            {{ Form::text('infection', Request::old('infection'), array('class' => 'form-control')) }}  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Miscellaneous History :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('miscellaneous_history', $appDetails->miscellaneous_history, array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Patient Weight :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_weight', Request::old('patient_weight'), array('class' => 'form-control')) }}                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Patient Height :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_height', Request::old('patient_height'), array('class' => 'form-control')) }}                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
							{{--
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Doctor Fee :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" name="doctor_fee" id="doctor_fee" class="form-control"   value="">                                   
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="case_number">Payment Mode :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="payment_mode" id="payment" class="form-control" value="">                                     
                                        </div>
                                    </div>
                                </div>
                            </div>
							--}}
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
            if(ui.item.patient_pic != 'null') {
                $('#patient_pic_view').attr('src', "{{url('/').'/uploads/'}}"+ui.item.patient_pic);
            }
            
			
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

<script>
    /* JS comes here */
    (function() {

        var width = 320; // We will scale the photo width to this
        var height = 0; // This will be computed based on the input stream

        var streaming = false;

        var video = null;
        var canvas = null;
        var photo = null;
        var startbutton = null;

        function startup() {
            video = document.getElementById('video');
            canvas = document.getElementById('canvas');
            photo = document.getElementById('photo');
            startbutton = document.getElementById('startbutton');

            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: false
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.log("An error occurred: " + err);
                });

            video.addEventListener('canplay', function(ev) {
                if (!streaming) {
                    height = video.videoHeight / (video.videoWidth / width);

                    if (isNaN(height)) {
                        height = width / (4 / 3);
                    }

                    video.setAttribute('width', width);
                    video.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                    canvas.setAttribute('height', height);
                    streaming = true;
                }
            }, false);

            startbutton.addEventListener('click', function(ev) {
                takepicture();
                ev.preventDefault();
            }, false);

            clearphoto();
        }


        function clearphoto() {
            var context = canvas.getContext('2d');
            context.fillStyle = "#AAA";
            context.fillRect(0, 0, canvas.width, canvas.height);

            var data = canvas.toDataURL('image/png');
            //photo.setAttribute('src', data);
        }

        function takepicture() {
            var context = canvas.getContext('2d');
            if (width && height) {
                canvas.width = width;
                canvas.height = height;
                context.drawImage(video, 0, 0, width, height);

                var data = canvas.toDataURL('image/png');
                //photo.setAttribute('src', data);

				 var profile_picture = document.getElementById('profile_picture');

				profile_picture.value = data;
            } else {
                clearphoto();
            }
        }

        window.addEventListener('load', startup, false);
    })();
    </script>

	<!-- Webcam.min.js -->
<script type="text/javascript" src="{{asset('assets/js/webcam.min.js')}}"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
 Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
 });
 Webcam.attach( '#my_camera' );

<!-- Code to handle taking the snapshot and displaying it locally -->
function take_snapshot() {
 
 // take snapshot and get image data
 Webcam.snap( function(data_uri) {
  // display results in page
   $(".image-tag").val(data_uri);
  document.getElementById('results').innerHTML = 
  '<img src="'+data_uri+'"/>';
  $('#approve').show();
  } );
}

function approve_snapshot() {
	var img = $(".image-tag").val();
	if(img != "") {
		$('#profile_picture').val(img);
		$('#patient_pic_view').attr('src', img);
		
		document.getElementById('results').innerHTML = '';
		$('#approve').hide();
		$('#patientPictureModal').modal('hide');
	}
}
</script>
@endsection

