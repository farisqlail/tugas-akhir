<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\HasilTes;
use App\Pelamar;
use App\DaftarSoal;
use App\JadwalTes;
use App\lowongan;

class HasilTesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pelamar = Pelamar::select('pelamar.id_pelamar', 'pelamar.nama_pelamar', 'lowongan.posisi_lowongan')
            ->join('hasil_tes', 'hasil_tes.id_pelamar', '=', 'pelamar.id_pelamar')
            ->join('lowongan', 'lowongan.id_lowongan', '=', 'pelamar.id_lowongan')
            ->where('hasil_tes.id_lowongan', $id)
            ->groupBy('id_pelamar', 'nama_pelamar', 'posisi_lowongan')
            ->get();
        $lowongan = lowongan::where('id_lowongan', $id)->first();
        // dd($pelamar); 

        return view('jawaban.index', [
            'pelamar' => $pelamar,
            'lowongan' => $lowongan
        ]);
    }

    public function detail($id)
    {

        $hasilTes = HasilTes::with('pelamar', 'daftar_soal')->where('id_pelamar', $id)->get();
        // dd($hasilTes);
        $pelamar = Pelamar::where('id_pelamar', $id)->first();
        return view('jawaban.detail', [
            'hasilTes' => $hasilTes,
            'pelamar' => $pelamar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user()->id;
        $pelamar = Pelamar::with('user')->where('id_user', $user)->get();

        $pelamarGet = $pelamar[0]->id_pelamar;

        $jadwaltes = JadwalTes::find($id);
        $daftarsoal = DaftarSoal::join('hasil_tes', 'hasil_tes.id_soal_tes', '=', 'daftar_soal.id_soal')
            ->where('id_jadwal_tes', $id)
            ->where('hasil_tes.id_pelamar', $pelamarGet)
            ->get();

        return view('jawaban.jawaban', ['pelamarGet' => $pelamarGet, 'daftarsoal' => $daftarsoal, 'jadwaltes' => $jadwaltes, 'pelamar' => $pelamar]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'jawaban' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Berhasil Upload', 'Jawaban diperiksa terlebih dahulu');

            $hasilTes = new HasilTes();

            $hasilTes->id_soal_tes = $request->get('id_soal_tes');
            $hasilTes->id_pelamar = $request->get('id_pelamar');
            $hasilTes->id_lowongan = $request->get('id_lowongan');
            if ($request->hasFile('jawaban')) {
                $file = $request->file('jawaban');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $hasilTes->jawaban = $filename;
                Storage::putFileAs("public/file/jawaban", $file, $filename);
            }

            $hasilTes->save();
        }

        return redirect()->back();
    }

    public function editJawaban($id)
    {

        $hasilTes = HasilTes::find($id);
        // dd($hasilTes);
        return view('jawaban.edit', ['hasilTes' => $hasilTes]);
    }

    public function updateJawaban(Request $request, $id)
    {

        $validator = Validator::make(request()->all(), [
            'jawaban' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Berhasil Ubah Jawaban', 'Jawaban diperiksa terlebih dahulu');

            $hasilTes = HasilTes::findOrFail($id);

            $hasilTes->id_soal_tes = $request->get('id_soal_tes');
            $hasilTes->id_pelamar = $request->get('id_pelamar');
            $hasilTes->id_lowongan = $request->get('id_lowongan');
            if ($request->hasFile('jawaban')) {
                $file = $request->file('jawaban');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $hasilTes->jawaban = $filename;
                Storage::putFileAs("public/file/jawaban", $file, $filename);
            }

            $hasilTes->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hasilTes = HasilTes::find($id);
        // dd($hasilTes);
        return view('jawaban.nilai', ['hasilTes' => $hasilTes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'nilai' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {

            Alert::success('Berhasil', 'Jawaban berhasil dinilai');

            $hasilTes = HasilTes::findOrFail($id);

            $hasilTes->nilai = $request->get('nilai');

            $hasilTes->save();

            $NA = HasilTes::select('id_soal', DB::raw('sum(nilai * bobot_soal) as hasil'))
                ->where('id_pelamar', $hasilTes->id_pelamar)
                ->join('daftar_soal', 'daftar_soal.id_soal', '=', 'hasil_tes.id_soal_tes')
                ->where('hasil_tes.id_lowongan', '=', $hasilTes->id_lowongan)
                ->groupBy('id_soal')
                ->get();
            $nilai = $NA->toArray();
            $sum_nilai  = array_sum(array_column($nilai, 'hasil'));
            $total=$sum_nilai / 100;

            Pelamar::where('id_pelamar', $hasilTes->id_pelamar)->update(['nilai_tes' => $total]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
