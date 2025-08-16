<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('Customer.dashboard-customer');
// });

Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/cars-list', [CustomerController::class, 'cars'])->name('customer.cars');
Route::get('/contact-us', [CustomerController::class, 'contact'])->name('customer.contact');
Route::post('/contact/send', [CustomerController::class, 'send'])->name('customer.send');
Route::view('/car-detail', 'customer.car-detail')->name('car-detail');
Route::get('/set-language/{lang}', function ($lang) {
    $availableLangs = ['en', 'ru']; // daftar bahasa yang tersedia

    if (in_array($lang, $availableLangs)) {
        session(['lang' => $lang]);
    }

    return redirect()->back(); // kembali ke halaman sebelumnya
})->name('setLanguage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customer-cars/{car}', [CustomerController::class, 'detail'])->name('customer.detailCar');
    Route::post('/booking', [CustomerController::class, 'bookNow'])->name('customer.booking');
    // Route::get('/order', [CustomerController::class, 'order'])->name('customer.order');
    // Route::get('/Payment', [TransactionController::class, 'viewOrder'])->name('customer.order');
    Route::get('/payment/{id}', [TransactionController::class, 'viewOrder'])->name('customer.order');
    Route::get('/my-transactions', [TransactionController::class, 'myTransactions'])->name('customer.myTransactions');
    Route::get('/invoice/{transaction}', [CustomerController::class, 'invoice'])->name('customer.invoice');
});

Route::middleware(['auth', 'role.staff.owner'])->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'dashboard'])->name('dashboard');

    Route::get('/type', [TypeController::class, 'index'])->name('type.index');
    Route::post('/type', [TypeController::class, 'store'])->name('type.store');
    Route::put('/type/{id}', [TypeController::class, 'update'])->name('type.update');

    Route::get('/location', [LocationController::class, 'index'])->name('location.index');
    Route::post('/location', [LocationController::class, 'store'])->name('location.store');
    Route::put('/location/{id}', [LocationController::class, 'update'])->name('location.update');

    Route::get('/car-type', [CarTypeController::class, 'index'])->name('car-type.index');
    Route::post('/car-type', [CarTypeController::class, 'store'])->name('car-type.store');
    Route::put('/car-type/{id}', [CarTypeController::class, 'update'])->name('car-type.update');

    Route::resource('cars', CarController::class);
    Route::get('/cars/type/{id}', [CarController::class, 'filterByType'])->name('cars.byType');

    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');

    Route::get('/staff/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::patch('/staff/transactions/{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
});

require __DIR__.'/auth.php';
