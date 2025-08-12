<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PengaduanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class User_PengaduanController extends Controller
{
    public function index(Request $request)
   {
    $userName = Auth::user();

    // Query hanya data milik user login
    $query = Pengaduan::with('user', 'foto')
        ->where('user_id', $userName->id)
        ->latest();

    // Filter berdasarkan status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter berdasarkan bulan
    if ($request->filled('bulan')) {
        $query->whereMonth('tanggal_kejadian', $request->bulan);
    }

    // Filter berdasarkan tahun
    if ($request->filled('tahun')) {
        $query->whereYear('tanggal_kejadian', $request->tahun);
    }

    // Filter berdasarkan tanggal lengkap
    if ($request->filled('tanggal') && $request->filled('bulan') && $request->filled('tahun')) {
        $tanggalLengkap = Carbon::createFromDate($request->tahun, $request->bulan, $request->tanggal)->format('Y-m-d');
        $query->whereDate('tanggal_kejadian', $tanggalLengkap);
    }

    $pengaduan = $query->get();

    return view('client.pengaduan.index', compact('pengaduan', 'userName'));
}
    public function create()
    {
        return view('client.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan'   => 'required|string',
            'lokasi'          => 'required|string|max:255',
            'foto.*'          => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $pengaduan = new Pengaduan();
        $pengaduan->user_id = Auth::id();
        $pengaduan->judul_pengaduan = $request->judul_pengaduan;
        $pengaduan->isi_pengaduan   = $request->isi_pengaduan;
        $pengaduan->lokasi          = $request->lokasi;
        $pengaduan->tanggal_kejadian = Carbon::now();
        $pengaduan->status = 'Menunggu';
        $pengaduan->save();

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('pengaduan_foto', 'public');
                PengaduanFoto::create([
                    'pengaduan_id' => $pengaduan->id,
                    'foto' => $path
                ]);
            }
        }

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())->findOrFail($id);

        return view('client.pengaduan.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'isi_pengaduan'   => 'required|string',
            'lokasi'          => 'required|string|max:255',
            'foto.*'          => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $pengaduan->update([
            'judul_pengaduan' => $request->judul_pengaduan,
            'isi_pengaduan'   => $request->isi_pengaduan,
            'lokasi'          => $request->lokasi
        ]);

        // Tambah foto baru jika ada
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('pengaduan_foto', 'public');
                PengaduanFoto::create([
                    'pengaduan_id' => $pengaduan->id,
                    'foto' => $path
                ]);
            }
        }

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())->findOrFail($id);

        // Hapus foto dari storage & DB
        foreach ($pengaduan->foto as $foto) {
            Storage::disk('public')->delete($foto->foto);
            $foto->delete();
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
