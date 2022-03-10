<?php

namespace App\Http\Controllers;

use App\Guru;
use App\JadwalPelajaran;
use App\JadwalPelajaranDetail;
use App\Jurusan;
use App\Kelas;
use App\Pelajaran;
use App\Ruangan;
use App\SubKelas;
use App\TahunAkademik;
use App\TingkatKelas;
use Illuminate\Http\Request;

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
        $pelajaran = Pelajaran::all();
        $tingkat = TingkatKelas::all();
        $jurusan = Jurusan::all();
        $sub = SubKelas::all();
        $ruangan = Ruangan::all();
        $guru = Guru::all();

        return view('jadwal-pelajaran.index', compact('data', 'pelajaran', 'tingkat', 'jurusan', 'sub', 'ruangan', 'guru'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kelas = Kelas::all();
        $tahun = $this->tahun_akademik();
        JadwalPelajaranDetail::truncate();
        JadwalPelajaran::truncate();
        foreach ($kelas as $kls) {
            $data = new JadwalPelajaran;
            $data->id = $this->generateUUID('JWP', 5);
            $data->kelas_id = $kls->id;
            $data->tahun_akademik_id = $tahun->id;
            $data->slug = $this->slug('Jadwal Pelajaran Kelas' . $kls->tingkat->nama . ' ' . $kls->jurusan->kode . ' ' . $kls->sub->nama . 'Tahun Akademik ' . $tahun->nama);
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
        try {
        } catch (\Throwable $th) {
            return redirect()->route('jadwal-pelajaran')->with('danger', 'Gagal menambahkan data !');
        }
    }
}
