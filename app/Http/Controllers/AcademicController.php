<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\RiwayatKelas;
use App\RiwayatKelasSiswa;
use App\Siswa;
use App\TahunAkademik;
use App\Walikelas;
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
        ], [
            'nama.required' => 'Nama tahun akademik tidak boleh kosong !',
            'nama.min' => 'Nama tahun akademik minimal 9 karakter !',
            'nama.max' => 'Nama tahun akademik maximal 30 karakter !',
            'semester.required' => 'Semester tidak boleh kosong !',
            'semester.in' => 'Data tidak cocok !',
        ]);
        try {

            $data = new TahunAkademik;
            $data->id = 'TAK' . sprintf('%02u', $data->count() + 1);
            $data->nama = $request->nama;
            $data->semester = $request->semester;
            $count = TahunAkademik::where('status', 1)->count();
            $data->status = 0;
            $data->save();
            return redirect()->route('tahun-akademik')->with('success', 'Berhasil menambahkan data !');
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
        ], [
            'nama-' . $id . '.required' => 'Nama tahun akademik tidak boleh kosong !',
            'nama-' . $id . '.min' => 'Nama tahun akademik minimal 9 karakter !',
            'nama-' . $id . '.max' => 'Nama tahun akademik maximal 30 karakter !',
            'semester-' . $id . '.required' => 'Semester tidak boleh kosong !',
            'semester-' . $id . '.in' => 'Data tidak cocok !',
        ]);

        try {
            $data = TahunAkademik::find($id);
            $data->nama = $request['nama-' . $id];
            $data->semester = $request['semester-' . $id];
            $data->save();

            return redirect()->route('tahun-akademik')->with('update', 'Berhasil mengubah data !');
        } catch (\Throwable $th) {
            return redirect()->route('tahun-akademik')->with('danger', 'Gagal menambahkan data !');
        }
    }

    public function active($id)
    {
        $data = TahunAkademik::find($id);
        if ($data) {
            TahunAkademik::where('status', 1)->update(['status' => 0]);
        }
        $data->status = 1;
        $data->save();
        $conn = RiwayatKelas::where('tahun_akademik_id', $id)->count();
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        if ($conn < 1) {
            if ($kelas != null) {
                Walikelas::truncate();
                foreach ($kelas as $kls) {
                    $wakel = new Walikelas;
                    $wakel->id = $this->generateUUID('WKL', 2);
                    $wakel->kelas_id = $kls->id;
                    $wakel->save();
                    $kelas = new RiwayatKelas;
                    $kelas->id = $this->generateUUID('RYK', 5);
                    $kelas->kelas_id = $kls->id;
                    $kelas->tahun_akademik_id = $id;
                    $kelas->save();
                    $rkelas = RiwayatKelas::where('tahun_akademik_id', $id)->first();
                    foreach ($siswa as $sis) {
                        $conn2 = RiwayatKelasSiswa::where([
                            ['riwayat_kelas_id', $rkelas->id],
                            ['siswa_id', $sis->id],
                        ])->first();
                        if ($conn2 == null) {
                            $rsiswa = new RiwayatKelasSiswa;
                            $rsiswa->id = $this->generateUUID('RKS', 7);
                            $rsiswa->riwayat_kelas_id = $kelas->id;
                            $rsiswa->siswa_id = $sis->id;
                            $rsiswa->save();
                        }
                    }
                }
            }
        }

        return redirect()->route('tahun-akademik')->with('update', 'Berhasil mengaktifkan data !');
        try {
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
