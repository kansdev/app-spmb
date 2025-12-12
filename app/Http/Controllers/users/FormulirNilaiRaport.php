<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\NilaiRaport;

class FormulirNilaiRaport extends Controller
{
    public function index()
    {
        return view('user.formulir_nilai_raport', ['user' => Auth::user()]);
    }
    public function save_nilai_raport(Request $request)
    {
        try {
            $validated = $request->validate([
                'nilai_raport_semester_1' => 'required|numeric',
                'nilai_raport_semester_2' => 'required|numeric',
                'nilai_raport_semester_3' => 'required|numeric',
                'nilai_raport_semester_4' => 'required|numeric',
                'nilai_raport_semester_5' => 'required|numeric',
            ]);
            NilaiRaport::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('upload_berkas')->with('success', 'Nilai raport berhasil disimpan.');
        } catch (\Exception $e) {
            // return redirect()->back()->with('failed', 'Nilai raport Gagal disimpan, ' . $e->getMessage());
            return redirect()->back()->with('failed', 'Nilai raport Gagal disimpan ');
        }
    }
}
