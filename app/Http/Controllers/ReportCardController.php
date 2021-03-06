<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\KategoriPelajaran;
use App\Kelas;
use App\Siswa;
use App\TingkatKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = $this->tahun_akademik();
        if (Auth::user()->guru) {
            $data = Kelas::where('id', Auth::user()->guru->walikelas->kelas_id)->first();
        } else if (Auth::user()->staff->jabatan->previlege == 1) {
            $data = Kelas::first();
        }
        $tingkat = TingkatKelas::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();

        return view('rapot.index', compact('data', 'tahun', 'tingkat', 'jurusan', 'kelas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $data = Siswa::where('slug', $slug)->first();
            $category = KategoriPelajaran::all();

            return view('rapot.detail', compact('data', 'category'));
        } catch (\Throwable $th) {
            return abort(404); 
        }
    }

    public function download($slug)
    {
        try {
            $tahun = $this->tahun_akademik();
            $data = Siswa::where('slug', $slug)->first();
            $category = KategoriPelajaran::all();

            return view('rapot.preview', compact('data', 'category', 'tahun'));
        } catch (\Throwable $th) {
            return abort(404); 
        }
    }

}
