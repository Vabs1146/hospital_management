
<!-- ========================================== -->
<div class="row clearfix">
	<div class="col-md-12">
	
	<br>
	<div class="table-responsive">
	@if(null !== old('prescriptions',$presDropdowns['prescriptions']) && count(old('prescriptions',$presDropdowns['prescriptions']))> 0 )
		<table class="table">
			<tr>
				<th>
					Medicine
				</th>
				
				<th>
				   Times a Day  
				</th>
				<th>
					Days
				</th>
				<th>
					Quantity   
				</th>
				
				<th>
				   
				</th>
			</tr>
				@foreach(old('prescriptions',$presDropdowns['prescriptions']) as $prescption)
					<tr>   
						<td>
							{{ $prescption->Medical_store->medicine_name }}
						</td>
						
						<td>
						   {{ $prescption->numberoftimes }}
							
						</td>
						<td>
							{{ $prescption->medicine_Quntity }}
						</td>
						<td>
						   {{ $prescption->strength }}
						</td>
						
						
						<td>
							<input type="checkbox" name="medicine_checkbox[{{$identifier}}][]" style="opacity: 1; position:relative; left:auto;" {{ in_array($prescption->id, $medications) ? 'checked' : ''}} value="{{$prescption->id}}">
							
						</td>
					<tr>
				@endforeach
			@endif
		</table>
		</div>
	</div>
</div>
<!-- ========================================== -->