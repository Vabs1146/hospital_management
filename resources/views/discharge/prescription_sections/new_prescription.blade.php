<span id="new_prescription">
	<div class="row clearfix">
		<div class="col-md-3">
			<div>
				<label>Medicine :</label>
			</div>
			{{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '0')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
			<div>
				<label>Generic Medicine :</label>
			</div>
			{{ Form::select('generic_medicine_id', array(''=>'Please select') + $casedata['medicinlist']->where('is_generic', '1')->pluck('medicine_name','id')->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
			<div>
				<label>Eye :</label>
			</div>
			{{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>
		<div class="col-md-3">
			<div>
				<label> Duration :</label>
			</div>
			{{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>

		<div class="col-md-3"> <!-- Timing -->
			<div>
				<label>Timing :</label>
			</div>
			{{ Form::select('medicine_timing', array(''=>'Please select') + $casedata['medicine_timing']->toArray(), Request::old('medicine_timing'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div>

		<div class="col-md-3"> <!-- frequency -->
			<div>
				<label>Frequency :</label>
			</div>
			{{ Form::select('numberoftimes[]', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control select2','data-live-search'=>'true')) }}
		</div> 
		<div class="col-md-2">
			<div>
				<label>From Date :</label>
			</div>
			{{ Form::text('from[]', null, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>
		<div class="col-md-2">
			<div>
				<label>To Date :</label>
			</div>
			{{ Form::text('to[]', null, array('class'=> 'form-control datepicker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
		</div>

		<div class="col-md-2">
			<button type='button' class="btn btn-primary" id='add_more_frequency'>Add Frequency <br> and Dates</button>
		</div>
	</div>
</span>
<script>
					$('#add_more_frequency').click(function(e) {
						e.preventDefault();
						var template = $("#more_timing_dates").clone();
						/*
						$(template).find('.datepicker').bootstrapMaterialDatePicker({
							format: 'YYYY-MM-DD - HH:mm A',
							clearButton: true,
							weekStart: 1
						});
						*/
						$('#new_prescription').append($(template).html());


						$( "#new_prescription .time-date-row:last-child" ).find('.Dyselect2').attr('name', 'numberoftimes[]');
						$( "#new_prescription .time-date-row:last-child" ).find('.from-date-picker').attr('name', 'from[]');
						$( "#new_prescription .time-date-row:last-child" ).find('.to-date-picker').attr('name', 'to[]');

						$( "#new_prescription .time-date-row:last-child" ).find('.Dyselect2').select2({width: '100%'});

						$( "#new_prescription .time-date-row:last-child" ).find('.datepicker').bootstrapMaterialDatePicker({
							format: 'YYYY-MM-DD',
							clearButton: true,
							weekStart: 1,
							time: false
						});
					});

					$(document).on('click', '.remove_more_frequency', function(e) {
						$(this).closest('.time-date-row').remove();
					});
				</script>

				<span id="more_timing_dates" style="display:none;">
					<div class="row clearfix time-date-row">
						<div class="col-md-3"> <!-- Timing -->
						
						</div>

						<div class="col-md-3"> <!-- frequency -->
							{{ Form::select('', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}
						</div> 
						<div class="col-md-2">
							{{ Form::text('', null, array('class'=> 'form-control datepicker from-date-picker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>
						<div class="col-md-2">
						{{ Form::text('', null, array('class'=> 'form-control datepicker to-date-picker', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
						</div>

						<div class="col-md-2">
							<button type='button' class="btn btn-warning remove_more_frequency" >Remove</button>
						</div>
					</div>
				</span>