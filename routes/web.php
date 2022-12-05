<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\AddCustomerController;
use App\Http\Controllers\Customer\RecordController;
use App\Http\Controllers\Login\UserController;
use App\Http\Controllers\HomeController;


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

// Route::get('/customer/view', function () {
//     return view('production.viewCustomer');
// });

// Route::group(['middleware' => ['auth:passport']], function() {

    // Account
    ROUTE::get('/account/add', [AccountController::class, 'index'])->name('addAccount');
    ROUTE::get('/account/view', [AccountController::class, 'histories'])->name('viewAccount');
    ROUTE::post('/account/load', [AccountController::class, 'loads'])->name('account.create');
    ROUTE::get('/account/edit{id}', [AccountController::class, 'edit'])->name('editAccount');
    ROUTE::post('/account/update', [AccountController::class, 'update'])->name('updateAccount');
    ROUTE::get('/account/delete{id}', [AccountController::class, 'destroy'])->name('deleteAccount');

    // Customer
    ROUTE::get('/customer', [CustomerController::class, 'index'])->name('home.customer');
    ROUTE::get('/home', [HomeController::class, 'index'])->name('home.page');
    // ROUTE::get('/', [CustomerController::class, 'home'])->middleware(['auth'])->name('home.page');
    ROUTE::get('/customer/view', [CustomerController::class, 'view'])->name('view.customer');
    ROUTE::post('/customer/store', [CustomerController::class, 'store'])->name('customer.create');
    ROUTE::get('/customer/delete{id}', [CustomerController::class, 'destroy'])->name('deleteCustomer');
    ROUTE::get('/customer/edit{id}', [CustomerController::class, 'edit'])->name('editCustomer');
    ROUTE::post('/customer/update', [CustomerController::class, 'update'])->name('updateCustomer');
    
    // Add Load
    ROUTE::get('/customer/load', [AddCustomerController::class, 'load'])->name('add.load');
    ROUTE::post('/customer/add', [AddCustomerController::class, 'add'])->name('customer.add');

    // Records
    ROUTE::get('/customer/records{id}', [RecordController::class, 'records'])->name('customer.record');
    ROUTE::get('/customer/records/delete{id}', [RecordController::class, 'delete'])->name('deleteRecords');

    // ROUTE::get('/login', [RegisterController::class, 'login']);
    ROUTE::get('/', [UserController::class, 'login'])->name('login.page');
    ROUTE::post('/auth', [UserController::class, 'auth'])->name('auth');
    ROUTE::get('/register', [UserController::class, 'register'])->name('create.register');
    ROUTE::post('/register/store', [UserController::class, 'store'])->name('register');
    ROUTE::get('/registration', [UserController::class, 'data']);
    

    ROUTE::get('/settings', [SettingController::class, 'setting'])->name('settings.page');

// });