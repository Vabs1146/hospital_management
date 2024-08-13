@extends('adminlayouts.master')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">

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

 {{--  <div class="container">
    <div class="list-group list-group-horizontal">
        @forelse ($model['DateWiseRecordLst'] as $VisitListDateWise)
                @if($model['case_master']['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/bill_details').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/bill_details').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>  --}}


<div class="card">
<div class="header bg-pink">
<h2>Add/Edit Bill Details </h2>
</div>
     
<div class="body">
<div class="row clearfix">

<form action="{{ url('/doctorbill/'. $model['doctor']['id'] .'/AddBill' ) }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}

<input type="hidden" name="doctor_id" id="doctor_id" class="form-control" value="{{$model['doctor']['id'] or ''}}" readonly="readonly" />

<div class="col-md-12">
<div class="col-md-2">
   <div class="form-group labelgrp">
     <label for="patient_name" class="control-label">Doctor Name</label>
    </div>
</div>

<div class="col-md-4">
   <div class="form-group">
    <div class="form-line">
      <input type="text" name="patient_name" id="patient_name" class="form-control"  readonly='readonly' value="{{ $model['doctor']['doctor_name'] or ''}}">                       
    </div>
   </div>
</div>   


<div class="col-md-2">
   <div class="form-group labelgrp">
     <label for="patient_name" class="control-label">Doctor Fee</label>
   </div>
</div>

<div class="col-md-4">
    <div class="form-group">
     <div class="form-line">
      <input type="text" name="patient_name" id="patient_name" class="form-control"  readonly='readonly' value="{{ $model['doctor']['doctorFee'] or ''}}">                         
     </div>
    </div>
</div>
</div>

<div class="col-md-12">
<div class="col-md-2">
   <div class="form-group labelgrp">
     {{ Form::label('case_id', 'Patient', array('class' => 'control-label')) }}
    </div>
</div>

<div class="col-md-4">
 {{ Form::select('case_id', array(''=>'Please select') + $model['Patient_list']->toArray(), Request::old('case_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
</div>   


<div class="col-md-2">
   <div class="form-group labelgrp">
     {{ Form::label('bill_date','Date', array('class' => ' control-label')) }}
   </div>
</div>

<div class="col-md-4">
    <div class="form-group">
     <div class="form-line">
      {{ Form::text('bill_date', Request::old('bill_date'), array('class' => 'form-control datepicker', 'data-provide'=>'datepicker')) }}                        
     </div>
    </div>
</div>
</div>


<div class="col-md-12">
<div class="col-md-offset-2 col-md-8">
<div class="table-responsive" style="max-height:500px; overflow-y: auto;">
    <table class="table">
        <tr>
            <td colspan="2">
                {{ Form::label('bill_item','Bill Item') }}
                {{ Form::text('bill_item', Request::old('Item_details'), array('class' => 'form-control')) }}
            </td>
            <td colspan="2">
                {{ Form::label('bill_Amount','Amount') }}
                {{ Form::number('bill_Amount', Request::old('bill_Amount'), array('class' => 'form-control', 'step'=>'1.00')) }}            
            </td>
            <td> 
                <label for="Item_Add" class="control-label">&nbsp;</label>
                <button type="submit" name="AddBillItems" id="AddBillItems"  value="AddBillItems" class="btn btn-success form-control">
                <i class="fa fa-plus"></i> Add
                </button>          
            </td>
        </tr>
                                
        @if(null !== old('doctorbill',$model['doctorbill']) && count(old('doctorbill',$model['doctorbill']))> 0 )
        @foreach(old('doctorbill',$model['doctorbill']) as $doctorbill)                                     
        <tr>
            <td> {{ $doctorbill->bill_item }} </td>
            <td> {{ $doctorbill->bill_Amount }} </td>
            <td> {{ $doctorbill->billed_date }} </td>
            <td> {{ (count($doctorbill->Case_master) > 0)? $doctorbill->Case_master->patient_name : "&nbsp;" }} </td>
            <td> {{ Form::button('Delete', array('class'=> 'btn btn-warning btn-lg pull-right', 'Value' => $doctorbill->id, 'name' => 'delete_item', 'type'=>'submit')) }} </td>
        </tr>
        @endforeach
        <tr>
            <td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
            <td> 
                <?php $itemsum = 0; 
                $itemsum = $model['doctorbill']->sum('bill_Amount') 
                ?>
                <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
            </td>
            <td>  </td>
            <td> &nbsp; </td>
            <td> &nbsp; </td>
        </tr>
        @endif
    </table>
</div>
</div>
</div>

<div class="row clearfix">
<div class="col-md-4 col-md-offset-2">
<div class="form-group">
<a class="btn btn-default btn-lg" href="{{ url('/doctorbill/') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
</div>
</div>
</div>
</form>   
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
    $('.select2').select2();
    </script>
@endsection
