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
        $query = Pengaduan::with(['user', 'foto'])->latest();

        // filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_kejadian', $request->bulan);
        }

        // filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_kejadian', $request->tahun);
        }

        // filter tanggal lengkap
        if ($request->filled('tanggal') && $request->filled('bulan') && $request->filled('tahun')) {
            $tanggalLengkap = Carbon::createFromDate(
                $request->tahun,
                $request->bulan,
                $request->tanggal
            )->format('Y-m-d');

            $query->whereDate('tanggal_kejadian', $tanggalLengkap);
        }

        // filter judul_pengaduan (misal: pembunuhan, pencurian, dll)
        if ($request->filled('judul_pengaduan')) {
            $query->where('judul_pengaduan', $request->judul_pengaduan);
        }

        $pengaduan = $query->get();

        // Kirim ke view khusus export (misal PDF / Word / Excel)
        return view('export.laporan-filter', compact('pengaduan'));
    }
}
