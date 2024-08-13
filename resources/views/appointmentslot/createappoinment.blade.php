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
      .scroll
      {
      overflow-y: scroll;
      height: 344px;
      }
       .noscroll
      {
      height: 344px;
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
                        <form action="{{ route('saveappintmentslot')}}" method="POST" class="form-horizontal" id="slotform">
                          {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                                Appointments Time 
                            </h2>
                          
                        </div>
                        
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               <label>Select Doctor : </label>
                               <p id="abc"></p>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">

							  @php
									//$doctors_list = $doctorlist->toArray();
									//dd($doctor_list);
									$doc_key = key($doctor_list);
									$doc_name = $doctor_list[$doc_key]->doctor_name;
									$doc_id = $doctor_list[$doc_key]->id;
								@endphp
								@if(count($doctor_list) > 1)
                               <select id="doctor_id" name="doctor_id" class="form-control select2 form-control2"  required>
                                <option selected value disabled>Select Doctor</option>
                                @foreach($doctor_list as $doctorlist)
                                <option value="{{ $doctorlist->id }}">{{ $doctorlist->doctor_name}}</option>
                                @endforeach
                              
								</select>
@else
									<input class="form-control" name="" value="{{$doc_name}}" type="text" disabled>

									<input class="form-control" name="doctor_id" value="{{$doc_id}}" type="hidden">
									@endif
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label>Day :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                             <select name="day" id="day" class="form-control select2 form-control2" > 
                                <option selected value disabled>Select Day</option>
                                <option value="7">Sunday</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                            </select>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Morning Start Time:</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                 <select name="morningstarttime" id="morningstarttime" class="morningstarttime form-control select2 form-control2"  style="width: 121%;">
                                  <option selected value disabled>Select</option>
                                 
                                  <option value="5">5:00 AM</option>
                                  <option value="6">6:00 AM</option>
                                  <option value="7">7:00 AM</option>
                                  <option value="8">8:00 AM</option>
                                  <option value="9">9:00 AM</option>
                                  <option value="10">10:00 AM</option>
                                  <option value="11">11:00 AM</option>
                               
                               </select>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Morning End Time :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                 <select name="morningendtime" id="morningendtime" class="morningendtime form-control select2 form-control2"  style="width: 121%;">
                              <option selected value disabled>Select</option>
                            
                              
                                  <option value="5 ">5:00 AM</option>
                                  <option value="6">6:00 AM</option>
                                  <option value="7">7:00 AM</option>
                                  <option value="8">8:00 AM</option>
                                  <option value="9">9:00 AM</option>
                                  <option value="10">10:00 AM</option>
                                  <option value="11">11:00 AM</option>
                         
                           </select>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Minute Difference  :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                <select name="morningminute" id="time_diff_minute" class=" time_diff_minute form-control select2 form-control2" >
                              <option selected value disabled>Select</option>
                              <option value="05">05</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                              <option value="30">30</option>
                              <option value="35">35</option>
                              <option value="40">40</option>
                              <option value="45">45</option>
                              <option value="50">50</option>
                              <option value="55">55</option>
                              <option value="60">60</option>
                           </select>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Afternoon Start Time:</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                 <select name="afternoonstarttime" id="afternoonstarttime" class=" afternoonstarttime form-control select2 form-control2" style="width: 121%;">
                                  <option selected value disabled>Select</option>
                                 
                                  <option value="11">11:00 AM</option>
                                  <option value="12">12:00 PM</option>
                                  <option value="13">1:00 PM</option>
                                  <option value="14">2:00 PM</option>
                                  <option value="15">3:00 PM</option>
                                  <option value="16">4:00 PM</option>
                                 
                               
                               </select>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Afternoon End Time :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                <select name="afternoonendtime" id="afternoonendtime" class="afternoonendtime form-control select2 form-control2" style="width: 121%;">
                              <option selected value disabled>Select</option>
                            
                                  <option value="11">11:00 AM</option>
                                  <option value="12">12:00 PM</option>
                                  <option value="13">1:00 PM</option>
                                  <option value="14">2:00 PM</option>
                                  <option value="15">3:00 PM</option>
                                  <option value="16">4:00 PM</option>
                         
                           </select>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Minute Difference  :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                 <select name="afternoonminute" id="time_diff_minute" class=" time_diff_minute form-control select2 form-control2" >
                              <option selected value disabled>Select</option>
                              <option value="05">05</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                              <option value="30">30</option>
                              <option value="35">35</option>
                              <option value="40">40</option>
                              <option value="45">45</option>
                              <option value="50">50</option>
                              <option value="55">55</option>
                              <option value="60">60</option>
                           </select>
                              </div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Evening Start Time:</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                               <select name="eveningstarttime" id="eveningstarttime" class=" eveningstarttime form-control select2 form-control2" style="width: 121%;">
                                  <option selected value disabled>Select</option>
                                 
                                     <option value="4">4:00 PM</option>
                                  <option value="5">5:00 PM</option>
                                  <option value="6">6:00 PM</option>
                                  <option value="7">7:00 PM</option>
                                  <option value="8">8:00 PM</option>
                                  <option value="9">9:00 PM</option>
                                  <option value="10">10:00 PM</option>
                                  <option value="11">11:00 PM</option>
                               
                               </select>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Evening End Time :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                               <select name="eveningendtime" id="eveningendtime" class="eveningendtime form-control select2 form-control2" style="width: 121%;">
                              <option selected value disabled>Select</option>
                            
                              <option value="4">4:00 PM</option>
                                  <option value="5">5:00 PM</option>
                                  <option value="6">6:00 PM</option>
                                  <option value="7">7:00 PM</option>
                                  <option value="8">8:00 PM</option>
                                  <option value="9">9:00 PM</option>
                                  <option value="10">10:00 PM</option>
                                  <option value="11">11:00 PM</option>
                         
                           </select>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label> Minute Difference  :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                               <select name="eveningminute" id="time_diff_minute" class=" time_diff_minute form-control select2 form-control2" >
                              <option selected value disabled>Select</option>
                              <option value="05">05</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                              <option value="30">30</option>
                              <option value="35">35</option>
                              <option value="40">40</option>
                              <option value="45">45</option>
                              <option value="50">50</option>
                              <option value="55">55</option>
                              <option value="60">60</option>
                           </select>
                              </div>
                              </div>
                              </div>

                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('admin') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
                            </div>
                        <div class="row clearfix">
                          <!-- MONDAY TAB -->
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <h5 class="text-center"><b>Monday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                      <input type="hidden" name="mondayvaluedata" id="mondayvaluedata" value="1">

                                        <li role="presentation" class=""><a href="" data-toggle="tab" id="mon_morningdata" name="Morning">Morning</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="mon_afternoondata" name="Afternoon">Afternoon</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="mon_eveningdata" name="Evening">Evening</a></li>
                                      
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="mondaytab">
                                      <div role="tabpanel" class="tab-pane animated flipInX active" id="mon_morningdata1" >
                                        <table class="table table-hover table-stripe table-bordered " id="mon_timeslotdata">
                                            
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="mon_afternoondata1">
                                        <table class="table table-hover table-stripe table-bordered" id="mon_timeslotdata">
                                            
                                          </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="mon_eveningdata1">
                                        <table class="table table-hover table-stripe table-bordered" id="mon_timeslotdata">
                                              
                                          </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- TUESDAY TAB -->
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <h5 class="text-center"><b>Tuesday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                      <input type="hidden" name="tuedayvaluedata" id="tuedayvaluedata" value="2">

                                      <li role="presentation" class="active"><a href="#" data-toggle="tab" id="tue_morningdata" name="Morning" id="Morning">Morning</a></li>
                                      <li role="presentation"><a href="#" data-toggle="tab" id="tue_afternoondata" name="Afternoon">Afternoon</a></li>
                                      <li role="presentation"><a href="#" id="tue_eveningdata" name="Evening" data-toggle="tab">Evening</a></li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="tuesdaytab">
                                      <div role="tabpanel" class="tab-pane animated flipInX active" id="tue_morningdata1">
                                        <table class="table table-hover table-stripe table-bordered" id="tue_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="tue_afternoondata1">
                                        <table class="table table-hover table-stripe table-bordered" id="tue_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="tue_eveningdata1">
                                          <table class="table table-hover table-stripe table-bordered" id="tue_timeslotdata">
                                              
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- WEDNESDAY -->
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <h5 class="text-center"><b>Wednesday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                      <input type="hidden" name="weddayvaluedata" id="weddayvaluedata" value="3">

                                        <li role="presentation" class="active"><a href="#" data-toggle="tab" id="wed_morningdata" name="Morning">Morning</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="wed_afternoondata" name="Afternoon">Afternoon</a></li>
                                        <li role="presentation"><a href="#wed_eveningdata" data-toggle="tab" id="wed_eveningdata" name="Evening">Evening</a></li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="wedtab">
                                      <div role="tabpanel" class="tab-pane animated flipInX active" id="wed_morningdata1">
                                        <table class="table table-hover table-stripe table-bordered " id="wed_timeslotdata">
                                            
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="wed_afternoondata1">
                                        <table class="table table-hover table-stripe table-bordered" id="wed_timeslotdata ">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="wed_eveningdata1">
                                         <table class="table table-hover table-stripe table-bordered" id="wed_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <h5 class="text-center"><b>Thursday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">

                                       <input type="hidden" name="thurdayvaluedata" id="thurdayvaluedata" value="4">

                                        <li role="presentation" class="active"><a href="#" data-toggle="tab" id="thur_morningdata" name="Morning
                                          ">Morning</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="thur_afternoondata" name="Afternoon">Afternoon</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="thur_eveningdata" name="Evening">Evening</a></li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="thurtab">
                                      <div role="tabpanel" class="tab-pane animated flipInX active" id="thur_morningdata1">
                                        <table class="table table-hover table-stripe table-bordered" id="thur_timeslotdata">
                                              
                                        </table>
                                           
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="thur_afternoondata1">
                                        <table class="table table-hover table-stripe table-bordered" id="thur_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="thur_eveningdata1">
                                        <table class="table table-hover table-stripe table-bordered" id="thur_timeslotdata">
                                              
                                        </table>
                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <h5 class="text-center"><b>Friday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                       <input type="hidden" name="fridayvaluedata" id="fridayvaluedata" value="5">
                                        <li role="presentation" class="active"><a href="#" data-toggle="tab" id="fri_morningdata" name="Morning">Morning</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="fri_afternoondata" name="Afternoon">Afternoon</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="fri_eveningdata" name="Evening">Evening</a></li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="fritab">
                                      <div role="tabpanel" class="tab-pane animated flipInX active" id="fri_morningdata1">
                                        <table class="table table-hover table-stripe table-bordered" id="fri_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="fri_afternoondata1">
                                         <table class="table table-hover table-stripe table-bordered" id="fri_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="fri_eveningdata1">
                                         <table class="table table-hover table-stripe table-bordered" id="fri_timeslotdata">
                                              
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <h5 class="text-center"><b>Saturday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                       <input type="hidden" name="satdayvaluedata" id="satdayvaluedata" value="6">
                                        <li role="presentation" class="active"><a href="#" data-toggle="tab" id="sat_morningdata" name="Morning">Morning</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="sat_afternoondata" name="Afternoon">Afternoon</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="sat_eveningdata" name="Evening">Evening</a></li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="sattab">
                                       <div role="tabpanel" class="tab-pane animated flipInX active" id="sat_morningdata1">
                                        <table class="table table-hover table-stripe table-bordered table-hover table-stripe table-bordered" id="sat_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="sat_afternoondata1">
                                        <table class="table table-hover table-stripe table-bordered table-hover table-stripe table-bordered" id="sat_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="sat_eveningdata1">
                                         <table class="table table-hover table-stripe table-bordered table-hover table-stripe table-bordered" id="sat_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                   <h5 class="text-center"><b>Sunday</b></h5>
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                       <input type="hidden" name="sundayvaluedata" id="sundayvaluedata" value="7">
                                        <li role="presentation" class="active"><a href="#" data-toggle="tab" id="sun_morningdata" name="Morning">Morning</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="sun_afternoondata" name="Afternoon">Afternoon</a></li>
                                        <li role="presentation"><a href="#" data-toggle="tab" id="sun_eveningdata" name="Evening">Evening</a></li>
                                       
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content" id="suntab">
                                      <div role="tabpanel" class="tab-pane animated flipInX active" id="sun_morningdata1">
                                        <table class="table table-hover table-stripe table-bordered" id="sun_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="sun_afternoondata1">
                                        <table class="table table-hover table-stripe table-bordered" id="sun_timeslotdata">
                                              
                                        </table>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="sun_eveningdata1">
                                         <table class="table table-hover table-stripe table-bordered" id="sun_timeslotdata">
                                              
                                        </table>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </form>
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
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
    });
