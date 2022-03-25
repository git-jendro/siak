<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Kelas;
use App\RiwayatKelas;
use App\TahunAkademik;
use App\TingkatKelas;
use Illuminate\Http\Request;

class ClassHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_now = $this->tahun_akademik();
        $data = RiwayatKelas::where('tahun_akademik_id', $tahun_now->id)->get();
        $tahun = TahunAkademik::all();
        $tingkat = TingkatKelas::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();

        return view('riwayat.index', compact('data', 'tahun', 'tingkat', 'jurusan', 'kelas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data = RiwayatKelas::where('slug', $slug)->first();

        return view('riwayat.detail', compact('data'));
    }

    public function filter_tahun(Request $request)
    {
        if ($request->kelas_id) {
            $data = RiwayatKelas::where([
                ['kelas_id', $request->kelas_id],
                ['tahun_akademik_id', $request->tahun],
            ])->with('tahun', 'guru', 'kelas.tingkat', 'kelas.jurusan', 'kelas.sub')->get();
        } else {
            $data = RiwayatKelas::where('tahun_akademik_id', $request->tahun)->with('tahun', 'guru', 'kelas.tingkat', 'kelas.jurusan', 'kelas.sub')->get();
        }
        return response()->json($data);
        try {
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

    public function filter_kelas(Request $request)
    {
        if ($request->tahun) {
            $data = RiwayatKelas::where([
                ['kelas_id', $request->kelas_id],
                ['tahun_akademik_id', $request->tahun],
            ])->with('tahun', 'guru', 'kelas.tingkat', 'kelas.jurusan', 'kelas.sub')->get();
        } else {
            $data = RiwayatKelas::where('kelas_id', $request->kelas_id)->with('tahun', 'guru', 'kelas.tingkat', 'kelas.jurusan', 'kelas.sub')->get();
        }
        return response()->json($data);
        try {
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }
}
