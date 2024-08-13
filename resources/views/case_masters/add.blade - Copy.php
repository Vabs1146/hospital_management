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
       @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
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
           
           {{ Form::model($casedata, array('route' => array('case_masters.store'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                               Add/Modify Case master
                            </h2>
                          
                        </div>
                        <div class="body">
                          {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                          <div class="row clearfix">
                          <div class="col-md-12">
                            {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
                            <h3> Case Number : {{ $casedata['case_number'] }} </h3>
            {{ Form::hidden('patient_emailId', Request::old('patient_emailId'), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
                          </div>
                       
                          <div class="col-md-12">
                             <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('doctor_id','Doctor') }}
                              </div>
                             </div>
                              
                              <div class="col-md-4">
                              {{ Form::select('doctor_id',array(''=>'Please select') + $casedata['doctorlist']->toArray(), Request::old('doctor_id'), array('class' => 'form-control select2')) }}                          
                             </div>
                            
                         
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('patient_name', 'Patient Name') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::text('patient_name', Request::old('patient_name'), array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>  
                            </div>
                            
                            <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('patient_address', 'Patient Address') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_address', Request::old('patient_address'), array('class'=> 'form-control')) }}                            
                              </div>
                              </div>
                              </div>
                          

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('patient_emailId', 'Patient Email Id') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                               {{ Form::email('patient_emailId', Request::old('patient_emailId'), array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div> 
                            </div> 
                            
                            <div class="col-md-12">
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('patient_mobile', 'Patient mobile') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::number('patient_mobile', Request::old('patient_mobile'), array('class'=> 'form-control')) }}                           
                              </div>
                              </div>
                              </div>
                          
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                             {{ Form::label('male_female', 'Male/Female') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              
                               {{ Form::select('male_female', ['Male','Female'], Request::old('male_female'), array('class' => 'form-control select2')) }}                         
                              
                              </div> 
                            </div> 
                            
                             <div class="col-md-12">
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('patient_age', 'Patient age') }}
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::number('patient_age', Request::old('patient_age'), array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('patient_height', 'Height') }} 
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_height', Request::old('patient_height'), array('class'=> 'form-control')) }}                          
                              </div>
                              </div>
                              </div>
                          </div> 

                          <div class="col-md-12">
                               <div class="col-md-2">
                              <div class="form-group labelgrp">
                               {{ Form::label('patient_weight', 'Weight') }} 
                              </div>
                              </div>

                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_weight', Request::old('patient_weight'), array('class'=> 'form-control')) }}                         
                              </div>
                              </div>
                              </div>

                          </div> 

                         

<!---------------tabs---------------------------->
                    <div class="col-md-12" id="TabContainerDiv">
                        <ul class="nav nav-tabs tab-col-pink" role="tablist" id="Tabseyehistory">
                            <li role="presentation" class="active">
                                <a href="#Complaints" data-toggle="tab">Complaint</a>
                            </li>
                            <li role="presentation">
                                <a href="#Diagnosis" data-toggle="tab">Diagnosis</a>
                            </li>
                            <li role="presentation">
                                <a href="#Treatment" data-toggle="tab">Treatment</a>
                            </li>
                        </ul>

                        <div class="tab-content clearfix">
                    
                    <div class="tab-pane active" id="Complaints">
                        <div class="col-sm-4">
                            <b><u>memorized items</u></b>
                            <div style="max-height:200px; overflow:auto;">
                                <ul  class="list-group">
                                    {{ $eyeMemory['id'] = '', $eyeMemory['name'] = '' }}
                                    @forelse($casedata['field_type_memory']->where('field_type_id', '1') as $Memory)
                                        <li class="list-group-item clearfix"><a class="memoryList" data-id="{{$Memory['id']}}" href=""> {{ $Memory['title'] }} </a>
                                            {{-- <span class="pull-right button-group"> 
                                                <button type="submit" name="mem_edit" class="btn-link"><span class="glyphicon glyphicon-edit"></span> edit</button>
                                                <button type="submit" name="mem_delete" value="mem_delete" id="mem_delete" class="btn-link hidden"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                            </span> --}}
                                        </li>
                                    @empty
                                        <li  class="list-group-item"> No Data found </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sm-push-4">
                            {{ Form::label('complaint', 'Complaint') }} 
                            {{ Form::text('complaint', Request::old('complaint'), array('class'=> 'form-control')) }}
                            <br/><br/>
                            <div class="">
                                <button type="submit" name="Add_complaint" class="btn btn-defaul" value="Add_complaint" >
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                            <br/><br/>
                            {{-- <div class = "panel panel-default">
                                <div class = "panel-body"> --}}
                                <div style="max-height:200px; overflow:auto;">
                                    <ul  class="list-group">
                                        @forelse($casedata['field_type_data']->where('field_type_id', '1') as $fieldData)
                                            <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                                        @empty
                                            <li  class="list-group-item"> No Data found </li>
                                        @endforelse
                                    </ul>
                                </div>
                                {{-- </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane" id="Diagnosis">
                        <div class="col-sm-4">
                            <b><u>memorized items</u></b>
                            <div style="max-height:200px; overflow:auto;">
                                <ul  class="list-group">
                                    {{ $eyeMemory['id'] = '', $eyeMemory['name'] = '' }}
                                    @forelse($casedata['field_type_memory']->where('field_type_id', '2') as $Memory)
                                        <li class="list-group-item clearfix"><a class="memoryList" data-id="{{$Memory['id']}}" href=""> {{ $Memory['title'] }} </a>
                                            {{-- <span class="pull-right button-group"> 
                                                <button type="submit" name="mem_edit" class="btn-link"><span class="glyphicon glyphicon-edit"></span> edit</button>
                                                <button type="submit" name="mem_delete" value="mem_delete" id="mem_delete" class="btn-link hidden"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                            </span> --}}
                                        </li>
                                    @empty
                                        <li  class="list-group-item"> No Data found </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>  
                        <div class="col-sm-4 col-sm-push-4">
                            {{ Form::label('Diagnosis', 'Diagnosis') }} 
                            {{ Form::text('Diagnosis', Request::old('Diagnosis'), array('class'=> 'form-control')) }}
                            <br/><br/>
                            <div class="">
                                <button type="submit" name="Add_Diagnosis" class="btn btn-defaul" value="Add_Diagnosis" >
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                            <br/><br/>
                            {{-- <div class = "panel panel-default">
                                <div class = "panel-body"> --}}
                                <div style="max-height:200px; overflow:auto;">
                                    <ul  class="list-group">
                                        @forelse($casedata['field_type_data']->where('field_type_id', '2') as $fieldData)
                                            <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                                        @empty
                                            <li  class="list-group-item"> No Data found </li>
                                        @endforelse
                                    </ul>
                                </div>
                                    {{-- </div>
                            </div> --}}
                        </div>                                              
                    </div>
                    <div class="tab-pane" id="Treatment">
                        <div class="col-sm-4">
                            <b><u>memorized items</u></b>
                            <div style="max-height:200px; overflow:auto;">
                                <ul  class="list-group">
                                    {{ $eyeMemory['id'] = '', $eyeMemory['name'] = '' }}
                                    @forelse($casedata['field_type_memory']->where('field_type_id', '3') as $Memory)
                                        <li class="list-group-item clearfix"><a class="memoryList" data-id="{{$Memory['id']}}" href=""> {{ $Memory['title'] }} </a>
                                            {{-- <span class="pull-right button-group"> 
                                                <button type="submit" name="mem_edit" class="btn-link"><span class="glyphicon glyphicon-edit"></span> edit</button>
                                                <button type="submit" name="mem_delete" value="mem_delete" id="mem_delete" class="btn-link hidden"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                            </span> --}}
                                        </li>
                                    @empty
                                        <li  class="list-group-item"> No Data found </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>  
                        <div class="col-sm-4 col-sm-push-4">
                            {{ Form::label('Treatment', 'Treatment') }} 
                            {{ Form::text('Treatment', Request::old('Treatment'), array('class'=> 'form-control')) }}
                            <br/><br/>
                            <div class="">
                                <button type="submit" name="Add_Treatment" class="btn btn-defaul" value="Add_Treatment" >
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                            <br/><br/>
                            {{-- <div class = "panel panel-default">
                                <div class = "panel-body"> --}}
                                <div style="max-height:200px; overflow:auto;">    
                                    <ul  class="list-group">
                                        @forelse($casedata['field_type_data']->where('field_type_id', '3') as $fieldData)
                                            <li class="list-group-item clearfix">{{ $fieldData['field_data'] }}</li>
                                        @empty
                                            <li  class="list-group-item"> No Data found </li>
                                        @endforelse
                                    </ul>
                                </div>
                                    {{-- </div>
                            </div> --}}
                        </div>                                                
                    </div>
                        <div class="col-sm-4 col-sm-pull-4 tab">
                           
                                {{ Form::label('title', 'Title') }} 
                                <div class="form-line">
                                  {{ Form::text('title', '', array('class'=> 'form-control')) }}
                                </div>
                                
                            
                            <br>
                            <div class="form-group">
                                {{ Form::label('memory_data', 'Data') }} 
                                {{ Form::text('memory_data', '', array('class'=> 'form-control ')) }}
                            </div>
                                {{ Form::hidden('field_type_id', Request::old('field_type_id','#Complaints'), array('class'=> 'form-control', 'id'=>'field_type_id')) }}
                                {{ Form::hidden('memory_id', '', array('class'=> 'form-control', 'id'=>'memory_id')) }}
                            <button type="submit" name="drAddToMemory" class="btn-link" value="drAddToMemory" >
                                <i class="fa fa-plus"></i> Add To Memory
                            </button>
                            <button type="submit" name="mem_delete" value="mem_delete" id="mem_delete" class="btn-link hidden"><i class="fa fa-minus"></i> Remove From Memory</button>
                        </div>
                    </div>
                    </div>
<!---------------tabs---------------------------->  
<!---------------follow-up-date---------------------->   

                    <div class="col-md-12">
                        <h3><u>Follow up date.</u><h3>
                    </div>    
                    <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('FollowUpDoctor_id','Doctor') }}
                            </div>
                            </div>
                               
                            <div class="col-md-4 ">
                            <div class="form-group">
                           
                            {{ Form::select('FollowUpDoctor_id',array(''=>'Please select') + $casedata['doctorlist']->toArray(),Request::old('FollowUpDoctor_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}                   
                           
                            </div>
                            </div>
                             
                            <div class="col-md-2">
                             <div class="form-group labelgrp">
                              {{ Form::label('appointment_dt','Date') }}
                             </div>
                             </div>
                             <div class="col-md-4">
                           
                              <input type="text" name="appointment_dt" class="form-control datepicker" id="appointment_dt">
                             </div>     
                         </div>
                        
                         <div class="col-md-12">
                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            <label>Time Slot</label>
                            </div>
                            </div>
                              
                            <div class="col-md-4">
                            <div class="form-group">
                            
                            <select class="form-control select2" id="FollowUpTimeSlot" name="FollowUpTimeSlot" data-live-search="true"></select>
                            
                            </div>
                            </div> 

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('Before_file', 'Before image') }}
                            </div>
                            </div>
                            
                            <div class="col-md-4">
                            <div class="form-group">
                            {{ Form::file('Before_file', Request::old('Before_file'), array('class'=> 'form-control')) }}
                            @if(isset($casedata['Before_file']) && $casedata['Before_file'] != null)
                            <a href="{{Storage::disk('local')->url($casedata['Before_file']) }}" class="" target="_blank"> Before Image link</a>              
                            @endif                                                   
                            </div>
                            </div> 
                        </div>

                         <div class="col-md-12">
                           

                            <div class="col-md-2">
                            <div class="form-group labelgrp">
                            {{ Form::label('After_file', 'After image') }} 
                            </div>
                            </div>
                              
                            <div class="col-md-4">
                            <div class="form-group">
                              {{ Form::file('After_file', Request::old('After_file'), array('class'=> 'form-control')) }}
                              @if(isset($casedata['After_file']) && $casedata['After_file'] != null)
                                  <a href="{{ Storage::disk('local')->url($casedata['After_file']) }}" class="" target="_blank"> After Image link</a>              
                              @endif                                                   
                            </div>
                            </div> 
                        </div>
              
                         <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              {{ Form::label('sendemail','Send Email') }}
                              </div>
                              </div>


                              <div class="col-md-6">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('Email_To', null, array('class'
                                => 'form-control', 'autocomplete'=>'off')) }}                              
                              </div> 
                              </div>
                              </div>
                              <div class="col-md-4">
                          
                            <button type="submit" formaction="{{ url('Send_email') }}" name="Send_email" class="btn btn-success " value="Send_email">Email</button>&nbsp;
                              </div>
                              </div>
 <!---------------follow-up-date---------------------->       

                           
                            <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-3">
                            <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                            <i class="fa fa-plus"></i> Submit
                            </button>
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                @if( isset($casedata['id']))
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters/print/').'/'.$casedata['id'] }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i>Print</a>
                                @endif
                
                 <button type="submit" name="Submit_email" formaction="{{ url('Send_email') }}" class="btn btn-primary btn-lg" value="Submit_email"><i class="fa fa-plus"></i> Submit & Email
                                  </button>&nbsp;
                                </div>
                                </div>
                               
                            </div>

                            
                        </div>
                        {{ Form::close() }}
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
   
        
        $("#Tabseyehistory a[href='"+$("#field_type_id").val()+"']").tab('show');
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href");
            $("#field_type_id").val(target);
            $("#memory_id").val('');
        });
        $("#TabContainerDiv a.memoryList").on('click',function(e){
            e.preventDefault();
            $("#memory_id").val($(this).data('id'));
            $("button[name='mem_delete']").addClass('hidden');
            $.get('/getMemoryDetials/'+$(this).data('id'),function(data){
                 $("input[name='title']").val(data.title);
                 $("input[name='memory_data']").val(data.data);
                 if(data.field_type_id = "1"){
                    $("input[name='complaint']").val(data.data);
                 }
                 if(data.field_type_id = "2"){
                    $("input[name='Diagnosis']").val(data.data);
                 }
                 if(data.field_type_id = "3"){
                    $("input[name='Treatment']").val(data.data);
                 }
                 $("button[name='mem_delete']").removeClass('hidden');
            });
           
        });


        $("#appointment_dt").on('change.dp', function (e) {
        $("#FollowUpTimeSlot").empty();
        //alert(this.value);         //Date in full format alert(new Date(this.value));
        var inputDate = new Date(this.value);
        var FollowUpDoctor_id = $("#FollowUpDoctor_id").val();
       

        var appointment_dt = $('#appointment_dt').val();
    
       
        
        var url1="{{url('avaibaletimeslotscasemaster')}}/"+FollowUpDoctor_id+'/'+appointment_dt;
    //alert(url1);

        $.ajax({
            url:url1,
           
            type:'GET',
            success:function(response) {
        //alert(response);
             if(response==0)
                  {
                    $("#FollowUpTimeSlot").append('<option value=" ">No Slots Available</option>');
                    $("#FollowUpTimeSlot").selectpicker("refresh");
                 }

                    else
                 {
                 
                        for(var i=0;i<response['timeslot1'].length;i++){
                  
                     var starttime= response['timeslot1'][i];
                    
                  
                     var toAppend = '<option value="'+starttime+'">'+starttime+'</option>';
                      $('#FollowUpTimeSlot').append(toAppend);
                      $("#FollowUpTimeSlot").selectpicker("refresh");
                  
                  
               

                
               
            }
   

                 }
              }
        }); 



    });
    });
</script>

<!-- jQuery Easing -->


@endsection


