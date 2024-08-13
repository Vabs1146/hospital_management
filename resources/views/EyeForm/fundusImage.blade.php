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
                      <form action="{{ url('/fundusImage') }}" method="POST" class="form-horizontal" id="fundusImageForm" enctype='multipart/form-data'>
                      {{ csrf_field() }}
                      {{ Form::hidden('case_id', Request::old('case_id',$case_id), array('class'=> 'form-control')) }}
                         <div class="header bg-pink">
                            <h2>
                                Fundus Image
                            </h2>
                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-12">
                              <div class="form-group">
                                <div class="col-md-6">
                                    <center> <b> OD </b> </center>
                                </div>
                                <div class="col-md-6">
                                        <center> <b> OS </b> </center>
                                </div>
                               </div>

                              </div>

                              <div class="col-md-12">
                            <div class="form-group">
                              <div class="col-md-6">
                                  <div class="example1" data-example="OdImg1">
                                      <div class="board" id="OdImg1_canvas"></div>
                                  </div>
                                  <input type="hidden" name="OdImg1" id="OdImg1">
                              </div>
                              <div class="col-md-6">
                                  <div class="example1" data-example1="OsImg1">
                                      <div class="board" id="OsImg1_canvas"></div>
                                  </div>
                                  <input type="hidden" name="OsImg1" id="OsImg1">
                              </div>
                          </div>   

                              </div>          
                            </div>
                             <div class="row clearfix">
                                <div class="col-md-4 col-md-offset-5">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit">
                                        <i class="fa fa-plus"></i> Submit
                                    </button>
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
  