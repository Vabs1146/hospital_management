<span class="dropdown-container">
	<div id="retina" class="ContainerToAppend">
		<div class="col-md-12">
			<div class="col-md-2">
				<div class="form-group labelgrp">
					<label>Retina</label>
				</div>
				<input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="1" />  
			</div>
			<div class="col-md-3">
				<div>
					{{ Form::select('Retina_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OD')->pluck('ddText','ddText')->toArray(), array_key_exists('Retina OD', $defaultValues)?$defaultValues['Retina OD']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>
				<div class="retina-eye">
					<input class="retina-eye-radio" type="radio" name="retina_eye_OD_temp"  value="Dilated" style="opacity: 1; left: auto; position: relative;">Dilated
					<input class="retina-eye-radio" type="radio" name="retina_eye_OD_temp" value="Undilated" style="opacity: 1; left: auto; position: relative;">Undilated
					<input class="retina-eye-radio" type="radio" name="retina_eye_OD_temp" value="none" style="opacity: 1; left: auto; position: relative;">none
					<input type="hidden" class="retina-eye-val" name="retina_eye_OD[]">
				</div> 
			</div>
			<div class="col-md-3">
				<div>
					{{ Form::select('Retina_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OS')->pluck('ddText','ddText')->toArray(), array_key_exists('Retina OS', $defaultValues)?$defaultValues['Retina OS']:null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
				</div>
				<div class="retina-eye">
					<input class="retina-eye-radio" type="radio" name="retina_eye_OS_temp"  value="Dilated" style="opacity: 1; left: auto; position: relative;">Dilated
					<input class="retina-eye-radio" type="radio" name="retina_eye_OS_temp" value="Undilated" style="opacity: 1; left: auto; position: relative;">Undilated
					<input class="retina-eye-radio" type="radio" name="retina_eye_OS_temp" value="none" style="opacity: 1; left: auto; position: relative;">none
					<input type="hidden" class="retina-eye-val" name="retina_eye_OS[]">
				</div> 
			</div>
			<div class="col-md-4">
				<button type="button" name="add" id="retinabtn" class="btn btn-success  set-dropdown-options"  data-field_name="Retina OD" data-form_name="EyeForm" >Set Option </button>
				<button type='button' class="btn btn-primary" id='retinabtnsave'>Save Option</button>
				<button id="Retina" class="btn btn-default addmore-retina" data-templateDiv="RetinaTemplate">Add</button>
			</div>
		</div>

		@if(isset($template_data) && $template_data != null && isset($template_data['Retina']))
			@foreach($template_data['Retina'] as $key => $template_row)
				<div class="col-md-12">
					<div class="col-md-2">
						<input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="" />   
					</div>
					<div class="col-md-3">
						<div>
						{{ Form::select('Retina_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OD')->pluck('ddText','ddText')->toArray(), $template_row->od, array('class'=> 'form-control Dyselect2')) }}
						</div>
						<div class="retina-eye">
							<input {{$template_row->duration_od == 'Dilated' ? 'checked' : ''}} class="retina-eye-radio" type="radio" name="retina_eye_OD_temp[{{$key}}]"  value="Dilated" style="opacity: 1; left: auto; position: relative;">Dilated
							<input {{$template_row->duration_od == 'Undilated' ? 'checked' : ''}} class="retina-eye-radio" type="radio" name="retina_eye_OD_temp[{{$key}}]" value="Undilated" style="opacity: 1; left: auto; position: relative;">Undilated
							<input {{$template_row->duration_od == 'none' ? 'checked' : ''}} class="retina-eye-radio" type="radio" name="retina_eye_OD_temp[{{$key}}]" value="none" style="opacity: 1; left: auto; position: relative;">none
							<input type="hidden" class="retina-eye-val" name="retina_eye_OD[]" value="{{$template_row->duration_od}}">
						</div> 
					</div>
					<div class="col-md-3">
						<div>
							{{ Form::select('Retina_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OS')->pluck('ddText','ddText')->toArray(), $template_row->os, array('class'=> 'form-control Dyselect2')) }}
						</div>
						<div class="retina-eye">
							<input {{$template_row->duration_os == 'Dilated' ? 'checked' : ''}} class="retina-eye-radio" type="radio" name="retina_eye_OS_temp[{{$key}}]"  value="Dilated" style="opacity: 1; left: auto; position: relative;">Dilated
							<input {{$template_row->duration_os == 'Undilated' ? 'checked' : ''}} class="retina-eye-radio" type="radio" name="retina_eye_OS_temp[{{$key}}]" value="Undilated" style="opacity: 1; left: auto; position: relative;">Undilated
							<input {{$template_row->duration_os == 'none' ? 'checked' : ''}} class="retina-eye-radio" type="radio" name="retina_eye_OS_temp[{{$key}}]" value="none" style="opacity: 1; left: auto; position: relative;">none
							<input type="hidden" class="retina-eye-val" name="retina_eye_OS[]" value="{{$template_row->duration_os}}">
						</div> 
					</div>
					<div class="col-md-2">
						<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
					</div>
				</div>
			@endforeach
		@endif

	</div>
	<div id='RetinaTextBoxesGroup' class="col-md-12">

	</div>
	<div style="display:none;">
		<div id="RetinaTemplate" >
			<div class="col-md-12">
				<div class="col-md-2">
					<input type="hidden" id="Retina[]" name="Retina[]" class="hiddenCounter" value="" />   
				</div>
				<div class="col-md-3">
					<div>
					{{ Form::select('Retina_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OD')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
					</div>
					<div class="retina-eye">
						<input class="retina-eye-radio" type="radio" name="retina_eye_OD_temp"  value="Dilated" style="opacity: 1; left: auto; position: relative;">Dilated
						<input class="retina-eye-radio" type="radio" name="retina_eye_OD_temp" value="Undilated" style="opacity: 1; left: auto; position: relative;">Undilated
						<input class="retina-eye-radio" type="radio" name="retina_eye_OD_temp" value="none" style="opacity: 1; left: auto; position: relative;">none
						<input type="hidden" class="retina-eye-val" name="retina_eye_OD[]">
					</div> 
				</div>
				<div class="col-md-3">
					<div>
						{{ Form::select('Retina_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'Retina OS')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
					</div>
					<div class="retina-eye">
						<input class="retina-eye-radio" type="radio" name="retina_eye_OS_temp"  value="Dilated" style="opacity: 1; left: auto; position: relative;">Dilated
						<input class="retina-eye-radio" type="radio" name="retina_eye_OS_temp" value="Undilated" style="opacity: 1; left: auto; position: relative;">Undilated
						<input class="retina-eye-radio" type="radio" name="retina_eye_OS_temp" value="none" style="opacity: 1; left: auto; position: relative;">none
						<input type="hidden" class="retina-eye-val" name="retina_eye_OS[]">
					</div> 
				</div>
				<div class="col-md-2">
					<button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove </button>
				</div>
			</div>
		</div>
	</div>

	<!-- ================================================================================= -->

	<!-- set-dropdown-options -->
	<!-- <span class="dropdown-container"> -->
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;">
	@php 
	$dropdown_options_field_name = 'Retina OD';
	$dropdown_options_form_name = 'EyeForm';
	@endphp
	{{--@include('comman_templates.dropdown_options_update')--}}
	</div>
</span>
<!-- ================================================================================= -->
<div class="dbMultiEntryContainer">
	@foreach ($form_details->eyeformmultipleentry()->where('field_name', 'Retina')->get() as $item)
	<div class="col-md-12">
		<div class="col-md-2">
		</div>
		<div class="col-md-3">
			<p>
			<input type="text" class="form-control" readonly value="{{$item->field_value_OD}}">
			</p>
			<p>
			<input type="text" class="form-control" readonly value="{{$item->duration_od}}">
			</p>
		</div>
		<div class="col-md-3">
			<p>
				<input type="text" class="form-control" readonly value="{{$item->field_value_OS}}">
			</p>
			<p>
				<input type="text" class="form-control" readonly value="{{$item->duration_os}}">
			</p>
		</div>
		<div class="col-md-2">
		<button class="removeDbItem btn btn-default" data-deleteid="{{$item->id}}">Remove</button>
		</div>
	</div>
	@endforeach
</div>


<script>
$(document).on('click', '.retina-eye-radio', function() {
	//alert($(this).val());
	$(this).parent().find('.retina-eye-val').val($(this).val());
});
$(document).on('click', '.addmore-retina', function(e) {
	e.preventDefault();
	//alert('hi');
	var retina_eye_html = $('#RetinaTemplate').html();

	var replace_text = 'retina_eye_OD_temp['+$.now()+']';

	retina_eye_html = retina_eye_html.replaceAll('retina_eye_OD_temp', replace_text);

	var replace_text = 'retina_eye_OS_temp['+$.now()+']';

	retina_eye_html = retina_eye_html.replaceAll('retina_eye_OS_temp', replace_text);

	$('#temp_retina').html(retina_eye_html);

	var template = $('#temp_retina').clone();

	$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));

	$(this).closest('div.ContainerToAppend').append($(template).html());
	$(this).closest('div.ContainerToAppend').find('.Dyselect2').select2({width: '100%'});

	$('#temp_retina').html('');
           
});
</script>
<!-- <div id="temp_retina" style="display:none;"></div> -->
<div id="temp_retina"></div>