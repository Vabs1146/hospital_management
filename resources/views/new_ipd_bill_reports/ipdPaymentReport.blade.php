@extends('adminlayouts.master')
@section('style')
<style>
        @media screen and (max-width: 767px) {
            .select2 {
                width: 100% !important;
            }
        }
         tfoot  {
    text-align: center;
}
.dataTables_wrapper .dt-buttons a.dt-button { background-color: #2b982b !important;line-height: 2.5; }
</style>
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
 

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
                        <div class="card col-md-10" style="float:none;margin:auto;">
                        <div class="header">
                            <center><h2><b>IPD BILL PAYMENT REPORT </b></h2></center>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12"> 
                                  @if(Session::has('flash_message'))
                                      <div class="alert alert-success">
                                          {{ Session::get('flash_message') }}
                                      </div>
                                  @endif
                                </div>

                             
                              <div class="col-md-12">
                                <div class="col-md-5">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                          From Date :
                                      </span>
                                      <div class="form-line">
                                          <input type="text" class="form-control datepicker" placeholder="" id="fromDate" name="fromDate">
                                      </div>
                                  </div>
                              </div>

                               <div class="col-md-5">
                                  <div class="input-group">
                                      <span class="input-group-addon">
                                         To Date :
                                      </span>
                                      <div class="form-line">
                                          <input type="text" class="form-control datepicker" placeholder="" id="ToDate" name="ToDate">
                                      </div>
                                  </div>
                              </div> 
							  <div class="col-md-2">
										 <div class="form-group">
													  <button type="button" onclick="return searchPatient()" class="btn btn-success waves-effect">Search</button></div>
								  </div>     
                          </div>
						 
                         <!--  <div class="col-md-12">
                              
                               <div class="col-md-6">
                                     <div class="form-group">
                                                  <button type="button" onclick="return searchPatient()" class="btn btn-success waves-effect">Search</button></div>
                              </div>                                        
                          </div> -->
						 
							  {{--<div class="col-md-12">
                                   <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Fees Detail :
                                        </span>
                                        <select name="fees_detail" id="fees_detail" class="form-control select2" placeholder="select fees detail">
										<option value="">Select</option> 
                                        @foreach($fees_details_array as $key => $val)
                                         <option value="{{$val}}">{{$val}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                  </div>
								  <div class="col-md-4" style="display:none;">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           Payment Mode :
                                        </span>
                                        <select name="payment_mode" id="payment_mode" class="form-control select2" placeholder="select payment mode">
										<option value="">Select</option> 
                                        @foreach($payment_modes_array as $key => $val)
                                         <option value="{{$key}}">{{$val}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                  </div>

							  </div> --}}

							  
                           </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 20px;">
                        <form>
                         <div class="header" style="background-color:#2b982b">
                            <h2 style="color:#fff !important;"> 
                                IPD BILL PAYMENT REPORT
                            </h2>
                          
                        </div>
                        
                        <div class="body">

                          <div class="table-responsive">
                             <table class="table table-striped table-hover table-bordered" id="thegrid">
                              <!-- <thead>
                                <tr>
                              									
                              									<th>Date</th>                    
                              									<th>Case No.</th>                   
                              									<th>IPD No.</th>
                              									<th>Patient Name</th>                
                              									<th>Doctor Name</th>
                              									<th>User</th>
                              									<th>Bill Number</th>
                              									<th>Total Amount</th>
                              									<th>Advance Amount</th> 
                              									<th>Advance Amount Payment Mode / Date</th> 
                              									<th>Discount</th>
                              									<th>Total Payment</th>  
                              									<th>Paid</th>
                              									
                              									<th>Payment Mode</th>
                              									<th>Total Payment</th> 
                              									<th>Balance</th>
                                </tr>
                              </thead>
                              <tbody>
                              
                              </tbody>
                               <tfoot>
                              							   
                              								<tr>
                              									<th></th>                    
                              									<th></th>                   
                              									<th></th>
                              									<th></th>                
                              									<th></th>
                              									<th></th>
                              									<th></th>
                              									<th></th>
                              									<th></th> 
                              									<th></th> 
                              									<th></th>
                              									<th></th>  
                              									<th></th>
                              									
                              									<th></th>
                              									<th></th>
                              									<th></th>
                              
                                </tr> 
                                </tfoot> -->


								<thead>
                                <tr>		 								
									<th>Bill No.</th>              
									<th>Patient</th>       								
									<th>Payment Date</th>                         
									<th>Paid Amount</th>                   
									<th>Payment Mode</th>                
									<th>Id No.</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                               <tfoot>
								<tr>
									<th></th>                    
									<th></th>                   
									<th></th>
									<th></th>                
									<th></th>               
									<th></th> 
                                </tr> 
                                </tfoot>
                              </table>
                             
                            </div>  
                          
                        </div>
                     </form>
                    </div>
                </div>
            </div>


</div>

 @endsection


@section('scripts')
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
    <script type="text/javascript">
        var theGrid = null;
    $(document).ready(function() {
    	$('.select2').select2();
    	var case_amount_total = 0;
    	 theGrid = $('#thegrid').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"ordering": true,
    		"responsive": false,
    		"autoWidth": false,
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    		"ajax": "{{url('new-ipd-bill-payment-report-grid')}}/",
    		"columnDefs": [
    			{
    				"targets": 0,
    				"visible": true,
    				"searchable": false,
    				"class":"never"
    			}
    		],
    		"displayLength": 25,
    		dom: 'Blfrtip',
    		buttons: [
    			
				{
					extend: 'copyHtml5',
					footer: true
				},
				{
					extend: 'excelHtml5',
					footer: true
				},
				{
					extend: 'csvHtml5',
					footer: true
				},
				{
					extend: 'pdfHtml5',
					footer: true
				},
    		],
			"drawCallback": function ( settings ) {
    			
    			//----------------------------------------------------------------------
    			var api = this.api();
    			$( api.table().footer() ).html("<th></th><th></th>"
				+"<th>Total</th>"
    			+"<th><span style='b'>"+api.column( 3, {page:'current'} ).data().sum()+"</span></th>"
				+"<th></th><th></th>"
    			);
    		}

    	} );
    });

function searchPatient() {
        if($('#fromDate').val() != "") {
           theGrid.column(1).search(
                $('#fromDate').val()
            ).draw();
         }         
         if($('#ToDate').val() != "") {
           theGrid.column(2).search(
                $('#ToDate').val()
            ).draw();
         }
   

         if($('#fromDate').val() == "" && $('#ToDate').val() == "") {
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.ajax.reload();
         }
        return false;
    }
    </script>
@endsection