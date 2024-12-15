<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Models\NavbarSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CmsController extends Controller
{
    public function index()
    {
        $pages = Page::all()->mapWithKeys(function ($page) {
            return [$page->identifier => $page->name];
        });

        return view('admin.cms.index', compact('pages'));
    }

    public function settings()
    {
        $settings = SiteSetting::orderBy('order')
            ->get()
            ->groupBy('group');
            
        $navbarSettings = NavbarSetting::first();
        
        return view('admin.cms.settings', compact('settings', 'navbarSettings'));
    }

    public function updateSettings(Request $request)
    {
        // Actualizar configuraciones generales
        foreach ($request->settings as $key => $value) {
            $setting = SiteSetting::where('key', $key)->first();
            
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    $path = $request->file("settings.{$key}")->store('public/settings');
                    $value = Storage::url($path);
                }
                
                $setting->update(['value' => $value]);
            }
        }

        // Actualizar configuraciones del navbar
        if ($request->has('navbar')) {
            $navbarSettings = NavbarSetting::first();
            if (!$navbarSettings) {
                $navbarSettings = new NavbarSetting();
            }

            if ($request->hasFile('navbar.logo')) {
                $path = $request->file('navbar.logo')->store('public/navbar');
                $navbarSettings->logo = Storage::url($path);
            }

            $navbarSettings->show_contact_button = $request->input('navbar.show_contact_button', false);
            $navbarSettings->contact_button_text = $request->input('navbar.contact_button_text');
            $navbarSettings->social_links = $request->input('navbar.social_links', []);
            $navbarSettings->save();
        }

        return back()->with('success', 'Configuración actualizada correctamente');
    }

    public function editPage(Page $page)
    {
        $sections = $page->sections()->orderBy('order')->get();
        return view('admin.cms.page.edit', compact('page', 'sections'));
    }

    public function updatePage(Request $request, Page $page)
    {
        $page->update($request->validated());
        return back()->with('success', 'Página actualizada correctamente');
    }

    public function preview(Page $page)
    {
        return view('pages.' . $page->identifier, compact('page'));
    }

    public function sections(Page $page)
    {
        $sections = $page->sections()->orderBy('order')->get();
        return view('admin.cms.sections.index', compact('page', 'sections'));
    }

    public function editSection(PageSection $section)
    {
        return view('admin.cms.sections.edit', compact('section'));
    }

    public function updateSection(Request $request, PageSection $section)
    {
        try {
            $data = $request->validate([
                'title' => 'nullable|string|max:255',
                'content' => 'required|string',
                'order' => 'required|integer|min:1',
                'is_active' => 'required|in:0,1'
            ]);

            $data['is_active'] = (bool)$data['is_active'];

            $section->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Sección actualizada correctamente'
                ]);
            }

            return back()->with('success', 'Sección actualizada correctamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar la sección: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
}
