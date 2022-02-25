<?php

namespace App\Http\Controllers;

use App\DetailKurikulum;
use App\Kurikulum;
use App\Pelajaran;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

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

        try {
            $data = new Kurikulum;
            $data->id = 'KRK' . sprintf('%02u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->slug = $this->slug($request->nama);
            $data->save();

            return redirect()->route('kurikulum')->with('success', 'Berhasil menambahkan data ' . $request->nama . ' !');
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
            'nama-' . $id => 'required|min:3|max:30',
        ], [
            'nama-' . $id . '.required' => 'Nama kurikulum tidak boleh kosong !',
            'nama-' . $id . '.min' => 'Nama kurikulum minimal 3 karakter !',
            'nama-' . $id . '.max' => 'Nama kurikulum maximal 30 karakter !',
        ]);

        try {
            $data = Kurikulum::find($id);
            $data->nama = $request['nama-' . $id];
            $data->slug = $this->slug($request['nama-' . $id]);
            $data->save();

            return redirect()->route('kurikulum')->with('update', 'Berhasil mengubah data ' . $request['nama-' . $id] . ' !');
        } catch (\Throwable $th) {
            return redirect()->route('kurikulum')->with('danger', 'Gagal menambahkan data !');
        }
    }

    public function pelajaran($slug)
    {
        try {
            $data = Kurikulum::where('slug', $slug)->first();
            $pelajaran = Pelajaran::all();
            $detail = DetailKurikulum::where('kurikulum_id', $data->id)->get();

            return view('kurikulum.detail', compact('data', 'pelajaran', 'detail'));
        } catch (\Throwable $th) {
            return redirect()->route('kurikulum')->with('danger', 'Gagal menambahkan data !');
        }
    }

    public function add_pelajaran(Request $request)
    {
        try {
            $data = new DetailKurikulum;
            $data->id = Uuid::uuid4()->toString();
            $data->kurikulum_id = $request->kurikulum_id;
            $data->pelajaran_id = $request->pelajaran_id;
            $data->save();

            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('fail');
        }
    }

    public function remove_pelajaran(Request $request)
    {
        try {
            DetailKurikulum::where([
                ['kurikulum_id', $request->kurikulum_id],
                ['pelajaran_id', $request->pelajaran_id],
            ])->delete();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('fail');
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