</script>

<script>
$(document).ready(function(){
  // MONDAY Moring Click
     $("#mon_morningdata").click(function(){
      alert("Monday Moring")

      var day=$("#mondayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
      var mon_morningdata= $("#mon_morningdata").attr("name");
      if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
     var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+mon_morningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#mon_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#mondaytab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#mon_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Monday Morning.</td>" +
                "</tr>";

                $("#mon_timeslotdata").append(data);
             }
               }
            }); 
   }
 
  });

// MONDAY Afternoon click

$("#mon_afternoondata").click(function(){
    
      var day=$("#mondayvaluedata").val();
   
    var doctor_id=$("#doctor_id").val();
      var mon_afternoondata= $("#mon_afternoondata").attr("name");
       if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
    var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+mon_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#mon_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                     $("#mondaytab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#mon_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Monday Afternoon.</td>" +
                "</tr>";

                $("#mon_timeslotdata").append(data);
             }
               }
            }); 
   
   }
  });


// MONDAY Evening click

$("#mon_eveningdata").click(function(){
      
      var day=$("#mondayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var mon_eveningdata= $("#mon_eveningdata").attr("name");
    
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
      var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+mon_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#mon_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                    $("#mondaytab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#mon_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Monday.</td>" +
                "</tr>";

                $("#mon_timeslotdata").append(data);
             }
               }
            });
   }   
  });

  // TUESDAY Moring Click
     $("#tue_morningdata").click(function(){
      var day=$("#tuedayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
      var tue_morningdata= $("#tue_morningdata").attr("name");
      if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
     var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+tue_morningdata+"/"+day;
     alert(url);
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  alert(response);
                  
                   var len = 0;
             $('#tue_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                    $("#tuesdaytab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#tue_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Tuesday Morning.</td>" +
                "</tr>";

                $("#tue_timeslotdata").append(data);
             }
               }
            }); 
   }
  });

