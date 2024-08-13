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


</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">


<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">

<style>
 .col-md-12 {
    margin-bottom: 0px !important;
}

.labelgrp {
    text-align: left !important;
}

.form-control {
	border:none;
	border-bottom:1px solid;
	box-shadow:none;
}


table{
	width:100%;
}

table {
	border: solid white !important;
	border-width: 1px 0 0 1px !important;
	border-bottom-style: none;
}

th, td {
	border: solid white !important;
	border-width: 0 1px 1px 0 !important;
	border-bottom-style: none;
} 
</style>
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
                       <form action="{{ url('save-psychiatrist-case-form') }}" method="POST" class="form-horizontal" id="eyeform" enctype='multipart/form-data'>
 
                        {{ csrf_field() }}
                        {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
                        {{ Form::hidden('case_number', Request::old('case_number', $casedata['case_number']), array('class'=> 'form-control', 'readonly'=>'readonly')) }}
                         <div class="header bg-pink">
                            <h2>
                              Patient Name : {{ $casedata->patient_name }} | Age : {{ $casedata['patient_age'] }} | Gender : {{ $casedata['male_female'] }} | Case Number : {{ $casedata['case_number'] }} | {{ 'Time :' . $casedata['visit_time']}}
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                 <a id="button" ><i class="material-icons" style="font-size: 33px !important;">keyboard_arrow_up</i></a>
				<div class="top-nav s-12 l-10">
				
				</div>
              
              <hr/>
               <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                  <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
<!-- start of panel complaint -->
<div class="panel panel-primary">
@include('Psychiatrist.form_steps.case_form_responsive')
</div>
<!-- end of panel complaint -->
<!-- start of panel Vision -->
<div class="panel panel-primary">

</div>
<!-- End Of Vision Panel -->
<!-- Start of Refraction panel -->
<div class="panel panel-primary">

</div>
<!-- End of Refraction -->
<!-- Start of Finding -->

                            </div>
                        </div>
                        <div class="col-md-12"></div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-primary waves-effect"><i class="fa fa-plus"></i> Submit
                                </button>
									
									<a class="btn btn-primary waves-effect btn-lg" href="{{url('/ViewEyeDetails').'/'.$casedata['id'] }}"> <i class="fa fa-eye"></i> View </a>
									
                                <a class="btn btn-primary waves-effect btn-lg" href="{{ url('/case_masters') }}"> <i class="glyphicon glyphicon-chevron-left"></i> Back </a>
                                      
                                    </div>
                                </div>
                               
                            </div>

                            
                        </div>
                       </form>
                    </div>
                </div>
            </div>


</div>

<div id="add-more-family-history-html" style="display:none;">
	<div class="row" >
		<div class="col-md-2">
			{{ Form::text('question_7_rlation[]', null, array('class'=> 'form-control', 'placeholder'=> 'relation', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('question_7_name[]', null, array('class'=> 'form-control', 'placeholder'=> 'name', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-4">
			{{ Form::text('question_7_doctor[]', null, array('class'=> 'form-control', 'placeholder'=> 'doctor name', 'autocomplete'=>'off')) }}
		</div>
		<div class="col-md-2">
			<a class="btn btn-info" href="javascript:void(0)" id="remove-family-history">Remove</a>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
$('#add-more-family-history').click(function() {
	$('#family_history_div').append($('#add-more-family-history-html').html());
});
$(document).on('click', '#remove-family-history', function() {
	$(this).closest('.row').remove();
});
$(document).on('click', '.delete-edit-family-history', function() {
	$(this).closest('.row').remove();
});
$(document).on('click', '.delete-psychiatrist-case-form-files', function() {
	$(this).parent().remove();
});
</script>
@endsection
