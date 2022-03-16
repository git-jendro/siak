<?php

namespace App\Http\Controllers;

use App\Guru;
use App\JadwalPelajaran;
use App\JadwalPelajaranDetail;
use App\Jurusan;
use App\Kelas;
use App\Pelajaran;
use App\Ruangan;
use App\TingkatKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JadwalPelajaran::orderBy('created_at', 'asc')->with('detail')->first();
        $tingkat = TingkatKelas::all();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $pelajaran = Pelajaran::all();
        $ruangan = Ruangan::all();
        $guru = Guru::all();
        $hari = JadwalPelajaranDetail::HARI;
        $jam = JadwalPelajaranDetail::JAM;

        return view('jadwal-pelajaran.index', compact('data', 'pelajaran', 'tingkat', 'jurusan', 'kelas', 'ruangan', 'guru', 'hari', 'jam'));
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
            $kelas = Kelas::all();
            $tahun = $this->tahun_akademik();
            JadwalPelajaranDetail::truncate();
            JadwalPelajaran::truncate();
            $before = Str::of($tahun->nama)->before('/');
            $after = Str::after($tahun->nama, '/');
            foreach ($kelas as $kls) {
                $data = new JadwalPelajaran;
                $data->id = $this->generateUUID('JWP', 5);
                $data->kelas_id = $kls->id;
                $data->tahun_akademik_id = $tahun->id;
                $data->slug = $this->slug('Jadwal Pelajaran Kelas ' . $kls->tingkat->nama . ' ' . $kls->jurusan->kode . ' ' . $kls->sub->nama . ' Tahun Akademik ' . $before . ' ' . $after);
                foreach ($kls->tingkat->kurikulum->kurikulum_detail as $pelajaran) {
                    $detail = new JadwalPelajaranDetail;
                    $detail->id = $this->generateUUID('DJW', 6);
                    $detail->jadwal_pelajaran_id = $data->id;
                    $detail->pelajaran_id = $pelajaran->pelajaran_id;
                    $detail->save();
                }
                $data->save();
            }
            return redirect()->route('jadwal-pelajaran')->with('success', 'Berhasil menambahkan data !');
        } catch (\Throwable $th) {
            return redirect()->route('jadwal-pelajaran')->with('danger', 'Gagal menambahkan data !');
        }
    }

    public function filter_kelas($tingkat_id, $jurusan_id)
    {
        try {
            $data = Kelas::where([
                ['tingkat_kelas_id', $tingkat_id],
                ['jurusan_id', $jurusan_id],
            ])->with('tingkat', 'jurusan', 'sub',)->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

    public function filter_tingkat($tingkat_id)
    {
        try {
            $data = Kelas::where('tingkat_kelas_id', $tingkat_id)->with('tingkat', 'jurusan', 'sub',)->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

    public function filter_jurusan($jurusan_id)
    {
        try {
            $data = Kelas::where('jurusan_id', $jurusan_id)->with('tingkat', 'jurusan', 'sub',)->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

    public function filter_jadwal($kelas_id)
    {
        try {
            $conn = JadwalPelajaran::selecT('id')->where('kelas_id', $kelas_id);
            $data = JadwalPelajaranDetail::whereHas('jadwal', function ($q) use ($conn) {
                $q->whereIn('jadwal_pelajaran_id', $conn);
            })->with('pelajaran', 'guru', 'ruangan')->get();
            $ruangan = Ruangan::all();
            $guru = Guru::all();
            $hari = JadwalPelajaranDetail::HARI;
            $mulai = JadwalPelajaranDetail::JAM;
            $selesai = JadwalPelajaranDetail::JAM;
            $kelas = Kelas::where('id', $kelas_id)->with('tingkat', 'jurusan', 'sub')->first();
            return response()->json([
                'data' => $data,
                'ruangan' => $ruangan,
                'guru' => $guru,
                'hari' => $hari,
                'mulai' => $mulai,
                'selesai' => $selesai,
                'kelas' => $kelas,
            ]);
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

    public function check_ruangan($ruangan_id, $hari, $mulai)
    {
        $con1 = JadwalPelajaranDetail::where([
            ['ruangan_id', $ruangan_id],
            ['hari', $hari],
            ['mulai', $mulai]
        ])->count();
        $con2 = JadwalPelajaranDetail::where([
            ['ruangan_id', $ruangan_id],
            ['hari', $hari],
            ['mulai', '<', $mulai],
            ['selesai', '>', $mulai],
        ])->count();
        if ($con1 >= 1) {
            return response()->json(false);
        } else if ($con2 >= 1) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function check_guru($guru_id, $hari, $mulai)
    {
        $con1 = JadwalPelajaranDetail::where([
            ['guru_id', $guru_id],
            ['hari', $hari],
            ['mulai', $mulai]
        ])->count();
        $con2 = JadwalPelajaranDetail::where([
            ['guru_id', $guru_id],
            ['hari', $hari],
            ['mulai', '<', $mulai],
            ['selesai', '>', $mulai],
        ])->count();
        if ($con1 >= 1) {
            return response()->json(false);
        } else if ($con2 >= 1) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function check_both($ruangan_id, $guru_id, $hari, $mulai)
    {
        $con1 = JadwalPelajaranDetail::where([
            ['ruangan_id', $ruangan_id],
            ['guru_id', $guru_id],
            ['hari', $hari],
            ['mulai', $mulai]
        ])->count();
        $con2 = JadwalPelajaranDetail::where([
            ['ruangan_id', $ruangan_id],
            ['guru_id', $guru_id],
            ['hari', $hari],
            ['mulai', '<', $mulai],
            ['mulai', '<', $mulai],
            ['selesai', '>', $mulai],
        ])->count();
        $conr1 = JadwalPelajaranDetail::where([
            ['ruangan_id', $ruangan_id],
            ['hari', $hari],
            ['mulai', $mulai]
        ])->count();
        $conr2 = JadwalPelajaranDetail::where([
            ['ruangan_id', $ruangan_id],
            ['hari', $hari],
            ['mulai', '<', $mulai],
            ['selesai', '>', $mulai],
        ])->count();
        $cong1 = JadwalPelajaranDetail::where([
            ['guru_id', $guru_id],
            ['hari', $hari],
            ['mulai', $mulai]
        ])->count();
        $cong2 = JadwalPelajaranDetail::where([
            ['guru_id', $guru_id],
            ['hari', $hari],
            ['mulai', '<', $mulai],
            ['selesai', '>', $mulai],
        ])->count();
        $conh1 = JadwalPelajaranDetail::where([
            ['hari', $hari],
            ['mulai', $mulai]
        ])->count();
        $conh2 = JadwalPelajaranDetail::where([
            ['hari', $hari],
            ['mulai', '<', $mulai],
            ['selesai', '>', $mulai],
        ])->count();
        if ($con1 >= 1) {
            return response()->json(false);
        } else if ($con2 >= 1) {
            return response()->json(false);
        } else if ($conr1 >= 1) {
            return response()->json('ruangan');
        } else if ($conr2 >= 1) {
            return response()->json('ruangan');
        } else if ($cong1 >= 1) {
            return response()->json('guru');
        } else if ($cong2 >= 1) {
            return response()->json('guru');
        } else if ($conh1 >= 1) {
            return response()->json('hari');
        } else if ($conh2 >= 1) {
            return response()->json('hari');
        } else {
            return response()->json(true);
        }
    }

    public function store_jadwal(Request $request)
    {
        // $con1 = JadwalPelajaranDetail::where([
        //     ['ruangan_id', $request->ruangan],
        //     ['hari', $request->hari],
        //     ['mulai', $request->start],
        // ])->count();
        // $con2 = JadwalPelajaranDetail::where([
        //     ['ruangan_id', $request->ruangan],
        //     ['hari', $request->hari],
        //     ['selesai', '>=', $request->start],
        // ])->count();
        // $con3 = JadwalPelajaranDetail::where([
        //     ['guru_id', $request->guru],
        //     ['hari', $request->hari],
        //     ['mulai', $request->start],
        // ])->count();
        // $con4 = JadwalPelajaranDetail::where([
        //     ['guru_id', $request->guru],
        //     ['hari', $request->hari],
        //     ['selesai', '>=', $request->start],
        // ])->count();
        // $con5 = JadwalPelajaranDetail::where([
        //     ['hari', $request->hari],
        //     ['mulai', $request->start],
        // ])->count();
        // if ($con1 >= 1) {
        //     return response()->json('ruangan');
        // } else if ($con2 >= 1) {
        //     return response()->json('guru');
        // } else if ($con3 >= 1) {
        //     return response()->json('hari');
        // } else {
        $jadwal = JadwalPelajaranDetail::find($request->id);
        $jadwal->guru_id = $request->guru;
        $jadwal->ruangan_id = $request->ruangan;
        $jadwal->hari = $request->hari;
        $jadwal->mulai = $request->start;
        $jadwal->selesai = $request->end;
        $jadwal->save();
        return response()->json(200);
        // }
    }

    public function download($slug)
    {
        try {
            $hari = JadwalPelajaranDetail::HARI;
            $jadwal = JadwalPelajaran::where('slug', $slug)->first();
            $data = JadwalPelajaranDetail::where('jadwal_pelajaran_id', $jadwal->id)->orderBy('hari', 'asc')->orderBy('mulai', 'asc')->get();
            return view('jadwal-pelajaran.preview', compact('jadwal', 'data', 'hari'));
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
