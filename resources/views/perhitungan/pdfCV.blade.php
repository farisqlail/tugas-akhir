<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pelamar->cv }}</title>
</head>
<body>
    
    <div class="pdf" style="margin: -10px; " align="center">
        <embed src="{{asset('storage/file/cv/'.$pelamar->cv)}}" type="application/pdf" height="760px" width="100%">
    </div>

</body>
</html>