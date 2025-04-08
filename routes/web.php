<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseLokasiController;
use App\Http\Controllers\DataPohonController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PemetaanController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\UserRolesController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication/')->group(function () {
    Route::controller(AuthenticationController::class)->group(function () {
        // Route::get('login', 'login')->name('login');
        Route::get('logincover', 'loginCover')->name('loginCover');
        Route::get('signin', 'signin')->name('signin');
        Route::get('signincover', 'signinCover')->name('signinCover');
        Route::get('resetpassword', 'resetPassword')->name('resetPassword');
        Route::get('resetpasswordcover', 'resetPasswordCover')->name('resetPasswordCover');
        Route::get('verification', 'verification')->name('verification');
        Route::get('verificationcover', 'verificationCover')->name('verificationCover');
    });
});

Route::resource('/aset', FrontendController::class)->only(['index', 'store', 'create', 'destroy', 'edit', 'update', 'show']);
Route::post('/savelocation', [FrontendController::class, 'location'])->name('location');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/generate-qrcode/{id}', [DataPohonController::class, 'generateQr'])->name('generate.qr');
Route::get('/get-plants', [AssetController::class, 'getDataPlant'])->name('getAllDataPlant');
Route::get('/get-plants-location/{id}', [AssetController::class, 'getDataPlantLocation'])->name('getAllDataPlantLocation');
Route::get('/get-index', [DataPohonController::class, 'getDataIndexPohon'])->name('getAllDataIndex');
Route::get('/get-content/{id}', [DataPohonController::class, 'getDataContentPohon'])->name('getAllDataContent');
Route::post('/update-content', [DataPohonController::class, 'updateContentIndexPohon'])->name('updateAllDataIndexContent');
Route::post('/delete-content', [DataPohonController::class, 'deleteContentIndexPohon'])->name('deleteAllDataIndexContent');
Route::post('/delete-plant', [AssetController::class, 'deletePlant'])->name('deleteAllDataPlant');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'superadmin']], function () {

    Route::get('/semua-lokasi', [DashboardController::class, 'index'])->name('index');
    Route::get('/perlokasi/{id}', [DashboardController::class, 'perlokasi'])->name('perlokasi');
    Route::get('/update-plant/{id}', [AssetController::class, 'updatePlant'])->name('updateAllDataPlant');

    Route::group(['prefix' => 'asset', 'as' => 'asset.'], function () {
        Route::get('/', [DataPohonController::class, 'index'])->name('index');
        Route::post('/', [DataPohonController::class, 'store'])->name('store');
        Route::post('/create', [DataPohonController::class, 'save'])->name('save');
        Route::put('/{id}', [DataPohonController::class, 'update'])->name('update');
        Route::get('/create', [DataPohonController::class, 'create'])->name('create');
    });

    Route::group(['prefix' => 'lokasi', 'as' => 'lokasi.'], function () {
        Route::get('/', [DatabaseLokasiController::class, 'index'])->name('index');
        Route::post('/', [DatabaseLokasiController::class, 'store'])->name('store');
        Route::get('/create', [DatabaseLokasiController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [DatabaseLokasiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DatabaseLokasiController::class, 'update'])->name('update');
        Route::delete('/{id}', [DatabaseLokasiController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'statistik', 'as' => 'statistik.'], function () {
        Route::get('/', [StatistikController::class, 'index'])->name('index');
        Route::get('/reviewer', [StatistikController::class, 'reviewer'])->name('reviewer');
        Route::get('/reviewer/{id}', [StatistikController::class, 'detailReviewer'])->name('detailReviewer');
        Route::get('/get-review-plant/{id}', [StatistikController::class, 'getReviewPlant'])->name('getAllReviewPlant');
    });

    Route::group(['prefix' => 'user-role', 'as' => 'user-role.'], function () {
        Route::get('/', [UserRolesController::class, 'index'])->name('index');
        Route::post('/', [UserRolesController::class, 'store'])->name('store');
        Route::get('/create', [UserRolesController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [UserRolesController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserRolesController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserRolesController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'pemetaan', 'as' => 'pemetaan.'], function () {
        Route::get('/', [PemetaanController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'ads', 'as' => 'ads.'], function () {
        Route::get('/', [AdsController::class, 'index'])->name('index');
        Route::post('/', [AdsController::class, 'store'])->name('store');
        Route::get('/create', [AdsController::class, 'create'])->name('create');
        Route::get('/{id}/edit', [AdsController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdsController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdsController::class, 'destroy'])->name('delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
