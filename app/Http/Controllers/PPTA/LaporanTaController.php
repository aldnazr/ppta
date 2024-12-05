<?php

namespace App\Http\Controllers\PPTA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanTaController extends Controller
{
    function index(Request $request)
    {
        return view('ppta.laporanta', [])->with([
            'user' => 'ppta'
        ]);
    }
}
