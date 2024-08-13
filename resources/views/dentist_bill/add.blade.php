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

</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/dentistBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/dentistBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
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
                    <form action="{{ url('/dentistBill'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                    {{ csrf_field() }}

                    @if (isset($case_master))
                        <input type="hidden" name="_method" value="PATCH">
                    @endif
                         <div class="header bg-pink">
                            <h2>
                                 Add/Modify bill
                            </h2>
                          
                        </div>
                        <div class="body">
                           <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number" class="control-label">Case Number</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">
                              </div>
                              </div>
                              </div>  

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="name_of_patient" class="control-label">Name Of Patient</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="name_of_patient" id="name_of_patient" class="form-control"  readonly='readonly' value="{{ $case_master['patient_name'] or ''}}"> 
                              </div>
                              </div>
                              </div>
                              </div>

                            <div class="col-md-12">
                             <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>    
                                            {{ Form::label('treatmentDone','Treatment ') }} 
                                            {{ Form::text('treatmentDone', Request::old('treatmentDone'), array('class' => 'form-control')) }}
                                        </td>
                                        <td>
                                            {{ Form::label('date','Date') }} 
                                            {{ Form::text('date', Request::old('date'), array('class' => 'form-control datepicker','autocomplete'=>'off')) }}                          
                                        </td>
                                        <td> 
                                            {{ Form::label('amountPaid','Amount') }} 
                                            {{ Form::number('amountPaid', Request::old('amountPaid'), array('class' => 'form-control')) }}                      
                                         </td>
                                             <td> 
                                            {{ Form::label('amountPaid','Balance') }} 

                                                              
                                         </td>
                                         <td>
                                            <p>
                                            &nbsp;
                                                <button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>                      
                                            </p>
                                         </td>
                                    </tr>
                                    @if( !empty($dentist_bill) && null !== $dentist_bill && count($dentist_bill) > 0 )
                                        @foreach(old('dentist_bill', $dentist_bill) as $billdata) 
                                            <tr>
                                                <td> <input type="hidden" name="treatments" value="{{ $billdata->treatmentDone }}">{{ $billdata->treatmentDone }} </td>
                                                <td> {{ $billdata->date }} </td>
                                                <td>{{ $billdata->amountPaid }} </td>
                                                <td><input type="hidden" name="balanceamt" value="{{ $billdata->balance }}">{{ $billdata->balance }} </td>
                                                <td> {{ Form::button('Delete', array('class'=> 'btn btn-warning pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} </td>
                                            </tr>
                                        @endforeach
                                             <tr>
                                                <td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
                                                <td>  </td>
                                                <td> 
                                                    <?php $itemsum = 0; 
                                                          $itemsum = $dentist_bill->sum('amountPaid') 
                                                    ?>
                                                    <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                                </td>
                                         

                                                <td> 
                                                    <?php $itemsum1 = 0; 
                                                          $itemsum1 = $dentist_bill->sum('balance') 
                                                    ?>
                                                    <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum1 }}"  readonly="readonly"> 
                                                </td>
                                            </tr>
                                    @endif
                                </table>
                            </div>
                            </div>
                              </form>
                            <div class="col-md-12">
                              <form action="{{url('updatepaymentadd')}}" method="POST" class="form-horizontal" >
                              {{ csrf_field() }}
                              <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
                                      
                              <input type="hidden" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">
                              <input type="hidden" name="name_of_patient" id="name_of_patient" class="form-control"  readonly='readonly' value="{{ $case_master['patient_name'] or ''}}">
                              <div class="table-responsive">      
                              <table class="table">
                              <tr>
                              <td>
                              {{ Form::label('Payment For','Payment For') }} <br>
                              <select class="form-control select2" id="treatmentDone" name="treatmentDone">
                              <?php $cnt=count($treatment); ?>
                              @if($cnt>0)
                              @foreach($treatment as $treatment)
                              <option value="{{$treatment->id}}">{{$treatment->treatmentDone}}</option>
                              @endforeach  
                              @else
                              <option value="0" readonly>No Treatment is added</option>
                              @endif
                              </select>    
                              </td>
                              <td>
                                  {{ Form::label('date','Date') }} 
                                  {{ Form::text('date', Request::old('date'), array('class' => 'form-control datepicker','autocomplete'=>'off')) }}                          
                              </td>
                              <td> 
                                  {{ Form::label('amountPaid','Amount Paid') }} 
                                  {{ Form::number('amountPaid', Request::old('amountPaid'), array('class' => 'form-control')) }}                      
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
                                {{ Form::label('amountPaid','Add Payment ') }} 
                               <button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>                      
                                  
                              </td>
                              </tr>
                              @if( !empty($pay_bill) && null !== $pay_bill && count($pay_bill) > 0 )
                              @foreach(old('pay_bill', $pay_bill) as $billdata) 
                              <tr>
                              <td>
                              <input type="hidden" name="treatmentname" value="{{ $billdata->dentist_bill_id }} "> {{ $billdata->treatmentDone }} 
                              </td>
                              <td>
                              {{ $billdata->date }} 
                              </td>
                              <td>
                              <input type="hidden" name="amountdelt" value="{{ $billdata->amountPaid }}">{{ $billdata->amountPaid }} 
                              </td>
                              <td> 
                              {{$payment_modes_array[$billdata->payment_mode]}}  
                              </td>
                              <td> 
							  <a href="{{ url('printpaymenmt')}}/{{$case_master->id}}/{{$billdata->id}}" ><i class="fa fa-print" aria-hidden="true"></i>Print</a> &nbsp;&nbsp;
                              {{ Form::button('Delete', array('class'=> 'btn btn-warning pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} </td>
                              </tr>
                              @endforeach
                              <tr>
                              <td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
                              <td>  </td>
                              <td> 
                                  <?php $itemsum = 0; 
                                        $itemsum = $pay_bill->sum('amountPaid') 
                                  ?>
                                  <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                              </td>
                              <td>  </td>
                              </tr>
                              @endif
                              </table>
                               </div>
                              </form>
                            </div>

                              
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-6 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" name="deleteAll" class="btn btn-success btn-lg" value="deleteAll"><i class="fa fa-trash" aria-hidden="true"></i> Delete
                                </button>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/dentistBill/print').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
                                <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>
                                      
                                </div>
                                </div>
                               
                            </div>    
                        </div>
                    </div>
                </div>
            </div>


</div>

        @endsection



@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>

@endsection
  