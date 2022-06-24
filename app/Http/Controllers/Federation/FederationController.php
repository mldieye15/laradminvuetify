<?php

namespace App\Http\Controllers\Federation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\QuartierRequest;
use App\Models\Federation\Federation;
use App\Models\Localisation\Commune;
use App\Models\Localisation\Quartier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FederationController extends Controller
{
    /**
     * Retourne la fédération.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $federation = Federation::where('visible',1)->get()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'email' => $item->email,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'sologan' => $item->sologan,
                'fax' => $item->fax,
                'date_creation' => $item->date_creation,
                'recipisse_numero' => $item->recipisse_numero,
                'recipisse_date' => $item->recipisse_date,
                'recipisse_url' => $item->recipisse_url,
                'reglement_int_url' => $item->reglement_int_url,
                'page_web' => $item->page_web,
                'facebook' => $item->facebook,
                'whatsapp' => $item->whatsapp,
                'telegram' => $item->telegram,
                'instagram' => $item->instagram,
                'tiktok' => $item->tiktok,
                'logo' => asset('storage/federations/'.$item->logo),
                'sport' => json_encode([
                    'id' => $item->sport->id,
                    'libelle' => $item->sport->libelle,
                ])
            ];
        })
        ;

        return Inertia::render('App/Federation/Federation', [
            'federation' => $federation,
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
