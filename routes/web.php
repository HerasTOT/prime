<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\CoverageController;
use App\Http\Controllers\CoveragePackageController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\LiquidationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PartialReceiptController;
use App\Http\Controllers\PaymentVoucherController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TratamientosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntryFormatController;
use App\Http\Controllers\CatalogController;

use Illuminate\Http\Request;

use App\Http\Controllers\WelcomeController;
use App\Models\EntryFormat;
use App\Models\Module;
use App\Models\PartialReceipt;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// Route::get('/', [WelcomeController::class, 'welcome'])
//     ->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', ['users' => User::all(), 'modulos' => Module::all()]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Seguridad
    Route::resource('module', ModuleController::class)->parameters(['module' => 'module']);
    Route::resource('permissions', PermissionController::class)->names('permissions');
    Route::resource('perfiles', RoleController::class)->parameters(['perfiles' => 'perfiles']);
    Route::resource('user', UserController::class)->parameters(['user' => 'user']);

    Route::resource('entryformat', EntryFormatController::class)->names('entryformat');
    Route::resource('catalog', CatalogController::class)->names('catalog');
    

});
Route::get('/entryformat/create', [EntryFormatController::class, 'create'])->name('entryformat.create');
Route::post('/entryformat', [EntryFormatController::class, 'store'])->name('entryformat.store');

Route::get('/checkEmail', function (Request $request) {
    $emailExists = EntryFormat::where('email', $request->email)->exists();
    return response()->json(['exists' => $emailExists]);
});

require __DIR__ . '/auth.php';
