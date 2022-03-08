<?php

namespace App\Http\Controllers;

use App\Guru;
use App\Kelas;
use App\TahunAkademik;
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
        $tahun = TahunAkademik::where('status', 1)->first();

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
            if ($count < 1) {
                $data->guru_id = $request->guru_id;
                $data->save();
                return response()->json(200);
            } else {
                return response()->json(409);
            }
        } catch (\Throwable $th) {
            return response()->json(409);
        }
    }

}
