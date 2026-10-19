<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Fakultas Kedokteran Universitas Bumigora
|--------------------------------------------------------------------------
*/

// 1. Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Profil
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');

// 3. Akademik
Route::get('/kurikulum', [CurriculumController::class, 'index'])->name('curriculum');
Route::get('/fasilitas', [FacilityController::class, 'index'])->name('facilities');
Route::get('/dosen', [FacultyController::class, 'index'])->name('faculty');
Route::get('/rs-pendidikan', [HospitalController::class, 'index'])->name('hospital');

// 4. Berita
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// 5. Galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// 6. Kontak
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:10,1');

// Program Studi Detail & Language
Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.show');
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en', 'zh'], true)) {
        session(['locale' => $locale]);
    }

    return redirect()->back(fallback: route('home'));
})->name('locale.switch');
