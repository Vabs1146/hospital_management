@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }
     tfoot  {
    text-align: right;
}

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($permissions); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
<div class="container-fluid">
  <div class="list-group list-group-horizontal">
        @forelse ($model['DateWiseRecordLst'] as $VisitListDateWise)
                @if($model['case_master']['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/bill_details').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/bill_details').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                    <div class="card">
                    <form action="{{ url('/bill_details'.( isset($model) ? "/" . $model['case_master']['id'] : "")) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    @if (isset($model['case_master']['id']) && !empty($model['case_master']['id']))
                            <input type="hidden" name="_method" value="PATCH">
                    @endif
                         <div class="header bg-pink">
                            <h2>
                               Add/Edit Bill Detail
							    @if($balance_amount > 0)
							   <span id="balance_amount" style="float:right;font-weight: bold;color: yellow;font-size: 15px;">Balance Amount : Rs. {{$balance_amount}}</span>
							   @endif
							   
<div style="float: right;">
<input data-case_id="{{$model['case_master']['id']}}" data-type="patient_billing" {{(isset($patient_activity->status) && $patient_activity->status == "In") ? 'checked' : ''}} style="width: 20px;height: 20px;opacity: 1;left: auto;position: relative;top: 5px;" class="patient-ativity" type="radio" name="patient_billing_state" value="In">&nbsp;IN&nbsp;&nbsp;&nbsp;
<input data-case_id="{{$model['case_master']['id']}}" data-type="patient_billing" {{(isset($patient_activity->status) && $patient_activity->status == "Out") ? 'checked' : ''}} style="width: 20px;height: 20px;opacity: 1;left: auto;position: relative;top: 5px;" class="patient-ativity" type="radio" name="patient_billing_state" value="Out">&nbsp;Out
</div>
                            </h2>
                          
                        </div>
                         
                        <div class="body">
                            <div class="row clearfix">
                               <input type="hidden" name="id" id="id" class="form-control" value="{{$model['case_master']['id'] or ''}}" readonly="readonly">   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Case Number :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" value="{{$model['case_master']['case_number'] or ''}}"  readonly="readonly">                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Patient Name :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_name" id="patient_name" class="form-control"  readonly='readonly' value="{{ $model['case_master']['mr_mrs_ms'] .' '. $model['case_master']['patient_name'] .' '. $model['case_master']['middle_name'] .' '. $model['case_master']['last_name']}}">
                              </div>
                              </div>
                              </div>

								<div class="col-md-2">
								<div class="form-group labelgrp">
								<label for="case_number">Bill Number :</label>
								</div>
								</div>


								<div class="col-md-4">
								<div class="form-group">
								<div class="form-line">
								<input readonly type="text" name="" id="bill_number" class="form-control"   value="{{ $model['case_master']['bill_number'] or ''}}">                            
								</div>
								</div>
								</div>

								<div class="col-md-2">
								<div class="form-group labelgrp">
								<label for="case_number">Bill Date :</label>
								</div>
								</div>


								<div class="col-md-4">
								<div class="form-group">
								<div class="form-line">
								<input type="text" name="bill_date" id="bill_date" class="form-control datepicker"   value="{{ $model['case_master']['bill_date'] or ''}}">                            
								</div>
								</div>
								</div>


                              <!-- <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Payment Mode :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="payment_mode" id="payment_mode" class="form-control"   value="{{ $model['case_master']['payment_mode'] or ''}}">                            
                              </div>
                              </div>
                              </div> -->
                              <div class="form-group">
                                 <div class="col-sm-offset-3 col-sm-6">
                                      <div class="form-group-row">
                                          <div class="col-sm-6">
                                          </div>
                                          <div class="col-sm-3">                
                                          </div>
                                          <div class="col-sm-3">
                                          </div>
                                      </div>
                                 </div>
                              </div>
                              <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
								<td>    
                                    <label for="bill_item" class="control-label">Doctor</label><br>
                                    <!-- <select class="form-control select2" name="doctor_id" id="doctor_id" autocomplete="off">
                                    									<option value="0">Select Doctor</option>
                                        @foreach ($doctors as $doctors_row)
                                    											<option value="{{ $doctors_row->id }}"> {{ $doctors_row->doctor_name }} </option>
                                    										@endforeach
                                    									</select> -->

																		@php
foreach ($doctors as $doctors_row) {
	if($doctors_row->id == $model['case_master']['doctor_id']) {
		$opd_doctor_name = $doctors_row->doctor_name;
	}
}
@endphp

									<input type="hidden" name="doctor_id" value="{{ $model['case_master']['doctor_id']}}"> 

									<input type="text" class="form-control" value="{{$opd_doctor_name}}" disabled>  
                                </td>
                                <td>    
                                    <label for="bill_item" class="control-label">Fees Details</label><br>
									<select class="form-control select2" name="bill_item" id="bill_item" autocomplete="off">
										<option value="0" >Select Fees Detail</option>
										@foreach($doctor_fees_details as $fees_details_row)
<option value="{{$fees_details_row->id}}" >{{$fees_details_row->fees_details}}</option>
										@endforeach
									</select> 
                                </td>
                                <td>
                                    <label for="bill_Amount" class="control-label">Bill Amount</label><br>
                                    <input type="number" step="0.01" name="bill_Amount" id="bill_Amount" class="form-control" value="{{$model['bill_Amount'] or ''}}">                            
                                </td>

                                <!-- <td>
                                    <label for="payment_mode" class="control-label">Payment Mode</label>
                                    <select class="form-control select2" name="payment_mode" id="payment_mode" required>
                                       <option value="0">Select Payment Mode</option>
                                     @foreach ($payment_modes as $payment_modes_row)
                                										<?php 
                                										$selected = "";
                                											//$selected = ($doctorCharge->procedure_id == $procedure->id)?"selected='selected'":"";
                                										 ?>
                                											<option value="{{ $payment_modes_row->id }}" {{ $selected }}
                                												 >
                                													{{ $payment_modes_row->name }}
                                											</option>
                                										@endforeach
                                    
                                    </select>                            
                                </td> -->
                                <td> 
                                    <label for="Item_Add" class="control-label">&nbsp;</label>
                                    <button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>                      
                                 </td>
                            </tr>
                            @if(null !== old('bill_data',$model['bill_data']) && count(old('bill_data',$model['bill_data']))> 0 )
                                @foreach(old('bill_data',$model['bill_data']) as $billdata) 
                                    <tr>
										<td> {{ $doctor_array[$billdata->doctor_id] }} </td>
                                        <td> {{ isset($fees_details_array[$billdata->bill_item]) ? $fees_details_array[$billdata->bill_item] : '' }} </td>
                                        <td> {{ $billdata->bill_Amount }} </td>
                                        
                                        <td> 
										@if($permissions['1_bill_details']->delete_permission || AUTH::user()->role == 1)
										{{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} 
										@endif
										</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td align="right"> <label for="sub_total" class="control-label">Sub Total</label>  </td>
										<td>  </td>
                                        <td> 
                                            <?php $itemsum = 0; 
                                                  $itemsum = $model['bill_data']->sum('bill_Amount') 
                                            ?>
                                            <input type="number" name="sub_total" id="sub_total" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                        </td>
                                        
										<td>  </td>
										<td>  </td>
                                    </tr>

									<tr>
                                        <td align="right"> <label for="bill_discount" class="control-label">Discount</label>  </td>
										<td>  </td>
                                        <td>
                                            <input type="number" name="bill_discount" id="bill_discount" class="form-control" value="{{$model['case_master']['bill_discount'] or ''}}"> 
                                        </td>
                                        
										<td>  </td>
										<td>  </td>
                                    </tr>

									<tr>
                                        <td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
										<td>  </td>
                                        <td> 
                                            <?php $itemsum = 0; 
                                                  $itemsum = $model['bill_data']->sum('bill_Amount');

												  $discount = (isset($model['case_master']['bill_discount']) && $model['case_master']['bill_discount'] != "") ? $model['case_master']['bill_discount'] : 0;

												  $total_amount = $itemsum - $discount;
                                            ?>
                                            <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $total_amount }}"  readonly="readonly"> 
                                        </td>
                                        
										<td>  </td>
										<td>  </td>
                                    </tr>

									<!-- <tr>
									                                        <td align="right"> <label for="paidAmount" class="control-label">Paid Amount</label>  </td>
										<td>  </td>
									                                        <td>
									                                            <input type="number" name="paidAmount" id="paidAmount" class="form-control" value="{{$model['case_master']['paidAmount'] or ''}}"> 
									                                        </td>
									                                        
										<td>  </td>
										<td>  </td>
									                                    </tr> -->

	 <tr>
								<td>    
                                    <label for="bill_item" class="control-label">Date</label><br>
									<input  class="form-control datepicker" type="text" name="payment_date" value="">
                                </td>
                                <td>
                                    <label for="payment_mode" class="control-label">Payment Mode</label><br>
                                    <select class="form-control select2" name="payment_mode" id="payment_mode" required>
                                       <option value="0">Select Payment Mode</option>
                                     @foreach ($payment_modes as $payment_modes_row)
											<?php 
											$selected = "";
												//$selected = ($doctorCharge->procedure_id == $procedure->id)?"selected='selected'":"";
											 ?>
												<option value="{{ $payment_modes_row->id }}" {{ $selected }}
													 >
														{{ $payment_modes_row->name }}
												</option>
											@endforeach
                                    
                                    </select>                            
                                </td>
                                <td>
                                    <label for="payment_Amount" class="control-label">Payment Amount</label><br>
                                    <input type="number" step="0.01" name="payment_Amount" id="payment_Amount" class="form-control" value="">                            
                                </td>

                               
                                <td> 
                                    <label for="Payment_Add" class="control-label">&nbsp;</label>
                                    <button class="btn btn-success form-control" name="Payment_Add" value="Payment_Add" type="submit"> <i class="fa fa-plus"></i> Pay</button>                      
                                 </td>
                            </tr>

	@foreach($payment_details as $payment_details_row)
