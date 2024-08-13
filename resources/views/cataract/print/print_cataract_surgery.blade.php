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

[class*="col-sm-"] {
  float: left;
}

[class*="col-xs-"] {
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
  font-size: 13px;
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
ul { display: inline-flex;
    list-style: none; }
ul li { padding: 10px; }
}

.table {
   margin-bottom: 0px;
}


.custom-text-input {
	width: 400px;
    border: none;
    border-bottom: 1px solid;
}

.labelgrp {
    border: none;
}

    </style>
</head>
<body>
 <div class="container-fluid">    
    
    <div class="row">
        <div class="col-lg-12">
            <img src={{ Storage::disk('local')->url($logoUrl) }} class="img-rounded" alt="letter head top" width="100%" height="100%" />
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
           <h3> <u>Cataract Surgery Form</u> </h3>
        </div>
    </div>
	
   <!-- ================================================================================= -->  
<div class="row">
<div class="col-md-12">
		<div class="col-md-3">
			<div class="form-group labelgrp">
			{{ Form::label('patient_name','Name Of Patient : ') }}
			</div>
		</div>


		<div class="col-md-4">
			<div class="form-group">
			<div class="form-line">
			<input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_name'] or ''}}">
			</div>  
			</div>
		</div>

		<div class="col-md-1">
			<div class="form-group labelgrp">
			{{ Form::label('name_of_age','Age :') }}
			</div>
		</div>


		<div class="col-md-1">
			<div class="form-group">
			<div class="form-line">
			<input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_age'] or ''}}">
			</div>
			</div>
		</div>

		<div class="col-md-1">
			<div class="form-group labelgrp">
			{{ Form::label('male_female','Sex :') }}
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group" style="padding-top: 6px">
			<input class="custom-text-input" type="text" name="" value="{{ $case_master['male_female'] or ''}}">			</div>
		</div>   


	</div>
	<div class="col-md-12">
		<div class="col-md-2">
			
			<div class="form-group labelgrp">
			{{ Form::label('case_number','OPD Case Number :') }}
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
			<div class="form-line">
			<input class="custom-text-input" type="text" name="" value="{{ $case_master['case_number'] or ''}}">
			</div>
			</div>
		</div> 

		<div class="col-md-2">
			<div class="form-group labelgrp">
			{{ Form::label('uhid_no','UHID No. :') }}
			</div>
		</div>


		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
				<input class="custom-text-input" type="text" name="" value="{{ $case_master['uhid_no'] or ''}}">
				</div>  
			</div>
		</div>

		<div class="col-md-2">
			
			<div class="form-group labelgrp">
			{{ Form::label('IPD_no','IPD No.  :') }}
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<div class="form-line">
				<input class="custom-text-input" type="text" name="" value="{{ $case_master['IPD_no'] or ''}}">
				</div>
			</div>
		</div> 

		
	</div>
	
	<div class="col-md-12">
		<div class="col-md-2">
			<div class="form-group labelgrp">
			{{ Form::label('patient_address','Address') }}
			</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<div class="form-line">
		<input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_address'] or ''}}">
		</div>
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_mobile','Contact No.') }}
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		<input class="custom-text-input" type="text" name="" value="{{ $case_master['patient_mobile'] or ''}}">
		</div>
		</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('son_daughter_of','Son / Daughter of') }}
		</div>
		</div>

		<div class="col-md-6">
		<div class="form-group">
		<div class="form-line">
		
		<input class="custom-text-input" type="text" name="" value="{{ $case_master['son_daughter_of'] or ''}}">
		</div>
		</div>
		</div>
<!--
		<div class="col-md-2">
		<div class="form-group labelgrp">
		{{ Form::label('patient_mobile','Contact No.') }}
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-group">
		<div class="form-line">
		{{ Form::text('patient_mobile', Request::old('patient_mobile',$case_master->patient_mobile), array('class' => 'form-control')) }}
		</div>
		</div>
		</div>
		-->
	</div>


