<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DaraMenuController;
use App\Http\Controllers\Admin\DaraMinumanController;
use App\Http\Controllers\Admin\DaraSnackController;
use App\Http\Controllers\Admin\DaraKategoriController;
use App\Http\Middleware\RoleAdmin;
use App\Models\DaraMenu;
use App\Models\DaraMinuman;
use App\Models\DaraSnack;

// Landing
Route::get('/', function () {
    $menus = DaraMenu::all();
    $minumans = DaraMinuman::all();
    $snacks = DaraSnack::all();
    return view('landing', compact('menus', 'minumans', 'snacks'));
})->name('landing');

// Detail produk
Route::get('/menu/{id}', fn($id) => view('landing_detail', ['menu' => DaraMenu::findOrFail($id), 'tipe' => 'menu']))->name('landing.detail.makanan');
Route::get('/minuman/{id}', fn($id) => view('landing_detail', ['menu' => DaraMinuman::findOrFail($id), 'tipe' => 'minuman']))->name('landing.detail.minuman');
Route::get('/snack/{id}', fn($id) => view('landing_detail', ['menu' => DaraSnack::findOrFail($id), 'tipe' => 'snack']))->name('landing.detail.snack');

// Pemesanan Publik
Route::get('/pesan/menu/{id}', [PemesananController::class, 'formPesanMenu'])->name('pesan.menu.form');
Route::post('/pesan', [PemesananController::class, 'store'])->name('pesan.store');
Route::get('/cek-pesanan', [PemesananController::class, 'cekPesananForm'])->name('cek.pesanan.form');
// Route update status pesanan
Route::put('/pemesanan/{id}', [PemesananController::class, 'update'])->name('pemesanan.update');
Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['auth', RoleAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/{page?}', [DashboardController::class, 'index'])->name('dashboard.page');

    Route::resource('menu', DaraMenuController::class);
    Route::resource('minuman', DaraMinumanController::class);
    Route::resource('snack', DaraSnackController::class);
    Route::resource('kategori', DaraKategoriController::class)->except(['show']);

    // Pemesanan CRUD
    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/', [PemesananController::class, 'index'])->name('index');
        Route::put('{id}/status', [PemesananController::class, 'updateStatus'])->name('update');
        Route::delete('{id}', [PemesananController::class, 'destroy'])->name('destroy'); // 🔥 Tambahkan DELETE
    });
});
