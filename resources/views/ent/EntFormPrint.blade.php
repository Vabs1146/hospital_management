<!DOCTYPE html>
@inject('CheckField', 'App\Http\Controllers\EntController')
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
    /* Print styling */
 
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
                 
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="Patient_name" class="control-label">Patient Name :</label>   {{ $casedata['patient_name'] }} 
            </div>
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <label class="control-label">Age :</label>   {{ $casedata['patient_age'] }}
                </div>
                <div class="col-sm-6">
                    <label class="control-label">Gender :</label>   {{ $casedata['male_female'] }}
                </div>
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
        @if(!$CheckField::IsFieldEmpty($form_details->CNS))       
            <div class="row">
                <div class="col-sm-12">
                    <label class="control-label">General Complaints :</label>   {!! nl2br($form_details->CNS) !!} 
                </div>
            </div>
        @endif
        <br>
        <br>
              <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <td>
                                    
                                </td>
                                <td >
                                    <strong>OD</strong>
                                </td>
                               
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'complaint')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Complaint
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                              
                            </tr>                            
                        @endforeach 
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'finding')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                    Finding      
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                            
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'diagnosis')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                        Diagnosis
                                    @endif
                                </td>
                                <td colspan="2">
                                    {{$item->field_value_OD}}
                                </td>
                            </tr>                            
                        @endforeach
                      
                    
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'treatment_advice')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                     Treatment Advice
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                                
                            </tr>                            
                        @endforeach
                        @foreach ($form_details->entformmultipleentry()->where('field_name', 'life_style_chenger')->get() as $item)
                            <tr>
                                <td>
                                    @if ($loop->iteration == 1)
                                     Life Style Changer
                                    @endif
                                </td>
                                <td>
                                    {{$item->field_value_OD}}
                                </td>
                               
                            </tr>                            
                        @endforeach
                        
                       
                        </tbody>
                    </table>
                </div>
              </div>  
            
                <div class="col-md-12">
                @if(count($blnc_test)>1)
                <div class="col-md-2">
                    <div class="form-group labelgrp">
                    <label>Balance Test :</label>   
                    </div>
                </div>
               <div class="col-md-12">
                @foreach($blnc_test as $key => $blnctest)
                <div class="col-md-2 ">
                    <ul class="" >
                       <li class="" style="list-style-type: none;"><label><b>{{$key+1}}.&nbsp;{{$blnctest->blncetestname}}</b></label> </li>
                    </ul>
                    
                </div>
                @endforeach
                </div>
                @endif
              </div>


