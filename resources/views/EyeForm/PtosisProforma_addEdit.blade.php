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
          <h2>Ptosis Proforma </h2>
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
                                <th>2.</th>
                                <th>MRD 1</th>
                                <td>
                                    @php $fieldName = "MRD1Right"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "MRD1Left"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>3.</th>
                                <th>MRD 2</th>
                                <td>
                                    @php $fieldName = "MRD2Right"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "MRD2Left"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>4.</th>
                                <th>PFH</th>
                                <td>
                                    @php $fieldName = "PFHRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "PFHLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>5.</th>
                                <th>LPS ACTION</th>
                                <td>
                                    @php $fieldName = "LPSACTIONRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "LPSACTIONLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>6.</th>
                                <th>FRONTALIS OVERACTION</th>
                                <td>
                                    @php $fieldName = "FRONTALISOVERACTIONRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "FRONTALISOVERACTIONLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>7.</th>
                                <th>LID CREASE</th>
                                <td>
                                    @php $fieldName = "LIDCREASERight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "LIDCREASELeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>8.</th>
                                <th>BELL’S PHENOMEMNON</th>
                                <td>
                                    @php $fieldName = "BELLSPHENOMEMNONRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "BELLSPHENOMEMNONLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>9.</th>
                                <th>CORNEAL SENSATION</th>
                                <td>
                                    @php $fieldName = "CORNEALSENSATIONRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "CORNEALSENSATIONLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>10.</th>
                                <th>ORBICULARIS ACTION</th>
                                <td>
                                    @php $fieldName = "ORBICULARISACTIONRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "ORBICULARISACTIONLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>11.</th>
                                <th>MGJW</th>
                                <td>
                                    @php $fieldName = "MGJWRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "MGJWLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>12.</th>
                                <th>FATIGUE TEST</th>
                                <td>
                                    @php $fieldName = "FATIGUETESTRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "FATIGUETESTLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>13.</th>
                                <th>ICE TEST</th>
                                <td>
                                    @php $fieldName = "ICETESTRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "ICETESTLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>14.</th>
                                <th>EDROPHONIUM /NEOSTIGMINE TEST</th>
                                <td>
                                    @php $fieldName = "EDROPHONIUMNEOSTIGMINETESTRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "EDROPHONIUMNEOSTIGMINETESTLeft"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                            </tr>
                            <tr>
                                <th>15.</th>
                                <th>SQUINT</th>
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
                                <th>16.</th>
                                <th>TEAR FUNCTION</th>
                                <td>
                                    @php $fieldName = "TEARFUNCTIONRight"; @endphp
                                    {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                </td>
                                <td>
                                    @php $fieldName = "TEARFUNCTIONLeft"; @endphp
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