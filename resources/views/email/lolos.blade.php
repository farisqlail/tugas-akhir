@extends('beautymail::templates.minty')

@section('content')

@include('beautymail::templates.minty.contentStart')
	<tr>
        <td class="title">
            Yth.
            {{ $data->nama_pelamar }}
        </td>
    </tr>
    <tr>
        <td width="100%" height="10"></td>
    </tr>
    <tr>
        <td class="paragraph">
            Menindaklanjuti pengumuman seleksi tahap 1 untuk lowongan <b>{{ $data->lowongan->posisi_lowongan }}</b>, melalui surat ini kami sampaikan bahwa anda LOLOS pada seleksi tahap 1 dan dimohon untuk mengikuti tes online yang akan diselenggarakan pada:
            <br><br>
            Tanggal : {{ $jadwalTes->tanggal }} WIB<br><br>

            Untuk informasi yang lebih lanjut dapat dilihat pada halaman website pada menu tes online.
            
            Atas perhatiannya kami sampaikan terimakasih.
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    @include('beautymail::templates.minty.contentEnd')

@stop