// TUESDAY Afternoon click

$("#tue_afternoondata").click(function(){
    
      var day=$("#tuedayvaluedata").val();
     
    var doctor_id=$("#doctor_id").val();
      var tue_afternoondata= $("#tue_afternoondata").attr("name");
     if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
     var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+tue_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#tue_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                    $("#tuesdaytab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#tue_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Tuesday Afternoon.</td>" +
                "</tr>";

                $("#tue_timeslotdata").append(data);
             }
               }
            }); 
   }  
  });


// TUESDAY Evening click

$("#tue_eveningdata").click(function(){
      
      var day=$("#tuedayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var tue_eveningdata= $("#tue_eveningdata").attr("name");
    
 if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
    var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+tue_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#tue_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                    $("#tuesdaytab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#tue_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Tuesday.</td>" +
                "</tr>";

                $("#tue_timeslotdata").append(data);
             }
               }
            }); 
   
   }  
  
  });
 
  // WEDNESDAY Moring Click
     $("#wed_morningdata").click(function(){
      var day=$("#weddayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
      var wed_morningdata= $("#wed_morningdata").attr("name");
  if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
    var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+wed_morningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                 
                   var len = 0;
             $('#wed_timeslotdata ').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                    $("#wedtab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#wed_timeslotdata ").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Wednesday Morning.</td>" +
                "</tr>";

                $("#wed_timeslotdata ").append(data);
             }
               }
            }); 
   }
  });

