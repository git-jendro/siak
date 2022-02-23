<?php

namespace App\Http\Controllers;

use App\Pelajaran;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelajaran::all();

        return view('pelajaran.index', compact('data'));
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
            'kkm' => 'required|numeric|digits:2',
        ], [
            'nama.required' => 'Nama pelajaran tidak boleh kosong !',
            'nama.min' => 'Nama pelajaran minimal 5 karakter !',
            'nama.max' => 'Nama pelajaran maximal 50 karakter !',
            'nama.regex' => 'Nama pelajaran hanya boleh diisi dengan huruf dan spasi !',
            'kkm.required' => 'KKM tidak boleh kosong !',
            'kkm.numeric' => 'KKM hanya boleh diisi angka !',
            'kkm.digits' => 'KKM hanya boleh diisi 2 angka !',
        ]);

        try {
            $data = new Pelajaran;
            $data->id = 'MPJ' . sprintf('%03u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->kkm = $request->kkm;
            $data->slug = $this->slug($request->nama);
            $data->save();

            return redirect()->route('pelajaran')->with('success', 'Berhasil menambahkan pelajaran ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('pelajaran')->with('danger', 'Gagal menambahkan pelajaran !');
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
            'kkm-'.$id => 'required|numeric|digits:2',
        ], [
            'nama-'.$id.'.required' => 'Nama pelajaran tidak boleh kosong !',
            'nama-'.$id.'.min' => 'Nama pelajaran minimal 5 karakter !',
            'nama-'.$id.'.max' => 'Nama pelajaran maximal 50 karakter !',
            'nama-'.$id.'.regex' => 'Nama pelajaran hanya boleh diisi dengan huruf dan spasi !',
            'kkm-'.$id.'.required' => 'KKM tidak boleh kosong !',
            'kkm-'.$id.'.numeric' => 'KKM hanya boleh diisi angka !',
            'kkm-'.$id.'.digits' => 'KKM hanya boleh diisi 2 angka !',
        ]);

        try {
            $data = Pelajaran::find($id);
            $data->nama = $request['nama-'.$id];
            $data->kkm = $request['kkm-'.$id];
            $data->slug = $this->slug($request['nama-'.$id]);
            $data->save();

            return redirect()->route('pelajaran')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('pelajaran')->with('danger', 'Gagal menambahkan data !');
        }
    }

}
