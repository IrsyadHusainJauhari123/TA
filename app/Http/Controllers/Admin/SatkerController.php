<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satker;
use Illuminate\Http\Request;

class SatkerController extends Controller
{
    public function index()
    {
        $data['list_satker'] = Satker::all();
        return view('admin.satker.index', $data);
    }


    public function create()
    {
        return view('admin.satker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satker' => 'required|string|max:255',
            'kode_satker' => 'required|string|max:255',

        ], [
            'nama_satker.required' => 'Field Nama Satker Harus Di Isi',
            'kode_satker.required' => 'Field Kode Satker Harus Di Isi',
        ]);
        $satker = new Satker;
        $satker->nama_satker = request('nama_satker');
        $satker->kode_satker = request('kode_satker');
        $satker->save();
        return redirect('admin/satker')->with('success', 'Data Berhasil Di Tambah');
    }

    public function edit(Satker $satker)
    {
        $data['satker'] = $satker;
        return view('admin.satker.edit', $data);
    }



    public function update(Request $request, Satker $satker)
    {
        $request->validate([
            'nama_satker' => 'required|string|max:255',
            'kode_satker' => 'required|string|max:255',

        ], [
            'nama_satker.required' => 'Field Nama Satker Harus Di Isi',
            'kode_satker.required' => 'Field Kode Satker Harus Di Isi',
        ]);
        $satker->nama_satker = request('nama_satker');
        $satker->kode_satker = request('kode_satker');
        $satker->save();
        return redirect('admin/satker')->with('success', 'Data Berhasil  Di Edit');
    }

    public function show(Satker $satker)
    {
        return view('admin.satker.show', compact('satker'));
    }



    function destroy(Satker $satker)
    {
        $satker->delete();

        return redirect('admin/satker')->with('danger', 'Data Berhasil Dihapus');
    }
}
