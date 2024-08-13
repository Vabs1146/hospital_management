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
          <form action="{{ url('/MedicineStock'.( empty($MedicineStock->id) ? "/0" : ("/" . $MedicineStock['id']))) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

               
                @if (!empty($MedicineStock->id) | 1==1)
                    <input type="hidden" name="_method" value="PATCH">
                @endif

        
        
          <div class="header bg-pink">
          <h2>Add Medicine Stock </h2>
          </div>
              <div class="body">
                  <div class="row clearfix ">
                    <input type="hidden" id="id" name="id" value="{{ $MedicineStock['id'] or ''}}" >
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('medicine_name','Medicine') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('medicine_name', Request::old('medicine_name',$MedicineStock->medicine_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('Remaining_Stock_Qty','Remaining Stock Qty') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Remaining_Stock_Qty', Request::old('Remaining_Stock_Qty',$MedicineStock->Remaining_Stock_Qty), array('class' => 'form-control', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                            </div>


                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('Mfg_date','Mfg.date') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                                
                                 {{ Form::text('Mfg_date', Request::old('Mfg_date',$MedicineStock->Mfg_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                   
                              </div>
                              </div>
                              </div>

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('Exp_date','Exp date') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Exp_date', Request::old('Exp_date',$MedicineStock->Exp_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>
                            </div>
                                 
                                 <!-- One row start -->
                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('Stock_in_date','Stock in date') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Stock_in_date', Request::old('Stock_in_date',$MedicineStock->Stock_in_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                           
                              </div>
                              </div>
                              </div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('Stock_Out_date','Stock Out date') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Stock_Out_date', Request::old('Stock_Out_date',$MedicineStock->Stock_Out_date), array('class' => 'form-control datepicker', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                            </div>



                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('Cost','Cost') }}
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
							  <div class="form-line">
                              {{ Form::text('Cost', Request::old('Cost',$MedicineStock->Cost), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
								</div>
                              
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('unit_Received','unit Received') }}   
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('unit_Received', Request::old('unit_Received',$MedicineStock->unit_Received), array('class' => 'form-control', 'autocomplete'=>'off')) }}                         
                              </div>
                              </div>
                              </div>
                            </div>

                            <div class="col-md-12">                           
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('unit_issued','unit issued') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('unit_issued', Request::old('unit_issued',$MedicineStock->unit_issued), array('class' => 'form-control', 'autocomplete'=>'off')) }}                          
                              </div>
                              </div>
                              </div>
                              
                               
                            </div>
                  

                            </div>    

                              <div class="row clearfix">
                                <div class="col-md-12">
                                  <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                              <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                               <i class="glyphicon glyphicon-plus btnicons"></i> Submit
                                </button>&nbsp;
                              
                              <a class="btn btn-default btn-lg" href="{{ url('/MedicineStock') }}" ><i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                             
                                </div>
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

<script>

    $("#medicine_name").change(function() {
     var id = $('#medicine_name').val();
     
                $.ajax({
                    url: "{{ url('GetMedicineName') }}/"+id,
                    dataType: 'json',
                    success: function(response) {
              var len = 0;
              if(response['data'] != null){
              len = response['data'].length;
              }

              if(len > 0){

              for(var i=0; i<len; i++)
              {
               var id = response['data'][i].id;
                 var Remaining_Stock_Qty = response['data'][i].Remaining_Stock_Qty;
                 var Mfg_date = response['data'][i].Mfg_date;
                 var Exp_date = response['data'][i].Exp_date;
                 var Stock_in_date = response['data'][i].Stock_in_date;
                 var Stock_Out_date = response['data'][i].Stock_Out_date;
                 var Cost = response['data'][i].Cost;
                 var unit_Received = response['data'][i].unit_Received;
                 var unit_issued = response['data'][i].unit_issued;
                 
              } 

              //alert(guardian_name);

               $('input[medicine_name="Remaining_Stock_Qty"]').val(Remaining_Stock_Qty);
                $('textarea[medicine_name="Mfg_date"]').val(Mfg_date);
                $('input[medicine_name="Exp_date"]').val(Exp_date);
                $('input[medicine_name="Stock_in_date"]').val(Stock_in_date);
                $('input[medicine_name="Stock_Out_date"]').val(Stock_Out_date);
                
                $('input[medicine_name="Cost"]').val(Cost);
                $('input[medicine_name="unit_Received"]').val(unit_Received);
                $('input[medicine_name="unit_issued"]').val(unit_issued);
                
                $("#maritial_status").selectpicker("refresh");
              }
              }
            
        });  
      
           
        });
</script>

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
