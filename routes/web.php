<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\BerkasController;
use App\Http\Controllers\PPTA\SidangTaController;
use App\Http\Controllers\Mahasiswa\HomeController;
use App\Http\Controllers\Dosen\DashboardController;
use App\Http\Controllers\Mahasiswa\TAPerangkatanController;
use App\Http\Controllers\Mahasiswa\JadwalBimbinganController;
use App\Http\Controllers\Mahasiswa\UsulanTugasAkhirController;
use App\Http\Controllers\Mahasiswa\PencarianPembimbingController;
use App\Http\Controllers\PPTA\LaporanFkController;
use App\Http\Controllers\PPTA\LaporanProposalController;
use App\Http\Controllers\PPTA\LaporanTaController;
use App\Http\Controllers\PPTA\MaintenanceController;
use App\Http\Controllers\PPTA\ProposalTaController;

Route::get('/document', function () {
    return view('mahasiswa.document', ['title' => 'Contact Page']);
});
Route::get('/taperangkatan', [TAPerangkatanController::class, 'index'])->name('taperangkatan');
Route::get('/taperangkatan/jurusan', [TAPerangkatanController::class, 'getByJurusan'])->name('taperangkatanjurusan');

Route::get('/pencarianpembimbing', [PencarianPembimbingController::class, 'index'])->name('pencarianpembimbing');
Route::get('/', [HomeController::class, 'index']);
Route::get('/usulan', [UsulanTugasAkhirController::class, 'index']);

Route::get('/jadbimbingan', [JadwalBimbinganController::class, 'index']);
Route::get('/jadbimbingan-dosen', [JadwalBimbinganController::class, 'getJadwalDosen']);

Route::get('/login', function () {
    return view('login'); // Replace with your login page
});

// Dosen Route
Route::redirect('/dosen', '/dosen/dashboard');
Route::get('/dosen/dashboard', [DashboardController::class, 'index']);
Route::get('/dosen/dashboard/penilaian/{id}', [BerkasController::class, 'penilaian'])->name('dashboard.penilaian');
Route::get('/dosen/berkas', [BerkasController::class, 'index']);
Route::get('/dosen/berkas/penilaian/{id}', [BerkasController::class, 'penilaian'])->name('berkas.penilaian');


//PPTA Route
Route::redirect('/ppta', '/ppta/proposal_ta');
Route::get('/ppta/proposal_ta', [ProposalTaController::class, 'index']);
Route::get('/ppta/sidang_ta', [SidangTaController::class, 'index'])->name('ppta.sidangta');
Route::get('/ppta/maintenance', [MaintenanceController::class, 'index']);

Route::get('/ppta/laporan_fk', [LaporanFkController::class, 'index']);
Route::get('/ppta/laporan_fk_pdf', [LaporanFkController::class, 'generatePdf'])->name('ppta.laporan_fk_pdf');

Route::get('/ppta/laporan_proposal', [LaporanProposalController::class, 'index']);
Route::get('/ppta/laporan_proposal_pdf', [LaporanProposalController::class, 'generatePdf'])->name('ppta.laporan_proposal_pdf');

Route::get('/ppta/laporan_ta', [LaporanTaController::class, 'index']);
Route::get('/ppta/laporan_ta_pdf', [LaporanTaController::class, 'generatePdf'])->name('ppta.laporan_ta_pdf');;


// Handle login submissions
// Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout functionality
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
// Route::middleware(['loggedin'])->group(function () {
//     Route::get('/', [HomeController::class, 'index']);
// });
