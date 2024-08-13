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

	.select2.select2-container.select2-container--default {
		width: 100% !important;
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
                <form action="{{ url('/patientDetails/EditKYC' ) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="header bg-pink">
                        <h2>Patient Info</h2>
						<span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;"></span>
                    </div>
                    <div class="body">
                        <div class="row clearfix ">
                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Doctor :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    {{ Form::hidden('doctor_id', $case_details->doctor_id) }}
                                    {{ Form::select('doctor_id_dd', array(''=>'Please select') + $doctorlist->toArray(), Request::old('case_details.doctor_id', $case_details->doctor_id), array('class' => 'form-control', 'required', 'readonly', 'disabled')) }}
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Case Number :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('case_number', Request::old('case_number', $case_details->case_number), array('class' => 'form-control', 'readonly')) }}
                                            {{ Form::hidden('case_id', $case_details->id) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

							<div class="col-md-12">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="patient_name" class="form-control">Patient Name <b class="star">*</b>:</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('patient_name',Request::old('patient_name', $case_details->patient_name), array('class' => 'form-control', 'required')) }}                            
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
											{{ Form::text('patient_address', Request::old('patient_address', $case_details->patient_address), array('class' => 'form-control')) }}                            
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="adhar_number" class="form-control">Adhar Number</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('adhar_number', $case_details->adhar_number, array('class' => 'form-control')) }}                            
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
                                            {{ Form::text('pan',  Request::old('pan', $case_details->pan), array('class' => 'form-control')) }}                            
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
                                            {{ Form::text('patient_emailId', Request::old('patient_emailId', $case_details->patient_emailId), array('class' => 'form-control')) }}                             
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
                                            <input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_details->male_female == "Male")? "checked=\"checked\"" : "" }}  />
                                            <label for="radio_8">Male</label>
                                            <input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple"value="Female" required   {{ ($case_details->male_female == "Female")? "checked=\"checked\"" : "" }} />
                                            <label for="radio_10">Female</label>
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
                                            <input value="{{$case_details->dob}}" type="date" class="datepicker form-control" id="dob" name="dob" placeholder="Select Date." data-date-format="yyyy-mm-dd">                           
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
                                            {{ Form::text('patient_age',  Request::old('patient_age', $case_details->patient_age), array('id'=>'patient_age','class' => 'form-control')) }}                            
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
                                            {{ Form::text('patient_mobile', Request::old('patient_mobile', $case_details->patient_mobile), array('class' => 'form-control', 'required')) }}                           
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
                                            {{ Form::text('alternate_number', Request::old('alternate_number', $case_details->alternate_number), array('class' => 'form-control')) }}                           
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
                                            {{ Form::text('referedby', Request::old('referedby', $case_details->referedby), array('class' => 'form-control')) }}  
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
                                            {{ Form::text('blood_pressure', Request::old('blood_pressure', $case_details->blood_pressure), array('class' => 'form-control')) }}                             
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
                                            {{ Form::text('infection', Request::old('infection', $case_details->infection), array('class' => 'form-control')) }}  
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
                                            {{ Form::text('miscellaneous_history', Request::old('miscellaneous_history', $case_details->miscellaneous_history), array('class' => 'form-control')) }}                             
                                        </div>
                                    </div>
                                </div>
                            </div>
<!-- ================================================================================= -->
<span class="dropdown-container">
						<div id="systemic_history" class="ContainerToAppend">
						<div class="col-md-12">
							<div class="col-md-2">
							<div class="form-group labelgrp">
							<label class="">Systemic History</label> 
							</div>
							<input type="hidden" id="systemicHistory[]" name="systemicHistory[]" class="hiddenCounter" value="1" />  
							</div>

							<div class="col-md-6">
							{{ Form::select('SystemicHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemic_history')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
		
							</div>

							

							<div class="col-md-4">
							<button type="button" name="add" id='chiefcomplaintbtn' class="btn btn-success set-dropdown-options" data-field_name="Chief Complaint OD" data-form_name="commanForm">Set Option </button>
							
							<button type='button' class="btn btn-primary" id='chiefcomplaintbtnsave'>Save Option</button>

							 <button id="addChiefComplaint" class="btn btn-default addmore" data-templateDiv="ChiefComplaintTemplate">Add</button>
							</div>
							</div>

						</div>
						<div id='ChiefTextBoxesGroup' class="col-md-12">

						</div>
</span>

<div class="dbMultiEntryContainer">
	@foreach ($patients_systemic_history as $item)
	<div class="col-md-12">
		<div class="col-md-2"> </div>
		<div class="col-md-8">
			<input type="text" class="form-control" readonly value="{{$item->value}}">
		</div>
		<div class="col-md-2">
			<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}" data-type="systemic_history">Remove</button>
		</div>

		<!-- <div class="col-md-12">
			<div class="col-md-2"> </div>
		
			<div class="col-md-8">
				<input type="text" class="form-control" readonly value="{{$item->duration}}">
			</div>
		
			<div class="col-md-2">
				
			</div>
		</div> -->
	</div>
	@endforeach
</div>
<!-- ================================================================================= -->

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Patient Weight :</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('patient_weight', Request::old('patient_weight', $case_details->patient_weight), array('class' => 'form-control')) }}                                    
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
                                            {{ Form::text('patient_height', Request::old('patient_height', $case_details->patient_height), array('class' => 'form-control')) }}                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" ><i class="fa fa-plus"></i> Submit
                                    </button>
                                    <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                                </div>
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

