<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicLandingPageController;
use App\Http\Controllers\LandingPageDraftController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ImageController;

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
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::get('/builder/{uuid}/{type?}', [LandingPageController::class, 'show'])->name('view.builder');

    Route::get('/preview/{uuid}/{type?}', function () {
        return Inertia::render('PageBuilder/Preview');
    })->name('preview.builder');

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




    Route::put('landing-pages/{uuid}/draft',    [LandingPageDraftController::class, 'update']);

    Route::get('landing-pages',                 [LandingPageController::class, 'index'])->name('landing-pages.index');
    Route::get('landing-pages/{uuid}',          [LandingPageController::class, 'show'])->name('landing-pages.show');
    Route::post('landing-pages',                [LandingPageController::class, 'store'])->name('landing-pages.store');
    Route::put('landing-pages/{uuid}',          [LandingPageController::class, 'update'])->name('landing-pages.update');
    Route::delete('landing-pages/{uuid}',       [LandingPageController::class, 'destroy'])->name('landing-pages.destroy');

    Route::prefix('images')->group(function () {

        Route::get('',                          [ImageController::class, 'index'])->name('images.index');
        Route::post('',                         [ImageController::class, 'store'])->name('images.store');
        Route::delete('{uuid}',                 [ImageController::class, 'destroy'])->name('images.delete');
    });
});

Route::get('campaign/{post}', [CampaignController::class, 'show'])
    ->name('view.campaign');



Route::get('/u/{user}/{slug?}', [PublicLandingPageController::class, 'show'])->name('user.page');

require __DIR__ . '/auth.php';
