<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DepartementController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\IncomingItemController;
use App\Http\Controllers\Admin\OutgoingItemController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\AjaxController;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect After Login (Role Based)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function (Request $request) {
    $user = $request->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    abort(403, 'Role not recognized');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Master Data
        Route::resource('categories', CategoryController::class);
        Route::resource('units', UnitController::class);

        // Duplicate check digunakan oleh import preview
        Route::post('items/check-duplicate', [\App\Http\Controllers\Admin\ItemController::class, 'checkDuplicate'])
            ->name('items.check-duplicate');

        // Import routes
        Route::get('items/import', [\App\Http\Controllers\Admin\ItemController::class, 'showImport'])->name('items.import.show');
        Route::post('items/import', [\App\Http\Controllers\Admin\ItemController::class, 'import'])->name('items.import');

        // Resource routes
        Route::resource('items', ItemController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('units', UnitController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('departement', DepartementController::class);

        // API untuk SELECT2 AJAX (Item Search)
        Route::get('api/items/search', [ItemController::class, 'searchItems'])->name('api.items.search');
        Route::get('api/categories/search', [ItemController::class, 'searchCategories'])->name('api.categories.search');
        Route::get('api/units/search', [ItemController::class, 'searchUnits'])->name('api.units.search');
        Route::get('api/suppliers/search', [SupplierController::class, 'searchSuppliers'])->name('api.suppliers.search');
        Route::get('api/departements/search', [DepartementController::class, 'searchDepartements'])->name('api.departements.search');

        // Transactions
        Route::resource('incoming', IncomingItemController::class);
        Route::resource('outgoing', OutgoingItemController::class);

        // Reports
        Route::get('reports/stock', [ReportController::class, 'stock'])
            ->name('reports.stock');
        Route::get('reports/movement', [ReportController::class, 'movement'])
            ->name('reports.movement');
        Route::get('reports/loan', [ReportController::class, 'loan'])
            ->name('reports.loan');

        // Profile
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.update-password');
        Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

        // Real-time name check routes for each resource
        Route::post('items/check-name', [AjaxController::class, 'checkName'])->name('items.check-name');
        Route::post('categories/check-name', [AjaxController::class, 'checkName'])->name('categories.check-name');
        Route::post('units/check-name', [AjaxController::class, 'checkName'])->name('units.check-name');
        Route::post('suppliers/check-name', [AjaxController::class, 'checkName'])->name('suppliers.check-name');
        Route::post('departement/check-name', [AjaxController::class, 'checkName'])->name('departement.check-name');

        // Debug Import
        Route::post('items/debug-import', [ItemController::class, 'debugImport'])->name('items.debug-import');
        Route::post('items/debug-file-type', [ItemController::class, 'debugFileType'])
            ->name('items.debug-file-type')
            ->middleware(['auth', 'role:admin']);
    });

/*
|--------------------------------------------------------------------------
| Profile Routes (All Roles)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
