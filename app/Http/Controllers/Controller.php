<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

abstract class Controller
{
    protected function prodiMapping()
    {
        $response = Http::get('https://kpta84.dinamika.ac.id/18410100143/ppta/public/api/prodi');
        return collect($response->json());
    }
}
