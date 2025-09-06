<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BakteriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

// Artikel (daftar)
Route::get('/article', [ArticleController::class, 'index'])->name('articles.index');

// Artikel detail
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Bakteri (punya controller sendiri, tetap biarin)
Route::get('/bakteri/{id}', [BakteriController::class, 'show'])->name('bakteri.show');
Route::get('/bakteri/{id}/studio', [BakteriController::class, 'studio'])->name('bakteri.studio');

// Route untuk menampilkan pre-test dan post-test
Route::get('/bakteri/{id}/quiz/{type}', [BakteriController::class, 'showQuiz'])->name('bakteri.quiz');

// Route untuk memproses jawaban kuis
Route::post('/bakteri/{id}/quiz/{type}', [BakteriController::class, 'submitQuiz'])->name('bakteri.submitQuiz');

// Route untuk menampilkan halaman hasil
Route::get('/bakteri/{id}/result', [BakteriController::class, 'showResult'])->name('bakteri.result');
