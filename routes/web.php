<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProfileController;

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


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', function () {
        return Inertia::render('Home');
    })->name('home');

    Route::get('/profile', function () {
        return Inertia::render('Profile/Show');
    })->name('profile');

    Route::get('profile/{profile}', [ProfileController::class, 'show'])
        ->name('view.profile');

    Route::put('update-profile/{profile}', [ProfileController::class, 'update'])
        ->name('update.profile');

    Route::post('upload/{profile}', [ProfileController::class, 'uploadPhoto'])
        ->name('upload.image');

    Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('campaign/{post}', [CampaignController::class, 'show'])
        ->name('campaign.view');

    // Route::get('/post', [PostController::class, 'index'])->name('post.index');
    // Route::get('post/{post}', [PostController::class, 'show'])
    //     ->name('post.view');


    Route::post('store', [PostController::class, 'store'])
        ->name('post.store');

    Route::post('storeComment/{post}', [PostController::class, 'storeComment'])
        ->name('post.comment.store');

    Route::post('storeLike/{post}', [PostController::class, 'storeLike'])
        ->name('post.like.store');

    Route::post('visibility/{post}/{visibility}', [PostController::class, 'updateVisibility'])
        ->name('post.visibility');

    Route::post('showNotifications/{user}', [PostController::class, 'showNotifications'])
        ->name('post.notification');
});

require __DIR__ . '/auth.php';
