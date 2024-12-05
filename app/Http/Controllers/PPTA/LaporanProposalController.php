<?php

namespace App\Http\Controllers\PPTA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanProposalController extends Controller
{
    function index(Request $request)
    {
        return view('ppta.laporanproposal', [])->with([
            'user' => 'ppta'
        ]);
    }
}
