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
</style>
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
@endsection
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header bg-pink">
              <h2>Paediatric Eye Evaluation View </h2>
              </div>
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
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "FixesFollowsLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>2.</th>
                                <th>Resists Occlusion</th>
                                <td>
                                    @php $fieldName = "ResistsOcclusionRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "ResistsOcclusionLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>3.</th>
                                <th>Fixation Pattern</th>
                                <td>
                                    @php $fieldName = "FixationPatternRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "FixationPatternLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>4.</th>
                                <th>Nystagmus</th>
                                <td>
                                    @php $fieldName = "NystagmusRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "NystagmusLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>5.</th>
                                <th>Ptosis</th>
                                <td>
                                    @php $fieldName = "PtosisRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "PtosisLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>6.</th>
                                <th>Head Posture</th>
                                <td>
                                    @php $fieldName = "HeadPostureRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "HeadPostureLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>7.</th>
                                <th>Squint</th>
                                <td>
                                    @php $fieldName = "SquintRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "SquintLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                            <tr>
                                <th>8.</th>
                                <th>Bruckner’s reflex</th>
                                <td>
                                    @php $fieldName = "BrucknersReflexRight"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                                <td>
                                    @php $fieldName = "BrucknersReflexLeft"; @endphp
                                    {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}
                                </td>
                            </tr>
                        </table>
                            </div>
                        </div>


                        <div class="row clearfix">
                        <div class="col-sm-6">
                        <div class="col-sm-6">Doctor's Signature</div>
                        <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        <div class="col-sm-6">
                        <div class="col-sm-6">PARENT'S/RELATIVE'S SIGNATURE</div>
                        <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        </div>
               

                        <div class="row clearfix">
                        <div class="col-md-12 ">
                        <div class="form-group">
                        <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm').'/'.$form_master->id. '/'.$patientRegister->id.'/edit/Opd' }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                        <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id.'/Opd' }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i> print</a>
                        </div>
                        </div>       
                        </div>
                   </div>
                </div>
            </div>
</div>
</div>

        @endsection

