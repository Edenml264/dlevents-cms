<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageSection;

class HomeController extends Controller
{
    public function index()
    {
        $sections = PageSection::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('home.index', compact('sections'));
    }
}
