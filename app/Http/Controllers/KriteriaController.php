<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Kriteria;
use App\lowongan;
use Illuminate\Support\Facades\Auth;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if (Auth::user()->role == 'admin') {
            $lowongan = lowongan::find($id);
            $data = Kriteria::where('id_lowongan', $id)->get();
            $nilai = $data->sum('bobot_preferensi');
            // dd($nilai);
            return view('kriteria.index', ['kriteria' => $data, 'lowongan' => $lowongan, 'nilai' => $nilai]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Auth::user()->role == 'admin') {
            $lowongan = lowongan::find($id);
            return view('kriteria.tambah', ['lowongan' => $lowongan]);
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
            'nama_kriteria' => "required",
            'atribut_kriteria' => "required",
            'bobot_preferensi' => "required",

        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Data kriteria berhasil ditambahkan');

            $kriteria = new Kriteria();
            $kriteria->id_lowongan = $request->get('id_lowongan');
            $kriteria->nama_kriteria = $request->get('nama_kriteria');
            $kriteria->atribut_kriteria = $request->get('atribut_kriteria');
            $kriteria->bobot_preferensi = $request->get('bobot_preferensi');
            $kriteria->save();
            return redirect()->route('kriteria.index', ['id' => $kriteria->id_lowongan]);
        }
        return redirect(route('kriteria'));
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
            $kriteria = Kriteria::find($id);
            return view('kriteria.edit', ['data' => $kriteria]);
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
            'nama_kriteria' => "required",
            'atribut_kriteria' => "required",
            'bobot_preferensi' => "required",

        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return back()->withErrors($validator->errors());
        } else {
            Alert::success('Berhasil', 'Data kriteria berhasil diubah');

            $kriteria = Kriteria::find($id);
            $kriteria->id_lowongan = $request->get('id_lowongan');
            $kriteria->nama_kriteria = $request->get('nama_kriteria');
            $kriteria->atribut_kriteria = $request->get('atribut_kriteria');
            $kriteria->bobot_preferensi = $request->get('bobot_preferensi');
            $kriteria->save();
        }
        return redirect(route('kriteria.index', ['id' => $kriteria->id_lowongan]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return redirect(route('kriteria.index', ['id' => $kriteria->id_lowongan]));
    }
}
