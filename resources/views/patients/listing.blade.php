@extends('adminlayouts.master')
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					
                                  @if(Session::has('flash_message'))
                                      <div class="alert alert-success">
                                          {{ Session::get('flash_message') }}
                                      </div>
                                  @endif

<!-- ================================================================================== -->
<div class="card">
	<div class="body">
		<div class="row clearfix">

		  <div class="col-md-12">
			  <div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">
						Patient Name :
					</span>
					<div class="form-line">
						<input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
					</div>
				</div>
			</div>

			 <div class="col-md-6">
				<div class="input-group">
					<span class="input-group-addon">
					   Doctor :
					</span>
					<div class="form-line">
						<!-- <input type="text" class="form-control" placeholder="" id="searchByDoctor" name="searchByDoctor"> -->

						<select name="searchByDoctor" id="searchByDoctor" class="form-control select2" placeholder="select your doctor">
							<option value="">Select</option> 
							@foreach($all_docotrs as $all_doctor_key => $all_doctor)
								<option value="{{$all_doctor_key}}" >{{$all_doctor}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			  <div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">
						Ipd Number :
					</span>
					<div class="form-line">
						<input type="text" class="form-control" placeholder="" id="searchIpdNumber" name="searchIpdNumber">
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">
						From Date :
					</span>
					<div class="form-line">
						<input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
					</div>
				</div>
			</div>

			 <div class="col-md-4">
				<div class="input-group">
					<span class="input-group-addon">
					   To Date :
					</span>
					<div class="form-line">
						<input type="text" class="form-control datepicker" placeholder="" id="ToDate" name="ToDate">
					</div>
				</div>
			</div>

			 <div class="col-md-3">
				<div class="form-group">
					<button type="button" onclick="return searchPatient()" class="btn btn-default waves-effect">Search</button></div>
			  </div>
		  </div>
	   </div>
	</div>
</div>
<!-- ================================================================================== -->
                              
                   
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>List of Patients</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
								<!--
                                    <th class="never">ID</th>                
                                    <th>Registration Date</th>                     
                                    <th>IPD Number</th>                
                                    <th>UHID Number</th>               
                                    <th>Patient Name</th>
                                    <th></th>
                                 --> 
								 
								<th class="never">ID</th>   
								<th>Patient Name</th>   
								<th>IPD No.</th>    
								<th>UHID No.</th>   
								<th>Admission Paper</th>   
								
								<!-- <th>Consent</th>   
								<th>IPD Bill</th>   
								<th>Add Payment receipt</th> 
								<th>Hospital Charges Particulars</th> 
								<th>Estimate Bill</th> 
								<th>IPD Summary Final Bill</th> 								
								<th>DISCHARGE SUMMARY</th>  								
								<th>Past History</th>  	 		 								
								<th>Daily Order Sheet</th>  	 								
								<th>RBS & Insulin Chart</th>  
								-->
								<th> </th>  	



                                </tr>
                              </thead>
                                <tbody>
                                </tbody>
                            </table>
                           </div>
<input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>                            
                        </div>
                    </div>
                </div>
            </div>
</div>

 @endsection
 
@section('scripts')
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){
            // $(".select2").select2()
            theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                "ajax": { "url" : "{{url('patients/grid')}}", 'type':'POST', data: {_method: 'POST', _tokdssdsen :$("#hdnCsrfToken").data('token'), searchByDay: $("#searchByDay").val()}},
                "order": [[ 0, "desc" ]],
                lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
                "createdRow": function( row, data, dataIndex){
                    //console.log(row);
                    //console.log(data);
                    //console.log(dataIndex);
                    if(data[12] == "1"){
                        $(row).addClass('redClass');
                    }
                },
					
                "columnDefs": [
					/*
                    {
                        "targets": 0,
                        "visible": false,
                        "searchable": false,
                        "class":"never"
                    },
						
					{
                        "render": function (data, type, row ) {
								//let action = '<a href="'+{{ url('/edit-patient') }}+'/'+row[0]+'"><i class="fa fa-pencil-alt" aria-hidden="true"></i>Case History</a>';

								let action = '<a href="{{ url('/edit-patient') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

                             action += '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';

							 action += '<a href="{{ url('/patients/consent/') }}/'+row[0]+'" class="btn btn-info ">Consent</a>';

							 action += '<a href="{{ url('/patients/discharge/') }}/'+row[0]+'" class="btn btn-info ">Discharge</a>';



								return action;
                        },
                        "sortable": false,
                        "targets": 5
                    }
						*/
						/*
                    {
                        "render": function ( data, type, row ) {
                            return data;
                        },
                        "targets": 1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 13                    
                    },
                    {
                        "render": function ( data, type, row ) {
                            //return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-danger">Delete</a>';
                            //return '<a href="{{ url('/ViewMedicalDetails') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-eye" aria-hidden="true"></i></a>';
							return data;
                        },
                        "sortable": false,
                        "targets": 13+1
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/editPatientDetials') }}/'+row[0]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-edit" aria-hidden="true"></i></a>';

                        },
                        "sortable": false,
                        "targets": 13+2
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 13+3
                    },
					*/
//=======================================================================================
					{
                        "render": function (data, type, row ) {
							let action = '';

@if($commonHelper->checkUserAccess("11_register",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_register",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
                            action += '<div style="border-bottom: 1px solid;">Admission Paper : <a href="{{ url('/edit-patient') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif

@if($commonHelper->checkUserAccess("11_register",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)

							action += '<a href="{{ url('/patients-registration-print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
				@endif			
							//==================================================
							/*
							action += '<div style="border-bottom: 1px solid;">Consent : <a href="{{ url('/edit-patient') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients-registration-print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
							
							
							//==================================================
							action += '<div style="border-bottom: 1px solid;">IPD Bill : <a href="{{ url('/edit-patient') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients-registration-print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
							*/
							//==================================================

@if($commonHelper->checkUserAccess("11_add-ipd-payment",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_add-ipd-payment",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Add Payment receipt : <a href="{{ url('/add-ipd-payment') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif							
							//==================================================
@if($commonHelper->checkUserAccess("11_edit-hospital-charges-particulars",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_edit-hospital-charges-particulars",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Hospital Charges Particulars : <a href="{{ url('/edit-hospital-charges-particulars') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif
							//==================================================

@if($commonHelper->checkUserAccess("11_ipd-estimate-bill",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_ipd-estimate-bill",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Estimate Bill : <a href="{{ url('/ipd-estimate-bill') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif		

@if($commonHelper->checkUserAccess("11_ipd-estimate-bill",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/print-ipd-estimate-bill') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
@if($commonHelper->checkUserAccess("11_ipd-summary-final-bill",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_ipd-summary-final-bill",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">IPD Summary Final Bill : <a href="{{ url('/ipd-summary-final-bill') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif		

@if($commonHelper->checkUserAccess("11_ipd-summary-final-bill",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)

							action += '<a href="{{ url('/print-ipd-summary-final-bill') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							//==================================================
                            
							action += '<div style="border-bottom: 1px solid;">Consent Form : <a href="{{ url('/patients/consent') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients/print-patient-consent') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
            
                            //==================================================
                            
@if($commonHelper->checkUserAccess("11_patients/discharge",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_patients/discharge",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">DISCHARGE SUMMARY : <a href="{{ url('/patients/discharge') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif		

@if($commonHelper->checkUserAccess("11_patients/discharge",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/patients/discharge/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
                            
@if($commonHelper->checkUserAccess("11_patients_history_sheet",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_patients_history_sheet",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Past History : <a href="{{ url('/patients_history_sheet') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif				

@if($commonHelper->checkUserAccess("11_patients_history_sheet",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/patients_history_sheet/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
                            
@if($commonHelper->checkUserAccess("11_daily-order-sheet",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_daily-order-sheet",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Daily Order Sheet : <a href="{{ url('/daily-order-sheet') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif			

@if($commonHelper->checkUserAccess("11_daily-order-sheet",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/daily-order-sheet/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
                            
@if($commonHelper->checkUserAccess("11_tpr-monitoring-chart",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_tpr-monitoring-chart",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">TPR Monitoring Chart : <a href="{{ url('/tpr-monitoring-chart') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif		

@if($commonHelper->checkUserAccess("11_tpr-monitoring-chart",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/tpr-monitoring-chart/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
                            
@if($commonHelper->checkUserAccess("11_treatment-medication-sheet",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_treatment-medication-sheet",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Treatment/Medication Sheet : <a href="{{ url('/treatment-medication-sheet') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif			

@if($commonHelper->checkUserAccess("11_treatment-medication-sheet",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/treatment-medication-sheet/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
                            
@if($commonHelper->checkUserAccess("11_nurses-over-report",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_nurses-over-report",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">Nurses Over Report : <a href="{{ url('/nurses-over-report') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif		

@if($commonHelper->checkUserAccess("11_nurses-over-report",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/nurses-over-report/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							//==================================================
                            
@if($commonHelper->checkUserAccess("11_rbs-insulin-chart",Auth::user()->id, 'edit_permission') || $commonHelper->checkUserAccess("11_rbs-insulin-chart",Auth::user()->id, 'add_permission')  || AUTH::user()->role == 1)
							action += '<div style="border-bottom: 1px solid;">RBS & Insulin Chart : <a href="{{ url('/rbs-insulin-chart') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';
@endif				

@if($commonHelper->checkUserAccess("11_rbs-insulin-chart",Auth::user()->id, 'print_permission')  || AUTH::user()->role == 1)
							action += '<a href="{{ url('/rbs-insulin-chart/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a></div>';
@endif							
							
							return action;
                        },
                        "sortable": false,
                        "targets": 4
                    },
					
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 5
                    }

/*
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/edit-patient') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients-registration-print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 4
                    },
					{
                        "render": function (data, type, row ) {
							//let action = '<a href="{{ url('/edit-patient') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							let action = '<a href="{{ url('/admission-consent') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 5,
							"visible": false
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/patients_ipd/patientBill/') }}/'+row[4]+'/edit" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients_ipd/patientBill/print/') }}/'+row[4] +'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 6,
							"visible": false
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/add-ipd-payment') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							//action += '<a href="{{ url('/print-advance-receipt') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 7
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/edit-hospital-charges-particulars') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							//action += '<a href="{{ url('/print-hospital-charges-particulars') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 8
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/ipd-estimate-bill') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/print-ipd-estimate-bill') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 9
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/ipd-summary-final-bill') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/print-ipd-summary-final-bill') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 10
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/patients/discharge') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients/discharge/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 11
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/patients_history_sheet') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/patients_history_sheet/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 12
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/daily-order-sheet') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/daily-order-sheet/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 13
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/rbs-insulin-chart') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/rbs-insulin-chart/print') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 14
                    },
                    {
                        "render": function ( data, type, row ) {
                            return '<a href="#" onclick="return doDelete('+row[0]+')" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        },
                        "sortable": false,
                        "targets": 15
                    },
	*/				
//====================================================================================
						/*,
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/edit-patient') }}/'+row[4]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/print-advance-receipt') }}/'+row[4]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 10
                    },
					{
                        "render": function (data, type, row ) {
							let action = '<a href="{{ url('/edit-patient') }}/'+row[3]+'" class="btn btn-default  btn-circle waves-effect waves-circle waves-float"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>';

							action += '<a href="{{ url('/print-advance-receipt') }}/'+row[3]+'" class="btn btn-default btn-circle waves-effect waves-circle waves-float"><i class="fa fa-print" aria-hidden="true"></i></a>';
							return action;
                        },
                        "sortable": false,
                        "targets": 11
                    }
						*/

                ],
					
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });

		function searchPatient() {
         var searchByName=$('#searchByName').val();
         var searchByDoctor=$('#searchByDoctor').val();
         var searchIpdNumber=$('#searchIpdNumber').val();
         var fromDate=$('#fromDate').val();
         var ToDate=$('#ToDate').val();
		 
		
        
         if(searchByName != ""){		 
           //theGrid.column(1).search(searchByName).draw();

		   theGrid.column(1).search(searchByName);
         }

         if(searchByDoctor != ""){
           //theGrid.column(2).search(searchByDoctor).draw();
		   theGrid.column(2).search(searchByDoctor);
         }         
         if(searchIpdNumber != ""){
           //theGrid.column(3).search(searchIpdNumber).draw();

		   theGrid.column(3).search(searchIpdNumber);
         }

		 if(fromDate != ""){
           //theGrid.column(4).search(fromDate).draw();
		   theGrid.column(4).search(fromDate);
         }

		 if(ToDate != ""){
           //theGrid.column(5).search(ToDate).draw();
		   theGrid.column(5).search(ToDate);
         }

         if(searchByName == "" && searchByDoctor == "" && searchIpdNumber == "" && fromDate == "" && $('#payment_mode').val() == "" && ToDate == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
			theGrid.column(4).search('');
            theGrid.column(5).search('');
            //theGrid.ajax.reload();
         }

		 theGrid.ajax.reload();
        return false;
        }

		 function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url("/patients/delete") }}', 
               type: 'POST',
               data: {_method: 'POST', _token :$("#hdnCsrfToken").data('token'), 'id' : id}
               }).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }
    </script>
@endsection
