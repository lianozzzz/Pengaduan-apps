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
    $validator = Validator::make($request->all(), [
        'nama_lengkap'    => 'required|string|max:255',
        'jenis_kelamin'   => 'required|in:Laki-Laki,Perempuan',
        'tanggal_lahir'   => 'required|date',
        'no_hp'           => 'required|digits_between:10,13|unique:users,no_hp',
        'username'        => 'required|string|max:255|unique:users,username',
        'password'        => 'required|string|min:6',
    ], [
        'nama_lengkap.required'    => 'Nama lengkap wajib diisi.',
        'jenis_kelamin.required'   => 'Jenis kelamin wajib dipilih.',
        'tanggal_lahir.required'   => 'Tanggal lahir wajib diisi.',
        'no_hp.required'           => 'No HP wajib diisi.',
        'no_hp.digits_between'     => 'No HP harus antara 10 sampai 13 digit.',
        'no_hp.unique'             => 'No HP sudah digunakan.', // Pesan khusus
        'username.required'        => 'Username wajib diisi.',
        'username.unique'          => 'Username sudah digunakan.',
        'password.required'        => 'Password wajib diisi.',
        'password.min'             => 'Password minimal 6 karakter.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    User::create([
        'nama_lengkap'   => $request->nama_lengkap,
        'jenis_kelamin'  => $request->jenis_kelamin,
        'tanggal_lahir'  => $request->tanggal_lahir,
        'no_hp'          => $request->no_hp,
        'username'       => $request->username,
        'password'       => Hash::make($request->password),
        'role'           => 'user',
    ]);

    return redirect()->route('login')->with('success', 'Akun kamu telah dibuat. Silakan login.');
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
