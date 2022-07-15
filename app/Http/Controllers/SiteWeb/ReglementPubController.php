<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ReglementPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Textes/Reglements/Index');
    }
}