<div class="col-md-12" >
<b>Introduction :</b>
<p>A cataract is opacity of the lens. Cataract operation is indicated only when you cannot function adequately due to poor sight produced by the cataract. Maturity  of Cataract is no longer a criterion for surgery. The natural lens within your eye with a slight cataract, although not perfect, has distinct advantages over an artificial lens </p>
<p>In giving permission for cataract extraction with/without implantation of an intraocular lens in my eye, I declare that I understand the following information :</p>
<ol>
<li>Alternative Treatments :</li>
<p>There are three methods of restoring vision after cataract surgery</p>
<p>a)&nbsp;Cataract Spectacles b)&nbsp;Contact Lens C)&nbsp;intraocular Lens</p>
<p>Cataract Spectacles Increase image Size by 30%.  They cannot be used if there is cataract in only one eye(the other is normal)because they may cause double vision. A contact lens increases image size by 8% However, it is difficult to handle and may not be tolerated by everyone. Intraocular lens does not increase Image size. It is surgically placed inside the permanently</p>
<li>An intraocular lens is implanted by surgery (not by laser).  The implanted lens will be left in the eye permanently. At the time of surgery the doctor may decide not to implant an intraocular lens in the eye, if for any reason he feels that the lens implantation is not indicated or may prove deleterious to the well being of the eye, even though permission may have been given to do so</li>

<li>Though the intraocular implant power is calculated by utilizing a computerized Biometer    ( A-Scan),  a small correction in the spectacles is to be considered inevitable postoperatively and      this may be more in specific cases. An astigmatism (number with axis) Which may reduce with time, is to be taken as inevitable and normal. Therefore, a small power is to be expected in the spectacles for distance and near for clear vision after the operation. In any case, the aim of cataract surgery is to remove the cloudy lens from the eye and replace it with a plastic lens and not to rid the patient of his spectacles.</li>

<li>The caliber of vision obtained after a successful cataract surgery/lens Implantation depends upon the retina behind. In an advanced cataract even with the most sophisticated instruments (Ultrasound Scan etc), it is not possible to be certain that the retina inside is normal. If the retina is normal, you will see well, bit it is not possible in a majority of advanced cataract cases to ascertain the visual status of the retina before operation</li>

<li>With modern instrumentation and micro surgical techniques, the rate of complication in cataract surgery With/Without intraocular lens implantation is very low. Complications can usually be managed by medical and/or surgical treatment. The changes of total loss of vision are less than 0.5%.However, the following complications can occur and are mentioned in standard text books of cataract and lens implantation surgery</li>
<p> </p>
<p>A)	It is possible that vision may drop after surgery due to thickening/Opacification of the posterior capsule. This  is not a complication but a sequeale to Extra Capsular Extraction. The condition is treated with the "yag Laser"</p>
<p>B)	Complications may include hemorrhages (bleeding), posterior capsule rupture, nucleus drop, vitreous loss, wound leakage, uveitis, corneal! Decompensation, glaucoma, cystoid macular oedem or retinal detachment. In addition lens implantation may be complicated by
Severe reaction to the lens (Toxic Lens Syndrome) or dislocation of the lens. The implanted lens may have to be repositioned or removed surgically if it is likely to damage the eye. Though every effort is made to minimize the chances of infection, it cannot be eliminated altogether. Loss of vision is a risk common to any intraocular surgery</p>
<p>C)   Although you may have opted for phacoemulsification surgery and the same may have  been        planned by your surgeon after pre operative examination, if during surgery Phacoemulsification is found to be unsafe or not feasible. Your surgeon will have the liberty to perform surgery by the conventional  technique in the interest of paiient safety
<p>D)	Complication Of Surgery in general :-  As the procedure is generally done under local anaesthesia  the risk to life is less than 0.5%. Risk is greater in patients with Diabeetes, Hypertension,  Cardiac ailments and other systemic disorder & when surgery is performed under general anaesthesia. There is a possibility of drug reaction, brain damage or risk to life.</p>
<p>Since it is impossible to state every complication that may occur as a result of surgery, the list of complication in this form is not exhaustive.</p>
</ol>
<h5>Consent operation for operation</h5>
<ol>
<li>I hearby authorize Dr. <input class="custom-text-input" type="text" name="" value=""> and those whom he may designate as associates or assistants to perform cataract operation with an intraocular lens/ without an intraocular lens/as a secondary procedure on my left/right eye. It has been explained to me that during the course of operation procedure, unforeseen conditions may be revealed or encountered  which necessitate surgical or other procedures in addition to or different from those contemplated. I, therefore  further request and authorize the above named physician/ surgeon or his designates to perform such additional surgical or other procedures as he or they deem necessary or desirable</li>
<li>The nature and purpose of the operation, the necessity thereof, the possible alternative methods of treatment of my condition have been fully explained to me, iin my vernacular language, and I understand the same</li>
<li>I am fully aware that the surgery is being performed in good faith and that no guarantee or assurance has been given as to the result that may be obtained</li>
<li>I consent to the administration of anesthesia and to the use of such anesthetics as may be deemed necessary or desirable</li>
<li>I further  consent to the administration of such drugs or infusions deemed necessary in the judgement of the medical staff</li>
<li>I consent to the observing, photographing or televising of the procedure to be performed for medical, scientific or education purpose provided my identity is not revealed by the pictures or by descriptive text accompanying them</li>
<li>Any tissues or parts surgically removed may be disposed off by the institution in accordance with customary practice</li>
</ol>
 <h5>Informed consent for operation on patients with guarded/poor visual prognosis</h5>               
