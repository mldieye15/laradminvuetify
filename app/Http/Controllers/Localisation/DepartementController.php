<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\DepartementRequest;
use App\Models\Localisation\Departement;
use App\Models\Localisation\Region;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DepartementController extends Controller
{
    /**
     * Retourne la liste des départemnets.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $departements = Departement::all()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'codification' => $item->codification,
                'indicatif' => $item->indicatif,
                'visible' => $item->visible,
                'map' => asset('storage/departements/'.$item->map),
                'region' => json_encode([
                    'id' => $item->region->id,
                    'sigle' => $item->region->sigle,
                ])
            ];
        });

        $regions = Region::all()->map(function($item){
            return [
                'id' => $item->id,
                'sigle' => $item->sigle
            ];
        });

        return Inertia::render('App/Localisation/Departement', [
            'departements' => $departements,
            'regions' => $regions,
        ]);
    }

    /**
     * Ajouter un département.
     *
     * @param  \App\Http\Requests\Localisation\DepartementRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(DepartementRequest $request){
        $map_path = '';
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('map')->store('departements', 'public');
            $map_path = (explode('departements/', $map_path))[1];
        }

        Departement::create([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'region_id' => $request->region['id']
        ]);

        return Redirect::route('departements.index');
    }

    /**
     * Metre à jour un département.
     *
     * @param  \App\Http\Requests\Localisation\DepartementRequest  $request
     * @param  int $departement
     * @return \Illuminate\Http\Response
    */
    public function update($departement, DepartementRequest $request){
        $oneDepartement = Departement::findOrFail($departement);

        $map_path = $oneDepartement->map;
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            //  supression du map raataché autre que le map par défaut
            if($oneDepartement->map != 'map-default.png'){
                Storage::delete('public/departements/'.$oneDepartement->map);
            }

            $map_path = $request->file('map')->store('departements', 'public');
            $map_path = (explode('departements/', $map_path))[1];
        }

        $oneDepartement->update([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'region_id' => $request->region['id']
        ]);

        return Redirect::route('departements.index');
    }

    /**
     * Supprimer un département.
     *
     * @param  int $departement
     * @return \Illuminate\Http\Response
    */
    public function destroy($departement){
        $oneDepartement = Departement::findOrFail($departement);

        if($oneDepartement->map != 'map-default.png'){
            Storage::delete('public/departements/'.$oneDepartement->map);
        }

        $oneDepartement->delete();

        return Redirect::route('departements.index');
    }
}
