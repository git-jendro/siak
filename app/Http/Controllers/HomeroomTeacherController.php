<?php

namespace App\Http\Controllers;

use App\Guru;
use App\RiwayatKelas;
use App\Walikelas;
use Illuminate\Http\Request;

class HomeroomTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Walikelas::all();
        $guru = Guru::all();
        $tahun = $this->tahun_akademik();

        return view('walikelas.index', compact('data', 'tahun', 'guru'));
    }

    public function modal_walikelas($guru_id)
    {
        try {
            $guru = Guru::find($guru_id);
            return response()->json($guru);
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = Walikelas::find($request->id);
            $count = Walikelas::where('guru_id', $request->guru_id)->count();
            $tahun = $this->tahun_akademik();
            if ($data->guru_id == $request->guru_id) {
                $data->guru_id = $request->guru_id;
                $data->save();
                $conn = RiwayatKelas::where([
                    ['kelas_id', '=', $data->kelas_id],
                    ['tahun_akademik_id', '=', $tahun->id],
                ])->first();
                if ($conn == null) {
                    $kelas = new RiwayatKelas;
                    $kelas->id = $this->generateUUID('RYK', 5);
                    $kelas->kelas_id = $data->kelas_id;
                    $kelas->guru_id = $data->guru_id;
                    $kelas->tahun_akademik_id = $tahun->id;
                    $kelas->save();
                } else {
                    $kelas = RiwayatKelas::find($conn->id);
                    $kelas->kelas_id = $data->kelas_id;
                    $kelas->guru_id = $data->guru_id;
                    $kelas->tahun_akademik_id = $tahun->id; 
                    $kelas->save();
                }
                
                return response()->json(200);
            } else if ($count < 1) {
                $data->guru_id = $request->guru_id;
                $data->save();
                $conn = RiwayatKelas::where([
                    ['kelas_id', '=', $data->kelas_id],
                    ['tahun_akademik_id', '=', $tahun->id],
                ])->first();
                if ($conn == null) {
                    $kelas = new RiwayatKelas;
                    $kelas->id = $this->generateUUID('RYK', 5);
                    $kelas->kelas_id = $data->kelas_id;
                    $kelas->guru_id = $data->guru_id;
                    $kelas->tahun_akademik_id = $tahun->id;
                    $kelas->save();
                } else {
                    $kelas = RiwayatKelas::find($conn->id);
                    $kelas->kelas_id = $data->kelas_id;
                    $kelas->guru_id = $data->guru_id;
                    $kelas->tahun_akademik_id = $tahun->id; 
                    $kelas->save();
                }
            } else {
                return response()->json(409);
            }
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }
}
