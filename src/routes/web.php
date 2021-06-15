<?php

use App\Events\AuthorizationGranted;
use App\Http\Controllers\AuthorizationCodeController;
use App\Http\Controllers\ClientController;
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
        'register_application' => asset('/images/register_application.png'),
        'view_appliaction' => asset('/images/view_requests.png')
    ]);
})->name('home');

Route::prefix('client')
    ->group(function () {
        Route::get('/create', [ClientController::class, 'create'])->name('register.client');
        Route::post('/create', [ClientController::class, 'store'])->name('create.client');

    });

Route::middleware('auth')->get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

Route::prefix('authorization-code')
    ->group(function () {

        Route::middleware('auth')->group(function () {
            Route::get('/auth', [AuthorizationCodeController::class, 'request'] );
            Route::post('/auth', [AuthorizationCodeController::class, 'authorize'] )->name('authorize.authorization-code');
        });


    });


require __DIR__.'/auth.php';

