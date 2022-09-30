@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 card-deck">

            <div class="card">
                <div class="card-header">
                    <center>
                        <h3>Seleksi Tahap 2 Posisi {{ $low->posisi_lowongan }}</h3>
                    </center>

                    <h3>Perankingan Hasil Tes</h3>

                    <a href="{{ route('seleksi.dua', $lowongan) }}" class="btn btn-md btn-success mt-5">Cetak
                        Rekap</a>
                    <div class="float-right mt-5">
                        <form action="{{ route('pelamar.tolak.dua') }}" method="post" id="formSort">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="text-dark mt-3" align="left">Jumlah yang Lolos : </label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="sorting" class="form-control" placeholder="Sorting">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="submit" class="btn btn-danger">Seleksi</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="table-responsive">
                    <div class="container">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">NO</th>
                                    <th align="center">Nama</th>
                                    <th align="center">Nilai Akhir</th>
                                    <th align="center">Ranking</th>
                                    <th align="center">Status Lamaran</th>
                                    <th align="center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilTes as $data)
                                <tr>
                                    <input type="text" name="id_pelamar[]" value="{{ $data['id_pelamar'] }}" form="formSort" hidden>
                                    <input type="text" name="total[]" value="($data['total'])" form="formSort" hidden>
                                    
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data['nama_pelamar'] }}</td>
                                    <td>{{ number_format($data['total']) }}</td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($data['status'] == 'Diterima')
                                        Lolos Seleksi Dua
                                        @elseif($data['status'] == 'Ditolak')
                                        Tidak Lolos Seleksi Dua
                                        @else
                                        Menunggu Seleksi Tahap Dua
                                        @endif
                                    </td>
                                    <td align="center">
                                        <form action="{{ route('pelamar.seleksi.dua', $data['id_pelamar']) }}" method="post">
                                            {{ csrf_field() }}

                                            <a href="{{ route('seleksi.detail', $data['id_pelamar']) }}" class="btn btn-info">Lihat Detail</a>

                                            <!-- @if ($data['status'] == null)
                                            <input type="submit" name="submit" href="{{ route('pelamar.seleksi.dua', $data['id_pelamar']) }}" class="btn btn-success" value="Terima">

                                            <input type="submit" name="submit" href="{{ route('pelamar.seleksi.dua', $data['id_pelamar']) }}" class="btn btn-danger" value="Tolak">
                                            @endif -->
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection