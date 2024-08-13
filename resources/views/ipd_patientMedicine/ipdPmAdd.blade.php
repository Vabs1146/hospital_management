@extends('adminlayouts.master')

@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
   select2-container .select2-selection--single
  {
        height: 33px !important;
  }

</style>
@endsection
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
          <form action="{{ url('/IPD/patientMedicine'.( empty($patientRegister->id) ? "/0" : ("/" . $patientRegister['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (!empty($patientRegister->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif

        <input type="hidden" id="register_id" name="register_id" value="{{ $patientRegister->id or ''}}" >
        <input type="hidden" id="id" name="id" value="{{ $patientMedicine->id or ''}}" >
          <div class="header bg-pink">
          <h2>Add/Edit bill</h2>
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
                              {{ Form::text('name', Request::old('name',$patientRegister->name), array('class' => 'form-control readonly','readonly', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>
                            </div>
                            </div>    

                            <div class="row clearfix">
                            <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                            <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientMedicine') }}" ><i class="glyphicon glyphicon-print"></i> Back </a>&nbsp;
                            <a class="btn btn-default btn-lg" href="{{ url('/IPD/patientRegsiter') }}"><i class="glyphicon glyphicon-chevron-left"></i>Patient Register</a>
                            @if (!empty($patientMedicine->id) && $patientMedicine->id > 0)
                             <a class="btn btn-default" href="{{ url('/IPD/patientMedicine/print/') ."/". $patientRegister->id }}" target="_blank" ><i class="glyphicon glyphicon-print"></i> Print </a>
                            @endif
                            </div>
                            </div> 
                            </div>

                            <div class="row">
                            @if(!empty($patientRegister->id) && $patientRegister->id > 0)
                            <div class="col-md-12">
                            <div class="table-responsive">
                            <table class="table">
                            <tr>
                                <td>
                                    <label for="Medicine" class="control-label">Medicine</label>
                                    {{ Form::select('medicine_id', array(''=>'Please select') + $medicinelist->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2', 'form-control2','required')) }} 
                                </td>
                                <td>
                                    <label class="control-label">Date of mgf.</label>
                                    <input type="text" name="date_of_mgf" id="date_of_mgf" class="form-control datepicker" value="{{ $date_of_mgf or ''}}">
                                </td>
                                <td>
                                    <label for="date_of_exp" class="control-label">Date of Exp.</label>
                                    <input type="text" name="date_of_exp" id="date_of_exp" class="form-control datepicker" value="{{ $date_of_exp or ''}}">
                                </td>
                                <td>
                                    <label for="batch_no" class="control-label">Batch No</label>
                                    <input type="text" name="batch_no" id="batch_no" class="form-control" value="{{ $batch_no or ''}}"> 
                                </td>
                                <td>
                                    <label for="price" class="control-label">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" value="{{ $price or ''}}"> 
                                </td>
                                <td>
                                    <label for="quantity" class="control-label">Quantity</label>
                                    <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $quantity or ''}}"> 
                                </td>
                                <td>
                                    <label for="Total Price" class="control-label">Amount</label> 
                                    <span class="form-control" id="totalPrice">  </span> 
                                </td>
                                <td>
                                    <label for="Item_Add" class="control-label">&nbsp;</label>
                                    <button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>
                                </td>
                            </tr>
                            @if(null !== old('patientMedicine',$patientMedicine) && count(old('patientMedicine',$patientMedicine))> 0 )
                                <?php 
                                    $itemsum = 0;
                                ?>
                                @foreach(old('patientMedicine',$patientMedicine) as $pMedicine) 
                                    <tr>
                                        <td> {{ $pMedicine->medical_store->medicine_name }} </td>
                                        <td> {{ $pMedicine->date_of_mgf }} </td>
                                        <td> {{ $pMedicine->date_of_exp }} </td>
                                        <td> {{ $pMedicine->batch_no }} </td>
                                        <td> {{ $pMedicine->price }} </td>
                                        <td> {{ $pMedicine->quantity }} </td>
                                        <td> {{ $pMedicine->price*$pMedicine->quantity }} </td>
                                        <td> {{ Form::button('Delete', array('class'=> 'btn btn-warning pull-right', 'Value' => $pMedicine->id, 'name' => 'delete_item', 'type'=>'submit', 'formnovalidate')) }} </td>
                                    </tr>
                                    @php
                                        $itemsum = $itemsum + ($pMedicine->price*$pMedicine->quantity);
                                    @endphp
                                @endforeach
                                     <tr>
                                        
                                        <td align="right" colspan="6"> 
                                            <label for="totalAmount" class="control-label">Total</label>  
                                        </td>
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
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
     $('.select2').select2();
      $("#price, #quantity").on('blur', function(){
        $("#totalPrice").text('');
          if($.isNumeric($.trim($("#price").val())) & $.isNumeric($.trim($("#quantity").val()))){
            $("#totalPrice").text($("#price").val() * $("#quantity").val());
          }
      });
     
    });
</script>
@endsection