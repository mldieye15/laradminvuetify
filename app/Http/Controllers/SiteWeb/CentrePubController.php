<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CentrePubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Structure/Centre/Index');
    }
}
