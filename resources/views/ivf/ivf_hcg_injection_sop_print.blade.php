<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
    /* Print styling */
 
 .list-group1 li
 {
    float: left;
    list-style-type: square;
    margin: 10px 20px;
    padding:0px;
 }
    @media print {
        [class*="col-sm-"] {
            float: left;
        }
        [class*="col-xs-"] {
            float: left;
        }
        .col-sm-12,
        .col-xs-12 {
            width: 100% !important;
        }
        .col-sm-11,
        .col-xs-11 {
            width: 91.66666667% !important;
        }
        .col-sm-10,
        .col-xs-10 {
            width: 83.33333333% !important;
        }
        .col-sm-9,
        .col-xs-9 {
            width: 75% !important;
        }
        .col-sm-8,
        .col-xs-8 {
            width: 66.66666667% !important;
        }
        .col-sm-7,
        .col-xs-7 {
            width: 58.33333333% !important;
        }
        .col-sm-6,
        .col-xs-6 {
            width: 50% !important;
        }
        .col-sm-5,
        .col-xs-5 {
            width: 41.66666667% !important;
        }
        .col-sm-4,
        .col-xs-4 {
            width: 33.33333333% !important;
        }
        .col-sm-3,
        .col-xs-3 {
            width: 25% !important;
        }
        .col-sm-2,
        .col-xs-2 {
            width: 16.66666667% !important;
        }
        .col-sm-1,
        .col-xs-1 {
            width: 8.33333333% !important;
        }
        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-xs-1,
        .col-xs-2,
        .col-xs-3,
        .col-xs-4,
        .col-xs-5,
        .col-xs-6,
        .col-xs-7,
        .col-xs-8,
        .col-xs-9,
        .col-xs-10,
        .col-xs-11,
        .col-xs-12 {
            float: left !important;
        }
        body {
            margin: 0;
            padding: 0 !important;
            min-width: 768px;
        }
        .container {
            width: auto;
            min-width: 750px;
        }
        body {
            font-size: 14px;
        }
        a[href]:after {
            content: none;
        }
        .noprint,
        div.alert,
        header,
        .group-media,
        .btn,
        .footer,
        form,
        #comments,
        .nav,
        ul.links.list-inline,
        ul.action-links {
            display: none !important;
        }
    }
 
    </style>
</head>
<body>
 <div class="container-fluid"> 
    @if($logoUrl)
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
	@endif

<!-- =================================================================================================== -->	

<div class="col-sm-12">
			<div class="col-sm-12">
				<div class="form-group labelgrp">            
				Inform sir about
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-4">
				<div class="form-group labelgrp">
					<label for="sop_hcg_ing_trigger_date_time" >Trigger Date & Time :</label>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="form-line">
						{{ $ivf_icsi_medicine->sop_hcg_ing_trigger_date_time }}   
					</div>
				</div>
			</div>
		</div>


		<div class="col-sm-12">
			<div class="col-sm-4">
				<div class="form-group labelgrp">
					<label for="rmo_name" >RMO Name :</label>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<div class="form-line">
						{{ $ivf_icsi_medicine->rmo_name }}                            
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-4">
				<div class="form-group labelgrp">
					<label for="reception_informed" > Reception Informed :</label>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<div class="form-line">
						{{ $ivf_icsi_medicine->reception_informed }}                            
					</div>
				</div>
			</div>
		</div>


		@include('ivf.elements.view.icsi_medicine')
<br>
		<div class="col-sm-12">
			<div class="col-sm-4">
				<div class="form-group labelgrp">            
					{{ Form::label('pt_instruction','Pt. Instruction :') }} 
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="form-line">           
						{{ $ivf_icsi_medicine->pt_instruction }}       
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-6">
				<div class="form-group labelgrp">            
					{{ Form::label('real_time_video_sent_to_sir','Real Time video with timings to be sent to Sir') }} 
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-12">
				<div class="form-group">
					<div class="form-line">           
						{{ $ivf_icsi_medicine->real_time_video_sent_to_sir }}       
					</div>
				</div>
			</div>
		</div>


<!-- ======================================================================================================= -->

        <div class="row">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>
 
</body>
</html>