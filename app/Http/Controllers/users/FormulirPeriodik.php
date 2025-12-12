<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\DataPeriodik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormulirPeriodik extends Controller
{
    public function index() {
        return view('user.formulir_periodik', ['user' => Auth::user()]);
    }

    public function save_periodik(Request $request) {
        try {
            $validated = $request->validate([
                'berat_badan' => 'required|numeric',
                'jarak_tempuh' => 'required|numeric',
                'waktu_tempuh' => 'required|date_format:H:i',
                'jumlah_saudara_kandung' => 'required|numeric'
            ], [
                'berat_badan' => 'Berat badan wajib di isi',
                'berat_badan' => 'Berat badan harus berupa angka',
                'jarak_tempuh' => 'Jarak tempuh wajib di isi',
                'jarak_tempuh' => 'Jarak tempuh harus berupa angka',
                'waktu_tempuh' => 'Waktu tempuh wajib di isi',
                'waktu_tempuh' => 'Waktu tempuh harus jam dan menit',
                'jumlah_saudara_kandung' => 'Jumlah saudara kandung wajib di isi',
                'jumlah_saudara_kandung' => 'Jumlah saudara kandung harus berupa angka',
            ]);
            DataPeriodik::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('formulir_nilai_raport')->with('success', 'Data Periodik berhasil disimpan.');
        } catch (\Exception $e) {
            // return redirect()->back()->with('failed', 'Data Gagal disimpan' . $e->getMessage());
            return redirect()->back()->with('failed', 'Data Gagal disimpan');
        }
    }
}
