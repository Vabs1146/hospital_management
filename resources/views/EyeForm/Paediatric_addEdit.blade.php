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

    .canvas {
        position: relative;
        width: 150px;
        height: 200px;
        background-color: #7a7a7a;
        margin: 70px auto 20px auto;
    }
</style>
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
        height: 100%;
    }
</style>


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
          <form action="{{ url('/dynamicForm/'.$form_master->id.'/'.$patientRegister->id. '/Opd' .'') }}" method="POST" class="form-horizontal" id="form_{{$patientRegister->id}}"
                enctype='multipart/form-data'>
                 {{ csrf_field() }}

          <div class="header bg-pink">
          <h2>Paediatric Eye Evaluation </h2>
          </div>
               {{ Form::hidden('register_id', $patientRegister->id ) }}
              <div class="body">
                        <div class="col-md-12">
                         <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>S. No</th>
                                    <th></th>
                                    <th>Right Eye</th>
                                    <th>Left Eye</th>
                                </tr>
                                <tr>
                                    <th>1.</th>
                                    <th>Fixes and Follows</th>
                                    <td>
                                        @php $fieldName = "FixesFollowsRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "FixesFollowsLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>2.</th>
                                    <th>Resists Occlusion</th>
                                    <td>
                                        @php $fieldName = "ResistsOcclusionRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "ResistsOcclusionLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <th>Fixation Pattern</th>
                                    <td>
                                        @php $fieldName = "FixationPatternRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "FixationPatternLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <th>Nystagmus</th>
                                    <td>
                                        @php $fieldName = "NystagmusRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "NystagmusLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <th>Ptosis</th>
                                    <td>
                                        @php $fieldName = "PtosisRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "PtosisLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>6.</th>
                                    <th>Head Posture</th>
                                    <td>
                                        @php $fieldName = "HeadPostureRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "HeadPostureLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>7.</th>
                                    <th>Squint</th>
                                    <td>
                                        @php $fieldName = "SquintRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "SquintLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>8.</th>
                                    <th>Bruckner’s reflex</th>
                                    <td>
                                        @php $fieldName = "BrucknersReflexRight"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                    <td>
                                        @php $fieldName = "BrucknersReflexLeft"; @endphp
                                        {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </div>

                            <div class="row clearfix">
                            <div class="col-md-4 col-md-offset-2">
                            <div class="form-group">
                            <input type="hidden" name="returnUrl" id="returnUrl" value="{{ url('/AddEditEyeDetails').'/'.$patientRegister->id }}" >
                            <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit"><i class="fa fa-plus"></i> Submit
                            </button>
                            <a class="btn btn-default btn-lg" href="{{ url('/AddEditEyeDetails').'/'.$patientRegister->id }}">
                            <i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                            <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/view/').'/'.$form_master->id.'/'.$patientRegister->id }}">
                            <i class="glyphicon glyphicon-chevron-left"></i> view</a>
                            <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}"
                            target="_blank"><i class="glyphicon glyphicon-chevron-left"></i> print</a>    
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
@endsection