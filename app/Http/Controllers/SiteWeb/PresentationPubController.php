<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PresentationPubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Federation/Presentation/Index');
    }
}
