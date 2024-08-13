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

    .canvas {
        position: relative;
        width: 150px;
        height: 200px;
        background-color: #7a7a7a;
        margin: 70px auto 20px auto;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->


<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">

<style>
    /*
        * drawingboards styles: set the board dimensions you want with CSS
        */

    .board {
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }

</style>

@section('content')
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
          <form action="{{ url('/patients_ipd/patientBill'.( empty($patientRegister->id) ? "/0" : ("/" . $patientRegister['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (!empty($patientRegister->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif

         <input type="hidden" id="register_id" name="register_id" value="{{ $patientRegister->id or ''}}" >
         <input type="hidden" id="id" name="id" value="{{ $patientbill->id or ''}}" >


<input type="hidden" name="ipd_bill_number_used" value="{{$initial_data['ipd_bill_number_used']}}">
<input type="hidden" name="ipd_bill_number_format" value="{{$initial_data['ipd_bill_number_format']}}">
<input type="hidden" name="ipd_bill_number_prefix" value="{{$initial_data['ipd_bill_number_prefix']}}">

          <div class="header bg-pink">
          <h2>Ipd Bill</h2>
          </div>
              <div class="body">
                  <div class="row clearfix ">
<div class="col-md-12">
  <div class="col-md-2">
  <div class="form-group labelgrp">
  {{ Form::label('first_name','Patient Name') }}
  </div>
  </div>

  <div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('first_name', Request::old('first_name',$patientRegister->first_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('middle_name', Request::old('middle_name',$patientRegister->middle_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('last_name', Request::old('last_name',$patientRegister->last_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('uhid_number','UHID no.') }}
		</div>
	</div>


	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('uhid_number', Request::old('uhid_number',$patientRegister->uhid_number), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('ipd_no','IPD no.') }}
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('ipd_number', Request::old('ipd_number',$patientRegister->ipd_number), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
			</div>
		</div>
	</div>
</div>


<div class="col-md-12">                           
 

   <div class="col-md-2">
  <div class="form-group labelgrp">
  {{ Form::label('tpa_company','TPA Company') }} 
  </div>
  </div>


  <div class="col-md-4">
  <div class="form-group">
  <div class="form-line">
  {{ Form::text('tpa_company', Request::old('tpa_company',$patientRegister->tpa_company), array('class' => 'form-control', 'autocomplete'=>'off')) }}
  </div>
  </div>
  </div>

  <div class="col-md-2">
  <div class="form-group labelgrp">
 {{ Form::label('insurance_company','Insurance Company') }}
  </div>
  </div>


  <div class="col-md-4">
  <div class="form-group">
  <div class="form-line">
  {{ Form::text('insurance_company', Request::old('insurance_company',$patientRegister->insurance_company), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
  </div>
  </div>
  </div>

</div>
                                 
                                 <!-- One row start -->
                            <div class="col-md-12">                           
                             
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('bill_no','Bill No') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('bill_no', Request::old('bill_no', $initial_data['ipd_bill_number']), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>

							  <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('bill_date','Bill Date') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('bill_date', Request::old('bill_date', isset($patientbill->bill_date) ? date('Y-m-d', strtotime($patientbill->bill_date)) : ''), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>

                            </div>



                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('bill_towards','Bill Towards') }}
                              </div>
                              </div>


                              <div class="col-md-10">
                              <div class="form-group">
							  <div class="form-line">
                              {{ Form::text('bill_towards', Request::old('bill_towards',$patientbill->bill_towards), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
								</div>
                              
								</div>

<div class="col-md-12"> 
	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('ward','Ward') }}   
		</div>
	</div>
@php
//echo "========".$patientbill->ward.">>>>>>".$patientbill->bed.">>>>>> <pre>";  exit;
@endphp
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{-- Form::text('ward', Request::old('ward',$patientbill->ward), array('class' => 'form-control', 'autocomplete'=>'off')) --}}  
				
				<select name="ward" class="form-control">
					<option value="">Select Ward</option>
					@foreach($ipd_ward_types as $ipd_ward_type)
						<option value="{{$ipd_ward_type->id}}" {{ (isset($patientbill->ward) && $patientbill->ward == $ipd_ward_type->id) ? 'selected' : '' }} >{{$ipd_ward_type->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group labelgrp">
			{{ Form::label('bed','Bed') }}   
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{-- Form::text('bed', Request::old('bed',$patientbill->bed), array('class' => 'form-control', 'autocomplete'=>'off')) --}} 
				
				<select name="bed" class="form-control">
					<option value="">Select Bed</option>
					@foreach($ipd_bed_numbers as $ipd_bed_number)
						<option value="{{$ipd_bed_number->id}}" {{ (isset($patientbill->bed) && $patientbill->bed == $ipd_bed_number->id) ? 'selected' : '' }}>{{$ipd_bed_number->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>

                            <div class="col-md-12">                           
                             
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('registration_date','Admit Date') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('admission_date_time', Request::old('admission_date_time', $patientRegister->admission_date_time), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>

							   <div class="col-md-2">
                              <div class="form-group labelgrp">
                               @php
                             $ipdDischarge = $patientRegister->ipdDischarge()->get()->first();
                             if(is_null($ipdDischarge)){
                               $ipdDischarge = new App\Models\IPD\ipdDischarge;
                              }
                          @endphp
                                 {{ Form::label('dod','Discharge Date') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{-- Form::text('dod', Request::old('dod',$ipdDischarge->dod), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) --}}   
							   
							   {{ Form::text('discharge_date_time', Request::old('discharge_date_time',$discharge_data->discharge_date_time), array('class' => 'form-control datetimepicker', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>

                            </div>
                  
                               <div class="col-md-12">                           
                             <!-- <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('registration_time','Admit Time') }}
                              </div>
                              </div>
                             
                             
                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('registration_time', Request::old('registration_time',$patientRegister->registration_time), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div> -->
                              
                              
                            </div>


                            <div class="col-md-12">                           
                             <!-- <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('dodtime','Discharge Time') }}
                              </div>
                              </div>
                             
                             
                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('dodtime', Request::old('dodtime',$ipdDischarge->dodtime), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div> -->
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('advance_amount','Advance Amount') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('advance_amount', Request::old('advance_amount', isset($advance_payment->advance_amount) ? $advance_payment->advance_amount : ''), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>

							  <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('discount_amount','Discount Amount') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('discount_amount', Request::old('discount_amount',$patientbill->discount_amount), array('class' => 'form-control', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>

                            </div>


                            <div class="col-md-12">                           
                             
                              
                            </div>

                            </div>    

                               <div class="row clearfix">
                                <div class="col-md-12">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                                  <i class="fa fa-plus"></i> Save
                                </button>

								<button type="submit" name="submit" class="btn btn-info btn-lg" value="submit_print" >
                                  <i class="fa fa-plus"></i> Save & Print
                                </button>
								{{--
                              <a class="btn btn-default btn-lg" href="{{ url('/patients_ipd/patientBill') }}" ><i class="glyphicon glyphicon-print"></i> Back </a> 
                              <a class="btn btn-default btn-lg" href="{{ url('/register') }}"><i class="glyphicon glyphicon-chevron-left"></i>Patient Register</a>
                              @if (!empty($patientbill->id) && $patientbill->id > 0)
                                  <a class="btn btn-default btn-lg" href="{{ url('/patients_ipd/patientBill/print/') ."/". $patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-print"></i> Print </a>
                                  <a class="btn btn-default btn-lg" href="{{ url('/patients_ipd/patientBill/printReceipt/') ."/". $patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-print"></i> Print Receipt </a>
                              @endif  
							  --}}
                                </div>
                                </div> 
                            </div>

                            <div class="row">
                               @if(!empty($patientbill->id) && $patientbill->id > 0)
                               <div class="col-md-12">
 <!-- ==================Start Particulars==============================  -->                                
                    <div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
<tr class="bill-item-tr">
<td>
<label for="particular" class="control-label">Particular</label>

@php $slected_particular = ""; $billdata_key = ""; @endphp
@include('patients_ipd_patientBill.comman_fields.particular_dropdown')
</td>
<td>
<label for="day" class="control-label">Day</label>
<input type="number" step="0.01" name="day" id="day" class="form-control day" value="{{ $day or ''}}">
</td>
<td>
<label for="rate" class="control-label">Rate</label>
<input type="number" step="0.01" name="rate" id="rate" class="form-control rate" value="{{ $rate or ''}}">
</td>
<td>
<label for="amount" class="control-label">Amount</label> 
<span class="form-control amount" id="amount">  </span> 
</td>
<td>
<label for="Item_Add" class="control-label">&nbsp;</label>
<button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>
</td>
</tr>
@if(null !== old('billItems',$billItems) && count(old('billItems',$billItems))> 0 )
<?php 
$itemsum = 0;
?>
@foreach(old('billItems',$billItems) as $billdata) 
<tr class="bill-item-tr">
<td>  
{{-- isset($ipd_particulars_all[$billdata->particular]) ? $ipd_particulars_all[$billdata->particular] : $billdata->particular --}}

@php $slected_particular = $billdata->particular;  $billdata_key = "_".$billdata->id;  @endphp
@include('patients_ipd_patientBill.comman_fields.particular_dropdown')
</td>
<td> 

<input type="number" step="0.01" name="day{{$billdata_key}}" id="day{{$billdata_key}}" class="form-control day" value="{{ $billdata->day }}"> 
</td>
<td> 

<input type="number" step="0.01" name="rate{{$billdata_key}}" id="rate{{$billdata_key}}" class="form-control rate" value="{{ $billdata->rate }}">
</td>
<td> 
<span class="form-control amount" id="amount{{$billdata_key}}">{{ (is_null($billdata->day)?1:$billdata->day)*$billdata->rate }} </span> 
</td>
<td> 
{{ Form::button('Update', array('class'=> 'btn btn-info btn-lg pull-left', 'Value' => $billdata->id, 'name' => 'update_item', 'type'=>'submit')) }}

{{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} 
</td>
</tr>
@php
$itemsum = $itemsum + ((is_null($billdata->day)?1:$billdata->day)*$billdata->rate);
@endphp
@endforeach
<tr>
	<td>  </td>
	<td>  </td>
	<td align="right"> <label for="totalAmount" class="control-label">Sub Total</label>  </td>
	<td> 
	<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
	</td>
	<td>  </td>
</tr>

@if($advance_payment->advance_amount)
<tr>
	<td>  </td>
	<td>  </td>
	<td align="right"> <label for="totalAmount" class="control-label">Advance Amount</label>  </td>
	<td> 
	<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $advance_payment->advance_amount }}"  readonly="readonly"> 
	</td>
	<td>  </td>
</tr>

@php $itemsum = $itemsum - $advance_payment->advance_amount; @endphp

@endif

@if($patientbill->discount_amount)
<tr>
	<td>  </td>
	<td>  </td>
	<td align="right"> <label for="totalAmount" class="control-label">Discount</label>  </td>
	<td> 
	<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{$patientbill->discount_amount}}"  readonly="readonly"> 
	</td>
	<td>  </td>
</tr>


@php $itemsum = $itemsum - $patientbill->discount_amount; @endphp

@endif

<tr>
	<td>  </td>
	<td>  </td>
	<td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
	<td> 
	<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
	</td>
	<td>  </td>
</tr>
@endif
</table>
                    </div>
<!-- ==================End Particulars==============================  -->

<!-- ==================Start payments==============================  -->
{{--
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover">
	<tr class="bill-item-tr">
		<td>
			<label for="particular" class="control-label">Date & Time</label>

			<input class="form-control datetimepicker" id="payment_date_time" name="payment_date_time" value="{{$payment->date_time or date('Y-m-d - h:i A')}}" type="text">
		</td>
		<td>
			<label for="day" class="control-label">Amount</label>
			{{ Form::text('payment_amount', null, array('class' => 'form-control')) }}  
		</td>
		<td>
			<label for="rate" class="control-label">Payment Mode</label>
			<select name="payment_mode" id="payment_mode" class="form-control select2" placeholder="select payment mode">
				<option value="">Select</option> 
				@foreach($payment_modes_array as $key => $val)
				<option value="{{$key}}" >{{$val}}</option> 
				@endforeach
			</select>
		</td>
		<td>
			<label for="amount" class="control-label">Payment ID No.</label> 
			{{ Form::text('payment_id_number', null, array('class' => 'form-control')) }}  
		</td>
		<td>
			<label for="Item_Add" class="control-label">&nbsp;</label>
			<button class="btn btn-success form-control" name="Payment_Add" value="Payment_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>
		</td>
	</tr>
	@if(count($payment_records) > 0)
	
	@foreach($payment_records as $key => $payment_records_row) 

	@php $total += floatval($payment_records_row->advance_amount); @endphp
	<tr class="bill-item-tr">
		<td>
			<!-- <label for="particular" class="control-label">Date & Time</label> -->

			<input class="form-control datetimepicker" id="payment_date_time{{$payment_records_row->id}}" name="payment_date_time{{$payment_records_row->id}}" value="{{$payment_records_row->date_time or date('Y-m-d - h:i A')}}" type="text">
		</td>
		<td>
			<!-- <label for="day" class="control-label">Amount</label> -->
			{{ Form::text('payment_amount'.$payment_records_row->id, $payment_records_row->advance_amount, array('class' => 'form-control')) }}  
		</td>
		<td>
			<!-- <label for="rate" class="control-label">Payment Mode</label> -->
			<select name="payment_mode{{$payment_records_row->id}}" id="payment_mode{{$payment_records_row->id}}" class="form-control select2" placeholder="select payment mode">
				<option value="">Select</option> 
				@foreach($payment_modes_array as $key => $val)
				<option value="{{$key}}" {{($payment_records_row->payment_mode == $key) ? 'selected' : ''}}>{{$val}}</option> 
				@endforeach
			</select>
		</td>
		<td>
			<!-- <label for="amount" class="control-label">Payment ID No.</label>  -->
			{{ Form::text('payment_id_number'.$payment_records_row->id, $payment_records_row->payment_id_number, array('class' => 'form-control')) }}  
		</td>
		<td> 
			{{ Form::button('Update', array('class'=> 'btn btn-info btn-lg pull-left', 'Value' => $payment_records_row->id, 'name' => 'update_payment_item', 'type'=>'submit')) }}

			{{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $payment_records_row->id, 'name' => 'delete_payment_item', 'type'=>'submit')) }} 
		</td>
	</tr>
	
	@endforeach
	<tr>
		<td>  </td>
		<td>  </td>
		<td align="right"> <label for="totalAmount" class="control-label">Total Paid</label>  </td>
		<td> 
		<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $total }}"  readonly="readonly"> 
		</td>
		<td>  </td>
	</tr>

	<tr>
		<td>  </td>
		<td>  </td>
		<td align="right"> <label for="totalAmount" class="control-label">Balance</label>  </td>
		<td> 
		<input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum - $total }}"  readonly="readonly"> 
		</td>
		<td>  </td>
	</tr>
	@endif
</table>
                    </div>
					--}}
<!-- ==================End payments==============================  -->
                
                               </div>
                
                                @endif
                            </div>
                </div>
           </form>
            </div>
        </div>
</div>
</div>
@endsection
 
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
		/*
      $("#day, #rate").on('blur', function () {
          $("#amount").text('');
          var numberofday = $.isNumeric($.trim($("#day").val())) ? $.trim($("#day").val()) : 1;
          if ($.isNumeric($.trim($("#rate").val()))) {
              $("#amount").text(numberofday * $("#rate").val());
          }
      });
	  */
	
		/*
	  $('.particular-dropdown').change(function() {
			let amount = $(this).find(':selected').data('amount');
			alert(amount);
	  });
	  */

	  $(document).on('change', '.particular-dropdown', function() {
			let amount = $(this).find(':selected').data('amount');

			let parent_tr = $(this).closest('.bill-item-tr');

			parent_tr.find(".rate").val(amount);

			calculate_amount($(this));
	  });

	  $(".day, .rate").on('blur', function () {

		  console.log('======== : ' + $(this).val());

		  calculate_amount($(this));
      });


	  function calculate_amount(current_element) {
		let parent_tr = current_element.closest('.bill-item-tr');

		parent_tr.find(".amount").text('');

		var numberofday = $.isNumeric($.trim(parent_tr.find(".day").val())) ? $.trim(parent_tr.find(".day").val()) : 1;
		if ($.isNumeric($.trim(parent_tr.find(".rate").val()))) {
			parent_tr.find(".amount").text(numberofday * parent_tr.find(".rate").val());
		}
	  }
      
    });
</script>
@endsection
