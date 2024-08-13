@extends('adminlayouts.master')
<style type="text/css">
  .medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
  color: #700;
  cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
  color: #f00;
}

.date-from .form-group {
	margin-right: 0px;
    margin-left: 0px;
}
.date-from label {
	padding-right: 0px;
}
</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
<div class="container">
    <div class="list-group list-group-horizontal">
       
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
			{{ Form::model($casedata, array('url' => url('/AddEdit/prescription/'.$casedata['id']), 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
			{{ csrf_field() }}

			<div class="header bg-pink">
				<h2>Add/Modify Prescription Dropdowns </h2>
				
				<span style="float:right;"><a class="btn btn-success" href="{{url('prescription-templates-listing/'.$casedata['id'])}}">Prescription Templates</a></span>
			</div>
			<div class="form-group">
				{{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
				{{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
				{{ Form::hidden('doctor_id', Request::old('doctor_id'), array('class'=> 'form-control')) }}
				{{ Form::hidden('patient_emailId', 'sureshramsakha@gmail.com', array('class'=> 'form-control')) }}
			</div>

			<div class="body">
				<div class="row clearfix">
					<div class="col-md-12 ">					</div>   

				<span id="new_prescription">
					
					
					<div class="col-md-12 dropdown-container">					</div>


					<div class="col-md-12 dropdown-container">					</div>

					

				


				
				{{-- @include('case_masters.prescription.drodown_template') --}}

	<!-- ====================================================================================================================================== -->
	@include('prescriptions.ent_drop_downs.medicine') 
	@include('prescriptions.ent_drop_downs.times_a_day') 
	@include('prescriptions.ent_drop_downs.day') 
	@include('prescriptions.ent_drop_downs.quantity') 

	<!-- ====================================================================================================================================== -->



<!-- Medicine_timing Set Option -->

<script type="text/javascript">

$(document).ready(function(){

	var medicine_timingcounter = 1;

	$("#medicine_timingtbtn").click(function () {

	if(medicine_timingcounter>10){
		swal("Only 10 Options Values are allow!");
		return false;
	}

	var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+medicine_timingcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="medicine_timing"><input class="form-control"  type="text" id="optionsval'+medicine_timingcounter+'" placeholder="value'+medicine_timingcounter+'" name="optionsval[]"></div><span class="input-group-addon medicine_timingremoveButton" type="button" id="medicine_timingremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>';
	
	$("#Medicine_timingTextBoxesGroup").append(newTextBoxDiv);
		medicine_timingcounter++;
	});
	
	$(document).on('click', '.medicine_timingremoveButton', function(e) {
		medicine_timingcounter--;
		var target = $("#Medicine_timingTextBoxesGroup").find("#TextBoxDiv" +medicine_timingcounter);
		$(target).remove();
	});
});
</script>

<script>
// Medicine_timing Add Option

      $("#medicine_timingbtnsave").click(function () {
        var content=$("#Medicine_timingTextBoxesGroup").val();
        if (isEmpty($('#Medicine_timingTextBoxesGroup'))) 
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
 var data=$("#Medicine_timingTextBoxesGroup :input").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("entinsert-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Timing", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });
</script>
	<!-- ============================================================================================================================================ -->
					</span>

					
				</div>
				</form>
			</div>

			

			<div class="row clearfix">
			<div class="col-md-12">
			<div class="form-group">
			<!-- <a class="btn btn-default btn-lg" href="{{ url('/case_masters/prescriptionlst') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To List</a> &nbsp;
			<a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>&nbsp;
			 -->
			
			</div>
			</div>
			</div> 
					</div>    
            </div>
        </div>

@include('prescriptions.frequency_add_more')

        @endsection
  
  @section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
    $('.select2').select2();
    </script>


<!-- Medicine Set Option -->
<script type="text/javascript">


</script>


<script type="text/javascript">
    function isEmpty( el ){
      return !$.trim(el.html())
  }


</script>


<!-- ==================================== Update dropdown options ================================================ -->
<script>
		$(document).on('click','.edit-dropdown-options',function() {
			var table_name = $(this).data('table_name');
			var form_name = $(this).data('form_name');
			var field_name = $(this).data('field_name');
			
			var element_to_show = $(this).closest('.dropdown-container').find('.dropdown-options-initial-div');

			var url = "{{route('get-update-ent-dropdown-options')}}";
			if(table_name == "entmedical_store") {
				url = "{{route('get-ent-prescription-dropdown-options')}}";
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

$(document).on('click','.update-dropdown-options-btn',function() { //alert('clicked');

			var clicked_element = $(this);

			var form_target = $(this).closest('.update-dropdown-options-form');

			var id = form_target.attr('id');
			var table_name = $(this).data('table_name');

			var form_data = $('#'+ id +' :input').serialize();

			var url = "{{url('update-ent-dropdown-options')}}";
			if(table_name == "entmedical_store") {
				url = "{{route('update-ent-prescription-dropdown-options')}}";
			}

			//alert(url);

			//alert(table_name);

			$.ajax({
				url: url,
				method:'post',
				data:{'form_data': form_data},
				datatype: 'json',
				success:function(response) {
					//console.log(response);

					//alert('hi');

					//location.reload();
					
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


@endsection