<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class User_AkunControler extends Controller
{
      public function index()
    {
        $userName = auth()->user();
        return view('client.akun.index', compact('userName'));
    }

    // Proses update data akun user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => [
                'required',
                'string',
                'max:30',
                'regex:/^[A-Za-z\s]+$/'
            ],
            'username' => 'required|string|max:15|unique:users,username,' . $user->id,
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|digits_between:10,12|numeric',
            'password' => 'nullable|string|min:6|max:10',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 30 karakter.',

            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username maksimal 15 karakter.',
            'username.unique' => 'Username sudah digunakan.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 sampai 12 digit angka.',
            'no_hp.numeric' => 'Nomor HP hanya boleh berisi angka.',

            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password maksimal 10 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan, mohon periksa inputan Anda.');
        }


        $user->nama_lengkap = $request->nama_lengkap;
        $user->username = $request->username;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->no_hp = $request->no_hp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('akun.user')->with('success', 'Data akun berhasil diperbarui.');
    }
}
