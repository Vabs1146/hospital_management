@extends('adminlayouts.master')
@section('style')
<style>
    @media screen and (max-width: 767px) {

    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
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
            
            height: 600px;
        }

</style>

 
@endsection
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                      <div class="header bg-pink">
                            <h2>
                                Squint Evaluation View
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="form-group">
                              @php $fieldName = "HeadPosture"; @endphp
                              <div class="col-sm-3"><label class="control-label">Head Posture:</label></div>    
                              <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                              </div>
                              </div>

                              <div class="col-md-12">
                              <div class="table-responsive">
                              <table class="table table-bordered">
                              <tr>
                              <th>Face Turn</th>
                              <th>Left</th>
                              <th>Righ</th>
                              </tr>
                              <tr>
                              <th>Chin elevation or depression</th>
                              <td>
                                @php $fieldName = "FaceTurnChinLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                              </td>
                              <td>
                                @php $fieldName = "FaceTurnChinRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                              </td>
                              </tr>
                              <tr>
                              <th>Head Tilt</th>
                              <td>
                                @php $fieldName = "FaceTurnHeadTiltLeft"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}                        
                             </td>
                              <td>
                                @php $fieldName = "FaceTurnHeadTiltRight"; @endphp
                                {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                              </td>
                              </tr>
                             </table>
                              </div>

                              </div>  
                              <div class="col-md-12">
                              @php $fieldName = "HirschbergTest"; @endphp
                              <div class="col-sm-3"><label class="control-label">Hirschberg Test:</label></div>    
                              <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                              </div>

                              <div class="col-md-12">
                              @php $fieldName = "CoverTest"; @endphp
                              <div class="col-sm-3"><label class="control-label">Cover Test:</label></div>    
                              <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                              </div>

                              <div class="col-md-12">
                              @php $fieldName = "PrismBarCoverTestDistance"; @endphp
                              <div class="col-sm-3"><label class="control-label">Prism Bar Cover Test Distance:</label></div>    
                              <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                              </div> 
                              <div class="col-md-12">
                              <div class="col-sm-3"><label class="control-label">All Nine gazes:</label></div>
                              <div class="table-responsive">
                                  <table class="table table-bordered">
                                      <tr>
                                          <td>
                                              @php $fieldName = "NineGazes1"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                          <td>
                                              @php $fieldName = "NineGazes2"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                          <td>
                                              @php $fieldName = "NineGazes3"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              @php $fieldName = "NineGazes4"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                          <td>
                                              @php $fieldName = "NineGazes5"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                          <td>
                                              @php $fieldName = "NineGazes6"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              @php $fieldName = "NineGazes7"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                          <td>
                                              @php $fieldName = "NineGazes8"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                          <td>
                                              @php $fieldName = "NineGazes9"; @endphp
                                              {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                          </td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="col-md-12">
                            @php $fieldName = "PrimaryDeviation"; @endphp
                            <div class="col-sm-3"><label class="control-label">Primary Deviation:</label></div>    
                            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                          </div>
                          <div class="col-md-12">
                            @php $fieldName = "SecondaryDeviation"; @endphp
                            <div class="col-sm-3"><label class="control-label">Secondary Deviation:</label></div>    
                            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                          </div>
                          <div class="col-md-12">
                            @php $fieldName = "OcularMotility"; @endphp
                            <div class="col-sm-3"><label class="control-label">Ocular Motility:</label></div>    
                            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                          </div>
                          <div class="col-md-12">
                            @php $fieldName = "WorthFourDotTest"; @endphp
                            <div class="col-sm-3"><label class="control-label">Worth Four Dot Test:</label></div>    
                            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                          </div>
                          <div class="col-md-12">
                            @php $fieldName = "Stereopsis"; @endphp
                            <div class="col-sm-3"><label class="control-label">Stereopsis:</label></div>    
                            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                          </div>
                          <div class="col-md-12">
                            @php $fieldName = "MaddoxRod"; @endphp
                            <div class="col-sm-3"><label class="control-label">Maddox Rod:</label></div>    
                            <div class="col-sm-9"><u>{{$form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data}}</u></div>
                          </div>
                          <div class="col-md-12">
                          <div class="col-sm-3"><label class="control-label">Dipopia Charting:</label></div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            @php $fieldName = "DipopiaCharting1"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                        <td>
                                            @php $fieldName = "DipopiaCharting2"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                        <td>
                                            @php $fieldName = "DipopiaCharting3"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @php $fieldName = "DipopiaCharting4"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                        <td>
                                            @php $fieldName = "DipopiaCharting5"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                        <td>
                                            @php $fieldName = "DipopiaCharting6"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @php $fieldName = "DipopiaCharting7"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                        <td>
                                            @php $fieldName = "DipopiaCharting8"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                        <td>
                                            @php $fieldName = "DipopiaCharting9"; @endphp
                                            {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                          <br/>
                          <br/>
                          <div class="col-md-12">
                              <div class="col-sm-6">
                                  <div class="col-sm-6">Doctor's Signature</div>
                                  <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="col-sm-6">PARENT'S/RELATIVE'S SIGNATURE</div>
                                  <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                              </div>
                          </div>
                          </div>
                          <div class="row clearfix">
                          <div class="col-md-4 col-md-offset-4">
                          <div class="form-group">
                          <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm').'/'.$form_master->id. '/'.$patientRegister->id.'/edit/Opd' }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                          <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id.'/Opd' }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i> print</a>
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
<script src="{{asset('drawingboardJs/drawingboard.min.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>
<script src="{{asset('drawingboardJs/yepnope.js')}}"></script>

<script type="text/javascript">

    var defaultOptions = {
        controls: [
            'Color',
            {
                Size: {
                    type: 'dropdown'
                }
            },
            // {
            //     DrawingMode: {
            //         filler: false
            //     }
            // },
            { Navigation: { back: false, forward: false } },
            //'Download'
        ],
        controlsPosition:"top right",
        size: 6,
        color: "rgb(127, 0, 0)",
        webStorage: false,
        enlargeYourContainer: false,
        //background: '/images/OdImg1.PNG',
        stretchImg: true
    }

    
    var OdImg1 = new DrawingBoard.Board('OdImg1_canvas', $.extend( {}, defaultOptions, {background: '/images/fundas.jpg'}));
    var OsImg1 = new DrawingBoard.Board('OsImg1_canvas', $.extend( {}, defaultOptions, {background: '/images/fundas.jpg'}));

    $(document).ready(function () {

        $("#fundusImageForm").on("submit", function () {
            var ImgData_OdImg1 = OdImg1.getImg();
            ImgData_OdImg1 = (OdImg1.history.initialItem == ImgData_OdImg1) ? '' : ImgData_OdImg1;
            $("#OdImg1").val(ImgData_OdImg1);

            var ImgData_OsImg1 = OsImg1.getImg();
            ImgData_OsImg1 = (OsImg1.history.initialItem == ImgData_OsImg1) ? '' : ImgData_OsImg1;
            $("#OsImg1").val(ImgData_OsImg1);

            OdImg1.clearWebStorage();
            OsImg1.clearWebStorage(); 
        });

    }); //document ready
</script>
 
<!-- jQuery Easing -->
<script src="{{ asset('JqueryUI/jquery.js') }} ">
</script>
<script>    
    jq = $.noConflict(true);
</script>
<script src="{{ asset('JqueryUI/jquery-ui.js') }} "></script>

 
@endsection
  