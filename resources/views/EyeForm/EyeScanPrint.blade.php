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
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        <div class="col-lg-12">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label for="date" class="control-label">Date :</label>   {{ \Carbon\Carbon::now()->format('d/M/Y') }}
        </div>
        <div class="col-sm-6">
            <label for="date" class="control-label">Time :</label>   
            {{ $casedata['visit_time'] }}
        </div>
    </div>
    <div class="row">
            <div class="col-sm-6">
                <label for="case_number" class="control-label">Case Number :</label>   {{ $casedata['case_number'] }} 
            </div>
            <div class="col-sm-6">
                    <label class="control-label">UHID NO :</label>   {{ $case_master['uhid_no'] }}
                </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $casedata['patient_name'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Age / Gender:</label>   {{ $casedata['patient_age'] }} / {{ $casedata['male_female'] }}                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Address :</label>   {{ $casedata['patient_address'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Contact No. :</label>   {{ $casedata['patient_mobile'] }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Appointment Dt :</label>   {{ $casedata['appointment_dt'] }} 
            </div>
            <div class="col-sm-6">
                <label class="control-label">Appointment Time. :</label>   {{ $casedata['appointment_timeslot'] }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label"></label>   {{ $form_details->ChiefComplaint }} 
            </div>
        </div>
        <br>
        <br>

@if(count($multiple_entries_data_arr) > 0)

<div class="col-md-12">
	<label>A Scan: </label>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<td style="width:33%">
						 
					</td>
					<td >
						<strong>OD</strong>
					</td>
					<td >
						<strong>OS</strong>
					</td>
				</tr>
			</thead>
			<tbody>
				@if($multiple_entries_data_arr['flat_k']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_k']['field_value_OS'] != "")
				<tr>
					<td>Flat K</td>
					<td>{{$multiple_entries_data_arr['flat_k']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['flat_k']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['flat_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['flat_axis']['field_value_OS'] != "")
				<tr>
					<td>Flat Axis</td>
					<td>{{$multiple_entries_data_arr['flat_axis']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['flat_axis']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['stap_k']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_k']['field_value_OS'] != "")
				<tr>
					<td>Stap K</td>
					<td>{{$multiple_entries_data_arr['stap_k']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['stap_k']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['stap_axis']['field_value_OD'] != "" && $multiple_entries_data_arr['stap_axis']['field_value_OS'] != "")
				<tr>
					<td>Stap Axis</td>
					<td>{{$multiple_entries_data_arr['stap_axis']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['stap_axis']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['axial_length']['field_value_OD'] != "" && $multiple_entries_data_arr['axial_length']['field_value_OS'] != "")
				<tr>
					<td>Axial Length</td>
					<td>{{$multiple_entries_data_arr['axial_length']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['axial_length']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['optical_acd']['field_value_OD'] != "" && $multiple_entries_data_arr['optical_acd']['field_value_OS'] != "")
				<tr>
					<td>Optical ACD</td>
					<td>{{$multiple_entries_data_arr['optical_acd']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['optical_acd']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['target_refraction']['field_value_OD'] != "" && $multiple_entries_data_arr['target_refraction']['field_value_OS'] != "")
				<tr>
					<td>Target Refraction</td>
					<td>{{$multiple_entries_data_arr['target_refraction']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['target_refraction']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['lens_thickness']['field_value_OD'] != "" && $multiple_entries_data_arr['lens_thickness']['field_value_OS'] != "")
				<tr>
					<td>Lens Thickness</td>
					<td>{{$multiple_entries_data_arr['lens_thickness']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['lens_thickness']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['wtw']['field_value_OD'] != "" && $multiple_entries_data_arr['wtw']['field_value_OS'] != "")
				<tr>
					<td>WTW</td>
					<td>{{$multiple_entries_data_arr['wtw']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['wtw']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['kc_formula_use']['field_value_OD'] != "" && $multiple_entries_data_arr['kc_formula_use']['field_value_OS'] != "")
				<tr>
					<td>KC/Formula Use</td>
					<td>{{$multiple_entries_data_arr['kc_formula_use']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['kc_formula_use']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['type_of_lens']['field_value_OD'] != "" && $multiple_entries_data_arr['type_of_lens']['field_value_OS'] != "")
				<tr>
					<td>Type of Lens</td>
					<td>{{$multiple_entries_data_arr['type_of_lens']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['type_of_lens']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['se']['field_value_OD'] != "" && $multiple_entries_data_arr['se']['field_value_OS'] != "")
				<tr>
					<td>Power of Lens - Se</td>
					<td>{{$multiple_entries_data_arr['se']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['se']['field_value_OS']}}</td>
				</tr>
				@endif

				@if($multiple_entries_data_arr['iol_cilinder']['field_value_OD'] != "" && $multiple_entries_data_arr['iol_cilinder']['field_value_OS'] != "")
				<tr>
					<td>Power of Lens - IOL Cilinder</td>
					<td>{{$multiple_entries_data_arr['iol_cilinder']['field_value_OD']}}</td>
					<td>{{$multiple_entries_data_arr['iol_cilinder']['field_value_OS']}}</td>
				</tr>
				@endif

			</tbody>
		</table>
	</div>
</div>

@endif
<div class="col-md-12">
    <div><h5><b>Scan Images</b></h5></div>
    <?php foreach ($reportScan_image as  $k=>$value) { ?>
        <img src="{{ asset('/a_scan_images/'.$value['filePath']) }}" height="200px" width="200px" style="margin: 10px;">
    <?php } ?>
    
</div>

    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function () { window.print(); }, 500);
            //window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>
 
</body>
</html>