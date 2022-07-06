<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Federation\FederationController;
use App\Http\Controllers\Federation\LigueRegionalController;
use App\Http\Controllers\Localisation\CommuneController;
use App\Http\Controllers\Localisation\DepartementController;
use App\Http\Controllers\Localisation\LocalisationController;
use App\Http\Controllers\Localisation\PaysController;
use App\Http\Controllers\Localisation\QuartierController;
use App\Http\Controllers\Localisation\RegionController;
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
        Route::delete('/pays/{pays}', [PaysController::class, 'destroy'])->name('pays.destroy');
        // regions
        Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
        Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
        Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');
        Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');
        // departements
        Route::get('/departements', [DepartementController::class, 'index'])->name('departements.index');
        Route::post('/departements', [DepartementController::class, 'store'])->name('departements.store');
        Route::put('/departements/{departement}', [DepartementController::class, 'update'])->name('departements.update');
        Route::delete('/departements/{departement}', [DepartementController::class, 'destroy'])->name('departements.destroy');
        // communes
        Route::get('/communes', [CommuneController::class, 'index'])->name('communes.index');
        Route::post('/communes', [CommuneController::class, 'store'])->name('communes.store');
        Route::put('/communes/{commune}', [CommuneController::class, 'update'])->name('communes.update');
        Route::delete('/communes/{commune}', [CommuneController::class, 'destroy'])->name('communes.destroy');
        // quartiers
        Route::get('/quartiers', [QuartierController::class, 'index'])->name('quartiers.index');
        Route::post('/quartiers', [CommuneController::class, 'store'])->name('quartiers.store');
        Route::put('/quartiers/{quartier}', [CommuneController::class, 'update'])->name('quartiers.update');
        Route::delete('/quartiers/{quartier}', [CommuneController::class, 'destroy'])->name('quartiers.destroy');
    });

    Route::group([
        'prefix' => 'app/fede',
        'namespace' => 'App\Http\Controllers\Federation'
    ],function(){
        //  federations
        Route::get('/federations',                 [FederationController::class, 'index'])->name('federations.index');
        Route::post('/federations',                [FederationController::class, 'store'])->name('federations.store');
        Route::put('/federations/{federation}',    [FederationController::class, 'update'])->name('federations.update');
        Route::delete('/federations/{federation}', [FederationController::class, 'destroy'])->name('federations.destroy');

        //  ligue-regional
        Route::get('/lig-regio',            [LigueRegionalController::class, 'index'])->name('ligregio.index');
        Route::get('/lig-regio/new',        [LigueRegionalController::class, 'create'])->name('ligregio.create');
        Route::get('/lig-regio/{ligue}',    [LigueRegionalController::class, 'show'])->name('ligregio.show');
        Route::post('/lig-regio',           [LigueRegionalController::class, 'store'])->name('ligregio.store');
        Route::put('/lig-regio/{ligue}',    [LigueRegionalController::class, 'update'])->name('ligregio.update');
        Route::delete('/lig-regio/{ligue}', [LigueRegionalController::class, 'destroy'])->name('ligregio.destroy');

    });
});
