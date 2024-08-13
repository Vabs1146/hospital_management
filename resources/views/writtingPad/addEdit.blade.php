@extends('layouts/app') 
 
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">

<link rel="stylesheet" href="{{ asset('drawingboardJs/prism.css') }}">
<link rel="stylesheet" href="{{ asset('drawingboardJs/website.css') }}">

<!-- in a production environment, just include the minified css. It contains the css of the board and the default controls (size, nav, colors): -->
<link rel="stylesheet" href="{{ asset('drawingboardJs/drawingboard.min.css') }}">

<style>
        /*
        * drawingboards styles: set the board dimensions you want with CSS
        */

        .board {
            margin: 0 auto;
            width: 100%;
            height: 1000px;
        }

        .panel-title .trigger:before {
        content: '\f151';
        /* '\f056'; */
        font-family: 'FontAwesome';
        vertical-align: text-bottom;
        }

        .panel-title .trigger.collapsed:before {
        content: '\f150'; 
        /* '\f055'; */
        font-family: 'FontAwesome';
        }

</style>
 
@endsection
 
@section('content')
<form action="{{ url('/writingCasePaper'.( empty($form_details->id) ? "/0" : ("/" . $form_details['id']))) }}" method="POST" id="writtingPadForm" class="form-horizontal" enctype = 'multipart/form-data' >
    {{ csrf_field() }}
    
    @if (!empty($form_details->id))
        <input type="hidden" name="_method" value="PATCH">
    @endif

    <div class="row">
        &nbsp;
    </div>

    <div class="form-group">
        @include('shared.error') 
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
    </div>
    <input type="hidden" id="id" name="id" value="{{ $form_details['id'] or ''}}" >
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success" value="submit" >
            <i class="fa fa-plus"></i> Submit
        </button>
        {{-- <a class="btn btn-default" href="{{ url('/eyeoperation') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a> --}}
        <a class="btn btn-default" href="{{ url('/writingCasePaper') }}" ><i class="glyphicon glyphicon-print"></i> Back </a>
        <a class="btn btn-default" href="{{ url('/PatientMedicalDetails').'/'.$casedata['id'] }}"><i class="glyphicon glyphicon-chevron-left"></i> Patient Details</a>
        <a class="btn btn-default" href="{{ url('/writingCasePaper/print').'/'.$casedata['id'] }}" target="_blank">Print</a>
        <a class="btn btn-default" href="{{ url('/writingCasePaper/view').'/'.$casedata['id'] }}"> view </a>
    </div>
    <div class="form-group">
        <div class="list-group list-group-horizontal">
            @forelse ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                    @if($casedata['id'] == $VisitListDateWise['id'])
                        <a href="{{ url('/writingCasePaper').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                    @else
                        <a href="{{ url('/writingCasePaper').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                    @endif
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">{{ Form::label('patient_name', 'Patient Name :') }} {{$casedata['patient_name']}}</div>
        <div class="col-md-6">{{ Form::label('patient_age', 'Patient age :') }} {{$casedata['patient_age']}}</div>
    </div>
    <div class="form-group">
        <div class="col-md-6">{{ Form::label('patient_address', 'Patient Address :') }} {{$casedata['patient_address']}}</div>
        <div class="col-md-6">{{ Form::label('patient_emailId', 'Patient email Id :') }} {{$casedata['patient_emailId']}}</div>
    </div>
    <div class="form-group">
        <div class="col-md-6">{{ Form::label('doctor_name', 'Doctor :') }} {{$casedata['doctor_name']}}</div>
        <div class="col-md-6">{{ Form::label('appointment_dt', 'Date :') }} {{ is_null($casedata['appointment_dt'])? Carbon\Carbon::today()->format('d/M/Y') :$casedata['appointment_dt'] }}
                {{-- Carbon\Carbon::createFromFormat('d/M/Y', Carbon\Carbon::today())->toDateTimeString() --}}
        </div>
    </div>

    {{ Form::hidden('case_id', Request::old('case_id',$casedata['id']), array('class'=> 'form-control')) }}
    
    <div>
        <div class="example1" data-example="retino_scopy_OD" >
            <div class="board" id="retino_scopy_OD_canvas"  ></div>
        </div>
    {{ Form::hidden('image_data', Request::old('image_data',$form_details['image_data']), array('class'=> 'form-control', 'id'=>'image_data')) }}

    </div>
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>


<script type="text/javascript">

    var defaultOptions = {
        // controls: [
        //     'Color',
        //     {
        //         Size: {
        //             type: 'dropdown'
        //         }
        //     },
        //     // {
        //     //     DrawingMode: {
        //     //         filler: false
        //     //     }
        //     // },
        //     { Navigation: { back: false, forward: false } },
            
        //     //'Download'
        // ],
        controlsPosition:"top right",
        size: 6,
        // color: "rgb(127, 0, 0)",
        webStorage: false,
        enlargeYourContainer: true,
        //background: '/images/OdImg1.PNG',
        stretchImg: false,
        eraserColor: "#ffffff",
    }

    var OdImg1 = new DrawingBoard.Board('retino_scopy_OD_canvas', $.extend( {}, defaultOptions, {background: $("#image_data").val()}));

    $(document).ready(function () {

        $(".ImageDelete").on('click',function(){
            var deleteBtn = $(this);
            var  postData = {
                        'case_id': $("input[type='hidden'][name='case_id']").val(),
                        'imageName': deleteBtn.val(),//
                        '_token': $("input[type='hidden'][name='_token']").val()
                    };
            $.ajax({
                    url: "{{ url('/eyeform/deleteImage') }}",
                    type:'POST',
                    //dataType: "json",
                    data: postData,
                    success: function(data) {
                        // deleteBtn.closest('div.col-md-6').find('img').attr('src', '');
                        deleteBtn.closest('div.col-md-6').html('');
                    }
                });
            return false;
        });

        $("#writtingPadForm").on("submit", function () {
            var ImgData_OdImg1 = OdImg1.getImg();
            //ImgData_OdImg1 = (OdImg1.history.initialItem == ImgData_OdImg1) ? '' : ImgData_OdImg1;
            $("#image_data").val(ImgData_OdImg1);
            OdImg1.clearWebStorage();
        });
    }); //document ready
</script>
@endsection