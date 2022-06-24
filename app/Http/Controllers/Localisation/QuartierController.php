<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\QuartierRequest;
use App\Models\Localisation\Commune;
use App\Models\Localisation\Quartier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class QuartierController extends Controller
{
    /**
     * Retourne la liste des quartiers.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $quartiers = Quartier::all()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'codification' => $item->codification,
                'indicatif' => $item->indicatif,
                'visible' => $item->visible,
                'map' => asset('storage/quartiers/'.$item->map),
                'commune' => json_encode([
                    'id' => $item->commune->id,
                    'sigle' => $item->commune->sigle,
                ])
            ];
        });

        $communes = Commune::all()->map(function($item){
            return [
                'id' => $item->id,
                'sigle' => $item->sigle
            ];
        });

        return Inertia::render('App/Localisation/Quartiers', [
            'quartiers' => $quartiers,
            'communes' => $communes,
        ]);
    }

    /**
     * Ajouter un quartier.
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

        Quartier::create([
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