// WEDNESDAY Afternoon click

$("#wed_afternoondata").click(function(){
    
      var day=$("#weddayvaluedata").val();
     
    var doctor_id=$("#doctor_id").val();
      var wed_afternoondata= $("#wed_afternoondata").attr("name");
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {

  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+wed_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#wed_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                  $("#wedtab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#wed_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Wednesday Afternoon.</td>" +
                "</tr>";

                $("#wed_timeslotdata").append(data);
             }
               }
            }); 
   }
   
   
  });


// WEDNESDAY Evening click

$("#wed_eveningdata").click(function(){
      
      var day=$("#weddayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var wed_eveningdata= $("#wed_eveningdata").attr("name");
    
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+wed_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#wed_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                  $("#wedtab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#wed_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Wednesday.</td>" +
                "</tr>";

                $("#wed_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });


  // THURSDAY Moring Click
     $("#thur_morningdata").click(function(){
      var day=$("#thurdayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
      var thur_morningdata= $("#thur_morningdata").attr("name");
  if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
       var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+thur_morningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                 
                   var len = 0;
             $('#thur_timeslotdata ').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                  $("#thurtab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#thur_timeslotdata ").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Thursday Morning.</td>" +
                "</tr>";

                $("#thur_timeslotdata ").append(data);
             }
               }
            }); 
       }
 
  });

