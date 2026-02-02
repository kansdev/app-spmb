<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\DataPeriodik;
use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FormulirPeriodik extends Controller
{
    public function index() {
        $user = Auth::user();
        $data_periodik = DataPeriodik::where('user_id', $user->id)->first();
        $cek_user_registrasi = Registrasi::where('user_id', $user->id)->first();
        return view('user.formulir_periodik', compact('user', 'data_periodik', 'cek_user_registrasi'));
    }

    public function save_periodik(Request $request) {
        try {
            $validated = $request->validate([
                'tinggi_badan' => 'required|numeric',
                'berat_badan' => 'required|numeric',
                'jarak_tempuh' => 'required|numeric',
                'waktu_tempuh' => 'required',
                'jumlah_saudara_kandung' => 'required|numeric'
            ], [
                'numeric' => ':attribute harus berupa angka',
                'required' => ':attribute wajib diisi'
            ]);
            DataPeriodik::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('formulir_nilai_raport')->with('success', 'Data Periodik berhasil disimpan.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data Gagal disimpan');
        }
    }

    public function edit_periodik(Request $request, $id)
    {
        $periodik = DataPeriodik::findOrFail($id);

        try {
            $validated = $request->validate([
                'tinggi_badan' => 'required|numeric',
                'berat_badan' => 'required|numeric',
                'jarak_tempuh' => 'required|numeric',
                'waktu_tempuh' => 'required',
                'jumlah_saudara_kandung' => 'required|numeric'
            ], [
                'numeric' => ':attribute harus berupa angka',
                'required' => ':attribute wajib diisi'
            ]);

            $periodik->update($validated);

            return redirect()->back()->with('success', 'Data Orang Tua berhasil diubah.');
        } catch(ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data orang tua gagal diubah');
        }
    }
}
