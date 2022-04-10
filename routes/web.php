<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/home', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/profile', function () {
    return Inertia::render('Profile/Show');
})->middleware(['auth', 'verified'])->name('profile');

Route::get('/builder', function () {
    return Inertia::render('PageBuilder/Index');
})->middleware(['auth', 'verified'])->name('builder.index');

Route::get('/builder/create', function () {
    return Inertia::render('PageBuilder/Create');
})->middleware(['auth', 'verified'])->name('builder.create');

require __DIR__ . '/auth.php';
