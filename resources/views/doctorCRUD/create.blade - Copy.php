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
                @if(empty($doctor->id))
                {{ Form::model($doctor, array('url' => 'admin/doctor')) }}
                @else
                {{ Form::model($doctor, array('route' => array('doctor.update',  $doctor->id), 'method' => 'PATCH' )) }}
                @endif
                <div class="header bg-pink">
                    <h2>
                        Doctor
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Name :</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('doctor_name', Request::old('doctor_name'), array('class' => 'form-control'), array('required')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Doctor Degree :</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('doctorDegree', Request::old('doctorDegree'),array('class'=>'form-control')) }}                             
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Mobile No :</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('mobile_no', Request::old('mobile_no'),array('class'=>'form-control')) }}           
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Patient Form :</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{ Form::select('formViewName', $doctorFormView->toArray(), Request::old('formViewName'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <label class="form-control"></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="demo-checkbox">
                                    {{ Form::checkbox('isActive', Request::old('isActive'),($doctor->isActive == 1),array('id'=>'basic_checkbox_2')) }}
                                    <label for="basic_checkbox_2">Is Active</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 doctor-fees" style="margin-top: -60px; display: <?php echo (!empty($doctorCharges) && $doctorCharges->count() > 0)?'show':'none' ?>">
                            <div class=" bg-pink">
                                <h2>
                                    Doctor Fees
                                </h2>
                            </div>
                            <div class="doctor-procedure">
                                <?php if(!empty($doctorCharges) && $doctorCharges->count() > 0 ){ ?>
                                @foreach ($doctorCharges as $key => $doctorCharge)
                                <div class="col-md-12 each_procedure">
                                    <div class="col-md-2">
                                        <label>Doctor Procedure :</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control select2" name="doctor_procedure[]" autocomplete="off">
                                        @foreach ($procedures as $procedure)
                                        <?php 
                                            $selected = ($doctorCharge->procedure_id == $procedure->id)?"selected='selected'":"";
                                         ?>
                                            <option value="{{ $procedure->id }}" {{ $selected }}
                                                 >
                                                    {{ $procedure->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label>Charges:</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="doctor_fees[]" value="{{ $doctorCharge->fees }}">
                                    </div>

                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove_procedure">
                                        Delete
                                        </button>
                                        <input type="hidden" name="doctor_charges_id[]" value="<?php echo $doctorCharge->id; ?>" class="doctor_charges_id">
                                        <input type="hidden" name="doctor_charges_status[]" class="doctor_charges_status" value="Active">
                                    </div>
                                    @if($key === count($doctorCharges)-1)
                                    <div class="col-md-1">
                                        <button class="btn btn-primary add_procedure" type="button">Add More</button>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                <?php } else { ?>
                                <div class="col-md-12 each_procedure">
                                    <div class="col-md-2">
                                        <label>Doctor Procedure :</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control select2" data-live-search='true' name="doctor_procedure[]">
                                        @foreach ($procedures as $procedure)
                                            <option value="{{ $procedure->id }}">{{ $procedure->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label>Charges:</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="doctor_fees[]" value="">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-primary add_procedure" type="button">Add More</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary waves-effect">
                                    <span>
                                        @if(empty($doctor->id))
                                            Add Doctor
                                        @else
                                            Update Doctor
                                        @endif
                                    </span>
                                </button>
                                <button type="button" class="btn btn-lg btn-primary waves-effect add-doctor-fees"><span>Add Doctor Fees</span>
                                </button>
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ route('doctor.index') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div id="create_procedure_div" style="display: none">
    <div class="col-md-12 each_procedure">
        <div class="col-md-2">
            <label>Doctor Procedure :</label>
        </div>
        <div class="col-md-2">
            <select class="form-control doctor_procedure_select" name="doctor_procedure[]">
                @foreach ($procedures as $procedure)
                <option value="{{ $procedure->id }}">{{ $procedure->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <label>Charges:</label>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" name="doctor_fees[]" value="">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove_unsaved_procedure">
            Delete
            </button>
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary add_procedure" type="button" >Add More</button>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2();
        $("body").on("click",'.add_procedure', function(){
            
            $(".doctor-procedure").append($("#create_procedure_div").html());
            $(".doctor-procedure").find('.doctor_procedure_select').addClass('select3');
            $(".select3").select2();
        })
        $("body").on("click", ".remove_procedure", function(){
            $(this).parents(".each_procedure").hide();
            $(this).siblings(".doctor_charges_status").val("Inactive");
            swal("Removed Doctor Charges")
        })
        $("body").on("click", ".remove_unsaved_procedure", function(){
            $(this).parents(".each_procedure").remove();
        })
        $("body").on("click", '.add-doctor-fees', function(){
            $(".doctor-fees").show();
        })
    });
</script>
@endsection