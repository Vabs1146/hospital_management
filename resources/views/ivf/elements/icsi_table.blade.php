<div class="col-md-12">
<table style="width:100%;" style="border:1px solid;">
<tr style="border:1px solid;">
	<th>Date</th>
	<th>DAY OF MENSES</th>
	<th>DAY OF INJECTION</th>
	<th>TIME OF INJECTION</th>
	<th>INJ FOLISURGE 150</th>
	<th>INJ HMG 150 </th>
	<th>INJ CETRORELIX 150</th>
	<th></th>
</tr>

@foreach($ivf_icsi_menses as $ivf_icsi_menses_row)
<input type="hidden" name="icsi_menses_all_old_id[]" value="{{$ivf_icsi_menses_row->id}}">
<tr style="border:1px solid;" class="menses-row">
	<input type="hidden" name="icsi_menses_old_id[]" value="{{$ivf_icsi_menses_row->id}}">
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_date[]', $ivf_icsi_menses_row->menses_injection_date, array('class' => 'form-control datepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_day[]', $ivf_icsi_menses_row->menses_day, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_day[]', $ivf_icsi_menses_row->menses_injection_day, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_time[]', $ivf_icsi_menses_row->menses_injection_time, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_inj_folisurge_150[]', $ivf_icsi_menses_row->menses_injection_inj_folisurge_150, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_inj_hmg_150[]', $ivf_icsi_menses_row->menses_injection_inj_hmg_150, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_inj_cetorflix_150[]', $ivf_icsi_menses_row->menses_injection_inj_cetorflix_150, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td><span class="btn btn-danger icsi-menses-remove" >remove</span></td>
</tr>
@endforeach

<tr style="border:1px solid;">
	<input type="hidden" name="icsi_menses_old_id[]" value="">
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_date[]', null, array('class' => 'form-control datepicker')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_day[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_day[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_time[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_inj_folisurge_150[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_inj_hmg_150[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td>
		<div class="form-line">
			{{ Form::text('menses_injection_inj_cetorflix_150[]', null, array('class' => 'form-control')) }}                            
		</div>
	</td>
	<td></td>
</tr>
</table>

<script>
$(document).on('click', '.icsi-menses-remove', function(e) {
		$(this).closest('.menses-row').remove();
	});
</script>
</div>