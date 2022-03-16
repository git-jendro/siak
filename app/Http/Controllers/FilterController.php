<?php

namespace App\Http\Controllers;

use App\Kelas;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    
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

}
