<?php

namespace App\Http\Controllers\Localisation;

use App\Http\Controllers\Controller;
use App\Models\Localisation\Pays;
use App\Models\Localisation\Region;
use Inertia\Inertia;

class LocalisationController extends Controller
{
    public function index(){
        $pays = Pays::all();
        $regions = Region::all();

        return Inertia::render('App/Localisation/Localisation', [
            'pays' => $pays,
            'regions' => $regions,
        ]);
    }
}
