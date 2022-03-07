<?php

namespace App\Http\Controllers;

use App\Kurikulum;
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
        $kurikulum = Kurikulum::all();

        return view('tingkat-kelas.index', compact('data', 'kurikulum'));
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
            'nama' => 'required|max:3',
            'kurikulum_id' => 'required|exists:tbl_kurikulum,id',
        ], [
            'nama.required' => 'Nama tingkatan tidak boleh kosong !',
            'nama.max' => 'Nama tingkatan maximal 3 karakter !',
            'kurikulum_id.required' => 'Kurikulum tidak boleh kosong !',
            'kurikulum_id.exists' => 'Data tidak cocok !',
        ]);

        try {
            $data = new TingkatKelas;
            $data->id = 'TGK' . sprintf('%02u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->kurikulum_id = $request->kurikulum_id;
            $data->save();

            return redirect()->route('tingkat-kelas')->with('success', 'Berhasil menambahkan data ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('tingkat-kelas')->with('danger', 'Gagal menambahkan data !');
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
            'nama-'.$id => 'required|max:3',
            'kurikulum_id-'.$id => 'required|exists:tbl_kurikulum,id',
        ], [
            'nama-'.$id.'.required' => 'Nama ruangan tidak boleh kosong !',
            'nama-'.$id.'.max' => 'Nama ruangan maximal 3 karakter !',
            'kurikulum_id-'.$id.'.required' => 'Kurikulum tidak boleh kosong !',
            'kurikulum_id-'.$id.'.exists' => 'Data tidak cocok !',
        ]);

        try {
            $data = TingkatKelas::find($id);
            $data->nama = $request['nama-'.$id];
            $data->kurikulum_id = $request['kurikulum_id-'.$id];
            $data->save();

            return redirect()->route('tingkat-kelas')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('tingkat-kelas')->with('danger', 'Gagal menambahkan data !');
        }
    }
}
