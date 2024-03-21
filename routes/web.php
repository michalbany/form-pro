<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

use App\Http\Controllers\{
    ProfileController,
    ProjectController,
    TextFieldController,
    PageController
};
use App\Services\EditorService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// FINE přesun na dashboard
Route::get('/dashboard', [ProjectController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    // FINE  vytvoření nového projektu 
    Route::post('/projects', [ProjectController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('projects.create');
    
    // FINE  smazání projektu
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('projects.destroy');
    
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    
    // @todo: Optimalizace route pro oddělení stánky a projektu
    
    // @note: Routes pro Editor:
    Route::get('/test/{project}', [EditorService::class, 'test'])
        ->name('test');

// -------------------------- //


Route::get('/project/{project}/edit', [EditorService::class, 'init'])
    ->middleware(['auth', 'verified'])
    ->name('edit.project.show');

Route::get('/project/{project}/{page}/edit', [EditorService::class, 'init'])
    ->middleware(['auth', 'verified'])
    ->name('edit.page.show');

// @deprecated - Smazat metody v Controllerech následně
// // Pro zobrazení editoru a načtení základních dat
// Route::get('/project/{project}/edit', [ProjectController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('edit.project.show');


// // Zobrazení jednotlivé stránky projektu
// Route::get('/project/{project}/{page}/edit', [PageController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('edit.page.show');
    
    
// Route::get('/project/{project}/view', [ProjectController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('view.project.show');


// // Zobrazení jednotlivé stránky projektu
// Route::get('/project/{project}/{page}/view', [PageController::class, 'show'])
//     ->middleware(['auth', 'verified'])
//     ->name('view.page.show');



// -------------------------- //


// Přesun na aktualizaci/vytvoření projektu
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('projects.edit');

// @change Aktualizace projektu (nazev)
Route::put('/projects/{project}', [ProjectController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('projects.update');

// @change Aktualizace stránky (nazev)
Route::put('/pages/{page}', [PageController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('pages.update');

// @note: přidání stránek a podstránek
Route::post('/pages', [PageController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('pages.create');

// @note: smazání stránky a podstránek
Route::delete('/pages/{page}', [PageController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('pages.destroy');



// @todo: Textové pole a obsah stránky ještě budeme řešit

// @note: přidání textového pole
Route::post('textfields', [TextFieldController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('fields.create');

// @note: smazání textového pole
Route::delete('textfields/{id}', [TextFieldController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('fields.destroy');

// @note: aktualizace textového pole
Route::put('textfields/{id}', [TextFieldController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('fields.update');



require __DIR__.'/auth.php';
