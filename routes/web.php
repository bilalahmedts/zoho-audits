<?php

use App\Http\Controllers\AuditController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Users\RoleController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->get('/', function () {
    return view('welcome');
});

// secured routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('checkLogin')->group(function () {
        Route::prefix('audits')->group(function () {
            Route::get('/', [AuditController::class, 'index'])->name('audits.index');
            Route::get('/create', [AuditController::class, 'create'])->name('audits.create');
            Route::post('/store', [AuditController::class, 'store'])->name('audits.store');
            Route::get('/edit/{audit}', [AuditController::class, 'edit'])->name('audits.edit');
            Route::put('/update/{audit}', [AuditController::class, 'update'])->name('audits.update');
            Route::delete('/delete/{audit}', [AuditController::class, 'destroy'])->name('audits.delete');
            Route::get('/audit-report', [AuditController::class, 'report'])->name('audits.audit-report');
            Route::post('/audit-report', [AuditController::class, 'getDataByDate'])->name('audits.audit-report');
            Route::get('/export-audit-report', [AuditController::class, 'export'])->name('audits.audit-report-table');
        });
    });

    Route::middleware('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/update/{user}', [UserController::class, 'update'])->name('users.update');
        });

        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/update/{role}', [RoleController::class, 'update'])->name('roles.update');
            Route::get('/delete/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });
        
        Route::prefix('campaigns')->group(function () {
            Route::get('/', [CampaignController::class, 'index'])->name('campaigns.index');
            Route::get('/create', [CampaignController::class, 'create'])->name('campaigns.create');
            Route::post('/store', [CampaignController::class, 'store'])->name('campaigns.store');
            Route::get('/edit/{campaign}', [CampaignController::class, 'edit'])->name('campaigns.edit');
            Route::put('/update/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
            Route::get('/delete/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.delete');
        });
    });
});

// unsecure routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});
