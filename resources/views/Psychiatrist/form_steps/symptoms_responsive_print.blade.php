	@php 
		$symptoms_arr = isset($psychiatrist->question_4) ? explode('--***--',  $psychiatrist->question_4) : '';
		$is_checked = in_array('Heart-Palpitations', $symptoms_arr) ? 'checked' : '';
	@endphp	

<tr>
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Heart-Palpitations" style="
position: initial; opacity: 1;" {{$is_checked}}> Heart-Palpitations &nbsp;&nbsp; छातीत धडधडणे
	</td>
	
	@php 
		
		$is_checked = in_array('Trembling of hands & legs', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Trembling of hands & legs" style="
position: initial; opacity: 1;" {{$is_checked}}> Trembling of hands & legs &nbsp;&nbsp; हातापायांची थरथर
	</td>
</tr>

	@php 
		
		$is_checked = in_array('Feeling doubtful about particular person/s', $symptoms_arr) ? 'checked' : '';
	@endphp	
<tr>
	<td colspan="10">
		<input type="checkbox" name="symptoms[]" value="Feeling doubtful about particular person/s" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling doubtful about particular person/s. &nbsp;&nbsp; एकाद्या विशिष्ट व्यक्ती किंवा व्यक्तींबद्दल संशय वाटणे
	</td>
</tr>
			
	
<tr>
	@php 
		
		$is_checked = in_array('Headache, backache', $symptoms_arr) ? 'checked' : '';
	@endphp	
<td colspan="5">
<input  type="checkbox" name="symptoms[]" value="Headache, backache" style="position: initial; opacity: 1;" {{$is_checked}}> 
Headache, backache &nbsp;&nbsp; डोकेदुखी, पाठदुखी
</td>
	@php 
		
		$is_checked = in_array('Talking, muttering, laughing to self', $symptoms_arr) ? 'checked' : '';
	@endphp	
<td colspan="5">
<input  type="checkbox" name="symptoms[]" value="Talking, muttering, laughing to self" style="position: initial; opacity: 1;" {{$is_checked}}> Talking, muttering, laughing to self.
</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Frequent Dioherrea', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Frequent Dioherrea" style="position: initial; opacity: 1;" {{$is_checked}}> Frequent Dioherrea &nbsp;&nbsp; वारंवार पोट बिघडणे
				</td>
	@php 
		
		$is_checked = in_array('Continuous talking / incoherent talk', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Continuous talking / incoherent talk" style="position: initial; opacity: 1;" {{$is_checked}}> Continuous talking / incoherent talk
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Lack of appetite', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Lack of appetite" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of appetite &nbsp;&nbsp; खायची इच्छा कमी होणे
				</td>
	@php 
		
		$is_checked = in_array('Laughing without reason', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Laughing without reason" style="position: initial; opacity: 1;" {{$is_checked}}> Laughing without reason
	</td>
</tr>	

<tr>
	@php 
		
		$is_checked = in_array('Acidity/Indigestion', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Acidity/Indigestion" style="position: initial; opacity: 1;" {{$is_checked}}> Acidity/Indigestion
				</td>
	@php 
		
		$is_checked = in_array('Constipation', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Constipation" style="position: initial; opacity: 1;" {{$is_checked}}> Constipation
	</td>
</tr>	

<tr>
	@php 
		
		$is_checked = in_array('Sleep disturbance, specify', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Sleep disturbance, specify" style="position: initial; opacity: 1;" {{$is_checked}}> Sleep disturbance, specify 
				</td>
	@php 
		
		$is_checked = in_array('Forgetfulness', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Forgetfulness" style="position: initial; opacity: 1;" {{$is_checked}}> Forgetfulness
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Sometimes/often talking irrelevantly', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Sometimes/often talking irrelevantly" style="position: initial; opacity: 1;" {{$is_checked}}> Sometimes/often talking irrelevantly
	</td>
</tr>	

<tr>
	@php 
		
		$is_checked = in_array('Lack of proper refreshing sleep', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Lack of proper refreshing sleep" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of proper refreshing sleep
				</td>
	@php 
		
		$is_checked = in_array('Lowered speed of work', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Lowered speed of work" style="position: initial; opacity: 1;" {{$is_checked}}> Lowered speed of work
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Continuously walking like a pendulum/pacing continuously', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Continuously walking like a pendulum/pacing continuously" style="position: initial; opacity: 1;" {{$is_checked}}> Continuously walking like a pendulum/pacing continuously
	</td>
</tr>	
	
<tr>
	@php 
		
		$is_checked = in_array('Feeling fearful / fearful at particular places', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Feeling fearful / fearful at particular places" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling fearful / fearful at particular places
	</td>
</tr>	

<tr>
	@php 
		
		$is_checked = in_array('Verbally abusive', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Verbally abusive" style="position: initial; opacity: 1;" {{$is_checked}}> Verbally abusive
				</td>
	@php 
		
		$is_checked = in_array('Feeling anxious', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Feeling anxious" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling anxious
	</td>
</tr>
	
<tr>
	@php 
		
		$is_checked = in_array('Throwing things/Physical attack on others', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Throwing things/Physical attack on others" style="position: initial; opacity: 1;" {{$is_checked}}> Throwing things/Physical attack on others
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Lack of concentration in work, education', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Lack of concentration in work, education" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of concentration in work, education
	</td>
</tr>	

<tr>
	@php 
		
		$is_checked = in_array('Not taking bath, brushing teeth', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Not taking bath, brushing teeth" style="position: initial; opacity: 1;" {{$is_checked}}> Not taking bath, brushing teeth
				</td>
	@php 
		
		$is_checked = in_array('Feeling restless and nervous', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Feeling restless and nervous" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling restless and nervous
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Lack of proper care of hygiene', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Lack of proper care of hygiene" style="position: initial; opacity: 1;" {{$is_checked}}> Lack of proper care of hygiene
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Feeling depresse & lonely', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Feeling depresse & lonely" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling depresse & lonely
				</td>
	@php 
		
		$is_checked = in_array('Addiction, Specify', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Addiction, Specify" style="position: initial; opacity: 1;" {{$is_checked}}> Addiction, Specify
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Thoughts about ending one’s life', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Thoughts about ending one’s life" style="position: initial; opacity: 1;" {{$is_checked}}> Thoughts about ending one’s life
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Repetitive behavior specify (for ex. washing hands, cleaning)', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Repetitive behavior specify (for ex. washing hands, cleaning)" style="position: initial; opacity: 1;" {{$is_checked}}> Repetitive behavior specify (for ex. washing hands, cleaning)
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Getting crying spell due to uncontrolled emotion/s', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Getting crying spell due to uncontrolled emotion/s" style="position: initial; opacity: 1;" {{$is_checked}}> Getting crying spell due to uncontrolled emotion/s
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Checking', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Checking" style="position: initial; opacity: 1;" {{$is_checked}}> Checking
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Talking less', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Talking less" style="position: initial; opacity: 1;" {{$is_checked}}> Talking less
				</td>
	@php 
		
		$is_checked = in_array('Avoiding to go to work/school', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Avoiding to go to work/school" style="position: initial; opacity: 1;" {{$is_checked}}> Avoiding to go to work/school
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Spending spree, shopping, excessive socialization (in episodes)', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Spending spree, shopping, excessive socialization (in episodes)" style="position: initial; opacity: 1;" {{$is_checked}}> Spending spree, shopping, excessive socialization (in episodes)
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Getting angry/developing quarrelsome nature aggressive', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Getting angry/developing quarrelsome nature aggressive" style="position: initial; opacity: 1;" {{$is_checked}}> Getting angry/developing quarrelsome nature aggressive
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Hearing of spoken words/sounds/voices in ears', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Hearing of spoken words/sounds/voices in ears" style="position: initial; opacity: 1;" {{$is_checked}}> Hearing of spoken words/sounds/voices in ears
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Theft, criminal record and antisocial behavior', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Theft, criminal record and antisocial behavior" style="position: initial; opacity: 1;" {{$is_checked}}> Theft, criminal record and antisocial behavior
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Feeling as if people are watching him/her', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input type="checkbox" name="symptoms[]" value="Feeling as if people are watching him/her" style="position: initial; opacity: 1;" {{$is_checked}}> Feeling as if people are watching him/her
	</td>
</tr>

<tr>
	@php 
		
		$is_checked = in_array('Mood swings', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Mood swings" style="position: initial; opacity: 1;" {{$is_checked}}> Mood swings
				</td>
	@php 
		
		$is_checked = in_array('Sex Related', $symptoms_arr) ? 'checked' : '';
	@endphp	
	<td colspan="5">
		<input  type="checkbox" name="symptoms[]" value="Sex Related" style="position: initial; opacity: 1;" {{$is_checked}}> Sex Related
	</td>
</tr>








