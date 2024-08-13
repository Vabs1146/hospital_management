@extends('adminlayouts.master')

@section('style')
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
				<form id="eyeform" action="{{ url('/set-dropdown-options') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data'>
					{{ csrf_field() }}


					<div class="header bg-pink">
						<h2>
							Manage Dropdown options
						</h2>

					</div>
					<div class="body">
						<div class="row clearfix ">
							<div class="col-md-12 ">
								<div class="col-md-2">
									<div class="form-group labelgrp">
									<label class="">Choose Field Name</label> 
									</div> 
								</div>

								<div class="col-md-3">
									<select id="dropdown_select" class="form-control select2" data-live-search="true" name="dropdwon_field_name">
										<option value=" ">-Select-</option>
											@foreach($dropdown_options_array as $key => $val)

											@php 

											@endphp

											@if(is_array($val))
												<option value="{{$key}}" data-od="{{$key.'_'.$val['1']}}" data-os="{{$key.'_'.$val['2']}}">{{$val['0']}}</option>
											@else
												<option value="{{$key}}" data-od="{{$key}}" data-os="{{$key}}">{{$val}}</option>
											@endif
											@endforeach
										</select>
								</div>

								<div class="form-line">
									<input class="form-control" type="hidden" id="fieldName1" name="fieldName1" value="">
									<input class="form-control" type="hidden" id="fieldName2" name="fieldName2" value="">
								</div>

								<div class="col-md-4">
									<button type="button" name="add" id='otherDetailsDiagnosisbtn' class="btn btn-success set-dropdown-options"  data-field_name="otherDetailsDiagnosis" data-form_name="EyeForm" >Set Option </button>
									<button type='button' class="btn btn-primary save-dropdown-options" id='otherDetailsDiagnosisbtnsave'>Save Option</button>
								</div>
							</div>

							<div id='TextBoxesGroup' class="col-md-12">

							</div>
							
							<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>





							
							<!-- <div class="col-md-12">                           
								<div class="col-md-4 col-md-offset-4">
								<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg">
								<i class="fa fa-plus"></i> Save
								</button> 
								</div>
								</div>
							</div>     -->              
							<!-- End Of row -->
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
<script>
   function isEmpty( el ){
      return !$.trim(el.html())
  }

//$('.select2').select2();



	$(document).ready(function() {

		var counter = 1;

		$(".set-dropdown-options").click(function () {

			if(counter>10){
				swal("Only 10 Options Values are allow!");
				return false;
			}

			var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+counter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="text" id="optionsval'+counter+'" placeholder="value'+counter+'" name="optionsval[]"></div><span class="input-group-addon removeButton" type="button" id="removeButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'

			$("#TextBoxesGroup").append(newTextBoxDiv);
			counter++;
		});

		$(document).on('click', '.removeButton', function(e) {
			counter--;
			var target = $("#TextBoxesGroup").find("#TextBoxDiv" +counter);
			$(target).remove();
		});
	});



	$(".save-dropdown-options").click(function () {
		var selected_option = $("#dropdown_select option:selected").text();
		var content=$("#TextBoxesGroup").val();
		if (isEmpty($('#TextBoxesGroup'))) {
			swal({
			title: "Please Add Some Option by clicking on",
			text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
			html: true
			});
		} else {
			var data=$("#eyeform").serialize();
			event.preventDefault();
			$.ajax({
				url:'{{ route("dynamic-field.insert") }}',
				method:'post',
				data:data,
				success:function(data) {
					swal({title: "Option For "+selected_option, text: "Added Successfully!", type: "success"},
						function(){ 
							location.reload();
						}
					);
				}
			})
		}

	});


	$('#dropdown_select').change(function() {
		var main_key = $(this).val();
		var od = $(this).find(':selected').data('od');
		var os = $(this).find(':selected').data('os');

		$('#fieldName1').val(od);
		$('#fieldName2').val(os);
	});

</script>
@endsection
