<?php

namespace App\Http\Controllers;

use App\BobotKriteria;
use App\DaftarSoal;
use App\HasilTes;
use App\JadwalTes;
use App\Kriteria;
use App\NilaiAlternatif;
use App\Lowongan;
use App\Pelamar;
use Barryvdh\DomPDF\Facade as PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index($id)
    {
        if (Auth::user()->role == 'admin') {
            $lowongan = Lowongan::all();
            $lowonganGet = $lowongan[0]->id_lowongan;
            // dd($lowonganGet);
            $low = Lowongan::find($id);
            $kriteria = Kriteria::where('id_lowongan', $id)->get();
            $alternatif = Pelamar::where('id_lowongan', $id)->where('status_dokumen', 'Dokumen Valid')->get();
            $kode_krit = [];
            foreach ($kriteria as $krit) {
                $kode_krit[$krit->id_kriteria] = [];
                foreach ($alternatif as $al) {
                    foreach ($al->bobot as $bobot) {
                        if ($bobot->kriteria->id_kriteria == $krit->id_kriteria) {
                            $kode_krit[$krit->id_kriteria][] = $bobot->jumlah_bobot;
                        }
                    }
                }

                if ($krit->atribut_kriteria == 'cost' && !empty($kode_krit[$krit->id_kriteria])) {

                    $kode_krit[$krit->id_kriteria] = min($kode_krit[$krit->id_kriteria]);
                } elseif ($krit->atribut_kriteria == 'benefit' && !empty($kode_krit[$krit->id_kriteria])) {

                    $kode_krit[$krit->id_kriteria] = max($kode_krit[$krit->id_kriteria]);
                } else {
                    Alert::error('Maaf', 'Data belum ada');

                    $kode_krit[$krit->id_kriteria] = 1;

                    return redirect()->back();
                }
            }
            //        return json_encode($kode_krit);
            return view('perhitungan.index', [
                'kriteria'      => $kriteria,
                'alternatif'    => $alternatif,
                'kode_krit'     => $kode_krit,
                'lowonganGet'   => $lowonganGet,
                'low'   => $low
            ]);
        } else {
            abort(404);
        }
    }

    public function validation($id)
    {

        if (Auth::user()->role == 'admin') {
            $lowongan = Lowongan::all();
            $lowonganGet = $lowongan[0]->id_lowongan;
            // dd($lowonganGet);
            $low = Lowongan::find($id);
            $kriteria = Kriteria::where('id_lowongan', $id)->get();
            $alternatif = Pelamar::where('id_lowongan', $id)->get();
            $kode_krit = [];
            foreach ($kriteria as $krit) {
                $kode_krit[$krit->id_kriteria] = [];
                foreach ($alternatif as $al) {
                    foreach ($al->bobot as $bobot) {
                        if ($bobot->kriteria->id_kriteria == $krit->id_kriteria) {
                            $kode_krit[$krit->id_kriteria][] = $bobot->jumlah_bobot;
                        }
                    }
                }

                if ($krit->atribut_kriteria == 'cost' && !empty($kode_krit[$krit->id_kriteria])) {

                    $kode_krit[$krit->id_kriteria] = min($kode_krit[$krit->id_kriteria]);
                } elseif ($krit->atribut_kriteria == 'benefit' && !empty($kode_krit[$krit->id_kriteria])) {

                    $kode_krit[$krit->id_kriteria] = max($kode_krit[$krit->id_kriteria]);
                } else {
                    Alert::error('Maaf', 'Data belum ada');

                    $kode_krit[$krit->id_kriteria] = 1;

                    return redirect()->back();
                }
            }
            //        return json_encode($kode_krit);
            return view('perhitungan.validasi', [
                'kriteria'      => $kriteria,
                'alternatif'    => $alternatif,
                'kode_krit'     => $kode_krit,
                'lowonganGet'   => $lowonganGet,
                'low'   => $low
            ]);
        } else {
            abort(404);
        }
    }

    public function pdf($id)
    {

        $pelamar = Pelamar::findOrFail($id);
        // dd($pelamar->cv);
        return view('perhitungan.pdfCV', [
            'pelamar' => $pelamar
        ]);
    }

    public function pdfIjazah($id)
    {

        $pelamar = Pelamar::findOrFail($id);
        return view('perhitungan.pdfIjazah', [
            'pelamar' => $pelamar
        ]);
    }

    public function pasFoto($id)
    {

        $pelamar = Pelamar::findOrFail($id);
        return view('perhitungan.pasFoto', [
            'pelamar' => $pelamar
        ]);
    }

    public function perhitungan2($id)
    {
        if (Auth::user()->role == 'admin') {
            $lowongan = Lowongan::find($id);
            $daftarSoal = DaftarSoal::all();
            $daftarSoalGet = $daftarSoal[0]->id_soal;
            $tes = HasilTes::all();
            $low = Lowongan::find($id);
            foreach ($tes as $hasilTes) {
                if (HasilTes::all()->count() == null) {

                    Alert::error('Maaf', 'Data belum ada');
                    return redirect()->back();
                } else {
                    // $hasilTes = HasilTes::select('id_pelamar', 'bobot_soal', DB::raw('sum(nilai) as nilai'))
                    //     ->join('daftar_soal', 'daftar_soal.id_soal', '=', 'hasil_tes.id_soal_tes')
                    //     ->where('hasil_tes.id_lowongan', '=', $id)
                    //     // ->where('hasil_tes.id_soal_tes', '=', $daftarSoalGet)
                    //     ->groupBy('id_pelamar', 'bobot_soal')
                    //     ->get();

                    $ar = [];
                    $pelamar = Pelamar::all();
                    foreach ($pelamar as $data) {
                        $nilai = HasilTes::select('id_soal', DB::raw('sum(nilai * bobot_soal) as hasil'))
                            ->where('id_pelamar', $data->id_pelamar)
                            ->join('daftar_soal', 'daftar_soal.id_soal', '=', 'hasil_tes.id_soal_tes')
                            ->where('hasil_tes.id_lowongan', '=', $id)
                            ->groupBy('id_soal')
                            ->get();

                        if ($nilai->isNotEmpty()) {
                            $nilai = $nilai->toArray();
                            $nilai = array_sum(array_column($nilai, 'hasil'));
                            $nilai = $nilai / 100;

                            $x['nama_pelamar'] = $data->nama_pelamar;
                            $x['status'] = $data->seleksi_dua;
                            $x['id_pelamar'] = $data->id_pelamar;

                            $x['total'] = $nilai;
                            array_push($ar, $x);
                        }
                    }
                    if (empty($ar)) {
                        Alert::error('Maaf', 'Data belum ada');

                        return redirect()->back();
                    }
                    array_multisort(array_column($ar, 'total'), SORT_DESC, $ar);
                    // usort($ar, function ($a, $b) {
                    //     return $a['total'] <=> $b['total'];
                    // });
                    // rsort($ar);
                    // dd($ar);
                    return view('perhitungan.seleksi2', [
                        'daftarSoal'    => $daftarSoal,
                        'hasilTes'      => $ar,
                        'lowongan'      => $lowongan,
                        'low'   => $low
                    ]);
                }
            }
            // dd($hasilTes);
        } else {
            abort(404);
        }
    }

    public function lowongan()
    {

        $lowongan = lowongan::all();
        $lowonganId = $lowongan[0]->id_lowongan;
        $jadwalTes = JadwalTes::join('lowongan', 'lowongan.id_lowongan', '=', 'jadwal_tes.id_lowongan')->get();
        // dd($jadwalTes);
        return view('perhitungan.lowongan', ['jadwalTes' => $jadwalTes]);
    }

    public function detail($id)
    {
        if (Auth::user()->role == 'admin') {
            $pelamar = Pelamar::find($id);
            $kriteria = Kriteria::where('id_lowongan', $pelamar->id_lowongan)->get();
            $alternatif = Pelamar::where('id_pelamar', $id)->get();
            $pel = NilaiAlternatif::join('bobot_kriteria', 'bobot_kriteria.id_bobot_kriteria', '=', 'nilai_alternatif.id_bobot_kriteria')
            ->join('kriteria', 'kriteria.id_kriteria', '=', 'bobot_kriteria.id_kriteria')
            ->where('nilai_alternatif.id_pelamar', $id)
            ->get(['nama_bobot','nama_kriteria']);
            return view('perhitungan.detail', ['pelamar' => $pelamar,'kriteria' => $kriteria,'alternatif' => $pel]);
        } else {
            abort(404);
        }
    }

    public function laporan1($id)
    {

        $lowongan = Lowongan::all();
        $lowonganGet = $lowongan[0]->id_lowongan;
        // dd($lowonganGet);
        $namalowongan = Lowongan::where('id_lowongan', $id)->first();
        $kriteria = Kriteria::where('id_lowongan', $id)->get();
        $alternatif = Pelamar::where('id_lowongan', $id)->get();
        $kode_krit = [];
        foreach ($kriteria as $krit) {
            $kode_krit[$krit->id_kriteria] = [];
            foreach ($alternatif as $al) {
                foreach ($al->bobot as $bobot) {
                    if ($bobot->kriteria->id_kriteria == $krit->id_kriteria) {
                        $kode_krit[$krit->id_kriteria][] = $bobot->jumlah_bobot;
                    }
                }
            }

            if ($krit->atribut_kriteria == 'cost' && !empty($kode_krit[$krit->id_kriteria])) {

                $kode_krit[$krit->id_kriteria] = min($kode_krit[$krit->id_kriteria]);
            } elseif ($krit->atribut_kriteria == 'benefit' && !empty($kode_krit[$krit->id_kriteria])) {

                $kode_krit[$krit->id_kriteria] = max($kode_krit[$krit->id_kriteria]);
            } else {
                $kode_krit[$krit->id_kriteria] = 1;
            }
        }

        //    return json_encode($kode_krit);
        // echo $kode_krit;
        // return view('laporan.seleksi1', [
        //     'kriteria'      => $kriteria,
        //     'alternatif'    => $alternatif,
        //     'kode_krit'     => $kode_krit,
        // ]);

        // dd($tes);
        $pdf = PDF::loadView('laporan.seleksi1', [
            'namalowongan'      => $namalowongan,
            'kriteria'      => $kriteria,
            'alternatif'    => $alternatif,
            'kode_krit'     => $kode_krit
        ]);

        return $pdf->download('Seleksi-tahap-satu.pdf');
    }

    public function laporan2($id)
    {
        $lowongan = Lowongan::find($id);
        $daftarSoal = DaftarSoal::all();
        $daftarSoalGet = $daftarSoal[0]->id_soal;
        $tes = HasilTes::all();

        foreach ($tes as $hasilTes) {
            if (HasilTes::all()->count() == null) {

                Alert::error('Maaf', 'Data belum ada');
                return redirect()->back();
            } else {
                // $hasilTes = HasilTes::select('id_pelamar', 'bobot_soal', DB::raw('sum(nilai) as nilai'))
                //     ->join('daftar_soal', 'daftar_soal.id_soal', '=', 'hasil_tes.id_soal_tes')
                //     ->where('hasil_tes.id_lowongan', '=', $id)
                //     // ->where('hasil_tes.id_soal_tes', '=', $daftarSoalGet)
                //     ->groupBy('id_pelamar', 'bobot_soal')
                //     ->get();

                // dd($lowonganGet);
                $kriteria = Kriteria::where('id_lowongan', $id)->get();
                $alternatif = Pelamar::where('id_lowongan', $id)->get();
                $kode_krit = [];
                foreach ($kriteria as $krit) {
                    $kode_krit[$krit->id_kriteria] = [];
                    foreach ($alternatif as $al) {
                        foreach ($al->bobot as $bobot) {
                            if ($bobot->kriteria->id_kriteria == $krit->id_kriteria) {
                                $kode_krit[$krit->id_kriteria][] = $bobot->jumlah_bobot;
                            }
                        }
                    }

                    if ($krit->atribut_kriteria == 'cost' && !empty($kode_krit[$krit->id_kriteria])) {

                        $kode_krit[$krit->id_kriteria] = min($kode_krit[$krit->id_kriteria]);
                    } elseif ($krit->atribut_kriteria == 'benefit' && !empty($kode_krit[$krit->id_kriteria])) {

                        $kode_krit[$krit->id_kriteria] = max($kode_krit[$krit->id_kriteria]);
                    } else {
                        $kode_krit[$krit->id_kriteria] = 1;
                    }
                }

                $ar = [];
                $pelamar = Pelamar::all();
                foreach ($pelamar as $data) {
                    $nilai = HasilTes::select('id_soal', DB::raw('sum(nilai * bobot_soal) as hasil'))
                        ->where('id_pelamar', $data->id_pelamar)
                        ->join('daftar_soal', 'daftar_soal.id_soal', '=', 'hasil_tes.id_soal_tes')
                        ->where('hasil_tes.id_lowongan', '=', $id)
                        ->groupBy('id_soal')
                        ->get();

                        
                    if ($nilai->isNotEmpty()) {
                        $nilai = $nilai->toArray();
                        $nilai = array_sum(array_column($nilai, 'hasil'));
                        $nilai = $nilai / 100;

                        $x['nama_pelamar'] = $data->nama_pelamar;
                        $x['alamat'] = $data->alamat;
                        $x['telepon'] = $data->no_telepon;
                        $x['status'] = $data->seleksi_dua;
                        $x['id_pelamar'] = $data->id_pelamar;
                        $x['berlaku_sampai'] = $data->berlaku_sampai;
                        $x['status_dokumen'] = $data->status_dokumen;

                        $x['nilaiAkhir'] = $nilai;
                        array_push($ar, $x);
                    }
                }
                if (empty($ar)) {
                    Alert::error('Maaf', 'Data belum ada');

                    return redirect()->back();
                }
                array_multisort(array_column($ar, 'nilaiAkhir'), SORT_DESC, $ar);
              
                 $pdf = PDF::loadView ('laporan.seleksi2', [

                    'daftarSoal'    => $daftarSoal,
                    'hasilTes'      => $ar,
                    'lowongan'      => $lowongan,
                    'kriteria'      => $kriteria,
                    'alternatif'    => $alternatif,
                    'kode_krit'     => $kode_krit
                ]);

                return $pdf->download('Laporan-Seleksi-dan-Rekrutmen.pdf');
            }
        }
        // dd($hasilTes); 

        // $pdf = PDF::loadView('laporan.seleksi2', [
        //     'daftarSoal'    => $daftarSoal,
        //     'hasilTes'      => $hasilTes,
        //     'lowongan'      => $lowongan
        // ]);

    }
}
