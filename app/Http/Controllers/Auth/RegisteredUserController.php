<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  public function store(Request $request)
{
    $request->validate([
        'no_hp' => [
            'required',
            'digits_between:10,13',
            'numeric',
            'unique:users,no_hp',
        ],
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'no_hp.unique' => 'Nomor HP sudah digunakan.',
    ]);

    User::create([
        'no_hp' => $request->no_hp,
        'name' => $request->name,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('dashboard');
}


}
