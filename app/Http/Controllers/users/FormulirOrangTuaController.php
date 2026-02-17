<?php

namespace App\Http\Controllers\users;

use App\Models\DataOrangTua;

use App\Http\Controllers\Controller;
use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FormulirOrangTuaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data_orang_tua = DataOrangTua::where('user_id', $user->id)->first();
        $cek_user_registrasi = Registrasi::where('user_id', $user->id)->first();
        return view('user.formulir_orang_tua', compact('user', 'data_orang_tua', 'cek_user_registrasi'));
    }

    public function save_orang_tua(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_ayah' => 'required|string|max:255',
                'status_ayah' => 'required|string|max:255',
                'nomor_ktp_ayah' => 'required|digits:16',
                'tahun_lahir_ayah' => 'required|integer|digits:4|min:1900|max:' . date("Y"),
                'pendidikan_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'penghasilan_ayah' => 'required',
                'disabilitas_ayah' => 'required',
                'nama_ibu' => 'required|string|max:255',
                'status_ibu' => 'required|string|max:255',
                'nomor_ktp_ibu' => 'required|digits:16',
                'tahun_lahir_ibu' => 'required|integer|digits:4|min:1900|max:' . date("Y"),
                'pendidikan_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'penghasilan_ibu' => 'required',
                'disabilitas_ibu' => 'required',
                'nama_wali'        => 'nullable|string|max:255',
                'status_wali'      => 'nullable|string',
                'pendidikan_wali'  => 'nullable|string',
                'pekerjaan_wali'   => 'nullable|string',
                'penghasilan_wali' => 'nullable|string',
                'disabilitas_wali' => 'nullable|string',
            ],
            [
                'required' => ':attribute wajib di isi',
                'digits' => ':ttribute maksimal :digits digit'
            ]);
            DataOrangTua::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('formulir_periodik')->with('success', 'Data Orang Tua berhasil disimpan.');
        } catch(ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data orang tua gagal disimpan');
        }
    }

    public function edit_orang_tua(Request $request, $id)
    {
        $orang_tua = DataOrangTua::findOrFail($id);

        try {
            $validated = $request->validate([
                'nama_ayah' => 'required|string|max:255',
                'status_ayah' => 'required|string|max:255',
                'nomor_ktp_ayah' => 'required|digits:16',
                'tahun_lahir_ayah' => 'required|integer|digits:4|min:1900|max:' . date("Y"),
                'pendidikan_ayah' => 'required',
                'pekerjaan_ayah' => 'required',
                'penghasilan_ayah' => 'required',
                'disabilitas_ayah' => 'required',
                'nama_ibu' => 'required|string|max:255',
                'status_ibu' => 'required|string|max:255',
                'nomor_ktp_ibu' => 'required|digits:16',
                'tahun_lahir_ibu' => 'required|integer|digits:4|min:1900|max:' . date("Y"),
                'pendidikan_ibu' => 'required',
                'pekerjaan_ibu' => 'required',
                'penghasilan_ibu' => 'required',
                'disabilitas_ibu' => 'required',
                'nama_wali'        => 'nullable|string|max:255',
                'status_wali'      => 'nullable|string',
                'pendidikan_wali'  => 'nullable|string',
                'pekerjaan_wali'   => 'nullable|string',
                'penghasilan_wali' => 'nullable|string',
                'disabilitas_wali' => 'nullable|string',
            ],
            [
                'required' => ':attribute wajib di isi',
                'digits' => ':ttribute maksimal :digits digit'
            ]);

            $orang_tua->update($validated);

            return redirect()->back()->with('success', 'Data Orang Tua berhasil diubah.');
        } catch(ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data orang tua gagal diubah');
        }
    }
}
