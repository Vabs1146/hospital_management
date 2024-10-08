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
                              
                    <div class="card">
                        <div class="header">
                            <h2>Patient Search Case</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">

								<div class="col-md-12">

<div class="col-md-2">

	<div class="input-group">
		<span class="input-group-addon">
		Today's Patients  :
		</span>
		<input type="radio" class="" placeholder="" id="all_patient_show_1" name="all_patient_show" value="0" style="position: relative; left: auto; opacity: 1;" checked>

		<span class="input-group-addon">
		All Patient :
		</span>
		<input type="radio" class="" placeholder="" id="all_patient_show_2" name="all_patient_show" value="1" style="position: relative; left: auto; opacity: 1;">
	</div>
</div>

<div class="col-md-2">
	<div class="input-group">
		<span class="input-group-addon">
		New  :
		</span>
		<input type="radio" class="" placeholder="" id="patient_visit_new" name="patient_visit" value="new" style="position: relative; left: auto; opacity: 1;">

		<span class="input-group-addon">
		Followup  :
		</span>
		<input type="radio" class="" placeholder="" id="patient_visit_followup" name="patient_visit" value="followup" style="position: relative; left: auto; opacity: 1;">
	</div>
</div>

                                   <div class="col-md-2">
								
									<div class="input-group">
                                        <span class="input-group-addon">
                                           Mr./Mrs./Ms. :
                                        </span>
                                        <select name="mr_mrs_ms" id="mr_mrs_ms" class="form-control select2" placeholder="">
										<option value=""></option> 
                                       <option value="Mr.">Mr.</option> 
                                       <option value="Mrs.">Mrs.</option> 
                                       <option value="Ms.">Ms.</option> 
                                    </select>
                                    </div>
                                </div>

									<div class="col-md-2">
										<div class="input-group">
											<span class="input-group-addon">
												First Name :
											</span>
											<div class="form-line">
												<input type="text" class="form-control" placeholder="" id="first_name" name="first_name">
											</div>
										</div>
									</div>

                                <div class="col-md-2">
										<div class="input-group">
											<span class="input-group-addon">
												Middle Name :
											</span>
											<div class="form-line">
												<input type="text" class="form-control" placeholder="" id="middle_name" name="middle_name">
											</div>
										</div>
									</div>
								
								<div class="col-md-2">
										<div class="input-group">
											<span class="input-group-addon">
												Last Name :
											</span>
											<div class="form-line">
												<input type="text" class="form-control" placeholder="" id="last_name" name="last_name">
											</div>
										</div>
									</div>
                              </div>

                              <div class="col-md-12">
                                
                                 <div class="col-md-4">
								
									<div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor Name :
                                        </span>
                                        <select name="searchByDoctor" id="searchByDoctor" class="form-control select2" placeholder="select your doctor">
										                    <option value="">Select</option> 
                                        @foreach($doctor as $doctor)
                                         <option value="{{$doctor->id}}">{{$doctor->doctor_name}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
								
								<div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            From Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           To Date :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control datepicker" placeholder="" id="ToDate" name="ToDate">
                                        </div>
                                    </div>
                                </div>
								
                              </div>
							  
							  
							  <div class="col-md-12">
                                   

                                  <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Ophtometry Seen Name :
                                        </span>
										<!--
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByOptometrist" name="searchByOptometrist">
                                        </div> -->
										<select name="searchByOptometrist" id="searchByOptometrist" class="form-control select2" placeholder="select user">
                                            <option value="">Select</option> 
											@foreach($ophtometry_users_array as $key => $val)
											 <option value="{{$key}}">{{$val}}</option> 
											@endforeach
										</select>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Add Patient User Name  :
                                        </span>
										<!--
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByUser" name="searchByUser">
                                        </div> -->
										
										<select name="searchByUser" id="searchByUser" class="form-control select2" placeholder="select user">
                                            <option value="">Select</option> 
                                        @foreach($all_users_array as $key => $val)
                                         <option value="{{$key}}">{{$val}}</option> 
                                        @endforeach
										</select>
                                    </div>
                                </div>
								
								<div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Referred By  :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control " placeholder="" id="searchByReferrer" name="searchByReferrer">
                                        </div>
                                    </div>
                                </div>

                                 
                              </div>
							  
<div class="col-md-12">
	  <div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				Diagnosis :
			</span>
			<div class="form-line">
			   {{ Form::select('diagnosis', array(''=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		</div>
	</div>

	 <div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
			   Procedure / Surgery   :
			</span>
			<div class="form-line">
				{{ Form::select('surgery', array(''=>'-Select-') + $form_dropdowns->where('fieldName', 'surgery')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		</div>
	</div>
	
	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				Vision  :
			</span>
			<div class="form-line">
				{{ Form::select('vision', array(''=>'-Select-') + $form_dropdowns->where('fieldName', 'dvn_od')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				IOL  :
			</span>
			<div class="form-line">
				{{ Form::select('iol', array(''=>'-Select-') + $form_dropdowns->where('fieldName', 'selected_iol')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control select2','data-live-search'=>'true')) }}
			</div>
		</div>
	</div>
  </div>
							  
<div class="col-md-12">
   <div class="col-md-2">
	<div class="input-group">
		<span class="input-group-addon">	
		   Patients age wise in date range  :
		</span>
		
		@php 
			$age_array = array(
				'less_18' => 'less than 18 years',
				'18_40' => '18 yrs. to 40 yrs',
				'41_60' => '41 yrs to 60 yrs',
				'60_more' => 'more than 60 years',
			);
		@endphp
		<select name="patient_age" id="patient_age" class="form-control select2" placeholder="select age">
		<option value="">Select</option> 
		@foreach($age_array as $key => $age)
		 <option value="{{$key}}">{{$age}}</option> 
		@endforeach
	</select>
	</div>
  </div>

  <div class="col-md-2">
	<div class="input-group">
		<span class="input-group-addon">	
		   Patients Waiting Time  :
		</span>
		
		@php 
			$waiting_array = array(
				'1' => '30min. to 1 hours',
				'2' => '1 hours to 2 hours',
				'3' => '2 hours to 3 hours',
				'4' => '> 3 hours',
			);
		@endphp
		<select name="waiting_time" id="waiting_time" class="form-control select2" placeholder="select age">
		<option value="">Select</option> 
		@foreach($waiting_array as $key => $wait)
		 <option value="{{$key}}">{{$wait}}</option> 
		@endforeach
	</select>
	</div>
  </div>

     <div class="col-md-3">
		  <div class="input-group">
			<span class="input-group-addon">
			   Fix Surgery  :
			</span>
			<div class="form-line">
				<input type="text" class="form-control datepicker" placeholder="" id="fix_surgery_date" name="fix_surgery_date">
			</div>
		</div>
	</div>

	<div class="col-md-3">
		  <div class="input-group">
			<span class="input-group-addon">
			   Area  :
			</span>
			<div class="form-line">
				<input type="text" class="form-control" placeholder="" id="area" name="area">
			</div>
		</div>
	</div>

	<!-- <div class="col-md-2">
		<div class="input-group">
			<span class="input-group-addon">
			   New  :
			</span>
	<input type="radio" class="" placeholder="" id="patient_visit_new" name="patient_visit" value="new" style="position: relative; left: auto; opacity: 1;">
	
	<span class="input-group-addon">
			   Followup  :
			</span>
	<input type="radio" class="" placeholder="" id="patient_visit_followup" name="patient_visit" value="followup" style="position: relative; left: auto; opacity: 1;">
		</div>
	
		<div class="input-group">
			
		</div>
	</div> -->

  

 <div class="col-md-2">
	<div class="form-group">
		<button type="button" onclick="return searchPatient()" class="btn btn-default waves-effect">Search</button></div>
  </div>
</div>
							  
                           </div>
                        </div>
                    </div>
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>List of Patients</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]">
                              <thead>
                                <tr>
                                    <th class="never">Date</th>               
                                    <th>Visit Time</th>                  
                                    <th>Case No.</th>                     
                                    <th>UHID Number</th>          
                                    <th>Patient Name | Age | Area</th>                   
                                   <!--  <th>Age</th>  -->
                                   <!--  <th>Gender</th>      -->                                   
                                    <th>Doctor Name</th>
                                    <th>Referred By </th>
                                    <th>Optometrist Seen</th>
                                    <th>User</th>
									<th>Diagnosis</th>
                                    <th>Procedure</th>
                                    <th>Vision</th>
                                    <th>Fix Surgery</th>
                                    <th>Posted for Doctor</th>

									<!-- <th>Area</th> -->
									<th>Waiting Time</th>
                                    <th>IOL</th>
                                    <!--<th>Is Followup</th>
                                     <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Mr./Mrs./Ms.</th> -->
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
			theGrid = $('#thegrid').DataTable({
				"processing": true,
				"serverSide": true,
				"ordering": true,
				"responsive": false,
				"autoWidth": false,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"ajax": "{{url('today-opdbill-report-grid')}}/",
				"columnDefs": [
					{
						"targets": 0,
						"visible": true,
						"searchable": false,
						"class":"never"
					},
					//{ "visible": false, "targets": groupColumn }
				],
				//"order": [[ groupColumn, 'asc' ]],
				"displayLength": 25,
				dom: 'Blfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5'
				]
			} );
        });
    </script>
	
	<script type="text/javascript">
    function searchPatient() {
		/*
			var searchByName = $('#searchByName').val();
			var searchByDoctor = $('#searchByDoctor').val();
			var fromDate = $('#fromDate').val();
			var ToDate = $('#ToDate').val();

			var searchByOptometrist = $('#searchByOptometrist').val();
			var searchByUser = $('#searchByUser').val();
			var searchByReferrer = $('#searchByReferrer').val();
			var all_patient_show = $('#all_patient_show').val();

			var diagnosis=$('select[name=diagnosis]').val();
			var surgery=$('select[name=surgery]').val();
			var vision=$('select[name=dvn_od]').val();

			var patient_age=$('#patient_age').val();
			var fix_surgery_date=$('#fix_surgery_date').val();
		*/
		let patients = [$('select[name=mr_mrs_ms]').val(), $('#first_name').val(), $('#middle_name').val(), $('#last_name').val(), $('#area').val()];

		console.log(patients);

		theGrid.column(1).search( JSON.stringify(patients) );
		theGrid.column(2).search( $('#searchByDoctor').val() );
		theGrid.column(3).search( $('#fromDate').val() );
		theGrid.column(4).search( $('#ToDate').val() );
		theGrid.column(5).search( $('#searchByOptometrist').val() );
		theGrid.column(6).search( $('#searchByUser').val() );
		theGrid.column(7).search( $('#searchByReferrer').val() );

		//theGrid.column(8).search( $('#all_patient_show').val() );

		theGrid.column(8).search( $('input[name="all_patient_show"]:checked').val() );

		theGrid.column(9).search( $('select[name=diagnosis]').val() );
		theGrid.column(10).search( $('select[name=surgery]').val() );
		theGrid.column(11).search( $('select[name=dvn_od]').val() );
		theGrid.column(12).search( $('#patient_age').val() );
		theGrid.column(13).search( $('#fix_surgery_date').val());

		//theGrid.column(14).search( $('#area').val() );
		theGrid.column(15).search( $('#waiting_time').val() );
		theGrid.column(14).search( $('select[name=iol]').val() );
		/*
		theGrid.column(17).search( $('input[name="is_followup"]:checked').val());
		theGrid.column(18).search( $('#middle_name').val());
		theGrid.column(19).search( $('#last_name').val());
		theGrid.column(20).search( $('select[name=mr_mrs_ms]').val() );
		*/
		
		theGrid.ajax.reload();
        return false;
    }
    </script>
@endsection
