<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return $this->redirectToRoleDashboard(Auth::user()->role);
        }

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            throw ValidationException::withMessages([
                'username' => ['Username atau password salah.'],
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return $this->redirectToRoleDashboard($user->role);
    }

    protected function redirectToRoleDashboard($role)
    {
        return match ($role) {
            'admin' => redirect()->route('dashboard.admin'),
            'user' => redirect()->route('dashboard.user'),
            default => abort(403, 'Role tidak dikenali.'),
        };
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
