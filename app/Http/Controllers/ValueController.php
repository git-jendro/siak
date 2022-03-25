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
        $tahun = $this->tahun_akademik();
        $kelas = Kelas::all();
        $before = Str::of($tahun->nama)->before('/');
        $after = Str::after($tahun->nama, '/');
        $con = Nilai::select('id')->where('tahun_akademik_id', $tahun->id);
        $count = DetailNilai::whereHas('nilai', function ($q) use ($con) {
            $q->whereIn('nilai_id', $con);
        })->count();
        if ($count >= 1) {
            DetailNilai::truncate();
            Nilai::truncate();
        }
        foreach ($kelas as $kls) {
            $nilai = new Nilai;
            $nilai->id = 'NIL' . sprintf('%05u', $nilai->count() + 1);
            $nilai->kelas_id = $kls->id;
            $nilai->tahun_akademik_id = $tahun->id;
            $nilai->slug = $this->slug('Nilai Kelas ' . $kls->tingkat->nama . ' ' . $kls->jurusan->kode . ' ' . $kls->sub->nama . ' Tahun Akademik ' . $before . ' ' . $after);
            $siswa = Siswa::where('kelas_id', $kls->id)->get();
            foreach ($siswa as $sis) {
                foreach ($kls->tingkat->kurikulum->kurikulum_detail as $pel) {
                    $d_nilai = new DetailNilai;
                    $d_nilai->id = Uuid::uuid4()->toString();
                    $d_nilai->siswa_id = $sis->id;
                    $d_nilai->nilai_id = $nilai->id;
                    $d_nilai->pelajaran_id = $pel->pelajaran_id;
                    $d_nilai->save();
                }
            }
            $nilai->save();
        }
        return redirect()->route('nilai')->with('success', 'Berhasil menambahkan data !');
        try {
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

    public function filter_kelas($kelas_id)
    {
        try {
            $tahun = $this->tahun_akademik();
            $data = Siswa::where('kelas_id', $kelas_id)->get();
            return response()->json([
                'data' => $data,
                'tahun' => $tahun,
            ]);
        } catch (\Throwable $th) {
            return response()->json(404);
        }
    }

    public function store_tugas1(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->tugas_1 = $request->nilai;
            $data->save();
            return response()->json([
                'message' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }

    public function store_tugas2(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->tugas_2 = $request->nilai;
            $data->save();
            return response()->json([
                'message' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }

    public function store_tugas3(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->tugas_3 = $request->nilai;
            $data->save();
            return response()->json([
                'message' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }

    public function store_tugas4(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->tugas_4 = $request->nilai;
            $data->save();
            return response()->json([
                'message' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }

    public function store_tugas5(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->tugas_5 = $request->nilai;
            $data->save();
            return response()->json([
                'message' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }

    public function store_uts(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->uts = $request->nilai;
            $data->save();
            return response()->json([
                'message' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }

    public function store_uas(Request $request)
    {
        try {
            $data = DetailNilai::find($request->id);
            $data->uas = $request->nilai;
            $sum = collect([$data->tugas_1, $data->tugas_2, $data->tugas_3, $data->tugas_4, $data->tugas_5, $data->uts, $data->uas]);
            $total = $sum->average();
            $data->nilai = number_format((float)$total, 0, '.', '');

            if ($data->nilai >= 95) {
                $data->grade = 'A+';
            } elseif ($data->nilai >= 90) {
                $data->grade = 'A';
            } elseif ($data->nilai >= 85) {
                $data->grade = 'A-';
            } elseif ($data->nilai >= 80) {
                $data->grade = 'B+';
            } elseif ($data->nilai >= 75) {
                $data->grade = 'B';
            } elseif ($data->nilai >= 70) {
                $data->grade = 'B-';
            } elseif ($data->nilai >= 65) {
                $data->grade = 'C+';
            } elseif ($data->nilai >= 60) {
                $data->grade = 'C';
            } elseif ($data->nilai >= 55) {
                $data->grade = 'C-';
            } elseif ($data->nilai >= 50) {
                $data->grade = 'D';
            } else {
                $data->grade = 'E';
            }

            // if ($data->nilai >= 80) {
            //     $data->grade = 'A';
            // } elseif ($data->nilai >= 70) {
            //     $data->grade = 'B';
            // } elseif ($data->nilai >= 50) {
            //     $data->grade = 'C';
            // } elseif ($data->nilai >= 40) {
            //     $data->grade = 'D';
            // } else {
            //     $data->grade = 'E';
            // }

            if ($data->nilai >= $data->pelajaran->kkm) {
                $data->status = 'Lulus';
            }
            $data->save();

            return response()->json([
                'message' => 200,
                'nilai' => $data->nilai,
                'grade' => $data->grade,
                'status' => $data->status,
            ]);
        } catch (\Throwable $th) {
            return response()->json(419);
        }
    }
}
