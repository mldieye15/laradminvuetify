<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class UtilHelper {

    /** Affichage du title de l apage? par défaut on afficher Office du bac*/
    public static function getTitle($title){
        return   $title.' | '.config('app.name') ?? config('app.name') ;
    }

    /** Mette active le menu de la page*/
    public static function setActive($route){
        return  Route::is($route) ? 'active' : '';
    }
}
