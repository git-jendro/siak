<?php

namespace App\Http\Controllers;

use App\KategoriPelajaran;
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
        $category = KategoriPelajaran::all();

        return view('pelajaran.index', compact('data', 'category'));
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
            'nama' => 'required|min:5|max:50|regex:/^[&a-zA-Z ]*$/',
            'kkm' => 'required|numeric|digits:2',
            'kategori_id' => 'required|exists:tbl_kategori_pelajaran,id',
        ], [
            'nama.required' => 'Nama pelajaran tidak boleh kosong !',
            'nama.min' => 'Nama pelajaran minimal 5 karakter !',
            'nama.max' => 'Nama pelajaran maximal 50 karakter !',
            'nama.regex' => 'Nama pelajaran hanya boleh diisi dengan huruf dan spasi !',
            'kkm.required' => 'KKM tidak boleh kosong !',
            'kkm.numeric' => 'KKM hanya boleh diisi angka !',
            'kkm.digits' => 'KKM hanya boleh diisi 2 angka !',
            'kategori_id.required' => 'Kategori tidak boleh kosong !',
            'kategori_id.exists' => 'Data tidak cocok !',
        ]);

        try {
            $data = new Pelajaran;
            $data->id = 'MPJ' . sprintf('%03u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->kkm = $request->kkm;
            $data->kategori_id = $request->kategori_id;
            $data->slug = $this->slug($request->nama);
            $data->save();

            return redirect()->route('pelajaran')->with('success', 'Berhasil menambahkan data ' . $request->nama . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('pelajaran')->with('danger', 'Gagal menambahkan data !');
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
            'nama-'.$id => 'required|min:5|max:50|regex:/^[&a-zA-Z ]*$/',
            'kkm-'.$id => 'required|numeric|digits:2',
            'kategori_id-'.$id => 'required|exists:tbl_kategori_pelajaran,id',
        ], [
            'nama-'.$id.'.required' => 'Nama pelajaran tidak boleh kosong !',
            'nama-'.$id.'.min' => 'Nama pelajaran minimal 5 karakter !',
            'nama-'.$id.'.max' => 'Nama pelajaran maximal 50 karakter !',
            'nama-'.$id.'.regex' => 'Nama pelajaran hanya boleh diisi dengan huruf dan spasi !',
            'kkm-'.$id.'.required' => 'KKM tidak boleh kosong !',
            'kkm-'.$id.'.numeric' => 'KKM hanya boleh diisi angka !',
            'kkm-'.$id.'.digits' => 'KKM hanya boleh diisi 2 angka !',
            'kategori_id-'.$id.'.required' => 'Kategori tidak boleh kosong !',
            'kategori_id-'.$id.'.exists' => 'Data tidak cocok !',
        ]);

        try {
            $data = Pelajaran::find($id);
            $data->nama = $request['nama-'.$id];
            $data->kkm = $request['kkm-'.$id];
            $data->kategori_id = $request['kategori_id-'.$id];
            $data->slug = $this->slug($request['nama-'.$id]);
            $data->save();

            return redirect()->route('pelajaran')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('pelajaran')->with('danger', 'Gagal menambahkan data !');
        }
    }

}
