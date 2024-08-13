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
    <div class="list-group list-group-horizontal">
        @forelse ($DateWiseRecordLst as $VisitListDateWise)
                @if($case_master['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/insuranceBill').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					 <div class="form-group">
                          @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                  </div>
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>
                                Eye Operation Notes
                            </h2>
                          
                        </div>
                        
    <form action="{{ url('/eyeoperation'.( isset($case_master) ? "/" . $case_master['id'] : "")) }}" method="POST" class="form-horizontal" enctype = 'multipart/form-data' >
                {{ csrf_field() }}

                @if (isset($case_master))
                    <input type="hidden" name="_method" value="PATCH">
                @endif
                        <div class="body">
                           <input type="hidden" id="case_id" name="case_id" value="{{ $case_master['id'] or ''}}" >
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number" class="form-control">Case Number :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" readonly='readonly' value="{{ $case_master['case_number'] or ''}}">              
                              </div>
                              </div>
                              </div>  

                            <!--    <div class="col-md-2">
                                                             <div class="form-group labelgrp">
                                                             <label for="patient_name" class="form-control">Name Of Patient :</label>
                                                             </div>
                                                             </div>
                               
                                                             <div class="col-md-4">
                                                             <div class="form-group">
                                                             <div class="form-line">
                                <input type="text" name="patient_name" id="patient_name" class="form-control" value="{{ $case_master['patient_name'] or ''}}">
                                                             </div>  
                                                             </div>
                                                             </div> -->


                              </div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label for="patient_name" class="form-control">Name <b class="star">*</b> :</label>
		</div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
			<div class="demo-radio-button" style="padding-top: 6px">
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_1" value="Mr." {{($case_master['mr_mrs_ms'] == "Mr.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_1" style="min-width: 50px;">Mr.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_2" value="Mrs." {{($case_master['mr_mrs_ms'] == "Mrs.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_2" style="min-width: 50px;">Mrs.</label>
				<input type="radio" name="mr_mrs_ms" id="mr_mrs_ms_3" value="Ms." {{($case_master['mr_mrs_ms'] == "Ms.") ? 'checked' : ''}} required />
				<label for="mr_mrs_ms_3" style="min-width: 50px;">Ms.</label>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">				
				{{ Form::text('patient_name',$case_master['patient_name'], array('class' => 'form-control', 'required')) }}  
			</div>
		</div>
	</div>

	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('middle_name',$case_master['middle_name'], array('class' => 'form-control', 'placeholder'=>'Middle Name','id'=>'middle_name')) }}                          
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('last_name',$case_master['last_name'], array('class' => 'form-control', 'placeholder'=>'Surname','id'=>'last_name')) }}                          
			</div>
		</div>
	</div>
</div>
		

                              <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="name_of_age" class="form-control">Age :</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_age" id="patient_age" class="form-control"  value="{{ $case_master['patient_age'] or ''}}">                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="male_female" class="form-control">Sex :</label>
                              </div>
                              </div>

                              <div class="col-md-4">
                                 <div class="form-group">
                              <div class="demo-radio-button" style="padding-top: 12px">
                              <input name="male_female" type="radio" id="radio_8" class=" with-gap radio-col-pink" value="Male" required  {{ ($case_master->male_female == "Male")? "checked=\"checked\"" : "" }}  />
                              <label for="radio_8">Male</label>
                              <input name="male_female" type="radio" id="radio_10" class="with-gap radio-col-deep-purple"value="Female" required   {{ ($case_master->male_female == "Female")? "checked=\"checked\"" : "" }} />
                              <label for="radio_10">Female</label>
                              </div>
                              </div>
                              
                              </div>   

                              </div>

<div class="col-md-12">
	<div class="col-md-2">
		<div class="form-group labelgrp">
			<label class="form-control"> Address <b class="star">*</b>:</label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<div class="form-line">
				{{ Form::text('patient_address', Request::old('patient_address', $case_master->patient_address), array('class' => 'form-control', 'placeholder'=>'Address')) }}       
			</div>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">     {{ Form::text('area', Request::old('area', $case_master->area), array('class' => 'form-control', 'placeholder'=>'Area')) }}                             
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('city', Request::old('city', $case_master->city), array('class' => 'form-control', 'placeholder'=>'City')) }}               
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<div class="form-line">
			{{ Form::text('district', Request::old('district', $case_master->district), array('class' => 'form-control', 'placeholder'=>'District')) }}                            
			</div>
		</div>
	</div>
