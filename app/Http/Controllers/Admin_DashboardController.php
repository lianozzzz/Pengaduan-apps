<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin_DashboardController extends Controller
{
   public function index()
{
    $userName = Auth::user();

    // Semua data pengaduan (untuk filter atau keperluan lain)
    $pengaduan = Pengaduan::with('user')->latest()->get();

    // Ambil 5 pengaduan terbaru
    $pengaduanTerbaru = Pengaduan::with('user')->latest()->take(5)->get();

    // Hitung jumlah per status
    $countPending = Pengaduan::where('status', 0)->count();
    $countProses = Pengaduan::where('status', 1)->count();
    $countSelesai = Pengaduan::where('status', 2)->count();
    $countDitolak = Pengaduan::where('status', 3)->count();

    return view('dashboard.admin', compact(
        'userName',
        'pengaduan',
        'pengaduanTerbaru',
        'countPending',
        'countProses',
        'countSelesai',
        'countDitolak'
    ));
}

}
