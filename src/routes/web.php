<?php

use App\Events\AuthorizationGranted;
use App\Http\Controllers\AuthorizationCodeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
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

Route::get('/', HomeController::class)->name('home');

Route::prefix('client')
    ->group(function () {
        Route::get('/create', [ClientController::class, 'create']);
        Route::post('/create', [ClientController::class, 'store'])->name('create.client');
    });

Route::prefix('authorization-code')
    ->group(function () {

        Route::get('', [AuthorizationCodeController::class, 'view'])->name('authorizationCodeFlow');

        Route::middleware('auth')->group(function () {
            Route::get('/auth', [AuthorizationCodeController::class, 'request']);
            Route::post('/auth', [AuthorizationCodeController::class, 'authorize'])
                ->name('authorize.authorization-code');
        });

    });


require __DIR__.'/auth.php';

