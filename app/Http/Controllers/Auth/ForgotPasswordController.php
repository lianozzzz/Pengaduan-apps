<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'no_hp' => 'required',
            'username' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('no_hp', $request->no_hp)
                    ->where('username', $request->username)
                    ->first();

        if (!$user) {
            return back()->withErrors(['msg' => 'Data tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
    }
}
