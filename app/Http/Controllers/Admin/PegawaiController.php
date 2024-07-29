<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $data['list_pegawai'] = Pegawai::all();
        return view('admin.pegawai.index', $data);
    }


    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ], [
            'nama_pegawai.required' => 'Field Nama Pegawai Harus Diisi ',
            'jabatan.required' => 'Field Jabatan Harus Diisi ',
            'nomor_hp.required' => 'Field Nomor Hp Harus Diisi ',
            'status.required' => 'Field Status Harus Diisi ',
        ]);

        // Simpan data ke dalam database
        $pegawai = new Pegawai;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->nomor_hp = $request->nomor_hp;
        $pegawai->status = $request->status;
        $pegawai->save();

        // Redirect dengan pesan sukses
        return redirect('admin/pegawai')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Pegawai $pegawai)
    {
        $data['pegawai'] = $pegawai;
        return view('admin.pegawai.edit', $data);
    }

    public function update(Pegawai $pegawai, Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ], [
            'nama_pegawai.required' => 'Field Nama Pegawai Harus Diisi ',
            'jabatan.required' => 'Field Jabatan Harus Diisi ',
            'nomor_hp.required' => 'Field Nomor Hp Harus Diisi ',
            'status.required' => 'Field Status Harus Diisi ',
        ]);
        $pegawai->nama_pegawai = request('nama_pegawai');
        $pegawai->jabatan = request('jabatan');
        $pegawai->status = request('status');
        $pegawai->nomor_hp = request('nomor_hp');;
        // dd($pegawai);
        $pegawai->save();

        return redirect('admin/pegawai')->with('success', 'Data Berhasil Di Edit');
    }


    public function show(Pegawai $pegawai)
    {
        $data['pegawai'] = $pegawai;
        return view('admin.pegawai.show', $data);
    }



    function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return redirect('admin/pegawai')->with('danger', 'Data Berhasil Dihapus');
    }
}
