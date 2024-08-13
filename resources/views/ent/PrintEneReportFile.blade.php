<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Report file</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
    <button type="button" onclick="return window.print();" class="hidden-print"> 
        Print
    </button>
    <button type="button" onclick="return window.close();" class="hidden-print"> 
        Close
    </button>
    <img src="{{ Storage::disk('local')->url($report_image->filePath) }}" alt="Lights" style="width:100%">    
</body>
</html>

