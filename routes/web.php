<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\MediaController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/servicios', [ServiceController::class, 'index'])->name('services');
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'store'])->name('contact.store');

// Rutas de administración
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas de leads
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
    Route::get('/leads/{lead}/edit', [LeadController::class, 'edit'])->name('leads.edit');
    Route::put('/leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
    
    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password.update');

    // Rutas del CMS
    Route::prefix('cms')->name('cms.')->group(function () {
        // Gestión de secciones
        Route::resource('sections', PageSectionController::class);
        
        // Gestión del menú
        Route::resource('menu', MenuItemController::class);
        
        // Gestión de medios
        Route::post('upload', [MediaController::class, 'upload'])->name('upload');
        Route::delete('media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
        
        // Ruta para inicializar las secciones de la página de inicio
        Route::get('/initialize-home', [PageSectionController::class, 'initializeHomeSections'])
            ->name('initialize-home');
    });
});

require __DIR__.'/auth.php';
