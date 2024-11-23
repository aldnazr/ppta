<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TAPerangkatanController;
use App\Http\Controllers\JadwalBimbinganController;
use App\Http\Controllers\UsulanTugasAkhirController;
use App\Http\Controllers\PencarianPembimbingController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('home', ['title' => 'Home Page']);
// });

Route::get('/blog', function () {
    return view('blog', [
        'title' => 'Blog Page',
        'posts' => Post::all()
    ]);
});


Route::get('/document', function () {
    return view('document', ['title' => 'Contact Page']);
});

// Route::get('/jadbimbingan', function () {
//     return view('jadbimbingan', ['title' => 'Contact Page']);
// });

// Route::get('/usulan', function () {
//     return view('usulan', ['title' => 'Contact Page']);
// });

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

// Route::view('/login', 'login')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
