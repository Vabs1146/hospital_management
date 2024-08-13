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


    </style>
</head>
<body> <div class="container-fluid">    
        <div class="row">
            <div class="col-lg-12">
                <img src={{ Storage::disk('local')->url($data['logoUrl']) }} class="img-rounded" alt="letter head top" width="100%" height="150" />
            </div>
            <div class="col-lg-12">&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Patient's Name :</label> {{$data['case_master']['patient_name']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Address :</label> {{$data['case_master']['patient_address']}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <label class="control-label">Tel. No. :</label> {{$data['case_master']['patient_mobile']}}
            </div>
        </div>
        <div class="row">
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c2.png') }}" /> 
                    {{ Form::checkbox('dentist_pain_in[]', '1', in_array('1',   $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()), array('disabled'))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c3.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '2', in_array('2', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c4.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '3', in_array('3', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c5.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '4', in_array('4', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c6.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '5', in_array('5', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c7.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '6', in_array('6', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c8.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '7', in_array('7', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c9.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '8', in_array('8', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c10.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '9', in_array('9', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c11.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '10', in_array('10', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c12.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '11', in_array('11', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c13.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '12', in_array('12', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c14.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '13', in_array('13', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c15.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '14', in_array('14', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c16.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '15', in_array('15', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
                    }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r2_c17.png') }}" /> {{ Form::checkbox('dentist_pain_in[]', '16', in_array('16', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray()))
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
                    {{ Form::checkbox('dentist_pain_in[]', '17', in_array('17', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c3.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '18', in_array('18', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c4.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '19', in_array('19', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c5.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '20', in_array('20', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c6.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '21', in_array('21', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c7.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '22', in_array('22', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c8.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '23', in_array('23', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c9.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '24', in_array('24', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c10.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '25', in_array('25', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c11.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '26', in_array('26', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c12.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '27', in_array('27', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c13.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '28', in_array('28', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c14.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '29', in_array('29', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c15.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '30', in_array('30', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c16.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '31', in_array('31', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
            <div class="checkboxContainer text-center">
                <label class="image-checkbox">
                    <img class="img-responsive" src="{{ Storage::disk('local')->url('uploads/dentist/dental map_r4_c17.png') }}"
                    />
                    {{ Form::checkbox('dentist_pain_in[]', '32', in_array('32', $data['dentist_pain_in']->pluck('pain_in_teeth')->toArray())) }}
                    <i class="fa fa-check hidden"></i>
                </label>
            </div>
        </div>
                    
        <div class="form-group">
            <legend>Advised Treatment dentist </legend>
            <div class="col-md-12">
                <label for="advised_treatment_1" class="control-label">&nbsp;</label>
                {{ $data['dentist']->advised_treatment_1 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_2" class="control-label">&nbsp;</label>
                {{ $data['dentist']->advised_treatment_2 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_3" class="control-label">&nbsp;</label>
                {{ $data['dentist']->advised_treatment_3 }}
            </div>
            <div class="col-md-12">
                <label for="advised_treatment_4" class="control-label">&nbsp;</label>
                {{ $data['dentist']->advised_treatment_4 }}
            </div>
        </div>
    
        <div class="form-group">
            {{ Form::label('is_diabetes','diabetic?') }} 
            {{ $data['dentist']->is_diabetes }}
        </div>
        <div class="form-group">
            {{ Form::label('is_bp','BP?') }} 
            {{ $data['dentist']->is_bp }}
        </div>
        <div class="form-group">
            {{ Form::label('is_haemophiles','Haemophile?') }} 
            {{ $data['dentist']->is_haemophiles }}
        </div>
        <div class="form-group">
            {{ Form::label('any_other_disease','Any Other Disease?') }} 
            {{ $data['dentist']->any_other_disease }}
        </div>

        <div class="form-group">
        <legend> Bill </legend>
        <div class="table-responsive">
            <table class="table table-bordered">
                @if( !empty($data['dentist_bill']) && null !== $data['dentist_bill'] && count($data['dentist_bill']) > 0 )
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
                @foreach($data['dentist_bill'] as $billdata) 
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
                                        $itemsum = $billdata->sum('amountPaid'); 

										$itemsum = floatval($itemsum);
        $billamount = (isset($itemsum) && $itemsum > 0) ? floatval($itemsum) : 0;
        $billamount = number_format((float)$billamount, 2, '.', '');
		$billamountInWords = $convert_to_words->displaywords($billamount);

										/*
                                        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
                                        $exp = explode('.', $itemsum);
                                        $billamountInWords = ucfirst($f->format($exp[0])) . ((sizeof($exp)>1)? (' and ' . ucfirst($f->format($exp[1]))) : '') . ' only.';
										*/

										//$billamountInWords = $convert_to_words->displaywords($billamount);
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
            {{ $data['case_master']['patient_name'] }}
        </div>
        <div class="col-md-6 pull-right">
            {{ config('app.name', 'Dr') }}
        </div>
    </div>

 </div>
    <a href="{{ route('generate-html-to-pdf',['download'=>'pdf']) }}">Download PDF</a>
    <!-- jQuery -->
  <script src="{{ asset('js/jquery.min.js')}} "></script>
        <!-- Bootstrap -->

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