<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\CommuneRequest;
use App\Models\Localisation\Commune;
use App\Models\Localisation\Departement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CommuneController extends Controller
{
    /**
     * Retourne la liste des communes.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $communes = Commune::all()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'codification' => $item->codification,
                'indicatif' => $item->indicatif,
                'visible' => $item->visible,
                'map' => asset('storage/communes/'.$item->map),
                'departement' => json_encode([
                    'id' => $item->departement->id,
                    'sigle' => $item->departement->sigle,
                ])
            ];
        });

        $departements = Departement::all()->map(function($item){
            return [
                'id' => $item->id,
                'sigle' => $item->sigle
            ];
        });

        return Inertia::render('App/Localisation/Commune', [
            'communes' => $communes,
            'departements' => $departements,
        ]);
    }

    /**
     * Ajouter une commune.
     *
     * @param  \App\Http\Requests\Localisation\CommuneRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(CommuneRequest $request){
        $map_path = 'map-default.png';
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('map')->store('communes', 'public');
            $map_path = (explode('communes/', $map_path))[1];
        }

        Commune::create([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'departement_id' => $request->departement['id']
        ]);

        return Redirect::route('communes.index');
    }

    /**
     * Metre à jour une commune.
     *
     * @param  \App\Http\Requests\Localisation\CommuneRequest  $request
     * @param  int $commune
     * @return \Illuminate\Http\Response
    */
    public function update($commune, CommuneRequest $request){
        $oneCommune = Commune::findOrFail($commune);

        $map_path = $oneCommune->map;
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            //  supression du map raataché autre que le map par défaut
            if($oneCommune->map != 'map-default.png'){
                Storage::delete('public/communes/'.$oneCommune->map);
            }

            $map_path = $request->file('map')->store('communes', 'public');
            $map_path = (explode('communes/', $map_path))[1];
        }

        $oneCommune->update([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'departement_id' => $request->departement['id']
        ]);

        return Redirect::route('communes.index');
    }

    /**
     * Supprimer une commune.
     *
     * @param  int $commune
     * @return \Illuminate\Http\Response
    */
    public function destroy($commune){
        $oneCommune = Commune::findOrFail($commune);

        if($oneCommune->map != 'map-default.png'){
            Storage::delete('public/communes/'.$oneCommune->map);
        }

        $oneCommune->delete();

        return Redirect::route('communes.index');
    }
}
