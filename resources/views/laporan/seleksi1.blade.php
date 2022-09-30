<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Rekap Seleksi 1</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">


        <style>
        /* body {
            font-family: arial;
        } */

        .print {
            margin-top: 10px;
        }

        @media print {
            .print {
                display: none;
            }
        }

        /* table {
            border-collapse: collapse;
        } */

    </style>
</head>

<body>
    <div class="container">

        <h3 class="text-center mt-2 mb-2">CV. LINTAS NUSA</h3>
        <p class="text-center mt-2 mb-2">Jl. Kalidami No.51, Mojo, Kec. Gubeng, Kota Surabaya, Jawa Timur</p>
        <p class="text-center mt-2 mb-2">No. Telepon: (031) 5687462  | Email: lintasnusa1990@gmail.com</p>
        <hr style="border: 2;">
        <p class="text-center mt-2 mb-2"><b>Laporan Rekap Hasil Seleksi Tahap 1 Pelamar untuk Posisi {{$namalowongan->posisi_lowongan}}</b></p>
        <p>Tanggal: {{date('d-m-Y')}}</p>
        


        <?php $bobot = []; ?>
        @foreach ($kriteria as $krit)
            <?php $bobot[$krit->id_kriteria] = $krit->bobot_preferensi; ?>
        @endforeach

        @if (!empty($alternatif))
            <?php $rangking = []; ?>
            @foreach ($alternatif as $data)
                <?php $total = 0;
                $nilai_normalisasi = 0; ?>
                @foreach ($data->bobot as $crip)
                    @if ($crip->kriteria->atribut_kriteria == 'cost')
                        <span hidden><?php $nilai_normalisasi = $kode_krit[$crip->kriteria->id_kriteria] / $crip->jumlah_bobot; ?></span>

                    @elseif($crip->kriteria->atribut_kriteria == 'benefit')
                        <span hidden><?php $nilai_normalisasi = $crip->jumlah_bobot / $kode_krit[$crip->kriteria->id_kriteria]; ?></span>


                    @endif
                    <span hidden><?php $total = $total + $bobot[$crip->kriteria->id_kriteria] * $nilai_normalisasi; ?></span>
                    <span hidden>{{ number_format($nilai_normalisasi, 2, ',', '.') }}</span>


                @endforeach
                <?php $rangking[] = [
                    'total' => $total,
                    'kode' => $data->id_pelamar,
                    'nama' => $data->nama_pelamar,
                    'alamat' => $data->alamat,
                    'notelp' => $data->no_telepon,
                    'idLowongan' => $data->id_lowongan,
                    'seleksi_1' => $data->seleksi_satu,
                ]; ?>
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($kriteria) + 1 }}" class="text-center">Data tidak
                    ditemukan</td>
            </tr>
        @endif


        <div class="table-responsive">
            <table border="1" cellspacing="" cellpadding="4" width="100%">
                <thead>
                    <tr>
                        <th align="center">No</th>
                        <th align="center">Nama</th>
                        <th align="center">Total</th>
                        <th align="center">Ranking</th>
                        <th align="center">Keterangan</th>
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
                            <td>{{ $no2++ }}</td>
                            <td>{{ $t['nama'] }}</td>
                            <td>{{ number_format($t['total'], 2, ',', '.') }}</td>
                            <td>{{ $a++ }}</td>
                            <td>
                                
                                @if ($t['seleksi_1'] == 'Diterima')
                                    Lolos Seleksi Satu
                                @elseif($t['seleksi_1'] == "Ditolak")
                                    Tidak Lolos Seleksi Satu
                                @else
                                    <span class="text-danger">Belum ada keterangan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>


</body>

</html>

