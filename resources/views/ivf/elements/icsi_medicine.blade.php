<div class="col-md-12" id="append_data_2" >
	@foreach($ivf_icsi_medicine_details as $ivf_icsi_medicine_details_row) 
		<input type="hidden" name="icsi_medicine_all_old_id[]" value="{{$ivf_icsi_medicine_details_row->id}}">
	<div class="row item-row">
		<input type="hidden" name="icsi_medicine_old_id[]" value="{{$ivf_icsi_medicine_details_row->id}}">
		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="medicine_name" class="form-control">MEDICIN NAME :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
				 {{ Form::text('medicine_name[]', $ivf_icsi_medicine_details_row->medicine_name, array('class'=> 'form-control')) }}  
				 </div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="time" class="form-control">Time :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('time[]', $ivf_icsi_medicine_details_row->time, array('class'=> 'form-control ')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="batch_number" class="form-control">Batch No. :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('batch_number[]', $ivf_icsi_medicine_details_row->batch_number, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>


		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="expiry_date" class="form-control">Exp Date :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('expiry_date[]', $ivf_icsi_medicine_details_row->expiry_date, array('class'=> 'form-control datepicker')) }}                            
				</div>
			</div>
		</div>
		<div class="col-md-1">
			<span class="btn btn-danger icsi-medicine-remove" >remove</span>
		</div>
	</div>
	@endforeach

	<div class="row item-row">
		<input type="hidden" name="icsi_medicine_old_id[]">
		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="medicine_name" class="form-control">MEDICIN NAME :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
				 {{ Form::text('medicine_name[]', null, array('class'=> 'form-control')) }}  
				 </div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="time" class="form-control">Time :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('time[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="batch_number" class="form-control">Batch No. :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('batch_number[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>


		
		<div class="col-md-2">
			<div class="form-group labelgrp">
				<label style="text-align: left;" for="expiry_date" class="form-control">Exp Date :</label>
			</div>
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('expiry_date[]', null, array('class'=> 'form-control datepicker')) }}                            
				</div>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>

<div class="col-md-12">
	<span class="btn btn-info" id="add_more_icsi_medicine">Add More</span>
</div>

<script>
	$('#add_more_icsi_medicine').click(function() {

		//alert('hi');
		let item = $('#hidden_icsi_medicine').clone();

		$('#append_data_2').append(item.html());

		

		$( "#append_data_2 .item-row:last-child" ).find('.datepicker').bootstrapMaterialDatePicker({
			format: 'YYYY-MM-DD',
			clearButton: true,
			weekStart: 1,
			time: false
		});
	});

	$(document).on('click', '#append_data_2 .icsi-medicine-remove', function(e) {
		$(this).closest('.item-row').remove();
	});
</script>

<div style="display:none;" id="hidden_icsi_medicine">
	<div class="row item-row">
		<input type="hidden" name="icsi_medicine_old_id[]">
		<div class="col-md-3">
			
			<div class="form-group">
				<div class="form-line">
				 {{ Form::text('medicine_name[]', null, array('class'=> 'form-control')) }}  
				 </div>
			</div>
		</div>

		<div class="col-md-3">
			
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('time[]', null, array('class'=> 'form-control ')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-3">
			
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('batch_number[]', null, array('class'=> 'form-control')) }}                            
				</div>
			</div>
		</div>


		
		<div class="col-md-2">
			
			<div class="form-group">
				<div class="form-line">
					 {{ Form::text('expiry_date[]', null, array('class'=> 'form-control datepicker')) }}                            
				</div>
			</div>
		</div>

		<div class="col-md-1">
			<span class="btn btn-danger icsi-medicine-remove" >remove</span>
		</div>
	</div>
</div>


