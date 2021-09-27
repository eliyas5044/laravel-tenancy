<?php

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

use App\Http\Controllers\Tenancy\AuthenticatedSessionController;
use App\Http\Controllers\Tenancy\PostController;
use App\Http\Controllers\Tenancy\RegisteredUserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Tenancy/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Tenancy/Dashboard');
})->middleware(['auth:tenancy', 'verified'])->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:tenancy')
    ->name('logout');

// broadcast auth
Route::post('broadcasting', [AuthenticatedSessionController::class, 'broadcastLogin'])
    ->middleware('auth:tenancy');

Route::patch('post-publish/{post}', [PostController::class, 'publish'])
    ->middleware(['auth:tenancy'])
    ->name('post-publish');
Route::resource('post', PostController::class)->middleware(['auth:tenancy']);
