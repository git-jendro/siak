<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jurusan::all();

        return view('jurusan.index', compact('data'));
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
            'nama' => 'required|min:5|max:50|regex:/^[a-zA-Z ]*$/',
            'kode' => 'required|min:2|max:10|regex:/^[a-zA-Z ]*$/',
        ], [
            'nama.required' => 'Nama jurusan tidak boleh kosong !',
            'nama.min' => 'Nama jurusan minimal 5 karakter !',
            'nama.max' => 'Nama jurusan maximal 50 karakter !',
            'nama.regex' => 'Nama jurusan hanya boleh diisi huruf !',
            'kode.required' => 'Kode jurusan tidak boleh kosong !',
            'kode.min' => 'Kode jurusan minimal 2 karakter !',
            'kode.max' => 'Kode jurusan maximal 10 karakter !',
            'kode.regex' => 'Kode jurusan hanya boleh diisi huruf !',
        ]);

        try {
            $data = new Jurusan;
            $data->id = 'JRS' . sprintf('%02u', $data->count() + 1);
            $data->kode = $request->kode;
            $data->nama = $request->nama;
            $data->save();

            return redirect()->route('jurusan')->with('success', 'Berhasil menambahkan data ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('jurusan')->with('danger', 'Gagal menambahkan data !');
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
            'nama-'.$id => 'required|min:5|max:50|regex:/^[a-zA-Z ]*$/',
            'kode-'.$id => 'required|min:2|max:10|regex:/^[a-zA-Z ]*$/',
        ], [
            'nama-'.$id.'.required' => 'Nama jurusan tidak boleh kosong !',
            'nama-'.$id.'.min' => 'Nama jurusan minimal 5 karakter !',
            'nama-'.$id.'.max' => 'Nama jurusan maximal 50 karakter !',
            'nama-'.$id.'.regex' => 'Nama jurusan hanya boleh diisi huruf !',
            'kode-'.$id.'.required' => 'Kode jurusan tidak boleh kosong !',
            'kode-'.$id.'.min' => 'Kode jurusan minimal 2 karakter !',
            'kode-'.$id.'.max' => 'Kode jurusan maximal 10 karakter !',
            'kode-'.$id.'.regex' => 'Kode jurusan hanya boleh diisi huruf !',
        ]);

        try {
            $data = Jurusan::find($id);
            $data->kode = $request['kode-'.$id];
            $data->nama = $request['nama-'.$id];
            $data->save();

            return redirect()->route('jurusan')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('jurusan')->with('danger', 'Gagal menambahkan data !');
        }
    }
}
