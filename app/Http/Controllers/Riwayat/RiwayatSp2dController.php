<?php

namespace App\Http\Controllers\Riwayat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Sp2d;
use Illuminate\Support\Carbon;

class RiwayatSp2dController extends Controller
{
    public function index()
    {
        // Mengambil data pengajuan sp2d yang diterima dan ditolak
        $sp2dDiterima = Sp2d::where('status', 'Di Terima')->get();
        $sp2dDitolak = Sp2d::where('status', 'Di Tolak')->get();

        // Mengirimkan data ke tampilan untuk ditampilkan
        return view('admin.pengajuanselesai.riwayatsp2d.index', [
            'sp2dDiterima' => $sp2dDiterima,
            'sp2dDitolak' => $sp2dDitolak
        ]);
    }


    public function show($id)
    {
        $sp2d = Sp2d::with('pegawai')->findOrFail($id);

        return view('admin.pengajuanselesai.riwayatsp2d.show', compact('sp2d'));
    }

    public function destroy($id)
    {
        $sp2d = Sp2d::findOrFail($id);

        // Hapus sp2d
        $sp2d->delete();

        // Redirect dengan pesan sukses
        return redirect('admin/pengajuanselesai/riwayatsp2d')->with('danger', 'Data Berhasil Dihapus');
    }

    public function filter(Request $request)
    {
        $nama_satker = $request->input('nama_satker');
        $tanggal_pengajuan = $request->input('tanggal_pengajuan');

        // Filter data yang diterima
        $sp2dDiterimaQuery = Sp2d::query()->where('status', 'Di Terima');

        // Filter data yang ditolak
        $sp2dDitolakQuery = Sp2d::query()->where('status', 'Di Tolak');

        // Filter berdasarkan nama satker jika ada
        if ($nama_satker) {
            $sp2dDiterimaQuery->whereHas('satker', function ($query) use ($nama_satker) {
                $query->where('nama_satker', 'like', '%' . $nama_satker . '%');
            });

            $sp2dDitolakQuery->whereHas('satker', function ($query) use ($nama_satker) {
                $query->where('nama_satker', 'like', '%' . $nama_satker . '%');
            });
        }

        // Filter berdasarkan tanggal pengajuan jika ada
        if ($request->has('tanggal_pengajuan') && !empty($request->tanggal_pengajuan)) {
            $tanggalPengajuan = Carbon::parse($request->tanggal_pengajuan)->format('d F Y');
            $sp2dDiterimaQuery->whereDate('tanggal_pengajuan', $tanggalPengajuan);
            $sp2dDitolakQuery->whereDate('tanggal_pengajuan', $tanggalPengajuan);
        }

        // Ambil hasil query
        $sp2dDiterima = $sp2dDiterimaQuery->get();
        $sp2dDitolak = $sp2dDitolakQuery->get();

        // Kemudian kembalikan view dengan data yang sudah difilter
        return view('admin.pengajuanselesai.riwayatsp2d.index', compact('sp2dDiterima', 'sp2dDitolak'));
    }
}
