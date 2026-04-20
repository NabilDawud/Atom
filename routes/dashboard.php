<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ExperienceController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\PortfolioController;
use App\Http\Controllers\Dashboard\PostContentController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SkillController;
use App\Http\Controllers\Dashboard\StatisticController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'storeAndUpdate'])->name('profiles.storeAndUpdate');

    Route::get('/skills/trash', [SkillController::class, 'trash'])->name('skills.trash');
    Route::get('/skills/{skill}/restore', [SkillController::class, 'restore'])->withTrashed()->name('skills.restore');
    Route::delete('/skills/{skill}/force-delete', [SkillController::class, 'forceDelete'])->withTrashed()->name('skills.forceDelete');
    Route::resource('skills', SkillController::class);

    Route::get('/services/trash', [ServiceController::class, 'trash'])->name('services.trash');
    Route::get('/services/{service}/restore', [ServiceController::class, 'restore'])->withTrashed()->name('services.restore');
    Route::delete('/services/{service}/force-delete', [ServiceController::class, 'forceDelete'])->withTrashed()->name('services.forceDelete');
    Route::resource('services', ServiceController::class);

    Route::get('/portfolios/trash', [PortfolioController::class, 'trash'])->name('portfolios.trash');
    Route::get('/portfolios/{portfolio}/restore', [PortfolioController::class, 'restore'])->withTrashed()->name('portfolios.restore');
    Route::delete('/portfolios/{portfolio}/force-delete', [PortfolioController::class, 'forceDelete'])->withTrashed()->name('portfolios.forceDelete');
    Route::resource('portfolios', PortfolioController::class);

    Route::get('/clients/trash', [ClientController::class, 'trash'])->name('clients.trash');
    Route::get('/clients/{client}/restore', [ClientController::class, 'restore'])->withTrashed()->name('clients.restore');
    Route::delete('/clients/{client}/force-delete', [ClientController::class, 'forceDelete'])->withTrashed()->name('clients.forceDelete');
    Route::resource('clients', ClientController::class);

    Route::get('/experiences/trash', [ExperienceController::class, 'trash'])->name('experiences.trash');
    Route::get('/experiences/{experience}/restore', [ExperienceController::class, 'restore'])->withTrashed()->name('experiences.restore');
    Route::delete('/experiences/{experience}/force-delete', [ExperienceController::class, 'forceDelete'])->withTrashed()->name('experiences.forceDelete');
    Route::resource('experiences', ExperienceController::class);

    Route::get('/statistics/trash', [StatisticController::class, 'trash'])->name('statistics.trash');
    Route::get('/statistics/{statistic}/restore', [StatisticController::class, 'restore'])->withTrashed()->name('statistics.restore');
    Route::delete('/statistics/{statistic}/force-delete', [StatisticController::class, 'forceDelete'])->withTrashed()->name('statistics.forceDelete');
    Route::resource('statistics', StatisticController::class);

    Route::get('/categories/{category}/cat-posts', [CategoryController::class, 'catPosts'])->name('categories.cat-Posts');
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::get('/categories/{category}/restore', [CategoryController::class, 'restore'])->withTrashed()->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->withTrashed()->name('categories.forceDelete');
    Route::resource('categories', CategoryController::class);

    Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->withTrashed()->name('posts.restore');
    Route::delete('/posts/{post}/force-delete', [PostController::class, 'forceDelete'])->withTrashed()->name('posts.forceDelete');
    Route::resource('posts', PostController::class);

    Route::get('/post_contents/trash', [PostContentController::class, 'trash'])->name('post_contents.trash');
    Route::get('/post_contents/{post_content}/restore', [PostContentController::class, 'restore'])->withTrashed()->name('post_contents.restore');
    Route::delete('/post_contents/{post_content}/force-delete', [PostContentController::class, 'forceDelete'])->withTrashed()->name('post_contents.forceDelete');
    Route::resource('post_contents', PostContentController::class);

    Route::resource('contacts', ContactController::class);
    Route::resource('images', ImageController::class);
    Route::resource('settings', SettingController::class);
});
