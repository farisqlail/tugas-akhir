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
            Batas pengumpulan tes sudah hampir ditutup, harap pelamar segera mengirimkan jawaban tes sebelum {{ $jadwal_tes->durasi_tes }}.
            <br><br>
            
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
