<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalledController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\UseVTRController;
use App\Http\Controllers\MaintenanceController;
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

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([])->group(function () {
    Route::get('/useVtr/{useVtr}/used', [UseVTRController::class, 'used'])->name('outVtr');
});

Route::resource('usevtrs', UseVTRController::class);
Route::get('/useVtr', [UseVTRController::class, 'create'])->name('useVtr');
Route::get('/useVtr/{useVtr}/used', [UseVTRController::class, 'used'])->name('outVtr');

Route::get('/dashboard',[ChartController::class, 'getAcquisition'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('call', CalledController::class);
Route::put('closecall', [CalledController::class, 'closeCall']);
Route::get('/called', [CalledController::class, 'index'])->name('called');
Route::post('reportCall', [CalledController::class, 'report']);

Route::resource('part', PartsController::class);
Route::get('/parts', [PartsController::class, 'index'])->name('parts');

Route::resource('purchase', PurchaseController::class);
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases');

Route::get('/maintenance', function () {
    return Inertia::render('Maintenance');
})->middleware(['auth', 'verified'])->name('maintenance');

Route::resource('car', CarsController::class);
Route::get('/cars', [CarsController::class, 'index'])->name('cars');

Route::resource('carMain', MaintenanceController::class);
Route::get('/carsMaintenance', [MaintenanceController::class, 'index'])->name('carsMaintenance');
Route::get('/carsMaint/{carsMaint}', [MaintenanceController::class, 'carMaint'])->name('carsMaint');

Route::get('/vtrs', [CarsController::class, 'vtrs'])->name('vtrs');
Route::get('/cars/{cars}', [UseVTRController::class, 'used']);
//Route::get('/cars/{cars}', [CarsController::class, 'usedVtr'])->name('outVtr');
Route::post('vtrOut', [CarsController::class, 'usedVtr'])->name('vtrOut');
Route::put('vtrBack', [CarsController::class, 'usedVtr'])->name('vtrBack');

Route::resource('driver', DriversController::class);
Route::get('/drivers', [DriversController::class, 'index'])->name('drivers');

//Rotas da Dashboard
Route::get('/charts', [ChartController::class, 'getAcquisition'])->name('charts');


Route::get('/cadastros', [AuthController::class, 'getTickets'])->name('cadastros');
Route::post('cad', [AuthController::class, 'create']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
