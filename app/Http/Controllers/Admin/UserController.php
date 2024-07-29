<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Satker;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $data['list_user'] = User::all();
        return view('admin.user.index', $data);
    }

    public function create()
    {
        // Ambil semua satker yang belum terasosiasi dengan user level Satker
        $list_satker = Satker::whereDoesntHave('users', function ($query) {
            $query->where('level', 'satker');
        })->get();

        return view('admin.user.create', compact('list_satker'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required|string',
                'username' => 'required|string',
                'level' => 'required|string',
                'email' => 'required|email',
                'jabatan' => 'required|string',
                'jenis_kelamin' => 'required|string',
                'alamat_satker' => 'required',
                'agama' => 'required|string',
                'password' => 'required',
                'no_hp' => 'required|string',
                'kode_satker' => 'required_if:level,Satker|exists:satker,id', // Ubah validasi ini sesuai dengan kebutuhan Anda
            ],
            [
                'nama.required' => 'Field nama harus diisi.',
                'username.required' => 'field username harus diisi.',
                'level.required' => 'Field Level Harus Dipilih',
                'username.unique' => 'Username sudah digunakan.',
                'jabatan.required' => 'Field jabatan harus diisi.',
                'alamat_satker.required' => 'Field alamat satker harus diisi.',
                'jenis_kelamin.required' => 'Field jenis kelamin harus diisi.',
                'agama.required' => 'Field agama harus diisi.',
                'email.required' => 'Field email harus diisi.',
                'email.email' => 'Field Format email tidak valid.',
                'email.unique' => 'Field Email sudah digunakan.',
                'no_hp.required' => 'Field Nomor Handphone Harus Di Isi.',
                'password.required' => 'Field Password harus terdiri dari minimal 8 Karakter.',
                'password.required_with.required' => 'Field Password harus diisi jika Anda mengisi kolom password.',
            ]
        );

        // Jika level adalah Satker, pastikan bahwa satker belum terasosiasi dengan user lain
        if ($validatedData['level'] === 'satker') {
            $existingUser = User::where('level', 'satker')
                ->where('id_satker', $validatedData['kode_satker'])
                ->exists();

            if ($existingUser) {
                return redirect()->back()->withInput()->withErrors(['satker_exists' => 'Satker telah terasosiasi dengan user lain']);
            }
        }

        // Buat instance baru dari model User
        $user = new User;

        // Assign nilai dari formulir ke properti objek User
        $user->nama = $validatedData['nama'];
        $user->username = $validatedData['username'];
        $user->level = $validatedData['level'];
        $user->email = $validatedData['email'];
        $user->jabatan = $validatedData['jabatan'];
        $user->jenis_kelamin = $validatedData['jenis_kelamin'];
        $user->alamat_satker = $validatedData['alamat_satker'];
        $user->agama = $validatedData['agama'];
        $user->no_hp = $validatedData['no_hp'];
        $user->password = bcrypt($validatedData['password']); // Gunakan hashing untuk password

        // Jika level adalah Satker, ambil nilai id_satker dari dropdown dan simpan
        if ($validatedData['level'] === 'satker') {
            $user->id_satker = $validatedData['kode_satker'];
        } else {
            // Pastikan id_satker tidak disertakan saat level adalah "Admin"
            $user->id_satker = null;
        }

        $user->save();

        // Redirect ke halaman tertentu setelah data berhasil disimpan
        return redirect('admin/user')->with('success', 'Data User Berhasil Ditambahkan');
    }





    public function show(User $user)
    {
        $data['user'] = $user;
        return view('admin.user.show', $data);
    }

    public function edit(User $user)
    {
        $data['user'] = $user;
        return view('admin.user.edit', $data);
    }

    public function update(User $user, Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate(
            [
                'nama' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|email',
                'jabatan' => 'required|string',
                'password' => 'required',
                'jenis_kelamin' => 'required|string',
                'alamat_satker' => 'required',
                'agama' => 'required|string',
                'password' => 'required',
                'no_hp' => 'required|string',
                'password_confirmation' => 'required',
                // Ubah validasi ini sesuai dengan kebutuhan Anda
            ],
            [
                'nama.required' => 'Field nama harus diisi.',
                'username.required' => 'field username harus diisi.',
                'username.unique' => 'Username sudah digunakan.',
                'jabatan.required' => 'Field jabatan harus diisi.',
                'alamat_satker.required' => 'Field alamat satker harus diisi.',
                'jenis_kelamin.required' => 'Field jenis kelamin harus diisi.',
                'agama.required' => 'Field agama harus diisi.',
                'email.required' => 'Field email harus diisi.',
                'email.email' => 'Field Format email tidak valid.',
                'email.unique' => 'Field Email sudah digunakan.',
                'no_hp.required' => 'Field Nomor Handphone Harus Di Isi.',
                'password_confirmation' => 'Konfirmasi Password harus sama dengan Password Baru .',
            ]
        );

        // Update data pengguna
        $user->update([
            'nama' => $validatedData['nama'],
            'username' => $validatedData['username'],
            'jabatan' => $validatedData['jabatan'],
            'alamat_satker' => $validatedData['alamat_satker'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'agama' => $validatedData['agama'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
        ]);

        // Update password jika password baru disediakan
        if (request('password')) {
            // Hash the password
            $user->password = bcrypt(request('password'));
            $user->save();
        }

        return redirect('admin/user')->with('success', 'Data Berhasil Di Ubah');
    }


    function destroy(User $user)
    {
        $user->delete();

        return redirect('admin/user')->with('danger', 'Data Berhasil Dihapus');
    }
}
