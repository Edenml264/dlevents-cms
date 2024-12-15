<?php

namespace App\Http\Controllers;

use App\Models\PageSection;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sections = PageSection::where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $navbar = Setting::where('key', 'navbar')->first()?->value;
        $footer = Setting::where('key', 'footer')->first()?->value;

        return view('welcome', compact('sections', 'navbar', 'footer'));
    }
}
