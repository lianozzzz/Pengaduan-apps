<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportController extends Controller
{
    // Cetak 1 laporan (perorangan)
    public function cetakLaporan($id_pengaduan)
    {
        $pengaduan = Pengaduan::with(['user', 'foto'])->findOrFail($id_pengaduan);
        return view('export.laporan-pengaduan', compact('pengaduan'));
    }

    // Cetak laporan berdasarkan filter
    public function cetakFilter(Request $request)
{
    $query = Pengaduan::with('user', 'foto');

    // filter judul
    if ($request->judul_pengaduan) {
        $query->where('judul_pengaduan', 'like', '%'.$request->judul_pengaduan.'%');
    }

    // filter tahun (pakai tanggal_kejadian kalau ada)
    if ($request->tahun) {
        $query->whereYear('tanggal_kejadian', $request->tahun);
    }

    // filter bulan
    if ($request->bulan) {
        $query->whereMonth('tanggal_kejadian', $request->bulan);
    }

    // filter tanggal
    if ($request->tanggal) {
        $query->whereDate('tanggal_kejadian', $request->tanggal);
    }

    // filter status
    if ($request->status !== null && $request->status !== '') {
        $query->where('status', $request->status);
    }

    $pengaduans = $query->get();
    $filters = $request->all();

    return view('admin.pengaduan.cetak', compact('pengaduans','filters'));
}


}
