<?php

namespace App\Http\Controllers\Federation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\QuartierRequest;
use App\Models\Federation\Federation;
use App\Models\Localisation\Quartier;
use App\Services\Federation\FederationService;
use App\Services\Federation\LigueRegionaleService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FederationController extends Controller
{

    /**
     * @var service
    */
    protected $service;
    /**
     * @var ligRegService
    */
    protected $ligRegService;

    /**
     * FederationController Constructor
     *
     * @param App\Services\Federation\FederationService $service
     * @param App\Services\Federation\LigueRegionaleService $ligRegService
     *
     */
    public function __construct(FederationService $service, LigueRegionaleService $ligRegService )
    {
        $this->service = $service;
        $this->ligRegService = $ligRegService;
    }


    /**
     * Retourne la fédération.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $federation = $this->service->getFederation();
        $ligueRegionale = $this->ligRegService->simplifiedLigReg();

        return Inertia::render('App/Federation/Federation', [
            'federation' => $federation,
            'ligueRegionale' => $ligueRegionale,
        ]);
    }

    /**
     * Ajouter une fédération.
     *
     * @param  \App\Http\Requests\Localisation\QuartierRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(QuartierRequest $request){
        $map_path = 'map-default.png';
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('map')->store('quartiers', 'public');
            $map_path = (explode('quartiers/', $map_path))[1];
        }

        Federation::create([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'commune_id' => $request->commune['id']
        ]);

        return Redirect::route('quartiers.index');
    }

    /**
     * Metre à jour un quartier.
     *
     * @param  \App\Http\Requests\Localisation\QuartierRequest  $request
     * @param  int $quartier
     * @return \Illuminate\Http\Response
    */
    public function update($quartier, QuartierRequest $request){
        $oneQuartier = Quartier::findOrFail($quartier);

        $map_path = $oneQuartier->map;
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
            ]);

            //  supression du map rataché autre que le map par défaut
            if($oneQuartier->map != 'map-default.png'){
                Storage::delete('public/quartiers/'.$oneQuartier->map);
            }

            $map_path = $request->file('map')->store('quartiers', 'public');
            $map_path = (explode('quartiers/', $map_path))[1];
        }

        $oneQuartier->update([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'commune_id' => $request->commune['id']
        ]);

        return Redirect::route('quartiers.index');
    }

    /**
     * Supprimer un quartier.
     *
     * @param  int $quartier
     * @return \Illuminate\Http\Response
    */
    public function destroy($quartier){
        $oneQuartier = Quartier::findOrFail($quartier);

        if($oneQuartier->map != 'map-default.png'){
            Storage::delete('public/quartiers/'.$oneQuartier->map);
        }

        $oneQuartier->delete();

        return Redirect::route('quartiers.index');
    }
}
