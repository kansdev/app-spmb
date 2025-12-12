<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSiswa;

class FormulirSiswaController extends Controller
{
    public function index()
    {
        return view('user.formulir_siswa', ['user' => Auth::user()]);
    }

    public function save_siswa(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string',
                'nisn' => 'required|numeric',
                'no_kk' => 'required|numeric',
                'nik' => 'required|digits:16|unique:data_siswa,nik',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'akta_lahir' => 'required',
                'disabilitas' => 'required|string|max:255',
                'kwarganegaraan' => 'required',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'required|string',
                'tempat_tinggal' => 'required|string|max:255',
                'transportasi' => 'required',
                'anak_keberapa' => 'required|numeric'
            ]);

            $validated['tanggal_lahir'] = Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');

            DataSiswa::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('formulir_orang_tua')->with('success', 'Data siswa berhasil disimpan.');
        } catch (\Exception $e) {
            // return redirect()->back()->with('failed', 'Data Gagal disimpan' . $e->getMessage());
            return redirect()->back()->with('failed', 'Data Gagal disimpan');
        }
    }
}
