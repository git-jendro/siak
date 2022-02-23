<?php

namespace App\Http\Controllers;

use App\Ruangan;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ruangan::all();

        return view('ruangan.index', compact('data'));
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
            'nama' => 'required|min:5|max:50',
            'kode' => 'required|min:5|max:20',
        ], [
            'nama.required' => 'Nama ruangan tidak boleh kosong !',
            'nama.min' => 'Nama ruangan minimal 5 karakter !',
            'nama.max' => 'Nama ruangan maximal 50 karakter !',
            'kode.required' => 'Kode ruangan tidak boleh kosong !',
            'kode.min' => 'Kode ruangan minimal 5 karakter !',
            'kode.max' => 'Kode ruangan maximal 20 karakter !',
        ]);

        try {
            $data = new Ruangan;
            $data->id = 'RGN' . sprintf('%03u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->kode = $request->kode;
            $data->save();

            return redirect()->route('ruangan')->with('success', 'Berhasil menambahkan ruangan ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('ruangan')->with('danger', 'Gagal menambahkan ruangan !');
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
            'nama-'.$id => 'required|min:5|max:50',
            'kode-'.$id => 'required|min:5|max:20',
        ], [
            'nama-'.$id.'.required' => 'Nama ruangan tidak boleh kosong !',
            'nama-'.$id.'.min' => 'Nama ruangan minimal 5 karakter !',
            'nama-'.$id.'.max' => 'Nama ruangan maximal 50 karakter !',
            'kode-'.$id.'.required' => 'Kode ruangan tidak boleh kosong !',
            'kode-'.$id.'.min' => 'Kode ruangan minimal 5 karakter !',
            'kode-'.$id.'.max' => 'Kode ruangan maximal 20 karakter !',
        ]);

        try {
            $data = Ruangan::find($id);
            $data->nama = $request['nama-'.$id];
            $data->kode = $request['kode-'.$id];
            $data->save();

            return redirect()->route('ruangan')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('ruangan')->with('danger', 'Gagal menambahkan data !');
        }
    }
}
