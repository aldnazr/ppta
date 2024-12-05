<?php

namespace App\Http\Controllers\PPTA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanFkController extends Controller
{
    function index(Request $request)
    {
        return view('ppta.laporanfk', [])->with([
            'user' => 'ppta'
        ]);
    }
}
