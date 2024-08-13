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
                            <h2>
                                Squint Evaluation
                            </h2>
                          
                        </div>
                        {{ Form::hidden('register_id', $patientRegister->id ) }}
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                                @php $fieldName = "HeadPosture"; @endphp
                                {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Head Posture') }} 
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                                <div class="table-responsive">
                              <table class="table">
                                  <tr>
                                      <th>Face Turn</th>
                                      <th>Right</th>
                                      <th>Left</th>
                                  </tr>
                                  <tr>
                            <th>Chin elevation or depression</th>
                            <td>
                                @php $fieldName = "FaceTurnChinLeft"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "FaceTurnChinRight"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                        </tr>
                        <tr>
                            <th>Head Tilt</th>
                            <td>
                                @php $fieldName = "FaceTurnHeadTiltLeft"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "FaceTurnHeadTiltRight"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            </tr>
                            </table>
                            </div>
                          </div>
                            <div class="col-md-12">
                                @php $fieldName = "HirschbergTest"; @endphp
                                {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Hirschberg Test') }} 
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                              @php $fieldName = "CoverTest"; @endphp
                                {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Cover Test') }} 
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                                 @php $fieldName = "PrismBarCoverTestDistance"; @endphp
                                  {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Prism Bar Cover Test : Distance') }} 
                                  {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                              <div class="form-group">
                                <label> All Nine gazes</label>
                              </div>
                              </div>

                              <div class="col-md-12">
                                <div class="table-responsive">
                               <table class="table table-responsive">
                                  <tr>
                                      <td>
                                          @php $fieldName = "NineGazes1"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                      </td>
                                      <td>
                                          @php $fieldName = "NineGazes2"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                      </td>
                                      <td>
                                          @php $fieldName = "NineGazes3"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                            
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          @php $fieldName = "NineGazes4"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                      </td>
                                      <td>
                                          @php $fieldName = "NineGazes5"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                      </td>
                                      <td>
                                          @php $fieldName = "NineGazes6"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                            
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          @php $fieldName = "NineGazes7"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                      </td>
                                      <td>
                                          @php $fieldName = "NineGazes8"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                                      </td>
                                      <td>
                                          @php $fieldName = "NineGazes9"; @endphp
                                          {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}                            
                                      </td>
                                  </tr>
                              </table>
                              </div>
                              </div>
                              <div class="col-md-12">
                                @php $fieldName = "PrimaryDeviation"; @endphp
                                {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Primary Deviation') }} 
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                              @php $fieldName = "SecondaryDeviation"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Secondary Deviation') }} 
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                              @php $fieldName = "OcularMotility"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Ocular Motility') }} 
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                                @php $fieldName = "WorthFourDotTest"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Worth Four Dot Test') }} 
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                              @php $fieldName = "Stereopsis"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Stereopsis') }} 
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                              @php $fieldName = "MaddoxRod"; @endphp
                              {{ Form::label('field_data_singular['.$field_name_id[$fieldName].']','Maddox Rod') }} 
                              {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                              </div>
                              <div class="col-md-12">
                                <div class="table">
                    <table class="table table-responsive">
                        <tr>
                            <td>
                                @php $fieldName = "DipopiaCharting1"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "DipopiaCharting2"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "DipopiaCharting3"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @php $fieldName = "DipopiaCharting4"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "DipopiaCharting5"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "DipopiaCharting6"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @php $fieldName = "DipopiaCharting7"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "DipopiaCharting8"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                            <td>
                                @php $fieldName = "DipopiaCharting9"; @endphp
                                {{ Form::text('field_data_singular['.$field_name_id[$fieldName].']', $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data, array('class'=> 'form-control')) }}
                            </td>
                        </tr>
                    </table>
                </div>
                              </div>

                              </div>
                              

                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-4">
                                <div class="form-group">
                                 <input type="hidden" name="returnUrl" id="returnUrl" value="{{ url('/AddEditEyeDetails').'/'.$patientRegister->id }}" >
                    <button type="submit" name="submit" class="btn btn-success" value="submit">
                        <i class="fa fa-plus"></i> Submit
                    </button>
                    <a class="btn btn-default" href="{{ url('/AddEditEyeDetails').'/'.$patientRegister->id }}"><i
                            class="glyphicon glyphicon-chevron-left"></i> Back</a>
                    <a class="btn btn-default"
                        href="{{ url('/dynamicForm/view/').'/'.$form_master->id.'/'.$patientRegister->id }}"><i
                            class="glyphicon glyphicon-chevron-left"></i> view</a>
                    <a class="btn btn-default"
                        href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}"
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
  