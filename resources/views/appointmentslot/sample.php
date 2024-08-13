@extends('adminlayouts.master')
@section('content')
<section class="content">
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <form action="{{ route('saveappintmentslot')}}" method="POST" class="form-horizontal" id="slotform">
                          {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                                Appointments Time Slot
                            </h2>
                          
                        </div>
                         <div class="form-group">
                          @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
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
                               <select id="doctor_id" name="doctor_id" class="form-control"  required>
                                <option selected value disabled>Select Doctor</option>
                                @foreach($doctor_list as $doctorlist)
                                <option value="{{ $doctorlist->id }}">{{ $doctorlist->doctor_name}}</option>
                                @endforeach
                              
                            </select>
                              </div>
                              </div>  

                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label>Day :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                             <select name="day" id="day" class="form-control" > 
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
                                 <select name="morningstarttime" id="morningstarttime" class="morningstarttime form-control"  style="width: 121%;">
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
                                 <select name="morningendtime" id="morningendtime" class="morningendtime form-control"  style="width: 121%;">
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
                              <label> Minute Difference Time :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                <select name="morningminute" id="time_diff_minute" class=" time_diff_minute form-control" >
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
                                 <select name="afternoonstarttime" id="afternoonstarttime" class=" afternoonstarttime form-control"  style="width: 121%;">
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
                                <select name="afternoonendtime" id="afternoonendtime" class="afternoonendtime form-control"  style="width: 121%;">
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
                              <label> Minute Difference Time :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                                 <select name="afternoonminute" id="time_diff_minute" class=" time_diff_minute form-control" >
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
                               <select name="eveningstarttime" id="eveningstarttime" class=" eveningstarttime form-control"  style="width: 121%;">
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
                               <select name="eveningendtime" id="eveningendtime" class="eveningendtime form-control"  style="width: 121%;">
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
                              <label> Minute Difference Time :</label>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group">
                               <select name="eveningminute" id="time_diff_minute" class=" time_diff_minute form-control" >
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
                                <button type="submit" class="btn btn-lg btn-primary waves-effect"><span> <i class="glyphicon glyphicon-plus btnicons"></i>Submit</span>
                                </button>
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('admin') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
                            </div>
                        <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">HOME</a></li>
                                        <li role="presentation"><a href="#profile_animation_1" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#messages_animation_1" data-toggle="tab">MESSAGES</a></li>
                                        <li role="presentation"><a href="#settings_animation_1" data-toggle="tab">SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b>Home Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="settings_animation_1">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">HOME</a></li>
                                        <li role="presentation"><a href="#profile_animation_2" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#messages_animation_2" data-toggle="tab">MESSAGES</a></li>
                                        <li role="presentation"><a href="#settings_animation_2" data-toggle="tab">SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b>Home Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="profile_animation_2">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="messages_animation_2">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="settings_animation_2">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                </div>



                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TABS WITH CUSTOM ANIMATIONS
                                <small>You can use different animation class. We used Animation.css which link is <a href="https://daneden.github.io/animate.css/" target="_blank">https://daneden.github.io/animate.css/</a></small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_1" data-toggle="tab">HOME</a></li>
                                        <li role="presentation"><a href="#profile_animation_1" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#messages_animation_1" data-toggle="tab">MESSAGES</a></li>
                                        <li role="presentation"><a href="#settings_animation_1" data-toggle="tab">SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated flipInX active" id="home_animation_1">
                                            <b>Home Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="profile_animation_1">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="messages_animation_1">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated flipInX" id="settings_animation_1">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                        <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">HOME</a></li>
                                        <li role="presentation"><a href="#profile_animation_2" data-toggle="tab">PROFILE</a></li>
                                        <li role="presentation"><a href="#messages_animation_2" data-toggle="tab">MESSAGES</a></li>
                                        <li role="presentation"><a href="#settings_animation_2" data-toggle="tab">SETTINGS</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane animated fadeInRight active" id="home_animation_2">
                                            <b>Home Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="profile_animation_2">
                                            <b>Profile Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="messages_animation_2">
                                            <b>Message Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane animated fadeInRight" id="settings_animation_2">
                                            <b>Settings Content</b>
                                            <p>
                                                Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram moderatius.
                                                Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent
                                                aliquid pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere
                                                gubergren sadipscing mel.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


</div>

        @endsection
  