<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        {{ Form::model($casedata,array('url' => url('/adddischargeAppointment'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
                        {{ csrf_field() }}
                         {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                        {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
                        {{ Form::hidden('case_id', $case_master['id'] , array('class'=> 'form-control')) }}
                         <div class="header bg-pink">
                            <h2>
                               Add Appointment
                            </h2>
                        </div>
                        <div class="body">
                        <div class="row clearfix">
							<div class="col-md-12" style="padding-top: 20px;">
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<label for="appointment_doctor_id" class="form-control">Doctor :</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<select name="appointment_doctor_id" id="appointment_doctor_id" class="form-control select2" placeholder="select your doctor" data-live-search="true">
										<option value="">Select Doctor</option>
											<?php 
												foreach($doctorlist->toArray() as $key => $doclist){
												?>
											<option value="{{ $key }}">{{ $doclist }}</option>
											<?php } ?>
										</select>
									</div>
								</div>
							<!-- </div>
							<div class="col-md-12"> -->
								<div class="col-md-3">
									<div class="form-group labelgrp">
										<label class="form-control">Appointment Date :</label>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('appointment_dt', Request::old('appointment_dt'), array('class'=> 'form-control datepicker','id'=>'appointment_dt')) }}
										</div>
									</div>
								</div>
							</div>
							

							<div class="col-md-12" id="appointment_append_div">
								<div class="row">
									<div class="col-md-3">Doctor</div>
									<div class="col-md-3">Date</div>
									<div class="col-md-3">Time</div>
									<div class="col-md-3">Action</div>
								</div>
                          
								<?php foreach ($appointment as $key => $value) { ?>
                                    <div class="row">
                                    <div class="col-md-3">
                                    <input type="text" name="[]" readonly value="{{$value->doctor_name}}">
                                    </div>
                                    <div class="col-md-3">
                                            <input type="" name="appointment_date[]" readonly value="{{$value->date}}">
                                    </div>
                                    <div class="col-md-3">
                                            <input type="" name="appointment_time[]" readonly value="{{$value->time}}">
                                    </div>
                                    <div class="col-md-3">
                                        <span class="remove-appointment btn btn-danger removeDbItemAppointment" data-id="{{$value->id}}">Remove Appointment</span>
                                    </div>
                                </div>
                               <?php } ?>
								<!-- <div class="col-md-2">
									<input type="text" name="appointment_id[]" readonly value="">
									<input type="text" name="appointment_doctor[]" readonly value="">
								</div>
								<div class="col-md-2">
										<input type="text" name="appointment_date[]" readonly value="">
								</div>
								<div class="col-md-2">
										<input type="text" name="appointment_time[]" readonly value="">
								</div>
								<div class="col-md-2">
									<span class=="remove-appointment">Remove Appointment</span>
								</div> -->
							</div>

							<div class="panel-footer">
                                    <button type="submit" class="btn btn-default" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                                    <a href="{{ url('/') }}" class="btn btn-default" > Home </a>
                                </div>
						</div>
                        </div>
                        </div>


<div class="col-md-12 col-sm-12 col-xs-12" id="slotdiv">
                            <div class="card">
                                <div class="header bg-pink">
                                    <h2>Time Slots for Appoinment for <span class="btn btn-info" id="selected_date"></span><span class="btn btn-info"  id="save_selection">Save Selection</span></h2>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-12" id="slotsrec">
                                            <div class="col-md-12" style="display: none;" id="slodrec">
                                                <div class="form-group">
                                                    <div class="col-md-12" >
                                                        <div class="" id="noslot"></div>
                                                        <div class="col-md-6">
                                                            <div id="Morning" class="align-items-center" style="display: none;">
                                                                <b>Morning Slot</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="MorningSlots">
                                                        <div id="appdate"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div id="Afternoon" style="display: none;">
                                                                <b>Afternoon Slot</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="AfternoonSlots">
                                                        <div id="appdate2"></div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div id="Evening" style="display: none;">
                                                                <b>Evening Slot</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="EveningSlots">
                                                        <div id="appdate1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            
                        </div>
                        {{ Form::close() }}
                    </div>
               
<script>
            $(document).ready(function(){
                $("#slotdiv").css("display","none");
                $(".select2").select2();
            $("#appointment_dt").on('change.dp', function (e) {
                $("#appdate").empty();
                $("#appdate2").empty();
                $("#appdate1").empty();
                $("#noslot").empty();
                $("#Morning").css("display","none");
                 $("#slodrec").css("display","block");
                $("#Afternoon").css("display","none");
                $("#Evening").css("display","none");
                //alert(this.value);         //Date in full format alert(new Date(this.value));
                var inputDate = new Date(this.value);
                var appointment_doctor_id = $("#appointment_doctor_id option:selected").val();
                var appointment_dt = $("#appointment_dt").val();
				$('#selected_date').html(appointment_dt);
                 //alert(appointment_dt);
                $('#startdate').data('date')
                //alert(appointment_dt);
                var url1 = "{{url('/')}}/avaibaletimeslots/"+appointment_doctor_id+'/'+appointment_dt;
               //alert(url1);
                var data=$("#createAppointment").serialize();
                $.ajax({
                    url:url1,
                    type:'GET',
                    data:data,
                    success:function(response) {
                      //alert(response);
                         if(response==0)
                         {
                            $("#slotsrec").addClass("noscroll");
                            $("#slotdiv").css("display","block");
                            $("#noslot").html("<h3>No Slots Available</h3>");
                            // $('<div class="col-md-6"></div>').appendTo($("#appdate"));
                         }
                         else
                         {
                          for(var i=0;i<response['slottime'].length;i++){
                            var slotime= response['slottime'][i];
                             var starttime= response['timeslot1'][i];
                            if(slotime=="Morning")
                            {
                                $("#Morning").css("display","block");
                                $("#slotdiv").css("display","block");
                                $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate"));  
                            }
                             else if(slotime=="Afternoon")
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         {
                             $("#Afternoon").css("display","block");
                             $("#slotdiv").css("display","block");
                             $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate2")); 
                         }
                         else if(slotime=="Evening")
                         {
                             $("#Evening").css("display","block");
                             $("#slotdiv").css("display","block");
                              $("#slotsrec").addClass("scroll");
            $('<div class="col-md-4"><div style=""><input type="radio" name="morningEvening" id="'+i+'" value="'+starttime+'" class="with-gap radio-col-teal"><label for="'+i+'">'+starttime+'</label></div></div>').appendTo($("#appdate1")); 
                         }
                    }
                         }
                     },
                }); 
            });
            });
        </script>
        <script> 
            function dayClickEvent(date, jsEvent, view) {
                    alert('Clicked on: ' + date.format());
                    const today = moment().format('YYYY-MM-DD');
                    const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
                    if (date.format('YYYY-MM-DD') > endOfMonth){       
                            return false;
                    }
                    if (date.format('YYYY-MM-DD') < today){
                            return false;
                    }
                    //$("#createAppointment").reset();
                    $("#createAppointment").trigger("reset");
                    $("#appointment_dt").val(date.format('DD/MMM/YYYY'));
                    $("#dateSelected").text(date.format('DD/MMM/YYYY'));
                    $(".print-error-msg").removeClass('alert-danger').removeClass('alert-success').css('display','none');
                    $("#myModal").modal();
                //alert(redirectUrl);
                //window.location.href = redirectUrl;
                //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                //alert('Current view: ' + view.name);
                // change the day's background color just for fun
                //$(this).css('background-color', 'red');
            }
            function dayRenderEvent(date, cell){
                const startOfMonth = moment().startOf('month').format('YYYY-MM-DD hh:mm');
                const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD hh:mm');
                console.log((date.format('YYYY-MM-DD hh:mm') > endOfMonth));
                console.log(date.format('YYYY-MM-DD hh:mm'));
                console.log(endOfMonth);
                if (date.format('YYYY-MM-DD hh:mm') > endOfMonth){
                        $(cell).addClass('disabled');
                        console.log('disabled');
                }
                if (date.format('YYYY-MM-DD hh:mm') < startOfMonth){
                        $(cell).addClass('disabled');
                }
            }
            $(document).ready(function(){
                $("#createAppointment").submit(function(e){
                    e.preventDefault();
                    var data = $("#createAppointment").serialize();
                    //alert(data); 
                    //$("#submitBtn").attr('disabled', 'disabled').addClass('disabled');
                    $("#submitBtn").button('loading');
                    var csrf_token = $("#hdnCsrfToken").data('token');
                    $.ajax({
                            url: 'appointment',
                            dataType: 'text',
                            type: 'post',
                            contentType: 'application/x-www-form-urlencoded',
                            data: $(this).serialize()+"&_token=" + csrf_token,
                            success: function(data, textStatus, jQxhr){
                               // alert(data);
                                data = JSON.parse(data);
                                if($.isEmptyObject(data.error)){
                                    $("#createAppointment").trigger("reset");
                                    $(".print-error-msg").removeClass('alert-danger').addClass('alert-success').css('display','block').find("ul").html('');
                                    $(".print-error-msg").find("ul").append('<li>'+data.success+'</li>');
                                    // $("#"+calendarId).fullCalendar('renderEvent', {"id":null,"title":"Token Number : "+ data.tokenNumber,"allDay":true,"start":$("#appointment_dt").val(),"end":$("#appointment_dt").val(),"color":"green","editable":false});
                                }else{
                                    printErrorMsg(data.error);
                                }
                                //$("#submitBtn").removeAttr('disabled').removeClass('disabled');                    
                                $("#submitBtn").button('reset');
                            },
                            error: function( jqXhr, textStatus, errorThrown ){
                                console.log( errorThrown );
                                //$("#submitBtn").removeAttr('disabled').removeClass('disabled');
                                $("#submitBtn").button('reset');
                            }
                        });
                    return false;
                });
            });
                function printErrorMsg (msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").addClass('alert-danger').css('display','block');        
                    $.each( msg, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }

			$(document).on('click', '.radio-col-teal', function() {
				//alert($(this).val());
			});

			$(document).on('click', '#save_selection', function() {
				//alert($('.radio-col-teal:checked').val());
				var selected_doctor = $('#appointment_doctor_id option:selected').text();

				
				var selected_date = $('#appointment_dt').val();
				var selected_time = $('.radio-col-teal:checked').val();
				$('.radio-col-teal:checked').prop('checked', false);

				var html = '<div class="row"><div class="col-md-3"> <input type="hidden" name="appointment_id[]" readonly value="">'; 
				html += '<input class="form-control" type="text" name="appointment_doctor[]" readonly value="'+selected_doctor+'"></div>';
							
				html += '<div class="col-md-3"><input class="form-control" type="text" name="appointment_date[]" readonly value="'+selected_date+'"></div>';
				html += '<div class="col-md-3"> <input class="form-control" type="text" name="appointment_time[]" readonly value="'+selected_time+'"> </div>';
				html += '<div class="col-md-3"><span class="btn btn-danger remove-appointment">Remove Appointment</span></div></div>';

				$('#appointment_append_div').append(html);
			});

      $(".removeDbItemAppointment").click(function(e) {
          //var ClickedButton = $(this);
          var id = $(this).attr('data-id');
          //alert(" class name is"+id)

          swal({
            title: "Are you sure?",
            text: "This Will Remove !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          }, function () {
              
            $.ajax({ url: '{{ url("deleteAppointment") }}',
              method:'POST',
              data: {
                _token :$("input[name='_token'][type='hidden']").val(),
                id : id,
              }
            })
            .success(function() {
             // $(containerDiv).remove();
             // $(ClickedButton).button('reset');
             
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

