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
            'nama-' . $id => 'required|min:3|max:100|regex:/^[\.a-zA-Z, ]*$/',
            'agama_id-' . $id => 'required|exists:tbl_agama,id',
            'jenis_kelamin-' . $id => 'required|in:L,P',
            'status-' . $id => 'required|in:0,1,2',
            'tempat_lahir-' . $id => 'required|min:3|max:30|regex:/^[a-zA-Z ]*$/',
            'tanggal_lahir-' . $id => 'required|date_format:d-m-Y',
            'alamat-' . $id => 'required|min:5|max:1000',
            'kelas_id-' . $id => 'required|exists:tbl_kelas,id',
            'no_telp-' . $id => 'required|digits_between:10,13|numeric',
            'nisn-' . $id => 'required|numeric|digits:8',
        ], [
            'nama-' . $id . '.required' => 'Nama tidak boleh kosong !',
            'nama-' . $id . '.min' => 'Nama minimal 3 karakter !',
            'nama-' . $id . '.max' => 'Nama maximal 100 karakter !',
            'nama-' . $id . '.regex' => 'Nama hanya boleh diisi huruf, . (titik) dan , (koma) !',
            'tempat_lahir-' . $id . '.required' => 'Tempat lahir tidak boleh kosong !',
            'tempat_lahir-' . $id . '.min' => 'Tempat lahir minimal 3 karakter !',
            'tempat_lahir-' . $id . '.max' => 'Tempat lahir maximal 30 karakter !',
            'tempat_lahir-' . $id . '.regex' => 'Tempat lahir hanya boleh diisi huruf',
            'alamat-' . $id . '.required' => 'Alamat tidak boleh kosong !',
            'alamat-' . $id . '.min' => 'Alamat minimal 5 karakter !',
            'alamat-' . $id . '.max' => 'Alamat maximal 1000 karakter !',
            'tanggal_lahir-' . $id . '.required' => 'Tanggal lahir tidak boleh kosong !',
            'tanggal_lahir-' . $id . '.date_format' => 'Format tanggal salah !',
            'jenis_kelamin-' . $id . '.required' => 'Jenis kelamin tidak boleh kosong !',
            'jenis_kelamin-' . $id . '.in' => 'Data tidak cocok !',
            'status-' . $id . '.required' => 'Status mengajar tidak boleh kosong !',
            'status-' . $id . '.in' => 'Data tidak cocok !',
            'agama_id-' . $id . '.required' => 'Agama tidak boleh kosong !',
            'agama_id-' . $id . '.exists' => 'Data tidak cocok !',
            'kelas_id-' . $id . '.required' => 'Kelas tidak boleh kosong !',
            'kelas_id-' . $id . '.exists' => 'Data tidak cocok !',
            'no_telp-' . $id . '.required' => 'Nomor telepon tidak boleh kosong !',
            'no_telp-' . $id . '.digits_between' => 'Nomor telepon minimal 10 dijit maximal 13 dijit !',
            'no_telp-' . $id . '.numeric' => 'Nomor telepon hanya boleh diisi angka !',
            'nisn-' . $id . '.required' => 'NISN tidak boleh kosong !',
            'nisn-' . $id . '.digits' => 'NISN terdiri dari 8 dijit !',
            'nisn-' . $id . '.numeric' => 'NISN hanya boleh diisi angka !',
        ]);

        if (request()->has('foto-' . $id)) {
            $request->validate([
                'foto-' . $id => 'image|max:3000',
            ], [
                'foto-' . $id . '.image' => 'Format foto tidak didukung !',
                'foto-' . $id . '.max' => 'Ukuran foto terlalu besat !',
            ]);
        }

        if (request('username-' . $id) != null) {
            $request->validate([
                'username' => 'min:3|max:20|unique:tbl_user,username',
            ], [
                'username-' . $id . '.min' => 'Username minimal 3 karakter !',
                'username-' . $id . '.max' => 'Username maximal 20 karakter !',
                'username-' . $id . '.unique' => 'Username telah digunakan !',
            ]);
        }

        if (request('password-' . $id) != null) {
            $request->validate([
                'password-' . $id => 'min:6|max:20',
            ], [
                'password-' . $id . '.min' => 'Password terlalu pendek !',
                'password-' . $id . '.max' => 'Password terlalu panjang !',
            ]);
        }

        try {
            // $kelas = Kelas::find($request['kelas_id-' . $id]);
            $data = JadwalPelajaran::find($id);
            $data->nama = $request['nama-' . $id];
            $data->nisn = $request['nisn-' . $id];
            $data->status = $request['status-' . $id];
            $data->agama_id = $request['agama_id-' . $id];
            $data->jenis_kelamin = $request['jenis_kelamin-' . $id];
            $data->tempat_lahir = $request['tempat_lahir-' . $id];
            $data->tanggal_lahir = $request['tanggal_lahir-' . $id];
            $data->alamat = $request['alamat-' . $id];
            $data->kelas_id = $request['kelas_id-' . $id];
            $data->save();

            return redirect()->route('jadwal-pelajaran')->with('update', 'Berhasil mengubah data !');
        } catch (\Throwable $th) {
            return redirect()->route('jadwal-pelajaran')->with('danger', 'Gagal mengubah data !');
        }
    }
}
