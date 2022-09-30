<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pelamar->pas_foto }}</title>
</head>
<body>
    
    <div class="pdf" style="margin: -10px; " align="center">
        <img src="{{ asset('storage/images/pas_foto/'.$pelamar->pas_foto) }}" alt="" srcset="">
    </div>

</body>
</html>