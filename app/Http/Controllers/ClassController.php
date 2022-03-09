<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Kelas;
use App\RiwayatKelas;
use App\SubKelas;
use App\TingkatKelas;
use App\Walikelas;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::all();
        $tingkat = TingkatKelas::all();
        $sub = SubKelas::all();
        $jurusan = Jurusan::all();

        return view('kelas.index', compact('data', 'tingkat', 'sub', 'jurusan'));
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
            'tingkat_kelas_id' => 'required|exists:tbl_tingkat_kelas,id',
            'sub_kelas_id' => 'required|exists:tbl_sub_kelas,id',
            'jurusan_id' => 'required|exists:tbl_jurusan,id',
        ], [
            'tingkat_kelas_id.required' => 'Tingkat kelas tidak boleh kosong !',
            'tingkat_kelas_id.exists' => 'Data tingkatan tidak ada !',
            'sub_kelas_id.required' => 'Sub kelas tidak boleh kosong !',
            'sub_kelas_id.exists' => 'Data sub kelas tidak ada !',
            'jurusan_id.required' => 'Jurusan tidak boleh kosong !',
            'jurusan_id.exists' => 'Data jurusan tidak ada !',
        ]);

        try {
            $data = new Kelas;
            $data->id = 'KLS' . sprintf('%03u', $data->count() + 1);
            $data->tingkat_kelas_id = $request->tingkat_kelas_id;
            $data->sub_kelas_id = $request->sub_kelas_id;
            $data->jurusan_id = $request->jurusan_id;
            $data->save();
            $wakel = new Walikelas;
            $wakel->id = $this->generateUUID('WKL', 2);
            $wakel->kelas_id = $data->id;
            $wakel->save();
            $tahun = $this->tahun_akademik();
            $conn = RiwayatKelas::where([
                ['kelas_id', '=', $data->id],
                ['tahun_akademik_id', '=', $tahun->id],
            ])->first();
            if ($conn == null) {
                $kelas = new RiwayatKelas;
                $kelas->id = $this->generateUUID('RYK', 5);
                $kelas->kelas_id = $data->id;
                $kelas->tahun_akademik_id = $tahun->id;
                $kelas->save();
            }

            return redirect()->route('kelas')->with('success', 'Berhasil menambahkan data kelas !');
        } catch (\Throwable $th) {
            return redirect()->route('kelas')->with('danger', 'Gagal menambahkan data !');
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
            'tingkat_kelas_id-' . $id => 'required|exists:tbl_tingkat_kelas,id',
            'sub_kelas_id-' . $id => 'required|exists:tbl_sub_kelas,id',
            'jurusan_id-' . $id => 'required|exists:tbl_jurusan,id',
        ], [
            'tingkat_kelas_id-' . $id . '.required' => 'Tingkat kelas tidak boleh kosong !',
            'tingkat_kelas_id-' . $id . '.exists' => 'Data tingkatan tidak ada !',
            'sub_kelas_id-' . $id . '.required' => 'Sub kelas tidak boleh kosong !',
            'sub_kelas_id-' . $id . '.exists' => 'Data sub kelas tidak ada !',
            'jurusan_id-' . $id . '.required' => 'Jurusan tidak boleh kosong !',
            'jurusan_id-' . $id . '.exists' => 'Data jurusan tidak ada !',
        ]);

        try {
            $data = Kelas::find($id);
            $data->tingkat_kelas_id = $request['tingkat_kelas_id-' . $id];
            $data->sub_kelas_id = $request['sub_kelas_id-' . $id];
            $data->jurusan_id = $request['jurusan_id-' . $id];
            $data->save();
            $tahun = $this->tahun_akademik();
            $wakel = new Walikelas;
            $wakel->id = $this->generateUUID('WKL', 2);
            $wakel->kelas_id = $data->id;
            $wakel->save();
            $conn = RiwayatKelas::where([
                ['kelas_id', '=', $data->id],
                ['tahun_akademik_id', '=', $tahun->id],
            ])->first();
            $kelas = RiwayatKelas::find($conn->id);
            $kelas->kelas_id = $data->id;
            if ($tahun->id != null) {
                $kelas->tahun_akademik_id = $tahun->id;
            }
            $kelas->save();

            return redirect()->route('kelas')->with('update', 'Berhasil mengubah data kelas !');
        } catch (\Throwable $th) {
            return redirect()->route('kelas')->with('danger', 'Gagal menambahkan data !');
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
