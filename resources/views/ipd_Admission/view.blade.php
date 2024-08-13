@extends('adminlayouts.master')
@section('style')
@inject('CheckField', 'App\Http\Controllers\EyeFormController')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!-- Styles -->
<link rel="stylesheet" href="{{ asset('JqueryUI/jquery-ui.css') }}">
 
 
@endsection
@section('content')

<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       
                         <div class="header bg-pink">
                            <center><h1 class=""><u>ADMISSION PAPER & CONSENT LETTER</u></h1></center>                          
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Name of Patient :</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->name}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-lable">Contact no:</label>
                                    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->mobile_no .'  '. $patientRegister->phone_no}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">UHID no :</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->uhid_no}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-lable">IPD no:</label>
                                    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                           {{$patientRegister->ipd_no}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Age :</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->age}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-lable"> Sex:</label>
                                    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->gender}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Weight :</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->weight}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-lable">Address:</label>
                                    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                           {{$patientRegister->address}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Date/Time of admission :</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->registration_date .' '.$patientRegister->registration_time }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-lable">Discharge Date/Time:</label>
                                    
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                          {{$patientRegister->discharge_date .' '.$patientRegister->discharge_time}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Registration Number:</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{$patientRegister->ipd_no}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 

                            <div class="row clearfix">
    <ul class="list-group">
        <li class="list-group-item">1. Explained about nature/risk/complications of disease</li>
        <li class="list-group-item">1. Marathi</li>
        <li class="list-group-item">2. We are admitting our patient in this hospital with all the due risk of disease which is explained to us.</li>
        <li class="list-group-item">2. Marathi</li>
        <li class="list-group-item">3. We give consent to hospital to perform necessary investigations/procedure/treatment on our patient.</li>
        <li class="list-group-item">3. Marathi</li>
        <li class="list-group-item">4. We have been informed about surgery & anaesthesia to be performed on our patient. Doctor explained due risk of this operation <u>{{ $form_field_values->where('form_field_code', $field_name_id["Operation"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Operation"])->first()->field_data}}</u> and anaesthesia <u>{{ $form_field_values->where('form_field_code', $field_name_id["Anaesthesia"])->isEmpty()?"":$form_field_values->where('form_field_code', $field_name_id["Anaesthesia"])->first()->field_data}}</u> we give consent for that.</li>
        <li class="list-group-item">4. Marathi</li>
        <li class="list-group-item">5. We will accept to take treatment from other substitute doctors in absence of Dr. Mangesh Kasle/Dr. Sulbha Kasle, provided by them for our services.</li>
        <li class="list-group-item">5. Marathi</li>
        <li class="list-group-item">6. We have been explained about services available in this hospital & provisional expenses on treatment.</li>
        <li class="list-group-item">6. Marathi</li>
 
</div>

<div class="row clearfix">
    <center>
        <div class="col-sm-12">
            WE HAVE BEEN EXPLAINED ALL TERMS & CONDITIONS IN OUR LANGUAGE / HINDI LANGUAGE. WE ACCEPT IT.
        </div>
        <div class="col-sm-12">
           Marathi
        </div>
    </center>
</div> 
        <div class="row justify-content-between">
         <div class="col-sm-3">
            <div class="col-sm-12">
                {{ empty($patientRegister->consultant_doctor)?"--": $doctorlist[$patientRegister->consultant_doctor] }}
            </div>
            <div class="col-sm-12">MD. DGO(Mum)</div>
            <div class="col-sm-12">Reg No 64886</div>
        </div>
          <div class="col-sm-3"></div>
          <div class="col-sm-3"></div>
          <div class="col-sm-3">
              <div class="col-sm-12"> <b>PATIENT/PATIENT RELATIVES SIGNATURE</b> </div>
              <div class="col-sm-12"></div>
              <div class="col-sm-12"></div>
          </div>
  </div>
<br/>
<br/>
<div class="row">
    <div class="col-sm-3">
        <div class="col-sm-12">
            {{ empty($patientRegister->consultant_doctor)?"--": $doctorlist[$patientRegister->consultant_doctor] }}
        </div>
        <div class="col-sm-12">MD. DGO(Mum)</div>
        <div class="col-sm-12">Reg No 64886</div>
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <div class="col-sm-12"> <b>SIGNATURE OF WITNESS</b> </div>
        <div class="col-sm-12"></div>
        <div class="col-sm-12"></div>
    </div>
</div>
<br/>
<br/>

                             <div class="row clearfix">
                                <div class="col-md-4">
                                <div class="form-group">
                                <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                                  <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/print/').'/'.$form_master->id.'/'.$patientRegister->id }}" target="_blank"><i class="glyphicon glyphicon-chevron-left"></i> print</a>
                                  <a class="btn btn-default btn-lg" href="{{ url('/dynamicForm/').'/'.$form_master->id.'/'.$patientRegister->id .'/edit' }}"><i class="glyphicon glyphicon-chevron-left"></i> Edit</a>
                                      
                                    </div>
                                </div>
                               
                            </div>

                            
                        </div>
                       
                    </div>
                </div>
            </div>


</div>

        @endsection
