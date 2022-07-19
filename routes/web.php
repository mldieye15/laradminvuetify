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
use App\Http\Controllers\Params\CotePratiquantController;
use App\Http\Controllers\Params\FonctionPratiquantController;
use App\Http\Controllers\Params\GradePratiquantController;
use App\Http\Controllers\SiteWeb\AssocaitionPubController;
use App\Http\Controllers\SiteWeb\CalendrierPubController;
use App\Http\Controllers\SiteWeb\CentrePubController;
use App\Http\Controllers\SiteWeb\ClubPubController;
use App\Http\Controllers\SiteWeb\MatchPubController;
use App\Http\Controllers\SiteWeb\MediatequePubController;
use App\Http\Controllers\SiteWeb\OrganisationPubController;
use App\Http\Controllers\SiteWeb\PresentationPubController;
use App\Http\Controllers\SiteWeb\ReglementPubController;
use App\Http\Controllers\SiteWeb\ResultatPubController;
use App\Http\Controllers\Structures\AssociationController;
use App\Http\Controllers\Structures\CentreFormationController;
use App\Http\Controllers\Structures\ClubController;
use App\Http\Controllers\User\PersonneController;
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

Route::name('public.')->group(function() {
    Route::group([
        'prefix' => 'public',
        'namespace' => 'App\Http\Controllers\SiteWeb'
    ],function(){

        Route::group([
            'prefix' => 'structures',
            'namespace' => 'App\Http\Controllers\Structures'
        ],function(){
            //  club
            Route::get('/clubs', [ClubPubController::class, 'index'])->name('club.index');

            //  centre-formation
            Route::get('/centre-formation', [CentrePubController::class, 'index'])->name('centreform.index');

            //  association
            Route::get('/associations', [AssocaitionPubController::class, 'index'])->name('association.index');
        });

        Route::group([
            'prefix' => 'federation',
            'namespace' => 'App\Http\Controllers\Structures'
        ],function(){
            //  presentation
            Route::get('/presentation', [PresentationPubController::class, 'index'])->name('presentation.index');

            //  organisation
            Route::get('/organisation', [OrganisationPubController::class, 'index'])->name('organisation.index');

            //  mediateque
            Route::get('/mediateque', [MediatequePubController::class, 'index'])->name('mediateque.index');
        });

        Route::group([
            'prefix' => 'activites',
            'namespace' => 'App\Http\Controllers\Structures'
        ],function(){
            //  calendrier
            Route::get('/calendrier', [CalendrierPubController::class, 'index'])->name('calendrier.index');

            //  matchs
            Route::get('/matchs', [MatchPubController::class, 'index'])->name('match.index');

            //  resultats
            Route::get('/resultats', [ResultatPubController::class, 'index'])->name('resultat.index');
        });

        Route::group([
            'prefix' => 'textes',
            'namespace' => 'App\Http\Controllers\Structures'
        ],function(){
            //  reglements
            Route::get('/reglements', [ReglementPubController::class, 'index'])->name('reglement.index');
        });
    });

});

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
        Route::post('/quartiers', [QuartierController::class, 'store'])->name('quartiers.store');
        Route::put('/quartiers/{quartier}', [QuartierController::class, 'update'])->name('quartiers.update');
        Route::delete('/quartiers/{quartier}', [QuartierController::class, 'destroy'])->name('quartiers.destroy');
        
    });

    Route::group([
        'prefix' => 'app/intial-data/pratiquants',
        'namespace' => 'App\Http\Controllers\Params'
    ],function(){
        // grades
        Route::get('/grades',            [GradePratiquantController::class, 'index'])->name('pratiquant.grade.index');
        Route::post('/grades',           [GradePratiquantController::class, 'store'])->name('pratiquant.grade.store');
        Route::put('/grades/{grade}',    [GradePratiquantController::class, 'update'])->name('pratiquant.grade.update');
        Route::delete('/grades/{grade}', [GradePratiquantController::class, 'destroy'])->name('pratiquant.grade.destroy');
        // fonctions
        Route::get('/fonctions',               [FonctionPratiquantController::class, 'index'])->name('pratiquant.fonction.index');
        Route::post('/fonctions',              [FonctionPratiquantController::class, 'store'])->name('pratiquant.fonction.store');
        Route::put('/fonctions/{fonction}',    [FonctionPratiquantController::class, 'update'])->name('pratiquant.fonction.update');
        Route::delete('/fonctions/{fonction}', [FonctionPratiquantController::class, 'destroy'])->name('pratiquant.fonction.destroy');
        // cotes
        Route::get('/cotes',           [CotePratiquantController::class, 'index'])->name('pratiquant.cote.index');
        Route::post('/fonctions',      [CotePratiquantController::class, 'store'])->name('pratiquant.cote.store');
        Route::put('/cotes/{cote}',    [CotePratiquantController::class, 'update'])->name('pratiquant.cote.update');
        Route::delete('/cotes/{cote}', [CotePratiquantController::class, 'destroy'])->name('pratiquant.cote.destroy');
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
        Route::post('/lig-regio/edit',      [LigueRegionalController::class, 'edit'])->name('ligregio.edit');
        Route::get('/lig-regio/{ligue}',    [LigueRegionalController::class, 'show'])->name('ligregio.show');
        Route::post('/lig-regio',           [LigueRegionalController::class, 'store'])->name('ligregio.store');
        Route::put('/lig-regio/{ligue}',    [LigueRegionalController::class, 'update'])->name('ligregio.update');
        Route::delete('/lig-regio/{ligue}', [LigueRegionalController::class, 'destroy'])->name('ligregio.destroy');
    });

    Route::group([
        'prefix' => 'app/fede/structures',
        'namespace' => 'App\Http\Controllers\Structures'
    ],function(){
        //  club
        Route::get('/clubs',           [ClubController::class, 'index'])->name('club.index');
        Route::post('/ajax-club',       [ClubController::class, 'ajaxListePays'])->name('club.ajaxListePays');
        Route::get('/clubs/new',       [ClubController::class, 'create'])->name('club.create');
        Route::post('/clubs/edit',     [ClubController::class, 'edit'])->name('club.edit');
        Route::get('/clubs/{club}',    [ClubController::class, 'show'])->name('club.show');
        Route::post('/clubs',          [ClubController::class, 'store'])->name('club.store');
        Route::put('/clubs/{club}',    [ClubController::class, 'update'])->name('club.update');
        Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])->name('club.destroy');
        //  centre-formation
        Route::get('/centre-formation',                 [CentreFormationController::class, 'index'])->name('centreform.index');
        Route::post('/ajax-centre-formation',           [CentreFormationController::class, 'ajaxListeCentreForm'])->name('club.ajaxListeCentreForm');
        Route::get('/centre-formation/new',             [CentreFormationController::class, 'create'])->name('centreform.create');
        Route::post('/centre-formation/edit',           [CentreFormationController::class, 'edit'])->name('centreform.edit');
        Route::get('/centre-formation/{centreform}',    [CentreFormationController::class, 'show'])->name('centreform.show');
        Route::post('/centre-formation',                [CentreFormationController::class, 'store'])->name('centreform.store');
        Route::put('/centre-formation/{centreform}',    [CentreFormationController::class, 'update'])->name('centreform.update');
        Route::delete('/centre-formation/{centreform}', [CentreFormationController::class, 'destroy'])->name('centreform.destroy');
        //  associations
        Route::get('/associations',                  [AssociationController::class, 'index'])->name('association.index');
        Route::post('/ajax-association',             [AssociationController::class, 'ajaxListeAssociation'])->name('club.ajaxListeAssociation');
        Route::get('/associations/new',              [AssociationController::class, 'create'])->name('association.create');
        Route::post('/associations/edit',            [AssociationController::class, 'edit'])->name('association.edit');
        Route::get('/associations/{association}',    [AssociationController::class, 'show'])->name('association.show');
        Route::post('/associations',                 [ClubControAssociationControllerller::class, 'store'])->name('association.store');
        Route::put('/associations/{association}',    [AssociationController::class, 'update'])->name('association.update');
        Route::delete('/associations/{association}', [ClubCoAssociationControllerntroller::class, 'destroy'])->name('association.destroy');
    });

    Route::group([
        'prefix' => 'app/effective',
        'namespace' => 'App\Http\Controllers\Structures'
    ],function(){
        //  personnes
        Route::get('/personnes',               [PersonneController::class, 'index'])->name('personne.index');
        Route::get('/personnes/new',           [PersonneController::class, 'create'])->name('personne.create');
        Route::post('/personnes/edit',         [PersonneController::class, 'edit'])->name('personne.edit');
        Route::get('/personnes/{personne}',    [PersonneController::class, 'show'])->name('personne.show');
        Route::post('/personnes',              [PersonneController::class, 'store'])->name('personne.store');
        Route::put('/personnes/{personne}',    [PersonneController::class, 'update'])->name('personne.update');
        Route::delete('/personnes/{personne}', [PersonneController::class, 'destroy'])->name('personne.destroy');
    });
});