<p>I have been explained by the attending surgeon/Designated Assistant prior to the operation that visual Prognosis after surgery is guarded/ uncertain/poor/very poor. The reasons for this have been explained to me.The reasons are: (to be signed by the patient/person authorized to consent for the patient.)</p>
<p>Trauma/Diabetic Retinopathy/Myopia/Glaucoma/Uvetis/Age Related Macular Degeneration/PVR/ Complex  Traction Retinal Detachment/Combined tractional rhegmatogenous retinal detachment I dislocated lens or IOL/ Endophthalmitis/Phacodonesis/Non Dilating Pupil (severe eye infection)</p>

<p>Signature of patient/person authorized to consent for patients:<input class="custom-text-input" type="text" name="" value="">.</p>
<p>I THE UNDERSIGNED (THE PATIENT OR NEAREST RELATIVE) HEREBY GIVE MY CONSENT FOR THE OPERATION OF LEFT EYE / RIGHT EYE WITH THE FULL KNOWLEDGE OF POSSIBLE COMPLICATIONS ABD GUARDED/ POOR VISUAL PROGNOSIS. ICERTIFY THAT I HAVE READ THIS INFORMED CONSENT/ IT HAS BEEN READ OVER TO ME AND EXPLAINED TO ME IN MY VERNACULAR LANGUAGE.</p>
<p>Signature/Thumb impression of patient/parent/guardian </p>
</div>



<div class="col-md-12" >
<br><br>
	<div class="col-md-6">Name : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-6">Relationship : <input class="custom-text-input" type="text" name="" value="">
	</div>

</div>

<div class="col-md-12" >
<br><br>
	<div class="col-md-12">Address : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>

</div>

<div class="col-md-12" >
<br><br>
	<div class="col-md-4">Phone(off) : 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4">(Res) : <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4">(Mob) : <input class="custom-text-input" type="text" name="" value="">
	</div>

</div>

<div class="col-md-12" >
<br><br>
<h5>Declaration by  Doctor</h5>                                                                           
<p>I declare that I have explained the nature and consequences of the procedure to be performed, and discussed the risks that particularly concern the patient.</p><br>
<p>I have given the patient an opportunity to ask questions and I have answered these.</p>
</div>


<div class="col-md-12" >
<br><br>
	<div class="col-md-4"><p>Doctor’s signature : </p> 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4"><p>Doctor’s name :</p>  <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-4"><p>Date :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
</div>


<div class="col-md-6" >
<br><br>
	<div class="col-md-12"><b>Witness 1</b></div>
	<div class="col-md-12">
<br><p>Signature : </p> 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12">
<br><p>Name :</p>  <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12">
<br><p>Address :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12">
<br><p>Tel :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
</div>

<div class="col-md-6" >
<br><br>
	<div class="col-md-12"><b>Witness 2</b></div>
	<div class="col-md-12">
<br><p>Signature : </p> 
		<input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12">
<br><p>Name :</p>  <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12">
<br><p>Address :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
	<div class="col-md-12">
<br><p>Tel :</p> <input class="custom-text-input" type="text" name="" value="">
	</div>
</div>
</div>
	<!-- =============================================================================================================================== -->

    <br/>
 
<!--
        <div class="col-lg-10">
            <label class="control-label"><center>
            In case of redness, pain in eyes, swelling, watering in eyes, please contact3,4, 1: emergency number : 8512043333</center>
            </label>
        </div>    

    <br/>

    <div class="col-sm-12" style="margin-top: 20px;">
        <label class="control-label">IOL Sticker</label>
        <div style="height:80px;"></div>
    </div>
    <div class="col-md-12" style="float: none; margin: 0 auto;">
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
    </div> -->



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