// THURSDAY Afternoon click

$("#thur_afternoondata").click(function(){
    
      var day=$("#thurdayvaluedata").val();
   
    var doctor_id=$("#doctor_id").val();
      var thur_afternoondata= $("#thur_afternoondata").attr("name");
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
   
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+thur_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#thur_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#thurtab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#thur_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Thursday Afternoon.</td>" +
                "</tr>";

                $("#thur_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });


// THURSDAY Evening click

$("#thur_eveningdata").click(function(){
      
      var day=$("#thurdayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var thur_eveningdata= $("#thur_eveningdata").attr("name");
    
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+thur_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#thur_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#thurtab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#thur_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Thursday.</td>" +
                "</tr>";

                $("#thur_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });

// FRIDAY Moring Click
     $("#fri_morningdata").click(function(){
      var day=$("#fridayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
  var fri_morningdata= $("#fri_morningdata").attr("name");
  if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+fri_morningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#fri_timeslotdata ').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#fritab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#fri_timeslotdata ").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Friday Morning.</td>" +
                "</tr>";

                $("#fri_timeslotdata ").append(data);
             }
               }
            }); 
       }
 
  });

// Friday Afternoon click

$("#fri_afternoondata").click(function(){
    
      var day=$("#fridayvaluedata").val();
    
    var doctor_id=$("#doctor_id").val();
      var fri_afternoondata= $("#fri_afternoondata").attr("name");
   
   
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+fri_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#fri_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#fritab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#fri_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Friday Afternoon.</td>" +
                "</tr>";

                $("#fri_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });


// FRIDAY Evening click

$("#fri_eveningdata").click(function(){
      
      var day=$("#fridayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var fri_eveningdata= $("#fri_eveningdata").attr("name");
    
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+fri_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#fri_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#fritab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#fri_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Friday.</td>" +
                "</tr>";

                $("#fri_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });

// SATURDAY Moring Click
     $("#sat_morningdata").click(function(){
      var day=$("#satdayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
      var sat_morningdata= $("#sat_morningdata").attr("name");

      if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  
   var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+sat_morningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#sat_timeslotdata ').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#sattab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#sat_timeslotdata ").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Saturday Morning.</td>" +
                "</tr>";

                $("#sat_timeslotdata ").append(data);
             }
               }
            }); 
       }
 
  });

// SATURDAY Afternoon click

$("#sat_afternoondata").click(function(){
    
      var day=$("#satdayvaluedata").val();
   
    var doctor_id=$("#doctor_id").val();
      var sat_afternoondata= $("#sat_afternoondata").attr("name");
if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
   
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+sat_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#sat_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#sattab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#sat_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Saturday Afternoon.</td>" +
                "</tr>";

                $("#sat_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });


// SATURDAY Evening click

$("#sat_eveningdata").click(function(){
      
      var day=$("#satdayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var sat_eveningdata= $("#sat_eveningdata").attr("name");
    
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+sat_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#sat_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#sattab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#sat_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Saturday.</td>" +
                "</tr>";

                $("#sat_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });


// SUNDAY Moring Click
     $("#sun_morningdata").click(function(){
      var day=$("#sundayvaluedata").val();
      var doctor_id=$("#doctor_id").val();
      var sun_morningdata= $("#sun_morningdata").attr("name");
  
  if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
    var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+sun_morningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                 
                   var len = 0;
             $('#sun_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                   $("#suntab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#sun_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Sunday Morning.</td>" +
                "</tr>";

                $("#sun_timeslotdata").append(data);
             }
               }
            }); 
       }
 
  });

// SUNDAY Afternoon click

$("#sun_afternoondata").click(function(){
    
      var day=$("#sundayvaluedata").val();
  
    var doctor_id=$("#doctor_id").val();
      var sun_afternoondata= $("#sun_afternoondata").attr("name");
     if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
   
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+sun_afternoondata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                  
                   var len = 0;
             $('#sun_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                  $("#suntab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#sun_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Sunday Afternoon.</td>" +
                "</tr>";

                $("#sun_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });


// SUNDAY Evening click

$("#sun_eveningdata").click(function(){
      
      var day=$("#sundayvaluedata").val();
     //alert(day);
    var doctor_id=$("#doctor_id").val();
      var sun_eveningdata= $("#sun_eveningdata").attr("name");
    
   if( !$('#doctor_id').val() ) { 
  alert("Please Select Doctor First!!");
   }
   else
   {
  var url="{{url('gettimeslotrecord')}}/"+doctor_id+"/"+sun_eveningdata+"/"+day;
         $.ajax({
                url:url,
                method:"get",
                success:function(response)
                {
                   var len = 0;
             $('#sun_timeslotdata').empty(); // Empty <tbody>
              if(response != null){
              len = response.length;
             }
                if(len > 0){
                  $("#suntab").addClass("scroll");
              for(var i=0; i<len; i++){
                 var id = response[i].id;
                 var day = response[i].day;
                 var starttime = response[i].starttime;
                 var endtime = response[i].endtime;
                
   var data='<tr><td class="text-center">'+starttime+'</td><td style="border-right: solid 1px black;"></td><td class="text-center">'+endtime+'</td><td class="text-center"><button class="btn btn-danger" id="deletebtn" onclick="deletemondayrec('+id+')">Delete</button></td></tr>'
    $("#sun_timeslotdata").append(data);   
             }
             }
               else{
                var data = "<tr>" +
                    "<td align='center' colspan='4'>No Slot found in Sunday.</td>" +
                "</tr>";

                $("#sun_timeslotdata").append(data);
             }
               }
            }); 
       }
   
  });

});
</script>
<script type="text/javascript">
  function deletemondayrec(id)
  {

 var data=$("#slotform").serialize();
    var conf=confirm("Are you sure!!!!");
     if(conf==true){
       
 var deleteurl="{{url('deleterecord')}}/"+id;

       $.ajax({
                url:deleteurl,
                method:"DELETE",
                data:data, 
                success:function(data)
                { 
                //   alert("Data deleted successfully!!");
                // location.reload();
             


                }
            });
     }
  }
</script>

@endsection
  