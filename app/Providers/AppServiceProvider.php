<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::defaultView('vendor.pagination.custom-pagination');

        // Share nik and nama to all views and components
        View::composer('*', function ($view) {
            $nik = session('nik'); // Ambil NIK dari session
            $nama = session('nama'); // Ambil Nama dari session

            // Kirim data ke view
            $view->with([
                'nik' => $nik,
                'nama' => $nama,
            ]);
        });
    }
}
