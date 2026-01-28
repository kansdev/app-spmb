<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\NilaiRaport;
use App\Models\Registrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FormulirNilaiRaport extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $nilai_raport = NilaiRaport::where('user_id', $user->id)->first();
        $cek_user_registrasi = Registrasi::where('user_id', $user->id)->first();

        return view('user.close.formulir_nilai_raport', compact('user', 'nilai_raport', 'cek_user_registrasi'));
    }

    public function save_nilai_raport(Request $request)
    {
        try {
            $validated = $request->validate([
                'nilai_bahasa_indonesia_1' => 'required|numeric',
                'nilai_bahasa_indonesia_2' => 'required|numeric',
                'nilai_bahasa_indonesia_3' => 'required|numeric',
                'nilai_bahasa_indonesia_4' => 'required|numeric',
                'nilai_bahasa_indonesia_5' => 'required|numeric',
                'nilai_matematika_1' => 'required|numeric',
                'nilai_matematika_2' => 'required|numeric',
                'nilai_matematika_3' => 'required|numeric',
                'nilai_matematika_4' => 'required|numeric',
                'nilai_matematika_5' => 'required|numeric',
                'nilai_bahasa_inggris_1' => 'required|numeric',
                'nilai_bahasa_inggris_2' => 'required|numeric',
                'nilai_bahasa_inggris_3' => 'required|numeric',
                'nilai_bahasa_inggris_4' => 'required|numeric',
                'nilai_bahasa_inggris_5' => 'required|numeric'
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
            return redirect()->back()->with('failed', 'Nilai raport Gagal disimpan ');
        }
    }

    public function edit_nilai_raport(Request $request, $id)
    {
        $nilai_raport = NilaiRaport::findOrFail($id);

        try {
            $validated = $request->validate([
                'nilai_bahasa_indonesia_1' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_indonesia_2' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_indonesia_3' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_indonesia_4' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_indonesia_5' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_matematika_1' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_matematika_2' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_matematika_3' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_matematika_4' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_matematika_5' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_inggris_1' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_inggris_2' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_inggris_3' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_inggris_4' => ['required','regex:/^\d+([.,]\d+)?$/'],
                'nilai_bahasa_inggris_5' => ['required','regex:/^\d+([.,]\d+)?$/']
            ], [
                'required' => ':attribute wajib diisi',
                'numeric' => ':attribute harus berupa angka'
            ]);

            $nilai_raport->update($validated);

            return redirect()->back()->with('success', 'Data Orang Tua berhasil diubah.');
        } catch(ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data orang tua gagal diubah');
        }
    }
}
