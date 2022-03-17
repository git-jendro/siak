<?php

namespace App\Http\Controllers;

use App\DetailNilai;
use App\Jurusan;
use App\Kelas;
use App\Nilai;
use App\Pelajaran;
use App\Siswa;
use App\TingkatKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class ValueController extends Controller
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

        return view('nilai.index', compact('data', 'tahun', 'tingkat', 'jurusan', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $tahun = $this->tahun_akademik();
            $kelas = Kelas::all();
            $before = Str::of($tahun->nama)->before('/');
            $after = Str::after($tahun->nama, '/');
            $pelajaran = Pelajaran::all();
            $con = Nilai::select('id')->where('tahun_akademik_id', $tahun->id);
            $count = DetailNilai::whereHas('nilai', function ($q) use ($con) {
                $q->whereIn('nilai_id', $con);
            })->count();
            if ($count >= 1) {
                Nilai::turncate();
                DetailNilai::turncate();
            }
            foreach ($kelas as $kls) {
                $nilai = new Nilai;
                $nilai->id = 'NIL' . sprintf('%05u', $nilai->count() + 1);
                $nilai->kelas_id = $kls->id;
                $nilai->tahun_akademik_id = $tahun->id;
                $nilai->slug = $this->slug('Nilai Kelas ' . $kls->tingkat->nama . ' ' . $kls->jurusan->kode . ' ' . $kls->sub->nama . ' Tahun Akademik ' . $before . ' ' . $after);
                $siswa = Siswa::where('kelas_id', $kls->id)->get();
                foreach ($siswa as $sis) {
                    foreach ($pelajaran as $pel) {
                        $d_nilai = new DetailNilai;
                        $d_nilai->id = Uuid::uuid4()->toString();
                        $d_nilai->siswa_id = $sis->id;
                        $d_nilai->nilai_id = $nilai->id;
                        $d_nilai->pelajaran_id = $pel->id;
                        $d_nilai->save();
                    }
                }
                $nilai->save();
            }
            return redirect()->route('nilai')->with('success', 'Berhasil menambahkan data !');
        } catch (\Throwable $th) {
            return redirect()->route('nilai')->with('danger', 'Gagal mengubah data !');
        }
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

            return view('nilai.detail', compact('data'));
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
