<div style="display:none">
    <div id="FrequencyTemplate">
		<span class="frequency_row">
       
		<div class="col-md-12 dropdown-container">
			<div class="col-md-1"> Frequency </div>

			<div class="col-md-4">
				{{ Form::select('name_numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), null, array('class' => 'form-control Dyselect2','data-live-search'=>'true')) }}
			</div> 
			
			<div class="col-md-1 date-from"> From </div>
			<div class="col-md-2">
				{{ Form::text('name_from', null, array('class'=> 'form-control datepicker2', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>
			<div class="col-md-1"> To </div>
			<div class="col-md-2">
			{{ Form::text('name_to', null, array('class'=> 'form-control datepicker2', 'autocomplete'=>'off', 'data-date-format' => "yyyy-mm-dd")) }}
			</div>
			
			<div class="col-md-1">
				<button class="removeFrequencyRow btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
			</div>
		</div>
		
		<span>
    </div>
 </div>
 
 <script>
 $(document).on('click', '.addFrequency', function(e) {
		//alert('hiiii');
	e.preventDefault();
	var template = $("#FrequencyTemplate").clone();
	
	//console.log($(template).html());
	
	//$(template).find('.hiddenCounter').val(($(this).closest('div.ContainerToAppend').find('div.form-group.row').length + 1));
	/*
	$('#frequencyContainerToAppend').append($(template).html());
	$('#frequencyContainerToAppend').find('.Dyselect2').select2({width: '100%'});
	$('#frequencyContainerToAppend').find('.datepicker2').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });
	*/
	//alert($(this).data('key'));
	
	var template_key = $(this).data('key');
	var htm_to_append = $(template).html();
	if (typeof template_key !== 'undefined') {
		/*
		htm_to_append = htm_to_append.replace("to[]", "to["+template_key+"][]");
		htm_to_append = htm_to_append.replace("from[]", "from["+template_key+"][]");
		htm_to_append = htm_to_append.replace("numberoftimes[]", "numberoftimes["+template_key+"][]");
		*/
		
		
		htm_to_append = htm_to_append.replace("name_to", "to["+template_key+"][]");
		htm_to_append = htm_to_append.replace("name_from", "from["+template_key+"][]");
		htm_to_append = htm_to_append.replace("name_numberoftimes", "numberoftimes["+template_key+"][]");
	} else {
		htm_to_append = htm_to_append.replace("name_to", "to[]");
		htm_to_append = htm_to_append.replace("name_from", "from[]");
		htm_to_append = htm_to_append.replace("name_numberoftimes", "numberoftimes[]");
	}
	// $(this).closest('.frequencyContainerToAppend').append($(template).html());
	console.log(htm_to_append);
	 $(this).closest('.frequencyContainerToAppend').append(htm_to_append);
	 $(this).closest('.frequencyContainerToAppend').find('.Dyselect2').select2({width: '100%'});
	 $(this).closest('.frequencyContainerToAppend').find('.datepicker2').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 1,
        time: false
    });
	
});

$(document).on('click', '.removeFrequencyRow' ,function(e){
  e.preventDefault();
  $(this).closest('.frequency_row').remove();
  return false;
});
 </script>