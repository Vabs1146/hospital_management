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
         <form action="{{ url('/formDropDown') }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Add form field values </h2>
          </div>  
              <div class="body">
                  <div class="row clearfix ">
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('formName','Form Name') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              
                              {{ Form::select('formName', array(''=>'Please select')+ old('formNameList', $formNameList), Request::old('formName'), array('class' => 'form-control select2', 'required','data-live-search'=>'true')) }}
                              </div>    


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                            {{ Form::label('fieldName','Field Name') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                                {{ Form::select('fieldName', array(''=>'Please select')+ Request::old('fieldNameList', $fieldNameList), Request::old('fieldName'),array('class'=> 'form-control select2', 'required','data-live-search'=>'true')) }}
                              
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Text :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('ddText', Request::old('ddText'), array('class' => 'form-control','autocomplete'=>'off', 'required')) }}                             
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Default/Normal :</label>
                              </div>
                              </div>


                             <div class="col-md-4">
                              <div class="form-group">
                              <div class="demo-radio-button" style="padding-top: 6px">

                                <input id="radio_8" name="isdefault" type="checkbox" value=""> 
                              <label for="radio_8"></label>

                              

                              </div>
                              </div>
                              </div>
                          </div>


                                    
                  </div>    

                  <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-2">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                                <i class="fa fa-plus"></i> Submit
                                </button>
                                <button type="submit" name="formDrDwnChange" id="formDrDwnChange" class="btn btn-success" style="display:none" value="formDrDwnChange" >
                                </button>
     
                                </div>
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
<script type="text/javascript">
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
        $('#formName').on('change', function(e){
            if($('#formName').val() != ''){
                $.get('/get_form_field/' + $('#formName').val(), function(data){
                    //success data
                    $('#fieldName').empty();
                    $('#fieldName').append('<option value=""> Please select </option>');
                    $.each(data, function(index, subcatObj){
                        $("#fieldName").append('<option value="'+subcatObj.fieldName+'" selected="">'+subcatObj.fieldName+'</option>');
                        $("#fieldName").selectpicker("refresh");

                    });
                });
            }
        });  
    });
</script>

 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
 <script type="text/javascript">
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
@endsection  



 
