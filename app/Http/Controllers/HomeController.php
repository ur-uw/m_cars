<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $logos_path = public_path('assets/imgs/logos');
        $logos = File::allFiles($logos_path);
        return view('home', compact('logos'));
    }
}
