<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

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
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.cms.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
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
        $section->update($request->all());
        return back()->with('success', 'Sección actualizada correctamente');
    }
}
