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
</style>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> SEO Management</h1>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        Add Module
    </div>

    <div class="panel-body">
                
        <form action="{{ url('/seo/SaveSeo' ) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
           
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    @include('shared.error') 
                    @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
               <!--  {{ Form::label('Page Url', 'url', array('class' => 'col-sm-3 control-label')) }}-->
                <label class="col-sm-3 control-label">url</label>

               <div class="col-sm-6">
              <!--  {{ Form::text('page_url', Request::old('page_url'), array('class' => 'form-control', 'placeholder'=>'Type Page Url')) }} -->
            <select name="page_url" id="" class="form-control" required>
                <option selected value disabled>Select url</option>
                @foreach($urllist as $urllists)
                <option value="{{ $urllists->id}}">{{ $urllists->name}}</option>
                @endforeach
            </select>
            </div> 

            
            </div>
            <div class="form-group">
                {{ Form::label('meta_title','Meta Title', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::text('meta_title', Request::old('meta_title'), array('class' => 'form-control', 'placeholder'=>'Type Meta Title','required')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('meta_desc','Meta Description', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::text('meta_desc', Request::old('meta_desc'), array('class' => 'form-control', 'placeholder'=>'Type Meta Description','required')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('meta_key','Meta Keywords', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::text('meta_key', Request::old('meta_key'), array('class' => 'form-control', 'placeholder'=>'Type Meta Keywords','required')) }}
                </div>
            </div>
           
            <div class="form-group"> 
                {{ Form::label('status','Status', array('class' => 'col-sm-3 control-label')) }}
                <div class="col-sm-6">
                <div class="checkbox">
                    <label><input type="radio" name="is_active" id="is_active" value="1" checked required /> Enable </label>
                    <label><input type="radio" name="is_active" id="is_active" value="0" required /> Disable </label>
                </div>
                </div>
            </div>
           
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="submit" class="btn btn-success" value="submit" >
                        <i class="fa fa-plus"></i> Submit
                    </button>
                    <a class="btn btn-default" href="{{ url('/appointmentlist') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Appointment</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <a class="btn btn-default" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back to Patient List</a>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    
    $(document).ready(function(){
      $('.datepicker').datepicker({
            format: "dd/M/yyyy",
            weekStart: 1,
            clearBtn: true,
            daysOfWeekHighlighted: "0,6",
            autoclose: true,
        });
    });
</script>

<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>

<script>    
     jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} ">
</script>
<script>
        var url = "{{ url('/GetCaseIdByPatientNameMobile') }}";
        jq(".autocompleteTxt").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ url('/GetCaseIdByPatientNameMobile') }}",
                    dataType: "json",
                    data: {
                        query: request.term,
                        PropertyName: jq(this.element).attr('name'),//'Complaints' 
                        tableName: 'eyeform'
                    },
                    success: function(data) {

                        // response($.map(data, function (item) {
                        //     return { 
                        //             value: item.value,
                        //             label: item.label,
                        //             patient_name: item.patient_name,
                        //             patient_mobile: item.patient_mobile
                        //         };
                        // }));
                        //data = JSON.parse(JSON.stringify(data));
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                jq("#case_number").val(ui.item.value);
                $('input[name="patient_name"]').val(ui.item.patient_name);
                $('input[name="patient_mobile"]').val(ui.item.patient_mobile);
                $('input[name="patient_address"]').val(ui.item.patient_address);
                $('input[name="patient_emailId"]').val(ui.item.patient_emailId);
                $('input[name="patient_age"]').val(ui.item.patient_age);
                $('input[name="male_female"][value='+ ui.item.male_female +']').attr('checked', 'checked');
                $('#doctor_id').val(ui.item.doctor_id);
                return false; // Prevent the widget from inserting the value.
            }
        });
</script>

@endsection