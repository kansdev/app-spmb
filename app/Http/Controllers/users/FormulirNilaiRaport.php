<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\NilaiRaport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FormulirNilaiRaport extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nilai_raport = NilaiRaport::where('user_id', $user->id)->first();
        return view('user.formulir_nilai_raport', compact('user', 'nilai_raport'));
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
            ], [
                'required' => ':attribute wajib diisi',
                'numeric' => ':attribute harus berupa angka'
            ]);
            NilaiRaport::create(array_merge($validated, [
                'user_id' => Auth::id()
            ]));

            return redirect()->route('upload_berkas')->with('success', 'Nilai raport berhasil disimpan.');
        } catch(ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            // return redirect()->back()->with('failed', 'Nilai raport Gagal disimpan, ' . $e->getMessage());
            return redirect()->back()->with('failed', 'Nilai raport Gagal disimpan ');
        }
    }
}
