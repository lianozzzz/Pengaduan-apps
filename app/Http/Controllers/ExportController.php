<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function cetakLaporan($id_pengaduan)
{
    $pengaduan = Pengaduan::with(['user', 'foto'])->findOrFail($id_pengaduan);
    return view('export.laporan-pengaduan', compact('pengaduan'));
}


}
