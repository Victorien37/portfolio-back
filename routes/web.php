<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\AuthController;
use App\Http\Controllers\WEB\UserController;
use App\Http\Controllers\WEB\SchoolController;
use App\Http\Controllers\WEB\HomepageController;
use App\Http\Controllers\WEB\ExperienceController;
use App\Http\Controllers\WEB\CompanyController;

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
Route::post('/create', [AuthController::class, 'create'])->name('create');
Route::post('/connexion', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/deconnexion', [AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'schools'], function() {
        Route::get('/', [SchoolController::class, 'index'])->name('school.index');
        Route::get('/store', [SchoolController::class, 'store'])->name('school.store');
        Route::post('/store', [SchoolController::class, 'create'])->name('school.create');
        Route::get('/{school}', [SchoolController::class, 'edit'])->name('school.edit');
        Route::put('/{school}', [SchoolController::class, 'update'])->name('school.update');
        Route::delete('/{school}', [SchoolController::class, 'delete'])->name('school.delete');
    });

    Route::group(['prefix' => 'companies'], function() {
        Route::get('/', [CompanyController::class, 'index'])->name('company.index');
        Route::get('/store', [CompanyController::class, 'store'])->name('company.store');
        Route::post('/store', [CompanyController::class, 'create'])->name('company.create');
        Route::get('/{company}', [CompanyController::class, 'edit'])->name('company.edit');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('company.update');
        Route::delete('/{company}', [CompanyController::class, 'delete'])->name('company.delete');
    });

    Route::group(['prefix' => 'homepage'], function() {
        Route::get('/', [HomepageController::class, 'index'])->name('homepage');
        Route::put('/', [HomepageController::class, 'update'])->name('homepage.update');
    });

    Route::group(['prefix' => 'about'], function() {
        Route::get('/', [UserController::class, 'index'])->name('about');
        Route::put('/', [UserController::class, 'update'])->name('about.update');
    });

    Route::group(['prefix' => 'career'], function() {
        Route::get('/', [ExperienceController::class, 'career'])->name('career.index');
        Route::get('/store', [ExperienceController::class, 'storeCareer'])->name('career.store');
        Route::post('/store', [ExperienceController::class, 'createCareer'])->name('career.create');
        Route::get('/{experience}', [ExperienceController::class, 'editCareer'])->name('career.edit');
        Route::put('/{experience}', [ExperienceController::class, 'updateCareer'])->name('career.update');
        Route::delete('/{experience}', [ExperienceController::class, 'deleteCareer'])->name('career.delete');
    });

    Route::group(['prefix' => 'experiences'], function() {
        Route::get('/', [ExperienceController::class, 'experience'])->name('experience.index');
        Route::get('/store', [ExperienceController::class, 'storeExperience'])->name('experience.store');
        Route::post('/store', [ExperienceController::class, 'createExperience'])->name('experience.create');
        Route::get('/{experience}', [ExperienceController::class, 'editExperience'])->name('experience.edit');
        Route::put('/{experience}', [ExperienceController::class, 'updateExperience'])->name('experience.update');
        Route::delete('/{experience}', [ExperienceController::class, 'deleteExperience'])->name('experience.delete');
    });

    Route::group(['prefix' => 'contacts'], function() {
        Route::get('/', [ExperienceController::class, 'index'])->name('contact');
        Route::delete('/{id}', [ExperienceController::class, 'delete'])->name('contact.delete');
    });

    Route::post('/company', [CompanyController::class, 'create'])->name('company.create');
});
