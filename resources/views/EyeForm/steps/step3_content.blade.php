<div class="col-md-12">
	<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="finding_type" value="new"> Default
	<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="finding_type" value="template"> Template

	<span id="finding_template_dropdown_div" style="display:none;">
		<div class="col-md-12">
			<div class="col-md-2">
					<div class="form-group labelgrp">
						<label class="form-control">Select Template</label>
					</div>
				</div>
			<div class="col-md-10">
				<select id="select_template" class="form-control">
					<option value="">Select Template</option>
					@foreach($finding_templates as $finding_templates_row)
					<option value="{{$finding_templates_row->id}}">{{$finding_templates_row->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</span>
</div>

<span class="template-span" id="template_one">
@include('EyeForm.steps.finding.lids')

@include('EyeForm.steps.finding.orbit')

@include('EyeForm.steps.finding.conjandlids')

@include('EyeForm.steps.finding.cornea')
</span>

<div class="col-md-12">
	<div class="col-md-2">
		{{-- <input type="button" value="CheckCanvas" id="checkCanvas"> --}}
	</div>

	<div class="col-md-5">

		<div class="col-md-12">
			<div class="example1" data-example="OdImg1">
			<div class="board" id="OdImg1_canvas"></div>
			</div>
			<input type="hidden" name="OdImg1" id="OdImg1"/>
		</div>

		<div class="col-md-12"><br>
			<input type="text" class="form-control" name="OdImg1_comment" id="OdImg1_comment" value="{{$form_details->OdImg1_comment}}"/>
		</div>

		<div class="col-md-12">
			@if (!empty($form_details->OdImg1) && !is_null($form_details->OdImg1))   
			<br>
			<button type="button" value="OdImg1" class="ImageDelete pull-right" >Delete</button>
			<p>&nbsp;</p>
			<center id="wPaint-OdImg1"> 
				<img src={{ Storage::disk('local')->url($form_details->OdImg1)."?".filemtime(Storage::path($form_details->OdImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />
			</center>
			@endif
		</div>
	</div>

	<div class="col-md-5">
		<div class="col-md-12">
			<div class="example1" data-example1="OsImg1">
			<div class="board" id="OsImg1_canvas">
			</div>
			</div>
			<input type="hidden" name="OsImg1" id="OsImg1"/>
		</div>

		<div class="col-md-12"><br>
			<input type="text" class="form-control" name="OsImg1_comment" id="OsImg1_comment" value="{{$form_details->OsImg1_comment}}"/>
		</div>
		<div class="col-md-12">
			@if (!empty($form_details->OsImg1) && !is_null($form_details->OsImg1))

			<button type="button" value="OsImg1" class="ImageDelete pull-right" >Delete</button>
			<p>&nbsp;</p>
			<center id="wPaint-OsImg1"> 
				<img src={{ Storage::disk('local')->url($form_details->OsImg1)."?".filemtime(Storage::path($form_details->OsImg1)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
			</center>
			@endif
		</div>
	</div>
</div>

<span class="template-span" id="template_two">
@include('EyeForm.steps.finding.ac')

@include('EyeForm.steps.finding.iris')

@include('EyeForm.steps.finding.pupil')

@include('EyeForm.steps.finding.lens')
</span>
<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label>Fundus</label>
		</div>
	</div>
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="example1" data-example="OdImg2">
				<div class="board" id="OdImg2_canvas" ></div>
			</div>
			<input type="hidden" name="OdImg2" id="OdImg2"/>
		</div>

		<div class="col-md-12"><br>
			<input type="text" class="form-control" name="OdImg2_comment" id="OdImg2_comment" value="{{$form_details->OdImg2_comment}}"/>
		</div>
		<div class="col-md-12">
			@if (!empty($form_details->OdImg2) && !is_null($form_details->OdImg2))
			<br>
			<button type="button" value="OdImg2" class="ImageDelete pull-right" >Delete</button>
			<p>&nbsp;</p>
			<center id="wPaint-OdImg2"> 
				<img src={{ Storage::disk('local')->url($form_details->OdImg2)."?".filemtime(Storage::path($form_details->OdImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
			</center>
			@endif
		</div>
	</div>

	<div class="col-md-5">
		<div class="col-md-12">
			<div class="example1" data-example="OsImg2">
				<div class="board" id="OsImg2_canvas"></div>
			</div>
			<input type="hidden" name="OsImg2" id="OsImg2"/>
		</div>

		<div class="col-md-12"><br>
			<input type="text" class="form-control" name="OsImg2_comment" id="OsImg2_comment" value="{{$form_details->OsImg2_comment}}"/>
		</div>
		<div class="col-md-6">
			@if (!empty($form_details->OsImg2) && !is_null($form_details->OsImg2))
			<br>
			<button type="button" value="OsImg2" class="ImageDelete pull-right" >Delete</button>
			<p>&nbsp;</p>
			<center id="wPaint-OsImg2"> 
				<img src={{ Storage::disk('local')->url($form_details->OsImg2)."?".filemtime(Storage::path($form_details->OsImg2)) }} class="img-rounded" alt="Image Not found" width="100%" height="100%" />  
			</center>
			@endif
		</div>
	</div>
</div>

<span class="template-span" id="template_three">
@include('EyeForm.steps.finding.vitreins')

@include('EyeForm.steps.finding.retina')

@include('EyeForm.steps.finding.onh')

@include('EyeForm.steps.finding.macula')

@include('EyeForm.steps.finding.sac')
</span>
<div class="col-md-12 custom-item-parent-div">
	<div class="row custom-item">
		<div class="col-md-4">
			<select class="custom-item-dropdown form-control select2">
				<option value="">Select Option</option>

				<option value="Lids" data-title="Lids" data-od="1" data-os="1">Lids</option>
				<option value="Orbit" data-title="Orbit" data-od="1" data-os="1">Orbit</option>

				<option value="ConjAndLids" data-title="Conj" data-od="1" data-os="1">Conj</option>
				<option value="cornia" data-title="Cornea" data-od="1" data-os="1">Cornea</option>

				<option value="AC" data-title="AC" data-od="1" data-os="1">AC</option>
				<option value="IRIS" data-title="Iris" data-od="1" data-os="1">Iris</option>

				<option value="pupilIrisac" data-title="Pupil" data-od="1" data-os="1">Pupil</option>
				<option value="lens" data-title="Lens" data-od="1" data-os="1">Lens</option>

				<option value="vitreoretinal" data-title="Vitreins" data-od="1" data-os="1">Vitreins</option>
				<option value="Retina" data-title="Retina" data-od="1" data-os="1">Retina</option>

				<option value="ONH" data-title="ONH" data-od="1" data-os="1">ONH</option>
				<option value="Macula" data-title="Macula" data-od="1" data-os="1">Macula</option>


				<option value="sac" data-title="Sac" data-od="1" data-os="1">Sac</option>
			</select>
		</div>
		<div class="col-md-3">

		</div>
		<div class="col-md-3">

		</div>
		<div class="col-md-2">
			<span class="add-custom-item btn btn-default">Add</span>
		</div>
	</div>
	<div class="custom-item-container">

	</div>
</div>       

<div class="col-md-12">
	<div class="col-md-6 col-md-offset-4">
		<div class="form-group">
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination') }}" type="submit" name="submit" class="btn btn-primary btn-lg" value="submit">
				Submit
			</button>
			<button type="submit" formaction="{{ url('/patientDetails/SaveEyeExamination1') }}" name="submit" class="btn btn-primary btn-lg" value="submit">
				Submit & View
			</button>             
			<a href="{{ url('/add-finding-templates') }}/{{$casedata['id']}}" name="submit" class="btn btn-info btn-lg">
				Add New Template
			</a>       
		</div>
	</div>
</div>


<script>
	$('input[name=finding_type]').click(function() {
		var finding_type = $(this).val();
		
		if(finding_type == 'new') {
			location.reload();
		}

		if(finding_type == 'template') {
			$('#new_prescription').hide();
			$('#finding_template_dropdown_div').show();
		}
		//alert(finding_type);
	});

	$(document).on('change', '#select_template', function() {
		var selected_template = $(this).val();
		//alert(selected_template);
		$('#template_one').html('');
				$('#template_two').html('');
				$('#template_three').html('');
		$.ajax({
			url : '{{url("get-finding-template-html")}}',
			type:'post',
			data : {'id' : $(this).val()},
			datatype: 'json',
			success : function(response) {


				$('#template_one').html(response.one);
				$('#template_two').html(response.two);
				$('#template_three').html(response.three);

				$('.template-span .select2').select2({width: '100%'});
			}
		});
		
	});
</script>
