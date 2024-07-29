<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use Illuminate\Http\Request;
use App\Models\BlastWa;
use App\Models\Broadcast;
use App\Models\Satker;

class RiwayatAgendaController extends Controller
{

    public function index()
    {
        $data['list_arsip'] = Arsip::all();
        return view('admin.arsip.index', $data);
    }


    public function create()
    {
        // Ambil data yang dibutuhkan dari model untuk ditampilkan di form
        $existingIds = Arsip::pluck('id_blastwa')->toArray();

        // Ambil data yang dibutuhkan dari model untuk ditampilkan di form
        $blastwaData = BlastWa::whereNotIn('id', $existingIds)->get();
        $broadcastData = Broadcast::whereNotIn('id', $existingIds)->get();
        $satkerData = Satker::all();

        return view('admin.arsip.create', compact('blastwaData', 'broadcastData', 'satkerData'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_pesan' => 'required', // Pastikan judul_pesan merupakan integer
            'satker_ids' => 'required|array',  // Pastikan semua satker_ids adalah integer
        ], [
            'judul_pesan.required' => 'Field Judul Agenda Harus DiIsi',
            'satker_ids.*required' => 'Field Satker Harus DiPilih',

        ]);

        // Simpan data arsip
        $arsip = new Arsip();
        $arsip->id_blastwa = $request->judul_pesan;
        $arsip->ids = implode(',', $request->satker_ids); // Gabungkan ID satker menjadi string dipisahkan koma

        // Cari data judul pesan yang dipilih
        // $arsip = Blastwa::findOrFail($request->judul_pesan);
        // $arsip = Broadcast::findOrFail($request->judul_pesan);
        // Simpan arsip ke dalam database
        $arsip->save();

        // Redirect atau kirim respons sukses
        return redirect('admin/arsip')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Ambil data arsip berdasarkan ID
        $arsip = Arsip::findOrFail($id);

        // Ambil semua ID satker yang sudah tersimpan di tabel arsip kecuali ID dari arsip yang sedang diedit
        $existingSatkerIds = Arsip::where('id', '!=', $id)->pluck('ids')->toArray();
        $existingSatkerIds = array_unique(explode(',', implode(',', $existingSatkerIds)));

        // Ambil data yang dibutuhkan dari model untuk ditampilkan di form
        $blastwaData = BlastWa::all();
        $broadcastData = Broadcast::all();
        $satkerData = Satker::whereNotIn('id', $existingSatkerIds)->get();

        // Ambil satker yang terkait dengan arsip yang sedang diedit
        $currentSatkerIds = explode(',', $arsip->ids);
        $currentSatkers = Satker::whereIn('id', $currentSatkerIds)->get();

        return view('admin.arsip.edit', compact('arsip', 'blastwaData', 'broadcastData', 'satkerData', 'currentSatkers'));
    }



    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul_pesan' => 'required', // Pastikan judul_pesan merupakan integer
            'satker_ids' => 'required|array',  // Pastikan semua satker_ids adalah integer
        ], [
            'judul_pesan.required' => 'Field Judul Agenda Harus DiIsi',
            'satker_ids.*required' => 'Field Satker Harus DiPilih',

        ]);

        // Ambil data arsip berdasarkan ID
        $arsip = Arsip::findOrFail($id);

        // Update data arsip
        $arsip->id_blastwa = $request->judul_pesan;
        $arsip->ids = implode(',', $request->satker_ids); // Gabungkan ID satker menjadi string dipisahkan koma

        // Simpan perubahan arsip ke dalam database
        $arsip->save();

        // Redirect atau kirim respons sukses
        return redirect('admin/arsip')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        // Cari data arsip berdasarkan ID
        $arsip = Arsip::findOrFail($id);
        // Hapus data arsip dari database
        $arsip->delete();

        // Redirect atau kirim respons sukses
        return redirect('admin/arsip')->with('danger', 'Data berhasil dihapus');
    }
}
