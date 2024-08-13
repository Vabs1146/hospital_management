@php

$filename = $reportFile->file_path;
$file = url('/').Storage::disk('local')->url($reportFile->file_path);

 /* 
// Header content type
header('Content-type: application/pdf');
  
header('Content-Disposition: inline; filename="' . $filename . '"');
  
header('Content-Transfer-Encoding: binary');
  
header('Accept-Ranges: bytes');
  
// Read the file
@readfile($file);
*/

@endphp

<embed type='application/pdf' src="{{$file}}"  width="500" height="200">

{{-- <iframe src="http://docs.google.com/gview?url={{$file}}&amp;embedded=true"></iframe> -->

<!-- <iframe src='https://docs.google.com/viewer?url={{$file}}&embedded=true' frameborder='0'></iframe> -->

--}}


