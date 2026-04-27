<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::post('/contact', [FrontController::class, 'contact'])->name('front.contact');

Route::get('/post/{post}', [FrontController::class, 'post'])->name('front.post');

Route::post('/subscribe', [FrontController::class, 'subscribe'])->name('front.subscribe');
Route::get('/unsubscribe/{token}', [FrontController::class, 'unsubscribe'])->name('front.unsubscribe')->middleware('signed');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
