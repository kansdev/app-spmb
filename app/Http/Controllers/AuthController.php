<?php

namespace App\Http\Controllers;

use App\Models\User;

use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// use phpseclib3\Crypt\Hash;

class AuthController extends Controller
{

    public function login_page()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.auth');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Membuat koneksi ke driver google
            $googleuser = Socialite::driver('google')->stateless()->user();
            // dd($googleuser);
            // Mencari data atau membuat data baru jika belum ada
            $user = User::updateOrCreate([
                'email' => $googleuser->getEmail(),
            ], [
                'name' => $googleuser->getName(), // Mendapatkan nama
                'google_id' => $googleuser->getId(), // Mendapatkan id google
                'avatar' => $googleuser->getAvatar(), // Mendapatkan avatar
                'password' => bcrypt(Str::random(16))
            ]);

            Auth::login($user);
            return redirect('/home');
        } catch (\Exception $e) {
            // echo $e->getMessage();
            return redirect('/')->with('error', 'Login Failed' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Auth Admin
    public function login_admin(Request $request) {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required'
            ]);

            $admin = DB::table('account')->where('username', $request->username)->first();

            // Cek jika user tidak ditemukan
            if (!$admin) {
                return redirect()->route('login')->with('error', 'Username tidak ditemukan');
            }

            // Cek password
            if (!Hash::check($request->password, $admin->password)) {
                return redirect()->route('login')->with('error', 'Password anda salah');
            }

            // simpan session
            session([
                'id' => $admin->id,
                'name' => $admin->name,
                'level' => $admin->level
            ]);

            return redirect()->route('admin.dashboard')->with('message', 'Selamat Datang ' . $admin->name);
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan : ' . $e->getMessage());
        }
    }
}
