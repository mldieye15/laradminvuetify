<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
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
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
//Route::get('/a-propos', [WelcomeController::class, 'index'])->name('about');
//Route::get('/contact', [WelcomeController::class, 'index'])->name('contact');

/*
Route::get('/', function () {
    //return view('welcome');
    return Inertia::render('Welcome');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::middleware('auth:sanctum')->name('dashboard.')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
});
