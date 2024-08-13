

@php //echo "========= <pre>"; print_r($sp_test_image); exit;@endphp
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

<style>

    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}


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
    #button {
  display: inline-block;
  background-color: #FF9800;
  text-decoration: none;
  width: 36px;
  height: 37px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 52px;
  right: 33px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  color: white;
  visibility: hidden;
  z-index: 1000;
}
#button::after {
 
  font-family: 'Material Icons';
  font-weight: bolder;
  font-style: normal;
  font-size: 1em;
  line-height: 40px;
  color: white;
}
#button:hover {
  cursor: pointer;
  background-color: #333;
}
#button:active {
  background-color: #555;
}
#button.show {
  opacity: 1;
  visibility: visible;
}
.details-section {
    color: initial;
    /* background-color: white; */
    text-align: center;
    margin-bottom: 7px;
    padding-top: 4px;
    padding-bottom: 1px;
    margin-top: -2px;
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
           
           {{ Form::model($casedata, array('route' => array('save-psychiatrist-followup'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}
                        
                        <div class="body">
                          {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                          <div class="row clearfix">
                          
                     

<!---------------follow-up-date---------------------->   

                   
                    <div class="col-md-12 col-md-offset-1">
						<div class="col-md-2 ">
							<div class="form-group labelgrp">
								{{ Form::label('FollowUpDoctor_id','Doctor : ') }} 
								<input type="hidden" name="FollowUpDoctorID"  id="FollowUpDoctorID" value="{{$casedata['doctor_id']}}">
							</div>
						</div>
						<div class="col-md-6 ">

							{{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $casedata['doctorlist']->toArray(),$casedata['doctor_id'],array('class' => 'form-control select2','disabled'=>'true')) }}

						</div>     
					</div>

					<div class="col-md-12 col-md-offset-1">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								{{ Form::label('casehistory_followup_notes','Note : ') }} 
							</div>
						</div>
						<div class="col-md-6">
							<textarea name="casehistory_followup_notes" id="casehistory_followup_notes" class="form-control">{{$case_master_data->casehistory_followup_notes??''}}</textarea>
						</div>     
					</div>

					<div class="col-md-12 col-md-offset-1">
						<div class="col-md-2">
							<div class="form-group labelgrp">
								{{ Form::label('appointment_dt','Follow up Date : ') }} 
							</div>
						</div>
						<div class="col-md-6">
							<input type="text" name="appointment_dt" id="appointment_dt" class="form-control datepicker">
						</div>     
					</div>
                        
                    <input type="hidden" readonly name="FollowUpTimeSlot" id="FollowUpTimeSlot" class="form-control">
					<!--                              ===============================================================-->
					<div class="col-md-12 col-sm-12 col-xs-12" id="slotdiv">
						<div class="card">
							<div class="header bg-pink">
								<h2>Time Slots for Appoinment </h2>
							</div>
							<div class="body">
								<div class="row clearfix">
									<div class="col-md-12" id="slotsrec">
										<div class="col-md-12" style="display: none;" id="slodrec">
											<div class="form-group">
												<div class="col-md-12" >
													<div class="" id="noslot"></div>
													<div class="col-md-6">
														<div id="Morning" class="align-items-center" style="display: none;">
															<b>Morning Slot</b>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="MorningSlots">
													<div id="appdate"></div>
												</div>
												<div class="col-md-12">
													<div class="col-md-6">
														<div id="Afternoon" style="display: none;">
															<b>Afternoon Slot</b>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="AfternoonSlots">
													<div id="appdate2"></div>
												</div>
												<div class="col-md-12">
													<div class="col-md-6">
														<div id="Evening" style="display: none;">
															<b>Evening Slot</b>
														</div>
													</div>
												</div>
												<div class="col-md-12" id="EveningSlots">
													<div id="appdate1"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

                       
 <!---------------follow-up-date---------------------->       

                           
                            <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-3">
                            <div class="">
                            <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                            <i class="fa fa-plus"></i> Submit
                            </button>
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                @if( isset($casedata['id']))
                                <!-- <a class="btn btn-default btn-lg" href="{{ url('/case_masters/print/').'/'.$casedata['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a> -->
                                @endif
                
                 <!-- <button type="submit" name="Submit_email" formaction="{{ url('Send_email') }}" class="btn btn-primary btn-lg" value="Submit_email"><i class="fa fa-plus"></i> Submit & Email
                                  </button>&nbsp; -->
                                </div>
                                </div>
                               
                            </div>

                            
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>


</div>

  <div class="modal fade" id="img_Modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_title">Document</h4>
        </div>
        <div class="modal-body"  id='print_ascan_document'>
			<img style="width: 100%;" id="modal_img" src="">
			<div id="image_data"></div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button"  onclick='printDiv();' class="btn btn-default">print</button>  -->
		  
		  <form method="POST" action="{{url('/print-upload-case-form-image')}}">
		  {{ csrf_field() }}
			<input type="hidden" id="image_to_print" name="image_to_print" value="">
			<input type="hidden" id="image_to_print_title" name="image_to_print_title" value="">

			<input class="btn btn-default" type="submit" name="submit" value="Print" formtarget="_blank">
		  </form>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


