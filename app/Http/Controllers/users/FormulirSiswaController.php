<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSiswa;
use App\Models\Registrasi;
use App\Models\User;

use App\Services\AppServices;

class FormulirSiswaController extends Controller
{

    public function __construct(
        protected AppServices $app
    ) {}

    public function index()
    {
        $user = Auth::user();
        // $siswa = DataSiswa::where('user_id', $user->id)->first();
        $siswa = $this->app->getDataSiswa($user->id);
        $cek_user_registrasi = Registrasi::where('user_id', $user->id)->first();
        return view('user..close.formulir_siswa', compact('user', 'siswa', 'cek_user_registrasi'));
        // dd($cek_user_registrasi);
    }

    public function save_siswa(Request $request)
    {
        // Cek data sudah ada
        if (DataSiswa::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('failed', 'Data siswa sudah disimpan');
        }

        try {
            $validated = $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'jenis_kelamin' => 'required',
                'nisn' => 'required|min_digits:10|max_digits:10',
                'no_kk' => 'required|numeric|min_digits:16|max_digits:16',
                'nik' => 'required|numeric|min_digits:16|max_digits:16|unique:data_siswa,nik',
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
                'min_digits' => ':attribute tidak boleh kurang dari :min_digits digit',
                'max_digits' => ':attribute tidak boleh kurang dari :max_digits digit',
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
        }
    }

    public function edit_siswa(Request $request, $id)
    {
        $siswa = DataSiswa::findOrFail($id);

        try {
            $validated = $request->validate([
                'nama_siswa' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki - Laki,Perempuan',
                'nisn' => 'required|min_digits:10|max_digits:10',
                'no_kk' => 'required|numeric|min_digits:16|max_digits:16',


                'nik' => [
                    'required',
                    'numeric',
                    'min_digits:16',
                    'max_digits:16',
                    Rule::unique('data_siswa', 'nik')->ignore($siswa->id),
                ],

                'agama' => 'required|in:islam,katolik,protestan,hindu,budha,khonghucu',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'akta_lahir' => 'required|string',
                'disabilitas' => 'required',
                'kwarganegaraan' => 'required|in:wni,wna',
                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'alamat' => 'required|string',
                'tempat_tinggal' => 'required|string',
                'transportasi' => 'required',
                'anak_keberapa' => 'required|numeric'
            ], [
                'min_digits' => ':attribute tidak boleh kurang dari :min_digits digit',
                'max_digits' => ':attribute tidak boleh kurang dari :max_digits digit',
                'required' => ':attribute wajib diisi'
            ]);

            $validated['tanggal_lahir'] = Carbon::parse($validated['tanggal_lahir'])->format('Y-m-d');

            $siswa->update($validated);

            return redirect()->back()->with('success', 'Data siswa berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data siswa gagal diubah.');
        }
    }
}
