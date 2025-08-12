<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PengaduanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Admin_PengaduanController extends Controller
{
    public function index(Request $request)
{
    $userName = Auth::user();

    $query = Pengaduan::with('user', 'foto')->latest();

    // Filter berdasarkan status jika dipilih
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

    // Filter berdasarkan tanggal jika lengkap (tanggal, bulan, tahun)
    if ($request->filled('tanggal') && $request->filled('bulan') && $request->filled('tahun')) {
        $tanggalLengkap = Carbon::createFromDate($request->tahun, $request->bulan, $request->tanggal)->format('Y-m-d');
        $query->whereDate('tanggal_kejadian', $tanggalLengkap);
    }

    $pengaduan = $query->get();

    return view('admin.pengaduan.index', compact('pengaduan', 'userName'));
}


     public function store(Request $request)
    {

        //  dd($request->all());
        $request->validate([
            'judul_pengaduan' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'required|in:0,1,2,3',
            'keterangan_kejadian' => 'required|string',
            'foto_kejadian.*' => 'nullable|image|max:2048', // max 2MB per foto
        ]);

        // Simpan pengaduan
        $pengaduan = Pengaduan::create([
            'user_id' => Auth::id(),
            'judul_pengaduan' => $request->judul_pengaduan,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'lokasi' => $request->lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
            'keterangan_kejadian' => $request->keterangan_kejadian,
        ]);

        // Simpan foto (maks 5)
        if ($request->hasFile('foto_kejadian')) {
            foreach ($request->file('foto_kejadian') as $index => $foto) {
                if ($index >= 5) break; // batasi maksimal 5
                $path = $foto->store('foto_pengaduan', 'public');

                PengaduanFoto::create([
                    'id_pengaduan' => $pengaduan->id_pengaduan,
                    'foto_kejadian' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
    }


    // update
    public function update(Request $request, $id_pengaduan)
{
    $request->validate([
        'judul_pengaduan' => 'required|string|max:255',
        'lokasi' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'status' => 'required|in:0,1,2,3',
        'keterangan_kejadian' => 'required|string',
        'foto_kejadian.*' => 'image|mimes:jpeg,png,jpg|max:2048', // validasi setiap file
    ]);

    $pengaduan = Pengaduan::findOrFail($id_pengaduan);

    $pengaduan->judul_pengaduan = $request->judul_pengaduan;
    $pengaduan->lokasi = $request->lokasi;
    $pengaduan->latitude = $request->latitude;
    $pengaduan->longitude = $request->longitude;
    $pengaduan->status = $request->status;
    $pengaduan->keterangan_kejadian = $request->keterangan_kejadian;
    $pengaduan->save();

    // Jika ada file foto baru di-upload
    if ($request->hasFile('foto_kejadian')) {
        foreach ($request->file('foto_kejadian') as $file) {
            $path = $file->store('foto_pengaduan', 'public');
            $pengaduan->foto()->create([
                'foto_kejadian' => $path,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Pengaduan berhasil diperbarui.');
}



    public function destroy($id_pengaduan)
{
    $pengaduan = Pengaduan::with('foto')->findOrFail($id_pengaduan);

    // Hapus semua file foto kejadian yang terkait dari penyimpanan
    foreach ($pengaduan->foto as $foto) {
        if (Storage::disk('public')->exists($foto->foto_kejadian)) {
            Storage::disk('public')->delete($foto->foto_kejadian);
        }
        $foto->delete(); // hapus record dari database
    }

    // Hapus record pengaduan
    $pengaduan->delete();

    return redirect()->back()->with('success', 'Pengaduan dan semua foto terkait berhasil dihapus.');
}


public function updateStatus(Request $request, $id_pengaduan)
{
    $request->validate([
        'status' => 'required|in:0,1,2,3',
    ]);

    $pengaduan = Pengaduan::findOrFail($id_pengaduan);
    $pengaduan->status = $request->status;
    $pengaduan->save();

    return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui.');
}

}
