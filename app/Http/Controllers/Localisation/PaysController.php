<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\PaysRequest;
use App\Models\Localisation\Continent;
use App\Models\Localisation\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PaysController extends Controller
{
    /**
     * Retourne la liste des pays.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $pays = Pays::all()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'code_alpha2' => $item->code_alpha2,
                'code_alpha3' => $item->code_alpha3,
                'indicatif' => $item->indicatif,
                'visible' => $item->visible,
                'flag' => asset('storage/pays/'.$item->flag),
                'map' => asset('storage/pays/', $item->map),
                'continent' => json_encode([
                    'id' => $item->continent->id,
                    'libelle' => $item->continent->libelle
                ]) //$item->continent
            ];
        });
        $continents = Continent::all()->map(function($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle
            ];
        });

        return Inertia::render('App/Localisation/Pays', [
            'pays' => $pays,
            'continents' => $continents,
        ]);
    }

    /**
     * Ajoute un pays.
     *
     * @param  \App\Http\Requests\Localisation\PaysRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(PaysRequest $request){
        $flag_path = '';
        if ($request->hasFile('flag')) {
            $flag_path = $request->file('flag')->store('pays', 'public');
            $flag_path = (explode('pays/', $flag_path))[1];
        }
        $pays = Pays::create([
            'libelle' => $request->libelle, //$request->libelle,
            'sigle' => $request->sigle,
            'code_alpha2' => $request->code_alpha2,
            'code_alpha3' =>$request->code_alpha3,
            'indicatif' => $request->indicatif,
            'flag' => $flag_path,
            'continent_id' => $request->continent['id']
        ]);

        /*return Inertia::render('App/Localisation/Pays', [
            'pays' => $pays,
            'data' => Request::input('libelle')
        ]);*/
        return Redirect::route('pays.index');
    }

    /**
     * Metre à jour un pays.
     *
     * @param  \App\Http\Requests\Localisation\PaysRequest  $request
     * @param  int $pays
     * @return \Illuminate\Http\Response
    */
    public function update($pays, PaysRequest $request){
        $flag_path = '';
        //$extenetsion = (explode('.', $pays->flag))[1];
        //$nom 
        $onePays = Pays::findOrFail($pays);
        if ($request->hasFile('flag')) {
            //Storage::delete('public/pays/'.$pays->flag);
            $flag_path = $request->file('flag')->store('pays', 'public');
            $flag_path = (explode('pays/', $flag_path))[1];
        }

        $onePays->update([
            'libelle' => $request->libelle, //$request->libelle,
            'sigle' => $request->sigle,
            'code_alpha2' => $request->code_alpha2,
            'code_alpha3' =>$request->code_alpha3,
            'indicatif' => $request->indicatif,
            //'flag' => $flag_path ? '',
            'continent_id' => $request->continent['id']
        ]);
        return Redirect::route('pays.index');
    }

    /**
     * Supprimer un pays.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request){
        return null;
    }
}
