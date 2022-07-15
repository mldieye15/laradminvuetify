<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MatchPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Activite/Match/Index');
    }
}
