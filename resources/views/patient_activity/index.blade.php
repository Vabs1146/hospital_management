@extends('adminlayouts.master')
@section('content')
<style>
.in-status {
	color:white;
	background-color: lightgreen;
}
.out-status {
	color:white;
	background-color: coral;
}
</style>
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
                                  <a href="{{url('/AddPatient_Details/0')}}" class="btn btn-primary btn-lg" role="button">Add Patient Details</a>
                                  <a href="{{url('/patientDetails/patient/report')}}" class="btn btn-primary btn-lg" role="button">Patient report</a>
                                </div>


                              <div class="col-md-12">
                                   <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Patient Number :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByNumber" name="searchByNumber">
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            Patient Name :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByName" name="searchByName">
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Doctor :
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="" id="searchByDoctor" name="searchByDoctor">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <!-- <span class="input-group-addon">
                                           Patients:
                                        </span> -->
                                        <div class="form-line">
                                            <select class="form-control select2" id="searchByDay">
                                                <option value="today">Todays Patients</option>
                                                <option value="all">All Patients</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" onclick="return searchPatient()" class="btn btn-default btn-lg waves-effect">Search</button></div>
                                  </div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <div class="card">
                         <div class="header bg-pink">
                            <h2>Activity of Patients</h2>
                         </div>
                        <div class="body">
                           <div class="table-responsive">
                            <!-- <table class="table table-hover table-bordered dataTable js-exportable" id="thegrid" data-stripe-classes="[]"> -->
							
							<table class="table table-hover table-bordered dataTable js-exportable" id="patient_view" data-stripe-classes="[]">
                              <thead>
                                <tr>
                                    <th class="never">ID</th>               
                                    <th>Photo</th>                  
                                    <th>Visit Time</th>                
                                    <th>Patient Number</th>         
                                    <th>Patient Name</th>   
									
                                    <th>Doctor</th>               
                                    <th>Referrer Name</th>   
                                    <th>Receptionist</th>  
                                    <th>Opthalmetry</th>
                                    <th>Doctor</th>
									
									<th>Procedure</th>
                                    <th>Billing</th>
                                    <th>Consultant</th>
                                    <th>Out Of Clinic</th>
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
	function get_array(in_out) {
		if(in_out) {
			return in_out.split("_");
		} else {
			return in_out;
		}
	}
	
	
		var theGrid = null;
		
       $(document).ready(function(){
			theGrid = $('#patient_view').DataTable( {
				"processing": true,
				"serverSide": true,
				"aaSorting" : [[0, 'desc']],
				"ajax": { "url" : "{{url('patient-activty-grid')}}", 'type':'POST', data: {_method: 'POST', _tokdssdsen :$("#hdnCsrfToken").data('token'), searchByDay: $("#searchByDay").val()}},
				"createdRow": function( row, data, dataIndex){
                    //console.log(row);
                    //console.log(data);
                    //console.log(dataIndex);
					/*
                    if(data[11] == "1"){
                        $(row).addClass('redClass');
                    }
					*/
					//$("td:eq(7)", row).css("background-color", "red");
					$("td:eq(7)", row).addClass("out-status");
					if(data[7] != "" && data[7] != null) {
						//$("td:eq(7)", row).css("background-color", (data[7] == "In") ? "green" : "red");
					}
					if(data[8] != "" && data[8] != null) {
						
						console.log(data[8]);
						if(data[8]) {
							var arr = get_array(data[8]);
							var status = arr[0];
							
							//$("td:eq(8)", row).css("background-color", (arr[0] == "In") ? "green" : "red");
							
							$("td:eq(8)", row).addClass((arr[0] == "In") ? "in-status" : "out-status");
						} 
					}
					
					if(data[9] != "" && data[9] != null) {
						if(data[9]) {
							var arr = get_array(data[9]);
							var status = arr[0];
							
							//$("td:eq(9)", row).css("background-color", (arr[0] == "In") ? "green" : "red");
							
							$("td:eq(9)", row).addClass((arr[0] == "In") ? "in-status" : "out-status");
						} 
						//$("td:eq(9)", row).css("background-color", (data[9] == "In") ? "green" : "red");
					}
					
					if(data[10] != "" && data[10] != null) {
						if(data[10]) {
							var arr = get_array(data[10]);
							var status = arr[0];
							
							//$("td:eq(10)", row).css("background-color", (arr[0] == "In") ? "green" : "red");
							$("td:eq(10)", row).addClass((arr[0] == "In") ? "in-status" : "out-status");
						} 
						//$("td:eq(10)", row).css("background-color", (data[10] == "In") ? "green" : "red");
					}
					
					if(data[11] != "" && data[11] != null) {
						if(data[11]) {
							var arr = get_array(data[11]);
							var status = arr[0];
							
							//$("td:eq(11)", row).css("background-color", (arr[0] == "In") ? "green" : "red");
							$("td:eq(11)", row).addClass((arr[0] == "In") ? "in-status" : "out-status");
						} 
						//$("td:eq(11)", row).css("background-color", (data[11] == "In") ? "green" : "red");
					}
					
					if(data[12] != "" && data[12] != null) {
						if(data[12]) {
							var arr = get_array(data[12]);
							var status = arr[0];
							
							//$("td:eq(12)", row).css("background-color", (arr[0] == "In") ? "green" : "red");
							$("td:eq(12)", row).addClass((arr[0] == "In") ? "in-status" : "out-status");
						} 
						//$("td:eq(12)", row).css("background-color", (data[12] == "In") ? "green" : "red");
					}
					
					if(data[13] != "" && data[13] != null) {
						if(data[13]) {
							var arr = get_array(data[13]);
							var status = arr[0];
							
							//$("td:eq(13)", row).css("background-color", (arr[0] == "In") ? "green" : "red");
							
							$("td:eq(13)", row).addClass((arr[0] == "In") ? "in-status" : "out-status");
						} 
						//$("td:eq(13)", row).css("background-color", (data[13] == "In") ? "green" : "red");
					}
					//console.log(data);
                },
				"columnDefs": [
					{
                        "render": function ( data, type, row ) {
							//console.log(row[1]);
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>'+row[0]+'</a>';
                        },
                        "sortable": true,
                        "targets": 0                    
                    },
				
					{
                        "render": function ( data, type, row ) {
							//console.log(data);
							//console.log(type);
							//console.log(row);
                            return 'Out';
                        },
                        "sortable": true,
                        "targets": 7                    
                    },
					{
                        "render": function ( data, type, row ) {
							var status_txt = "";
							if(row[8]) {
								var arr = get_array(row[8]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
								
								//return '<label> <b>IN - </b>'+ in_time +'</label><br><label><br/><b>OUT - </b>'+ out_time +'</label><br>'
								if(in_time != '') {
									status_txt += '<label> <b>IN - </b><br>'+ in_time +'</label>';
								}
								
								if(in_time != '' && out_time != '') {
									status_txt += '<hr>';
								}
								
								if(out_time != '') {
									status_txt += '<label><b>OUT - </b><br>'+ out_time +'</label>';
								}
							}
							return status_txt;	
								
                            
                        },
                        "sortable": false,
                        "targets": 8                    
                    },
					{
                        "render": function ( data, type, row ) {
							var status_txt = "";
							if(row[9]) {
								var arr = get_array(row[9]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
								
								
								//return '<label> <b>IN - </b>'+ in_time +'</label><br><label><br/><b>OUT - </b>'+ out_time +'</label><br>'
								
								if(in_time != '') {
									status_txt += '<label> <b>IN - </b><br>'+ in_time +'</label>';
								}
								
								if(in_time != '' && out_time != '') {
									status_txt += '<hr>';
								}
								
								if(out_time != '') {
									status_txt += '<label><b>OUT - </b><br>'+ out_time +'</label>';
								}
							}
							return status_txt;								
                            
                        },
                        "sortable": false,
                        "targets": 9                    
                    },
					{
                        "render": function ( data, type, row ) {
							var status_txt = "";
							if(row[10]) {
								var arr = get_array(row[10]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
								
								//return '<label> <b>IN :</b>'+ in_time +'</label><br><label><br/><b>OUT :</b>'+ out_time +'</label><br>'
								if(in_time != '') {
									status_txt += '<label> <b>IN - </b><br>'+ in_time +'</label>';
								}
								
								if(in_time != '' && out_time != '') {
									status_txt += '<hr>';
								}
								
								if(out_time != '') {
									status_txt += '<label><b>OUT - </b><br>'+ out_time +'</label>';
								}
							}
							return status_txt;	
                            
                        },
                        "sortable": false,
                        "targets": 10                    
                    },
					{
                        "render": function ( data, type, row ) {
							var status_txt = "";
							if(row[11]) {
								var arr = get_array(row[11]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
								
								//return '<label> <b>IN :</b>'+ in_time +'</label><br><label><br/><b>OUT :</b>'+ out_time +'</label><br>'
								if(in_time != '') {
									status_txt += '<label> <b>IN - </b><br>'+ in_time +'</label>';
								}
								
								if(in_time != '' && out_time != '') {
									status_txt += '<hr>';
								}
								
								if(out_time != '') {
									status_txt += '<label><b>OUT - </b><br>'+ out_time +'</label>';
								}
							}
							return status_txt;	
                            
                        },
                        "sortable": false,
                        "targets": 11                    
                    },
					{
                        "render": function ( data, type, row ) {
							var status_txt = "";
							if(row[12]) {
								var arr = get_array(row[12]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
								
								//return '<label> <b>IN :</b>'+ in_time +'</label><br><label><br/><b>OUT :</b>'+ out_time +'</label><br>'
								if(in_time != '') {
									status_txt += '<label> <b>IN - </b><br>'+ in_time +'</label>';
								}
								
								if(in_time != '' && out_time != '') {
									status_txt += '<hr>';
								}
								
								if(out_time != '') {
									status_txt += '<label><b>OUT - </b><br>'+ out_time +'</label>';
								}
							}
							return status_txt;	
                            
                        },
                        "sortable": false,
                        "targets": 12                    
                    },
					/*
					{
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 8                    
                    },
					{
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 9                    
                    },
					{
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 10                    
                    },
					{
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 11                    
                    },
					{
                        "render": function ( data, type, row ) {
                            return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
                        },
                        "sortable": false,
                        "targets": 12                    
                    },
					*/
					{
                        "render": function ( data, type, row ) {
                            //return '<a href="{{ url('/PatientMedicalDetails') }}/'+row[0]+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Case History</a>';
							
							//return '<div class="form-group"><input style="width: 20px; opacity: 1; left: auto; position: relative;" class="form-control" type="radio" name="patient_activity_state" value="in">IN<br><input style="width: 20px; opacity: 1; left: auto; position: relative;" class="form-control" type="radio" name="patient_activity_state" value="out">Out</div>';
							
							status = "";
							if(row[13]) {
								var arr = get_array(row[13]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
							}
							
							var in_checked = (status == "In") ? 'checked' : '';
							var out_checked = (status == "Out") ? 'checked' : '';
							
							//var in_checked = (row[13] == "In") ? 'checked' : '';
							//var out_checked = (row[13] == "Out") ? 'checked' : '';
							
							if(in_checked != "") {
								//$("td:eq(13)", row).css("background-color","green");
								
								$(row).css("background-color","green");
							}
							
							if(in_checked != "") {
								//$("td:eq(13)", row).css("background-color","red");
								
								$(row).css("background-color","red");
							}
							
							var status_text = '<input data-case_id="'+row[0]+'" data-type="patient_out" '+ in_checked +' style="width: 20px;height: 20px;opacity: 1;left: auto;position: relative;top: 5px;" class="patient-ativity" type="radio" name="patient_out_state_'+row[0]+'" value="In">&nbsp;IN';
							
							if(row[13]) {
								var arr = get_array(row[13]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
								
								//alert(in_time);
								
								if(in_time != '') {
									status_text += '<br>'+ in_time;
								}
							}
							
							status_text += '<hr>';
							
							status_text += '<input data-case_id="'+row[0]+'" data-type="patient_out" '+ out_checked +' style="width: 20px;height: 20px;opacity: 1;left: auto;position: relative;top: 5px;" class="patient-ativity" type="radio" name="patient_out_state_'+row[0]+'" value="Out">&nbsp;Out';
							
							
							if(row[13]) {
								var arr = get_array(row[13]);
								var status = arr[0];
								var in_time = arr[1];
								var out_time = arr[2];
																
								if(out_time != '') {
									status_text += '<br>'+ out_time;
								}
							}
							
							
							return status_text;
							
							//return '<input data-case_id="'+row[0]+'" data-type="patient_out" '+ in_checked +' style="width: 20px;height: 20px;opacity: 1;left: auto;position: relative;top: 5px;" class="patient-ativity" type="radio" name="patient_out_state_'+row[0]+'" value="in">&nbsp;IN&nbsp;&nbsp;&nbsp; <input data-case_id="'+row[0]+'" data-type="patient_out" '+ out_checked +' style="width: 20px;height: 20px;opacity: 1;left: auto;position: relative;top: 5px;" class="patient-ativity" type="radio" name="patient_out_state_'+row[0]+'" value="out">&nbsp;Out';
                        },
                        "sortable": false,
                        "targets": 13                    
                    }
				]
			} );
	 } );	
	 
	 function searchPatient() {
         
         if($('#searchByNumber').val() != ""){
            theGrid.column(1).search(
                $('#searchByNumber').val()
            ).draw();
         }
         if($('#searchByDoctor').val() != ""){
           theGrid.column(2).search(
                $('#searchByDoctor').val()
            ).draw();
         }         
         if($('#searchByName').val() != ""){
           theGrid.column(3).search(
                $('#searchByName').val()
            ).draw();
         }         
         if($('#searchByDay').val() != ""){
           theGrid.column(8).search(
                $('#searchByDay').val()
            ).draw();
         }
         if($('#searchByName').val() == "" && $('#searchByNumber').val() == "" && $('#searchByDoctor').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
	}
    </script>
@endsection
