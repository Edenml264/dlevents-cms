<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    public function index()
    {
        return view('admin.cms.index');
    }

    public function settings()
    {
        $settings = SiteSetting::orderBy('group')->orderBy('order')->get()
            ->groupBy('group');
        return view('admin.cms.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            $setting = SiteSetting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    $path = $request->file("settings.{$key}")->store('public/site');
                    $value = Storage::url($path);
                }
                $setting->update(['value' => $value]);
            }
        }

        return back()->with('success', 'Configuración actualizada correctamente');
    }

    public function editPage($page)
    {
        $sections = PageSection::where('page', $page)
            ->orderBy('order')
            ->get();
        
        return view('admin.cms.edit-page', compact('page', 'sections'));
    }

    public function preview($page)
    {
        return view("admin.cms.preview.{$page}");
    }

    public function updateSection(Request $request, PageSection $section)
    {
        $validated = $request->validate([
            'content' => 'required',
            'is_active' => 'boolean',
            'order' => 'integer'
        ]);

        $section->update($validated);
        return back()->with('success', 'Sección actualizada correctamente');
    }
}
