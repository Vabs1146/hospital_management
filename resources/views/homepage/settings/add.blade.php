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
                <form action="{{ url('/new-update-settings') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    @if (isset($model))
                    <input type="hidden" name="_method" value="PATCH">
                    @endif
                    <div class="header bg-pink">
                        <h2>Add/Modify Settings</h2>
                    </div>


                    <div class="body">
                        <div class="row clearfix ">                            
                               {{-- <div class="col-md-4">
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
                                </div> --}}
								
								<div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Top Slider Text :</label>
                                    </div>
                                </div>

								<div class="col-md-6">
									<div class="form-group">
										<div class="form-line">
											<textarea type="text" class="form-control" id="top_slider_text" name="top_slider_text" placeholder="value" required>{{$all_settings['top_slider_text']->value}}</textarea>
										</div>
									</div>
								</div>
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_top_slider_text" value="Update">
                                    </div>
                                </div>
                            </div>

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
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_twitter_link" value="Update">
                                </div>
                            </div>
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
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_fb_link" value="Update">
                                </div>
                            </div>
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
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_linkedin_link" value="Update">
                                </div>
                            </div>
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
                          
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_insta_link" value="Update">
                                </div>
                            </div>
                        </div> 



                        <div class="row clearfix ">                            
                                <div class="col-md-4">
                                    <div class="form-group labelgrp">
                                        <label class="form-control">Logo :</label>
                                    </div>
                                </div>

                                <div class="col-md-{{($all_settings['hospital_logo']->value != "") ? '4' : '6'}}">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" name="hospital_logo" id="hospital_logo" class="form-control">
                                        </div>
                                    </div>
									
                                </div>
									<div class="col-md-2">
									<a target="_blank" href="{{url('/')}}/uploads/images/{{$all_settings['hospital_logo']->value}}"><img style="width: 100px;" src="{{url('/')}}/uploads/images/{{$all_settings['hospital_logo']->value}}"></a>
									</div>
								<div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <input type="submit" name="update_hospital_logo" value="Update">
                                    </div>
                                </div>
                            </div>
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Call now number :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="call_now" id="call_now" class="form-control" value="{{$all_settings['call_now']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_call_now" value="Update">
                                </div>
                            </div>
                        </div> 

						
                       
                       <div class="row clearfix ">                            
                            <div class="col-md-4">
                                <div class="form-group labelgrp">
                                    <label class="form-control">Appointment Link :</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="appointment_link" id="appointment_link" class="form-control" value="{{$all_settings['appointment_link']->value??''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group labelgrp">
                                    <input type="submit" name="update_appointment_link" value="Update">
                                </div>
                            </div>
                        </div> 

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Whatsapp :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="whatsapp" id="whatsapp" class="form-control" value="{{$all_settings['whatsapp']->value}}">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_whatsapp" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Address :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
<textarea type="text" class="form-control" id="address" name="address" placeholder="Address" >{{$all_settings['address']->value}}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_address" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Email :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="email" id="email" class="form-control" value="{{$all_settings['email']->value}}">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_email" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Call Us :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="call_us" id="call_us" class="form-control" value="{{$all_settings['call_us']->value}}">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_call_us" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Google Map Iframe :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
<textarea type="text" class="form-control" id="google_map" name="google_map" placeholder="Google Map Iframe " required>{{$all_settings['google_map']->value}}</textarea>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_google_map" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Copyright Text :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="copyright" id="copyright" class="form-control" value="{{$all_settings['copyright']->value}}">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_copyright" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Header olor :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="header_color" id="header_color" class="form-control" value="{{isset($all_settings['header_color']) ? $all_settings['header_color']->value : ''}}">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_header_color" value="Update">
								</div>
							</div>
						</div>

						<div class="row clearfix ">                            
							<div class="col-md-4">
								<div class="form-group labelgrp">
									<label class="form-control">Footer Color :</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="footer_color" id="footer_color" class="form-control" value="{{isset($all_settings['footer_color']) ? $all_settings['footer_color']->value : ''}}">
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group labelgrp">
									<input type="submit" name="update_footer_color" value="Update">
								</div>
							</div>
						</div>

<!-- ========================================================================================== -->
							<!--  -->
                       <!-- =================================================== -->

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
