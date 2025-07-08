<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DaraMenuController;
use App\Http\Controllers\Admin\DaraMinumanController;
use App\Http\Controllers\Admin\DaraSnackController;
use App\Http\Controllers\Admin\DaraKategoriController;
use App\Http\Middleware\RoleAdmin;

use App\Models\DaraMenu;
use App\Models\DaraMinuman;
use App\Models\DaraSnack;

// ------------------
// Halaman Landing (Publik)
// ------------------
Route::get('/', function () {
    $menus = DaraMenu::all();
    $minumans = DaraMinuman::all();
    $snacks = DaraSnack::all();
    return view('landing', compact('menus', 'minumans', 'snacks'));
})->name('landing');

// 🔽 Detail publik
Route::get('/menu/{id}', function ($id) {
    $menu = DaraMenu::findOrFail($id);
    return view('landing_detail', ['menu' => $menu, 'tipe' => 'makanan']);
})->name('landing.detail.makanan');

Route::get('/minuman/{id}', function ($id) {
    $menu = DaraMinuman::findOrFail($id);
    return view('landing_detail', ['menu' => $menu, 'tipe' => 'minuman']);
})->name('landing.detail.minuman');

Route::get('/snack/{id}', function ($id) {
    $menu = DaraSnack::findOrFail($id);
    return view('landing_detail', ['menu' => $menu, 'tipe' => 'snack']);
})->name('landing.detail.snack');

// ------------------
// Login & Logout (Publik)
// ------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------------------
// Admin Dashboard dan CRUD (Hanya Admin yang Bisa Akses)
// ------------------
Route::middleware(['auth', RoleAdmin::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/{page?}', [DashboardController::class, 'index'])->name('dashboard.page');

    // CRUD Menu Makanan
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [DaraMenuController::class, 'index'])->name('index');
        Route::get('create', [DaraMenuController::class, 'create'])->name('create');
        Route::post('/', [DaraMenuController::class, 'store'])->name('store');
        Route::get('{id}', [DaraMenuController::class, 'show'])->name('show'); // ✅ Admin detail
        Route::get('{id}/edit', [DaraMenuController::class, 'edit'])->name('edit');
        Route::put('{id}', [DaraMenuController::class, 'update'])->name('update');
        Route::get('{id}', [DaraMenuController::class, 'show'])->name('show');
        Route::delete('{id}', [DaraMenuController::class, 'destroy'])->name('destroy');
    });

    // CRUD Minuman
    Route::prefix('minuman')->name('minuman.')->group(function () {
        Route::get('/', [DaraMinumanController::class, 'index'])->name('index');
        Route::get('create', [DaraMinumanController::class, 'create'])->name('create');
        Route::post('/', [DaraMinumanController::class, 'store'])->name('store');
        Route::get('{id}', [DaraMinumanController::class, 'show'])->name('show'); // ✅ Admin detail
        Route::get('{id}/edit', [DaraMinumanController::class, 'edit'])->name('edit');
        Route::put('{id}', [DaraMinumanController::class, 'update'])->name('update');
        Route::delete('{id}', [DaraMinumanController::class, 'destroy'])->name('destroy');
    });

    // CRUD Snack
    Route::prefix('snack')->name('snack.')->group(function () {
        Route::get('/', [DaraSnackController::class, 'index'])->name('index');
        Route::get('create', [DaraSnackController::class, 'create'])->name('create');
        Route::post('/', [DaraSnackController::class, 'store'])->name('store');
        Route::get('{id}', [DaraSnackController::class, 'show'])->name('show'); // ✅ Admin detail
        Route::get('{id}/edit', [DaraSnackController::class, 'edit'])->name('edit');
        Route::put('{id}', [DaraSnackController::class, 'update'])->name('update');
        Route::delete('{id}', [DaraSnackController::class, 'destroy'])->name('destroy');
        Route::get('{id}', [DaraSnackController::class, 'show'])->name('show');
    });

    // CRUD Kategori
    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [DaraKategoriController::class, 'index'])->name('index');
        Route::get('create', [DaraKategoriController::class, 'create'])->name('create');
        Route::post('/', [DaraKategoriController::class, 'store'])->name('store');
        Route::get('{id}/edit', [DaraKategoriController::class, 'edit'])->name('edit');
        Route::put('{id}', [DaraKategoriController::class, 'update'])->name('update');
        Route::delete('{id}', [DaraKategoriController::class, 'destroy'])->name('destroy');
    });
});
