<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Admin_AkunController extends Controller
{
    public function index(){

        $userName = Auth::user();
        return view('admin.akun.index',compact('userName'));
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'jenis_kelamin' => 'required',
        'tanggal_lahir' => 'required|date',
        'no_hp' => 'required|string|max:12',
    ]);

    $user = User::findOrFail($id);
    $user->nama_lengkap = $request->nama_lengkap;
    $user->username = $request->username;
    $user->jenis_kelamin = $request->jenis_kelamin;
    $user->tanggal_lahir = $request->tanggal_lahir;
    $user->no_hp = $request->no_hp;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->back()->with('success', 'Data akun berhasil diperbarui.');
}


     public function pengguna(Request $request)
    {
        $userName = Auth::user();
        $query = User::query();

        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('admin.pengguna.index', compact('userName', 'users'));
    }


    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('passwordku123'); // Atau pakai tanggal lahir dll
        $user->save();

    return redirect()->back()->with('success', 'Password berhasil direset.');
    }
    

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

    return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }


    public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
        'tanggal_lahir' => 'required|date',
        'no_hp' => 'required|string|max:20',
        'username' => 'required|string|max:50|unique:users,username',
        'password' => 'required|string|min:6',
        'role' => 'required|in:admin,user',
    ]);

    User::create([
        'nama_lengkap' => $request->nama_lengkap,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'no_hp' => $request->no_hp,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
}

}

