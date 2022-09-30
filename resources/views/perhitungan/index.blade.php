@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 card-deck">
                <div class="card">
                    <div class="card-header">
                        <center>
                            <h3>Seleksi Tahap 1 Posisi {{ $low->posisi_lowongan }}</h3>
                        </center>
                        <h3 class="float-left">Hasil Analisa</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Pelamar</th>
                                        @foreach ($kriteria as $krit)
                                            <th class="text-center">{{ $krit->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @foreach ($alternatif as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->nama_pelamar }}</td>
                                            @foreach ($data->bobot_kriteria as $bk)
                                                <td>{{ $bk->nama_bobot }}</td>
                                            @endforeach

                                            {{-- <td>{{ $data->bobotKriteria->nama_bobot }}</td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- @else
                                        <tr>
                                            <td colspan="{{ count($pelamar) + 1 }}" class="text-center">Data tidak
                                                ditemukan</td>
                                        </tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 card-deck mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Normalisasi</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Pelamar</th>
                                        <?php $bobot = []; ?>
                                        @foreach ($kriteria as $krit)
                                            <?php $bobot[$krit->id_kriteria] = $krit->bobot_preferensi; ?>
                                            <th class="text-center">{{ $krit->nama_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($alternatif))
                                        <?php $rangking = []; ?>
                                        @foreach ($alternatif as $data)
                                            <tr>
                                                <td>{{ $data->nama_pelamar }}</td>
                                                <?php $total = 0;
                                                $nilai_normalisasi = 0; ?>
                                                @foreach ($data->bobot as $crip)
                                                    @if ($crip->kriteria->atribut_kriteria == 'cost')
                                                        <?php $nilai_normalisasi = $kode_krit[$crip->kriteria->id_kriteria] / $crip->jumlah_bobot; ?>
                                                    @elseif($crip->kriteria->atribut_kriteria == 'benefit')
                                                        <?php $nilai_normalisasi = $crip->jumlah_bobot / $kode_krit[$crip->kriteria->id_kriteria]; ?>
                                                    @endif
                                                    <?php $total = $total + $bobot[$crip->kriteria->id_kriteria] * $nilai_normalisasi; ?>
                                                    <td>{{ number_format($nilai_normalisasi, 2, ',', '.') }}</td>
                                                @endforeach
                                                <?php $rangking[] = [
                                                    'total' => $total,
                                                    'kode' => $data->id_pelamar,
                                                    'nama' => $data->nama_pelamar,
                                                    'idLowongan' => $data->id_lowongan,
                                                    'seleksi_1' => $data->seleksi_satu,
                                                    'date' => $data->created_at,
                                                ]; ?>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ count($kriteria) + 1 }}" class="text-center">Data tidak
                                                ditemukan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <p style="color: red;">Keterangan: Rentang nilai diantara 0 hingga 1</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 card-deck mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Perankingan Hasil Perhitungan SAW</h3>

                        {{-- <a href="{{ route('seleksi.satu', $rangking[0]['idLowongan']) }}"
                            class="btn btn-success mt-5">Cetak
                            Rekap</a> --}}
                        <div class=" mt-5">
                            <form action="{{ route('pelamar.tolak.satu') }}" method="post" id="formSort">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="text-dark mt-3" align="left">Nilai Total Min'>= : </label>
                                        <input type="text" name="nilai" class="form-control" placeholder="Nilai">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text-dark mt-3" align="left">Jumlah yang Lolos : </label>
                                        <input type="text" name="sorting" class="form-control" placeholder="Sorting">
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger">Seleksi</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th align="center">NO</th>
                                        <th align="center">Nama</th>
                                        <th align="center">Total</th>
                                        <th align="center">Ranking</th>
                                        <th align="center">Status Lamaran</th>
                                        <th align="center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        usort($rangking, function ($a, $b) {
                                            return $a['total'] <=> $b['total'];
                                        });
                                        rsort($rangking);
                                        $a = 1;
                                        $no2 = 1;
                                    @endphp

                                    @foreach ($rangking as $t)
                                        <tr>
                                            <input type="text" name="kode[]" value="{{ $t['kode'] }}"
                                                form="formSort" hidden>
                                            <input type="text" name="total[]" value="{{ $t['total'] }}"
                                                form="formSort" hidden>
                                            <td>{{ $no2++ }}</td>
                                            <td>{{ $t['nama'] }}</td>
                                            <td>{{ number_format($t['total'], 2, ',', '.') }}</td>
                                            <td>{{ $a++ }}</td>
                                            <td>
                                                @if ($t['seleksi_1'] == 'Diterima')
                                                    Lolos Seleksi Satu
                                                @elseif ($t['seleksi_1'] == 'Ditolak')
                                                    Tidak Lolos Seleksi
                                                @else
                                                    Menunggu Seleksi
                                                @endif
                                            </td>
                                            <td align="center">

                                                <form action="{{ route('pelamar.update', $t['kode']) }}" method="post">
                                                    {{ csrf_field() }}

                                                    <a href="{{ route('seleksi.detail', $t['kode']) }}"
                                                        class="btn btn-info">Lihat Detail</a>

                                                    <!-- @if ($t['seleksi_1'] == null)
    <input type="submit" name="submit" class="btn btn-success"
                                                                    value="Terima">

                                                                <input type="submit" name="submit" class="btn btn-danger"
                                                                    value="Tolak">
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
        @endsection
