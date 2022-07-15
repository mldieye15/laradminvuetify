<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class ClubPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Structure/Club/Index');
    }
}
