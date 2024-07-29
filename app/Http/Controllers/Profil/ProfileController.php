<?php

namespace App\Http\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mengambil data pengguna yang sedang login
        return view('profile.index', compact('user'));
    }

    public function edit($id)
    {
        // Ambil pengguna yang ingin diubah
        $user = User::findOrFail($id);

        // Pastikan pengguna yang mengakses aksi ini memiliki izin
        if (Auth::user()->level !== 'admin' && Auth::user()->id !== $user->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengubah pengguna ini.');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form yang dikirimkan


        // Ambil data pengguna yang ingin diubah
        $user = User::findOrFail($id);

        // Perbarui informasi pengguna
        $user->nama = $request->nama;
        $user->agama = $request->agama;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;

        // Perbarui password jika dimasukkan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Simpan perubahan
        $user->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect('profile')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
