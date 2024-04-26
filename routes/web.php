<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\UserController;
use App\Http\Controllers\WEB\HomepageController;
use App\Http\Controllers\WEB\ExperienceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);

//Route::group(['middleware' => 'auth'], function () {
    Route::get('/deconnexion', [UserController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'homepage'], function() {
        Route::get('/', [HomepageController::class, 'index'])->name('homepage');
        Route::post('/', [HomepageController::class, 'update'])->name('homepage.update');
    });

    Route::group(['prefix' => 'about'], function() {
        Route::get('/', [UserController::class, 'about'])->name('about');
        Route::post('/', [UserController::class, 'updateAbout'])->name('about.update');
    });

    Route::group(['prefix' => 'career'], function() {
        Route::get('/', [ExperienceController::class, 'index'])->name('career');
        Route::post('/', [ExperienceController::class, 'update'])->name('career.update');
    });

    Route::group(['prefix' => 'experience'], function() {
        Route::get('/', [ExperienceController::class, 'index'])->name('experience');
    });

    Route::group(['prefix' => 'contact'], function() {
        Route::get('/', [ExperienceController::class, 'index'])->name('contact');
    });
//});
