<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\admins\DonHangController;
use App\Http\Controllers\admins\UserController;
use App\Http\Controllers\admins\VoucherController;
use App\Http\Controllers\admins\SanPhamController;
use App\Http\Controllers\admins\InvoiceController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\OrderControler;

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

// Route auth
Route::get('register',                  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register',                 [RegisterController::class, 'register']);

Route::get('login',                     [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login',                    [LoginController::class, 'login']);
Route::post('logout',                   [LoginController::class, 'logout'])->name('logout');

Route::get('password/reset',            [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email',           [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',    [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset',           [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/', function () {
    return view('admins.dashboard');
})->name('dashboard')->middleware(['auth', 'check.admin']);;

// Route admin
Route::middleware(['auth', 'check.admin'])->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/', function () {
            return view('admins.dashboard');
        })->name('dashboard');


        Route::prefix('danhmucs')
            ->as('danhmucs.')
            ->group(function () {
                Route::get('/',                 [DanhMucController::class, 'index'])->name('index');
                Route::get('create',            [DanhMucController::class, 'create'])->name('create');
                Route::post('store',            [DanhMucController::class, 'store'])->name('store');
                Route::get('show/{id}',         [DanhMucController::class, 'show'])->name('show');
                Route::get('{id}/edit',         [DanhMucController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [DanhMucController::class, 'update'])->name('update');
                Route::delete('{id}/destroy',   [DanhMucController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('sanphams')
            ->as('sanphams.')
            ->group(function () {
                Route::get('/',                 [SanPhamController::class, 'index'])->name('index');
                Route::get('create',            [SanPhamController::class, 'create'])->name('create');
                Route::post('store',            [SanPhamController::class, 'store'])->name('store');
                Route::get('show/{id}',         [SanPhamController::class, 'show'])->name('show');
                Route::get('{id}/edit',         [SanPhamController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [SanPhamController::class, 'update'])->name('update');
                Route::delete('{id}/destroy',   [SanPhamController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('donhangs')
            ->as('donhangs.')
            ->group(function () {
                Route::get('/',                 [DonHangController::class, 'index'])->name('index');
                Route::get('show/{id}',         [DonHangController::class, 'show'])->name('show');
                Route::put('{id}/update',       [DonHangController::class, 'update'])->name('update');
            });
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::get('/',                 [UserController::class, 'index'])->name('index');
                Route::get('show/{id}',         [UserController::class, 'show'])->name('show');
                Route::put('{id}/update',       [UserController::class, 'update'])->name('update');
            });
        Route::prefix('vouchers')
            ->as('vouchers.')
            ->group(function () {
                Route::get('/',                 [VoucherController::class, 'index'])->name('index');
                Route::get('create',            [VoucherController::class, 'create'])->name('create');
                Route::post('store',            [VoucherController::class, 'store'])->name('store');
                Route::get('show/{id}',         [VoucherController::class, 'show'])->name('show');
                Route::get('{id}/edit',         [VoucherController::class, 'edit'])->name('edit');
                Route::put('{id}/update',       [VoucherController::class, 'update'])->name('update');
                Route::delete('{id}/destroy',   [VoucherController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('invoices')
            ->as('invoices.')
            ->group(function () {
                Route::get('/',                 [InvoiceController::class, 'index'])->name('index');
                Route::get('show/{id}',         [InvoiceController::class, 'show'])->name('show');
                Route::put('{id}/update',       [InvoiceController::class, 'update'])->name('update');
            });
    });
