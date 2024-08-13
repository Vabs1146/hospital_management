<?php
use App\helperClass\drAppHelper;

$convert_to_words = new drAppHelper();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
        /* Print styling */

        @media print {


            .pageBreak {
                page-break-after: always;
            }

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
                font-size: 12px;
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
                <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top"
                    width="100%" height="100%" />
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12 panel panel-default">
                    <center> <strong>
                            <h3>Discharge Summary</h3>
                        </strong> </center>
                </div>
            </div>

        </div>

        <!-- ========================================================================== -->
        <div class="row">
            <div class="col-sm-6">
                <h4>General Information</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">UHID no. :</label> {{ $registration_data->uhid_number }}
            </div>
            <div class="col-sm-4">
                <label class="control-label">IPD no. :</label> {{ $registration_data->ipd_number }}
            </div>
            <div class="col-sm-4">

                @php
                    if (isset($discharge_summary['date_time'])) {
                        $date_arr = explode(' - ', $discharge_summary['date_time']->value_1);
                    }
                @endphp
                <label class="control-label">Date :</label>
                {{ isset($discharge_summary['date_time']) ? date('d/m/Y', strtotime($date_arr[0])) . ' ' . $date_arr[1] : '' }}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Name :</label> {{ $registration_data->first_name }}
                {{$registration_data->middle_name}} {{$registration_data->last_name}}
            </div>
            <div class="col-sm-3">
                <label class="control-label">Age :</label> {{ $registration_data->age }}
            </div>
            <div class="col-sm-3">
                <label class="control-label">Sex :</label> {{$registration_data->gender }}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Address :</label> {{ $registration_data->address }}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Primary Consultant :</label>
                {{ (isset($discharge_summary['primary_consultant']) && $discharge_summary['primary_consultant']->value_1) ? $all_doctors[$discharge_summary['primary_consultant']->value_1] : ''}}
            </div>

            <div class="col-sm-6">
                <label class="control-label">Consultant :</label>
                {{ $registration_data->consultant}}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Admission Date & Time :</label>
                {{--$registration_data->admission_date_time--}}
                {{ $convert_to_words->format_date_time($registration_data->admission_date_time) }}
            </div>
            <div class="col-sm-6">
                <label class="control-label">Discharge Date & Time :</label>
                {{--$discharge_data->discharge_date_time--}}
                {{ $convert_to_words->format_date_time($discharge_data->discharge_date_time) }}
            </div>
        </div>

        @php
            $diagnosis = isset($discharge_summary['diagnosis']) ? $discharge_summary['diagnosis']->value_1 : '';
        @endphp
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Diagnosis :</label> {!! nl2br($diagnosis) !!}
            </div>
        </div>
        @php
            $discharge_against_medical_advice = isset($discharge_summary['discharge_against_medical_advice']) ? $discharge_summary['discharge_against_medical_advice']->value_1 : '';
        @endphp
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Discharge Against Medical Advice :</label>
                {!! nl2br($discharge_against_medical_advice) !!}
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <h4>Clinical Examination</h4>
            </div>
        </div>


        <div class="row">
            @php
                $bp_1 = isset($discharge_summary['bp_1']) ? $discharge_summary['bp_1']->value_1 : '';
            @endphp
            @php
                $bp_2 = isset($discharge_summary['bp_2']) ? $discharge_summary['bp_2']->value_1 : '';
            @endphp
            <div class="col-sm-4">
                <label class="control-label">BP :</label> {{$bp_1}} / {{$bp_2}} MMHG
            </div>


            @php
                $pulse_1 = isset($discharge_summary['pulse_1']) ? $discharge_summary['pulse_1']->value_1 : '';
            @endphp
            @php
                $pulse_2 = isset($discharge_summary['pulse_2']) ? $discharge_summary['pulse_2']->value_1 : '';
            @endphp
            <div class="col-sm-4">
                <label class="control-label">Pulse :</label> {{$pulse_1}} / {{$pulse_2}}
            </div>

            @php
                $rr_1 = isset($discharge_summary['rr_1']) ? $discharge_summary['rr_1']->value_1 : '';
            @endphp
            @php
                $rr_2 = isset($discharge_summary['rr_2']) ? $discharge_summary['rr_2']->value_1 : '';
            @endphp
            <div class="col-sm-4">
                <label class="control-label">R.R :</label> {{$rr_1}} / {{$rr_2}}
            </div>
        </div>

        @php
            $rs = isset($discharge_summary['rs']) ? $discharge_summary['rs']->value_1 : '';
        @endphp
        @php
            $temperature = isset($discharge_summary['temperature']) ? $discharge_summary['temperature']->value_1 : '';
        @endphp
        @php
            $cvs = isset($discharge_summary['cvs']) ? $discharge_summary['cvs']->value_1 : '';
        @endphp
        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">RS :</label> {{ $rs }}
            </div>
            <div class="col-sm-4">
                <label class="control-label">Temperature :</label> {{ $temperature }}
            </div>
            <div class="col-sm-4">
                <label class="control-label">CVS :</label> {{ $cvs }}
            </div>
        </div>

        @php
            $spo2 = isset($discharge_summary['spo2']) ? $discharge_summary['spo2']->value_1 : '';
        @endphp
        @php
            $cns = isset($discharge_summary['cns']) ? $discharge_summary['cns']->value_1 : '';
        @endphp
        @php
            $pa = isset($discharge_summary['pa']) ? $discharge_summary['pa']->value_1 : '';
        @endphp

        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">SpO2 :</label> {{ $spo2 }}
            </div>
            <div class="col-sm-4">
                <label class="control-label">CNS :</label> {{ $cns }}
            </div>
            <div class="col-sm-4">
                <label class="control-label">PA :</label> {{ $pa }}
            </div>
        </div>

        @php
            $consulting_doctor = isset($discharge_summary['consulting_doctor']) ? $discharge_summary['consulting_doctor']->value_1 : '';
        @endphp
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Consulting Doctor :</label> {{ $all_doctors[$consulting_doctor] }}
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <h4>History of Present Illness</h4>
            </div>
        </div>

        @php
            $history_of_present_illness = isset($discharge_summary['history_of_present_illness']) ? $discharge_summary['history_of_present_illness']->value_1 : '';
        @endphp

        @php
            $chief_complaints = isset($discharge_summary['chief_complaints']) ? $discharge_summary['chief_complaints']->value_1 : '';
        @endphp

        @php
            $medical = isset($discharge_summary['medical']) ? $discharge_summary['medical']->value_1 : '';
        @endphp

        @php
            $surgical = isset($discharge_summary['surgical']) ? $discharge_summary['surgical']->value_1 : '';
        @endphp

        @php
            $course_in_hospital = isset($discharge_summary['course_in_hospital']) ? $discharge_summary['course_in_hospital']->value_1 : '';
        @endphp

        @php
            $hemodynamic_condition = isset($discharge_summary['hemodynamic_condition']) ? $discharge_summary['hemodynamic_condition']->value_1 : '';
        @endphp

        @php
            $discharge_temperature = isset($discharge_summary['discharge_temperature']) ? $discharge_summary['discharge_temperature']->value_1 : '';
        @endphp

        @php
            $discharge_pulse_1 = isset($discharge_summary['discharge_pulse_1']) ? $discharge_summary['discharge_pulse_1']->value_1 : '';
        @endphp

        @php
            $discharge_pulse_2 = isset($discharge_summary['discharge_pulse_2']) ? $discharge_summary['discharge_pulse_2']->value_1 : '';
        @endphp

        @php
            $discharge_bp_1 = isset($discharge_summary['discharge_bp_1']) ? $discharge_summary['discharge_bp_1']->value_1 : '';
        @endphp


        @php
            $target_elements = [
                'discharge_bp_2',
                'discharge_rr_1',
                'discharge_rr_2',
                'diet',
                'treatment_advice',
                'treatment_on_discharge',
                'consult_symptoms',
                'final_notes',
                'followup_1',
                'followup_2',
                'followup_3',
                'followup_4'
            ];

            foreach ($target_elements as $target_elements_val) {
                ${$target_elements_val} = isset($discharge_summary[$target_elements_val]) ? $discharge_summary[$target_elements_val]->value_1 : '';
            }
        @endphp





        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Chief Complaints :</label> {!! nl2br($chief_complaints) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">History of Present Illness :</label>
                {!! nl2br($history_of_present_illness) !!}
            </div>
        </div>


        <!-- <div class="row">
        <div class="col-sm-6">
            <h4>Treatment Given</h4>
        </div>
    </div>
   
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label"></label> {!! nl2br($medical) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label">Surgical :</label> {!! nl2br($surgical) !!}
        </div>
    </div>-->


        <div class="row">
            <div class="col-sm-6">
                <h4>Course in The Hospital & Discussion</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Course in The Hospital :</label> {!! nl2br($course_in_hospital) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h4>Patient`s Condition on Discharge</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">Hemodynamic Condition :</label> {!! nl2br($hemodynamic_condition) !!}
            </div>
            <div class="col-sm-4">
                <label class="control-label">Temperature :</label> {!! nl2br($discharge_temperature) !!}
            </div>
            <div class="col-sm-4">
                <label class="control-label">Pulse :</label> {{$discharge_pulse_1}} / {{$discharge_pulse_2}}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <label class="control-label">BP :</label> {{ $discharge_bp_1 }} / {{ $discharge_bp_2 }}
            </div>
            <div class="col-sm-4">
                <label class="control-label">R.R :</label> {{ $discharge_rr_1 }} / {{ $discharge_rr_2 }}
            </div>
            <div class="col-sm-4">
                @php
                    $discharge_spo2 = isset($discharge_summary['discharge_spo2']) ? $discharge_summary['discharge_spo2']->value_1 : '';
                @endphp
                <label class="control-label">SpO2 :</label> {{ $discharge_spo2 }}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @php
                    $discharge_notes = isset($discharge_summary['discharge_notes']) ? $discharge_summary['discharge_notes']->value_1 : '';
                @endphp
                <label class="control-label">Notes :</label> {{ $discharge_notes }}
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Follow-up :</label>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-3"><label class="control-label">1. </label> {{$followup_1}}</div>
                <!--<div class="col-sm-3"><label class="control-label">2. </label> {{$followup_1}}</div>-->
                <div class="col-sm-3"><label class="control-label">2. </label> {{$followup_3}}</div>
                <div class="col-sm-3"><label class="control-label">3. </label> {{$followup_4}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h4>Instruction on Discharge</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Please come to the hospital or contact your doctor immediately if :</label>
                {!! nl2br($treatment_advice) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">In case of following (as applicable) please consult your doctor immediately
                    :</label> {!! nl2br($consult_symptoms) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h4></h4>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Treatment Given :</label> {!! nl2br($medical) !!}
            </div>
        </div>
        <!--<div class="row">
        <div class="col-sm-12">
            <label class="control-label">Surgical :</label> {!! nl2br($surgical) !!}
        </div>
    </div>-->
        <div class="row">
            <div class="col-sm-12">
                <label class="control-label">Notes1 :</label> {!! nl2br($final_notes) !!}
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <h4>Child Information</h4>
            </div>
        </div>
        <div class="row">
            @if (!empty($discharge_summary['child_sex']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Sex. :</label> {{  $discharge_summary['child_sex']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_date_time']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Date Time. :</label> {{  $discharge_summary['child_date_time']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_weight']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Weight. :</label> {{  $discharge_summary['child_weight']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_condition_at_birth']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Condition at birth. :</label>
                    {{  $discharge_summary['child_condition_at_birth']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_blood_grp']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Blood Group. :</label>
                    {{  $discharge_summary['child_blood_grp']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_cgpd']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">CGPD. :</label> {{  $discharge_summary['child_cgpd']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_tsh']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">TSH. :</label> {{  $discharge_summary['child_tsh']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_sbill']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">S. Bill. :</label> {{  $discharge_summary['child_sbill']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_phototherapy']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Kept in phototherapy. :</label>
                    {{  $discharge_summary['child_phototherapy']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_weightdischarge']->value_1))
                <div class="col-sm-4">
                    <label class="control-label">Weight on discharge. :</label>
                    {{  $discharge_summary['child_weightdischarge']->value_1 }}
                </div>
            @endif
        </div>
        <div class="row">
            @if (!empty($discharge_summary['child_bcg']->value_1))
                <div class="col-sm-2">
                    <label class="control-label">BCG. :</label> {{  $discharge_summary['child_bcg']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_given_on_bcg']->value_1))
                <div class="col-sm-10">
                    <label class="control-label">Given On. :</label>
                    {{  $discharge_summary['child_given_on_bcg']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_hepb']->value_1))
                <div class="col-sm-2">
                    <label class="control-label">HEPB. :</label> {{  $discharge_summary['child_hepb']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_given_on_hepb']->value_1))
                <div class="col-sm-10">
                    <label class="control-label">Given On. :</label>
                    {{  $discharge_summary['child_given_on_hepb']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_opv']->value_1))
                <div class="col-sm-2">
                    <label class="control-label">OPV. :</label> {{  $discharge_summary['child_opv']->value_1 }}
                </div>
            @endif
            @if (!empty($discharge_summary['child_given_on_opv']->value_1))
                <div class="col-sm-10">
                    <label class="control-label">Given On. :</label>
                    {{  $discharge_summary['child_given_on_opv']->value_1 }}
                </div>
            @endif
        </div>



        <!-- ========================================================================== -->



        <br />
        <!-- ======================================= -->

        @if(count($priscriptions_data))
            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Treatment Adviced :</h3>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>Sr. No.</strong></td>
                                            <td><strong>Medicine</strong></td>
                                            <td><strong>Times a day</strong></td>
                                            <td><strong>Day</strong></td>
                                            <td><strong>Quantity</strong></td>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php    $Sumtotal = 0; ?>
                                        @foreach($priscriptions_data as $prescption)
                                            <tr>
                                                <td>
                                                    {{  $loop->iteration }}
                                                </td>
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

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
        <!-- =================================== -->
        <br />
        <br />
        <br />
        <div class="form-group">
            <div class="col-md-6">
                _______________________
            </div>
            <div class="col-md-6 pull-right">
                _______________________
            </div>
            <div class="col-md-6">
                Signature
            </div>
            <div class="col-md-6 pull-right">
                Signature
            </div>
            <div class="col-md-6">
                {{ $registration_data->first_name . ' ' . $registration_data->middle_name . ' ' . $registration_data->last_name}}
            </div>
            <div class="col-md-6 pull-right">
                {{$convert_to_words->get_hospital_name()}}
            </div>
        </div>


        <!--<div class="row pageBreak">
                <div class="col-lg-12">
                    <img src={{ Storage::disk('local')->url($FooterUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
                </div>
                <div class="col-lg-12">&nbsp;</div>
        </div>-->


        <!-- ===================================================Prescription========================================== -->

        <!-- =========================== End Prescription ============================================================= -->


        <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function () { window.print(); }, 500);
                window.onfocus = function () { setTimeout(function () { window.close(); }, 50); }
            });
        </script>

</body>

</html>