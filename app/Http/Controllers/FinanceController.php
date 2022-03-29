<?php

namespace App\Http\Controllers;

use App\DetailPembayaran;
use App\Jurusan;
use App\Kelas;
use App\Pembayaran;
use App\TingkatKelas;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembayaran::all();
        $jurusan = Jurusan::all();

        return view('pembayaran.index', compact('data', 'jurusan'));
    }

    public function detail_pembayaran()
    {
        $data = DetailPembayaran::all();
        $jurusan = Jurusan::all();
        return view('pembayaran.detail-pembayaran', compact('data', 'jurusan'));
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
            'jurusan_id' => 'required|exists:tbl_jurusan, id',
            'keterangan' => 'required|min:6|max:1000',
            'nominal' => 'required|regex:^[\.0-9]*$|min:',
        ], [
            'nama.required' => 'Nama tidak boleh kosong !',
            'nama.exists' => 'Data tidak cocok !',
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
