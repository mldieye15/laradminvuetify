<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Localisation\LocalisationController;
use App\Http\Controllers\Localisation\PaysController;
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
Route::middleware('auth:sanctum')->group(function() {
    Route::get('app/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::group([
        'prefix' => 'app/intial-data',
        'namespace' => 'App\Http\Controllers\Localisation'
    ],function(){
        Route::get('/', [LocalisationController::class, 'index'])->name('basicdata.index');
        // pays
        Route::get('/pays', [PaysController::class, 'index'])->name('pays.index');
        Route::post('/pays', [PaysController::class, 'store'])->name('pays.store');
        Route::put('/pays/{pays}', [PaysController::class, 'update'])->name('pays.update');
    });
});
