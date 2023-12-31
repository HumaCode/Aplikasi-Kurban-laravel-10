<?php

use App\Http\Controllers\DataMasjidController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KurbanController;
use App\Http\Controllers\KurbanHewanController;
use App\Http\Controllers\KurbanPesertaController;
use App\Http\Controllers\MasjidBankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserProfilController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\EnsureDataMasjidCompleted;
use Illuminate\Support\Facades\Auth;

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

Route::get('logout-user', function () {
    Auth::logout();

    return redirect('/');
})->name('logout-user');

// Route::get('/', function () {
//     return view('welcomelte');
// });

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('data-masjid/{slug}', [DataMasjidController::class, 'show'])->name('data_masjid.show');
Route::get('data-masjid/{slugMasjid}/profil/{slugProfil}', [DataMasjidController::class, 'profil'])->name('data_masjid.profil');
Route::get('data-masjid/{slugMasjid}/informasi/{slugInformasi}', [DataMasjidController::class, 'informasi'])->name('data_masjid.informasi');


Route::get('verified', [WelcomeController::class, 'konfirm'])->name('verification.verify')->middleware('auth');
Route::get('verified2', [WelcomeController::class, 'konfirm'])->name('user_konfirm')->middleware('auth');
Route::get('verified3', [WelcomeController::class, 'konfirm'])->name('verification.notice')->middleware('auth');
Route::post('konfirm_wa', [WelcomeController::class, 'konfirm_wa'])->name('tanya')->middleware('auth');


Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('masjid', MasjidController::class);

    Route::middleware(EnsureDataMasjidCompleted::class)->group(function () {
        Route::resource('infaq', InfaqController::class);
        Route::resource('kurbanpeserta', KurbanPesertaController::class);
        Route::resource('peserta', PesertaController::class);
        Route::resource('kurbanhewan', KurbanHewanController::class);
        Route::resource('kurban', KurbanController::class);
        Route::resource('userprofil', UserProfilController::class);
        Route::resource('masjidbank', MasjidBankController::class);
        Route::resource('informasi', InformasiController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('profil', ProfilController::class);
        Route::resource('kas', KasController::class);
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});
