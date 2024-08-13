 .@extends('adminlayouts.master')
<style type="text/css">
  .medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
  color: #700;
  cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
  color: #f00;
}

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="list-group list-group-horizontal">
        @forelse ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/AddEdit/prescription').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/AddEdit/prescription').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
          {{ Form::model($casedata, array('url' => url('/AddEdit/entprescription/'.$casedata['id']), 'method' => 'POST','id'=>'entform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Add/Modify Ent Prescription </h2>
		  <span style="float:right;"><a class="btn btn-success" href="{{url('ent-prescription-templates-listing/'.$casedata['id'])}}">Prescription Templates</a></span>
          </div>
              <div class="form-group">
                {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
                {{ Form::hidden('doctor_id', Request::old('doctor_id'), array('class'=> 'form-control')) }}
                {{ Form::hidden('patient_emailId', Request::old('patient_emailId'), array('class'=> 'form-control')) }}
            </div>
              <div class="body">

			  
                  <div class="row clearfix">
                            <div class="col-md-12 ">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Patient Name :</label>
                              </div>
                              </div>

                               <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_name', Request::old('patient_name'), array('class'=> 'form-control','readonly'=>'readonly')) }}                            
                              </div>
                              </div>
                              </div> 
                              </div>   

                             <div class="col-md-12">
                             <div class="form-group">
                             <h3 class="text-center"><u>Prescription.</u></h3>
                             </div>
                             </div>

                              <!-- <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Medicine :</label>
                              </div>
                              </div>
                              
                              
                              <div class="col-md-6">
                              {{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>
                              
                              <div class="col-md-4">
                              <button type="button" name="add" id='medicinetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='MedicineTextBoxesGroup' class="col-md-12">
                              
                              </div> -->

                              <!-- <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Times a Day :</label>
                              </div>
                              </div>
                              
                              <div class="col-md-6">
                              {{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div> 
                              <div class="col-md-4">
                              <button type="button" name="add" id='timesadaytbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='timesadaybtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='TimesadayTextBoxesGroup' class="col-md-12">
                                
                              </div> -->

                              <!-- <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Day :</label>
                              </div>
                              </div>
                              
                              
                              <div class="col-md-6">
                              {{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>
                              <div class="col-md-4">
                              <button type="button" name="add" id='daytbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='daybtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='DayTextBoxesGroup' class="col-md-12">
                                
                              </div> -->


                              <!-- <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Quantity :</label>
                              </div>
                              </div>
                              <div class="col-md-6">
                                                           {{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2')) }}
                              
                              </div>
                              <div class="col-md-4">
                              <button type="button" name="add" id='enttbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='entbtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='EntTextBoxesGroup' class="col-md-12">
                                
                              </div> -->


							  <!-- ================================================================================ -->
<div class="col-md-12">
					<div class="col-md-4">
						<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"> New Prescription
						<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template"> Template
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="{{url('add-ent-prescription-dropdowns').'/'.$casedata['id']}}" >Add Dropdown</a>  
							<!-- <a class="btn btn-primary btn-lg" href="" >Create Prescription Template and Edit</a>   -->
							<a class="btn btn-primary btn-lg" href="{{url('add-ent-prescription-templates').'/'.$casedata['id']}}">Create Prescription Template</a>
							<a class="btn btn-primary btn-lg" href="" >Languages</a>  
						</div>
					</div>
				</div>

				<span id="prescription_template" style="display:none;">
						
						<div class="col-md-12">
							<div class="col-md-2">
									<div class="form-group labelgrp">
										<label class="form-control">Select Template</label>
									</div>
								</div>
							<div class="col-md-10">
								<select id="select_template" class="form-control">
									<option value="">Select Template</option>
									@foreach($templates as $prescription_template)
									<option value="{{$prescription_template->id}}">{{$prescription_template->template_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</span>

				<span id="new_prescription">
					<div class="col-md-12">
						<div class="col-md-3">
							<div>
								<label>Medicine :</label>
							</div>
							 {{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>
						<div class="col-md-3">
							<div>
								<label> Times a Day :</label>
							</div>
							{{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

						<div class="col-md-3"> <!-- Timing -->
							<div>
								<label>Day :</label>
							</div>
							{{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

						<div class="col-md-3"> <!-- Timing -->
							<div>
								<label>Quantity :</label>
							</div>
							{{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2')) }}
						</div>

						
					</div>
				</span>
			  <!-- =================================================================================== -->

                             <div class="col-md-12">
                                    <div class="col-md-2">
                                        <div class="form-group labelgrp">
                                        <label>Email To :</label>
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
                                        <button type="submit"  name="sendemailpres" class="btn btn-success " value="sendemailpres" >Email To Other</button> </div>
                                      </div>

                              

                              

                             <div class="col-md-12 clearfix">
								<div class="col-md-12">
								<div class="form-group">
								{{ Form::submit('Add Prescription', array('class' => 'btn btn-primary btn-lg', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}  
								{{ Form::button('Send Message', array('class' => 'btn btn-primary btn-lg', 'Value' => $casedata['id'], 'name' => 'prescription_msg', 'type'=>'submit')) }}      
										<button type="submit"  name="submiitemailpres" class="btn btn-primary btn-lg " value="submiitemailpres" >Submit & Mail</button>  
								</div>
								<br>
								
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
		<label>Notes</label>
		</div>
	</div>

	<div class="col-md-9">
		{{ Form::textarea('notes', ($prscription_notes) ? $prscription_notes : null, array('class'=> 'form-control')) }}
	</div>
	
	
</div>

<div class="row clearfix">
	<div class="col-md-6 col-md-offset-2">
		<div class="form-group">
			{{ Form::submit('Save Note', array('class' => 'btn btn-primary btn-lg', 'value' => 'save_note', 'name' => 'save_note')) }}
		</div>
	</div>
</div>
								<br>
								<div class="table-responsive">
								@if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
									<table class="table">
										<tr>
											<th>
												Medicine
											</th>
											
											<th>
											   Times a Day  
											</th>
											<th>
												Days
											</th>
											<th>
												Quantity   
											</th>
                      @if($commonHelper->checkUserAccess("4_case_masters/prescriptionlstother",Auth::user()->id, 'delete_permission') || AUTH::user()->role == 1)											
											<th>
											   
											</th>
                      @endif
										</tr>
											@foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
												<tr>   
													<td>
														{{ $prescption->Medical_store->medicine_name }}
													</td>
													
													<td>
													   {{ $prescption->numberoftimes }}
														
													</td>
													<td>
														{{ $prescption->medicine_Quntity }}
													</td>
													<td>
													   {{ $prescption->strength }}
													</td>
													
                          @if($commonHelper->checkUserAccess("4_case_masters/prescriptionlstother",Auth::user()->id, 'delete_permission') || AUTH::user()->role == 1)				
													<td>
														{{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
														{{-- <a href="{{'/case_masters/delete/'.$prescption->id }}" class="btn btn-primary" name='prescription_delete'> Delete Prescription </a> --}}
													</td>
                          @endif
												<tr>
											@endforeach
										@endif
									</table>
									</div>
								</div>
                        </div>


						
                                  
                        <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                            <a class="btn btn-default btn-lg" href="{{ url('/case_masters/prescriptionlst') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To List</a> &nbsp;
                            <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>&nbsp;


                            @if($commonHelper->checkUserAccess("4_case_masters/prescriptionlstother",Auth::user()->id, 'print_permission') || AUTH::user()->role == 1)
                            <a class="btn btn-default btn-lg"  href="{{ url('/print/entprescription').'/'.$casedata['id'] }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a>

                            @endif
                
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
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
    $('.select2').select2();
    </script>


<!-- Medicine Set Option -->
<script type="text/javascript">

$(document).ready(function(){

    var medcounter = 1;

    $("#medicinetbtn").click(function () {
      
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

<!-- Eye Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var entcounter = 1;

    $("#enttbtn").click(function () {
      
  if(entcounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+entcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ent_prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+entcounter+'" placeholder="value'+entcounter+'" name="optionsval[]"></div><span class="input-group-addon eyeremoveButton" type="button" id="eyeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#EntTextBoxesGroup").append(newTextBoxDiv);
  entcounter++;
     });


$(document).on('click', '.eyeremoveButton', function(e) {
entcounter--;
   var target = $("#EntTextBoxesGroup").find("#TextBoxDiv" +entcounter);
  $(target).remove();
});


  });
</script>

<!-- Day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var daycounter = 1;

    $("#daytbtn").click(function () {
      
  if(daycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+daycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ent_prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Quantity"><input class="form-control"  type="text" id="optionsval'+daycounter+'" placeholder="value'+daycounter+'" name="optionsval[]"></div><span class="input-group-addon dayremoveButton" type="button" id="dayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



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

    $("#timesadaytbtn").click(function () {
      
  if(timesadaycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+timesadaycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="ent_prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Times a day"><input class="form-control"  type="text" id="optionsval'+timesadaycounter+'" placeholder="value'+timesadaycounter+'" name="optionsval[]"></div><span class="input-group-addon timesadayremoveButton" type="button" id="timesadayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



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

      $("#medicinebtnsave").click(function () {
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
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("entmedicine-field.insert") }}',
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


// ent Add Option

      $("#entbtnsave").click(function () {
        var content=$("#EntTextBoxesGroup").val();
        if (isEmpty($('#EntTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("ent-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Quantity", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Day Add Option

      $("#daybtnsave").click(function () {
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
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("ent-field.insert") }}',
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

      $("#timesadaybtnsave").click(function () {
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
 var data=$("#entform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("ent-field.insert") }}',
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

<script>
	$('input[name=prescription_type]').click(function() {
		var prescription_type = $(this).val();
		
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
			url : '{{url("get-ent-prescription-template")}}',
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
@endsection