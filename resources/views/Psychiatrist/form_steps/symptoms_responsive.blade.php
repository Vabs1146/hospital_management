	@php 
		$symptoms_arr = isset($psychiatrist->question_4) ? explode('--***--',  $psychiatrist->question_4) : '';
		$is_checked = in_array('Heart-Palpitations', $symptoms_arr) ? 'checked' : '';
	@endphp	

<div class="col-md-12">
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Heart-Palpitations" style="
position: initial; opacity: 1;" {{$is_checked}}> Heart-Palpitations &nbsp;&nbsp; छातीत धडधडणे
	</div>
	
	@php 
		
		$is_checked = in_array('Trembling of hands & legs', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Trembling of hands & legs" style="
position: initial; opacity: 1;" {{$is_checked}}> Trembling of hands & legs &nbsp;&nbsp; हातापायांची थरथर
	</div>
</div>

	@php 
		
		$is_checked = in_array('Feeling doubtful about particular person/s', $symptoms_arr) ? 'checked' : '';
	@endphp	
<div class="col-md-12">
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Feeling doubtful about particular person/s" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling doubtful about particular person/s. &nbsp;&nbsp; एकाद्या विशिष्ट व्यक्ती किंवा व्यक्तींबद्दल संशय वाटणे
	</div>
</div>
			
	
<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Headache, backache', $symptoms_arr) ? 'checked' : '';
	@endphp	
<div class="col-md-6">
<input  type="checkbox" name="symptoms[]" value="Headache, backache" style="position: initial; opacity: 1;" {{$is_checked}}> 
Headache, backache &nbsp;&nbsp; डोकेदुखी, पाठदुखी
</div>
	@php 
		
		$is_checked = in_array('Talking, muttering, laughing to self', $symptoms_arr) ? 'checked' : '';
	@endphp	
<div class="col-md-6">
<input  type="checkbox" name="symptoms[]" value="Talking, muttering, laughing to self" style="position: initial; opacity: 1;" {{$is_checked}}> Talking, muttering, laughing to self.
</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Frequent Dioherrea', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Frequent Dioherrea" style="position: initial; opacity: 1;" {{$is_checked}}> Frequent Dioherrea &nbsp;&nbsp; वारंवार पोट बिघडणे
				</div>
	@php 
		
		$is_checked = in_array('Continuous talking / incoherent talk', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Continuous talking / incoherent talk" style="position: initial; opacity: 1;" {{$is_checked}}> Continuous talking / incoherent talk
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Lack of appetite', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Lack of appetite" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of appetite &nbsp;&nbsp; खायची इच्छा कमी होणे
				</div>
	@php 
		
		$is_checked = in_array('Laughing without reason', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Laughing without reason" style="position: initial; opacity: 1;" {{$is_checked}}> Laughing without reason
	</div>
</div>	

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Acidity/Indigestion', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Acidity/Indigestion" style="position: initial; opacity: 1;" {{$is_checked}}> Acidity/Indigestion
				</div>
	@php 
		
		$is_checked = in_array('Constipation', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Constipation" style="position: initial; opacity: 1;" {{$is_checked}}> Constipation
	</div>
</div>	

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Sleep disturbance, specify', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Sleep disturbance, specify" style="position: initial; opacity: 1;" {{$is_checked}}> Sleep disturbance, specify 
				</div>
	@php 
		
		$is_checked = in_array('Forgetfulness', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Forgetfulness" style="position: initial; opacity: 1;" {{$is_checked}}> Forgetfulness
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Sometimes/often talking irrelevantly', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Sometimes/often talking irrelevantly" style="position: initial; opacity: 1;" {{$is_checked}}> Sometimes/often talking irrelevantly
	</div>
</div>	

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Lack of proper refreshing sleep', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Lack of proper refreshing sleep" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of proper refreshing sleep
				</div>
	@php 
		
		$is_checked = in_array('Lowered speed of work', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Lowered speed of work" style="position: initial; opacity: 1;" {{$is_checked}}> Lowered speed of work
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Continuously walking like a pendulum/pacing continuously', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Continuously walking like a pendulum/pacing continuously" style="position: initial; opacity: 1;" {{$is_checked}}> Continuously walking like a pendulum/pacing continuously
	</div>
</div>	
	
<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Feeling fearful / fearful at particular places', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Feeling fearful / fearful at particular places" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling fearful / fearful at particular places
	</div>
</div>	

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Verbally abusive', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Verbally abusive" style="position: initial; opacity: 1;" {{$is_checked}}> Verbally abusive
				</div>
	@php 
		
		$is_checked = in_array('Feeling anxious', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Feeling anxious" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling anxious
	</div>
</div>
	
<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Throwing things/Physical attack on others', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Throwing things/Physical attack on others" style="position: initial; opacity: 1;" {{$is_checked}}> Throwing things/Physical attack on others
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Lack of concentration in work, education', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Lack of concentration in work, education" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of concentration in work, education
	</div>
</div>	

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Not taking bath, brushing teeth', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Not taking bath, brushing teeth" style="position: initial; opacity: 1;" {{$is_checked}}> Not taking bath, brushing teeth
				</div>
	@php 
		
		$is_checked = in_array('Feeling restless and nervous', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Feeling restless and nervous" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling restless and nervous
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Lack of proper care of hygiene', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Lack of proper care of hygiene" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of proper care of hygiene
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Feeling depresse & lonely', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Feeling depresse & lonely" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling depresse & lonely
				</div>
	@php 
		
		$is_checked = in_array('Addiction, Specify', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Addiction, Specify" style="position: initial; opacity: 1;" {{$is_checked}}> Addiction, Specify
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Thoughts about ending one’s life', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Thoughts about ending one’s life" style="position: initial; opacity: 1;" {{$is_checked}}> Thoughts about ending one’s life
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Repetitive behavior specify (for ex. washing hands, cleaning)', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Repetitive behavior specify (for ex. washing hands, cleaning)" style="position: initial; opacity: 1;" {{$is_checked}}> Repetitive behavior specify (for ex. washing hands, cleaning)
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Getting crying spell due to uncontrolled emotion/s', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Getting crying spell due to uncontrolled emotion/s" style="position: initial; opacity: 1;" {{$is_checked}}> Getting crying spell due to uncontrolled emotion/s
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Checking', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Checking" style="position: initial; opacity: 1;" {{$is_checked}}> Checking
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Talking less', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Talking less" style="position: initial; opacity: 1;" {{$is_checked}}> Talking less
				</div>
	@php 
		
		$is_checked = in_array('Avoiding to go to work/school', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Avoiding to go to work/school" style="position: initial; opacity: 1;" {{$is_checked}}> Avoiding to go to work/school
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Spending spree, shopping, excessive socialization (in episodes)', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Spending spree, shopping, excessive socialization (in episodes)" style="position: initial; opacity: 1;" {{$is_checked}}> Spending spree, shopping, excessive socialization (in episodes)
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Getting angry/developing quarrelsome nature aggressive', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Getting angry/developing quarrelsome nature aggressive" style="position: initial; opacity: 1;" {{$is_checked}}> Getting angry/developing quarrelsome nature aggressive
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Hearing of spoken words/sounds/voices in ears', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Hearing of spoken words/sounds/voices in ears" style="position: initial; opacity: 1;" {{$is_checked}}> Hearing of spoken words/sounds/voices in ears
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Theft, criminal record and antisocial behavior', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Theft, criminal record and antisocial behavior" style="position: initial; opacity: 1;" {{$is_checked}}> Theft, criminal record and antisocial behavior
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Feeling as if people are watching him/her', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input type="checkbox" name="symptoms[]" value="Feeling as if people are watching him/her" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling as if people are watching him/her
	</div>
</div>

<div class="col-md-12">
	@php 
		
		$is_checked = in_array('Mood swings', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Mood swings" style="position: initial; opacity: 1;" {{$is_checked}}> Mood swings
				</div>
	@php 
		
		$is_checked = in_array('Sex Related', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<div class="col-md-6">
		<input  type="checkbox" name="symptoms[]" value="Sex Related" style="position: initial; opacity: 1;" {{$is_checked}}> Sex Related
	</div>
</div>








