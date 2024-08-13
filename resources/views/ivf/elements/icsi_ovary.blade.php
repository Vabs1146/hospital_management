<div class="col-md-12" id="append_data_1" >
	@foreach($ivf_icsi_ovary as $ivf_icsi_ovary_row)
	<input type="hidden" name="icsi_ovary_all_old_id[]" value="{{$ivf_icsi_ovary_row->id}}">
		<div class="row item-row">
		<input type="hidden" name="icsi_ovary_old_id[]" value="{{$ivf_icsi_ovary_row->id}}">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_date" class="form-control">DAY / DATE :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
				 {{ Form::text('ivf_icsi_ovary_date[]', $ivf_icsi_ovary_row->ivf_icsi_ovary_date, array('class'=> 'form-control datepicker')) }}  
				 </div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_right" class="form-control">RIGHT OVARY :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_right[]', $ivf_icsi_ovary_row->ivf_icsi_ovary_right, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_left" class="form-control">LEFT OVARY :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_left[]', $ivf_icsi_ovary_row->ivf_icsi_ovary_left, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_mi" class="form-control">MI :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_mi[] ', $ivf_icsi_ovary_row->ivf_icsi_ovary_mi, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>
		<div class="col-md-1">
			<span class="btn btn-danger icsi-ovary-remove" >remove</span>
		</div>
	</div>
	@endforeach

	<div class="row item-row">
		<input type="hidden" name="icsi_ovary_old_id[]">
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_date" class="form-control">DAY / DATE :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
				 {{ Form::text('ivf_icsi_ovary_date[]', null, array('class'=> 'form-control datepicker')) }}  
				 </div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_right" class="form-control">RIGHT OVARY :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_right[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_left" class="form-control">LEFT OVARY :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_left[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_mi" class="form-control">MI :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_mi[] ', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>
		<div class="col-md-1">
			
		</div>
	</div>
</div>

<div class="col-md-12">
	<span class="btn btn-info" id="add_more_icsi_ovary">Add More</span>
</div>

<script>
	$('#add_more_icsi_ovary').click(function() {

		//alert('hi');
		let item = $('#hidden_icsi_ovary').clone();

		$('#append_data_1').append(item.html());
		
		//$( "#append_data_1 .time-date-row:last-child" ).find('.Dyselect2').select2({width: '100%'});

		$( "#append_data_1 .item-row:last-child" ).find('.datepicker').bootstrapMaterialDatePicker({
			format: 'YYYY-MM-DD',
			clearButton: true,
			weekStart: 1,
			time: false
		});
	});

	$(document).on('click', '#append_data_1 .icsi-ovary-remove', function(e) {
		$(this).closest('.item-row').remove();
	});
</script>

<div style="display:none;" id="hidden_icsi_ovary">
	<div class="row item-row">
		<input type="hidden" name="icsi_ovary_old_id[]">
		<div class="col-md-2">
			<!-- <div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_date" class="form-control">DAY / DATE :</label>
			</div> -->
			<div class="form-group">
				<div class="form-line">
				 {{ Form::text('ivf_icsi_ovary_date[]', null, array('class'=> 'form-control datepicker')) }}  
				 </div>
			</div>
		</div>

		<div class="col-md-3">
			<!-- <div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_right" class="form-control">RIGHT OVARY :</label>
			</div> -->
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_right[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<!-- <div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_left" class="form-control">LEFT OVARY :</label>
			</div> -->
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_left[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>


		
		<div class="col-md-3">
			<!-- <div class="form-group labelgrp">
				<label style="text-align: left;" for="ivf_icsi_ovary_mi" class="form-control">MI :</label>
			</div> -->
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('ivf_icsi_ovary_mi[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-1">
			<span class="btn btn-danger icsi-ovary-remove" >remove</span>
		</div>
	</div>
</div>


