<?php

namespace App\Http\Controllers;

use App\SubKelas;
use Illuminate\Http\Request;

class SubClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubKelas::all();

        return view('sub-kelas.index', compact('data'));
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
            'nama' => 'required|digits_between:0,3|unique:tbl_sub_kelas,nama|numeric',
        ], [
            'nama.required' => 'Nama sub kelas tidak boleh kosong !',
            'nama.digits_between' => 'Nama sub kelas maximal 3 karakter !',
            'nama.unique' => 'Nama sub kelas sudah ada !',
            'nama.numeric' => 'Nama sub kelas hanya boleh diisi angka !',
        ]);

        try {
            $data = new SubKelas;
            $data->id = 'SBK' . sprintf('%03u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->save();

            return redirect()->route('sub-kelas')->with('success', 'Berhasil menambahkan ruangan ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('sub-kelas')->with('danger', 'Gagal menambahkan ruangan !');
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
            'nama-'.$id => 'required|digits_between:0,3|unique:tbl_sub_kelas,nama|numeric',
        ], [
            'nama-'.$id.'.required' => 'Nama sub kelas tidak boleh kosong !',
            'nama-'.$id.'.digits_between' => 'Nama sub kelas maximal 3 karakter !',
            'nama-'.$id.'.unique' => 'Nama sub kelas tidak boleh sama !',
            'nama-'.$id.'.numeric' => 'Nama sub kelas hanya boleh diisi angka !',
        ]);

        try {
            $data = SubKelas::find($id);
            $data->nama = $request['nama-'.$id];
            $data->save();

            return redirect()->route('sub-kelas')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('sub-kelas')->with('danger', 'Gagal menambahkan data !');
        }
    }
}
