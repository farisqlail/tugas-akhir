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
            Menindaklanjuti pengumuman seleksi tahap 2 untuk lowongan <b>{{ $data->lowongan->posisi_lowongan }}</b>, melalui surat ini kami sampaikan
            bahwa anda TIDAK LOLOS pada seleksi tahap 2.

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
