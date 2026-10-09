<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Fakultas Kedokteran Universitas Bumigora
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.show');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:10,1');
