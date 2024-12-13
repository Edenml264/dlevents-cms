<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\NavbarSettingController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/servicios', [ServiceController::class, 'index'])->name('services');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

// Rutas de administración
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // CMS Routes
    Route::prefix('cms')->name('cms.')->group(function () {
        Route::get('/', [CmsController::class, 'index'])->name('index');
        Route::get('/settings', [CmsController::class, 'settings'])->name('settings');
        Route::post('/settings', [CmsController::class, 'updateSettings'])->name('settings.update');
        Route::get('/page/{page}', [CmsController::class, 'editPage'])->name('edit-page');
        Route::get('/preview/{page}', [CmsController::class, 'preview'])->name('preview');
        Route::put('/section/{section}', [CmsController::class, 'updateSection'])->name('section.update');
        
        // Rutas para la configuración del navbar
        Route::get('/navbar', [NavbarSettingController::class, 'edit'])->name('navbar.edit');
        Route::put('/navbar', [NavbarSettingController::class, 'update'])->name('navbar.update');
    });

    // Leads
    Route::resource('leads', LeadController::class);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password.update');

    // Media management
    Route::post('upload', [MediaController::class, 'upload'])->name('upload');
    Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
});

require __DIR__.'/auth.php';
