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
        <!-- Custom Fonts -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <style>
 /* Print styling */

.checkboxContainer {
    padding-left: 0 !important;
    padding-right: 0 !important;
    position: relative;
    float: left;
}
/*image gallery*/
.image-checkbox {
    cursor: pointer;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border: 4px solid transparent;
    margin-bottom: 0;
    outline: 0;
      display: none;
}
.image-checkbox input[type="checkbox"] {
    display: none;
}

.image-checkbox-checked {
    border-color: #4783B0;
     display: inline-block;
}
.image-checkbox .fa {
  position: absolute;
  color: #4A79A3;
  background-color: #fff;
  /* padding: 10px; */
  top: 0;
  right: 0;
}
.image-checkbox-checked .fa {
  display: block !important;
}

@media print {

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
  float: left;
}

.checkboxContainer{
    padding-left: 0 !important;
    padding-right: 0 !important;
    position: relative;
    float: left;
}

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
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
  font-size: 10px;
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
  display:none !important;
}
}
    </style>
</head>
<body>
 <div class="container-fluid">    
        <div class="row">
            <div class="col-lg-12">
                <img src="{{url('/')}}{{ Storage::disk('local')->url($logoUrl) }}" class="img-rounded" alt="letter head top" width="100%" height="150" />
            </div>
            <div class="col-lg-12">&nbsp;</div>
        </div>
	 <input type="hidden" name="patient_emailId" value="{{ $case_master['patient_emailId'] or ''}}">
	 {{ Form::hidden('case_number', Request::old('case_number'), array('class'=> 'form-control')) }}
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Patient's Name :</label> {{$case_master['patient_name']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Address :</label> {{$case_master['patient_address']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Tel. No. :</label> {{$case_master['patient_mobile']}}
            </div>
        </div>
        <div class="row">
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c2.png') }}" /> 
                    {{ Form::checkbox('dentist_pain_in[]', '1', in_array('1', $dentist_pain_in->pluck('pain_in_teeth')->toArray()), array('disabled'))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c3.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '2', in_array('2', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c4.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '3', in_array('3', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c5.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '4', in_array('4', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c6.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '5', in_array('5', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c7.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '6', in_array('6', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c8.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '7', in_array('7', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c9.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '8', in_array('8', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c10.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '9', in_array('9', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c11.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '10', in_array('10', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c12.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '11', in_array('11', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c13.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '12', in_array('12', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c14.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '13', in_array('13', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c15.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '14', in_array('14', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c16.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '15', in_array('15', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c17.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '16', in_array('16', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c2.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '17', in_array('17', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c3.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '18', in_array('18', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c4.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '19', in_array('19', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c5.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '20', in_array('20', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c6.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '21', in_array('21', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c7.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '22', in_array('22', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c8.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '23', in_array('23', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c9.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '24', in_array('24', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c10.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '25', in_array('25', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c11.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '26', in_array('26', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c12.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '27', in_array('27', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c13.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '28', in_array('28', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c14.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '29', in_array('29', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c15.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '30', in_array('30', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c16.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '31', in_array('31', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c17.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '32', in_array('32', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
        </div>
                    
        <div class="form-group">
            <legend>Advised Treatment </legend>
            <div class="col-md-12">
                <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_1 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_2" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_2 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_3" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_3 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_4" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_4 }}
            </div>
        </div>
    
        <div class="form-group">
            {{ Form::label('is_diabetes','diabetic?') }} 
            {{ $dentist->is_diabetes }}
        </div>
        <div class="form-group">
            {{ Form::label('is_bp','BP?') }} 
            {{ $dentist->is_bp }}
        </div>
        <div class="form-group">
            {{ Form::label('is_haemophiles','Haemophile?') }} 
            {{ $dentist->is_haemophiles }}
        </div>
        <div class="form-group">
            {{ Form::label('any_other_disease','Any Other Disease?') }} 
            {{ $dentist->any_other_disease }}
        </div>

        <div class="form-group">
        <legend> Bill </legend>
        <div class="table-responsive">
            <table class="table table-bordered">
                @if( !empty($dentist_bill) && null !== $dentist_bill && count($dentist_bill) > 0 )
                <thead>
                    <tr>
                        <th>    
                            {{ Form::label('treatmentDone','Treatment Done') }} 
                        </th>
                        <th>
                            {{ Form::label('date','Date') }} 
                            
                        </th>
                        <th> 
                            {{ Form::label('amountPaid','Amount Paid') }} 
                            
                            </th>
                    </tr>
                </thead>
                @foreach($dentist_bill as $billdata) 
                        <tr>
                            <td> {{ $billdata->treatmentDone }} </td>
                            <td> {{ $billdata->date }} </td>
                            <td>{{ $billdata->amountPaid }} </td>
                        </tr>
                    @endforeach
                            <tr>
                            <td>  </td>
                            <td align="right"> 
                                <p></p>
                                <label for="totalAmount" class="control-label">Total</label>  
                            </td>
                            <td> 
                                <?php $itemsum = 0; 
                                        $itemsum = $dentist_bill->sum('amountPaid'); 
										$itemsum = floatval($itemsum);
        $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
        $billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);
										/*
                                        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                        $exp = explode('.', $itemsum);
                                        $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
										*/
                                ?>
                                <p></p>
                                {{ $itemsum }}
                                <p>{{$billamountInWords}}</p> 
                            </td>
                        </tr>
                @endif
            </table>
        </div>
        </div>

   
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
            {{ $case_master['patient_name'] }}
        </div>
        <div class="col-md-6 pull-right">
            {{ config('app.name', 'Dr') }}
        </div>
    </div>

 </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $(".image-checkbox").each(function () {
                if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                    $(this).addClass('image-checkbox-checked');
                } else {
                    $(this).removeClass('image-checkbox-checked');
                }
            });
            
            setTimeout(function () { window.print();window.close(); }, 500);
            window.onfocusout = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>

</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <!-- Custom Fonts -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <style>
 /* Print styling */

.checkboxContainer {
    padding-left: 0 !important;
    padding-right: 0 !important;
    position: relative;
    float: left;
}
/*image gallery*/
.image-checkbox {
    cursor: pointer;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    border: 4px solid transparent;
    margin-bottom: 0;
    outline: 0;
      display: none;
}
.image-checkbox input[type="checkbox"] {
    display: none;
}

.image-checkbox-checked {
    border-color: #4783B0;
     display: inline-block;
}
.image-checkbox .fa {
  position: absolute;
  color: #4A79A3;
  background-color: #fff;
  /* padding: 10px; */
  top: 0;
  right: 0;
}
.image-checkbox-checked .fa {
  display: block !important;
}

@media print {

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
  float: left;
}

.checkboxContainer{
    padding-left: 0 !important;
    padding-right: 0 !important;
    position: relative;
    float: left;
}

.col-sm-12, .col-xs-12 {
  width:100% !important;
}

.col-sm-11, .col-xs-11 {
  width:91.66666667% !important;
}

.col-sm-10, .col-xs-10 {
  width:83.33333333% !important;
}

.col-sm-9, .col-xs-9 {
  width:75% !important;
}

.col-sm-8, .col-xs-8 {
  width:66.66666667% !important;
}

.col-sm-7, .col-xs-7 {
  width:58.33333333% !important;
}

.col-sm-6, .col-xs-6 {
  width:50% !important;
}

.col-sm-5, .col-xs-5 {
  width:41.66666667% !important;
}

.col-sm-4, .col-xs-4 {
  width:33.33333333% !important;
}

.col-sm-3, .col-xs-3 {
  width:25% !important;
}

.col-sm-2, .col-xs-2 {
  width:16.66666667% !important;
}

.col-sm-1, .col-xs-1 {
  width:8.33333333% !important;
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
  font-size: 10px;
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
  display:none !important;
}
}
    </style>
</head>
<body>
 <div class="container-fluid">    
        <div class="row">
            <div class="col-lg-12">
                <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
            </div>
            <div class="col-lg-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Patient's Name :</label> {{$case_master['patient_name']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Address :</label> {{$case_master['patient_address']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Tel. No. :</label> {{$case_master['patient_mobile']}}
            </div>
        </div>
        <div class="row">
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c2.png') }}" /> 
                    {{ Form::checkbox('dentist_pain_in[]', '1', in_array('1', $dentist_pain_in->pluck('pain_in_teeth')->toArray()), array('disabled'))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c3.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '2', in_array('2', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c4.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '3', in_array('3', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c5.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '4', in_array('4', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c6.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '5', in_array('5', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c7.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '6', in_array('6', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c8.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '7', in_array('7', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c9.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '8', in_array('8', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c10.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '9', in_array('9', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c11.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '10', in_array('10', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c12.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '11', in_array('11', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c13.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '12', in_array('12', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c14.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '13', in_array('13', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c15.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '14', in_array('14', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c16.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '15', in_array('15', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c17.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '16', in_array('16', $dentist_pain_in->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c2.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '17', in_array('17', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c3.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '18', in_array('18', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c4.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '19', in_array('19', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c5.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '20', in_array('20', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c6.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '21', in_array('21', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c7.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '22', in_array('22', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c8.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '23', in_array('23', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c9.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '24', in_array('24', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c10.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '25', in_array('25', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c11.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '26', in_array('26', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c12.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '27', in_array('27', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c13.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '28', in_array('28', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c14.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '29', in_array('29', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c15.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '30', in_array('30', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c16.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '31', in_array('31', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c17.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '32', in_array('32', $dentist_pain_in->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
        </div>
                    
        <div class="form-group">
            <legend>Advised Treatment </legend>
            <div class="col-md-12">
                <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_1 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_2" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_2 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_3" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_3 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_4" class="control-label">&nbsp;</label>
                {{ $dentist->advised_treatment_4 }}
            </div>
        </div>
    
        <div class="form-group">
            {{ Form::label('is_diabetes','diabetic?') }} 
            {{ $dentist->is_diabetes }}
        </div>
        <div class="form-group">
            {{ Form::label('is_bp','BP?') }} 
            {{ $dentist->is_bp }}
        </div>
        <div class="form-group">
            {{ Form::label('is_haemophiles','Haemophile?') }} 
            {{ $dentist->is_haemophiles }}
        </div>
        <div class="form-group">
            {{ Form::label('any_other_disease','Any Other Disease?') }} 
            {{ $dentist->any_other_disease }}
        </div>

        <div class="form-group">
        <legend> Bill </legend>
        <div class="table-responsive">
            <table class="table table-bordered">
                @if( !empty($dentist_bill) && null !== $dentist_bill && count($dentist_bill) > 0 )
                <thead>
                    <tr>
                        <th>    
                            {{ Form::label('treatmentDone','Treatment Done') }} 
                        </th>
                        <th>
                            {{ Form::label('date','Date') }} 
                            
                        </th>
                        <th> 
                            {{ Form::label('amountPaid','Amount Paid') }} 
                            
                            </th>
                    </tr>
                </thead>
                @foreach($dentist_bill as $billdata) 
                        <tr>
                            <td> {{ $billdata->treatmentDone }} </td>
                            <td> {{ $billdata->date }} </td>
                            <td>{{ $billdata->amountPaid }} </td>
                        </tr>
                    @endforeach
                            <tr>
                            <td>  </td>
                            <td align="right"> 
                                <p></p>
                                <label for="totalAmount" class="control-label">Total</label>  
                            </td>
                            <td> 
                                <?php $itemsum = 0; 
                                        $itemsum = $dentist_bill->sum('amountPaid'); 
										$itemsum = floatval($itemsum);
        $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
        $billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);

										/*
                                        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                        $exp = explode('.', $itemsum);
                                        $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
										*/
										$billamountInWords = $convert_to_words->displaywords($billamount);
                                ?>
                                <p></p>
                                {{ $itemsum }}
                                <p>{{$billamountInWords}}</p> 
                            </td>
                        </tr>
                @endif
            </table>
        </div>
        </div>

   
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
            {{ $case_master['patient_name'] }}
        </div>
        <div class="col-md-6 pull-right">
            {{ config('app.name', 'Dr') }}
        </div>
    </div>

 </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $(".image-checkbox").each(function () {
                if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                    $(this).addClass('image-checkbox-checked');
                } else {
                    $(this).removeClass('image-checkbox-checked');
                }
            });
            
            setTimeout(function () { window.print();window.close(); }, 500);
            window.onfocusout = function () { setTimeout(function () { window.close(); }, 50); }
        });
    </script>

</body>
</html>