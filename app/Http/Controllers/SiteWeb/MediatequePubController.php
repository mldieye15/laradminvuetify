<?php

namespace App\Http\Controllers\SiteWeb;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MediatequePubController extends Controller
{
    public function index(){
        return Inertia::render('Public/Federation/Mediateque/Index');
    }
}
