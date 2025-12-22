<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSiswa;

class FormulirSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = DataSiswa::where('user_id', $user->id)->first();
        return view('user.formulir_siswa', compact('user', 'siswa'));
    }

    public function save_siswa(Request $request)
    {
        // Cek data sudah ada
        if (DataSiswa::where('user_id', Auth::id())->exist()) {
            return redirect()->back()->with('failed', 'Data siswa sudah disimpan');
        }

        try {
            $validated = $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'jenis_kelamin' => 'required',
                'nisn' => 'required',
                'no_kk' => 'required|numeric|digits:16',
                'nik' => 'required|numeric|digits:16|unique:data_siswa,nik',
                'agama' => 'required',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'akta_lahir' => 'required|string',
                'disabilitas' => 'required',
                'kwarganegaraan' => 'required',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'required|string',
                'tempat_tinggal' => 'required|string',
                'transportasi' => 'required',
                'anak_keberapa' => 'required|numeric'
            ], [
                'digits' => ':attribute harus :digits digit',
                'required' => ':attribute wajib diisi'
            ]);

            $validated['tanggal_lahir'] = Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');

            DataSiswa::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('formulir_orang_tua')->with('success', 'Data siswa berhasil disimpan.');
        } catch (ValidationException $e) {
            throw $e;
        }
        catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data Gagal disimpan, ' . $e->getMessage());
            // return redirect()->back()->with('failed', 'Data Gagal disimpan');
        }
    }
}