<!----------------------------------------------------------------------------->
 <legend>Examination</legend>
 <div class="table-responsive">
            <table class="table  table-bordered">
                
                 <tbody>
                @if (!empty($form_details->leftear) && !is_null($form_details->leftear)&& ($form_details->ear1_chk=="1"))
                   <tr>
                   <td>Left Ear</td>
                   <td>
                        @if (!empty($form_details->leftear) && !is_null($form_details->leftear))
                          
                            <center id="wPaint-leftear"> 
                                    <img src={{ Storage::disk('local')->url($form_details->leftear)."?".filemtime(Storage::path($form_details->leftear)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                            </center>
                        @endif
                   </td>
                   </tr>
                   @endif 

                @if (!empty($form_details->rightear) && !is_null($form_details->rightear)&& ($form_details->ear2_chk=="1"))
                   <tr>
                   <td>Right Ear</td>
                   <td>
                        @if (!empty($form_details->rightear) && !is_null($form_details->rightear))
                          
                            <center id="wPaint-rightear"> 
                                    <img src={{ Storage::disk('local')->url($form_details->rightear)."?".filemtime(Storage::path($form_details->rightear)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                            </center>
                        @endif
                   </td>
                   </tr>
                   @endif 

                @if (!empty($form_details->nose) && !is_null($form_details->nose)&& ($form_details->nose_chk=="1"))
                   <tr>
                   <td>Nose</td>
                   <td>
                        @if (!empty($form_details->nose) && !is_null($form_details->nose))
                          
                            <center id="wPaint-nose"> 
                                    <img src={{ Storage::disk('local')->url($form_details->nose)."?".filemtime(Storage::path($form_details->nose)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                            </center>
                        @endif
                   </td>
                   </tr>
                   @endif 

                @if (!empty($form_details->neck) && !is_null($form_details->neck)&& ($form_details->neck_chk=="1"))
                   <tr>
                   <td>Neck</td>
                   <td>
                        @if (!empty($form_details->neck) && !is_null($form_details->neck))
                          
                            <center id="wPaint-neck"> 
                                    <img src={{ Storage::disk('local')->url($form_details->neck)."?".filemtime(Storage::path($form_details->neck)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                            </center>
                        @endif
                   </td>
                   </tr>
                   @endif 

                @if (!empty($form_details->throat) && !is_null($form_details->throat)&& ($form_details->throat_chk=="1"))
                   <tr>
                   <td>Throat</td>
                   <td>
                        @if (!empty($form_details->throat) && !is_null($form_details->throat))
                          
                            <center id="wPaint-throat"> 
                                    <img src={{ Storage::disk('local')->url($form_details->throat)."?".filemtime(Storage::path($form_details->throat)) }} class="img-rounded" alt="Image Not found" width="50%" height="50%" />
                            </center>
                        @endif
                   </td>
                   </tr>
                   @endif 
            </tbody>   
                </table>
            </div>
   <!--  <div class="col-md-12">
            <legend>Examination</legend>
                   
            @if (!empty($form_details->leftear) && !is_null($form_details->leftear)&& ($form_details->ear1_chk=="1"))
            <div class="col-md-3">
            <label for="ear1_chk"><b>Left Ear</b></label>
            <div class="">
            @if (!empty($form_details->leftear) && !is_null($form_details->leftear))
                <center id="wPaint-leftear"> 
                        <img src={{ Storage::disk('local')->url($form_details->leftear)."?".filemtime(Storage::path($form_details->leftear)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>    
            </div>
            @endif
            
            @if (!empty($form_details->rightear) && !is_null($form_details->rightear)&& ($form_details->ear2_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Right Ear</b></label>
            <div class="">
            @if (!empty($form_details->rightear) && !is_null($form_details->rightear))
                <center id="wPaint-rightear"> 
                        <img src={{ Storage::disk('local')->url($form_details->rightear)."?".filemtime(Storage::path($form_details->rightear)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif

            @if (!empty($form_details->nose) && !is_null($form_details->nose)&& ($form_details->nose_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Nose</b></label>
            <div class="">
            @if (!empty($form_details->nose) && !is_null($form_details->nose))
                <center id="wPaint-nose"> 
                        <img src={{ Storage::disk('local')->url($form_details->nose)."?".filemtime(Storage::path($form_details->nose)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif

            @if (!empty($form_details->neck) && !is_null($form_details->neck)&& ($form_details->neck_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Neck</b></label>
            <div class="">
            @if (!empty($form_details->neck) && !is_null($form_details->neck))
                <center id="wPaint-neck"> 
                        <img src={{ Storage::disk('local')->url($form_details->neck)."?".filemtime(Storage::path($form_details->neck)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif

            @if (!empty($form_details->throat) && !is_null($form_details->throat)&& ($form_details->throat_chk=="1"))
            <div class="col-md-3">
            <label for="ear2_chk"><b>Throat</b></label>
            <div class="">
            @if (!empty($form_details->throat) && !is_null($form_details->throat))
                <center id="wPaint-throat"> 
                        <img src={{ Storage::disk('local')->url($form_details->throat)."?".filemtime(Storage::path($form_details->throat)) }} class="img-rounded" alt="Image Not found" width="100%" height="150" />
                </center>
            @endif
            </div>  
            </div>
            @endif
        </div>
                -->
    <!------------------------------------------------------------------------------>
               <div class="col-md-12">
                   
                    <div class="col-md-4">
                    <label for="uveiitis_chk"><b>Investigation</b></label>
                    
                    </div>
                    

                <div class="col-md-12">
                    @if($form_details->uveiitis_chk=="1")
                    <div class="col-md-4">
                        <label for="uveiitis_chk"><b>Investigation For Uveiitis</b></label>
                          <ul class="list-group1">
                                            <li class="list-group-item1" style="">Cbc</li>
                                            <li class="list-group-item1" style="">Esr</li>
                                            <li class="list-group-item1" style="">Fbs/ppbs</li>
                                            <li class="list-group-item1" style="">Mantoux test</li>
                                            <li class="list-group-item1" style="">Chest x-ray</li>
                                            <li class="list-group-item1" style="">Suptum for TB</li>
                                            <li class="list-group-item1" style="">SERUM ACE</li>
                                            <li class="list-group-item1" style="">CECT CHEST</li>
                                            <li class="list-group-item1" style="">BAL</li>
                                            <li class="list-group-item1" style="">RA FACTOR</li>
                                            <li class="list-group-item1" style="">ANTI dsDNA,ANA</li>
                                            <li class="list-group-item1" style="">P-ANCA,C-ANCA</li>
                                            <li class="list-group-item1" style="">Serum homocysteine</li>
                                            <li class="list-group-item1" style="">HLA B27</li>
                                            <li class="list-group-item1" style="">IgG and IgM anti Toxo antibodies</li>
                                            <li class="list-group-item1" style="">HIV,HCV</li>
                                            <li class="list-group-item1" style="">VDRL</li>
                                        </ul>
                    </div>
                     @endif
                     @if($form_details->preoperative_chk=="1")
                    <div class="col-md-4">
                    <label for="preoperative_chk"><b>Pre Operative Investigation</b></label>
                    <ul class="list-group1">
                                        <li class="list-group-item1" style="">CBC</li>
                                        <li class="list-group-item1" style="">ESR</li>
                                        <li class="list-group-item1" style="">FBS/PPBS</li>
                                        <li class="list-group-item1" style="">HIV 1&2</li>
                                        <li class="list-group-item1" style="">HbsAG</li>
                                        <li class="list-group-item1" style="">HCV</li>
                                        <li class="list-group-item1" style="">URINE ROUTINE/MICROSCOPE</li>
                                        <li class="list-group-item1" style="">BUN</li>
                                        <li class="list-group-item1" style="">S CREATININE</li>
                                        <li class="list-group-item1" style="">S ELECTROLYTES</li>
                                        <li class="list-group-item1" style="">Chest x-ray and ECG</li>
                                        </ul>
                         
                    </div>
                     @endif

                     @if($form_details->preoperative_chk1=="1")
                    <div class="col-md-4">
                    <label for="preoperative_chk1"><b>Pre Operative Investigation1</b></label>
                    <ul class="list-group1">
                                        <li class="list-group-item1" style="">CBC</li>
                                        <li class="list-group-item1" style="">ESR</li>
                                        <li class="list-group-item1" style="">FBS/PPBS</li>
                                        <li class="list-group-item1" style="">HIV 1&2</li>
                                        <li class="list-group-item1" style="">HbsAG</li>
                                        <li class="list-group-item1" style="">HCV</li>
                                        <li class="list-group-item1" style="">URINE ROUTINE/MICROSCOPE</li>
                                        <li class="list-group-item1" style="">BUN</li>
                                        <li class="list-group-item1" style="">S CREATININE</li>
                                        <li class="list-group-item1" style="">S ELECTROLYTES</li>
                                        <li class="list-group-item1" style="">Chest x-ray and ECG</li>
                                        </ul>
                         
                    </div>
                     @endif

                </div>
                 <div class="col-md-12">
                  <div class="table-responsive">
                  
                            @if(null !== old('prescriptions',$casedata['prescriptions']) && count(old('prescriptions',$casedata['prescriptions']))> 0 )
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            Medicine
                                        </th>
                                        
                                        <th>
                                           Times a Day  
                                        </th>
                                        <th>
                                            Days
                                        </th>
                                        <th>
                                            Quantity   
                                        </th>
                                        
                                       
                                    </tr>
                                        @foreach(old('prescriptions',$casedata['prescriptions']) as $prescption)
                                            <tr>   
                                                <td>
                                                    {{ $prescption->Medical_store->medicine_name }}
                                                </td>
                                                
                                                <td>
                                                   {{ $prescption->numberoftimes }}
                                                    
                                                </td>
                                                <td>
                                                    {{ $prescption->medicine_Quntity }}
                                                </td>
                                                <td>
                                                   {{ $prescption->strength }}
                                                </td>
                                                
                                                
                                               
                                            <tr>
                                        @endforeach
                                    @endif
                                </table>
                                </div>
                </div>
               </div>

        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <div class="pull-right">
                    <b>{{ config('app.name', 'Dr') }}</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
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