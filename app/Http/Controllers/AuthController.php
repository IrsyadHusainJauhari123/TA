<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    function loginProcess(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil, periksa level pengguna
            if (Auth::user()->level === 'admin') {
                return redirect('admin/beranda')->with('success', 'Selamat Datang Admin SIJAGA KPPN KETAPANG');
            } elseif (Auth::user()->level === 'satker') {
                // Mengecek apakah relasi satker ada pada user
                if (Auth::user()->satker) {
                    $nama_satker = Auth::user()->satker->nama_satker; // Mengakses nama_satker dari relasi satker pengguna yang sedang login
                    return redirect('user/dashboard')->with('success', 'Selamat Datang Satker ' . $nama_satker);
                } else {
                    return redirect()->back()->with('error', 'Gagal mendapatkan data satker pengguna.');
                }
            }
        }

        // Jika autentikasi gagal, Laravel akan secara otomatis mengarahkan kembali pengguna ke halaman sebelumnya
        return back()->with('danger', 'Kombinasi email dan password tidak cocok.');
    }


    function logout(Request $request)
    {
        Auth::guard('Admin')->logout();
        Auth::guard('Satker')->logout();

        $request->session()->invalidate();

        return redirect('login')->with('warning', 'Anda Telah Keluar');
    }
}
