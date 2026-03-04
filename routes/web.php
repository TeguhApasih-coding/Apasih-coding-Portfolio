<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SidebarController;
use App\Http\Controllers\Admin\SkillCategoryController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController as ControllersProjectController;
use App\Livewire\Admin\Projects\Index;
use App\Livewire\Admin\Skills\Index as SkillsIndex;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');

// Send Message
Route::post('/contact/send', [ContactController::class, 'sendMessage'])->name('contact.send');

// Projects routes for frontend
Route::controller(ControllersProjectController::class)->prefix('projects')->name('projects.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/search', 'search')->name('search');
    Route::get('/skill/{skill:slug}', 'filterBySkill')->name('skill');
    Route::get('/{project:slug}', 'show')->name('show'); // ⬅️ HAPUS :slug, karena sudah ada getRouteKeyName() di model
    Route::post('/{project}/like', 'like')->name('like');
    Route::post('/{project}/share', 'share')->name('share');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Admin Page
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [MainController::class, 'indexOfAdmin'])->name('home');

    // Projects Routes
    Route::prefix('projects')->name('projects.')->group(function() {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/search', [ProjectController::class, 'search'])->name('search');
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/bulk-action', [ProjectController::class, 'bulkAction'])->name('bulk-action');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::get('/show/{project}', [ProjectController::class, 'show'])->name('show');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
    });
    // Route::prefix('projects')->name('projects.')->group(function () {
    //     // ⬅️⬅️⬅️ GUNAKAN FUNCTION INI UNTUK LIVEWIRE ⬅️⬅️⬅️
    //     Route::get('/', function() {
    //         return view('admin.projects.index'); // Render wrapper view
    //     })->name('index');
        
    //     Route::get('/create', [ProjectController::class, 'create'])->name('create');
    //     Route::post('/', [ProjectController::class, 'store'])->name('store');
    //     Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
    //     Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
    //     Route::put('/{project}', [ProjectController::class, 'update'])->name('update');
    //     Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');
    // });

    // Contact Page Admin
    Route::prefix('contact-messages')->name('contact.')->group(function() {
        Route::get('/', [ContactController::class, 'index'])->name('message');
        Route::get('/{message}', [ContactController::class, 'show'])->name('message.show');
        Route::post('/{message}/read', [ContactController::class, 'markAsRead'])->name('mark-read');
        Route::post('/{message}/spam', [ContactController::class, 'markAsSpam'])->name('mark-spam');
        Route::delete('/{message}', [ContactController::class, 'destroy'])->name('message.destroy');
        Route::post('/bulk-action', [ContactController::class, 'bulkAction'])->name('bulk-action');
    });

    // Skill Categories Routes
    Route::prefix('skill-categories')->name('skill-categories.')->group(function() {
        Route::get('/', [SkillCategoryController::class, 'index'])->name('index');
        Route::get('/create', [SkillCategoryController::class, 'create'])->name('create');
        Route::post('/', [SkillCategoryController::class, 'store'])->name('store');
        Route::get('/{skillCategory}/edit', [SkillCategoryController::class, 'edit'])->name('edit');
        Route::put('/{skillCategory}', [SkillCategoryController::class, 'update'])->name('update');
        Route::delete('/{skillCategory}', [SkillCategoryController::class, 'destroy'])->name('destroy');
        Route::post('/reorder', [SkillCategoryController::class, 'reorder'])->name('reorder');
        Route::post('/{skillCategory}/toggle-status', [SkillCategoryController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Skills
    Route::prefix('skills')->name('skills.')->group(function () {
        Route::post('reorder', [SkillController::class, 'reorder'])->name('reorder');
        Route::post('{skill}/toggle-status', [SkillController::class, 'toggleStatus'])->name('toggle-status');
        // Resource route di bawah
        Route::get('/', [SkillController::class, 'index'])->name('index');
        Route::get('/create', [SkillController::class, 'create'])->name('create');
        Route::post('/', [SkillController::class, 'store'])->name('store');
        Route::get('/{skill}', [SkillController::class, 'show'])->name('show');
        Route::get('/{skill}/edit', [SkillController::class, 'edit'])->name('edit');
        Route::put('/{skill}', [SkillController::class, 'update'])->name('update');
        Route::delete('/{skill}', [SkillController::class, 'destroy'])->name('destroy');
    });
    //Route::resource('skills', SkillController::class);    

    // Sidebar toggle
    // Route::post('/sidebar/toggle', [SidebarController::class, 'toggle'])->name('sidebar.toggle');
});

require __DIR__.'/auth.php';
