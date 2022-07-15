<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AssocaitionPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Structure/Association/Index');
    }
}
