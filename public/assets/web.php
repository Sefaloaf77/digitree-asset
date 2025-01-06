<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseLokasiController;
use App\Http\Controllers\DataPohonController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAppsController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\TablesController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'analysis'])->name('index');
Route::get('/changelog', [HomeController::class, 'changelog'])->name('changeLog');
Route::get('/chart', [HomeController::class, 'chart'])->name('chart');
Route::get('/contact', [HomeController::class, 'contacts'])->name('contact');
Route::get('/dragdrop', [HomeController::class, 'dragdrop'])->name('dragdrop');
Route::get('/fonticons', [HomeController::class, 'fonticons'])->name('fonticons');
Route::get('/orderlist', [HomeController::class, 'orderlist'])->name('orderList');
Route::get('/payments', [HomeController::class, 'payments'])->name('payments');
Route::get('/profilesetting', [HomeController::class, 'profilesetting'])->name('profileSetting');

Route::prefix('socialapps/')->group(function () {
    Route::controller(SocialAppsController::class)->group(function () {
        Route::get('compose', 'compose')->name('compose');
        Route::get('inbox', 'inbox')->name('inbox');
        Route::get('chat', 'chat')->name('chat');
    });
});

Route::prefix('components/')->group(function () {
    Route::controller(ComponentsController::class)->group(function () {
        Route::get('accordions', 'accordions')->name('accordions');
        Route::get('tabs', 'tabs')->name('tabs');
        Route::get('modal', 'modal')->name('modal');
        Route::get('notification', 'notification')->name('notification');
        Route::get('lightbox', 'lightbox')->name('lightbox');
        Route::get('swiper', 'swiper')->name('swiper');
    });
});

Route::prefix('element/')->group(function () {
    Route::controller(ElementController::class)->group(function () {
        Route::get('alert', 'alert')->name('alert');
        Route::get('avatar', 'avatar')->name('avatar');
        Route::get('buttons', 'buttons')->name('buttons');
        Route::get('badges', 'badges')->name('badges');
        Route::get('breadcrumb', 'breadcrumb')->name('breadcrumb');
        Route::get('dropdowns', 'dropdown')->name('dropdowns');
        Route::get('loader', 'loader')->name('loader');
        Route::get('pagination', 'pagination')->name('pagination');
        Route::get('progressbar', 'progressbar')->name('progressbar');
    });
});

Route::prefix('tables/')->group(function () {
    Route::controller(TablesController::class)->group(function () {
        Route::get('basictable', 'basicTable')->name('basicTable');
        Route::get('datatable', 'dataTable')->name('dataTable');
        Route::get('eidtabletable', 'eidtableTable')->name('eidtableTable');
    });
});

Route::prefix('forms/')->group(function () {
    Route::controller(FormsController::class)->group(function () {
        Route::get('basic', 'basic')->name('basic');
        Route::get('inputgroup', 'inputGroup')->name('inputGroup');
        Route::get('validation', 'validation')->name('validation');
        Route::get('checkbox', 'checkbox')->name('checkbox');
        Route::get('radio', 'radio')->name('radio');
        Route::get('switches', 'switches')->name('switches');
    });
});

Route::prefix('invoice/')->group(function () {
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('invoice', 'invoice')->name('invoice');
        Route::get('invoiceadd', 'invoiceAdd')->name('invoiceAdd');
        Route::get('invoicelist', 'invoiceList')->name('invoiceList');
    });
});

Route::prefix('pages/')->group(function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('starterpage', 'starterPage')->name('starterPage');
        Route::get('pricing', 'pricing')->name('pricing');
        Route::get('comingsoon', 'comingsoon')->name('comingsoon');
        Route::get('maintenance', 'maintenance')->name('maintenance');
        Route::get('error404', 'error404')->name('error404');
        Route::get('error500', 'error500')->name('error500');
        Route::get('error503', 'error503')->name('error503');
    });
});

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

// Route::prefix('dashboard/')->group(function () {
//     Route::controller(HomeController::class)->group(function () {
//         Route::get('analysis', 'analysis')->name('analysis');
//         Route::get('ecommerce', 'ecommerce')->name('ecommerce');
//         Route::get('accounts', 'accounts')->name('accounts');
//     });
// });
// User Apps ===========================

Route::resource('/plant', FrontendController::class)->only(['index', 'store', 'create', 'destroy', 'edit', 'update', 'show']);

// Route::post('plant/ulasan/', FrontendController::class)->name('ulasan');

//User Apps ===========================

//WebAdmin ============================
//Login ------

Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'authenticate']);

//Login ------

//Dashboard ------

// Route::resource('/dashboard', DashboardController::class)->only(
//     ['index']
// );

//Dashboard ------

//Data Pohon ------
// Route::resource('/data-pohon', DataPohonController::class)->only(
//     ['index', 'store', 'create', 'destroy', 'edit', 'update', 'show']
// );
Route::get('/get-plants', [PlantController::class, 'getDataPlant'])->name('getAllDataPlant');
Route::get('/generate-qrcode/{id}', [DataPohonController::class, 'generateQr'])->name('generate.qr');
Route::get('/get-index', [DataPohonController::class, 'getDataIndexPohon'])->name('getAllDataIndex');
Route::get('/get-content/{id}', [DataPohonController::class, 'getDataContentPohon'])->name('getAllDataContent');
Route::post('/update-content', [DataPohonController::class, 'updateContentIndexPohon'])->name('updateAllDataIndexContent');
Route::post('/delete-content', [DataPohonController::class, 'deleteContentIndexPohon'])->name('deleteAllDataIndexContent');


Route::post('/delete-plant', [PlantController::class, 'deletePlant'])->name('deleteAllDataPlant');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth']], function () {
    Route::get('/semua-lokasi', [DashboardController::class, 'index'])->name('index');
    Route::get('/perlokasi', [DashboardController::class, 'perlokasi'])->name('perlokasi');
    Route::get('/update-plant/{id}', [PlantController::class, 'updatePlant'])->name('updateAllDataPlant');

    Route::group(['prefix' => 'pohon', 'as' => 'pohon.'], function () {
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

});

//Data Pohon ------

// //Data Index Pohon ------
// Route::resource('/data-content-index-pohon', DataIndexPohonController::class)->only(
//     ['index', 'store', 'create', 'destroy', 'edit', 'update', 'show']
// );
// //Data Index Pohon -------

// statistik pohon

// Route::resource('/statistik-pohon', StatistikController::class)->only(['index', 'store', 'create', 'destroy', 'edit', 'update', 'show']);

//Web Aadmin ============================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
