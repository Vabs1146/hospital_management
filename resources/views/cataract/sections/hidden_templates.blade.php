<div style="display:none">
	<div id="investigationtemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="investigation[]" name="investigation[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{-- Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) --}}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	<div id="treatmentgiventemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="treatmentgiven[]" name="treatmentgiven[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                  {{ Form::select('treatmentgiven_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'treatmentgiven')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('treatmentgiven_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'treatmentgiven')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	<div id="reasonofadmissiontemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="reasonofadmission[]" name="reasonofadmission[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                  {{ Form::select('reasonofadmission_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('reasonofadmission_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	<div id="systemicdiseasestemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="systemicdiseases[]" name="systemicdiseases[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                  {{ Form::select('systemicdiseases_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'systemicdiseases')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{-- Form::select('reasonofadmission_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'reasonofadmission')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) --}}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	<div id="otherDetailsDiagnosisTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsDiagnosis[]" name="otherDetailsDiagnosis[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsDiagnosis_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('otherDetailsDiagnosis_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsDiagnosis')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	<div id="otherDetailsAnteriorSegmentTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsAnteriorSegment[]" name="otherDetailsAnteriorSegment[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsAnteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsAnteriorSegment', $defaultValues)?$defaultValues['otherDetailsAnteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('otherDetailsAnteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAnteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsAnteriorSegment', $defaultValues)?$defaultValues['otherDetailsAnteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>

	<div id="otherDetailsPosteriorSegmentTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsPosteriorSegment[]" name="otherDetailsPosteriorSegment[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                     {{ Form::select('otherDetailsPosteriorSegment_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsPosteriorSegment', $defaultValues)?$defaultValues['otherDetailsPosteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{ Form::select('otherDetailsPosteriorSegment_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsPosteriorSegment')->pluck('ddText','ddText')->toArray(), array_key_exists('otherDetailsPosteriorSegment', $defaultValues)?$defaultValues['otherDetailsPosteriorSegment']:null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>

	<div id="otherDetailsAdviceTemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="otherDetailsAdviceCount[]" name="otherDetailsAdviceCount[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
					 {{ Form::select('otherDetailsAdvice_OD[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdvice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
				<div class="col-md-3">
				  {{ Form::select('otherDetailsAdvice_OS[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'otherDetailsAdvice')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
				</div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>


	<!-- ================================================================================================================= -->

	
	<div id="surgerydetailstemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="surgerydetails[]" name="surgerydetails[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                  {{Form::select('surgerydetails_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgerydetails')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{Form::select('surgerydetails_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgerydetails')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	
	<!-- ================================================================================================================= -->

	
	<div id="surgeryvisiontemplate">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="surgeryvision[]" name="surgeryvision[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                  {{Form::select('surgeryvision_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{Form::select('surgeryvision_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
	
	<!-- ================================================================================================================= -->

	
	<div id="discharge_iol_name_template">
        <div class="col-md-12">
                <div class="col-md-2">
                    <input type="hidden" id="surgeryvision[]" name="surgeryvision[]" class="hiddenCounter" value="" />
                </div>
                <div class="col-md-3">
                  {{Form::select('discharge_iol_name_od[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'discharge_iol_name')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) }}
                </div>
                <div class="col-md-3">
                  {{-- Form::select('surgeryvision_os[]', array(' '=>'-Select-') + $form_dropdowns->where('fieldName', 'surgeryvision')->pluck('ddText','ddText')->toArray(), null, array('class'=> 'form-control Dyselect2')) --}}
                </div>
                <div class="col-md-2">
                    <button class="removeItem btn btn-default" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Remove</button>
                </div>
        </div>
    </div>
</div>