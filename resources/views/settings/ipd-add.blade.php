@extends('adminlayouts.master')
@section('content')
@section('content')
@php $permissions = session('permissions');
	//echo "====1111111===>>> <pre>"; print_r($all_settings); exit;

	//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
<div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@include('shared.error')
			@if(Session::has('flash_message'))
				<div class="alert alert-success">
					{{ Session::get('flash_message') }}
				</div>
			@endif
			<div class="card">
				<form action="{{ url('/ipd-settings') }}" method="POST" class="form-horizontal"
					enctype="multipart/form-data">
					{{ csrf_field() }}

					@if (isset($model))
						<input type="hidden" name="_method" value="PATCH">
					@endif
					<div class="header bg-pink">
						<h2>Add/Modify Settings</h2>
					</div>


					<div class="body">
						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Hospital Name :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_hospital_name" id="ipd_hospital_name"
											class="form-control" value="{{$all_settings['ipd_hospital_name']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_hospital_name" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Advance Receipt Number :</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_advance_receipt_number"
											id="ipd_advance_receipt_number" class="form-control"
											value="{{$all_settings['ipd_advance_receipt_number']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_advance_receipt_number" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Payment Receipt Number :</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_payment_receipt_number"
											id="ipd_payment_receipt_number" class="form-control"
											value="{{$all_settings['ipd_payment_receipt_number']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_payment_receipt_number" value="Update">
									</div>
								</div>
							@endif
						</div>



						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Bill Prefix :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_ipd_bill_prefix" id="ipd_ipd_bill_prefix"
											class="form-control"
											value="{{$all_settings['ipd_ipd_bill_prefix']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_ipd_bill_prefix" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Bill Number :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_ipd_bill_number" id="ipd_ipd_bill_number"
											class="form-control"
											value="{{$all_settings['ipd_ipd_bill_number']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_ipd_bill_number" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Summary Bill Prefix :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_summary_bill_prefix" id="ipd_summary_bill_prefix"
											class="form-control"
											value="{{$all_settings['ipd_summary_bill_prefix']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_summary_bill_prefix" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Summary Bill Number :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_summary_bill_number" id="ipd_summary_bill_number"
											class="form-control"
											value="{{$all_settings['ipd_summary_bill_number']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_summary_bill_number" value="Update">
									</div>
								</div>
							@endif
						</div>



						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">UHID Prefix :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_uhid_prefix" id="ipd_uhid_prefix"
											class="form-control" value="{{$all_settings['ipd_uhid_prefix']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_uhid_prefix" value="Update">
									</div>
								</div>
							@endif
						</div>
						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">UHID Number :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_uhid_number" id="ipd_uhid_number"
											class="form-control" value="{{$all_settings['ipd_uhid_number']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_uhid_number" value="Update">
									</div>
								</div>
							@endif
						</div>


						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Prefix :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_ipd_prefix" id="ipd_ipd_prefix"
											class="form-control" value="{{$all_settings['ipd_ipd_prefix']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_ipd_prefix" value="Update">
									</div>
								</div>
							@endif
						</div>
						<div class="row clearfix ">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Number :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_ipd_number" id="ipd_ipd_number"
											class="form-control" value="{{$all_settings['ipd_ipd_number']->value}}">
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_ipd_number" value="Update">
									</div>
								</div>
							@endif
						</div>


						<!-- ================================== Payment Mode ================================================ -->
						<div class="row clearfix parent-add-container">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Payment Modes :</label>
								</div>
							</div>
							<div class="col-md-4 add-container">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_payment_mode[]" id="ipd_payment_mode[]"
											class="form-control" value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<div class="">
										<a data-name="ipd_payment_mode" class="add-more btn btn-info"
											href="javascript:void(0)">Add More</a>
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_payment_mode" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix parent-add-container">
							<div class="col-md-12">
								@foreach($payment_modes as $payment_mode)
									<div class="col-md-2 remove-block">
										<input type="hidden" name="old_payment_modes[]" value="{{$payment_mode->id}}">
										<div class="form-line">
											<input readonly type="text" name="" id="" class="form-control"
												value="{{$payment_mode->name}}" style="width: 80%; display: inline;">

											<a class="remove-data" href="javascript:void(0)">x</a>
										</div>

									</div>
								@endforeach
							</div>
						</div>
						<!-- ================================== IPD Doctors ================================================ -->
						<div class="row clearfix parent-add-container">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">IPD Doctors :</label>
								</div>
							</div>
							<div class="col-md-4 add-container">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_doctor[]" id="ipd_doctor[]" class="form-control"
											value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<div class="">
										<a data-name="ipd_doctor" class="add-more btn btn-info"
											href="javascript:void(0)">Add More</a>
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_doctor" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix parent-add-container">
							<div class="col-md-12">
								@foreach($ipd_doctors as $ipd_doctor)
									<div class="col-md-2 remove-block">
										<input type="hidden" name="old_ipd_doctors[]" value="{{$ipd_doctor->id}}">
										<div class="form-line">
											<input readonly type="text" name="" id="" class="form-control"
												value="{{$ipd_doctor->name}}" style="width: 80%; display: inline;">

											<a class="remove-data" href="javascript:void(0)">x</a>
										</div>

									</div>
								@endforeach
							</div>
						</div>
						<!-- ================================== Ward Type================================================ -->

						<div class="row clearfix parent-add-container">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Ward Type :</label>
								</div>
							</div>
							<div class="col-md-4 add-container">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_ward_type[]" id="ipd_ward_type[]"
											class="form-control" value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<div class="">
										<a data-name="ipd_ward_type" class="add-more btn btn-info"
											href="javascript:void(0)">Add More</a>
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_ward_type" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix parent-add-container">
							<div class="col-md-12">
								@foreach($ipd_ward_types as $ipd_ward_type)
									<div class="col-md-2 remove-block">
										<input type="hidden" name="old_ipd_ward_types[]" value="{{$ipd_ward_type->id}}">
										<div class="form-line">
											<input readonly type="text" name="" id="" class="form-control"
												value="{{$ipd_ward_type->name}}" style="width: 80%; display: inline;">

											<a class="remove-data" href="javascript:void(0)">x</a>
										</div>

									</div>
								@endforeach
							</div>
						</div>

						<!-- ================================== Bed Number================================================ -->

						<div class="row clearfix parent-add-container">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Bed Number :</label>
								</div>
							</div>
							<div class="col-md-4 add-container">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_bed_number[]" id="ipd_bed_number[]"
											class="form-control" value="">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<div class="">
										<a data-name="ipd_bed_number" class="add-more btn btn-info"
											href="javascript:void(0)">Add More</a>
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_bed_number" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix parent-add-container">
							<div class="col-md-12">
								@foreach($ipd_bed_numbers as $ipd_bed_number)
									<div class="col-md-2 remove-block">
										<input type="hidden" name="old_ipd_bed_numbers[]" value="{{$ipd_bed_number->id}}">
										<div class="form-line">
											<input readonly type="text" name="" id="" class="form-control"
												value="{{$ipd_bed_number->name}}" style="width: 80%; display: inline;">

											<a class="remove-data" href="javascript:void(0)">x</a>
										</div>

									</div>
								@endforeach
							</div>
						</div>


						<!-- ================================== Particulars================================================ -->
						<div class="row clearfix parent-add-container">
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Particulars :</label>
								</div>
							</div>
							<div class="col-md-4 add-container">
								<select class="form-control" name="main_category" id="main_particular_category">
									<option value="0">Select Main Category</option>
									@foreach($ipd_particulars as $parent_id => $ipd_particular)
										<option value="{{$parent_id}}">{{$ipd_particular['name']}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<div class="">
										<!-- <a data-name="ipd_particulars" class="add-more btn btn-info" href="javascript:void(0)">Add More</a> -->
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">
										<input type="submit" name="update_ipd_particulars" value="Update">
									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix parent-add-container">
							<!-- <div class="col-md-4">
		<div class="form-group labelgrp">
			<label class="form-control"> </label>
		</div>
	</div> -->
							<div class="col-md-4 add-container">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_particulars[]" id="ipd_particulars[]"
											class="form-control" value="" placeholder="Particular">
									</div>
								</div>
							</div>
							<div class="col-md-4 add-container-amount" style="visibility:hidden">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="ipd_particulars_amount[]" id="ipd_particulars_amount[]"
											class="form-control ipd_particulars_amount" value="" placeholder="Amount">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<div class="">
										<a data-name="ipd_particulars" class="add-more btn btn-info"
											href="javascript:void(0)">Add More</a>
									</div>
								</div>
							</div>
							@if($permissions['11_ipd-settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
									<div class="form-group labelgrp">

									</div>
								</div>
							@endif
						</div>

						<div class="row clearfix parent-add-container">
							<div class="col-md-12">
								<table>
									<tr>
										<th>Main Category</th>
										<th>Sub Category</th>
									</tr>
									@foreach($ipd_particulars as $parent_id => $ipd_particular)
										<tr>
											<td style="width: 200px;">
												<div class="remove-block">
													<input type="hidden" name="old_ipd_particulars[]"
														value="{{$parent_id}}">
													<div class="form-line">
														<input readonly type="text" name="" id="" class="form-control"
															value="{{$ipd_particular['name']}}"
															style="width: 80%; display: inline;">

														<a class="remove-data" href="javascript:void(0)">x</a>
													</div>
												</div>
											</td>
											<td>
												@if(isset($ipd_particulars[$parent_id]['childs']))
													@foreach($ipd_particulars[$parent_id]['childs'] as $subcategories)
														<!-- <div style="width: 400px; float:left;" class="remove-block" > -->

														<div style="display:flex" class="row remove-block">
															<div class="col-md-5">
																<input type="hidden" name="old_ipd_particulars[]"
																	value="{{$subcategories['id']}}">
																<!-- <div class="form-line"> -->
																<input readonly type="text" name="" id=""
																	class=" form-line form-control"
																	value="{{$subcategories['name']}}" style=" ">
															</div>
															<!-- <a class="remove-data" href="javascript:void(0)">x</a> -->
															<!-- </div>
																										<div class="form-line"> -->

															<div class="col-md-5">
																<input type="text" name="" id="{{$subcategories['id']}}_value"
																	class="form-line form-control"
																	value="{{$subcategories['amount']}}" style=" ">

															</div>
															<div class="col-md-2">
																<a class="remove-data" href="javascript:void(0)">x</a>
																<button type="button" class="btn btn-primary update_data" id=""
																	value="{{$subcategories['id']}}">Update</button>
															</div>
															<!-- </div> -->
														</div>
													@endforeach
												@endif
											</td>
										</tr>
									@endforeach
								</table>
							</div>
						</div>

						<!-- ================================================================== -->

					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script>
	$('.update_data').click(function () {
		var id = $(this).attr('value');
		var value = $("#" + id + "_value").val();
		$.ajax({
			method:"POST",
			url: "{{url('/update_ipd_perticulars')}}",
			datatype: "JSON",
			data:{
				"id":id,
				"value":value
			},
			success: function (data) {
				location.reload();
			}
		});
	});
	$('#main_particular_category').change(function () {
		//alert($(this).val());
		if ($(this).val() > 0) {
			$('.add-container-amount').css('visibility', 'unset');
		} else {
			$('.add-container-amount').css('visibility', 'hidden');
		}
	});
	$('.add-more').click(function () {
		let input_element_name = $(this).data('name');

		//alert(input_element_name);

		let input_element = '<div class="form-group"> <div class="form-line"> <input type="text" name="' + input_element_name + '[]" id="' + input_element_name + '[]" class="form-control" value=""  placeholder="Particular"> </div> </div>';

		if (input_element_name == 'ipd_particulars') {

			let input_amount_element = '<div class="form-group"> <div class="form-line"> <input type="text" name="ipd_particulars_amount[]" id="' + input_element_name + '[]" class="form-control" value="" placeholder="Amount"> </div> </div>';

			//input_amount_element += '<input type="text" name="ipd_particulars_amount[]" id="ipd_particulars_amount[]" class="form-control" value="" placeholder="Amount">';

			$(this).closest('.parent-add-container').find('.add-container-amount').append(input_amount_element);
		}

		$(this).closest('.parent-add-container').find('.add-container').append(input_element);

	});


	$('.remove-data').click(function () {
		$(this).closest('.remove-block').remove();
	});
</script>
@endsection