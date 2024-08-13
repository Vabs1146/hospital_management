@extends('adminlayouts.master')
<style type="text/css">
  tfoot  {
    text-align: right;
}
</style>
@section('content')
<section class="content">
<div class="container-fluid">
  <div class="list-group list-group-horizontal">
        @forelse ($model['DateWiseRecordLst'] as $VisitListDateWise)
                @if($model['case_master']['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/bill_details').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/bill_details').'/'.$VisitListDateWise['id'].'/edit' }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <form action="{{ url('/bill_details'.( isset($model) ? "/" . $model['case_master']['id'] : "")) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    @if (isset($model['case_master']['id']) && !empty($model['case_master']['id']))
                            <input type="hidden" name="_method" value="PATCH">
                    @endif
                         <div class="header bg-pink">
                            <h2>
                               Add/Edit Bill Detail
                            </h2>
                          
                        </div>
                         <div class="form-group">
                          @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                         </div>
                        <div class="body">
                            <div class="row clearfix">
                               <input type="hidden" name="id" id="id" class="form-control" value="{{$model['case_master']['id'] or ''}}" readonly="readonly">   


                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Case Number</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="case_number" id="case_number" class="form-control" value="{{$model['case_master']['case_number'] or ''}}"  readonly="readonly">                            
                              </div>
                              </div>
                              </div>

                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Patient Name</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="patient_name" id="patient_name" class="form-control"  readonly='readonly' value="{{ $model['case_master']['patient_name'] or ''}}">
                              </div>
                              </div>
                              </div>
                              <div class="col-md-2">
                              <div class="form-group labelgrp">
                              <label for="case_number">Payment Mode</label>
                              </div>
                              </div>


                              <div class="col-md-4">
                              <div class="form-group">
                              <div class="form-line">
                              <input type="text" name="payment_mode" id="payment_mode" class="form-control"   value="{{ $model['case_master']['payment_mode'] or ''}}">                            
                              </div>
                              </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-offset-3 col-sm-6">
                                      <div class="form-group-row">
                                          <div class="col-sm-6">
                                          </div>
                                          <div class="col-sm-3">                
                                          </div>
                                          <div class="col-sm-3">
                                          </div>
                                      </div>
                                 </div>
                              </div>
                              <div class="col-sm-offset-3 col-sm-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>    
                                    <label for="bill_item" class="control-label">Details</label>
                                    <input type="text" name="bill_item" id="bill_item" class="form-control" value="{{$model['bill_item'] or ''}}"> 
                                </td>
                                <td>
                                    <label for="bill_Amount" class="control-label">Bill Amount</label>
                                    <input type="number" step="0.01" name="bill_Amount" id="bill_Amount" class="form-control" value="{{$model['bill_Amount'] or ''}}">                            
                                </td>
                                <td> 
                                    <label for="Item_Add" class="control-label">&nbsp;</label>
                                    <button class="btn btn-success form-control" name="Item_Add" value="Item_Add" type="submit"> <i class="fa fa-plus"></i> Add</button>                      
                                 </td>
                            </tr>
                            @if(null !== old('bill_data',$model['bill_data']) && count(old('bill_data',$model['bill_data']))> 0 )
                                @foreach(old('bill_data',$model['bill_data']) as $billdata) 
                                    <tr>
                                        <td> {{ $billdata->bill_item }} </td>
                                        <td> {{ $billdata->bill_Amount }} </td>
                                        <td> {{ Form::button('Delete', array('class'=> 'btn btn-warning pull-right', 'Value' => $billdata->id, 'name' => 'delete_item', 'type'=>'submit')) }} </td>
                                    </tr>
                                @endforeach
                                     <tr>
                                        <td align="right"> <label for="totalAmount" class="control-label">Total</label>  </td>
                                        <td> 
                                            <?php $itemsum = 0; 
                                                  $itemsum = $model['bill_data']->sum('bill_Amount') 
                                            ?>
                                            <input type="number" name="totalAmount" id="totalAmount" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                        </td>
                                        <td>  </td>

                                     
                                    </tr>

                                    <!--  <tr>
                                        <td > <label for="totalAmount" class="control-label">Payment Way</label>  </td>
                                        <td> 
         <input type="number" name="payment_mode" id="payment_mode" class="form-control" value="{{ $itemsum }}"  readonly="readonly"> 
                                          
                                            
                                        </td>
                                        <td>  </td>

                                     
                                    </tr> -->

                            @endif
                        </table>
                    </div>
                </div>

                <div class="form-group">
                {{-- <label for="totalAmount" class="col-sm-3 control-label">Final Bill</label> --}}
                <div class="col-sm-6">
                    <?php 

                      $billamount = isset($itemsum) && $itemsum > 0 ? floatval($itemsum - floatval($model['case_master']['paidAmount'])) : 0;
                      $billamount = $billamount > 0 ? ($billamount += $billamount*(floatval($model['case_master']['tax_percentage'])/100)) : $billamount;
                    ?>
                    {{-- <input type="number" name="tax_percentage" id="tax_percentage" class="form-control"  value="{{ $billamount }}" readonly="readonly" > --}}
                </div>
            </div>   
            <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="save_bill" id="save_bill"  value="save_bill" class="btn btn-success">
                        <i class="fa fa-plus"></i> Save
                    </button> 
                    <button type="submit" name="save_print_bill" id="save_print_bill" value="save_print_bill" class="btn btn-success">
                        Save Print
                    </button> 
                    <a class="btn btn-default" href="{{ url('/bill_details') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                </div>

                            </div>

                        </div>
                     </form>
                    </div>
                </div>
            </div>


</div>
</section>

 @endsection


@section('scripts')
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
    <script type="text/javascript">
        var theGrid = null;
        $(document).ready(function(){

    //            $('select').on('change', function (e) {
    //                 $('#total').empty();
    //        var optionSelected = $("option:selected", this);
    // var docid = this.value;
   // alert(docid);

     theGrid = $('#thegrid').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "responsive": false,
                "autoWidth": false,
                 
                "ajax": "{{url('patientbill/report/grid')}}/",//+docid,
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    {
                        "targets": 0,
                        "visible": true,
                        "searchable": false,
                        "class":"never"
                    }
                ],
                dom: 'Blfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                 drawCallback: function () {
      var api = this.api();
      $( api.table().footer() ).html("<th></th><th></th><th></th><th></th><th></th><th>Total "+
        api.column( 5, {page:'current'} ).data().sum()+"</th>"
      );
    }
                
        
            });

      // $.ajax({
      //           url:"{{url('patientbill/gettotal')}}",//+docid,
      //           method:"get",
              
      //       success:function(response) {

      //        var Total=response;
      //        $("#total").append(Total);
      // //  alert(Total);

      //         }
      //     }); 

        // });

             
           

            $('.datepicker').datepicker({
                format: "yyyy/mm/dd",
                weekStart: 1,
                clearBtn: true,
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
            });
        });
        function doDelete(id) {
            if(confirm('You really want to delete this record?')) {
               $.ajax({ url: '{{ url('/case_masters') }}/' + id, type: 'DELETE'}).success(function() {
                theGrid.ajax.reload();
               });
            }
            return false;
        }

        function searchPatient(){
         
         if($('#doctor_id').val() != ""){
           theGrid.column(1).search(
                $('#doctor_id').val()
            ).draw();
         }

         if($('#fromDate').val() != ""){
           theGrid.column(2).search(
                $('#fromDate').val()
            ).draw();
         }         
         if($('#ToDate').val() != ""){
           theGrid.column(3).search(
                $('#ToDate').val()
            ).draw();
         }
         if($('#doctor_id').val() == "" && $('#fromDate').val() == "" && $('#ToDate').val() == ""){
            theGrid.column(1).search('');
            theGrid.column(2).search('');
            theGrid.column(3).search('');
            theGrid.ajax.reload();
         }
        return false;
        }



    </script>
@endsection