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
    $query = Pengaduan::with(['user', 'foto']);

    if ($request->status !== null && $request->status !== '') {
        $query->where('status', $request->status);
    }
    if ($request->bulan) {
        $query->whereMonth('created_at', $request->bulan);
    }
    if ($request->tanggal) {
        $query->whereDay('created_at', $request->tanggal);
    }
    if ($request->tahun) {
        $query->whereYear('created_at', $request->tahun);
    }
    if ($request->judul_pengaduan) {
        $query->where('judul_pengaduan', $request->judul_pengaduan);
    }

    $pengaduans = $query->get(); // pakai jamak biar sama dengan blade
$filters = $request->all();

return view('admin.pengaduan.cetak', compact('pengaduans','filters'));

}

}
