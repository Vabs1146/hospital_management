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

	
	<div class="row">
        <div class="col-lg-12" style="text-align:center;">
           <h2>{{strtoupper($ivf_type)}}</h2>
        </div>
    </div>
 
	 	<br>
	<div class="row">
        <div class="col-sm-4">
           LMP :
        </div>
        <div class="col-sm-8">
           {{ $main_details->ivf_od_lmp }}
        </div>
    </div>
 
	 	<br>
	<div class="row">
        <div class="col-sm-4">
           Pre-IVF Hysteroscopy :
        </div>
        <div class="col-sm-8">
           {{ $main_details->ivf_od_pre_ivf_heteroscopy }}   
        </div>
    </div>
 
	 	<br>
	<div class="row">
        <div class="col-sm-4">
           Agonist Depo :
        </div>
        <div class="col-sm-8">
			<div class="col-sm-12">
				<div class="col-sm-6">
					Name
				</div>
				<div class="col-sm-6">
					Date
				</div>
			</div>
           @foreach($ivf_agonist_data as $ivf_agonist_data_row)
			<div class="col-sm-12">
				<div class="col-sm-6">
					{{$ivf_agonist_data_row->name}}
				</div>
				<div class="col-sm-6">
					{{$ivf_agonist_data_row->date}}
				</div>
			</div>
			@endforeach 
        </div>
    </div>
 
	 	<br>
	<div class="row">
        <div class="col-sm-2">
           CYCLE TYPE :
        </div>
        <div class="col-sm-4">
           {{ $main_details->ivf_od_cycle_type }}   
        </div>
        <div class="col-sm-2">
           INJECTION :
        </div>
        <div class="col-sm-4">
           {{ $main_details->ivf_od_injection }}   
        </div>
    </div>
    
        <br>
        <div class="table-responsive">
			<table class="table  table-bordered" style="width:100%;">
				<tr style="border:1px solid;">
					<th>Date</th>
					<th>DAY OF MENSES</th>
					<th>DAY OF TABLET</th>
					<th>ET</th>
					<th>DOSES
						<table style="width:100%;">
							<tr>
						<td>Medicine</td>
						<td>Duration</td>
						<td>Time</td>
							</tr>
						</table>
					</th>
					<th>NOTES</th>
				</tr>

				@foreach($ivf_menses_data as $ivf_od_menses_row)
				<tr>
					<td>
							{{ $ivf_od_menses_row->menses_injection_date }} 
					</td>
					<td>
							{{ $ivf_od_menses_row->menses_day }}   
					</td>
					<td>
							{{ $ivf_od_menses_row->menses_tablet_day }}       
					</td>
					<td>
							{{ $ivf_od_menses_row->menses_et }}   
					</td>
					<td>
					<table style="width:100%;">
						@foreach($ivf_menses_dosage_data[$ivf_od_menses_row->id] as $ivf_menses_dosage_data_row) 
							<tr>
								<td>{{ $ivf_menses_dosage_data_row['medicine'] }} </td>
								<td>{{ $ivf_menses_dosage_data_row['duration'] }}</td>
								<td>{{ $ivf_menses_dosage_data_row['time'] }} </td>
							</tr>
						@endforeach
						</table>
					</td>
					<td>
							{{ $ivf_od_menses_row->notes }}   
					</td>
				</tr>
				@endforeach
			</table>
        </div>
 
	 	<br>

		<div class="row">
			<div class="col-sm-4">
			  Follow-up Date & Time :
			</div>
			<div class="col-sm-2">
			   1. {{ $main_details->ivf_followup_1 }}   
			</div>
			<div class="col-sm-2">
			   2. {{ $main_details->ivf_followup_2 }}
			</div>
			<div class="col-sm-2">
			   3. {{ $main_details->ivf_followup_3 }}  
			</div>
			<div class="col-sm-2">
			   4. {{ $main_details->ivf_followup_4 }} 
			</div>
		</div>
        

     
	 	<br>

	<div class="row">
        <div class="col-sm-4">
           Notes :
        </div>
        <div class="col-sm-8">
           {{ $main_details->ivf_od_notes }}   
        </div>
    </div>
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