<tr>
	<td>    
	{{date('d F, Y', strtotime($payment_details_row->payment_date))}}
	</td>
	<td>
		{{$payment_modes_array[$payment_details_row->payment_mode]}}                      
	</td>
	<td>
		{{$payment_details_row->paid_Amount}}                            
	</td>

   
	<td> 
	@if($permissions['1_bill_details']->delete_permission || AUTH::user()->role == 1)
	{{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $payment_details_row->id, 'name' => 'delete_payment_item', 'type'=>'submit')) }} 
	@endif
	</td>
</tr>
	@endforeach

	@if(floatval($total_paid) > 0) 
	<tr>
		<td>    
		
		</td>
		<td>
			<label for="bill_discount" class="control-label">Total Paid</label>
			                 
		</td>
		<td>
			Rs. {{$total_paid}}                            
		</td>

	   
		<td> 
				 
		 </td>
	</tr>
	<tr>
		<td>    
		
		</td>
		<td>
			<label for="bill_discount" class="control-label">Balance</label>
			                   
		</td>
		<td>
			Rs. {{$total_amount - $total_paid}}                            
		</td>

	   
		<td> 
				 
		 </td>
	</tr>
	@endif


                                    <!--  <tr>
                                        <td > <label for="totalAmount" class="control-label">Payment Way</label>  </td>
                                        <td> 
         <input type="number" name="payment_mode" id="payment_mode" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                          
                                            
                                        </td>
                                        <td>  </td>

                                     
                                    </tr> -->

                            @endif
                        </table>
                    </div>
                </div>

                <div class="form-group">
                {{-- <label for="totalAmount" class="col-sm-3 control-label">Final Bill</label> --}}
                <div class="col-sm-6">
                    <?php 

                      $billamount = isset($itemsum) && $itemsum > 0 ? floatval($itemsum - floatval($model['case_master']['paidAmount'])) : 0;
                      $billamount = $billamount > 0 ? ($billamount += $billamount*(floatval($model['case_master']['tax_percentage'])/100)) : $billamount;
                    ?>
                    {{-- <input type="number" name="tax_percentage" id="tax_percentage" class="form-control"  value="{{ $billamount }}" readonly="readonly" > --}}
                </div>
            </div>   
            <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="save_bill" id="save_bill"  value="save_bill" class="btn btn-success btn-lg">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <button type="submit" name="save_print_bill" id="save_print_bill" value="save_print_bill" class="btn btn-success btn-lg">
                        Save Print
                    </button> 
                    <a class="btn btn-default btn-lg" href="{{ url('/bill_details') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>

                            </div>

                        </div>
                     </form>
                    </div>
                </div>
            </div>


