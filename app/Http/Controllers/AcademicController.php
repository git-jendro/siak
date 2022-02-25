<?php

namespace App\Http\Controllers;

use App\TahunAkademik;
use Illuminate\Http\Request;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TahunAkademik::all();
        $semester = TahunAkademik::semester;

        return view('tahun-akademik.index', compact('data', 'semester'));
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
            'nama' => 'required|min:9|max:30',
            'semester' => 'required|in:1,2',
            'status' => 'required|in:0,1',
        ], [
            'nama.required' => 'Nama tahun akademik tidak boleh kosong !',
            'nama.min' => 'Nama tahun akademik minimal 9 karakter !',
            'nama.max' => 'Nama tahun akademik maximal 30 karakter !',
            'semester.required' => 'Semester tidak boleh kosong !',
            'semester.in' => 'Data tidak cocok !',
            'status.required' => 'Status tidak boleh kosong !',
            'status.in' => 'Data tidak cocok !',
        ]);
        try {
            if ($request->status == 1) {
                TahunAkademik::where('status', 1)->update(['status' => 0]);
            }

            $data = new TahunAkademik;
            $data->id = 'TAK' . sprintf('%02u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->semester = $request->semester;
            $data->status = $request->status;
            $data->save();

            return redirect()->route('tahun-akademik')->with('success', 'Berhasil menambahkan data tahun-akademik !');
        } catch (\Throwable $th) {
            return redirect()->route('tahun-akademik')->with('danger', 'Gagal menambahkan data !');
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
        // dd($request);
        $request->validate([
            'nama-' . $id => 'required|min:9|max:30',
            'semester-' . $id => 'required|in:1,2',
            'status-' . $id => 'required|in:0,1',
        ], [
            'nama-' . $id . '.required' => 'Nama tahun akademik tidak boleh kosong !',
            'nama-' . $id . '.min' => 'Nama tahun akademik minimal 9 karakter !',
            'nama-' . $id . '.max' => 'Nama tahun akademik maximal 30 karakter !',
            'semester-' . $id . '.required' => 'Semester tidak boleh kosong !',
            'semester-' . $id . '.in' => 'Data tidak cocok !',
            'status-' . $id . '.required' => 'Status tidak boleh kosong !',
            'status-' . $id . '.in' => 'Data tidak cocok !',
        ]);

        try {
            if ($request['status-' . $id] == 1) {
                TahunAkademik::where('status', 1)->update(['status' => 0]);
            }

            $data = TahunAkademik::find($id);
            $data->nama = $request['nama-' . $id];
            $data->semester = $request['semester-' . $id];
            $data->status = $request['status-' . $id];
            $data->save();

            return redirect()->route('tahun-akademik')->with('update', 'Berhasil mengubah data tahun-akademik !');
        } catch (\Throwable $th) {
            return redirect()->route('tahun-akademik')->with('danger', 'Gagal menambahkan data !');
        }
    }

    public function active($id)
    {
        $data = TahunAkademik::find($id);
        try {
            if ($data) {
                TahunAkademik::where('status', 1)->update(['status' => 0]);
            }
            $data->status = 1;
            $data->save();

            return redirect()->route('tahun-akademik')->with('update', 'Berhasil mengaktifkan data !');
        } catch (\Throwable $th) {
            return redirect()->route('tahun-akademik')->with('danger', 'Gagal mengaktifkan data !');
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
