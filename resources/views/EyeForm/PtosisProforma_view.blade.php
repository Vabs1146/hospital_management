@extends('adminlayouts.master')
@section('content')

<div class="container-fluid">
<div class="row clearfix">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header bg-pink">
              <h2>Paediatric Eye Evaluation View </h2>
              </div>
              <div class="body">
                        <div class="col-md-12"> 
                          <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>S. No</th>
                                    <th></th>
                                    <th>Right Eye</th>
                                    <th>Left Eye</th>
                                </tr>
                                <tr>
                                    <th>1.</th>
                                    <th>Ptosis</th>
                                    <td>
                                        @php $fieldName = "PtosisRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "PtosisLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>2.</th>
                                    <th>MRD 1</th>
                                    <td>
                                        @php $fieldName = "MRD1Right"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "MRD1Left"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>3.</th>
                                    <th>MRD 2</th>
                                    <td>
                                        @php $fieldName = "MRD2Right"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "MRD2Left"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>4.</th>
                                    <th>PFH</th>
                                    <td>
                                        @php $fieldName = "PFHRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "PFHLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>5.</th>
                                    <th>LPS ACTION</th>
                                    <td>
                                        @php $fieldName = "LPSACTIONRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "LPSACTIONLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>6.</th>
                                    <th>FRONTALIS OVERACTION</th>
                                    <td>
                                        @php $fieldName = "FRONTALISOVERACTIONRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "FRONTALISOVERACTIONLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>7.</th>
                                    <th>LID CREASE</th>
                                    <td>
                                        @php $fieldName = "LIDCREASERight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "LIDCREASELeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>8.</th>
                                    <th>BELL’S PHENOMEMNON</th>
                                    <td>
                                        @php $fieldName = "BELLSPHENOMEMNONRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "BELLSPHENOMEMNONLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>9.</th>
                                    <th>CORNEAL SENSATION</th>
                                    <td>
                                        @php $fieldName = "CORNEALSENSATIONRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "CORNEALSENSATIONLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>10.</th>
                                    <th>ORBICULARIS ACTION</th>
                                    <td>
                                        @php $fieldName = "ORBICULARISACTIONRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "ORBICULARISACTIONLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>11.</th>
                                    <th>MGJW</th>
                                    <td>
                                        @php $fieldName = "MGJWRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "MGJWLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>12.</th>
                                    <th>FATIGUE TEST</th>
                                    <td>
                                        @php $fieldName = "FATIGUETESTRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "FATIGUETESTLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>13.</th>
                                    <th>ICE TEST</th>
                                    <td>
                                        @php $fieldName = "ICETESTRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "ICETESTLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>14.</th>
                                    <th>EDROPHONIUM /NEOSTIGMINE TEST</th>
                                    <td>
                                        @php $fieldName = "EDROPHONIUMNEOSTIGMINETESTRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "EDROPHONIUMNEOSTIGMINETESTLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>15.</th>
                                    <th>SQUINT</th>
                                    <td>
                                        @php $fieldName = "SquintRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "SquintLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>16.</th>
                                    <th>TEAR FUNCTION</th>
                                    <td>
                                        @php $fieldName = "TEARFUNCTIONRight"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                    <td>
                                        @php $fieldName = "TEARFUNCTIONLeft"; @endphp
                                        {{ $form_field_values->where('form_field_code', $field_name_id[$fieldName])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id[$fieldName])->first()->field_data }}
                                    </td>
                                </tr>
                            </table>
                            </div>
                        </div>


                        <div class="row clearfix">
                        <div class="col-sm-6">
                        <div class="col-sm-6">Doctor's Signature</div>
                        <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        <div class="col-sm-6">
                        <div class="col-sm-6">PARENT'S/RELATIVE'S SIGNATURE</div>
                        <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        </div>
                        </div>
               

                        <div class="row clearfix">
                        <div class="col-md-12 ">
                        <div class="form-group">
                        <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm').'/'.$form_master->id. '/'.$patientRegister->id.'/edit/Opd' }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                        <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id.'/Opd' }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i> print</a>
                        </div>
                        </div>       
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

        @endsection

