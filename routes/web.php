<?php

use App\Http\Controllers\BerkasController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TAPerangkatanController;
use App\Http\Controllers\JadwalBimbinganController;
use App\Http\Controllers\UsulanTugasAkhirController;
use App\Http\Controllers\PencarianPembimbingController;


Route::get('/blog', function () {
    return view('blog', [
        'title' => 'Blog Page',
        'posts' => Post::all()
    ]);
});

Route::get('/document', function () {
    return view('document', ['title' => 'Contact Page']);
});

Route::get('/penilaian', function () {
    return view('penilaian');
});

Route::get('/mhshome', function () {
    return view('mhshome', ['title' => 'Contact Page']);
});

Route::get('/post/{id}', function ($id) {
    $post = Post::find($id);

    return view('post', ['title' => 'Full Post', 'post' => $post]);
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

Route::get('/berkas', [BerkasController::class, 'index']);

// Handle login submissions
// Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout functionality
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
// Route::middleware(['loggedin'])->group(function () {
//     Route::get('/', [HomeController::class, 'index']);
// });
