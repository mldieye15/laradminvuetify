<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\RegionRequest;
use App\Models\Localisation\Pays;
use App\Models\Localisation\Region;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegionController extends Controller
{
    /**
     * Retourne la liste des régions.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $regions = Region::all()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'codification' => $item->codification,
                'indicatif' => $item->indicatif,
                'visible' => $item->visible,
                'map' => asset('storage/regions/'.$item->map),
                'pays' => json_encode([
                    'id' => $item->pays->id,
                    'sigle' => $item->pays->sigle,
                ])
            ];
        });

        $pays = Pays::all()->map(function($item){
            return [
                'id' => $item->id,
                'sigle' => $item->sigle
            ];
        });

        return Inertia::render('App/Localisation/Region', [
            'regions' => $regions,
            'pays' => $pays,
        ]);
    }

    /**
     * Ajouter une région.
     *
     * @param  \App\Http\Requests\Localisation\RegionRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(RegionRequest $request){
        $map_path = 'map-default.png';
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('map')->store('regions', 'public');
            $map_path = (explode('regions/', $map_path))[1];
        }

        Region::create([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'pays_id' => $request->pays['id']
        ]);

        return Redirect::route('regions.index');
    }

    /**
     * Metre à jour une région.
     *
     * @param  \App\Http\Requests\Localisation\RegionRequest  $request
     * @param  int $region
     * @return \Illuminate\Http\Response
    */
    public function update($region, RegionRequest $request){
        $oneRegion = Region::findOrFail($region);

        $map_path = $oneRegion->map;
        if ($request->hasFile('map')) {
            $request->validate([
                'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            //  supression du map raataché autre que le map par défaut
            if($oneRegion->map != 'map-default.png'){
                Storage::delete('public/regions/'.$oneRegion->map);
            }

            $map_path = $request->file('map')->store('regions', 'public');
            $map_path = (explode('regions/', $map_path))[1];
        }

        $oneRegion->update([
            'libelle' => $request->libelle,
            'sigle' => $request->sigle,
            'codification' => $request->codification,
            'indicatif' => $request->indicatif,
            'map' => $map_path,
            'pays_id' => $request->pays['id']
        ]);

        return Redirect::route('regions.index');
    }

    /**
     * Supprimer une region.
     *
     * @param  int $region
     * @return \Illuminate\Http\Response
    */
    public function destroy($region){
        $oneRegion = Region::findOrFail($region);

        if($oneRegion->map != 'map-default.png'){
            Storage::delete('public/regions/'.$oneRegion->map);
        }

        $oneRegion->delete();

        return Redirect::route('regions.index');
    }
}
