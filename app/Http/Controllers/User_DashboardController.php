<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_DashboardController extends Controller
{
    public function index()
{
    $userName = Auth::user();
    $user = Auth::user();

    // Hanya pengaduan milik user yang login
    $pengaduan = Pengaduan::with('user')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

    // Ambil 5 pengaduan terbaru milik user
    $pengaduanTerbaru = Pengaduan::with('user')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

    // Hitung jumlah per status untuk user
    $countPending = Pengaduan::where('user_id', $user->id)->where('status', 0)->count();
    $countProses = Pengaduan::where('user_id', $user->id)->where('status', 1)->count();
    $countSelesai = Pengaduan::where('user_id', $user->id)->where('status', 2)->count();
    $countDitolak = Pengaduan::where('user_id', $user->id)->where('status', 3)->count();

    return view('dashboard.user', compact(
        'user',
        'pengaduan',
        'pengaduanTerbaru',
        'countPending',
        'countProses',
        'countSelesai',
        'countDitolak',
        'userName'
    ));
}

}
