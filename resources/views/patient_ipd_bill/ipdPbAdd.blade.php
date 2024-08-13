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
          <form action="{{ url('/IPD/patientBill'.( empty($patientRegister->id) ? "/0" : ("/" . $patientRegister['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (!empty($patientRegister->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif

         <input type="hidden" id="register_id" name="register_id" value="{{ $patientRegister->id or ''}}" >
         <input type="hidden" id="id" name="id" value="{{ $patientbill->id or ''}}" >
          <div class="header bg-pink">
          <h2>Admission Paper</h2>
          </div>
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('name','Patient Name') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('name', Request::old('name',$patientRegister->first_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('uhid_no','UHID no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('uhid_no', Request::old('uhid_no',$patientRegister->uhid_number), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('ipd_no','IPD no.') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('ipd_no', Request::old('ipd_no',$patientRegister->ipd_number), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('tpa_company','TPA Company') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('tpa_company', Request::old('tpa_company',$patientbill->tpa_company), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>
                            </div>
                                 
                                 <!-- One row start -->
                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('insurance_company','Insurance Company') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('insurance_company', Request::old('insurance_company',$patientbill->insurance_company), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('bill_no','Bill No') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('bill_no', Request::old('bill_no',$patientbill->bill_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
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


                              <div class="col-md-4">
                              <div class="form-group">
							  <div class="form-line">
                              {{ Form::text('bill_towards', Request::old('bill_towards',$patientbill->bill_towards), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
								</div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('room_no','Room No') }}   
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('room_no', Request::old('room_no',$patientbill->room_no), array('class' => 'form-control', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('bill_date','Bill Date') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('bill_date', Request::old('bill_date',$patientbill->bill_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('registration_date','Admit Date') }}  
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                             {{ Form::text('registration_date', Request::old('registration_date',$patientRegister->registration_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>
                            </div>
                  
                               <div class="col-md-12">                           
                             <div class="col-md-2">
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
                               {{ Form::text('dod', Request::old('dod',$ipdDischarge->dod), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
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
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('advance_amount','Advance Amount') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('advance_amount', Request::old('advance_amount',$patientbill->advance_amount), array('class' => 'form-control', 'autocomplete'=>'off')) }}                        
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
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

                            </div>    

                               <div class="row clearfix">
                                <div class="col-md-12">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                                  <i class="fa fa-plus"></i> save
                                </button>
                              {{-- <a class="btn btn-default" href="{{ url('/eyeoperation') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> --}}
                              <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientBill') }}" ><i class="glyphicon glyphicon-print"></i> Back </a>
                              <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientRegsiter') }}"><i class="glyphicon glyphicon-chevron-left"></i>Patient Register</a>
                              @if (!empty($patientbill->id) && $patientbill->id > 0)
                                  <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientBill/print/') ."/". $patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-print"></i> Print </a>
                                  <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientBill/printReceipt/') ."/". $patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-print"></i> Print Receipt </a>
                              @endif  
                                </div>
                                </div> 
                            </div>

                            <div class="row">
                               @if(!empty($patientbill->id) && $patientbill->id > 0)
                               <div class="col-md-12">
                                 
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr>
                                <td>
                                    <label for="particular" class="control-label">Particular</label>
                                    <input type="text" name="particular" id="particular" class="form-control" value="{{ $particular or ''}}"> 
                                </td>
                                <td>
                                    <label for="day" class="control-label">Day</label>
                                    <input type="number" step="0.01" name="day" id="day" class="form-control" value="{{ $day or ''}}">
                                </td>
                                <td>
                                    <label for="rate" class="control-label">Rate</label>
                                    <input type="number" step="0.01" name="rate" id="rate" class="form-control" value="{{ $rate or ''}}">
                                </td>
                                <td>
                                    <label for="amount" class="control-label">Amount</label> 
                                    <span class="form-control" id="amount">  </span> 
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
                                    <tr>
                                        <td> {{ $billdata->particular }} </td>
                                        <td> {{ $billdata->day }} </td>
                                        <td> {{ $billdata->rate }} </td>
                                        <td> {{ (is_null($billdata->day)?1:$billdata->day)*$billdata->rate }} </td>
                                        <td> {{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} </td>
                                    </tr>
                                    @php
                                        $itemsum = $itemsum + ((is_null($billdata->day)?1:$billdata->day)*$billdata->rate);
                                    @endphp
                                @endforeach
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
      $("#day, #rate").on('blur', function () {
          $("#amount").text('');
          var numberofday = $.isNumeric($.trim($("#day").val())) ? $.trim($("#day").val()) : 1;
          if ($.isNumeric($.trim($("#rate").val()))) {
              $("#amount").text(numberofday * $("#rate").val());
          }
      });
      
    });
</script>
@endsection
