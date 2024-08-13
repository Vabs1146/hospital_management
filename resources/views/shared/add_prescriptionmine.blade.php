<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Add/Modify Prescription</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            {{ Form::model($casedata, array('url' => url('/AddEdit/prescription/'.$casedata['id']), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}<form role="form">
                <div class="card-body">
                 <div class="container-fluid">         
                  <div class="form-group">
                {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
                  </div>
                  <div class="form-group">
                    {{ Form::label('medicine_id', 'Medicine') }}
                {{ Form::select('medicine_id', array(''=>'Please select') + $casedata['medicinlist']->pluck('medicine_name','id')->toArray(), Request::old('medicine_id'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                 {{ Form::label('strength', 'Eye') }} 
                {{--  {{ Form::text('strength', Request::old('strength'), array('class'=> 'form-control')) }}  --}}
                {{ Form::select('strength', array(''=>'Please select') + $casedata['medicine_strength']->toArray(), Request::old('strength'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                 {{ Form::label('medicine_quantity', 'Day') }} 
                {{--  {{ Form::text('medicine_quantity', Request::old('medicine_quantity'), array('class'=> 'form-control')) }}  --}}
                {{ Form::select('medicine_quantity', array(''=>'Please select') + $casedata['quantity']->toArray(), Request::old('medicine_quantity'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                 {{ Form::label('numberoftimes', 'Times a Day') }} 
                {{--  {{ Form::number('numberoftimes', Request::old('numberoftimes'), array('class'=> 'form-control')) }}  --}}
                {{ Form::select('numberoftimes', array(''=>'Please select') + $casedata['numberOfTimes_drpdwn']->toArray(), Request::old('numberoftimes'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                {{ Form::submit('Add Prescription', array('class' => 'btn btn-primary', 'value' => 'prescription_save', 'name' => 'prescription_save')) }}                    
                  </div>
                   <div class="form-group">
                @include('shared.error') 
                @if(Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif
            </div>
            <div class="table-responsive">
                @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                    <table class="table">
                        <tr>
                            <th>
                                Medicine
                            </th>
                            <th>
                                Eye
                            </th>
                            <th>
                                Day
                            </th>
                            <th>
                                Times a Day    
                            </th>
                            <th>
                                <!-- Used for delete button -->    
                            </th>
                        </tr>
                            @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                <tr>   
                                    <td>
                                        {{ $prescption->Medical_store->medicine_name }}
                                    </td>
                                    <td>
                                        {{ $prescption->strength }}
                                    </td>
                                    <td>
                                        {{ $prescption->medicine_Quntity }}
                                    </td>
                                    <td>
                                        {{ $prescption->numberoftimes }}
                                    </td>
                                    
                                    {{-- <td>
                                        {{ $prescption->per_unit_cost }}
                                    </td>
                                    <td>
                                        {{ $prescption->per_unit_cost * $prescption->medicine_Quntity }}
                                    </td> --}}
                                    <td>
                                        {{ Form::button('Delete Prescription', array('class' => 'btn btn-primary', 'Value' => $prescption->id, 'name' => 'prescription_delete', 'type'=>'submit')) }}
                                        {{-- <a href="{{'/case_masters/delete/'.$prescption->id }}" class="btn btn-primary" name='prescription_delete'> Delete Prescription </a> --}}
                                    </td>
                                <tr>
                            @endforeach
                        @endif
                    </table>
                </div>
        {{ Form::close() }}
                </div>
            </div>
                <!-- /.card-body -->

                
              </form>
            </div>
            
         

          </div>

          <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
$('#medicine_id').select2();
</script>
