<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CalendrierPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Activite/Calendrier/Index');
    }
}
