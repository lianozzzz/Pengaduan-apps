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
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nama_lengkap'  => ['required', 'string', 'max:30', 'regex:/^[A-Za-z\s]+$/'],
        'username'      => ['required', 'string', 'max:15', 'unique:users,username'],
        'jenis_kelamin' => ['required', 'in:Laki-Laki,Perempuan'],
        'tanggal_lahir' => ['required', 'date'],
        'no_hp'         => ['required', 'digits_between:10,12', 'numeric', 'unique:users,no_hp'],
        'password'      => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'nama_lengkap'  => $request->nama_lengkap,
        'username'      => $request->username,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'no_hp'         => $request->no_hp,
        'password'      => Hash::make($request->password),
        'role'          => 'user',
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

}
