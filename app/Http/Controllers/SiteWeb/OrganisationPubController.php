<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class OrganisationPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Federation/Organisation/Index');
    }
}