<div id="templateContainner" style="display:none">
    <div id="ChiefComplaintTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="systemicHistory[]" name="systemicHistory[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-6">
                    {{ Form::select('SystemicHistory_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemic_history')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2','data-live-search'=>'true')) }}
		
                </div>
               
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
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
	
	function getBalanceAmount(case_number) {
		$.ajax({
                url: "{{ url('/get-balance') }}",
                dataType: "json",
                data: {
                    case_number: case_number,
                },
                success: function(data) {
						if(data.balance > 0) {
							$('#balance_amount').html('Balance Amount : Rs.' + data.balance);
						} else {
							$('#balance_amount').html('');
						}
                    
                }
            });
	}
	
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
			getBalanceAmount(ui.item.value);
            jq("#case_number").val(ui.item.value);
            $('input[name="patient_name"]').val(ui.item.patient_name);
            if(ui.item.patient_pic) {
                $('#patient_pic_view').attr('src', "{{url('/').'/uploads/'}}"+ui.item.patient_pic);
            } else {
                $('#patient_pic_view').attr('src', "{{url('/').'/images/user.jpeg'}}");
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

<!-- Chief Complaint Set Option -->
<script type="text/javascript">
$(document).ready(function(){

    var counter = 1;

    $("#chiefcomplaintbtn").click(function () {
      
  if(counter>10){
            swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+counter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="fieldName1" value="systemic_history"><input class="form-control"  type="text" id="optionsval'+counter+'" placeholder="value'+counter+'" name="optionsval[]"></div><span class="input-group-addon chiefcomplainremoveButton" type="button" id="chiefcomplainremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

$("#ChiefTextBoxesGroup").append(newTextBoxDiv);
  counter++;
     });

$(document).on('click', '.chiefcomplainremoveButton', function(e) {
counter--;
   var target = $("#ChiefTextBoxesGroup").find("#TextBoxDiv" +counter);
  $(target).remove();
});
});

 function isEmpty( el ){
      return !$.trim(el.html())
  }
// Chief Complaint Add Option

      $("#chiefcomplaintbtnsave").click(function () {
        var content=$("#ChiefTextBoxesGroup").val();
        if (isEmpty($('#ChiefTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#patient_form").serialize();
        event.preventDefault();
        $.ajax({
            url:'{{ route("dynamic-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Systemic History", text: "Added Successfully!", type: "success"},
             function(){ 
              //location.reload();
              }
            );
            }
        })
    }

    });

	$('.addmore').click(function(e) {
		//alert('hi');
            e.preventDefault();
            var template = $("#"+$(this).data('templatediv')).clone();
            $(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
            // $("#surgeryDetails").find('#patient_name').val('');
           $(this).closest('div.ContainerToAppend').append($(template).html());
            $(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});
            // .each(function(index,ele){
            //     $(ele).select2({width: '80%'});
            // });
        });

		 $('.ContainerToAppend').on('click', '.removeItem' ,function(e){
          e.preventDefault();
          $(this).closest('div.col-md-12').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });
		
		$(".removeDbItem").click(function(e) {
			var ClickedButton = $(this);
			var containerDiv = $(this).closest('div.form-group.row');

			var delete_type = ClickedButton.data('type');
			var url='{{ url("eyeform/deleteMultiEntry") }}/'+ $(ClickedButton).data('deleteid');
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

