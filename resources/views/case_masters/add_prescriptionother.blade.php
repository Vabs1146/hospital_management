@extends('adminlayouts.master')
<style type="text/css">
  .medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton{
  color: #700;
  cursor: pointer;
}

.medicineremoveButton,.eyeremoveButton,.dayremoveButton,.timesadayremoveButton:hover {
  color: #f00;
}

</style>
@section('style')
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="list-group list-group-horizontal">
        @forelse ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/AddEdit/prescription').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/AddEdit/prescription').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
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
          {{ Form::model($casedata, array('url' => url('/AddEdit/prescriptionother/'.$casedata['id']), 'method' => 'POST','id'=>'eyeform',  'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Add/Modify Prescription </h2>
          </div>
              <div class="form-group">
                {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
            </div>
              <div class="body">
                  <div class="row clearfix">
                            <div class="col-md-12 ">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Patient Name :</label>
                              </div>
                              </div>

                               <div class="col-md-8">
                              <div class="form-group">
                              <div class="form-line">
                              {{ Form::text('patient_name', Request::old('patient_name'), array('class'=> 'form-control','readonly'=>'readonly')) }}                            
                              </div>
                              </div>
                              </div> 
                              </div>   

                             <div class="col-md-12">
                             <div class="form-group">
                             <h3 class="text-center"><u>Prescription.</u><h3>
                             </div>
                             </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Medicine :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>

                              <div class="col-md-4">
                              <button type="button" name="add" id='medicinetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='medicinebtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='MedicineTextBoxesGroup' class="col-md-12">

                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Quantity :</label>
                              </div>
                              </div>
                              <div class="col-md-6">
                              {{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>
                              <div class="col-md-4">
                              <button type="button" name="add" id='eyetbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='eyebtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='EyeTextBoxesGroup' class="col-md-12">
                                
                              </div>

                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control"> Day :</label>
                              </div>
                              </div>


                              <div class="col-md-6">
                              {{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div>
                              <div class="col-md-4">
                              <button type="button" name="add" id='daytbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='daybtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='DayTextBoxesGroup' class="col-md-12">
                                
                              </div>
                             
                              <div class="col-md-12">
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label class="form-control">Times a Day :</label>
                              </div>
                              </div>

                              <div class="col-md-6">
                              {{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control select2','data-live-search'=>'true')) }}
                              </div> 
                              <div class="col-md-4">
                              <button type="button" name="add" id='timesadaytbtn' class="btn btn-success ">Set Option </button>    
                              <button type='button' class="btn btn-primary" id='timesadaybtnsave'>Add</button>
                              </div>
                              </div>
                              <div id='TimesadayTextBoxesGroup' class="col-md-12">
                                
                              </div>

                              

                            <div class="row clearfix">
                            <div class="col-md-6 col-md-offset-2">
                            <div class="form-group">
                            {{ Form::submit('Add Prescription', array('class' => 'btn btn-primary btn-lg', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}  
                            {{ Form::button('Send Message', array('class' => 'btn btn-primary btn-lg', 'Value' => $casedata['id'], 'name' => 'prescription_msg', 'type'=>'submit')) }}      
                            </div>
                            <br>
                            <div class="table-responsive">
                            @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                                <table class="table">
                                    <tr>
                                        <th>
                                            Medicine
                                        </th>
                                        
                                        <th>
                                            Eye
                                        </th>
                                        <th>
                                            Days
                                        </th>
                                        <th>
                                            Times a Day    
                                        </th>
                                        
                                        <th>
                                            <!-- Used for delete button -->    
                                        </th>
                                    </tr>
                                        @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                            <tr>   
                                                <td>
                                                    {{ $prescption->Medical_store->medicine_name }}
                                                </td>
                                                
                                                <td>
                                                    {{ $prescption->strength }}
                                                </td>
                                                <td>
                                                    {{ $prescption->medicine_Quntity }}
                                                </td>
                                                <td>
                                                    {{ $prescption->numberoftimes }}
                                                </td>
                                                
                                                {{-- <td>
                                                    {{ $prescption->per_unit_cost }}
                                                </td>
                                                <td>
                                                    {{ $prescption->per_unit_cost * $prescption->medicine_Quntity }}
                                                </td> --}}
                                                <td>
                                                    {{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
                                                    {{-- <a href="{{'/case_masters/delete/'.$prescption->id }}" class="btn btn-primary" name='prescription_delete'> Delete Prescription </a> --}}
                                                </td>
                                            <tr>
                                        @endforeach
                                    @endif
                                </table>
                                </div>
                            </div>
                        </div>
                                  
                        <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                            <a class="btn btn-default btn-lg" href="{{ url('/case_masters/prescriptionlstother') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To List</a> &nbsp;
                            <a class="btn btn-default btn-lg" href="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Back To Patient Details</a>&nbsp;
                            <a class="btn btn-default btn-lg"  href="{{ url('/print/prescriptionother').'/'.$casedata['id'] }}" target="_blank"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
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
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
    $('.select2').select2();
    </script>


<!-- Medicine Set Option -->
<script type="text/javascript">

$(document).ready(function(){

    var medcounter = 1;

    $("#medicinetbtn").click(function () {
      
  if(medcounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+medcounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="balance_quantity" value="1"><input class="form-control"  type="hidden"  name="isactive" value="1"><input class="form-control"  type="text" id="optionsval'+medcounter+'" placeholder="value'+medcounter+'" name="optionsval[]"></div><span class="input-group-addon medicineremoveButton" type="button" id="medicineremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#MedicineTextBoxesGroup").append(newTextBoxDiv);
  medcounter++;
     });


$(document).on('click', '.medicineremoveButton', function(e) {
medcounter--;
   var target = $("#MedicineTextBoxesGroup").find("#TextBoxDiv" +medcounter);
  $(target).remove();
});


  });
</script>

<!-- Eye Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var eyecounter = 1;

    $("#eyetbtn").click(function () {
      
  if(eyecounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+eyecounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Strength"><input class="form-control"  type="text" id="optionsval'+eyecounter+'" placeholder="value'+eyecounter+'" name="optionsval[]"></div><span class="input-group-addon eyeremoveButton" type="button" id="eyeremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#EyeTextBoxesGroup").append(newTextBoxDiv);
  eyecounter++;
     });


$(document).on('click', '.eyeremoveButton', function(e) {
eyecounter--;
   var target = $("#EyeTextBoxesGroup").find("#TextBoxDiv" +eyecounter);
  $(target).remove();
});


  });
</script>

<!-- Day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var daycounter = 1;

    $("#daytbtn").click(function () {
      
  if(daycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+daycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Quantity"><input class="form-control"  type="text" id="optionsval'+daycounter+'" placeholder="value'+daycounter+'" name="optionsval[]"></div><span class="input-group-addon dayremoveButton" type="button" id="dayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#DayTextBoxesGroup").append(newTextBoxDiv);
  daycounter++;
     });


$(document).on('click', '.dayremoveButton', function(e) {
daycounter--;
   var target = $("#DayTextBoxesGroup").find("#TextBoxDiv" +daycounter);
  $(target).remove();
});


  });
</script>


<!-- Times a day Set Option -->

<script type="text/javascript">

$(document).ready(function(){

    var timesadaycounter = 1;

    $("#timesadaytbtn").click(function () {
      
  if(timesadaycounter>10){
               swal("Only 10 Options Values are allow!");
            return false;
  }
  
var newTextBoxDiv='<div class="col-md-3" id="TextBoxDiv'+timesadaycounter+'"><div class="input-group"><div class="form-line"><input class="form-control"  type="hidden"  name="formName" value="Prescription"><input class="form-control"  type="hidden"  name="fieldName" value="Times a day"><input class="form-control"  type="text" id="optionsval'+timesadaycounter+'" placeholder="value'+timesadaycounter+'" name="optionsval[]"></div><span class="input-group-addon timesadayremoveButton" type="button" id="timesadayremoveButton" ><i class="fa fa-times" aria-hidden="true"></i></span></div></div>'



$("#TimesadayTextBoxesGroup").append(newTextBoxDiv);
  timesadaycounter++;
     });


$(document).on('click', '.timesadayremoveButton', function(e) {
timesadaycounter--;
   var target = $("#TimesadayTextBoxesGroup").find("#TextBoxDiv" +timesadaycounter);
  $(target).remove();
});


  });
</script>


<script type="text/javascript">
    function isEmpty( el ){
      return !$.trim(el.html())
  }

// Medicine Add Option

      $("#medicinebtnsave").click(function () {
        var content=$("#MedicineTextBoxesGroup").val();
        if (isEmpty($('#MedicineTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("medicine-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Medicine", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Eye Add Option

      $("#eyebtnsave").click(function () {
        var content=$("#EyeTextBoxesGroup").val();
        if (isEmpty($('#EyeTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Eye", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });


// Day Add Option

      $("#daybtnsave").click(function () {
        var content=$("#DayTextBoxesGroup").val();
        if (isEmpty($('#DayTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Day", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });




// Times a day Add Option

      $("#timesadaybtnsave").click(function () {
        var content=$("#TimesadayTextBoxesGroup").val();
        if (isEmpty($('#TimesadayTextBoxesGroup'))) 
        {
            swal({
            title: "Please Add Some Option by clicking on",
            text: "<button style=\"border-radius: 4px !important;\" type='button' class='btn btn-success'>Set Option</button>",
            html: true
            });
        }
       else 
    {
 var data=$("#eyeform").serialize();
        event.preventDefault();
        $.ajax({
           url:'{{ route("eye-field.insert") }}',
            method:'post',
            data:data,
            success:function(data)
            {
             swal({title: "Option For Times a Day", text: "Added Successfully!", type: "success"},
             function(){ 
              location.reload();
              }
            );
            }
        })
    }

    });

</script>


@endsection