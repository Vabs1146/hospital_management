<div class="container">
<div class="row clearfix">
	<div class="col-md-12">
	<div class="form-group">
	<h3 class="text-center"><u>Prescription.</u></h3>
	</div>
	</div>

	<div class="col-md-12">
	<input style="position:relative; opacity: 1; left: 0px; " checked type="radio" name="prescription_type" value="new"> New Prescription
	<input style="position:relative;opacity: 1; left: 0px; " type="radio" name="prescription_type" value="template"> Template
	</div>
	<span id="new_prescription">
	<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label class="form-control">Medicine :</label>
	</div>
	</div>


	<div class="col-md-6">
		{{ Form::select('medicine_id', array(''=>'Please select') + $medicinlist->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
	</div>

	<div class="col-md-4">
		<button type="button" name="add" id='medicinetbtn' class="btn btn-success  set-dropdown-options" data-table_name="medical_store" data-field_name="" data-form_name="">Set Option </button>    
		<button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
	</div>

	<div id='MedicineTextBoxesGroup' class="col-md-12">

	</div>
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
	</div>


	<div class="col-md-12 dropdown-container">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		<label class="form-control">Eye :</label>
		</div>
		</div>
		<div class="col-md-6">
		{{ Form::select('strength', array(''=>'Please select') + $presDropdowns['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-4">
		<button type="button" name="add" id='eyetbtn' class="btn btn-success set-dropdown-options" data-table_name="form_dropdowns" data-field_name="Strength" data-form_name="Prescription">Set Option </button>    
		<button type='button' class="btn btn-primary" id='eyebtnsave'>Add</button>
		</div>

		<div id='EyeTextBoxesGroup' class="col-md-12"> </div>

		<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
	</div>

	<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label class="form-control">Frequency :</label>
	</div>
	</div>

	<div class="col-md-6">
	{{ Form::select('numberoftimes', array(''=>'Please select') + $presDropdowns['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
	</div> 
	<div class="col-md-4">
	<button type="button" name="add" id='timesadaytbtn' class="btn btn-success set-dropdown-options" data-table_name="form_dropdowns" data-field_name="Times a day" data-form_name="Prescription">Set Option </button>    
	<button type='button' class="btn btn-primary" id='timesadaybtnsave'>Add</button>
	</div>

	<div id='TimesadayTextBoxesGroup' class="col-md-12"> </div>
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
	</div>

	<div class="col-md-12 dropdown-container">
	<div class="col-md-2">
	<div class="form-group labelgrp">
	<label class="form-control"> Duration :</label>
	</div>
	</div>


	<div class="col-md-6">
	{{ Form::select('medicine_quantity', array(''=>'Please select') + $presDropdowns['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
	</div>
	<div class="col-md-4">
	<button type="button" name="add" id='daytbtn' class="btn btn-success set-dropdown-options" data-table_name="form_dropdowns" data-field_name="Quantity" data-form_name="Prescription">Set Option </button>    
	<button type='button' class="btn btn-primary" id='daybtnsave'>Add</button>
	</div>

	<div id='DayTextBoxesGroup' class="col-md-12"> </div>
	<div class='dropdown-options-initial-div' class="col-md-12" style="display:none;"> </div>
	</div>

	<div class="col-md-12 dropdown-container">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			<label class="form-control"> Date :</label>
			</div>
		</div>
		<div class="col-md-1 date-from">
			<div class="form-group labelgrp">
			<label class="form-control"> From :</label>
			</div>
		</div>
		<div class="col-md-2">
			{{ Form::text('from', Request::old('from', null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>
		<div class="col-md-1">
			<div class="form-group labelgrp">
			<label class="form-control"> To :</label>
			</div>
		</div>
		<div class="col-md-2">
			{{ Form::text('to', Request::old('to', null), array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>

		<div class="col-md-4">

		</div>
	</div>
	</span>

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
				url : '{{url("get-prescription-template")}}',
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
</div>
</div>