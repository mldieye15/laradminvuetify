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
                'continent' => $item->continent->toJson()
                 /*json_encode([
                    'id' => $item->continent->id,
                    'libelle' => $item->continent->libelle
                ])$ $item->continent->toJson() */
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
        $onePays = Pays::findOrFail($pays);
        $flag_path = $onePays->flag;
        if ($request->hasFile('flag')) {
            //  supression
            if($onePays->flag != 'flag-default.png'){
                Storage::delete('public/pays/'.$onePays->flag);
            }
            $flag_path = $request->file('flag')->store('pays', 'public');
            $flag_path = (explode('pays/', $flag_path))[1];
            //$onePays->flag = $flag_path;
        }

        //
        if(isset($request->continent['id']) && $request->continent['id']!=null && $request->continent['id']!=0){
            $continent = $request->continent['id'];
        }else{
            $continent = $onePays->continent->id;
        }

        $onePays->update([
            'libelle' => $request->libelle, //$request->libelle,
            'sigle' => $request->sigle,
            'code_alpha2' => $request->code_alpha2,
            'code_alpha3' =>$request->code_alpha3,
            'indicatif' => $request->indicatif,
            'flag' => $flag_path,
            'continent_id' => $continent
        ]);

        return Redirect::route('pays.index');
    }

    /**
     * Supprimer un pays.
     *
     * @param  int $pays
     * @return \Illuminate\Http\Response
    */
    public function destroy($pays){
        $onePays = Pays::findOrFail($pays);
        if($onePays->flag != 'flag-default.png'){
            Storage::delete('public/pays/'.$onePays->flag);
        }

        $onePays->delete();

        return Redirect::route('pays.index');
    }
}
