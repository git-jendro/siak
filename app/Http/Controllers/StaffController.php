<?php

namespace App\Http\Controllers;

use App\Agama;
use App\Jabatan;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Staff::all();
        $jabatan = Jabatan::all();
        $agama = Agama::all();

        return view('staff.index', compact('data', 'jabatan', 'agama'));
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
            'nama' => 'required|min:3|max:100|regex:/^[\.a-zA-Z, ]*$/',
            'agama_id' => 'required|exists:tbl_agama,id',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|min:3|max:30|regex:/^[a-zA-Z ]*$/',
            'tanggal_lahir' => 'required|date_format:d-m-Y',
            'alamat' => 'required|min:5|max:1000',
            'jabatan_id' => 'required|exists:tbl_jabatan,id',
            'no_telp' => 'required|digits_between:10,13|numeric',
            'username' => 'required|min:3|max:20|unique:tbl_user,username',
            'password' => 'required|min:6|max:20',
            'foto' => 'required|image|max:3000',
        ], [
            'nama.required' => 'Nama tidak boleh kosong !',
            'nama.min' => 'Nama minimal 3 karakter !',
            'nama.max' => 'Nama maximal 100 karakter !',
            'nama.regex' => 'Nama hanya boleh diisi huruf, . (titik) dan , (koma) !',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong !',
            'tempat_lahir.min' => 'Tempat lahir minimal 3 karakter !',
            'tempat_lahir.max' => 'Tempat lahir maximal 30 karakter !',
            'tempat_lahir.regex' => 'Tempat lahir hanya boleh diisi huruf',
            'alamat.required' => 'Alamat tidak boleh kosong !',
            'alamat.min' => 'Alamat minimal 5 karakter !',
            'alamat.max' => 'Alamat maximal 1000 karakter !',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong !',
            'tanggal_lahir.date_format' => 'Format tanggal salah !',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong !',
            'jenis_kelamin.in' => 'Data tidak cocok !',
            'agama_id.required' => 'Agama tidak boleh kosong !',
            'agama_id.exists' => 'Data tidak cocok !',
            'jabatan_id.required' => 'Jabatan tidak boleh kosong !',
            'jabatan_id.exists' => 'Data tidak cocok !',
            'no_telp.required' => 'Nomor telepon tidak boleh kosong !',
            'no_telp.digits_between' => 'Nomor telpon minimal 10 dijit maximal 13 dijit !',
            'no_telp.numeric' => 'Nomor telpon hanya boleh diisi angka !',
            'username.required' => 'Username tidak boleh kosong !',
            'username.min' => 'Username minimal 3 karakter !',
            'username.max' => 'Username maximal 20 karakter !',
            'password.required' => 'Password tidak boleh kosong !',
            'password.min' => 'Password terlalu pendek !',
            'password.max' => 'Password terlalu panjang !',
            'foto.required' => 'Foto tidak boleh kosong !',
            'foto.image' => 'Format foto tidak didukung !',
            'foto.max' => 'Ukuran foto terlalu besat !',
        ]);

        try {
            $filename = $request->foto->getClientOriginalName();
            
            $data = new Staff;
            $data->id = $this->generateUUID('STF', 3);
            $path = 'Staff/' . $data->id . '/Foto';
            $data->nama = $request->nama;
            $data->agama_id = $request->agama_id;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->alamat = $request->alamat;
            $data->jabatan_id = $request->jabatan_id;
            $data->no_telp = $request->no_telp;
            $user = new User;
            $user->id = $this->generateUUID('USR', 8);
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $data->user_id = $user->id;
            $data->foto = $request->foto->storeAs($path, $filename);
            $data->save();
            $user->save();
            return redirect()->route('staff')->with('success', 'Berhasil menambahkan data !');
        } catch (\Throwable $th) {
            return redirect()->route('staff')->with('danger', 'Gagal menambahkan data !');
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
            'tempat_lahir-' . $id => 'required|min:3|max:30|regex:/^[a-zA-Z ]*$/',
            'tanggal_lahir-' . $id => 'required|date_format:d-m-Y',
            'alamat-' . $id => 'required|min:5|max:1000',
            'jabatan_id-' . $id => 'required|exists:tbl_jabatan,id',
            'no_telp-' . $id => 'required|numeric|digits_between:10,13',
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
            'agama_id-' . $id . '.required' => 'Agama tidak boleh kosong !',
            'agama_id-' . $id . '.exists' => 'Data tidak cocok !',
            'jabatan_id-' . $id . '.required' => 'Jabatan tidak boleh kosong !',
            'jabatan_id-' . $id . '.exists' => 'Data tidak cocok !',
            'no_telp-' . $id . '.required' => 'Nomor telepon tidak boleh kosong !',
            'no_telp-' . $id . '.digits_between' => 'Nomor telpon minimal 10 dijit maximal 13 dijit !',
            'no_telp-' . $id . '.numeric' => 'Nomor telpon hanya boleh diisi angka !',
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
                'username-' . $id => 'min:3|max:20|unique:tbl_user,username',
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
            $data = Staff::find($id);
            $data->nama = $request['nama-' . $id];
            $data->agama_id = $request['agama_id-' . $id];
            $data->jenis_kelamin = $request['jenis_kelamin-' . $id];
            $data->tempat_lahir = $request['tempat_lahir-' . $id];
            $data->tanggal_lahir = $request['tanggal_lahir-' . $id];
            $data->alamat = $request['alamat-' . $id];
            $data->jabatan_id = $request['jabatan_id-' . $id];
            $data->no_telp = $request['no_telp-' . $id];
            if (request()->has('foto-' . $id)) {
                $filename = $request['foto-' . $id]->getClientOriginalName();
                $path = 'Staff/' . $id . '/Foto';
                $this->deleteFile($data->foto);
                $data->foto = $request['foto-' . $id]->storeAs($path, $filename);
            }
            $data->save();

            
            $user = User::find($data->user_id);
            if (request('username-' . $id) != null) {
                $user->username = $request['username-' . $id];
            }
            $user->save();
            if (request('password-' . $id) != null) {
                $user->password = Hash::make($request['password-' . $id]);
            }
            $user->save();

            return redirect()->route('staff')->with('update', 'Berhasil mengubah data !');
        } catch (\Throwable $th) {
            return redirect()->route('staff')->with('danger', 'Gagal menambahkan data !');
        }
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $conn = Jabatan::select('id')->where('previlege', 2);
            $count = Staff::whereHas('jabatan', function ($q) use ($conn) {
                $q->whereIn('jabatan_id', $conn);
            })->count();
            $data = Staff::find($id);
            if ($data->user_id == Auth::user()->id) {
                return redirect()->route('staff')->with('danger', 'Tidak dapat menghapus akun yang sedang login !');
            } elseif ($count <= 1) {
                return redirect()->route('staff')->with('danger', 'Gagal menghapus data karena jabatan Keuangan tidak boleh kosong !');
            }
            User::where('id', $data->user->id)->delete();
            Staff::destroy($id);
            return redirect()->route('staff')->with('danger', 'Berhasil menghapus data !');
        } catch (\Throwable $th) {
            return redirect()->route('staff')->with('danger', 'Gagal menghapus data !');
        }
    }
}
