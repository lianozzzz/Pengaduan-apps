<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // login
    public function index(){

        return view('auth.login');
    }

    // register
    public function create(){

        return view('auth.register');
    }


   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'no_hp' => [
            'required',
            'digits_between:10,13',
            'numeric',
            'unique:users,no_hp', // pastikan unik di tabel users kolom no_hp
        ],
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'no_hp.required' => 'Nomor HP wajib diisi.',
        'no_hp.digits_between' => 'Nomor HP harus antara 10 sampai 13 digit.',
        'no_hp.numeric' => 'Nomor HP hanya boleh berisi angka.',
        'no_hp.unique' => 'Nomor HP sudah digunakan.',
        'name.required' => 'Nama wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    // Simpan user baru
    $user = \App\Models\User::create([
        'no_hp' => $request->no_hp,
        'name' => $request->name,
        'password' => bcrypt($request->password),
    ]);

    // Login otomatis setelah registrasi (opsional)
    auth()->login($user);

    // Redirect ke halaman setelah login
    return redirect()->route('dashboard')->with('success', 'Registrasi berhasil.');
}


public function resetPasswordManual(Request $request)
{
    $request->validate([
        'no_hp'         => 'required|digits_between:10,13',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        'password'      => 'required|string|min:6|confirmed',
    ], [
        'no_hp.required' => 'No HP wajib diisi.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'password.required' => 'Password baru wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    // Cari user berdasarkan no_hp, tanggal_lahir, dan jenis_kelamin
    $user = User::where('no_hp', $request->no_hp)
                ->where('tanggal_lahir', $request->tanggal_lahir)
                ->where('jenis_kelamin', $request->jenis_kelamin)
                ->first();

    if (!$user) {
        return back()->withErrors(['Data tidak ditemukan atau salah.']);
    }

    // Update password
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
}


}
