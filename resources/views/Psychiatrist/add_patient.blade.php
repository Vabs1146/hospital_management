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
     #button {
  display: inline-block;
  background-color: #FF9800;
  text-decoration: none;
  width: 36px;
  height: 37px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 52px;
  right: 33px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  color: white;
  visibility: hidden;
  z-index: 1000;
}
#button::after {
 
  font-family: 'Material Icons';
  font-weight: bolder;
  font-style: normal;
  font-size: 1em;
  line-height: 40px;
  color: white;
}
#button:hover {
  cursor: pointer;
  background-color: #333;
}
#button:active {
  background-color: #555;
}
#button.show {
  opacity: 1;
  visibility: visible;
}


</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">


<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">

<style>
 .col-md-12 {
    margin-bottom: 0px !important;
}

.labelgrp {
    text-align: left !important;
}

.form-control {
	border:none;
	border-bottom:1px solid;
	box-shadow:none;
}


table{
	width:100%;
}

table {
	border: solid white !important;
	border-width: 1px 0 0 1px !important;
	border-bottom-style: none;
}

th, td {
	border: solid white !important;
	border-width: 0 1px 1px 0 !important;
	border-bottom-style: none;
} 
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="list-group list-group-horizontal">
        @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
            @if($casedata['id'] == $VisitListDateWise['id'])
                <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
            @else
                <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
					<!--
                       <form action="{{ url('save-psychiatrist-case-form') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
 
                        {{ csrf_field() }}
                        {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                        {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
						-->
                         <div class="header bg-pink">
                            <h2>
                              Patient Name : {{ $casedata->patient_name }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . $casedata['visit_time']}}
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                 <a id="button" ><i class="material-icons" style="font-size: 33px !important;">keyboard_arrow_up</i></a>
				<div class="top-nav s-12 l-10">
				
				</div>
              
              <hr/>
               <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                  <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
<!-- start of panel complaint -->
<div class="panel panel-primary">
@include('Psychiatrist.form_steps.case_form_responsive')
</div>
<!-- end of panel complaint -->
<!-- start of panel Vision -->
<div class="panel panel-primary">
@include('Psychiatrist.form_steps.notes')
</div>
<!-- End Of Vision Panel -->
<!-- Start of Refraction panel -->
<div class="panel panel-primary">
@include('Psychiatrist.form_steps.prescriptions')
</div>

<div class="panel panel-primary">
@include('Psychiatrist.form_steps.follow_up_section')
</div>

<div class="panel panel-primary">
@include('Psychiatrist.form_steps.report_files_section')
</div>

<!-- End of Refraction -->
<!-- Start of Finding -->

                            </div>
                        </div>
        <!--                <div class="col-md-12"></div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-primary waves-effect"><i class="fa fa-plus"></i> Submit
                                </button>
									
									<a class="btn btn-primary waves-effect btn-lg" href="{{url('/ViewEyeDetails').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> View </a>
									
								<a class="btn btn-primary waves-effect btn-lg" href="{{url('/print-psyciatrist-case-form').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> Print </a>
									
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('/case_masters') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
                            </div>
-->
                            
                        </div>
                      <!-- </form> -->
                    </div>
                </div>
            </div>


</div>

<div id="add-more-family-history-html" style="display:none;">
	<div class="row" >
		<div class="col-md-2">
			{{ Form::text('question_7_rlation[]', null, array('class'=> 'form-control', 'placeholder'=> 'relation', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('question_7_name[]', null, array('class'=> 'form-control', 'placeholder'=> 'name', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('question_7_doctor[]', null, array('class'=> 'form-control', 'placeholder'=> 'doctor name', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-2">
			<a class="btn btn-info" href="javascript:void(0)" id="remove-family-history">Remove</a>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
$('#add-more-family-history').click(function() {
	$('#family_history_div').append($('#add-more-family-history-html').html());
});
$(document).on('click', '#remove-family-history', function() {
	$(this).closest('.row').remove();
});
$(document).on('click', '.delete-edit-family-history', function() {
	$(this).closest('.row').remove();
});
$(document).on('click', '.delete-psychiatrist-case-form-files', function() {
	$(this).parent().remove();
});
</script>

 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
    $('.select2').select2();
    </script>


<!-- Medicine Set Option -->
<script type="text/javascript">

$(document).ready(function() {

	var medcounter = 1;

	//$("#medicinetbtn").click(function () {

$(document).on('click', '#medicinetbtn', function(e) {
		if(medcounter>10){
			swal("Only 10 Options Values are allow!");
			return false;
		}

		var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+medcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="balance_quantity" value="1"><input class="form-control"  type="hidden"  name="isactive" value="1"><input class="form-control"  type="text" id="optionsval'+medcounter+'" placeholder="value'+medcounter+'" name="optionsval[]"></div><span class="input-group-addon medicineremoveButton" type="button" id="medicineremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

		$("#MedicineTextBoxesGroup").append(newTextBoxDiv);
		medcounter++;
	});

	$(document).on('click', '.medicineremoveButton', function(e) {
		medcounter--;
		var target = $("#MedicineTextBoxesGroup").find("#TextBoxDiv" +medcounter);
		$(target).remove();
	});


});
</script>

<!-- Generic Set Option -->

<script type="text/javascript">

$(document).ready(function(){

	var genericcounter = 1;

	//$("#generictbtn").click(function () {

$(document).on('click', '#generictbtn', function(e) {
	if(genericcounter>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+genericcounter+'"><input type="hidden" name="is_generic" value="1"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+genericcounter+'" placeholder="value'+genericcounter+'" name="optionsval[]"></div><span class="input-group-addon genericremoveButton" type="button" id="genericremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';
	
	$("#GenericTextBoxesGroup").append(newTextBoxDiv);
		genericcounter++;
	});
	
	$(document).on('click', '.genericremoveButton', function(e) {
		genericcounter--;
		var target = $("#GenericTextBoxesGroup").find("#TextBoxDiv" +genericcounter);
		$(target).remove();
	});
});
</script>

<!-- Eye Set Option -->

<script type="text/javascript">

$(document).ready(function(){

	var eyecounter = 1;

	//$("#eyetbtn").click(function () {

$(document).on('click', '#eyetbtn', function(e) {
	if(eyecounter>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+eyecounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+eyecounter+'" placeholder="value'+eyecounter+'" name="optionsval[]"></div><span class="input-group-addon eyeremoveButton" type="button" id="eyeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';
	
	$("#EyeTextBoxesGroup").append(newTextBoxDiv);
		eyecounter++;
	});
	
	$(document).on('click', '.eyeremoveButton', function(e) {
		eyecounter--;
		var target = $("#EyeTextBoxesGroup").find("#TextBoxDiv" +eyecounter);
		$(target).remove();
	});
});
</script>

<!-- Day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var daycounter = 1;

    //$("#daytbtn").click(function () {
 
$(document).on('click', '#daytbtn', function(e) {     
  if(daycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+daycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Quantity"><input class="form-control"  type="text" id="optionsval'+daycounter+'" placeholder="value'+daycounter+'" name="optionsval[]"></div><span class="input-group-addon dayremoveButton" type="button" id="dayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#DayTextBoxesGroup").append(newTextBoxDiv);
  daycounter++;
     });


$(document).on('click', '.dayremoveButton', function(e) {
daycounter--;
   var target = $("#DayTextBoxesGroup").find("#TextBoxDiv" +daycounter);
  $(target).remove();
});


  });
</script>


<!-- Times a day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var timesadaycounter = 1;

   // $("#timesadaytbtn").click(function () {
 
$(document).on('click', '#timesadaytbtn', function(e) {          
  if(timesadaycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+timesadaycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Times a day"><input class="form-control"  type="text" id="optionsval'+timesadaycounter+'" placeholder="value'+timesadaycounter+'" name="optionsval[]"></div><span class="input-group-addon timesadayremoveButton" type="button" id="timesadayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#TimesadayTextBoxesGroup").append(newTextBoxDiv);
  timesadaycounter++;
     });


$(document).on('click', '.timesadayremoveButton', function(e) {
timesadaycounter--;
   var target = $("#TimesadayTextBoxesGroup").find("#TextBoxDiv" +timesadaycounter);
  $(target).remove();
});


  });
</script>


<script type="text/javascript">
    function isEmpty( el ){
      return !$.trim(el.html())
  }

// Medicine Add Option

      //$("#medicinebtnsave").click(function () {

$(document).on('click', '#medicinebtnsave', function(e) {      
        var content=$("#MedicineTextBoxesGroup").val();
        if (isEmpty($('#MedicineTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("medicine-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Medicine", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
	

// Generic Add Option

  //    $("#genericbtnsave").click(function () {


$(document).on('click', '#genericbtnsave', function(e) {      
        var content=$("#GenericTextBoxesGroup").val();
        if (isEmpty($('#GenericTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 //var data=$("#eyeform").serialize();
 var data=$("#GenericTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("medicine-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Generic Medicine", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Eye Add Option

  //    $("#eyebtnsave").click(function () {


$(document).on('click', '#eyebtnsave', function(e) {   
        var content=$("#EyeTextBoxesGroup").val();
        if (isEmpty($('#EyeTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Eye", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Day Add Option

      //$("#daybtnsave").click(function () {


$(document).on('click', '#daybtnsave', function(e) {   
        var content=$("#DayTextBoxesGroup").val();
        if (isEmpty($('#DayTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Day", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });




// Times a day Add Option

      //$("#timesadaybtnsave").click(function () {


$(document).on('click', '#timesadaybtnsave', function(e) {   
        var content=$("#TimesadayTextBoxesGroup").val();
        if (isEmpty($('#TimesadayTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Times a Day", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

</script>


<!-- ==================================== Update dropdown options ================================================ -->
<script>
		$(document).on('click','.set-dropdown-options',function() {
			var table_name = $(this).data('table_name');
			var form_name = $(this).data('form_name');
			var field_name = $(this).data('field_name');
			
			var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

			var url = "{{route('get-update-dropdown-options')}}";
			if(table_name == "medical_store") {
				url = "{{route('get-prescription-dropdown-options')}}";
			}

			$.ajax({
				url: url,
				method:'post',
				data:{'table_name': table_name, 'form_name': form_name,'form_field': field_name},
				datatype: 'json',
				success:function(response) {
					console.log(response);
					
					element_to_show.html(response.view);
				}
			});

			console.log(form_name + ' : '+  field_name);
			//$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').show();

			element_to_show.show();
		});

		$(document).on('click','.update-dropdown-options-btn',function() {
			//alert('clicked');

			var clicked_element = $(this);

			var form_target = $(this).closest('.update-dropdown-options-form');

			var id = form_target.attr('id');
			var table_name = $(this).data('table_name');

			var form_data = $('#'+ id +' :input').serialize();

			var url = "{{route('update-dropdown-options')}}";
			if(table_name == "medical_store") {
				url = "{{route('update-prescription-dropdown-options')}}";
			}

			//alert(table_name);

			$.ajax({
				url: url,
				method:'post',
				data:{'form_data': form_data},
				datatype: 'json',
				success:function(response) {
					console.log(response);

					location.reload();
					
					clicked_element.closest('.dropdown-container').find('.dropdown-options-initial-div').hide('');
				}
			});
		});

		$(document).on('click','.remove-initial-options',function() {
			$(this).closest('.initial_options').remove();
		});

$(document).on('click','.cancel-dropdown-options-btn',function() {
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').hide();
$(this).closest('.dropdown-container').find('.dropdown-options-initial-div').html('');
});
</script>

<script>
	//$('input[name=prescription_type]').click(function() {


$(document).on('click', '.prescription_type', function(e) {  


		var prescription_type = $(this).val();
//alert(prescription_type); 		
		if(prescription_type == 'new') {
			$('#new_prescription').show();
			$('#prescription_template').hide();
		}

		if(prescription_type == 'template') {
			$('#new_prescription').hide();
			$('#prescription_template').show();
		}
		//alert(prescription_type);
	});

	$(document).on('change', '#select_template', function() {
		var selected_template = $(this).val();
		//alert(selected_template);

		$.ajax({
			url : '{{url("get-psychiatrist-prescription-template")}}',
			type:'post',
			data : {'id' : $(this).val()},
			datatype: 'html',
			success : function(response) {
				$('#prescription_template').html(response);
				$('.template_select2').select2();
				$('.template-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });
			}
		});
	});
</script>




<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
   <script type="text/javascript">
    
     $(".select2").select2();
   </script>


    <script type="text/javascript">
    
    $(document).ready(function(){

	//=========================================================================================
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
                var doctor_id = $("#doctor_id option:selected").val();
                var appointment_dt = $("#appointment_dt").val();
                 //alert(appointment_dt);
                $('#startdate').data('date')
                //alert(appointment_dt);
                
                
                 var inputDate = new Date(this.value);
        var FollowUpDoctor_id = $("#FollowUpDoctor_id").val();
       

        var appointment_dt = $('#appointment_dt').val();
       
        
        //var url1="{{url('avaibaletimeslotscasemaster')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
        
                var url1 = "{{url('avaibaletimeslots')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
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
                             else if(slotime=="Afternoon")                                                                                                               {
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
     $(document).on('click', '#slotsrec input[type="radio"]', function() {
     //alert($(this).val());
     $("#FollowUpTimeSlot").empty();
      $("#FollowUpTimeSlot").val($(this).val());
    });
	//==============================================================================================
    });
</script>
@endsection
