<?php

use App\Http\Controllers\BakteriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/bakteri/{id}', [BakteriController::class, 'show'])->name('bakteri.show');