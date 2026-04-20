<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class FfServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // For Laravel 10 (Kernel): register middleware in app/Http/Kernel.php manually
        // For Laravel 11: register middleware alias in bootstrap/app.php (see README note)
    }
}
