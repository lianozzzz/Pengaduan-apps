<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $query->whereMonth('created_at', $request->bulan);
    }

    // Filter berdasarkan tahun
    if ($request->filled('tahun')) {
        $query->whereYear('created_at', $request->tahun);
    }

    // Filter berdasarkan tanggal lengkap
    if ($request->filled('tanggal') && $request->filled('bulan') && $request->filled('tahun')) {
        $tanggalLengkap = Carbon::createFromDate($request->tahun, $request->bulan, $request->tanggal)->format('Y-m-d');
        $query->whereDate('created_at', $tanggalLengkap);
    }

    $pengaduan = $query->get();

    return view('client.pengaduan.index', compact('pengaduan', 'userName'));
}

  // Simpan pengaduan baru
   public function store(Request $request)
        {

            // dd($request->all());

        $validator = Validator::make($request->all(), [
            'judul_pengaduan' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'tanggal_kejadian' => 'required|date',
            'lokasi' => 'nullable|string|max:50',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'keterangan_kejadian' => 'required|string|max:1000',
            'status' => 'required|string|max:20',
            'foto_kejadian' => 'nullable|array',
            'foto_kejadian.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'judul_pengaduan.required' => 'Judul pengaduan wajib diisi.',
            'judul_pengaduan.max' => 'Judul pengaduan maksimal 50 karakter.',
            'judul_pengaduan.regex' => 'Judul pengaduan hanya boleh berisi huruf dan spasi.',

            'lokasi.max' => 'Lokasi maksimal 50 karakter.',
            
            'latitude.between' => 'Latitude harus antara -90 hingga 90.',
            'longitude.between' => 'Longitude harus antara -180 hingga 180.',

            'keterangan_kejadian.required' => 'Keterangan kejadian wajib diisi.',
            'keterangan_kejadian.max' => 'Keterangan kejadian maksimal 1000 karakter.',

            'status.required' => 'Status wajib diisi.',
            'status.max' => 'Status maksimal 20 karakter.',

            'foto_kejadian.*.image' => 'Setiap file harus berupa gambar.',
            'foto_kejadian.*.mimes' => 'Gambar harus bertipe jpg, jpeg, atau png.',
            'foto_kejadian.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan, mohon periksa inputan Anda.');
        }


    $pengaduan = new Pengaduan();
    $pengaduan->user_id = Auth::id();
    $pengaduan->judul_pengaduan = $request->judul_pengaduan;
    
    $pengaduan->lokasi = $request->lokasi;
    $pengaduan->latitude = $request->latitude;
    $pengaduan->longitude = $request->longitude;
    $pengaduan->keterangan_kejadian = $request->keterangan_kejadian;
    $pengaduan->status = 0; // default pending
    $pengaduan->save();

    // Simpan foto jika ada
    if ($request->hasFile('foto_kejadian')) {
    foreach ($request->file('foto_kejadian') as $file) {
        $path = $file->store('foto_pengaduan', 'public');

        $pengaduan->foto()->create([
            'foto_kejadian' => $path
        ]);
    }
}


    return redirect()->back()->with('success', 'Pengaduan berhasil dikirim.');
}


   public function update(Request $request, $id)
{
    $pengaduan = Pengaduan::where('user_id', Auth::id())->findOrFail($id);
        $validator = Validator::make($request->all(), [
            'judul_pengaduan' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'lokasi' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'keterangan_kejadian' => 'required|string|max:1000',
            'foto_kejadian' => 'nullable|array|max:5',
            'foto_kejadian.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Judul Pengaduan
            'judul_pengaduan.required' => 'Judul pengaduan wajib diisi.',
            'judul_pengaduan.string' => 'Judul pengaduan harus berupa teks.',
            'judul_pengaduan.max' => 'Judul pengaduan maksimal 255 karakter.',
            'judul_pengaduan.regex' => 'Judul pengaduan hanya boleh berisi huruf dan spasi.',

            // Lokasi
            'lokasi.string' => 'Lokasi harus berupa teks.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',

            // Latitude & Longitude
            'latitude.numeric' => 'Latitude harus berupa angka.',
            'latitude.between' => 'Latitude harus berada di antara -90 hingga 90.',
            'longitude.numeric' => 'Longitude harus berupa angka.',
            'longitude.between' => 'Longitude harus berada di antara -180 hingga 180.',

            // Keterangan Kejadian
            'keterangan_kejadian.required' => 'Keterangan kejadian wajib diisi.',
            'keterangan_kejadian.string' => 'Keterangan kejadian harus berupa teks.',
            'keterangan_kejadian.max' => 'Keterangan kejadian maksimal 1000 karakter.',

            // Foto Kejadian
            'foto_kejadian.array' => 'Format foto kejadian tidak valid.',
            'foto_kejadian.max' => 'Maksimal 5 foto kejadian yang diperbolehkan.',
            'foto_kejadian.*.image' => 'Setiap file foto harus berupa gambar.',
            'foto_kejadian.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_kejadian.*.max' => 'Ukuran setiap gambar maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan, mohon periksa kembali inputan Anda.');
        }


    $pengaduan->judul_pengaduan = $request->judul_pengaduan;
    $pengaduan->tanggal_kejadian = $request->tanggal_kejadian;
    $pengaduan->lokasi = $request->lokasi;
    $pengaduan->latitude = $request->latitude;
    $pengaduan->longitude = $request->longitude;
    $pengaduan->keterangan_kejadian = $request->keterangan_kejadian;
    $pengaduan->save();

    // Simpan foto baru jika ada
    if ($request->hasFile('foto_kejadian')) {

        // ❗️Opsi: hapus foto lama jika diperlukan
        foreach ($pengaduan->foto as $foto) {
            if (Storage::disk('public')->exists($foto->foto_kejadian)) {
                Storage::disk('public')->delete($foto->foto_kejadian);
            }
            $foto->delete();
        }

        foreach ($request->file('foto_kejadian') as $file) {
            $path = $file->store('foto_pengaduan', 'public');

            $pengaduan->foto()->create([
                'foto_kejadian' => $path
            ]);
        }
    }

    return redirect()->back()->with('success', 'Pengaduan berhasil diperbarui.');
}


    // Hapus pengaduan
    public function destroy($id)
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())->findOrFail($id);

        if ($pengaduan->lampiran && Storage::disk('public')->exists($pengaduan->lampiran)) {
            Storage::disk('public')->delete($pengaduan->lampiran);
        }

        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }

}
