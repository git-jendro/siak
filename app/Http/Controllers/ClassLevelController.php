<?php

namespace App\Http\Controllers;

use App\TingkatKelas;
use Illuminate\Http\Request;

class ClassLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TingkatKelas::all();

        return view('tingkat-kelas.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:3|unique:tbl_tingkat_kelas,nama',
        ], [
            'nama.required' => 'Nama tingkatan tidak boleh kosong !',
            'nama.max' => 'Nama tingkatan maximal 3 karakter !',
            'nama.unique' => 'Nama tingkatan sudah ada !',
        ]);

        try {
            $data = new TingkatKelas;
            $data->id = 'TGK' . sprintf('%02u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->save();

            return redirect()->route('tingkat-kelas')->with('success', 'Berhasil menambahkan ruangan ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('tingkat-kelas')->with('danger', 'Gagal menambahkan ruangan !');
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
        $request->validate([
            'nama-'.$id => 'required|max:3|unique:tbl_tingkat_kelas,nama',
        ], [
            'nama-'.$id.'.required' => 'Nama tingkatan tidak boleh kosong !',
            'nama-'.$id.'.max' => 'Nama tingkatan maximal 3 karakter !',
            'nama-'.$id.'.unique' => 'Nama tingkatan sudah ada !',
        ]);

        try {
            $data = TingkatKelas::find($id);
            $data->nama = $request['nama-'.$id];
            $data->save();

            return redirect()->route('tingkat-kelas')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('tingkat-kelas')->with('danger', 'Gagal menambahkan data !');
        }
    }
}