</div>


 @endsection


@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){

       $(".select2").select2();

     theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                 
                "ajax": "{{url('patientbill/report/grid')}}/",//+docid,
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": true,
                        "searchable": false,
                        "class":"never"
                    }
                ],
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                 drawCallback: function () {
      var api = this.api();
      $( api.table().footer() ).html("<th></th><th></th><th></th><th></th><th></th><th>Total "+
        api.column( 5, {page:'current'} ).data().sum()+"</th>"
      );
    }
                
        
            });

      // $.ajax({
      //           url:"{{url('patientbill/gettotal')}}",//+docid,
      //           method:"get",
              
      //       success:function(response) {

      //        var Total=response;
      //        $("#total").append(Total);
      // //  alert(Total);

      //         }
      //     }); 

        // });

             
           

            $('.datepicker').datepicker({
                format: "yyyy/mm/dd",
                weekStart: 1,
                clearBtn: true,
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient(){
         
         if($('#doctor_id').val() != ""){
           theGrid.column(1).search(
                $('#doctor_id').val()
            ).draw();
         }

         if($('#fromDate').val() != ""){
           theGrid.column(2).search(
                $('#fromDate').val()
            ).draw();
         }         
         if($('#ToDate').val() != ""){
           theGrid.column(3).search(
                $('#ToDate').val()
            ).draw();
         }
         if($('#doctor_id').val() == "" && $('#fromDate').val() == "" && $('#ToDate').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }


	$('#doctor_id').on('change', function() {
		var doctor_id = $(this).val();
		if(doctor_id != 0) {
			//alert(doctor_id);

			$.ajax({
				url:"{{url('bill_details/get_fees_details')}}/"+doctor_id,
				method:"get",
				datatype:'html',

				success:function(response) {
					$('#bill_item').html(response);
					//alert(response);
				}
			}); 
		}
	});

	$('#bill_item').on('change', function() {
		var bill_item_id = $(this).val();
		if(bill_item_id != 0) {
			//alert(bill_item_id);

			$.ajax({
				url:"{{url('bill_details/get_fees')}}/"+bill_item_id,
				method:"get",
				datatype:'html',

				success:function(response) {
					$('#bill_Amount').val(response);
					//alert(response);
				}
			}); 
		}
	});


	
    </script>
@endsection