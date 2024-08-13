
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  @include('shared.error')
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success">
                  {{ Session::get('flash_message') }}
                  </div>
                  @endif     
          <div class="card">
          {{ Form::model($presDropdowns, array('url' => url('/patients/save-prescription'), 'method' => 'POST','id'=>'entform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Add/Modify Ent Prescription </h2>
		  <span style="float:right;"><a class="btn btn-success" href="{{url('ent-prescription-templates-listing/')}}">Prescription Templates</a></span>
          </div>
              <div class="form-group">
                {{ Form::hidden('registration_id', $registration_data->id, array('class'=> 'form-control')) }}
            </div>
              <div class="body">

			  
                  <div class="row clearfix">

                             <div class="col-md-12">
                             <div class="form-group">
                             <h3 class="text-center"><u>Prescription.</u></h3>
                             </div>
                             </div>


							  <!-- ================================================================================ -->
<div class="col-md-12">
					<div class="col-md-4">
						<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"> New Prescription
						<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template"> Template
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="form-group">
							<a class="btn btn-primary btn-lg" href="{{url('add-ent-prescription-dropdowns')}}" >Add Dropdown</a>  
							
							<a class="btn btn-primary btn-lg" href="{{url('add-ent-prescription-templates')}}">Create Prescription Template</a>
							
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
							 {{ Form::select('medicine_id', array(''=>'Please select') + $presDropdowns['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>
						<div class="col-md-3">
							<div>
								<label> Times a Day :</label>
							</div>
							{{ Form::select('numberoftimes', array(''=>'Please select') + $presDropdowns['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

						<div class="col-md-3"> <!-- Timing -->
							<div>
								<label>Day :</label>
							</div>
							{{ Form::select('medicine_quantity', array(''=>'Please select') + $presDropdowns['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
						</div>

						<div class="col-md-3"> <!-- Timing -->
							<div>
								<label>Quantity :</label>
							</div>
							{{ Form::select('strength', array(''=>'Please select') + $presDropdowns['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2')) }}
						</div>

						
					</div>
				</span>
			  <!-- =================================================================================== -->

                             <div class="col-md-12">                                      </div>

                              

                              

                            <div class="row clearfix">
								<div class="col-md-6 col-md-offset-2">
								<div class="form-group">
								{{ Form::submit('Add Prescription', array('class' => 'btn btn-primary btn-lg', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}  
								
								</div>
								<br>
								<div class="table-responsive">
								@if(null !== old('prescriptions',$presDropdowns['prescriptions']) && count(old('prescriptions',$presDropdowns['prescriptions']))> 0 )
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
											
											<th>
											   
											</th>
										</tr>
											@foreach(old('prescriptions',$presDropdowns['prescriptions']) as $prescption)
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
													
													
													<td>
														{{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
														{{-- <a href="{{'/case_masters/delete/'.$prescption->id }}" class="btn btn-primary" name='prescription_delete'> Delete Prescription </a> --}}
													</td>
												<tr>
											@endforeach
										@endif
									</table>
									</div>
								</div>
                        </div>


						
                                  
                        <div class="row clearfix">                        </div>  
                                  
                    </div>
                    </form>
                </div>
            </div>    
            </div>
        </div>

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