<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Localisation\PaysRequest;
use App\Models\Localisation\Pays;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaysController extends Controller
{
    /**
     * Retourne la liste des pays.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        $pays = Pays::all();

        return Inertia::render('App/Localisation/Pays', [
            'pays' => $pays,
        ]);
    }

    /**
     * Ajoute un pays.
     *
     * @param  \App\Http\Requests\Localisation\PaysRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(PaysRequest $request){
        return null;
    }

    /**
     * Metre à jour un pays.
     *
     * @param  \App\Http\Requests\Localisation\PaysRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function update(PaysRequest $request){
        return null;
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
