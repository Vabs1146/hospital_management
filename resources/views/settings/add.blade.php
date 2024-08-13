@extends('adminlayouts.master')
@section('content')
@section('content')
@php $permissions = session('permissions'); 
//echo "====1111111===>>> <pre>"; print_r($all_settings); exit;

//echo "====1111111===>>> <pre>"; print_r(AUTH::user()); exit;
@endphp
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
                <form action="{{ url('/settings') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @if (isset($model))
                    <input type="hidden" name="_method" value="PATCH">
                    @endif
                    <div class="header bg-pink">
                        <h2>Add/Modify Settings</h2>
                    </div>


                    <div class="body">
                        <div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Hospital Name :</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="hospital_name" id="hospital_name" class="form-control" value="{{$all_settings['hospital_name']->value}}">
                                        </div>
                                    </div>
                                </div>
								@if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_hospital_name" value="Update">
                                    </div>
                                </div>
								@endif
                            </div>



                        <div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Hospital Logo :</label>
                                    </div>
                                </div>

                                <div class="col-md-{{($all_settings['hospital_logo']->value != "") ? '4' : '6'}}">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="hospital_logo" id="hospital_logo" class="form-control">
                                        </div>
                                    </div>
									
                                </div>
								@if($all_settings['hospital_logo']->value != "")
									<div class="col-md-2">
									<a target="_blank" href="{{url('/')}}/uploads/images/{{$all_settings['hospital_logo']->value}}"><img style="width: 100px;" src="{{url('/')}}/uploads/images/{{$all_settings['hospital_logo']->value}}"></a>
									</div>
								@endif
								@if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_hospital_logo" value="Update">
                                    </div>
                                </div>
								@endif
                            </div>

							<div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Doctor Name :</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="doctor_name" id="doctor_name" class="form-control" value="{{$all_settings['doctor_name']->value}}">
                                        </div>
                                    </div>
                                </div>
								@if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_doctor_name" value="Update">
                                    </div>
                                </div>
								@endif
                            </div>

							<div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">UHID Prefix :</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="uhid_prefix" id="uhid_prefix" class="form-control" value="{{$all_settings['uhid_prefix']->value}}">
                                        </div>
                                    </div>
                                </div>
								@if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_uhid_prefix" value="Update">
                                    </div>
                                </div>
								@endif
                            </div>

							<div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">OPD Bill Number :</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="bill_number" id="bill_number" class="form-control" value="{{$all_settings['bill_number']->value}}">
                                        </div>
                                    </div>
                                </div>
								@if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_bill_number" value="Update">
                                    </div>
                                </div>
								@endif
                            </div>

                            <!-- <div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">IPD  NO  :</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="ipd_prefix" id="doctor_name" class="form-control" value="{{$all_settings['ipd_prefix']->value}}">
                                        </div>
                                    </div>
                                </div>
                                @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_IPD_Number" value="Update">
                                    </div>
                                </div>
                                @endif
                            </div>
                             <div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">IPD Bill Number :</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" name="ipd_bill_prefix" id="bill_number" class="form-control" value="{{$all_settings['ipd_bill_prefix']->value}}">
                                        </div>
                                    </div>
                                </div>
                                @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_IPD_bill_number" value="Update">
                                    </div>
                                </div>
                                @endif
                            </div>  -->
							
                            <div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Webcam :</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div>
                                        <div>
                                            <input style="opacity: unset;position: relative;left: auto;" type="radio" name="webcam" value="1" {{($all_settings['webcam']->value == '1') ? 'checked' : ''}}> Enabled
                                            <input style="opacity: unset;position: relative;left: auto;" type="radio" name="webcam" value="0" {{($all_settings['webcam']->value == '0') ? 'checked' : ''}}> Disabled
                                        </div>
                                    </div>
                                </div>
                                @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_webcam" value="Update">
                                    </div>
                                </div>
                                @endif
                            </div>
                        
                        
                       <!-- =================================================== -->
                       
                       <!-- <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Top Bar :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <div>
                                        <input style="opacity: unset;position: relative;left: auto;" type="radio" name="top_bar" value="1" {{(isset($all_settings['top_bar']) && $all_settings['top_bar']->value == '1') ? 'checked' : ''}}> Enabled
                                        <input style="opacity: unset;position: relative;left: auto;" type="radio" name="top_bar" value="0" {{(isset($all_settings['top_bar']) && $all_settings['top_bar']->value == '0') ? 'checked' : ''}}> Disabled
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_top_bar" value="Update">
                                </div>
                            </div>
                            @endif
                        </div>  -->
<!--                        
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Twitter Link :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="twitter_link" id="twitter_link" class="form-control" value="{{$all_settings['twitter_link']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_twitter_link" value="Update">
                                </div>
                            </div>
                            @endif
                        </div> 
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Facebook Link :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="fb_link" id="fb_link" class="form-control" value="{{$all_settings['fb_link']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_fb_link" value="Update">
                                </div>
                            </div>
                            @endif
                        </div> 
                       
                       
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">LinkedIn Link :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="linkedin_link" id="linkedin_link" class="form-control" value="{{$all_settings['linkedin_link']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_linkedin_link" value="Update">
                                </div>
                            </div>
                            @endif
                        </div> 
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Instagram Link :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="insta_link" id="twitter_link" class="form-control" value="{{$all_settings['insta_link']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_insta_link" value="Update">
                                </div>
                            </div>
                            @endif
                        </div> 
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Opening Hours :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="openeing_hours" id="openeing_hours" class="form-control" value="{{$all_settings['openeing_hours']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_openeing_hours" value="Update">
                                </div>
                            </div>
                            @endif
                        </div> 
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Opening Hours Text :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="openeing_hours_text" id="openeing_hours_text" class="form-control" value="{{$all_settings['openeing_hours_text']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_openeing_hours_text" value="Update">
                                </div>
                            </div>
                            @endif
                        </div> 
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Appointment Number :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="appointment_number" id="appointment_number" class="form-control" value="{{$all_settings['appointment_number']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            @if($permissions['settings']->edit_permission || AUTH::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_appointment_number" value="Update">
                                </div>
                            </div>
                            @endif
                        </div>  -->
                       <!-- =================================================== -->

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
