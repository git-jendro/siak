<?php

namespace App\Http\Controllers;

use App\Kurikulum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kurikulum::all();

        return view('kurikulum.index', compact('data'));
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
            'nama' => 'required|min:3|max:30',
        ], [
            'nama.required' => 'Nama kurikulum tidak boleh kosong !',
            'nama.min' => 'Nama kurikulum minimal 3 karakter !',
            'nama.max' => 'Nama kurikulum maximal 30 karakter !',
        ]);

        $data = new Kurikulum;
        $data->id = 'KRK' . sprintf('%02u', $data->count() + 1);
        $data->nama = $request->nama;
        $data->save();
        try {

            return redirect()->route('kurikulum')->with('success', 'Berhasil menambahkan data '. $request->nama .' !');
        } catch (\Throwable $th) {
            return redirect()->route('kurikulum')->with('danger', 'Gagal menambahkan data !');
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
            'nama-'.$id => 'required|min:3|max:30',
        ], [
            'nama-'. $id .'.required' => 'Nama kurikulum tidak boleh kosong !',
            'nama-'. $id .'.min' => 'Nama kurikulum minimal 3 karakter !',
            'nama-'. $id .'.max' => 'Nama kurikulum maximal 30 karakter !',
        ]);

        try {
            $data = Kurikulum::find($id);
            $data->tingkat_kelas_id = $request['nama-' . $id];
            $data->save();

            return redirect()->route('kurikulum')->with('update', 'Berhasil mengubah data ' . $request['nama-'.$id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('kurikulum')->with('danger', 'Gagal menambahkan data !');
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
        //
    }
}
