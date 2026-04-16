<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ExperienceController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\PortfolioController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SkillController;
use App\Http\Controllers\Dashboard\StatisticController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::put('/profile' , [ProfileController::class, 'storeAndUpdate'])->name('profiles.storeAndUpdate');
    Route::get('/skills/trash', [SkillController::class, 'trash'])->name('skills.trash');
    Route::get('/skills/{skill}/restore', [SkillController::class, 'restore'])->withTrashed()->name('skills.restore');
    Route::delete('/skills/{skill}/force-delete', [SkillController::class, 'forceDelete'])->withTrashed()->name('skills.forceDelete');
    Route::resource('skills', SkillController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('experiences', ExperienceController::class);
    Route::resource('statistics', StatisticController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('images', ImageController::class);
    Route::resource('settings', SettingController::class);
});
