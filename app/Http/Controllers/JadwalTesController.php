<?php

namespace App\Http\Controllers;

use App\DaftarSoal;
use App\HasilTes;
use App\JadwalTes;
use App\lowongan;
use App\Pelamar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class JadwalTesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $jadwal_tes = DB::table('jadwal_tes')
                ->join('lowongan', 'lowongan.id_lowongan', '=', 'jadwal_tes.id_lowongan')->get();
            return view('jadwal_tes.index', ['jadwal_tes' => $jadwal_tes]);
        } else {
            abort(404);
        }
    }

    public function home()
    {

        $user = Auth::user()->id;
        $pelamar = Pelamar::where('id_user', $user)->get();
        // dd($pelamar);

        if (!empty($pelamar)) {
            foreach ($pelamar as $data) {

                $pelamar = Pelamar::with('user')->where('id_user', $user)
                    ->join('lowongan', 'lowongan.id_lowongan', '=', 'pelamar.id_lowongan')
                    ->get();

                $pelamarGet = $data->id_lowongan;

                $jadwal_tes = JadwalTes::join('lowongan', 'lowongan.id_lowongan', '=', 'jadwal_tes.id_lowongan',)
                    ->where('lowongan.id_lowongan', $pelamarGet)
                    ->get();
            }
            // dd($pelamar->count() > 0);

            // if($pelamar[0]->seleksi_satu == 'Diterima'){

            //     return view('jadwal_tes.home', ['jadwal_tes' => $jadwal_tes, 'pelamar' => $pelamar]);
            // } elseif(Pelamar::whereNull('seleksi_satu')->get()) {

            //     return view('jadwal_tes.gagal',);
            // } else {
            //     return view('jadwal_tes.gagal',);
            // }
            if ($pelamar->count() > 0) {
                if ($pelamar[0]->seleksi_satu == "Diterima") {

                    return view('jadwal_tes.home', ['jadwal_tes' => $jadwal_tes, 'pelamar' => $pelamar]);
                } else if ($pelamar[0]->seleksi_satu == "Ditolak") {

                    return view('jadwal_tes.gagal');
                } elseif (Pelamar::whereNull('seleksi_satu')->get()) {
                    return view('jadwal_tes.gagal');
                }
            } else {

                return view('jadwal_tes.gagal');
            }
        }
    }

    public function notif($id)
    {

        $jadwal_tes = JadwalTes::find($id);
        $lowongan = Lowongan::where('id_lowongan',$jadwal_tes->id_lowongan)->first();
        $pelamar = Pelamar::where('id_lowongan', $lowongan->id_lowongan)->where('seleksi_satu', 'Diterima')->get();

        foreach ($pelamar as $item) {
            $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
            $beautymail->send('email.notif', ['data' => $item, 'jadwal_tes' => $jadwal_tes], function ($message) use ($item) {
                $message
                    ->from('lintasnusa1990@gmail.com')
                    ->to($item->user->email, $item->nama_pelamar)
                    ->subject('Notifikasi ' . $item->lowongan->posisi_lowongan);
            });

        }
        
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin') {
            $daftarsoal = DaftarSoal::all();
            $lowongan = lowongan::all();

            $daftarsoaltes = HasilTes::all();
            return view('jadwal_tes.tambah', ['lowongan' => $lowongan, 'daftarsoal' => $daftarsoal, 'daftarsoaltes' => $daftarsoaltes]);
        } else {
            abort(404);
        }
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
            'id_lowongan' => 'required',
            'tanggal' => "required",
            'batas' => "required",

        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Jadwal tes berhasil ditambahkan');

            $jadwal_tes = new JadwalTes();
            $jadwal_tes->id_lowongan = $request->get('id_lowongan');
            $jadwal_tes->tanggal_notif = $request->get('tanggal_notif');
            $jadwal_tes->tanggal = $request->get('tanggal');
            $jadwal_tes->durasi_tes = $request->get('batas');
            $jadwal_tes->save();
            return redirect()->route('jadwal_tes.index');
        }
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
        if (Auth::user()->role == 'admin') {
            $jadwal_tes = DB::table('jadwal_tes')
                ->join('lowongan', 'lowongan.id_lowongan', '=', 'jadwal_tes.id_lowongan')
                ->where('id_jadwal_tes', $id)
                ->first();
            $lowongan = lowongan::all();
            return view('jadwal_tes.edit', ['jadwal_tes' => $jadwal_tes, 'lowongan' => $lowongan]);
        } else {
            abort(404);
        }
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
            'id_lowongan' => 'required',
            'tanggal' => "required",
            'batas' => "required",

        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Jadwal tes berhasil diubah');

            $jadwal_tes = JadwalTes::find($id);
            $jadwal_tes->id_lowongan = $request->get('id_lowongan');
            $jadwal_tes->tanggal_notif = $request->get('tanggal_notif');
            $jadwal_tes->tanggal = $request->get('tanggal');
            $jadwal_tes->durasi_tes = $request->get('batas');
            $jadwal_tes->save();
            return redirect()->route('jadwal_tes.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal_tes = JadwalTes::find($id);
        $jadwal_tes->delete();

        return redirect()->route('jadwal_tes.index');
    }
}
