<div class="col-md-12">
<table style="width:100%;" style="border:1px solid;" id="menses_table">
<tr style="border:1px solid;">
	<th style="width:90px;">Date</th>
	<th style="width:90px;">DAY OF MENSES</th>
	<th style="width:90px;">DAY OF TABLET</th>
	<th style="width:90px;">ET</th>
	<th>DOSES
		<div class="doses-row">
			<span style="width:100px;display: inline-block;">Medicine</span>
			<span style="width:100px;display: inline-block;">Duration</span>
			<span style="width:100px;display: inline-block;">Time</span>
			<span></span>
		</div>
	</th>
	<th>NOTES</th>
	<th  style="width:30px;"></th>
</tr>
@php
	$parent_tr_id_key = "1";
@endphp
@foreach($ivf_menses_data as $ivf_od_menses_row)
<input type="hidden" name="od_menses_all_old_ids[]" value="{{$ivf_od_menses_row->id}}">

	@include('ivf.elements.od_menses_update_tr', ['ivf_od_menses_row' => $ivf_od_menses_row, 'ivf_menses_dosage_data' => $ivf_menses_dosage_data, 'od_menses_old_id' => $ivf_od_menses_row->id])
	
	@php
		$parent_tr_id_key = 1 + $ivf_od_menses_row->id;
	@endphp
@endforeach

@include('ivf.elements.od_menses_tr', ['parent_tr_id_key' => $parent_tr_id_key])

</table>

@php $hidden = 'hidden_' @endphp
<div id="od_menses_doses_row_hidden" style="display:none;">
	@include('ivf.elements.od_menses_doses_row', ['parent_tr_id_key' => '1'])
</div>

<table id="od_menses_tr_hidden" style="display:none;">
@include('ivf.elements.od_menses_tr', ['parent_tr_id_key' => '1'])
</table>

<script>
$(document).on('click', '.od-menses-remove', function(e) {
		$(this).closest('.od-menses-row').remove();
	});


$(document).on('click', '.od-menses-doses-add-more', function(e) {

	let od_menses_doses_element = $('#od_menses_doses_row_hidden').clone();

	var htm_to_append = od_menses_doses_element.html();

	let tr_id = $(this).data('tr_id');

	//alert(tr_id);
	
	htm_to_append = htm_to_append.replace("hidden_medicine[1][]", "medicine["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_duration[1][]", "duration["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_time[1][]", "time["+tr_id+"][]");

	htm_to_append = htm_to_append.replace('data-tr_id="1"', 'data-tr_id="'+tr_id+'"');

	$(this).closest('.doses-medicine-container').append(htm_to_append);
});

$(document).on('click', '.od-menses-tr-add-more', function(e) {

	let od_menses_tr_element = $('#od_menses_tr_hidden tbody').clone();

	var htm_to_append = od_menses_tr_element.html();
	
	//alert($(this).data('parent_tr_id'));

	let tr_id = 1 + $(this).data('parent_tr_id');

	//alert(tr_id);
	
	htm_to_append = htm_to_append.replace("hidden_menses_injection_date[1][]", "menses_injection_date["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_menses_day[1][]", "menses_day["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_menses_tablet_day[1][]", "menses_tablet_day["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_menses_et[1][]", "menses_et["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_notes[1][]", "notes["+tr_id+"][]");
	htm_to_append = htm_to_append.replace('data-parent_tr_id="1"', 'data-parent_tr_id="'+tr_id+'"');


	htm_to_append = htm_to_append.replace('data-tr_id="1"', 'data-tr_id="'+tr_id+'"');
	htm_to_append = htm_to_append.replace("hidden_medicine[1][]", "medicine["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_duration[1][]", "duration["+tr_id+"][]");
	htm_to_append = htm_to_append.replace("hidden_time[1][]", "time["+tr_id+"][]");

	

	$('#menses_table tbody').append(htm_to_append);

	
	$('#menses_table .od-menses-row:last-child .datepicker').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD',
		clearButton: true,
		weekStart: 1,
		time: false
	});
});

$(document).on('click', '.od-menses-doses-remove', function(e) {
	$(this).closest('.doses-medicine-row').remove();
});

$(document).on('click', '.od-menses-tr-remove', function(e) {
	$(this).closest('.od-menses-row').remove();
});

function isEmpty( el ){
      return !$.trim(el.html())
  }
</script>
</div>