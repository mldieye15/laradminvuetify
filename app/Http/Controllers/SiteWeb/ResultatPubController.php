<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ResultatPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Activite/Resultat/Index');
    }
}