</div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="surgery_name" class="form-control">Surgery</label>
                              </div>
                              </div>
                              <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('surgery_name', Request::old('surgery_name',$eyeoperation->surgery_name), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>
                              </div>

                                <div class="col-md-12" id="surgeryDetails">
                                    <legend class="text-center">Surgery Details </legend>
                                        <div class="col-md-2">
                                        <label for="surgery_details[]" class="control-label">&nbsp;</label>
                                        </div>
                                        <div class="col-md-8">
                                        <input type="text" name="surgery_details[]" id="patient_name" class="form-control" value=""> 
                                        </div>
                                        <div class="col-md-1 ">
                                        <button id="addSurgeryDetails" class="btn btn-default">Add</button>
                                        </div>  
                                </div>
                                
                              <div class="dbSurgeryName">
                                  @foreach ($eyeoperation->eye_op_nt_surgery_details()->get() as $item)
                                  <div class="form-group dbSurgeryNameItem">
                                      <div class="col-md-2">
                                        <label for="surgery_details[]" class="control-label">&nbsp;</label>
                                        </div>
                                      <div class="col-md-8 ">
                                          <div class="form-line">
                                            <input type="text" class="form-control" readonly value="{{$item->surgery_details}}">
                                          <input type="hidden" class="surgeryDetail_id" value="{{$item->id}}" />
                                          </div>
                                          
                                      </div>
                                      <div class="col-md-1">
                                        
                                          <button class="removeDbSurgeryItem btn btn-default">Remove</button>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="notes" class="form-control">Notes:</label>
                              </div>
                              </div>
                              <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('notes', Request::old('notes',$eyeoperation->notes), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              </div>
                              </div>
                              </div>
                              
                            </div>
                            <div class="row clearfix" id="AnesthetistNote"> 
                              <legend class="text-center">Anesthetist Notes</legend>
                              <div class="col-md-12">
                                  {{ Form::label('an_history','History') }} 
                                  {{ Form::text('an_history', Request::old('an_history',$anesthetist_notes->an_history), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_allergies','Allergies') }} 
                                  {{ Form::text('an_allergies', Request::old('an_allergies',$anesthetist_notes->an_allergies), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_pulse','Pulse') }} 
                                  {{ Form::text('an_pulse', Request::old('an_pulse',$anesthetist_notes->an_pulse), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_cardiac_history','Cardiac History') }} 
                                  {{ Form::text('an_cardiac_history', Request::old('an_cardiac_history',$anesthetist_notes->an_cardiac_history), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_bp','BP') }} 
                                  {{ Form::text('an_bp', Request::old('an_bp',$anesthetist_notes->an_bp), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_investigations','Investigations') }} 
                                  {{ Form::text('an_investigations', Request::old('an_investigations',$anesthetist_notes->an_investigations), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_nbm_notnbm','NBM/NotNBM') }} 
                                  {{ Form::text('an_nbm_notnbm', Request::old('an_nbm_notnbm',$anesthetist_notes->an_nbm_notnbm), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('an_dentition','Dentition') }} 
                                  {{ Form::text('an_dentition', Request::old('an_dentition',$anesthetist_notes->an_dentition), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <legend class="text-center">Intra-Operative Notes</legend>
                              <div class="col-md-12">
                                  {{ Form::label('ion_anesthesia_topical_peribular_given_by','Anesthesia:Topical/Peribulbar given by') }} 
                                  {{ Form::text('ion_anesthesia_topical_peribular_given_by', Request::old('ion_anesthesia_topical_peribular_given_by',$anesthetist_notes->ion_anesthesia_topical_peribular_given_by), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('ion_pulse','Pulse') }} 
                                  {{ Form::text('ion_pulse', Request::old('ion_pulse',$anesthetist_notes->ion_pulse), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('ion_o_saturation','O2 Saturation') }} 
                                  {{ Form::text('ion_o_saturation', Request::old('ion_o_saturation',$anesthetist_notes->ion_o_saturation), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('ion_bp','BP') }} 
                                  {{ Form::text('ion_bp', Request::old('ion_bp',$anesthetist_notes->ion_bp), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <legend class="text-center">Post-Operative Notes</legend>
                              <div class="col-md-12">
                                  {{ Form::label('pon_pulse','Pulse') }} 
                                  {{ Form::text('pon_pulse', Request::old('pon_pulse',$anesthetist_notes->pon_pulse), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('pon_bp','BP') }} 
                                  {{ Form::text('pon_bp', Request::old('pon_bp',$anesthetist_notes->pon_bp), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('pon_o_saturation','O2 Saturation') }} 
                                  {{ Form::text('pon_o_saturation', Request::old('pon_o_saturation',$anesthetist_notes->pon_o_saturation), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                              <div class="col-md-12">
                                  {{ Form::label('pon_additional_note','Additional Note') }} 
                                  {{ Form::text('pon_additional_note', Request::old('pon_additional_note',$anesthetist_notes->pon_additional_note), array('class' => 'form-control', 'autocomplete'=>'off')) }}
                              </div>
                            </div>
                             <div class="row clearfix">
                              <div class="col-md-4 col-md-offset-4">
                              <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                              </button>&nbsp;
                              <a class="btn btn-default btn-lg" href="{{ url('/eyeoperation/print').'/'. $case_master->id }}" target="_blank"><i class="glyphicon glyphicon-print"></i> Print </a>&nbsp;
                              <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$case_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
                              </div>
                              </div>   
                            </div>

                            
                        </div>
                      </form>
                      <div id="templateContainner" style="display:none">
                        <div id="surgeryDetailsTemplate">
                            <div class="form-group">
                              <div class="col-md-2">
                                        <label for="surgery_details[]" class="control-label">&nbsp;</label>
                                        </div>
                                <div class="col-md-8">
                                    
                                    <div class="form-line">
                                       <input type="text" name="surgery_details[]" class="form-control surgeryDetailsTxt" value="">
                                    </div>
                                   
                                </div>
                                <div class="col-md-1">
                                
                                    <button class="removeSurgeryItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                                </div>
                            </div>            
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
   $(document).ready(function() {
   });
   $(".select2").select2();
 </script>
<script type="text/javascript">
    $(document).ready(function(){
      //$('.datepicker').datepicker({
           // format: "dd/M/yyyy",
           // weekStart: 1,
           // clearBtn: true,
           // daysOfWeekHighlighted: "0,6",
           // autoclose: true,
       // });

        $('#addSurgeryDetails').click(function(e){
            e.preventDefault();
            var template = $("#surgeryDetailsTemplate").clone();
            $(template).find('.surgeryDetailsTxt').attr('value', $("#surgeryDetails").find('#patient_name').val());
            $("#surgeryDetails").find('#patient_name').val('');
            $("#surgeryDetails").append($(template).html());
        });
        $('#surgeryDetails').on('click', '.removeSurgeryItem', function(e){
          e.preventDefault();
          $(this).closest('div.form-group').remove();
          //$('#surgeryDetails').remove($(this).closest('div.form-group'));
          return false;
        });
        $(".removeDbSurgeryItem").click(function(e){
            e.preventDefault();
            if(confirm('You really want to delete this record?')) {
               var ClickedButton = $(this);
               var containerDiv = $(this).closest('div.dbSurgeryNameItem');
               $(ClickedButton).button('loading');
               $.ajax({ url: '{{ url('/eyeoperation/deleteSurgeryDetials') }}/' + $(containerDiv).find('.surgeryDetail_id').val(), 
                    type: 'DELETE',
                    data: {_method: 'delete', 
                           _token :$("input[name='_token'][type='hidden']").val(),
                           surgery_details_id : $(containerDiv).find('.surgeryDetail_id').val()
                          }
                    })
                .success(function() {
                    $(containerDiv).remove();
                    $(ClickedButton).button('reset');
                }).error(function(){
                    $(ClickedButton).button('reset');
                });
            }
        });
    });
</script>
@endsection
  