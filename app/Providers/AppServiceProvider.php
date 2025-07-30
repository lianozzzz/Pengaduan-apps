<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    //     Fortify::authenticateUsing(function (Request $request) {
    //     $user = User::where('username', $request->username)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         return $user;
    //     }

    //     return null;
    // });

     Carbon::setLocale('id'); // Set global
    setlocale(LC_TIME, 'id_ID'); // Tambahan untuk sistem operasi jika perlu
    }
}
